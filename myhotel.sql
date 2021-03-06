-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Sep 2019 pada 15.03
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myhotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_costumer`
--

CREATE TABLE `tb_costumer` (
  `id_costumer` int(11) NOT NULL,
  `nama_costumer` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `created_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_costumer`
--

INSERT INTO `tb_costumer` (`id_costumer`, `nama_costumer`, `email`, `password`, `photo`, `jk`, `created_date`) VALUES
(3, 'Key', 'key@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'no-pict.png', 'Perempuan', '2019-09-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_photos`
--

CREATE TABLE `tb_photos` (
  `id_photos` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `photos` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_photos`
--

INSERT INTO `tb_photos` (`id_photos`, `id_room`, `photos`) VALUES
(20, 5, '1000102906_2_wh_hr_10005651-23ce4a83e2b0f02970e5ec27bf13667c.jpeg'),
(21, 5, '1000102906_1_wh_hr_10005651-5084c56c84e7b0eb00374ebb0724c3a9.jpeg'),
(22, 5, '1000102906_0_wh_hr_10005651-1024x683-FIT-AND-TRIM-8fd0746c55e0f40572d3b89b213a4bae.jpeg'),
(23, 6, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(24, 6, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(25, 6, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(26, 6, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(27, 7, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(28, 7, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg'),
(29, 8, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg1000274355_0_wh_hr_20025088-f55dbbcfd75d9c63fca93eabb23fca3f.jpeg'),
(30, 8, '1000102902_1_wh_hr_10005651-3200x1856-FIT-AND-TRIM-9a207cb197eab6caaeab137009821e50.jpeg1000274355_2_wh_hr_20025088-1df940667c40f23541a5828067b96779.jpeg'),
(31, 8, '1000274355_1_wh_hr_20025088-1ea0b8388e5ee6eb85a1fa946f186fea.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_room`
--

CREATE TABLE `tb_room` (
  `id_room` int(11) NOT NULL,
  `nama_room` varchar(50) NOT NULL,
  `jml_kamar` int(11) NOT NULL,
  `size_dewasa` int(11) NOT NULL,
  `size_anak` int(11) NOT NULL,
  `jml_tersedia` int(11) NOT NULL,
  `kasur_ranjang` int(11) NOT NULL,
  `kasur_single` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_room`
--

INSERT INTO `tb_room` (`id_room`, `nama_room`, `jml_kamar`, `size_dewasa`, `size_anak`, `jml_tersedia`, `kasur_ranjang`, `kasur_single`, `harga`) VALUES
(4, 'Executive Twin', 15, 2, 2, 15, 0, 2, 457000),
(5, 'Deluxe Twin', 25, 2, 2, 25, 0, 2, 425000),
(6, 'Superior Twin', 10, 2, 2, 10, 0, 2, 383500),
(7, 'Deluxe Double', 8, 2, 0, 8, 1, 0, 355000),
(8, 'Family Room', 5, 2, 2, 5, 1, 2, 223630);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_trans_rooms`
--

CREATE TABLE `tb_trans_rooms` (
  `id_trans` varchar(12) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `id_costumer` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` enum('pending','check_in','check_out','cancel','waiting') NOT NULL,
  `modify_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_trans_rooms`
--

INSERT INTO `tb_trans_rooms` (`id_trans`, `check_in`, `check_out`, `id_costumer`, `id_room`, `total`, `status`, `modify_date`) VALUES
('INV190925000', '2019-09-11', '2019-09-13', 3, 5, 850000, 'check_in', '2019-09-25 15:40:36'),
('INV190925001', '2019-09-11', '2019-09-13', 3, 5, 850000, 'cancel', '2019-09-24 16:02:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_admin`, `nama`, `email`, `password`, `photo`) VALUES
(1, 'Keisya Puspitasari', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'no-pict.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_costumer`
--
ALTER TABLE `tb_costumer`
  ADD PRIMARY KEY (`id_costumer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `tb_photos`
--
ALTER TABLE `tb_photos`
  ADD PRIMARY KEY (`id_photos`),
  ADD KEY `id_room` (`id_room`);

--
-- Indeks untuk tabel `tb_room`
--
ALTER TABLE `tb_room`
  ADD PRIMARY KEY (`id_room`);

--
-- Indeks untuk tabel `tb_trans_rooms`
--
ALTER TABLE `tb_trans_rooms`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_costumer` (`id_costumer`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_costumer`
--
ALTER TABLE `tb_costumer`
  MODIFY `id_costumer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_photos`
--
ALTER TABLE `tb_photos`
  MODIFY `id_photos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tb_room`
--
ALTER TABLE `tb_room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_photos`
--
ALTER TABLE `tb_photos`
  ADD CONSTRAINT `fk_photo` FOREIGN KEY (`id_room`) REFERENCES `tb_room` (`id_room`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_trans_rooms`
--
ALTER TABLE `tb_trans_rooms`
  ADD CONSTRAINT `fk_trans_room_idcostumer` FOREIGN KEY (`id_costumer`) REFERENCES `tb_costumer` (`id_costumer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_trans_room_idroom` FOREIGN KEY (`id_room`) REFERENCES `tb_room` (`id_room`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
