-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 11:01 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- --------------------------------------------------------

--
-- Table structure for table `book_author`
--

CREATE TABLE IF NOT EXISTS `book_author` (
`AuthorID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_author`
--

INSERT INTO `book_author` (`AuthorID`, `Name`) VALUES
(1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `book_language`
--

CREATE TABLE IF NOT EXISTS `book_language` (
`LanguageID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_language`
--

INSERT INTO `book_language` (`LanguageID`, `Name`) VALUES
(1, 'English'),
(2, 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `book_library`
--

CREATE TABLE IF NOT EXISTS `book_library` (
  `BookID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Guid` varchar(255) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_publisher`
--

CREATE TABLE IF NOT EXISTS `book_publisher` (
`PublisherID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_publisher`
--

INSERT INTO `book_publisher` (`PublisherID`, `Name`) VALUES
(1, '-');

-- --------------------------------------------------------

--
-- Table structure for table `book_release`
--

CREATE TABLE IF NOT EXISTS `book_release` (
`BookID` int(11) NOT NULL,
  `Image_link` varchar(1000) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `AuthorID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `TranslatorID` int(11) NOT NULL,
  `PublisherID` int(11) NOT NULL,
  `Tags` varchar(255) DEFAULT NULL,
  `Pages` double NOT NULL,
  `Sample_link` varchar(1000) NOT NULL,
  `Full_link` varchar(1000) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `Original_released` date DEFAULT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_review`
--

CREATE TABLE IF NOT EXISTS `book_review` (
`ReviewID` bigint(20) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Detail` text NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Updated_by` varchar(50) DEFAULT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_submit`
--

CREATE TABLE IF NOT EXISTS `book_submit` (
`SubmitBookID` int(11) NOT NULL,
  `Image_link` varchar(1000) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Author` varchar(255) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `Translator` varchar(255) NOT NULL,
  `Tags` varchar(255) DEFAULT NULL,
  `Pages` double NOT NULL,
  `Sample_link` varchar(1000) NOT NULL,
  `Full_link` varchar(1000) NOT NULL,
  `Purpose` varchar(255) DEFAULT NULL,
  `Publisher` varchar(255) DEFAULT NULL,
  `ISBN` varchar(255) DEFAULT NULL,
  `Original_released` date DEFAULT NULL,
  `BookID` int(11) DEFAULT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `book_translator`
--

CREATE TABLE IF NOT EXISTS `book_translator` (
`TranslatorID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_translator`
--

INSERT INTO `book_translator` (`TranslatorID`, `Name`, `Website`) VALUES
(1, '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `book_type`
--

CREATE TABLE IF NOT EXISTS `book_type` (
`TypeID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_type`
--

INSERT INTO `book_type` (`TypeID`, `Name`) VALUES
(1, 'Manga');

-- --------------------------------------------------------

--
-- Table structure for table `core_status`
--

CREATE TABLE IF NOT EXISTS `core_status` (
`StatusID` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `core_status`
--

INSERT INTO `core_status` (`StatusID`, `Status`) VALUES
(1, 'active'),
(2, 'allocated'),
(3, 'approved'),
(4, 'authorized'),
(5, 'banned'),
(6, 'blank'),
(7, 'canceled'),
(8, 'checked'),
(9, 'closed'),
(10, 'commented'),
(11, 'compared'),
(12, 'deleted'),
(13, 'disabled'),
(14, 'downloaded'),
(15, 'edited'),
(16, 'enabled'),
(17, 'error'),
(18, 'expired'),
(19, 'failed'),
(20, 'hidden'),
(21, 'installed'),
(22, 'listed'),
(23, 'locked'),
(24, 'maintenance'),
(25, 'merged'),
(26, 'moved'),
(27, 'ok'),
(28, 'on hold'),
(29, 'on process'),
(30, 'on request'),
(31, 'open'),
(32, 'outstanding'),
(33, 'overdue'),
(34, 'paid'),
(35, 'pending'),
(36, 'registered'),
(37, 'rejected'),
(38, 'removed'),
(39, 'signed'),
(40, 'stopped'),
(41, 'success'),
(42, 'suspended'),
(43, 'unauthorized'),
(44, 'unknown'),
(45, 'uploaded'),
(46, 'viewed'),
(47, 'void'),
(48, 'waiting'),
(49, 'public'),
(50, 'private'),
(51, 'publish'),
(52, 'draft'),
(53, 'on going'),
(54, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `user_api`
--

CREATE TABLE IF NOT EXISTS `user_api` (
  `Domain` varchar(50) NOT NULL,
  `ApiKey` varchar(255) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Username` varchar(50) NOT NULL,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_api`
--

INSERT INTO `user_api` (`Domain`, `ApiKey`, `StatusID`, `Created_at`, `Username`, `Updated_at`, `Updated_by`) VALUES
('localhost', '1vvyhfz3RtubHk4qWstEzMjhUP83T6xT7bwUQHhr3', 1, '2017-05-12 08:12:19', 'reslim', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE IF NOT EXISTS `user_auth` (
  `Username` varchar(50) NOT NULL,
  `RS_Token` varchar(255) NOT NULL,
  `Created` datetime NOT NULL,
  `Expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
`UserID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Aboutme` varchar(255) DEFAULT NULL,
  `Avatar` text,
  `RoleID` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`UserID`, `Username`, `Password`, `Fullname`, `Address`, `Phone`, `Email`, `Aboutme`, `Avatar`, `RoleID`, `StatusID`, `Created_at`, `Updated_at`) VALUES
(1, 'reslim', '$2y$11$D9ZWJOhKvLoor7RyUA70hOVzbwJ9RA.nk909QLENotxq26F6k/Qxu', 'Master', 'INDONESIA', '12345', 'your@yourdomain.com', 'Master of reSlim Project', '', 1, 1, '2016-12-28 20:17:12', '2016-12-28 20:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_forgot`
--

CREATE TABLE IF NOT EXISTS `user_forgot` (
  `Email` varchar(50) NOT NULL,
  `Verifylink` varchar(255) NOT NULL,
  `Created` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Expired` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`RoleID` int(11) NOT NULL,
  `Role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`RoleID`, `Role`) VALUES
(1, 'superuser'),
(2, 'admin'),
(3, 'member');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `Username` varchar(50) NOT NULL,
  `Fullname` varchar(255) DEFAULT NULL,
  `No_Account` varchar(255) DEFAULT NULL,
  `Bank_Name` varchar(255) DEFAULT NULL,
  `Bank_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_upload`
--

CREATE TABLE IF NOT EXISTS `user_upload` (
`ItemID` int(11) NOT NULL,
  `Date_Upload` datetime NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Alternate` varchar(255) DEFAULT NULL,
  `External_link` varchar(255) DEFAULT NULL,
  `Filename` varchar(255) NOT NULL,
  `Filepath` varchar(255) NOT NULL,
  `Filetype` varchar(255) NOT NULL,
  `Filesize` double NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL,
  `StatusID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_withdrawal`
--

CREATE TABLE IF NOT EXISTS `user_withdrawal` (
`WithdrawID` bigint(20) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `No_Account` varchar(255) NOT NULL,
  `Bank_Name` varchar(255) NOT NULL,
  `Bank_Address` varchar(255) NOT NULL,
  `No_Reference` varchar(50) NOT NULL,
  `From_Bank` varchar(255) NOT NULL,
  `From_Name` varchar(255) NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `Image_Evidence` varchar(255) DEFAULT NULL,
  `Detail` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Created_at` datetime NOT NULL,
  `Adminname` varchar(50) NOT NULL,
  `Updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_author`
--
ALTER TABLE `book_author`
 ADD PRIMARY KEY (`AuthorID`), ADD KEY `AuthorID` (`AuthorID`), ADD KEY `Name` (`Name`);

--
-- Indexes for table `book_language`
--
ALTER TABLE `book_language`
 ADD PRIMARY KEY (`LanguageID`), ADD KEY `LanguageID` (`LanguageID`), ADD KEY `Name` (`Name`);

--
-- Indexes for table `book_library`
--
ALTER TABLE `book_library`
 ADD PRIMARY KEY (`BookID`,`Username`), ADD KEY `ID` (`BookID`,`Username`), ADD KEY `StatusID` (`StatusID`), ADD KEY `Username` (`Username`) USING BTREE, ADD KEY `Guid` (`Guid`);

--
-- Indexes for table `book_publisher`
--
ALTER TABLE `book_publisher`
 ADD PRIMARY KEY (`PublisherID`), ADD KEY `Name` (`Name`), ADD KEY `PublisherID` (`PublisherID`) USING BTREE;

--
-- Indexes for table `book_release`
--
ALTER TABLE `book_release`
 ADD PRIMARY KEY (`BookID`), ADD KEY `BookID` (`BookID`), ADD KEY `Title` (`Title`), ADD KEY `AuthorID` (`AuthorID`), ADD KEY `LanguageID` (`LanguageID`), ADD KEY `TranslatorID` (`TranslatorID`), ADD KEY `Tags` (`Tags`), ADD KEY `StatusID` (`StatusID`), ADD KEY `Created_at` (`Created_at`), ADD KEY `Username` (`Username`), ADD KEY `TypeID` (`TypeID`) USING BTREE, ADD KEY `PublisherID` (`PublisherID`), ADD KEY `ISBN` (`ISBN`), ADD KEY `Original_released` (`Original_released`);

--
-- Indexes for table `book_review`
--
ALTER TABLE `book_review`
 ADD PRIMARY KEY (`ReviewID`,`Username`,`BookID`), ADD KEY `ReviewID` (`ReviewID`), ADD KEY `Username` (`Username`), ADD KEY `BookID` (`BookID`), ADD KEY `Created_at` (`Created_at`), ADD KEY `StatusID` (`StatusID`);

--
-- Indexes for table `book_submit`
--
ALTER TABLE `book_submit`
 ADD PRIMARY KEY (`SubmitBookID`), ADD KEY `Title` (`Title`), ADD KEY `Tags` (`Tags`), ADD KEY `StatusID` (`StatusID`), ADD KEY `Created_at` (`Created_at`), ADD KEY `Username` (`Username`), ADD KEY `SubmitBookID` (`SubmitBookID`) USING BTREE, ADD KEY `Author` (`Author`) USING BTREE, ADD KEY `Language` (`Language`) USING BTREE, ADD KEY `Translator` (`Translator`) USING BTREE, ADD KEY `BookID` (`BookID`), ADD KEY `Publisher` (`Publisher`), ADD KEY `ISBN` (`ISBN`), ADD KEY `Original_released` (`Original_released`);

--
-- Indexes for table `book_translator`
--
ALTER TABLE `book_translator`
 ADD PRIMARY KEY (`TranslatorID`), ADD KEY `TranslatorID` (`TranslatorID`), ADD KEY `Name` (`Name`);

--
-- Indexes for table `book_type`
--
ALTER TABLE `book_type`
 ADD PRIMARY KEY (`TypeID`), ADD KEY `TypeID` (`TypeID`) USING BTREE, ADD KEY `Name` (`Name`);

--
-- Indexes for table `core_status`
--
ALTER TABLE `core_status`
 ADD PRIMARY KEY (`StatusID`), ADD KEY `StatusID` (`StatusID`) USING BTREE;

--
-- Indexes for table `user_api`
--
ALTER TABLE `user_api`
 ADD PRIMARY KEY (`Domain`), ADD KEY `Domain` (`Domain`), ADD KEY `StatusID` (`StatusID`), ADD KEY `Username` (`Username`), ADD KEY `ApiKey` (`ApiKey`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
 ADD PRIMARY KEY (`Username`,`RS_Token`), ADD KEY `token` (`Username`,`RS_Token`,`Expired`) USING BTREE;

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
 ADD PRIMARY KEY (`UserID`,`Username`), ADD KEY `user_data_ibfk_1` (`StatusID`), ADD KEY `user_data_ibfk_2` (`RoleID`), ADD KEY `Username` (`Username`), ADD KEY `Fullname` (`Fullname`) USING BTREE, ADD KEY `Password` (`Password`), ADD KEY `Email` (`Email`);

--
-- Indexes for table `user_forgot`
--
ALTER TABLE `user_forgot`
 ADD PRIMARY KEY (`Email`,`Verifylink`), ADD KEY `Email` (`Email`), ADD KEY `Verifylink` (`Verifylink`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`RoleID`), ADD KEY `ID` (`RoleID`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
 ADD PRIMARY KEY (`Username`), ADD KEY `Username` (`Username`), ADD KEY `Fullname` (`Fullname`), ADD KEY `No_Account` (`No_Account`);

--
-- Indexes for table `user_upload`
--
ALTER TABLE `user_upload`
 ADD PRIMARY KEY (`ItemID`), ADD KEY `ItemID` (`ItemID`), ADD KEY `Date_Upload` (`Date_Upload`), ADD KEY `Filename` (`Filename`), ADD KEY `Filetype` (`Filetype`), ADD KEY `Username` (`Username`) USING BTREE, ADD KEY `StatusID` (`StatusID`) USING BTREE;

--
-- Indexes for table `user_withdrawal`
--
ALTER TABLE `user_withdrawal`
 ADD PRIMARY KEY (`WithdrawID`), ADD KEY `WithdrawID` (`WithdrawID`), ADD KEY `Fullname` (`Fullname`), ADD KEY `No_Account` (`No_Account`), ADD KEY `Username` (`Username`), ADD KEY `Adminname` (`Adminname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_author`
--
ALTER TABLE `book_author`
MODIFY `AuthorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book_language`
--
ALTER TABLE `book_language`
MODIFY `LanguageID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `book_publisher`
--
ALTER TABLE `book_publisher`
MODIFY `PublisherID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book_release`
--
ALTER TABLE `book_release`
MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_review`
--
ALTER TABLE `book_review`
MODIFY `ReviewID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_submit`
--
ALTER TABLE `book_submit`
MODIFY `SubmitBookID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_translator`
--
ALTER TABLE `book_translator`
MODIFY `TranslatorID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `book_type`
--
ALTER TABLE `book_type`
MODIFY `TypeID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `core_status`
--
ALTER TABLE `core_status`
MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `RoleID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_upload`
--
ALTER TABLE `user_upload`
MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_withdrawal`
--
ALTER TABLE `user_withdrawal`
MODIFY `WithdrawID` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_library`
--
ALTER TABLE `book_library`
ADD CONSTRAINT `book_library_ibfk_1` FOREIGN KEY (`BookID`) REFERENCES `book_release` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_library_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_library_ibfk_3` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_release`
--
ALTER TABLE `book_release`
ADD CONSTRAINT `book_release_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `book_author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_2` FOREIGN KEY (`LanguageID`) REFERENCES `book_language` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_3` FOREIGN KEY (`TranslatorID`) REFERENCES `book_translator` (`TranslatorID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_4` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_5` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_6` FOREIGN KEY (`TypeID`) REFERENCES `book_type` (`TypeID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_release_ibfk_7` FOREIGN KEY (`PublisherID`) REFERENCES `book_publisher` (`PublisherID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_review`
--
ALTER TABLE `book_review`
ADD CONSTRAINT `book_review_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_review_ibfk_2` FOREIGN KEY (`BookID`) REFERENCES `book_release` (`BookID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_review_ibfk_3` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `book_submit`
--
ALTER TABLE `book_submit`
ADD CONSTRAINT `book_submit_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `book_submit_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_api`
--
ALTER TABLE `user_api`
ADD CONSTRAINT `user_api_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_api_ibfk_2` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_auth`
--
ALTER TABLE `user_auth`
ADD CONSTRAINT `user_token` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_data`
--
ALTER TABLE `user_data`
ADD CONSTRAINT `user_data_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_data_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `user_role` (`RoleID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_forgot`
--
ALTER TABLE `user_forgot`
ADD CONSTRAINT `user_forgot_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user_data` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_settings`
--
ALTER TABLE `user_settings`
ADD CONSTRAINT `user_settings_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_upload`
--
ALTER TABLE `user_upload`
ADD CONSTRAINT `user_upload_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user_data` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_upload_ibfk_2` FOREIGN KEY (`StatusID`) REFERENCES `core_status` (`StatusID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
