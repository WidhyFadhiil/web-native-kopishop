-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2024 at 10:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopishop`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(15) NOT NULL,
  `kode_kategori_barang` int(2) NOT NULL,
  `nama_barang` varchar(25) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_kategori_barang`, `nama_barang`, `harga_jual`, `photo`) VALUES
('BRG001', 2, 'cappucino', 25000, 'Cappucino.jpg'),
('BRG002', 2, 'matcha latte', 30000, 'Cappucino.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `kode_detail_penjualan` int(11) NOT NULL,
  `kode_penjualan` varchar(15) NOT NULL,
  `kode_barang` varchar(15) NOT NULL,
  `qty` int(2) NOT NULL,
  `sub_total` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`kode_detail_penjualan`, `kode_penjualan`, `kode_barang`, `qty`, `sub_total`) VALUES
(1, 'P000004', 'BRG002', 1, 20000),
(2, 'P000005', 'BRG002', 1, 20000),
(3, 'P000004', 'BRG003', 1, 15000),
(4, 'P000005', 'BRG002', 2, 40000),
(5, 'P000005', 'BRG004', 2, 10000),
(6, 'P000002', 'BRG002', 1, 20000),
(7, 'P000003', 'BRG002', 1, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `kode_kategori_barang` int(2) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`kode_kategori_barang`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `log_aktifitas`
--

CREATE TABLE `log_aktifitas` (
  `id_log_aktifitas` int(20) NOT NULL,
  `kode_user` int(30) NOT NULL,
  `nama_user` varchar(35) NOT NULL,
  `no_hp` varchar(35) NOT NULL,
  `akses` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_aktifitas`
--

INSERT INTO `log_aktifitas` (`id_log_aktifitas`, `kode_user`, `nama_user`, `no_hp`, `akses`, `keterangan`, `date_time`) VALUES
(2, 14, 'julian', '343432432', 'Admin', 'hapus data user', '2024-02-04 07:10:29'),
(3, 15, 'julian', '243243242342', 'Kasir', 'input data user', '2024-02-04 07:10:54'),
(4, 15, 'julian', '243243242342', 'Admin', 'update data user', '2024-02-04 07:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kode_penjualan` varchar(15) NOT NULL,
  `kode_user` varchar(5) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `total_bayar` int(9) NOT NULL,
  `total_harga` int(9) NOT NULL,
  `kembalian` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_penjualan`, `kode_user`, `tanggal_penjualan`, `total_bayar`, `total_harga`, `kembalian`) VALUES
('P000001', '6', '2020-01-20', 200000, 190000, 20000),
('P000002', '6', '2020-01-27', 100000, 20000, 80000),
('P000003', '9', '2024-01-05', 80000, 50000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` int(3) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `akses` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `nama_user`, `no_hp`, `alamat`, `akses`, `username`, `password`) VALUES
(15, 'julian', '243243242342', 'jakarta', 'Admin', 'admin', '$2y$10$c05.lkEss17fVciq0GqVg.q0UGHpGIQK350O2AS83.CRc8me.Q1Sq');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `hapus_log_aktifitas` AFTER DELETE ON `user` FOR EACH ROW INSERT INTO log_aktifitas SET
kode_user = old.kode_user,
nama_user = old.nama_user,
no_hp = old.no_hp,
akses = old.akses,
keterangan = 'hapus data user'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ins_log_aktifitas` AFTER INSERT ON `user` FOR EACH ROW INSERT INTO log_aktifitas SET
kode_user = new.kode_user,
nama_user = new.nama_user,
no_hp = new.no_hp,
akses = new.akses,
keterangan = 'input data user'
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_log_aktifitas` AFTER UPDATE ON `user` FOR EACH ROW INSERT INTO log_aktifitas SET
kode_user = new.kode_user,
nama_user = new.nama_user,
no_hp = new.no_hp,
akses = new.akses,
keterangan = 'update data user'
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`kode_detail_penjualan`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`kode_kategori_barang`);

--
-- Indexes for table `log_aktifitas`
--
ALTER TABLE `log_aktifitas`
  ADD PRIMARY KEY (`id_log_aktifitas`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kode_penjualan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `kode_detail_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `kode_kategori_barang` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `log_aktifitas`
--
ALTER TABLE `log_aktifitas`
  MODIFY `id_log_aktifitas` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `kode_user` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
