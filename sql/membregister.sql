-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06.11.2017 klo 08:30
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
SELECT m_id FROM t_members WHERE m_active<>0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActiveMembers` ()  NO SQL
    COMMENT 'Showing IDs and names of all active members'
SELECT m_id, m_lastname, m_firstname, m_active FROM t_members WHERE m_active<>0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getActiveNames` ()  NO SQL
    COMMENT 'Getting the names of active members'
SELECT m_firstname, m_lastname FROM t_members WHERE m_active<>0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAllMembers` ()  NO SQL
    COMMENT 'Showing IDs, Names, and activity of all members'
SELECT m_id, m_lastname, m_firstname, m_active FROM t_members$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getFirstName` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Getting specific firstname'
SELECT m_firstname FROM t_members WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getLastName` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Getting specific lastname'
SELECT m_lastname FROM t_members WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getNames` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Get last and first name of specific ID'
SELECT m_lastname, m_firstname FROM t_members WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getRefdata` (IN `newyear` INT(4) UNSIGNED)  NO SQL
    COMMENT 'Selecting reference number info'
SELECT ta_id, m_id, ta_refnumber1, ta_refnumber2, ta_refnumber3, ta_refnumber4 FROM t_transactionhistory WHERE i_year=newyear$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getTAData` (IN `newyear` INT(4) UNSIGNED)  NO SQL
    COMMENT 'Get IDs, Refnumbers and Paid(bool)s of a year'
