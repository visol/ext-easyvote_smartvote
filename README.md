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

Command Line Interface
----------------------

To import the Post Boxes

	./typo3/cli_dispatch.phpsh extbase smartvote:import


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