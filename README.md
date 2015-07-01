EasyVote Location
=================

TYPO3 CMS extension for form importing data from EasyVote using its API.

TODO
----

* remove localization
* Add Vidi module
* Change module of Votewecker
* Configure Logger to send email

* Check whether to keep or not those models

```
	Candidate
	---------
	'photos' => [ ], -> serialized
	'links' => [ ], -> serialized
	'answers' -> serialized
	'spiderValues' -> serialized
	'coordinate' -> serialized

	Party
	-----
	#'constituencies' => 'districts', -> serialized
	#'lists' => 'lists',  -> serialized
	#'answers' => 'answers',  -> serialized
```

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

Typical import workflow:

	./typo3/cli_dispatch.phpsh extbase smartvote:import --identifier 11_ch_sr
	./typo3/cli_dispatch.phpsh extbase smartvote:connectPartiesToNationalParty --identifier 11_ch_sr --verbose
	./typo3/cli_dispatch.phpsh extbase smartvote:importCandidateImage --identifier 11_ch_sr --verbose

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
