-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 05:04 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int(11) NOT NULL,
  `Name` varchar(500) DEFAULT NULL,
  `Employeecode` varchar(500) NOT NULL,
  `Department` text NOT NULL,
  `DateofBirth` date DEFAULT NULL,
  `JoiningDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_info`
--

INSERT INTO `employee_info` (`id`, `Name`, `Employeecode`, `Department`, `DateofBirth`, `JoiningDate`) VALUES
(369, 'employee1', 'EMP001', 'Development', '1993-10-12', '2019-01-10'),
(370, 'employee2', 'EMP002', 'Design', '1989-08-30', '2016-02-20'),
(371, 'employee3', 'EMP003', 'Financial', '1992-05-25', '2019-01-10'),
(372, 'employee4', 'EMP004', 'Development', '1984-07-12', '2018-05-13'),
(373, 'employee5', 'EMP005', 'Design', '1990-01-10', '2017-04-10'),
(374, 'employee6', 'EMP006', 'Financial', '1994-02-11', '2020-12-11'),
(375, 'employee7', 'EMP007', 'Financial', '1993-12-10', '2020-12-12'),
(376, 'employee8', 'EMP008', 'Development', '1993-04-25', '2020-12-13'),
(377, 'employee9', 'EMP009', 'Development', '1990-03-12', '2020-12-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=378;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
