-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 07:29 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_bank`
--

CREATE TABLE `mst_bank` (
  `id_bank` int(11) NOT NULL,
  `nama_bank` text NOT NULL,
  `no_rek` text NOT NULL,
  `cabang` text NOT NULL,
  `kota` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_bank`
--

INSERT INTO `mst_bank` (`id_bank`, `nama_bank`, `no_rek`, `cabang`, `kota`) VALUES
(1, 'BCA', '12345678913456', 'Kudus', 'Kudus'),
(2, 'Bank Mandiri', '987654321123456', 'Pati', 'Pati');

-- --------------------------------------------------------

--
-- Table structure for table `mst_biaya`
--

CREATE TABLE `mst_biaya` (
  `id_biaya` int(11) NOT NULL,
  `nama_biaya` text NOT NULL,
  `jml_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_biaya`
--

INSERT INTO `mst_biaya` (`id_biaya`, `nama_biaya`, `jml_biaya`) VALUES
(1, 'Uang Bensin', 15000),
(2, 'Uang Makan', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `mst_cabang`
--

CREATE TABLE `mst_cabang` (
  `id_cabang` int(11) NOT NULL,
  `kode_cabang` text NOT NULL,
  `nama_cabang` text NOT NULL,
  `alamat_cabang` text NOT NULL,
  `no_telp_cab` text NOT NULL,
  `manager` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_cabang`
--

INSERT INTO `mst_cabang` (`id_cabang`, `kode_cabang`, `nama_cabang`, `alamat_cabang`, `no_telp_cab`, `manager`) VALUES
(2, 'CAB-03012020-0001', 'ADONIA', 'Jl. Sosrokartono No. 45', '081228690093', 'Donny'),
(3, 'CAB-06012020-0002', 'Kerinci', 'Jl. Dewi Sartika No. 13', '081226435113', 'Ata');

-- --------------------------------------------------------

--
-- Table structure for table `mst_kendaraan`
--

CREATE TABLE `mst_kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `nama_kendaraan` text NOT NULL,
  `nopol` text NOT NULL,
  `bbm` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_kendaraan`
--

INSERT INTO `mst_kendaraan` (`id_kendaraan`, `nama_kendaraan`, `nopol`, `bbm`) VALUES
(1, 'Mitsubishi L300', 'K 3676 VB', 'Solar'),
(2, 'Daihatsu Grandmax', 'H 1616 FK', 'Bensin'),
(3, 'Suzuki Carry 1.3', 'H 1234 FG', 'Bensin');

-- --------------------------------------------------------

--
-- Table structure for table `mst_tarif`
--

CREATE TABLE `mst_tarif` (
  `id_tarif` int(11) NOT NULL,
  `kota_asal` text NOT NULL,
  `kota_tujuan` text NOT NULL,
  `tarif_volume` int(11) NOT NULL,
  `tarif_jarak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_tarif`
--

INSERT INTO `mst_tarif` (`id_tarif`, `kota_asal`, `kota_tujuan`, `tarif_volume`, `tarif_jarak`) VALUES
(1, 'Kudus', 'Pati', 1500, 2000),
(2, 'Kudus', 'Semarang', 2500, 3000),
(3, 'Rembang', 'Semarang', 5500, 7000);

-- --------------------------------------------------------

--
-- Table structure for table `mst_toko`
--

CREATE TABLE `mst_toko` (
  `id_toko` int(11) NOT NULL,
  `pemilik` text NOT NULL,
  `nama_toko` text NOT NULL,
  `alamat_toko` text NOT NULL,
  `telp_toko` text NOT NULL,
  `npwp` text NOT NULL,
  `diskon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_toko`
--

INSERT INTO `mst_toko` (`id_toko`, `pemilik`, `nama_toko`, `alamat_toko`, `telp_toko`, `npwp`, `diskon`) VALUES
(1, 'Donny Kurniawan', 'ADONIA Jaya', 'Jl. Dewi Sartika no 32', '291448048', '1235468452321654', 1000),
(2, 'Ratna Damayanti', 'Ratna Cell', 'Jl. Sosrokartono no 45', '2147483647', '987654321', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `mst_tujuan`
--

CREATE TABLE `mst_tujuan` (
  `id_tujuan` int(11) NOT NULL,
  `nama_tujuan` text NOT NULL,
  `kota` text NOT NULL,
  `jarak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_tujuan`
--

INSERT INTO `mst_tujuan` (`id_tujuan`, `nama_tujuan`, `kota`, `jarak`) VALUES
(1, 'CV. Adonia Jaya', 'Kudus', 10),
(2, 'Toko Juragan Asli', 'Rembang', 45);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE `mst_user` (
  `id_user` int(11) NOT NULL,
  `nama` text NOT NULL,
  `email` varchar(150) NOT NULL,
  `hp` text NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `level` text NOT NULL,
  `image` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`id_user`, `nama`, `email`, `hp`, `username`, `password`, `level`, `image`, `date_created`, `is_active`) VALUES
(24, 'Donny Kurniawan', 'ata.adonia@gmail.com', '08122860093', 'admin', '$2y$10$X/CJ0lA8IxifIulrHolXH.l.vHQLr5Lw08RgWZEwbcmUVgXeYh58O', 'Admin', 'avatar04.png', '2019-10-30', 1),
(34, 'Donny K', 'ata.adonia@gmail.com', '08995625604', 'spv', '$2y$10$2gzLpfgcyAyyvDM0h.99geo4Ba4xYC/sDnpugYcVQ2I.mTZ3wPlHK', 'Supervisor', 'default.jpg', '2019-12-08', 1),
(35, 'Adonia Vincent N', 'admin@gmail.com', '08122567898', 'driver', '$2y$10$NYJ4yN/kTlwsNRKAM9.nouu7ojiedpCkadbwzU98lqBgB0VT0AQ4m', 'Driver', 'avatar51.png', '2019-12-08', 1),
(36, 'Donny Kurniawan', 'ata.adonia@gmail.com', '08995625604', 'gerai', '$2y$10$tHSens7Qvf8TzaYC.zoVJOOp/5plWIKz6CWnbj34JzFUNs0VSUJ7q', 'Gerai', 'avatar041.png', '2020-01-08', 1),
(38, 'Adonia Vincent N', 'natan.adonia@gmail.com', '08122567894', 'user', '$2y$10$aSU94e7Q4TPl79b2LmvrF.o2.E.ITyQpb1HCkisAnDCf/Q9mHgZ3q', 'User', 'avatar52.png', '2020-02-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `sess_nama` text NOT NULL,
  `tgl_order` date NOT NULL,
  `kode_order` text NOT NULL,
  `nama_pengirim` text NOT NULL,
  `telp_pengirim` text NOT NULL,
  `alamat_pengirim` text NOT NULL,
  `nama_penerima` text NOT NULL,
  `telp_penerima` text NOT NULL,
  `alamat_penerima` text NOT NULL,
  `status_pickup` int(11) NOT NULL,
  `sukses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `sess_nama`, `tgl_order`, `kode_order`, `nama_pengirim`, `telp_pengirim`, `alamat_pengirim`, `nama_penerima`, `telp_penerima`, `alamat_penerima`, `status_pickup`, `sukses`) VALUES
(4, '', '2020-02-05', 'POJ-05022020-0829-0001', 'Donny Kurniawan', '2147483647', 'Ds. SIngocandi rt', 'Adonia', '899999999', 'jhjhjjjhjhjh', 0, 0),
(5, '', '2020-02-06', 'POV-06022020-0108-0002', 'Adonia Vincent', '08122860093', 'Ds. Harjoningrum', 'Della Putra', '08992345678', 'Jl. Markibuk 45', 1, 1),
(6, '', '2020-02-12', 'POJ-06022020-0114-0003', 'Yosafat', '08985858585', 'Pati', 'Ardi', '08156478965412', 'Tegal', 1, 1),
(7, 'Donny Kurniawan', '2020-02-12', 'POJ-12022020-0223-0004', 'Ardi Handoko', '0812256898745', 'Ds. Sengon 3 no 45 rt/rw : 05/06 Salatiga', 'Putri Wijaya', '0812565421456', 'Ds. Amburadul 96 Blora', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perjalanan`
--

CREATE TABLE `tb_perjalanan` (
  `id_route` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `tgl_dinas` date NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `tujuan_id` int(11) NOT NULL,
  `biaya_dinas` int(11) NOT NULL,
  `ket` text NOT NULL,
  `km_awal` int(11) NOT NULL,
  `km_akhir` int(11) NOT NULL,
  `beli_bbm` int(11) NOT NULL,
  `biaya_lain` int(11) NOT NULL,
  `file1` varchar(150) NOT NULL,
  `file2` varchar(150) NOT NULL,
  `confirm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perjalanan`
--

INSERT INTO `tb_perjalanan` (`id_route`, `sess_id`, `tgl_dinas`, `kendaraan_id`, `tujuan_id`, `biaya_dinas`, `ket`, `km_awal`, `km_akhir`, `beli_bbm`, `biaya_lain`, `file1`, `file2`, `confirm`) VALUES
(2, 35, '2019-12-10', 1, 2, 150000, '-', 123001, 123100, 100000, 0, '1.png', '2.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pickup`
--

CREATE TABLE `tb_pickup` (
  `id_pickup` int(11) NOT NULL,
  `sess_id` int(11) NOT NULL,
  `tgl_pickup` date NOT NULL,
  `order_kd` text NOT NULL,
  `tgl_kirim` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pickup`
--

INSERT INTO `tb_pickup` (`id_pickup`, `sess_id`, `tgl_pickup`, `order_kd`, `tgl_kirim`) VALUES
(6, 35, '2020-02-12', 'POJ-05022020-0829-0001', '0000-00-00'),
(7, 35, '2020-02-12', 'POJ-12022020-0223-0004', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_jarak`
--

CREATE TABLE `transaksi_jarak` (
  `id_transaksi_jarak` int(11) NOT NULL,
  `transaksi_kode` text NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jarak` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_jarak`
--

INSERT INTO `transaksi_jarak` (`id_transaksi_jarak`, `transaksi_kode`, `tgl_transaksi`, `jarak`, `nominal`, `pembayaran`) VALUES
(1, 'POJ-05022020-0829-0001', '2020-02-05', 2, 2000, 4000),
(2, 'POJ-06022020-0114-0003', '2020-02-12', 4, 3000, 12000),
(3, 'POJ-12022020-0223-0004', '2020-02-12', 4, 2000, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_volume`
--

CREATE TABLE `transaksi_volume` (
  `id_transaksi_volume` int(11) NOT NULL,
  `transaksi_kode` text NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `volume` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_volume`
--

INSERT INTO `transaksi_volume` (`id_transaksi_volume`, `transaksi_kode`, `tgl_transaksi`, `volume`, `nominal`, `pembayaran`) VALUES
(1, 'POV-06022020-0108-0002', '2020-02-06', 6, 3000, 18000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_bank`
--
ALTER TABLE `mst_bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `mst_biaya`
--
ALTER TABLE `mst_biaya`
  ADD PRIMARY KEY (`id_biaya`);

--
-- Indexes for table `mst_cabang`
--
ALTER TABLE `mst_cabang`
  ADD PRIMARY KEY (`id_cabang`);

--
-- Indexes for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `mst_tarif`
--
ALTER TABLE `mst_tarif`
  ADD PRIMARY KEY (`id_tarif`);

--
-- Indexes for table `mst_toko`
--
ALTER TABLE `mst_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `mst_tujuan`
--
ALTER TABLE `mst_tujuan`
  ADD PRIMARY KEY (`id_tujuan`);

--
-- Indexes for table `mst_user`
--
ALTER TABLE `mst_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_perjalanan`
--
ALTER TABLE `tb_perjalanan`
  ADD PRIMARY KEY (`id_route`);

--
-- Indexes for table `tb_pickup`
--
ALTER TABLE `tb_pickup`
  ADD PRIMARY KEY (`id_pickup`);

--
-- Indexes for table `transaksi_jarak`
--
ALTER TABLE `transaksi_jarak`
  ADD PRIMARY KEY (`id_transaksi_jarak`);

--
-- Indexes for table `transaksi_volume`
--
ALTER TABLE `transaksi_volume`
  ADD PRIMARY KEY (`id_transaksi_volume`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_bank`
--
ALTER TABLE `mst_bank`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_biaya`
--
ALTER TABLE `mst_biaya`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_cabang`
--
ALTER TABLE `mst_cabang`
  MODIFY `id_cabang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_tarif`
--
ALTER TABLE `mst_tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_toko`
--
ALTER TABLE `mst_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_tujuan`
--
ALTER TABLE `mst_tujuan`
  MODIFY `id_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mst_user`
--
ALTER TABLE `mst_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_perjalanan`
--
ALTER TABLE `tb_perjalanan`
  MODIFY `id_route` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pickup`
--
ALTER TABLE `tb_pickup`
  MODIFY `id_pickup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_jarak`
--
ALTER TABLE `transaksi_jarak`
  MODIFY `id_transaksi_jarak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_volume`
--
ALTER TABLE `transaksi_volume`
  MODIFY `id_transaksi_volume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
