#
# Table structure for table 'tx_bpnhandle_domain_model_handle'
#
CREATE TABLE tx_bpnhandle_domain_model_handle
(
	uid       int(11)                 NOT NULL auto_increment,
	pid       int(11)      DEFAULT 0  NOT NULL,
	tstamp    int(11)      DEFAULT 0  NOT NULL,
	crdate    int(11)      DEFAULT 0  NOT NULL,
	cruser_id int(11)      DEFAULT 0  NOT NULL,
	deleted   tinyint(4)   DEFAULT 0  NOT NULL,
	hidden    tinyint(4)   DEFAULT 0  NOT NULL,

	name      varchar(200) DEFAULT '' NOT NULL,
	type      varchar(20)  DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY handle (name)
) ENGINE = InnoDB;

CREATE TABLE tt_content
(
	handle varchar(100) DEFAULT '' NOT NULL,
	KEY handle (handle)
) ENGINE = InnoDB;

CREATE TABLE pages
(
	handle varchar(100) DEFAULT '' NOT NULL,
	KEY handle (handle)
) ENGINE = InnoDB;

CREATE TABLE fe_groups
(
	handle varchar(100) DEFAULT '' NOT NULL,
	KEY handle (handle)
) ENGINE = InnoDB;
