-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2018 at 06:13 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital_bk`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
`id` int(11) NOT NULL,
  `dptname` varchar(30) NOT NULL,
  `hid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `dptname`, `hid`) VALUES
(1, 'อายุรกรรมชาย', '1'),
(2, 'อายุรกรรมหญิง', '1'),
(3, 'ศัลยกรรมชาย', '1'),
(4, 'ศัลยกรรมหญิง', '1'),
(5, 'ICU', '1'),
(6, 'LR', '1');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
`id` int(11) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `hid` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

CREATE TABLE `drug` (
`d_id` int(11) NOT NULL,
  `d_name` varchar(30) NOT NULL,
  `protein` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `en`
--

CREATE TABLE `en` (
`id` int(11) NOT NULL,
  `cal` int(11) NOT NULL,
  `nameE` varchar(50) NOT NULL,
  `cho` float DEFAULT NULL,
  `prot` float DEFAULT NULL,
  `fat` float DEFAULT NULL,
  `spec_dis` varchar(30) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `en`
--

INSERT INTO `en` (`id`, `cal`, `nameE`, `cho`, `prot`, `fat`, `spec_dis`) VALUES
(1, 1000, 'สูตรน้ำนม (C:P:F=50:20:30)', 125, 50, 33.33, NULL),
(2, 1000, 'สูตรนมถั่วเหลือง (C:P:F=50:20:30)', 125, 50, 33.33, NULL),
(3, 1000, 'BD สูตรผัก (C:P:F=55:15:30)', 137.5, 37.5, 33.33, 'ผู้ป่วยทั่วไป'),
(4, 1000, 'BD สูตรเบาหวาน (C:P:F=53:15:32)', 132.5, 37.5, 35.56, 'DM'),
(5, 1000, 'BD low protein/CKD (C:P:F=55:10:35)', 137.5, 25, 38.89, ' Low protein,CKD '),
(6, 1000, 'BD สูตรใช้เครื่องช่วยหายใจ  (C:P:F=45:20:35)', 112.5, 40, 38.89, 'Malabsoroption '),
(7, 1000, 'BD โปรตีนสูง: (C:P:F=50:20:30)', 125, 50, 33.33, 'Malabsoroption '),
(8, 1010, 'Peptamen', 125, 40, 39, 'Malabsoroption '),
(9, 34, 'sdfgsdf', 34, 345, 34, 'sdfgsdf');

-- --------------------------------------------------------

--
-- Table structure for table `formula`
--

CREATE TABLE `formula` (
`id` int(11) NOT NULL,
  `type` enum('enteral','PPN','TPN','') NOT NULL,
  `gen_name` varchar(20) NOT NULL,
  `total_cal` mediumint(9) NOT NULL,
  `CHO_cal` int(5) NOT NULL,
  `fat_cal` int(5) NOT NULL,
  `prot_cal` int(5) NOT NULL,
  `volume` int(4) NOT NULL,
  `n_npc` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
`id` int(11) NOT NULL,
  `hid` varchar(10) NOT NULL,
  `hosID` varchar(5) NOT NULL,
  `hosName` varchar(30) NOT NULL,
  `province` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `hid`, `hosID`, `hosName`, `province`) VALUES
(0, '0', '11119', 'จอมทอง', 'เชียงใหม่');

-- --------------------------------------------------------

--
-- Table structure for table `naf`
--

CREATE TABLE `naf` (
`screenid` mediumint(6) NOT NULL,
  `screendate` date DEFAULT NULL,
  `ward` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `screenNo` smallint(2) NOT NULL,
  `hosp` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `hid` varchar(5) CHARACTER SET utf8 NOT NULL,
  `HN` varchar(15) CHARACTER SET utf8 NOT NULL,
  `AN` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `Fname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Lname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(6) CHARACTER SET utf8 NOT NULL,
  `bw` float NOT NULL,
  `ht` float DEFAULT NULL,
  `ht_tell` int(5) DEFAULT NULL,
  `length` int(5) DEFAULT NULL,
  `arm` int(5) NOT NULL,
  `IBW` float NOT NULL,
  `bmi1` float DEFAULT NULL,
  `diag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ecog` varchar(100) CHARACTER SET utf8 NOT NULL,
  `alb` float DEFAULT NULL,
  `TLC` int(10) DEFAULT NULL,
  `shape` varchar(10) CHARACTER SET utf8 NOT NULL,
  `wt_change` float NOT NULL,
  `diet_type` varchar(50) CHARACTER SET utf8 NOT NULL,
  `diet_qnt` varchar(50) CHARACTER SET utf8 NOT NULL,
  `swallow` int(5) DEFAULT NULL,
  `GI` int(50) DEFAULT NULL,
  `vomit` int(5) DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dm` int(5) DEFAULT NULL,
  `cancer` int(5) DEFAULT NULL,
  `hip` int(5) DEFAULT NULL,
  `cva` int(5) DEFAULT NULL,
  `mulfx` int(5) DEFAULT NULL,
  `ckd` int(5) DEFAULT NULL,
  `chf` int(5) DEFAULT NULL,
  `sepsis` int(5) DEFAULT NULL,
  `copd` int(5) DEFAULT NULL,
  `hemato` int(5) DEFAULT NULL,
  `liver` int(5) DEFAULT NULL,
  `hi` int(5) DEFAULT NULL,
  `burn` int(5) DEFAULT NULL,
  `pneumo` int(5) DEFAULT NULL,
  `critical` int(5) DEFAULT NULL,
  `bw_s` int(5) DEFAULT NULL,
  `lab_s` int(5) DEFAULT NULL,
  `shape_s` int(5) NOT NULL,
  `wt_s` int(5) NOT NULL,
  `diet_s` int(5) NOT NULL,
  `gi_s` int(3) NOT NULL,
  `status_s` int(5) NOT NULL,
  `dis_s` int(11) NOT NULL,
  `score` tinyint(5) NOT NULL,
  `level` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `fat_req` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `vol_req` int(11) NOT NULL,
  `npc` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `doctor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reporter` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `result1` varchar(120) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `nrs2002`
--

CREATE TABLE `nrs2002` (
  `screenid` mediumint(6) NOT NULL DEFAULT '0',
  `screendate` date DEFAULT NULL,
  `ward` varchar(50) NOT NULL,
  `screenNo` smallint(2) NOT NULL,
  `HN` varchar(15) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `bw` int(11) NOT NULL,
  `ht` int(11) NOT NULL,
  `IBW` int(11) NOT NULL,
  `bmi1` float NOT NULL,
  `wt_type` varchar(15) CHARACTER SET armscii8 DEFAULT NULL,
  `wt_change` float NOT NULL,
  `wt_percent` float DEFAULT NULL,
  `wt_period` varchar(50) CHARACTER SET armscii8 NOT NULL,
  `diet_type` varchar(30) CHARACTER SET armscii8 NOT NULL,
  `intake` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `diag` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `diet_s` int(30) NOT NULL,
  `wt_score` int(5) NOT NULL,
  `bmi_s1` smallint(5) NOT NULL,
  `dis_s` int(11) NOT NULL,
  `age_score` smallint(6) NOT NULL,
  `score` tinyint(2) NOT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `vol_req` int(11) NOT NULL,
  `fat_req` int(11) DEFAULT NULL,
  `npc` varchar(15) CHARACTER SET armscii8 DEFAULT NULL,
  `doctor` varchar(50) NOT NULL,
  `reporter` varchar(50) CHARACTER SET armscii8 NOT NULL,
  `cancer` varchar(10) CHARACTER SET armscii8 DEFAULT NULL,
  `aids` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `ckd` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `heart` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `dm` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `bedsore` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `edema` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `liver` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `neuro` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `lung` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `ascites` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `ostomy` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `injury` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `spinal` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `peritonitis` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `infection` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `surgery` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `pancreas` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `burn` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `HI` varchar(100) CHARACTER SET armscii8 NOT NULL,
  `acute` smallint(6) NOT NULL,
  `chronic` smallint(6) NOT NULL,
  `other1` varchar(50) CHARACTER SET armscii8 DEFAULT NULL,
  `other` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `result1` varchar(100) CHARACTER SET armscii8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nt2013`
--

CREATE TABLE `nt2013` (
`screenid` int(15) NOT NULL,
  `screendate` date DEFAULT NULL,
  `ward` varchar(50) CHARACTER SET utf8 NOT NULL,
  `screenNo` smallint(2) NOT NULL,
  `hosp` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `hid` varchar(5) CHARACTER SET utf8 DEFAULT NULL,
  `HN` varchar(15) CHARACTER SET utf8 NOT NULL,
  `AN` varchar(10) DEFAULT NULL,
  `Fname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Lname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(6) CHARACTER SET utf8 NOT NULL,
  `bw` float NOT NULL,
  `ht` float NOT NULL,
  `UBW` float DEFAULT NULL,
  `IBW` float NOT NULL,
  `bmi1` float NOT NULL,
  `diag` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ecog` varchar(100) CHARACTER SET utf8 NOT NULL,
  `diet_type` varchar(100) CHARACTER SET utf8 NOT NULL,
  `diet_period` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `intake` varchar(100) CHARACTER SET utf8 NOT NULL,
  `diet_s` int(30) NOT NULL,
  `wt_type` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `wt_change` float NOT NULL,
  `wt_percent` float DEFAULT NULL,
  `wt_period` varchar(100) CHARACTER SET utf8 NOT NULL,
  `wtloss_s` int(11) DEFAULT NULL,
  `edema2` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `edema` tinyint(3) NOT NULL,
  `fatloss` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `fatloss2` int(11) NOT NULL,
  `mloss1` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mloss2` tinyint(3) NOT NULL,
  `mpower1` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `mpower2` tinyint(3) NOT NULL,
  `cancer` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `lung` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ckd` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `liver` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `aids` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ascites` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `bedsore` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `dm` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `neuro` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `chronic` smallint(6) NOT NULL,
  `heart` varchar(100) CHARACTER SET utf8 NOT NULL,
  `ostomy` varchar(100) CHARACTER SET utf8 NOT NULL,
  `injury` varchar(100) CHARACTER SET utf8 NOT NULL,
  `HI` varchar(100) CHARACTER SET utf8 NOT NULL,
  `spinal` varchar(100) CHARACTER SET utf8 NOT NULL,
  `burn` varchar(100) CHARACTER SET utf8 NOT NULL,
  `infection` varchar(100) CHARACTER SET utf8 NOT NULL,
  `surgery` varchar(100) CHARACTER SET utf8 NOT NULL,
  `pancreas` varchar(100) CHARACTER SET utf8 NOT NULL,
  `peritonitis` varchar(100) CHARACTER SET utf8 NOT NULL,
  `hepatitis` tinyint(3) NOT NULL,
  `NF` tinyint(3) NOT NULL,
  `acute` smallint(6) NOT NULL,
  `score` tinyint(2) NOT NULL,
  `level` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `other1` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `other2` tinyint(3) DEFAULT NULL,
  `result1` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `fat_req` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `vol_req` int(11) NOT NULL,
  `npc` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `doctor` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `reporter` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `pn`
--

CREATE TABLE `pn` (
`id` int(11) NOT NULL,
  `nameP` varchar(50) NOT NULL,
  `vol` int(11) NOT NULL,
  `cho` int(11) NOT NULL,
  `prot` int(11) NOT NULL,
  `fat` int(11) NOT NULL,
  `n` int(11) NOT NULL,
  `cal` int(11) NOT NULL,
  `Na` int(11) DEFAULT NULL,
  `K` int(11) DEFAULT NULL,
  `Ca` int(11) DEFAULT NULL,
  `Mg` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Cl` int(11) DEFAULT NULL,
  `Acetate` int(11) DEFAULT NULL,
  `SO4` int(11) DEFAULT NULL,
  `Z` int(11) DEFAULT NULL,
  `osmole` int(11) NOT NULL,
  `other` varchar(500) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pn`
--

INSERT INTO `pn` (`id`, `nameP`, `vol`, `cho`, `prot`, `fat`, `n`, `cal`, `Na`, `K`, `Ca`, `Mg`, `P`, `Cl`, `Acetate`, `SO4`, `Z`, `osmole`, `other`) VALUES
(1, '10% AMINOVEN', 500, 0, 50, 0, 8, 200, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(2, 'B-Fluid 1000ml', 1000, 75, 30, 0, 5, 420, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 750, NULL),
(3, 'SmofKabiven peripheral', 1448, 103, 46, 41, 7, 1000, 36, 28, 2, 5, 12, 32, 96, 5, 0, 850, NULL),
(4, '10% Aminoven', 500, 0, 50, 0, 8, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 990, 'central 17 d/min'),
(5, 'SmofKabiven-peripheral  (1.9L : 1300kcal)', 1904, 135, 60, 54, 10, 1300, 48, 36, 3, 6, 16, 42, 125, 6, 0, 850, 'fishoil rich O-3 8 gm'),
(6, 'Oliclinomel peripheral N4-1.5L', 1500, 120, 33, 30, 5, 910, 32, 24, 3, 3, 13, 50, 46, 0, 0, 750, 'NPC:N = 144, Shelf life 48 hr(Room temp)-7 d(2-8C)'),
(7, 'Oliclinomel peripheral N4-2L', 2000, 160, 44, 40, 7, 1215, 42, 32, 4, 4, 17, 66, 61, 0, 0, 750, 'NPC:N = 144, Shelf life 48 hr(Room temp)-7 d(2-8C)'),
(8, 'Oliclinomel peripheral N7-1L', 1000, 160, 40, 40, 7, 1200, 32, 24, 2, 2, 10, 48, 57, 0, 0, 1450, 'NPC:N=158, lipid Cal:NPC=38.5% ,Shelf life 48 hr(Room temp)-7 d(2-8C)'),
(9, 'Oliclinomel N7-central 1.5L', 1500, 240, 60, 300, 9, 1800, 48, 36, 3, 3, 15, 72, 86, 0, 0, 1450, 'NPC:N=158, lipid Cal:NPC=38.5%, Shelf life 48 hr(Room temp)-7 d(2-8C)'),
(10, 'Oliclinomel N7-central 2L', 2000, 320, 80, 80, 12, 2400, 64, 48, 4, 4, 20, 96, 114, 0, 0, 1450, 'NPC:N=158, lipid Cal:NPC=38.5%, Shelf life 48 hr(Room temp)-7 days (2-8C)'),
(12, 'B-Fluid 1000ml', 1000, 75, 30, 0, 5, 420, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 750, NULL),
(13, 'SmofKabiven peripheral', 1448, 103, 46, 41, 7, 1000, 36, 28, 2, 5, 12, 32, 96, 5, 0, 850, NULL),
(16, 'SmofKabiven -peripheral (1.5L :1000kcal)', 1448, 103, 46, 41, 7, 1000, 36, 28, 2, 5, 12, 32, 96, 5, 0, 850, NULL),
(17, '5% Aminoven', 500, 0, 25, 0, 4, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 495, 'peripheral 34d/min'),
(18, 'test of PN', 455, 3444, 33, 22, 44, 2332, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'asmdklfa;sdnkflnsd'),
(19, 'OARENTERAL TEST', 89, 989, 89, 9, 9, 9, 8, 8, 98, 98, 9, 9, 98, 9, 9, 8, 'SDFAKDJFNADS');

-- --------------------------------------------------------

--
-- Table structure for table `reporter`
--

CREATE TABLE `reporter` (
`id` int(11) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `screening`
--

CREATE TABLE `screening` (
`screenid` mediumint(6) NOT NULL,
  `screendate` date DEFAULT NULL,
  `ward` varchar(50) CHARACTER SET utf8 NOT NULL,
  `screenNo` smallint(2) NOT NULL,
  `HN` varchar(15) CHARACTER SET utf8 NOT NULL,
  `Fname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Lname` varchar(30) CHARACTER SET utf8 NOT NULL,
  `age` int(3) NOT NULL,
  `sex` varchar(6) CHARACTER SET utf8 NOT NULL,
  `bw` int(11) NOT NULL,
  `ht` int(11) NOT NULL,
  `IBW` int(11) NOT NULL,
  `bmi1` float NOT NULL,
  `wt_type` varchar(15) DEFAULT NULL,
  `wt_change` float NOT NULL,
  `wt_percent` float DEFAULT NULL,
  `wt_period` varchar(50) NOT NULL,
  `diet_type` varchar(30) NOT NULL,
  `intake` varchar(100) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `diet_s` int(30) NOT NULL,
  `wt_score` int(5) NOT NULL,
  `bmi_s1` smallint(5) NOT NULL,
  `dis_s` int(11) NOT NULL,
  `age_score` smallint(6) NOT NULL,
  `score` tinyint(2) NOT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `vol_req` int(11) NOT NULL,
  `fat_req` int(11) DEFAULT NULL,
  `npc` varchar(15) DEFAULT NULL,
  `doctor` varchar(50) CHARACTER SET utf8 NOT NULL,
  `reporter` varchar(50) NOT NULL,
  `cancer` varchar(10) DEFAULT NULL,
  `aids` varchar(100) DEFAULT NULL,
  `ckd` varchar(100) DEFAULT NULL,
  `heart` varchar(100) NOT NULL,
  `dm` varchar(100) NOT NULL,
  `bedsore` varchar(100) NOT NULL,
  `edema` varchar(100) NOT NULL,
  `liver` varchar(100) NOT NULL,
  `neuro` varchar(100) NOT NULL,
  `lung` varchar(100) NOT NULL,
  `ascites` varchar(100) NOT NULL,
  `ostomy` varchar(100) NOT NULL,
  `injury` varchar(100) NOT NULL,
  `spinal` varchar(100) NOT NULL,
  `peritonitis` varchar(100) NOT NULL,
  `infection` varchar(100) NOT NULL,
  `surgery` varchar(100) NOT NULL,
  `pancreas` varchar(100) NOT NULL,
  `burn` varchar(100) NOT NULL,
  `HI` varchar(100) NOT NULL,
  `acute` smallint(6) NOT NULL,
  `chronic` smallint(6) NOT NULL,
  `other1` varchar(50) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `result1` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `tbpatient`
--

CREATE TABLE `tbpatient` (
`id` int(11) NOT NULL,
  `HN` varchar(15) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `age` int(5) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `address` varchar(80) NOT NULL,
  `hid` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treat`
--

CREATE TABLE `treat` (
`id` int(11) NOT NULL,
  `HN` varchar(15) NOT NULL,
  `treat_No` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `Fname` varchar(30) DEFAULT NULL,
  `Lname` varchar(30) DEFAULT NULL,
  `risk` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `enteral` varchar(150) DEFAULT NULL,
  `parenteral` varchar(150) DEFAULT NULL,
  `cal_gain` int(11) DEFAULT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `vol_gain` int(11) DEFAULT NULL,
  `vol_req` int(11) DEFAULT NULL,
  `prot_gain` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `NPCratio` varchar(15) DEFAULT NULL,
  `en_cal` int(11) DEFAULT NULL,
  `pn_cal` int(11) DEFAULT NULL,
  `en_ratio` int(11) DEFAULT NULL,
  `en_pn2` varchar(100) DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `Tdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8;

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
`t_id` int(11) NOT NULL,
  `drug` varchar(30) NOT NULL,
  `total_prot` int(11) NOT NULL,
  `total_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `treatnt`
--

CREATE TABLE `treatnt` (
`id` int(11) NOT NULL,
  `hosp` varchar(30) NOT NULL,
  `HN` varchar(9) NOT NULL,
  `AN` varchar(10) DEFAULT NULL,
  `treat_No` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `Fname` varchar(30) DEFAULT NULL,
  `Lname` varchar(30) DEFAULT NULL,
  `risk` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `sex` varchar(15) DEFAULT NULL,
  `en1` varchar(150) DEFAULT NULL,
  `en2` varchar(150) DEFAULT NULL,
  `pn1` varchar(150) DEFAULT NULL,
  `pn2` varchar(150) DEFAULT NULL,
  `cal_gain` int(11) DEFAULT NULL,
  `cal_req` int(11) DEFAULT NULL,
  `vol_gain` int(11) DEFAULT NULL,
  `vol_req` int(11) DEFAULT NULL,
  `prot_gain` int(11) DEFAULT NULL,
  `prot_req` int(11) DEFAULT NULL,
  `fat_gain` int(11) DEFAULT NULL,
  `fat_req` int(11) DEFAULT NULL,
  `NPCratio` varchar(15) DEFAULT NULL,
  `en_cal` int(11) DEFAULT NULL,
  `pn_cal` int(11) DEFAULT NULL,
  `en_ratio` float DEFAULT NULL,
  `en_pn2` varchar(100) DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `Tdate` date NOT NULL,
  `conc` varchar(20) DEFAULT NULL,
  `er` int(11) DEFAULT NULL,
  `water` int(11) DEFAULT NULL,
  `pr1` int(11) DEFAULT NULL,
  `pr2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `triage`
--

CREATE TABLE `triage` (
`id` int(11) NOT NULL,
  `hn` varchar(9) NOT NULL,
  `ward` varchar(30) NOT NULL,
  `bw` decimal(5,0) NOT NULL,
  `ht` smallint(3) NOT NULL,
  `diet` varchar(10) NOT NULL,
  `wtloss` varchar(10) NOT NULL,
  `bmi` double(5,2) NOT NULL,
  `risk` varchar(20) NOT NULL,
  `Tdate` date NOT NULL,
  `reporter` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `triagenaf`
--

CREATE TABLE `triagenaf` (
`id` int(11) NOT NULL,
  `hosp` varchar(30) DEFAULT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `AN` varchar(10) DEFAULT NULL,
  `ward` varchar(30) DEFAULT NULL,
  `bw` decimal(5,0) NOT NULL,
  `ht` smallint(3) NOT NULL,
  `diet` varchar(10) NOT NULL,
  `wtloss` varchar(10) NOT NULL,
  `critical` varchar(20) NOT NULL,
  `bmi` double(5,2) NOT NULL,
  `score` int(11) NOT NULL,
  `risk` varchar(20) NOT NULL,
  `Tdate` date DEFAULT NULL,
  `reporter` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `triagent`
--

CREATE TABLE `triagent` (
`id` int(11) NOT NULL,
  `hosp` varchar(30) DEFAULT NULL,
  `hid` varchar(5) DEFAULT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `AN` varchar(10) DEFAULT NULL,
  `ward` varchar(30) DEFAULT NULL,
  `bw` decimal(5,0) NOT NULL,
  `ht` smallint(3) NOT NULL,
  `diet` varchar(10) NOT NULL,
  `wtloss` varchar(10) NOT NULL,
  `critical` varchar(20) NOT NULL,
  `bmi` double(5,2) NOT NULL,
  `score` int(11) NOT NULL,
  `risk` varchar(20) NOT NULL,
  `Tdate` date DEFAULT NULL,
  `reporter` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
`uid` int(11) NOT NULL,
  `hid` varchar(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pw` varchar(8) NOT NULL,
  `level` int(1) NOT NULL,
  `Fname` varchar(30) NOT NULL,
  `Lname` varchar(30) NOT NULL,
  `mail` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `hid`, `uname`, `pw`, `level`, `Fname`, `Lname`, `mail`) VALUES
(0, '0', 'admin', 'admin', 3, 'admin', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `drug`
--
ALTER TABLE `drug`
 ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `en`
--
ALTER TABLE `en`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formula`
--
ALTER TABLE `formula`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `gen_name` (`gen_name`);

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
 ADD PRIMARY KEY (`id`), ADD KEY `hid` (`hid`);

--
-- Indexes for table `naf`
--
ALTER TABLE `naf`
 ADD PRIMARY KEY (`screenid`), ADD UNIQUE KEY `screenid` (`screenid`);

--
-- Indexes for table `nt2013`
--
ALTER TABLE `nt2013`
 ADD PRIMARY KEY (`screenid`), ADD UNIQUE KEY `screenid` (`screenid`);

--
-- Indexes for table `pn`
--
ALTER TABLE `pn`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reporter`
--
ALTER TABLE `reporter`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `screening`
--
ALTER TABLE `screening`
 ADD PRIMARY KEY (`screenid`), ADD UNIQUE KEY `screenid` (`screenid`);

--
-- Indexes for table `tbpatient`
--
ALTER TABLE `tbpatient`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treat`
--
ALTER TABLE `treat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
 ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `treatnt`
--
ALTER TABLE `treatnt`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `triage`
--
ALTER TABLE `triage`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `triagenaf`
--
ALTER TABLE `triagenaf`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `triagent`
--
ALTER TABLE `triagent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `drug`
--
ALTER TABLE `drug`
MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `en`
--
ALTER TABLE `en`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `formula`
--
ALTER TABLE `formula`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `naf`
--
ALTER TABLE `naf`
MODIFY `screenid` mediumint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `nt2013`
--
ALTER TABLE `nt2013`
MODIFY `screenid` int(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pn`
--
ALTER TABLE `pn`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `reporter`
--
ALTER TABLE `reporter`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `screening`
--
ALTER TABLE `screening`
MODIFY `screenid` mediumint(6) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbpatient`
--
ALTER TABLE `tbpatient`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treat`
--
ALTER TABLE `treat`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `treatnt`
--
ALTER TABLE `treatnt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `triage`
--
ALTER TABLE `triage`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `triagenaf`
--
ALTER TABLE `triagenaf`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `triagent`
--
ALTER TABLE `triagent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
