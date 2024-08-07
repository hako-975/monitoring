-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Jun 2024 pada 02.37
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dht22`
--

CREATE TABLE `dht22` (
  `id` int(11) NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dht22`
--

INSERT INTO `dht22` (`id`, `temperature`, `humidity`, `create_at`) VALUES
(1, 25.5, 50.3, '2024-04-27 05:55:47'),
(2, 25.8, 49.7, '2024-04-27 05:55:47'),
(3, 26.2, 48.9, '2024-04-27 05:56:57'),
(4, 26.7, 48.3, '2024-04-27 05:56:57'),
(5, 27.1, 47.8, '2024-04-27 05:57:57'),
(6, 27.5, 47.2, '2024-04-27 05:57:57'),
(7, 27.8, 46.9, '2024-04-27 05:58:29'),
(8, 28.2, 46.5, '2024-04-27 05:58:29'),
(9, 28.9, 45.8, '2024-04-27 05:59:21'),
(10, 29.3, 45.4, '2024-04-27 05:59:21'),
(11, 29.7, 45, '2024-04-27 06:02:35'),
(12, 30.1, 44.7, '2024-04-27 06:02:35'),
(13, 30.5, 44.3, '2024-04-27 06:02:35'),
(14, 30.9, 43.9, '2024-04-27 06:02:35'),
(15, 31.2, 43.6, '2024-04-27 06:02:35'),
(16, 31.6, 43.2, '2024-04-27 06:02:35'),
(17, 32, 42.9, '2024-04-27 06:02:35'),
(18, 32.4, 42.5, '2024-04-27 06:02:35'),
(19, 32.8, 42.2, '2024-04-27 06:02:35'),
(20, 33.1, 41.8, '2024-04-27 06:02:35'),
(21, 33.5, 41.5, '2024-04-27 06:05:17'),
(22, 33.9, 41.1, '2024-04-27 06:05:17'),
(23, 34.3, 40.8, '2024-04-27 06:05:17'),
(24, 34.7, 40.4, '2024-04-27 06:05:17'),
(25, 35.1, 40.1, '2024-04-27 06:05:17'),
(26, 35.4, 39.7, '2024-04-27 06:05:17'),
(27, 35.8, 39.4, '2024-04-27 06:05:17'),
(28, 36.2, 39, '2024-04-27 06:05:17'),
(29, 36.6, 38.7, '2024-04-27 06:05:17'),
(30, 37, 38.3, '2024-04-27 06:05:17'),
(31, 37.3, 38, '2024-04-27 06:12:10'),
(32, 37.7, 37.6, '2024-04-27 06:12:10'),
(33, 38.1, 37.3, '2024-04-27 06:12:10'),
(34, 38.5, 36.9, '2024-04-27 06:12:10'),
(35, 38.9, 36.6, '2024-04-27 06:12:10'),
(36, 39.2, 0, '2024-04-27 06:12:10'),
(37, 39.6, 35.9, '2024-04-27 06:12:10'),
(38, 40, 35.5, '2024-04-27 06:12:10'),
(39, 40.4, 35.2, '2024-04-27 06:12:10'),
(40, 40.8, 34.8, '2024-04-27 06:12:10'),
(41, 41.1, 34.5, '2024-04-27 06:12:10'),
(42, 41.5, 34.1, '2024-04-27 06:12:10'),
(43, 41.9, 33.8, '2024-04-27 06:12:10'),
(44, 42.3, 33.4, '2024-04-27 06:12:10'),
(45, 42.7, 33.1, '2024-04-27 06:12:10'),
(46, 43, 32.7, '2024-04-27 06:12:10'),
(47, 43.4, 32.4, '2024-04-27 06:12:10'),
(48, 43.8, 32, '2024-04-27 06:12:10'),
(49, 69, 36, '2024-04-28 13:49:33'),
(50, 69, 36, '2024-06-01 13:49:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ina219`
--

CREATE TABLE `ina219` (
  `id` int(11) NOT NULL,
  `arus` float NOT NULL,
  `tegangan` float NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ina219`
--

INSERT INTO `ina219` (`id`, `arus`, `tegangan`, `create_at`) VALUES
(1, 0.25, 5.12, '2024-04-27 06:18:15'),
(2, 0.27, 5.1, '2024-04-27 06:18:15'),
(3, 0.29, 5.08, '2024-04-27 06:18:15'),
(4, 0.31, 5.06, '2024-04-27 06:18:15'),
(5, 0.33, 5.04, '2024-04-27 06:18:15'),
(6, 0.35, 5.02, '2024-04-27 06:18:15'),
(7, 0.37, 5, '2024-04-27 06:18:15'),
(8, 0.39, 4.98, '2024-04-27 06:18:15'),
(9, 0.41, 4.96, '2024-04-27 06:18:15'),
(10, 0.43, 4.94, '2024-04-27 06:18:15'),
(11, 0.45, 4.92, '2024-04-27 06:18:15'),
(12, 0.47, 4.9, '2024-04-27 06:18:15'),
(13, 0.49, 4.88, '2024-04-27 06:18:15'),
(14, 0.51, 4.86, '2024-04-27 06:18:15'),
(15, 0.53, 4.84, '2024-04-27 06:18:15'),
(16, 0.55, 4.82, '2024-04-27 06:18:15'),
(17, 0.57, 4.8, '2024-04-27 06:18:15'),
(18, 0.59, 4.78, '2024-04-27 06:18:15'),
(19, 0.61, 4.76, '2024-04-27 06:18:15'),
(20, 0.63, 4.74, '2024-04-27 06:18:15'),
(21, 0.65, 4.72, '2024-04-27 06:18:15'),
(22, 0.67, 4.7, '2024-04-27 06:18:15'),
(23, 0.69, 4.68, '2024-04-27 06:18:15'),
(24, 0.71, 4.66, '2024-04-27 06:18:15'),
(25, 0.73, 4.64, '2024-04-27 06:18:15'),
(26, 0.75, 4.62, '2024-04-27 06:18:15'),
(27, 0.77, 4.6, '2024-04-27 06:18:15'),
(28, 0.79, 4.58, '2024-04-27 06:18:15'),
(29, 0.81, 4.56, '2024-04-27 06:18:15'),
(30, 0.83, 4.54, '2024-04-27 06:18:15'),
(31, 0.85, 4.52, '2024-04-27 06:18:15'),
(32, 0.87, 4.5, '2024-04-27 06:18:15'),
(33, 0.89, 4.48, '2024-04-27 06:18:15'),
(34, 0.91, 4.46, '2024-04-27 06:18:15'),
(35, 0.93, 4.44, '2024-04-27 06:18:15'),
(36, 0.95, 4.42, '2024-04-27 06:18:15'),
(37, 0.97, 4.4, '2024-04-27 06:18:15'),
(38, 0.99, 4.38, '2024-04-27 06:18:15'),
(39, 1.01, 4.36, '2024-04-27 06:18:15'),
(40, 1.03, 4.34, '2024-04-27 06:18:15'),
(41, 1.05, 4.32, '2024-04-27 06:18:15'),
(42, 1.07, 4.3, '2024-04-27 06:18:15'),
(43, 1.09, 4.28, '2024-04-27 06:18:15'),
(44, 1.11, 4.26, '2024-04-27 06:18:15'),
(45, 1.13, 4.24, '2024-04-27 06:18:15'),
(46, 1.15, 4.22, '2024-04-27 06:18:15'),
(47, 1.17, 4.2, '2024-04-27 06:18:15'),
(48, 1.19, 4.18, '2024-04-27 06:24:22'),
(49, 1.21, 4.16, '2024-04-27 06:27:22'),
(50, 1.23, 4.14, '2024-04-27 06:38:22'),
(51, 1.25, 4.12, '2024-04-27 07:18:15'),
(52, 3.5, 6.9, '2024-04-28 14:44:31'),
(53, 3.5, 6.9, '2024-06-01 14:44:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ldr`
--

CREATE TABLE `ldr` (
  `id` int(11) NOT NULL,
  `lt` int(11) NOT NULL,
  `rt` int(11) NOT NULL,
  `ld` int(11) NOT NULL,
  `rd` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ldr`
--

INSERT INTO `ldr` (`id`, `lt`, `rt`, `ld`, `rd`, `create_at`) VALUES
(7, 100, 50, 20, 55, '2024-06-07 00:00:13'),
(8, 100, 100, 100, 100, '2024-06-07 00:01:33'),
(9, 0, 0, 0, 0, '2024-06-07 00:09:58'),
(12, 420, 10, 42, 69, '2024-06-07 00:16:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'admin', '$2y$10$OOKyR9AltDQIchTG9suRyuNdVledYegkwLBbsq6U1cqSz58hvuxCy', 'Habib Al-Huda Abdullah');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `dht22`
--
ALTER TABLE `dht22`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ina219`
--
ALTER TABLE `ina219`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ldr`
--
ALTER TABLE `ldr`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `dht22`
--
ALTER TABLE `dht22`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `ina219`
--
ALTER TABLE `ina219`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `ldr`
--
ALTER TABLE `ldr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
