-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.0.51b-community - MySQL Community Edition (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2014-04-29 00:25:25
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table ajmidb.cc_agent
DROP TABLE IF EXISTS `cc_agent`;
CREATE TABLE IF NOT EXISTS `cc_agent` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `domain` int(5) unsigned NOT NULL default '0',
  `userid` varchar(16) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `name` varchar(64) NOT NULL default '',
  `agent_group` smallint(5) unsigned NOT NULL default '3',
  `occupancy` tinyint(3) unsigned NOT NULL default '3',
  `login_status` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `userid` (`userid`),
  UNIQUE KEY `idx_id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent: 6 rows
DELETE FROM `cc_agent`;
/*!40000 ALTER TABLE `cc_agent` DISABLE KEYS */;
INSERT INTO `cc_agent` (`id`, `domain`, `userid`, `password`, `name`, `agent_group`, `occupancy`, `login_status`) VALUES
	(1, 0, 'root', '81dc9bdb52d04dc20036dbd8313ed055', 'System Root', 3, 3, 2),
	(43, 0, 'User01', '81dc9bdb52d04dc20036dbd8313ed055', 'Agent Outbound 01', 3, 3, 1),
	(44, 0, 'User02', '81dc9bdb52d04dc20036dbd8313ed055', 'Agent Inbound 01', 3, 3, 1),
	(45, 0, 'AM01', '81dc9bdb52d04dc20036dbd8313ed055', 'Account Manager', 3, 3, 1),
	(46, 0, 'User03', '81dc9bdb52d04dc20036dbd8313ed055', 'User03', 3, 3, 1),
	(47, 0, 'QA01', '81dc9bdb52d04dc20036dbd8313ed055', 'QA01', 3, 3, 0);
/*!40000 ALTER TABLE `cc_agent` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_activity
DROP TABLE IF EXISTS `cc_agent_activity`;
CREATE TABLE IF NOT EXISTS `cc_agent_activity` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `agent` int(5) unsigned NOT NULL default '0',
  `agent_group` int(5) unsigned NOT NULL default '0',
  `agent_skill` int(5) unsigned NOT NULL default '0',
  `status` int(5) unsigned NOT NULL default '0',
  `status_time` datetime default NULL,
  `status_reason` int(5) unsigned NOT NULL default '0',
  `contact_type` int(5) unsigned NOT NULL default '0',
  `rec_status` int(5) unsigned NOT NULL default '0',
  `rec_status_time` datetime default NULL,
  `login_time` datetime default NULL,
  `logout_time` datetime default NULL,
  `last_login_time` datetime default NULL,
  `last_logout_time` datetime default NULL,
  `ext_status` int(5) unsigned NOT NULL default '0',
  `ext_number` varchar(8) NOT NULL default '',
  `ext_status_time` datetime default NULL,
  `location` varchar(64) NOT NULL default '',
  `dialer_status` int(5) unsigned NOT NULL default '0',
  `dialer_status_time` datetime default NULL,
  `tot_ready_time` int(8) unsigned NOT NULL default '0',
  `tot_notready_time` int(8) unsigned NOT NULL default '0',
  `tot_acw_time` int(8) unsigned NOT NULL default '0',
  `tot_busy_time` int(8) unsigned NOT NULL default '0',
  `tot_outbound_time` int(8) unsigned NOT NULL default '0',
  `tot_acd_call` int(8) unsigned NOT NULL default '0',
  `tot_abd_call` int(8) unsigned NOT NULL default '0',
  `tot_talk_time` int(8) unsigned NOT NULL default '0',
  `tot_ring_time` int(8) unsigned NOT NULL default '0',
  `tot_abd_time` int(8) unsigned NOT NULL default '0',
  `tot_hold_time` int(8) unsigned NOT NULL default '0',
  `tot_acd_email` int(8) unsigned NOT NULL default '0',
  `tot_acd_sms` int(8) unsigned NOT NULL default '0',
  `tot_acd_fax` int(8) unsigned NOT NULL default '0',
  `remote_number` varchar(40) default NULL,
  `data` varchar(80) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key_activity` (`id`,`agent`),
  KEY `idx_ext_number` (`ext_number`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_activity: 1 rows
DELETE FROM `cc_agent_activity`;
/*!40000 ALTER TABLE `cc_agent_activity` DISABLE KEYS */;
INSERT INTO `cc_agent_activity` (`id`, `agent`, `agent_group`, `agent_skill`, `status`, `status_time`, `status_reason`, `contact_type`, `rec_status`, `rec_status_time`, `login_time`, `logout_time`, `last_login_time`, `last_logout_time`, `ext_status`, `ext_number`, `ext_status_time`, `location`, `dialer_status`, `dialer_status_time`, `tot_ready_time`, `tot_notready_time`, `tot_acw_time`, `tot_busy_time`, `tot_outbound_time`, `tot_acd_call`, `tot_abd_call`, `tot_talk_time`, `tot_ring_time`, `tot_abd_time`, `tot_hold_time`, `tot_acd_email`, `tot_acd_sms`, `tot_acd_fax`, `remote_number`, `data`) VALUES
	(1, 1, 0, 0, 1, '2014-04-28 06:00:24', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 7, '5656', '2014-04-27 06:00:24', '', 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);
/*!40000 ALTER TABLE `cc_agent_activity` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_activity_code
DROP TABLE IF EXISTS `cc_agent_activity_code`;
CREATE TABLE IF NOT EXISTS `cc_agent_activity_code` (
  `id` int(10) NOT NULL auto_increment,
  `code` tinyint(3) default NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_activity_code: 5 rows
DELETE FROM `cc_agent_activity_code`;
/*!40000 ALTER TABLE `cc_agent_activity_code` DISABLE KEYS */;
INSERT INTO `cc_agent_activity_code` (`id`, `code`, `name`) VALUES
	(1, 0, 'Logout'),
	(2, 1, 'Ready'),
	(3, 2, 'Not Ready'),
	(4, 3, 'ACW'),
	(5, 4, 'Busy');
/*!40000 ALTER TABLE `cc_agent_activity_code` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_activity_log
DROP TABLE IF EXISTS `cc_agent_activity_log`;
CREATE TABLE IF NOT EXISTS `cc_agent_activity_log` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `agent` int(5) unsigned NOT NULL default '0',
  `agent_group` int(5) unsigned NOT NULL default '0',
  `agent_skill` int(5) unsigned NOT NULL default '0',
  `ext_number` varchar(8) NOT NULL default '',
  `location` varchar(64) NOT NULL default '',
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `status` smallint(5) unsigned NOT NULL default '0',
  `reason` smallint(5) unsigned NOT NULL default '0',
  `next_status` smallint(5) unsigned NOT NULL default '0',
  `next_reason` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `agent_time_stat` (`agent`,`start_time`,`end_time`,`status`),
  KEY `idx_agent_endtime` (`agent`,`end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_activity_log: ~0 rows (approximately)
DELETE FROM `cc_agent_activity_log`;
/*!40000 ALTER TABLE `cc_agent_activity_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_agent_activity_log` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_extension_status
DROP TABLE IF EXISTS `cc_agent_extension_status`;
CREATE TABLE IF NOT EXISTS `cc_agent_extension_status` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `code` int(10) unsigned default NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_extension_status: 7 rows
DELETE FROM `cc_agent_extension_status`;
/*!40000 ALTER TABLE `cc_agent_extension_status` DISABLE KEYS */;
INSERT INTO `cc_agent_extension_status` (`id`, `code`, `name`) VALUES
	(1, 4, 'Offhook'),
	(2, 5, 'Ringing'),
	(3, 6, 'Dialing'),
	(4, 7, 'Talking'),
	(5, 8, 'Held'),
	(6, 17, 'Reserved'),
	(7, 25, 'Idle');
/*!40000 ALTER TABLE `cc_agent_extension_status` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_group
DROP TABLE IF EXISTS `cc_agent_group`;
CREATE TABLE IF NOT EXISTS `cc_agent_group` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `code` varchar(32) NOT NULL default '',
  `description` varchar(64) NOT NULL default '',
  `direction` tinyint(3) unsigned NOT NULL default '0',
  `hunting_number` varchar(8) default NULL,
  `group_type` smallint(5) unsigned NOT NULL default '0',
  `overflow_group` int(5) unsigned NOT NULL default '0',
  `autoacw` smallint(5) unsigned NOT NULL default '0',
  `autoacwtime` smallint(5) unsigned NOT NULL default '0',
  `autoacwreason` smallint(5) unsigned NOT NULL default '0',
  `status_active` smallint(5) unsigned default '1',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `hunting_number` (`hunting_number`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_group: 4 rows
DELETE FROM `cc_agent_group`;
/*!40000 ALTER TABLE `cc_agent_group` DISABLE KEYS */;
INSERT INTO `cc_agent_group` (`id`, `code`, `description`, `direction`, `hunting_number`, `group_type`, `overflow_group`, `autoacw`, `autoacwtime`, `autoacwreason`, `status_active`) VALUES
	(1, 'GROUP01', 'GROUP01', 3, '1001', 0, 0, 0, 0, 0, 1),
	(2, 'GROUP02', 'GROUP02', 3, '1002', 0, 0, 0, 0, 0, 1),
	(3, 'GROUP03', 'GROUP03', 3, '1003', 0, 0, 0, 0, 0, 1),
	(4, 'GROUP04', 'GROUP04', 3, '1004', 0, 0, 0, 0, 0, 1);
/*!40000 ALTER TABLE `cc_agent_group` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_skill
DROP TABLE IF EXISTS `cc_agent_skill`;
CREATE TABLE IF NOT EXISTS `cc_agent_skill` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `agent` int(5) NOT NULL default '0',
  `skill` smallint(5) unsigned NOT NULL default '0',
  `score` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_skill: 2 rows
DELETE FROM `cc_agent_skill`;
/*!40000 ALTER TABLE `cc_agent_skill` DISABLE KEYS */;
INSERT INTO `cc_agent_skill` (`id`, `agent`, `skill`, `score`) VALUES
	(1, 1, 1, 100),
	(2, 43, 1, 100);
/*!40000 ALTER TABLE `cc_agent_skill` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_agent_trend
DROP TABLE IF EXISTS `cc_agent_trend`;
CREATE TABLE IF NOT EXISTS `cc_agent_trend` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `agent_group` int(5) unsigned NOT NULL default '0',
  `trend_time` datetime default NULL,
  `agent_reg` int(5) unsigned NOT NULL default '0',
  `agent_active` int(5) unsigned NOT NULL default '0',
  `agent_ready` int(5) unsigned NOT NULL default '0',
  `agent_acw` int(5) unsigned NOT NULL default '0',
  `agent_notready` int(5) unsigned NOT NULL default '0',
  `agent_busy` int(5) unsigned NOT NULL default '0',
  `agent_outbound` int(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_agent_trend: 0 rows
DELETE FROM `cc_agent_trend`;
/*!40000 ALTER TABLE `cc_agent_trend` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_agent_trend` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_app_reference
DROP TABLE IF EXISTS `cc_app_reference`;
CREATE TABLE IF NOT EXISTS `cc_app_reference` (
  `ref_group` varchar(64) NOT NULL,
  `ref_value` int(11) NOT NULL,
  `ref_desc` varchar(128) default NULL,
  `ref_note` varchar(128) default NULL,
  `ref_order` int(11) default NULL,
  PRIMARY KEY  (`ref_group`,`ref_value`),
  KEY `idx_ref_group` (`ref_group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_app_reference: 7 rows
DELETE FROM `cc_app_reference`;
/*!40000 ALTER TABLE `cc_app_reference` DISABLE KEYS */;
INSERT INTO `cc_app_reference` (`ref_group`, `ref_value`, `ref_desc`, `ref_note`, `ref_order`) VALUES
	('FAX_STATUS', 0, 'Null', NULL, 0),
	('FAX_STATUS', 1, 'New', NULL, 1),
	('FAX_STATUS', 2, 'Fax Document Ready', NULL, 2),
	('FAX_STATUS', 3, 'On Progress', NULL, 3),
	('FAX_STATUS', 4, 'Success', NULL, 4),
	('FAX_STATUS', 5, 'Failed', NULL, 5),
	('FAX_STATUS', 101, 'Failed invalid file', NULL, 6);
/*!40000 ALTER TABLE `cc_app_reference` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_callsession_code
DROP TABLE IF EXISTS `cc_callsession_code`;
CREATE TABLE IF NOT EXISTS `cc_callsession_code` (
  `CallSessionId` int(10) unsigned NOT NULL auto_increment,
  `CallSessionCode` varchar(5) NOT NULL default '',
  `Description` varchar(50) default NULL,
  PRIMARY KEY  (`CallSessionId`,`CallSessionCode`),
  UNIQUE KEY `CallSessionCode` (`CallSessionCode`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_callsession_code: 19 rows
DELETE FROM `cc_callsession_code`;
/*!40000 ALTER TABLE `cc_callsession_code` DISABLE KEYS */;
INSERT INTO `cc_callsession_code` (`CallSessionId`, `CallSessionCode`, `Description`) VALUES
	(1, '0001', 'CALL_OFFERED'),
	(2, '0002', 'DROPED_OFFERED'),
	(3, '1001', 'IVR_RINGING'),
	(4, '1002', 'IVR_ABANDON'),
	(5, '1003', 'IVR_CONNECTED'),
	(6, '1004', 'IVR_TERMINATED'),
	(7, '2001', 'QUEUED'),
	(8, '2002', 'QUEUE_TERMINATED'),
	(9, '3001', 'AGENT_ROUTED'),
	(10, '3002', 'AGENT_RINGING'),
	(11, '3003', 'AGENT_ABANDON'),
	(12, '3004', 'AGENT_CONNECTED'),
	(13, '3005', 'AGENT_TERMINATED'),
	(14, '3006', 'AGENT_HELD'),
	(15, '3007', 'AGENT_ORIGINATED'),
	(16, '3008', 'AGENT_TRUNKSEIZED'),
	(17, '3009', 'AGENT_INITIATED'),
	(18, '3010', 'AGENT_FAILED'),
	(19, '9999', 'TERMINATED');
/*!40000 ALTER TABLE `cc_callsession_code` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_call_session
DROP TABLE IF EXISTS `cc_call_session`;
CREATE TABLE IF NOT EXISTS `cc_call_session` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `session_id` varchar(32) NOT NULL default '',
  `session_track` bigint(10) unsigned NOT NULL default '0',
  `direction` smallint(5) unsigned NOT NULL default '0',
  `call_type` smallint(5) unsigned NOT NULL default '0',
  `status` smallint(5) unsigned NOT NULL default '0',
  `last_status` smallint(5) unsigned NOT NULL default '0',
  `priority` smallint(5) unsigned NOT NULL default '0',
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `a_number` varchar(24) default NULL,
  `b_number` varchar(24) default NULL,
  `d_number` varchar(24) default NULL,
  `trunk_number` varchar(8) default NULL,
  `trunk_member` varchar(8) default NULL,
  `ivr_port` varchar(8) default NULL,
  `ivr_ext` varchar(8) default NULL,
  `ivr_data` varchar(255) default NULL,
  `ivr_duration` int(5) default NULL,
  `que_ext` varchar(8) default NULL,
  `que_port` varchar(8) default NULL,
  `que_start` datetime default NULL,
  `que_end` datetime default NULL,
  `agent_id` int(5) default NULL,
  `agent_group` int(5) default NULL,
  `agent_time` datetime default NULL,
  `agent_ext` varchar(24) default NULL,
  `agent_ring` int(5) default NULL,
  `agent_talk` int(5) default NULL,
  `agent_hold` int(5) default NULL,
  `assign_id` bigint(6) default NULL,
  `assign_data` varchar(255) default NULL,
  `cust_id` bigint(6) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `session_id` (`session_id`),
  KEY `idx_1` (`agent_id`,`start_time`),
  KEY `idx_2` (`agent_id`,`start_time`,`status`),
  KEY `start_time` (`start_time`),
  KEY `idx_assign_data` (`assign_data`),
  KEY `idx_assign_time` (`start_time`,`assign_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_call_session: ~0 rows (approximately)
DELETE FROM `cc_call_session`;
/*!40000 ALTER TABLE `cc_call_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_call_session` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_call_track
DROP TABLE IF EXISTS `cc_call_track`;
CREATE TABLE IF NOT EXISTS `cc_call_track` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `call_session` bigint(10) unsigned NOT NULL default '0',
  `start_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `end_time` datetime default NULL,
  `status` smallint(5) unsigned NOT NULL default '0',
  `next_status` smallint(5) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `call_trac_ie1` (`call_session`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_call_track: ~0 rows (approximately)
DELETE FROM `cc_call_track`;
/*!40000 ALTER TABLE `cc_call_track` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_call_track` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_extension_agent
DROP TABLE IF EXISTS `cc_extension_agent`;
CREATE TABLE IF NOT EXISTS `cc_extension_agent` (
  `id` int(4) NOT NULL auto_increment,
  `pbx` int(10) unsigned default '0',
  `ext_number` varchar(8) NOT NULL default '',
  `ext_desc` varchar(64) default NULL,
  `ext_type` smallint(3) NOT NULL default '0' COMMENT 'analog, digital, softphone',
  `ext_status` smallint(3) NOT NULL default '0' COMMENT 'enable, disable',
  `ext_location` varchar(64) NOT NULL default '' COMMENT 'ip, hostname, port',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_extension_agent: 2 rows
DELETE FROM `cc_extension_agent`;
/*!40000 ALTER TABLE `cc_extension_agent` DISABLE KEYS */;
INSERT INTO `cc_extension_agent` (`id`, `pbx`, `ext_number`, `ext_desc`, `ext_type`, `ext_status`, `ext_location`) VALUES
	(1, 1, '4535', 'Agent Inbound', 2, 1, '127.0.0.1'),
	(3, 1, '9043', 'Agent Inbound', 0, 1, '192.168.1.46');
/*!40000 ALTER TABLE `cc_extension_agent` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_extension_ivr
DROP TABLE IF EXISTS `cc_extension_ivr`;
CREATE TABLE IF NOT EXISTS `cc_extension_ivr` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `pbx` int(10) unsigned NOT NULL default '0',
  `ext_port` varchar(8) NOT NULL default '0',
  `ext_number` varchar(8) NOT NULL,
  `ext_desc` varchar(64) NOT NULL,
  `ext_type` smallint(3) unsigned NOT NULL default '0',
  `ext_status` smallint(3) unsigned NOT NULL default '0',
  `tapi_id` int(5) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `ext_number` (`pbx`,`ext_number`),
  KEY `ext_port` (`pbx`,`ext_port`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_extension_ivr: 0 rows
DELETE FROM `cc_extension_ivr`;
/*!40000 ALTER TABLE `cc_extension_ivr` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_extension_ivr` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_groups
DROP TABLE IF EXISTS `cc_groups`;
CREATE TABLE IF NOT EXISTS `cc_groups` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `code` varchar(32) NOT NULL default '',
  `description` varchar(64) NOT NULL default '',
  `direction` tinyint(3) unsigned NOT NULL default '0',
  `hunting_number` varchar(8) default NULL,
  `group_type` smallint(5) unsigned NOT NULL default '0',
  `overflow_group` int(5) unsigned NOT NULL default '0',
  `autoacw` smallint(5) unsigned NOT NULL default '0',
  `autoacwtime` smallint(5) unsigned NOT NULL default '0',
  `autoacwreason` smallint(5) unsigned NOT NULL default '0',
  `status_active` smallint(5) unsigned default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `hunting_number` (`hunting_number`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_groups: 0 rows
DELETE FROM `cc_groups`;
/*!40000 ALTER TABLE `cc_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_groups` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_ivr
DROP TABLE IF EXISTS `cc_ivr`;
CREATE TABLE IF NOT EXISTS `cc_ivr` (
  `id` int(11) NOT NULL auto_increment,
  `hunting_number` varchar(10) NOT NULL default '',
  `description` varchar(64) NOT NULL default '',
  `agent_group` smallint(5) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `idx_hunting_number` (`hunting_number`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_ivr: 2 rows
DELETE FROM `cc_ivr`;
/*!40000 ALTER TABLE `cc_ivr` DISABLE KEYS */;
INSERT INTO `cc_ivr` (`id`, `hunting_number`, `description`, `agent_group`) VALUES
	(1, '3000', 'HUNTING IVR1', 1),
	(2, '3100', 'HUNTING IVR2', 2);
/*!40000 ALTER TABLE `cc_ivr` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_pbx
DROP TABLE IF EXISTS `cc_pbx`;
CREATE TABLE IF NOT EXISTS `cc_pbx` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pbx_name` varchar(16) NOT NULL default '',
  `pbx_desc` varchar(64) NOT NULL default '',
  `model` varchar(64) NOT NULL default '',
  `link_protocol` varchar(16) NOT NULL default '',
  `status` int(3) unsigned NOT NULL default '0',
  `note` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_pbx: 5 rows
DELETE FROM `cc_pbx`;
/*!40000 ALTER TABLE `cc_pbx` DISABLE KEYS */;
INSERT INTO `cc_pbx` (`id`, `pbx_name`, `pbx_desc`, `model`, `link_protocol`, `status`, `note`) VALUES
	(1, 'ajmicc-pbx01', 'PBX01', 'IP-PBX', 'ASTCON', 1, NULL),
	(2, 'ajmicc-pbx02', 'PBX02', 'IP-PBX', 'ASTCON', 1, NULL),
	(3, 'ajmicc-pbx03', 'PBX03', 'IP-PBX', 'ASTCON', 1, NULL),
	(4, 'ajmicc-pbx04', 'PBX04', 'IP-PBX', 'ASTCON', 1, NULL),
	(5, 'ajmicc-pbx05', 'PBX05', 'IP-PBX', 'ASTCON', 1, NULL);
/*!40000 ALTER TABLE `cc_pbx` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_pbx_settings
DROP TABLE IF EXISTS `cc_pbx_settings`;
CREATE TABLE IF NOT EXISTS `cc_pbx_settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pbx` int(10) unsigned NOT NULL default '0',
  `set_name` varchar(255) NOT NULL default '',
  `set_type` int(5) unsigned NOT NULL default '0',
  `set_value` varchar(255) NOT NULL default '',
  `set_comment` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `pbxsetting` (`pbx`,`set_name`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table ajmidb.cc_pbx_settings: 3 rows
DELETE FROM `cc_pbx_settings`;
/*!40000 ALTER TABLE `cc_pbx_settings` DISABLE KEYS */;
INSERT INTO `cc_pbx_settings` (`id`, `pbx`, `set_name`, `set_type`, `set_value`, `set_comment`) VALUES
	(1, 1, 'host', 0, '192.168.1.46', NULL),
	(2, 1, 'port', 0, '5043', NULL),
	(3, 1, 'tac', 0, '', NULL);
/*!40000 ALTER TABLE `cc_pbx_settings` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_phone_debit
DROP TABLE IF EXISTS `cc_phone_debit`;
CREATE TABLE IF NOT EXISTS `cc_phone_debit` (
  `agentid` int(10) unsigned NOT NULL,
  `userid` varchar(32) default NULL,
  `enabled` tinyint(3) unsigned default '0',
  `balance` bigint(20) default '0',
  `lastusedate` datetime default NULL,
  `expiredate` datetime default NULL,
  PRIMARY KEY  (`agentid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_phone_debit: 0 rows
DELETE FROM `cc_phone_debit`;
/*!40000 ALTER TABLE `cc_phone_debit` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_phone_debit` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_phone_debit_transaction
DROP TABLE IF EXISTS `cc_phone_debit_transaction`;
CREATE TABLE IF NOT EXISTS `cc_phone_debit_transaction` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `origin` char(32) default NULL,
  `destination` char(32) default NULL,
  `group_id` smallint(32) default NULL,
  `date_time` datetime default NULL,
  `amount` int(10) unsigned default NULL,
  `amount_before` int(10) unsigned default NULL,
  `amount_after` int(10) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `origin` (`origin`,`destination`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_phone_debit_transaction: 0 rows
DELETE FROM `cc_phone_debit_transaction`;
/*!40000 ALTER TABLE `cc_phone_debit_transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_phone_debit_transaction` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_phone_status_log
DROP TABLE IF EXISTS `cc_phone_status_log`;
CREATE TABLE IF NOT EXISTS `cc_phone_status_log` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `agent` int(5) unsigned NOT NULL default '0',
  `agent_group` int(5) unsigned NOT NULL default '0',
  `ext_number` varchar(8) NOT NULL default '',
  `session_id` varchar(32) NOT NULL default '',
  `location` varchar(64) NOT NULL default '',
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `status` smallint(5) unsigned NOT NULL default '0',
  `reason` smallint(5) unsigned NOT NULL default '0',
  `next_status` smallint(5) unsigned NOT NULL default '0',
  `next_reason` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `agent` (`agent`),
  KEY `ext_number` (`ext_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_phone_status_log: ~0 rows (approximately)
DELETE FROM `cc_phone_status_log`;
/*!40000 ALTER TABLE `cc_phone_status_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_phone_status_log` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_queue_activity
DROP TABLE IF EXISTS `cc_queue_activity`;
CREATE TABLE IF NOT EXISTS `cc_queue_activity` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `call_session` varchar(32) NOT NULL default '',
  `port` varchar(8) default NULL,
  `ext_number` varchar(8) default NULL,
  `caller_number` varchar(32) default NULL,
  `agent_group` int(5) unsigned NOT NULL default '0',
  `agent_skill` int(5) unsigned NOT NULL default '0',
  `start_time` datetime default NULL,
  `orderno` int(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `call_session` (`call_session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_queue_activity: 0 rows
DELETE FROM `cc_queue_activity`;
/*!40000 ALTER TABLE `cc_queue_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_queue_activity` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_reasons
DROP TABLE IF EXISTS `cc_reasons`;
CREATE TABLE IF NOT EXISTS `cc_reasons` (
  `reasonid` int(5) unsigned NOT NULL auto_increment,
  `reason_tipe` tinyint(2) unsigned NOT NULL default '0',
  `reason_code` varchar(32) NOT NULL default '',
  `reason_desc` varchar(64) NOT NULL default '',
  `reason_timeout` int(5) default '0',
  PRIMARY KEY  (`reasonid`),
  UNIQUE KEY `reason_code` (`reasonid`,`reason_code`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_reasons: 4 rows
DELETE FROM `cc_reasons`;
/*!40000 ALTER TABLE `cc_reasons` DISABLE KEYS */;
INSERT INTO `cc_reasons` (`reasonid`, `reason_tipe`, `reason_code`, `reason_desc`, `reason_timeout`) VALUES
	(1, 1, 'BRIEFING', 'Briefing "', 0),
	(2, 1, 'PRAY', 'Pray "', 0),
	(3, 1, 'REST', 'Rest "', 0),
	(4, 1, 'LUNCH', 'Lunch "', 0);
/*!40000 ALTER TABLE `cc_reasons` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_recording
DROP TABLE IF EXISTS `cc_recording`;
CREATE TABLE IF NOT EXISTS `cc_recording` (
  `id` bigint(10) unsigned NOT NULL auto_increment,
  `agent_id` smallint(5) unsigned default '0',
  `agent_group` smallint(5) unsigned default '0',
  `agent_ext` varchar(24) default NULL,
  `anumber` varchar(24) default NULL,
  `start_time` datetime default NULL,
  `end_time` datetime default NULL,
  `duration` int(11) default NULL,
  `direction` tinyint(3) unsigned default NULL,
  `session_key` varchar(32) NOT NULL default '',
  `file_voc_type` varchar(10) default NULL,
  `file_voc_size` varchar(10) default NULL,
  `file_voc_loc` varchar(128) default NULL,
  `file_voc_name` varchar(250) NOT NULL default '',
  `file_scr_type` varchar(10) default NULL,
  `file_scr_size` varchar(10) default NULL,
  `file_scr_loc` varchar(64) default NULL,
  `file_scr_name` varchar(32) default NULL,
  `memo` text,
  `agent_note` text,
  `assignment_data` varchar(60) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `file_voc_name` (`file_voc_name`),
  KEY `idx_agentid` (`agent_id`),
  KEY `idx_data` (`assignment_data`),
  KEY `idx_agent_ext` (`agent_ext`),
  KEY `idx_anumber` (`anumber`),
  KEY `idx_starttime` (`start_time`),
  KEY `assignment_data` (`assignment_data`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_recording: ~0 rows (approximately)
DELETE FROM `cc_recording`;
/*!40000 ALTER TABLE `cc_recording` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_recording` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_reference_value
DROP TABLE IF EXISTS `cc_reference_value`;
CREATE TABLE IF NOT EXISTS `cc_reference_value` (
  `ref_group` varchar(64) NOT NULL,
  `ref_value` int(10) unsigned NOT NULL,
  `ref_desc` varchar(128) default NULL,
  `ref_note` varchar(128) default NULL,
  PRIMARY KEY  (`ref_group`,`ref_value`),
  KEY `idx_ref_group` (`ref_group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_reference_value: 0 rows
DELETE FROM `cc_reference_value`;
/*!40000 ALTER TABLE `cc_reference_value` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_reference_value` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_settings
DROP TABLE IF EXISTS `cc_settings`;
CREATE TABLE IF NOT EXISTS `cc_settings` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `instance_id` int(5) unsigned NOT NULL default '0',
  `set_modul` varchar(255) NOT NULL default '',
  `set_name` varchar(255) NOT NULL default '',
  `set_type` int(5) unsigned NOT NULL default '0',
  `set_value` varchar(255) NOT NULL default '',
  `set_comment` varchar(255) default NULL,
  PRIMARY KEY  (`id`),
  KEY `instance_modul` (`instance_id`,`set_modul`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_settings: 12 rows
DELETE FROM `cc_settings`;
/*!40000 ALTER TABLE `cc_settings` DISABLE KEYS */;
INSERT INTO `cc_settings` (`id`, `instance_id`, `set_modul`, `set_name`, `set_type`, `set_value`, `set_comment`) VALUES
	(1, 1, 'cti', 'pbx.id', 0, '2', NULL),
	(2, 1, 'agent', 'server.host', 0, '192.168.7.7', NULL),
	(3, 1, 'agent', 'server.port', 0, '16000', NULL),
	(4, 1, 'recording', 'file.basepath', 0, '/opt/enigma/log/voice', NULL),
	(5, 1, 'manager', 'server.host', 0, '192.168.1.46', NULL),
	(6, 1, 'manager', 'server.port', 0, '9800', NULL),
	(25, 0, 'cti', 'pbx.id', 0, '1', NULL),
	(26, 0, 'agent', 'server.host', 0, '192.168.7.7', NULL),
	(27, 0, 'agent', 'server.port', 0, '16000', NULL),
	(28, 0, 'manager', 'server.host', 0, '192.168.7.8', NULL),
	(29, 0, 'manager', 'server.port', 0, '9800', NULL),
	(30, 0, 'recording', 'file.basepath', 0, '/opt/enigma/log/voice', NULL);
/*!40000 ALTER TABLE `cc_settings` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_skill
DROP TABLE IF EXISTS `cc_skill`;
CREATE TABLE IF NOT EXISTS `cc_skill` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `domain` int(5) unsigned NOT NULL default '0',
  `skill_code` varchar(32) NOT NULL default '',
  `skill_type` smallint(3) unsigned NOT NULL default '0',
  `description` varchar(64) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `skill_code` (`skill_code`,`domain`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_skill: 2 rows
DELETE FROM `cc_skill`;
/*!40000 ALTER TABLE `cc_skill` DISABLE KEYS */;
INSERT INTO `cc_skill` (`id`, `domain`, `skill_code`, `skill_type`, `description`) VALUES
	(1, 0, 'skl1', 0, 'Skil satu'),
	(2, 0, 'skl2', 0, 'Skil Dua');
/*!40000 ALTER TABLE `cc_skill` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_vdn_agent_group
DROP TABLE IF EXISTS `cc_vdn_agent_group`;
CREATE TABLE IF NOT EXISTS `cc_vdn_agent_group` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `vdn` varchar(16) NOT NULL default '',
  `agent_group` smallint(5) unsigned NOT NULL default '0',
  `description` varchar(16) NOT NULL default '',
  `routing_alg` tinyint(3) unsigned NOT NULL default '1',
  `is_direct` tinyint(3) unsigned NOT NULL default '0',
  `trash_target` varchar(16) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vdn` (`vdn`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_vdn_agent_group: 0 rows
DELETE FROM `cc_vdn_agent_group`;
/*!40000 ALTER TABLE `cc_vdn_agent_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_vdn_agent_group` ENABLE KEYS */;


-- Dumping structure for table ajmidb.cc_vdn_skill
DROP TABLE IF EXISTS `cc_vdn_skill`;
CREATE TABLE IF NOT EXISTS `cc_vdn_skill` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `vdn` varchar(16) NOT NULL default '',
  `skill` smallint(5) unsigned NOT NULL default '0',
  `score` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `vdn` (`vdn`,`skill`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.cc_vdn_skill: 0 rows
DELETE FROM `cc_vdn_skill`;
/*!40000 ALTER TABLE `cc_vdn_skill` DISABLE KEYS */;
/*!40000 ALTER TABLE `cc_vdn_skill` ENABLE KEYS */;


-- Dumping structure for table ajmidb.coll_category_collmon
DROP TABLE IF EXISTS `coll_category_collmon`;
CREATE TABLE IF NOT EXISTS `coll_category_collmon` (
  `CollCategoryId` int(10) unsigned NOT NULL auto_increment,
  `CollCategoryName` varchar(150) default NULL,
  `CollCategoryDesc` varchar(200) default NULL,
  `CollCategoryFlags` tinyint(1) unsigned default '1' COMMENT '1=yes , 0=no',
  PRIMARY KEY  (`CollCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.coll_category_collmon: ~8 rows (approximately)
DELETE FROM `coll_category_collmon`;
/*!40000 ALTER TABLE `coll_category_collmon` DISABLE KEYS */;
INSERT INTO `coll_category_collmon` (`CollCategoryId`, `CollCategoryName`, `CollCategoryDesc`, `CollCategoryFlags`) VALUES
	(1, 'Opening (Courtesy)', 'Opening (Courtesy)', 0),
	(2, 'Call Akurasi', 'Call Akurasi', 0),
	(3, 'Freelook', 'Freelook', 0),
	(4, 'Fraud', 'Fraud', 0),
	(5, 'Question', 'Question', 1),
	(6, 'Question2', 'Question', 1),
	(7, 'Question3', 'Question', 1),
	(8, 'Question4', 'Question', 1);
/*!40000 ALTER TABLE `coll_category_collmon` ENABLE KEYS */;


-- Dumping structure for table ajmidb.coll_report_collmon
DROP TABLE IF EXISTS `coll_report_collmon`;
CREATE TABLE IF NOT EXISTS `coll_report_collmon` (
  `ReportId` int(11) unsigned NOT NULL auto_increment,
  `CustomerId` int(11) unsigned NOT NULL default '0',
  `CollmonUser` int(10) unsigned default NULL,
  `CollmonResultId` int(10) unsigned default NULL,
  `CollmonPoint` int(10) unsigned default NULL,
  `CollmonNotes` text,
  `CollmonCreateTs` datetime default NULL,
  PRIMARY KEY  (`ReportId`),
  KEY `CustomerId` (`CustomerId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.coll_report_collmon: ~0 rows (approximately)
DELETE FROM `coll_report_collmon`;
/*!40000 ALTER TABLE `coll_report_collmon` DISABLE KEYS */;
/*!40000 ALTER TABLE `coll_report_collmon` ENABLE KEYS */;


-- Dumping structure for table ajmidb.coll_subcategory_collmon
DROP TABLE IF EXISTS `coll_subcategory_collmon`;
CREATE TABLE IF NOT EXISTS `coll_subcategory_collmon` (
  `SubCategoryId` int(10) unsigned NOT NULL auto_increment,
  `CategoryId` int(10) unsigned NOT NULL,
  `SubCategoryParents` int(11) default NULL,
  `SubCategory` tinytext,
  `SubCategoryDesc` text,
  `StartNumber` int(5) default NULL,
  `EndNumber` int(5) default NULL,
  `StepNumber` int(5) default NULL,
  `SubCategoryFlags` tinyint(3) unsigned default '1' COMMENT '1=yes, 0=no',
  PRIMARY KEY  (`SubCategoryId`),
  KEY `FK_CategoryId` (`CategoryId`),
  CONSTRAINT `FK_CategoryId` FOREIGN KEY (`CategoryId`) REFERENCES `coll_category_collmon` (`CollCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.coll_subcategory_collmon: ~8 rows (approximately)
DELETE FROM `coll_subcategory_collmon`;
/*!40000 ALTER TABLE `coll_subcategory_collmon` DISABLE KEYS */;
INSERT INTO `coll_subcategory_collmon` (`SubCategoryId`, `CategoryId`, `SubCategoryParents`, `SubCategory`, `SubCategoryDesc`, `StartNumber`, `EndNumber`, `StepNumber`, `SubCategoryFlags`) VALUES
	(1, 1, 1, 'Salam Pembuka', 'Salam Pembuka', 0, 100, 1, 1),
	(2, 2, 2, 'Penjelasan Produk', 'Penjelasan Produk', 0, 100, 1, 1),
	(3, 3, 3, 'Persetujuan Awal', 'Persetujuan Awal', 0, 100, 1, 1),
	(4, 4, 4, 'Akurasi dan Kelengkapan Pengisian Data', 'Akurasi dan Kelengkapan Pengisian Data', 0, 100, 1, 1),
	(5, 5, 5, 'Konfirmasi Persetujuan Nasabah', 'Konfirmasi Persetujuan Nasabah', 0, 100, 1, 1),
	(6, 6, 6, 'Penutup', 'Penutup', 0, 100, 1, 1),
	(7, 7, 7, 'Etika dan Teknik Bertelepon', 'Etika dan Teknik Bertelepon', 0, 100, 1, 1),
	(8, 8, 8, 'Handling Objection dan Analisis Skill', 'Handling Objection dan Analisis Skill', 0, 100, 1, 1);
/*!40000 ALTER TABLE `coll_subcategory_collmon` ENABLE KEYS */;


-- Dumping structure for function ajmidb.F_GetIdentificationNum
DROP FUNCTION IF EXISTS `F_GetIdentificationNum`;
DELIMITER //
CREATE DEFINER=`enigma`@`%` FUNCTION `F_GetIdentificationNum`(`intCallReason` int, `strIdNumHolder` varchar(20), `strIdNumSpouse` varchar(20)) RETURNS varchar(20) CHARSET latin1
BEGIN
 DECLARE strIdNum varchar(20);
 IF intCallReason = 402 THEN 
  SET strIdNum = strIdNumSpouse;
 ELSE 
  SET strIdNum = strIdNumHolder;
 END IF;
 RETURN strIdNum;
END//
DELIMITER ;


-- Dumping structure for function ajmidb.F_getLastReasonStatus
DROP FUNCTION IF EXISTS `F_getLastReasonStatus`;
DELIMITER //
CREATE DEFINER=`enigma`@`%` FUNCTION `F_getLastReasonStatus`(`FCustomerId` INT, `FTelesalesId` INT) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE REASON_ID INT;
	SELECT 
		a.CallReasonId INTO REASON_ID
	FROM t_gn_callhistory a
	WHERE a.CustomerId= FCustomerId 
			AND a.CreatedById = FTelesalesId
	ORDER BY a.CallHistoryCreatedTs DESC LIMIT 1;
	
	RETURN REASON_ID;
END//
DELIMITER ;


-- Dumping structure for function ajmidb.F_GetPlanId
DROP FUNCTION IF EXISTS `F_GetPlanId`;
DELIMITER //
CREATE DEFINER=`enigma`@`%` FUNCTION `F_GetPlanId`(`ProductId` INT, `ProductPlan` INT, `PayModeId` INT, `Age` INT) RETURNS int(11)
BEGIN
	DECLARE RowID INT;
		SELECT 
			a.ProductPlanId INTO RowID
		FROM t_gn_productplan a
			WHERE a.ProductId=ProductId
				AND a.ProductPlan = ProductPlan
				AND a.PayModeId = PayModeId
				AND Age BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd;
		RETURN RowID;
END//
DELIMITER ;


-- Dumping structure for function ajmidb.F_GetPremiumAge
DROP FUNCTION IF EXISTS `F_GetPremiumAge`;
DELIMITER //
CREATE DEFINER=`enigma`@`%` FUNCTION `F_GetPremiumAge`(`ProductPlan` INT, `ProductId` INT, `PayModeId` INT, `FindAge` INT) RETURNS decimal(10,0)
    COMMENT 'F_GetPremiumAge'
BEGIN
	DECLARE PremiByAge DECIMAL;
	SELECT 
	  a.ProductPlanPremium INTO PremiByAge
	 FROM  t_gn_productplan a 
	WHERE a.ProductPlan= ProductPlan	
		and a.ProductId= ProductId
		and a.PayModeId= PayModeId
		and FindAge BETWEEN ProductPlanAgeStart and ProductPlanAgeEnd;
	return PremiByAge;	
END//
DELIMITER ;


-- Dumping structure for table ajmidb.tms_agent
DROP TABLE IF EXISTS `tms_agent`;
CREATE TABLE IF NOT EXISTS `tms_agent` (
  `UserId` int(10) unsigned NOT NULL auto_increment,
  `id` varchar(16) NOT NULL,
  `code_user` varchar(6) default NULL,
  `full_name` varchar(40) NOT NULL default '',
  `init_name` varchar(16) default NULL,
  `profile_id` int(32) unsigned NOT NULL default '0',
  `group_id` int(32) unsigned NOT NULL default '0',
  `handling_type` int(1) unsigned NOT NULL default '0',
  `agency_id` varchar(2) NOT NULL default '0',
  `spv_id` int(2) unsigned default NULL,
  `mgr_id` int(4) unsigned default NULL,
  `admin_id` int(10) default NULL,
  `password` varchar(255) default NULL,
  `ip_address` varchar(16) default NULL,
  `user_state` int(1) NOT NULL default '0',
  `logged_state` int(1) NOT NULL default '0',
  `login_count` int(10) unsigned default NULL,
  `updated_by` varchar(30) default NULL,
  `last_update` datetime default NULL,
  `update_password` datetime default NULL,
  `telphone` tinyint(3) unsigned default '1' COMMENT '1=yes, 0=no',
  PRIMARY KEY  (`UserId`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `init_name` (`init_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_agent: ~9 rows (approximately)
DELETE FROM `tms_agent`;
/*!40000 ALTER TABLE `tms_agent` DISABLE KEYS */;
INSERT INTO `tms_agent` (`UserId`, `id`, `code_user`, `full_name`, `init_name`, `profile_id`, `group_id`, `handling_type`, `agency_id`, `spv_id`, `mgr_id`, `admin_id`, `password`, `ip_address`, `user_state`, `logged_state`, `login_count`, `updated_by`, `last_update`, `update_password`, `telphone`) VALUES
	(1, 'root', 'root', 'System Root', 'root', 8, 0, 8, 'AJ', 0, 0, 0, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 1, 42, NULL, '2014-04-28 20:06:11', '2013-09-24 15:19:43', 1),
	(2, 'Admin', 'admin', 'Administrator', 'admin', 1, 0, 1, 'AJ', 0, 0, 2, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, NULL, '2014-04-22 17:16:40', NULL, 0),
	(5, 'spv01', 'spv01', 'Supervisor 01', 'spv01', 3, 0, 3, 'AJ', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, NULL, '2014-04-17 14:12:33', NULL, 1),
	(6, 'TM01', 'Agent ', 'Agent 01', 'Agent 01', 4, 0, 4, 'AJ', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, 0, NULL, NULL, NULL, NULL, 1),
	(7, 'User01', 'User01', 'Agent Outbound 01', 'User01', 4, 0, 4, 'EU', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, '1', '2014-04-27 04:00:10', '2014-04-15 21:25:41', 1),
	(8, 'User02', 'User02', 'Agent Inbound 01', 'User02', 6, 0, 6, 'EU', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, '1', '2014-04-27 02:56:16', '2014-04-17 02:38:36', 1),
	(9, 'AM01', 'AM01', 'Account Manager', 'AM01', 2, 0, 2, 'EU', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', NULL, 1, 0, NULL, '1', NULL, '2014-04-17 02:40:10', 0),
	(10, 'User03', 'User03', 'User03', 'User03', 6, 0, 6, 'EU', 5, 9, 2, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, '1', '2014-04-27 02:58:22', '2014-04-22 14:08:00', 1),
	(11, 'QA01', 'QA01', 'Quality Insurance', 'QA01', 5, 0, 5, 'EU', 5, 0, 0, '81dc9bdb52d04dc20036dbd8313ed055', '127.0.0.1', 1, 0, NULL, '1', '2014-04-27 04:44:58', '2014-04-23 16:39:12', 0);
/*!40000 ALTER TABLE `tms_agent` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_agent_activity
DROP TABLE IF EXISTS `tms_agent_activity`;
CREATE TABLE IF NOT EXISTS `tms_agent_activity` (
  `ActivityId` int(10) NOT NULL auto_increment,
  `UserId` int(10) default NULL,
  `ActivityDateTs` datetime default NULL,
  `ActivityAction` varchar(100) default NULL,
  `ActivitySessionId` varchar(100) default NULL,
  `ActivityLocation` varchar(100) default NULL,
  PRIMARY KEY  (`ActivityId`)
) ENGINE=MyISAM AUTO_INCREMENT=428 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_agent_activity: 427 rows
DELETE FROM `tms_agent_activity`;
/*!40000 ALTER TABLE `tms_agent_activity` DISABLE KEYS */;
INSERT INTO `tms_agent_activity` (`ActivityId`, `UserId`, `ActivityDateTs`, `ActivityAction`, `ActivitySessionId`, `ActivityLocation`) VALUES
	(1, 1, '2014-03-05 16:32:22', 'LOGIN', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(2, 1, '2014-03-05 16:35:27', 'LOGOUT', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(3, 1, '2014-03-05 16:35:33', 'LOGIN', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(4, 1, '2014-03-05 16:37:25', 'LOGOUT', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(5, 1, '2014-03-05 16:37:30', 'LOGIN', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(6, 1, '2014-03-05 16:49:31', 'LOGIN', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(7, 1, '2014-03-05 16:50:38', 'LOGOUT', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(8, 1, '2014-03-05 16:50:42', 'LOGIN', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(9, 1, '2014-03-05 19:09:01', 'LOGOUT', 'b21632675d53600749328d13994d7293', '127.0.0.1'),
	(10, 1, '2014-03-05 22:51:19', 'LOGIN', '87137a91073885332e3ed6f8ec3e1d09', '127.0.0.1'),
	(11, 1, '2014-03-05 22:51:36', 'LOGIN', '69999876a9345b8d9d537c822a8d00bf', '127.0.0.1'),
	(12, 1, '2014-03-05 22:53:08', 'LOGIN', 'f2cd693dcbb3af4a9088e298af524870', '127.0.0.1'),
	(13, 1, '2014-03-05 22:53:46', 'LOGIN', '623f15769ff91479b6f97e657fa17a9a', '127.0.0.1'),
	(14, 1, '2014-03-05 22:54:03', 'LOGIN', '6ce5a6c5401b25cdd02805f4ec0cae22', '127.0.0.1'),
	(15, 1, '2014-03-05 22:55:05', 'LOGIN', 'fd250187ac654b46f57cff448a5b3def', '127.0.0.1'),
	(16, 1, '2014-03-05 22:56:13', 'LOGIN', 'e32b432496bb62a4f8bc4021f6138ee7', '127.0.0.1'),
	(17, 1, '2014-03-05 22:57:26', 'LOGIN', '29fede0036256d308875e5a7a966b622', '127.0.0.1'),
	(18, 1, '2014-03-05 22:58:05', 'LOGIN', 'a4b00b6b64e4014559c16fe8a658a4f2', '127.0.0.1'),
	(19, 1, '2014-03-05 22:59:53', 'LOGIN', 'f033df32b06e49b8915a82070650ada0', '127.0.0.1'),
	(20, 1, '2014-03-05 23:02:12', 'LOGIN', 'e283e660ba22d31bfa3d2dd6b2caa896', '127.0.0.1'),
	(21, 1, '2014-03-06 20:37:35', 'LOGIN', '0b0f8a43c94a783cb4ba045b136880f4', '127.0.0.1'),
	(22, 1, '2014-03-06 20:41:44', 'LOGOUT', '0b0f8a43c94a783cb4ba045b136880f4', '127.0.0.1'),
	(23, 1, '2014-03-07 23:45:33', 'LOGIN', '58bbb3083a0244f4e7c21f08ef3ea2c3', '127.0.0.1'),
	(24, 1, '2014-03-08 19:33:40', 'LOGOUT', '58bbb3083a0244f4e7c21f08ef3ea2c3', '127.0.0.1'),
	(25, 1, '2014-03-09 09:22:52', 'LOGIN', '58bbb3083a0244f4e7c21f08ef3ea2c3', '127.0.0.1'),
	(26, 1, '2014-03-09 09:28:47', 'LOGOUT', '58bbb3083a0244f4e7c21f08ef3ea2c3', '127.0.0.1'),
	(27, 1, '2014-03-14 20:34:58', 'LOGIN', '03f46784ea231dfa656ba63ef1f7999a', '127.0.0.1'),
	(28, 1, '2014-03-15 01:04:59', 'LOGOUT', '03f46784ea231dfa656ba63ef1f7999a', '127.0.0.1'),
	(29, 1, '2014-03-15 01:05:04', 'LOGIN', '03f46784ea231dfa656ba63ef1f7999a', '127.0.0.1'),
	(30, 1, '2014-03-15 01:19:27', 'LOGOUT', '03f46784ea231dfa656ba63ef1f7999a', '127.0.0.1'),
	(31, 1, '2014-03-15 01:27:58', 'LOGIN', '3952dcc4fc48d05440b8b5f50900ea3f', '127.0.0.1'),
	(32, 1, '2014-03-15 15:10:36', 'LOGIN', 'a94f599aa94caf8a9fbf3ab07fcb8dcd', '127.0.0.1'),
	(33, 1, '2014-03-15 15:40:23', 'LOGIN', 'd739402eef3c7d72c19ba0b16a1013de', '127.0.0.1'),
	(34, 1, '2014-03-15 15:50:46', 'LOGOUT', 'd739402eef3c7d72c19ba0b16a1013de', '127.0.0.1'),
	(35, 1, '2014-03-15 15:50:51', 'LOGIN', 'd739402eef3c7d72c19ba0b16a1013de', '127.0.0.1'),
	(36, 1, '2014-03-16 05:03:35', 'LOGIN', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(37, 1, '2014-03-17 12:24:43', 'LOGOUT', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(38, 1, '2014-03-17 12:25:31', 'LOGIN', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(39, 1, '2014-03-17 18:23:45', 'LOGOUT', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(40, 1, '2014-03-17 18:23:50', 'LOGIN', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(41, 1, '2014-03-19 02:04:11', 'LOGOUT', '690fc38a905d649451f9485f58501637', '127.0.0.1'),
	(42, 1, '2014-03-19 02:04:55', 'LOGIN', 'b037fb935abf4c31b99449e08dfac983', '127.0.0.1'),
	(43, 1, '2014-03-21 14:32:40', 'LOGOUT', 'b037fb935abf4c31b99449e08dfac983', '127.0.0.1'),
	(44, 1, '2014-03-21 20:59:31', 'LOGIN', '1743533ff2ec579caba5ab6e637ca1e4', '127.0.0.1'),
	(45, 1, '2014-03-21 21:03:53', 'LOGOUT', '1743533ff2ec579caba5ab6e637ca1e4', '127.0.0.1'),
	(46, 1, '2014-03-24 23:57:17', 'LOGIN', '6c68d44979eee514137c96bf32cd8eb3', '127.0.0.1'),
	(47, 1, '2014-03-25 00:00:35', 'LOGOUT', '6c68d44979eee514137c96bf32cd8eb3', '127.0.0.1'),
	(48, 1, '2014-03-26 14:19:50', 'LOGIN', '1e2cd9e0b31cd32459fd186b94761f53', '127.0.0.1'),
	(49, 1, '2014-03-27 11:41:54', 'LOGIN', 'b88874a5844a3b5eeb9292124043a93d', '127.0.0.1'),
	(50, 1, '2014-03-27 16:33:08', 'LOGOUT', '1e2cd9e0b31cd32459fd186b94761f53', '127.0.0.1'),
	(51, 1, '2014-03-27 16:33:14', 'LOGIN', '1e2cd9e0b31cd32459fd186b94761f53', '127.0.0.1'),
	(52, 1, '2014-03-27 18:34:50', 'LOGOUT', '1e2cd9e0b31cd32459fd186b94761f53', '127.0.0.1'),
	(53, 1, '2014-03-27 18:36:54', 'LOGIN', '1e2cd9e0b31cd32459fd186b94761f53', '127.0.0.1'),
	(54, 1, '2014-03-28 11:17:51', 'LOGIN', 'ed14f177abe9587c0d0cfa8ee28e46fc', '127.0.0.1'),
	(55, 1, '2014-03-28 19:42:39', 'LOGOUT', 'ed14f177abe9587c0d0cfa8ee28e46fc', '127.0.0.1'),
	(56, 1, '2014-03-28 19:42:44', 'LOGIN', 'ed14f177abe9587c0d0cfa8ee28e46fc', '127.0.0.1'),
	(57, 1, '2014-03-28 21:35:54', 'LOGOUT', 'ed14f177abe9587c0d0cfa8ee28e46fc', '127.0.0.1'),
	(58, 1, '2014-03-28 21:37:00', 'LOGIN', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(59, 1, '2014-03-28 22:24:13', 'LOGOUT', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(60, 1, '2014-03-28 22:26:09', 'LOGIN', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(61, 1, '2014-03-28 22:26:27', 'LOGOUT', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(62, 1, '2014-03-28 22:26:52', 'LOGIN', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(63, 1, '2014-03-28 22:28:46', 'LOGOUT', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(64, 1, '2014-03-28 22:29:14', 'LOGIN', 'd423cc2c05b63000b646b2e8e225b075', '127.0.0.1'),
	(65, 1, '2014-03-29 02:39:06', 'LOGIN', 'e70c2d3f008fe7ab6a627cbc5f4efbe5', '127.0.0.1'),
	(66, 1, '2014-03-29 03:38:10', 'LOGOUT', 'e70c2d3f008fe7ab6a627cbc5f4efbe5', '127.0.0.1'),
	(67, 1, '2014-03-29 03:39:06', 'LOGIN', 'e70c2d3f008fe7ab6a627cbc5f4efbe5', '127.0.0.1'),
	(68, 1, '2014-03-31 01:19:42', 'LOGOUT', 'e70c2d3f008fe7ab6a627cbc5f4efbe5', '127.0.0.1'),
	(69, 1, '2014-03-31 01:19:50', 'LOGIN', 'e70c2d3f008fe7ab6a627cbc5f4efbe5', '127.0.0.1'),
	(70, 1, '2014-03-31 03:06:59', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(71, 1, '2014-03-31 07:06:44', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(72, 1, '2014-03-31 07:06:51', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(73, 1, '2014-03-31 07:27:13', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(74, 1, '2014-03-31 07:36:24', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(75, 1, '2014-03-31 07:36:41', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(76, 1, '2014-03-31 07:36:57', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(77, 1, '2014-03-31 07:45:05', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(78, 1, '2014-03-31 07:45:11', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(79, 1, '2014-03-31 08:02:39', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(80, 1, '2014-03-31 23:46:06', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(81, 1, '2014-04-01 13:55:39', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(82, 1, '2014-04-01 13:55:45', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(83, 1, '2014-04-01 14:25:29', 'LOGOUT', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(84, 1, '2014-04-01 14:25:54', 'LOGIN', '7eba0475d901b95b1aa09e18db0aa637', '127.0.0.1'),
	(85, 1, '2014-04-02 06:17:04', 'LOGIN', '55f2a695bcb00a04299ac17575e43db4', '127.0.0.1'),
	(86, 1, '2014-04-02 14:20:33', 'LOGOUT', '55f2a695bcb00a04299ac17575e43db4', '127.0.0.1'),
	(87, 1, '2014-04-02 14:20:40', 'LOGIN', '55f2a695bcb00a04299ac17575e43db4', '127.0.0.1'),
	(88, 1, '2014-04-02 16:06:12', 'LOGOUT', '55f2a695bcb00a04299ac17575e43db4', '127.0.0.1'),
	(89, 1, '2014-04-02 16:12:06', 'LOGIN', '516ab382f4a8ecf3061144ae2eba9d88', '127.0.0.1'),
	(90, 1, '2014-04-02 16:38:59', 'LOGIN', '905becfcb72df067a75869c83e0168a6', '127.0.0.1'),
	(91, 1, '2014-04-02 18:50:04', 'LOGIN', '52afdb01726a56e87ec380a5d1d73698', '127.0.0.1'),
	(92, 1, '2014-04-02 18:53:33', 'LOGIN', 'c88f6be63e3a4f1d9f74abfe05d5dfac', '127.0.0.1'),
	(93, 1, '2014-04-02 19:21:50', 'LOGOUT', '905becfcb72df067a75869c83e0168a6', '127.0.0.1'),
	(94, 1, '2014-04-02 19:22:21', 'LOGOUT', 'c88f6be63e3a4f1d9f74abfe05d5dfac', '127.0.0.1'),
	(95, 1, '2014-04-02 19:22:38', 'LOGOUT', '516ab382f4a8ecf3061144ae2eba9d88', '127.0.0.1'),
	(96, 1, '2014-04-02 20:36:30', 'LOGIN', 'd9e58a251c208014f03ac3d80e4f5e94', '127.0.0.1'),
	(97, 1, '2014-04-03 00:13:28', 'LOGOUT', 'd9e58a251c208014f03ac3d80e4f5e94', '127.0.0.1'),
	(98, 1, '2014-04-03 11:51:00', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(99, 1, '2014-04-03 14:16:46', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(100, 1, '2014-04-03 14:32:15', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(101, 1, '2014-04-03 17:53:11', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(102, 1, '2014-04-03 18:54:06', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(103, 1, '2014-04-03 23:56:39', 'LOGIN', '8f7bf5a19707b7b8ee43bd6c6755b7ad', '127.0.0.1'),
	(104, 1, '2014-04-04 04:03:13', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(105, 1, '2014-04-04 04:03:28', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(106, 1, '2014-04-04 04:04:43', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(107, 1, '2014-04-04 17:09:10', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(108, 1, '2014-04-04 17:25:03', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(109, 1, '2014-04-05 01:55:46', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(110, 33, '2014-04-05 01:55:51', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(111, 33, '2014-04-05 02:22:32', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(112, 33, '2014-04-05 02:22:51', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(113, 33, '2014-04-05 02:32:10', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(114, 1, '2014-04-05 02:32:15', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(115, 1, '2014-04-05 02:33:27', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(116, 1, '2014-04-05 02:39:10', 'LOGIN', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(117, 1, '2014-04-05 07:32:36', 'LOGOUT', '606cb10a8be13f1e4bc964b58a7c426e', '127.0.0.1'),
	(118, 1, '2014-04-06 01:13:19', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(119, 1, '2014-04-06 02:13:55', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(120, 33, '2014-04-06 02:14:00', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(121, 33, '2014-04-06 02:17:07', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(122, 1, '2014-04-06 02:17:23', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(123, 1, '2014-04-06 06:34:54', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(124, 1, '2014-04-06 06:35:12', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(125, 1, '2014-04-06 23:05:38', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(126, 33, '2014-04-06 23:05:49', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(127, 33, '2014-04-06 23:13:18', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(128, 1, '2014-04-06 23:13:24', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(129, 1, '2014-04-06 23:13:52', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(130, 33, '2014-04-06 23:14:14', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(131, 33, '2014-04-06 23:14:41', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(132, 1, '2014-04-06 23:44:47', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(133, 1, '2014-04-07 19:04:09', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(134, 33, '2014-04-07 19:04:18', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(135, 33, '2014-04-07 19:04:28', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(136, 1, '2014-04-07 19:04:34', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(137, 1, '2014-04-07 19:06:26', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(138, 33, '2014-04-07 19:06:34', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(139, 33, '2014-04-07 21:49:46', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(140, 1, '2014-04-07 21:49:54', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(141, 1, '2014-04-07 21:50:16', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(142, 33, '2014-04-07 21:50:33', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(143, 33, '2014-04-07 21:51:08', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(144, 1, '2014-04-07 21:51:14', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(145, 1, '2014-04-07 21:51:37', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(146, 33, '2014-04-07 21:51:47', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(147, 33, '2014-04-07 22:02:36', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(148, 1, '2014-04-07 22:02:41', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(149, 1, '2014-04-07 22:03:01', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(150, 33, '2014-04-07 22:03:09', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(151, 33, '2014-04-07 22:06:38', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(152, 1, '2014-04-07 22:06:43', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(153, 1, '2014-04-07 22:07:07', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(154, 33, '2014-04-07 22:07:15', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(155, 33, '2014-04-07 22:16:44', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(156, 1, '2014-04-07 22:16:50', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(157, 1, '2014-04-07 22:17:11', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(158, 33, '2014-04-07 22:17:19', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(159, 33, '2014-04-07 22:20:22', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(160, 1, '2014-04-07 22:20:32', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(161, 1, '2014-04-07 22:21:31', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(162, 33, '2014-04-07 22:21:39', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(163, 33, '2014-04-07 22:21:53', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(164, 1, '2014-04-07 22:22:01', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(165, 1, '2014-04-07 22:22:15', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(166, 33, '2014-04-07 22:22:22', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(167, 33, '2014-04-07 22:30:39', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(168, 1, '2014-04-07 22:30:45', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(169, 1, '2014-04-07 22:31:01', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(170, 33, '2014-04-07 22:31:10', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(171, 33, '2014-04-07 22:38:23', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(172, 1, '2014-04-07 22:38:29', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(173, 1, '2014-04-07 22:39:11', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(174, 33, '2014-04-07 22:39:19', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(175, 33, '2014-04-07 23:04:38', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(176, 1, '2014-04-07 23:04:43', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(177, 1, '2014-04-07 23:05:32', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(178, 33, '2014-04-07 23:05:37', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(179, 33, '2014-04-07 23:06:17', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(180, 1, '2014-04-07 23:06:23', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(181, 1, '2014-04-07 23:06:41', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(182, 33, '2014-04-07 23:06:47', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(183, 33, '2014-04-07 23:07:27', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(184, 1, '2014-04-07 23:07:33', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(185, 1, '2014-04-07 23:07:55', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(186, 33, '2014-04-07 23:08:01', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(187, 33, '2014-04-07 23:09:11', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(188, 1, '2014-04-07 23:09:17', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(189, 1, '2014-04-07 23:09:40', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(190, 1, '2014-04-07 23:09:45', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(191, 1, '2014-04-07 23:09:58', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(192, 33, '2014-04-07 23:10:05', 'LOGIN', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(193, 33, '2014-04-08 00:27:11', 'LOGOUT', '91051a92c493a7b85f1da5053a77aed4', '127.0.0.1'),
	(194, 24, '2014-04-10 02:32:40', 'LOGOUT', '835595cbd5d2fdbc0377ce3a5cf5c081', '127.0.0.1'),
	(195, 1, '2014-04-10 02:45:06', 'LOGIN', '835595cbd5d2fdbc0377ce3a5cf5c081', '127.0.0.1'),
	(196, 1, '2014-04-10 02:54:04', 'LOGOUT', '835595cbd5d2fdbc0377ce3a5cf5c081', '127.0.0.1'),
	(197, 1, '2014-04-10 02:54:12', 'LOGIN', '835595cbd5d2fdbc0377ce3a5cf5c081', '127.0.0.1'),
	(198, 1, '2014-04-10 03:06:00', 'LOGOUT', '835595cbd5d2fdbc0377ce3a5cf5c081', '127.0.0.1'),
	(199, 1, '2014-04-11 02:20:12', 'LOGIN', 'f93688777db4cc90c0ccee70aed9d3a5', '127.0.0.1'),
	(200, 1, '2014-04-11 06:01:27', 'LOGOUT', 'f93688777db4cc90c0ccee70aed9d3a5', '127.0.0.1'),
	(201, 1, '2014-04-11 10:24:48', 'LOGIN', '8eca6d8b84af3f95bff0876d196eeeb3', '127.0.0.1'),
	(202, 1, '2014-04-12 04:24:54', 'LOGOUT', '8eca6d8b84af3f95bff0876d196eeeb3', '127.0.0.1'),
	(203, 1, '2014-04-13 06:50:54', 'LOGIN', 'bad11599d8b80f2c30b0f2eb368535e1', '127.0.0.1'),
	(204, 1, '2014-04-13 11:31:11', 'LOGOUT', 'bad11599d8b80f2c30b0f2eb368535e1', '127.0.0.1'),
	(205, 1, '2014-04-14 12:22:51', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(206, 1, '2014-04-15 22:35:46', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(207, 1, '2014-04-15 22:35:59', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(208, 1, '2014-04-15 22:38:40', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(209, 1, '2014-04-15 22:38:45', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(210, 1, '2014-04-15 22:39:29', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(211, 1, '2014-04-15 22:39:39', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(212, 1, '2014-04-15 22:40:15', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(213, 1, '2014-04-15 22:40:20', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(214, 1, '2014-04-15 22:40:44', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(215, 1, '2014-04-15 22:41:52', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(216, 1, '2014-04-15 22:41:57', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(217, 1, '2014-04-15 22:42:30', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(218, 1, '2014-04-15 22:42:35', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(219, 1, '2014-04-15 22:44:24', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(220, 1, '2014-04-15 22:44:29', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(221, 1, '2014-04-15 22:49:58', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(222, 1, '2014-04-15 22:50:02', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(223, 1, '2014-04-15 22:50:24', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(224, 1, '2014-04-15 22:50:29', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(225, 1, '2014-04-15 22:50:38', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(226, 1, '2014-04-15 22:50:44', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(227, 1, '2014-04-15 22:51:52', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(228, 1, '2014-04-15 22:51:56', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(229, 1, '2014-04-17 02:22:30', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(230, 1, '2014-04-17 02:22:35', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(231, 1, '2014-04-17 02:23:14', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(232, 1, '2014-04-17 02:23:19', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(233, 1, '2014-04-17 02:49:22', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(234, 8, '2014-04-17 02:49:29', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(235, 8, '2014-04-17 03:04:59', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(236, 1, '2014-04-17 03:05:04', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(237, 1, '2014-04-17 03:06:04', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(238, 8, '2014-04-17 03:06:12', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(239, 8, '2014-04-17 03:06:38', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(240, 1, '2014-04-17 03:06:43', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(241, 1, '2014-04-17 03:06:59', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(242, 8, '2014-04-17 03:07:06', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(243, 1, '2014-04-17 03:09:39', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(244, 8, '2014-04-17 03:30:12', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(245, 1, '2014-04-17 03:31:20', 'LOGOUT', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(246, 1, '2014-04-17 03:31:26', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(247, 8, '2014-04-17 03:31:59', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(248, 1, '2014-04-17 03:37:55', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(249, 8, '2014-04-17 03:38:02', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(250, 8, '2014-04-17 03:42:37', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(251, 1, '2014-04-17 03:42:42', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(252, 8, '2014-04-17 12:48:06', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(253, 1, '2014-04-17 12:55:37', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(254, 8, '2014-04-17 12:55:45', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(255, 8, '2014-04-17 13:45:13', 'LOGOUT', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(256, 1, '2014-04-17 13:45:18', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(257, 1, '2014-04-17 14:09:18', 'LOGOUT', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(258, 5, '2014-04-17 14:09:25', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(259, 5, '2014-04-17 14:12:33', 'LOGOUT', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(260, 1, '2014-04-17 15:04:59', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(261, 8, '2014-04-17 15:45:53', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(262, 1, '2014-04-17 15:46:00', 'LOGOUT', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(263, 1, '2014-04-17 15:46:07', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(264, 1, '2014-04-17 15:47:24', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(265, 8, '2014-04-17 15:47:32', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(266, 8, '2014-04-17 15:47:38', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(267, 1, '2014-04-17 15:47:44', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(268, 1, '2014-04-17 15:48:13', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(269, 8, '2014-04-17 15:48:23', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(270, 8, '2014-04-17 15:49:25', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(271, 1, '2014-04-17 15:49:33', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(272, 1, '2014-04-17 15:54:29', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(273, 7, '2014-04-17 15:54:37', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(274, 1, '2014-04-17 15:56:29', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(275, 1, '2014-04-17 16:31:22', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(276, 7, '2014-04-17 17:35:22', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(277, 1, '2014-04-17 17:35:27', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(278, 1, '2014-04-17 17:36:20', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(279, 8, '2014-04-17 17:36:27', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(280, 8, '2014-04-17 17:36:33', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(281, 7, '2014-04-17 17:36:39', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(282, 7, '2014-04-18 06:20:19', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(283, 1, '2014-04-18 06:20:24', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(284, 1, '2014-04-18 06:22:01', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(285, 8, '2014-04-18 06:22:10', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(286, 1, '2014-04-18 06:22:55', 'LOGIN', '185564a8a6c2b52eb103d717dc64273e', '127.0.0.1'),
	(287, 8, '2014-04-18 06:26:28', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(288, 7, '2014-04-18 06:26:43', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(289, 7, '2014-04-18 06:30:12', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(290, 1, '2014-04-18 06:30:18', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(291, 1, '2014-04-18 06:30:49', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(292, 1, '2014-04-18 06:30:55', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(293, 1, '2014-04-18 06:31:01', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(294, 7, '2014-04-18 06:31:12', 'LOGIN', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(295, 7, '2014-04-18 07:15:41', 'LOGOUT', 'ec5ed9bb5320f06c0b755c8781c505c2', '127.0.0.1'),
	(296, 1, '2014-04-19 02:42:20', 'LOGIN', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(297, 1, '2014-04-19 02:42:27', 'LOGOUT', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(298, 7, '2014-04-19 02:42:35', 'LOGIN', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(299, 7, '2014-04-19 02:42:42', 'LOGOUT', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(300, 1, '2014-04-19 02:42:47', 'LOGIN', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(301, 1, '2014-04-19 02:43:17', 'LOGOUT', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(302, 7, '2014-04-19 02:43:26', 'LOGIN', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(303, 7, '2014-04-21 04:52:24', 'LOGOUT', '1e706667150f2c5149d739a74f125d5a', '127.0.0.1'),
	(304, 7, '2014-04-21 12:00:56', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(305, 7, '2014-04-21 12:06:06', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(306, 8, '2014-04-21 12:06:11', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(307, 8, '2014-04-21 12:50:34', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(308, 1, '2014-04-21 12:50:39', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(309, 1, '2014-04-21 13:08:33', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(310, 8, '2014-04-21 13:08:40', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(311, 8, '2014-04-21 13:08:46', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(312, 7, '2014-04-21 13:08:53', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(313, 7, '2014-04-21 19:29:10', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(314, 1, '2014-04-21 21:32:42', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(315, 1, '2014-04-21 21:32:51', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(316, 7, '2014-04-21 21:32:59', 'LOGIN', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(317, 7, '2014-04-21 21:40:42', 'LOGOUT', '1bf8c1d80718574bc284620ba26e9b40', '127.0.0.1'),
	(318, 7, '2014-04-22 05:25:02', 'LOGIN', 'f3948401a57575dc3362774d1f9ceb68', '127.0.0.1'),
	(319, 7, '2014-04-22 08:03:19', 'LOGOUT', 'f3948401a57575dc3362774d1f9ceb68', '127.0.0.1'),
	(320, 1, '2014-04-22 14:06:31', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(321, 1, '2014-04-22 17:09:23', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(322, 7, '2014-04-22 17:09:36', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(323, 7, '2014-04-22 17:09:52', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(324, 2, '2014-04-22 17:09:57', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(325, 2, '2014-04-22 17:16:40', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(326, 7, '2014-04-22 17:16:46', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(327, 7, '2014-04-22 23:51:41', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(328, 1, '2014-04-22 23:52:07', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(329, 1, '2014-04-23 13:52:33', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(330, 1, '2014-04-23 13:52:53', 'LOGIN', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(331, 10, '2014-04-23 13:53:49', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(332, 10, '2014-04-23 13:53:54', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(333, 7, '2014-04-23 13:54:04', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(334, 7, '2014-04-23 15:34:26', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(335, 7, '2014-04-23 16:38:00', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(336, 7, '2014-04-23 16:38:15', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(337, 1, '2014-04-23 16:38:20', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(338, 1, '2014-04-23 16:40:03', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(339, 11, '2014-04-23 16:40:09', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(340, 1, '2014-04-23 16:41:22', 'LOGIN', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(341, 11, '2014-04-23 17:42:25', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(342, 1, '2014-04-23 17:42:32', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(343, 1, '2014-04-23 17:42:55', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(344, 11, '2014-04-23 17:43:02', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(345, 1, '2014-04-23 18:32:38', 'LOGIN', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(346, 11, '2014-04-23 19:21:07', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(347, 11, '2014-04-23 19:21:14', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(348, 1, '2014-04-23 20:18:25', 'LOGIN', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(349, 1, '2014-04-23 20:46:51', 'LOGOUT', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(350, 11, '2014-04-23 20:46:57', 'LOGIN', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(351, 11, '2014-04-23 20:51:00', 'LOGIN', '16ee3780867ed281748480a2b69fcb5d', '127.0.0.1'),
	(352, 11, '2014-04-23 21:17:50', 'LOGIN', 'd9a1e0e1a386d6f647d7594f72983aec', '127.0.0.1'),
	(353, 11, '2014-04-23 21:32:52', 'LOGOUT', '813920a1a914a222a92a0d4c7660ed9e', '127.0.0.1'),
	(354, 11, '2014-04-23 21:34:39', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(355, 1, '2014-04-23 21:34:48', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(356, 11, '2014-04-23 21:38:53', 'LOGOUT', 'd9a1e0e1a386d6f647d7594f72983aec', '127.0.0.1'),
	(357, 1, '2014-04-23 21:45:48', 'LOGOUT', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(358, 11, '2014-04-23 21:45:55', 'LOGIN', '38fc639ccdf45f9af0316d7fcf019343', '127.0.0.1'),
	(359, 7, '2014-04-24 21:19:55', 'LOGOUT', '21471bc6194846810b3dad093cd975b2', '127.0.0.1'),
	(360, 11, '2014-04-24 21:20:08', 'LOGIN', '21471bc6194846810b3dad093cd975b2', '127.0.0.1'),
	(361, 11, '2014-04-25 15:15:09', 'LOGOUT', 'dc1a5f26101fc8cbad8bed1d93efc3db', '127.0.0.1'),
	(362, 7, '2014-04-25 15:15:16', 'LOGIN', 'dc1a5f26101fc8cbad8bed1d93efc3db', '127.0.0.1'),
	(363, 7, '2014-04-25 15:20:34', 'LOGOUT', 'dc1a5f26101fc8cbad8bed1d93efc3db', '127.0.0.1'),
	(364, 11, '2014-04-25 15:20:43', 'LOGIN', 'dc1a5f26101fc8cbad8bed1d93efc3db', '127.0.0.1'),
	(365, 11, '2014-04-25 15:22:11', 'LOGOUT', 'dc1a5f26101fc8cbad8bed1d93efc3db', '127.0.0.1'),
	(366, 1, '2014-04-25 23:20:29', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(367, 1, '2014-04-25 23:20:40', 'LOGOUT', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(368, 11, '2014-04-25 23:20:50', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(369, 11, '2014-04-25 23:21:30', 'LOGOUT', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(370, 7, '2014-04-25 23:21:38', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(371, 7, '2014-04-25 23:22:17', 'LOGOUT', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(372, 11, '2014-04-25 23:22:23', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(373, 11, '2014-04-25 23:23:01', 'LOGOUT', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(374, 7, '2014-04-25 23:23:10', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(375, 7, '2014-04-26 00:05:11', 'LOGOUT', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(376, 11, '2014-04-26 00:05:22', 'LOGIN', 'e9ef48615e08b2b6f685c4c00b05d28d', '127.0.0.1'),
	(377, 11, '2014-04-26 17:45:22', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(378, 11, '2014-04-26 17:45:45', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(379, 7, '2014-04-26 17:45:51', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(380, 7, '2014-04-26 22:38:49', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(381, 11, '2014-04-26 22:39:00', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(382, 11, '2014-04-26 22:43:07', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(383, 7, '2014-04-26 22:43:20', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(384, 11, '2014-04-26 22:43:56', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(385, 11, '2014-04-26 23:52:36', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(386, 11, '2014-04-26 23:53:06', 'LOGOUT', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(387, 7, '2014-04-26 23:53:10', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(388, 11, '2014-04-26 23:53:15', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(389, 11, '2014-04-27 01:00:31', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(390, 7, '2014-04-27 01:00:44', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(391, 7, '2014-04-27 01:25:54', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(392, 11, '2014-04-27 01:26:05', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(393, 11, '2014-04-27 01:37:43', 'LOGOUT', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(394, 7, '2014-04-27 01:37:54', 'LOGIN', '90d1ada08cc01fbfdd30e229ede63d76', '127.0.0.1'),
	(395, 11, '2014-04-27 01:38:35', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(396, 1, '2014-04-27 01:44:19', 'LOGIN', '40f68a48376984421649af8eb36b4e56', '127.0.0.1'),
	(397, 11, '2014-04-27 01:50:24', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(398, 7, '2014-04-27 02:55:42', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(399, 7, '2014-04-27 02:55:57', 'LOGOUT', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(400, 8, '2014-04-27 02:56:05', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(401, 8, '2014-04-27 02:56:16', 'LOGOUT', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(402, 10, '2014-04-27 02:56:22', 'LOGIN', 'de4ed8a48cc588639675ecc501d2f022', '127.0.0.1'),
	(403, 11, '2014-04-27 02:56:40', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(404, 7, '2014-04-27 02:57:06', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(405, 7, '2014-04-27 02:58:02', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(406, 10, '2014-04-27 02:58:10', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(407, 10, '2014-04-27 02:58:22', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(408, 7, '2014-04-27 02:58:29', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(409, 7, '2014-04-27 03:00:32', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(410, 1, '2014-04-27 03:00:38', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(411, 1, '2014-04-27 03:01:13', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(412, 7, '2014-04-27 03:01:18', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(413, 7, '2014-04-27 03:19:42', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(414, 11, '2014-04-27 03:19:53', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(415, 11, '2014-04-27 03:33:02', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(416, 7, '2014-04-27 03:33:08', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(417, 7, '2014-04-27 04:00:10', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(418, 11, '2014-04-27 04:00:16', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(419, 11, '2014-04-27 04:44:58', 'LOGOUT', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(420, 1, '2014-04-27 04:45:10', 'LOGIN', 'c0528b50b37a810828df7b02f749c7db', '127.0.0.1'),
	(421, 1, '2014-04-27 06:12:45', 'LOGIN', '1db49f57fbf00ee36d925287dc625058', '127.0.0.1'),
	(422, 1, '2014-04-28 11:25:23', 'LOGOUT', '1db49f57fbf00ee36d925287dc625058', '127.0.0.1'),
	(423, 1, '2014-04-28 11:25:28', 'LOGIN', '1db49f57fbf00ee36d925287dc625058', '127.0.0.1'),
	(424, 1, '2014-04-28 16:36:14', 'LOGOUT', 'a61c7f6aa0cef216d1836ccbaf7446e6', '127.0.0.1'),
	(425, 1, '2014-04-28 16:36:20', 'LOGIN', 'a61c7f6aa0cef216d1836ccbaf7446e6', '127.0.0.1'),
	(426, 1, '2014-04-28 20:06:03', 'LOGOUT', 'a61c7f6aa0cef216d1836ccbaf7446e6', '127.0.0.1'),
	(427, 1, '2014-04-28 20:06:11', 'LOGIN', 'a61c7f6aa0cef216d1836ccbaf7446e6', '127.0.0.1');
/*!40000 ALTER TABLE `tms_agent_activity` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_agent_chat
DROP TABLE IF EXISTS `tms_agent_chat`;
CREATE TABLE IF NOT EXISTS `tms_agent_chat` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from` varchar(255) NOT NULL default '',
  `to` varchar(255) NOT NULL default '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL default '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_agent_chat: ~0 rows (approximately)
DELETE FROM `tms_agent_chat`;
/*!40000 ALTER TABLE `tms_agent_chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `tms_agent_chat` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_agent_group
DROP TABLE IF EXISTS `tms_agent_group`;
CREATE TABLE IF NOT EXISTS `tms_agent_group` (
  `id` varchar(32) NOT NULL,
  `name` varchar(50) default NULL,
  `handling_type` char(1) default NULL,
  `group_master` varchar(32) default NULL,
  `description` varchar(255) default NULL,
  `updated_by` varchar(32) default NULL,
  `last_update` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_agent_group: 0 rows
DELETE FROM `tms_agent_group`;
/*!40000 ALTER TABLE `tms_agent_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `tms_agent_group` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_agent_msgbox
DROP TABLE IF EXISTS `tms_agent_msgbox`;
CREATE TABLE IF NOT EXISTS `tms_agent_msgbox` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `from` int(255) unsigned default NULL,
  `to` int(255) unsigned default NULL,
  `message` text NOT NULL,
  `sent` datetime NOT NULL default '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table ajmidb.tms_agent_msgbox: ~22 rows (approximately)
DELETE FROM `tms_agent_msgbox`;
/*!40000 ALTER TABLE `tms_agent_msgbox` DISABLE KEYS */;
INSERT INTO `tms_agent_msgbox` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
	(1, 1, 1, 'test', '2014-04-01 16:39:27', 0),
	(2, 1, 26, 'test', '2014-04-01 16:39:27', 0),
	(3, 1, 27, 'test', '2014-04-01 16:39:27', 0),
	(4, 1, 28, 'test', '2014-04-01 16:39:27', 0),
	(5, 1, 29, 'test', '2014-04-01 16:39:27', 0),
	(6, 1, 30, 'test', '2014-04-01 16:39:27', 0),
	(7, 1, 31, 'test', '2014-04-01 16:39:27', 0),
	(8, 1, 32, 'test', '2014-04-01 16:39:27', 0),
	(9, 1, 33, 'test', '2014-04-01 16:39:27', 0),
	(10, 1, 34, 'test', '2014-04-01 16:39:27', 0),
	(11, 1, 35, 'test', '2014-04-01 16:39:28', 0),
	(12, 1, 1, 'll', '2014-04-10 02:59:51', 0),
	(13, 1, 26, 'll', '2014-04-10 02:59:51', 0),
	(14, 1, 27, 'll', '2014-04-10 02:59:51', 0),
	(15, 1, 28, 'll', '2014-04-10 02:59:52', 0),
	(16, 1, 29, 'll', '2014-04-10 02:59:52', 0),
	(17, 1, 30, 'll', '2014-04-10 02:59:52', 0),
	(18, 1, 31, 'll', '2014-04-10 02:59:52', 0),
	(19, 1, 32, 'll', '2014-04-10 02:59:52', 0),
	(20, 1, 33, 'll', '2014-04-10 02:59:52', 0),
	(21, 1, 34, 'll', '2014-04-10 02:59:52', 0),
	(22, 1, 35, 'll', '2014-04-10 02:59:52', 0);
/*!40000 ALTER TABLE `tms_agent_msgbox` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_agent_profile
DROP TABLE IF EXISTS `tms_agent_profile`;
CREATE TABLE IF NOT EXISTS `tms_agent_profile` (
  `id` bigint(32) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `menu_group` varchar(80) default NULL,
  `menu` varchar(200) default NULL,
  `response` text,
  `updated_by` varchar(32) default NULL,
  `last_update` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table ajmidb.tms_agent_profile: 7 rows
DELETE FROM `tms_agent_profile`;
/*!40000 ALTER TABLE `tms_agent_profile` DISABLE KEYS */;
INSERT INTO `tms_agent_profile` (`id`, `name`, `menu_group`, `menu`, `response`, `updated_by`, `last_update`) VALUES
	(1, 'System Administrator', '1,20,3,8,5,6,7,26,10', '5,6,7,9,10,11,12,13,14,15,16,17,19,23,24,25,26,27,28,29,30,31,32,33,18,35,37,38,39,42,40,43,44,45,46,47,48,49,51,52,53,54,2,56,57,58,59,60,61,62,20,63,64,54,66,67,68,69,35,31,4,75,79,76,45,45,80,86,87', '0,4,26,14,3,32,33,25,5,35,1,34,2,30,16,9,6,28,13,10,20,19,18,17,11,22,21,7,31,24,23,15,27,36', 'System Root', '2014-04-17 02:17:34'),
	(4, 'Agent Outbound', '7,10', '20,23,24,25,50,88', '81,82,83,84,85', 'System Root', '2014-04-17 02:18:03'),
	(3, 'System Supervisor', '20,8,5,6,7,10', '17,15,24,33,38,42,16,46,49,43,20,51,23,63,45,7,56,66,67', '0,4,26,14,3,32,33,25,5,35,1,34,2,30,16,9,6,28,13,10,20,19,18,17,11,22,21,7,31,24,23,15,27,36', 'System Root', '2014-04-17 02:32:30'),
	(2, 'System Manager', '20,8,5,6,7,10', '15,24,33,42,16,43,23,56,63,45,59,17,66,67', '0,4,26,14,3,32,33,25,5,35,1,34,2,30,16,9,6,28,13,10,20,19,18,17,11,22,21,7,31,24,23,15,27,36', 'System Root', '2014-04-17 02:32:12'),
	(5, 'Quality Assurance', '5,10', '15,16,24,10,7,29,30,39,36,42,37,7,45,19,33,23,57,59,40,66', '0,4,26,14,3,32,33,25,5,35,1,34,2,30,16,9,6,28,13,10,20,19,18,17,11,22,21,7,31,24,23,15,27,36', 'System Root', '2014-04-17 02:17:20'),
	(6, 'Agent Inbound', '7,10', '23,88,89', '81,82,83,84,85', 'System Root', '2014-04-17 02:17:52'),
	(8, 'System Root', '1,20,3,8,5,6,7,26,10', '5,6,7,9,10,11,12,13,14,15,16,17,19,23,24,25,26,27,28,29,30,31,32,33,18,35,37,38,39,42,40,43,44,45,46,47,48,49,51,52,53,54,2,56,57,58,59,60,61,62,20,63,64,54,66,67,68,69,35,31,4,75,79,76,45,45,80,86,87', '0,4,26,14,3,32,33,25,5,35,1,34,2,30,16,9,6,28,13,10,20,19,18,17,11,22,21,7,31,24,23,15,27,36', 'System Root', '2014-04-17 02:20:28');
/*!40000 ALTER TABLE `tms_agent_profile` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_application_config
DROP TABLE IF EXISTS `tms_application_config`;
CREATE TABLE IF NOT EXISTS `tms_application_config` (
  `module_name` varchar(20) NOT NULL,
  `param_name` varchar(30) NOT NULL,
  `param_value` varchar(50) default NULL,
  `description` varchar(255) default NULL,
  `content` mediumtext,
  `updated_by` varchar(32) default NULL,
  `last_update` datetime default NULL,
  PRIMARY KEY  (`module_name`(1),`param_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table ajmidb.tms_application_config: 31 rows
DELETE FROM `tms_application_config`;
/*!40000 ALTER TABLE `tms_application_config` DISABLE KEYS */;
INSERT INTO `tms_application_config` (`module_name`, `param_name`, `param_value`, `description`, `content`, `updated_by`, `last_update`) VALUES
	('COMPANY', 'FAX_NUMBER', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'TAG_LINE', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'ADDRESS_1', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'ADDRESS_2', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'COMPANY_LOGO', NULL, NULL, NULL, NULL, NULL),
	('COMPANY', 'COMPANY_NAME', 'Razaki Technology', NULL, NULL, NULL, NULL),
	('COMPANY', 'EMAIL', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'PHONE_NUMBER', '', NULL, NULL, NULL, NULL),
	('COMPANY', 'WEB_ADDRESS', '', NULL, NULL, NULL, NULL),
	('DATA_CAPTURE', 'CAPTURE_TIME', '1.0', 'Data Capture Time', NULL, NULL, NULL),
	('DB_BACKUP', 'BACKUP_PERIOD', NULL, NULL, NULL, NULL, NULL),
	('DB_BACKUP', 'BACKUP_TIME', NULL, NULL, NULL, NULL, NULL),
	('DB_BACKUP', 'DATA_TABLE', '0', 'Table: 0-All Tables. 1-Main Tables', NULL, NULL, NULL),
	('UPLOAD', 'ENABLED', '1', 'Upload Data', NULL, NULL, NULL),
	('WEBSITE', 'AUTHOR', 'Razakiers Team', 'Developer', NULL, NULL, NULL),
	('WEBSITE', 'TITLE', 'EUI System', 'Website Title', NULL, NULL, NULL),
	('WEBSITE', 'VERSION', '1.0', 'Aplication Version', NULL, NULL, NULL),
	('COMPANY', 'CITY', 'Jakarta', NULL, NULL, NULL, NULL),
	('COMPANY', 'POST_CODE', '', NULL, NULL, NULL, NULL),
	('CONFIG', 'THEME', 'cupertino', 'cupertino', NULL, 'superuser', '2009-08-29 13:18:32'),
	('WEBSITE', 'COPYRIGHT', '&copy; Copyright 2009', NULL, NULL, NULL, NULL),
	('WEBSITE', 'LOGO_DARK', 'Enigma', NULL, NULL, NULL, NULL),
	('WEBSITE', 'LOGO_ORANGE', 'Insurance System', NULL, NULL, NULL, NULL),
	('CONFIG', 'HOST_IP_ADDR', 'localhost', NULL, NULL, NULL, NULL),
	('CONFIG', 'DB_NAME', 'rspi', NULL, NULL, NULL, NULL),
	('CONFIG', 'DB_USERNAME', 'enigma', NULL, NULL, NULL, NULL),
	('CONFIG', 'DB_PASSWORD', 'enigma', NULL, NULL, NULL, NULL),
	('CONFIG', 'URL', '', NULL, NULL, NULL, NULL),
	('CONFIG', 'FILE_PATH', '', NULL, NULL, NULL, NULL),
	('CONFIG', 'PDF_DIRECTORY', '', NULL, NULL, NULL, NULL),
	('INSTRUCTION', 'INSTRUCTION', '1', '', '<p>Sistem ini adalah aplikasi untuk mengakses \r\n          informasi yang perlu diketahui oleh para agent seperti, \r\n          nasabah yang sedang ditangani, performansi agent dan sebagainya.</p>\r\n        <p><strong>Ketentuan penggunaan akses sistem \r\n          :</strong></p>\r\n        <ol>\r\n          <li>Untuk mengakses sistem ini Anda harus mempunyai \r\n            otorisasi yang diatur oleh System Administrator.</li>\r\n          <li>Yang berhak mengakses sistem ini adalah agent yang telah ditunjuk \r\n            oleh<b style="color:green;"> E.U.I Frame Work V 0.0.1</b>.</li>\r\n          <li>Anda bertanggung jawab untuk menjaga kerahasiaan \r\n            data nasabah yang ada dalam sistem ini.</li>\r\n          </ol>', NULL, NULL);
/*!40000 ALTER TABLE `tms_application_config` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_application_menu
DROP TABLE IF EXISTS `tms_application_menu`;
CREATE TABLE IF NOT EXISTS `tms_application_menu` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `group_menu` tinyint(1) NOT NULL COMMENT '1=CUSTOMER; 2=MANAGEMEN; 3=REPORTS;  4=UTILITIES; 5=REFERENCES; 6=SYSTEM',
  `menu` varchar(25) default NULL,
  `file_name` varchar(64) NOT NULL default '#',
  `el_id` varchar(25) default NULL,
  `description` text,
  `flag` tinyint(1) NOT NULL default '1',
  `updated_by` varchar(32) default NULL,
  `last_update` datetime default NULL,
  `OrderId` int(3) NOT NULL default '0',
  `images` varchar(50) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table ajmidb.tms_application_menu: 73 rows
DELETE FROM `tms_application_menu`;
/*!40000 ALTER TABLE `tms_application_menu` DISABLE KEYS */;
INSERT INTO `tms_application_menu` (`id`, `group_menu`, `menu`, `file_name`, `el_id`, `description`, `flag`, `updated_by`, `last_update`, `OrderId`, `images`) VALUES
	(1, 1, 'Cutoff Dates', 'set_efectivedate_nav.php', 'set_efectivedate_nav.php', NULL, 0, NULL, NULL, 9, 'application.png'),
	(2, 1, 'Campaign Cores', 'SetCores', 'SetCores', NULL, 1, NULL, NULL, 1, 'application.png'),
	(3, 1, 'Products', 'SetProduct', 'SetProduct', NULL, 1, NULL, NULL, 2, 'application.png'),
	(4, 1, 'Product Benefits', 'SetBenefit', 'SetBenefit', NULL, 1, NULL, NULL, 3, 'application.png'),
	(5, 1, 'Campaigns Setup', 'SetCampaign', 'SetCampaign', NULL, 1, NULL, NULL, 5, 'application.png'),
	(6, 1, 'Call Results', 'SetCallResult', 'SetCallResult', NULL, 1, NULL, NULL, 7, 'application.png'),
	(7, 5, 'Phone Approvals', 'ModApprovePhone', 'ModApprovePhone', NULL, 1, NULL, NULL, 7, 'application.png'),
	(9, 1, 'Last Calls Setup', 'SetLastCall', 'SetLastCall', NULL, 1, NULL, NULL, 11, 'application.png'),
	(10, 5, 'Customer Name Approvals', 'mon_chgcust_nav.php', NULL, NULL, 0, NULL, NULL, 10, 'application.png'),
	(11, 3, 'Manage Group Menu', 'SysMenuGroup', 'SysMenuGroup', NULL, 1, NULL, NULL, 0, 'application.png'),
	(12, 3, 'Manage System Menu', 'SysMenu', 'SysMenu', NULL, 1, NULL, NULL, 1, 'application.png'),
	(13, 3, 'User Registration', 'SysUser', 'SysUser', NULL, 1, NULL, NULL, 2, 'user_edit.png'),
	(14, 3, 'Application Layout', 'SysThemes', 'SysThemes', NULL, 1, NULL, NULL, 3, 'application.png'),
	(15, 26, 'Agent Monitoring', 'MonAgentActivity', 'MonAgentActivity', NULL, 1, NULL, NULL, 1, 'application.png'),
	(16, 5, 'Recordings', 'ModVoiceData', 'ModVoiceData', NULL, 1, NULL, NULL, 0, 'application.png'),
	(17, 8, 'Assignment Data', 'MgtAssignment', 'MgtAssignment', NULL, 1, NULL, NULL, 0, 'application.png'),
	(18, 8, 'Reload Data', 'mgt_retrive_nav.php', NULL, NULL, 0, NULL, NULL, 3, 'application.png'),
	(19, 8, 'TM Scoring All', 'dta_detail_nav.php', 'dta_detail_nav.php', 'Customer Details', 0, NULL, NULL, 2, 'application.png'),
	(20, 7, 'Customer Followup', 'SrcCustomerList', 'SrcCustomerList', NULL, 1, NULL, NULL, 0, 'application.png'),
	(21, 10, 'Notes', 'Notes', 'Notes', NULL, 0, NULL, NULL, 0, 'application.png'),
	(22, 8, 'Customer List', 'SrcCustomerList', 'SrcCustomerList', NULL, 0, NULL, NULL, 1, 'application.png'),
	(23, 10, 'Change Password', 'Password', 'Password', NULL, 1, NULL, NULL, 0, 'application.png'),
	(24, 10, 'Logout', 'Logout', 'Logout', NULL, 1, NULL, NULL, 1, 'application.png'),
	(25, 7, 'Customer Appoinment', 'SrcAppoinment', 'SrcAppoinment', NULL, 1, NULL, NULL, 0, 'application.png'),
	(26, 6, 'Download Prospect Level', '../report/rpt_prosplevel_nav.php', NULL, NULL, 0, NULL, NULL, 2, 'application.png'),
	(27, 6, 'Download Call Tracking', '../report/rpt_calltracking_nav.php', NULL, NULL, 0, NULL, NULL, 1, 'application.png'),
	(28, 6, 'Report TXT', '../report/rpt_closing_nav.php', NULL, NULL, 0, NULL, NULL, 0, 'application.png'),
	(29, 6, 'List Closing', '../report/rpt_listclosing_nav.php', NULL, NULL, 0, NULL, NULL, 3, 'application.png'),
	(30, 6, 'Closing VRS', '../report/rpt_closingvrs_nav.php', NULL, NULL, 0, NULL, NULL, 4, 'application.png'),
	(31, 1, 'Product Prefixes', 'SetPrefix', 'SetPrefix', NULL, 1, NULL, NULL, 4, 'application.png'),
	(32, 1, 'Product Scripts', 'SetProductScript', 'SetProductScript', NULL, 1, NULL, NULL, 10, 'application.png'),
	(33, 6, 'Call Tracking Report', '../report/rpt_ctr_nav.php', NULL, NULL, 0, NULL, NULL, 5, 'application.png'),
	(35, 8, 'View Product Plans', 'ModViewPlan', 'ModViewPlan', NULL, 1, NULL, NULL, 6, 'application.png'),
	(36, 7, 'Customer Policy', 'SrcCustomerPolis', 'SrcCustomerPolis', NULL, 1, NULL, NULL, 0, 'application.png'),
	(37, 5, 'Download Recordings', 'mon_dwnrecording_nav.php', NULL, NULL, 0, NULL, NULL, 0, 'application.png'),
	(38, 8, 'Customer Transfer', 'dta_transfer_nav.php', NULL, NULL, 0, NULL, NULL, 4, 'application.png'),
	(39, 5, 'Approval Interest', 'QtyApprovalInterest', 'QtyApprovalInterest', NULL, 1, NULL, NULL, 0, 'application.png'),
	(40, 5, 'Approval Pending', 'QtyApprovalPending', 'QtyApprovalPending', NULL, 1, NULL, NULL, 0, 'application.png'),
	(43, 8, 'Campaign Information', 'set_mcampaigninfo_nav.php', 'set_mcampaigninfo_nav.php', NULL, 1, NULL, NULL, 7, 'application.png'),
	(42, 7, 'Broadcast Messages', 'ModBroadcastMsg', NULL, NULL, 1, NULL, NULL, 8, 'application.png'),
	(44, 20, 'Management Call', 'set_testcall_nav.php', 'set_testcall_nav.php', NULL, 0, NULL, NULL, 0, 'application.png'),
	(45, 6, 'Activity Report', 'rpt_callmon_nav.php', 'rpt_callmon_nav.php', NULL, 1, NULL, NULL, 0, 'application.png'),
	(46, 8, 'Multiple Transfer', 'dta_mutransfer_nav.php', 'dta_mutransfer_nav.php', NULL, 0, NULL, NULL, 5, 'application.png'),
	(47, 20, 'User Extension', 'CtiExtension', 'CtiExtension', NULL, 1, NULL, NULL, 0, 'application.png'),
	(48, 20, 'Manage MISDN', 'set_isdnsetup_nav.php', 'set_isdnsetup_nav.php', NULL, 0, NULL, NULL, 0, 'application.png'),
	(49, 8, 'Transafer Data', 'MgtTransferData', 'MgtTransferData', NULL, 1, NULL, NULL, 0, 'application.png'),
	(56, 20, 'Free Dial', 'CtiFreeDial', 'CtiFreeDial', NULL, 1, NULL, NULL, 2, 'application.png'),
	(50, 7, 'Customer Closing', 'SrcCustomerClosing', 'SrcCustomerClosing', NULL, 1, NULL, NULL, 0, 'application.png'),
	(51, 8, 'Retrieve Data', 'dta_qc_nav.php', 'asAS', NULL, 0, NULL, NULL, 1, 'application.png'),
	(52, 1, 'Call Category Result', 'SetResultCategory', 'SetResultCategory', NULL, 1, NULL, NULL, 6, 'application.png'),
	(53, 1, 'Quality Result', 'SetResultQuality', 'SetResultQuality', NULL, 1, NULL, NULL, 8, 'application.png'),
	(54, 8, 'Re-Assignment Data', 'ssasSssS', 'asS', NULL, 0, NULL, NULL, 0, 'application.png'),
	(55, 1, 'Data FIlter', '', NULL, NULL, 0, NULL, NULL, 0, 'application.png'),
	(57, 5, 'Quality Approval', 'QtyApprovalData', 'QtyApprovalData', NULL, 1, NULL, NULL, 0, 'application.png'),
	(58, 1, ' Setup Work Area', 'SetWorkArea', 'SetWorkArea', NULL, 0, NULL, NULL, 0, 'application.png'),
	(59, 6, 'Quality Report', 'SetResultQuality', 'SetResultQuality', NULL, 1, NULL, NULL, 0, 'application.png'),
	(61, 1, 'FTP Setup', 'set_ftp_nav.php', 'set_ftp_nav.php', NULL, 0, NULL, NULL, 0, 'application.png'),
	(62, 1, 'Colmon Setup', 'set_collmon_nav.php', 'set_collmon_nav.php', NULL, 0, NULL, NULL, 0, 'application.png'),
	(63, 8, 'Customer Detail', 'MgtDetailData', 'MgtDetailData', NULL, 1, NULL, NULL, 0, 'application.png'),
	(64, 1, 'FTP Upload Read', 'SetReadFTP', 'SetReadFTP', NULL, 1, NULL, NULL, 12, 'application.png'),
	(65, 7, 'Customer Not Ineterest', 'SrcNotInterest', 'SrcNotInterest', NULL, 1, NULL, NULL, 0, 'application.png'),
	(66, 26, 'Live Size Monitoring', 'mgt_monlive_data_nav.php', NULL, NULL, 0, NULL, NULL, 0, 'application.png'),
	(67, 6, 'Tracking Report', 'rpt_call_tracking_ajmi.php', NULL, NULL, 1, NULL, NULL, 0, 'application.png'),
	(68, 8, 'Upload Detail', 'ModUploadDetail', 'ModUploadDetail', NULL, 1, NULL, NULL, 0, 'application.png'),
	(69, 26, 'Server Monitoring', 'mgt_monitoring_device_nav.php', NULL, NULL, 1, NULL, NULL, 0, 'application.png'),
	(79, 20, 'CTI Setting', 'SASasAS', 'cc_settings', NULL, 0, NULL, NULL, 3, 'application.png'),
	(75, 20, 'User Skill', 'CtiUserSkill', 'CtiUserSkill', NULL, 1, NULL, NULL, 1, 'application.png'),
	(76, 20, 'PBX Setting', 'ASasASss', 'cc_pbx_settings', NULL, 0, NULL, NULL, 2, 'application.png'),
	(80, 1, 'Setup Upload', 'SetUpload', 'SetUpload', NULL, 1, NULL, NULL, 2, 'application.png'),
	(89, 7, 'Form Inbound', 'ModFormInbound', 'ModFormInbound', NULL, 1, NULL, NULL, 0, 'application.png'),
	(88, 7, 'Dashboard', 'ModDashboard', 'ModDashboard', NULL, 1, NULL, NULL, 0, 'application.png'),
	(86, 3, 'User Group Layout', 'SysUserLayout', 'SysUserLayout', NULL, 1, NULL, NULL, 4, 'user_edit.png'),
	(87, 3, 'User Privileges', 'SysPrivileges', 'SysPrivileges', NULL, 1, NULL, NULL, 2, 'user_edit.png');
/*!40000 ALTER TABLE `tms_application_menu` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_application_themes
DROP TABLE IF EXISTS `tms_application_themes`;
CREATE TABLE IF NOT EXISTS `tms_application_themes` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_application_themes: 25 rows
DELETE FROM `tms_application_themes`;
/*!40000 ALTER TABLE `tms_application_themes` DISABLE KEYS */;
INSERT INTO `tms_application_themes` (`id`, `name`) VALUES
	('base', 'Base'),
	('black-tie', 'Black Tie'),
	('blitzer', 'Blitzer'),
	('cupertino', 'Cupertino'),
	('dark-hive', 'Dark Hive'),
	('dot-luv', 'Dot Luv'),
	('eggplant', 'Eggplant'),
	('excite-bike', 'Excite Bike'),
	('flick', 'Flick'),
	('hot-sneaks', 'Hot Sneaks'),
	('humanity', 'Humanity'),
	('le-frog', 'Le Frog'),
	('mint-choc', 'Mint Choc'),
	('overcast', 'Overcast'),
	('pepper-grinder', 'Pepper Grinder'),
	('redmond', 'Redmond'),
	('smoothness', 'Smoothness'),
	('south-street', 'South Street'),
	('start', 'Start'),
	('sunny', 'Sunny'),
	('swanky-purse', 'Swanky Purse'),
	('trontastic', 'Trontastic'),
	('ui-darkness', 'UI Darkness'),
	('ui-lightness', 'UI Lightness'),
	('vader', 'Vader');
/*!40000 ALTER TABLE `tms_application_themes` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_ftp_config
DROP TABLE IF EXISTS `tms_ftp_config`;
CREATE TABLE IF NOT EXISTS `tms_ftp_config` (
  `ftp_id` int(10) unsigned NOT NULL auto_increment,
  `ftp_port` varchar(20) default NULL,
  `ftp_user` varchar(20) default NULL,
  `ftp_pasword` varchar(20) default NULL,
  `ftp_host` varchar(25) default NULL,
  `ftp_get_file` varchar(100) default NULL,
  `ftp_put_file` varchar(100) default NULL,
  `ftp_history_file` varchar(100) default NULL,
  `ftp_flags` tinyint(2) default NULL,
  PRIMARY KEY  (`ftp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_ftp_config: 1 rows
DELETE FROM `tms_ftp_config`;
/*!40000 ALTER TABLE `tms_ftp_config` DISABLE KEYS */;
INSERT INTO `tms_ftp_config` (`ftp_id`, `ftp_port`, `ftp_user`, `ftp_pasword`, `ftp_host`, `ftp_get_file`, `ftp_put_file`, `ftp_history_file`, `ftp_flags`) VALUES
	(1, '21', 'root', 'root01', '192.168.7.77', '/var/www/html/FTP_TEXT', '/opt/enigma/webapps/ajmi/tmp', '/opt/enigma/webapps/ajmi/upload', 1);
/*!40000 ALTER TABLE `tms_ftp_config` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_ftp_read
DROP TABLE IF EXISTS `tms_ftp_read`;
CREATE TABLE IF NOT EXISTS `tms_ftp_read` (
  `ftp_read_id` int(10) unsigned NOT NULL auto_increment,
  `ftp_read_directory` varchar(100) default NULL,
  `ftp_read_filetype` varchar(100) default NULL,
  `ftp_read_ctltype` varchar(100) default NULL,
  `ftp_read_dir_history` varchar(100) default NULL,
  `ftp_read_mode` enum('GET','PUT') default NULL,
  `ftp_read_action` varchar(100) default NULL,
  `ftp_read_crontab` varchar(400) default NULL,
  `ftp_read_createts` datetime default NULL,
  PRIMARY KEY  (`ftp_read_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_ftp_read: 2 rows
DELETE FROM `tms_ftp_read`;
/*!40000 ALTER TABLE `tms_ftp_read` DISABLE KEYS */;
INSERT INTO `tms_ftp_read` (`ftp_read_id`, `ftp_read_directory`, `ftp_read_filetype`, `ftp_read_ctltype`, `ftp_read_dir_history`, `ftp_read_mode`, `ftp_read_action`, `ftp_read_crontab`, `ftp_read_createts`) VALUES
	(1, '/var/sftp/incoming', 'MCS_AJMIXXXXXXXXXX.txt', 'MCS_AJMIXXXXXXXXXX.ctl', '/var/sftp/history', 'GET', '/opt/enigma/webapps/ajmi/php/act_read_ftpdata.php', '*/1 * * * * php /opt/enigma/webapps/ajmi/php/act_read_ftpdata.php GET 1', '2013-10-23 03:42:02'),
	(2, '/var/sftp/outgoing', 'repbm.txt', 'repbm.ctl', '/var/sftp/outgoing', 'PUT', '/opt/enigma/webapps/ajmi/php/act_read_ftpdata.php', '*/10 * * * * php /opt/enigma/webapps/ajmi/php/act_read_ftpdata.php PUT 2', '2013-10-24 14:51:47');
/*!40000 ALTER TABLE `tms_ftp_read` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_group_menu
DROP TABLE IF EXISTS `tms_group_menu`;
CREATE TABLE IF NOT EXISTS `tms_group_menu` (
  `GroupId` int(10) NOT NULL auto_increment,
  `GroupName` varchar(50) default NULL,
  `GroupShow` tinyint(4) default NULL,
  `GroupDesc` varchar(200) default NULL,
  `CreateDate` datetime default NULL,
  `UserCreate` varchar(50) default NULL,
  `GroupOrder` int(10) NOT NULL default '0',
  PRIMARY KEY  (`GroupId`),
  KEY `GroupName` (`GroupName`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_group_menu: 9 rows
DELETE FROM `tms_group_menu`;
/*!40000 ALTER TABLE `tms_group_menu` DISABLE KEYS */;
INSERT INTO `tms_group_menu` (`GroupId`, `GroupName`, `GroupShow`, `GroupDesc`, `CreateDate`, `UserCreate`, `GroupOrder`) VALUES
	(1, 'SETTINGS', 1, 'Settings', '2012-10-10 11:57:28', 'superuser', 0),
	(20, 'MANAGE PHONE', 1, 'Management Phone', '2013-02-14 10:45:45', 'sysadmin', 0),
	(3, 'MANAGE SYSTEM', 1, 'Manage System', '2012-10-10 11:57:34', 'superuser', 3),
	(8, 'MANAGE DATA', 1, 'Manage Data', '2012-10-14 16:11:07', 'superuser', 1),
	(5, 'QUALITY ASSURANCE', 1, 'Quality Assurance', '2012-10-10 11:57:40', 'superuser', 4),
	(6, 'REPORTS', 1, 'Reports', '2012-10-10 11:57:40', 'superuser', 5),
	(7, 'SEARCHES', 1, 'Searches', '2012-10-14 23:39:58', 'superuser', 6),
	(10, 'SYSTEM', 1, 'System', '2012-10-16 22:48:31', 'superuser', 8),
	(26, 'MONITORING', 1, 'Live Monitoring', '2014-03-02 02:29:47', '1', 0);
/*!40000 ALTER TABLE `tms_group_menu` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_misdn_provider
DROP TABLE IF EXISTS `tms_misdn_provider`;
CREATE TABLE IF NOT EXISTS `tms_misdn_provider` (
  `ProviderId` int(10) NOT NULL auto_increment,
  `ProviderCode` varchar(50) default NULL,
  `ProviderName` varchar(50) default NULL,
  `ProviderStatus` tinyint(1) default '1',
  PRIMARY KEY  (`ProviderId`),
  UNIQUE KEY `ProviderCode` (`ProviderCode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_misdn_provider: ~8 rows (approximately)
DELETE FROM `tms_misdn_provider`;
/*!40000 ALTER TABLE `tms_misdn_provider` DISABLE KEYS */;
INSERT INTO `tms_misdn_provider` (`ProviderId`, `ProviderCode`, `ProviderName`, `ProviderStatus`) VALUES
	(1, 'TKOM', 'TELKOMSELL', 1),
	(2, 'FLEXI', 'TELKOM FLEXI', 1),
	(3, 'EXCEL', 'EXCELCOMIDO', 1),
	(4, 'ISAT', 'INDOSAT', 1),
	(5, 'AXIS', 'AXIATA', 1),
	(6, 'ESIA', 'ESIA', 1),
	(7, 'THREE', '3THREE', 1),
	(8, 'TELKOM', 'TELKOM', 1);
/*!40000 ALTER TABLE `tms_misdn_provider` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_misdn_quality
DROP TABLE IF EXISTS `tms_misdn_quality`;
CREATE TABLE IF NOT EXISTS `tms_misdn_quality` (
  `QualityId` int(10) unsigned NOT NULL auto_increment,
  `QualityName` varchar(50) default NULL,
  `QualityFlagsStatus` tinyint(1) unsigned default '1',
  PRIMARY KEY  (`QualityId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_misdn_quality: ~4 rows (approximately)
DELETE FROM `tms_misdn_quality`;
/*!40000 ALTER TABLE `tms_misdn_quality` DISABLE KEYS */;
INSERT INTO `tms_misdn_quality` (`QualityId`, `QualityName`, `QualityFlagsStatus`) VALUES
	(1, 'GOOD', 1),
	(2, 'MIDDLE', 1),
	(3, 'AVERAGE', 1),
	(4, 'POOR', 1);
/*!40000 ALTER TABLE `tms_misdn_quality` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_misdn_report
DROP TABLE IF EXISTS `tms_misdn_report`;
CREATE TABLE IF NOT EXISTS `tms_misdn_report` (
  `CallId` int(10) NOT NULL auto_increment,
  `CallSessionId` bigint(20) default NULL,
  `CallDate` datetime default NULL,
  `CallEndDate` datetime default NULL,
  `CallNumber` varchar(50) default NULL,
  `CallByUser` int(10) default NULL,
  `CallRemarks` text,
  `CallMISDNType` varchar(11) default NULL,
  `CallMISDNQualityId` int(11) default NULL,
  `ProviderId` int(10) default NULL,
  `isCall` int(1) NOT NULL default '0',
  PRIMARY KEY  (`CallId`),
  KEY `FK_tms_misdn_report_tms_misdn_provider` (`ProviderId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_misdn_report: ~0 rows (approximately)
DELETE FROM `tms_misdn_report`;
/*!40000 ALTER TABLE `tms_misdn_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `tms_misdn_report` ENABLE KEYS */;


-- Dumping structure for table ajmidb.tms_misdn_type
DROP TABLE IF EXISTS `tms_misdn_type`;
CREATE TABLE IF NOT EXISTS `tms_misdn_type` (
  `MISDNId` int(10) unsigned NOT NULL auto_increment,
  `MISDNProvider` int(50) default NULL,
  `MISDNPrefix` varchar(50) default NULL,
  `MISDNName` varchar(50) default NULL,
  `MISDNNumber` varchar(50) default NULL,
  `MISDNStatus` tinyint(1) unsigned default '1',
  PRIMARY KEY  (`MISDNId`),
  KEY `FK_tms_isdn_type_tms_isdn_provider` (`MISDNProvider`),
  CONSTRAINT `FK_tms_misdn_type_tms_misdn_provider` FOREIGN KEY (`MISDNProvider`) REFERENCES `tms_misdn_provider` (`ProviderId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.tms_misdn_type: ~12 rows (approximately)
DELETE FROM `tms_misdn_type`;
/*!40000 ALTER TABLE `tms_misdn_type` DISABLE KEYS */;
INSERT INTO `tms_misdn_type` (`MISDNId`, `MISDNProvider`, `MISDNPrefix`, `MISDNName`, `MISDNNumber`, `MISDNStatus`) VALUES
	(1, 1, '0852', 'SIMPATI', '23445899', 1),
	(2, 4, '0857', 'MENTARI', '16004796', 1),
	(3, 2, '021', 'FLEXI', '32066189', 1),
	(4, 1, '0813', 'SIMPATI', '63202200', 1),
	(5, 4, '0815', 'MENTARI', '74091081', 1),
	(6, 3, '0877', 'exelcomido', '88170756', 1),
	(7, 4, '0856', 'MENTARI', '24871882', 1),
	(8, 2, '021', 'FLEXI', '49043482', 1),
	(9, 3, '0878', 'exelcomido', '80825505', 1),
	(10, 3, '0878', 'exelcomido', '78899486', 1),
	(12, 2, '021', 'FLEXI', '71242064', 1),
	(16, 7, '0896', 'zzzz', '61560545', 1);
/*!40000 ALTER TABLE `tms_misdn_type` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_activitycall
DROP TABLE IF EXISTS `t_gn_activitycall`;
CREATE TABLE IF NOT EXISTS `t_gn_activitycall` (
  `ActivityId` int(10) NOT NULL auto_increment,
  `CallSession` bigint(20) NOT NULL default '0',
  `StartCallTs` datetime default NULL,
  `ConnectTs` datetime default NULL,
  `DisconnectTs` datetime default NULL,
  `EndCallTs` datetime default NULL,
  `CallerNumber` varchar(50) default NULL,
  `CustomerId` int(10) default NULL,
  `AgentId` int(11) default NULL,
  PRIMARY KEY  (`ActivityId`),
  KEY `CustomerId` (`CustomerId`),
  KEY `CallSession` (`CallSession`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_activitycall: ~0 rows (approximately)
DELETE FROM `t_gn_activitycall`;
/*!40000 ALTER TABLE `t_gn_activitycall` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_activitycall` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_activitylog
DROP TABLE IF EXISTS `t_gn_activitylog`;
CREATE TABLE IF NOT EXISTS `t_gn_activitylog` (
  `ActivityId` int(10) NOT NULL auto_increment,
  `ActivityUserId` int(10) default NULL,
  `ActivityDate` timestamp NULL default CURRENT_TIMESTAMP,
  `ActivityEvent` tinytext,
  PRIMARY KEY  (`ActivityId`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_activitylog: 32 rows
DELETE FROM `t_gn_activitylog`;
/*!40000 ALTER TABLE `t_gn_activitylog` DISABLE KEYS */;
INSERT INTO `t_gn_activitylog` (`ActivityId`, `ActivityUserId`, `ActivityDate`, `ActivityEvent`) VALUES
	(1, 1, '2014-03-05 16:58:19', 'Remove Group Menu ::10'),
	(2, 1, '2014-03-05 16:58:26', 'Assign Group Menu ::10,7'),
	(3, 1, '2014-03-08 00:01:39', 'Add Core ::TEST_CORE,TEST_CORE,1'),
	(4, 1, '2014-03-14 20:49:22', 'EnableGroup Menu :: 1'),
	(5, 1, '2014-03-14 20:49:28', 'DisableGroup Menu :: 1'),
	(6, 1, '2014-03-14 20:49:32', 'EnableGroup Menu :: 1'),
	(7, 1, '2014-03-15 15:42:03', 'Assign Menu ::5,6,7,9,10,11,12,13,14,15,16,17,19,23,24,25,26,27,28,29,30,31,32,33,18,35,37,38,39,42,40,43,44,45,46,47,48,49,51,52,53,54,2,56,57,58,59,60,61,62,20,63,64,54,66,67,68,69,35,31,4,75,79,76,45,45,80'),
	(8, 1, '2014-03-26 16:25:26', 'EnableGroup Menu :: 1'),
	(9, 1, '2014-03-31 07:12:16', 'Disable Menu ::58'),
	(10, 1, '2014-04-01 15:00:40', 'EnableGroup Menu :: 1'),
	(11, 1, '2014-04-03 14:48:12', 'Add Core ::TEST_CORES2,TEST_CORES2,1'),
	(12, 1, '2014-04-03 14:48:20', 'Update Core ::1'),
	(13, 1, '2014-04-06 22:47:33', 'Remove Group Menu ::5,10'),
	(14, 1, '2014-04-07 19:05:30', 'Assign Menu ::81,82,83,84,85,11,20'),
	(15, 1, '2014-04-07 19:06:19', 'Assign Menu ::81,82,83,84,85,11,20,24'),
	(16, 1, '2014-04-15 21:39:42', 'Remove Menu ::81'),
	(17, 1, '2014-04-15 21:39:47', 'Remove Menu ::82,83,84,85'),
	(18, 1, '2014-04-15 21:41:28', 'Remove Group Menu ::7,10'),
	(19, 1, '2014-04-16 23:21:41', 'Disable Menu ::76'),
	(20, 1, '2014-04-16 23:21:57', 'Disable Menu ::21'),
	(21, 1, '2014-04-16 23:22:13', 'Disable Menu ::79'),
	(22, 1, '2014-04-16 23:24:00', 'Disable Menu ::66'),
	(23, 1, '2014-04-16 23:27:36', 'Assign Menu ::5,6,7,9,10,11,12,13,14,15,16,17,19,23,24,25,26,27,28,29,30,31,32,33,18,35,37,38,39,42,40,43,44,45,46,47,48,49,51,52,53,54,2,56,57,58,59,60,61,62,20,63,64,54,66,67,68,69,35,31,4,75,79,76,45,45,80,86,87'),
	(24, 1, '2014-04-17 03:05:18', 'Remove Menu ::11'),
	(25, 1, '2014-04-17 03:05:34', 'Assign Menu ::20,23,24,88'),
	(26, 1, '2014-04-17 03:05:52', 'Assign Menu ::20,23,24,88,89'),
	(27, 1, '2014-04-17 03:06:54', 'Remove Menu ::24'),
	(28, 1, '2014-04-17 03:22:04', 'Remove Menu ::20'),
	(29, 1, '2014-04-17 15:59:11', 'Remove Menu ::11'),
	(30, 1, '2014-04-17 15:59:30', 'Assign Menu ::20,23,24,25'),
	(31, 1, '2014-04-17 15:59:37', 'Assign Menu ::20,23,24,25,50'),
	(32, 1, '2014-04-17 15:59:46', 'Assign Menu ::20,23,24,25,50,88');
/*!40000 ALTER TABLE `t_gn_activitylog` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_addphone
DROP TABLE IF EXISTS `t_gn_addphone`;
CREATE TABLE IF NOT EXISTS `t_gn_addphone` (
  `AddPhoneId` int(10) NOT NULL auto_increment,
  `CustomerId` int(10) default NULL,
  `AddPhoneType` int(10) default NULL,
  `AddPhoneNumber` varchar(50) default NULL,
  `AddPhoneApproveId` bigint(20) NOT NULL,
  PRIMARY KEY  (`AddPhoneId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_addphone: 0 rows
DELETE FROM `t_gn_addphone`;
/*!40000 ALTER TABLE `t_gn_addphone` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_addphone` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_applicationmember
DROP TABLE IF EXISTS `t_gn_applicationmember`;
CREATE TABLE IF NOT EXISTS `t_gn_applicationmember` (
  `MemberId` int(10) unsigned NOT NULL auto_increment,
  `ApplicationId` int(10) unsigned NOT NULL COMMENT 'FK_',
  `MemberNumber` varchar(20) NOT NULL COMMENT 'FK_',
  `MembeNumerOrder` int(10) unsigned NOT NULL COMMENT 'FK_',
  `CustomerName` varchar(64) NOT NULL COMMENT 'FK_',
  `InsuredId` int(10) unsigned NOT NULL COMMENT 'FK_',
  `CreatedTs` datetime NOT NULL COMMENT 'FK_',
  PRIMARY KEY  (`MemberId`),
  KEY `ApplicationId` (`ApplicationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_applicationmember: ~0 rows (approximately)
DELETE FROM `t_gn_applicationmember`;
/*!40000 ALTER TABLE `t_gn_applicationmember` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_applicationmember` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_appoinment
DROP TABLE IF EXISTS `t_gn_appoinment`;
CREATE TABLE IF NOT EXISTS `t_gn_appoinment` (
  `AppoinmentId` bigint(20) NOT NULL auto_increment,
  `CustomerId` int(10) default NULL,
  `UserId` int(10) default NULL,
  `ApoinmentDate` datetime default NULL,
  `ApoinmentCreate` datetime default NULL,
  `ApoinmentFlag` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`AppoinmentId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_appoinment: 2 rows
DELETE FROM `t_gn_appoinment`;
/*!40000 ALTER TABLE `t_gn_appoinment` DISABLE KEYS */;
INSERT INTO `t_gn_appoinment` (`AppoinmentId`, `CustomerId`, `UserId`, `ApoinmentDate`, `ApoinmentCreate`, `ApoinmentFlag`) VALUES
	(1, 1, 7, '2014-04-17 04:00:00', '2014-04-17 15:56:01', 1),
	(2, 3, 7, '2014-04-23 12:00:00', '2014-04-23 14:26:28', 1);
/*!40000 ALTER TABLE `t_gn_appoinment` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_approvalhistory
DROP TABLE IF EXISTS `t_gn_approvalhistory`;
CREATE TABLE IF NOT EXISTS `t_gn_approvalhistory` (
  `ApprovalHistoryId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned NOT NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `ApprovalItemId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_GN_ApprovalItem].ApprovalItemId',
  `CreatedById` int(10) unsigned NOT NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `ApprovalOldValue` varchar(100) NOT NULL,
  `ApprovalNewValue` varchar(100) NOT NULL,
  `ApprovalApprovedFlag` tinyint(1) unsigned NOT NULL default '0' COMMENT '0 = No; 1 = Yes',
  `ApprovalCreatedTs` timestamp NOT NULL default '0000-00-00 00:00:00' on update CURRENT_TIMESTAMP,
  `ApprovalUpdatedTs` timestamp NOT NULL default '0000-00-00 00:00:00',
  `ApprovePhoneType` tinyint(2) default '0',
  PRIMARY KEY  (`ApprovalHistoryId`),
  KEY `FK_ApprovalHistory_CustomerId` (`CustomerId`),
  KEY `FK_ApprovalHistory_ApprovalItemId` (`ApprovalItemId`),
  KEY `FK_ApprovalHistory_CreatedById` (`CreatedById`),
  KEY `FK_ApprovalHistory_UpdatedById` (`UpdatedById`),
  CONSTRAINT `FK_ApprovalHistory_ApprovalItemId` FOREIGN KEY (`ApprovalItemId`) REFERENCES `t_lk_approvalitem` (`ApprovalItemId`),
  CONSTRAINT `FK_ApprovalHistory_CreatedById` FOREIGN KEY (`CreatedById`) REFERENCES `tms_agent` (`UserId`),
  CONSTRAINT `FK_ApprovalHistory_CustomerId` FOREIGN KEY (`CustomerId`) REFERENCES `t_gn_customer` (`CustomerId`),
  CONSTRAINT `FK_ApprovalHistory_UpdatedById` FOREIGN KEY (`UpdatedById`) REFERENCES `tms_agent` (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='This is an Approval History table which holds history of app';

-- Dumping data for table ajmidb.t_gn_approvalhistory: ~3 rows (approximately)
DELETE FROM `t_gn_approvalhistory`;
/*!40000 ALTER TABLE `t_gn_approvalhistory` DISABLE KEYS */;
INSERT INTO `t_gn_approvalhistory` (`ApprovalHistoryId`, `CustomerId`, `ApprovalItemId`, `CreatedById`, `UpdatedById`, `ApprovalOldValue`, `ApprovalNewValue`, `ApprovalApprovedFlag`, `ApprovalCreatedTs`, `ApprovalUpdatedTs`, `ApprovePhoneType`) VALUES
	(1, 3, 2, 7, NULL, 'NULL', '021320662189', 1, '2014-04-27 00:00:13', '2014-04-26 22:16:19', 2),
	(2, 3, 5, 7, NULL, 'NULL', '92092092092090', 1, '2014-04-27 00:00:09', '2014-04-26 22:52:18', 5),
	(3, 4, 3, 7, NULL, 'NULL', '018909098765', 0, '2014-04-27 01:38:25', '2014-04-27 00:38:25', 3);
/*!40000 ALTER TABLE `t_gn_approvalhistory` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_assignment
DROP TABLE IF EXISTS `t_gn_assignment`;
CREATE TABLE IF NOT EXISTS `t_gn_assignment` (
  `AssignId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned default NULL,
  `AssignAdmin` tinyint(3) unsigned default NULL,
  `AssignMgr` tinyint(3) unsigned default NULL,
  `AssignSpv` tinyint(3) unsigned default NULL,
  `AssignSelerId` tinyint(3) unsigned default NULL,
  `AssignDate` datetime default NULL,
  `AssignMode` enum('DIS','MOV','RLD') NOT NULL default 'DIS',
  `AssignBlock` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`AssignId`),
  UNIQUE KEY `CustomerId` (`CustomerId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_assignment: ~4 rows (approximately)
DELETE FROM `t_gn_assignment`;
/*!40000 ALTER TABLE `t_gn_assignment` DISABLE KEYS */;
INSERT INTO `t_gn_assignment` (`AssignId`, `CustomerId`, `AssignAdmin`, `AssignMgr`, `AssignSpv`, `AssignSelerId`, `AssignDate`, `AssignMode`, `AssignBlock`) VALUES
	(1, 1, 1, 9, 5, 7, '2014-04-17 15:54:11', 'DIS', 0),
	(2, 2, 2, 9, 5, 7, '2014-04-22 17:16:03', 'DIS', 0),
	(3, 3, 2, 9, 5, 7, '2014-04-22 17:16:03', 'DIS', 0),
	(4, 4, 2, 9, 5, 7, '2014-04-22 17:16:03', 'DIS', 0);
/*!40000 ALTER TABLE `t_gn_assignment` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_beneficiary
DROP TABLE IF EXISTS `t_gn_beneficiary`;
CREATE TABLE IF NOT EXISTS `t_gn_beneficiary` (
  `BeneficiaryId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned default NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `InsuredId` bigint(20) unsigned default NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `SalutationId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_GN_Salutation].SalutationId',
  `GenderId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_GN_Gender].GenderId',
  `IdentificationTypeId` tinyint(3) unsigned zerofill default NULL COMMENT 'Must match [T_GN_IdentificationType].IdentificationTypeId',
  `PremiumGroupId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_GN_PremiumGroup].PremiumGroupId',
  `RelationshipTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_GN_RelationshipType].RelationshipTypeId',
  `ProvinceId` tinyint(3) unsigned zerofill default NULL COMMENT 'Must match [T_GN_ProvinceId].ProvinceId',
  `CreatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `BeneficiaryFirstName` varchar(30) NOT NULL,
  `BeneficiaryLastName` varchar(30) NOT NULL,
  `BeneficieryPercentage` decimal(3,0) unsigned NOT NULL,
  `BeneficiaryDOB` date NOT NULL,
  `BeneficiaryIdentificationNum` varchar(20) NOT NULL,
  `BeneficiaryAddressLine1` varchar(60) NOT NULL,
  `BeneficiaryAddressLine2` varchar(60) NOT NULL,
  `BeneficiaryAddressLine3` varchar(60) NOT NULL,
  `BeneficiaryAddressLine4` varchar(60) NOT NULL,
  `BeneficiaryCity` varchar(20) NOT NULL,
  `BeneficiaryZipCode` varchar(10) NOT NULL,
  `BeneficiaryHomePhoneNum` varchar(30) NOT NULL,
  `BeneficiaryMobilePhoneNum` varchar(30) NOT NULL,
  `BeneficiaryWorkPhoneNum` varchar(30) NOT NULL,
  `BeneficiaryWorkExtPhoneNum` varchar(10) NOT NULL,
  `BeneficiaryFaxNum` varchar(30) NOT NULL,
  `BeneficiaryEmail` varchar(50) NOT NULL,
  `BeneficiaryCreatedTs` timestamp NOT NULL default '0000-00-00 00:00:00',
  `BeneficiaryUpdatedTs` timestamp NULL default NULL,
  PRIMARY KEY  (`BeneficiaryId`),
  KEY `FK_Beneficiary_CustomerId` (`CustomerId`),
  KEY `FK_Beneficiary_SalutationId` (`SalutationId`),
  KEY `FK_Beneficiary_GenderId` (`GenderId`),
  KEY `FK_Beneficiary_IdentificationTypeId` (`IdentificationTypeId`),
  KEY `FK_Beneficiary_PremiumGroupId` (`PremiumGroupId`),
  KEY `FK_Beneficiary_ProvinceId` (`ProvinceId`),
  KEY `FK_Beneficiary_CreatedById` (`CreatedById`),
  KEY `FK_Beneficiary_UpdatedById` (`UpdatedById`),
  KEY `FK_Beneficiary_RelationshipTypeId` (`RelationshipTypeId`),
  KEY `InsuredId` (`InsuredId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Beneficiary table which holds beneficiary informat';

-- Dumping data for table ajmidb.t_gn_beneficiary: ~0 rows (approximately)
DELETE FROM `t_gn_beneficiary`;
/*!40000 ALTER TABLE `t_gn_beneficiary` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_beneficiary` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_bucket_customers
DROP TABLE IF EXISTS `t_gn_bucket_customers`;
CREATE TABLE IF NOT EXISTS `t_gn_bucket_customers` (
  `CustomerId` bigint(20) unsigned NOT NULL auto_increment,
  `FTP_DataId` int(20) NOT NULL default '0',
  `CustomerNumber` varchar(64) NOT NULL COMMENT 'Two-digit prefix must match two-digit of the current year',
  `GenderId` varchar(5) default NULL COMMENT 'Must match [T_LK_Gender].GenderId',
  `CardTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CardType].CardTypeId',
  `IdentificationTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_IdentificationType].IdentificationTypeId',
  `UploadedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `CustomerFirstName` varchar(50) NOT NULL,
  `CustomerLastName` varchar(50) default NULL,
  `CustomerDOB` date default NULL,
  `CustomerIdentificationNum` varchar(20) default NULL,
  `CustomerAddressLine1` varchar(60) default NULL,
  `CustomerAddressLine2` varchar(60) default NULL,
  `CustomerAddressLine3` varchar(60) default NULL,
  `CustomerAddressLine4` varchar(60) default NULL,
  `CustomerCity` varchar(20) default NULL,
  `CustomerZipCode` varchar(10) default NULL,
  `CustomerHomePhoneNum` varchar(30) default NULL,
  `CustomerMobilePhoneNum` varchar(30) default NULL,
  `CustomerWorkPhoneNum` varchar(30) default NULL,
  `CustomerWorkExtPhoneNum` varchar(10) default NULL,
  `CustomerFaxNum` varchar(30) default NULL,
  `CustomerEmail` varchar(50) default NULL,
  `CustomerOfficeName` varchar(50) default NULL,
  `CustomerOfficeLine1` varchar(50) default NULL,
  `CustomerOfficeLine2` varchar(50) default NULL,
  `CustomerOfficeLine3` varchar(50) default NULL,
  `CustomerOfficeLine4` varchar(50) default NULL,
  `CustomerOfficeCity` varchar(50) default NULL,
  `CustomerOfficeZipCode` varchar(50) default NULL,
  `CustomerArea` varchar(50) default NULL,
  `CustomerCardType` varchar(200) default NULL,
  `CustomerUploadedTs` datetime default NULL,
  `CustomerUpdatedTs` datetime default NULL,
  `FTP_UploadId` int(11) unsigned default NULL,
  `CustomerDeleted` tinyint(2) unsigned NOT NULL default '0' COMMENT '1=deleted, 0=not deleted',
  `AssignCampaign` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`CustomerId`),
  KEY `idx` (`FTP_DataId`,`CustomerUpdatedTs`,`FTP_UploadId`),
  KEY `FTP_DataId` (`CustomerDeleted`,`FTP_DataId`),
  KEY `idx2` (`CustomerDeleted`),
  KEY `idx3` (`CustomerNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='This is a Customer table which holds customer information.';

-- Dumping data for table ajmidb.t_gn_bucket_customers: ~7 rows (approximately)
DELETE FROM `t_gn_bucket_customers`;
/*!40000 ALTER TABLE `t_gn_bucket_customers` DISABLE KEYS */;
INSERT INTO `t_gn_bucket_customers` (`CustomerId`, `FTP_DataId`, `CustomerNumber`, `GenderId`, `CardTypeId`, `IdentificationTypeId`, `UploadedById`, `UpdatedById`, `CustomerFirstName`, `CustomerLastName`, `CustomerDOB`, `CustomerIdentificationNum`, `CustomerAddressLine1`, `CustomerAddressLine2`, `CustomerAddressLine3`, `CustomerAddressLine4`, `CustomerCity`, `CustomerZipCode`, `CustomerHomePhoneNum`, `CustomerMobilePhoneNum`, `CustomerWorkPhoneNum`, `CustomerWorkExtPhoneNum`, `CustomerFaxNum`, `CustomerEmail`, `CustomerOfficeName`, `CustomerOfficeLine1`, `CustomerOfficeLine2`, `CustomerOfficeLine3`, `CustomerOfficeLine4`, `CustomerOfficeCity`, `CustomerOfficeZipCode`, `CustomerArea`, `CustomerCardType`, `CustomerUploadedTs`, `CustomerUpdatedTs`, `FTP_UploadId`, `CustomerDeleted`, `AssignCampaign`) VALUES
	(1, 0, '001002021', NULL, NULL, NULL, 2, NULL, 'RAHMAT 1', 'RAHMAT 1', '1986-01-01', '0909090909099090', 'ADDRSS1', 'ADDRSS1', 'ADDRSS1', 'ADDRSS1', 'DEPOK', '16421', '0213206189', '0213206189', '0213206189', '0213206189', '0213206189', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 1),
	(2, 0, '001002022', NULL, NULL, NULL, 2, NULL, 'RAHMAT 2', 'RAHMAT 2', '1986-01-02', '0909090909099090', 'ADDRSS2', 'ADDRSS2', 'ADDRSS2', 'ADDRSS2', 'DEPOK', '16421', '0213206190', '0213206190', '0213206190', '0213206190', '0213206190', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'MASTER', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 1),
	(3, 0, '001002023', NULL, NULL, NULL, 2, NULL, 'RAHMAT 3', 'RAHMAT 3', '1986-01-03', '0909090909099090', 'ADDRSS3', 'ADDRSS3', 'ADDRSS3', 'ADDRSS3', 'DEPOK', '16421', '0213206191', '0213206191', '0213206191', '0213206191', '0213206191', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 1),
	(4, 0, '001002024', NULL, NULL, NULL, 2, NULL, 'RAHMAT 4', 'RAHMAT 4', '1986-01-04', '0909090909099090', 'ADDRSS4', 'ADDRSS4', 'ADDRSS4', 'ADDRSS4', 'DEPOK', '16421', '0213206192', '0213206192', '0213206192', '0213206192', '0213206192', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'MASTER', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 0),
	(5, 0, '001002025', NULL, NULL, NULL, 2, NULL, 'RAHMAT 5', 'RAHMAT 5', '1986-01-05', '0909090909099090', 'ADDRSS5', 'ADDRSS5', 'ADDRSS5', 'ADDRSS5', 'DEPOK', '16421', '0213206193', '0213206193', '0213206193', '0213206193', '0213206193', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 0),
	(6, 0, '001002026', NULL, NULL, NULL, 2, NULL, 'RAHMAT 6', 'RAHMAT 6', '1986-01-06', '0909090909099090', 'ADDRSS6', 'ADDRSS6', 'ADDRSS6', 'ADDRSS6', 'DEPOK', '16421', '0213206194', '0213206194', '0213206194', '0213206194', '0213206194', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'MASTER', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 0),
	(7, 0, '001002027', NULL, NULL, NULL, 2, NULL, 'RAHMAT 7', 'RAHMAT 7', '1986-01-07', '0909090909099090', 'ADDRSS7', 'ADDRSS7', 'ADDRSS7', 'ADDRSS7', 'DEPOK', '16421', '0213206195', '0213206195', '0213206195', '0213206195', '0213206195', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '0000-00-00 00:00:00', 3, 0, 0);
/*!40000 ALTER TABLE `t_gn_bucket_customers` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_callhistory
DROP TABLE IF EXISTS `t_gn_callhistory`;
CREATE TABLE IF NOT EXISTS `t_gn_callhistory` (
  `CallHistoryId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned NOT NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `CallReasonId` int(10) unsigned NOT NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
  `CreatedById` int(10) unsigned NOT NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `CallHistoryCallDate` datetime default NULL,
  `CallNumber` varchar(15) default NULL,
  `CallHistoryNotes` text,
  `CallHistoryCreatedTs` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `CallHistoryUpdatedTs` timestamp NULL default NULL,
  PRIMARY KEY  (`CallHistoryId`),
  KEY `idx_CallHistoryCreatedTs` (`CallHistoryCreatedTs`),
  KEY `idx_customerid` (`CustomerId`),
  KEY `idx` (`CallReasonId`,`CallHistoryCreatedTs`,`CustomerId`,`CreatedById`,`UpdatedById`),
  KEY `idx_CreatedById` (`CreatedById`),
  KEY `idx2` (`CallHistoryCreatedTs`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 COMMENT='This is a Call History table which holds customers'' call his';

-- Dumping data for table ajmidb.t_gn_callhistory: ~15 rows (approximately)
DELETE FROM `t_gn_callhistory`;
/*!40000 ALTER TABLE `t_gn_callhistory` DISABLE KEYS */;
INSERT INTO `t_gn_callhistory` (`CallHistoryId`, `CustomerId`, `CallReasonId`, `CreatedById`, `UpdatedById`, `CallHistoryCallDate`, `CallNumber`, `CallHistoryNotes`, `CallHistoryCreatedTs`, `CallHistoryUpdatedTs`) VALUES
	(1, 1, 2, 7, NULL, '2014-04-17 15:56:01', '902902020290', 'DEFDFFDF', '2014-04-17 15:56:01', NULL),
	(2, 1, 5, 7, NULL, '2014-04-22 07:10:35', '902902020290', 'SDFSAD', '2014-04-22 07:10:35', NULL),
	(3, 2, 2, 7, NULL, '2014-04-22 17:25:52', '0213206189', NULL, '2014-04-22 17:25:52', NULL),
	(4, 2, 5, 7, NULL, '2014-04-23 13:57:59', '0213206188', NULL, '2014-04-23 13:57:59', NULL),
	(5, 3, 3, 7, NULL, '2014-04-23 14:26:28', '0213206190', 'SDASD', '2014-04-23 14:26:28', NULL),
	(9, 2, 5, 11, 11, NULL, '0213206189', 'OK SAYA PENDING DULU NIH DATANYA', '2014-04-25 14:04:39', '2014-04-25 14:38:55'),
	(10, 2, 5, 11, 11, NULL, '0213206189', 'EFFDSFDSF', '2014-04-25 14:03:05', '2014-04-25 15:03:05'),
	(11, 2, 5, 11, 11, NULL, '0213206189', 'EFFDSFDSF', '2014-04-25 14:04:08', '2014-04-25 15:04:08'),
	(12, 2, 5, 11, 11, NULL, '0213206189', '', '2014-04-25 14:15:03', '2014-04-25 15:15:03'),
	(13, 2, 13, 7, NULL, '2014-04-25 23:22:05', '0213206188', 'OK SAYA UDAH KONFIR M', '2014-04-25 23:22:05', NULL),
	(14, 2, 13, 7, NULL, '2014-04-25 23:39:27', NULL, 'ASASAS', '2014-04-25 23:39:27', NULL),
	(15, 2, 13, 7, NULL, '2014-04-25 23:39:37', NULL, 'ASASAS', '2014-04-25 23:39:37', NULL),
	(16, 2, 13, 7, NULL, '2014-04-25 23:41:08', '0213206189', NULL, '2014-04-25 23:41:08', NULL),
	(17, 2, 13, 7, NULL, '2014-04-26 00:04:46', '0213206188', 'OPOPOP', '2014-04-26 00:04:46', NULL),
	(18, 2, 13, 11, 11, NULL, '0213206189', 'OK CLOSE', '2014-04-26 00:09:00', '2014-04-26 01:09:00');
/*!40000 ALTER TABLE `t_gn_callhistory` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_campaign
DROP TABLE IF EXISTS `t_gn_campaign`;
CREATE TABLE IF NOT EXISTS `t_gn_campaign` (
  `CampaignId` int(10) unsigned NOT NULL auto_increment,
  `CampaignTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CampaignType].CampaignTypeId',
  `BuildTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_BuildType].BuildTypeId',
  `CategoryId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_Category].CategoryId',
  `CignaCampTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CignaCampType].CignaCampTypeId',
  `CignaSystemId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CignaSystem].CignaSystemId',
  `ReUploadReasonId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_ReUploadReason].ReUploadReasonId',
  `CampaignNumber` char(10) NOT NULL COMMENT 'Prefix = 11',
  `CampaignName` varchar(100) NOT NULL,
  `CampaignStartDate` datetime NOT NULL,
  `CampaignEndDate` datetime NOT NULL,
  `CampaignExtendedDate` datetime default NULL,
  `CampaignReUploadFlag` tinyint(1) default '0' COMMENT '0 = No; 1 = Yes',
  `CampaignDataFileName` varchar(200) default NULL,
  `CampaignStatusFlag` tinyint(1) NOT NULL COMMENT '0 = Inactive; 1 = Active',
  `CampaignRowData` int(5) NOT NULL,
  `CampaignIsFollowUp` tinyint(3) unsigned NOT NULL default '0' COMMENT '0=not follow, 1=follow',
  `OutboundGoalsId` tinyint(3) unsigned NOT NULL default '2' COMMENT '0=not follow, 1=follow',
  `DirectMethod` tinyint(3) unsigned NOT NULL default '0' COMMENT '0=No, 1=Direct, 2=manual',
  `DirectAction` tinyint(2) unsigned NOT NULL default '0' COMMENT '0=No, 1=Direct, 2=manual',
  `DID` tinyint(2) unsigned NOT NULL default '0' COMMENT '0=No, 1=Direct, 2=manual',
  `AvailCampaignId` tinyint(3) unsigned NOT NULL default '0' COMMENT '0=No, 1=Direct, 2=manual',
  PRIMARY KEY  (`CampaignId`),
  UNIQUE KEY `CampaignNumber` (`CampaignNumber`),
  KEY `FK_Campaign_CampaignTypeId` (`CampaignTypeId`),
  KEY `FK_Campaign_BuildTypeId` (`BuildTypeId`),
  KEY `FK_Campaign_CategoryId` (`CategoryId`),
  KEY `FK_Campaign_CignaCampTypeId` (`CignaCampTypeId`),
  KEY `FK_Campaign_CignaSystemId` (`CignaSystemId`),
  KEY `FK_Campaign_ReUploadReasonId` (`ReUploadReasonId`),
  KEY `CampaignStatusFlag` (`CampaignStatusFlag`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='This is a Campaign table which holds campaign information.';

-- Dumping data for table ajmidb.t_gn_campaign: ~3 rows (approximately)
DELETE FROM `t_gn_campaign`;
/*!40000 ALTER TABLE `t_gn_campaign` DISABLE KEYS */;
INSERT INTO `t_gn_campaign` (`CampaignId`, `CampaignTypeId`, `BuildTypeId`, `CategoryId`, `CignaCampTypeId`, `CignaSystemId`, `ReUploadReasonId`, `CampaignNumber`, `CampaignName`, `CampaignStartDate`, `CampaignEndDate`, `CampaignExtendedDate`, `CampaignReUploadFlag`, `CampaignDataFileName`, `CampaignStatusFlag`, `CampaignRowData`, `CampaignIsFollowUp`, `OutboundGoalsId`, `DirectMethod`, `DirectAction`, `DID`, `AvailCampaignId`) VALUES
	(1, NULL, NULL, 2, NULL, NULL, NULL, '1400001', 'CAMPAIGN2014', '2014-03-08 00:46:12', '2015-03-19 00:00:00', NULL, 0, NULL, 1, 0, 0, 1, 1, 2, 0, 2),
	(2, NULL, NULL, 1, NULL, NULL, NULL, '1400002', 'CAMPAIGN2015', '2014-03-08 00:47:30', '2014-03-31 00:00:00', NULL, 0, NULL, 1, 0, 0, 2, 0, 0, 0, 0),
	(5, NULL, NULL, 1, NULL, NULL, NULL, '1400003', 'TEST LAGI', '2014-04-11 02:41:16', '2014-04-11 00:00:00', NULL, 0, NULL, 1, 0, 0, 2, 0, 0, 1, 0);
/*!40000 ALTER TABLE `t_gn_campaign` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_campaigngroup
DROP TABLE IF EXISTS `t_gn_campaigngroup`;
CREATE TABLE IF NOT EXISTS `t_gn_campaigngroup` (
  `CampaignGroupId` int(10) unsigned NOT NULL auto_increment,
  `CampaignGroupCode` varchar(50) NOT NULL,
  `CampaignGroupName` varchar(50) NOT NULL,
  `CampaignGroupStatusFlag` tinyint(1) NOT NULL COMMENT '0 = Inactive; 1 = Active',
  PRIMARY KEY  (`CampaignGroupId`),
  UNIQUE KEY `CampaignGroupCode` (`CampaignGroupCode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Campaign Group table which holds campaign groups/c';

-- Dumping data for table ajmidb.t_gn_campaigngroup: ~2 rows (approximately)
DELETE FROM `t_gn_campaigngroup`;
/*!40000 ALTER TABLE `t_gn_campaigngroup` DISABLE KEYS */;
INSERT INTO `t_gn_campaigngroup` (`CampaignGroupId`, `CampaignGroupCode`, `CampaignGroupName`, `CampaignGroupStatusFlag`) VALUES
	(1, 'TEST_CORE', 'TEST_CORE', 1),
	(2, 'TEST_CORES2', 'TEST_CORES2', 1);
/*!40000 ALTER TABLE `t_gn_campaigngroup` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_campaignproduct
DROP TABLE IF EXISTS `t_gn_campaignproduct`;
CREATE TABLE IF NOT EXISTS `t_gn_campaignproduct` (
  `CampaignProductId` int(10) unsigned NOT NULL auto_increment,
  `CampaignId` int(10) unsigned NOT NULL COMMENT 'Must match [T_LK_Campaign].CampaignId',
  `ProductId` int(10) unsigned NOT NULL COMMENT 'Must match [T_LK_Product].ProductId',
  PRIMARY KEY  (`CampaignProductId`),
  KEY `FK_CampaignProduct_CampaignId` (`CampaignId`),
  KEY `FK_CampaignProduct_ProductId` (`ProductId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='This is a Campaign - Product association table which holds p';

-- Dumping data for table ajmidb.t_gn_campaignproduct: ~4 rows (approximately)
DELETE FROM `t_gn_campaignproduct`;
/*!40000 ALTER TABLE `t_gn_campaignproduct` DISABLE KEYS */;
INSERT INTO `t_gn_campaignproduct` (`CampaignProductId`, `CampaignId`, `ProductId`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(5, 5, 1),
	(6, 5, 2);
/*!40000 ALTER TABLE `t_gn_campaignproduct` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_campaign_transaction
DROP TABLE IF EXISTS `t_gn_campaign_transaction`;
CREATE TABLE IF NOT EXISTS `t_gn_campaign_transaction` (
  `Id` int(10) NOT NULL auto_increment,
  `DIDCampaign` int(10) default NULL,
  `CampaignId` int(10) default NULL,
  PRIMARY KEY  (`Id`),
  KEY `DIDCampaign` (`DIDCampaign`,`CampaignId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_campaign_transaction: 4 rows
DELETE FROM `t_gn_campaign_transaction`;
/*!40000 ALTER TABLE `t_gn_campaign_transaction` DISABLE KEYS */;
INSERT INTO `t_gn_campaign_transaction` (`Id`, `DIDCampaign`, `CampaignId`) VALUES
	(1, 1, 6),
	(2, 2, 6),
	(3, 3, 7),
	(4, 4, 7);
/*!40000 ALTER TABLE `t_gn_campaign_transaction` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_customer
DROP TABLE IF EXISTS `t_gn_customer`;
CREATE TABLE IF NOT EXISTS `t_gn_customer` (
  `CustomerId` bigint(20) unsigned NOT NULL auto_increment,
  `CustomerNumber` varchar(20) NOT NULL COMMENT 'Two-digit prefix must match two-digit of the current year',
  `CampaignId` int(10) unsigned NOT NULL COMMENT 'Must match [T_GN_Campaign].CampaignId',
  `SalutationId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Salutation].SalutationId',
  `GenderId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Gender].GenderId',
  `CardTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CardType].CardTypeId',
  `IdentificationTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_IdentificationType].IdentificationTypeId',
  `ProvinceId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Province].ProvinceId',
  `SponsorId` tinyint(3) unsigned default '1',
  `CallReasonId` int(10) unsigned default NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
  `CallReasonQue` int(10) unsigned default NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
  `QueueId` int(10) unsigned default NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
  `SellerId` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `UploadedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `CustomerStatus` tinyint(10) unsigned default NULL COMMENT '1=nikah , 0=belum menikah',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `CustomerPolicyNumber` varchar(20) default NULL COMMENT 'Two-digit prefix must match [T_GN_Product].ProductPolicyNumPrefix',
  `CustomerPolicyEffectiveDate` datetime default NULL,
  `CustomerFirstName` varchar(50) NOT NULL,
  `CustomerLastName` varchar(50) default NULL,
  `CustomerDOB` date default NULL,
  `CustomerIdentificationNum` varchar(20) default NULL,
  `CustomerAddressLine1` varchar(60) default NULL,
  `CustomerAddressLine2` varchar(60) default NULL,
  `CustomerAddressLine3` varchar(60) default NULL,
  `CustomerAddressLine4` varchar(60) default NULL,
  `CustomerCity` varchar(20) default NULL,
  `CustomerZipCode` varchar(10) default NULL,
  `CustomerHomePhoneNum` varchar(30) default NULL,
  `CustomerMobilePhoneNum` varchar(30) default NULL,
  `CustomerWorkPhoneNum` varchar(30) default NULL,
  `CustomerWorkFaxNum` varchar(30) default NULL,
  `CustomerWorkExtPhoneNum` varchar(10) default NULL,
  `CustomerFaxNum` varchar(30) default NULL,
  `CustomerEmail` varchar(50) default NULL,
  `CustomerOfficeName` varchar(50) default NULL,
  `CustomerOfficeLine1` varchar(50) default NULL,
  `CustomerOfficeLine2` varchar(50) default NULL,
  `CustomerOfficeLine3` varchar(50) default NULL,
  `CustomerOfficeLine4` varchar(50) default NULL,
  `CustomerOfficeCity` varchar(50) default NULL,
  `CustomerOfficeZipCode` varchar(50) default NULL,
  `CustomerArea` varchar(50) default NULL,
  `CustomerCardType` varchar(32) default NULL,
  `CustomerUploadedTs` timestamp NULL default NULL,
  `CustomerUpdatedTs` timestamp NULL default NULL,
  `CustomerRejectedDate` datetime default NULL,
  `InitDays` int(11) NOT NULL default '0',
  `QaProsess` tinyint(4) default '0' COMMENT '1=prosess, 0=No Prosess',
  `CustomerCcNumber` varchar(50) default '0' COMMENT '1=prosess, 0=No Prosess',
  `CustomerExpiredCard` varchar(10) default '0' COMMENT '1=prosess, 0=No Prosess',
  PRIMARY KEY  (`CustomerId`,`CustomerNumber`,`CampaignId`),
  KEY `KeyIdx` (`CampaignId`,`CustomerNumber`,`CallReasonId`,`SellerId`),
  KEY `idx2` (`CallReasonId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This is a Customer table which holds customer information.';

-- Dumping data for table ajmidb.t_gn_customer: ~4 rows (approximately)
DELETE FROM `t_gn_customer`;
/*!40000 ALTER TABLE `t_gn_customer` DISABLE KEYS */;
INSERT INTO `t_gn_customer` (`CustomerId`, `CustomerNumber`, `CampaignId`, `SalutationId`, `GenderId`, `CardTypeId`, `IdentificationTypeId`, `ProvinceId`, `SponsorId`, `CallReasonId`, `CallReasonQue`, `QueueId`, `SellerId`, `UploadedById`, `CustomerStatus`, `UpdatedById`, `CustomerPolicyNumber`, `CustomerPolicyEffectiveDate`, `CustomerFirstName`, `CustomerLastName`, `CustomerDOB`, `CustomerIdentificationNum`, `CustomerAddressLine1`, `CustomerAddressLine2`, `CustomerAddressLine3`, `CustomerAddressLine4`, `CustomerCity`, `CustomerZipCode`, `CustomerHomePhoneNum`, `CustomerMobilePhoneNum`, `CustomerWorkPhoneNum`, `CustomerWorkFaxNum`, `CustomerWorkExtPhoneNum`, `CustomerFaxNum`, `CustomerEmail`, `CustomerOfficeName`, `CustomerOfficeLine1`, `CustomerOfficeLine2`, `CustomerOfficeLine3`, `CustomerOfficeLine4`, `CustomerOfficeCity`, `CustomerOfficeZipCode`, `CustomerArea`, `CustomerCardType`, `CustomerUploadedTs`, `CustomerUpdatedTs`, `CustomerRejectedDate`, `InitDays`, `QaProsess`, `CustomerCcNumber`, `CustomerExpiredCard`) VALUES
	(1, '001002021', 2, NULL, 1, NULL, NULL, NULL, 1, 7, NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, 'ROHAMTTULLAH', NULL, NULL, NULL, 'Customer Address1', 'Customer Address2', NULL, NULL, 'Depok', NULL, '0213206176', '0213206189', '902902020290', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-04-22 07:10:35', NULL, 0, 0, '89898998989', '0'),
	(2, '001002021', 2, NULL, 1, 1, NULL, NULL, 1, 7, NULL, NULL, 7, 2, NULL, NULL, NULL, NULL, 'RAHMAT 1', 'RAHMAT 1', '1986-01-01', '0909090909099090', 'ADDRSS1', 'ADDRSS1', 'ADDRSS1', 'ADDRSS1', 'DEPOK', '16421', '0213206188', '0213206189', '0213206110', NULL, '0213206189', '0213206189', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '2014-04-26 01:09:00', NULL, 0, 0, '0', '0'),
	(3, '001002022', 2, NULL, 0, 0, NULL, NULL, 1, 3, NULL, NULL, 7, 2, NULL, NULL, NULL, NULL, 'RAHMAT 2', 'RAHMAT 2', '1986-01-02', '0909090909099090', 'ADDRSS2', 'ADDRSS2', 'ADDRSS2', 'ADDRSS2', 'DEPOK', '16421', '0213206190', '0213206190', '0213206190', NULL, '0213206190', '0213206190', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'MASTER', '2014-04-22 17:14:44', '2014-04-23 14:26:28', NULL, 0, 0, '0', '0'),
	(4, '001002023', 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, 'RAHMAT 3', 'RAHMAT 3', '1986-01-03', '0909090909099090', 'ADDRSS3', 'ADDRSS3', 'ADDRSS3', 'ADDRSS3', 'DEPOK', '16421', '0213206191', '0213206191', '0213206191', NULL, '0213206191', '0213206191', 'jombi_par@yahoo.com', 'Razaki', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'MAMPANG', 'JAKSEL', '16421', 'DEPOK', 'VISA', '2014-04-22 17:14:44', '0000-00-00 00:00:00', NULL, 0, 0, '0', '0');
/*!40000 ALTER TABLE `t_gn_customer` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_customerapplication
DROP TABLE IF EXISTS `t_gn_customerapplication`;
CREATE TABLE IF NOT EXISTS `t_gn_customerapplication` (
  `ApplicationId` bigint(20) unsigned NOT NULL auto_increment,
  `ProductId` int(10) unsigned default NULL,
  `CustomerId` int(10) unsigned default NULL,
  `CustomerName` varchar(100) default NULL,
  `AutoNumber` bigint(15) unsigned default NULL,
  `ApplicationNumber` varchar(15) default NULL,
  `PolicyNumber` varchar(64) default NULL,
  `CreatedTs` datetime default NULL,
  `CreateIdByUserId` int(10) default NULL,
  PRIMARY KEY  (`ApplicationId`),
  UNIQUE KEY `CustomerId` (`CustomerId`),
  KEY `keyApps` (`ProductId`,`CustomerId`,`PolicyNumber`),
  KEY `Uniq` (`CustomerId`),
  KEY `ApplicationId` (`ApplicationId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_customerapplication: ~0 rows (approximately)
DELETE FROM `t_gn_customerapplication`;
/*!40000 ALTER TABLE `t_gn_customerapplication` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_customerapplication` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_cutoffdate
DROP TABLE IF EXISTS `t_gn_cutoffdate`;
CREATE TABLE IF NOT EXISTS `t_gn_cutoffdate` (
  `CuttoffDateId` int(10) unsigned NOT NULL auto_increment,
  `CutoffDate` date NOT NULL,
  PRIMARY KEY  (`CuttoffDateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Cutoff Date table which holds cutoff dates in cale';

-- Dumping data for table ajmidb.t_gn_cutoffdate: ~0 rows (approximately)
DELETE FROM `t_gn_cutoffdate`;
/*!40000 ALTER TABLE `t_gn_cutoffdate` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_cutoffdate` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_dependent
DROP TABLE IF EXISTS `t_gn_dependent`;
CREATE TABLE IF NOT EXISTS `t_gn_dependent` (
  `DependentId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned NOT NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `SalutationId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_Salutation].SalutationId',
  `GenderId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_Gender].GenderId',
  `IdentificationTypeId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_IdentificationType].IdentificationTypeId',
  `PremiumGroupId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_PremiumGroup].PremiumGroupCodeId',
  `RelationshipTypeId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_RelationshipType].RelationshipTypeId',
  `ProvinceId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_LK_Province].ProvinceId',
  `CreatedById` int(10) unsigned NOT NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `DependentFirstName` varchar(50) NOT NULL,
  `DependentLastName` varchar(50) NOT NULL,
  `DependentDOB` date NOT NULL,
  `DependentIdentificationNum` varchar(20) NOT NULL,
  `DependentAddressLine1` varchar(60) NOT NULL,
  `DependentAddressLine2` varchar(60) NOT NULL,
  `DependentAddressLine3` varchar(60) NOT NULL,
  `DependentAddressLine4` varchar(60) NOT NULL,
  `DependentCity` varchar(20) NOT NULL,
  `DependentZipCode` varchar(10) NOT NULL,
  `DependentHomePhoneNum` varchar(30) NOT NULL,
  `DependentMobilePhoneNum` varchar(30) NOT NULL,
  `DependentWorkPhoneNum` varchar(30) NOT NULL,
  `DependentWorkExtPhoneNum` varchar(10) NOT NULL,
  `DependentFaxNum` varchar(30) NOT NULL,
  `DependentEmail` varchar(50) NOT NULL,
  `DependentCreatedTs` timestamp NOT NULL default '0000-00-00 00:00:00',
  `DependentUpdatedTs` timestamp NULL default NULL,
  PRIMARY KEY  (`DependentId`),
  KEY `FK_Dependent_CustomerId` (`CustomerId`),
  KEY `FK_Dependent_SalutationId` (`SalutationId`),
  KEY `FK_Dependent_GenderId` (`GenderId`),
  KEY `FK_Dependent_IdentificationTypeId` (`IdentificationTypeId`),
  KEY `FK_Dependent_PremiumGroupId` (`PremiumGroupId`),
  KEY `FK_Dependent_ProvinceId` (`ProvinceId`),
  KEY `FK_Dependent_CreatedById` (`CreatedById`),
  KEY `FK_Dependent_UpdatedById` (`UpdatedById`),
  KEY `FK_Dependent_RelationshipTypeId` (`RelationshipTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Dependent table which holds dependent information.';

-- Dumping data for table ajmidb.t_gn_dependent: ~0 rows (approximately)
DELETE FROM `t_gn_dependent`;
/*!40000 ALTER TABLE `t_gn_dependent` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_dependent` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_detail_template
DROP TABLE IF EXISTS `t_gn_detail_template`;
CREATE TABLE IF NOT EXISTS `t_gn_detail_template` (
  `Id` int(10) unsigned NOT NULL auto_increment,
  `UploadTmpId` int(10) NOT NULL default '0',
  `UploadColsName` varchar(100) NOT NULL default '',
  `UploadColsAlias` varchar(100) default NULL,
  `UploadColsOrder` int(10) default NULL,
  `UploadsColsFunction` varchar(50) default NULL,
  PRIMARY KEY  (`Id`,`UploadTmpId`,`UploadColsName`),
  KEY `UploadTmpId` (`UploadTmpId`),
  KEY `UploadColsName` (`UploadColsName`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_detail_template: 55 rows
DELETE FROM `t_gn_detail_template`;
/*!40000 ALTER TABLE `t_gn_detail_template` DISABLE KEYS */;
INSERT INTO `t_gn_detail_template` (`Id`, `UploadTmpId`, `UploadColsName`, `UploadColsAlias`, `UploadColsOrder`, `UploadsColsFunction`) VALUES
	(1, 1, 'CustomerNumber', 'CustomerNumber', NULL, NULL),
	(2, 1, 'CustomerFirstName', 'CustomerFirstName', NULL, NULL),
	(3, 1, 'CustomerLastName', 'CustomerLastName', NULL, NULL),
	(4, 1, 'CustomerDOB', 'CustomerDOB', NULL, NULL),
	(5, 1, 'CustomerIdentificationNum', 'CustomerIdentificationNum', NULL, NULL),
	(6, 1, 'CustomerAddressLine1', 'CustomerAddressLine1', NULL, NULL),
	(7, 1, 'CustomerAddressLine2', 'CustomerAddressLine2', NULL, NULL),
	(8, 1, 'CustomerAddressLine3', 'CustomerAddressLine3', NULL, NULL),
	(9, 1, 'CustomerAddressLine4', 'CustomerAddressLine4', NULL, NULL),
	(10, 1, 'CustomerCity', 'CustomerCity', NULL, NULL),
	(11, 1, 'CustomerZipCode', 'CustomerZipCode', NULL, NULL),
	(12, 1, 'CustomerHomePhoneNum', 'CustomerHomePhoneNum', NULL, NULL),
	(13, 1, 'CustomerMobilePhoneNum', 'CustomerMobilePhoneNum', NULL, NULL),
	(14, 1, 'CustomerWorkPhoneNum', 'CustomerWorkPhoneNum', NULL, NULL),
	(15, 1, 'CustomerWorkExtPhoneNum', 'CustomerWorkExtPhoneNum', NULL, NULL),
	(16, 1, 'CustomerFaxNum', 'CustomerFaxNum', NULL, NULL),
	(17, 1, 'CustomerEmail', 'CustomerEmail', NULL, NULL),
	(18, 1, 'CustomerOfficeName', 'CustomerOfficeName', NULL, NULL),
	(19, 1, 'CustomerOfficeLine1', 'CustomerOfficeLine1', NULL, NULL),
	(20, 1, 'CustomerOfficeLine2', 'CustomerOfficeLine2', NULL, NULL),
	(21, 1, 'CustomerOfficeLine3', 'CustomerOfficeLine3', NULL, NULL),
	(22, 1, 'CustomerOfficeLine4', 'CustomerOfficeLine4', NULL, NULL),
	(23, 1, 'CustomerOfficeCity', 'CustomerOfficeCity', NULL, NULL),
	(24, 1, 'CustomerOfficeZipCode', 'CustomerOfficeZipCode', NULL, NULL),
	(25, 1, 'CustomerArea', 'CustomerArea', NULL, NULL),
	(26, 1, 'CustomerCardType', 'CustomerCardType', NULL, NULL),
	(27, 1, 'CustomerUploadedTs', 'CustomerUploadedTs', NULL, NULL),
	(28, 1, 'CustomerUpdatedTs', 'CustomerUpdatedTs', NULL, NULL),
	(29, 2, 'CustomerNumber', 'CustomerNumber', NULL, NULL),
	(30, 2, 'IdentificationTypeId', 'IdentificationTypeId', NULL, NULL),
	(31, 2, 'CustomerFirstName', 'CustomerFirstName', NULL, NULL),
	(32, 2, 'CustomerLastName', 'CustomerLastName', NULL, NULL),
	(33, 2, 'CustomerDOB', 'CustomerDOB', NULL, NULL),
	(34, 2, 'CustomerIdentificationNum', 'CustomerIdentificationNum', NULL, NULL),
	(35, 2, 'CustomerAddressLine1', 'CustomerAddressLine1', NULL, NULL),
	(36, 2, 'CustomerAddressLine2', 'CustomerAddressLine2', NULL, NULL),
	(37, 2, 'CustomerAddressLine3', 'CustomerAddressLine3', NULL, NULL),
	(38, 2, 'CustomerAddressLine4', 'CustomerAddressLine4', NULL, NULL),
	(39, 2, 'CustomerCity', 'CustomerCity', NULL, NULL),
	(40, 2, 'CustomerZipCode', 'CustomerZipCode', NULL, NULL),
	(41, 2, 'CustomerHomePhoneNum', 'CustomerHomePhoneNum', NULL, NULL),
	(42, 2, 'CustomerMobilePhoneNum', 'CustomerMobilePhoneNum', NULL, NULL),
	(43, 2, 'CustomerWorkPhoneNum', 'CustomerWorkPhoneNum', NULL, NULL),
	(44, 2, 'CustomerWorkExtPhoneNum', 'CustomerWorkExtPhoneNum', NULL, NULL),
	(45, 2, 'CustomerFaxNum', 'CustomerFaxNum', NULL, NULL),
	(46, 2, 'CustomerEmail', 'CustomerEmail', NULL, NULL),
	(47, 2, 'CustomerOfficeName', 'CustomerOfficeName', NULL, NULL),
	(48, 2, 'CustomerOfficeLine1', 'CustomerOfficeLine1', NULL, NULL),
	(49, 2, 'CustomerOfficeLine2', 'CustomerOfficeLine2', NULL, NULL),
	(50, 2, 'CustomerOfficeLine3', 'CustomerOfficeLine3', NULL, NULL),
	(51, 2, 'CustomerOfficeLine4', 'CustomerOfficeLine4', NULL, NULL),
	(52, 2, 'CustomerOfficeCity', 'CustomerOfficeCity', NULL, NULL),
	(53, 2, 'CustomerOfficeZipCode', 'CustomerOfficeZipCode', NULL, NULL),
	(54, 2, 'CustomerArea', 'CustomerArea', NULL, NULL),
	(55, 2, 'CustomerCardType', 'CustomerCardType', NULL, NULL);
/*!40000 ALTER TABLE `t_gn_detail_template` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_direct_campaign
DROP TABLE IF EXISTS `t_gn_direct_campaign`;
CREATE TABLE IF NOT EXISTS `t_gn_direct_campaign` (
  `DirectId` int(10) NOT NULL auto_increment,
  `DirectCampaignFrom` int(10) default NULL,
  `DirectCampaignTo` int(10) default NULL,
  `CustomerIdOld` int(10) default NULL,
  `CustomerIdNew` int(10) default NULL,
  `SellerId` int(10) default NULL,
  `CallReasonId` int(10) default NULL,
  `CreateByUserId` int(10) default NULL,
  `CreateDateTs` datetime default NULL,
  `DirectMethode` int(10) default NULL,
  `DirectAction` int(10) default NULL,
  PRIMARY KEY  (`DirectId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_direct_campaign: 1 rows
DELETE FROM `t_gn_direct_campaign`;
/*!40000 ALTER TABLE `t_gn_direct_campaign` DISABLE KEYS */;
INSERT INTO `t_gn_direct_campaign` (`DirectId`, `DirectCampaignFrom`, `DirectCampaignTo`, `CustomerIdOld`, `CustomerIdNew`, `SellerId`, `CallReasonId`, `CreateByUserId`, `CreateDateTs`, `DirectMethode`, `DirectAction`) VALUES
	(1, 1, 2, 1, 1, 8, 17, 8, '2014-04-17 15:49:14', 1, 2);
/*!40000 ALTER TABLE `t_gn_direct_campaign` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_distribusi_log
DROP TABLE IF EXISTS `t_gn_distribusi_log`;
CREATE TABLE IF NOT EXISTS `t_gn_distribusi_log` (
  `DistribusiLogId` int(10) unsigned NOT NULL auto_increment,
  `LogAssignmentId` int(10) unsigned default NULL,
  `LogUserId` int(10) unsigned default NULL COMMENT 'To User',
  `LogAssignUserId` int(10) unsigned default NULL COMMENT 'From User',
  `LogCreatedDate` datetime default '0000-00-00 00:00:00',
  PRIMARY KEY  (`DistribusiLogId`),
  KEY `idx` (`LogAssignmentId`,`LogCreatedDate`,`LogAssignUserId`),
  KEY `idx2` (`LogAssignmentId`,`LogCreatedDate`),
  KEY `idx_src` (`LogCreatedDate`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_distribusi_log: 4 rows
DELETE FROM `t_gn_distribusi_log`;
/*!40000 ALTER TABLE `t_gn_distribusi_log` DISABLE KEYS */;
INSERT INTO `t_gn_distribusi_log` (`DistribusiLogId`, `LogAssignmentId`, `LogUserId`, `LogAssignUserId`, `LogCreatedDate`) VALUES
	(1, 1, 7, 1, '2014-04-17 15:54:11'),
	(2, 2, 7, 2, '2014-04-22 17:16:03'),
	(3, 3, 7, 2, '2014-04-22 17:16:03'),
	(4, 4, 7, 2, '2014-04-22 17:16:04');
/*!40000 ALTER TABLE `t_gn_distribusi_log` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_formlayout
DROP TABLE IF EXISTS `t_gn_formlayout`;
CREATE TABLE IF NOT EXISTS `t_gn_formlayout` (
  `FormId` int(10) NOT NULL auto_increment,
  `PrefixId` int(11) NOT NULL default '0',
  `Handler` varchar(500) NOT NULL default 'TForm',
  `Model` varchar(500) NOT NULL default 'TModel',
  `AddView` varchar(500) NOT NULL default '',
  `EditView` varchar(50) NOT NULL default '',
  `UrlView` varchar(200) default '0',
  `UserLevel` int(11) default NULL,
  PRIMARY KEY  (`FormId`,`PrefixId`,`AddView`),
  KEY `PrefixId` (`PrefixId`),
  KEY `AddView` (`AddView`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_formlayout: 2 rows
DELETE FROM `t_gn_formlayout`;
/*!40000 ALTER TABLE `t_gn_formlayout` DISABLE KEYS */;
INSERT INTO `t_gn_formlayout` (`FormId`, `PrefixId`, `Handler`, `Model`, `AddView`, `EditView`, `UrlView`, `UserLevel`) VALUES
	(1, 1, 'TForm', 'TModel', 'form_hospital', 'form_product', 'http://192.168.1.46/EUI/', NULL),
	(2, 2, 'TForm', 'TModel', 'form_hospital', 'form_product', 'http://localhost:8080/svndevel/EUI/', NULL);
/*!40000 ALTER TABLE `t_gn_formlayout` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_grouplayout
DROP TABLE IF EXISTS `t_gn_grouplayout`;
CREATE TABLE IF NOT EXISTS `t_gn_grouplayout` (
  `Id` int(10) NOT NULL auto_increment,
  `GroupId` int(10) default NULL,
  `LayoutId` int(10) default NULL,
  `Themes` varchar(300) default NULL,
  `CreatedDateTs` datetime default NULL,
  `CreateByUserId` int(11) default NULL,
  `Flags` tinyint(4) default NULL,
  PRIMARY KEY  (`Id`),
  UNIQUE KEY `uniq` (`GroupId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_grouplayout: 7 rows
DELETE FROM `t_gn_grouplayout`;
/*!40000 ALTER TABLE `t_gn_grouplayout` DISABLE KEYS */;
INSERT INTO `t_gn_grouplayout` (`Id`, `GroupId`, `LayoutId`, `Themes`, `CreatedDateTs`, `CreateByUserId`, `Flags`) VALUES
	(1, 1, 2, 'redmond', '2014-04-06 02:36:49', 1, 1),
	(2, 4, 3, 'excite-bike', '2014-04-06 04:34:32', 1, 1),
	(3, 3, 2, 'cupertino', '2014-04-06 04:41:16', 1, 1),
	(4, 2, 2, 'cupertino', '2014-04-06 04:41:25', 1, 1),
	(5, 5, 5, 'cupertino', '2014-04-06 04:41:36', 1, 1),
	(6, 8, 6, 'redmond', '2014-04-17 02:23:07', 1, 1),
	(7, 6, 3, 'excite-bike', '2014-04-17 02:37:34', 1, 1);
/*!40000 ALTER TABLE `t_gn_grouplayout` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_insured
DROP TABLE IF EXISTS `t_gn_insured`;
CREATE TABLE IF NOT EXISTS `t_gn_insured` (
  `InsuredId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned NOT NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `PolicyId` int(10) unsigned default '0' COMMENT 'Must match [T_GN_Policy].PolicyId',
  `SalutationId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Salutation].SalutationId',
  `GenderId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Gender].GenderId',
  `IdentificationTypeId` tinyint(3) unsigned default '4' COMMENT 'Must match [T_LK_IdentificationType].IdentificationTypeId',
  `PremiumGroupId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_PremiumGroup].PremiumGroupCodeId',
  `RelationshipTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_RelationshipType].RelationshipTypeId',
  `ProvinceId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Province].ProvinceId',
  `CreatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `InsuredFirstName` varchar(100) default NULL,
  `InsuredLastName` varchar(100) default NULL,
  `InsuredDOB` date default NULL,
  `InsuredAge` varchar(8) default NULL,
  `InsuredIdentificationNum` varchar(20) default NULL,
  `InsuredAddressLine1` varchar(60) default NULL,
  `InsuredAddressLine2` varchar(60) default NULL,
  `InsuredAddressLine3` varchar(60) default NULL,
  `InsuredAddressLine4` varchar(60) default NULL,
  `InsuredCity` varchar(20) default NULL,
  `InsuredZipCode` varchar(10) default NULL,
  `InsuredHomePhoneNum` varchar(30) default NULL,
  `InsuredMobilePhoneNum` varchar(30) default NULL,
  `InsuredOfficePhoneNum` varchar(30) default NULL,
  `InsuredOfficePhoneExtNum` varchar(10) default NULL,
  `InsuredFaxNum` varchar(30) default NULL,
  `InsuredEmail` varchar(50) default NULL,
  `InsuredCreatedTs` timestamp NULL default '0000-00-00 00:00:00',
  `InsuredUpdatedTs` timestamp NULL default NULL,
  PRIMARY KEY  (`InsuredId`),
  KEY `FK_Insured_CustomerId` (`CustomerId`),
  KEY `FK_Insured_PolicyId` (`PolicyId`),
  KEY `FK_Insured_SalutationId` (`SalutationId`),
  KEY `FK_Insured_GenderId` (`GenderId`),
  KEY `FK_Insured_IdentificationTypeId` (`IdentificationTypeId`),
  KEY `FK_Insured_PremiumGroupId` (`PremiumGroupId`),
  KEY `FK_Insured_RelationshipTypeId` (`RelationshipTypeId`),
  KEY `FK_Insured_ProvinceId` (`ProvinceId`),
  KEY `FK_Insured_CreatedById` (`CreatedById`),
  KEY `FK_Insured_UpdatedById` (`UpdatedById`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Dependent table which holds dependent information.';

-- Dumping data for table ajmidb.t_gn_insured: ~0 rows (approximately)
DELETE FROM `t_gn_insured`;
/*!40000 ALTER TABLE `t_gn_insured` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_insured` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_lastcall
DROP TABLE IF EXISTS `t_gn_lastcall`;
CREATE TABLE IF NOT EXISTS `t_gn_lastcall` (
  `LastCallId` int(10) unsigned NOT NULL auto_increment,
  `LastCallStartDate` date NOT NULL,
  `LastCallEndDate` date NOT NULL,
  `LastCallStartTime` time NOT NULL,
  `LastCallEndTime` time NOT NULL,
  `LastCallReason` mediumtext NOT NULL,
  `LastCallStatus` tinyint(3) unsigned NOT NULL default '1',
  `LasCallCreateBy` tinyint(2) NOT NULL,
  `LastCallCreateDate` datetime default NULL,
  PRIMARY KEY  (`LastCallId`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_lastcall: 2 rows
DELETE FROM `t_gn_lastcall`;
/*!40000 ALTER TABLE `t_gn_lastcall` DISABLE KEYS */;
INSERT INTO `t_gn_lastcall` (`LastCallId`, `LastCallStartDate`, `LastCallEndDate`, `LastCallStartTime`, `LastCallEndTime`, `LastCallReason`, `LastCallStatus`, `LasCallCreateBy`, `LastCallCreateDate`) VALUES
	(22, '2014-05-01', '2022-01-05', '01:00:00', '23:30:00', 'TAMBAHAN WAKTU', 1, 1, '2014-04-15 18:20:28'),
	(23, '2014-04-01', '2014-04-15', '00:00:12', '00:00:12', 'TESTING', 1, 1, '2014-04-15 17:24:36');
/*!40000 ALTER TABLE `t_gn_lastcall` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_layout
DROP TABLE IF EXISTS `t_gn_layout`;
CREATE TABLE IF NOT EXISTS `t_gn_layout` (
  `Id` int(10) NOT NULL auto_increment,
  `Name` varchar(100) default NULL,
  `Images` varchar(200) default NULL,
  `Author` varchar(200) default NULL,
  `Description` text,
  `Flags` tinyint(4) default '1',
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_layout: 6 rows
DELETE FROM `t_gn_layout`;
/*!40000 ALTER TABLE `t_gn_layout` DISABLE KEYS */;
INSERT INTO `t_gn_layout` (`Id`, `Name`, `Images`, `Author`, `Description`, `Flags`) VALUES
	(1, 'standar', 'standar.png', 'razaki team', 'Suport With Category Menu && chield Menu And Chat Menu', 1),
	(2, 'example', 'example.png', 'razaki team', 'Suport With Category Menu && chield Menu And Chat Menu', 1),
	(3, 'danamon', 'danamon.png', 'razaki team', 'Suport chield Menu Only', 1),
	(4, 'right-layout', 'right-layout.png', 'razaki team', 'Suport With Category Menu && chield Menu And Chat Menu', 1),
	(5, 'blueomens', 'blueomens.png', 'razaki team', 'Suport chield Menu Only', 1),
	(6, 'easytemplate', 'easytemplate.png', 'razaki team', 'Suport chield Menu Only', 1);
/*!40000 ALTER TABLE `t_gn_layout` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_payer
DROP TABLE IF EXISTS `t_gn_payer`;
CREATE TABLE IF NOT EXISTS `t_gn_payer` (
  `PayerId` int(50) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned default NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `SalutationId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Salutation].SalutationId',
  `GenderId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Gender].GenderId',
  `IdentificationTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_IdentificationType].IdentificationTypeId',
  `PremiumGroupId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_PremiumGroup].PremiumGroupId',
  `RelationshipTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_RelationshipType].RelationshipTypeId',
  `ProvinceId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_Province].ProvinceId',
  `PaymentTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_PaymentType].PaymentTypeId',
  `CreditCardTypeId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CreditCardType].CreditCardTypeId',
  `ValidCCPrefixId` int(10) unsigned default NULL COMMENT 'Must match [T_LK_ValidCCPrefix].ValidCCPrefixId',
  `CreatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `UpdatedById` int(10) unsigned default NULL COMMENT 'Must match [tms_agent].UserId',
  `PayerFirstName` varchar(100) NOT NULL,
  `PayerLastName` varchar(100) NOT NULL,
  `PayerDOB` date NOT NULL,
  `PayersAge` decimal(10,2) NOT NULL,
  `PayerIdentificationNum` varchar(30) NOT NULL,
  `PayerAddressLine1` varchar(60) NOT NULL,
  `PayerAddressLine2` varchar(60) NOT NULL,
  `PayerZipCode` varchar(10) NOT NULL,
  `PayerAddressLine3` varchar(60) default NULL,
  `PayerAddressLine4` varchar(60) NOT NULL,
  `PayerCity` varchar(20) NOT NULL,
  `PayerHomePhoneNum` varchar(30) NOT NULL,
  `PayerMobilePhoneNum` varchar(30) NOT NULL,
  `PayerWorkPhoneNum` varchar(30) NOT NULL,
  `PayerOfficePhoneNum` varchar(30) NOT NULL,
  `PayerWorkExtPhoneNum` varchar(10) NOT NULL,
  `PayerFaxNum` varchar(30) NOT NULL,
  `PayerEmail` varchar(50) NOT NULL,
  `PayerCreditCardNum` varchar(16) NOT NULL,
  `PayerOfficeName` varchar(60) NOT NULL,
  `PayerCreditCardExpDate` char(5) NOT NULL,
  `PayerCreatedTs` timestamp NOT NULL default '0000-00-00 00:00:00',
  `PayerUpdatedTs` timestamp NULL default NULL,
  `PayersInsured` tinyint(2) NOT NULL default '0',
  `PayersKodeAreaHome` varchar(5) default NULL,
  `PayerAddrType` varchar(5) default NULL,
  `PayersKodeAreaOffice` varchar(5) default NULL,
  PRIMARY KEY  (`PayerId`),
  UNIQUE KEY `CustomerId` (`CustomerId`),
  KEY `FK_Payer_CustomerId` (`CustomerId`),
  KEY `FK_Payer_SalutationId` (`SalutationId`),
  KEY `FK_Payer_GenderId` (`GenderId`),
  KEY `FK_Payer_IdentificationTypeId` (`IdentificationTypeId`),
  KEY `FK_Payer_PremiumGroupId` (`PremiumGroupId`),
  KEY `FK_Payer_ProvinceId` (`ProvinceId`),
  KEY `FK_Payer_PaymentTypeId` (`PaymentTypeId`),
  KEY `FK_Payer_CreditCardTypeId` (`CreditCardTypeId`),
  KEY `FK_Payer_CreatedById` (`CreatedById`),
  KEY `FK_Payer_UpdatedById` (`UpdatedById`),
  KEY `FK_Payer_ValidCCPrefixId` (`ValidCCPrefixId`),
  KEY `FK_Payer_RelationshipTypeId` (`RelationshipTypeId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Payer table which holds payer information.';

-- Dumping data for table ajmidb.t_gn_payer: ~0 rows (approximately)
DELETE FROM `t_gn_payer`;
/*!40000 ALTER TABLE `t_gn_payer` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_payer` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_pendingphonenum
DROP TABLE IF EXISTS `t_gn_pendingphonenum`;
CREATE TABLE IF NOT EXISTS `t_gn_pendingphonenum` (
  `PendingPhoneNumId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` bigint(20) unsigned NOT NULL COMMENT 'Must match [T_GN_Customer].CustomerId',
  `PendingPhoneNumHome` varchar(30) NOT NULL COMMENT 'Datatype and length must match [T_GN_Customer].CustomerHomePhoneNum',
  `PendingPhoneNumMobile` varchar(30) NOT NULL COMMENT 'Datatype and length must match [T_GN_Customer].CustomerMobilePhoneNum',
  `PendingPhoneNumWork` varchar(30) NOT NULL COMMENT 'Datatype and length must match [T_GN_Customer].CustomerWorkPhoneNum',
  `PendingPhoneNumWorkExt` varchar(10) NOT NULL COMMENT 'Datatype and length must match [T_GN_Customer].CustomerWorkExtPhoneNum',
  PRIMARY KEY  (`PendingPhoneNumId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Pending Phone Num table which holds pending phone ';

-- Dumping data for table ajmidb.t_gn_pendingphonenum: ~0 rows (approximately)
DELETE FROM `t_gn_pendingphonenum`;
/*!40000 ALTER TABLE `t_gn_pendingphonenum` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_pendingphonenum` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_pertanyaan_kesehatan
DROP TABLE IF EXISTS `t_gn_pertanyaan_kesehatan`;
CREATE TABLE IF NOT EXISTS `t_gn_pertanyaan_kesehatan` (
  `KesehatanId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` int(10) unsigned default NULL,
  `InsuredId` int(10) unsigned default NULL,
  `ParentId` int(10) unsigned default NULL,
  `ChildsId` int(10) unsigned default NULL,
  `Answers` enum('Y','N') default NULL COMMENT 'Y=ya , N=no',
  `Description` text,
  `CreatedTs` text,
  PRIMARY KEY  (`KesehatanId`),
  KEY `ParentId` (`ParentId`),
  KEY `CustomerId` (`CustomerId`),
  KEY `idx` (`CustomerId`,`InsuredId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_pertanyaan_kesehatan: 0 rows
DELETE FROM `t_gn_pertanyaan_kesehatan`;
/*!40000 ALTER TABLE `t_gn_pertanyaan_kesehatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_pertanyaan_kesehatan` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_policy
DROP TABLE IF EXISTS `t_gn_policy`;
CREATE TABLE IF NOT EXISTS `t_gn_policy` (
  `PolicyId` int(10) unsigned NOT NULL auto_increment,
  `ProductPlanId` int(10) unsigned default NULL COMMENT 'Must match [T_GN_ProductPlan].ProductPlanId',
  `PolicySalesDate` datetime default NULL,
  `PolicyNumber` varchar(20) NOT NULL COMMENT 'Two digit prefix must match [T_GN_Product].ProductPolicyNumPrefix',
  `PolicyEffectiveDate` datetime NOT NULL,
  `PolicyPremi` decimal(19,2) default NULL,
  PRIMARY KEY  (`PolicyId`),
  KEY `FK_Policy_ProductPlanId` (`ProductPlanId`),
  KEY `idx` (`PolicySalesDate`,`PolicyNumber`),
  KEY `idx_policy` (`PolicyNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Policy table which holds customers'' policy.';

-- Dumping data for table ajmidb.t_gn_policy: ~0 rows (approximately)
DELETE FROM `t_gn_policy`;
/*!40000 ALTER TABLE `t_gn_policy` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_policy` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_policyautogen
DROP TABLE IF EXISTS `t_gn_policyautogen`;
CREATE TABLE IF NOT EXISTS `t_gn_policyautogen` (
  `PolicyAutoGenId` bigint(20) NOT NULL auto_increment,
  `CustomerId` int(10) default NULL,
  `PolicyLastNumber` int(10) default NULL,
  `ProductId` int(10) default NULL,
  `MemberGroup` int(10) default NULL,
  `PolicyNumber` varchar(50) default NULL,
  PRIMARY KEY  (`PolicyAutoGenId`),
  KEY `idx` (`CustomerId`,`PolicyNumber`),
  KEY `idx2` (`PolicyNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_policyautogen: 0 rows
DELETE FROM `t_gn_policyautogen`;
/*!40000 ALTER TABLE `t_gn_policyautogen` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_policyautogen` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_product
DROP TABLE IF EXISTS `t_gn_product`;
CREATE TABLE IF NOT EXISTS `t_gn_product` (
  `ProductId` int(10) unsigned NOT NULL auto_increment,
  `CampaignGroupId` int(10) unsigned NOT NULL COMMENT 'Must match [T_GN_CampaignGroup].CampaignGroupId',
  `ProductTypeId` tinyint(3) unsigned NOT NULL default '1' COMMENT 'Must match [T_GN_ProductType].ProductTypeId',
  `ProductCode` varchar(50) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `ProductPolicyNumPrefix` tinyint(2) unsigned NOT NULL default '1' COMMENT '1=with premi , 0=not premi',
  `ProductStatusFlag` tinyint(1) unsigned NOT NULL default '1' COMMENT '0 = Inactive; 1 = Active',
  PRIMARY KEY  (`ProductId`),
  UNIQUE KEY `ProductCode` (`ProductCode`),
  KEY `FK_Product_ProductTypeId` (`ProductTypeId`),
  KEY `FK_Product_CampaignGroupId` (`CampaignGroupId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Product table which holds product information.';

-- Dumping data for table ajmidb.t_gn_product: ~2 rows (approximately)
DELETE FROM `t_gn_product`;
/*!40000 ALTER TABLE `t_gn_product` DISABLE KEYS */;
INSERT INTO `t_gn_product` (`ProductId`, `CampaignGroupId`, `ProductTypeId`, `ProductCode`, `ProductName`, `ProductPolicyNumPrefix`, `ProductStatusFlag`) VALUES
	(1, 1, 1, 'PRODUCT_TEST', 'PRODUCT_TEST', 1, 1),
	(2, 2, 1, 'TEST_PRODUCT', 'TEST_PRODUCT', 1, 1);
/*!40000 ALTER TABLE `t_gn_product` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_productplan
DROP TABLE IF EXISTS `t_gn_productplan`;
CREATE TABLE IF NOT EXISTS `t_gn_productplan` (
  `ProductPlanId` int(10) unsigned NOT NULL auto_increment,
  `ProductId` int(10) unsigned NOT NULL COMMENT 'Must match [T_GN_Product].ProductId',
  `PayModeId` tinyint(3) unsigned NOT NULL COMMENT 'Must match [T_GN_PayMode].PayModeId',
  `PremiumGroupId` tinyint(3) default NULL COMMENT 'Must match [T_GN_PremiumGroup].PremiumGroupId',
  `ProductPlan` tinyint(3) unsigned NOT NULL COMMENT 'Regular numbers',
  `ProductPlanName` varchar(10) NOT NULL COMMENT 'Begins with PLAN, followed by Roman numerals (I, II, III, IV, V, ...)',
  `ProductPlanAgeStart` decimal(3,1) unsigned NOT NULL,
  `ProductPlanAgeEnd` decimal(3,1) unsigned NOT NULL,
  `ProductPlanPremium` mediumint(8) unsigned NOT NULL COMMENT 'Nominal in Rupiah',
  `ProductPlanStatusFlag` tinyint(1) NOT NULL COMMENT '0 = Inactive; 1 = Active',
  PRIMARY KEY  (`ProductPlanId`),
  KEY `FK_ProductPlan_PayModeId` (`PayModeId`),
  KEY `FK_ProductPlan_PremiumGroupId` (`PremiumGroupId`),
  KEY `FK_ProductPlan_ProductId` (`ProductId`),
  KEY `idx_where` (`ProductPlanAgeStart`,`ProductPlanAgeEnd`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COMMENT='This is a Product Plan table which holds all product plans.';

-- Dumping data for table ajmidb.t_gn_productplan: ~10 rows (approximately)
DELETE FROM `t_gn_productplan`;
/*!40000 ALTER TABLE `t_gn_productplan` DISABLE KEYS */;
INSERT INTO `t_gn_productplan` (`ProductPlanId`, `ProductId`, `PayModeId`, `PremiumGroupId`, `ProductPlan`, `ProductPlanName`, `ProductPlanAgeStart`, `ProductPlanAgeEnd`, `ProductPlanPremium`, `ProductPlanStatusFlag`) VALUES
	(1, 1, 1, 2, 1, 'PLAN1', 10.0, 20.0, 0, 0),
	(2, 1, 1, 2, 2, 'PLAN2', 10.0, 20.0, 0, 0),
	(3, 2, 1, 2, 1, 'PLAN1', 1.0, 2.0, 100, 1),
	(4, 2, 1, 2, 2, 'PLAN2', 1.0, 2.0, 200, 1),
	(5, 2, 1, 2, 1, 'PLAN1', 3.0, 4.0, 300, 1),
	(6, 2, 1, 2, 2, 'PLAN2', 3.0, 4.0, 400, 1),
	(7, 2, 2, 2, 1, 'PLAN1', 1.0, 2.0, 500, 1),
	(8, 2, 2, 2, 2, 'PLAN2', 1.0, 2.0, 600, 1),
	(9, 2, 2, 2, 1, 'PLAN1', 3.0, 4.0, 700, 1),
	(10, 2, 2, 2, 2, 'PLAN2', 3.0, 4.0, 800, 1);
/*!40000 ALTER TABLE `t_gn_productplan` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_productplanbenefit
DROP TABLE IF EXISTS `t_gn_productplanbenefit`;
CREATE TABLE IF NOT EXISTS `t_gn_productplanbenefit` (
  `ProductPlanBenefitId` int(10) unsigned NOT NULL auto_increment,
  `ProductId` int(10) unsigned NOT NULL,
  `ProductPlan` int(10) unsigned NOT NULL COMMENT '0 = Inactive; 1 = Active',
  `ProductPlanBenefit` varchar(30) NOT NULL COMMENT 'Nominal',
  `ProductPlanBenefitDesc` varchar(500) NOT NULL,
  `ProductPlanBenefitStatusFlag` tinyint(1) unsigned NOT NULL COMMENT '0 = Inactive; 1 = Active',
  PRIMARY KEY  (`ProductPlanBenefitId`),
  KEY `FK_ProductPlanBenefit_ProductPlanId` (`ProductId`),
  KEY `ProductPlan` (`ProductPlan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is a Product Plan Benefit table which holds benefits fo';

-- Dumping data for table ajmidb.t_gn_productplanbenefit: ~0 rows (approximately)
DELETE FROM `t_gn_productplanbenefit`;
/*!40000 ALTER TABLE `t_gn_productplanbenefit` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_productplanbenefit` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_productprefixnumber
DROP TABLE IF EXISTS `t_gn_productprefixnumber`;
CREATE TABLE IF NOT EXISTS `t_gn_productprefixnumber` (
  `PrefixNumberId` int(10) NOT NULL auto_increment,
  `PrefixMethod` varchar(10) NOT NULL default '0',
  `ProductId` int(10) default NULL,
  `PrefixChar` varchar(20) default NULL,
  `PrefixLength` int(10) default NULL,
  `PrefixFlagStatus` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`PrefixNumberId`,`PrefixMethod`),
  UNIQUE KEY `ProductId` (`ProductId`),
  KEY `PrefixMethod` (`PrefixMethod`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_productprefixnumber: 2 rows
DELETE FROM `t_gn_productprefixnumber`;
/*!40000 ALTER TABLE `t_gn_productprefixnumber` DISABLE KEYS */;
INSERT INTO `t_gn_productprefixnumber` (`PrefixNumberId`, `PrefixMethod`, `ProductId`, `PrefixChar`, `PrefixLength`, `PrefixFlagStatus`) VALUES
	(1, 'one-to-one', 1, 'TST0000000000000000', 19, 1),
	(2, 'one-to-one', 2, 'XXX0000000', 10, 1);
/*!40000 ALTER TABLE `t_gn_productprefixnumber` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_productscript
DROP TABLE IF EXISTS `t_gn_productscript`;
CREATE TABLE IF NOT EXISTS `t_gn_productscript` (
  `ScriptId` bigint(20) unsigned NOT NULL auto_increment,
  `ProductId` int(10) unsigned NOT NULL,
  `ScriptFileName` varchar(150) default NULL,
  `Description` varchar(300) default NULL,
  `ScriptFlagStatus` tinyint(1) unsigned NOT NULL default '1',
  `ScriptUpload` varchar(80) default NULL,
  `UploadDate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `UploadBy` int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ScriptId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_productscript: 3 rows
DELETE FROM `t_gn_productscript`;
/*!40000 ALTER TABLE `t_gn_productscript` DISABLE KEYS */;
INSERT INTO `t_gn_productscript` (`ScriptId`, `ProductId`, `ScriptFileName`, `Description`, `ScriptFlagStatus`, `ScriptUpload`, `UploadDate`, `UploadBy`) VALUES
	(2, 2, 'setup_comforta_ajmi.txt', 'ASDF', 0, 'setup_comforta_ajmi.txt', '2014-04-13 07:18:56', 1),
	(3, 1, 'setup_comforta_ajmi.txt', 'OK', 1, 'setup_comforta_ajmi.txt', '2014-04-13 07:19:18', 1),
	(4, 1, 'form_cuti_lebaran.pdf', 'TEST PDF TYPE', 1, 'form_cuti_lebaran.pdf', '2014-04-17 17:36:07', 1);
/*!40000 ALTER TABLE `t_gn_productscript` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_product_question
DROP TABLE IF EXISTS `t_gn_product_question`;
CREATE TABLE IF NOT EXISTS `t_gn_product_question` (
  `QuistionId` int(10) NOT NULL auto_increment,
  `QuistionParents` int(10) default NULL,
  `QuistionChilds` int(10) default NULL,
  `QuistionProductId` int(10) default NULL,
  `QuistionDescription` text,
  PRIMARY KEY  (`QuistionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_product_question: 0 rows
DELETE FROM `t_gn_product_question`;
/*!40000 ALTER TABLE `t_gn_product_question` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_product_question` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_query
DROP TABLE IF EXISTS `t_gn_query`;
CREATE TABLE IF NOT EXISTS `t_gn_query` (
  `query_id` int(10) unsigned NOT NULL auto_increment,
  `query_section` varchar(50) NOT NULL default '',
  `query_level` int(11) default NULL,
  `query` text,
  `flags` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`query_id`,`query_section`),
  KEY `query_section` (`query_section`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_query: 7 rows
DELETE FROM `t_gn_query`;
/*!40000 ALTER TABLE `t_gn_query` DISABLE KEYS */;
INSERT INTO `t_gn_query` (`query_id`, `query_section`, `query_level`, `query`, `flags`) VALUES
	(1, 'distribusi', 1, 'select count(a.AssignId) as jumlah  from t_gn_assignment a \r\nleft join t_gn_customer b on a.CustomerId=b.CustomerId   \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nwhere 1=1  and a.AssignAdmin=\'{SESSION_USER}\' \r\nand c.CampaignId=\'{CAMPAIGN_ID}\' \r\nand a.AssignMgr IS NULL', 1),
	(2, 'distribusi', 2, 'select count(a.AssignId) as jumlah  from t_gn_assignment a \r\nleft join t_gn_customer b on a.CustomerId=b.CustomerId   \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nwhere 1=1 AND a.AssignAdmin IS NOT NULL \r\nAND a.AssignMgr=\'{SESSION_USER}\' \r\nand c.CampaignId=\'{CAMPAIGN_ID}\' \r\nAND a.AssignSpv IS NULL', 1),
	(3, 'distribusi', 3, 'select count(a.AssignId) as jumlah from t_gn_assignment a \r\nleft join t_gn_customer b on a.CustomerId=b.CustomerId   \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nwhere 1=1  and a.AssignSpv =\'{SESSION_USER}\'  and c.CampaignId=\'{CAMPAIGN_ID}\'\r\nand a.AssignMgr IS NOT NULL\r\nand a.AssignAdmin IS NOT NULL\r\nand a.AssignSelerId is null', 1),
	(4, 'distribusi', 4, 'select count(a.AssignId) as jumlah from t_gn_assignment a left join t_gn_customer b on a.CustomerId=b.CustomerId  where 1=1 and a.AssignAdmin=\'{SESSION_USER}\' and a.AssignMgr IS NULL', 1),
	(5, 'querylist', 1, 'select * from t_gn_assignment a \r\nleft join t_gn_customer b on a.CustomerId=b.CustomerId   \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nwhere 1=1  and a.AssignAdmin=\'{SESSION_USER}\'  and c.CampaignId=\'{CAMPAIGN_ID}\'  and a.AssignMgr IS NULL', 1),
	(6, 'querylist', 3, 'select * from t_gn_assignment a \r\nleft join t_gn_customer b on a.CustomerId=b.CustomerId   \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nwhere 1=1  and a.AssignSpv =\'{SESSION_USER}\'  and c.CampaignId=\'{CAMPAIGN_ID}\'\r\nand a.AssignMgr IS NOT NULL\r\nand a.AssignAdmin IS NOT NULL\r\nand a.AssignSelerId is null', 1),
	(7, 'querylist', 2, 'SELECT * FROM t_gn_assignment a\r\nLEFT JOIN t_gn_customer b ON a.CustomerId=b.CustomerId \r\nleft join t_gn_campaign c on b.CampaignId=c.CampaignId\r\nWHERE 1=1 AND a.AssignMgr=\'{SESSION_USER}\' \r\nand c.CampaignId=\'{CAMPAIGN_ID}\'\r\nAND a.AssignSpv IS NULL AND a.AssignSelerId IS NULL', 1);
/*!40000 ALTER TABLE `t_gn_query` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_recording
DROP TABLE IF EXISTS `t_gn_recording`;
CREATE TABLE IF NOT EXISTS `t_gn_recording` (
  `RecId` bigint(20) unsigned NOT NULL auto_increment,
  `RecDate` datetime default NULL,
  `RecFileName` varchar(50) NOT NULL default '',
  `RecStatusDownload` tinyint(2) NOT NULL default '0',
  `RecDateDownload` datetime default NULL,
  `RecSumaryFile` int(10) default NULL,
  `RecUserDownload` int(10) default NULL,
  `RecResultStatus` int(10) default NULL,
  PRIMARY KEY  (`RecId`,`RecFileName`),
  UNIQUE KEY `RecFileName` (`RecFileName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_recording: 0 rows
DELETE FROM `t_gn_recording`;
/*!40000 ALTER TABLE `t_gn_recording` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_recording` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_template
DROP TABLE IF EXISTS `t_gn_template`;
CREATE TABLE IF NOT EXISTS `t_gn_template` (
  `TemplateId` int(10) unsigned NOT NULL auto_increment,
  `TemplateTableName` varchar(50) NOT NULL default '0',
  `TemplateName` varchar(200) default NULL,
  `TemplateMode` varchar(200) default NULL,
  `TemplateFileType` char(10) default NULL,
  `TemplateFlags` tinyint(1) unsigned default '1',
  `TemplateCreateTs` datetime default NULL,
  PRIMARY KEY  (`TemplateId`,`TemplateTableName`),
  KEY `idx` (`TemplateTableName`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_template: 2 rows
DELETE FROM `t_gn_template`;
/*!40000 ALTER TABLE `t_gn_template` DISABLE KEYS */;
INSERT INTO `t_gn_template` (`TemplateId`, `TemplateTableName`, `TemplateName`, `TemplateMode`, `TemplateFileType`, `TemplateFlags`, `TemplateCreateTs`) VALUES
	(1, 't_gn_bucket_customers', 'Bucket Data', 'insert', 'excel', 1, '2014-04-04 01:05:40'),
	(2, 't_gn_bucket_customers', 'Bucket Data2', 'insert', 'excel', 1, '2014-04-04 14:07:40');
/*!40000 ALTER TABLE `t_gn_template` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_tmpupload
DROP TABLE IF EXISTS `t_gn_tmpupload`;
CREATE TABLE IF NOT EXISTS `t_gn_tmpupload` (
  `CampaignId` int(10) NOT NULL default '0',
  `UpoadDuplicateCampaign` int(10) NOT NULL default '0',
  `CustomerNumber` varchar(50) NOT NULL default '',
  `CustomerFirstName` varchar(50) default NULL,
  `Gender` varchar(50) default NULL,
  `CardTypeDesc` varchar(50) default NULL,
  `CustomerDOB` date default NULL,
  `CustomerAddressLine1` varchar(200) default NULL,
  `CustomerAddressLine2` varchar(200) default NULL,
  `CustomerAddressLine3` varchar(200) default NULL,
  `CustomerAddressLine4` varchar(200) default NULL,
  `CustomerCity` varchar(100) default NULL,
  `CustomerZipCode` varchar(15) default NULL,
  `CustomerHomePhoneNum` varchar(18) default NULL,
  `CustomerMobilePhoneNum` varchar(18) default NULL,
  `CustomerWorkPhoneNum` varchar(18) default NULL,
  `CustomerUploadedTs` datetime default NULL,
  `UploadedById` varchar(50) default NULL,
  `UploadFileName` varchar(200) default NULL,
  PRIMARY KEY  (`CustomerNumber`,`UpoadDuplicateCampaign`,`CampaignId`),
  KEY `CampaignId` (`CampaignId`),
  KEY `UpoadDuplicateCampaign` (`UpoadDuplicateCampaign`),
  KEY `CustomerNumber` (`CustomerNumber`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_tmpupload: 0 rows
DELETE FROM `t_gn_tmpupload`;
/*!40000 ALTER TABLE `t_gn_tmpupload` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_tmpupload` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_tmp_tarik_detail
DROP TABLE IF EXISTS `t_gn_tmp_tarik_detail`;
CREATE TABLE IF NOT EXISTS `t_gn_tmp_tarik_detail` (
  `tmp_tarik_datail_id` int(10) NOT NULL auto_increment,
  `tmp_tarik_id` bigint(20) default NULL,
  `CustomerId` bigint(20) default '0',
  `CampaignId` bigint(20) default NULL,
  `AssignId` bigint(20) default NULL,
  `AssignAdminId` bigint(20) default NULL,
  `AssignManagerId` bigint(20) default NULL,
  `AssignSupervisorId` bigint(20) default NULL,
  `AssignSellerId` bigint(20) default NULL,
  `CreatedTs` datetime default NULL,
  `Distribute` enum('Y','N') default 'N',
  PRIMARY KEY  (`tmp_tarik_datail_id`),
  KEY `CampaignId` (`CampaignId`),
  KEY `CustomerId` (`CustomerId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_tmp_tarik_detail: 0 rows
DELETE FROM `t_gn_tmp_tarik_detail`;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_detail` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_tmp_tarik_id
DROP TABLE IF EXISTS `t_gn_tmp_tarik_id`;
CREATE TABLE IF NOT EXISTS `t_gn_tmp_tarik_id` (
  `tmp_id` int(10) NOT NULL auto_increment,
  `tmp_size_data` int(10) default NULL,
  `tmp_session_id` varchar(200) default NULL,
  `tmp_code_sql` text,
  `tmp_created_by` int(11) default NULL,
  `tmp_created_ts` datetime default NULL,
  PRIMARY KEY  (`tmp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_tmp_tarik_id: 0 rows
DELETE FROM `t_gn_tmp_tarik_id`;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_id` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_id` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_tmp_tarik_log
DROP TABLE IF EXISTS `t_gn_tmp_tarik_log`;
CREATE TABLE IF NOT EXISTS `t_gn_tmp_tarik_log` (
  `TmpLogId` int(10) unsigned NOT NULL auto_increment,
  `CustomerId` int(10) default NULL,
  `AssignAdminId` int(10) default NULL,
  `AssignManagerId` int(10) default NULL,
  `AssignSupervisorId` int(10) default NULL,
  `AssignSellerId` int(10) default NULL,
  `SessionTmpId` int(10) default NULL,
  `CreatedTs` datetime default NULL,
  PRIMARY KEY  (`TmpLogId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_tmp_tarik_log: 0 rows
DELETE FROM `t_gn_tmp_tarik_log`;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_tmp_tarik_log` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_uploadreport
DROP TABLE IF EXISTS `t_gn_uploadreport`;
CREATE TABLE IF NOT EXISTS `t_gn_uploadreport` (
  `UploadId` bigint(20) unsigned NOT NULL auto_increment,
  `UploadFileName` varchar(200) default NULL,
  `UploadTemporaryLocation` varchar(300) default NULL,
  `UploadByUserId` int(10) default NULL,
  `TotalDataRows` int(10) default NULL,
  `TotalSuccessRows` int(10) default NULL,
  `TotalFailedRows` int(10) default NULL,
  `TotalDuplicateSameCampaign` int(10) default NULL,
  `TotalDuplicateOtherCampaign` int(10) default NULL,
  `UploadDateTs` datetime default NULL,
  `UploadUerId` int(11) default NULL,
  PRIMARY KEY  (`UploadId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_uploadreport: 0 rows
DELETE FROM `t_gn_uploadreport`;
/*!40000 ALTER TABLE `t_gn_uploadreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_uploadreport` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_upload_report_ftp
DROP TABLE IF EXISTS `t_gn_upload_report_ftp`;
CREATE TABLE IF NOT EXISTS `t_gn_upload_report_ftp` (
  `FTP_UploadId` int(10) NOT NULL auto_increment,
  `FTP_UploadRows` int(10) default NULL,
  `FTP_UploadSuccess` int(10) default NULL,
  `FTP_UploadDuplicate` int(10) default NULL,
  `FTP_UploadFailed` int(10) default NULL,
  `FTP_UploadDateTs` datetime default NULL,
  `FTP_UploadFilename` text,
  `FTP_UploadType` varchar(50) default 'FTP',
  PRIMARY KEY  (`FTP_UploadId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_upload_report_ftp: 3 rows
DELETE FROM `t_gn_upload_report_ftp`;
/*!40000 ALTER TABLE `t_gn_upload_report_ftp` DISABLE KEYS */;
INSERT INTO `t_gn_upload_report_ftp` (`FTP_UploadId`, `FTP_UploadRows`, `FTP_UploadSuccess`, `FTP_UploadDuplicate`, `FTP_UploadFailed`, `FTP_UploadDateTs`, `FTP_UploadFilename`, `FTP_UploadType`) VALUES
	(1, 6, 6, NULL, NULL, '2014-04-04 22:23:36', 'http://localhost:8080/svndevel/EUI/application/temp/TEST_UPLOAD_BUCKET_EUI.xls', 'MNL'),
	(2, 6, 6, NULL, NULL, '2014-04-05 04:07:11', 'http://localhost:8080/svndevelshoping/EUI/application/temp/TEST_UPLOAD_BUCKET_EUI.xls', 'MNL'),
	(3, 7, 7, NULL, NULL, '2014-04-22 17:14:44', 'http://localhost:8080/svndevel/EUI/application/temp/Bucket_Data_1398157816.xls', 'MNL');
/*!40000 ALTER TABLE `t_gn_upload_report_ftp` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_gn_verified_remider
DROP TABLE IF EXISTS `t_gn_verified_remider`;
CREATE TABLE IF NOT EXISTS `t_gn_verified_remider` (
  `VerifiedId` bigint(20) unsigned NOT NULL auto_increment,
  `CustomerId` int(10) unsigned default NULL,
  `VerifiedStatus` tinyint(2) unsigned default NULL,
  `VerifiedFlags` tinyint(3) unsigned NOT NULL default '0',
  `UserLevelId` tinyint(4) unsigned NOT NULL default '0',
  `VerfiedCreatedTs` datetime default NULL,
  PRIMARY KEY  (`VerifiedId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_gn_verified_remider: 0 rows
DELETE FROM `t_gn_verified_remider`;
/*!40000 ALTER TABLE `t_gn_verified_remider` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_gn_verified_remider` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_approvalitem
DROP TABLE IF EXISTS `t_lk_approvalitem`;
CREATE TABLE IF NOT EXISTS `t_lk_approvalitem` (
  `ApprovalItemId` tinyint(3) unsigned NOT NULL auto_increment,
  `ApprovalItem` varchar(50) NOT NULL,
  PRIMARY KEY  (`ApprovalItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='This is an Approval Item table which holds items that should';

-- Dumping data for table ajmidb.t_lk_approvalitem: ~6 rows (approximately)
DELETE FROM `t_lk_approvalitem`;
/*!40000 ALTER TABLE `t_lk_approvalitem` DISABLE KEYS */;
INSERT INTO `t_lk_approvalitem` (`ApprovalItemId`, `ApprovalItem`) VALUES
	(1, 'Customer Name'),
	(2, 'Home Phone Number'),
	(3, 'Mobile Phone Number'),
	(4, 'Office Phone Number'),
	(5, 'Office Ext Number'),
	(6, 'Additional Phone Number');
/*!40000 ALTER TABLE `t_lk_approvalitem` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_aprove_status
DROP TABLE IF EXISTS `t_lk_aprove_status`;
CREATE TABLE IF NOT EXISTS `t_lk_aprove_status` (
  `ApproveId` int(10) unsigned NOT NULL auto_increment,
  `AproveCode` int(5) unsigned default NULL,
  `AproveName` varchar(50) default NULL,
  `ApproveEskalasi` int(11) unsigned default NULL,
  `ConfirmFlags` tinyint(1) unsigned default '0' COMMENT '1=yes , 0=no',
  `AproveFlags` tinyint(1) unsigned default NULL,
  `CancelFlags` tinyint(1) unsigned default '0',
  `UserPrivileges` int(11) unsigned default NULL,
  `AproveVeryfied` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`ApproveId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_aprove_status: 4 rows
DELETE FROM `t_lk_aprove_status`;
/*!40000 ALTER TABLE `t_lk_aprove_status` DISABLE KEYS */;
INSERT INTO `t_lk_aprove_status` (`ApproveId`, `AproveCode`, `AproveName`, `ApproveEskalasi`, `ConfirmFlags`, `AproveFlags`, `CancelFlags`, `UserPrivileges`, `AproveVeryfied`) VALUES
	(1, 501, 'Verified By QA', 0, 0, 1, 0, 3, 1),
	(2, 502, 'Pending By QA', 1, 0, 1, 0, 4, 0),
	(3, 503, 'Reject By QA', 0, 0, 1, 0, 4, 0),
	(5, 504, 'Reconfirm', 0, 1, 1, 0, 4, 0);
/*!40000 ALTER TABLE `t_lk_aprove_status` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_bank
DROP TABLE IF EXISTS `t_lk_bank`;
CREATE TABLE IF NOT EXISTS `t_lk_bank` (
  `BankId` tinyint(3) unsigned NOT NULL auto_increment,
  `BankName` varchar(50) NOT NULL,
  `BankStatusFlag` tinyint(1) NOT NULL default '1' COMMENT '0 = Inactive; 1 = Active',
  PRIMARY KEY  (`BankId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1 COMMENT='This is a Bank table which holds the all approved banks from';

-- Dumping data for table ajmidb.t_lk_bank: ~31 rows (approximately)
DELETE FROM `t_lk_bank`;
/*!40000 ALTER TABLE `t_lk_bank` DISABLE KEYS */;
INSERT INTO `t_lk_bank` (`BankId`, `BankName`, `BankStatusFlag`) VALUES
	(1, 'AMEX', 1),
	(2, 'ANZ/Panin', 1),
	(3, 'Artha Graha', 1),
	(4, 'BCA', 1),
	(5, 'BII', 1),
	(6, 'BNI', 1),
	(7, 'BPD (Pembangunan Daerah)', 1),
	(8, 'BRI', 1),
	(9, 'BTN (Tabungan Negara)', 1),
	(10, 'Buana Indonesia', 1),
	(11, 'Bukopin', 1),
	(12, 'Bumiputera', 1),
	(13, 'Cash Bank Manhattan', 1),
	(14, 'CIMB Niaga', 1),
	(15, 'Citibank', 1),
	(16, 'Commonwealth', 1),
	(17, 'Danamon', 1),
	(18, 'GE', 1),
	(19, 'HSBC', 1),
	(20, 'Lippo', 1),
	(21, 'Mandiri', 1),
	(22, 'MBF', 1),
	(23, 'Mega', 1),
	(24, 'Niaga', 1),
	(25, 'Nusantara', 1),
	(26, 'OCBC NISP', 1),
	(27, 'Permata', 1),
	(28, 'RBS/ABN Amro', 1),
	(29, 'Riau', 1),
	(30, 'Standard Chartered', 1),
	(31, 'Sinarmas', 1);
/*!40000 ALTER TABLE `t_lk_bank` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_billingaddress
DROP TABLE IF EXISTS `t_lk_billingaddress`;
CREATE TABLE IF NOT EXISTS `t_lk_billingaddress` (
  `BilingId` int(10) NOT NULL auto_increment,
  `BilingCode` char(5) default NULL,
  `BilingDescription` varchar(100) default NULL,
  `BilingFlagsStatus` tinyint(4) default NULL,
  PRIMARY KEY  (`BilingId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_billingaddress: 3 rows
DELETE FROM `t_lk_billingaddress`;
/*!40000 ALTER TABLE `t_lk_billingaddress` DISABLE KEYS */;
INSERT INTO `t_lk_billingaddress` (`BilingId`, `BilingCode`, `BilingDescription`, `BilingFlagsStatus`) VALUES
	(1, '01', 'Home Address', 1),
	(2, '02', 'Office Address', 1),
	(3, '02', 'Other Address', 1);
/*!40000 ALTER TABLE `t_lk_billingaddress` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_branch
DROP TABLE IF EXISTS `t_lk_branch`;
CREATE TABLE IF NOT EXISTS `t_lk_branch` (
  `BranchId` tinyint(3) unsigned NOT NULL auto_increment,
  `BranchCode` varchar(8) NOT NULL,
  `BranchName` varchar(100) NOT NULL,
  `BranchManager` varchar(100) default NULL,
  `BranchContact` varchar(100) default NULL,
  `BranchAddress` varchar(100) default NULL,
  `BranchEmail` varchar(100) default NULL,
  `BranchFlags` tinyint(1) unsigned default '1',
  PRIMARY KEY  (`BranchId`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1 COMMENT='This is a Branch look-up table which holds branch informatio';

-- Dumping data for table ajmidb.t_lk_branch: ~28 rows (approximately)
DELETE FROM `t_lk_branch`;
/*!40000 ALTER TABLE `t_lk_branch` DISABLE KEYS */;
INSERT INTO `t_lk_branch` (`BranchId`, `BranchCode`, `BranchName`, `BranchManager`, `BranchContact`, `BranchAddress`, `BranchEmail`, `BranchFlags`) VALUES
	(1, '14120', 'JAKARTA CENTRAL', 'DUMMY MANAGER6', '02132066189', '', 'jombi.php@gmail.com', 1),
	(2, '95113', 'MEDAN', 'DUMMY MANAGER', '02132066189', '', 'jombi_par@yahoo.com', 1),
	(3, '03', 'SURABAYA', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(4, '40288', 'BANDUNG', 'DUMMY MANAGER', '02132066189', '', 'jombi_par@yahoo.com', 1),
	(5, '05', 'LAMPUNG', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(6, '06', 'SEMARANG', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(7, '07', 'PEKAN BARU', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(8, '08', 'JAKARTA UTARA', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(9, '09', 'PADANG', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(10, '10', 'JAKARTA SELATAN', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(11, '11', 'JAMBI', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(12, '12', 'PALEMBANG', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(13, '14', 'DENPASAR', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(14, '15', 'SOLO', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(15, '16', 'CILEGON', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(16, '17', 'MAKASSAR', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(17, '18', 'MUARA BUNGO', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(18, '19', 'RANTAU PRAPAT', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(19, '20', 'BUKIT TINGGI', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(20, '21', 'SAMARINDA', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(21, '22', 'PEMATANG SIANTAR', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(22, '23', 'PADANG SIDEMPUAN', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(23, '24', 'PONTIANAK', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(24, '25', 'BANJARMASIN', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(25, '26', 'MALANG', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(26, '27', 'PUWOKERTO', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(27, '28', 'SUKABUMI', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1),
	(28, '29', 'JEMBER', 'DUMMY MANAGER', '02132066189', NULL, 'jombi_par@yahoo.com', 1);
/*!40000 ALTER TABLE `t_lk_branch` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_buildtype
DROP TABLE IF EXISTS `t_lk_buildtype`;
CREATE TABLE IF NOT EXISTS `t_lk_buildtype` (
  `BuildTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `BuildType` varchar(10) NOT NULL,
  PRIMARY KEY  (`BuildTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='This is a Build Type table which holds all build types.';

-- Dumping data for table ajmidb.t_lk_buildtype: ~3 rows (approximately)
DELETE FROM `t_lk_buildtype`;
/*!40000 ALTER TABLE `t_lk_buildtype` DISABLE KEYS */;
INSERT INTO `t_lk_buildtype` (`BuildTypeId`, `BuildType`) VALUES
	(1, 'ADD ON'),
	(2, 'UPGRADE'),
	(3, 'XSELL');
/*!40000 ALTER TABLE `t_lk_buildtype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_callreason
DROP TABLE IF EXISTS `t_lk_callreason`;
CREATE TABLE IF NOT EXISTS `t_lk_callreason` (
  `CallReasonId` int(10) unsigned NOT NULL auto_increment,
  `CallReasonCategoryId` tinyint(3) unsigned default NULL COMMENT 'Must match [T_LK_CallReasonCategory].CallReasonCategoryId',
  `CallReasonLevel` tinyint(3) unsigned NOT NULL COMMENT 'HandleCodeforUser',
  `CallReasonCode` smallint(5) unsigned NOT NULL,
  `CallReasonDesc` varchar(100) NOT NULL,
  `CallReasonStatusFlag` tinyint(1) unsigned NOT NULL COMMENT '0 = Inactive; 1 = Active',
  `CallReasonContactedFlag` tinyint(4) unsigned default '1' COMMENT '0 = Not Contacted; 1 = Contacted',
  `CallReasonEvent` tinyint(1) unsigned default '0' COMMENT '0 = Inactive; 1 = Active',
  `CallReasonLater` tinyint(1) unsigned default '0' COMMENT '0 = Not Contacted; 1 = Contacted',
  `CallReasonOrder` tinyint(1) unsigned default '0' COMMENT '0 = Not Contacted; 1 = Contacted',
  `CallReasonNoNeed` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`CallReasonId`),
  KEY `FK_CallReason_CallReasonCategoryId` (`CallReasonCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 COMMENT='This is a Call Reason table which holds all call reasons.';

-- Dumping data for table ajmidb.t_lk_callreason: ~17 rows (approximately)
DELETE FROM `t_lk_callreason`;
/*!40000 ALTER TABLE `t_lk_callreason` DISABLE KEYS */;
INSERT INTO `t_lk_callreason` (`CallReasonId`, `CallReasonCategoryId`, `CallReasonLevel`, `CallReasonCode`, `CallReasonDesc`, `CallReasonStatusFlag`, `CallReasonContactedFlag`, `CallReasonEvent`, `CallReasonLater`, `CallReasonOrder`, `CallReasonNoNeed`) VALUES
	(1, 7, 1, 101, 'BUSY LINE', 1, 0, 0, 0, 1, 0),
	(2, 3, 2, 106, 'THINKING', 1, 1, 0, 1, 2, 0),
	(3, 3, 2, 105, 'CALL BACK', 1, 1, 0, 1, 1, 0),
	(4, 4, 3, 107, 'SUDAH MENINGGAL', 1, 1, 0, 0, 1, 1),
	(5, 5, 3, 110, 'SALE', 1, 1, 1, 1, 1, 1),
	(6, 7, 1, 103, 'INVALID NUMBER', 1, 0, 0, 0, 3, 1),
	(7, 7, 1, 102, 'NO ANSWER', 1, 0, 0, 0, 2, 0),
	(8, 7, 1, 104, 'MAILBOX', 1, 0, 0, 0, 4, 1),
	(9, 4, 3, 108, 'TIDAK PUNYA KARTU KREDIT', 1, 1, 0, 0, 2, 1),
	(10, 4, 3, 109, 'TIDAK INGIN IKUT PROGRAM', 1, 1, 0, 0, 3, 1),
	(11, 2, 1, 111, 'MEETING', 1, 1, 0, 0, 1, 0),
	(12, 2, 1, 112, 'SEDANG KELUAR / TIDAK DITEMPAT', 1, 1, 0, 0, 2, 0),
	(13, 5, 3, 113, 'SALE RECONFIRM', 1, 1, 1, 0, 15, 1),
	(14, 2, 1, 114, 'WRONG NUMBER', 1, 0, 0, 0, 3, 0),
	(15, 8, 1, 201, 'ASK Information', 1, 0, 0, 0, 3, 0),
	(16, 8, 1, 202, 'Complaint', 1, 0, 0, 0, 3, 0),
	(17, 8, 1, 203, 'Interest', 1, 0, 0, 0, 3, 0);
/*!40000 ALTER TABLE `t_lk_callreason` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_callreasoncategory
DROP TABLE IF EXISTS `t_lk_callreasoncategory`;
CREATE TABLE IF NOT EXISTS `t_lk_callreasoncategory` (
  `CallReasonCategoryId` tinyint(3) unsigned NOT NULL auto_increment,
  `CallReasonCategoryCode` varchar(15) NOT NULL,
  `CallReasonCategoryName` varchar(64) NOT NULL,
  `CallReasonInterest` int(11) NOT NULL,
  `CallReasonCategoryFlags` int(1) unsigned NOT NULL default '1',
  `CallReasonCategoryOrder` int(1) unsigned NOT NULL default '1',
  `CallOutboundGoalsId` tinyint(3) unsigned NOT NULL default '2',
  PRIMARY KEY  (`CallReasonCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='This is a Call Reason Category table which holds call reason';

-- Dumping data for table ajmidb.t_lk_callreasoncategory: ~6 rows (approximately)
DELETE FROM `t_lk_callreasoncategory`;
/*!40000 ALTER TABLE `t_lk_callreasoncategory` DISABLE KEYS */;
INSERT INTO `t_lk_callreasoncategory` (`CallReasonCategoryId`, `CallReasonCategoryCode`, `CallReasonCategoryName`, `CallReasonInterest`, `CallReasonCategoryFlags`, `CallReasonCategoryOrder`, `CallOutboundGoalsId`) VALUES
	(2, 'Not Contacted', 'Not Contacted', 0, 1, 2, 2),
	(3, 'Contacted', 'Contacted', 0, 1, 3, 2),
	(4, 'Not Sale', 'Not Sales', 0, 1, 4, 2),
	(5, 'Sale', 'Sale', 1, 1, 5, 2),
	(7, 'Not Connected', 'Not Connected', 0, 1, 1, 2),
	(8, 'Incoming Call', 'Incoming Call', 1, 1, 1, 1);
/*!40000 ALTER TABLE `t_lk_callreasoncategory` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_campaigntype
DROP TABLE IF EXISTS `t_lk_campaigntype`;
CREATE TABLE IF NOT EXISTS `t_lk_campaigntype` (
  `CampaignTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `CampaignTypeCode` char(3) NOT NULL,
  `CampaignTypeDesc` varchar(100) NOT NULL,
  PRIMARY KEY  (`CampaignTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COMMENT='This is a Campaign Type lookup table which holds all the cam';

-- Dumping data for table ajmidb.t_lk_campaigntype: ~22 rows (approximately)
DELETE FROM `t_lk_campaigntype`;
/*!40000 ALTER TABLE `t_lk_campaigntype` DISABLE KEYS */;
INSERT INTO `t_lk_campaigntype` (`CampaignTypeId`, `CampaignTypeCode`, `CampaignTypeDesc`) VALUES
	(1, 'BAN', 'Banking Regular'),
	(2, 'CCL', 'Cancel and Rejected'),
	(3, 'DUM', 'Dummy'),
	(4, 'FTP', 'Mapping with FTP'),
	(5, 'INB', 'Incoming Calls'),
	(6, 'INH', 'In-house'),
	(7, 'IPM', 'Initial Payment and Mapping'),
	(8, 'IPO', 'Initial Payment Only'),
	(9, 'IPW', 'Initial + Mapping + U/W'),
	(10, 'IWO', 'Initial + Non-mapping + U/W'),
	(11, 'MKT', 'Need Mapping'),
	(12, 'OTB', 'Outbound Program'),
	(13, 'OUB', 'Outbound Program'),
	(14, 'OWN', 'Own Leads'),
	(15, 'UPG', 'Upgrade'),
	(16, 'UWF', 'Underwriting FTP'),
	(17, 'UWH', 'Underwriting In-house'),
	(18, 'UWM', 'Underwriting with Mapping'),
	(19, 'VAM', 'Virtual Account with Mapping'),
	(20, 'VAO', 'Virtual Account Only'),
	(21, 'VER', 'Verification'),
	(22, 'XSL', 'Cross Sell');
/*!40000 ALTER TABLE `t_lk_campaigntype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_campaign_did
DROP TABLE IF EXISTS `t_lk_campaign_did`;
CREATE TABLE IF NOT EXISTS `t_lk_campaign_did` (
  `Id` int(10) NOT NULL auto_increment,
  `DIDName` varchar(10) default NULL,
  `DIDDirection` varchar(50) NOT NULL default '',
  `DIDNumber` char(50) default NULL,
  `DIDFlags` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`DIDDirection`,`Id`),
  KEY `Id` (`Id`),
  KEY `keys` (`DIDName`),
  KEY `key2` (`DIDDirection`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_campaign_did: 4 rows
DELETE FROM `t_lk_campaign_did`;
/*!40000 ALTER TABLE `t_lk_campaign_did` DISABLE KEYS */;
INSERT INTO `t_lk_campaign_did` (`Id`, `DIDName`, `DIDDirection`, `DIDNumber`, `DIDFlags`) VALUES
	(1, 'link1', '29533601', '6287882830168', 1),
	(2, 'link2', '29533602', '6287882830179', 1),
	(3, 'link3', '29533603', '6285216826730', 1),
	(4, 'link4', '29533604', '6285216826735', 1);
/*!40000 ALTER TABLE `t_lk_campaign_did` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_cardtype
DROP TABLE IF EXISTS `t_lk_cardtype`;
CREATE TABLE IF NOT EXISTS `t_lk_cardtype` (
  `CardTypeId` int(10) NOT NULL auto_increment,
  `CardType` int(10) default NULL,
  `CardTypeDesc` varchar(50) default NULL,
  `CardTypeFlag` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`CardTypeId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_cardtype: 3 rows
DELETE FROM `t_lk_cardtype`;
/*!40000 ALTER TABLE `t_lk_cardtype` DISABLE KEYS */;
INSERT INTO `t_lk_cardtype` (`CardTypeId`, `CardType`, `CardTypeDesc`, `CardTypeFlag`) VALUES
	(1, 1, 'VISA CLASSIC', 1),
	(2, 2, 'VISA GOLD', 1),
	(3, 3, 'VISA MEGA CARREFOUR', 1);
/*!40000 ALTER TABLE `t_lk_cardtype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_category
DROP TABLE IF EXISTS `t_lk_category`;
CREATE TABLE IF NOT EXISTS `t_lk_category` (
  `CategoryId` tinyint(3) unsigned NOT NULL auto_increment,
  `Category` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `CategoryCode` char(5) default NULL,
  PRIMARY KEY  (`CategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='This is a Category table which holds the campaign categories';

-- Dumping data for table ajmidb.t_lk_category: ~3 rows (approximately)
DELETE FROM `t_lk_category`;
/*!40000 ALTER TABLE `t_lk_category` DISABLE KEYS */;
INSERT INTO `t_lk_category` (`CategoryId`, `Category`, `Description`, `CategoryCode`) VALUES
	(1, 'CREDIT SHIELD', 'Credit Shield', '100'),
	(2, 'MEGA INVESTA', 'Hospital Insurance', '101'),
	(3, 'PERSONAL ANCIDENT', 'Personal Ancident', '102');
/*!40000 ALTER TABLE `t_lk_category` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_cignacamptype
DROP TABLE IF EXISTS `t_lk_cignacamptype`;
CREATE TABLE IF NOT EXISTS `t_lk_cignacamptype` (
  `CignaCampTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `CignaCampType` varchar(20) NOT NULL,
  PRIMARY KEY  (`CignaCampTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This is a Cigna Campaign Type table which holds Cigna''s camp';

-- Dumping data for table ajmidb.t_lk_cignacamptype: ~4 rows (approximately)
DELETE FROM `t_lk_cignacamptype`;
/*!40000 ALTER TABLE `t_lk_cignacamptype` DISABLE KEYS */;
INSERT INTO `t_lk_cignacamptype` (`CignaCampTypeId`, `CignaCampType`) VALUES
	(1, 'GET'),
	(2, 'BUILD'),
	(3, 'S 2 S'),
	(4, 'WIN BACK');
/*!40000 ALTER TABLE `t_lk_cignacamptype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_cignasystem
DROP TABLE IF EXISTS `t_lk_cignasystem`;
CREATE TABLE IF NOT EXISTS `t_lk_cignasystem` (
  `CignaSystemId` tinyint(3) unsigned NOT NULL auto_increment,
  `CignaSystemCode` char(2) NOT NULL,
  `CignaSystem` varchar(50) NOT NULL,
  PRIMARY KEY  (`CignaSystemId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Cigna System table which holds all Cigna''s systems';

-- Dumping data for table ajmidb.t_lk_cignasystem: ~2 rows (approximately)
DELETE FROM `t_lk_cignasystem`;
/*!40000 ALTER TABLE `t_lk_cignasystem` DISABLE KEYS */;
INSERT INTO `t_lk_cignasystem` (`CignaSystemId`, `CignaSystemCode`, `CignaSystem`) VALUES
	(1, '00', 'System Six'),
	(2, '04', 'System Cicap');
/*!40000 ALTER TABLE `t_lk_cignasystem` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_creditcardtype
DROP TABLE IF EXISTS `t_lk_creditcardtype`;
CREATE TABLE IF NOT EXISTS `t_lk_creditcardtype` (
  `CreditCardTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `CreditCardTypeCode` tinyint(3) unsigned NOT NULL,
  `CreditCardTypeDesc` varchar(50) NOT NULL,
  PRIMARY KEY  (`CreditCardTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Card Type table which holds the credit card type i';

-- Dumping data for table ajmidb.t_lk_creditcardtype: ~2 rows (approximately)
DELETE FROM `t_lk_creditcardtype`;
/*!40000 ALTER TABLE `t_lk_creditcardtype` DISABLE KEYS */;
INSERT INTO `t_lk_creditcardtype` (`CreditCardTypeId`, `CreditCardTypeCode`, `CreditCardTypeDesc`) VALUES
	(1, 80, 'H2H Global Visa'),
	(2, 81, 'H2H Global Mastercard');
/*!40000 ALTER TABLE `t_lk_creditcardtype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_cutoffdate
DROP TABLE IF EXISTS `t_lk_cutoffdate`;
CREATE TABLE IF NOT EXISTS `t_lk_cutoffdate` (
  `CutoffDateId` int(10) unsigned NOT NULL auto_increment,
  `CutoffMonth` char(2) NOT NULL default '0',
  `CutoffDate` date NOT NULL,
  PRIMARY KEY  (`CutoffDateId`,`CutoffMonth`),
  UNIQUE KEY `CutoffMonth` (`CutoffMonth`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1 COMMENT='This is a Cutoff Date table which holds all cutoff dates in ';

-- Dumping data for table ajmidb.t_lk_cutoffdate: ~12 rows (approximately)
DELETE FROM `t_lk_cutoffdate`;
/*!40000 ALTER TABLE `t_lk_cutoffdate` DISABLE KEYS */;
INSERT INTO `t_lk_cutoffdate` (`CutoffDateId`, `CutoffMonth`, `CutoffDate`) VALUES
	(29, '01', '2013-01-26'),
	(38, '02', '2013-02-25'),
	(39, '03', '2013-03-25'),
	(40, '04', '2013-04-25'),
	(41, '05', '2013-05-24'),
	(42, '06', '2013-06-25'),
	(43, '07', '2013-07-23'),
	(44, '08', '2013-08-26'),
	(45, '09', '2013-09-25'),
	(46, '10', '2013-10-24'),
	(47, '11', '2013-11-25'),
	(48, '12', '2013-12-20');
/*!40000 ALTER TABLE `t_lk_cutoffdate` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_direction_action
DROP TABLE IF EXISTS `t_lk_direction_action`;
CREATE TABLE IF NOT EXISTS `t_lk_direction_action` (
  `ActionId` int(10) NOT NULL auto_increment,
  `ActionCode` int(10) default NULL,
  `ActionName` varchar(20) default NULL,
  `ActionFlags` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`ActionId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_direction_action: 2 rows
DELETE FROM `t_lk_direction_action`;
/*!40000 ALTER TABLE `t_lk_direction_action` DISABLE KEYS */;
INSERT INTO `t_lk_direction_action` (`ActionId`, `ActionCode`, `ActionName`, `ActionFlags`) VALUES
	(1, 1, 'Duplicate', 1),
	(2, 2, 'Replace', 1);
/*!40000 ALTER TABLE `t_lk_direction_action` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_direct_method
DROP TABLE IF EXISTS `t_lk_direct_method`;
CREATE TABLE IF NOT EXISTS `t_lk_direct_method` (
  `MethodId` int(10) unsigned NOT NULL auto_increment,
  `MethodCode` int(10) unsigned NOT NULL default '0',
  `MethodName` varchar(50) NOT NULL default '',
  `MenthodFlags` tinyint(1) default NULL,
  PRIMARY KEY  (`MethodId`,`MethodCode`),
  KEY `MethodCode` (`MethodCode`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_direct_method: 2 rows
DELETE FROM `t_lk_direct_method`;
/*!40000 ALTER TABLE `t_lk_direct_method` DISABLE KEYS */;
INSERT INTO `t_lk_direct_method` (`MethodId`, `MethodCode`, `MethodName`, `MenthodFlags`) VALUES
	(1, 1, 'Direct', 1),
	(2, 2, 'Manual', 1);
/*!40000 ALTER TABLE `t_lk_direct_method` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_effectivedate
DROP TABLE IF EXISTS `t_lk_effectivedate`;
CREATE TABLE IF NOT EXISTS `t_lk_effectivedate` (
  `EffectiveDateId` int(10) unsigned NOT NULL auto_increment,
  `CutoffDateId` int(10) unsigned NOT NULL COMMENT 'Must match [T_LK_CutoffDate].CutoffDateId',
  `EffectiveDateProdDate` date NOT NULL,
  `EffectiveDate` date NOT NULL,
  PRIMARY KEY  (`EffectiveDateId`),
  KEY `FK_EffectiveDate_CutoffDateId` (`CutoffDateId`),
  CONSTRAINT `FK_EffectiveDate_CutoffDateId` FOREIGN KEY (`CutoffDateId`) REFERENCES `t_lk_cutoffdate` (`CutoffDateId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is an Effective Date table which holds all effective da';

-- Dumping data for table ajmidb.t_lk_effectivedate: ~0 rows (approximately)
DELETE FROM `t_lk_effectivedate`;
/*!40000 ALTER TABLE `t_lk_effectivedate` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_lk_effectivedate` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_gender
DROP TABLE IF EXISTS `t_lk_gender`;
CREATE TABLE IF NOT EXISTS `t_lk_gender` (
  `GenderId` tinyint(3) unsigned NOT NULL auto_increment,
  `GenderCode` char(2) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `GenderShortCode` char(1) NOT NULL,
  `GenderIndonesia` varchar(20) NOT NULL,
  PRIMARY KEY  (`GenderId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Gender table which holds the gender codes and desc';

-- Dumping data for table ajmidb.t_lk_gender: ~2 rows (approximately)
DELETE FROM `t_lk_gender`;
/*!40000 ALTER TABLE `t_lk_gender` DISABLE KEYS */;
INSERT INTO `t_lk_gender` (`GenderId`, `GenderCode`, `Gender`, `GenderShortCode`, `GenderIndonesia`) VALUES
	(1, '01', 'Male', 'M', 'LAKI-LAKI'),
	(2, '02', 'Female', 'F', 'PEREMPUAN');
/*!40000 ALTER TABLE `t_lk_gender` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_identificationtype
DROP TABLE IF EXISTS `t_lk_identificationtype`;
CREATE TABLE IF NOT EXISTS `t_lk_identificationtype` (
  `IdentificationTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `IdentificationType` varchar(10) default NULL,
  PRIMARY KEY  (`IdentificationTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This is an Identification Type table which holds valid types';

-- Dumping data for table ajmidb.t_lk_identificationtype: ~4 rows (approximately)
DELETE FROM `t_lk_identificationtype`;
/*!40000 ALTER TABLE `t_lk_identificationtype` DISABLE KEYS */;
INSERT INTO `t_lk_identificationtype` (`IdentificationTypeId`, `IdentificationType`) VALUES
	(1, 'KTP'),
	(2, 'SIM'),
	(3, 'PASPOR'),
	(4, NULL);
/*!40000 ALTER TABLE `t_lk_identificationtype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_outbound_goals
DROP TABLE IF EXISTS `t_lk_outbound_goals`;
CREATE TABLE IF NOT EXISTS `t_lk_outbound_goals` (
  `OutboundGoalsId` int(10) unsigned NOT NULL auto_increment,
  `Name` varchar(15) NOT NULL default '',
  `Description` varchar(200) default NULL,
  `Flags` int(10) default NULL,
  PRIMARY KEY  (`Name`,`OutboundGoalsId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_outbound_goals: 2 rows
DELETE FROM `t_lk_outbound_goals`;
/*!40000 ALTER TABLE `t_lk_outbound_goals` DISABLE KEYS */;
INSERT INTO `t_lk_outbound_goals` (`OutboundGoalsId`, `Name`, `Description`, `Flags`) VALUES
	(1, 'Inbound', 'Inbound Call ', 1),
	(2, 'Outbound', 'Outbound Call ', 1);
/*!40000 ALTER TABLE `t_lk_outbound_goals` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_paymenttype
DROP TABLE IF EXISTS `t_lk_paymenttype`;
CREATE TABLE IF NOT EXISTS `t_lk_paymenttype` (
  `PaymentTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `PaymentTypeCode` tinyint(3) unsigned NOT NULL,
  `PaymentTypeDesc` varchar(50) NOT NULL,
  PRIMARY KEY  (`PaymentTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='This is a Payment Type table which holds types of payment.';

-- Dumping data for table ajmidb.t_lk_paymenttype: ~3 rows (approximately)
DELETE FROM `t_lk_paymenttype`;
/*!40000 ALTER TABLE `t_lk_paymenttype` DISABLE KEYS */;
INSERT INTO `t_lk_paymenttype` (`PaymentTypeId`, `PaymentTypeCode`, `PaymentTypeDesc`) VALUES
	(1, 10, 'Credit Card'),
	(2, 20, 'Saving'),
	(3, 80, 'Virtual Account');
/*!40000 ALTER TABLE `t_lk_paymenttype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_paymode
DROP TABLE IF EXISTS `t_lk_paymode`;
CREATE TABLE IF NOT EXISTS `t_lk_paymode` (
  `PayModeId` tinyint(3) unsigned NOT NULL auto_increment,
  `PayMode` varchar(10) NOT NULL,
  `PayModeCode` char(1) NOT NULL,
  PRIMARY KEY  (`PayModeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Pay Mode table which holds payment modes.';

-- Dumping data for table ajmidb.t_lk_paymode: ~2 rows (approximately)
DELETE FROM `t_lk_paymode`;
/*!40000 ALTER TABLE `t_lk_paymode` DISABLE KEYS */;
INSERT INTO `t_lk_paymode` (`PayModeId`, `PayMode`, `PayModeCode`) VALUES
	(1, 'Annually', 'A'),
	(2, 'Monthly', 'M');
/*!40000 ALTER TABLE `t_lk_paymode` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_phonetype
DROP TABLE IF EXISTS `t_lk_phonetype`;
CREATE TABLE IF NOT EXISTS `t_lk_phonetype` (
  `PhoneTypeId` int(10) NOT NULL auto_increment,
  `PhoneType` int(10) default NULL,
  `PhoneDesc` varchar(50) default NULL,
  `FlagStatusActive` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`PhoneTypeId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ajmidb.t_lk_phonetype: 5 rows
DELETE FROM `t_lk_phonetype`;
/*!40000 ALTER TABLE `t_lk_phonetype` DISABLE KEYS */;
INSERT INTO `t_lk_phonetype` (`PhoneTypeId`, `PhoneType`, `PhoneDesc`, `FlagStatusActive`) VALUES
	(1, 1, 'Home', 1),
	(2, 2, 'Office', 1),
	(3, 3, 'Mobile', 1),
	(4, 4, 'Family', 0),
	(5, 5, 'Neighbor', 0);
/*!40000 ALTER TABLE `t_lk_phonetype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_premiumgroup
DROP TABLE IF EXISTS `t_lk_premiumgroup`;
CREATE TABLE IF NOT EXISTS `t_lk_premiumgroup` (
  `PremiumGroupId` tinyint(3) unsigned NOT NULL auto_increment,
  `PremiumGroupCode` char(2) NOT NULL,
  `PremiumGroupName` char(20) NOT NULL,
  `PremiumGroupDesc` varchar(20) NOT NULL,
  `PremiumGroupOrder` tinyint(2) NOT NULL,
  PRIMARY KEY  (`PremiumGroupId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This is a Premium Group table which holds all the premium gr';

-- Dumping data for table ajmidb.t_lk_premiumgroup: ~4 rows (approximately)
DELETE FROM `t_lk_premiumgroup`;
/*!40000 ALTER TABLE `t_lk_premiumgroup` DISABLE KEYS */;
INSERT INTO `t_lk_premiumgroup` (`PremiumGroupId`, `PremiumGroupCode`, `PremiumGroupName`, `PremiumGroupDesc`, `PremiumGroupOrder`) VALUES
	(1, 'DP', 'Anak', 'Dependent', 3),
	(2, 'MI', 'Diri Sendiri', 'Main Insured', 1),
	(3, 'SP', 'Istri/Suami', 'Spouse', 2),
	(4, 'OT', 'Orang Tua', 'Other', 4);
/*!40000 ALTER TABLE `t_lk_premiumgroup` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_producttype
DROP TABLE IF EXISTS `t_lk_producttype`;
CREATE TABLE IF NOT EXISTS `t_lk_producttype` (
  `ProductTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `ProductType` varchar(5) NOT NULL,
  PRIMARY KEY  (`ProductTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COMMENT='This is a Product Type table which holds types of product av';

-- Dumping data for table ajmidb.t_lk_producttype: ~2 rows (approximately)
DELETE FROM `t_lk_producttype`;
/*!40000 ALTER TABLE `t_lk_producttype` DISABLE KEYS */;
INSERT INTO `t_lk_producttype` (`ProductTypeId`, `ProductType`) VALUES
	(1, 'HIP'),
	(2, 'PA');
/*!40000 ALTER TABLE `t_lk_producttype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_province
DROP TABLE IF EXISTS `t_lk_province`;
CREATE TABLE IF NOT EXISTS `t_lk_province` (
  `ProvinceId` tinyint(3) unsigned NOT NULL auto_increment,
  `ProvinceCode` char(2) NOT NULL,
  `Province` varchar(100) NOT NULL,
  PRIMARY KEY  (`ProvinceId`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1 COMMENT='This is a Province lookup table which holds all the province';

-- Dumping data for table ajmidb.t_lk_province: ~33 rows (approximately)
DELETE FROM `t_lk_province`;
/*!40000 ALTER TABLE `t_lk_province` DISABLE KEYS */;
INSERT INTO `t_lk_province` (`ProvinceId`, `ProvinceCode`, `Province`) VALUES
	(1, '01', 'Aceh'),
	(2, '03', 'Bali'),
	(3, '05', 'Bangka-Belitung'),
	(4, '07', 'Banten'),
	(5, '09', 'Bengkulu'),
	(6, '11', 'DI Yogyakarta'),
	(7, '13', 'DKI Jaya'),
	(8, '15', 'Gorontalo'),
	(9, '17', 'Irian Jaya'),
	(10, '19', 'Irian Jaya Timur'),
	(11, '20', 'Jambi'),
	(12, '21', 'Jawa Barat'),
	(13, '23', 'Jawa Tengah'),
	(14, '25', 'Jawa Timur'),
	(15, '27', 'Kalimantan Barat'),
	(16, '28', 'Kalimantan Selatan'),
	(17, '29', 'Kalimantan Tengah'),
	(18, 'aa', 'Kalimantan Timur'),
	(19, 'ab', 'Lampung'),
	(20, 'ac', 'Maluku'),
	(21, 'ad', 'Maluku Utara'),
	(22, 'ae', 'Nusa Tenggara Barat'),
	(23, 'af', 'Nusa Tenggara Timur'),
	(24, 'ag', 'Riau'),
	(25, 'ah', 'Riau Kepulauan'),
	(26, 'ai', 'Sulawesi Selatan'),
	(27, 'aj', 'Sulawesi Tengah'),
	(28, 'ak', 'Sulawesi Tenggara'),
	(29, 'al', 'Sulawesi Utara'),
	(30, 'am', 'Sumatera Barat'),
	(31, 'an', 'Sumatera Selatan'),
	(32, 'ao', 'Sumatera Utara'),
	(100, '', '');
/*!40000 ALTER TABLE `t_lk_province` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_relationshiptype
DROP TABLE IF EXISTS `t_lk_relationshiptype`;
CREATE TABLE IF NOT EXISTS `t_lk_relationshiptype` (
  `RelationshipTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `RelationshipTypeCode` char(2) NOT NULL,
  `RelationshipTypeDesc` varchar(100) NOT NULL,
  `RelationshipTypeFlags` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`RelationshipTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1 COMMENT='This is a Relationship Type table which holds all the relati';

-- Dumping data for table ajmidb.t_lk_relationshiptype: ~29 rows (approximately)
DELETE FROM `t_lk_relationshiptype`;
/*!40000 ALTER TABLE `t_lk_relationshiptype` DISABLE KEYS */;
INSERT INTO `t_lk_relationshiptype` (`RelationshipTypeId`, `RelationshipTypeCode`, `RelationshipTypeDesc`, `RelationshipTypeFlags`) VALUES
	(1, '1', 'Diri Sendiri', 1),
	(2, '2', 'Orang tua kandung', 1),
	(3, '3', 'Debitur/Kreditur', 1),
	(4, '4', 'Anak kandung', 1),
	(5, '5', 'Adik Kandung', 1),
	(6, '6', 'Kerja/Majikan-Karyawan', 1),
	(7, '7', 'Kakak Kandung', 1),
	(8, '8', 'Anak Angkat / Didik', 1),
	(9, '9', 'Keponakan', 1),
	(10, '10', 'Nenek/Kakek Kandung', 1),
	(11, '11', 'Rekan Kerja', 1),
	(12, '12', 'Saudara', 1),
	(13, '13', 'Cucu/Cicit', 1),
	(14, '14', 'Tante', 1),
	(15, '15', 'Kreditur', 1),
	(16, '16', 'Paman', 1),
	(17, '17', 'Orang Tua Angkat', 1),
	(18, '18', 'Saudara Angkat', 1),
	(19, '19', 'Sepupu', 1),
	(20, '21', 'Anak Tiri', 1),
	(21, '22', 'Anak Rohani', 1),
	(22, '23', 'Mertua', 1),
	(23, '24', 'Suami', 1),
	(24, '25', 'Istri', 1),
	(25, '26', 'Ayah', 1),
	(26, '27', 'Ibu', 1),
	(27, '28', 'Anak', 1),
	(28, '29', 'Kakak', 1),
	(29, '30', 'Adik', 1);
/*!40000 ALTER TABLE `t_lk_relationshiptype` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_relationshiptype_copy
DROP TABLE IF EXISTS `t_lk_relationshiptype_copy`;
CREATE TABLE IF NOT EXISTS `t_lk_relationshiptype_copy` (
  `RelationshipTypeId` tinyint(3) unsigned NOT NULL auto_increment,
  `RelationshipTypeCode` char(2) NOT NULL,
  `RelationshipTypeDesc` varchar(100) NOT NULL,
  PRIMARY KEY  (`RelationshipTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='This is a Relationship Type table which holds all the relati';

-- Dumping data for table ajmidb.t_lk_relationshiptype_copy: ~37 rows (approximately)
DELETE FROM `t_lk_relationshiptype_copy`;
/*!40000 ALTER TABLE `t_lk_relationshiptype_copy` DISABLE KEYS */;
INSERT INTO `t_lk_relationshiptype_copy` (`RelationshipTypeId`, `RelationshipTypeCode`, `RelationshipTypeDesc`) VALUES
	(1, '01', 'Husband'),
	(2, '02', 'Wife'),
	(3, '03', 'Son'),
	(4, '04', 'Daugther'),
	(5, '05', 'Dependent'),
	(6, '06', 'Father'),
	(7, '07', 'Mother'),
	(8, '08', 'Spouse'),
	(9, '09', 'Brother'),
	(10, '10', 'Sister'),
	(11, '99', 'Unknown'),
	(12, 'aa', 'Kakek'),
	(13, 'ab', 'Nenek'),
	(14, 'ac', 'Ibu Kandung'),
	(15, 'ad', 'Ayah Kandung'),
	(16, 'ae', 'Paman'),
	(17, 'af', 'Tante'),
	(18, 'ag', 'Saudara Kadung'),
	(19, 'ah', 'Saudara Sepupu'),
	(20, 'ai', 'Suami'),
	(21, 'aj', 'Istri'),
	(22, 'ak', 'Anak Kandung'),
	(23, 'al', 'Keponakan'),
	(24, 'am', 'Cucu'),
	(25, 'an', 'Ahli Waris'),
	(26, 'ao', 'Tidak Disebut'),
	(27, 'ap', 'Grandfather'),
	(28, 'aq', 'Grandmother'),
	(29, 'ar', 'Uncle'),
	(30, 'as', 'Aunt'),
	(31, 'at', 'Cousin'),
	(32, 'au', 'Niece'),
	(33, 'av', 'Nephew'),
	(34, 'aw', 'Grandson'),
	(35, 'ax', 'Granddaugther'),
	(36, 'BN', 'Beneficiary/Other'),
	(37, 'PH', 'Policy Holder/Self');
/*!40000 ALTER TABLE `t_lk_relationshiptype_copy` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_reuploadreason
DROP TABLE IF EXISTS `t_lk_reuploadreason`;
CREATE TABLE IF NOT EXISTS `t_lk_reuploadreason` (
  `ReUploadReasonId` tinyint(3) unsigned NOT NULL auto_increment,
  `ReUploadReason` varchar(100) NOT NULL,
  PRIMARY KEY  (`ReUploadReasonId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='This is a Re-Upload Reason table which holds re-upload reaso';

-- Dumping data for table ajmidb.t_lk_reuploadreason: ~4 rows (approximately)
DELETE FROM `t_lk_reuploadreason`;
/*!40000 ALTER TABLE `t_lk_reuploadreason` DISABLE KEYS */;
INSERT INTO `t_lk_reuploadreason` (`ReUploadReasonId`, `ReUploadReason`) VALUES
	(1, 'Move'),
	(2, 'Offering another product'),
	(3, 'Re-upload previous campaign'),
	(4, 'Wrong upload');
/*!40000 ALTER TABLE `t_lk_reuploadreason` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_salutation
DROP TABLE IF EXISTS `t_lk_salutation`;
CREATE TABLE IF NOT EXISTS `t_lk_salutation` (
  `SalutationId` tinyint(3) unsigned NOT NULL auto_increment,
  `SalutationCode` char(2) NOT NULL,
  `Salutation` varchar(20) NOT NULL,
  PRIMARY KEY  (`SalutationId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COMMENT='This is a Salutation lookup table which holds all available ';

-- Dumping data for table ajmidb.t_lk_salutation: ~36 rows (approximately)
DELETE FROM `t_lk_salutation`;
/*!40000 ALTER TABLE `t_lk_salutation` DISABLE KEYS */;
INSERT INTO `t_lk_salutation` (`SalutationId`, `SalutationCode`, `Salutation`) VALUES
	(1, '01', 'Mr.'),
	(2, '02', 'Mrs.'),
	(3, '03', 'Ms.'),
	(4, '04', 'Dr.'),
	(5, '05', 'dr.'),
	(6, '06', 'drg.'),
	(7, '08', 'drh.'),
	(8, '09', 'Prof.'),
	(9, '10', 'Dra.'),
	(10, '11', 'Drs.'),
	(11, '12', 'Hj.'),
	(12, '13', 'YB'),
	(13, '14', 'YM'),
	(14, '15', 'Tun'),
	(15, '16', 'Dato'),
	(16, '17', 'Datuk'),
	(17, '18', 'Datin'),
	(18, '19', 'Datuk Sri'),
	(19, '20', 'Datin Sri'),
	(20, '21', 'YAM'),
	(21, '22', 'En'),
	(22, '23', 'Tuan'),
	(23, '24', 'Puan'),
	(24, '25', 'Cik'),
	(25, '26', 'Tn Haji'),
	(26, '27', 'Pn Hjk'),
	(27, '28', 'Ir.'),
	(28, '29', 'Major'),
	(29, '30', 'Major Dr'),
	(30, '31', 'Tengku'),
	(31, '32', 'Ungku'),
	(32, '33', 'H.'),
	(33, '34', 'Pdt.'),
	(34, '99', '_'),
	(35, 'aa', 'Bp.'),
	(36, 'ab', 'Ibu');
/*!40000 ALTER TABLE `t_lk_salutation` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_sponsor
DROP TABLE IF EXISTS `t_lk_sponsor`;
CREATE TABLE IF NOT EXISTS `t_lk_sponsor` (
  `SponsorId` tinyint(3) unsigned NOT NULL auto_increment,
  `SponsorSourceCode` varchar(8) NOT NULL,
  `SponsorDBCode` varchar(8) NOT NULL,
  `SponsorCode` varchar(8) NOT NULL,
  `SponsorName` varchar(50) NOT NULL,
  PRIMARY KEY  (`SponsorId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='This is a Sponsor table which holds sponsor information.';

-- Dumping data for table ajmidb.t_lk_sponsor: ~1 rows (approximately)
DELETE FROM `t_lk_sponsor`;
/*!40000 ALTER TABLE `t_lk_sponsor` DISABLE KEYS */;
INSERT INTO `t_lk_sponsor` (`SponsorId`, `SponsorSourceCode`, `SponsorDBCode`, `SponsorCode`, `SponsorName`) VALUES
	(1, 'MIS-03', 'NXO-09', 'B41', 'PT. Mitra Inti Selaras');
/*!40000 ALTER TABLE `t_lk_sponsor` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_validccprefix
DROP TABLE IF EXISTS `t_lk_validccprefix`;
CREATE TABLE IF NOT EXISTS `t_lk_validccprefix` (
  `ValidCCPrefixId` int(10) unsigned NOT NULL auto_increment,
  `BankId` tinyint(3) unsigned default NULL,
  `ValidCCPrefix` varchar(10) NOT NULL,
  `ValidCCPrefixNote` varchar(100) NOT NULL,
  PRIMARY KEY  (`ValidCCPrefixId`),
  KEY `FK_ValidCCPrefix_BankId` (`BankId`),
  CONSTRAINT `FK_ValidCCPrefix_BankId` FOREIGN KEY (`BankId`) REFERENCES `t_lk_bank` (`BankId`)
) ENGINE=InnoDB AUTO_INCREMENT=230 DEFAULT CHARSET=latin1 COMMENT='This is a Valid Credit Card Prefix table which holds valid (';

-- Dumping data for table ajmidb.t_lk_validccprefix: ~228 rows (approximately)
DELETE FROM `t_lk_validccprefix`;
/*!40000 ALTER TABLE `t_lk_validccprefix` DISABLE KEYS */;
INSERT INTO `t_lk_validccprefix` (`ValidCCPrefixId`, `BankId`, `ValidCCPrefix`, `ValidCCPrefixNote`) VALUES
	(1, NULL, '436502', 'H2H Global Mastercard'),
	(2, NULL, '510217', 'H2H Global Mastercard'),
	(3, NULL, '512021', 'H2H Global Mastercard'),
	(4, NULL, '512676', 'H2H Global Mastercard'),
	(5, NULL, '512765', 'H2H Global Mastercard'),
	(6, NULL, '515647', 'H2H Global Mastercard'),
	(7, NULL, '518323', 'H2H Global Mastercard'),
	(8, NULL, '518446', 'H2H Global Mastercard'),
	(9, NULL, '518494', 'H2H Global Mastercard'),
	(10, NULL, '518535', 'H2H Global Mastercard'),
	(11, NULL, '518828', 'H2H Global Mastercard'),
	(12, NULL, '518856', 'H2H Global Mastercard'),
	(13, NULL, '518884', 'H2H Global Mastercard'),
	(14, NULL, '518943', 'H2H Global Mastercard'),
	(15, NULL, '519311', 'H2H Global Mastercard'),
	(16, NULL, '520037', 'H2H Global Mastercard'),
	(17, NULL, '520166', 'H2H Global Mastercard'),
	(18, NULL, '520191', 'H2H Global Mastercard'),
	(19, NULL, '520366', 'H2H Global Mastercard'),
	(20, NULL, '520370', 'H2H Global Mastercard'),
	(21, NULL, '520371', 'H2H Global Mastercard'),
	(22, NULL, '520373', 'H2H Global Mastercard'),
	(23, NULL, '521343', 'H2H Global Mastercard'),
	(24, NULL, '521896', 'H2H Global Mastercard'),
	(25, NULL, '522028', 'H2H Global Mastercard'),
	(26, NULL, '522846', 'H2H Global Mastercard'),
	(27, NULL, '523026', 'H2H Global Mastercard'),
	(28, NULL, '523940', 'H2H Global Mastercard'),
	(29, NULL, '523983', 'H2H Global Mastercard'),
	(30, NULL, '524064', 'H2H Global Mastercard'),
	(31, NULL, '524069', 'H2H Global Mastercard'),
	(32, NULL, '524169', 'H2H Global Mastercard'),
	(33, NULL, '524319', 'H2H Global Mastercard'),
	(34, NULL, '524325', 'H2H Global Mastercard'),
	(35, NULL, '525644', 'H2H Global Mastercard'),
	(36, NULL, '526853', 'H2H Global Mastercard'),
	(37, NULL, '527460', 'H2H Global Mastercard'),
	(38, NULL, '528872', 'H2H Global Mastercard'),
	(39, NULL, '528912', 'H2H Global Mastercard'),
	(40, NULL, '528913', 'H2H Global Mastercard'),
	(41, NULL, '528919', 'H2H Global Mastercard'),
	(42, NULL, '529984', 'H2H Global Mastercard'),
	(43, NULL, '531857', 'H2H Global Mastercard'),
	(44, NULL, '533619', 'H2H Global Mastercard'),
	(45, NULL, '537705', 'H2H Global Mastercard'),
	(46, NULL, '540174', 'H2H Global Mastercard'),
	(47, NULL, '540184', 'H2H Global Mastercard'),
	(48, NULL, '540462', 'H2H Global Mastercard'),
	(49, NULL, '540468', 'H2H Global Mastercard'),
	(50, NULL, '540469', 'H2H Global Mastercard'),
	(51, NULL, '540731', 'H2H Global Mastercard'),
	(52, NULL, '540890', 'H2H Global Mastercard'),
	(53, NULL, '540891', 'H2H Global Mastercard'),
	(54, NULL, '541067', 'H2H Global Mastercard'),
	(55, NULL, '541069', 'H2H Global Mastercard'),
	(56, NULL, '541070', 'H2H Global Mastercard'),
	(57, NULL, '541078', 'H2H Global Mastercard'),
	(58, NULL, '541616', 'H2H Global Mastercard'),
	(59, NULL, '542064', 'H2H Global Mastercard'),
	(60, NULL, '542177', 'H2H Global Mastercard'),
	(61, NULL, '542181', 'H2H Global Mastercard'),
	(62, NULL, '542260', 'H2H Global Mastercard'),
	(63, NULL, '542448', 'H2H Global Mastercard'),
	(64, NULL, '542466', 'H2H Global Mastercard'),
	(65, NULL, '542651', 'H2H Global Mastercard'),
	(66, NULL, '543248', 'H2H Global Mastercard'),
	(67, NULL, '543415', 'H2H Global Mastercard'),
	(68, NULL, '543730', 'H2H Global Mastercard'),
	(69, NULL, '543972', 'H2H Global Mastercard'),
	(70, NULL, '544304', 'H2H Global Mastercard'),
	(71, NULL, '544305', 'H2H Global Mastercard'),
	(72, NULL, '544741', 'H2H Global Mastercard'),
	(73, NULL, '545281', 'H2H Global Mastercard'),
	(74, NULL, '546592', 'H2H Global Mastercard'),
	(75, NULL, '546593', 'H2H Global Mastercard'),
	(76, NULL, '547332', 'H2H Global Mastercard'),
	(77, NULL, '547370', 'H2H Global Mastercard'),
	(78, NULL, '547398', 'H2H Global Mastercard'),
	(79, NULL, '548198', 'H2H Global Mastercard'),
	(80, NULL, '548199', 'H2H Global Mastercard'),
	(81, NULL, '548296', 'H2H Global Mastercard'),
	(82, NULL, '548297', 'H2H Global Mastercard'),
	(83, NULL, '549113', 'H2H Global Mastercard'),
	(84, NULL, '552002', 'H2H Global Mastercard'),
	(85, NULL, '552008', 'H2H Global Mastercard'),
	(86, NULL, '552042', 'H2H Global Mastercard'),
	(87, NULL, '552115', 'H2H Global Mastercard'),
	(88, NULL, '552239', 'H2H Global Mastercard'),
	(89, NULL, '552338', 'H2H Global Mastercard'),
	(90, NULL, '552829', 'H2H Global Mastercard'),
	(91, NULL, '552884', 'H2H Global Mastercard'),
	(92, NULL, '557799', 'H2H Global Mastercard'),
	(93, NULL, '558284', 'H2H Global Mastercard'),
	(94, NULL, '589587', 'H2H Global Mastercard'),
	(95, NULL, '400934', 'H2H Global Visa'),
	(96, NULL, '402695', 'H2H Global Visa'),
	(97, NULL, '402736', 'H2H Global Visa'),
	(98, NULL, '404776', 'H2H Global Visa'),
	(99, NULL, '405515', 'H2H Global Visa'),
	(100, NULL, '405516', 'H2H Global Visa'),
	(101, NULL, '405542', 'H2H Global Visa'),
	(102, NULL, '405577', 'H2H Global Visa'),
	(103, NULL, '409675', 'H2H Global Visa'),
	(104, NULL, '410504', 'H2H Global Visa'),
	(105, NULL, '410506', 'H2H Global Visa'),
	(106, NULL, '412933', 'H2H Global Visa'),
	(107, NULL, '412934', 'H2H Global Visa'),
	(108, NULL, '412935', 'H2H Global Visa'),
	(109, NULL, '413718', 'H2H Global Visa'),
	(110, NULL, '413719', 'H2H Global Visa'),
	(111, NULL, '414009', 'H2H Global Visa'),
	(112, NULL, '414397', 'H2H Global Visa'),
	(113, NULL, '415735', 'H2H Global Visa'),
	(114, NULL, '415736', 'H2H Global Visa'),
	(115, NULL, '420183', 'H2H Global Visa'),
	(116, NULL, '420191', 'H2H Global Visa'),
	(117, NULL, '420192', 'H2H Global Visa'),
	(118, NULL, '420194', 'H2H Global Visa'),
	(119, NULL, '420978', 'H2H Global Visa'),
	(120, NULL, '421141', 'H2H Global Visa'),
	(121, NULL, '421570', 'H2H Global Visa'),
	(122, NULL, '421920', 'H2H Global Visa'),
	(123, NULL, '424103', 'H2H Global Visa'),
	(124, NULL, '425857', 'H2H Global Visa'),
	(125, NULL, '425945', 'H2H Global Visa'),
	(126, NULL, '426013', 'H2H Global Visa'),
	(127, NULL, '426535', 'H2H Global Visa'),
	(128, NULL, '428107', 'H2H Global Visa'),
	(129, NULL, '428416', 'H2H Global Visa'),
	(130, NULL, '429301', 'H2H Global Visa'),
	(131, NULL, '429750', 'H2H Global Visa'),
	(132, NULL, '430978', 'H2H Global Visa'),
	(133, NULL, '430980', 'H2H Global Visa'),
	(134, NULL, '430981', 'H2H Global Visa'),
	(135, NULL, '431181', 'H2H Global Visa'),
	(136, NULL, '431182', 'H2H Global Visa'),
	(137, NULL, '432449', 'H2H Global Visa'),
	(138, NULL, '433612', 'H2H Global Visa'),
	(139, NULL, '433613', 'H2H Global Visa'),
	(140, NULL, '433683', 'H2H Global Visa'),
	(141, NULL, '434075', 'H2H Global Visa'),
	(142, NULL, '434098', 'H2H Global Visa'),
	(143, NULL, '434099', 'H2H Global Visa'),
	(144, NULL, '436502', 'H2H Global Visa'),
	(145, NULL, '436799', 'H2H Global Visa'),
	(146, NULL, '437527', 'H2H Global Visa'),
	(147, NULL, '437700', 'H2H Global Visa'),
	(148, NULL, '437701', 'H2H Global Visa'),
	(149, NULL, '439040', 'H2H Global Visa'),
	(150, NULL, '439043', 'H2H Global Visa'),
	(151, NULL, '439062', 'H2H Global Visa'),
	(152, NULL, '445076', 'H2H Global Visa'),
	(153, NULL, '445377', 'H2H Global Visa'),
	(154, NULL, '447211', 'H2H Global Visa'),
	(155, NULL, '447242', 'H2H Global Visa'),
	(156, NULL, '450722', 'H2H Global Visa'),
	(157, NULL, '451197', 'H2H Global Visa'),
	(158, NULL, '451249', 'H2H Global Visa'),
	(159, NULL, '451285', 'H2H Global Visa'),
	(160, NULL, '451286', 'H2H Global Visa'),
	(161, NULL, '452485', 'H2H Global Visa'),
	(162, NULL, '452486', 'H2H Global Visa'),
	(163, NULL, '454178', 'H2H Global Visa'),
	(164, NULL, '454493', 'H2H Global Visa'),
	(165, NULL, '454677', 'H2H Global Visa'),
	(166, NULL, '455770', 'H2H Global Visa'),
	(167, NULL, '456798', 'H2H Global Visa'),
	(168, NULL, '456878', 'H2H Global Visa'),
	(169, NULL, '456879', 'H2H Global Visa'),
	(170, NULL, '458769', 'H2H Global Visa'),
	(171, NULL, '458785', 'H2H Global Visa'),
	(172, NULL, '461662', 'H2H Global Visa'),
	(173, NULL, '461663', 'H2H Global Visa'),
	(174, NULL, '463199', 'H2H Global Visa'),
	(175, NULL, '463722', 'H2H Global Visa'),
	(176, NULL, '464005', 'H2H Global Visa'),
	(177, NULL, '464583', 'H2H Global Visa'),
	(178, NULL, '472802', 'H2H Global Visa'),
	(179, NULL, '478487', 'H2H Global Visa'),
	(180, NULL, '483574', 'H2H Global Visa'),
	(181, NULL, '483575', 'H2H Global Visa'),
	(182, NULL, '485764', 'H2H Global Visa'),
	(183, NULL, '489087', 'H2H Global Visa'),
	(184, NULL, '489781', 'H2H Global Visa'),
	(185, NULL, '490283', 'H2H Global Visa'),
	(186, NULL, '490284', 'H2H Global Visa'),
	(187, NULL, '490294', 'H2H Global Visa'),
	(188, NULL, '490295', 'H2H Global Visa'),
	(189, NULL, '490296', 'H2H Global Visa'),
	(190, NULL, '490702', 'H2H Global Visa'),
	(191, NULL, '493496', 'H2H Global Visa'),
	(192, NULL, '493497', 'H2H Global Visa'),
	(193, NULL, '493498', 'H2H Global Visa'),
	(194, NULL, '496698', 'H2H Global Visa'),
	(195, NULL, '548415', 'H2H Global Visa'),
	(196, NULL, '455632', 'H2H Global Visa'),
	(197, NULL, '541322', 'H2H Global Mastercard'),
	(198, NULL, '410505', 'H2H Global Visa'),
	(199, NULL, '548117', 'H2H Global Mastercard'),
	(201, NULL, '421167', 'H2H Global Visa'),
	(202, NULL, '442373', 'H2H Global Visa'),
	(203, NULL, '461785', 'H2H Global Visa'),
	(204, NULL, '542640', 'H2H Global Mastercard'),
	(205, NULL, '540912', 'H2H Global Mastercard'),
	(206, NULL, '557338', 'H2H Global Mastercard'),
	(207, NULL, '557791', 'H2H Global Mastercard'),
	(208, NULL, '455633', 'H2H Global Visa'),
	(209, NULL, '548988', 'H2H Global Mastercard'),
	(210, NULL, '548116', 'H2H Global Mastercard'),
	(211, NULL, '421168', 'H2H Global Visa'),
	(212, NULL, '454179', 'H2H Global Visa'),
	(213, NULL, '454633', 'H2H Global Visa'),
	(214, NULL, '524261', 'H2H Global Mastercard'),
	(215, NULL, '498853', 'H2H Global Visa'),
	(216, NULL, '524125', 'H2H Global Mastercard'),
	(217, NULL, '545298', 'H2H Global Mastercard'),
	(218, NULL, '540889', 'H2H Global Mastercard'),
	(219, NULL, '552695', 'H2H Global Mastercard'),
	(220, NULL, '409766', 'H2H Global Visa'),
	(221, NULL, '437450', 'H2H Global Visa'),
	(222, NULL, '472647', 'H2H Global Visa'),
	(223, NULL, '554302', 'H2H Global Mastercard'),
	(224, NULL, '437527', 'H2H Global Visa'),
	(225, NULL, '459921', 'H2H Global Visa'),
	(226, NULL, '466574', 'H2H Global Visa'),
	(227, NULL, '514934', 'H2H Global Mastercard'),
	(228, NULL, '442374', 'H2H Global Visa'),
	(229, NULL, '456799', 'H2H Global Visa');
/*!40000 ALTER TABLE `t_lk_validccprefix` ENABLE KEYS */;


-- Dumping structure for table ajmidb.t_lk_validccprefix_copy
DROP TABLE IF EXISTS `t_lk_validccprefix_copy`;
CREATE TABLE IF NOT EXISTS `t_lk_validccprefix_copy` (
  `ValidCCPrefixId` int(10) unsigned NOT NULL auto_increment,
  `BankId` tinyint(3) unsigned default NULL,
  `ValidCCPrefix` varchar(10) NOT NULL,
  `ValidCCPrefixNote` varchar(100) NOT NULL,
  PRIMARY KEY  (`ValidCCPrefixId`),
  KEY `FK_ValidCCPrefix_BankId` (`BankId`),
  CONSTRAINT `t_lk_validccprefix_copy_ibfk_1` FOREIGN KEY (`BankId`) REFERENCES `t_lk_bank` (`BankId`)
) ENGINE=InnoDB AUTO_INCREMENT=376 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT COMMENT='This is a Valid Credit Card Prefix table which holds valid (';

-- Dumping data for table ajmidb.t_lk_validccprefix_copy: ~375 rows (approximately)
DELETE FROM `t_lk_validccprefix_copy`;
/*!40000 ALTER TABLE `t_lk_validccprefix_copy` DISABLE KEYS */;
INSERT INTO `t_lk_validccprefix_copy` (`ValidCCPrefixId`, `BankId`, `ValidCCPrefix`, `ValidCCPrefixNote`) VALUES
	(1, 2, '541716', ''),
	(2, 2, '541067', ''),
	(3, 2, '415736', ''),
	(4, 2, '413223', ''),
	(5, 2, '430978', ''),
	(6, 2, '430979', ''),
	(7, 2, '430980', ''),
	(8, 2, '430935', ''),
	(9, 2, '437700', 'RBS => Master ANZ'),
	(10, 2, '458769', 'Platinum ANZ'),
	(11, 2, '415737', ''),
	(12, 4, '501900', 'NEW MASTER'),
	(13, 4, '356280', ''),
	(14, 4, '542643', ''),
	(15, 4, '543730', ''),
	(16, 4, '482545', 'NEW MASTER'),
	(17, 4, '447242', ''),
	(18, 4, '455645', ''),
	(19, 4, '101580', 'BCA Card  1015  => GOLD\n'),
	(20, 8, '518824', ''),
	(21, 8, '510458', ''),
	(22, 5, '356285', ''),
	(23, 5, '545280', ''),
	(24, 5, '547332', ''),
	(25, 5, '544745', ''),
	(26, 5, '356284', ''),
	(27, 5, '400476', ''),
	(28, 5, '405577', ''),
	(29, 5, '429301', ''),
	(30, 11, '421268', ''),
	(31, 11, '464790', ''),
	(32, 15, '554042', ''),
	(33, 15, '552077', ''),
	(34, 15, '552040', ''),
	(35, 15, '445083', ''),
	(36, 28, '510217', 'Master Platinum'),
	(37, 18, '501051', ''),
	(38, 18, '548942', ''),
	(39, 18, '510505', ''),
	(40, 18, '520142', 'GE Finance'),
	(41, 18, '520143', 'GE Finance'),
	(42, 18, '520370', 'GE Finance'),
	(43, 18, '520372', ''),
	(44, 19, '518494', ''),
	(45, 19, '518435', ''),
	(46, 19, '518335', ''),
	(47, 19, '542448', ''),
	(48, 19, '447264', ''),
	(49, 20, '541078', ''),
	(50, 20, '540486', ''),
	(51, 20, '540678', ''),
	(52, 20, '540569', ''),
	(53, 20, '414397', ''),
	(54, 20, '426535', ''),
	(55, 10, '451497', ''),
	(56, 21, '512676', ''),
	(57, 21, '525946', ''),
	(58, 21, '521052', 'Master New'),
	(59, 21, '461663', ''),
	(60, 21, '413718', ''),
	(61, 21, '413719', ''),
	(62, 21, '461662', ''),
	(63, 21, '445076', ''),
	(64, 21, '405651', ''),
	(65, 21, '463199', ''),
	(66, 22, '548146', ''),
	(67, 22, '548245', ''),
	(68, 31, '484777', ''),
	(69, 12, '426750', ''),
	(70, 13, '530817', ''),
	(71, 7, '108913', ''),
	(72, 9, '437527', 'NEW'),
	(73, 27, '540891', ''),
	(74, 27, '540890', ''),
	(75, 27, '549113', ''),
	(76, 27, '548496', ''),
	(77, 27, '528872', '5288=>Shopping card '),
	(78, 27, '498853', ''),
	(79, 27, '426254', ''),
	(80, 27, '464005', ''),
	(81, 27, '548297', ''),
	(82, 30, '493498', ''),
	(83, 23, '420191', 'Mega Visa'),
	(84, 23, '420181', ''),
	(85, 23, '421407', ''),
	(86, 23, '420294', ''),
	(87, 23, '420393', ''),
	(88, 17, '567799', ''),
	(89, 17, '542360', ''),
	(90, 17, '527460', ''),
	(91, 17, '521896', ''),
	(92, 17, '521343', ''),
	(93, 17, '543415', ''),
	(94, 17, '456898', ''),
	(95, 17, '425857', ''),
	(96, 17, '451285', ''),
	(97, 17, '452485', ''),
	(98, 17, '548198', ''),
	(99, 17, '548199', ''),
	(100, 17, '439040', ''),
	(101, 17, '439041', ''),
	(102, 17, '452486', ''),
	(103, 17, '589887', ''),
	(104, 17, '515647', ''),
	(105, 6, '524640', ''),
	(106, 6, '548988', ''),
	(107, 6, '548415', 'Master New'),
	(108, 6, '542214', ''),
	(109, 6, '410504', ''),
	(110, 14, '428416', ''),
	(111, NULL, '542466', ''),
	(112, 14, '533619', '5336 => Syariah'),
	(113, NULL, '456878', ''),
	(114, 3, '420183', ''),
	(115, 3, '421403', ''),
	(116, 5, '404776', ''),
	(117, 5, '464987', ''),
	(118, 28, '524101', ''),
	(119, 28, '528913', ''),
	(120, 28, '512422', ''),
	(121, 28, '542223', ''),
	(122, 28, '553134', ''),
	(123, 28, '510249', ''),
	(124, 28, '540876', ''),
	(125, 28, '552885', ''),
	(126, 2, '526414', ''),
	(127, 2, '463722', ''),
	(128, 2, '517689', ''),
	(129, 2, '557795', ''),
	(130, 2, '554199', ''),
	(131, 2, '415535', ''),
	(132, NULL, '424103', ''),
	(133, 12, '524320', ''),
	(134, 12, '512430', ''),
	(135, 12, '512630', ''),
	(136, 14, '472802', ''),
	(137, 14, '514111', ''),
	(138, 14, '485764', ''),
	(139, 14, '443172', ''),
	(140, 14, '552596', ''),
	(141, 14, '552597', ''),
	(142, 14, '524319', ''),
	(143, 14, '524368', ''),
	(144, 17, '537705', ''),
	(145, 17, '402335', ''),
	(146, NULL, '524064', ''),
	(147, 17, '520166', ''),
	(148, 17, '529984', ''),
	(149, 17, '520191', ''),
	(150, 17, '490295', ''),
	(151, 17, '490296', ''),
	(152, 17, '434098', ''),
	(153, 17, '434099', ''),
	(154, 21, '421057', ''),
	(155, 21, '489594', ''),
	(156, 25, '424611', ''),
	(157, 27, '554682', ''),
	(158, 4, '477377', ''),
	(159, 4, '522287', ''),
	(160, 6, '436583', ''),
	(161, 8, '518884', ''),
	(162, 9, '421570', ''),
	(163, 15, '428107', ''),
	(164, 15, '555018', ''),
	(165, 15, '403731', ''),
	(166, 15, '542960', ''),
	(167, 15, '436799', ''),
	(168, 16, '542091', ''),
	(169, 17, '589587', ''),
	(170, 17, '552829', ''),
	(171, 17, '552884', ''),
	(172, 17, '557799', ''),
	(173, 18, '520373', ''),
	(174, 18, '514928', 'GE Finance'),
	(175, 18, '520153', 'GE Finance'),
	(176, 18, '520366', 'GE Finance'),
	(177, 18, '520371', 'GE Finance'),
	(178, 19, '400934', ''),
	(179, 19, '529442', ''),
	(180, 19, '539700', ''),
	(181, 21, '140011', ''),
	(182, 21, '800063', ''),
	(183, 21, '454677', ''),
	(184, 23, '489087', 'Mega Visa'),
	(185, 27, '433612', ''),
	(186, 27, '433613', ''),
	(187, 27, '547398', ''),
	(188, 27, '548296', ''),
	(189, 30, '494053', ''),
	(190, 30, '433683', ''),
	(191, 30, '493499', ''),
	(192, 10, '486463', ''),
	(193, 10, '461981', ''),
	(194, 9, '436502', 'VISA'),
	(195, 9, '532659', 'MASTER Prioritas'),
	(196, 9, '518856', 'MASTER Gold'),
	(197, 9, '552002', 'MASTER Platinum'),
	(198, 9, '547582', 'MASTER Business Card'),
	(199, 9, '553479', 'MASTER Corporate Card'),
	(200, 9, '518828', 'MASTER Hyundai Card'),
	(201, 15, '454179', 'VISA Classic/Makro'),
	(202, 15, '454178', 'VISA Gold'),
	(203, 15, '414009', 'VISA Platinum'),
	(204, 15, '542177', 'MASTER Classic/Makro/Gold'),
	(205, 15, '540184', 'MASTER'),
	(206, 15, '558720', 'MASTER'),
	(207, 15, '552042', 'MASTER Platinum'),
	(208, 4, '455632', 'VISA Classic'),
	(209, 4, '455633', 'VISA Gold'),
	(210, 4, '445377', 'VISA Platinum'),
	(211, 4, '472646', 'VISA SQ PPS Club (Infinite)'),
	(212, 4, '472647', 'VISA SQ Krisflyer (Signature)'),
	(213, 4, '483545', 'VISA KBC BCA'),
	(214, 4, '541322', 'MASTER Classic'),
	(215, 4, '540912', 'MASTER Gold'),
	(216, 4, '543248', 'MASTER Platinum'),
	(217, 4, '522990', 'MASTER World Card'),
	(218, 5, '493828', 'VISA Classic/Gold'),
	(219, 5, '442373', 'VISA Classic Lion Air'),
	(220, 5, '493829', 'VISA Gold'),
	(221, 5, '442374', 'VISA Gold'),
	(222, 5, '426013', 'VISA Platinum'),
	(223, 5, '456781', 'VISA Corporate'),
	(224, 5, '542449', 'MASTER Classic'),
	(225, 5, '540160', 'MASTER Gold'),
	(226, 5, '545298', 'MASTER Gold'),
	(227, 5, '545299', 'MASTER Gold'),
	(228, 5, '552008', 'MASTER Platinum'),
	(229, 5, '520037', 'MASTER'),
	(230, 17, '456798', 'VISA Classic'),
	(231, 17, '451286', 'VISA Prudential'),
	(232, 17, '456799', 'VISA Gold'),
	(233, 17, '432449', 'VISA Platinum'),
	(234, 17, '542260', 'MASTER Classic'),
	(235, 17, '552338', 'MASTER World Card'),
	(236, 17, '523983', 'MASTER Titanium'),
	(237, 17, '540731', 'MASTER Gold'),
	(238, 17, '552239', 'MASTER Platinum'),
	(239, 27, '454633', 'VISA Classic'),
	(240, 27, '498833', 'VISA Gold'),
	(241, 27, '490702', 'VISA Business'),
	(242, 27, '429750', 'VISA Gold'),
	(243, 27, '461785', 'VISA Astra World Card'),
	(244, 27, '542167', 'MASTER Classic'),
	(245, 27, '540889', 'MASTER Gold'),
	(246, 27, '515863', 'MASTER Manhattan'),
	(247, 27, '549846', 'MASTER Black Card'),
	(248, 27, '554302', 'MASTER Platinum'),
	(249, 20, '456879', 'VISA Gold'),
	(250, 20, '431181', 'VISA Classic'),
	(251, 20, '431182', 'VISA Gold'),
	(252, 20, '540174', 'MASTER Gold'),
	(253, 20, '540462', 'MASTER Golf'),
	(254, 20, '540468', 'MASTER Lady'),
	(255, 20, '540469', 'MASTER IMA Card'),
	(256, 14, '459921', 'VISA Classic'),
	(257, 14, '459920', 'VISA Gold'),
	(258, 14, '552810', 'MASTER'),
	(259, 14, '548116', 'MASTER Classic'),
	(260, 14, '548117', 'MASTER Gold'),
	(261, 14, '528919', 'MASTER Platinum'),
	(262, 14, '522866', 'MASTER Business Card'),
	(263, 30, '451196', 'VISA Corporate Card Classic'),
	(264, 30, '451197', 'VISA Corporate Card Gold'),
	(265, 30, '451297', 'VISA Gold All in One'),
	(266, 30, '493496', 'VISA Business Gold'),
	(267, 30, '493497', 'VISA Business Platinum'),
	(268, 30, '493598', 'VISA Black Platinum'),
	(269, 30, '544305', 'MASTER Classic'),
	(270, 30, '544404', 'MASTER Gold'),
	(271, 30, '544505', 'MASTER Corporate Card Classic'),
	(272, 30, '544304', 'MASTER Gold All in One/Business Platinum'),
	(273, 30, '514934', 'MASTER Black Platinum'),
	(274, 18, '543972', 'MASTER Classic'),
	(275, 18, '544741', 'MASTER Gold'),
	(276, 18, '520383', 'MASTER Classic'),
	(277, 18, '518943', 'MASTER Classic'),
	(278, 19, '454493', 'VISA Classic'),
	(279, 19, '447211', 'VISA Gold'),
	(280, 19, '483574', 'VISA Classic Co-Brand'),
	(281, 19, '483575', 'VISA Gold Co-Brand'),
	(282, 19, '409675', 'VISA Platinum'),
	(283, 19, '403409', 'VISA Advanced Platinum'),
	(284, 19, '483577', 'VISA Advanced Platinum'),
	(285, 19, '518535', 'MASTER Classic'),
	(286, 19, '518594', 'MASTER Gold'),
	(287, 19, '518323', 'MASTER Premier'),
	(288, 2, '415735', 'VISA Classic'),
	(289, 2, '415836', 'VISA Gold'),
	(290, 2, '430981', 'VISA Platinum'),
	(291, 2, '405542', 'VISA Card Femme'),
	(292, 2, '541069', 'MASTER Classic'),
	(293, 2, '541070', 'MASTER Gold'),
	(294, 2, '541616', 'MASTER Platinum'),
	(295, 2, '522846', 'MASTER Black Card'),
	(296, 2, '437701', 'VISA Gold Panin'),
	(297, 2, '437800', 'VISA Platinum Panin'),
	(298, 6, '410505', 'VISA Gold'),
	(299, 6, '410506', 'VISA Gold'),
	(300, 6, '451249', 'VISA Platinum'),
	(301, 6, '439062', 'VISA Corporate'),
	(302, 6, '421440', 'VISA Gold'),
	(303, 6, '421441', 'VISA Gold'),
	(304, 6, '403423', 'VISA'),
	(305, 6, '542640', 'MASTER Gold'),
	(306, 6, '510472', 'MASTER Corporate'),
	(307, 6, '524069', 'MASTER Infiniti Gold'),
	(308, 6, '523026', 'MASTER Infiniti Classic'),
	(309, 6, '522028', 'MASTER Gold'),
	(310, 6, '531857', 'MASTER '),
	(311, 6, '524125', 'MASTER Titanium'),
	(312, 6, '518446', 'MASTER Titanium'),
	(313, 21, '413819', 'VISA Gold'),
	(314, 21, '425945', 'VISA Platinum'),
	(315, 21, '490283', 'VISA Hypermart'),
	(316, 21, '490284', 'VISA Hypermart'),
	(317, 21, '434075', 'VISA Corporate'),
	(318, 21, '512724', 'MASTER Gold'),
	(319, 21, '524325', 'MASTER Titanium'),
	(320, 23, '420192', 'VISA Gold'),
	(321, 23, '420194', 'VISA Platinum'),
	(322, 23, '478487', 'VISA Co-Branding-Classic'),
	(323, 23, '458785', 'VISA Co-Branding-Gold'),
	(324, 23, '464933', 'VISA Corporate Gold'),
	(325, 23, '464934', 'VISA Corporate Platinum'),
	(326, 11, '421167', 'VISA Classic'),
	(327, 11, '421168', 'VISA Gold'),
	(328, 11, '489781', 'VISA Platinum'),
	(329, 11, '516055', 'MASTER Classic'),
	(330, 11, '526853', 'MASTER Gold'),
	(331, 11, '523940', 'MASTER Platinum'),
	(332, 11, '552695', 'MASTER Business'),
	(333, 10, '402695', 'VISA Classic'),
	(334, 10, '402736', 'VISA Gold'),
	(335, 10, '421920', 'VISA Platinum'),
	(336, 10, '486607', 'VISA Purchasing Card'),
	(337, 10, '461920', 'VISA Business Platinum'),
	(338, 10, '512620', 'MASTER Classic'),
	(339, 10, '512765', 'MASTER Gold'),
	(340, 10, '519311', 'MASTER Platinum'),
	(341, 10, '553388', 'MASTER Corporate Card'),
	(342, 10, '540579', 'MASTER Purchasing Card'),
	(343, 12, '432442', 'VISA Classsic'),
	(344, 12, '432443', 'VISA Gold'),
	(345, 12, '432342', 'VISA Platinum'),
	(346, 26, '464583', 'VISA Platinum'),
	(347, 28, '525644', 'MASTER Classic'),
	(348, 28, '512021', 'MASTER Gold'),
	(349, 28, '528912', 'MASTER Platinum'),
	(350, NULL, '421167', ''),
	(351, NULL, '540883', ''),
	(352, NULL, '557790', ''),
	(353, NULL, '409766', ''),
	(354, NULL, '409873', ''),
	(355, NULL, '420191', ''),
	(356, NULL, '420192', ''),
	(357, NULL, '420193', ''),
	(358, NULL, '420194', ''),
	(359, NULL, '420978', ''),
	(360, NULL, '421141', ''),
	(361, NULL, '421408', ''),
	(362, NULL, '421445', ''),
	(363, NULL, '473189', ''),
	(364, NULL, '476085', ''),
	(365, NULL, '489385', ''),
	(366, NULL, '510457', ''),
	(367, NULL, '510462', ''),
	(368, NULL, '510481', ''),
	(369, NULL, '522184', ''),
	(370, NULL, '526422', ''),
	(371, NULL, '526423', ''),
	(372, NULL, '542064', ''),
	(373, NULL, '545281', ''),
	(374, NULL, '552115', ''),
	(375, NULL, '557791', '');
/*!40000 ALTER TABLE `t_lk_validccprefix_copy` ENABLE KEYS */;


-- Dumping structure for view ajmidb.view_no_touch
DROP VIEW IF EXISTS `view_no_touch`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_no_touch` (
	`CustomerId` BIGINT(20) UNSIGNED NULL DEFAULT NULL,
	`AssignSpv` TINYINT(3) UNSIGNED NULL DEFAULT NULL,
	`AssignSelerId` TINYINT(3) UNSIGNED NULL DEFAULT NULL,
	`SellerId` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Must match [tms_agent].UserId',
	`CallReasonId` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
	`CustomerFirstName` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view ajmidb.view_progress_data
DROP VIEW IF EXISTS `view_progress_data`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_progress_data` (
	`jum` BIGINT(21) NOT NULL DEFAULT '0',
	`cmp` BIGINT(21) NOT NULL DEFAULT '0',
	`CampaignId` INT(10) UNSIGNED NOT NULL COMMENT 'Must match [T_GN_Campaign].CampaignId',
	`CallReasonId` INT(10) UNSIGNED NULL DEFAULT NULL COMMENT 'Must match [T_LK_CallReason].CallReasonId',
	`CallReasonDesc` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`solicied` DECIMAL(23,0) NULL DEFAULT NULL,
	`Usolicied` DECIMAL(23,0) NULL DEFAULT NULL
) ENGINE=MyISAM;


-- Dumping structure for view ajmidb.view_touch_data
DROP VIEW IF EXISTS `view_touch_data`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `view_touch_data` (
	`count(distinct a.CustomerId)` BIGINT(21) NOT NULL DEFAULT '0',
	`tanggal` DATE NULL DEFAULT NULL,
	`CampaignNumber` CHAR(10) NULL DEFAULT NULL COMMENT 'Prefix = 11' COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view ajmidb.v_sales_date
DROP VIEW IF EXISTS `v_sales_date`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_sales_date` (
	`CustomerId` INT(10) NULL DEFAULT NULL,
	`PolicySalesDate` DATETIME NULL DEFAULT NULL,
	`PolicyNumber` VARCHAR(20) NOT NULL COMMENT 'Two digit prefix must match [T_GN_Product].ProductPolicyNumPrefix' COLLATE 'latin1_swedish_ci',
	`CustomerFirstName` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`CustomerUpdatedTs` TIMESTAMP NULL DEFAULT NULL,
	`CallReasonDesc` VARCHAR(100) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`CallReasonCategoryName` VARCHAR(64) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;


-- Dumping structure for view ajmidb.view_no_touch
DROP VIEW IF EXISTS `view_no_touch`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_no_touch`;
CREATE ALGORITHM=UNDEFINED DEFINER=`enigma`@`%` SQL SECURITY DEFINER VIEW `view_no_touch` AS select `a`.`CustomerId` AS `CustomerId`,`a`.`AssignSpv` AS `AssignSpv`,`a`.`AssignSelerId` AS `AssignSelerId`,`b`.`SellerId` AS `SellerId`,`b`.`CallReasonId` AS `CallReasonId`,`b`.`CustomerFirstName` AS `CustomerFirstName` from (`t_gn_assignment` `a` left join `t_gn_customer` `b` on((`a`.`CustomerId` = `b`.`CustomerId`))) where ((`a`.`AssignSpv` is not null) and (`a`.`AssignSelerId` is not null) and isnull(`b`.`CallReasonId`));


-- Dumping structure for view ajmidb.view_progress_data
DROP VIEW IF EXISTS `view_progress_data`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_progress_data`;
CREATE ALGORITHM=UNDEFINED DEFINER=`enigma`@`%` SQL SECURITY DEFINER VIEW `view_progress_data` AS select count(0) AS `jum`,count(`a`.`CampaignId`) AS `cmp`,`a`.`CampaignId` AS `CampaignId`,`a`.`CallReasonId` AS `CallReasonId`,`b`.`CallReasonDesc` AS `CallReasonDesc`,sum(if((`a`.`CustomerUpdatedTs` is not null),1,0)) AS `solicied`,sum(if(isnull(`a`.`CustomerUpdatedTs`),1,0)) AS `Usolicied` from (`t_gn_customer` `a` left join `t_lk_callreason` `b` on((`a`.`CallReasonId` = `b`.`CallReasonId`))) group by `a`.`CallReasonId`,`a`.`CampaignId` order by `a`.`CampaignId` desc;


-- Dumping structure for view ajmidb.view_touch_data
DROP VIEW IF EXISTS `view_touch_data`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `view_touch_data`;
CREATE ALGORITHM=UNDEFINED DEFINER=`enigma`@`%` SQL SECURITY DEFINER VIEW `view_touch_data` AS select count(distinct `a`.`CustomerId`) AS `count(distinct a.CustomerId)`,cast(`a`.`CallHistoryCreatedTs` as date) AS `tanggal`,`c`.`CampaignNumber` AS `CampaignNumber` from ((`t_gn_callhistory` `a` left join `t_gn_customer` `b` on((`a`.`CustomerId` = `b`.`CustomerId`))) left join `t_gn_campaign` `c` on((`b`.`CampaignId` = `c`.`CampaignId`))) where (1 = 1) group by cast(`a`.`CallHistoryCreatedTs` as date);


-- Dumping structure for view ajmidb.v_sales_date
DROP VIEW IF EXISTS `v_sales_date`;
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_sales_date`;
CREATE ALGORITHM=UNDEFINED DEFINER=`enigma`@`%` SQL SECURITY DEFINER VIEW `v_sales_date` AS select `a`.`CustomerId` AS `CustomerId`,`b`.`PolicySalesDate` AS `PolicySalesDate`,`b`.`PolicyNumber` AS `PolicyNumber`,`c`.`CustomerFirstName` AS `CustomerFirstName`,`c`.`CustomerUpdatedTs` AS `CustomerUpdatedTs`,`d`.`CallReasonDesc` AS `CallReasonDesc`,`e`.`CallReasonCategoryName` AS `CallReasonCategoryName` from ((((`t_gn_policyautogen` `a` join `t_gn_policy` `b` on((`a`.`PolicyNumber` = `b`.`PolicyNumber`))) left join `t_gn_customer` `c` on((`a`.`CustomerId` = `c`.`CustomerId`))) left join `t_lk_callreason` `d` on((`c`.`CallReasonId` = `d`.`CallReasonId`))) left join `t_lk_callreasoncategory` `e` on((`d`.`CallReasonCategoryId` = `e`.`CallReasonCategoryId`))) group by `b`.`PolicyNumber`;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
