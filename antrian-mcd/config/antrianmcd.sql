-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 04:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrianmcd`
--

-- --------------------------------------------------------

--
-- Table structure for table `an_trian`
--

CREATE TABLE `an_trian` (
  `id` int(6) NOT NULL,
  `waktu_datang` time NOT NULL,
  `selisihkedatangan` int(6) NOT NULL,
  `awal_pelayanan` time NOT NULL,
  `selisihpelayanankasir` int(6) NOT NULL,
  `keluar` time NOT NULL,
  `selisihkeluarantrian` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `an_trian`
--

INSERT INTO `an_trian` (`id`, `waktu_datang`, `selisihkedatangan`, `awal_pelayanan`, `selisihpelayanankasir`, `keluar`, `selisihkeluarantrian`) VALUES
(43, '21:01:00', 0, '21:01:00', 0, '21:01:00', 0),
(46, '21:02:00', 1, '21:04:00', 3, '21:08:00', 7),
(47, '21:26:00', 24, '21:26:00', 22, '21:27:00', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `an_trian`
--
ALTER TABLE `an_trian`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `an_trian`
--
ALTER TABLE `an_trian`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