SELECT m_id, ta_refnumber1, ta_paid1, ta_refnumber2, ta_paid2, ta_refnumber3, ta_paid3, ta_refnumber4, ta_paid4 FROM t_transactionhistory WHERE i_year=newyear$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewMemberWBD` (IN `firstname` VARCHAR(255) CHARSET utf8mb4, IN `lastname` VARCHAR(255) CHARSET utf8mb4, IN `birthday` DATE)  NO SQL
    COMMENT 'Inserting a new member with birthdate'
INSERT INTO t_members (m_firstname, m_lastname, m_birthdate) VALUES (firstname, lastname, birthday)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertNewMemberWOBD` (IN `firstname` VARCHAR(255) CHARSET utf8mb4, IN `lastname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Adding a new member'
INSERT INTO t_members (m_firstname, m_lastname) VALUES (firstName, lastName)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `newTransactionRow` (IN `id` INT(5) UNSIGNED, IN `newyear` INT(4) UNSIGNED)  NO SQL
    COMMENT 'Adding a new row to transactionhistory table'
INSERT INTO t_transactionhistory (i_year, m_id) VALUES (newyear, id)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setActive` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Setting member active'
UPDATE t_members SET m_active=1 WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `setInactive` (IN `id` INT(5) UNSIGNED)  NO SQL
    COMMENT 'Setting member inactive'
UPDATE t_members SET m_active=0 WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateAddress` (IN `id` INT(5) UNSIGNED, IN `address` VARCHAR(255) CHARSET utf8mb4, IN `city` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating address of a member'
UPDATE t_members SET m_address=address, m_city=city WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBirthdate` (IN `id` INT(5) UNSIGNED, IN `birthday` DATE)  NO SQL
    COMMENT 'Updating birthdate'
UPDATE t_members SET m_birthdate=birthday WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateEmail` (IN `id` INT(5) UNSIGNED, IN `email` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating email of a member'
UPDATE m_members SET m_email=email WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateFName` (IN `id` INT(5) UNSIGNED, IN `firstname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating first name'
UPDATE t_members SET m_firstname=firstname WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateLName` (IN `id` INT(5) UNSIGNED, IN `lastname` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating last name'
UPDATE t_members SET m_lastname=lastname WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePhone` (IN `id` INT(5) UNSIGNED, IN `phonenumber` VARCHAR(255) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating phonenumber'
UPDATE t_members SET m_phone=phonenumber WHERE m_id=id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateRefNumbers` (IN `id` INT(5) UNSIGNED, IN `ref1` VARCHAR(9) CHARSET utf8mb4, IN `ref2` VARCHAR(9) CHARSET utf8mb4, IN `ref3` VARCHAR(9) CHARSET utf8mb4, IN `ref4` VARCHAR(9) CHARSET utf8mb4)  NO SQL
    COMMENT 'Updating reference numbers of individual member/year'
UPDATE t_transactionhistory SET ta_refnumber1=ref1, ta_refnumber2=ref2, ta_refnumber3=ref3, ta_refnumber4=ref4 WHERE ta_id=id$$

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
  `m_firstname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `m_lastname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `m_active` tinyint(1) NOT NULL DEFAULT '1',
  `m_birthdate` date DEFAULT NULL,
  `m_phone` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `m_email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `m_address` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `m_city` varchar(255) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_swedish_ci;

--
-- Vedos taulusta `t_members`
--

INSERT INTO `t_members` (`m_id`, `m_firstname`, `m_lastname`, `m_active`, `m_birthdate`, `m_phone`, `m_email`, `m_address`, `m_city`) VALUES
(1, 'Pertti', 'Pesusieni', 1, NULL, NULL, NULL, '', ''),
(2, 'Bob', 'Builder', 0, NULL, NULL, NULL, '', ''),
(3, 'Tuomas', 'Veturi', 1, NULL, NULL, NULL, '', ''),
(4, 'Matti', 'Meikäläinen', 1, NULL, NULL, NULL, NULL, NULL),
(5, 'herp', 'derp', 1, NULL, NULL, NULL, NULL, NULL),
(6, 'derp', 'herp', 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Caren', 'Crocket', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Crocket', 'Aisha', 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Aisha', 'Canter', 1, NULL, NULL, NULL, NULL, NULL),
(10, 'Canter', 'Nicholas', 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Nicholas', 'Crabb', 1, NULL, NULL, NULL, NULL, NULL),
(12, 'Crabb', 'Hugo', 1, NULL, NULL, NULL, NULL, NULL),
(13, 'Hugo', 'Abshire', 1, NULL, NULL, NULL, NULL, NULL),
(14, 'Abshire', 'Vivienne', 1, NULL, NULL, NULL, NULL, NULL),
(15, 'Vivienne', 'Hakes', 1, NULL, NULL, NULL, NULL, NULL),
(16, 'Hakes', 'Lashunda', 1, NULL, NULL, NULL, NULL, NULL),
(17, 'Lashunda', 'Knopf', 1, NULL, NULL, NULL, NULL, NULL),
(18, 'Knopf', 'Chanell', 1, NULL, NULL, NULL, NULL, NULL),
(19, 'Chanell', 'Keesee', 1, NULL, NULL, NULL, NULL, NULL),
(20, 'Keesee', 'Lyman', 1, NULL, NULL, NULL, NULL, NULL),
(21, 'Lyman', 'Graves', 1, NULL, NULL, NULL, NULL, NULL),
(22, 'Graves', 'Jacque', 1, NULL, NULL, NULL, NULL, NULL),
(23, 'Jacque', 'Rodden', 1, NULL, NULL, NULL, NULL, NULL),
(24, 'Rodden', '\r\n    Sherise', 1, NULL, NULL, NULL, NULL, NULL),
(25, '\r\n    Sherise', ' Button', 1, NULL, NULL, NULL, NULL, NULL),
(26, ' Button', '\r\n    Shonna', 1, NULL, NULL, NULL, NULL, NULL),
(27, '\r\n    Shonna', ' Swinford', 1, NULL, NULL, NULL, NULL, NULL),
(28, ' Swinford', '\r\n    Doria', 1, NULL, NULL, NULL, NULL, NULL),
(29, '\r\n    Doria', ' Reinoso', 1, NULL, NULL, NULL, NULL, NULL),
(30, ' Reinoso', '\r\n    Jettie', 1, NULL, NULL, NULL, NULL, NULL),
(31, '\r\n    Jettie', ' Stegner', 1, NULL, NULL, NULL, NULL, NULL),
(32, ' Stegner', '\r\n    Stephane', 1, NULL, NULL, NULL, NULL, NULL),
(33, '\r\n    Stephane', ' Crosswhite', 1, NULL, NULL, NULL, NULL, NULL),
(34, ' Crosswhite', '\r\n    Yuette', 1, NULL, NULL, NULL, NULL, NULL),
(35, '\r\n    Yuette', ' Litton', 1, NULL, NULL, NULL, NULL, NULL),
(36, ' Litton', '\r\n    Danille', 1, NULL, NULL, NULL, NULL, NULL),
(37, '\r\n    Danille', ' Selvy', 1, NULL, NULL, NULL, NULL, NULL),
(38, ' Selvy', '\r\n    Hiroko', 1, NULL, NULL, NULL, NULL, NULL),
(39, '\r\n    Hiroko', ' Pruitt', 1, NULL, NULL, NULL, NULL, NULL),
(40, ' Pruitt', '\r\n    Hailey', 1, NULL, NULL, NULL, NULL, NULL),
(41, '\r\n    Hailey', ' Bezio', 1, NULL, NULL, NULL, NULL, NULL),
(42, ' Bezio', '\r\n    Sondra', 1, NULL, NULL, NULL, NULL, NULL),
(43, '\r\n    Sondra', ' Slankard', 1, NULL, NULL, NULL, NULL, NULL),
(44, ' Slankard', '\r\n    Cristen', 1, NULL, NULL, NULL, NULL, NULL),
(45, '\r\n    Cristen', ' Perales', 1, NULL, NULL, NULL, NULL, NULL),
(46, ' Perales', '\r\n    Fumiko', 1, NULL, NULL, NULL, NULL, NULL),
(47, '\r\n    Fumiko', ' Nolen', 1, NULL, NULL, NULL, NULL, NULL),
(48, ' Nolen', '\r\n    Maryellen', 1, NULL, NULL, NULL, NULL, NULL),
(49, '\r\n    Maryellen', ' Engelbrecht', 1, NULL, NULL, NULL, NULL, NULL),
(50, ' Engelbrecht', '\r\n    Jannie', 1, NULL, NULL, NULL, NULL, NULL),
(51, '\r\n    Jannie', ' Desrochers', 1, NULL, NULL, NULL, NULL, NULL),
(52, ' Desrochers', '\r\n    Jadwiga', 1, NULL, NULL, NULL, NULL, NULL),
(53, '\r\n    Jadwiga', ' Malo', 1, NULL, NULL, NULL, NULL, NULL),
(54, ' Malo', '\r\n    Melanie', 1, NULL, NULL, NULL, NULL, NULL),
(55, '\r\n    Melanie', ' Pearse', 1, NULL, NULL, NULL, NULL, NULL),
(56, ' Pearse', '\r\n    Ruthann', 1, NULL, NULL, NULL, NULL, NULL);

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
-- Vedos taulusta `t_transactionhistory`
--

INSERT INTO `t_transactionhistory` (`ta_id`, `i_year`, `m_id`, `ta_refnumber1`, `ta_paid1`, `ta_datepaid1`, `ta_refnumber2`, `ta_paid2`, `ta_datepaid2`, `ta_refnumber3`, `ta_paid3`, `ta_datepaid3`, `ta_refnumber4`, `ta_paid4`, `ta_datepaid4`) VALUES
(1, 2017, 1, '201700114', 0, NULL, '201700127', 0, NULL, '201700130', 0, NULL, '201700143', 0, NULL),
(2, 2017, 2, '201700211', 0, NULL, '201700224', 0, NULL, '201700237', 0, NULL, '201700240', 0, NULL),
(3, 2017, 3, '201700318', 0, NULL, '201700321', 0, NULL, '201700334', 0, NULL, '201700347', 0, NULL),
(4, 2017, 4, '201700415', 0, NULL, '201700428', 0, NULL, '201700431', 0, NULL, '201700444', 0, NULL);

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
  MODIFY `m_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `t_transactionhistory`
--
ALTER TABLE `t_transactionhistory`
  MODIFY `ta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
