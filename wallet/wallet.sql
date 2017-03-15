-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2017 at 06:54 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '$2y$12$m02X9RSkCR6J.3SETSSKCe5SvMTX2ZVEunsEM9mtxmGv5qRgotWKK');

-- --------------------------------------------------------

--
-- Table structure for table `examsection`
--

CREATE TABLE `examsection` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `examsection`
--

INSERT INTO `examsection` (`id`, `username`, `password`) VALUES
(1, 'examsection', '$2y$12$m02X9RSkCR6J.3SETSSKCe5SvMTX2ZVEunsEM9mtxmGv5qRgotWKK');

-- --------------------------------------------------------

--
-- Table structure for table `exam_transactions`
--

CREATE TABLE `exam_transactions` (
  `exam_id` varchar(500) NOT NULL,
  `s_id` varchar(50) NOT NULL,
  `is_regular` tinyint(1) NOT NULL,
  `subjects` varchar(700) NOT NULL,
  `amount` int(6) NOT NULL,
  `datetime` datetime NOT NULL,
  `t_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_transactions`
--

INSERT INTO `exam_transactions` (`exam_id`, `s_id`, `is_regular`, `subjects`, `amount`, `datetime`, `t_id`) VALUES
('1-1 reguler r16', '134G1A0565', 1, 'All', 750, '2017-03-02 09:18:48', 204),
('dasd', '134G1A0565', 0, 'rohith', 350, '2017-03-03 18:34:28', 302),
('dsfsdfdssfs', '134G1A0565', 1, 'All', 750, '2017-03-03 18:34:04', 301);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(1) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `username`, `password`) VALUES
(1, 'faculty', '$2y$12$m02X9RSkCR6J.3SETSSKCe5SvMTX2ZVEunsEM9mtxmGv5qRgotWKK');

-- --------------------------------------------------------

--
-- Table structure for table `regular_exams`
--

