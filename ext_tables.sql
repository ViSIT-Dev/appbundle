#
# Table structure for table 'tx_visittablets_domain_model_config'
#
CREATE TABLE tx_visittablets_domain_model_config (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	language int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	content text DEFAULT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (language)

);


#
# Table structure for table 'tx_visittablets_domain_model_inmate'
#
CREATE TABLE tx_visittablets_domain_model_inmate (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	first_name varchar(255) DEFAULT '' NOT NULL,
	last_name varchar(255) DEFAULT '' NOT NULL,
	nationality varchar(255) DEFAULT '' NOT NULL,
	profession varchar(255) DEFAULT '' NOT NULL,
  place_of_birth varchar(255) DEFAULT '' NOT NULL,
	date_of_birth varchar(255) DEFAULT '' NOT NULL,
	date_of_passing varchar(255) DEFAULT '' NOT NULL,
	date_of_imprisonment varchar(255) DEFAULT '' NOT NULL,
	date_of_release varchar(255) DEFAULT '' NOT NULL,
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

  language int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

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

	PRIMARY KEY (uid),
	KEY parent (pid),

);


#
# Table structure for table 'tx_visittablets_domain_model_galerycontentelement'
#
CREATE TABLE tx_visittablets_domain_model_galerycontentelement (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	language int(11) DEFAULT '0' NOT NULL,
	sub_elements int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	sub_title varchar(255) DEFAULT '' NOT NULL,
	teaser_text text DEFAULT '' NOT NULL,
	text text NOT NULL,
	layout int(11) NOT NULL default '0',
	media int(11) unsigned NOT NULL default '0',
        
	sorting int(11) DEFAULT '0' NOT NULL,
  hidden tinyint(1) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_visittablets_domain_model_galerycontentsubelement'
#
CREATE TABLE tx_visittablets_domain_model_galerycontentsubelement (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,


	title varchar(255) DEFAULT '' NOT NULL,
	text text NOT NULL,
	light_theme tinyint(1) unsigned DEFAULT '0' NOT NULL,
	media int(11) unsigned NOT NULL default '0',
	galery_content_element int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,
  hidden tinyint(1) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_visittablets_domain_model_galeryteaserelement'
#
CREATE TABLE tx_visittablets_domain_model_galeryteaserelement (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	teaser_title varchar(255) DEFAULT '' NOT NULL,
	teaser_title_en varchar(255) DEFAULT '' NOT NULL,
	media int(11) unsigned NOT NULL default '0',

	galery_content_element int(11) unsigned DEFAULT '0' NOT NULL,
	galery_content_element_en int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,
  hidden tinyint(1) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(1) unsigned DEFAULT '0' NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

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
  fullscreenvideo tinyint(1) unsigned DEFAULT '0' NOT NULL,
	description text NOT NULL,

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	language int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY language (language)

);

#
# Table structure for table 'tx_visittablets_domain_model_prisoncell'
#
CREATE TABLE tx_visittablets_domain_model_prisoncell (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	name_en varchar(255) DEFAULT '' NOT NULL,
	inmates int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);

#
# Table structure for table 'tx_visittablets_domain_model_event'
#
CREATE TABLE tx_visittablets_domain_model_event (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	name varchar(255) DEFAULT '' NOT NULL,
	name_en varchar(255) DEFAULT '' NOT NULL,
	inmates int(11) unsigned DEFAULT '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,

	sorting int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),

);