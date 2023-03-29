-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 04.31
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
-- Database: `db_webstore_pkk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL,
  `category_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`id_category`, `category_name`, `category_picture`) VALUES
(7, 'Shoes', 'category1666315994.png'),
(8, 'Glasses', 'category1666315980.png'),
(9, 'T-Shirt', 'category1666315958.png'),
(10, 'Hoodie', 'category1666315947.png'),
(11, 'Hats', 'category1673650268.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detailtransaksi`
--

CREATE TABLE `tb_detailtransaksi` (
  `id_trans` varchar(5) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_condition` varchar(50) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`id_product`, `id_category`, `product_name`, `product_price`, `product_condition`, `product_desc`, `product_image`, `product_status`, `date_created`) VALUES
(3, 9, 'F&D T-Shirt Greek Original Edition', 165000, 'New', 'Barang Masih bagus aman dan terpercaya', 'product1665657374.png', 1, '2022-10-13 10:36:14'),
(4, 9, 'F&D T-Shirt Freedom Original Edition', 165000, 'New', 'Barang bagus aman dan terpercaya', 'product1665657416.png', 1, '2022-10-13 10:36:56'),
(5, 9, 'F&D T-Shirt Mythologic Original Edition', 165000, 'New', 'Bagus aman dan terpercaya', 'product1665657457.png', 1, '2022-10-13 10:37:37'),
(6, 9, 'F&D T-Shirt Mochi Edition', 165000, 'New', 'Bagus aman dan terpercaya', 'product1665657489.png', 1, '2022-10-13 10:38:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_trans` varchar(5) NOT NULL,
  `id_user` date NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_trans` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `nama`, `password`, `tgl_lahir`, `jk`, `email`, `telp`, `alamat`, `gambar`, `level`) VALUES
(1, 'budi', '-', '123', '2006-06-04', 'Pria', 'hermawan12@gmail.com', '0895378179800', '-', '-', 'user'),
(4, 'saya', '-', '123', '0000-00-00', '', 'sayastress@gmail.com', '-', '-', '-', 'user'),
(5, 'ridhoos', '-', 'enter', '0000-00-00', '', 'dorido@gmail.com', '-', '-', '-', 'admin'),
(7, 'ridho sulistyo saputro', '-', '123', '0000-00-00', '-', 'dorido123@gmail.com', '-', '-', '-', 'user'),
(9, 'aryaaaaaa', '-', '123', '0000-00-00', '-', 'aryaryuga3@gmail.com', '-', '-', '-', 'user'),
(10, 'doctor', 'Dr Doctor', '$2y$10$oysRkILk2gfLrXiFFhhJHOF.M5oOy/Oue3flZMwp60PA7Fy0CKCqO', '2006-06-04', 'Pria', 'drdoctor@gmail.com', '0895378179800', 'Rhodes Island', '-', 'admin'),
(11, 'zoro', '-', '$2y$10$K0n8eCd.Otx02at.X4HYcOEuqw8iNipDxgISw26xOclrOsYgNsqbm', '0000-00-00', '-', 'zoro123@gmail.com', '-', '-', '-', 'user'),
(12, 'dorido', '-', '$2y$10$K0n8eCd.Otx02at.X4HYcOEuqw8iNipDxgISw26xOclrOsYgNsqbm', '0000-00-00', '-', 'apaaja@gmail.com', '-', '-', '-', 'user'),
(13, 'hero', '-', '$2y$10$xcCRpYYV6EbOVx44BjeJ1.66XpdG6w7CtTqAzbJBKn7lKJvMQK8LS', '0000-00-00', '-', 'heroro@gmail.com', '-', '-', '-', 'user'),
(14, 'D', 'Doctor', '$2y$10$gqR51w5NSxizsFXH1Pnt4Ot74ZqlnbhBp7laJPHR/z11Dzm6DQnhe', '2006-02-28', 'Pria', 'dc@gmail.com', '0895378179800', 'Jln Soekarno Hatta', '-', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
