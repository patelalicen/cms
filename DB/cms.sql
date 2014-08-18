DROP TABLE IF EXISTS `cms_activity`;
CREATE TABLE IF NOT EXISTS `cms_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `title` varchar(255) NOT NULL COMMENT 'Title of activity',
  `activity_type` varchar(100) NOT NULL COMMENT 'Type of activity',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_aliases`
--

DROP TABLE IF EXISTS `cms_aliases`;
CREATE TABLE IF NOT EXISTS `cms_aliases` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `fname` varchar(100) NOT NULL COMMENT 'First name of investigated person',
  `mname` varchar(100) NOT NULL COMMENT 'Middle name of investigated person',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of investigated person',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cms_aliases`
--

INSERT INTO `cms_aliases` (`id`, `pi_id`, `fname`, `mname`, `lname`, `web_url`, `note`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 0, 'Vipul', 'm', 'patel', 'yahoo.com', '', '2014-06-14 22:33:41', 3, '2014-06-15 12:53:04', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 2, 'vip', 'm', 'patel', 'yahoo.com', '', '2014-06-14 22:33:42', 3, '0000-00-00 00:00:00', 0, 'yes', '2014-06-15 12:37:25', 3, 0, 'active'),
(3, 0, 'vvp', 'm', 'patel', 'yahoo.com', '', '2014-06-14 22:33:42', 3, '2014-06-15 12:53:04', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 0, 'new', 'mmm', 'test', 'gmail.com', '', '2014-06-15 12:53:04', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 0, '', '', '', '', '', '2014-06-15 12:56:00', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, 0, '', '', '', '', '', '2014-06-15 13:02:27', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(7, 0, '', '', '', '', '', '2014-06-15 13:03:10', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(8, 2, 'new333', 'mmm', 'test', 'gmail.com', '', '2014-06-15 13:18:31', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(9, 2, 'new555', 'mmm555', 'test555', 'gmail.com555', '', '2014-06-15 14:05:07', 3, '2014-06-15 14:05:58', 3, 'yes', '2014-06-15 14:05:42', 3, 0, 'active'),
(10, 2, 'new666', 'mmm6666', 'test666', 'gmail.com666', '', '2014-06-15 14:05:31', 3, '2014-06-15 14:09:29', 3, 'yes', '2014-06-15 14:17:51', 3, 0, 'active'),
(11, 2, 'new777', 'mmm777', 'test7777', 'gmail.com777', '', '2014-06-15 14:09:29', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(12, 2, 'new888', 'mmm888', 'test888', 'gmail.com888', '', '2014-06-15 14:18:27', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(13, 2, 'new', 'mmm', 'test444', 'gmail.com', '', '2014-06-16 14:52:51', 3, '0000-00-00 00:00:00', 0, 'yes', '2014-06-16 14:53:15', 3, 0, 'active'),
(14, 2, 'Array', 'Array', 'Array', 'Array', '', '2014-06-18 15:00:46', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(15, 2, '2', '2', '2', '2.com', '', '2014-06-18 15:06:32', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(16, 2, '3', '3', '3', '3.com', '', '2014-06-18 15:07:14', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(17, 3, 'vip', 'vip', 'vip', 'cip', '', '2014-06-18 23:09:27', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(18, 3, 'test', 'test', 'test', 'test', '', '2014-06-28 20:50:22', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_article_author_url`
--

DROP TABLE IF EXISTS `cms_article_author_url`;
CREATE TABLE IF NOT EXISTS `cms_article_author_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `ai_id` int(11) NOT NULL COMMENT 'PK of article_information.id',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_article_information`
--

DROP TABLE IF EXISTS `cms_article_information`;
CREATE TABLE IF NOT EXISTS `cms_article_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `publish_date` date NOT NULL COMMENT 'Published Date',
  `note` text NOT NULL COMMENT 'Article Notes',
  `fname` varchar(100) NOT NULL COMMENT 'First name of Author Information',
  `mname` varchar(100) NOT NULL COMMENT 'Middle name of Author Information',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of Author Information',
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `phone_number` varchar(55) NOT NULL COMMENT 'Phone Number',
  `mobile_number` varchar(55) NOT NULL COMMENT 'Mobile Number',
  `twitter_username` varchar(100) NOT NULL COMMENT 'Twitter Username',
  `twitter_url` varchar(100) NOT NULL COMMENT 'Twitter Profile Page [URL]',
  `fb_username` varchar(100) NOT NULL COMMENT 'Facebook Username',
  `fb_url` varchar(100) NOT NULL COMMENT 'Facebook Profile Page [URL]',
  `linkedin_username` varchar(100) NOT NULL COMMENT 'Linkedin Username',
  `linkedin_url` varchar(100) NOT NULL COMMENT 'Linkedin Profile Page [URL]',
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `author_note` text NOT NULL COMMENT 'Author Notes [Text Box]',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_assign_transfer`
--

DROP TABLE IF EXISTS `cms_assign_transfer`;
CREATE TABLE IF NOT EXISTS `cms_assign_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `assign_to` int(11) NOT NULL COMMENT 'PK of this user table',
  `assign_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `assign_date` datetime NOT NULL COMMENT 'Date of assigned case',
  `is_transfered` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'If case is transfer or assigned (yes = transfered, no = assinged)',
  `note` text NOT NULL COMMENT 'General note about transfer or assigned',
  `status` enum('active','inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms_assign_transfer`
--

INSERT INTO `cms_assign_transfer` (`id`, `case_id`, `assign_to`, `assign_by`, `assign_date`, `is_transfered`, `note`, `status`) VALUES
(1, 4, 3, 1, '2014-06-06 01:23:15', 'no', '', 'active'),
(2, 3, 4, 1, '2014-06-06 01:23:15', 'no', '', 'active'),
(3, 5, 3, 2, '2014-06-16 14:47:02', 'no', '', 'active'),
(4, 7, 3, 2, '2014-06-18 23:03:15', 'no', '', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_businesses`
--

DROP TABLE IF EXISTS `cms_businesses`;
CREATE TABLE IF NOT EXISTS `cms_businesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `business_type` varchar(255) NOT NULL COMMENT 'Business type',
  `business_name` varchar(255) NOT NULL COMMENT 'Business Name',
  `number_of_employees` varchar(255) NOT NULL COMMENT 'Number of Employees',
  `annual_revenue` varchar(255) NOT NULL COMMENT 'Annual Revenue',
  `category` int(11) NOT NULL COMMENT 'Category id (PK category.id)',
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'PK of #__country.id',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_businesses`
--

INSERT INTO `cms_businesses` (`id`, `pi_id`, `business_type`, `business_name`, `number_of_employees`, `annual_revenue`, `category`, `street`, `city`, `zip`, `state`, `country`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 2, 'iokjhh1', 'kjh1', 'hkjh1', 'jkhkj1', 0, 'kjh1', 1166, 'hjkhkj1', 5, 62, 'hkhjk1', '2014-06-15 15:38:28', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 2, 'iokjhh2', 'kjh2', 'hkjh2', 'jkhkj2', 0, 'kjh2', 160, 'jkhkj2', 26, 40, 'hkhjk2', '2014-06-15 15:38:28', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 2, '3', '3', '3', '3', 0, '3', 43, '3', 8, 109, '3', '2014-06-15 15:51:47', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_category`
--

DROP TABLE IF EXISTS `cms_category`;
CREATE TABLE IF NOT EXISTS `cms_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `title` varchar(255) NOT NULL COMMENT 'Title of activity',
  `parent_category_id` int(11) NOT NULL COMMENT 'PK category.id',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_city`
--

DROP TABLE IF EXISTS `cms_city`;
CREATE TABLE IF NOT EXISTS `cms_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1624 ;

--
-- Dumping data for table `cms_city`
--

INSERT INTO `cms_city` (`id`, `name`, `state_id`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'Kolhapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 'Port Blair', 32, 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 'Adilabad', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(4, 'Adoni', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(5, 'Amadalavalasa', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(6, 'Amalapuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(7, 'Anakapalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(8, 'Anantapur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(9, 'Badepalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(10, 'Banganapalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(11, 'Bapatla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(12, 'Bellampalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(13, 'Bethamcherla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(14, 'Bhadrachalam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(15, 'Bhainsa', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(16, 'Bheemunipatnam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(17, 'Bhimavaram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(18, 'Bhongir', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(19, 'Bobbili', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(20, 'Bodhan', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(21, 'Chilakaluripet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(22, 'Chirala', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(23, 'Chittoor', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(24, 'Cuddapah', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(25, 'Devarakonda', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(26, 'Dharmavaram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(27, 'Eluru', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(28, 'Farooqnagar', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(29, 'Gadwal', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(30, 'Gooty', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(31, 'Gudivada', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(32, 'Gudur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(33, 'Guntakal', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(34, 'Guntur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(35, 'Hanuman Junction', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(36, 'Hindupur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(37, 'Hyderabad', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(38, 'Ichchapuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(39, 'Jaggaiahpet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(40, 'Jagtial', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(41, 'Jammalamadugu', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(42, 'Jangaon', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(43, 'Kadapa', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(44, 'Kadiri', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(45, 'Kagaznagar', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(46, 'Kakinada', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(47, 'Kalyandurg', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(48, 'Kamareddy', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(49, 'Kandukur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(50, 'Karimnagar', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(51, 'Kavali', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(52, 'Khammam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(53, 'Koratla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(54, 'Kothagudem', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(55, 'Kothapeta', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(56, 'Kovvur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(57, 'Kurnool', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(58, 'Kyathampalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(59, 'Macherla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(60, 'Machilipatnam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(61, 'Madanapalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(62, 'Mahbubnagar', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(63, 'Mancherial', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(64, 'Mandamarri', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(65, 'Mandapeta', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(66, 'Manuguru', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(67, 'Markapur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(68, 'Medak', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(69, 'Miryalaguda', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(70, 'Mogalthur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(71, 'Nagari', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(72, 'Nagarkurnool', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(73, 'Nandyal', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(74, 'Narasapur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(75, 'Narasaraopet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(76, 'Narayanpet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(77, 'Narsipatnam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(78, 'Nellore', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(79, 'Nidadavole', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(80, 'Nirmal', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(81, 'Nizamabad', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(82, 'Nuzvid', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(83, 'Ongole', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(84, 'Palacole', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(85, 'Palasa Kasibugga', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(86, 'Palwancha', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(87, 'Parvathipuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(88, 'Pedana', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(89, 'Peddapuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(90, 'Pithapuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(91, 'Pondur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(92, 'Ponnur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(93, 'Proddatur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(94, 'Punganur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(95, 'Puttur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(96, 'Rajahmundry', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(97, 'Rajam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(98, 'Ramachandrapuram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(99, 'Ramagundam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(100, 'Rayachoti', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(101, 'Rayadurg', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(102, 'Renigunta', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(103, 'Repalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(104, 'Sadasivpet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(105, 'Salur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(106, 'Samalkot', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(107, 'Sangareddy', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(108, 'Sattenapalle', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(109, 'Siddipet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(110, 'Singapur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(111, 'Sircilla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(112, 'Srikakulam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(113, 'Srikalahasti', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(115, 'Suryapet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(116, 'Tadepalligudem', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(117, 'Tadpatri', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(118, 'Tandur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(119, 'Tanuku', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(120, 'Tenali', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(121, 'Tirupati', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(122, 'Tuni', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(123, 'Uravakonda', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(124, 'Venkatagiri', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(125, 'Vicarabad', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(126, 'Vijayawada', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(127, 'Vinukonda', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(128, 'Visakhapatnam', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(129, 'Vizianagaram', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(130, 'Wanaparthy', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(131, 'Warangal', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(132, 'Yellandu', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(133, 'Yemmiganur', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(134, 'Yerraguntla', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(135, 'Zahirabad', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(136, 'Rajampet', 1, 0, 1, 0, '0000-00-00 00:00:00', 0),
(137, 'Along', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(138, 'Bomdila', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(139, 'Itanagar', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(140, 'Naharlagun', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(141, 'Pasighat', 3, 0, 1, 0, '0000-00-00 00:00:00', 0),
(142, 'Abhayapuri', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(143, 'Amguri', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(144, 'Anandnagaar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(145, 'Barpeta', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(146, 'Barpeta Road', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(147, 'Bilasipara', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(148, 'Bongaigaon', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(149, 'Dhekiajuli', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(150, 'Dhubri', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(151, 'Dibrugarh', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(152, 'Digboi', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(153, 'Diphu', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(154, 'Dispur', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(156, 'Gauripur', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(157, 'Goalpara', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(158, 'Golaghat', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(159, 'Guwahati', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(160, 'Haflong', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(161, 'Hailakandi', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(162, 'Hojai', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(163, 'Jorhat', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(164, 'Karimganj', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(165, 'Kokrajhar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(166, 'Lanka', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(167, 'Lumding', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(168, 'Mangaldoi', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(169, 'Mankachar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(170, 'Margherita', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(171, 'Mariani', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(172, 'Marigaon', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(173, 'Nagaon', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(174, 'Nalbari', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(175, 'North Lakhimpur', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(176, 'Rangia', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(177, 'Sibsagar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(178, 'Silapathar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(179, 'Silchar', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(180, 'Tezpur', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(181, 'Tinsukia', 2, 0, 1, 0, '0000-00-00 00:00:00', 0),
(182, 'Amarpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(183, 'Araria', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(184, 'Areraj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(185, 'Arrah', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(186, 'Asarganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(187, 'Aurangabad', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(188, 'Bagaha', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(189, 'Bahadurganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(190, 'Bairgania', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(191, 'Bakhtiarpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(192, 'Banka', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(193, 'Banmankhi Bazar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(194, 'Barahiya', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(195, 'Barauli', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(196, 'Barbigha', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(197, 'Barh', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(198, 'Begusarai', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(199, 'Behea', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(200, 'Bettiah', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(201, 'Bhabua', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(202, 'Bhagalpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(203, 'Bihar Sharif', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(204, 'Bikramganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(205, 'Bodh Gaya', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(206, 'Buxar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(207, 'Chandan Bara', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(208, 'Chanpatia', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(209, 'Chhapra', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(210, 'Colgong', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(211, 'Dalsinghsarai', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(212, 'Darbhanga', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(213, 'Daudnagar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(214, 'Dehri-on-Sone', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(215, 'Dhaka', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(216, 'Dighwara', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(217, 'Dumraon', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(218, 'Fatwah', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(219, 'Forbesganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(220, 'Gaya', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(221, 'Gogri Jamalpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(222, 'Gopalganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(223, 'Hajipur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(224, 'Hilsa', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(225, 'Hisua', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(226, 'Islampur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(227, 'Jagdispur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(228, 'Jamalpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(229, 'Jamui', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(230, 'Jehanabad', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(231, 'Jhajha', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(232, 'Jhanjharpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(233, 'Jogabani', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(234, 'Kanti', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(235, 'Katihar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(236, 'Khagaria', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(237, 'Kharagpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(238, 'Kishanganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(239, 'Lakhisarai', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(240, 'Lalganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(241, 'Madhepura', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(242, 'Madhubani', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(243, 'Maharajganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(244, 'Mahnar Bazar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(245, 'Makhdumpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(246, 'Maner', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(247, 'Manihari', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(248, 'Marhaura', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(249, 'Masaurhi', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(250, 'Mirganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(251, 'Mokameh', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(252, 'Motihari', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(253, 'Motipur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(254, 'Munger', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(255, 'Murliganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(256, 'Muzaffarpur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(257, 'Narkatiaganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(258, 'Naugachhia', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(259, 'Nawada', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(260, 'Nokha', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(261, 'Patna', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(262, 'Piro', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(263, 'Purnia', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(264, 'Rafiganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(265, 'Rajgir', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(266, 'Ramnagar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(267, 'Raxaul Bazar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(268, 'Revelganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(269, 'Rosera', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(270, 'Saharsa', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(271, 'Samastipur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(272, 'Sasaram', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(273, 'Sheikhpura', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(274, 'Sheohar', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(275, 'Sherghati', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(276, 'Silao', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(277, 'Sitamarhi', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(278, 'Siwan', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(279, 'Sonepur', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(280, 'Sugauli', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(281, 'Sultanganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(282, 'Supaul', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(283, 'Warisaliganj', 5, 0, 1, 0, '0000-00-00 00:00:00', 0),
(284, 'Ahiwara', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(285, 'Akaltara', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(286, 'Ambagarh Chowki', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(287, 'Ambikapur', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(288, 'Arang', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(289, 'Bade Bacheli', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(290, 'Balod', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(291, 'Baloda Bazar', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(292, 'Bemetra', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(293, 'Bhatapara', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(294, 'Bilaspur', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(295, 'Birgaon', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(296, 'Champa', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(297, 'Chirmiri', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(298, 'Dalli-Rajhara', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(299, 'Dhamtari', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(300, 'Dipka', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(301, 'Dongargarh', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(302, 'Durg-Bhilai Nagar', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(303, 'Gobranawapara', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(304, 'Jagdalpur', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(305, 'Janjgir', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(306, 'Jashpurnagar', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(307, 'Kanker', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(308, 'Kawardha', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(309, 'Kondagaon', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(310, 'Korba', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(311, 'Mahasamund', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(312, 'Mahendragarh', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(313, 'Mungeli', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(314, 'Naila Janjgir', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(315, 'Raigarh', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(316, 'Raipur', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(317, 'Rajnandgaon', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(318, 'Sakti', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(319, 'Tilda Newra', 35, 0, 1, 0, '0000-00-00 00:00:00', 0),
(320, 'Amli', 30, 0, 1, 0, '0000-00-00 00:00:00', 0),
(321, 'Silvassa', 30, 0, 1, 0, '0000-00-00 00:00:00', 0),
(322, 'Daman and Diu', 29, 0, 1, 0, '0000-00-00 00:00:00', 0),
(323, 'Daman and Diu', 29, 0, 1, 0, '0000-00-00 00:00:00', 0),
(324, 'Asola', 25, 0, 1, 0, '0000-00-00 00:00:00', 0),
(325, 'Delhi', 25, 0, 1, 0, '0000-00-00 00:00:00', 0),
(326, 'Aldona', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(327, 'Curchorem Cacora', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(328, 'Madgaon', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(329, 'Mapusa', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(330, 'Margao', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(331, 'Marmagao', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(332, 'Panaji', 26, 0, 1, 0, '0000-00-00 00:00:00', 0),
(333, 'Ahmedabad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(334, 'Amreli', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(335, 'Anand', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(336, 'Ankleshwar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(337, 'Bharuch', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(338, 'Bhavnagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(339, 'Bhuj', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(340, 'Cambay', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(341, 'Dahod', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(342, 'Deesa', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(343, 'Dharampur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(344, 'Dholka', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(345, 'Gandhinagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(346, 'Godhra', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(347, 'Himatnagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(348, 'Idar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(349, 'Jamnagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(350, 'Junagadh', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(351, 'Kadi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(352, 'Kalavad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(353, 'Kalol', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(354, 'Kapadvanj', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(355, 'Karjan', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(356, 'Keshod', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(357, 'Khambhalia', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(358, 'Khambhat', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(359, 'Kheda', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(360, 'Khedbrahma', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(361, 'Kheralu', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(362, 'Kodinar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(363, 'Lathi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(364, 'Limbdi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(365, 'Lunawada', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(366, 'Mahesana', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(367, 'Mahuva', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(368, 'Manavadar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(369, 'Mandvi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(370, 'Mangrol', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(371, 'Mansa', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(372, 'Mehmedabad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(373, 'Modasa', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(374, 'Morvi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(375, 'Nadiad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(376, 'Navsari', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(377, 'Padra', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(378, 'Palanpur', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(379, 'Palitana', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(380, 'Pardi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(381, 'Patan', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(382, 'Petlad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(383, 'Porbandar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(384, 'Radhanpur', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(385, 'Rajkot', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(386, 'Rajpipla', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(387, 'Rajula', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(388, 'Ranavav', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(389, 'Rapar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(390, 'Salaya', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(391, 'Sanand', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(392, 'Savarkundla', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(393, 'Sidhpur', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(394, 'Sihor', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(395, 'Songadh', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(396, 'Surat', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(397, 'Talaja', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(398, 'Thangadh', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(399, 'Tharad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(400, 'Umbergaon', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(401, 'Umreth', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(402, 'Una', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(403, 'Unjha', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(404, 'Upleta', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(405, 'Vadnagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(406, 'Vadodara', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(407, 'Valsad', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(408, 'Vapi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(409, 'Vapi', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(410, 'Veraval', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(411, 'Vijapur', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(412, 'Viramgam', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(413, 'Visnagar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(414, 'Vyara', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(415, 'Wadhwan', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(416, 'Wankaner', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(417, 'Adalaj', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(418, 'Adityana', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(419, 'Alang', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(420, 'Ambaji', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(421, 'Ambaliyasan', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(422, 'Andada', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(423, 'Anjar', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(424, 'Anklav', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(425, 'Antaliya', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(426, 'Arambhada', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(427, 'Atul', 4, 0, 1, 0, '0000-00-00 00:00:00', 0),
(428, 'Ballabhgarh', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(429, 'Ambala', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(430, 'Ambala', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(431, 'Asankhurd', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(432, 'Assandh', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(433, 'Ateli', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(434, 'Babiyal', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(435, 'Bahadurgarh', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(436, 'Barwala', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(437, 'Bhiwani', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(438, 'Charkhi Dadri', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(439, 'Cheeka', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(440, 'Ellenabad 2', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(441, 'Faridabad', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(442, 'Fatehabad', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(443, 'Ganaur', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(444, 'Gharaunda', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(445, 'Gohana', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(446, 'Gurgaon', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(447, 'Haibat(Yamuna Nagar)', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(448, 'Hansi', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(449, 'Hisar', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(450, 'Hodal', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(451, 'Jhajjar', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(452, 'Jind', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(453, 'Kaithal', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(454, 'Kalan Wali', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(455, 'Kalka', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(456, 'Karnal', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(457, 'Ladwa', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(458, 'Mahendragarh', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(459, 'Mandi Dabwali', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(460, 'Narnaul', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(461, 'Narwana', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(462, 'Palwal', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(463, 'Panchkula', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(464, 'Panipat', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(465, 'Pehowa', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(466, 'Pinjore', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(467, 'Rania', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(468, 'Ratia', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(469, 'Rewari', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(470, 'Rohtak', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(471, 'Safidon', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(472, 'Samalkha', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(473, 'Shahbad', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(474, 'Sirsa', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(475, 'Sohna', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(476, 'Sonipat', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(477, 'Taraori', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(478, 'Thanesar', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(479, 'Tohana', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(480, 'Yamunanagar', 6, 0, 1, 0, '0000-00-00 00:00:00', 0),
(481, 'Arki', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(482, 'Baddi', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(483, 'Bilaspur', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(484, 'Chamba', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(485, 'Dalhousie', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(486, 'Dharamsala', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(487, 'Hamirpur', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(488, 'Mandi', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(489, 'Nahan', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(490, 'Shimla', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(491, 'Solan', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(492, 'Sundarnagar', 7, 0, 1, 0, '0000-00-00 00:00:00', 0),
(493, 'Jammu', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(494, 'Achabbal', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(495, 'Akhnoor', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(496, 'Anantnag', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(497, 'Arnia', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(498, 'Awantipora', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(499, 'Bandipore', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(500, 'Baramula', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(501, 'Kathua', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(502, 'Leh', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(503, 'Punch', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(504, 'Rajauri', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(505, 'Sopore', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(506, 'Srinagar', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(507, 'Udhampur', 8, 0, 1, 0, '0000-00-00 00:00:00', 0),
(508, 'Amlabad', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(509, 'Ara', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(510, 'Barughutu', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(511, 'Bokaro Steel City', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(512, 'Chaibasa', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(513, 'Chakradharpur', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(514, 'Chandrapura', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(515, 'Chatra', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(516, 'Chirkunda', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(517, 'Churi', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(518, 'Daltonganj', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(519, 'Deoghar', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(520, 'Dhanbad', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(521, 'Dumka', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(522, 'Garhwa', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(523, 'Ghatshila', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(524, 'Giridih', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(525, 'Godda', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(526, 'Gomoh', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(527, 'Gumia', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(528, 'Gumla', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(529, 'Hazaribag', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(530, 'Hussainabad', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(531, 'Jamshedpur', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(532, 'Jamtara', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(533, 'Jhumri Tilaiya', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(534, 'Khunti', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(535, 'Lohardaga', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(536, 'Madhupur', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(537, 'Mihijam', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(538, 'Musabani', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(539, 'Pakaur', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(540, 'Patratu', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(541, 'Phusro', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(542, 'Ramngarh', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(543, 'Ranchi', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(544, 'Sahibganj', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(545, 'Saunda', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(546, 'Simdega', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(547, 'Tenu Dam-cum- Kathhara', 34, 0, 1, 0, '0000-00-00 00:00:00', 0),
(548, 'Arasikere', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(549, 'Bangalore', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(550, 'Belgaum', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(551, 'Bellary', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(552, 'Chamrajnagar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(553, 'Chikkaballapur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(554, 'Chintamani', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(555, 'Chitradurga', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(556, 'Gulbarga', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(557, 'Gundlupet', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(558, 'Hassan', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(559, 'Hospet', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(560, 'Hubli', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(561, 'Karkala', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(562, 'Karwar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(563, 'Kolar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(564, 'Kota', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(565, 'Lakshmeshwar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(566, 'Lingsugur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(567, 'Maddur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(568, 'Madhugiri', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(569, 'Madikeri', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(570, 'Magadi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(571, 'Mahalingpur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(572, 'Malavalli', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(573, 'Malur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(574, 'Mandya', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(575, 'Mangalore', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(576, 'Manvi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(577, 'Mudalgi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(578, 'Mudbidri', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(579, 'Muddebihal', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(580, 'Mudhol', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(581, 'Mulbagal', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(582, 'Mundargi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(583, 'Mysore', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(584, 'Nanjangud', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(585, 'Pavagada', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(586, 'Puttur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(587, 'Rabkavi Banhatti', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(588, 'Raichur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(589, 'Ramanagaram', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(590, 'Ramdurg', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(591, 'Ranibennur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(592, 'Robertson Pet', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(593, 'Ron', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(594, 'Sadalgi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(595, 'Sagar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(596, 'Sakleshpur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(597, 'Sandur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(598, 'Sankeshwar', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(599, 'Saundatti-Yellamma', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(600, 'Savanur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(601, 'Sedam', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(602, 'Shahabad', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(603, 'Shahpur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(604, 'Shiggaon', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(605, 'Shikapur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(606, 'Shimoga', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(607, 'Shorapur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(608, 'Shrirangapattana', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(609, 'Sidlaghatta', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(610, 'Sindgi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(611, 'Sindhnur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(612, 'Sira', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(613, 'Sirsi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(614, 'Siruguppa', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(615, 'Srinivaspur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(616, 'Talikota', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(617, 'Tarikere', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(618, 'Tekkalakota', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(619, 'Terdal', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(620, 'Tiptur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(621, 'Tumkur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(622, 'Udupi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(623, 'Vijayapura', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(624, 'Wadi', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(625, 'Yadgir', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(626, 'Adoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(627, 'Akathiyoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(628, 'Alappuzha', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(629, 'Ancharakandy', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(630, 'Aroor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(631, 'Ashtamichira', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(632, 'Attingal', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(633, 'Avinissery', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(634, 'Chalakudy', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(635, 'Changanassery', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(636, 'Chendamangalam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(637, 'Chengannur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(638, 'Cherthala', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(639, 'Cheruthazham', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(640, 'Chittur-Thathamangalam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(641, 'Chockli', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(642, 'Erattupetta', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(643, 'Guruvayoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(644, 'Irinjalakuda', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(645, 'Kadirur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(646, 'Kalliasseri', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(647, 'Kalpetta', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(648, 'Kanhangad', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(649, 'Kanjikkuzhi', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(650, 'Kannur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(651, 'Kasaragod', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(652, 'Kayamkulam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(653, 'Kochi', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(654, 'Kodungallur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(655, 'Kollam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(656, 'Koothuparamba', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(657, 'Kothamangalam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(658, 'Kottayam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(659, 'Kozhikode', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(660, 'Kunnamkulam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(661, 'Malappuram', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(662, 'Mattannur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(663, 'Mavelikkara', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(664, 'Mavoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(665, 'Muvattupuzha', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(666, 'Nedumangad', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(667, 'Neyyattinkara', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(668, 'Ottappalam', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(669, 'Palai', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(670, 'Palakkad', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(671, 'Panniyannur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(672, 'Pappinisseri', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(673, 'Paravoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(674, 'Pathanamthitta', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(675, 'Payyannur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(676, 'Peringathur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(677, 'Perinthalmanna', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(678, 'Perumbavoor', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(679, 'Ponnani', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(680, 'Punalur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(681, 'Quilandy', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(682, 'Shoranur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(683, 'Taliparamba', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(684, 'Thiruvalla', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(685, 'Thiruvananthapuram', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(686, 'Thodupuzha', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(687, 'Thrissur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(688, 'Tirur', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(689, 'Vadakara', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(690, 'Vaikom', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(691, 'Varkala', 10, 0, 1, 0, '0000-00-00 00:00:00', 0),
(692, 'Kavaratti', 28, 0, 1, 0, '0000-00-00 00:00:00', 0),
(693, 'Ashok Nagar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(694, 'Balaghat', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(695, 'Betul', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(696, 'Bhopal', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(697, 'Burhanpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(698, 'Chhatarpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(699, 'Dabra', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(700, 'Datia', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(701, 'Dewas', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(702, 'Dhar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(703, 'Fatehabad', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(704, 'Gwalior', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(705, 'Indore', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(706, 'Itarsi', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(707, 'Jabalpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(708, 'Katni', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(709, 'Kotma', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(710, 'Lahar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(711, 'Lundi', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(712, 'Maharajpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(713, 'Mahidpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(714, 'Maihar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(715, 'Malajkhand', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(716, 'Manasa', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(717, 'Manawar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(718, 'Mandideep', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(719, 'Mandla', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(720, 'Mandsaur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(721, 'Mauganj', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(722, 'Mhow Cantonment', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(723, 'Mhowgaon', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(724, 'Morena', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(725, 'Multai', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(726, 'Murwara', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(727, 'Nagda', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(728, 'Nainpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(729, 'Narsinghgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(730, 'Narsinghgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(731, 'Neemuch', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(732, 'Nepanagar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(733, 'Niwari', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(734, 'Nowgong', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(735, 'Nowrozabad', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(736, 'Pachore', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(737, 'Pali', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(738, 'Panagar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(739, 'Pandhurna', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(740, 'Panna', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(741, 'Pasan', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(742, 'Pipariya', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(743, 'Pithampur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(744, 'Porsa', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(745, 'Prithvipur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(746, 'Raghogarh-Vijaypur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(747, 'Rahatgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(748, 'Raisen', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(749, 'Rajgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(750, 'Ratlam', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(751, 'Rau', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(752, 'Rehli', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(753, 'Rewa', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(754, 'Sabalgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(755, 'Sagar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(756, 'Sanawad', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(757, 'Sarangpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(758, 'Sarni', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(759, 'Satna', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(760, 'Sausar', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(761, 'Sehore', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(762, 'Sendhwa', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(763, 'Seoni', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(764, 'Seoni-Malwa', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(765, 'Shahdol', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(766, 'Shajapur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(767, 'Shamgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(768, 'Sheopur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(769, 'Shivpuri', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(770, 'Shujalpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(771, 'Sidhi', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(772, 'Sihora', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(773, 'Singrauli', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(774, 'Sironj', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(775, 'Sohagpur', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(776, 'Tarana', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(777, 'Tikamgarh', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(778, 'Ujhani', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(779, 'Ujjain', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(780, 'Umaria', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(781, 'Vidisha', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(782, 'Wara Seoni', 11, 0, 1, 0, '0000-00-00 00:00:00', 0),
(783, 'Ahmednagar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(784, 'Akola', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(785, 'Amravati', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(786, 'Aurangabad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(787, 'Baramati', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(788, 'Chalisgaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(789, 'Chinchani', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(790, 'Devgarh', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(791, 'Dhule', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(792, 'Dombivli', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(793, 'Durgapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(794, 'Ichalkaranji', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(795, 'Jalna', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(796, 'Kalyan', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(797, 'Latur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(798, 'Loha', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(799, 'Lonar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(800, 'Lonavla', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(801, 'Mahad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(802, 'Mahuli', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(803, 'Malegaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(804, 'Malkapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(805, 'Manchar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(806, 'Mangalvedhe', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(807, 'Mangrulpir', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(808, 'Manjlegaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(809, 'Manmad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(810, 'Manwath', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(811, 'Mehkar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(812, 'Mhaswad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(813, 'Miraj', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(814, 'Morshi', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(815, 'Mukhed', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(816, 'Mul', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(817, 'Mumbai', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(818, 'Murtijapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(819, 'Nagpur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(820, 'Nalasopara', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(821, 'Nanded-Waghala', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(822, 'Nandgaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(823, 'Nandura', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(824, 'Nandurbar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(825, 'Narkhed', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(826, 'Nashik', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(827, 'Navi Mumbai', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(828, 'Nawapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(829, 'Nilanga', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(830, 'Osmanabad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(831, 'Ozar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(832, 'Pachora', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(833, 'Paithan', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(834, 'Palghar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(835, 'Pandharkaoda', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(836, 'Pandharpur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(837, 'Panvel', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(838, 'Parbhani', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(839, 'Parli', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(840, 'Parola', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(841, 'Partur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(842, 'Pathardi', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(843, 'Pathri', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(844, 'Patur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(845, 'Pauni', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(846, 'Pen', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(847, 'Phaltan', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(848, 'Pulgaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(849, 'Pune', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(850, 'Purna', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(851, 'Pusad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(852, 'Rahuri', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(853, 'Rajura', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(854, 'Ramtek', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(855, 'Ratnagiri', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(856, 'Raver', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(857, 'Risod', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(858, 'Sailu', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(859, 'Sangamner', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(860, 'Sangli', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(861, 'Sangole', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(862, 'Sasvad', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(863, 'Satana', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(864, 'Satara', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(865, 'Savner', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(866, 'Sawantwadi', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(867, 'Shahade', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(868, 'Shegaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(869, 'Shendurjana', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(870, 'Shirdi', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(871, 'Shirpur-Warwade', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(872, 'Shirur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(873, 'Shrigonda', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(874, 'Shrirampur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(875, 'Sillod', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(876, 'Sinnar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(877, 'Solapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(878, 'Soyagaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(879, 'Talegaon Dabhade', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(880, 'Talode', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(881, 'Tasgaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(882, 'Tirora', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(883, 'Tuljapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(884, 'Tumsar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(885, 'Uran', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(886, 'Uran Islampur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(887, 'Wadgaon Road', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(888, 'Wai', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(889, 'Wani', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(890, 'Wardha', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(891, 'Warora', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(892, 'Warud', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(893, 'Washim', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(894, 'Yevla', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(895, 'Uchgaon', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(896, 'Udgir', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(897, 'Umarga', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(898, 'Umarkhed', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(899, 'Umred', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(900, 'Vadgaon Kasba', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(901, 'Vaijapur', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(902, 'Vasai', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(903, 'Virar', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(904, 'Vita', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(905, 'Yavatmal', 12, 0, 1, 0, '0000-00-00 00:00:00', 0);
INSERT INTO `cms_city` (`id`, `name`, `state_id`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(906, 'Yawal', 12, 0, 1, 0, '0000-00-00 00:00:00', 0),
(907, 'Imphal', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(908, 'Kakching', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(909, 'Lilong', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(910, 'Mayang Imphal', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(911, 'Thoubal', 13, 0, 1, 0, '0000-00-00 00:00:00', 0),
(912, 'Jowai', 14, 0, 1, 0, '0000-00-00 00:00:00', 0),
(913, 'Nongstoin', 14, 0, 1, 0, '0000-00-00 00:00:00', 0),
(914, 'Shillong', 14, 0, 1, 0, '0000-00-00 00:00:00', 0),
(915, 'Tura', 14, 0, 1, 0, '0000-00-00 00:00:00', 0),
(916, 'Aizawl', 15, 0, 1, 0, '0000-00-00 00:00:00', 0),
(917, 'Champhai', 15, 0, 1, 0, '0000-00-00 00:00:00', 0),
(918, 'Lunglei', 15, 0, 1, 0, '0000-00-00 00:00:00', 0),
(919, 'Saiha', 15, 0, 1, 0, '0000-00-00 00:00:00', 0),
(920, 'Dimapur', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(921, 'Kohima', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(922, 'Mokokchung', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(923, 'Tuensang', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(924, 'Wokha', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(925, 'Zunheboto', 16, 0, 1, 0, '0000-00-00 00:00:00', 0),
(950, 'Anandapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(951, 'Anugul', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(952, 'Asika', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(953, 'Balangir', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(954, 'Balasore', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(955, 'Baleshwar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(956, 'Bamra', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(957, 'Barbil', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(958, 'Bargarh', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(959, 'Bargarh', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(960, 'Baripada', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(961, 'Basudebpur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(962, 'Belpahar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(963, 'Bhadrak', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(964, 'Bhawanipatna', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(965, 'Bhuban', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(966, 'Bhubaneswar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(967, 'Biramitrapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(968, 'Brahmapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(969, 'Brajrajnagar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(970, 'Byasanagar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(971, 'Cuttack', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(972, 'Debagarh', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(973, 'Dhenkanal', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(974, 'Gunupur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(975, 'Hinjilicut', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(976, 'Jagatsinghapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(977, 'Jajapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(978, 'Jaleswar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(979, 'Jatani', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(980, 'Jeypur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(981, 'Jharsuguda', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(982, 'Joda', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(983, 'Kantabanji', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(984, 'Karanjia', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(985, 'Kendrapara', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(986, 'Kendujhar', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(987, 'Khordha', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(988, 'Koraput', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(989, 'Malkangiri', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(990, 'Nabarangapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(991, 'Paradip', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(992, 'Parlakhemundi', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(993, 'Pattamundai', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(994, 'Phulabani', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(995, 'Puri', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(996, 'Rairangpur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(997, 'Rajagangapur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(998, 'Raurkela', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(999, 'Rayagada', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1000, 'Sambalpur', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1001, 'Soro', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1002, 'Sunabeda', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1003, 'Sundargarh', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1004, 'Talcher', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1005, 'Titlagarh', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1006, 'Umarkote', 17, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1007, 'Karaikal', 27, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1008, 'Mahe', 27, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1009, 'Pondicherry', 27, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1010, 'Yanam', 27, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1011, 'Ahmedgarh', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1012, 'Amritsar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1013, 'Barnala', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1014, 'Batala', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1015, 'Bathinda', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1016, 'Bhagha Purana', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1017, 'Budhlada', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1018, 'Chandigarh', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1019, 'Dasua', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1020, 'Dhuri', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1021, 'Dinanagar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1022, 'Faridkot', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1023, 'Fazilka', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1024, 'Firozpur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1025, 'Firozpur Cantt.', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1026, 'Giddarbaha', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1027, 'Gobindgarh', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1028, 'Gurdaspur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1029, 'Hoshiarpur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1030, 'Jagraon', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1031, 'Jaitu', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1032, 'Jalalabad', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1033, 'Jalandhar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1034, 'Jalandhar Cantt.', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1035, 'Jandiala', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1036, 'Kapurthala', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1037, 'Karoran', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1038, 'Kartarpur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1039, 'Khanna', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1040, 'Kharar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1041, 'Kot Kapura', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1042, 'Kurali', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1043, 'Longowal', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1044, 'Ludhiana', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1045, 'Malerkotla', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1046, 'Malout', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1047, 'Mansa', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1048, 'Maur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1049, 'Moga', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1050, 'Mohali', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1051, 'Morinda', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1052, 'Mukerian', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1053, 'Muktsar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1054, 'Nabha', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1055, 'Nakodar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1056, 'Nangal', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1057, 'Nawanshahr', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1058, 'Pathankot', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1059, 'Patiala', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1060, 'Patran', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1061, 'Patti', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1062, 'Phagwara', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1063, 'Phillaur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1064, 'Qadian', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1065, 'Raikot', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1066, 'Rajpura', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1067, 'Rampura Phul', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1068, 'Rupnagar', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1069, 'Samana', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1070, 'Sangrur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1071, 'Sirhind Fatehgarh Sahib', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1072, 'Sujanpur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1073, 'Sunam', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1074, 'Talwara', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1075, 'Tarn Taran', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1076, 'Urmar Tanda', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1077, 'Zira', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1078, 'Zirakpur', 18, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1079, 'Bali', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1080, 'Banswara', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1081, 'Ajmer', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1082, 'Alwar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1083, 'Bandikui', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1084, 'Baran', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1085, 'Barmer', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1086, 'Bikaner', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1087, 'Fatehpur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1088, 'Jaipur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1089, 'Jaisalmer', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1090, 'Jodhpur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1091, 'Kota', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1092, 'Lachhmangarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1093, 'Ladnu', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1094, 'Lakheri', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1095, 'Lalsot', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1096, 'Losal', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1097, 'Makrana', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1098, 'Malpura', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1099, 'Mandalgarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1100, 'Mandawa', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1101, 'Mangrol', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1102, 'Merta City', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1103, 'Mount Abu', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1104, 'Nadbai', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1105, 'Nagar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1106, 'Nagaur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1107, 'Nargund', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1108, 'Nasirabad', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1109, 'Nathdwara', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1110, 'Navalgund', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1111, 'Nawalgarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1112, 'Neem-Ka-Thana', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1113, 'Nelamangala', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1114, 'Nimbahera', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1115, 'Nipani', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1116, 'Niwai', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1117, 'Nohar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1118, 'Nokha', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1119, 'Pali', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1120, 'Phalodi', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1121, 'Phulera', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1122, 'Pilani', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1123, 'Pilibanga', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1124, 'Pindwara', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1125, 'Pipar City', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1126, 'Prantij', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1127, 'Pratapgarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1128, 'Raisinghnagar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1129, 'Rajakhera', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1130, 'Rajaldesar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1131, 'Rajgarh (Alwar)', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1132, 'Rajgarh (Churu', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1133, 'Rajsamand', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1134, 'Ramganj Mandi', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1135, 'Ramngarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1136, 'Ratangarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1137, 'Rawatbhata', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1138, 'Rawatsar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1139, 'Reengus', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1140, 'Sadri', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1141, 'Sadulshahar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1142, 'Sagwara', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1143, 'Sambhar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1144, 'Sanchore', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1145, 'Sangaria', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1146, 'Sardarshahar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1147, 'Sawai Madhopur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1148, 'Shahpura', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1149, 'Shahpura', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1150, 'Sheoganj', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1151, 'Sikar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1152, 'Sirohi', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1153, 'Sojat', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1154, 'Sri Madhopur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1155, 'Sujangarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1156, 'Sumerpur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1157, 'Suratgarh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1158, 'Taranagar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1159, 'Todabhim', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1160, 'Todaraisingh', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1161, 'Tonk', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1162, 'Udaipur', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1163, 'Udaipurwati', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1164, 'Vijainagar', 19, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1165, 'Gangtok', 20, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1166, 'Calcutta', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1167, 'Arakkonam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1168, 'Arcot', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1169, 'Aruppukkottai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1170, 'Bhavani', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1171, 'Chengalpattu', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1172, 'Chennai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1173, 'Chinna salem', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1174, 'Coimbatore', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1175, 'Coonoor', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1176, 'Cuddalore', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1177, 'Dharmapuri', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1178, 'Dindigul', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1179, 'Erode', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1180, 'Gudalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1181, 'Gudalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1182, 'Gudalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1183, 'Kanchipuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1184, 'Karaikudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1185, 'Karungal', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1186, 'Karur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1187, 'Kollankodu', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1188, 'Lalgudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1189, 'Madurai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1190, 'Nagapattinam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1191, 'Nagercoil', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1192, 'Namagiripettai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1193, 'Namakkal', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1194, 'Nandivaram-Guduvancheri', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1195, 'Nanjikottai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1196, 'Natham', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1197, 'Nellikuppam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1198, 'Neyveli', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1199, 'O'' Valley', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1200, 'Oddanchatram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1201, 'P.N.Patti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1202, 'Pacode', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1203, 'Padmanabhapuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1204, 'Palani', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1205, 'Palladam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1206, 'Pallapatti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1207, 'Pallikonda', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1208, 'Panagudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1209, 'Panruti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1210, 'Paramakudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1211, 'Parangipettai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1212, 'Pattukkottai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1213, 'Perambalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1214, 'Peravurani', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1215, 'Periyakulam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1216, 'Periyasemur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1217, 'Pernampattu', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1218, 'Pollachi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1219, 'Polur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1220, 'Ponneri', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1221, 'Pudukkottai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1222, 'Pudupattinam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1223, 'Puliyankudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1224, 'Punjaipugalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1225, 'Rajapalayam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1226, 'Ramanathapuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1227, 'Rameshwaram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1228, 'Rasipuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1229, 'Salem', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1230, 'Sankarankoil', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1231, 'Sankari', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1232, 'Sathyamangalam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1233, 'Sattur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1234, 'Shenkottai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1235, 'Sholavandan', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1236, 'Sholingur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1237, 'Sirkali', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1238, 'Sivaganga', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1239, 'Sivagiri', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1240, 'Sivakasi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1241, 'Srivilliputhur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1242, 'Surandai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1243, 'Suriyampalayam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1244, 'Tenkasi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1245, 'Thammampatti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1246, 'Thanjavur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1247, 'Tharamangalam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1248, 'Tharangambadi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1249, 'Theni Allinagaram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1250, 'Thirumangalam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1251, 'Thirunindravur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1252, 'Thiruparappu', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1253, 'Thirupuvanam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1254, 'Thiruthuraipoondi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1255, 'Thiruvallur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1256, 'Thiruvarur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1257, 'Thoothukudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1258, 'Thuraiyur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1259, 'Tindivanam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1260, 'Tiruchendur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1261, 'Tiruchengode', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1262, 'Tiruchirappalli', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1263, 'Tirukalukundram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1264, 'Tirukkoyilur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1265, 'Tirunelveli', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1266, 'Tirupathur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1267, 'Tirupathur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1268, 'Tiruppur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1269, 'Tiruttani', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1270, 'Tiruvannamalai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1271, 'Tiruvethipuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1272, 'Tittakudi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1273, 'Udhagamandalam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1274, 'Udumalaipettai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1275, 'Unnamalaikadai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1276, 'Usilampatti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1277, 'Uthamapalayam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1278, 'Uthiramerur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1279, 'Vadakkuvalliyur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1280, 'Vadalur', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1281, 'Vadipatti', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1282, 'Valparai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1283, 'Vandavasi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1284, 'Vaniyambadi', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1285, 'Vedaranyam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1286, 'Vellakoil', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1287, 'Vellore', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1288, 'Vikramasingapuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1289, 'Viluppuram', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1290, 'Virudhachalam', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1291, 'Virudhunagar', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1292, 'Viswanatham', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1293, 'Agartala', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1294, 'Badharghat', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1295, 'Dharmanagar', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1296, 'Indranagar', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1297, 'Jogendranagar', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1298, 'Kailasahar', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1299, 'Khowai', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1300, 'Pratapgarh', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1301, 'Udaipur', 22, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1302, 'Achhnera', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1303, 'Adari', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1304, 'Agra', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1305, 'Aligarh', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1306, 'Allahabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1307, 'Amroha', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1308, 'Azamgarh', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1309, 'Bahraich', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1310, 'Ballia', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1311, 'Balrampur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1312, 'Banda', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1313, 'Bareilly', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1314, 'Chandausi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1315, 'Dadri', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1316, 'Deoria', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1317, 'Etawah', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1318, 'Fatehabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1319, 'Fatehpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1320, 'Fatehpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1321, 'Greater Noida', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1322, 'Hamirpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1323, 'Hardoi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1324, 'Jajmau', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1325, 'Jaunpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1326, 'Jhansi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1327, 'Kalpi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1328, 'Kanpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1329, 'Kota', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1330, 'Laharpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1331, 'Lakhimpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1332, 'Lal Gopalganj Nindaura', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1333, 'Lalganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1334, 'Lalitpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1335, 'Lar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1336, 'Loni', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1337, 'Lucknow', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1338, 'Mathura', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1339, 'Meerut', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1340, 'Modinagar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1341, 'Muradnagar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1342, 'Nagina', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1343, 'Najibabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1344, 'Nakur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1345, 'Nanpara', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1346, 'Naraura', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1347, 'Naugawan Sadat', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1348, 'Nautanwa', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1349, 'Nawabganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1350, 'Nehtaur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1351, 'NOIDA', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1352, 'Noorpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1353, 'Obra', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1354, 'Orai', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1355, 'Padrauna', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1356, 'Palia Kalan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1357, 'Parasi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1358, 'Phulpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1359, 'Pihani', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1360, 'Pilibhit', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1361, 'Pilkhuwa', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1362, 'Powayan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1363, 'Pukhrayan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1364, 'Puranpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1365, 'Purquazi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1366, 'Purwa', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1367, 'Rae Bareli', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1368, 'Rampur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1369, 'Rampur Maniharan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1370, 'Rasra', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1371, 'Rath', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1372, 'Renukoot', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1373, 'Reoti', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1374, 'Robertsganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1375, 'Rudauli', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1376, 'Rudrapur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1377, 'Sadabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1378, 'Safipur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1379, 'Saharanpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1380, 'Sahaspur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1381, 'Sahaswan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1382, 'Sahawar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1383, 'Sahjanwa', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1384, 'Saidpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1385, 'Sambhal', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1386, 'Samdhan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1387, 'Samthar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1388, 'Sandi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1389, 'Sandila', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1390, 'Sardhana', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1391, 'Seohara', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1392, 'Shahabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1393, 'Shahabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1394, 'Shahganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1395, 'Shahjahanpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1396, 'Shamli', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1397, 'Shamsabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1398, 'Shamsabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1399, 'Sherkot', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1400, 'Shikarpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1401, 'Shikohabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1402, 'Shishgarh', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1403, 'Siana', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1404, 'Sikanderpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1405, 'Sikandra Rao', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1406, 'Sikandrabad', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1407, 'Sirsaganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1408, 'Sirsi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1409, 'Sitapur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1410, 'Soron', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1411, 'Suar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1412, 'Sultanpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1413, 'Sumerpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1414, 'Tanda', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1415, 'Tanda', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1416, 'Tetri Bazar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1417, 'Thakurdwara', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1418, 'Thana Bhawan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1419, 'Tilhar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1420, 'Tirwaganj', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1421, 'Tulsipur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1422, 'Tundla', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1423, 'Unnao', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1424, 'Utraula', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1425, 'Varanasi', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1426, 'Vrindavan', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1427, 'Warhapur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1428, 'Zaidpur', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1429, 'Zamania', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1430, 'Almora', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1431, 'Bazpur', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1432, 'Chamba', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1433, 'Dehradun', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1434, 'Haldwani', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1435, 'Haridwar', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1436, 'Jaspur', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1437, 'Kashipur', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1438, 'kichha', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1439, 'Kotdwara', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1440, 'Manglaur', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1441, 'Mussoorie', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1442, 'Nagla', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1443, 'Nainital', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1444, 'Pauri', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1445, 'Pithoragarh', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1446, 'Ramnagar', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1447, 'Rishikesh', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1448, 'Roorkee', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1449, 'Rudrapur', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1450, 'Sitarganj', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1451, 'Tehri', 33, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1452, 'Muzaffarnagar', 23, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1453, 'Adra', 1, 0, 1, 0, '0000-00-00 00:00:00', 103),
(1454, 'Alipurduar', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1455, 'Arambagh', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1456, 'Asansol', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1457, 'Baharampur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1458, 'Bally', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1459, 'Balurghat', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1460, 'Bankura', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1461, 'Barakar', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1462, 'Barasat', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1463, 'Bardhaman', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1464, 'Bidhan Nagar', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1465, 'Chinsura', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1466, 'Contai', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1467, 'Cooch Behar', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1468, 'Darjeeling', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1469, 'Durgapur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1470, 'Haldia', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1471, 'Howrah', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1472, 'Islampur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1473, 'Jhargram', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1474, 'Kharagpur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1475, 'Kolkata', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1476, 'Mainaguri', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1477, 'Mal', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1478, 'Mathabhanga', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1479, 'Medinipur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1480, 'Memari', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1481, 'Monoharpur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1482, 'Murshidabad', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1483, 'Nabadwip', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1484, 'Naihati', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1485, 'Panchla', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1486, 'Pandua', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1487, 'Paschim Punropara', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1488, 'Purulia', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1489, 'Raghunathpur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1490, 'Raiganj', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1491, 'Rampurhat', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1492, 'Ranaghat', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1493, 'Sainthia', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1494, 'Santipur', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1495, 'Siliguri', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1496, 'Sonamukhi', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1497, 'Srirampore', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1498, 'Suri', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1499, 'Taki', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1500, 'Tamluk', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1501, 'Tarakeswar', 24, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1502, 'Chikmagalur', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1503, 'Davanagere', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1504, 'Dharwad', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1505, 'Gadag', 9, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1506, 'Chennai', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1507, 'Coimbatore', 21, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1508, 'Barrackpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1509, 'Barwani', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1510, 'Basna', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1511, 'Bawal', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1512, 'Beawar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1513, 'Berhampur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1514, 'Bhajanpura', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1515, 'Bhandara', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1516, 'Bharatpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1517, 'Bharthana', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1518, 'Bhilai', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1519, 'Bhilwara', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1520, 'Bhinmal', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1521, 'Bhiwandi', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1522, 'Bhusawal', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1523, 'Bidar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1524, 'Bijnaur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1525, 'Bilara', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1527, 'Budaun', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1528, 'Bulandshahr', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1529, 'Burla', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1532, 'Chakeri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1533, 'Champawat', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1534, 'Chandil', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1535, 'Chandrapur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1536, 'Chapirevula', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1537, 'Charkhari', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1538, 'Charkhi Dadri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1539, 'Chhindwara', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1540, 'Chiplun', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1541, 'Chitrakoot', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1542, 'Churu', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1543, 'Dalkhola', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1544, 'Damoh', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1545, 'Daund', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1546, 'Dehgam', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1547, 'Devgarh', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1548, 'Dhulian', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1549, 'Dumdum', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1550, 'Dwarka1', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1551, 'Etah', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1552, 'Faizabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1553, 'Falna', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1554, 'Farrukhabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1555, 'Fatehgarh', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1556, 'Fatehpur Chaurasi', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1557, 'Fatehpur Sikri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1558, 'Firozabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1559, 'Gadchiroli', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1560, 'Gandhidham', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1561, 'Ganjam', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1562, 'Ghatampur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1563, 'Ghatanji', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1564, 'Ghaziabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1565, 'Ghazipur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1566, 'Goa Velha', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1567, 'Gokak', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1568, 'Gondiya', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1569, 'Gorakhpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1571, 'Guna', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1572, 'Hanumangarh', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1573, 'Harda', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1574, 'Harsawa', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1575, 'Hastinapur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1576, 'Hathras', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1579, 'Jagadhri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1580, 'Jais', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1581, 'Jaitaran', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1582, 'Jalgaon', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1583, 'Jalore', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1584, 'Jhabua', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1585, 'Jhalawar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1586, 'Jhunjhunu', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1588, 'Junnar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1589, 'Kailaras', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1590, 'Kalburgi', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1591, 'Kalimpong', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1592, 'Kamthi', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1593, 'Kanpur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1594, 'Karad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1595, 'Keylong', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1596, 'Kheri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1598, 'Khurai', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1600, 'Kodad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1601, 'Konnagar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1602, 'Krishnanagar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1603, 'Kuchinda', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1605, 'Madhyamgram', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1606, 'Mahabaleswar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1608, 'Mahoba', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1609, 'Mahwa', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1614, 'Manesar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1615, 'Mangalagiri', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1616, 'Mira-Bhayandar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1617, 'Mirzapur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1618, 'Mithapur', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1619, 'Mohania', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1620, 'Mokama', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1621, 'Moradabad', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1622, 'Mukatsar', 0, 0, 1, 0, '0000-00-00 00:00:00', 0),
(1623, 'Nagalapuram', 0, 0, 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_client`
--

DROP TABLE IF EXISTS `cms_client`;
CREATE TABLE IF NOT EXISTS `cms_client` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of this table',
  `company_name` varchar(255) NOT NULL,
  `main_location` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `primary_phone` varchar(55) NOT NULL COMMENT 'Phone Number',
  `secondary_phone` varchar(55) NOT NULL COMMENT 'Phone Number',
  `fax` varchar(55) NOT NULL COMMENT 'Fax Number',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL',
  `note` text NOT NULL COMMENT 'Profile note',
  `case_policies` text NOT NULL COMMENT 'Case Policies',
  `invoice_policies` text NOT NULL COMMENT 'Invoice Policies',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_client`
--

INSERT INTO `cms_client` (`id`, `company_name`, `main_location`, `address`, `street`, `city`, `zip`, `state`, `country`, `email`, `primary_phone`, `secondary_phone`, `fax`, `web_url`, `note`, `case_policies`, `invoice_policies`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 'first company', 'first company', 'first company', 'first company', 0, '', 0, 0, 'patelalicen@gmail.com', 'first company', 'first company', 'first company', '', 'first company', 'first company', 'first company', '2014-07-15 03:58:10', 1, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 'second company', 'second company', 'second company', 'second company', 0, '', 0, 0, 'second@company.com', 'second company', 'second company', 'second company', '', 'second company', 'second company', 'second company', '2014-07-15 16:33:18', 1, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_clip_information`
--

DROP TABLE IF EXISTS `cms_clip_information`;
CREATE TABLE IF NOT EXISTS `cms_clip_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `air_date` datetime NOT NULL COMMENT 'Published Date',
  `online_view_count` int(11) NOT NULL COMMENT 'Online Views[Count]',
  `duration` varchar(100) NOT NULL COMMENT 'Duration Format [Hours/Minutes/Seconds]',
  `clip_content_desc` text NOT NULL COMMENT 'Clip/Video Content Description',
  `clip_notes` varchar(100) NOT NULL COMMENT 'Last name of Author Information',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_clip_information`
--

INSERT INTO `cms_clip_information` (`id`, `case_id`, `box_url`, `air_date`, `online_view_count`, `duration`, `clip_content_desc`, `clip_notes`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 4, '4', '2014-06-04 12:00:00', 4, '4', '4', '4', '2014-06-16 14:17:33', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 4, '5', '2014-06-05 12:00:00', 5, '5', '5', '5', '2014-06-16 14:23:35', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 4, '6', '2014-06-06 12:00:00', 6, '6', '6', '6', '2014-06-16 14:23:35', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_cms`
--

DROP TABLE IF EXISTS `cms_cms`;
CREATE TABLE IF NOT EXISTS `cms_cms` (
  `cms_id` int(11) NOT NULL AUTO_INCREMENT,
  `cms_title` varchar(100) DEFAULT NULL,
  `cms_sub_title` varchar(255) NOT NULL,
  `seo_url` varchar(255) NOT NULL COMMENT 'For SEO friendly url',
  `ext_url` varchar(255) NOT NULL COMMENT 'External site url for front menu',
  `parent` int(11) NOT NULL DEFAULT '0' COMMENT 'CMS Id: FK #__cms.cms_id',
  `link_to_cms` int(11) NOT NULL DEFAULT '0' COMMENT 'CMS Id: FK #__cms.cms_id',
  `cms_content` text,
  `meta_title` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(500) DEFAULT NULL,
  `meta_keywords` varchar(300) DEFAULT NULL,
  `front_menu` char(1) NOT NULL DEFAULT 'y' COMMENT 'Display in front menu: y=display, n=not display',
  `cms_active` char(1) DEFAULT 'y',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cms_id`),
  KEY `ind_cms_title` (`cms_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_contact_person`
--

DROP TABLE IF EXISTS `cms_contact_person`;
CREATE TABLE IF NOT EXISTS `cms_contact_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of this table',
  `client_id` int(11) NOT NULL COMMENT 'Company Name',
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `office_phone` varchar(55) NOT NULL COMMENT 'Phone Number',
  `mobile` varchar(55) NOT NULL COMMENT 'mobile Number',
  `fax` varchar(55) NOT NULL COMMENT 'Fax Number',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_contact_person`
--

INSERT INTO `cms_contact_person` (`id`, `client_id`, `full_name`, `email`, `office_phone`, `mobile`, `fax`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 0, 'test', 'test@test.com', '09876555678', '9877863', '', '2014-07-15 15:44:35', 1, '2014-08-04 22:56:29', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 0, 'first', 'first@test.com', '32145697', '', '', '2014-08-04 22:56:18', 1, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_country`
--

DROP TABLE IF EXISTS `cms_country`;
CREATE TABLE IF NOT EXISTS `cms_country` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `country_code` char(2) NOT NULL DEFAULT '',
  `country_name` varchar(45) NOT NULL DEFAULT '',
  `currency_code` char(3) DEFAULT NULL,
  `iso_numeric` char(4) DEFAULT NULL,
  `capital` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `cms_country`
--

INSERT INTO `cms_country` (`id`, `country_code`, `country_name`, `currency_code`, `iso_numeric`, `capital`) VALUES
(1, 'AD', 'Andorra', 'EUR', '020', 'Andorra la Vella'),
(2, 'AE', 'United Arab Emirates', 'AED', '784', 'Abu Dhabi'),
(3, 'AF', 'Afghanistan', 'AFN', '004', 'Kabul'),
(4, 'AG', 'Antigua and Barbuda', 'XCD', '028', 'St. John''s'),
(5, 'AI', 'Anguilla', 'XCD', '660', 'The Valley'),
(6, 'AL', 'Albania', 'ALL', '008', 'Tirana'),
(7, 'AM', 'Armenia', 'AMD', '051', 'Yerevan'),
(8, 'AO', 'Angola', 'AOA', '024', 'Luanda'),
(9, 'AQ', 'Antarctica', '', '010', ''),
(10, 'AR', 'Argentina', 'ARS', '032', 'Buenos Aires'),
(11, 'AS', 'American Samoa', 'USD', '016', 'Pago Pago'),
(12, 'AT', 'Austria', 'EUR', '040', 'Vienna'),
(13, 'AU', 'Australia', 'AUD', '036', 'Canberra'),
(14, 'AW', 'Aruba', 'AWG', '533', 'Oranjestad'),
(15, 'AX', '?land', 'EUR', '248', 'Mariehamn'),
(16, 'AZ', 'Azerbaijan', 'AZN', '031', 'Baku'),
(17, 'BA', 'Bosnia and Herzegovina', 'BAM', '070', 'Sarajevo'),
(18, 'BB', 'Barbados', 'BBD', '052', 'Bridgetown'),
(19, 'BD', 'Bangladesh', 'BDT', '050', 'Dhaka'),
(20, 'BE', 'Belgium', 'EUR', '056', 'Brussels'),
(21, 'BF', 'Burkina Faso', 'XOF', '854', 'Ouagadougou'),
(22, 'BG', 'Bulgaria', 'BGN', '100', 'Sofia'),
(23, 'BH', 'Bahrain', 'BHD', '048', 'Manama'),
(24, 'BI', 'Burundi', 'BIF', '108', 'Bujumbura'),
(25, 'BJ', 'Benin', 'XOF', '204', 'Porto-Novo'),
(26, 'BL', 'Saint Barth?lemy', 'EUR', '652', 'Gustavia'),
(27, 'BM', 'Bermuda', 'BMD', '060', 'Hamilton'),
(28, 'BN', 'Brunei', 'BND', '096', 'Bandar Seri Begawan'),
(29, 'BO', 'Bolivia', 'BOB', '068', 'Sucre'),
(30, 'BQ', 'Bonaire', 'USD', '535', ''),
(31, 'BR', 'Brazil', 'BRL', '076', 'Bras?lia'),
(32, 'BS', 'Bahamas', 'BSD', '044', 'Nassau'),
(33, 'BT', 'Bhutan', 'BTN', '064', 'Thimphu'),
(34, 'BV', 'Bouvet Island', 'NOK', '074', ''),
(35, 'BW', 'Botswana', 'BWP', '072', 'Gaborone'),
(36, 'BY', 'Belarus', 'BYR', '112', 'Minsk'),
(37, 'BZ', 'Belize', 'BZD', '084', 'Belmopan'),
(38, 'CA', 'Canada', 'CAD', '124', 'Ottawa'),
(39, 'CC', 'Cocos [Keeling] Islands', 'AUD', '166', 'West Island'),
(40, 'CD', 'Democratic Republic of the Congo', 'CDF', '180', 'Kinshasa'),
(41, 'CF', 'Central African Republic', 'XAF', '140', 'Bangui'),
(42, 'CG', 'Republic of the Congo', 'XAF', '178', 'Brazzaville'),
(43, 'CH', 'Switzerland', 'CHF', '756', 'Berne'),
(44, 'CI', 'Ivory Coast', 'XOF', '384', 'Yamoussoukro'),
(45, 'CK', 'Cook Islands', 'NZD', '184', 'Avarua'),
(46, 'CL', 'Chile', 'CLP', '152', 'Santiago'),
(47, 'CM', 'Cameroon', 'XAF', '120', 'Yaound'),
(48, 'CN', 'China', 'CNY', '156', 'Beijing'),
(49, 'CO', 'Colombia', 'COP', '170', 'Bogot'),
(50, 'CR', 'Costa Rica', 'CRC', '188', 'San Jos'),
(51, 'CU', 'Cuba', 'CUP', '192', 'Havana'),
(52, 'CV', 'Cape Verde', 'CVE', '132', 'Praia'),
(53, 'CW', 'Curacao', 'ANG', '531', 'Willemstad'),
(54, 'CX', 'Christmas Island', 'AUD', '162', 'The Settlement'),
(55, 'CY', 'Cyprus', 'EUR', '196', 'Nicosia'),
(56, 'CZ', 'Czechia', 'CZK', '203', 'Prague'),
(57, 'DE', 'Germany', 'EUR', '276', 'Berlin'),
(58, 'DJ', 'Djibouti', 'DJF', '262', 'Djibouti'),
(59, 'DK', 'Denmark', 'DKK', '208', 'Copenhagen'),
(60, 'DM', 'Dominica', 'XCD', '212', 'Roseau'),
(61, 'DO', 'Dominican Republic', 'DOP', '214', 'Santo Domingo'),
(62, 'DZ', 'Algeria', 'DZD', '012', 'Algiers'),
(63, 'EC', 'Ecuador', 'USD', '218', 'Quito'),
(64, 'EE', 'Estonia', 'EUR', '233', 'Tallinn'),
(65, 'EG', 'Egypt', 'EGP', '818', 'Cairo'),
(66, 'EH', 'Western Sahara', 'MAD', '732', 'El Aai?n'),
(67, 'ER', 'Eritrea', 'ERN', '232', 'Asmara'),
(68, 'ES', 'Spain', 'EUR', '724', 'Madrid'),
(69, 'ET', 'Ethiopia', 'ETB', '231', 'Addis Ababa'),
(70, 'FI', 'Finland', 'EUR', '246', 'Helsinki'),
(71, 'FJ', 'Fiji', 'FJD', '242', 'Suva'),
(72, 'FK', 'Falkland Islands', 'FKP', '238', 'Stanley'),
(73, 'FM', 'Micronesia', 'USD', '583', 'Palikir'),
(74, 'FO', 'Faroe Islands', 'DKK', '234', 'T?rshavn'),
(75, 'FR', 'France', 'EUR', '250', 'Paris'),
(76, 'GA', 'Gabon', 'XAF', '266', 'Libreville'),
(77, 'GB', 'United Kingdom', 'GBP', '826', 'London'),
(78, 'GD', 'Grenada', 'XCD', '308', 'St. George''s'),
(79, 'GE', 'Georgia', 'GEL', '268', 'Tbilisi'),
(80, 'GF', 'French Guiana', 'EUR', '254', 'Cayenne'),
(81, 'GG', 'Guernsey', 'GBP', '831', 'St Peter Port'),
(82, 'GH', 'Ghana', 'GHS', '288', 'Accra'),
(83, 'GI', 'Gibraltar', 'GIP', '292', 'Gibraltar'),
(84, 'GL', 'Greenland', 'DKK', '304', 'Nuuk'),
(85, 'GM', 'Gambia', 'GMD', '270', 'Banjul'),
(86, 'GN', 'Guinea', 'GNF', '324', 'Conakry'),
(87, 'GP', 'Guadeloupe', 'EUR', '312', 'Basse-Terre'),
(88, 'GQ', 'Equatorial Guinea', 'XAF', '226', 'Malabo'),
(89, 'GR', 'Greece', 'EUR', '300', 'Athens'),
(90, 'GS', 'South Georgia and the South Sandwich Islands', 'GBP', '239', 'Grytviken'),
(91, 'GT', 'Guatemala', 'GTQ', '320', 'Guatemala City'),
(92, 'GU', 'Guam', 'USD', '316', 'Hag?t?a'),
(93, 'GW', 'Guinea-Bissau', 'XOF', '624', 'Bissau'),
(94, 'GY', 'Guyana', 'GYD', '328', 'Georgetown'),
(95, 'HK', 'Hong Kong', 'HKD', '344', 'Hong Kong'),
(96, 'HM', 'Heard Island and McDonald Islands', 'AUD', '334', ''),
(97, 'HN', 'Honduras', 'HNL', '340', 'Tegucigalpa'),
(98, 'HR', 'Croatia', 'HRK', '191', 'Zagreb'),
(99, 'HT', 'Haiti', 'HTG', '332', 'Port-au-Prince'),
(100, 'HU', 'Hungary', 'HUF', '348', 'Budapest'),
(101, 'ID', 'Indonesia', 'IDR', '360', 'Jakarta'),
(102, 'IE', 'Ireland', 'EUR', '372', 'Dublin'),
(103, 'IL', 'Israel', 'ILS', '376', ''),
(104, 'IM', 'Isle of Man', 'GBP', '833', 'Douglas'),
(105, 'IN', 'India', 'INR', '356', 'New Delhi'),
(106, 'IO', 'British Indian Ocean Territory', 'USD', '086', ''),
(107, 'IQ', 'Iraq', 'IQD', '368', 'Baghdad'),
(108, 'IR', 'Iran', 'IRR', '364', 'Tehran'),
(109, 'IS', 'Iceland', 'ISK', '352', 'Reykjavik'),
(110, 'IT', 'Italy', 'EUR', '380', 'Rome'),
(111, 'JE', 'Jersey', 'GBP', '832', 'Saint Helier'),
(112, 'JM', 'Jamaica', 'JMD', '388', 'Kingston'),
(113, 'JO', 'Jordan', 'JOD', '400', 'Amman'),
(114, 'JP', 'Japan', 'JPY', '392', 'Tokyo'),
(115, 'KE', 'Kenya', 'KES', '404', 'Nairobi'),
(116, 'KG', 'Kyrgyzstan', 'KGS', '417', 'Bishkek'),
(117, 'KH', 'Cambodia', 'KHR', '116', 'Phnom Penh'),
(118, 'KI', 'Kiribati', 'AUD', '296', 'Tarawa'),
(119, 'KM', 'Comoros', 'KMF', '174', 'Moroni'),
(120, 'KN', 'Saint Kitts and Nevis', 'XCD', '659', 'Basseterre'),
(121, 'KP', 'North Korea', 'KPW', '408', 'Pyongyang'),
(122, 'KR', 'South Korea', 'KRW', '410', 'Seoul'),
(123, 'KW', 'Kuwait', 'KWD', '414', 'Kuwait City'),
(124, 'KY', 'Cayman Islands', 'KYD', '136', 'George Town'),
(125, 'KZ', 'Kazakhstan', 'KZT', '398', 'Astana'),
(126, 'LA', 'Laos', 'LAK', '418', 'Vientiane'),
(127, 'LB', 'Lebanon', 'LBP', '422', 'Beirut'),
(128, 'LC', 'Saint Lucia', 'XCD', '662', 'Castries'),
(129, 'LI', 'Liechtenstein', 'CHF', '438', 'Vaduz'),
(130, 'LK', 'Sri Lanka', 'LKR', '144', 'Colombo'),
(131, 'LR', 'Liberia', 'LRD', '430', 'Monrovia'),
(132, 'LS', 'Lesotho', 'LSL', '426', 'Maseru'),
(133, 'LT', 'Lithuania', 'LTL', '440', 'Vilnius'),
(134, 'LU', 'Luxembourg', 'EUR', '442', 'Luxembourg'),
(135, 'LV', 'Latvia', 'LVL', '428', 'Riga'),
(136, 'LY', 'Libya', 'LYD', '434', 'Tripoli'),
(137, 'MA', 'Morocco', 'MAD', '504', 'Rabat'),
(138, 'MC', 'Monaco', 'EUR', '492', 'Monaco'),
(139, 'MD', 'Moldova', 'MDL', '498', 'Chisinau'),
(140, 'ME', 'Montenegro', 'EUR', '499', 'Podgorica'),
(141, 'MF', 'Saint Martin', 'EUR', '663', 'Marigot'),
(142, 'MG', 'Madagascar', 'MGA', '450', 'Antananarivo'),
(143, 'MH', 'Marshall Islands', 'USD', '584', 'Majuro'),
(144, 'MK', 'Macedonia', 'MKD', '807', 'Skopje'),
(145, 'ML', 'Mali', 'XOF', '466', 'Bamako'),
(146, 'MM', 'Myanmar [Burma]', 'MMK', '104', 'Nay Pyi Taw'),
(147, 'MN', 'Mongolia', 'MNT', '496', 'Ulan Bator'),
(148, 'MO', 'Macao', 'MOP', '446', 'Macao'),
(149, 'MP', 'Northern Mariana Islands', 'USD', '580', 'Saipan'),
(150, 'MQ', 'Martinique', 'EUR', '474', 'Fort-de-France'),
(151, 'MR', 'Mauritania', 'MRO', '478', 'Nouakchott'),
(152, 'MS', 'Montserrat', 'XCD', '500', 'Plymouth'),
(153, 'MT', 'Malta', 'EUR', '470', 'Valletta'),
(154, 'MU', 'Mauritius', 'MUR', '480', 'Port Louis'),
(155, 'MV', 'Maldives', 'MVR', '462', 'Mal'),
(156, 'MW', 'Malawi', 'MWK', '454', 'Lilongwe'),
(157, 'MX', 'Mexico', 'MXN', '484', 'Mexico City'),
(158, 'MY', 'Malaysia', 'MYR', '458', 'Kuala Lumpur'),
(159, 'MZ', 'Mozambique', 'MZN', '508', 'Maputo'),
(160, 'NA', 'Namibia', 'NAD', '516', 'Windhoek'),
(161, 'NC', 'New Caledonia', 'XPF', '540', 'Noumea'),
(162, 'NE', 'Niger', 'XOF', '562', 'Niamey'),
(163, 'NF', 'Norfolk Island', 'AUD', '574', 'Kingston'),
(164, 'NG', 'Nigeria', 'NGN', '566', 'Abuja'),
(165, 'NI', 'Nicaragua', 'NIO', '558', 'Managua'),
(166, 'NL', 'Netherlands', 'EUR', '528', 'Amsterdam'),
(167, 'NO', 'Norway', 'NOK', '578', 'Oslo'),
(168, 'NP', 'Nepal', 'NPR', '524', 'Kathmandu'),
(169, 'NR', 'Nauru', 'AUD', '520', ''),
(170, 'NU', 'Niue', 'NZD', '570', 'Alofi'),
(171, 'NZ', 'New Zealand', 'NZD', '554', 'Wellington'),
(172, 'OM', 'Oman', 'OMR', '512', 'Muscat'),
(173, 'PA', 'Panama', 'PAB', '591', 'Panama City'),
(174, 'PE', 'Peru', 'PEN', '604', 'Lima'),
(175, 'PF', 'French Polynesia', 'XPF', '258', 'Papeete'),
(176, 'PG', 'Papua New Guinea', 'PGK', '598', 'Port Moresby'),
(177, 'PH', 'Philippines', 'PHP', '608', 'Manila'),
(178, 'PK', 'Pakistan', 'PKR', '586', 'Islamabad'),
(179, 'PL', 'Poland', 'PLN', '616', 'Warsaw'),
(180, 'PM', 'Saint Pierre and Miquelon', 'EUR', '666', 'Saint-Pierre'),
(181, 'PN', 'Pitcairn Islands', 'NZD', '612', 'Adamstown'),
(182, 'PR', 'Puerto Rico', 'USD', '630', 'San Juan'),
(183, 'PS', 'Palestine', 'ILS', '275', ''),
(184, 'PT', 'Portugal', 'EUR', '620', 'Lisbon'),
(185, 'PW', 'Palau', 'USD', '585', 'Melekeok - Palau State Capital'),
(186, 'PY', 'Paraguay', 'PYG', '600', 'Asunci?n'),
(187, 'QA', 'Qatar', 'QAR', '634', 'Doha'),
(188, 'RE', 'R?union', 'EUR', '638', 'Saint-Denis'),
(189, 'RO', 'Romania', 'RON', '642', 'Bucharest'),
(190, 'RS', 'Serbia', 'RSD', '688', 'Belgrade'),
(191, 'RU', 'Russia', 'RUB', '643', 'Moscow'),
(192, 'RW', 'Rwanda', 'RWF', '646', 'Kigali'),
(193, 'SA', 'Saudi Arabia', 'SAR', '682', 'Riyadh'),
(194, 'SB', 'Solomon Islands', 'SBD', '090', 'Honiara'),
(195, 'SC', 'Seychelles', 'SCR', '690', 'Victoria'),
(196, 'SD', 'Sudan', 'SDG', '729', 'Khartoum'),
(197, 'SE', 'Sweden', 'SEK', '752', 'Stockholm'),
(198, 'SG', 'Singapore', 'SGD', '702', 'Singapore'),
(199, 'SH', 'Saint Helena', 'SHP', '654', 'Jamestown'),
(200, 'SI', 'Slovenia', 'EUR', '705', 'Ljubljana'),
(201, 'SJ', 'Svalbard and Jan Mayen', 'NOK', '744', 'Longyearbyen'),
(202, 'SK', 'Slovakia', 'EUR', '703', 'Bratislava'),
(203, 'SL', 'Sierra Leone', 'SLL', '694', 'Freetown'),
(204, 'SM', 'San Marino', 'EUR', '674', 'San Marino'),
(205, 'SN', 'Senegal', 'XOF', '686', 'Dakar'),
(206, 'SO', 'Somalia', 'SOS', '706', 'Mogadishu'),
(207, 'SR', 'Suriname', 'SRD', '740', 'Paramaribo'),
(208, 'SS', 'South Sudan', 'SSP', '728', 'Juba'),
(209, 'ST', 'S?o Tom? and Pr?ncipe', 'STD', '678', 'S?o Tom'),
(210, 'SV', 'El Salvador', 'USD', '222', 'San Salvador'),
(211, 'SX', 'Sint Maarten', 'ANG', '534', 'Philipsburg'),
(212, 'SY', 'Syria', 'SYP', '760', 'Damascus'),
(213, 'SZ', 'Swaziland', 'SZL', '748', 'Mbabane'),
(214, 'TC', 'Turks and Caicos Islands', 'USD', '796', 'Cockburn Town'),
(215, 'TD', 'Chad', 'XAF', '148', 'N''Djamena'),
(216, 'TF', 'French Southern Territories', 'EUR', '260', 'Port-aux-Fran?ais'),
(217, 'TG', 'Togo', 'XOF', '768', 'Lom'),
(218, 'TH', 'Thailand', 'THB', '764', 'Bangkok'),
(219, 'TJ', 'Tajikistan', 'TJS', '762', 'Dushanbe'),
(220, 'TK', 'Tokelau', 'NZD', '772', ''),
(221, 'TL', 'East Timor', 'USD', '626', 'Dili'),
(222, 'TM', 'Turkmenistan', 'TMT', '795', 'Ashgabat'),
(223, 'TN', 'Tunisia', 'TND', '788', 'Tunis'),
(224, 'TO', 'Tonga', 'TOP', '776', 'Nuku''alofa'),
(225, 'TR', 'Turkey', 'TRY', '792', 'Ankara'),
(226, 'TT', 'Trinidad and Tobago', 'TTD', '780', 'Port of Spain'),
(227, 'TV', 'Tuvalu', 'AUD', '798', 'Funafuti'),
(228, 'TW', 'Taiwan', 'TWD', '158', 'Taipei'),
(229, 'TZ', 'Tanzania', 'TZS', '834', 'Dodoma'),
(230, 'UA', 'Ukraine', 'UAH', '804', 'Kyiv'),
(231, 'UG', 'Uganda', 'UGX', '800', 'Kampala'),
(232, 'UM', 'U.S. Minor Outlying Islands', 'USD', '581', ''),
(233, 'US', 'United States', 'USD', '840', 'Washington'),
(234, 'UY', 'Uruguay', 'UYU', '858', 'Montevideo'),
(235, 'UZ', 'Uzbekistan', 'UZS', '860', 'Tashkent'),
(236, 'VA', 'Vatican City', 'EUR', '336', 'Vatican'),
(237, 'VC', 'Saint Vincent and the Grenadines', 'XCD', '670', 'Kingstown'),
(238, 'VE', 'Venezuela', 'VEF', '862', 'Caracas'),
(239, 'VG', 'British Virgin Islands', 'USD', '092', 'Road Town'),
(240, 'VI', 'U.S. Virgin Islands', 'USD', '850', 'Charlotte Amalie'),
(241, 'VN', 'Vietnam', 'VND', '704', 'Hanoi'),
(242, 'VU', 'Vanuatu', 'VUV', '548', 'Port Vila'),
(243, 'WF', 'Wallis and Futuna', 'XPF', '876', 'Mata-Utu'),
(244, 'WS', 'Samoa', 'WST', '882', 'Apia'),
(245, 'XK', 'Kosovo', 'EUR', '0', 'Pristina'),
(246, 'YE', 'Yemen', 'YER', '887', 'Sanaa'),
(247, 'YT', 'Mayotte', 'EUR', '175', 'Mamoutzou'),
(248, 'ZA', 'South Africa', 'ZAR', '710', 'Pretoria'),
(249, 'ZM', 'Zambia', 'ZMK', '894', 'Lusaka'),
(250, 'ZW', 'Zimbabwe', 'ZWL', '716', 'Harare');

-- --------------------------------------------------------

--
-- Table structure for table `cms_criminal_traffic`
--

DROP TABLE IF EXISTS `cms_criminal_traffic`;
CREATE TABLE IF NOT EXISTS `cms_criminal_traffic` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `parent_id` int(11) NOT NULL COMMENT 'PK of criminal_traffic.id',
  `case_no` varchar(100) NOT NULL COMMENT 'Case No.',
  `offense_date` datetime NOT NULL COMMENT 'Offense Date',
  `category` int(11) NOT NULL COMMENT 'Category id (PK category.id)',
  `offense_code` varchar(255) NOT NULL COMMENT 'Offense Code',
  `offense_dcescription` text NOT NULL COMMENT 'Offense Description',
  `court` varchar(255) NOT NULL COMMENT 'Court',
  `arresting_agency` varchar(255) NOT NULL,
  `admitted_date` datetime NOT NULL COMMENT 'Admitted Date',
  `release_date` datetime NOT NULL COMMENT 'Release Date',
  `time_served` varchar(25) NOT NULL COMMENT 'Time Served',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_criminal_traffic`
--

INSERT INTO `cms_criminal_traffic` (`id`, `pi_id`, `parent_id`, `case_no`, `offense_date`, `category`, `offense_code`, `offense_dcescription`, `court`, `arresting_agency`, `admitted_date`, `release_date`, `time_served`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 2, 0, '1', '1970-01-01 12:00:00', 0, '1', 'dfsafdsafd', 'jklj', 'klkl', '2014-06-04 12:00:00', '2014-06-25 12:00:00', 'jkl', '1', '2014-06-15 15:51:47', 3, '2014-06-16 14:52:52', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 2, 0, '2', '1970-01-01 12:00:00', 0, '2', '222222222', '2', '2', '2014-06-04 12:00:00', '2014-06-04 12:00:00', '2', '2', '2014-06-15 15:51:47', 3, '2014-06-16 14:52:52', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 2, 0, '3', '1970-01-01 12:00:00', 0, '3', '3', '3', '3', '2014-06-04 12:00:00', '2014-06-04 12:00:00', '3', '3', '2014-06-15 15:51:47', 3, '2014-06-16 14:52:52', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 3, 0, '', '2014-06-01 12:00:00', 0, 'test', 'test', 't', 'test', '2014-06-01 12:00:00', '2014-11-01 12:00:00', '5 month', 'www.google.com', '2014-06-28 20:59:39', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 3, 0, '', '2014-06-02 12:00:00', 0, 'yyyuuu', 'This is test record # 2', 't', 'test', '2014-06-02 12:00:00', '2014-08-02 12:00:00', '2 month', 'test', '2014-06-28 22:16:55', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_emails`
--

DROP TABLE IF EXISTS `cms_emails`;
CREATE TABLE IF NOT EXISTS `cms_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cms_emails`
--

INSERT INTO `cms_emails` (`id`, `pi_id`, `email`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 0, 'email1@test.com', 'yahoo.com', '2014-06-14 22:33:42', 3, '2014-06-15 12:53:04', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 0, 'email3@test.com', 'yahoo.com', '2014-06-14 22:33:42', 3, '2014-06-15 12:53:04', 3, 'yes', '2014-06-15 12:41:19', 3, 0, 'active'),
(3, 0, 'email4@test.com', 'yahoo.com', '2014-06-14 22:33:43', 3, '2014-06-15 12:53:04', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 0, 'email4@test.com', 'yahoo.com', '2014-06-14 22:33:43', 3, '2014-06-15 12:56:00', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 0, '', '', '2014-06-15 13:02:27', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, 0, '', '', '2014-06-15 13:03:10', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(7, 2, 'test1.com', 'test1.com', '2014-06-15 13:18:32', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(8, 2, 'test2.com', 'test2.com', '2014-06-15 15:09:32', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(9, 2, 'test3.com', 'test3.com', '2014-06-15 15:09:32', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_investigated_newspaper`
--

DROP TABLE IF EXISTS `cms_investigated_newspaper`;
CREATE TABLE IF NOT EXISTS `cms_investigated_newspaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `name` varchar(100) NOT NULL COMMENT 'Name of newspaper',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `newspaper` varchar(255) NOT NULL COMMENT 'Newspaper',
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_investigated_tv_channel`
--

DROP TABLE IF EXISTS `cms_investigated_tv_channel`;
CREATE TABLE IF NOT EXISTS `cms_investigated_tv_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `name` varchar(100) NOT NULL COMMENT 'Name of channel',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `newspaper` varchar(255) NOT NULL COMMENT 'Newspaper',
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_investigated_tv_channel`
--

INSERT INTO `cms_investigated_tv_channel` (`id`, `case_id`, `name`, `url`, `newspaper`, `street`, `city`, `zip`, `state`, `country`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 4, '1', '1', '1', '1', 494, '1', 1, 3, '2014-06-16 14:17:33', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 4, '2', '2', '2', '2', 1302, '2', 3, 6, '2014-06-16 14:17:33', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 4, '3', '3', '3', '3', 417, '3', 2, 62, '2014-06-16 14:17:33', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_investigation_case`
--

DROP TABLE IF EXISTS `cms_investigation_case`;
CREATE TABLE IF NOT EXISTS `cms_investigation_case` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `client` varchar(255) NOT NULL,
  `person_investigated` varchar(255) NOT NULL COMMENT 'Full name of Person Investigated',
  `client_matter_number` varchar(100) NOT NULL,
  `doi` date NOT NULL COMMENT 'Date of investigation',
  `report_date` date NOT NULL COMMENT 'Date of report created',
  `carrier` varchar(255) NOT NULL,
  `toonari_client` varchar(255) NOT NULL,
  `note` text NOT NULL COMMENT 'General note about persion and investigation case',
  `priority` enum('Normal','High','Low') NOT NULL DEFAULT 'Normal',
  `estimated_completion_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `case_type` varchar(255) NOT NULL,
  `assing_to` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `salesperson_affiliate` varchar(255) NOT NULL,
  `end_client` varchar(255) NOT NULL,
  `budget` float NOT NULL,
  `hours` float NOT NULL,
  `hourly_rate` float NOT NULL,
  `person_investigated_fname` varchar(255) NOT NULL,
  `person_investigated_mname` varchar(255) NOT NULL,
  `person_investigated_lname` varchar(255) NOT NULL,
  `clientnote` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `zip` varchar(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `dob` datetime NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `build` varchar(255) NOT NULL,
  `other_characteristics` varchar(255) NOT NULL,
  `cell_phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `myspace` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Record Created Date Insert date when data inseted',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record updated Date Insert/Update date when data updated',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Data is deleted or not',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted Date deleted date when is_deleted updated to yes',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive','','') NOT NULL DEFAULT 'active' COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `cms_investigation_case`
--

INSERT INTO `cms_investigation_case` (`id`, `client`, `person_investigated`, `client_matter_number`, `doi`, `report_date`, `carrier`, `toonari_client`, `note`, `priority`, `estimated_completion_date`, `client_id`, `case_type`, `assing_to`, `created_on`, `due_date`, `salesperson_affiliate`, `end_client`, `budget`, `hours`, `hourly_rate`, `person_investigated_fname`, `person_investigated_mname`, `person_investigated_lname`, `clientnote`, `address`, `street`, `city`, `state`, `zip`, `sex`, `dob`, `height`, `weight`, `build`, `other_characteristics`, `cell_phone`, `email`, `facebook`, `twitter`, `myspace`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 'John Stewart, Bluebird LLC', 'Alice 2', '20093', '2002-02-21', '2003-01-02', '21st Century Insurance Inc', 'Brown & Company, L.L.P.', 'This is thest', 'High', '2014-01-02', 1, '', 2, '2003-01-02 12:00:00', '2006-04-05 12:00:00', 'Percentage', 'test end client', 100, 200, 300, 'test f', 'test m', 'test l', 'tesaet', 'test', 'atesat', 1303, 0, '35768', '0', '0000-00-00 00:00:00', '5', '6', '456', 'this is sad fsda', '98764553121', 'patel@paetl.com', 'asdfsadfsf', 'sdfasf', 'sdfa', '2014-05-11 18:36:23', 1, '2014-08-03 18:29:13', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, '', 'Alice 1', '', '2014-05-03', '2014-05-10', '', '', '<p>Sort investigation</p>', 'Normal', '0000-00-00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-05-11 19:06:40', 1, '2014-05-11 19:09:10', 1, 'yes', '2014-05-11 19:09:29', 1, 0, 'active'),
(3, '', 'Parag', '', '2014-05-20', '2014-05-28', '', '', '<p>This is information about parag </p>', 'Normal', '0000-00-00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-05-25 15:52:22', 2, '2014-06-06 00:51:43', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, '', 'vipul', '', '2014-05-20', '2014-05-30', '', '', '<p>thsi sia fsdklajlskf lsk</p>\r\n<p>sakfjdklsajf kljsklfjlkasjfaf</p>\r\n<p>cb bd</p>', 'Normal', '0000-00-00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-05-25 15:52:50', 2, '2014-06-06 00:51:43', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, '', 'xyz', '', '2014-06-12', '2014-06-24', '', '', '<p>in tst</p>', 'Normal', '0000-00-00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-06-16 14:46:20', 2, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, '', 't', '', '2014-06-04', '2014-06-11', '', '', '<p>t</p>', 'Normal', '0000-00-00', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-06-16 14:47:32', 2, '0000-00-00 00:00:00', 0, 'yes', '2014-06-16 14:48:30', 2, 0, 'active'),
(7, 'John Stewart, Bluebird LLC', 'Steven Matthewt', '20093', '2013-09-05', '2014-01-02', '21st Century Insurance Inc', 'Brown & Company, L.L.P.', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and  typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy  text ever since the 1500s, when an unknown printer took a galley of  type and scrambled it to make a type specimen book. It has survived not  only five centuries, but also the leap into electronic typesetting,  remaining essentially unchanged. It was popularised in the 1960s with  the release of Letraset sheets containing Lorem Ipsum passages, and more  recently with desktop publishing software like Aldus PageMaker  including versions of Lorem Ipsum.</p>', 'High', '2014-01-02', 0, '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, 0, 0, '', '', '', '', '', '', 0, 0, '0', '', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '2014-06-18 00:14:34', 1, '2014-06-18 00:14:57', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_license`
--

DROP TABLE IF EXISTS `cms_license`;
CREATE TABLE IF NOT EXISTS `cms_license` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of this table',
  `employee_id` int(11) NOT NULL COMMENT 'Employee ID (PK user.user_id)',
  `private_investigator` varchar(255) NOT NULL,
  `expiration_date` datetime NOT NULL COMMENT 'License expiration created date',
  `valid_region` varchar(55) NOT NULL COMMENT 'Phone Number',
  `license_number` varchar(55) NOT NULL COMMENT 'license_number Number',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_license`
--

INSERT INTO `cms_license` (`id`, `employee_id`, `private_investigator`, `expiration_date`, `valid_region`, `license_number`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 3, '', '0000-00-00 00:00:00', '', '46546587', '2014-08-01 14:19:38', 1, '2014-08-01 14:22:23', 1, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 4, '', '0000-00-00 00:00:00', '', '4654658733', '2014-08-01 14:30:20', 1, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_menu`
--

DROP TABLE IF EXISTS `cms_menu`;
CREATE TABLE IF NOT EXISTS `cms_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) DEFAULT NULL,
  `listing_page` varchar(255) DEFAULT NULL,
  `addedit_page` varchar(255) DEFAULT NULL,
  `menu_icon` varchar(255) DEFAULT NULL,
  `menu_order` int(11) DEFAULT '0',
  `menu_active` char(1) DEFAULT 'y',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cms_menu`
--

INSERT INTO `cms_menu` (`menu_id`, `menu_name`, `listing_page`, `addedit_page`, `menu_icon`, `menu_order`, `menu_active`) VALUES
(1, 'User Role', 'user-role-list.php', 'user-role-addedit.php', 'images/icons/user-role.png', 1, 'y'),
(2, 'Menu', 'menu-list.php', 'menu-addedit.php', 'images/icons/menu.png', 2, 'y'),
(3, 'Employee', 'user-list.php', 'user-addedit.php', 'images/icons/user.png', 3, 'y'),
(4, 'User Rights', 'user-rights-list.php', 'user-rights-addedit.php', 'images/icons/user-rights.png', 4, 'y'),
(5, 'CMS', 'cms-list.php', 'cms-addedit.php', 'images/icons/cms.png', 5, 'y'),
(6, 'Site Config', 'site-config.php', 'site-config.php', 'images/icons/siteconfig.png', 99, 'y'),
(7, 'Case', 'case-list.php', 'case-addedit.php', 'images/icons/case.jpg', 6, 'y'),
(8, 'My Case', 'mycase-list.php', 'personal-information-addedit.php,social-media-information-addedit.php,tv-channel-addedit.php,newspaper-addedit.php,sequence-addedit.php', 'images/icons/case.jpg', 7, 'y'),
(9, 'Clients', 'client-list.php', 'client-addedit.php', 'images/icons/client.png', 1, 'y'),
(10, 'Contact Person', 'contact_person-list.php', 'contact_person-addedit.php', 'images/icons/contact_person.png', 0, 'y'),
(11, 'License', 'license-list.php', 'license-addedit.php', 'images/icons/license.png', 6, 'y'),
(12, 'Customize forms', 'tabs-list.php', 'tabs-addedit.php', 'images/icons/tabs.png', 0, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `cms_newspaper`
--

DROP TABLE IF EXISTS `cms_newspaper`;
CREATE TABLE IF NOT EXISTS `cms_newspaper` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `title` varchar(255) NOT NULL COMMENT 'Title of activity',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_personal_info`
--

DROP TABLE IF EXISTS `cms_personal_info`;
CREATE TABLE IF NOT EXISTS `cms_personal_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of investigation.id',
  `fname` varchar(100) NOT NULL COMMENT 'First name of investigated person',
  `mname` varchar(100) NOT NULL COMMENT 'Middle name of investigated person',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of investigated person',
  `dob` date NOT NULL COMMENT 'Date of birth',
  `age_b` int(11) NOT NULL COMMENT 'Age when investigation',
  `web_url_dob` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note_dob` text NOT NULL,
  `dod` date NOT NULL COMMENT 'Date of Death',
  `age_d` int(11) NOT NULL COMMENT 'Age when death',
  `web_url_dod` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note_dod` text NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_personal_info`
--

INSERT INTO `cms_personal_info` (`id`, `case_id`, `fname`, `mname`, `lname`, `dob`, `age_b`, `web_url_dob`, `note_dob`, `dod`, `age_d`, `web_url_dod`, `note_dod`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(2, 4, 'Vipul3', 'm4', 'patel5', '0000-00-00', 8, 'gmail.com', '', '1988-01-08', 9, 'www.fb.com', '', '2014-06-14 22:33:41', 3, '2014-06-18 22:30:08', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 7, 'Vipul2', 'm2', 'patel2', '0000-00-00', 10, 'http://www.google.com', '', '0000-00-00', 0, '', '', '2014-06-18 23:08:16', 3, '2014-08-15 14:00:32', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 7, '', '', '', '0000-00-00', 0, '', '', '0000-00-00', 0, '', '', '2014-08-15 19:37:44', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 7, '', '', '', '0000-00-00', 0, '', '', '0000-00-00', 0, '', '', '2014-08-15 19:45:50', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_person_investigated_favorite_pages`
--

DROP TABLE IF EXISTS `cms_person_investigated_favorite_pages`;
CREATE TABLE IF NOT EXISTS `cms_person_investigated_favorite_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_by_friends_of_person_investigated`
--

DROP TABLE IF EXISTS `cms_photos_by_friends_of_person_investigated`;
CREATE TABLE IF NOT EXISTS `cms_photos_by_friends_of_person_investigated` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_by_friends_of_person_investigated_like`
--

DROP TABLE IF EXISTS `cms_photos_by_friends_of_person_investigated_like`;
CREATE TABLE IF NOT EXISTS `cms_photos_by_friends_of_person_investigated_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_commented_on_by_friends_of_person_investigated`
--

DROP TABLE IF EXISTS `cms_photos_commented_on_by_friends_of_person_investigated`;
CREATE TABLE IF NOT EXISTS `cms_photos_commented_on_by_friends_of_person_investigated` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_commented_on_by_person_investigated`
--

DROP TABLE IF EXISTS `cms_photos_commented_on_by_person_investigated`;
CREATE TABLE IF NOT EXISTS `cms_photos_commented_on_by_person_investigated` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_of_friends_of_person_investigated`
--

DROP TABLE IF EXISTS `cms_photos_of_friends_of_person_investigated`;
CREATE TABLE IF NOT EXISTS `cms_photos_of_friends_of_person_investigated` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_of_person_investigated`
--

DROP TABLE IF EXISTS `cms_photos_of_person_investigated`;
CREATE TABLE IF NOT EXISTS `cms_photos_of_person_investigated` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_photos_person_investigated_like`
--

DROP TABLE IF EXISTS `cms_photos_person_investigated_like`;
CREATE TABLE IF NOT EXISTS `cms_photos_person_investigated_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `is_case_related_activity` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is for Case Related Activity or not',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_pi_dob`
--

DROP TABLE IF EXISTS `cms_pi_dob`;
CREATE TABLE IF NOT EXISTS `cms_pi_dob` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of investigation.id',
  `dob` date NOT NULL COMMENT 'Date of birth',
  `age_b` int(11) NOT NULL COMMENT 'Age when investigation',
  `web_url_dob` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note_dob` text NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_pi_dob`
--

INSERT INTO `cms_pi_dob` (`id`, `pi_id`, `dob`, `age_b`, `web_url_dob`, `note_dob`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 3, '2014-06-01', 9, 'gmail.com', 'This is test', '2014-06-21 23:51:47', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 3, '2014-06-02', 8, 'gmail.com', 'This is test 2', '2014-06-22 00:01:10', 3, '0000-00-00 00:00:00', 0, 'yes', '2014-08-16 22:40:49', 3, 0, 'active'),
(3, 3, '2014-06-07', 77, '777.gmail.com', 'Test 777', '2014-06-22 00:12:46', 3, '2014-06-28 18:10:50', 3, 'yes', '2014-06-28 18:12:44', 3, 0, 'active'),
(4, 3, '2014-06-04', 64, 'gmail.com', 'test 44', '2014-06-22 00:31:30', 3, '2014-06-22 02:01:23', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 2, '2014-06-01', 9, 'gmail.com', 'test 1', '2014-06-25 00:29:16', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pi_dod`
--

DROP TABLE IF EXISTS `cms_pi_dod`;
CREATE TABLE IF NOT EXISTS `cms_pi_dod` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of investigation.id',
  `dod` date NOT NULL COMMENT 'Date of Death',
  `age_d` int(11) NOT NULL COMMENT 'Age when death',
  `web_url_dod` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note_dod` text NOT NULL,
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_pi_dod`
--

INSERT INTO `cms_pi_dod` (`id`, `pi_id`, `dod`, `age_d`, `web_url_dod`, `note_dod`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 3, '2014-06-30', 99, '123', 'test', '2014-06-27 15:11:56', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 3, '2014-06-29', 9, 'google.com', 'test is test', '2014-06-27 15:15:35', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 3, '2014-06-26', 222, 'www.google222.com', 'test is test 111 2222', '2014-06-27 15:16:44', 3, '2014-06-28 18:10:08', 3, 'yes', '2014-06-28 18:14:07', 3, 0, 'active'),
(4, 3, '2014-06-27', 11, 'www.google.com', 'test is test 11', '2014-06-28 17:52:30', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 3, '2014-06-27', 111222, 'www.google.com', 'test is test 111', '2014-06-28 17:57:47', 3, '2014-06-28 22:37:53', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, 3, '2014-06-05', 3, 'www.test.com', 'test', '2014-06-28 22:37:01', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pi_sequence`
--

DROP TABLE IF EXISTS `cms_pi_sequence`;
CREATE TABLE IF NOT EXISTS `cms_pi_sequence` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of this table',
  `case_id` int(11) NOT NULL COMMENT 'primary key of investigation table',
  `table_name` varchar(255) NOT NULL,
  `table_id` int(11) NOT NULL COMMENT 'primary key of table_name',
  `sequence_no` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `cms_pi_sequence`
--

INSERT INTO `cms_pi_sequence` (`id`, `case_id`, `table_name`, `table_id`, `sequence_no`) VALUES
(1, 7, 'personal_info', 3, 1),
(2, 7, 'pi_dob', 1, 2),
(3, 7, 'pi_dob', 4, 4),
(7, 7, 'pi_dod', 2, 6),
(6, 7, 'pi_dod', 1, 5),
(8, 7, 'pi_dod', 4, 7),
(9, 7, 'pi_dod', 5, 8),
(10, 7, 'pi_dod', 6, 9),
(11, 7, 'pi_aliases', 17, 10),
(12, 7, 'pi_aliases', 18, 11),
(14, 7, 'previous_addresses', 11, 12),
(15, 7, 'previous_addresses', 12, 13),
(16, 7, 'criminal_traffic', 4, 14),
(17, 7, 'criminal_traffic', 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `cms_posts`
--

DROP TABLE IF EXISTS `cms_posts`;
CREATE TABLE IF NOT EXISTS `cms_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_posts_activity`
--

DROP TABLE IF EXISTS `cms_posts_activity`;
CREATE TABLE IF NOT EXISTS `cms_posts_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_post_id` int(11) NOT NULL COMMENT 'PK of posts.id',
  `activity_id` int(11) NOT NULL COMMENT 'PK of posts.id',
  `activity_type` varchar(255) NOT NULL COMMENT 'Type of activity',
  `url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `box_url` varchar(255) NOT NULL COMMENT 'Box URL',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_previous_addresses`
--

DROP TABLE IF EXISTS `cms_previous_addresses`;
CREATE TABLE IF NOT EXISTS `cms_previous_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `location_type` varchar(100) NOT NULL COMMENT 'Location type',
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `start_date` date NOT NULL COMMENT 'Start date',
  `end_date` date NOT NULL COMMENT 'End date',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `cms_previous_addresses`
--

INSERT INTO `cms_previous_addresses` (`id`, `pi_id`, `location_type`, `address`, `street`, `city`, `zip`, `state`, `country`, `start_date`, `end_date`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 0, 'amd2', '', '', 494, '', 1, 3, '0000-00-00', '0000-00-00', 'http://www.google.com', '2014-06-14 22:33:42', 3, '2014-06-15 12:53:04', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 0, 'And1', '', '', 494, '', 1, 3, '0000-00-00', '0000-00-00', 'http://www.google.com', '2014-06-14 22:33:42', 3, '2014-06-15 12:56:00', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 0, '', '', '', 0, '', 0, 0, '0000-00-00', '0000-00-00', '', '2014-06-15 13:02:27', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 0, '', '', '', 0, '', 0, 0, '0000-00-00', '0000-00-00', '', '2014-06-15 13:03:10', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 2, 'Permenent', '', 'Sciencecity', 333, '11111', 4, 105, '1990-01-01', '2000-01-31', 'http://www.google.com', '2014-06-15 13:18:31', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, 2, 'Temp1', '', 'Sciencecity1', 494, '11111', 1, 3, '2000-02-01', '2010-01-01', 'http://www.google1.com', '2014-06-15 14:49:56', 3, '0000-00-00 00:00:00', 0, 'yes', '2014-06-15 14:50:44', 3, 0, 'active'),
(7, 2, 'Temp1', '', 'Sciencecity1', 494, '11111', 1, 3, '2000-02-01', '2010-01-01', 'http://www.google1.com', '2014-06-15 14:50:25', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(8, 2, 'Temp2', '', 'Sciencecity2', 1302, '2222', 2, 6, '2010-02-01', '2014-01-01', 'http://www.google2.com', '2014-06-15 14:50:25', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(9, 2, 'Temp3', '', 'Sciencecity3', 494, '11111', 1, 1, '2000-02-01', '2010-01-01', 'http://www.google1.com', '2014-06-15 14:51:09', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(10, 2, '4', '', '4', 916, '4', 9, 3, '2014-06-04', '2023-06-04', '4.com', '2014-06-18 15:08:04', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(11, 3, 'tes', '', '', 417, '32564', 3, 6, '2014-08-07', '2014-08-20', '', '2014-08-04 00:40:54', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(12, 3, 'test', '', '', 494, '3215', 1, 3, '2014-08-05', '2014-08-29', 'test.com', '2014-08-04 23:06:28', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_previous_phone_numbers`
--

DROP TABLE IF EXISTS `cms_previous_phone_numbers`;
CREATE TABLE IF NOT EXISTS `cms_previous_phone_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `phone_number` varchar(55) NOT NULL COMMENT 'Phone Number',
  `line_type` enum('landline','mobile') NOT NULL COMMENT 'Line type Land line or mobile',
  `carrier` varchar(255) NOT NULL COMMENT 'Carrier',
  `fname` varchar(100) NOT NULL COMMENT 'First name of Phone Owner',
  `mname` varchar(100) NOT NULL COMMENT 'Middle name of Phone Owner',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of Phone Owner',
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `start_date` date NOT NULL COMMENT 'Start date',
  `end_date` date NOT NULL COMMENT 'End date',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cms_previous_phone_numbers`
--

INSERT INTO `cms_previous_phone_numbers` (`id`, `pi_id`, `phone_number`, `line_type`, `carrier`, `fname`, `mname`, `lname`, `address`, `street`, `city`, `zip`, `state`, `country`, `start_date`, `end_date`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 2, '', 'landline', 'ftp', 'vipul', 'm', 'patel', 'this is landlive adddress', 'streeet is landive', 494, '677', 1, 3, '1970-01-01', '1970-01-01', 'yahoo.com', '2014-06-14 22:33:42', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 2, '', 'mobile', 'est', 'fasdf', 'asdfsdfsaf', 'sdfsdfdsfsfsaf', 'asdffas', 'sdfsafdsf', 434, '333', 5, 32, '2000-01-01', '2000-01-01', 'gmail', '2014-06-15 15:55:10', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_site_config`
--

DROP TABLE IF EXISTS `cms_site_config`;
CREATE TABLE IF NOT EXISTS `cms_site_config` (
  `site_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `from_name` varchar(100) DEFAULT NULL,
  `from_email` varchar(255) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `town` varchar(75) DEFAULT NULL,
  `state` varchar(75) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fax` varchar(50) DEFAULT NULL,
  `copy` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL COMMENT 'Facebook page URL',
  `twitter_url` varchar(255) DEFAULT NULL COMMENT 'Twitter link',
  `blog_url` varchar(255) DEFAULT NULL COMMENT 'Blog feed URL',
  PRIMARY KEY (`site_config_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_site_config`
--

INSERT INTO `cms_site_config` (`site_config_id`, `admin_name`, `admin_email`, `from_name`, `from_email`, `street`, `town`, `state`, `zipcode`, `phone`, `create_date`, `fax`, `copy`, `facebook_url`, `twitter_url`, `blog_url`) VALUES
(1, 'Admin', 'test@test.com', 'Admin', 'test@test.com', NULL, NULL, NULL, NULL, NULL, '2014-04-29 12:24:39', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person`
--

DROP TABLE IF EXISTS `cms_smi_person`;
CREATE TABLE IF NOT EXISTS `cms_smi_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of investigation.id',
  `relation` int(11) NOT NULL COMMENT 'Relation id (PK relation.id)',
  `fname` varchar(100) NOT NULL COMMENT 'First name of investigated person',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of investigated person',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_smi_person`
--

INSERT INTO `cms_smi_person` (`id`, `case_id`, `relation`, `fname`, `lname`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 0, 0, '', '', '2014-06-16 14:38:48', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_company`
--

DROP TABLE IF EXISTS `cms_smi_person_company`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `education_name` varchar(200) NOT NULL COMMENT 'Company name in Social Profile',
  `note` text NOT NULL COMMENT 'Company note',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_education`
--

DROP TABLE IF EXISTS `cms_smi_person_education`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `education_name` varchar(200) NOT NULL COMMENT 'Education name in Social Profile',
  `note` text NOT NULL COMMENT 'Education Notes',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_groups`
--

DROP TABLE IF EXISTS `cms_smi_person_groups`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `number_of_groups` int(11) NOT NULL COMMENT 'Number of groups',
  `note` text NOT NULL COMMENT 'Groups Notes',
  `groups_page_url` varchar(255) NOT NULL COMMENT 'Groups Page URL',
  `gpnote` text NOT NULL COMMENT 'General note about groups page',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_groups_crlp`
--

DROP TABLE IF EXISTS `cms_smi_person_groups_crlp`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_groups_crlp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `spg_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person_groups.id',
  `url` varchar(255) NOT NULL COMMENT 'Case Related likes Page [URL]',
  `note` text NOT NULL COMMENT 'Education Notes',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_likes`
--

DROP TABLE IF EXISTS `cms_smi_person_likes`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `number_of_likes` int(11) NOT NULL COMMENT 'Number of likes',
  `note` text NOT NULL COMMENT 'General note about likes',
  `likes_page_url` varchar(255) NOT NULL COMMENT 'Likes Page URL',
  `lpnote` text NOT NULL COMMENT 'General note about likes page',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_likes_crlp`
--

DROP TABLE IF EXISTS `cms_smi_person_likes_crlp`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_likes_crlp` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `spl_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person_likes.id',
  `url` varchar(255) NOT NULL COMMENT 'Case Related likes Page [URL]',
  `note` text NOT NULL COMMENT 'Education Notes',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_place_lived`
--

DROP TABLE IF EXISTS `cms_smi_person_place_lived`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_place_lived` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_smi_person_social_media_sites`
--

DROP TABLE IF EXISTS `cms_smi_person_social_media_sites`;
CREATE TABLE IF NOT EXISTS `cms_smi_person_social_media_sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `sp_id` int(11) NOT NULL COMMENT 'PK of cms_smi_person.id',
  `social_media_site` int(11) NOT NULL COMMENT 'Social Media Site id (PK social_media_site.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `pname` varchar(100) NOT NULL COMMENT 'Profile name in Social Profile',
  `note` text NOT NULL COMMENT 'Profile note',
  `username` varchar(100) NOT NULL COMMENT 'Username in Social Profile',
  `unote` text NOT NULL COMMENT 'Username Notes',
  `user_id` varchar(100) NOT NULL COMMENT 'User ID in Social Profile',
  `ppage` varchar(100) NOT NULL COMMENT 'Profile page url in Social Profile',
  `ppnote` text NOT NULL COMMENT 'Profile note',
  `about_url` varchar(255) NOT NULL COMMENT 'Web URL',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_staff_with_clip`
--

DROP TABLE IF EXISTS `cms_staff_with_clip`;
CREATE TABLE IF NOT EXISTS `cms_staff_with_clip` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `case_id` int(11) NOT NULL COMMENT 'PK of invitation_case.id',
  `ci_id` int(11) NOT NULL COMMENT 'PK of clip_information.id',
  `staff` varchar(100) NOT NULL COMMENT 'Name of channel',
  `fname` varchar(100) NOT NULL COMMENT 'First name of Author Information',
  `mname` varchar(100) NOT NULL COMMENT 'Middle name of Author Information',
  `lname` varchar(100) NOT NULL COMMENT 'Last name of Author Information',
  `email` varchar(255) NOT NULL COMMENT 'Email address',
  `phone_number` varchar(55) NOT NULL COMMENT 'Phone Number',
  `mobile_number` varchar(55) NOT NULL COMMENT 'Mobile Number',
  `twitter_username` varchar(100) NOT NULL COMMENT 'Twitter Username',
  `twitter_url` varchar(100) NOT NULL COMMENT 'Twitter Profile Page [URL]',
  `fb_username` varchar(100) NOT NULL COMMENT 'Facebook Username',
  `fb_url` varchar(100) NOT NULL COMMENT 'Facebook Profile Page [URL]',
  `linkedin_username` varchar(100) NOT NULL COMMENT 'Linkedin Username',
  `linkedin_url` varchar(100) NOT NULL COMMENT 'Linkedin Profile Page [URL]',
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL COMMENT 'City id (PK city.id)',
  `zip` varchar(25) NOT NULL COMMENT 'Zip / Zip/Postal Code',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `country` int(11) NOT NULL COMMENT 'Country id (PK country.id)',
  `author_note` text NOT NULL COMMENT 'Author Notes [Text Box]',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cms_staff_with_clip`
--

INSERT INTO `cms_staff_with_clip` (`id`, `case_id`, `ci_id`, `staff`, `fname`, `mname`, `lname`, `email`, `phone_number`, `mobile_number`, `twitter_username`, `twitter_url`, `fb_username`, `fb_url`, `linkedin_username`, `linkedin_url`, `street`, `city`, `zip`, `state`, `country`, `author_note`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 4, 0, '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', '7', 418, '7', 35, 8, '7', '2014-06-16 14:17:33', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 4, 0, '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', '8', 4, '8', 30, 5, '8', '2014-06-16 14:24:37', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 4, 0, '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', '9', 626, '9', 29, 9, '9', '2014-06-16 14:24:37', 3, '2014-06-16 14:35:13', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_staff_with_clip_author_url`
--

DROP TABLE IF EXISTS `cms_staff_with_clip_author_url`;
CREATE TABLE IF NOT EXISTS `cms_staff_with_clip_author_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `awc_id` int(11) NOT NULL COMMENT 'PK of staff_with_clip.id',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_state`
--

DROP TABLE IF EXISTS `cms_state`;
CREATE TABLE IF NOT EXISTS `cms_state` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `cms_state`
--

INSERT INTO `cms_state` (`id`, `name`, `country_code`, `ordering`, `state`, `checked_out`, `checked_out_time`, `created_by`) VALUES
(1, 'ANDHRA PRADESH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(2, 'ASSAM', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(3, 'ARUNACHAL PRADESH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(4, 'GUJRAT', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(5, 'BIHAR', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(6, 'HARYANA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(7, 'HIMACHAL PRADESH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(8, 'JAMMU & KASHMIR', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(9, 'KARNATAKA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(10, 'KERALA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(11, 'MADHYA PRADESH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(12, 'MAHARASHTRA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(13, 'MANIPUR', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(14, 'MEGHALAYA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(15, 'MIZORAM', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(16, 'NAGALAND', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(17, 'ORISSA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(18, 'PUNJAB', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(19, 'RAJASTHAN', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(20, 'SIKKIM', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(21, 'TAMIL NADU', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(22, 'TRIPURA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(23, 'UTTAR PRADESH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(24, 'WEST BENGAL', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(25, 'DELHI', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(26, 'GOA', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(27, 'PONDICHERY', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(28, 'LAKSHDWEEP', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(29, 'DAMAN & DIU', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(30, 'DADRA & NAGAR', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(31, 'CHANDIGARH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(32, 'ANDAMAN & NICOBAR', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(33, 'UTTARANCHAL', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(34, 'JHARKHAND', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0),
(35, 'CHATTISGARH', 'IN', 0, 1, 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_tabs`
--

DROP TABLE IF EXISTS `cms_tabs`;
CREATE TABLE IF NOT EXISTS `cms_tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key of this table',
  `case_id` int(11) NOT NULL COMMENT 'case id (PK case.id)',
  `heading` varchar(255) NOT NULL,
  `note` text NOT NULL COMMENT 'Profile note',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cms_tabs`
--

INSERT INTO `cms_tabs` (`id`, `case_id`, `heading`, `note`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 1, 'Test', 'This is test', '2014-08-10 21:55:24', 1, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(2, 3, 'Test PI', 'Test PI', '2014-08-18 00:47:54', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(3, 3, 'Test PI', 'Test PI', '2014-08-18 00:48:33', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(4, 3, 'Test PI', 'test pi', '2014-08-18 00:48:54', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(5, 7, 'Test PI', 'Test PI', '2014-08-18 01:12:31', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(6, 7, 'Test PI 2', 'Test PI 2', '2014-08-18 01:15:08', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(7, 7, 'Test SMI', 'Test SMI', '2014-08-18 01:17:01', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(8, 7, 'Test np', 'Test np', '2014-08-18 01:17:22', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active'),
(9, 7, 'test tv', 'test tv', '2014-08-18 01:17:50', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_tv_channel`
--

DROP TABLE IF EXISTS `cms_tv_channel`;
CREATE TABLE IF NOT EXISTS `cms_tv_channel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `title` varchar(255) NOT NULL COMMENT 'Title of activity',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_tv_channel`
--

INSERT INTO `cms_tv_channel` (`id`, `title`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, '', '2014-06-16 13:49:33', 3, '0000-00-00 00:00:00', 0, 'no', '0000-00-00 00:00:00', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `cms_user`
--

DROP TABLE IF EXISTS `cms_user`;
CREATE TABLE IF NOT EXISTS `cms_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT '0',
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `user_active` char(1) DEFAULT 'y',
  `middle_name` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `report_to` int(11) NOT NULL,
  `office_location` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` int(11) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `office_phone` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `security_clearance` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `cms_user`
--

INSERT INTO `cms_user` (`user_id`, `user_role_id`, `first_name`, `last_name`, `email`, `user_name`, `password`, `user_active`, `middle_name`, `job_title`, `report_to`, `office_location`, `address`, `street`, `city`, `state`, `zip`, `country`, `company_email`, `office_phone`, `mobile_phone`, `home_phone`, `skype`, `fax`, `language`, `dob`, `security_clearance`, `note`, `image`) VALUES
(1, 1, 'Super', 'Admin', 'patelalicen@gmail.com', 'webadmin', 'webadmin', 'y', '', '', 0, '', '', '', 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(2, 2, 'Site', 'Admin', 'patelalicen@gmail.com', 'admin', 'admin', 'y', '', '', 0, '', '', '', 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(3, 3, 'Alice', 'Patel', 'patelalicen@gmail.com', 'alice', 'alice', 'y', '', '', 0, '', '', '', 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(4, 3, 'Herry', 'Poter', 'herry@gmail.com', 'herry', 'herry', 'y', '', '', 0, '', '', '', 0, 0, '', 0, '', '', '', '', '', '', '', '', '', '', ''),
(5, 3, 'new one', 'new', 'new@gmail.com', 'new', 'new', 'y', '', '', 0, 'Test', '', '', 0, 0, '', 0, 'test@test.com', 'Test', 'Test', 'Test', '', 'first company', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_user_rights`
--

DROP TABLE IF EXISTS `cms_user_rights`;
CREATE TABLE IF NOT EXISTS `cms_user_rights` (
  `user_right_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT '0',
  `menu_id` int(11) DEFAULT '0',
  `user_right` int(11) DEFAULT '0' COMMENT '1 = View, 2 = Add, 3 = Edit, 4 = Delete, 5 = Copy, 6 = Export',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_right_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=398 ;

--
-- Dumping data for table `cms_user_rights`
--

INSERT INTO `cms_user_rights` (`user_right_id`, `user_role_id`, `menu_id`, `user_right`, `create_date`) VALUES
(148, 4, 8, 1, '2014-06-17 02:33:38'),
(149, 4, 8, 2, '2014-06-17 02:33:38'),
(150, 4, 8, 3, '2014-06-17 02:33:38'),
(259, 2, 6, 1, '2014-07-15 04:40:22'),
(260, 2, 6, 2, '2014-07-15 04:40:22'),
(261, 2, 6, 3, '2014-07-15 04:40:22'),
(262, 2, 6, 4, '2014-07-15 04:40:22'),
(263, 2, 7, 1, '2014-07-15 04:40:23'),
(264, 2, 10, 1, '2014-07-15 04:40:23'),
(265, 2, 10, 2, '2014-07-15 04:40:23'),
(266, 2, 10, 3, '2014-07-15 04:40:23'),
(273, 3, 8, 1, '2014-07-15 11:35:36'),
(274, 3, 8, 2, '2014-07-15 11:35:37'),
(275, 3, 8, 3, '2014-07-15 11:35:37'),
(276, 3, 9, 1, '2014-07-15 11:35:37'),
(277, 3, 9, 2, '2014-07-15 11:35:37'),
(354, 6, 7, 1, '2014-08-10 08:14:14'),
(355, 6, 7, 2, '2014-08-10 08:14:15'),
(356, 6, 7, 3, '2014-08-10 08:14:15'),
(357, 6, 7, 4, '2014-08-10 08:14:15'),
(358, 1, 1, 1, '2014-08-10 08:15:20'),
(359, 1, 1, 2, '2014-08-10 08:15:20'),
(360, 1, 1, 3, '2014-08-10 08:15:20'),
(361, 1, 1, 4, '2014-08-10 08:15:20'),
(362, 1, 2, 1, '2014-08-10 08:15:20'),
(363, 1, 2, 2, '2014-08-10 08:15:20'),
(364, 1, 2, 3, '2014-08-10 08:15:20'),
(365, 1, 2, 4, '2014-08-10 08:15:21'),
(366, 1, 3, 1, '2014-08-10 08:15:21'),
(367, 1, 3, 2, '2014-08-10 08:15:21'),
(368, 1, 3, 3, '2014-08-10 08:15:21'),
(369, 1, 3, 4, '2014-08-10 08:15:21'),
(370, 1, 4, 1, '2014-08-10 08:15:21'),
(371, 1, 4, 2, '2014-08-10 08:15:21'),
(372, 1, 4, 3, '2014-08-10 08:15:21'),
(373, 1, 4, 4, '2014-08-10 08:15:21'),
(374, 1, 6, 1, '2014-08-10 08:15:21'),
(375, 1, 6, 2, '2014-08-10 08:15:21'),
(376, 1, 6, 3, '2014-08-10 08:15:21'),
(377, 1, 6, 4, '2014-08-10 08:15:21'),
(378, 1, 7, 1, '2014-08-10 08:15:21'),
(379, 1, 7, 2, '2014-08-10 08:15:21'),
(380, 1, 7, 3, '2014-08-10 08:15:21'),
(381, 1, 7, 4, '2014-08-10 08:15:21'),
(382, 1, 8, 1, '2014-08-10 08:15:21'),
(383, 1, 8, 2, '2014-08-10 08:15:21'),
(384, 1, 8, 3, '2014-08-10 08:15:21'),
(385, 1, 8, 4, '2014-08-10 08:15:21'),
(386, 1, 9, 1, '2014-08-10 08:15:21'),
(387, 1, 9, 2, '2014-08-10 08:15:21'),
(388, 1, 9, 3, '2014-08-10 08:15:21'),
(389, 1, 9, 4, '2014-08-10 08:15:21'),
(390, 1, 10, 1, '2014-08-10 08:15:21'),
(391, 1, 10, 2, '2014-08-10 08:15:21'),
(392, 1, 10, 3, '2014-08-10 08:15:21'),
(393, 1, 10, 4, '2014-08-10 08:15:21'),
(394, 1, 11, 1, '2014-08-10 08:15:21'),
(395, 1, 11, 2, '2014-08-10 08:15:21'),
(396, 1, 11, 3, '2014-08-10 08:15:21'),
(397, 1, 11, 4, '2014-08-10 08:15:21');

-- --------------------------------------------------------

--
-- Table structure for table `cms_user_role`
--

DROP TABLE IF EXISTS `cms_user_role`;
CREATE TABLE IF NOT EXISTS `cms_user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(100) DEFAULT NULL,
  `user_role_active` char(1) DEFAULT 'y',
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cms_user_role`
--

INSERT INTO `cms_user_role` (`user_role_id`, `user_role_name`, `user_role_active`, `create_date`) VALUES
(1, 'Chief Operator', 'y', '2012-12-31 13:00:00'),
(2, 'Case Manager', 'y', '2012-12-31 13:00:00'),
(3, 'Investigator', 'y', '2012-12-31 13:00:00'),
(4, 'Quality Assurance', 'y', '2014-05-11 06:11:43'),
(5, 'Salesperson/Affiliate', 'y', '2014-05-11 10:35:15'),
(6, 'Intake Manager', 'y', '2014-07-15 09:48:31');

-- --------------------------------------------------------

--
-- Table structure for table `cms_voter_registration`
--

DROP TABLE IF EXISTS `cms_voter_registration`;
CREATE TABLE IF NOT EXISTS `cms_voter_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK of this table',
  `pi_id` int(11) NOT NULL COMMENT 'PK of personal_info.id',
  `political_affiliation` varchar(255) NOT NULL COMMENT 'Political Affiliation',
  `registration_date` datetime NOT NULL COMMENT 'Registration Date',
  `state` int(11) NOT NULL COMMENT 'State id (PK state.id)',
  `web_url` varchar(255) NOT NULL COMMENT 'Web URL (Only for QA)',
  `created_date` datetime NOT NULL COMMENT 'Record created date',
  `created_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `updated_date` datetime NOT NULL COMMENT 'Record edited date',
  `updated_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `is_deleted` enum('yes','no') NOT NULL DEFAULT 'no' COMMENT 'Flag is recored deleted or not (yes = deleted)',
  `deleted_date` datetime NOT NULL COMMENT 'Record deleted date',
  `deleted_by` int(11) NOT NULL COMMENT 'Logged in user id (PK user.user_id)',
  `ordering` int(11) NOT NULL COMMENT 'Ordering of records',
  `status` enum('active','inactive') NOT NULL COMMENT 'Status record is actove or not?',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cms_voter_registration`
--

INSERT INTO `cms_voter_registration` (`id`, `pi_id`, `political_affiliation`, `registration_date`, `state`, `web_url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `is_deleted`, `deleted_date`, `deleted_by`, `ordering`, `status`) VALUES
(1, 2, 'Test', '1970-01-01 12:00:00', 34, 'google.om', '2014-06-15 15:34:57', 3, '2014-06-16 14:52:51', 3, 'no', '0000-00-00 00:00:00', 0, 0, 'active');