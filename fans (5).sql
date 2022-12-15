-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Des 2022 pada 03.35
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fans`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kode_akun` varchar(7) NOT NULL,
  `nama_akun` varchar(30) NOT NULL,
  `email_akun` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_level` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_akun`, `email_akun`, `password`, `id_level`) VALUES
('AA00001', 'owner', 'owner@gmail.com', '$2y$10$H7QhLQXmx7/K46Mk/3.1n.hUYkgY1oD3Zb13v/yQWhmgvKPoK25ZW', 1),
('AA00002', 'admin', 'admin@gmail.com', '$2y$10$I.Ycq5ccEggYwgJQcSnXJeVfqXkZEfioXEESt6uoGX2pxir2GekaS', 2),
('AA00003', 'fillah', 'fillah@gmail.com', '$2y$10$kzwnVrlNnANPzXfUkd53Y.EhUwDBYmThitatAHpLV5bnppDLoAX5C', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `faq`
--

CREATE TABLE `faq` (
  `id` int(7) NOT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `jawaban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `level_akun`
--

CREATE TABLE `level_akun` (
  `id_level` int(4) NOT NULL,
  `level` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level_akun`
--

INSERT INTO `level_akun` (`id_level`, `level`) VALUES
(1, 'Super'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(7) NOT NULL,
  `nama_pelanggan` varchar(25) NOT NULL,
  `email_pelanggan` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `nomer_hp` varchar(13) NOT NULL,
  `status` varchar(15) NOT NULL,
  `tanggal_berlangganan` date NOT NULL,
  `kode_produk` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `email_pelanggan`, `password`, `nomer_hp`, `status`, `tanggal_berlangganan`, `kode_produk`) VALUES
('PL00001', 'rio', 'rio@gmail.com', '123', '08880583766', 'non aktif', '2022-12-05', 'PD00002');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(7) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `kecepatan` varchar(8) NOT NULL,
  `harga_produk` int(7) NOT NULL,
  `bandwith` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `kecepatan`, `harga_produk`, `bandwith`) VALUES
('PD00001', 'Internet Lite', '10 ', 100000, '1:4'),
('PD00002', 'Internet Dedicated', '20', 150000, '1:4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `kode_transaksi` varchar(7) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total` int(7) NOT NULL,
  `kode_akun` varchar(7) NOT NULL,
  `kode_pelanggan` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `tanggal_transaksi`, `total`, `kode_akun`, `kode_pelanggan`) VALUES
('TR00001', '2022-12-05', 100000, 'AA00001', 'PL00001'),
('TR00002', '2022-12-05', 100000, 'AA00001', 'PL00001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode_akun`),
  ADD KEY `id_level` (`id_level`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level_akun`
--
ALTER TABLE `level_akun`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`),
  ADD KEY `pelanggan_ibfk_1` (`kode_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode_transaksi`),
  ADD KEY `kode_akun` (`kode_akun`),
  ADD KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `level_akun`
--
ALTER TABLE `level_akun`
  MODIFY `id_level` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_akun` (`id_level`);

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_akun`) REFERENCES `akun` (`kode_akun`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
