<?php
namespace Visol\EasyvoteSmartvote\Importer;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Core\Tests\Exception;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Visol\EasyvoteSmartvote\Domain\Model\Election;

/**
 * Importer service
 */
class CandidateImageImporterService
{

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\CandidateRepository
     * @inject
     */
    protected $candidateRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @inject
     */
    protected $objectManager;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager;

    /**
     * @var Election
     */
    protected $election;

    /**
     * The table holding all candidates
     *
     * @var string
     */
    protected $candidateTable = 'tx_easyvotesmartvote_domain_model_candidate';

    /**
     * @var array
     */
    protected $logs = array();

    /**
     * @var bool
     */
    protected $verbose;

    public function initializeObject()
    {
        /** @var $querySettings \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings */
        $querySettings = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\Typo3QuerySettings');
        $querySettings->setRespectStoragePage(FALSE);
        $this->candidateRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * Match a party to its national party
     *
     * @param bool $forceReimport
     * @return array
     */
    public function importImages($forceReimport = FALSE)
    {
        $candidates = $this->candidateRepository->findByElectionIgnoreFrontend($this->election);
        $i = 0;
        foreach ($candidates as $candidate) {
            if ($i > 40) {
                // DEBUG
                //break;
            }
            $candidateInfo = ' / ' . $candidate['first_name'] . ' ' . $candidate['last_name'] . ' (' . $candidate['uid'] . ')';
            if (!empty($candidate['serialized_photos']) && count(json_decode($candidate['serialized_photos']))) {
                $photos = json_decode($candidate['serialized_photos']);

                // Encoding of file name is required since name could contains accents and spaces.
                $baseName = urlencode(basename($photos[0]));
                $urlPath = dirname($photos[0]);
                $remotePhotoUrl = 'https://www.smartvote.ch' . $urlPath . '/' . $baseName;

                // Download the file
                $remoteFilesize = $this->getRemoteFilesize($remotePhotoUrl);
                if ((int)$candidate['photo_cached_remote_filesize'] === $remoteFilesize && !$forceReimport) {
                    $this->log('[CHECK]   [OK]          No photo update needed.' . $candidateInfo);
                } elseif ($remoteFilesize > 0 || ($remoteFilesize > 0 && $forceReimport)) {
                    $this->log('[CHECK]   [TODO]        Photo update needed.' . $candidateInfo);
                    $this->importOrUpdatePhotoForCandidate($remotePhotoUrl, $remoteFilesize, $candidate);
                } else {
                    $this->log('[CHECK]   [OK]          Photo of candidate doesn\'t exist.' . $candidateInfo);
                }
            } else {
                $this->log('[CHECK]   [OK]          Candidate has no photo.' . $candidateInfo);
            }
            $i++;
        }
        return $this->logs;
    }

    /**
     * Return the file size of a remote file if the request was successful
     *
     * @param $url
     * @return int|null
     */
    protected function getRemoteFilesize($url)
    {
        $remoteFileHeaderData = GeneralUtility::getUrl($url, 2);
        $remoteFileSize = NULL;
        if ($remoteFileHeaderData) {
            $status = NULL;
            if (preg_match("/^HTTP\/1\.[01] (\d\d\d)/", $remoteFileHeaderData, $matches)) {
                $status = (int)$matches[1];
            }
            if (preg_match("/Content-Length: (\d+)/", $remoteFileHeaderData, $matches)) {
                $contentLength = (int)$matches[1];
            }
            if ($status === 200 && $contentLength > 0) {
                $remoteFileSize = $contentLength;
            }
        }
        return $remoteFileSize;
    }

    /**
     * Import or update a photo of a candidate
     * If the candidate doesn't have a file reference, then a new file is added. If not, the existing file is replaced
     * with new content.
     *
     * @param string $url
     * @param int $remoteFileSize
     * @param array $candidate
     */
    protected function importOrUpdatePhotoForCandidate($url, $remoteFileSize, $candidate)
    {
        $candidateInfo = ' / ' . $candidate['first_name'] . ' ' . $candidate['last_name'] . ' (' . $candidate['uid'] . ')';
        $fileContent = GeneralUtility::getUrl($url);
        if ($fileContent) {
            $temporaryFilename = GeneralUtility::tempnam('candidate-' . $candidate['uid'] . '-', '.jpg');
            GeneralUtility::writeFile($temporaryFilename, $fileContent);

            $this->cropImage($temporaryFilename);

            $existingFileReferences = $this->getFileRepository()->findByRelation($this->candidateTable, 'photo', $candidate['uid']);

            if (count($existingFileReferences)) {
                // User already has a photo, so we need to replace the underlying file with a new one
                // photo has maxitems=1
                /** @var \TYPO3\CMS\Core\Resource\FileReference $existingFileReference */
                $existingFileReference = $existingFileReferences[0];
                $existingFile = $existingFileReference->getOriginalFile();
                $this->replaceExistingPhoto($existingFile, $temporaryFilename, $remoteFileSize, $candidate);
            } else {
                $this->importPhoto($temporaryFilename, $remoteFileSize, $candidate);
            }

        } else {
            $this->log('[FETCH]   [FAIL]        Photo could not be downloaded from remote server.' . $candidateInfo);
        }
    }

    /**
     * Replace the content of an existing File object with a new picture
     * Update the cached remote file size to ensure that the photo is compared to the current remote file on next run.
     *
     * @param \TYPO3\CMS\Core\Resource\File $existingPhoto
     * @param string $newPhotoFilename
     * @param string $remoteFileSize
     * @param array $candidate
     * @throws \TYPO3\CMS\Core\Resource\Exception\IllegalFileExtensionException
     */
    protected function replaceExistingPhoto($existingPhoto, $newPhotoFilename, $remoteFileSize, $candidate)
    {
        $candidateInfo = ' / ' . $candidate['first_name'] . ' ' . $candidate['last_name'] . ' (' . $candidate['uid'] . ')';
        try {
            $this->getFileStorage()->replaceFile($existingPhoto, $newPhotoFilename);
            $this->log('[REPLACE] [OK]          Photo was replaced by a new photo.' . $candidateInfo);
            $data = [];
            $data[$this->candidateTable][$candidate['uid']] = array(
                'photo' => 1,
                'photo_cached_remote_filesize' => $remoteFileSize
            );
            /** @var \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler */
            $dataHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler');
            $dataHandler->start($data, array());
            $dataHandler->admin = TRUE;
            $dataHandler->process_datamap();
            if ($dataHandler->errorLog) {
                $this->log('[REPLACE] [UPDATE-FAIL] Cached remote file size could not be updated. Reason: ' . $dataHandler->errorLog . $candidateInfo);
            } else {
                $this->log('[REPLACE] [UPDATE-OK]   Cached remote file size was updated.' . $candidateInfo);
            }
        } catch (Exception $e) {
            $this->log('[REPLACE] [FAIL]        Photo could not be replaced by a new photo. Reason: ' . $e->getMessage() . $candidateInfo);
        }
    }

    /**
     * Copy a given file to the smartvote folder, create a File object and a FileReference for it
     *
     * @param string $photoFilename
     * @param string $remoteFileSize
     * @param array $candidate
     * @throws \TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException
     */
    protected function importPhoto($photoFilename, $remoteFileSize, $candidate)
    {
        $candidateInfo = ' / ' . $candidate['first_name'] . ' ' . $candidate['last_name'] . ' (' . $candidate['uid'] . ')';

        // User doesn't have a photo yet, so we add a new file and file reference
        $folder = $this->getResourceFactory()->createFolderObject($this->getFileStorage(), '/smartvote', 'smartvote');
        $file = $this->getFileStorage()->addFile($photoFilename, $folder);
        $data = [];
        $data['sys_file_reference']['NEW' . uniqid(6)] = array(
            'uid_local' => $file->getUid(),
            'table_local' => 'sys_file',
            'uid_foreign' => $candidate['uid'],
            'tablenames' => $this->candidateTable,
            'fieldname' => 'photo',
            'pid' => $candidate['pid']
        );
        $data[$this->candidateTable][$candidate['uid']] = array(
            'photo' => 1,
            'photo_cached_remote_filesize' => $remoteFileSize
        );
        /** @var \TYPO3\CMS\Core\DataHandling\DataHandler $dataHandler */
        $dataHandler = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\DataHandling\DataHandler');
        $dataHandler->start($data, array());
        $dataHandler->admin = TRUE;
        $dataHandler->process_datamap();
        if ($dataHandler->errorLog) {
            $this->log('[SAVE]    [FAIL]        Photo could not be saved in TYPO3 instance. Reason: ' . $dataHandler->errorLog . $candidateInfo);
        } else {
            $this->log('[SAVE]    [OK]          Photo was successfully saved.' . $candidateInfo);
        }
    }

    /**
     * @param string $filePathAndName
     */
    protected function cropImage($filePathAndName)
    {
        $imageInformation = getimagesize($filePathAndName);
        if (empty($imageInformation)) {
            $this->log('[RESIZE]  [FAIL]        Photo size could not be determined.');
            return;
        }

        $width = (int)$imageInformation[0];
        $height = (int)$imageInformation[1];

        $fileCropConfiguration = [];
        if ($width > $height) {
            // landscape
            $fileCropConfiguration['height'] = $height;
            $fileCropConfiguration['width'] = $height . 'c';
        } else {
            // portrait
            $fileCropConfiguration['width'] = $width;
            // take the topmost part of the image
            $fileCropConfiguration['height'] = $width . 'c-100';
        }
        $conf = array(
            'file' => $filePathAndName,
            'file.' => $fileCropConfiguration
        );
        $croppedImage = $this->getContentObjectRenderer()->IMG_RESOURCE($conf);
        if ($croppedImage) {
            $croppedImageFilename = GeneralUtility::getFileAbsFileName($croppedImage);
            copy($croppedImageFilename, $filePathAndName);
            GeneralUtility::unlink_tempfile($croppedImageFilename);
            $this->log('[RESIZE]  [OK]          Photo was successfully resized.');
        } else {
            $this->log('[RESIZE]  [FAIL]        Photo could not be resized.');
        }
    }

    /**
     * @param string $log
     * @return void
     */
    protected function log($log)
    {
        $this->logs[] = $log . "\n";
    }

    /**
     * @param Election $election
     */
    public function setElection(Election $election)
    {
        $this->election = $election;
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\ResourceStorage
     */
    protected function getFileStorage()
    {
        // Storage with uid=1 is hardcoded
        $storageObject = $this->getResourceFactory()->getStorageObject(1);
        // Don't check permission because we don't have a real backend user in Command Controller context
        $storageObject->setEvaluatePermissions(FALSE);
        return $storageObject;
    }

    /**
     * @return ResourceFactory
     */
    protected function getResourceFactory()
    {
        return ResourceFactory::getInstance();
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\FileRepository
     */
    protected function getFileRepository()
    {
        return GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
    }

    /**
     * @return \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected function getContentObjectRenderer()
    {
        return GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
    }

}
