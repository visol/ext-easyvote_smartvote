EasyVote Location
=================

TYPO3 CMS extension for form importing data from EasyVote using its API.

TODO
----

* localization

Installation
------------

Because of an issue with SVG image, the following settings must be configured on the page where the plugin is installed within in a TS template.

config.baseURL >
config.absRefPrefix = /

Build assets
------------

Source is located at `Resources/Public/JavaScript/App/*.js`. Grunt will watch the files and generate as editing the build file into
`Resources/Public/JavaScript/Build/Bundle.js`. To start watching.

```
	npm install
	grunt watch
```

Command Line Interface
----------------------

To import all smartvote data:

	./typo3/cli_dispatch.phpsh extbase smartvote:import

Other commands available:

  * connectpartiestonationalparty: Tries to match parties to the respective national party.
  * importcandidateimage: Imports and resizes/crops candidate images

Typical import workflow below. Important: make sure to connect the elections in the BE beforehand,
like the Ständerat election is connected to the National election in order to solve connected questionnaire.

	# Nationalrat
	./typo3/cli_dispatch.phpsh extbase smartvote:import --identifier 15_ch_nr
	./typo3/cli_dispatch.phpsh extbase smartvote:connectPartiesToNationalParty --identifier 15_ch_nr --verbose
	./typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier 15_ch_nr --verbose

	# Same for Ständerat
	./typo3/cli_dispatch.phpsh extbase smartvote:import --identifier 15_ch_sr
	./typo3/cli_dispatch.phpsh extbase smartvote:connectPartiesToNationalParty --identifier 15_ch_sr --verbose
	./typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier 15_ch_sr --verbose
	
If you're re-importing data, you must also truncate File References and Files of candidate images:

	delete from sys_file_reference where tablenames='tx_easyvotesmartvote_domain_model_candidate';
	delete from sys_file where identifier LIKE '/smartvote%';

Then, you can safely remove all files from /fileadmin/smartvote.

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
