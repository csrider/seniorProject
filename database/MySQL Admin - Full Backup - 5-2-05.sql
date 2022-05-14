SET
  @OLD_CHARACTER_SET_CLIENT = @ @CHARACTER_SET_CLIENT;

SET
  @OLD_CHARACTER_SET_RESULTS = @ @CHARACTER_SET_RESULTS;

SET
  @OLD_COLLATION_CONNECTION = @ @COLLATION_CONNECTION;

SET
  NAMES utf8;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE=NO_AUTO_VALUE_ON_ZERO */
;

CREATE DATABASE
/*!32312 IF NOT EXISTS*/
`zmendev`;

USE `zmendev`;

DROP TABLE IF EXISTS `admin_user`;

CREATE TABLE `admin_user` (
  `admin_user_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_user_fname` varchar(32) DEFAULT NULL,
  `admin_user_lname` varchar(32) DEFAULT NULL,
  `admin_user_username` varchar(16) DEFAULT NULL,
  `admin_user_password` varchar(16) DEFAULT NULL,
  `admin_user_email` varchar(64) DEFAULT NULL,
  `admin_level` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`admin_user_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `admin_user` (
    `admin_user_id`,
    `admin_user_fname`,
    `admin_user_lname`,
    `admin_user_username`,
    `admin_user_password`,
    `admin_user_email`,
    `admin_level`
  )
VALUES
  (
    1,
    'Chris',
    'Rider',
    'csr19us',
    'password',
    'csr19us@hotmail.com , csrider@gmail.com',
    1
  ),
  (
    2,
    'Brian',
    'Holms',
    'bhols',
    'password',
    'brianholms@fake.com',
    1
  ),
  (
    3,
    'Anthony',
    'Wilstead',
    'awill',
    'password',
    'awill@anotherfake.com',
    1
  ),
  (
    4,
    'Nat',
    'Ember',
    'nember',
    'password',
    'nember@fakeagain.com',
    1
  ),
  (
    5,
    'Dan',
    'Poe',
    'dpoe',
    'password',
    'poe@imposter.com',
    1
  ),
  (
    6,
    'Ernst',
    'Nolz',
    'enolz',
    'password',
    'enolz@fake.edu',
    3
  ),
  (
    7,
    'Abbey',
    'Forog',
    'aforog',
    'password',
    'aforog@fake.edu',
    3
  ),
  (
    8,
    'Marv',
    'Albas',
    'malbas',
    'password',
    'malbas@nothing.org',
    3
  ),
  (
    9,
    'Samantha',
    'Sanders',
    'sandra',
    'password',
    'SamSan@notreal.com',
    3
  ),
  (
    10,
    'Josh',
    'Zuresk',
    'jzur',
    'password',
    'jzur@wannabe.com',
    3
  ),
  (
    11,
    'Joel',
    'Hurt',
    'jhurt',
    'password',
    'jhurt@notreally.com',
    3
  );

DROP TABLE IF EXISTS `bank_acct_type`;

CREATE TABLE `bank_acct_type` (
  `bat_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `bat_type` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `bat_desc` varchar(64) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `bat_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `bat_created` datetime DEFAULT NULL,
  PRIMARY KEY (`bat_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `bank_acct_type` (
    `bat_id`,
    `bat_type`,
    `bat_desc`,
    `bat_lastupd`,
    `bat_created`
  )
VALUES
  (
    3,
    'Checking',
    'Standard checking account',
    '2005-04-30 20:58:03',
    '2005-04-30 20:58:03'
  ),
  (
    4,
    'Savings',
    'Standard savings account',
    '2005-04-30 20:58:14',
    '2005-04-30 20:58:14'
  );

DROP TABLE IF EXISTS `cc_vendor`;

CREATE TABLE `cc_vendor` (
  `ccv_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ccv_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ccv_merch_num` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ccv_merch_phone` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `ccv_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ccv_created` datetime DEFAULT NULL,
  PRIMARY KEY (`ccv_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `cc_vendor` (
    `ccv_id`,
    `ccv_name`,
    `ccv_merch_num`,
    `ccv_merch_phone`,
    `ccv_lastupd`,
    `ccv_created`
  )
VALUES
  (
    1,
    'Visa',
    '2348900982',
    '(888)888-8888',
    '2005-04-30 20:46:07',
    '2005-02-09 13:29:10'
  ),
  (
    2,
    'Mastercard',
    '4902288',
    '(800)555-1212',
    '2005-04-30 20:46:07',
    '2005-02-10 14:29:19'
  ),
  (
    3,
    'Discover Card',
    '46564554-54646',
    '(800)555-3333',
    '2005-04-30 20:46:07',
    '2005-02-09 13:29:28'
  ),
  (
    4,
    'American Express',
    '1211233-550-44',
    '(888)555-4444',
    '2005-04-30 20:46:07',
    '2005-02-09 13:29:34'
  ),
  (
    5,
    'Capital One',
    '09234098234098',
    '(888)555-5555',
    '2005-04-30 20:46:07',
    '2005-03-04 00:10:16'
  ),
  (
    6,
    'Eagle Access Card',
    'usi-evan-0013',
    '(812)399-9999',
    '2005-04-30 20:46:07',
    '2005-03-21 15:20:04'
  ),
  (
    7,
    'Diners Club',
    '11111111222222',
    '(978)555-1698',
    '2005-04-30 20:46:07',
    '2005-04-28 23:09:24'
  );

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `cust_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ctype_id` tinyint(3) UNSIGNED DEFAULT '0',
  `cust_lname` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_fname` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_minitial` char(1) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_suffix` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_address1` varchar(64) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_address2` varchar(64) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_city` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_state` char(2) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_zip` varchar(10) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_wphone` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_hphone` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_mphone` varchar(14) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `paym_id` tinyint(3) UNSIGNED DEFAULT '0',
  `cust_tax_id` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin DEFAULT NULL,
  `cust_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_id` mediumint(8) UNSIGNED DEFAULT '0',
  `cust_created` datetime DEFAULT NULL,
  PRIMARY KEY (`cust_id`),
  KEY `customer_ctype` TYPE BTREE (`ctype_id`),
  KEY `customer_paym` TYPE BTREE (`paym_id`),
  KEY `customer_admin` TYPE BTREE (`admin_id`),
  CONSTRAINT `FK_customer_1` FOREIGN KEY (`ctype_id`) REFERENCES `customer_type` (`ctype_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE,
    CONSTRAINT `FK_customer_2` FOREIGN KEY (`paym_id`) REFERENCES `pay_method` (`paym_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE,
    CONSTRAINT `FK_customer_3` FOREIGN KEY (`admin_id`) REFERENCES `admin_user` (`admin_user_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 3072 kB; InnoDB free: 9216 kB; (`ctype_id`) REF';

INSERT INTO
  `customer` (
    `cust_id`,
    `ctype_id`,
    `cust_lname`,
    `cust_fname`,
    `cust_minitial`,
    `cust_suffix`,
    `cust_address1`,
    `cust_address2`,
    `cust_city`,
    `cust_state`,
    `cust_zip`,
    `cust_wphone`,
    `cust_hphone`,
    `cust_mphone`,
    `paym_id`,
    `cust_tax_id`,
    `cust_lastupd`,
    `admin_id`,
    `cust_created`
  )
VALUES
  (
    1,
    2,
    'Sanders',
    'Colonel',
    '',
    '',
    '1 Chicken Lane',
    '',
    'Louisville',
    'KY',
    '40201',
    '',
    '(502)555-1224',
    '',
    1,
    '2342-232322-68-435',
    '2005-04-30 22:51:27',
    1,
    '2005-04-20 21:22:33'
  ),
  (
    2,
    1,
    'Smith',
    'John',
    '',
    '',
    '316 Fulton Ave.',
    '',
    'Evansville',
    'IN',
    '47713',
    '',
    '(812)555-3395',
    '',
    1,
    '',
    '2005-05-01 02:23:10',
    1,
    '2005-05-01 02:23:10'
  ),
  (
    3,
    1,
    'Lloyd',
    'Russel',
    '',
    '',
    '123 Court Ave.',
    '',
    'Evansville',
    'IN',
    '47712',
    '(812)555-9088',
    '(812)555-3981',
    '',
    1,
    '',
    '2005-05-01 17:21:57',
    1,
    '2005-02-01 16:58:42'
  ),
  (
    5,
    1,
    'Williams',
    'Andy',
    '',
    '',
    '4792 W CR 275 N',
    '',
    'Evansville',
    'IN',
    '47761',
    '',
    '(812)555-0207',
    '',
    1,
    '',
    '2005-05-01 17:41:09',
    1,
    '2005-05-01 17:39:05'
  ),
  (
    6,
    5,
    'Graves',
    'Bob',
    '',
    '',
    '5898 Broadway Ave.',
    '',
    'Evansville',
    'IN',
    '47711',
    '',
    '(812)555-1238',
    '',
    1,
    '54544-563-1123',
    '2005-05-01 21:48:11',
    1,
    '2005-05-01 21:48:11'
  ),
  (
    7,
    1,
    'Wessel',
    'Tom',
    'R',
    '',
    '2218 Oak Trace',
    '',
    'Highlands',
    'KY',
    '40203',
    '',
    '(502)555-2121',
    '(502)555-1112',
    1,
    '',
    '2005-05-01 22:04:09',
    1,
    '2005-05-01 22:04:09'
  );

INSERT INTO
  `customer` (
    `cust_id`,
    `ctype_id`,
    `cust_lname`,
    `cust_fname`,
    `cust_minitial`,
    `cust_suffix`,
    `cust_address1`,
    `cust_address2`,
    `cust_city`,
    `cust_state`,
    `cust_zip`,
    `cust_wphone`,
    `cust_hphone`,
    `cust_mphone`,
    `paym_id`,
    `cust_tax_id`,
    `cust_lastupd`,
    `admin_id`,
    `cust_created`
  )
VALUES
  (
    8,
    3,
    'Bush',
    'Dubya',
    '',
    '',
    '1600 Pen Ave.',
    '',
    'New Washington',
    'IN',
    '47157',
    '',
    '(812)555-8876',
    '',
    1,
    '',
    '2005-05-01 22:24:52',
    1,
    '2005-05-01 22:24:52'
  ),
  (
    9,
    1,
    'Brown',
    'Sara',
    'M',
    '',
    '234 1st Avenue',
    '',
    'Evansville',
    'IN',
    '47710',
    '',
    '(812)555-4567',
    '',
    1,
    '',
    '2005-05-01 22:54:21',
    1,
    '2005-05-01 22:54:21'
  ),
  (
    11,
    2,
    'Stut',
    'William',
    '',
    '',
    '7410 Eagle Crest Blvd',
    '',
    'Evansville',
    'IN',
    '47715',
    '(800)555-1888',
    '(812)555-3776',
    '',
    1,
    '',
    '2005-05-01 23:01:05',
    1,
    '2005-05-01 23:01:05'
  ),
  (
    12,
    2,
    'Sanders',
    'Amy',
    '',
    '',
    '22 West Francine',
    '',
    'Evansville',
    'IN',
    '47711',
    '',
    '(812)555-3196',
    '',
    1,
    '',
    '2005-05-01 23:45:23',
    1,
    '2004-03-09 23:02:36'
  ),
  (
    13,
    2,
    'Robbel',
    'Tim',
    '',
    '',
    '141 S Elm Street',
    '',
    'Henderson',
    'KY',
    ' 42420',
    '',
    '(270) 555-025',
    '',
    1,
    '',
    '2005-05-01 23:12:21',
    1,
    '2005-05-01 23:12:21'
  ),
  (
    15,
    2,
    'Thomas',
    'Andy',
    '',
    '',
    '1203 W Cherry Street',
    '',
    'Carmi',
    'IL',
    '62821',
    '',
    '(618)555-4841',
    '',
    1,
    '',
    '2005-05-01 23:21:47',
    1,
    '2005-05-01 23:21:47'
  );

INSERT INTO
  `customer` (
    `cust_id`,
    `ctype_id`,
    `cust_lname`,
    `cust_fname`,
    `cust_minitial`,
    `cust_suffix`,
    `cust_address1`,
    `cust_address2`,
    `cust_city`,
    `cust_state`,
    `cust_zip`,
    `cust_wphone`,
    `cust_hphone`,
    `cust_mphone`,
    `paym_id`,
    `cust_tax_id`,
    `cust_lastupd`,
    `admin_id`,
    `cust_created`
  )
VALUES
  (
    17,
    4,
    'Fisher',
    'Carrie',
    '',
    '',
    '2121 starwars drive',
    '',
    'Mt. Vernon',
    'IL',
    '47721',
    '',
    '(812)555-4567',
    '',
    1,
    '',
    '2005-05-01 23:25:44',
    1,
    '2005-05-01 23:25:44'
  ),
  (
    18,
    1,
    'Doe',
    'John',
    'W',
    'Jr.',
    '123 First St.',
    '',
    'Fairfield',
    'IL',
    '23388-6776',
    '(555)555-6666',
    '(555)555-5555',
    '(555)555-7777',
    1,
    '',
    '2005-05-02 02:02:21',
    1,
    '2005-05-02 02:02:21'
  );

DROP TABLE IF EXISTS `customer_bank`;

CREATE TABLE `customer_bank` (
  `cust_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `custbank_address1` varchar(64) DEFAULT NULL,
  `custbank_address2` varchar(64) DEFAULT NULL,
  `custbank_city` varchar(32) DEFAULT NULL,
  `custbank_state` char(2) DEFAULT NULL,
  `custbank_zip` varchar(10) DEFAULT NULL,
  `custbank_bank` varchar(32) DEFAULT NULL,
  `bat_id` tinyint(3) UNSIGNED DEFAULT '0',
  `custbank_routing` varchar(16) DEFAULT NULL,
  `custbank_account` varchar(16) DEFAULT NULL,
  `custbank_created` datetime DEFAULT NULL,
  `custbank_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `custbank_created_ip` varchar(15) DEFAULT NULL,
  `custbank_lastupd_ip` varchar(15) DEFAULT NULL,
  `custbank_last_mod_by` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`cust_id`),
  KEY `customer_bank_bat_id` TYPE BTREE (`bat_id`),
  CONSTRAINT `FK_customer_bank_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_customer_bank_2` FOREIGN KEY (`bat_id`) REFERENCES `bank_acct_type` (`bat_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 10240 kB; (`bat_id`) REFER `zmendev/bank_acct_t';

INSERT INTO
  `customer_bank` (
    `cust_id`,
    `custbank_address1`,
    `custbank_address2`,
    `custbank_city`,
    `custbank_state`,
    `custbank_zip`,
    `custbank_bank`,
    `bat_id`,
    `custbank_routing`,
    `custbank_account`,
    `custbank_created`,
    `custbank_lastupd`,
    `custbank_created_ip`,
    `custbank_lastupd_ip`,
    `custbank_last_mod_by`
  )
VALUES
  (
    1,
    '1 Chicken Lane',
    '',
    'Louisville',
    'KY',
    '40201',
    'Fifth Third Bank',
    3,
    '098114',
    '32098900',
    '2005-04-20 21:22:33',
    '2005-04-30 22:52:03',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    6,
    '5898 Broadway Ave.',
    '',
    'Evansville',
    'IN',
    '47711',
    'Bank One',
    3,
    '4554255',
    '23572221',
    '2005-05-01 21:49:37',
    '2005-05-01 21:49:37',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    8,
    '1600 Pen Ave.',
    '',
    'New Washington',
    'IN',
    '47157',
    'First Federal Savings',
    4,
    '54544',
    '665448',
    '2005-05-01 22:28:51',
    '2005-05-01 22:28:51',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    15,
    '203 E Cherry Street',
    '',
    'Carmi',
    'IL',
    '62821',
    'Fifth Third',
    3,
    '12459684',
    '46516354984',
    '2005-05-01 23:23:55',
    '2005-05-01 23:23:55',
    '192.168.1.201',
    NULL,
    '1'
  );

DROP TABLE IF EXISTS `customer_cc`;

CREATE TABLE `customer_cc` (
  `cust_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `custcc_address1` varchar(64) DEFAULT NULL,
  `custcc_address2` varchar(64) DEFAULT NULL,
  `custcc_city` varchar(32) DEFAULT NULL,
  `custcc_state` char(2) DEFAULT NULL,
  `custcc_zip` varchar(10) DEFAULT NULL,
  `ccv_id` tinyint(3) UNSIGNED DEFAULT '0',
  `custcc_name` varchar(40) DEFAULT NULL,
  `custcc_number` varchar(24) DEFAULT NULL,
  `custcc_cid` char(3) DEFAULT NULL,
  `custcc_expire` varchar(5) DEFAULT NULL,
  `custcc_cust_svc` varchar(14) DEFAULT NULL,
  `custcc_created` datetime DEFAULT NULL,
  `custcc_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `custcc_created_ip` varchar(15) DEFAULT NULL,
  `custcc_lastupd_ip` varchar(15) DEFAULT NULL,
  `custcc_last_mod_by` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`cust_id`),
  KEY `customer_cc_ccv_id` TYPE BTREE (`ccv_id`),
  CONSTRAINT `FK_customer_cc_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_customer_cc_2` FOREIGN KEY (`ccv_id`) REFERENCES `cc_vendor` (`ccv_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 10240 kB; (`cust_id`) REFER `zmendev/customer`(';

INSERT INTO
  `customer_cc` (
    `cust_id`,
    `custcc_address1`,
    `custcc_address2`,
    `custcc_city`,
    `custcc_state`,
    `custcc_zip`,
    `ccv_id`,
    `custcc_name`,
    `custcc_number`,
    `custcc_cid`,
    `custcc_expire`,
    `custcc_cust_svc`,
    `custcc_created`,
    `custcc_lastupd`,
    `custcc_created_ip`,
    `custcc_lastupd_ip`,
    `custcc_last_mod_by`
  )
VALUES
  (
    2,
    '316 Fulton Ave.',
    '',
    'Evansville',
    'IN',
    '47713',
    2,
    'Jon L. Smith',
    '1111222233334444',
    '542',
    '12/07',
    '1-888-555-1212',
    '2005-05-01 02:25:06',
    '2005-05-01 02:25:06',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    5,
    '4792 W CR 275 N',
    '',
    'Evansville',
    'IN',
    '47761',
    4,
    'Anton M. Wills',
    '5454323298984141',
    '554',
    '09/06',
    '',
    '2005-05-01 17:40:20',
    '2005-05-01 17:40:20',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    7,
    '2218 Oak Trace',
    '',
    'Highlands',
    'KY',
    '40203',
    1,
    'Tom R. Wessel',
    '5678452145675484',
    '667',
    '05/07',
    '',
    '2005-05-01 22:14:50',
    '2005-05-01 22:14:50',
    '192.168.1.200',
    NULL,
    '1'
  ),
  (
    13,
    '141 S Elm Street',
    '',
    'Henderson',
    'KY',
    '42420',
    4,
    'Henderson Cancer Center PSC',
    '1542584684512111',
    '998',
    '01/09',
    '',
    '2005-05-01 23:15:56',
    '2005-05-01 23:17:43',
    '192.168.1.201',
    NULL,
    '1'
  ),
  (
    18,
    '123 First St.',
    '',
    'Fairfield',
    'IL',
    '23388-6776',
    4,
    'Jonathan W. Doe',
    '1234567890123456',
    '557',
    '12/06',
    '1-888-555-1234',
    '2005-05-02 02:07:42',
    '2005-05-02 02:07:42',
    '192.168.1.200',
    NULL,
    '1'
  );

DROP TABLE IF EXISTS `customer_online`;

CREATE TABLE `customer_online` (
  `cust_id` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `custo_username` varchar(16) DEFAULT NULL,
  `custo_password` varchar(16) DEFAULT NULL,
  `custo_email` varchar(64) DEFAULT NULL,
  `custo_promotions` tinyint(1) UNSIGNED DEFAULT NULL,
  `custo_created` datetime DEFAULT NULL,
  `custo_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `custo_last_access` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `custo_create_ip` varchar(15) DEFAULT NULL,
  `custo_last_update_ip` varchar(15) DEFAULT NULL,
  `custo_last_access_ip` varchar(15) DEFAULT NULL,
  `custo_last_mod_by` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`cust_id`),
  CONSTRAINT `FK_customer_online_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 10240 kB; (`cust_id`) REFER `zmendev/customer`(';

INSERT INTO
  `customer_online` (
    `cust_id`,
    `custo_username`,
    `custo_password`,
    `custo_email`,
    `custo_promotions`,
    `custo_created`,
    `custo_last_update`,
    `custo_last_access`,
    `custo_create_ip`,
    `custo_last_update_ip`,
    `custo_last_access_ip`,
    `custo_last_mod_by`
  )
VALUES
  (
    1,
    'sanders',
    'chicken',
    'vendor_support@kfc.com',
    1,
    '2005-04-20 21:22:33',
    '2005-05-02 01:32:56',
    '2005-05-02 01:32:56',
    '192.168.1.200',
    NULL,
    '192.168.1.200',
    '1'
  ),
  (
    2,
    'jsmith',
    'password',
    'jsmith@anisp.com',
    0,
    '2005-05-01 02:25:05',
    '2005-05-01 16:20:26',
    '2005-05-01 16:20:26',
    '192.168.1.200',
    NULL,
    '192.168.1.203',
    '1'
  ),
  (
    3,
    'lloyd',
    'mayor',
    'rlloyd@evansville.com',
    1,
    '2005-02-01 17:01:17',
    '2005-05-01 17:22:23',
    '2005-05-01 17:02:26',
    '192.168.1.200',
    NULL,
    '192.168.1.203',
    '1'
  ),
  (
    5,
    'williams1',
    'password',
    'andy.williams@gone.com',
    0,
    '2005-05-01 17:40:19',
    '2005-05-01 17:40:28',
    '2005-05-01 17:40:28',
    '192.168.1.200',
    NULL,
    '192.168.1.203',
    '1'
  ),
  (
    6,
    'bgraves',
    'password',
    'bgraves@aol.com',
    1,
    '2005-05-01 21:49:37',
    '2005-05-01 21:49:37',
    '0000-00-00 00:00:00',
    '192.168.1.200',
    NULL,
    NULL,
    '1'
  ),
  (
    7,
    'trwessel',
    'password',
    'trw@nope.gov',
    0,
    '2005-05-01 22:14:50',
    '2005-05-01 22:14:50',
    '0000-00-00 00:00:00',
    '192.168.1.200',
    NULL,
    NULL,
    '1'
  );

INSERT INTO
  `customer_online` (
    `cust_id`,
    `custo_username`,
    `custo_password`,
    `custo_email`,
    `custo_promotions`,
    `custo_created`,
    `custo_last_update`,
    `custo_last_access`,
    `custo_create_ip`,
    `custo_last_update_ip`,
    `custo_last_access_ip`,
    `custo_last_mod_by`
  )
VALUES
  (
    8,
    'dubya',
    'password',
    'gdb@tycoon.com',
    1,
    '2005-05-01 22:28:51',
    '2005-05-01 22:28:51',
    '0000-00-00 00:00:00',
    '192.168.1.200',
    NULL,
    NULL,
    '1'
  ),
  (
    9,
    'sbrown',
    '12345',
    'sbrown@yahoo.com',
    1,
    '2005-05-01 22:56:09',
    '2005-05-01 22:56:09',
    '0000-00-00 00:00:00',
    '192.168.1.201',
    NULL,
    NULL,
    '1'
  ),
  (
    13,
    'trobbins',
    '12345',
    'trobbins@blah',
    0,
    '2005-05-01 23:15:56',
    '2005-05-01 23:15:56',
    '0000-00-00 00:00:00',
    '192.168.1.201',
    NULL,
    NULL,
    '1'
  ),
  (
    15,
    'athomas',
    'cuthair',
    'athomas@barber.com',
    1,
    '2005-05-01 23:23:55',
    '2005-05-01 23:50:59',
    '2005-05-01 23:50:59',
    '192.168.1.201',
    NULL,
    '192.168.1.203',
    '1'
  ),
  (
    18,
    'jdoe',
    '123password',
    'jdoe@yahoo.com',
    1,
    '2005-05-02 02:07:42',
    '2005-05-02 02:07:42',
    '0000-00-00 00:00:00',
    '192.168.1.200',
    NULL,
    NULL,
    '1'
  );

DROP TABLE IF EXISTS `customer_type`;

CREATE TABLE `customer_type` (
  `ctype_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ctype_type` varchar(32) DEFAULT NULL,
  `ctype_desc` varchar(128) DEFAULT NULL,
  `ctype_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ctype_created` datetime DEFAULT NULL,
  PRIMARY KEY (`ctype_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `customer_type` (
    `ctype_id`,
    `ctype_type`,
    `ctype_desc`,
    `ctype_lastupd`,
    `ctype_created`
  )
VALUES
  (
    1,
    'Residential',
    'Customer is a typical private residence',
    '2005-04-30 20:52:06',
    '2005-04-30 20:50:27'
  ),
  (
    2,
    'Commercial',
    'Customer is a business of some sort',
    '2005-04-30 20:51:54',
    '2005-04-30 20:51:54'
  ),
  (
    3,
    'Government',
    'Customer is a form of government',
    '2005-04-30 20:53:58',
    '2005-04-30 20:53:58'
  ),
  (
    4,
    'Non-Profit',
    'Customer is a non-profit organization',
    '2005-04-30 20:54:26',
    '2005-04-30 20:54:26'
  ),
  (
    5,
    'Religious',
    'Customer is a church or temple',
    '2005-04-30 20:57:01',
    '2005-04-30 20:57:01'
  );

DROP TABLE IF EXISTS `new_customer`;

CREATE TABLE `new_customer` (
  `nc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nc_fname` varchar(32) DEFAULT NULL,
  `nc_lname` varchar(32) DEFAULT NULL,
  `nc_address1` varchar(64) DEFAULT NULL,
  `nc_address2` varchar(64) DEFAULT NULL,
  `nc_city` varchar(32) DEFAULT NULL,
  `nc_state` char(2) DEFAULT NULL,
  `nc_dphone` varchar(13) DEFAULT NULL,
  `nc_email` varchar(64) DEFAULT NULL,
  `nc_contact_method` varchar(10) DEFAULT NULL,
  `nc_created` datetime DEFAULT NULL,
  `nc_created_ip` varchar(15) DEFAULT NULL,
  `nc_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nc_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`nc_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `new_customer` (
    `nc_id`,
    `nc_fname`,
    `nc_lname`,
    `nc_address1`,
    `nc_address2`,
    `nc_city`,
    `nc_state`,
    `nc_dphone`,
    `nc_email`,
    `nc_contact_method`,
    `nc_created`,
    `nc_created_ip`,
    `nc_updated`,
    `nc_status`
  )
VALUES
  (
    1,
    'Laura',
    'Quest',
    '425 Kimbern Road',
    '',
    'Evansville',
    'IN',
    '(812)555-7034',
    'lquest@nada.com',
    'email',
    '2005-05-01 17:42:36',
    '192.168.1.203',
    '2005-05-01 21:19:17',
    NULL
  ),
  (
    2,
    'Matthew',
    'Boz',
    '399 Eastern Way',
    '',
    'Mt. Vernon',
    'IN',
    '(812)555-2131',
    'mboz@anyisp.org',
    'phone',
    '2005-05-01 21:03:54',
    '192.168.1.203',
    '2005-05-01 21:22:20',
    'checkout'
  ),
  (
    3,
    'Antone',
    'Holtz',
    '345 Weinz Avenue',
    '',
    'Evansville',
    'IN',
    '(812)55-1919',
    '',
    'phone',
    '2005-05-01 23:27:34',
    '192.168.1.201',
    '2005-05-01 23:27:34',
    NULL
  ),
  (
    4,
    'Sally',
    'Fez',
    '5678 South Greenway Drive',
    '',
    'Evansville',
    'IN',
    '(812)555-5718',
    'sfez@uhuh.com',
    'email',
    '2005-05-01 23:28:38',
    '192.168.1.201',
    '2005-05-01 23:28:38',
    NULL
  );

DROP TABLE IF EXISTS `pay_method`;

CREATE TABLE `pay_method` (
  `paym_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `paym_name` varchar(20) DEFAULT NULL,
  `paym_desc` varchar(64) DEFAULT NULL,
  `paym_merchant_num` varchar(64) DEFAULT NULL,
  `paym_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `paym_created` datetime DEFAULT NULL,
  PRIMARY KEY (`paym_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `pay_method` (
    `paym_id`,
    `paym_name`,
    `paym_desc`,
    `paym_merchant_num`,
    `paym_lastupd`,
    `paym_created`
  )
VALUES
  (
    1,
    'Paper Bill',
    'We deliver an invoice for them to pay',
    'n/a',
    '2005-04-30 20:48:25',
    '2005-04-30 20:48:25'
  ),
  (
    2,
    'Credit Card',
    'They pay online with a credit card',
    'n/a',
    '2005-04-30 20:48:46',
    '2005-04-30 20:48:46'
  ),
  (
    3,
    'Electronic Check',
    'They pay online with a bank account (EFT)',
    'n/a',
    '2005-04-30 20:49:08',
    '2005-04-30 20:49:08'
  ),
  (
    4,
    'PayPal',
    'They pay online using a PayPal account',
    'paypal@zmenlawncare.com',
    '2005-04-30 20:49:59',
    '2005-04-30 20:49:43'
  );

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `pmt_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cust_id` mediumint(8) UNSIGNED DEFAULT '0',
  `paym_id` tinyint(3) UNSIGNED DEFAULT '0',
  `pmt_amount` decimal(8, 2) DEFAULT NULL,
  `pmt_date` date DEFAULT NULL,
  `pmt_ip` varchar(15) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pmt_id`),
  KEY `payment_cust_id` TYPE BTREE (`cust_id`),
  KEY `payment_paym_id` TYPE BTREE (`paym_id`),
  CONSTRAINT `FK_payment_1` FOREIGN KEY (`paym_id`) REFERENCES `pay_method` (`paym_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE,
    CONSTRAINT `FK_payment_2` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 10240 kB';

INSERT INTO
  `payment` (
    `pmt_id`,
    `cust_id`,
    `paym_id`,
    `pmt_amount`,
    `pmt_date`,
    `pmt_ip`,
    `timestamp`
  )
VALUES
  (
    1,
    1,
    3,
    '142.50',
    '2005-03-12',
    '192.168.1.200',
    '2005-05-01 22:16:58'
  ),
  (
    2,
    1,
    3,
    '142.50',
    '2005-04-14',
    '192.168.1.200',
    '2005-05-01 22:16:58'
  );

DROP TABLE IF EXISTS `prod_type`;

CREATE TABLE `prod_type` (
  `ptype_id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ptype_type` varchar(32) DEFAULT NULL,
  `ptype_desc` varchar(128) DEFAULT NULL,
  `ptype_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ptype_created` datetime DEFAULT NULL,
  PRIMARY KEY (`ptype_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `prod_type` (
    `ptype_id`,
    `ptype_type`,
    `ptype_desc`,
    `ptype_lastupd`,
    `ptype_created`
  )
VALUES
  (
    1,
    'Year-round',
    'Products and services offered during all seasons',
    '2005-04-08 15:54:28',
    '2005-04-04 15:31:26'
  ),
  (
    2,
    'Summer',
    'Products and services offered during Summer',
    '2005-03-25 21:52:25',
    '2005-03-25 21:51:46'
  ),
  (
    3,
    'Autumn',
    'Products and services offered during Fall',
    '2005-03-30 19:39:19',
    '2005-03-25 21:51:58'
  ),
  (
    4,
    'Winter',
    'Products and services offered during Winter',
    '2005-03-25 21:52:25',
    '2005-03-25 21:52:05'
  ),
  (
    5,
    'Spring',
    'Products and services offered during Spring',
    '2005-04-08 15:54:28',
    '2005-03-30 14:58:40'
  ),
  (
    6,
    'Spring, Summer',
    'Products and services offered during Spring and Summer',
    '2005-04-08 15:54:28',
    '2005-04-05 14:28:37'
  ),
  (
    7,
    'Spring, Autumn',
    'Products and services offered during Spring and Autumn',
    '2005-04-08 15:54:28',
    '2005-04-05 14:29:04'
  ),
  (
    8,
    'Spring, Summer, Autumn',
    'Products and services offered during Spring, Summer, and Autumn',
    '2005-04-08 15:54:28',
    '2005-04-05 14:41:00'
  );

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `prod_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(64) DEFAULT NULL,
  `prod_desc` text,
  `prod_notes` text,
  `prod_unit_size` varchar(32) DEFAULT NULL,
  `prod_cost` float(8, 2) DEFAULT NULL,
  `prod_price` decimal(8, 2) DEFAULT NULL,
  `prod_price_d1` float(3, 2) DEFAULT NULL,
  `prod_price_d2` float(3, 2) DEFAULT NULL,
  `prod_is_promote` tinyint(1) UNSIGNED DEFAULT NULL,
  `prod_is_active` tinyint(1) UNSIGNED DEFAULT NULL,
  `prod_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prod_created` datetime DEFAULT NULL,
  `prod_last_mod_by` varchar(16) DEFAULT NULL,
  `ptype_id` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `product_ptype_id` TYPE BTREE (`ptype_id`),
  CONSTRAINT `FK_product_1` FOREIGN KEY (`ptype_id`) REFERENCES `prod_type` (`ptype_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 9216 kB; (`ptype_id`) REFER `zmendev/prod_type`';

INSERT INTO
  `product` (
    `prod_id`,
    `prod_name`,
    `prod_desc`,
    `prod_notes`,
    `prod_unit_size`,
    `prod_cost`,
    `prod_price`,
    `prod_price_d1`,
    `prod_price_d2`,
    `prod_is_promote`,
    `prod_is_active`,
    `prod_lastupd`,
    `prod_created`,
    `prod_last_mod_by`,
    `ptype_id`
  )
VALUES
  (
    1,
    'Basic Package 150',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$15.00 basic package',
    'job',
    0.00,
    '15.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:34:12',
    '2005-04-30 21:28:55',
    NULL,
    8
  ),
  (
    2,
    'Basic Package 175',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$17.50 basic package',
    'job',
    0.00,
    '17.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:34:28',
    '2005-04-30 21:30:13',
    NULL,
    8
  ),
  (
    3,
    'Basic Package 200',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$20.00 basic package',
    'job',
    0.00,
    '20.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:35:19',
    '2005-04-30 21:35:19',
    NULL,
    8
  ),
  (
    4,
    'Basic Package 225',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$22.50 basic package',
    'job',
    0.00,
    '22.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:35:46',
    '2005-04-30 21:35:46',
    NULL,
    8
  ),
  (
    5,
    'Basic Package 250',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$25.00 basic package',
    'job',
    0.00,
    '25.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:36:30',
    '2005-04-30 21:36:30',
    NULL,
    8
  );

INSERT INTO
  `product` (
    `prod_id`,
    `prod_name`,
    `prod_desc`,
    `prod_notes`,
    `prod_unit_size`,
    `prod_cost`,
    `prod_price`,
    `prod_price_d1`,
    `prod_price_d2`,
    `prod_is_promote`,
    `prod_is_active`,
    `prod_lastupd`,
    `prod_created`,
    `prod_last_mod_by`,
    `ptype_id`
  )
VALUES
  (
    6,
    'Basic Package 275',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$27.50 basic package',
    'job',
    0.00,
    '27.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:42:13',
    '2005-04-30 21:42:13',
    NULL,
    8
  ),
  (
    7,
    'Basic Package 300',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$30.00 basic package',
    'job',
    0.00,
    '30.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:43:00',
    '2005-04-30 21:43:00',
    NULL,
    8
  ),
  (
    8,
    'Basic Package 325',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$32.50 basic package',
    'job',
    0.00,
    '32.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:43:26',
    '2005-04-30 21:43:26',
    NULL,
    8
  ),
  (
    9,
    'Basic Package 350',
    'Our basic package of mowing, weed-eating, and blowing.',
    '$35.00 basic package',
    'job',
    0.00,
    '35.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 21:43:52',
    '2005-04-30 21:43:52',
    NULL,
    8
  ),
  (
    10,
    'Snow Removal - Bronze',
    'Snow removal from hard surfaces, for lighter snows.',
    'Up to 3 inches, typical property. Snow shovel will usually suffice. Doesn\'t include salt.',
    'job',
    0.00,
    '10.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:06:02',
    '2005-04-30 22:00:35',
    NULL,
    4
  );

INSERT INTO
  `product` (
    `prod_id`,
    `prod_name`,
    `prod_desc`,
    `prod_notes`,
    `prod_unit_size`,
    `prod_cost`,
    `prod_price`,
    `prod_price_d1`,
    `prod_price_d2`,
    `prod_is_promote`,
    `prod_is_active`,
    `prod_lastupd`,
    `prod_created`,
    `prod_last_mod_by`,
    `ptype_id`
  )
VALUES
  (
    11,
    'Snow Removal - Silver',
    'Snow removal from hard surfaces, for lighter to moderate snows.',
    'Up to 6 inches, typical property. Snow shovel will usually suffice. Doesn\'t include salt. ',
    'job',
    0.00,
    '15.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:05:51',
    '2005-04-30 22:01:33',
    NULL,
    4
  ),
  (
    12,
    'Snow Removal - Gold',
    'Snow removal from hard surfaces, for moderate to heavy snows.',
    'Up to 24 inches, typical property. Involves snow-blower and/or push-plow. Includes salt, as needed. ',
    'job',
    0.00,
    '20.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:06:57',
    '2005-04-30 22:04:44',
    NULL,
    4
  ),
  (
    13,
    'Edging',
    'Edging along sidewalks, driveways, and paths.',
    'May be included in the basic package for valued customers.',
    'job',
    0.00,
    '1.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-05-01 00:11:38',
    '2005-04-30 22:09:07',
    NULL,
    6
  ),
  (
    14,
    'Crab Grass Prevention',
    'Nip that unsightly crab-grass in the bud, with our pre-season treatment that is designed to prevent it from growing before it becomes a problem.',
    'Special time-release granules from Scotts.',
    'pound',
    0.20,
    '1.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:12:04',
    '2005-04-30 22:11:22',
    NULL,
    5
  );

INSERT INTO
  `product` (
    `prod_id`,
    `prod_name`,
    `prod_desc`,
    `prod_notes`,
    `prod_unit_size`,
    `prod_cost`,
    `prod_price`,
    `prod_price_d1`,
    `prod_price_d2`,
    `prod_is_promote`,
    `prod_is_active`,
    `prod_lastupd`,
    `prod_created`,
    `prod_last_mod_by`,
    `ptype_id`
  )
VALUES
  (
    15,
    'Leaf Removal - Standard',
    'Removal of all those unhealthy dead leaves from your property.',
    'Anything from manual raking and blowing, to vaccuming.',
    'job',
    0.00,
    '6.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:15:03',
    '2005-04-30 22:15:03',
    NULL,
    3
  ),
  (
    16,
    'Leaf Removal - Large',
    'Removal of all those unhealthy dead leaves from your property.',
    '',
    'job',
    0.00,
    '11.50',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:15:44',
    '2005-04-30 22:15:25',
    NULL,
    3
  ),
  (
    17,
    'Gutter Cleaning',
    'Remove leaves, seeds, and debris from clogged gutters.',
    'Removal of leaves, seeds, and debris from gutters.',
    'job',
    0.00,
    '5.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-05-01 00:13:20',
    '2005-04-30 22:17:26',
    NULL,
    7
  ),
  (
    18,
    'Seeding',
    'Fill empty spots in your lawn, or simply make your yard thicker and more lush.',
    'grass seed by the pound',
    'pound',
    0.25,
    '1.00',
    NULL,
    NULL,
    NULL,
    1,
    '2005-04-30 22:19:15',
    '2005-04-30 22:19:15',
    NULL,
    5
  );

DROP TABLE IF EXISTS `state`;

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(40) NOT NULL DEFAULT '',
  `state_abbrev` char(2) NOT NULL DEFAULT '',
  `state_isactive` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`state_id`)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `state` (
    `state_id`,
    `state_name`,
    `state_abbrev`,
    `state_isactive`
  )
VALUES
  (1, 'Alaska', 'AK', 0),
  (2, 'Alabama', 'AL', 0),
  (3, 'Arizona', 'AZ', 0),
  (4, 'Arkansas', 'AR', 0),
  (5, 'California', 'CA', 0),
  (6, 'Colorado', 'CO', 0),
  (7, 'Connecticut', 'CT', 0),
  (8, 'Delaware', 'DE', 0),
  (9, 'District of Columbia', 'DC', 0),
  (10, 'Florida', 'FL', 0),
  (11, 'Georgia', 'GA', 0),
  (12, 'Hawaii', 'HI', 0),
  (13, 'Idaho', 'ID', 0),
  (14, 'Illinois', 'IL', 1),
  (15, 'Indiana', 'IN', 1),
  (16, 'Iowa', 'IA', 0),
  (17, 'Kansas', 'KS', 0),
  (18, 'Kentucky', 'KY', 1),
  (19, 'Louisiana', 'LA', 0),
  (20, 'Maine', 'ME', 0),
  (21, 'Maryland', 'MD', 0),
  (22, 'Massachusetts', 'MA', 0),
  (23, 'Michigan', 'MI', 0),
  (24, 'Minnesota', 'MN', 0),
  (25, 'Mississippi', 'MS', 0),
  (26, 'Missouri', 'MO', 0),
  (27, 'Montana', 'MT', 0),
  (28, 'Nebraska', 'NE', 0),
  (29, 'Nevada', 'NV', 0),
  (30, 'New Hampshire', 'NH', 0),
  (31, 'New Jersey', 'NJ', 0),
  (32, 'New Mexico', 'NM', 0),
  (33, 'New York', 'NY', 0),
  (34, 'North Carolina', 'NC', 0),
  (35, 'North Dakota', 'ND', 0),
  (36, 'Ohio', 'OH', 0),
  (37, 'Oklahoma', 'OK', 0),
  (38, 'Oregon', 'OR', 0);

INSERT INTO
  `state` (
    `state_id`,
    `state_name`,
    `state_abbrev`,
    `state_isactive`
  )
VALUES
  (39, 'Pennsylvania', 'PA', 0),
  (40, 'Rhode Island', 'RI', 0),
  (41, 'South Carolina', 'SC', 0),
  (42, 'South Dakota', 'SD', 0),
  (43, 'Tennessee', 'TN', 0),
  (44, 'Texas', 'TX', 0),
  (45, 'Utah', 'UT', 0),
  (46, 'Vermont', 'VT', 0),
  (47, 'Virginia', 'VA', 0),
  (48, 'Washington', 'WA', 0),
  (49, 'West Virginia', 'WV', 0),
  (50, 'Wisconsin', 'WI', 0),
  (51, 'Wyoming', 'WY', 0);

DROP TABLE IF EXISTS `svc_addr_prod`;

CREATE TABLE `svc_addr_prod` (
  `sap_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sa_id` mediumint(8) UNSIGNED DEFAULT '0',
  `prod_id` mediumint(8) UNSIGNED DEFAULT '0',
  `sap_date_added` datetime DEFAULT NULL,
  `sap_added_by` mediumint(8) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`sap_id`),
  KEY `sap_sa_id` TYPE BTREE (`sa_id`),
  KEY `sap_prod_id` TYPE BTREE (`prod_id`),
  KEY `sap_added_by` (`sap_added_by`),
  CONSTRAINT `FK_svc_addr_prod_1` FOREIGN KEY (`sap_added_by`) REFERENCES `admin_user` (`admin_user_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE,
    CONSTRAINT `FK_svc_addr_prod_2` FOREIGN KEY (`sa_id`) REFERENCES `svc_address` (`sa_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `FK_svc_addr_prod_3` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`) ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1 COMMENT = 'InnoDB free: 9216 kB; (`sa_id`) REFER `zmendev/svc_address`(';

INSERT INTO
  `svc_addr_prod` (
    `sap_id`,
    `sa_id`,
    `prod_id`,
    `sap_date_added`,
    `sap_added_by`
  )
VALUES
  (1, 1, 9, '2005-04-20 21:22:33', 1),
  (2, 1, 13, '2005-04-20 21:22:33', 1),
  (3, 1, 17, '2005-04-20 21:22:33', 1),
  (4, 1, 18, '2005-04-20 21:22:33', 1),
  (5, 2, 1, '2005-04-20 21:22:33', 1),
  (6, 2, 13, '2005-04-20 21:22:33', 1),
  (7, 2, 17, '2005-04-20 21:22:33', 1),
  (8, 2, 18, '2005-04-20 21:22:33', 1),
  (9, 3, 2, '2005-04-20 21:22:33', 1),
  (10, 3, 13, '2005-04-20 21:22:33', 1),
  (11, 3, 17, '2005-04-20 21:22:33', 1),
  (12, 3, 18, '2005-04-20 21:22:33', 1),
  (13, 4, 2, '2005-04-20 21:22:33', 1),
  (14, 4, 13, '2005-04-20 21:22:33', 1),
  (15, 4, 17, '2005-04-20 21:22:33', 1),
  (16, 4, 18, '2005-04-20 21:22:33', 1),
  (17, 5, 3, '2005-04-20 21:22:33', 1),
  (18, 5, 13, '2005-04-20 21:22:33', 1),
  (19, 5, 17, '2005-04-20 21:22:33', 1),
  (20, 5, 18, '2005-04-20 21:22:33', 1),
  (21, 6, 2, '2005-05-01 02:23:42', 1),
  (22, 6, 13, '2005-05-01 02:23:42', 1),
  (23, 6, 14, '2005-05-01 02:23:43', 1),
  (24, 6, 18, '2005-05-01 02:23:43', 1),
  (25, 7, 5, '2005-02-01 17:00:31', 1),
  (26, 7, 13, '2005-02-01 17:00:31', 1),
  (27, 7, 14, '2005-02-01 17:00:31', 1);

INSERT INTO
  `svc_addr_prod` (
    `sap_id`,
    `sa_id`,
    `prod_id`,
    `sap_date_added`,
    `sap_added_by`
  )
VALUES
  (28, 7, 17, '2005-02-01 17:00:31', 1),
  (29, 7, 18, '2005-02-01 17:00:31', 1),
  (30, 8, 2, '2005-02-01 17:07:53', 1),
  (31, 8, 13, '2005-02-01 17:07:53', 1),
  (32, 9, 1, '2005-05-01 17:39:26', 1),
  (33, 10, 5, '2005-05-01 21:48:52', 1),
  (34, 10, 13, '2005-05-01 21:48:52', 1),
  (35, 10, 18, '2005-05-01 21:48:52', 1),
  (36, 14, 1, '2005-05-01 22:14:01', 1),
  (37, 14, 17, '2005-05-01 22:14:01', 1),
  (38, 15, 9, '2005-05-01 22:27:37', 1),
  (39, 15, 13, '2005-05-01 22:27:37', 1),
  (40, 15, 14, '2005-05-01 22:27:37', 1),
  (41, 15, 17, '2005-05-01 22:27:37', 1),
  (42, 15, 18, '2005-05-01 22:27:38', 1),
  (43, 16, 7, '2005-05-01 22:27:38', 1),
  (44, 16, 13, '2005-05-01 22:27:38', 1),
  (45, 16, 17, '2005-05-01 22:27:38', 1),
  (46, 16, 18, '2005-05-01 22:27:38', 1),
  (47, 17, 1, '2005-05-01 22:55:30', 1),
  (48, 17, 13, '2005-05-01 22:55:30', 1),
  (49, 17, 14, '2005-05-01 22:55:30', 1),
  (50, 17, 17, '2005-05-01 22:55:30', 1),
  (51, 17, 18, '2005-05-01 22:55:30', 1),
  (52, 18, 4, '2005-05-01 23:01:22', 1),
  (53, 18, 13, '2005-05-01 23:01:22', 1);

INSERT INTO
  `svc_addr_prod` (
    `sap_id`,
    `sa_id`,
    `prod_id`,
    `sap_date_added`,
    `sap_added_by`
  )
VALUES
  (54, 18, 14, '2005-05-01 23:01:22', 1),
  (55, 18, 17, '2005-05-01 23:01:22', 1),
  (56, 18, 18, '2005-05-01 23:01:22', 1),
  (57, 19, 5, '2005-05-01 23:07:47', 1),
  (58, 19, 13, '2005-05-01 23:07:47', 1),
  (59, 19, 14, '2005-05-01 23:07:47', 1),
  (60, 19, 17, '2005-05-01 23:07:47', 1),
  (61, 19, 18, '2005-05-01 23:07:47', 1),
  (62, 20, 5, '2005-05-01 23:07:47', 1),
  (63, 20, 13, '2005-05-01 23:07:47', 1),
  (64, 20, 14, '2005-05-01 23:07:48', 1),
  (65, 20, 17, '2005-05-01 23:07:48', 1),
  (66, 20, 18, '2005-05-01 23:07:48', 1),
  (67, 21, 5, '2005-05-01 23:07:48', 1),
  (68, 21, 13, '2005-05-01 23:07:48', 1),
  (69, 21, 14, '2005-05-01 23:07:48', 1),
  (70, 21, 17, '2005-05-01 23:07:48', 1),
  (71, 21, 18, '2005-05-01 23:07:48', 1),
  (72, 22, 5, '2005-05-01 23:07:48', 1),
  (73, 22, 13, '2005-05-01 23:07:48', 1),
  (74, 22, 14, '2005-05-01 23:07:48', 1),
  (75, 22, 17, '2005-05-01 23:07:48', 1),
  (76, 22, 18, '2005-05-01 23:07:48', 1),
  (77, 23, 5, '2005-05-01 23:07:48', 1),
  (78, 23, 13, '2005-05-01 23:07:49', 1),
  (79, 23, 14, '2005-05-01 23:07:49', 1);

INSERT INTO
  `svc_addr_prod` (
    `sap_id`,
    `sa_id`,
    `prod_id`,
    `sap_date_added`,
    `sap_added_by`
  )
VALUES
  (80, 23, 17, '2005-05-01 23:07:49', 1),
  (81, 23, 18, '2005-05-01 23:07:49', 1),
  (82, 24, 5, '2005-05-01 23:07:49', 1),
  (83, 24, 13, '2005-05-01 23:07:49', 1),
  (84, 24, 14, '2005-05-01 23:07:49', 1),
  (85, 24, 17, '2005-05-01 23:07:49', 1),
  (86, 24, 18, '2005-05-01 23:07:49', 1),
  (87, 25, 5, '2005-05-01 23:07:49', 1),
  (88, 25, 13, '2005-05-01 23:07:49', 1),
  (89, 25, 14, '2005-05-01 23:07:49', 1),
  (90, 25, 17, '2005-05-01 23:07:49', 1),
  (91, 25, 18, '2005-05-01 23:07:49', 1),
  (92, 26, 6, '2005-05-01 23:12:43', 1),
  (93, 26, 13, '2005-05-01 23:12:43', 1),
  (94, 26, 14, '2005-05-01 23:12:43', 1),
  (95, 26, 17, '2005-05-01 23:12:43', 1),
  (96, 26, 18, '2005-05-01 23:12:43', 1),
  (97, 27, 1, '2005-05-01 23:21:58', 1),
  (98, 28, 1, '2005-05-01 23:25:57', 1),
  (99, 29, 1, '2005-05-02 02:06:07', 1),
  (100, 29, 17, '2005-05-02 02:06:07', 1),
  (101, 29, 18, '2005-05-02 02:06:07', 1),
  (102, 30, 3, '2005-05-02 02:06:07', 1),
  (103, 30, 13, '2005-05-02 02:06:07', 1);

DROP TABLE IF EXISTS `svc_address`;

CREATE TABLE `svc_address` (
  `sa_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cust_id` mediumint(8) UNSIGNED DEFAULT '0',
  `sa_address1` varchar(64) DEFAULT NULL,
  `sa_address2` varchar(64) DEFAULT NULL,
  `sa_city` varchar(32) DEFAULT NULL,
  `sa_state` char(2) DEFAULT NULL,
  `sa_zip` varchar(10) DEFAULT NULL,
  `sa_area_code` char(3) DEFAULT NULL,
  `sa_phone` varchar(14) DEFAULT NULL,
  `sa_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sa_created` datetime DEFAULT NULL,
  `sa_last_mod_by` varchar(16) DEFAULT NULL,
  `sa_last_serviced` date DEFAULT NULL,
  `sa_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`sa_id`),
  KEY `svc_address_cust_id` TYPE BTREE (`cust_id`),
  CONSTRAINT `FK_svc_address_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `svc_address` (
    `sa_id`,
    `cust_id`,
    `sa_address1`,
    `sa_address2`,
    `sa_city`,
    `sa_state`,
    `sa_zip`,
    `sa_area_code`,
    `sa_phone`,
    `sa_lastupd`,
    `sa_created`,
    `sa_last_mod_by`,
    `sa_last_serviced`,
    `sa_status`
  )
VALUES
  (
    1,
    1,
    '1 Chicken Lane',
    '',
    'Louisville',
    'KY',
    '40201',
    '502',
    '555-1224',
    '2005-05-01 02:26:22',
    '2005-04-20 21:22:33',
    '1',
    '2005-05-01',
    'complete'
  ),
  (
    2,
    1,
    '7497 East Main St.',
    '',
    'Louisville',
    'KY',
    '40202',
    '502',
    '555-8997',
    '2005-05-01 21:10:06',
    '2005-04-20 21:22:33',
    '1',
    '2005-05-01',
    'checkout'
  ),
  (
    3,
    1,
    '1298 State St.',
    '',
    'New Albany',
    'IN',
    '47129',
    '812',
    '555-9444',
    '2005-05-01 02:26:33',
    '2005-04-20 21:22:33',
    '1',
    '2005-05-01',
    'complete'
  ),
  (
    4,
    1,
    '789 Hwy. 23',
    '',
    'Charlestown',
    'IN',
    '47111',
    '812',
    '555-9812',
    '2005-05-01 02:26:29',
    '2005-04-20 21:22:33',
    '1',
    '2005-04-23',
    'incomplete'
  ),
  (
    5,
    1,
    '891 N. Green River Rd.',
    '',
    'Evansville',
    'IN',
    '47715',
    '812',
    '555-9088',
    '2005-04-30 23:05:54',
    '2005-04-20 21:22:33',
    '1',
    '2005-04-20',
    'complete'
  ),
  (
    6,
    2,
    '326 Faker Ave.',
    '',
    'Evansville',
    'IN',
    '47713',
    '812',
    '555-3395',
    '2005-05-01 21:26:06',
    '2005-05-01 02:23:42',
    '1',
    NULL,
    'checkout'
  ),
  (
    7,
    3,
    '4032 North Fall Ave.',
    '',
    'Evansville',
    'IN',
    '47712',
    '812',
    '555-1228',
    '2005-05-01 17:23:25',
    '2005-02-01 17:00:31',
    '1',
    NULL,
    NULL
  );

INSERT INTO
  `svc_address` (
    `sa_id`,
    `cust_id`,
    `sa_address1`,
    `sa_address2`,
    `sa_city`,
    `sa_state`,
    `sa_zip`,
    `sa_area_code`,
    `sa_phone`,
    `sa_lastupd`,
    `sa_created`,
    `sa_last_mod_by`,
    `sa_last_serviced`,
    `sa_status`
  )
VALUES
  (
    8,
    3,
    '2 Second St.',
    '',
    'Newburgh',
    'IN',
    '47720',
    '812',
    '555-4233',
    '2005-05-01 17:23:25',
    '2005-02-01 17:07:53',
    NULL,
    NULL,
    NULL
  ),
  (
    9,
    5,
    '475 W CR 175 N',
    '',
    'Evansville',
    'IN',
    '47761',
    '812',
    '555-0207',
    '2005-05-01 17:39:26',
    '2005-05-01 17:39:26',
    '1',
    NULL,
    NULL
  ),
  (
    10,
    6,
    '998 West Branch',
    '',
    'Evansville',
    'IN',
    '47711',
    '812',
    '555-9981',
    '2005-05-01 21:48:52',
    '2005-05-01 21:48:52',
    '1',
    NULL,
    NULL
  ),
  (
    14,
    7,
    '228 Oak Trace',
    '',
    'Highlands',
    'KY',
    '40203',
    '502',
    '555-2121',
    '2005-05-01 22:14:01',
    '2005-05-01 22:14:01',
    '1',
    NULL,
    NULL
  ),
  (
    15,
    8,
    '1600 Pencil Ave.',
    '',
    'New Washington',
    'IN',
    '47157',
    '812',
    '555-8876',
    '2005-05-01 22:27:37',
    '2005-05-01 22:27:37',
    '1',
    NULL,
    NULL
  ),
  (
    16,
    8,
    '518 Main St.',
    '',
    'Anytown',
    'IL',
    '30497',
    '812',
    '555-7754',
    '2005-05-01 22:27:38',
    '2005-05-01 22:27:38',
    '1',
    NULL,
    NULL
  ),
  (
    17,
    9,
    '2345 1st Avenue',
    '',
    'Evansville',
    'IN',
    '47710',
    '812',
    '555-4567',
    '2005-05-01 22:55:29',
    '2005-05-01 22:55:29',
    '1',
    NULL,
    NULL
  ),
  (
    18,
    11,
    '7401 Eagle Crest Blvd',
    '',
    'Evansville',
    'IN',
    '47715',
    '812',
    '555-3776',
    '2005-05-01 23:01:22',
    '2005-05-01 23:01:22',
    '1',
    NULL,
    NULL
  );

INSERT INTO
  `svc_address` (
    `sa_id`,
    `cust_id`,
    `sa_address1`,
    `sa_address2`,
    `sa_city`,
    `sa_state`,
    `sa_zip`,
    `sa_area_code`,
    `sa_phone`,
    `sa_lastupd`,
    `sa_created`,
    `sa_last_mod_by`,
    `sa_last_serviced`,
    `sa_status`
  )
VALUES
  (
    19,
    12,
    '220 West Francine',
    '',
    'Evansville',
    'IN',
    '47711',
    '812',
    '555-3196',
    '2005-05-01 23:50:02',
    '2004-03-09 23:07:46',
    '1',
    '2005-04-30',
    'incomplete'
  ),
  (
    20,
    12,
    '2038 Divider St.',
    '',
    'Evansville',
    'IN',
    '47713',
    '812',
    '555-1581',
    '2005-05-01 23:50:02',
    '2004-03-09 23:07:47',
    '1',
    '2005-04-26',
    'complete'
  ),
  (
    21,
    12,
    '44111 North 2nd Avenue',
    '',
    'Evansville',
    'IN',
    '47710',
    '812',
    '555-4110',
    '2005-05-01 23:50:02',
    '2004-03-09 23:07:48',
    '1',
    '2005-04-25',
    'complete'
  ),
  (
    22,
    12,
    '101 S. Green River Road',
    '',
    'Evansville',
    'IN',
    '47714',
    '812',
    '555-5555',
    '2005-05-01 23:50:02',
    '2004-03-09 23:07:48',
    '1',
    '2005-04-25',
    'complete'
  ),
  (
    23,
    12,
    '461 Bellemeazer',
    '',
    'Evansville',
    'IN',
    '47713',
    '812',
    '555-6226',
    '2005-05-01 23:50:02',
    '2004-06-04 23:07:48',
    '1',
    '2005-04-23',
    'complete'
  ),
  (
    24,
    12,
    '4615 University Dr.',
    '',
    'Evansville',
    'IN',
    '47720',
    '812',
    '555-2650',
    '2005-05-01 23:50:02',
    '2005-03-21 23:07:49',
    '1',
    '2005-04-22',
    'complete'
  ),
  (
    25,
    12,
    '8388 Bellaks',
    '',
    'Newburgh',
    'IN',
    '47735',
    '812',
    '555-1111',
    '2005-05-01 23:50:03',
    '2005-03-21 23:07:49',
    '1',
    '2005-04-23',
    'complete'
  );

INSERT INTO
  `svc_address` (
    `sa_id`,
    `cust_id`,
    `sa_address1`,
    `sa_address2`,
    `sa_city`,
    `sa_state`,
    `sa_zip`,
    `sa_area_code`,
    `sa_phone`,
    `sa_lastupd`,
    `sa_created`,
    `sa_last_mod_by`,
    `sa_last_serviced`,
    `sa_status`
  )
VALUES
  (
    26,
    13,
    '141 N elm Street',
    '',
    'Henderson',
    'KY',
    ' 42420',
    '270',
    ' 555-025',
    '2005-05-01 23:12:43',
    '2005-05-01 23:12:43',
    '1',
    NULL,
    NULL
  ),
  (
    27,
    15,
    '202 E Cherry St',
    '',
    'Carmi',
    'IL',
    '62821',
    '618',
    '555-4841',
    '2005-05-01 23:21:58',
    '2005-05-01 23:21:58',
    '1',
    NULL,
    NULL
  ),
  (
    28,
    17,
    '2121 starwars drive',
    '',
    'Mt. Vernon',
    'IL',
    '47721',
    '812',
    '555-4567',
    '2005-05-01 23:25:57',
    '2005-05-01 23:25:57',
    '1',
    NULL,
    NULL
  ),
  (
    29,
    18,
    '123 First St.',
    '',
    'Fairfield',
    'IL',
    '23388-6776',
    '555',
    '555-5555',
    '2005-05-02 02:06:07',
    '2005-05-02 02:06:07',
    '1',
    NULL,
    NULL
  ),
  (
    30,
    18,
    '456 Second St.',
    '',
    'Mt. Vernon',
    'IL',
    '23499-4322',
    '555',
    '555-1111',
    '2005-05-02 02:06:07',
    '2005-05-02 02:06:07',
    '1',
    NULL,
    NULL
  );

DROP TABLE IF EXISTS `tip`;

CREATE TABLE `tip` (
  `tip_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ptype_id` tinyint(3) UNSIGNED DEFAULT NULL,
  `tip_text` text,
  `tip_lastupd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tip_created` datetime DEFAULT NULL,
  `tip_last_mod_by` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`tip_id`),
  KEY `tip_ptype_id` TYPE BTREE (`ptype_id`),
  CONSTRAINT `ptype` FOREIGN KEY (`ptype_id`) REFERENCES `prod_type` (`ptype_id`) ON DELETE
  SET
    NULL ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
  `tip` (
    `tip_id`,
    `ptype_id`,
    `tip_text`,
    `tip_lastupd`,
    `tip_created`,
    `tip_last_mod_by`
  )
VALUES
  (
    1,
    2,
    'A mower\'s engine turns the blade with the right amount of energy at full throttle.  Gas is not saved when the engine is slowed.',
    '2005-04-30 20:44:08',
    '2005-03-31 11:04:30',
    '5'
  ),
  (
    2,
    5,
    'You should overseed your lawn between the months of March and May.',
    '2005-04-30 20:44:08',
    '2005-04-04 11:06:41',
    '5'
  ),
  (
    3,
    5,
    'Freshly planted grass needs approximately 1 of water per day unitl the seeds have germinated.',
    '2005-04-30 20:43:44',
    '2005-04-04 11:08:31',
    '1'
  ),
  (
    4,
    5,
    'Aplying starter fertilizer directly after planting grass seed will stimulate early root development, so your seedlings develop.',
    '2005-04-30 20:43:44',
    '2005-04-04 14:53:39',
    '1'
  ),
  (
    5,
    5,
    'Early Spring is the best time to apply crabgrass preventer.',
    '2005-04-30 20:44:08',
    '2005-04-04 14:56:47',
    '5'
  ),
  (
    6,
    5,
    'Apply a Turf Fertilizer to help make your lawn greener, thicker, and stronger.',
    '2005-04-30 20:44:08',
    '2005-04-04 15:04:34',
    '5'
  ),
  (
    7,
    2,
    'Apply a Summer Guard Fertilizer to help prevent brown spots and patches from appearing because of heat or drought.',
    '2005-04-30 20:44:08',
    '2005-04-04 15:14:21',
    '5'
  );

INSERT INTO
  `tip` (
    `tip_id`,
    `ptype_id`,
    `tip_text`,
    `tip_lastupd`,
    `tip_created`,
    `tip_last_mod_by`
  )
VALUES
  (
    8,
    2,
    'Apply Grub Control to prevent grubs from damaging your yard.  It also helps prevent moles by eliminating their food source.',
    '2005-04-30 20:44:08',
    '2005-04-04 15:16:47',
    '5'
  ),
  (
    9,
    5,
    'Turn simple mail boxes or lamp posts into visual centerpieces by circling them with flowers from earliest to latest spring. Position rocks around posts, as well, to create added interest.',
    '2005-04-30 20:43:44',
    '2005-04-04 15:17:30',
    '1'
  ),
  (
    28,
    7,
    'In the spring or fall, sprinkle lawn with grass seed. This helps to fill in bare spots in your lawn.  It also helps to eliminate weeds.  First, loosen soil and spread peat moss, compost, or top soil.  Then, walk over the lawn to help seeds settle into the soil.  Don\'t forget to water!',
    '2005-04-05 14:46:51',
    '2005-04-04 15:20:15',
    '1'
  ),
  (
    29,
    3,
    'Shaded areas of lawns hamper grass growth.  To give your lawn maximum sunlight, rake it, especially in October and November when leaves and pine straw cover the ground.',
    '2005-04-08 15:57:57',
    '2005-04-04 15:23:38',
    '1'
  ),
  (
    30,
    5,
    'Mowing is not about making a fashion statement, so wear safety glasses, when needed, and shoes with some grip to them.  Do not where sandals!',
    '2005-04-08 15:58:23',
    '2005-04-04 15:25:59',
    '1'
  );

INSERT INTO
  `tip` (
    `tip_id`,
    `ptype_id`,
    `tip_text`,
    `tip_lastupd`,
    `tip_created`,
    `tip_last_mod_by`
  )
VALUES
  (
    31,
    5,
    'A good source of nutrients for you lawn is compost.  A small layer of composted plant matter can add vital nutrients over a period of time.  You will not get an instant growth to you lawn.  Over time, your lawn will have you looking like a master lawn gardener!',
    '2005-04-30 20:44:08',
    '2005-04-04 15:30:25',
    '5'
  ),
  (
    32,
    3,
    'Fall is normally a drier season.  Therefore, you should water lawns periodically to avoid turf stress.  An early stress warning to watch is if your grass doesn\'t spring back after being walked across.  Another is if there is a change in color, usually from dark to light.',
    '2005-04-30 20:44:35',
    '2005-04-04 15:32:47',
    '5'
  ),
  (
    36,
    8,
    'Always pick up fallen branches and/or debris before mowing. This will prevent damaging a mower blade and the possibility of injuring someone or yourself.',
    '2005-04-05 14:41:10',
    '2005-04-04 15:50:40',
    '1'
  ),
  (
    40,
    2,
    'Water your lawn in the morning.  This allows time for water to evaporate.  Wet grass that sits overnight is a prime setting for fungus growth.',
    '2005-04-06 16:09:06',
    '2005-04-06 16:09:06',
    '5'
  ),
  (
    41,
    2,
    'Proper watering and mowing greatly affects the health and look of your lawn during the summer months. Lawns need at least 1 inch of water per week.',
    '2005-04-06 16:29:07',
    '2005-04-06 16:29:07',
    '5'
  );

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;

/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;

SET
  CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT;

SET
  CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS;

SET
  COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;