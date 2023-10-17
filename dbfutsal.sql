-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2023 at 05:19 AM
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
-- Database: `dbfutsal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_212279`
--

CREATE TABLE `admin_212279` (
  `212279_id_user` int(3) NOT NULL,
  `212279_username` varchar(20) NOT NULL,
  `212279_password` varchar(20) NOT NULL,
  `212279_nama` varchar(50) NOT NULL,
  `212279_no_handphone` varchar(15) NOT NULL,
  `212279_email` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_212279`
--

INSERT INTO `admin_212279` (`212279_id_user`, `212279_username`, `212279_password`, `212279_nama`, `212279_no_handphone`, `212279_email`) VALUES
(1, 'Geraldshrn', 'm212279', 'Gerald Sharon Ratu', '082197252773', 'geraldratu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `bayar_212279`
--

CREATE TABLE `bayar_212279` (
  `212279_id_bayar` int(11) NOT NULL,
  `212279_id_sewa` int(11) NOT NULL,
  `212279_bukti` text NOT NULL,
  `212279_tanggal_upload` date NOT NULL DEFAULT current_timestamp(),
  `212279_konfirmasi` varchar(50) NOT NULL DEFAULT 'Belum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bayar_212279`
--

INSERT INTO `bayar_212279` (`212279_id_bayar`, `212279_id_sewa`, `212279_bukti`, `212279_tanggal_upload`, `212279_konfirmasi`) VALUES
(55, 123, '64522a4de1d9a.png', '2023-05-03', 'Terkonfirmasi'),
(56, 127, '652df538ee439.png', '2023-10-17', 'Terkonfirmasi'),
(57, 128, '652df606de5e8.png', '2023-10-17', 'Terkonfirmasi');

-- --------------------------------------------------------

--
-- Table structure for table `lapangan_212279`
--

CREATE TABLE `lapangan_212279` (
  `212279_id_lapangan` int(11) NOT NULL,
  `212279_nama` varchar(35) NOT NULL,
  `212279_keterangan` text NOT NULL,
  `212279_harga` int(11) NOT NULL,
  `212279_foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `lapangan_212279`
--

INSERT INTO `lapangan_212279` (`212279_id_lapangan`, `212279_nama`, `212279_keterangan`, `212279_harga`, `212279_foto`) VALUES
(23, 'Bronze2', 'ini lapangan Dewa', 10000, 'footbal.jpg'),
(24, 'Silver', 'Ini Lapangan Emas', 20000, 'badmintoon.jpg'),
(25, 'Gold', 'Ini Lapangan Silver', 30000, 'basket.jpg'),
(26, 'Diamond', 'Ini Lapangan Golf4', 40000, 'futsal.jpg'),
(27, '', '', 0, '652df02080f44.png'),
(29, 'test', '', 123, '652df064de52f.png');

-- --------------------------------------------------------

--
-- Table structure for table `sewa_212279`
--

CREATE TABLE `sewa_212279` (
  `212279_id_sewa` int(11) NOT NULL,
  `212279_id_user` int(11) NOT NULL,
  `212279_id_lapangan` int(11) NOT NULL,
  `212279_tanggal_pesan` date NOT NULL DEFAULT current_timestamp(),
  `212279_lama_sewa` int(11) NOT NULL,
  `212279_jam_mulai` datetime NOT NULL,
  `212279_jam_habis` datetime NOT NULL,
  `212279_harga` int(11) NOT NULL,
  `212279_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sewa_212279`
--

INSERT INTO `sewa_212279` (`212279_id_sewa`, `212279_id_user`, `212279_id_lapangan`, `212279_tanggal_pesan`, `212279_lama_sewa`, `212279_jam_mulai`, `212279_jam_habis`, `212279_harga`, `212279_total`) VALUES
(123, 98, 23, '2023-05-03', 2, '2023-05-03 16:23:00', '2023-05-03 18:23:00', 30000, 60000),
(124, 0, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 0, 0),
(125, 0, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 0, 0),
(126, 98, 0, '2023-10-17', 0, '0000-00-00 00:00:00', '1970-01-01 01:00:00', 30000, 30000),
(127, 98, 24, '2023-10-17', 2, '2023-10-17 09:43:00', '2023-10-17 11:43:00', 20000, 40000),
(128, 98, 25, '2023-10-17', 2, '2023-10-17 09:48:00', '2023-10-17 11:48:00', 30000, 60000);

-- --------------------------------------------------------

--
-- Table structure for table `user_212279`
--

CREATE TABLE `user_212279` (
  `212279_id_user` int(11) NOT NULL,
  `212279_email` varchar(50) NOT NULL,
  `212279_password` varchar(32) NOT NULL,
  `212279_no_handphone` varchar(20) NOT NULL,
  `212279_jenis_kelamin` varchar(10) NOT NULL,
  `212279_nama_lengkap` varchar(60) NOT NULL,
  `212279_alamat` text NOT NULL,
  `212279_foto` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_212279`
--

INSERT INTO `user_212279` (`212279_id_user`, `212279_email`, `212279_password`, `212279_no_handphone`, `212279_jenis_kelamin`, `212279_nama_lengkap`, `212279_alamat`, `212279_foto`) VALUES
(98, 'geraldshrn@gmail.com', 'm212279', '082197252774', 'Laki-laki', 'Gerald Sharon Ratu', 'Bekasi', '645229918b946.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_212279`
--
ALTER TABLE `admin_212279`
  ADD PRIMARY KEY (`212279_id_user`);

--
-- Indexes for table `bayar_212279`
--
ALTER TABLE `bayar_212279`
  ADD PRIMARY KEY (`212279_id_bayar`);

--
-- Indexes for table `lapangan_212279`
--
ALTER TABLE `lapangan_212279`
  ADD PRIMARY KEY (`212279_id_lapangan`);

--
-- Indexes for table `sewa_212279`
--
ALTER TABLE `sewa_212279`
  ADD PRIMARY KEY (`212279_id_sewa`);

--
-- Indexes for table `user_212279`
--
ALTER TABLE `user_212279`
  ADD PRIMARY KEY (`212279_id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_212279`
--
ALTER TABLE `admin_212279`
  MODIFY `212279_id_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bayar_212279`
--
ALTER TABLE `bayar_212279`
  MODIFY `212279_id_bayar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `lapangan_212279`
--
ALTER TABLE `lapangan_212279`
  MODIFY `212279_id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sewa_212279`
--
ALTER TABLE `sewa_212279`
  MODIFY `212279_id_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user_212279`
--
ALTER TABLE `user_212279`
  MODIFY `212279_id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
