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
	city varchar(255) DEFAULT '' NOT NULL,
	language varchar(255) DEFAULT '' NOT NULL,
	district_name varchar(255) DEFAULT '' NOT NULL,
	party_short varchar(255) DEFAULT '' NOT NULL,
	incumbent tinyint(1) unsigned DEFAULT '0' NOT NULL,
	elected tinyint(1) unsigned DEFAULT '0' NOT NULL,
	civil_state_name varchar(255) DEFAULT '' NOT NULL,
	denomination_name varchar(255) DEFAULT '' NOT NULL,
	education_name varchar(255) DEFAULT '' NOT NULL,
	employment_name text NOT NULL,
	occupation varchar(255) DEFAULT '' NOT NULL,
	number_of_children int(11) DEFAULT '0' NOT NULL,
	hobbies text NOT NULL,
	favorite_books text NOT NULL,
	favorite_music text NOT NULL,
	favorite_movies text NOT NULL,
	link_to_smart_spider varchar(255) DEFAULT '' NOT NULL,
	link_to_portrait varchar(255) DEFAULT '' NOT NULL,
	link_to_facebook varchar(255) DEFAULT '' NOT NULL,
	link_to_twitter varchar(255) DEFAULT '' NOT NULL,
	link_to_politnetz varchar(255) DEFAULT '' NOT NULL,
	link_to_youtube varchar(255) DEFAULT '' NOT NULL,
	link_to_vimeo varchar(255) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	why_me text NOT NULL,
	slogan text NOT NULL,
	personal_website varchar(255) DEFAULT '' NOT NULL,
	election_list_name varchar(255) DEFAULT '' NOT NULL,
	photos int(11) DEFAULT '0' NOT NULL,
	photo int(11) DEFAULT '0' NOT NULL,
	photo_cached_remote_filesize int(11) DEFAULT '0' NOT NULL,
	links int(11) DEFAULT '0' NOT NULL,
	answers int(11) DEFAULT '0' NOT NULL,
	spider_values int(11) DEFAULT '0' NOT NULL,
	coordinate int(11) DEFAULT '0' NOT NULL,
	serialized_photos text NOT NULL,
	serialized_links text NOT NULL,
	serialized_answers text NOT NULL,
	serialized_spider_values text NOT NULL,
	serialized_coordinate text NOT NULL,
	party int(11) unsigned DEFAULT '0',
	district int(11) unsigned DEFAULT '0',
	election int(11) unsigned DEFAULT '0',
	election_list int(11) unsigned DEFAULT '0',
	civil_state int(11) unsigned DEFAULT '0',
	denomination int(11) unsigned DEFAULT '0',
	education int(11) unsigned DEFAULT '0',

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
	districts int(11) DEFAULT '0' NOT NULL,
	election_lists int(11) DEFAULT '0' NOT NULL,
	answers int(11) DEFAULT '0' NOT NULL,
	serialized_districts text NOT NULL,
	serialized_election_lists text NOT NULL,
	serialized_answers text NOT NULL,
	election int(11) unsigned DEFAULT '0',
	national_party int(11) unsigned DEFAULT '0',

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
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
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

	title varchar(255) DEFAULT '' NOT NULL,
	short_title varchar(255) DEFAULT '' NOT NULL,
	election_date int(11) unsigned DEFAULT '0' NOT NULL,
	smart_vote_identifier varchar(255) DEFAULT '' NOT NULL,
	import_log text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	total_cleavage1 int(11) DEFAULT '0' NOT NULL,
	total_cleavage2 int(11) DEFAULT '0' NOT NULL,
	total_cleavage3 int(11) DEFAULT '0' NOT NULL,
	total_cleavage4 int(11) DEFAULT '0' NOT NULL,
	total_cleavage5 int(11) DEFAULT '0' NOT NULL,
	total_cleavage6 int(11) DEFAULT '0' NOT NULL,
	total_cleavage7 int(11) DEFAULT '0' NOT NULL,
	total_cleavage8 int(11) DEFAULT '0' NOT NULL,

	related_election int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
);

#
# Table structure for table 'tx_easyvotesmartvote_domain_model_education'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_education (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_civilstate'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_civilstate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_denomination'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_denomination (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_questioncategory'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_questioncategory (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_question'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_question (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name text NOT NULL,
	alternative_uid int(11) DEFAULT '0' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
	groupping int(11) DEFAULT '0' NOT NULL,
	type varchar(255) DEFAULT '' NOT NULL,
	rapide tinyint(1) unsigned DEFAULT '0' NOT NULL,
	education tinyint(1) unsigned DEFAULT '0' NOT NULL,
	cleavage1 int(11) DEFAULT '0' NOT NULL,
	cleavage2 int(11) DEFAULT '0' NOT NULL,
	cleavage3 int(11) DEFAULT '0' NOT NULL,
	cleavage4 int(11) DEFAULT '0' NOT NULL,
	cleavage5 int(11) DEFAULT '0' NOT NULL,
	cleavage6 int(11) DEFAULT '0' NOT NULL,
	cleavage7 int(11) DEFAULT '0' NOT NULL,
	cleavage8 int(11) DEFAULT '0' NOT NULL,
	info text NOT NULL,
	pro text NOT NULL,
	contra varchar(255) DEFAULT '' NOT NULL,
	election int(11) unsigned DEFAULT '0',
	category int(11) unsigned DEFAULT '0',

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
# Table structure for table 'tx_easyvotesmartvote_domain_model_electionlist'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_electionlist (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	number_of_candidates int(11) DEFAULT '0' NOT NULL,
	number_of_answers int(11) DEFAULT '0' NOT NULL,
	internal_identifier varchar(255) DEFAULT '' NOT NULL,
	link_to_list varchar(255) DEFAULT '' NOT NULL,
	list_number varchar(255) DEFAULT '' NOT NULL,
	election int(11) unsigned DEFAULT '0',
	district int(11) unsigned DEFAULT '0',

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
# Table structure for table 'tx_easyvotesmartvote_domain_model_link'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_link (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	url varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_answer'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_answer (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	question int(11) DEFAULT '0' NOT NULL,
	internal_identifier int(11) DEFAULT '0' NOT NULL,
	value int(11) DEFAULT '0' NOT NULL,
	comment text NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_spidervalue'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_spidervalue (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	cleavage int(11) DEFAULT '0' NOT NULL,
	internal_identifier int(11) DEFAULT '0' NOT NULL,
	value double(11,2) DEFAULT '0.00' NOT NULL,
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
# Table structure for table 'tx_easyvotesmartvote_domain_model_coordinate'
#
CREATE TABLE tx_easyvotesmartvote_domain_model_coordinate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	x double(11,2) DEFAULT '0.00' NOT NULL,
	y double(11,2) DEFAULT '0.00' NOT NULL,
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
