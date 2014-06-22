-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 23, 2014 at 12:04 AM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `arun`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `address_one` varchar(100) NOT NULL,
  `address_two` varchar(100) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `corporate_email` varchar(100) NOT NULL,
  `no_of_users` int(11) NOT NULL,
  `start_date` date NOT NULL COMMENT 'Corporate start date',
  `end_date` date NOT NULL COMMENT 'Corporate end date',
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `company_name`, `address_one`, `address_two`, `contact_number`, `corporate_email`, `no_of_users`, `start_date`, `end_date`, `status`, `created`) VALUES
(1, 'abc', 'address for this', '', '7845121654', 'corporate@email.com', 8, '2014-06-01', '2014-12-31', 1, '0000-00-00 00:00:00'),
(2, 'test company', 'pune', 'pune', '94329423', 'zsdc@sdf.com', 3, '2014-05-20', '2014-07-20', 1, '2014-05-26 09:40:30'),
(3, 'test company', 'pune', 'pune', '343249348', 'test@co.com', 20, '2014-05-20', '2014-07-20', 1, '2014-06-04 08:21:44');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE IF NOT EXISTS `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content_type` varchar(50) NOT NULL,
  `content_data` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `content_type`, `content_data`, `created`, `modified`) VALUES
(1, 'contact_us', 'contact us contact us contact us contact us contact us contact us contact us contact us contact us contact us.a', '0000-00-00 00:00:00', '2014-05-22 16:42:19'),
(2, 'privacy_policy', 'Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy Privacy Policy.', '2014-05-30 20:14:41', '2014-05-22 16:45:46'),
(3, 'terms_conditions', 'Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions Terms and Conditions.', '0000-00-00 00:00:00', '2014-05-22 16:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `elists`
--

CREATE TABLE IF NOT EXISTS `elists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Holds the information of My emailing List' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `elists`
--

INSERT INTO `elists` (`id`, `name`, `published`, `created`, `modified`) VALUES
(3, 'test', 1, '2014-06-21 17:14:39', '2014-06-21 17:14:42'),
(4, 'fgdfgf', 1, '2014-06-22 23:55:25', '2014-06-22 23:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elist_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `elist_id`, `email`, `created`, `modified`) VALUES
(1, 3, 'ravi@ravi.com', '2014-06-21 17:18:55', '2014-06-21 17:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `emails_stats`
--

CREATE TABLE IF NOT EXISTS `emails_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_form_id` int(11) NOT NULL,
  `email_id` varchar(256) NOT NULL,
  `sent` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Hold the stats for Mails' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_forms`
--

CREATE TABLE IF NOT EXISTS `email_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `elist_id` int(11) NOT NULL COMMENT 'foreign keys to email list table',
  `template_id` int(11) NOT NULL COMMENT 'Foreign key to template table',
  `name` varchar(150) NOT NULL,
  `from_email` varchar(265) NOT NULL,
  `from_email_name` varchar(256) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `sch_date` varchar(256) NOT NULL,
  `sch_time` text NOT NULL,
  `time_zone` varchar(256) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `sent` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Hold the Email and Its Scheduling Information' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `email_forms`
--

INSERT INTO `email_forms` (`id`, `elist_id`, `template_id`, `name`, `from_email`, `from_email_name`, `subject`, `sch_date`, `sch_time`, `time_zone`, `created`, `modified`, `published`, `sent`) VALUES
(1, 3, 12, 'ghjhgj', 'hgjghj', 'ghjghjghj', 'ghjgh', 'jghjg', 'hjghjgh', 'jghj', '2014-06-22 23:48:38', '2014-06-22 23:48:38', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inquries`
--

CREATE TABLE IF NOT EXISTS `inquries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `inquiry_type` varchar(50) NOT NULL,
  `details` text NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `inquries`
--

INSERT INTO `inquries` (`id`, `name`, `company`, `email`, `phone`, `inquiry_type`, `details`, `ip_address`, `created`) VALUES
(1, 'kjbkj', 'bjkhb', 'jkb@sdfgsdf.sdf', 'kj', 'bkjb', 'kjbk asdasd asdasd sadsad asd', '127.0.0.1', '0000-00-00 00:00:00'),
(2, 'lkn', 'lkn', 'lknb@sdfsdf.sss', 'lkjnb', 'lkl', 'knklj', '127.0.0.1', '2014-05-22 17:08:26'),
(3, 'khkh', 'kh', 'lknb@sdfsdf.sss', 'lnhlkhnklnh', 'knbk', 'bk', '127.0.0.1', '2014-05-22 17:09:03'),
(4, 'a jksdfjkbk', 'gkigkjgg', 'lknb@sdfsdf.sss', 'bgkljhbgsajklfdhbsalk', 'khbaskfhskalfh', 'khbdsakfhsdfsd', '127.0.0.1', '2014-05-22 17:09:14'),
(5, 'sdbfk ahfkh', 'hbsdkfhskdh', 'lknb@sdfsdf.sss', 'lsdnflskdh', 'lsahflsdh', 'lsghnlds', '127.0.0.1', '2014-05-22 17:09:23'),
(6, 'saeekjhbg askhb', 'l kshf ksah', 'lknb@sdfsdf.sss', 'dfds', 'sljsljg', 'lnslgndslg', '127.0.0.1', '2014-05-22 17:09:43'),
(7, 'askhf k', 'hkslfhlksh', 'lknb@sdfsdf.sss', 'alfnlasfn', 'lnasflkn', 'lafnlksanfln', '127.0.0.1', '2014-05-22 17:09:52'),
(8, 'sd,fjnbksd fnbk', 'lnsldfnsl d', 'lknb@sdfsdf.sss', 'alsjnfslsdnf', 'ldnvlsdn', 'lknb@sdfsdf.sss', '127.0.0.1', '2014-05-22 17:10:04'),
(9, 'sa kdhkh', 'lhalksnflskdfn l', 'lknb@sdfsdf.sss', 'sdlfnsldn', 'lsnldn', 'lnlnldfn', '127.0.0.1', '2014-05-22 17:10:23'),
(10, 'sdk hglsah', 'hlsdhfsl l', 'lknb@sdfsdf.sss', 'sndlgsnd', 'l hdslg shl ', 'l hnlhf lshf lsdhf lsdfh', '127.0.0.1', '2014-05-22 17:10:35'),
(11, 'ksdhf klsh', 'jsdljf ls', 'lknb@sdfsdf.sss', 'sljdlsdj ', 'ldsjvl sj', 'j sldjl sdj gfl', '127.0.0.1', '2014-05-22 17:10:55'),
(12, 's dkjhgkslh', 'nlsnfl sad', 'lknb@sdfsdf.sss', 'lsdnfl s', 'lxjvgsld', 'ldlvn sl', '127.0.0.1', '2014-05-22 17:11:15');

-- --------------------------------------------------------

--
-- Table structure for table `maildomains`
--

CREATE TABLE IF NOT EXISTS `maildomains` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail_server_ip` varchar(200) NOT NULL,
  `pop3_address` varchar(100) NOT NULL,
  `pop3_port` int(11) NOT NULL,
  `smtp_address` varchar(100) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `newsletter_mail_id` varchar(100) NOT NULL,
  `mail_password` varchar(200) NOT NULL,
  `webmail_url` varchar(100) NOT NULL,
  `email_footer` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `maildomains`
--

INSERT INTO `maildomains` (`id`, `mail_server_ip`, `pop3_address`, `pop3_port`, `smtp_address`, `smtp_port`, `newsletter_mail_id`, `mail_password`, `webmail_url`, `email_footer`, `user_id`, `status`, `created`) VALUES
(1, '125.212.54.211', '4354', 3543, '43', 43, '', '354', '3654', '6354634', 2, 0, '2014-05-22 19:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `my_files`
--

CREATE TABLE IF NOT EXISTS `my_files` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `data` longblob NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`) VALUES
(1, 'Super Admin', 1),
(2, 'User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

CREATE TABLE IF NOT EXISTS `tbl_category_master` (
  `category_id` int(2) NOT NULL COMMENT 'Short Name of Category',
  `category_name` char(1) NOT NULL COMMENT 'S:????????',
  `category_description` varchar(50) NOT NULL COMMENT 'Description of category in detail',
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record updation date',
  `deleted_flag` char(1) NOT NULL DEFAULT 'N' COMMENT 'To identify deleted status',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of possible categories';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_master`
--

CREATE TABLE IF NOT EXISTS `tbl_client_master` (
  `client_id` varchar(20) NOT NULL COMMENT '"Client Unique ID',
  `client_name` varchar(50) NOT NULL COMMENT '"Client Name',
  `client_address1` varchar(100) DEFAULT NULL COMMENT '"Client address',
  `client_address2` varchar(100) DEFAULT NULL COMMENT '"Client address',
  `client_contact_no` varchar(20) NOT NULL COMMENT '"Client landline / Mobile number',
  `client_email` varchar(30) NOT NULL COMMENT '"client email',
  `client_contact_person` varchar(50) NOT NULL COMMENT '"client contact person',
  `client_no_of_user` int(11) NOT NULL DEFAULT '1' COMMENT 'Number of user can use Diggy system',
  `contract_start_date` datetime NOT NULL COMMENT 'Start date of contract',
  `contract_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'End date of contract',
  `contract_suspend_status` char(1) NOT NULL DEFAULT 'N' COMMENT 'Gives the status of client is in Suspended state or not??',
  `mail_domain_id` varchar(20) NOT NULL COMMENT '"Domain Unique ID',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Record registration date',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record updation date',
  `deleted_flag` char(1) NOT NULL DEFAULT 'N' COMMENT 'To identify deleted status',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='"This table will hold a company information from which News ';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code_master`
--

CREATE TABLE IF NOT EXISTS `tbl_code_master` (
  `code_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code_jap_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `code_eng_name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `code_jap_value` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `code_eng_value` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `code_descritpion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This will hold all possible codes and values that may come a';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_diggy_user_master`
--

CREATE TABLE IF NOT EXISTS `tbl_diggy_user_master` (
  `user_name` varchar(25) NOT NULL COMMENT 'User login email address',
  `password` varchar(12) NOT NULL COMMENT '"Password',
  `full_name` varchar(50) NOT NULL COMMENT '"Full name of user ',
  `designation` varchar(20) DEFAULT NULL COMMENT '"Designation of user',
  `client_id` varchar(20) DEFAULT NULL COMMENT '"Client company ID',
  `email` varchar(30) NOT NULL COMMENT '"email id of user',
  `role` int(1) NOT NULL DEFAULT '1' COMMENT 'Defines the Role or Group to whom user belongs',
  `initial_password` char(1) NOT NULL DEFAULT 'N' COMMENT 'Status to check if initial password is reset',
  `is_admin` char(1) NOT NULL DEFAULT 'N' COMMENT 'Defines ADMIN rights given to user',
  `created_on` datetime NOT NULL COMMENT 'Record registration date',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record updation date',
  `deleted_flag` char(1) NOT NULL DEFAULT 'N' COMMENT 'To identify if user is deleted or not.',
  PRIMARY KEY (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='"This will hold the information of users going to use this s';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emaildomain_master`
--

CREATE TABLE IF NOT EXISTS `tbl_emaildomain_master` (
  `mail_domain_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mail_server_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mail_pop3_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mail_pop3_port` int(3) NOT NULL,
  `mail_smtp_add` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mail_smtp_port` int(3) NOT NULL,
  `Newsletter_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `webmail_url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `mail_footer` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`mail_domain_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This will hold all Exclusive email address for particular cl';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry_master`
--

CREATE TABLE IF NOT EXISTS `tbl_inquiry_master` (
  `inquiry_id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email_communication` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `Phone_communication` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `face_communication` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `inquiry_message` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `is_open` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `open_reason` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`inquiry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This will hold all the inquiry information from users and tr';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list_master`
--

CREATE TABLE IF NOT EXISTS `tbl_list_master` (
  `client_id` varchar(20) NOT NULL,
  `list_id` varchar(15) NOT NULL,
  `list_name` varchar(70) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`client_id`,`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This will hold the name of List Client has given to set of u';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_scheduler`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_scheduler` (
  `mail_tran_id` varchar(15) NOT NULL,
  `client_id` varchar(15) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `list_id` varchar(15) NOT NULL,
  `mail_template` varchar(15) NOT NULL,
  `target_dispatch_dt` datetime NOT NULL,
  `Is_processed` char(1) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`mail_tran_id`,`client_id`,`user_id`,`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This will hold all the information about the users for which';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_template_master`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_template_master` (
  `mail_template_id` varchar(15) NOT NULL,
  `mail_template_subject` varchar(100) NOT NULL,
  `mail_template_data` varchar(2000) NOT NULL,
  `mail_type` char(1) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) NOT NULL,
  PRIMARY KEY (`mail_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This will store mail template offered by Diggy System';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_template_user`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_template_user` (
  `list_id` varchar(15) NOT NULL,
  `mail_template_id` varchar(15) NOT NULL,
  `mail_subject` varchar(100) NOT NULL,
  `mail_data` varchar(200) NOT NULL,
  `is_modified` char(1) NOT NULL DEFAULT 'N',
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`list_id`,`mail_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This will store Customized mail template for list / client--';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_user`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_user` (
  `client_id` varchar(15) NOT NULL COMMENT 'Client ID',
  `user_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'User ID ( Auto Increment )',
  `list_id` varchar(15) NOT NULL COMMENT 'Specific List name defined by Client for set of users',
  `id` varchar(20) NOT NULL COMMENT 'This value will be provided by client through CSV.',
  `user_name` varchar(50) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `age` int(2) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `prefecture` varchar(25) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'E' COMMENT 'By Default : E:',
  `pc_email` varchar(100) DEFAULT NULL COMMENT 'Either email is mandatory',
  `mobile_email` varchar(100) DEFAULT NULL COMMENT 'Either email is mandatory',
  `device_type` varchar(20) NOT NULL COMMENT 'Either email is mandatory',
  `reply_status` char(1) DEFAULT 'N' COMMENT 'If reply is received then set it as Y else N by default',
  `contact_status` char(1) NOT NULL DEFAULT 'N' COMMENT '"Gives the contact status only if received reply from Users',
  `created_on` datetime DEFAULT NULL COMMENT 'Record registration date',
  `updated_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record updation date',
  `deleted_flag` char(1) NOT NULL DEFAULT 'N' COMMENT 'To identify if user is deleted or not.',
  PRIMARY KEY (`user_id`,`client_id`,`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table will the list of users for which Mail will be sen' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mail_user_tran`
--

CREATE TABLE IF NOT EXISTS `tbl_mail_user_tran` (
  `transaction_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `list_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `id` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `category` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `mail_sent_date` datetime NOT NULL,
  `mail_sent_details` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reply_number` int(2) NOT NULL,
  `mail_count` int(2) NOT NULL DEFAULT '0',
  `dispatch_status` char(1) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Unread / Read / Error',
  `created_on` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`transaction_id`,`client_id`,`user_id`,`list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='This table will hold all transaction information for said us';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prefecture_master`
--

CREATE TABLE IF NOT EXISTS `tbl_prefecture_master` (
  `prefecture_id` int(2) NOT NULL COMMENT 'unique identification for prefecture',
  `prefecture_name` varchar(50) NOT NULL COMMENT 'Name of prefecture',
  PRIMARY KEY (`prefecture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='List of Prefectures in Japan';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_master`
--

CREATE TABLE IF NOT EXISTS `tbl_role_master` (
  `role_id` int(1) NOT NULL COMMENT 'Unique ID for Role',
  `role_name` varchar(25) NOT NULL COMMENT '"Name of Role',
  `role_description` varchar(100) NOT NULL COMMENT 'Short description about role and responsibility',
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record updation date',
  `deleted_flag` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='It will hold all possible Roles in Diggy system';

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_master`
--

CREATE TABLE IF NOT EXISTS `tbl_staff_master` (
  `client_id` varchar(20) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `staff_name` varchar(50) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_flag` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`client_id`,`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This will store staff name and email address to identify the';

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_title` varchar(256) NOT NULL,
  `template_html` text NOT NULL,
  `footer_text` text NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Email Template Details' AUTO_INCREMENT=14 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `template_title`, `template_html`, `footer_text`, `published`, `created`, `modified`) VALUES
(11, 'stylish', 'test', 'test', 1, '2014-06-21 17:06:16', '2014-06-21 17:06:27'),
(12, 'sdfsfds', '<h1>sdfsdf sdf</h1><br>sfdfsdfsdfs<br>', 'sdfsdfsd', 1, '2014-06-21 19:29:36', '2014-06-21 19:31:10'),
(13, 'jumbo', 'fgdfgdfgdfg', 'dfgdfgdfgdfgd', 1, '2014-06-22 17:20:45', '2014-06-22 17:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `user_pass` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `user_pass`, `full_name`, `designation`, `company_id`, `contact_email`, `role_id`, `is_admin`, `status`, `created`) VALUES
(2, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Administrator', 'Super Admin', 1, 'admin@mail.com', 1, 1, 1, '0000-00-00 00:00:00'),
(3, 'arun1', '123456', 'arun', 'developer', 1, 'test@company.com', 2, 0, 1, '2014-06-04 08:23:34'),
(4, 'test123', '7855b5d653801bbc991149c8fa47dcddfd95f5f5', 'test', 'jhjh', 1, 'tst@sdjf.com', 2, 0, 0, '2014-06-04 09:13:03'),
(5, 'test2', '7c222fb2927d828af22f592134e8932480637c0d', 'test', 'test', 1, 'test@company.com', 2, 0, 1, '2014-06-12 09:36:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
