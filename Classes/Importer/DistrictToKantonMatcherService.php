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

use Visol\EasyvoteSmartvote\Domain\Model\Election;

/**
 * Importer service
 */
class DistrictToKantonMatcherService
{

    /**
     * @var \Visol\EasyvoteSmartvote\Domain\Repository\DistrictRepository
     * @inject
     */
    protected $districtRepository;

    /**
     * @var \Visol\Easyvote\Domain\Repository\KantonRepository
     * @inject
     */
    protected $kantonRepository;

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
        $this->districtRepository->setDefaultQuerySettings($querySettings);
        $this->kantonRepository->setDefaultQuerySettings($querySettings);
    }

    /**
     * Match a party to its national party
     *
     * @param bool $verbose
     * @return array
     */
    public function matchDistrictsToKanton($verbose = FALSE)
    {
        $districts = $this->districtRepository->findByElection($this->election);
        foreach ($districts as $district) {
            /** @var $district \Visol\EasyvoteSmartvote\Domain\Model\District */
            $kanton = $this->kantonRepository->findOneByName($district->getName());
            if ($kanton instanceof \Visol\Easyvote\Domain\Model\Kanton) {
                if ($verbose) {
                    $this->log('[MATCH]    District: ' . $district->getName() . ' --> ' . $kanton->getName());
                }
                $district->setCanton($kanton);
                $this->districtRepository->update($district);
                $this->persistenceManager->persistAll();
            } else {
                if ($verbose) {
                    $this->log('[NO MATCH] District: ' . $district->getName());
                }
            }

        }
        return $this->logs;
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

}
