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

use Visol\EasyvoteSmartvote\Enumeration\Model;

/**
 * Import Parties from the SmartVote platform.
 */
class PartyImporter extends AbstractImporter
{

    /**
     * @var
     */
    protected $tableName = 'tx_easyvotesmartvote_domain_model_party';

    /**
     * @var
     */
    protected $internalIdentifier = 'ID_party';

    /**
     * @var array
     */
    protected $serializedFields = array(
        'constituencies' => 'serialized_districts',
        'lists' => 'serialized_election_lists',
        'answers' => 'serialized_answers',
    );

    /**
     * @var
     */
    protected $mappingFields = array(
        'party' => 'title',
        'party_short' => 'title_short',
        'logo' => 'logo',
        'n_candidates' => 'number_of_candidates',
        'n_answers' => 'number_of_answers',
        'facebookProfile' => 'facebook_profile',
        'website' => 'website',
        #'parents' => 'parents',
        #'constituencies' => 'districts', -> serialized
        #'lists' => 'lists',  -> serialized
        #'answers' => 'answers',  -> serialized
    );

    /**
     * @return array
     */
    public function import()
    {
        $collectedData = parent::import(Model::PARTY);

        $this->postProcessParentParty();

        return $collectedData;
    }


    /**
     * Post-process the candidates to compute the answers.
     * Goal is to convert the smartvote question id to the easyvote question id.
     *
     * @throws \Exception
     */
    protected function postProcessParentParty()
    {

        $items = $this->getItemsFromDatasource(Model::PARTY);

        foreach ($items as $item) {
            if (!empty($item['parents'])) {
                $values = ['internal_identifier_parent' => $item['parents'][0]];
                $condition = sprintf(
                    'election = %s AND internal_identifier = %s',
                    $this->election->getUid(),
                    $item['ID_party']
                );
                $this->getDatabaseConnection()->exec_UPDATEquery($this->tableName, $condition, $values);
            }
        }
    }

    /**
     * @return array
     */
    public function localize()
    {
        return parent::localize(Model::PARTY);
    }

}
