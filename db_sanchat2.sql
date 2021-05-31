-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Agu 2020 pada 03.01
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sanchat2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `group_id` int(225) NOT NULL,
  `owner_id` int(225) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`group_id`, `owner_id`, `name`) VALUES
(1, 1, 'My Family'),
(2, 1, 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_message`
--

CREATE TABLE `group_message` (
  `message_id` int(225) NOT NULL,
  `group_id` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `group_message`
--

INSERT INTO `group_message` (`message_id`, `group_id`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_user`
--

CREATE TABLE `group_user` (
  `user_id` int(225) NOT NULL,
  `group_id` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `group_user`
--

INSERT INTO `group_user` (`user_id`, `group_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `message_id` int(225) NOT NULL,
  `user_id` int(225) NOT NULL,
  `message` text NOT NULL,
  `deleted` int(1) DEFAULT '0',
  `sent_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `message`, `deleted`, `sent_at`) VALUES
(1, 1, '23', 1, '2019-11-02 02:53:59'),
(2, 1, '23', 1, '2019-11-02 02:54:01'),
(3, 1, '333<br />\n', 1, '2019-11-02 10:57:43'),
(4, 1, '23<br />\n', 1, '2019-11-02 10:57:47'),
(5, 1, '123<br />\n123<br />\n<br />\n', 1, '2019-11-02 11:01:28'),
(6, 1, '123<br />\n123<br />\n', 1, '2019-11-02 11:01:33'),
(7, 1, '123<br />\n123<br />\n!@<br />\n', 1, '2019-11-02 11:02:42'),
(8, 1, '33<br />\n', 1, '2019-11-02 11:03:22'),
(9, 1, '!@#<br />\n!@#<br />\n<br />\n<br />\n', 1, '2019-11-02 11:03:31'),
(10, 1, '<br />\n<br />\n<br />\n', 1, '2019-11-02 11:03:55'),
(11, 1, '<br />\n', 1, '2019-11-02 11:04:18'),
(12, 1, '<br />\n<br />\n<br />\n<br />\n', 1, '2019-11-02 11:04:21'),
(13, 1, '123123', 1, '2019-11-02 11:10:22'),
(14, 1, '1<br />\n@<br />\n#<br />\n$<br />\n<br />\n4', 1, '2019-11-02 11:10:34'),
(15, 1, '123123      123123<br />\n', 1, '2019-11-02 11:10:53'),
(16, 1, '<br />\n<br />\n<br />\n<br />\n', 1, '2019-11-02 11:10:58'),
(17, 1, '23', 1, '2019-11-02 13:19:04'),
(18, 1, '23<br />\n123', 1, '2019-11-02 13:19:09'),
(19, 3, '11', 1, '2019-11-02 15:20:25'),
(20, 3, '1', 1, '2019-11-02 15:20:31'),
(21, 3, '23', 1, '2019-11-02 15:20:42'),
(22, 3, '44', 1, '2019-11-02 15:20:46'),
(23, 3, 'd', 1, '2019-11-02 15:31:34'),
(24, 3, 'd', 1, '2019-11-02 15:32:13'),
(25, 1, 'tes', 0, '2019-11-02 18:16:20'),
(26, 1, 'tes', 0, '2019-11-02 18:16:22'),
(27, 2, 'Halo', 0, '2020-08-26 07:54:02'),
(28, 2, 'as', 0, '2020-08-26 07:54:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(225) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_activity` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `name`, `username`, `password`, `last_activity`) VALUES
(1, 'Hafizh', 'mhafizhrh', 'hafizh99', '2020-08-26 08:00:20'),
(2, 'admin', 'admin', 'admin', '2020-08-26 08:01:00'),
(3, 'Admin', 'admin2', 'hafizh99', '2019-11-02 15:48:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_friends`
--

CREATE TABLE `user_friends` (
  `user1_id` int(225) NOT NULL,
  `user2_id` int(225) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `user_request_id` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user_friends`
--

INSERT INTO `user_friends` (`user1_id`, `user2_id`, `status`, `user_request_id`) VALUES
(1, 2, 1, 1),
(1, 3, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `user_friends`
--
ALTER TABLE `user_friends`
  ADD UNIQUE KEY `user1_id` (`user1_id`,`user2_id`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
