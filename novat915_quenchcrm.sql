-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2013 at 10:26 AM
-- Server version: 5.5.28-cll
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `novat915_quenchcrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `audience` int(2) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `important` tinyint(4) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `hits` int(11) NOT NULL,
  `deadline` date NOT NULL COMMENT '发布的截止日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `name`) VALUES
(1, '暂定报名'),
(2, '尚不报名'),
(3, '未联系上'),
(4, '转为明年'),
(5, '确认不报名');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE IF NOT EXISTS `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '申请人ID',
  `enquiry_id` int(11) NOT NULL DEFAULT '0',
  `slep` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'SLEP是否通过',
  `application_data` tinyint(4) NOT NULL DEFAULT '0' COMMENT '申请材料是否完备',
  `project_data` tinyint(4) NOT NULL COMMENT '安置资料是否完备',
  `visa_data` tinyint(4) DEFAULT '0' COMMENT '签证资料是否完备',
  `orgnization_id` int(11) DEFAULT NULL COMMENT '境外机构',
  `visa_signed_date` date DEFAULT NULL COMMENT '签证日期',
  `visa_status` int(11) NOT NULL DEFAULT '1' COMMENT '签证状态',
  `job_status` int(11) NOT NULL DEFAULT '1' COMMENT '工作岗位状态',
  `departure_date` date DEFAULT NULL COMMENT '出发日期',
  `comments` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '运营备注',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL COMMENT '所属工作组',
  `project_id` int(11) NOT NULL DEFAULT '0' COMMENT '申请项目',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `source_id` int(11) NOT NULL DEFAULT '0' COMMENT '学生来源',
  `status` int(2) NOT NULL COMMENT '申请人当前状态',
  `father_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '父亲姓名',
  `father_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '父亲手机',
  `father_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '父亲单位',
  `mother_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '母亲姓名',
  `mother_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '母亲手机',
  `mother_company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '母亲单位',
  `emergency_contact` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人',
  `emergency_relation` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人关系',
  `emergency_speak_en` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人是否讲英语',
  `emergency_mobile` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人电话',
  `address` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '紧急联系人地址',
  `phase_id` int(11) NOT NULL DEFAULT '2' COMMENT '当前阶段',
  `return_status_id` int(11) unsigned DEFAULT NULL COMMENT '归国状态',
  `return_date` datetime DEFAULT NULL COMMENT '归国日期',
  `project_status_id` int(11) unsigned DEFAULT NULL COMMENT '项目进行状态',
  `job_offer_upload_oversea_status` int(4) unsigned DEFAULT '0' COMMENT '安置材料已上传外方',
  `usa_informed` tinyint(4) DEFAULT '0' COMMENT '行程是否提交外方',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `enquiry_id`, `slep`, `application_data`, `project_data`, `visa_data`, `orgnization_id`, `visa_signed_date`, `visa_status`, `job_status`, `departure_date`, `comments`, `created`, `modified`, `user_id`, `group_id`, `project_id`, `task_id`, `source_id`, `status`, `father_name`, `father_mobile`, `father_company`, `mother_name`, `mother_mobile`, `mother_company`, `emergency_contact`, `emergency_relation`, `emergency_speak_en`, `emergency_mobile`, `address`, `phase_id`, `return_status_id`, `return_date`, `project_status_id`, `job_offer_upload_oversea_status`, `usa_informed`) VALUES
