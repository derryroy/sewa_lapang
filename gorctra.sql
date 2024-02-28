-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 05:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gorctra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `email`, `password`, `tanggal`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2023-05-31 10:13:23', 1),
(2, 'Admin 1', 'admin1@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2023-06-28 09:26:02', 0),
(3, 'Admin 2', 'admin2@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2023-06-28 09:26:52', 0),
(40, 'Keuangan', 'keuangan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2023-08-04 15:37:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `sesi` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail_pesanan`, `id_pesanan`, `tanggal`, `sesi`, `harga`, `diskon`, `total`) VALUES
(1, 1, '2023-06-28', 7, 700000, 0, 700000),
(2, 2, '2023-06-29', 1, 500000, 0, 500000),
(3, 3, '2023-06-28', 8, 700000, 0, 700000),
(4, 4, '2023-06-28', 7, 700000, 0, 700000),
(5, 5, '2023-06-28', 8, 700000, 0, 700000),
(6, 6, '2023-06-28', 8, 700000, 0, 700000),
(7, 7, '2023-06-28', 6, 600000, 0, 600000),
(8, 8, '2023-06-28', 6, 600000, 0, 600000),
(9, 9, '2023-07-08', 5, 700000, 0, 700000),
(10, 10, '2023-07-03', 7, 700000, 0, 700000),
(11, 11, '2023-07-05', 8, 700000, 0, 700000),
(12, 12, '2023-07-05', 6, 700000, 0, 700000),
(13, 13, '2023-07-05', 6, 600000, 0, 600000),
(14, 14, '2023-07-03', 3, 500000, 0, 500000),
(15, 15, '2023-07-04', 4, 500000, 0, 500000),
(16, 16, '2023-07-06', 1, 500000, 0, 500000),
(17, 17, '2023-07-06', 5, 600000, 0, 600000),
(18, 18, '2023-07-08', 8, 700000, 0, 700000),
(19, 19, '2023-07-05', 5, 600000, 0, 600000),
(20, 20, '2023-07-08', 4, 700000, 0, 700000),
(21, 21, '2023-07-09', 6, 700000, 0, 700000),
(22, 22, '2023-07-09', 7, 700000, 0, 700000),
(23, 23, '2023-07-09', 3, 700000, 0, 700000),
(24, 24, '2023-07-10', 4, 500000, 0, 500000),
(25, 25, '2023-07-15', 2, 700000, 0, 700000),
(26, 26, '2023-07-11', 4, 500000, 0, 500000),
(27, 27, '2023-07-17', 1, 500000, 0, 500000),
(28, 28, '2023-07-12', 2, 500000, 0, 500000),
(29, 29, '2023-07-10', 1, 500000, 0, 500000),
(30, 30, '2023-07-19', 1, 500000, 0, 500000),
(31, 31, '2023-07-11', 2, 500000, 0, 500000),
(32, 32, '2023-07-10', 7, 700000, 0, 700000),
(33, 33, '2023-07-10', 1, 500000, 0, 500000),
(34, 34, '2023-07-10', 2, 500000, 0, 500000),
(35, 35, '2023-08-27', 3, 700000, 0, 700000),
(36, 36, '2023-08-20', 3, 700000, 0, 700000),
(37, 37, '2023-08-05', 6, 700000, 100000, 600000),
(38, 37, '2023-08-12', 6, 700000, 100000, 600000),
(39, 37, '2023-08-19', 6, 700000, 100000, 600000),
(40, 37, '2023-08-26', 6, 700000, 100000, 600000),
(41, 38, '2023-08-13', 3, 700000, 0, 700000),
(42, 39, '2023-08-31', 1, 500000, 0, 500000),
(43, 39, '2023-08-31', 2, 500000, 0, 500000),
(44, 39, '2023-08-31', 3, 500000, 0, 500000),
(45, 39, '2023-08-31', 4, 500000, 0, 500000),
(46, 39, '2023-08-31', 5, 600000, 0, 600000),
(47, 39, '2023-08-31', 6, 600000, 0, 600000),
(48, 39, '2023-08-31', 7, 700000, 0, 700000),
(49, 39, '2023-08-31', 8, 700000, 0, 700000),
(50, 40, '2023-08-06', 1, 3125000, 0, 3125000),
(51, 40, '2023-08-06', 2, 3125000, 0, 3125000),
(52, 40, '2023-08-06', 3, 3125000, 0, 3125000),
(53, 40, '2023-08-06', 4, 3125000, 0, 3125000),
(54, 40, '2023-08-06', 5, 3125000, 0, 3125000),
(55, 40, '2023-08-06', 6, 3125000, 0, 3125000),
(56, 40, '2023-08-06', 7, 3125000, 0, 3125000),
(57, 40, '2023-08-06', 8, 3125000, 0, 3125000),
(58, 40, '2023-08-06', 1, 700000, 0, 700000),
(59, 40, '2023-08-06', 2, 700000, 0, 700000),
(60, 40, '2023-08-06', 3, 700000, 0, 700000),
(61, 40, '2023-08-06', 4, 700000, 0, 700000),
(62, 40, '2023-08-06', 5, 700000, 0, 700000),
(63, 40, '2023-08-06', 6, 700000, 0, 700000),
(64, 40, '2023-08-06', 7, 700000, 0, 700000),
(65, 40, '2023-08-06', 8, 700000, 0, 700000),
(66, 41, '2023-08-06', 1, 3125000, 0, 3125000),
(67, 41, '2023-08-06', 2, 3125000, 0, 3125000),
(68, 41, '2023-08-06', 3, 3125000, 0, 3125000),
(69, 41, '2023-08-06', 4, 3125000, 0, 3125000),
(70, 41, '2023-08-06', 5, 3125000, 0, 3125000),
(71, 41, '2023-08-06', 6, 3125000, 0, 3125000),
(72, 41, '2023-08-06', 7, 3125000, 0, 3125000),
(73, 41, '2023-08-06', 8, 3125000, 0, 3125000);

-- --------------------------------------------------------

--
-- Table structure for table `harga_diskon`
--

CREATE TABLE `harga_diskon` (
  `id_harga_diskon` int(11) NOT NULL,
  `nama_diskon` varchar(20) NOT NULL,
  `harga_diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_diskon`
--

INSERT INTO `harga_diskon` (`id_harga_diskon`, `nama_diskon`, `harga_diskon`) VALUES
(1, 'diskon1', 70000),
(2, 'diskon2', 85000),
(3, 'diskon3', 100000),
(4, 'diskon4', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `harga_event`
--

CREATE TABLE `harga_event` (
  `id_harga_event` int(11) NOT NULL,
  `nama_event` varchar(20) NOT NULL,
  `harga_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_event`
--

INSERT INTO `harga_event` (`id_harga_event`, `nama_event`, `harga_event`) VALUES
(1, 'harga1', 20000000),
(2, 'harga2', 25000000);

-- --------------------------------------------------------

--
-- Table structure for table `harga_sewa`
--

CREATE TABLE `harga_sewa` (
  `id_harga_sewa` int(11) NOT NULL,
  `nama_harga` varchar(20) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `harga_sewa`
--

INSERT INTO `harga_sewa` (`id_harga_sewa`, `nama_harga`, `harga_sewa`) VALUES
(1, 'harga1', 500000),
(2, 'harga2', 600000),
(3, 'harga3', 700000),
(4, 'harga4', 700000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `sesi` int(1) NOT NULL,
  `harga` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `kadaluarsa_keranjang` timestamp NULL DEFAULT NULL,
  `event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `no_pesanan` varchar(15) NOT NULL,
  `event` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `nama_klub` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `tanggal_pesanan` timestamp NULL DEFAULT NULL,
  `tanggal_kadaluarsa` timestamp NULL DEFAULT NULL,
  `tanggal_pembayaran` timestamp NULL DEFAULT NULL,
  `status_pembayaran` int(11) NOT NULL,
  `lokasi_gambar` varchar(50) DEFAULT NULL,
  `nama_gambar` varchar(50) DEFAULT NULL,
  `nama_gambar_2` varchar(50) DEFAULT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `no_pesanan`, `event`, `id_user`, `id_admin`, `nama_klub`, `telepon`, `tanggal_pesanan`, `tanggal_kadaluarsa`, `tanggal_pembayaran`, `status_pembayaran`, `lokasi_gambar`, `nama_gambar`, `nama_gambar_2`, `catatan`) VALUES
(1, 'GCA202306270001', 0, NULL, 1, 'dvd', '2323232323', '2023-06-27 10:00:36', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(2, 'GCA202306280001', 0, NULL, 1, 'David', '08515539322', '2023-06-28 03:47:12', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(3, 'GCA202306280002', 0, NULL, 1, 'Fajrul', '08515594201', '2023-06-28 04:18:17', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(4, 'GCA202306280003', 0, 4, NULL, NULL, NULL, '2023-06-28 04:19:11', '2023-06-28 05:19:11', '2023-07-04 09:06:03', 3, 'upload/bukti_tf/', 'GCA202306280003.png', NULL, NULL),
(5, 'GCA202306280004', 0, NULL, 1, 'David', '08515593832', '2023-06-28 04:28:06', NULL, '2023-07-06 14:29:42', 4, NULL, NULL, NULL, NULL),
(6, 'GCA202306280005', 0, NULL, 1, 'Fajrul', '08515559391', '2023-06-28 04:35:19', NULL, '2023-07-05 03:18:37', 4, NULL, NULL, NULL, NULL),
(7, 'GCA202306280006', 0, 6, NULL, NULL, NULL, '2023-06-28 04:36:17', '2023-06-28 05:36:17', '2023-06-27 23:36:54', 3, 'upload/bukti_tf/', 'GCA202306280006.png', NULL, NULL),
(8, 'GCA202306280007', 0, 6, NULL, NULL, NULL, '2023-06-28 04:38:24', '2023-06-28 05:38:24', '2023-06-27 23:38:40', 3, 'upload/bukti_tf/', 'GCA202306280007.png', NULL, NULL),
(9, 'GCA202307020001', 0, 6, NULL, NULL, NULL, '2023-07-02 15:44:56', '2023-07-02 16:44:56', '2023-07-05 03:17:30', 3, NULL, NULL, NULL, NULL),
(10, 'GCA202307030001', 0, 6, NULL, NULL, NULL, '2023-07-03 09:38:18', '2023-07-03 10:38:18', NULL, 3, NULL, NULL, NULL, NULL),
(11, 'GCA202307040001', 0, 22, NULL, NULL, NULL, '2023-07-04 03:29:20', '2023-07-04 04:29:20', '2023-07-03 22:30:19', 3, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(12, 'GCA202307040002', 0, NULL, 1, 'Refaldi', '08515535393', '2023-07-04 03:37:56', NULL, '2023-07-05 03:31:34', 4, NULL, NULL, NULL, NULL),
(13, 'GCA202307040003', 0, 22, NULL, NULL, NULL, '2023-07-04 04:21:00', '2023-07-04 05:21:00', '2023-07-04 09:05:19', 3, NULL, NULL, NULL, NULL),
(14, 'GCA202307040004', 0, NULL, 1, 'Dadang', '12345678', '2023-07-04 08:14:24', NULL, '2023-07-08 04:02:13', 2, NULL, NULL, NULL, NULL),
(15, 'GCA202307040005', 0, NULL, 1, 'Cecep', '1234567', '2023-07-04 09:07:09', NULL, '2023-07-04 09:07:19', 2, NULL, NULL, NULL, NULL),
(16, 'GCA202307050001', 0, 6, NULL, NULL, NULL, '2023-07-05 03:29:27', '2023-07-05 04:29:27', '2023-07-05 03:36:53', 3, NULL, NULL, NULL, NULL),
(17, 'GCA202307050002', 0, 6, NULL, NULL, NULL, '2023-07-05 14:26:07', '2023-07-05 15:26:07', NULL, 3, NULL, NULL, NULL, NULL),
(18, 'GCA202307050003', 0, 6, NULL, NULL, NULL, '2023-07-05 15:31:36', '2023-07-05 16:31:36', NULL, 3, NULL, NULL, NULL, NULL),
(19, 'GCA202307060001', 0, 6, NULL, NULL, NULL, '2023-07-06 13:24:42', '2023-07-06 14:24:42', '2023-07-06 14:17:04', 3, 'upload/bukti_tf/', 'GCA202307060001.jpg', NULL, NULL),
(20, 'GCA202307060002', 0, NULL, 1, 'Rossi', '085155042299', '2023-07-06 14:52:13', NULL, '2023-07-08 03:48:30', 2, NULL, NULL, NULL, NULL),
(21, 'GCA202307070001', 0, 6, NULL, NULL, NULL, '2023-07-07 04:12:49', '2023-07-07 05:12:49', NULL, 3, NULL, NULL, NULL, NULL),
(22, 'GCA202307080001', 0, 6, NULL, NULL, NULL, '2023-07-08 05:20:11', '2023-07-08 06:20:11', '2023-07-08 00:34:11', 3, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(23, 'GCA202307080002', 0, NULL, 1, 'Deden', '08515538310', '2023-07-08 14:31:18', NULL, '2023-07-08 14:37:56', 2, NULL, NULL, NULL, NULL),
(24, 'GCA202307080003', 0, 6, NULL, NULL, NULL, '2023-07-08 16:03:02', '2023-07-08 17:03:02', '2023-07-08 16:12:30', 3, 'upload/bukti_tf/', 'GCA202307080003.jpg', NULL, NULL),
(25, 'GCA202307080004', 0, 26, NULL, NULL, NULL, '2023-07-08 16:28:35', '2023-07-08 17:28:35', NULL, 3, NULL, NULL, NULL, NULL),
(26, 'GCA202307080005', 0, 22, NULL, NULL, NULL, '2023-07-08 16:37:37', '2023-07-08 17:37:37', '2023-07-08 09:37:43', 3, 'upload/bukti_tf/', 'GCA202307080005.jpg', NULL, NULL),
(27, 'GCA202307080006', 0, 27, NULL, NULL, NULL, '2023-07-08 16:38:42', '2023-07-08 17:38:42', '2023-07-08 17:28:04', 3, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(28, 'GCA202307080007', 0, 28, NULL, NULL, NULL, '2023-07-08 16:42:44', '2023-07-08 17:42:44', '2023-07-08 16:43:45', 3, 'upload/bukti_tf/', 'GCA202307080007.jpg', NULL, NULL),
(29, 'GCA202307090001', 0, 28, NULL, NULL, NULL, '2023-07-08 17:13:11', '2023-07-08 18:13:11', '2023-07-08 17:14:23', 3, 'upload/bukti_tf/', 'GCA202307090001.jpeg', NULL, NULL),
(30, 'GCA202307090002', 0, 26, NULL, NULL, NULL, '2023-07-09 03:09:47', '2023-07-09 04:09:47', NULL, 3, NULL, NULL, NULL, NULL),
(31, 'GCA202307090003', 0, 26, NULL, NULL, NULL, '2023-07-09 04:21:47', '2023-07-09 05:21:47', '2023-07-09 04:27:46', 3, 'upload/bukti_tf/', 'GCA202307090003.jpg', NULL, NULL),
(32, 'GCA202307090004', 0, 28, NULL, NULL, NULL, '2023-07-09 04:23:26', '2023-07-09 05:23:26', '2023-07-09 04:27:50', 3, 'upload/bukti_tf/', 'GCA202307090004.jpeg', NULL, NULL),
(33, 'GCA202307090005', 0, 22, NULL, NULL, NULL, '2023-07-09 14:04:36', '2023-07-09 15:04:36', NULL, 3, NULL, NULL, NULL, NULL),
(34, 'GCA202307090006', 0, 22, NULL, NULL, NULL, '2023-07-09 14:05:30', '2023-07-09 15:05:30', '2023-07-09 14:07:05', 3, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(35, 'GCA202308030001', 0, 29, NULL, NULL, NULL, '2023-08-03 02:06:03', '2023-08-03 03:06:03', '2023-08-03 02:39:00', 2, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(36, 'GCA202308030002', 0, 29, NULL, NULL, NULL, '2023-08-03 02:28:45', '2023-08-03 03:28:45', '2023-08-03 02:38:56', 2, 'upload/bukti_tf/', '.jpg', NULL, NULL),
(37, 'GCA202308030003', 0, 29, NULL, NULL, NULL, '2023-08-03 02:46:57', '2023-08-03 03:46:57', '2023-08-04 15:24:55', 2, 'upload/bukti_tf/', 'GCA202308030003.jpg', 'GCA202308030003_2.png', 'uangnya kurang 50.000'),
(38, 'GCA202308040001', 0, 29, NULL, NULL, NULL, '2023-08-04 02:25:28', '2023-08-04 02:30:28', NULL, 3, NULL, NULL, NULL, NULL),
(39, 'GCA202308040002', 1, NULL, 1, 'qwerty', '081987654321', '2023-08-04 10:33:56', NULL, '2023-08-04 10:41:43', 4, NULL, NULL, NULL, NULL),
(40, 'GCA202308040003', 1, NULL, 1, 'asd', '1234567890', '2023-08-04 10:39:58', NULL, '2023-08-04 10:41:39', 4, NULL, NULL, NULL, NULL),
(41, 'GCA202308040004', 1, NULL, 1, 'asd', '0987654321', '2023-08-04 10:42:19', NULL, '2023-08-04 14:23:21', 2, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` longtext NOT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `nama_klub` varchar(100) DEFAULT NULL,
  `telepon2` varchar(15) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `telepon`, `nama_klub`, `telepon2`, `tanggal`) VALUES
(3, 'der', 'dery@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', '123456', 'KARTA', '123456', '2023-05-31 10:28:42'),
(4, 'dery roy', 'deryroy@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123456', 'XSEKUSI', '12345', '2023-05-31 10:49:18'),
(6, 'David', 'david@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0851553838', 'Dvd Club', '0851000838', '2023-06-14 05:56:32'),
(7, 'Revan', 'revan@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123456780', 'Color Crew', '98989898', '2023-06-28 06:55:57'),
(21, 'M Dery Roy A', 'm_deryroy@ymail.com', 'a2a30f4b1f04c535a4441497f9d69cd42958f3e7', '0987654', NULL, NULL, '2023-07-03 10:19:41'),
(22, 'Ali Yudin', 'aliyudin@gmail.com', 'a2a30f4b1f04c535a4441497f9d69cd42958f3e7', '08515502282', 'ABC Club', NULL, '2023-07-04 03:28:05'),
(23, 'Raden', 'gedelracingteam@gmail.com', 'ceecdb89780f3e5179680e80a5fce186b8de733a', '123456', NULL, NULL, '2023-07-05 16:36:40'),
(26, 'Fajrul', 'muhammadfajrulalim@gmail.com', 'cc9f816a42431cf852cdc7a3fad42a6f65ffce24', '088222731117', NULL, NULL, '2023-07-08 16:27:45'),
(27, 'Ali Yudin', 'ali2671634@gmail.com', '5d4f2a92571f30ae2174544d85984fc079e5b63e', '0811112223334', NULL, NULL, '2023-07-08 16:36:40'),
(28, 'Deden', 'deden@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '0851434338', NULL, NULL, '2023-07-08 16:41:56'),
(29, 'icaanz', 'icaanz@yahoo.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', '1234567890', NULL, NULL, '2023-08-03 02:03:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`);

--
-- Indexes for table `harga_diskon`
--
ALTER TABLE `harga_diskon`
  ADD PRIMARY KEY (`id_harga_diskon`);

--
-- Indexes for table `harga_event`
--
ALTER TABLE `harga_event`
  ADD PRIMARY KEY (`id_harga_event`);

--
-- Indexes for table `harga_sewa`
--
ALTER TABLE `harga_sewa`
  ADD PRIMARY KEY (`id_harga_sewa`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `harga_diskon`
--
ALTER TABLE `harga_diskon`
  MODIFY `id_harga_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `harga_event`
--
ALTER TABLE `harga_event`
  MODIFY `id_harga_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `harga_sewa`
--
ALTER TABLE `harga_sewa`
  MODIFY `id_harga_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
