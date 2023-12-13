-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 06:10 AM
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
-- Database: `tugaspw4`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `email` varchar(15) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nim` varchar(9) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(9) NOT NULL,
  `jurusan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `id_wali` int(5) NOT NULL,
  `role` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nim`, `nama`, `jenis_kelamin`, `jurusan`, `alamat`, `id_wali`, `role`) VALUES
(1, 'Aa@gmail.com', '123', '122', 'aaa', '', 'PPLG', 'aaa', 1, 'admin'),
(34, 'aaa', '111', '345', 'murid', 'p', 'pplg', 'sesesese', 23, 'murid'),
(50, 'bbb', '222', '65', 'ibukk', 'perempuan', '-', 'rsrewesrtfuhnn jhiunjhuys rw34fdjhu', 65, ''),
(51, 'wertyu', '12345', '45678', 'dede', 'Laki-Laki', 'to', 'drcv jmijnb resvbjdd', 9, 'murid');

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `id` int(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`id`, `nama`) VALUES
(1, 'asasssaassa'),
(2, 'Sutar'),
(3, 'aaaaa'),
(4, 'ss'),
(5, 'aaaasddadsa'),
(6, 'ss'),
(8, 'vvvv'),
(9, 'ieajdnsdnawidn'),
(10, 'arum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
