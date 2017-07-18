-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17.07.2017 klo 12:17
-- Palvelimen versio: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `membregister`
--
CREATE DATABASE IF NOT EXISTS `membregister` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `membregister`;

DELIMITER $$
--
-- Proseduurit
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getActiveIDs` ()  NO SQL
    COMMENT 'Getting IDs of active members'
SELECT m_id FROM t_members WHERE m_active=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActiveMembers` ()  NO SQL
    COMMENT 'Showing IDs and names of all active members'
SELECT m_id, m_lastname, m_firstname, m_active FROM t_members WHERE m_active<>0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActiveNames` ()  NO SQL
    COMMENT 'Getting the names of active members'
SELECT m_firstname, m_lastname FROM t_members WHERE m_active=1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllMembers` ()  NO SQL
    COMMENT 'Showing IDs, Names, and activity of all members'
SELECT m_id, m_lastname, m_firstname, m_active FROM t_members$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getFirstName` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Getting specific firstname'
SELECT m_firstname FROM t_members WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLastName` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Getting specific lastname'
SELECT m_lastname FROM t_members WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRefdata` (IN `newyear` INT)  NO SQL
    COMMENT 'Selecting reference number info'
SELECT ta_id, m_id, ta_refnumber1, ta_refnumber2, ta_refnumber3, ta_refnumber4 FROM t_transactionhistory WHERE i_year='newyear'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewMemberWBD` (IN `firstname` VARCHAR(255) CHARSET utf8mb4, IN `lastname` VARCHAR(255) CHARSET utf8mb4, IN `birthday` DATE)  NO SQL
    COMMENT 'Inserting a new member with birthdate'
INSERT INTO t_members (m_firstname, m_lastname, m_birthdate) VALUES (firstname, lastname, birthday)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewMemberWOBD` (IN `firstname` VARCHAR(255) CHARSET utf8mb4, IN `lastname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Adding a new member'
INSERT INTO t_members (m_firstname, m_lastname) VALUES (firstName, lastName)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `newTransactionRow` (IN `id` INT, IN `newyear` INT)  NO SQL
    COMMENT 'Adding a new row to transactionhistory table'
INSERT INTO t_transactionhistory (i_year, m_id) VALUES (newyear, id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setActive` (IN `id` INT)  NO SQL
    COMMENT 'Setting member active'
UPDATE t_members SET m_active=1 WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setInactive` (IN `id` INT)  NO SQL
    COMMENT 'Setting member inactive'
UPDATE t_members SET m_active=0 WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAddress` (IN `id` INT, IN `address` VARCHAR(255) CHARSET utf8mb4, IN `city` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating address of a member'
UPDATE t_members SET m_address='address', m_city='city' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBirthdate` (IN `id` INT, IN `birthday` DATE)  NO SQL
    COMMENT 'Updating birthdate'
UPDATE t_members SET m_birthdate='birthday' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEmail` (IN `id` INT, IN `email` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating email of a member'
UPDATE m_members SET m_email='email' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateFName` (IN `id` INT, IN `firstname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating first name'
UPDATE t_members SET m_firstname='firstname' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateLName` (IN `id` INT, IN `lastname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating last name'
UPDATE t_members SET m_lastname='lastname' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePhone` (IN `id` INT, IN `phonenumber` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating phonenumber'
UPDATE t_members SET m_phone='phonenumber' WHERE m_id='id'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRefNumbers` (IN `id` INT, IN `ref1` VARCHAR(9) CHARSET utf8mb4, IN `ref2` VARCHAR(9) CHARSET utf8mb4, IN `ref3` VARCHAR(9) CHARSET utf8mb4, IN `ref4` VARCHAR(9) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating reference numbers of individual member/year'
UPDATE t_transactionhistory SET ta_refnumber1='ref1', ta_refnumber2='ref2', ta_refnumber3='ref3', ta_refnumber4='ref4' WHERE ta_id='id'$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Rakenne taululle `t_installments`
--

CREATE TABLE `t_installments` (
  `i_year` int(4) NOT NULL,
  `i_installment1` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `i_duedate1` varchar(6) NOT NULL DEFAULT '20.11.',
  `i_installment2` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `i_duedate2` varchar(6) NOT NULL DEFAULT '20.01.',
  `i_installment3` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `i_duedate3` varchar(6) NOT NULL DEFAULT '20.03.',
  `i_installment4` decimal(13,4) NOT NULL DEFAULT '0.0000',
  `i_duedate4` varchar(6) NOT NULL DEFAULT '20.05.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Rakenne taululle `t_members`
--

CREATE TABLE `t_members` (
  `m_id` smallint(5) UNSIGNED NOT NULL,
  `m_firstname` varchar(255) NOT NULL,
  `m_lastname` varchar(255) NOT NULL,
  `m_active` tinyint(1) NOT NULL DEFAULT '1',
  `m_birthdate` date DEFAULT NULL,
  `m_phone` varchar(255) DEFAULT NULL,
  `m_email` varchar(255) DEFAULT NULL,
  `m_address` varchar(255) DEFAULT NULL,
  `m_city` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Rakenne taululle `t_transactionhistory`
--

CREATE TABLE `t_transactionhistory` (
  `ta_id` int(11) NOT NULL,
  `i_year` int(4) NOT NULL,
  `m_id` int(5) NOT NULL,
  `ta_refnumber1` varchar(9) NOT NULL DEFAULT '1',
  `ta_paid1` tinyint(1) NOT NULL DEFAULT '0',
  `ta_datepaid1` date DEFAULT NULL,
  `ta_refnumber2` varchar(9) NOT NULL DEFAULT '2',
  `ta_paid2` tinyint(1) NOT NULL DEFAULT '0',
  `ta_datepaid2` date DEFAULT NULL,
  `ta_refnumber3` varchar(9) NOT NULL DEFAULT '3',
  `ta_paid3` tinyint(1) NOT NULL DEFAULT '0',
  `ta_datepaid3` date DEFAULT NULL,
  `ta_refnumber4` varchar(9) NOT NULL DEFAULT '4',
  `ta_paid4` tinyint(1) NOT NULL DEFAULT '0',
  `ta_datepaid4` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_installments`
--
ALTER TABLE `t_installments`
  ADD PRIMARY KEY (`i_year`);

--
-- Indexes for table `t_members`
--
ALTER TABLE `t_members`
  ADD PRIMARY KEY (`m_id`),
  ADD KEY `m_active` (`m_active`);

--
-- Indexes for table `t_transactionhistory`
--
ALTER TABLE `t_transactionhistory`
  ADD PRIMARY KEY (`ta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_installments`
--
ALTER TABLE `t_installments`
  MODIFY `i_year` int(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_members`
--
ALTER TABLE `t_members`
  MODIFY `m_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_transactionhistory`
--
ALTER TABLE `t_transactionhistory`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