(1, 1, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, NULL, '2012-09-21', '2012-09-21', 26, 23, 2, 36, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0, 0),
(2, 2, 0, 2, 0, 0, 4, NULL, 1, 2, NULL, '', '2012-09-21', '2012-09-27', 26, 23, 2, 36, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 0, 0),
(3, 3, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, NULL, '2012-09-25', '2012-09-25', 23, 24, 1, 35, 3, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0, 0),
(4, 8, 0, 2, 0, 1, 4, NULL, 2, 2, NULL, '', '2012-09-27', '2012-09-27', 26, 23, 2, 35, 2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, 1, 1),
(5, 22, 0, 0, 0, 0, NULL, NULL, 1, 1, NULL, NULL, '2012-10-09', '2012-10-17', 30, 25, 1, 34, 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_files`
--

CREATE TABLE IF NOT EXISTS `applicant_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phase_id` int(11) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `latest_comments` text COLLATE utf8_unicode_ci COMMENT '最后一次对这个文件的说明',
  `download_file_id` int(11) NOT NULL,
  `is_readed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否老师看过了',
  `is_passed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '审核结果，默认不通过',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_file_types`
--

CREATE TABLE IF NOT EXISTS `applicant_file_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_itinerary`
--

CREATE TABLE IF NOT EXISTS `applicant_itinerary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `depart_datetime` datetime DEFAULT NULL COMMENT '从中国出发日期',
  `arrive_datetime` datetime DEFAULT NULL COMMENT '到达美国时间',
  `arrive_city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '到达美国的第一个城市',
  `air_company_go` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程航空公司',
  `air_code_go` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程航班号',
  `how_to_meet` text COLLATE utf8_unicode_ci COMMENT '到达雇主处的方式',
  `is_pick_up` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '雇主是否来接，如不来接是否提供指示',
  `depart_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '从中国起飞的城市',
  `return_depart_datetime` datetime DEFAULT NULL COMMENT '回程出发日期',
  `return_air_company` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程航空公司',
  `return_depart_city` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程出发城市',
  `return_arrive_date` datetime DEFAULT NULL COMMENT '回程到达日期',
  `return_arrive_city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程抵达城市',
  `air_code_return` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程航班号',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `air_port_pick_status` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否接机',
  `depart_datetime2` datetime DEFAULT NULL COMMENT '去程第二段出发时间',
  `arrive_datetime2` datetime DEFAULT NULL COMMENT '去程第二段到达时间',
  `depart_city2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程第二段出发城市',
  `arrive_city2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程第二段到达城市',
  `air_company2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程第二段航空公司',
  `air_code2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程第二段航班号',
  `depart_datetime3` datetime DEFAULT NULL COMMENT '去程最终抵达出发时间',
  `arrive_datetime3` datetime DEFAULT NULL COMMENT '去程最终抵达到达时间',
  `depart_city3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程最终抵达出发城市',
  `arrive_city3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程最终抵达到达城市',
  `air_company3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程最终抵达航空公司',
  `air_code3` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '去程最终抵达航班号',
  `return_depart_datetime2` datetime DEFAULT NULL COMMENT '回程第二段出发时间',
  `return_arrive_date2` datetime DEFAULT NULL COMMENT '回程第二段到达时间',
  `return_depart_city2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程第二段出发城市',
  `return_arrive_city2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程第二段到达城市',
  `return_air_company2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程第二段航空公司',
  `air_code_return2` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程第二段航班号',
  `return_depart_datetime3` datetime DEFAULT NULL COMMENT '回程最终抵达出发时间',
  `return_arrive_date3` datetime DEFAULT NULL COMMENT '回程最终抵达到达时间',
  `return_depart_city3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程最终抵达出发城市',
  `return_arrive_city3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程最终抵达到达城市',
  `return_air_company3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程最终抵达航空公司',
  `air_code_return3` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '回程最终抵达航班号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `applicant_jobs`
--

CREATE TABLE IF NOT EXISTS `applicant_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `job_title` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '工作职位',
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '雇主单位名称',
  `employer_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '雇主地址',
  `state_id` int(11) DEFAULT NULL,
  `city_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `street_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `employer_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '雇主姓名',
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '雇主电话',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '雇主邮件',
  `offer_file_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `working_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '工作内容',
  `provide_accom` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否提供住宿',
  `start_from` date DEFAULT NULL COMMENT '开始工作日期',
  `end_by` date DEFAULT NULL COMMENT '工作结束日期',
  `interview` tinyint(4) NOT NULL DEFAULT '0' COMMENT '参加JOBFAIR/雇主面试/自主申请',
  `hf_family_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿家庭名称',
  `family_city_name` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿家庭城市',
  `family_address` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿家庭地址',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `hf_issue_date` date DEFAULT NULL COMMENT 'HF下发日期',
  `hf_status` int(5) DEFAULT NULL COMMENT 'HF状态',
  `jf_issue_date` date DEFAULT NULL COMMENT 'JF下发日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `applicant_jobs`
--

INSERT INTO `applicant_jobs` (`id`, `applicant_id`, `group_id`, `job_title`, `company_name`, `employer_address`, `state_id`, `city_name`, `street_name`, `employer_name`, `phone`, `email`, `offer_file_name`, `working_content`, `provide_accom`, `start_from`, `end_by`, `interview`, `hf_family_name`, `family_city_name`, `family_address`, `created`, `modified`, `hf_issue_date`, `hf_status`, `jf_issue_date`) VALUES
(1, 4, 0, 'assistant', 'LITTLE SPROUTS', NULL, 1, '', '', '', '', '', NULL, '', 0, '2013-07-16', '2013-08-10', 0, 'mark', '', '', '2012-09-27', '2012-09-27', '2013-06-01', 1, '2013-06-01'),
(2, 2, 23, 'assistant', 'little sprouts', NULL, 1, 'boston', '', '', '', '', NULL, '', 0, '2013-01-01', '2013-01-01', 1, '', '', '', '2012-09-27', '2012-09-27', '2013-01-01', 1, '2013-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_visas`
--

CREATE TABLE IF NOT EXISTS `applicant_visas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` int(11) NOT NULL,
  `visa_traing_date` date DEFAULT NULL COMMENT '签培日期',
  `training_method_id` int(11) DEFAULT NULL COMMENT '签培方式',
  `visa_appointment_date` date DEFAULT NULL COMMENT '签证日期',
  `embassy_id` int(11) DEFAULT NULL COMMENT '签证领馆',
  `embassy_address` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '签证地址',
  `last_training_date` date DEFAULT NULL COMMENT '行前培训日期',
  `last_training_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '行前培训地址',
  `departure_date` date DEFAULT NULL COMMENT '赴美时间',
  `return_date` date DEFAULT NULL COMMENT '回国日期',
  `itinery_file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `group_id` int(11) NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `is_passport_ok` tinyint(4) DEFAULT NULL COMMENT '护照',
  `visa_fee_billing` tinyint(4) DEFAULT NULL COMMENT '签证费缴费单',
  `is_photo_ok` tinyint(4) DEFAULT NULL COMMENT '签证照',
  `is_application_form_ok` tinyint(4) DEFAULT NULL COMMENT '签证申请表',
  `is_father_income_ok` tinyint(4) DEFAULT NULL COMMENT '父亲收入证明',
  `is_mother_income_ok` tinyint(4) DEFAULT NULL COMMENT '母亲收入证明',
  `is_bank_deposit1_ok` tinyint(4) DEFAULT NULL COMMENT '银行存款1',
  `is_bank_deposit2_ok` tinyint(4) DEFAULT NULL COMMENT '银行存款2',
  `others` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '其它',
  `sevis` tinyint(4) DEFAULT '0' COMMENT 'SEVIS费用',
  `ds2019` tinyint(4) DEFAULT '0' COMMENT 'DS2019',
  `form160` tinyint(4) DEFAULT '0' COMMENT '160表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `apply_fee_status`
--

CREATE TABLE IF NOT EXISTS `apply_fee_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='代表学生报名费的缴费状态的表格' AUTO_INCREMENT=7 ;

--
-- Dumping data for table `apply_fee_status`
--

INSERT INTO `apply_fee_status` (`id`, `name`) VALUES
(1, '等待提交报名费'),
(2, '已缴报名费'),
(3, '退出未缴款'),
(4, '退出等待退款'),
(5, '退出已退款'),
(6, '其它');

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `channels`
--

INSERT INTO `channels` (`id`, `name`) VALUES
(1, '宣讲会'),
(2, '自主报名');

-- --------------------------------------------------------

--
-- Table structure for table `checkins`
--

CREATE TABLE IF NOT EXISTS `checkins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(10) unsigned NOT NULL,
  `is_job_location_changed` tinyint(4) NOT NULL DEFAULT '0',
  `new_job_location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_description` text COLLATE utf8_unicode_ci,
  `is_accom_changed` tinyint(4) NOT NULL DEFAULT '0',
  `new_accom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `accom_cond_changed` tinyint(4) NOT NULL DEFAULT '0',
  `new_accom_cond` text COLLATE utf8_unicode_ci,
  `living_notes` text COLLATE utf8_unicode_ci COMMENT '生活方面有何问题',
  `job_notes` text COLLATE utf8_unicode_ci COMMENT '工作方面有何问题',
  `is_social` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否参加文化交流活动',
  `social_desc_1` text COLLATE utf8_unicode_ci COMMENT '文化交流活动1',
  `social_desc_2` text COLLATE utf8_unicode_ci COMMENT '文化交流活动2',
  `comments` text COLLATE utf8_unicode_ci COMMENT '对项目有何感受或建议',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `is_updated_by_student` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否更新',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否通过',
  `teacher_notes` text COLLATE utf8_unicode_ci COMMENT '老师留言',
  PRIMARY KEY (`id`),
  KEY `enquiry_id` (`enquiry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `checkins`
--

INSERT INTO `checkins` (`id`, `enquiry_id`, `is_job_location_changed`, `new_job_location`, `job_description`, `is_accom_changed`, `new_accom`, `accom_cond_changed`, `new_accom_cond`, `living_notes`, `job_notes`, `is_social`, `social_desc_1`, `social_desc_2`, `comments`, `created`, `modified`, `is_updated_by_student`, `status`, `teacher_notes`) VALUES
(1, 8, 0, '新工作地址：', '', 0, '新住宿地址：', 0, '新住宿条件：', '', '', 0, '', '', '', '2012-09-28', '2012-09-28', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checkin_photos`
--

CREATE TABLE IF NOT EXISTS `checkin_photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` int(10) unsigned NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE IF NOT EXISTS `client_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`id`, `name`) VALUES
(1, '新客户'),
(2, '老客户');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `department` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `manager` varchar(40) COLLATE utf8_unicode_ci DEFAULT '',
  `mobile` varchar(11) COLLATE utf8_unicode_ci DEFAULT '',
  `office` varchar(12) COLLATE utf8_unicode_ci DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `fax` varchar(12) COLLATE utf8_unicode_ci DEFAULT '',
  `user_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `customer_id`, `department`, `manager`, `mobile`, `office`, `email`, `fax`, `user_id`, `created`, `modified`, `available`) VALUES
(4, '张辽', 3, '武装部', '曹操', '13901234567', '022-12345678', 'zhangliao@test.com', '022-87654321', 15, 1341923356, 1341923356, 1),
(5, '郭嘉', 3, '参谋部', '曹操', '13001234567', '022－23456789', 'guojia@test.com', '022-98765432', 15, 1341923498, 1341923498, 1),
(6, '貂蝉', 4, '后勤部', '吕布', '13907654321', '033－34567890', 'diaochan@test.com', '033-09876543', 15, 1341923920, 1341923920, 1),
(7, '陈登', 4, '参谋部', '吕布', '13003456789', '033－34567890', 'chendeng@test.com', '033-09876543', 15, 1341923988, 1341923988, 1),
(8, '卢群群', 5, '团委', '郝亮', '13646424065', '', '', '', 22, 1344570133, 1344570133, 1),
(9, '虚拟联系人', 6, '虚拟部门', '虚拟领导', '13901234567', '88888888', 'yw@test.com', '99999999', 21, 1344937230, 1344937230, 1),
(10, '周老师', 7, '团委', '李老师', '15001216227', '', '', '', 21, 1345428502, 1345428502, 1),
(11, '赵子健', 16, '国际处', '徐玲玲', '13827659076', '010-61778923', 'zhaozijian@sina.com', '010-62778965', 21, 1348418090, 1348418142, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_status`
--

CREATE TABLE IF NOT EXISTS `contract_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='学生的协议当前的状态' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `contract_status`
--

INSERT INTO `contract_status` (`id`, `name`) VALUES
(1, '等待中'),
(2, '已签协议'),
(3, '退出');

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients`
--

CREATE TABLE IF NOT EXISTS `crm_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients`
--

INSERT INTO `crm_clients` (`id`, `contact_id`, `group_id`, `user_id`, `created`) VALUES
(1, 1, 0, 35, '2013-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_accoutings`
--

CREATE TABLE IF NOT EXISTS `crm_clients_accoutings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL COMMENT 'First name',
  `middle_name` varchar(20) DEFAULT NULL COMMENT 'Middle name',
  `last_name` varchar(20) DEFAULT NULL COMMENT 'Last name',
  `address1` varchar(50) DEFAULT NULL COMMENT 'Address1',
  `address2` varchar(50) DEFAULT NULL COMMENT 'Address2',
  `city` varchar(20) DEFAULT NULL COMMENT 'City',
  `state_id` int(11) DEFAULT NULL COMMENT 'State',
  `postcode` varchar(5) DEFAULT NULL COMMENT 'Postcode',
  `phone` varchar(10) DEFAULT NULL COMMENT 'Phone',
  `mobile` varchar(15) DEFAULT NULL COMMENT 'Mobile',
  `comments` text COMMENT 'Comments',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_accoutings`
--

INSERT INTO `crm_clients_accoutings` (`id`, `client_id`, `first_name`, `middle_name`, `last_name`, `address1`, `address2`, `city`, `state_id`, `postcode`, `phone`, `mobile`, `comments`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_other`
--

CREATE TABLE IF NOT EXISTS `crm_clients_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `rate` float DEFAULT '0' COMMENT 'Monthly Rate',
  `service1` varchar(100) DEFAULT NULL COMMENT 'Service 1',
  `service2` varchar(100) DEFAULT NULL COMMENT 'Service 2',
  `service3` varchar(100) DEFAULT NULL COMMENT 'Service 3',
  `service4` varchar(100) DEFAULT NULL COMMENT 'Service 4',
  `service5` varchar(100) DEFAULT NULL COMMENT 'Service 5',
  `description` text COMMENT 'Description',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_other`
--

INSERT INTO `crm_clients_other` (`id`, `client_id`, `rate`, `service1`, `service2`, `service3`, `service4`, `service5`, `description`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_sem`
--

CREATE TABLE IF NOT EXISTS `crm_clients_sem` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `rate` float DEFAULT '0' COMMENT 'Monthly Rate',
  `service1` varchar(100) DEFAULT NULL COMMENT 'Service 1',
  `service2` varchar(100) DEFAULT NULL COMMENT 'Service 2',
  `service3` varchar(100) DEFAULT NULL COMMENT 'Service 3',
  `service4` varchar(100) DEFAULT NULL COMMENT 'Service 4',
  `service5` varchar(100) DEFAULT NULL COMMENT 'Service 5',
  `google` text COMMENT 'Google Analystics',
  `description` text COMMENT 'Description',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_sem`
--

INSERT INTO `crm_clients_sem` (`id`, `client_id`, `rate`, `service1`, `service2`, `service3`, `service4`, `service5`, `google`, `description`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_seo`
--

CREATE TABLE IF NOT EXISTS `crm_clients_seo` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `keywords` varchar(255) NOT NULL COMMENT 'Keywords',
  `rate` float NOT NULL DEFAULT '0' COMMENT 'Monthly Fee',
  `meta_tags` text COMMENT 'Meta Tags',
  `meta_description` text COMMENT 'Meta Description',
  `meta_title` text COMMENT 'Meta Title',
  `google` text COMMENT 'Google Analystics',
  `service1` varchar(100) DEFAULT NULL COMMENT 'Service 1',
  `service2` varchar(100) DEFAULT NULL COMMENT 'Service 2',
  `service3` varchar(100) DEFAULT NULL COMMENT 'Service 3',
  `service4` varchar(100) DEFAULT NULL COMMENT 'Service 4',
  `service5` varchar(100) DEFAULT NULL COMMENT 'Service 5',
  `description` text COMMENT 'Description',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_seo`
--

INSERT INTO `crm_clients_seo` (`id`, `client_id`, `keywords`, `rate`, `meta_tags`, `meta_description`, `meta_title`, `google`, `service1`, `service2`, `service3`, `service4`, `service5`, `description`, `created`, `modified`) VALUES
(1, 1, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-02-20', '2013-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_socials`
--

CREATE TABLE IF NOT EXISTS `crm_clients_socials` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `rate` float DEFAULT '0' COMMENT 'Monthly Fee',
  `facebook` varchar(255) DEFAULT NULL COMMENT 'Facebook',
  `twitter` varchar(255) DEFAULT NULL COMMENT 'Twitter',
  `linked_in` varchar(255) DEFAULT NULL COMMENT 'LinkedIn',
  `rss` varchar(255) DEFAULT NULL COMMENT 'RSS',
  `tumblr` varchar(255) DEFAULT NULL COMMENT 'Tumblr',
  `service1` varchar(100) DEFAULT NULL COMMENT 'Service 1',
  `service2` varchar(100) DEFAULT NULL COMMENT 'Service 2',
  `service3` varchar(100) DEFAULT NULL COMMENT 'Service 3',
  `service4` varchar(100) DEFAULT NULL COMMENT 'Service 4',
  `service5` varchar(100) DEFAULT NULL COMMENT 'Service 5',
  `comments` text COMMENT 'Comments',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_socials`
--

INSERT INTO `crm_clients_socials` (`id`, `client_id`, `rate`, `facebook`, `twitter`, `linked_in`, `rss`, `tumblr`, `service1`, `service2`, `service3`, `service4`, `service5`, `comments`, `created`, `modified`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-02-20', '2013-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `crm_clients_web_hostings`
--

CREATE TABLE IF NOT EXISTS `crm_clients_web_hostings` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `client_id` int(11) NOT NULL,
  `rate` int(11) DEFAULT '0' COMMENT 'Monthly Fee',
  `domain_name` varchar(100) DEFAULT NULL COMMENT 'Domain Name',
  `domain_login_user_name` varchar(50) DEFAULT NULL COMMENT 'Domain Login Name',
  `domain_login_pwd` varchar(50) DEFAULT NULL COMMENT 'Domain Login Password',
  `cpanel_info` text COMMENT 'cPanel info',
  `clients_list` text COMMENT 'Clients List',
  `client_other_info` text COMMENT 'Client Other Info',
  `root_folder` varchar(100) DEFAULT NULL COMMENT 'Root Folder name',
  `created` date NOT NULL,
  `contract_sign_date` varchar(20) DEFAULT NULL COMMENT 'Contract Sign Date',
  `expire_date` varchar(20) DEFAULT NULL COMMENT 'Expired Date',
  `cms_name` varchar(20) DEFAULT NULL COMMENT 'CMS Name',
  `service1` varchar(100) DEFAULT NULL COMMENT 'Service 1',
  `service2` varchar(100) DEFAULT NULL COMMENT 'Service 2',
  `service3` varchar(100) DEFAULT NULL COMMENT 'Service 3',
  `service4` varchar(100) DEFAULT NULL COMMENT 'Service 4',
  `service5` varchar(100) DEFAULT NULL COMMENT 'Service 5',
  `comments` text COMMENT 'Comments',
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `crm_clients_web_hostings`
--

INSERT INTO `crm_clients_web_hostings` (`id`, `client_id`, `rate`, `domain_name`, `domain_login_user_name`, `domain_login_pwd`, `cpanel_info`, `clients_list`, `client_other_info`, `root_folder`, `created`, `contract_sign_date`, `expire_date`, `cms_name`, `service1`, `service2`, `service3`, `service4`, `service5`, `comments`) VALUES
(1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2013-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crm_contacts`
--

CREATE TABLE IF NOT EXISTS `crm_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique ID',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0' COMMENT 'Sales Name',
  `tags` varchar(50) DEFAULT NULL COMMENT 'Tags',
  `gender` varchar(4) NOT NULL DEFAULT '' COMMENT 'Title',
  `type_id` varchar(20) NOT NULL DEFAULT '' COMMENT 'Type',
  `lead_id` int(11) DEFAULT '1' COMMENT 'Lead Type',
  `company` varchar(100) NOT NULL DEFAULT '' COMMENT 'Company',
  `first_name` varchar(20) NOT NULL DEFAULT '' COMMENT 'First Name',
  `middle_name` varchar(20) NOT NULL DEFAULT '' COMMENT 'Middle Name',
  `last_name` varchar(20) NOT NULL DEFAULT '' COMMENT 'Last Name',
  `address1` varchar(50) DEFAULT NULL COMMENT 'Address 1',
  `address2` varchar(50) DEFAULT NULL COMMENT 'Address 2',
  `city` varchar(20) DEFAULT 'Melbourne' COMMENT 'City',
  `state` varchar(10) DEFAULT NULL COMMENT 'State',
  `zip` varchar(6) DEFAULT NULL COMMENT 'Postcode',
  `country` varchar(20) DEFAULT 'Australia' COMMENT 'Country',
  `idstatus` varchar(30) DEFAULT NULL COMMENT 'ID Status',
  `phone` varchar(15) DEFAULT NULL COMMENT 'Phone',
  `business_phone` varchar(15) DEFAULT NULL COMMENT 'Business phone',
  `home_phone` varchar(15) DEFAULT NULL COMMENT 'Home phone',
  `fax` varchar(15) DEFAULT NULL COMMENT 'Fax',
  `mobile` varchar(15) DEFAULT NULL COMMENT 'Mobile',
  `email` varchar(200) DEFAULT NULL COMMENT 'Email',
  `title` varchar(20) DEFAULT NULL COMMENT 'Job Title',
  `url` varchar(50) DEFAULT NULL COMMENT 'URL',
  `comments` text COMMENT 'Comments',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `crm_contacts`
--

INSERT INTO `crm_contacts` (`id`, `category_id`, `created_by`, `tags`, `gender`, `type_id`, `lead_id`, `company`, `first_name`, `middle_name`, `last_name`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `idstatus`, `phone`, `business_phone`, `home_phone`, `fax`, `mobile`, `email`, `title`, `url`, `comments`, `status`, `created`, `modified`) VALUES
(1, 0, 35, '', '', '2', 2, 'Daronet Australia', 'Effi', '', 'Shwintarsky', '', '', '', '52', '', '', '', '0411817777', '', '', '', '0411817777', 'effi@daronet.com.au', '', '', '', 2, '2013-02-20', '2013-02-20'),
(2, 0, 35, '', '', '2', 1, 'Anz ashburton ', 'Steve', '', 'Higgins', '', '', '', '52', '', '', '', '38854022', '', '', '', '', 'steve.higgins@anz.com', '', '', 'i spoke with him few times he told me in jan/13 i  should try agein in jully/13 ', 1, '2013-02-21', '2013-02-21'),
(3, 0, 35, '', '', '2', 2, 'pact group ', 'fluer /sue', '', '', '', '', '', '52', '', '', '', '88254106', '', '', '', '', 'sue.parker@pactgroup.com.au', '', '', 'i spoke to sue she is the ceo,the owner is jewish i spoke to him once ehe told sue to look after me, need to talk to fluer she looks after the water. spoke to her in feb/13 she told me on contract with never fail till june/13 so i will call herin m may /13 to come down and talk about owr prices. ', 1, '2013-02-21', '2013-02-21'),
(4, 0, 35, '', '', '2', 2, 'hitex confectionery ', 'sam briskin', '', '', '', '', '', '52', '', '', '', '95800447', '95802500', '', '', '', 'sbriskin@hitex.net.au', '', '', 'i pop in jan/30/13  owner in jewish i spoke with the laddy in office have now big wet he sand me a email that have contract till aug/13 so i should come see him in july ', 1, '2013-02-21', '2013-02-21'),
(5, 0, 35, '', '', '1', 1, 'atlas webstar ', 'fiena ', '', '', '', '', '', '52', '', '', '', '95605877', '', '', '', '', 'pincu@quench.com.au', '', '', '', 1, '2013-02-21', '2013-02-21'),
(6, 0, 35, '', '', '1', 2, 'Print Centre ', 'brian', '', '', '', '', '', '52', '', '', '', '96462533', '', '', '', '', 'brian@theprintcentre.com.au', '', '', '', 1, '2013-02-21', '2013-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `crm_timesheets`
--

CREATE TABLE IF NOT EXISTS `crm_timesheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `crm_timesheets`
--

INSERT INTO `crm_timesheets` (`id`, `user_id`, `stamp`, `type`) VALUES
(4, 35, '2013-01-30 11:24:05', 'Checkin');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(2) NOT NULL,
  `customerType_id` int(2) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT '未知',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `comments` text COLLATE utf8_unicode_ci,
  `money_return_sum1` int(11) NOT NULL DEFAULT '0',
  `money_return_sum2` int(11) NOT NULL DEFAULT '0',
  `is_shared` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `province_id`, `customerType_id`, `group_id`, `user_id`, `city`, `created`, `modified`, `available`, `comments`, `money_return_sum1`, `money_return_sum2`, `is_shared`) VALUES
(5, '山东科技大学', 11, 1, 24, 22, '青岛', '2012-08-10', '2012-08-10', 1, '重点合作院校', 0, 0, 1),
(7, '武汉理工大学', 21, 2, 23, 21, '武汉市', '2012-08-20', '2012-08-20', 1, '已合作两年', 0, 0, 1),
(8, '山东财经大学', 11, 1, 24, 22, '济南', '2012-09-03', '2012-09-03', 1, '', 2500, 0, 1),
(9, '天津对外经济贸易职业技术学院', 7, 1, 24, 22, '天津', '2012-09-03', '2012-09-03', 1, '', 3000, 0, 1),
(10, '北京工业大学', 1, 1, 23, 21, '北京', '2012-09-04', '2012-09-04', 1, '', 1000, 0, 1),
(12, '武汉理工大学', 21, 2, 23, 21, '湖北', '2012-09-04', '2012-09-04', 1, '', 1200, 0, 1),
(14, '湖北大学', 21, 1, 23, 21, '武汉', '2012-09-05', '2012-09-05', 1, '', 1000, 0, 1),
(15, '中央财经大学', 1, 1, 23, 21, '北京', '2012-09-05', '2012-09-05', 1, '无', 500, 0, 1),
(16, '华北电力大学', 1, 1, 24, 21, '北京昌平区', '2012-09-23', '2012-09-23', 1, '已合作swt、step', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE IF NOT EXISTS `customer_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `customer_types`
--

INSERT INTO `customer_types` (`id`, `name`) VALUES
(1, 'Cold Lead'),
(2, 'Hot Lead'),
(3, 'Referral'),
(4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'HQ'),
(2, 'Sales Department'),
(3, 'Project Management'),
(4, 'Developer Department'),
(5, 'Content Editing');

-- --------------------------------------------------------

--
-- Table structure for table `download_files`
--

CREATE TABLE IF NOT EXISTS `download_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mimeType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT '1',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `embassys`
--

CREATE TABLE IF NOT EXISTS `embassys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='签证使馆' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `embassys`
--

INSERT INTO `embassys` (`id`, `name`) VALUES
(1, '秀水东路'),
(2, '安家楼'),
(3, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '报名者ID',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '姓名',
  `customer_id` int(10) unsigned DEFAULT NULL COMMENT '客户',
  `money_return_sum` int(11) DEFAULT '0' COMMENT '返点金额',
  `school` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '学校',
  `grade` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '毕业年',
  `major` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '专业',
  `mobile` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '手机',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '邮件',
  `source_id` int(11) NOT NULL COMMENT '报名渠道',
  `presentation_id` int(11) DEFAULT NULL COMMENT '报名途径',
  `comments` text COLLATE utf8_unicode_ci COMMENT '销售备注',
  `created` date NOT NULL COMMENT '填表日期',
  `modified` date NOT NULL COMMENT '最后更新',
  `is_viewed_by_operation` tinyint(4) NOT NULL DEFAULT '0',
  `gender` tinyint(4) DEFAULT '0' COMMENT '性别',
  `status` int(11) NOT NULL COMMENT '报名者状态',
  `group_id` int(11) NOT NULL COMMENT '工作组',
  `project_id` int(11) NOT NULL COMMENT '报名项目',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `exam_date` date NOT NULL COMMENT 'SLEP考试日期',
  `slep_scores` int(3) NOT NULL DEFAULT '0' COMMENT 'SLEP考试成绩',
  `is_app_form_submit` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否提交报名表',
  `is_feedback` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否回访',
  `is_applicant` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否有效销售',
  `intention_oversea` tinyint(4) NOT NULL DEFAULT '0' COMMENT '留学意向',
  `intention_internship` tinyint(4) NOT NULL DEFAULT '0' COMMENT '国内实习意向',
  `others_interesting` text COLLATE utf8_unicode_ci COMMENT '还希望了解哪些',
  `how_to_konw_youthedu` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL DEFAULT '0' COMMENT '省份',
  `city_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '城市',
  `identification` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '身份证',
  `apply_fee` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '报名费',
  `apply_fee_receipt` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '报名费收据',
  `apply_fee_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '报名费备注',
  `apply_fee_type` int(11) DEFAULT NULL COMMENT '报名费交费方式',
  `apply_fee_received` date DEFAULT NULL COMMENT '报名费交费日期',
  `apply_fee_payer` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '报名费交款人',
  `apply_fee_status_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '代表缴费状态',
  `project_fee` varchar(10) CHARACTER SET utf8 DEFAULT NULL COMMENT '项目费',
  `project_fee_receipt` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '项目费收据',
  `project_fee_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '项目费备注',
  `project_fee_type` int(11) DEFAULT NULL COMMENT '项目费交费方式',
  `project_fee_received` date DEFAULT NULL COMMENT '项目费交费日期',
  `project_fee_payer` varchar(20) CHARACTER SET utf8 DEFAULT NULL COMMENT '项目费交款人',
  `project_fee_status_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '项目费状态',
  `accom_fee` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿费',
  `accom_receipt` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿费收据',
  `accom_fee_type` int(4) DEFAULT NULL COMMENT '住宿费交费方式',
  `accom_received` date DEFAULT NULL COMMENT '住宿费交费日期',
  `accom_period` int(4) DEFAULT NULL COMMENT '住宿期限',
  `accom_fee_payer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿费交款人',
  `accom_comment` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '住宿费备注',
  `accom_fee_status_id` int(2) DEFAULT NULL COMMENT '住宿费状态',
  `project_fee_period` int(2) DEFAULT NULL COMMENT '项目期限',
  `contract_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '项目编号',
  `sign_date` date DEFAULT NULL COMMENT '合同签署日期',
  `contract_status_id` int(11) NOT NULL DEFAULT '1' COMMENT '学生是否签订协议',
  `contract_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '合同备注',
  `cancel_fee` int(11) DEFAULT NULL COMMENT '退款金额',
  `cancel_fee_receipt` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '退款收据编号',
  `cancel_fee_type` int(11) DEFAULT NULL COMMENT '退款方式',
  `cancel_fee_date` date DEFAULT NULL COMMENT '退款日期',
  `cancel_fee_form_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '退款申请书是否签字提交',
  `cancel_fee_reason` text COLLATE utf8_unicode_ci COMMENT '退出原因',
  `user_id` int(11) NOT NULL DEFAULT '-1' COMMENT '被分配运营老师',
  `input_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '谁输入的',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Dumping data for table `enquiries`
--


-- --------------------------------------------------------

--
-- Table structure for table `enquiry_feedbacks`
--

CREATE TABLE IF NOT EXISTS `enquiry_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `reason_id` int(11) NOT NULL,
  `comments` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `operator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `enquiry_feedbacks`
--

INSERT INTO `enquiry_feedbacks` (`id`, `enquiry_id`, `answer_id`, `reason_id`, `comments`, `created`, `modified`, `operator_id`) VALUES
(9, 7, 1, 1, '已回访，该学生确认参加', '2012-07-13', '2012-07-13', 16),
(10, 12, 2, 3, '从签证阶段因故取消', '2012-08-19', '2012-08-02', 16),
(11, 10002, 3, 3, '尝试一个回复', '2012-08-03', '2012-08-03', 16),
(12, 10003, 3, 5, 'fsadfdsa', '2012-08-03', '2012-08-03', 16),
(13, 10004, 2, 4, 'ffffffffff', '2012-08-04', '2012-08-04', 16),
(14, 10005, 1, 1, '', '2012-08-06', '2012-08-06', 16),
(15, 10006, 1, 1, '', '2012-08-06', '2012-08-06', 16),
(16, 10004, 1, 1, '', '2012-08-06', '2012-08-06', 16),
(17, 10013, 2, 4, 'shishi', '2012-08-14', '2012-08-14', 25),
(18, 10023, 1, 1, '', '2012-08-20', '2012-08-20', 23),
(19, 10024, 2, 4, '', '2012-08-20', '2012-08-20', 23),
(20, 10031, 1, 1, '', '2012-08-27', '2012-08-23', 23),
(21, 10034, 1, 1, '', '2012-08-30', '2012-08-30', 23),
(22, 10062, 1, 1, '', '2012-09-05', '2012-09-05', 23),
(23, 10088, 1, 1, '报名', '2012-09-05', '2012-09-05', 26),
(24, 10088, 1, 1, '', '2012-09-06', '2012-09-05', 26),
(25, 18, 1, 1, '', '2012-09-24', '2012-09-24', 26),
(26, 16, 2, 2, '费用太高', '2012-09-24', '2012-09-24', 26),
(27, 16, 1, 1, '决定报名', '2012-09-25', '2012-09-24', 26),
(28, 14, 1, 1, '', '2012-09-24', '2012-09-24', 26),
(29, 12, 1, 1, '', '2012-09-24', '2012-09-24', 26),
(30, 10, 1, 1, '', '2012-09-24', '2012-09-24', 26),
(31, 3, 2, 5, '周二答复', '2012-09-23', '2012-09-25', 23),
(32, 3, 1, 1, '', '2012-09-25', '2012-09-25', 23),
(33, 8, 1, 1, '', '2012-09-27', '2012-09-27', 26),
(34, 5, 1, 1, '', '2012-09-27', '2012-09-27', 26),
(35, 4, 1, 1, '', '2012-09-27', '2012-09-27', 26),
(36, 20, 3, 5, '', '2012-09-29', '2012-09-29', 23),
(37, 22, 2, 4, '', '2012-11-09', '2012-10-09', 30);

-- --------------------------------------------------------

--
-- Table structure for table `fee_types`
--

CREATE TABLE IF NOT EXISTS `fee_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `fee_types`
--

INSERT INTO `fee_types` (`id`, `name`) VALUES
(1, '人民币现金'),
(2, '人民币汇款'),
(3, '美元现金'),
(4, '美元汇款');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `group_leader` int(11) NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_group_users_groups` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `job_status`
--

CREATE TABLE IF NOT EXISTS `job_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_status`
--

INSERT INTO `job_status` (`id`, `name`) VALUES
(1, '待定'),
(2, '已有');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE IF NOT EXISTS `meetings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hold_on` datetime NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sponsor` int(11) NOT NULL,
  `agenda` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `meeting_minutes` int(11) DEFAULT NULL,
  `location` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_minutes`
--

CREATE TABLE IF NOT EXISTS `meeting_minutes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `meeting_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_meeting_minutes_meetings` (`meeting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `meeting_users`
--

CREATE TABLE IF NOT EXISTS `meeting_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hold_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_meeting_users_meetings` (`meeting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `receiver_id`, `content`, `is_read`, `created`, `modified`, `sender_id`) VALUES
(1, 35, 'test', 1, '2013-02-21', '2013-02-21', 35);

-- --------------------------------------------------------

--
-- Table structure for table `money_returns`
--

CREATE TABLE IF NOT EXISTS `money_returns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `sum` float NOT NULL DEFAULT '0' COMMENT '返点金额',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否已经付出',
  `paid_on` date DEFAULT NULL COMMENT '支付日期',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `money_returns`
--

INSERT INTO `money_returns` (`id`, `enquiry_id`, `customer_id`, `sum`, `status`, `paid_on`, `created`, `modified`, `group_id`, `user_id`, `task_id`, `comment`) VALUES
(7, 10032, 6, 500, 0, '2012-10-28', '2012-08-28', '2012-08-28', 14, 21, 22, ''),
(8, 10032, 6, 500, 0, '2012-10-28', '2012-08-28', '2012-08-28', 14, 21, 22, '');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `user_id` int(11) NOT NULL COMMENT 'which user',
  `tag_id` int(11) NOT NULL COMMENT 'the tag',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `on_desktop` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'on desktop always',
  `is_cool` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'important',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `name`, `content`, `user_id`, `tag_id`, `created`, `modified`, `on_desktop`, `is_cool`, `is_deleted`) VALUES
(1, '标题：testt', 'test', 25, 2, '2012-10-08', '2012-10-08', 0, 0, 0),
(2, '标题：报名学生', '10月17号回访', 30, 1, '2012-10-12', '2012-10-12', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orgnizations`
--

CREATE TABLE IF NOT EXISTS `orgnizations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL DEFAULT '1',
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `orgnizations`
--

INSERT INTO `orgnizations` (`id`, `project_id`, `name`) VALUES
(1, 1, 'Spirit'),
(2, 1, 'CCI'),
(3, 1, '自我安置'),
(4, 2, 'CHI');

-- --------------------------------------------------------

--
-- Table structure for table `phases`
--

CREATE TABLE IF NOT EXISTS `phases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `phases`
--

INSERT INTO `phases` (`id`, `name`) VALUES
(1, '报名'),
(2, '申请'),
(3, '安置'),
(4, '签证'),
(5, '行前'),
(6, '赴美'),
(7, '回国'),
(8, '退出'),
(9, '其它');

-- --------------------------------------------------------

--
-- Table structure for table `presentations`
--

CREATE TABLE IF NOT EXISTS `presentations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hold_on` date NOT NULL,
  `customer_id` int(11) NOT NULL COMMENT '哪个学校',
  `speaker` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `manager` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `student_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '互动学生',
  `contact_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dept_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `projects` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channels` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrived_number` int(11) NOT NULL,
  `regist_number` int(11) NOT NULL,
  `exam_date` date NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `comments` text COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `presentations`
--

INSERT INTO `presentations` (`id`, `hold_on`, `customer_id`, `speaker`, `group_id`, `user_id`, `manager`, `student_name`, `contact_name`, `dept_name`, `contact_phone`, `projects`, `channels`, `arrived_number`, `regist_number`, `exam_date`, `summary`, `comments`, `created`, `modified`, `available`, `status`, `name`) VALUES
(4, '2012-07-20', 3, 'test', 9, 15, 'test', 'test', 'test', 'test', 'test', '1,2,', '1,2,3,', 100, 20, '2012-09-01', 'test', 'test', '2012-07-13', '2012-07-13', 1, 1, NULL),
(5, '2012-07-17', 3, 'test', 9, 15, 'test', 'test', 'test', 'test', 'test', '4,5,', '4,5,', 20, 10, '2012-10-14', 'test', 'test', '2012-07-13', '2012-07-13', 1, 1, NULL),
(6, '2012-08-14', 6, 'test', 14, 21, 'test', 'test', 'test', 'test', '9999999', '1,2,', '1,', 100, 20, '2012-09-14', 'testtesttesttesttesttest', 'testtesttesttesttesttest', '2012-08-14', '2012-08-14', 1, 1, '张子平的虚拟宣讲会的主题'),
(8, '2012-09-25', 16, '张梓萍', 24, 21, '张梓萍', '拉拉', '', '', '', '1,2,', '1,', 20, 20, '0000-00-00', '好', '无', '2012-09-23', '2012-09-23', 1, 1, '暑期带薪_张梓萍2012');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) unsigned NOT NULL,
  `is_itinerary_right` tinyint(4) NOT NULL DEFAULT '1',
  `itinerary_notes` text COLLATE utf8_unicode_ci,
  `is_sevis_on` tinyint(4) NOT NULL,
  `sevis_notes` text COLLATE utf8_unicode_ci,
  `is_social_insu_on` tinyint(4) NOT NULL DEFAULT '0',
  `social_insu_notes` text COLLATE utf8_unicode_ci,
  `job_location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '工作地点',
  `job_description` text COLLATE utf8_unicode_ci COMMENT '工作内容',
  `accommodation` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT '住宿地点',
  `accom_conditions` text COLLATE utf8_unicode_ci NOT NULL COMMENT '住宿条件',
  `status` int(3) NOT NULL DEFAULT '0',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `accom_handover` tinyint(4) DEFAULT '0' COMMENT '交接住宿家庭',
  `teacher_notes` text COLLATE utf8_unicode_ci,
  `is_updated_by_student` tinyint(4) NOT NULL DEFAULT '1' COMMENT '标示学生激活信息是否更新',
  PRIMARY KEY (`id`),
  UNIQUE KEY `enquiry_id` (`enquiry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `enquiry_id`, `is_itinerary_right`, `itinerary_notes`, `is_sevis_on`, `sevis_notes`, `is_social_insu_on`, `social_insu_notes`, `job_location`, `job_description`, `accommodation`, `accom_conditions`, `status`, `created`, `modified`, `accom_handover`, `teacher_notes`, `is_updated_by_student`) VALUES
(1, 8, 1, '是', 0, NULL, 0, NULL, 'little SPROUTS', 'ASSISTANT', 'MA', 'GOOD', 1, '2012-09-28', '2012-09-28', 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'Name',
  `client_id` int(11) DEFAULT '0' COMMENT 'Client',
  `user_id` int(11) DEFAULT '0' COMMENT 'Project Manager',
  `comments` text COLLATE utf8_unicode_ci COMMENT 'Project Summary',
  `deadline_date` date DEFAULT NULL COMMENT 'Deadline',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT 'Status',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `client_id`, `user_id`, `comments`, `deadline_date`, `created`, `modified`, `status`) VALUES
(11, 'testproject', NULL, NULL, '', '2013-01-30', '2013-01-30', '2013-01-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_fee_status`
--

CREATE TABLE IF NOT EXISTS `project_fee_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_fee_status`
--

INSERT INTO `project_fee_status` (`id`, `name`) VALUES
(1, '等待缴纳'),
(2, '已缴');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE IF NOT EXISTS `project_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `name`) VALUES
(1, '进行中'),
(2, '正常完成'),
(3, '按程序提前结束'),
(4, '擅自提前结束'),
(5, '逾期不归');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(54, 'NT'),
(53, 'ACT'),
(52, 'WA'),
(51, 'TAS'),
(50, 'SA'),
(49, 'QLD'),
(48, 'NSW'),
(44, 'VIC');

-- --------------------------------------------------------

--
-- Table structure for table `reasons`
--

CREATE TABLE IF NOT EXISTS `reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `reasons`
--

INSERT INTO `reasons` (`id`, `name`) VALUES
(1, '报名'),
(2, '费用太高，不参加'),
(3, '父母不同意'),
(4, '假期另有安排'),
(5, '其他');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE IF NOT EXISTS `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `name`) VALUES
(1, '暂定报名'),
(2, '尚不报名'),
(3, '未联系上'),
(4, '转为明年'),
(5, '转为短期实习');

-- --------------------------------------------------------

--
-- Table structure for table `return_status`
--

CREATE TABLE IF NOT EXISTS `return_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `return_status`
--

INSERT INTO `return_status` (`id`, `name`) VALUES
(1, '等待提交'),
(2, '等待审核'),
(3, '已通过');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Root'),
(2, 'Manager'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `search_urls`
--

CREATE TABLE IF NOT EXISTS `search_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `search_urls`
--

INSERT INTO `search_urls` (`id`, `link`) VALUES
(1, 'enq_fields%5B0%5D=Enquiry.id&enq_fields%5B1%5D=Enquiry.customer_id&enq_fields%5B2%5D=Enquiry.school&enq_fields%5B3%5D=Enquiry.major&enq_fields%5B4%5D=Enquiry.email&app_fields=&app_job_fields=&app_visa_fields=&app_itinerary_fields='),
(2, 'conditions%5BAND%5D%5BApplicant.group_id%5D=14&conditions%5BAND%5D%5B0%5D=Applicant.phase_id%3E1&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.application_data%5D=0&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.application_data&fields%5B2%5D=Phase.name&fields%5B3%5D=Phase.id&fields%5B4%5D=Enquiry.id&fields%5B5%5D=Enquiry.school&fields%5B6%5D=Enquiry.name&fields%5B7%5D=Enquiry.mobile&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Project.id&fields%5B10%5D=Project.name&fields%5B11%5D=Source.id&fields%5B12%5D=Source.name&fields%5B13%5D=Orgnization.name&joins%5B0%5D=ApplicantFile'),
(3, 'conditions%5BAND%5D%5BApplicant.group_id%5D=14&conditions%5BAND%5D%5B0%5D=Applicant.phase_id%3E1&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.application_data%5D=0&conditions%5BAND%5D%5BApplicant.orgnization_id%5D=1&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.application_data&fields%5B2%5D=Phase.name&fields%5B3%5D=Phase.id&fields%5B4%5D=Enquiry.id&fields%5B5%5D=Enquiry.school&fields%5B6%5D=Enquiry.name&fields%5B7%5D=Enquiry.mobile&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Project.id&fields%5B10%5D=Project.name&fields%5B11%5D=Source.id&fields%5B12%5D=Source.name&fields%5B13%5D=Orgnization.name&joins%5B0%5D=ApplicantFile'),
(4, 'conditions%5BAND%5D%5BApplicant.group_id%5D=14&conditions%5BAND%5D%5B0%5D=Applicant.phase_id%3E1&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.application_data%5D=0&conditions%5BAND%5D%5BApplicant.phase_id%5D=4&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.application_data&fields%5B2%5D=Phase.name&fields%5B3%5D=Phase.id&fields%5B4%5D=Enquiry.id&fields%5B5%5D=Enquiry.school&fields%5B6%5D=Enquiry.name&fields%5B7%5D=Enquiry.mobile&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Project.id&fields%5B10%5D=Project.name&fields%5B11%5D=Source.id&fields%5B12%5D=Source.name&fields%5B13%5D=Orgnization.name&joins%5B0%5D=ApplicantFile'),
(5, 'conditions%5BAND%5D%5BApplicant.group_id%5D=14&conditions%5BAND%5D%5B0%5D=Applicant.phase_id%3E1&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.phase_id%5D=3&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.application_data&fields%5B2%5D=Phase.name&fields%5B3%5D=Phase.id&fields%5B4%5D=Enquiry.id&fields%5B5%5D=Enquiry.school&fields%5B6%5D=Enquiry.name&fields%5B7%5D=Enquiry.mobile&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Project.id&fields%5B10%5D=Project.name&fields%5B11%5D=Source.id&fields%5B12%5D=Source.name&fields%5B13%5D=Orgnization.name&joins%5B0%5D=ApplicantFile'),
(6, 'conditions%5BAND%5D%5BApplicant.group_id%5D=16&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.visa_status%5D=2&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.visa_data&fields%5B2%5D=ApplicantVisa.visa_traing_date&fields%5B3%5D=Applicant.phase_id&fields%5B4%5D=ApplicantVisa.visa_appointment_date&fields%5B5%5D=ApplicantVisa.id&fields%5B6%5D=ApplicantVisa.last_training_date&fields%5B7%5D=ApplicantVisa.embassy_address&fields%5B8%5D=ApplicantVisa.embassy_id&fields%5B9%5D=ApplicantVisa.training_method_id&fields%5B10%5D=ApplicantVisa.sevis&fields%5B11%5D=ApplicantVisa.ds2019&fields%5B12%5D=ApplicantVisa.form160&fields%5B13%5D=Enquiry.id&fields%5B14%5D=Enquiry.school&fields%5B15%5D=Enquiry.name&fields%5B16%5D=Enquiry.mobile&fields%5B17%5D=Enquiry.email&fields%5B18%5D=Project.id&fields%5B19%5D=Project.name&fields%5B20%5D=Phase.name&fields%5B21%5D=Phase.id&fields%5B22%5D=Orgnization.name&fields%5B23%5D=VisaStatus.name&fields%5B24%5D=Applicant.visa_status'),
(7, 'conditions%5BAND%5D%5BApplicant.group_id%5D=16&conditions%5BAND%5D%5BApplicant.status%5D=0&conditions%5BAND%5D%5BApplicant.visa_status%5D=1&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.visa_data&fields%5B2%5D=ApplicantVisa.visa_traing_date&fields%5B3%5D=Applicant.phase_id&fields%5B4%5D=ApplicantVisa.visa_appointment_date&fields%5B5%5D=ApplicantVisa.id&fields%5B6%5D=ApplicantVisa.last_training_date&fields%5B7%5D=ApplicantVisa.embassy_address&fields%5B8%5D=ApplicantVisa.embassy_id&fields%5B9%5D=ApplicantVisa.training_method_id&fields%5B10%5D=ApplicantVisa.sevis&fields%5B11%5D=ApplicantVisa.ds2019&fields%5B12%5D=ApplicantVisa.form160&fields%5B13%5D=Enquiry.id&fields%5B14%5D=Enquiry.school&fields%5B15%5D=Enquiry.name&fields%5B16%5D=Enquiry.mobile&fields%5B17%5D=Enquiry.email&fields%5B18%5D=Project.id&fields%5B19%5D=Project.name&fields%5B20%5D=Phase.name&fields%5B21%5D=Phase.id&fields%5B22%5D=Orgnization.name&fields%5B23%5D=VisaStatus.name&fields%5B24%5D=Applicant.visa_status'),
(8, 'enq_fields=&app_fields=&app_job_fields=&app_visa_fields=&app_itinerary_fields%5B0%5D=ApplicantItinerary.depart_datetime&app_itinerary_fields%5B1%5D=ApplicantItinerary.arrive_datetime&app_itinerary_fields%5B2%5D=ApplicantItinerary.arrive_city&app_itinerary_fields%5B3%5D=ApplicantItinerary.air_company_go&app_itinerary_fields%5B4%5D=ApplicantItinerary.air_code_go&app_itinerary_fields%5B5%5D=ApplicantItinerary.how_to_meet&app_itinerary_fields%5B6%5D=ApplicantItinerary.is_pick_up&app_itinerary_fields%5B7%5D=ApplicantItinerary.depart_city&app_itinerary_fields%5B8%5D=ApplicantItinerary.return_depart_datetime&app_itinerary_fields%5B9%5D=ApplicantItinerary.return_air_company&app_itinerary_fields%5B10%5D=ApplicantItinerary.return_depart_city&app_itinerary_fields%5B11%5D=ApplicantItinerary.return_arrive_date&app_itinerary_fields%5B12%5D=ApplicantItinerary.return_arrive_city&app_itinerary_fields%5B13%5D=ApplicantItinerary.air_code_return&app_itinerary_fields%5B14%5D=ApplicantItinerary.air_port_pick_status&app_itinerary_fields%5B15%5D=ApplicantItinerary.depart_datetime2&app_itinerary_fields%5B16%5D=ApplicantItinerary.arrive_datetime2&app_itinerary_fields%5B17%5D=ApplicantItinerary.depart_city2&app_itinerary_fields%5B18%5D=ApplicantItinerary.arrive_city2&app_itinerary_fields%5B19%5D=ApplicantItinerary.air_company2&app_itinerary_fields%5B20%5D=ApplicantItinerary.air_code2&app_itinerary_fields%5B21%5D=ApplicantItinerary.depart_datetime3&app_itinerary_fields%5B22%5D=ApplicantItinerary.arrive_datetime3&app_itinerary_fields%5B23%5D=ApplicantItinerary.depart_city3&app_itinerary_fields%5B24%5D=ApplicantItinerary.arrive_city3&app_itinerary_fields%5B25%5D=ApplicantItinerary.air_company3&app_itinerary_fields%5B26%5D=ApplicantItinerary.air_code3&app_itinerary_fields%5B27%5D=ApplicantItinerary.return_depart_datetime2&app_itinerary_fields%5B28%5D=ApplicantItinerary.return_arrive_date2&app_itinerary_fields%5B29%5D=ApplicantItinerary.return_depart_city2&app_itinerary_fields%5B30%5D=ApplicantItinerary.return_arrive_city2&app_itinerary_fields%5B31%5D=ApplicantItinerary.return_air_company2&app_itinerary_fields%5B32%5D=ApplicantItinerary.air_code_return2&app_itinerary_fields%5B33%5D=ApplicantItinerary.return_depart_datetime3&app_itinerary_fields%5B34%5D=ApplicantItinerary.return_arrive_date3&app_itinerary_fields%5B35%5D=ApplicantItinerary.return_depart_city3&app_itinerary_fields%5B36%5D=ApplicantItinerary.return_arrive_city3&app_itinerary_fields%5B37%5D=ApplicantItinerary.return_air_company3&app_itinerary_fields%5B38%5D=ApplicantItinerary.air_code_return3'),
(9, 'conditions%5BAND%5D%5BEnquiry.group_id%5D=14&conditions%5BAND%5D%5BEnquiry.project_id%5D=1&conditions%5BAND%5D%5BEnquiry.is_applicant%5D=0&conditions%5BAND%5D%5BEnquiry.status%5D=0&conditions%5BAND%5D%5BEnquiry.school%5D=%E5%8C%97%E4%BA%AC%E5%B7%A5%E4%B8%9A%E5%A4%A7%E5%AD%A6&fields%5B0%5D=Enquiry.id&fields%5B1%5D=Enquiry.name&fields%5B2%5D=Enquiry.school&fields%5B3%5D=Enquiry.grade&fields%5B4%5D=Enquiry.major&fields%5B5%5D=Enquiry.email&fields%5B6%5D=Enquiry.mobile&fields%5B7%5D=Enquiry.email&fields%5B8%5D=Enquiry.exam_date&fields%5B9%5D=Enquiry.is_feedback&fields%5B10%5D=Enquiry.slep_scores&fields%5B11%5D=Enquiry.apply_fee_status_id&fields%5B12%5D=Enquiry.accom_fee_status_id&fields%5B13%5D=Enquiry.project_fee_status_id&fields%5B14%5D=Enquiry.apply_fee&fields%5B15%5D=Enquiry.project_fee&fields%5B16%5D=Enquiry.presentation_id&fields%5B17%5D=Enquiry.is_app_form_submit&fields%5B18%5D=Project.name&fields%5B19%5D=Presentation.name&fields%5B20%5D=Presentation.hold_on&fields%5B21%5D=Source.name&fields%5B22%5D=Phase.name&fields%5B23%5D=ApplyFeeStatus.name&fields%5B24%5D=ContractStatus.name&fields%5B25%5D=ProjectFeeStatus.name&joins%5B0%5D%5Btable%5D=applicants&joins%5B0%5D%5Balias%5D=Applicant&joins%5B0%5D%5Btype%5D=LEFT&joins%5B0%5D%5Bconditions%5D%5B0%5D=Enquiry.id%3DApplicant.enquiry_id&joins%5B1%5D%5Btable%5D=phases&joins%5B1%5D%5Balias%5D=Phase&joins%5B1%5D%5Btype%5D=LEFT&joins%5B1%5D%5Bconditions%5D%5B0%5D=Applicant.phase_id%3DPhase.id'),
(10, 'conditions%5BAND%5D%5BEnquiry.group_id%5D=14&conditions%5BAND%5D%5BEnquiry.project_id%5D=1&conditions%5BAND%5D%5BEnquiry.is_applicant%5D=0&conditions%5BAND%5D%5BEnquiry.status%5D=0&conditions%5BAND%5D%5BEnquiry.presentation_id%5D=6&fields%5B0%5D=Enquiry.id&fields%5B1%5D=Enquiry.name&fields%5B2%5D=Enquiry.school&fields%5B3%5D=Enquiry.grade&fields%5B4%5D=Enquiry.major&fields%5B5%5D=Enquiry.email&fields%5B6%5D=Enquiry.mobile&fields%5B7%5D=Enquiry.email&fields%5B8%5D=Enquiry.exam_date&fields%5B9%5D=Enquiry.is_feedback&fields%5B10%5D=Enquiry.slep_scores&fields%5B11%5D=Enquiry.apply_fee_status_id&fields%5B12%5D=Enquiry.accom_fee_status_id&fields%5B13%5D=Enquiry.project_fee_status_id&fields%5B14%5D=Enquiry.apply_fee&fields%5B15%5D=Enquiry.project_fee&fields%5B16%5D=Enquiry.presentation_id&fields%5B17%5D=Enquiry.is_app_form_submit&fields%5B18%5D=Project.name&fields%5B19%5D=Presentation.name&fields%5B20%5D=Presentation.hold_on&fields%5B21%5D=Source.name&fields%5B22%5D=Phase.name&fields%5B23%5D=ApplyFeeStatus.name&fields%5B24%5D=ContractStatus.name&fields%5B25%5D=ProjectFeeStatus.name&joins%5B0%5D%5Btable%5D=applicants&joins%5B0%5D%5Balias%5D=Applicant&joins%5B0%5D%5Btype%5D=LEFT&joins%5B0%5D%5Bconditions%5D%5B0%5D=Enquiry.id%3DApplicant.enquiry_id&joins%5B1%5D%5Btable%5D=phases&joins%5B1%5D%5Balias%5D=Phase&joins%5B1%5D%5Btype%5D=LEFT&joins%5B1%5D%5Bconditions%5D%5B0%5D=Applicant.phase_id%3DPhase.id'),
(11, 'conditions%5BAND%5D%5BEnquiry.group_id%5D=25&conditions%5BAND%5D%5BEnquiry.project_id%5D=1&conditions%5BAND%5D%5BEnquiry.is_applicant%5D=0&conditions%5BAND%5D%5BEnquiry.status%5D=0&conditions%5BAND%5D%5BEnquiry.name+LIKE%5D=%25%E6%9D%A8%E6%B3%A2%25&fields%5B0%5D=Enquiry.id&fields%5B1%5D=Enquiry.name&fields%5B2%5D=Enquiry.school&fields%5B3%5D=Enquiry.grade&fields%5B4%5D=Enquiry.major&fields%5B5%5D=Enquiry.email&fields%5B6%5D=Enquiry.mobile&fields%5B7%5D=Enquiry.project_id&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Enquiry.exam_date&fields%5B10%5D=Enquiry.is_feedback&fields%5B11%5D=Enquiry.slep_scores&fields%5B12%5D=Enquiry.apply_fee_status_id&fields%5B13%5D=Enquiry.accom_fee_status_id&fields%5B14%5D=Enquiry.project_fee_status_id&fields%5B15%5D=Enquiry.apply_fee&fields%5B16%5D=Enquiry.project_fee&fields%5B17%5D=Enquiry.presentation_id&fields%5B18%5D=Enquiry.is_app_form_submit&fields%5B19%5D=Presentation.name&fields%5B20%5D=Presentation.hold_on&fields%5B21%5D=Source.name&fields%5B22%5D=Phase.name&fields%5B23%5D=ApplyFeeStatus.name&fields%5B24%5D=ContractStatus.name&fields%5B25%5D=ProjectFeeStatus.name&joins%5B0%5D%5Btable%5D=applicants&joins%5B0%5D%5Balias%5D=Applicant&joins%5B0%5D%5Btype%5D=LEFT&joins%5B0%5D%5Bconditions%5D%5B0%5D=Enquiry.id%3DApplicant.enquiry_id&joins%5B1%5D%5Btable%5D=phases&joins%5B1%5D%5Balias%5D=Phase&joins%5B1%5D%5Btype%5D=LEFT&joins%5B1%5D%5Bconditions%5D%5B0%5D=Applicant.phase_id%3DPhase.id'),
(12, 'conditions%5BAND%5D%5BEnquiry.group_id%5D=25&conditions%5BAND%5D%5BEnquiry.project_id%5D=1&conditions%5BAND%5D%5BEnquiry.is_applicant%5D=0&conditions%5BAND%5D%5BEnquiry.status%5D=0&conditions%5BAND%5D%5BEnquiry.name+LIKE%5D=%25%E6%9D%A8%E6%B3%A2%25&conditions%5BAND%5D%5BEnquiry.school%5D=%E9%83%91%E5%B7%9E%E5%A4%A7%E5%AD%A6&conditions%5BAND%5D%5BEnquiry.is_app_form_submit%5D=1&fields%5B0%5D=Enquiry.id&fields%5B1%5D=Enquiry.name&fields%5B2%5D=Enquiry.school&fields%5B3%5D=Enquiry.grade&fields%5B4%5D=Enquiry.major&fields%5B5%5D=Enquiry.email&fields%5B6%5D=Enquiry.mobile&fields%5B7%5D=Enquiry.project_id&fields%5B8%5D=Enquiry.email&fields%5B9%5D=Enquiry.exam_date&fields%5B10%5D=Enquiry.is_feedback&fields%5B11%5D=Enquiry.slep_scores&fields%5B12%5D=Enquiry.apply_fee_status_id&fields%5B13%5D=Enquiry.accom_fee_status_id&fields%5B14%5D=Enquiry.project_fee_status_id&fields%5B15%5D=Enquiry.apply_fee&fields%5B16%5D=Enquiry.project_fee&fields%5B17%5D=Enquiry.presentation_id&fields%5B18%5D=Enquiry.is_app_form_submit&fields%5B19%5D=Presentation.name&fields%5B20%5D=Presentation.hold_on&fields%5B21%5D=Source.name&fields%5B22%5D=Phase.name&fields%5B23%5D=ApplyFeeStatus.name&fields%5B24%5D=ContractStatus.name&fields%5B25%5D=ProjectFeeStatus.name&joins%5B0%5D%5Btable%5D=applicants&joins%5B0%5D%5Balias%5D=Applicant&joins%5B0%5D%5Btype%5D=LEFT&joins%5B0%5D%5Bconditions%5D%5B0%5D=Enquiry.id%3DApplicant.enquiry_id&joins%5B1%5D%5Btable%5D=phases&joins%5B1%5D%5Balias%5D=Phase&joins%5B1%5D%5Btype%5D=LEFT&joins%5B1%5D%5Bconditions%5D%5B0%5D=Applicant.phase_id%3DPhase.id'),
(13, 'conditions%5BAND%5D%5BApplicant.group_id%5D=25&conditions%5BAND%5D%5B0%5D=Applicant.phase_id%3E1&conditions%5BAND%5D%5BEnquiry.name+LIKE%5D=%25%E6%9D%A8%E6%B3%A2%25&conditions%5BAND%5D%5BEnquiry.school%5D=%E9%83%91%E5%B7%9E%E5%A4%A7%E5%AD%A6&conditions%5BAND%5D%5BApplicant.phase_id%5D=2&conditions%5BAND%5D%5BApplicant.orgnization_id%5D=1&fields%5B0%5D=Applicant.id&fields%5B1%5D=Applicant.application_data&fields%5B2%5D=Applicant.status&fields%5B3%5D=Phase.name&fields%5B4%5D=Phase.id&fields%5B5%5D=Enquiry.id&fields%5B6%5D=Enquiry.school&fields%5B7%5D=Enquiry.name&fields%5B8%5D=Enquiry.mobile&fields%5B9%5D=Enquiry.email&fields%5B10%5D=Enquiry.contract_id&fields%5B11%5D=Project.id&fields%5B12%5D=Project.name&fields%5B13%5D=Source.id&fields%5B14%5D=Source.name&fields%5B15%5D=Orgnization.name&joins%5B0%5D=ApplicantFile');

-- --------------------------------------------------------

--
-- Table structure for table `sources`
--

CREATE TABLE IF NOT EXISTS `sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sources`
--

INSERT INTO `sources` (`id`, `name`) VALUES
(1, '代理'),
(2, '学校'),
(3, '个人');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '美国的州名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=60 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`) VALUES
(52, 'VIC'),
(53, 'NSW'),
(54, 'TAS'),
(55, 'SA'),
(56, 'WA'),
(57, 'QLD'),
(58, 'ACT'),
(59, 'NT');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `icon`) VALUES
(1, '报名学生相关', 'book.png'),
(2, '申请阶段相关', 'money_2.png'),
(3, '安置阶段相关', 'companies.png'),
(4, '签证阶段相关', 'visa.png'),
(5, '行前阶段相关', 'trolly.png'),
(6, '赴美阶段相关', 'airplane.png'),
(7, '学生回国相关', 'airplane.png'),
(8, '学生回访相关', 'phone.png');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Name',
  `task_type` int(11) DEFAULT '0' COMMENT 'Type',
  `priority` int(11) DEFAULT '0' COMMENT 'Priority',
  `deadline_date` date NOT NULL COMMENT 'Deadline',
  `comments` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Assigned To',
  `status` tinyint(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `texting_templates`
--

CREATE TABLE IF NOT EXISTS `texting_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `texting_templates`
--

INSERT INTO `texting_templates` (`id`, `name`, `content`) VALUES
(1, '参加完宣讲会的通知', '你好！\r\n感谢你参加FESCO优势项目办公室（YES）的暑期带薪宣讲会！\r\n为了使你能够更好的了解北京外企集团及我们的海外交流项目，优势办已将有关项目资料发往你的邮箱，请注意查收。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(2, '通过考试的通知', '你好！\r\n恭喜你通过了SLEP英语考试，详细情况请查看邮箱。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至\r\n'),
(3, '没通过考试的通知', '你好！\r\n很遗憾你没有通过SLEP英语考试，不能够继续参加今年的暑期赴美带薪实习项目。有关退款事宜请查看邮箱。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(4, '提醒缴纳项目费的通知', '你好！\r\n我们尚未收到你缴纳的项目费，为了不影响你在美的岗位匹配，请尽快缴纳项目费，以便我们为你发送岗位匹配所需的资料包，收到资料后我们才能为你匹配岗位。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(5, '提醒提交申请资料的通知', '你好！\r\n你的申请阶段资料还没有完全提交，请登录优势后台，完成申请阶段的资料提交。优势办还需为你们的资料进行审核、修改、美化、提交外方机构，只有准备了完整的资料包才能正式申请岗位。请尽快完成申请阶段的资料。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至\r\n'),
(6, '提交签证资料的通知', '你好！\r\n请按照项目手册上的指导，在后台上上传签证阶段资料。为避免耽误同学们申请签证，请尽快准备资料。提交后一周内请常上优势后台查看新消息。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(7, '提醒提交签证资料的通知', '你好！\r\n你的签证阶段资料还没有完全提交，请登录优势后台，按照项目手册和后台留言上的指导，在后台上上传签证阶段资料。为避免耽误同学们申请签证，请尽快准备资料。并在提交后一周内请常上优势后台查看新消息。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(8, '得到JOB OFFER的通知', '你好！\r\n你的JOBOFFER下来了！请登录优势后台下载，按照项目手册或模板的指导，在24小时内签字扫描上传，如不及时可能造成岗位丢失。如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至\r\n'),
(9, '给签证通过的同学的行前准备通知', '你好！\r\n恭喜你通过了面签，得到了赴美签证！\r\n目前，需要你完成五项工作，详情请查看邮箱和优势后台。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(10, '行前培训的通知1(前期安置并通过签证的同学)', '你好！\r\n优势办行前培训日程已发往你的邮箱，请及时查看。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至'),
(11, '学生正常结束项目回国后的通知', '你好！\r\n恭喜顺利完成暑期赴美带薪实习，欢迎回到祖国！\r\n请在优势后台上登记回国，并上传护照页入境章和雇主评估表，以便优势办向外方确认你的回国信息，并开具实习报告。同时请提交赴美感言和照片，发送至老师的邮箱。优势办会以同学们每次Check-In情况、感言和照片为参考，评选年度优秀学生。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至\r\n'),
(12, '给退款学生的通知', '你好！\r\n由于特殊原因, 你需要退出项目，优势办感到十分遗憾。下面按照协议中的退款流程，为你申请退款。\r\n已将退款申请表发至你的邮箱，请及时查看并填写。\r\n如有任何问题，欢迎咨询免费服务电话：4006-501-801或邮件至\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `training_methods`
--

CREATE TABLE IF NOT EXISTS `training_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='签证培训方式' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `training_methods`
--

INSERT INTO `training_methods` (`id`, `name`) VALUES
(1, '现场'),
(2, 'Skype');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL COMMENT 'Type Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Individual'),
(2, 'Private Owned Company'),
(3, 'Goverment Department'),
(4, 'Network'),
(5, 'SEO'),
(6, 'PPC'),
(7, 'Office Call'),
(8, 'Referral');

-- --------------------------------------------------------

--
-- Table structure for table `useful_urls`
--

CREATE TABLE IF NOT EXISTS `useful_urls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `search_url_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='保存用户的查询的库表' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `useful_urls`
--

INSERT INTO `useful_urls` (`id`, `user_id`, `search_url_id`, `name`) VALUES
(1, 25, 1, '试试保存一下'),
(2, 23, 8, 'ssss');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `available` tinyint(4) NOT NULL DEFAULT '1',
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=39 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `department_id`, `role_id`, `available`, `title`) VALUES
(35, 'Admin', 'admin@quench.com.au', '28de5548e10df1447412b5e38449ff9259092157', 1, 1, 1, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `user_projects`
--

CREATE TABLE IF NOT EXISTS `user_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_projects`
--

INSERT INTO `user_projects` (`id`, `user_id`, `project_id`) VALUES
(5, 23, 1),
(6, 26, 2),
(7, 30, 2),
(8, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `visa_status`
--

CREATE TABLE IF NOT EXISTS `visa_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `visa_status`
--

INSERT INTO `visa_status` (`id`, `name`) VALUES
(1, '未开始申请'),
(2, '通过'),
(3, '等待第二次签证'),
(4, '等待使馆通知'),
(5, '退出');

-- --------------------------------------------------------

--
-- Table structure for table `workinglogs_feedbacks`
--

CREATE TABLE IF NOT EXISTS `workinglogs_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `working_log_id` int(11) NOT NULL,
  `content` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_logs`
--

CREATE TABLE IF NOT EXISTS `working_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Task Title',
  `content` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Content',
  `result` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Result',
  `questions` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'Pending Issues',
  `created` date NOT NULL,
  `modified` date NOT NULL,
  `next_appointment_date` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Next Appointment',
  `important` tinyint(4) NOT NULL DEFAULT '0',
  `status` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `working_logs`
--

INSERT INTO `working_logs` (`id`, `group_id`, `user_id`, `contact_id`, `name`, `content`, `result`, `questions`, `created`, `modified`, `next_appointment_date`, `important`, `status`) VALUES
(1, 0, 35, 1, 'Phone call discation summery', 'the client like to install water filtration ... he ask to call him on monday', '', '', '2013-02-20', '2013-02-20', '', 0, 0),
(2, 0, 35, 4, 'follow up', 'sam', 'i pop in jan/30/13  owner in jewish i spoke with the laddy in office have now big wet he sand me a email that have contract till aug/13 so i should come see him in july ', '', '2013-02-21', '2013-02-21', '07/02/2013', 0, 0),
(3, 0, 35, 5, 'follow up ', '', 'spoke to her in 18/feb she have never fail pay $140 for cooler dont use much water told her we will save up some money and you will sport a local company as well. she told me to  call her back and mar/13', '', '2013-02-21', '2013-02-21', '03/26/2013', 0, 0),
(4, 0, 35, 6, 'URGENT', '', 'need to give a call when he is moving he have never fail toild me will swop over when he is moving iy"h', '', '2013-02-21', '2013-02-21', '03/05/2013', 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crm_clients`
--
ALTER TABLE `crm_clients`
  ADD CONSTRAINT `crm_clients_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `crm_contacts` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_accoutings`
--
ALTER TABLE `crm_clients_accoutings`
  ADD CONSTRAINT `crm_clients_accoutings_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_other`
--
ALTER TABLE `crm_clients_other`
  ADD CONSTRAINT `crm_clients_other_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_sem`
--
ALTER TABLE `crm_clients_sem`
  ADD CONSTRAINT `crm_clients_sem_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_seo`
--
ALTER TABLE `crm_clients_seo`
  ADD CONSTRAINT `crm_clients_seo_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_socials`
--
ALTER TABLE `crm_clients_socials`
  ADD CONSTRAINT `crm_clients_socials_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `crm_clients_web_hostings`
--
ALTER TABLE `crm_clients_web_hostings`
  ADD CONSTRAINT `crm_clients_web_hostings_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `crm_clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `group_users`
--
ALTER TABLE `group_users`
  ADD CONSTRAINT `FK_group_users_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `meeting_minutes`
--
ALTER TABLE `meeting_minutes`
  ADD CONSTRAINT `FK_meeting_minutes_meetings` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `meeting_users`
--
ALTER TABLE `meeting_users`
  ADD CONSTRAINT `FK_meeting_users_meetings` FOREIGN KEY (`meeting_id`) REFERENCES `meetings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
