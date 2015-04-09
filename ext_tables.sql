#
# Table structure for table 'tx_easyvotesmartvote_domain_model_candidate'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_candidate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
	gender varchar(255) DEFAULT '' NOT NULL,
	year_of_birth varchar(255) DEFAULT '' NOT NULL,
	language varchar(255) DEFAULT '' NOT NULL,
	city varchar(255) DEFAULT '' NOT NULL,
	incumbent tinyint(1) unsigned DEFAULT '0' NOT NULL,
	elected tinyint(1) unsigned DEFAULT '0' NOT NULL,
	party int(11) unsigned DEFAULT '0',
	district int(11) unsigned DEFAULT '0',
	election int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotesmartvote_domain_model_party'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_party (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
	name_short varchar(255) DEFAULT '' NOT NULL,
	logo varchar(255) DEFAULT '' NOT NULL,
	number_of_candidates int(11) DEFAULT '0' NOT NULL,
	number_of_answers int(11) DEFAULT '0' NOT NULL,
	facebook_profile varchar(255) DEFAULT '' NOT NULL,
	website varchar(255) DEFAULT '' NOT NULL,
	candidates int(11) unsigned DEFAULT '0' NOT NULL,
	election int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotesmartvote_domain_model_district'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_district (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	seats int(11) DEFAULT '0' NOT NULL,
	internal_identifier int(11) DEFAULT '0' NOT NULL,
	candidates int(11) unsigned DEFAULT '0' NOT NULL,
	election int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotesmartvote_domain_model_election'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_election (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	district int(11) unsigned DEFAULT '0' NOT NULL,

	smart_vote_identifier varchar(255) DEFAULT '' NOT NULL,
	type int(11) DEFAULT '0' NOT NULL,
	year int(11) DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),

 KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_easyvotesmartvote_domain_model_election'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_election (

	district  int(11) unsigned DEFAULT '0' NOT NULL,

);
