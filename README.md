EasyVote Location
=================

TYPO3 CMS extension for form importing data from EasyVote using its API.

Build assets
------------

Source is located at `Resources/Public/JavaScript/App/*.js`. Grunt will watch
the files and generate as editing the build file into
`Resources/Public/JavaScript/Build/Bundle.js`. To start watching.

```
npm install
grunt watch
```

Import
------

### All data

To import all smartvote data:

```
./typo3/cli_dispatch.phpsh extbase smartvote:import
```

### Cantonal scope import

There are basically 4 steps

-   Create new set of election records in the database. The legislative election
    should be created prior to the executive e.g. "17_vd_leg", "17_vd_exe".
    Adjust the settings in the BE and makes sure to connect the executive -\>
    legislative.

```
# Same for Ständerat
election_identifier="17_vd_leg"

# Each command accept option --verbose
./typo3/cli_dispatch.phpsh extbase smartvote:import --identifier $election_identifier
./typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier $election_identifier
```

-   Duplicate pages in the BE and adjust its content.

-   Create a scheduler task to import the smartvote's data every night. e.g 3:00

-   Created a cron job to import the candidate's images every night 3:10. This
    task is still necessary since the task will fail in the context of the
    scheduler.

```
10 3 * * * /var/www/vhosts/easyvote/htdocs/typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier 17_vd_leg
```

### National scope

Other commands available:

-   `connectpartiestonationalparty`: Tries to match parties to the respective
    national party.

-   `importcandidateimage`: Imports and resizes/crops candidate images

Typical import workflow below. Important: make sure to connect the elections in
the BE beforehand, like the Ständerat election is connected to the National
election in order to solve connected questionnaire.

```
# Nationalrat
election_identifier="15_ch_nr"

# Same for Ständerat
election_identifier="15_ch_sr"

# Each command accept option --verbose
./typo3/cli_dispatch.phpsh extbase smartvote:import --identifier $election_identifier
./typo3/cli_dispatch.phpsh extbase smartvote:connectPartiesToNationalParty --identifier $election_identifier
./typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier $election_identifier
./typo3/cli_dispatch.phpsh extbase smartvote:connectDistrictsToCanton --identifier $election_identifier
```

The matching of parties to national parties might not be complete because there
is no national party for some local/ cantonal parties. These relations must be
adjusted manually.

Re-importing data
-----------------

If you're re-importing data, you must also truncate File References and Files of
candidate images:

```
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_answer;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_candidate;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_civilstate;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_denomination;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_district;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_education;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_electionlist;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_party;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_question;
TRUNCATE TABLE tx_easyvotesmartvote_domain_model_questioncategory;

DELETE FROM sys_file_reference WHERE tablenames='tx_easyvotesmartvote_domain_model_candidate';
DELETE FROM sys_file WHERE identifier LIKE '/smartvote%';
```

Then, you can safely remove all files from /fileadmin/smartvote and the caching
files

```
rm -f fileadmin/smartvote/*
rm -f typo3temp/Cache/Data/easyvote_smartvote/*
```

Finally, run the importer CLI commands

Unit Test
---------

Guidance for running the Unit Test in this extension

```
# Install the PHPUnit Framework
cd typo3_src
composer install

# Run the test
typo3_src/bin/phpunit --colors -c typo3/sysext/core/Build/UnitTests.xml typo3conf/ext/easyvote_smartvote/Tests/Unit
```

TODO
----

-   Image import is failing in the conext of the scheduler
