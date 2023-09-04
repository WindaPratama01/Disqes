-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2023 pada 04.54
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disqes`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `user_id`) VALUES
(25, 'YouTube', '', '1,6,7'),
(26, 'WhatsApp', '', '6'),
(27, 'Gallery', '', '7'),
(28, 'Facebook', '', '1,7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_case`
--

CREATE TABLE `test_case` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `key_case` varchar(11) NOT NULL,
  `priority` varchar(255) NOT NULL,
  `behavior` varchar(255) NOT NULL,
  `precondition` text NOT NULL,
  `instruction` text NOT NULL,
  `expected_result` varchar(255) NOT NULL,
  `test_suite_id` int(11) NOT NULL,
  `test_section_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `test_case`
--

INSERT INTO `test_case` (`id`, `name`, `key_case`, `priority`, `behavior`, `precondition`, `instruction`, `expected_result`, `test_suite_id`, `test_section_id`, `project_id`) VALUES
(51, 'Shorts Movie', 'SS-1', 'Medium', 'Positive', 'Shorts Movie YT', '', '', 34, 34, 25),
(52, 'Reels Movie', 'RR-2', 'High', 'Negative', 'Reels Movie YT', '', '', 35, 35, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_section`
--

CREATE TABLE `test_section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `test_suite_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `test_section`
--

INSERT INTO `test_section` (`id`, `name`, `test_suite_id`, `project_id`) VALUES
(34, 'Shorts YT', 34, 25),
(35, 'Reels YT', 35, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `test_suite`
--

CREATE TABLE `test_suite` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `test_suite`
--

INSERT INTO `test_suite` (`id`, `name`, `description`, `project_id`) VALUES
(34, 'Shorts', '', 25),
(35, 'Reels', '', 25),
(36, 'Video', '', 27),
(37, 'Foto', '', 27),
(38, 'Album', '', 27);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('super admin','member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'winda pratama', 'winda@gmail.com', '101010', 'super admin'),
(6, 'Mawar', 'mawareva@gmail.com', '12345', 'member'),
(7, 'Prilly', 'prilly@gmail.com', '12345', 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `test_case`
--
ALTER TABLE `test_case`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_section_id` (`instruction`(768)),
  ADD KEY `test_suite_id` (`precondition`(768));

--
-- Indeks untuk tabel `test_section`
--
ALTER TABLE `test_section`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_suite_id` (`test_suite_id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `test_suite`
--
ALTER TABLE `test_suite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `test_case`
--
ALTER TABLE `test_case`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `test_section`
--
ALTER TABLE `test_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `test_suite`
--
ALTER TABLE `test_suite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
