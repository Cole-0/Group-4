-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2024 at 08:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbmonitoringsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_seminar`
--

CREATE TABLE `add_seminar` (
  `id` int(100) NOT NULL,
  `id_info` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `place` varchar(50) NOT NULL,
  `nature_training` varchar(50) NOT NULL,
  `certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(100) NOT NULL,
  `id_info` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `place` varchar(50) NOT NULL,
  `nature` varchar(50) NOT NULL,
  `certificate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `id_info`, `title`, `date`, `place`, `nature`, `certificate`) VALUES
(3, 0, 'asdasd', '2024-04-16', 'asdasd', 'asdas', 'dasdas'),
(5, 0, 'testnew', '2024-04-15', 'parst', 'participant', 'certers'),
(7, 0, 'adwdaw', '2024-04-07', 'adwadw', 'participant', 'asdasda'),
(8, 0, 'last', '2024-04-23', 'adwa12321132', 'speaker', 'asda112231'),
(9, 0, 'nigga', '2024-04-21', 'nigga', 'speaker', 'nigga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `UID` int(11) NOT NULL,
  `fname` tinytext NOT NULL,
  `lname` tinytext NOT NULL,
  `contactno` int(11) NOT NULL,
  `course` tinytext NOT NULL,
  `password` varchar(1000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activation_code` mediumint(9) NOT NULL,
  `status` enum('1','2','3','') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`UID`, `fname`, `lname`, `contactno`, `course`, `password`, `email`, `activation_code`, `status`) VALUES
(53, 'Nyxen', 'Test', 2147483647, 'BSIT', '$2y$10$cFf3Orh17/o71Lu0/Nqyc.PK2TjDcpabcjnP4cejyc6IlQOE6XTI2', 'testdumm18@gmail.com', 58494, '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_seminar`
--
ALTER TABLE `add_seminar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_info` (`id_info`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_info` (`id_info`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_seminar`
--
ALTER TABLE `add_seminar`
  ADD CONSTRAINT `add_seminar_ibfk_1` FOREIGN KEY (`id_info`) REFERENCES `add_seminar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
