#
# Table structure for table 'tx_visittablets_domain_model_inmate'
#
CREATE TABLE tx_visittablets_domain_model_inmate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	date_of_birth date DEFAULT '0000-00-00',
	place_of_birth varchar(255) DEFAULT '' NOT NULL,
	nationality varchar(255) DEFAULT '' NOT NULL,
	day_of_passing varchar(255) DEFAULT '' NOT NULL,
	profession varchar(255) DEFAULT '' NOT NULL,
	prison_start date DEFAULT '0000-00-00',
	prison_end date DEFAULT '0000-00-00',
	subtitle varchar(255) DEFAULT '' NOT NULL,
	event varchar(255) DEFAULT '' NOT NULL,
	teasertext text NOT NULL,
	text text NOT NULL,
	media int(11) unsigned NOT NULL default '0',
	vip tinyint(1) unsigned DEFAULT '0' NOT NULL,
	prison_cell int(11) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_visittablets_domain_model_cardpoi'
#
CREATE TABLE tx_visittablets_domain_model_cardpoi (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	language int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	longitude double(11,2) DEFAULT '0.00' NOT NULL,
	latitude double(11,2) DEFAULT '0.00' NOT NULL,
	flag_text varchar(255) DEFAULT '' NOT NULL,
	sub_title varchar(255) DEFAULT '' NOT NULL,
	media int(11) unsigned NOT NULL default '0',
	description text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)

);
#
# Table structure for table 'tx_visittablets_domain_model_scopepoi'
#
CREATE TABLE tx_visittablets_domain_model_scopepoi (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	x int(11) DEFAULT '0' NOT NULL,
	y int(11) DEFAULT '0' NOT NULL,
	radius int(11) DEFAULT '0' NOT NULL,
	sub_title varchar(255) DEFAULT '' NOT NULL,
	media int(11) unsigned NOT NULL default '0',
	description text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_visittablets_domain_model_prisoncell'
#
CREATE TABLE tx_visittablets_domain_model_prisoncell (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	inmate int(11) unsigned DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	imates int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_visittablets_domain_model_prisoncell'
#
CREATE TABLE tx_visittablets_domain_model_prisoncell (

	inmate int(11) unsigned DEFAULT '0' NOT NULL,

);
