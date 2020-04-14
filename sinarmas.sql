-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Apr 2020 pada 20.53
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinarmas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_background`
--

CREATE TABLE `tbl_background` (
  `background_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `img_source` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `position` varchar(15) NOT NULL,
  `update` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id_banner` int(11) NOT NULL,
  `img_banner` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `name`, `username`, `password`, `hak_akses`) VALUES
(1, 'Admin Covid 19', 'admincovid19', 'YWRtaW5jb3ZpZDE5', 'Admin'),
(4, 'Dzaky Rabbani', 'drabbani28@gmail.com', 'YW5ha3dpa3JhbWFoaXRz', 'Operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_version`
--

CREATE TABLE `tbl_version` (
  `version_id` int(11) NOT NULL,
  `versi` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_version`
--

INSERT INTO `tbl_version` (`version_id`, `versi`, `created_at`) VALUES
(1, 1, '2020-01-22 10:05:28'),
(2, 2, '2020-01-22 10:06:00'),
(3, 3, '2020-01-22 10:06:21'),
(4, 4, '2020-01-22 10:06:43'),
(5, 5, '2020-01-22 10:07:36'),
(6, 6, '2020-01-22 10:08:23'),
(7, 7, '2020-01-22 10:08:52'),
(8, 8, '2020-01-22 10:09:24'),
(9, 9, '2020-01-22 10:09:51'),
(10, 10, '2020-01-22 10:10:17'),
(11, 11, '2020-01-22 10:10:39'),
(12, 12, '2020-01-23 02:47:33'),
(13, 13, '2020-01-23 09:57:41'),
(14, 14, '2020-01-23 09:57:56'),
(15, 15, '2020-01-23 09:58:18'),
(16, 16, '2020-01-23 09:58:35'),
(17, 17, '2020-01-23 10:31:56'),
(18, 18, '2020-01-27 08:29:02'),
(19, 19, '2020-01-27 08:30:47'),
(20, 20, '2020-01-27 08:33:20'),
(21, 21, '2020-01-27 08:34:28'),
(22, 22, '2020-01-27 08:34:30'),
(23, 23, '2020-01-27 08:35:01'),
(24, 24, '2020-01-27 08:35:15'),
(25, 25, '2020-01-27 08:35:24'),
(26, 26, '2020-01-27 08:36:07'),
(27, 27, '2020-01-27 08:36:10'),
(28, 28, '2020-01-27 08:36:20'),
(29, 29, '2020-01-27 08:37:40'),
(30, 30, '2020-01-27 08:56:19'),
(31, 31, '2020-01-27 08:56:34'),
(32, 32, '2020-01-27 08:57:09'),
(33, 33, '2020-04-12 15:47:09'),
(34, 34, '2020-04-12 15:47:13'),
(35, 35, '2020-04-12 15:47:15'),
(36, 36, '2020-04-12 15:47:17'),
(37, 37, '2020-04-12 15:47:18'),
(38, 38, '2020-04-12 15:47:19'),
(39, 39, '2020-04-12 15:47:20'),
(40, 40, '2020-04-12 15:47:21'),
(41, 41, '2020-04-12 15:47:22'),
(42, 42, '2020-04-12 15:47:24'),
(43, 43, '2020-04-12 15:47:25'),
(44, 44, '2020-04-12 15:47:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_background`
--
ALTER TABLE `tbl_background`
  ADD PRIMARY KEY (`background_id`);

--
-- Indeks untuk tabel `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_version`
--
ALTER TABLE `tbl_version`
  ADD PRIMARY KEY (`version_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_background`
--
ALTER TABLE `tbl_background`
  MODIFY `background_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT untuk tabel `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id_banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_version`
--
ALTER TABLE `tbl_version`
  MODIFY `version_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
