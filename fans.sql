-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Nov 2022 pada 13.00
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
  `level` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_akun`, `email_akun`, `password`, `level`) VALUES
('AA00001', 'owner', 'owner@gmail.com', '$2y$10$H7QhLQXmx7/K46Mk/3.1n.hUYkgY1oD3Zb13v/yQWhmgvKPoK25ZW', 'Super');

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
('PL00001', 'fillah', 'fillah@gamil.com', '123', '123', 'aktif', '2022-11-25', 'PD00001'),
('PL00002', '1', '1', '1', '12', 'aktif', '2022-11-25', 'PD00001'),
('PL00003', '1', '1', '1', '1', 'aktif', '2022-11-25', 'PD00001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `kode_gambar` varchar(7) NOT NULL,
  `gambar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(7) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `kecepatan` varchar(8) NOT NULL,
  `harga_produk` int(7) NOT NULL,
  `stok` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `kecepatan`, `harga_produk`, `stok`) VALUES
('PD00001', 'Internet Lite', '10 mbps', 150000, '100'),
('PD00002', '1', '1', 1, '1');

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
('TR00001', '2022-11-25', 150000, 'AA00001', 'PL00002'),
('TR00002', '2022-11-25', 150000, 'AA00001', 'PL00003'),
('TR00003', '2022-11-25', 150000, 'AA00001', 'PL00001'),
('TR00004', '2022-11-25', 150000, 'AA00001', 'PL00001'),
('TR00005', '2022-11-25', 150000, 'AA00001', 'PL00003'),
('TR00006', '2022-11-25', 150000, 'AA00001', 'PL00001'),
('TR00007', '2022-11-25', 150000, 'AA00001', 'PL00001');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`),
  ADD KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`kode_gambar`);

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
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`kode_produk`) REFERENCES `produk` (`kode_produk`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`kode_akun`) REFERENCES `akun` (`kode_akun`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`kode_pelanggan`) REFERENCES `pelanggan` (`kode_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