CREATE TABLE `regular_exams` (
  `name` varchar(200) NOT NULL,
  `regulation` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `amount` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regular_exams`
--

INSERT INTO `regular_exams` (`name`, `regulation`, `semester`, `amount`) VALUES
('dsfsdfdssfs', 'r16', '2-2', '750');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `rollno` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `branch` varchar(6) NOT NULL,
  `regulation` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `amount` int(5) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`rollno`, `name`, `branch`, `regulation`, `email`, `amount`, `password`) VALUES
('134G1A0565', 'ROHITH', 'CSE', 'R13', '134g1a0565@srit.ac.in', 55850, '$2y$12$m02X9RSkCR6J.3SETSSKCe5SvMTX2ZVEunsEM9mtxmGv5qRgotWKK'),
('dfadsf', 'dfsfs', 'CIV', 'dfs', 'dfsf@gmail.com', 0, '$2y$12$ZmnzQADXjaqKRtcF0whAlO3Gr2V2QlJxbzkTpL5YnXl0H/tt9AaJC');

-- --------------------------------------------------------

--
-- Table structure for table `supply_exams`
--

CREATE TABLE `supply_exams` (
  `name` varchar(500) NOT NULL,
  `regulation` varchar(10) NOT NULL,
  `branch` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `num_subjects` int(2) NOT NULL,
  `sub_names` varchar(1000) NOT NULL,
  `amounts` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_exams`
--

INSERT INTO `supply_exams` (`name`, `regulation`, `branch`, `semester`, `num_subjects`, `sub_names`, `amounts`) VALUES
('dasd', 'r16', 'cse', '2/-2', 1, 'rohith', '350');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `t_id` int(6) NOT NULL,
  `f_id` int(6) NOT NULL,
  `s_id` varchar(15) NOT NULL,
  `is_debited` tinyint(1) NOT NULL,
  `amount` int(6) NOT NULL,
  `datetime` datetime NOT NULL,
  `reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`t_id`, `f_id`, `s_id`, `is_debited`, `amount`, `datetime`, `reason`) VALUES
(181, 1, '134G1A0565', 0, 5000, '2017-02-28 17:29:38', 'Rs.5000 credited to 134G1A0565'),
(182, 1, '134G1A0565', 1, 200, '2017-02-28 17:29:42', 'Rs.200 debited from 134G1A0565'),
(183, 20, '134G1A0565', 1, 750, '2017-02-28 17:33:33', 'Rs.750 debited from 134G1A0565 for 1-1 reguler r16'),
(184, 20, '134G1A0565', 1, 650, '2017-02-28 17:33:59', 'Rs.650 debited from 134G1A0565 for 2-2 SUPPLY r17'),
(185, 1, '134G1A0565', 0, 500, '2017-03-01 09:53:03', 'Rs.500 credited to 134G1A0565'),
(186, 1, '134G1A0565', 1, 100, '2017-03-01 09:53:52', 'Rs.100 debited from 134G1A0565'),
(187, 1, '134G1A0565', 0, 500, '2017-03-01 10:44:41', 'Rs.500 credited to 134G1A0565'),
(188, 1, '134G1A0565', 1, 500, '2017-03-01 10:44:48', 'Rs.500 debited from 134G1A0565'),
(189, 1, '134G1A0565', 0, 500, '2017-03-01 10:45:22', 'Rs.500 credited to 134G1A0565'),
(190, 1, '134G1A0565', 1, 500, '2017-03-01 10:45:23', 'Rs.500 debited from 134G1A0565'),
(191, 1, '134G1A0565', 1, 500, '2017-03-01 10:45:26', 'Rs.500 debited from 134G1A0565'),
(192, 1, '134G1A0565', 1, 500, '2017-03-01 10:45:27', 'Rs.500 debited from 134G1A0565'),
(193, 1, '134G1A0565', 0, 500, '2017-03-01 11:13:50', 'Rs.500 credited to 134G1A0565'),
(194, 1, '134G1A0565', 1, 500, '2017-03-01 11:13:54', 'Rs.500 debited from 134G1A0565'),
(195, 1, '134G1A0565', 0, 500, '2017-03-01 14:23:37', 'Rs.500 credited to 134G1A0565'),
(196, 1, '134G1A0565', 1, 400, '2017-03-01 14:23:42', 'Rs.400 debited from 134G1A0565'),
(198, 1, '134G1A0565', 0, 500, '2017-03-01 15:01:45', 'Rs.500 credited to 134G1A0565'),
(199, 1, '134G1A0565', 1, 500, '2017-03-01 15:01:54', 'Rs.500 debited from 134G1A0565'),
(200, 1, '134G1A0565', 0, 500, '2017-03-01 15:21:27', 'Rs.500 credited to 134G1A0565'),
(201, 1, '134G1A0565', 1, 200, '2017-03-01 15:21:42', 'Rs.200 debited from 134G1A0565'),
(204, 20, '134G1A0565', 1, 750, '2017-03-02 09:18:48', 'Rs.750 debited from 134G1A0565 for 1-1 reguler r16'),
(205, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:50', 'Rs.500 credited to 134G1A0565'),
(206, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:51', 'Rs.500 credited to 134G1A0565'),
(207, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:52', 'Rs.500 credited to 134G1A0565'),
(208, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:52', 'Rs.500 credited to 134G1A0565'),
(209, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:52', 'Rs.500 credited to 134G1A0565'),
(210, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:53', 'Rs.500 credited to 134G1A0565'),
(211, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:53', 'Rs.500 credited to 134G1A0565'),
(212, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:53', 'Rs.500 credited to 134G1A0565'),
(213, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:53', 'Rs.500 credited to 134G1A0565'),
(214, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:53', 'Rs.500 credited to 134G1A0565'),
(215, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:54', 'Rs.500 credited to 134G1A0565'),
(216, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:54', 'Rs.500 credited to 134G1A0565'),
(217, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:54', 'Rs.500 credited to 134G1A0565'),
(218, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:54', 'Rs.500 credited to 134G1A0565'),
(219, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:54', 'Rs.500 credited to 134G1A0565'),
(220, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:55', 'Rs.500 credited to 134G1A0565'),
(221, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:55', 'Rs.500 credited to 134G1A0565'),
(222, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:55', 'Rs.500 credited to 134G1A0565'),
(223, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:55', 'Rs.500 credited to 134G1A0565'),
(224, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:55', 'Rs.500 credited to 134G1A0565'),
(225, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(226, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(227, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(228, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(229, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(230, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:56', 'Rs.500 credited to 134G1A0565'),
(231, 1, '134G1A0565', 0, 500, '2017-03-02 10:38:57', 'Rs.500 credited to 134G1A0565'),
(232, 1, '134G1A0565', 0, 500, '2017-03-02 10:40:58', 'Rs.500 credited to 134G1A0565'),
(233, 1, '134G1A0565', 0, 500, '2017-03-02 10:41:55', 'Rs.500 credited to 134G1A0565'),
(234, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:20', 'Rs.500 credited to 134G1A0565'),
(235, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:21', 'Rs.500 credited to 134G1A0565'),
(236, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:21', 'Rs.500 credited to 134G1A0565'),
(237, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:21', 'Rs.500 credited to 134G1A0565'),
(238, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:22', 'Rs.500 credited to 134G1A0565'),
(239, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:22', 'Rs.500 credited to 134G1A0565'),
(240, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:22', 'Rs.500 credited to 134G1A0565'),
(241, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:22', 'Rs.500 credited to 134G1A0565'),
(242, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:23', 'Rs.500 credited to 134G1A0565'),
(243, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:23', 'Rs.500 credited to 134G1A0565'),
(244, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:23', 'Rs.500 credited to 134G1A0565'),
(245, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:23', 'Rs.500 credited to 134G1A0565'),
(246, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:23', 'Rs.500 credited to 134G1A0565'),
(247, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:24', 'Rs.500 credited to 134G1A0565'),
(248, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:24', 'Rs.500 credited to 134G1A0565'),
(249, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:24', 'Rs.500 credited to 134G1A0565'),
(250, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:24', 'Rs.500 credited to 134G1A0565'),
(251, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:25', 'Rs.500 credited to 134G1A0565'),
(252, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:25', 'Rs.500 credited to 134G1A0565'),
(253, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:25', 'Rs.500 credited to 134G1A0565'),
(254, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:28', 'Rs.500 credited to 134G1A0565'),
(255, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:29', 'Rs.500 credited to 134G1A0565'),
(256, 1, '134G1A0565', 0, 500, '2017-03-02 10:42:29', 'Rs.500 credited to 134G1A0565'),
(257, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:07', 'Rs.500 credited to 134G1A0565'),
(258, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:08', 'Rs.500 credited to 134G1A0565'),
(259, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:08', 'Rs.500 credited to 134G1A0565'),
(260, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:08', 'Rs.500 credited to 134G1A0565'),
(261, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:08', 'Rs.500 credited to 134G1A0565'),
(262, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:08', 'Rs.500 credited to 134G1A0565'),
(263, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(264, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(265, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(266, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(267, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(268, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:09', 'Rs.500 credited to 134G1A0565'),
(269, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:10', 'Rs.500 credited to 134G1A0565'),
(270, 1, '134G1A0565', 0, 500, '2017-03-02 10:43:10', 'Rs.500 credited to 134G1A0565'),
(271, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:41', 'Rs.500 credited to 134G1A0565'),
(272, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:42', 'Rs.500 credited to 134G1A0565'),
(273, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:42', 'Rs.500 credited to 134G1A0565'),
(274, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:42', 'Rs.500 credited to 134G1A0565'),
(275, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:43', 'Rs.500 credited to 134G1A0565'),
(276, 1, '134G1A0565', 0, 500, '2017-03-02 11:53:43', 'Rs.500 credited to 134G1A0565'),
(277, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:10', 'Rs.500 credited to 134G1A0565'),
(278, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:11', 'Rs.500 credited to 134G1A0565'),
(279, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:11', 'Rs.500 credited to 134G1A0565'),
(280, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:11', 'Rs.500 credited to 134G1A0565'),
(281, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:11', 'Rs.500 credited to 134G1A0565'),
(282, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:12', 'Rs.500 credited to 134G1A0565'),
(283, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:12', 'Rs.500 credited to 134G1A0565'),
(284, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:12', 'Rs.500 credited to 134G1A0565'),
(285, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:12', 'Rs.500 credited to 134G1A0565'),
(286, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:13', 'Rs.500 credited to 134G1A0565'),
(287, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:13', 'Rs.500 credited to 134G1A0565'),
(288, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:13', 'Rs.500 credited to 134G1A0565'),
(289, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:13', 'Rs.500 credited to 134G1A0565'),
(290, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:13', 'Rs.500 credited to 134G1A0565'),
(291, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:41', 'Rs.500 credited to 134G1A0565'),
(292, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:41', 'Rs.500 credited to 134G1A0565'),
(293, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:51', 'Rs.500 credited to 134G1A0565'),
(294, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:52', 'Rs.500 credited to 134G1A0565'),
(295, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:52', 'Rs.500 credited to 134G1A0565'),
(296, 1, '134G1A0565', 0, 500, '2017-03-02 12:03:52', 'Rs.500 credited to 134G1A0565'),
(297, 1, '134G1A0565', 0, 5000, '2017-03-02 12:03:55', 'Rs.5000 credited to 134G1A0565'),
(298, 1, '134G1A0565', 0, 5000, '2017-03-02 12:03:55', 'Rs.5000 credited to 134G1A0565'),
(299, 1, '134G1A0565', 0, 500, '2017-03-03 18:33:15', 'Rs.500 credited to 134G1A0565'),
(300, 1, '134G1A0565', 1, 500, '2017-03-03 18:33:19', 'Rs.500 debited from 134G1A0565'),
(301, 20, '134G1A0565', 1, 750, '2017-03-03 18:34:04', 'Rs.750 debited from 134G1A0565 for dsfsdfdssfs'),
(302, 20, '134G1A0565', 1, 350, '2017-03-03 18:34:28', 'Rs.350 debited from 134G1A0565 for dasd'),
(303, 1, '134G1A0565', 0, 500, '2017-03-04 11:11:44', 'Rs.500 credited to 134G1A0565'),
(304, 1, '134G1A0565', 1, 500, '2017-03-04 11:11:48', 'Rs.500 debited from 134G1A0565'),
(305, 1, '134G1A0565', 1, 500, '2017-03-04 11:11:49', 'Rs.500 debited from 134G1A0565'),
(306, 1, '134G1A0565', 1, 500, '2017-03-04 11:11:49', 'Rs.500 debited from 134G1A0565'),
(307, 1, '134G1A0565', 1, 500, '2017-03-04 11:11:49', 'Rs.500 debited from 134G1A0565');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `examsection`
--
ALTER TABLE `examsection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_transactions`
--
ALTER TABLE `exam_transactions`
  ADD PRIMARY KEY (`s_id`,`exam_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regular_exams`
--
ALTER TABLE `regular_exams`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`rollno`);

--
-- Indexes for table `supply_exams`
--
ALTER TABLE `supply_exams`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `examsection`
--
ALTER TABLE `examsection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `t_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
