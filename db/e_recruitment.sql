-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2021 at 05:22 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_recruitment`
--

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `kriteria` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL,
  `sifat` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `id_posisi`, `kriteria`, `bobot`, `sifat`) VALUES
(1, 1, 'Pengalaman Kerja', 10, 'B'),
(2, 1, 'Pemahaman Job Desk', 28, 'B'),
(3, 1, 'Negosiasi Upah', 30, 'C'),
(4, 1, 'Attitude', 10, 'B'),
(5, 1, 'Tes Seleksi', 20, 'B'),
(6, 2, 'Pengalaman Kerja', 10, 'B'),
(7, 2, 'Pemahaman Job Desk', 30, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_posisi` int(11) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `kuota` int(3) NOT NULL,
  `tgl_dibuka` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ditutup` date NOT NULL,
  `buka` int(1) NOT NULL DEFAULT '1',
  `jumlah_pelamar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id_posisi`, `posisi`, `kuota`, `tgl_dibuka`, `tgl_ditutup`, `buka`, `jumlah_pelamar`) VALUES
(1, 'Monev', 6, '2021-05-22 17:00:00', '0000-00-00', 1, 13),
(2, 'Koordinator Lapangan', 10, '2021-05-23 17:00:00', '0000-00-00', 1, 0),
(3, 'Petugas Lapangan', 20, '2021-05-23 17:00:00', '0000-00-00', 1, 0),
(4, 'Peer Educator', 10, '2021-05-23 17:00:00', '0000-00-00', 1, 0),
(5, 'CBC', 1, '2021-05-22 17:00:00', '0000-00-00', 1, 0),
(6, 'Bendahara', 1, '2021-05-24 08:18:38', '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `nama_pelamar` varchar(50) NOT NULL,
  `tgl_interview` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nilai1` int(1) NOT NULL,
  `nilai2` int(1) NOT NULL,
  `nilai3` int(1) NOT NULL,
  `nilai4` int(1) NOT NULL,
  `nilai5` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `id_posisi`, `nama_pelamar`, `tgl_interview`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`) VALUES
(1, 1, 'Akasuna Hera', '2021-05-31 03:12:16', 2, 5, 3, 3, 5),
(2, 1, 'Kazuyuki Jei', '2021-05-31 19:17:58', 3, 4, 3, 4, 4),
(3, 1, 'Yoru Mikazuki', '2021-05-31 19:58:03', 1, 3, 2, 4, 3),
(4, 1, 'Lan Wang Ji', '2021-05-31 19:58:51', 5, 5, 4, 3, 5),
(5, 1, 'Wei Wu Xian', '2021-05-31 19:59:21', 3, 5, 4, 2, 5),
(6, 1, 'Jiang Wan Yin', '2021-05-31 19:59:55', 3, 3, 3, 2, 3),
(7, 1, 'Lan Xi Chen', '2021-05-31 20:00:59', 5, 3, 4, 4, 5),
(8, 1, 'Xie Lian', '2021-05-31 20:01:41', 5, 4, 2, 4, 4),
(9, 1, 'Hua Cheng', '2021-05-31 20:02:19', 5, 5, 5, 4, 5),
(10, 1, 'Hong Hua', '2021-05-31 20:02:46', 2, 5, 3, 4, 5),
(11, 1, 'Zhou Zi Xu', '2021-05-31 21:06:22', 4, 4, 4, 3, 4),
(12, 1, 'Wen Ke Xing', '2021-05-31 21:07:20', 2, 4, 4, 2, 4),
(13, 1, 'Zhang Cheng Ling', '2021-05-31 21:08:02', 1, 2, 1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_pelamar`
--

CREATE TABLE `penilaian_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub_kriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_sub1` varchar(50) NOT NULL COMMENT 'n =1',
  `nama_sub2` varchar(50) NOT NULL COMMENT 'n=2',
  `nama_sub3` varchar(50) NOT NULL COMMENT 'n=3',
  `nama_sub4` varchar(50) NOT NULL COMMENT 'n=4',
  `nama_sub5` varchar(50) NOT NULL COMMENT 'n=5'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub_kriteria`, `id_kriteria`, `nama_sub1`, `nama_sub2`, `nama_sub3`, `nama_sub4`, `nama_sub5`) VALUES
(1, 1, 'Tidak Ada', '1 Tahun', '2-3 Tahun', '4-5 Tahun', '>5 Tahun'),
(2, 2, 'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'),
(3, 6, 'Tidak Ada', '1 Tahun', '2-3 Tahun', '4-5 Tahun', '>5 Tahun'),
(4, 7, 'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik'),
(5, 3, 'Sangat Rendah', 'Rendah', 'Sedang', 'Tinggi', 'Sangat Tinggi'),
(6, 4, 'Sangat Buruk', 'Buruk', 'Biasa', 'Baik', 'Sangat Baik'),
(7, 5, 'Sangat Kurang', 'Kurang', 'Cukup', 'Baik', 'Sangat Baik');

-- --------------------------------------------------------

--
-- Table structure for table `temp_lowongan`
--

CREATE TABLE `temp_lowongan` (
  `id_temp` int(11) NOT NULL,
  `id_posisi` int(11) NOT NULL,
  `jumlah_pelamar` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `kode_petugas` varchar(6) NOT NULL,
  `password` varchar(30) NOT NULL,
  `nama` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `kode_petugas`, `password`, `nama`) VALUES
(1, 'hrd01', '123', 'Akasuna Hera');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_posisi` (`id_posisi`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_posisi`);

--
-- Indexes for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`),
  ADD KEY `id_posisi` (`id_posisi`);

--
-- Indexes for table `penilaian_pelamar`
--
ALTER TABLE `penilaian_pelamar`
  ADD KEY `id_posisi` (`id_posisi`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_pelamar` (`id_pelamar`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `temp_lowongan`
--
ALTER TABLE `temp_lowongan`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_posisi` (`id_posisi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_posisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temp_lowongan`
--
ALTER TABLE `temp_lowongan`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_posisi`) REFERENCES `lowongan` (`id_posisi`);

--
-- Constraints for table `pelamar`
--
ALTER TABLE `pelamar`
  ADD CONSTRAINT `pelamar_ibfk_1` FOREIGN KEY (`id_posisi`) REFERENCES `lowongan` (`id_posisi`);

--
-- Constraints for table `penilaian_pelamar`
--
ALTER TABLE `penilaian_pelamar`
  ADD CONSTRAINT `penilaian_pelamar_ibfk_1` FOREIGN KEY (`id_posisi`) REFERENCES `lowongan` (`id_posisi`),
  ADD CONSTRAINT `penilaian_pelamar_ibfk_2` FOREIGN KEY (`id_pelamar`) REFERENCES `pelamar` (`id_pelamar`),
  ADD CONSTRAINT `penilaian_pelamar_ibfk_3` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `temp_lowongan`
--
ALTER TABLE `temp_lowongan`
  ADD CONSTRAINT `temp_lowongan_ibfk_1` FOREIGN KEY (`id_posisi`) REFERENCES `lowongan` (`id_posisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
