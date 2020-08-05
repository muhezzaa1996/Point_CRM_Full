-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 02:11 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_kontrak`
--

CREATE TABLE `log_kontrak` (
  `id_log_kontrak` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `sess_nama` text NOT NULL,
  `tgl_project` date NOT NULL,
  `perusahaan` text NOT NULL,
  `kode_customer` text NOT NULL,
  `no_job` text NOT NULL,
  `nama_project` text NOT NULL,
  `nilai_project` bigint(50) NOT NULL,
  `snilai_project` varchar(50) NOT NULL,
  `peluang` int(11) NOT NULL,
  `sales1` text NOT NULL,
  `sales2` text NOT NULL,
  `sales3` text NOT NULL,
  `sales4` text NOT NULL,
  `keterangan` text NOT NULL,
  `alasan` text NOT NULL,
  `tgl_update` date NOT NULL,
  `username` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_kontrak`
--

INSERT INTO `log_kontrak` (`id_log_kontrak`, `id_kontrak`, `sess_nama`, `tgl_project`, `perusahaan`, `kode_customer`, `no_job`, `nama_project`, `nilai_project`, `snilai_project`, `peluang`, `sales1`, `sales2`, `sales3`, `sales4`, `keterangan`, `alasan`, `tgl_update`, `username`, `status`) VALUES
(276, 49, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-001', 'Project Pemasangan Antena Radar Bea Cukai Cab. Jakarta Timur', 450000000, '450.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 3 Bulan', '', '2020-08-04', 'admin', 1),
(277, 49, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-001', 'Project Pemasangan Antena Radar Bea Cukai Cab. Jakarta Timur', 450000000, '450.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 4 Bulan', 'Terjadi Perubahan Waktu Deadline', '2020-08-04', 'admin', 2),
(278, 49, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-001', 'Project Pemasangan Antena Radar Bea Cukai Cab. Jakarta Timur', 450000000, '450.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 4 Bulan', 'Terjadi Perubahan Waktu Deadline', '2020-08-04', 'admin', 4),
(279, 50, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-002', 'Project Instalasi Radio', 300000000, '300.000.000', 10, 'bph', 'CSD', 'N/A', 'N/A', 'Deadline 2 Bulan', '', '2020-08-04', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_project`
--

CREATE TABLE `log_project` (
  `id_log` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `sess_nama` text NOT NULL,
  `tgl_project` date NOT NULL,
  `perusahaan` text NOT NULL,
  `kode_customer` text NOT NULL,
  `no_job` text NOT NULL,
  `nama_project` text NOT NULL,
  `nilai_project` bigint(50) NOT NULL,
  `snilai_project` varchar(50) NOT NULL,
  `peluang` int(11) NOT NULL,
  `sales1` text NOT NULL,
  `sales2` text NOT NULL,
  `sales3` text NOT NULL,
  `sales4` text NOT NULL,
  `keterangan` text NOT NULL,
  `alasan` text NOT NULL,
  `tgl_update` date NOT NULL,
  `username` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_project`
--

INSERT INTO `log_project` (`id_log`, `id_project`, `sess_nama`, `tgl_project`, `perusahaan`, `kode_customer`, `no_job`, `nama_project`, `nilai_project`, `snilai_project`, `peluang`, `sales1`, `sales2`, `sales3`, `sales4`, `keterangan`, `alasan`, `tgl_update`, `username`, `status`) VALUES
(250, 192, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'MITG-202008-001', 'Project Pembuatan Aplikasi Sistem Monitoring Kapal Laut', 500000000, '500.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 6 Bulan', '', '2020-08-04', 'admin', 1),
(251, 192, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'MITG-202008-001', 'Project Pembuatan Aplikasi Sistem Monitoring Kapal Laut', 500000000, '500.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 6 Bulan', '', '2020-08-04', 'admin', 4),
(252, 192, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'MITG-202008-001', 'Project Pembuatan Aplikasi Sistem Monitoring Kapal Laut', 500000000, '500.000.000', 100, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 6 Bulan', 'Clear', '2020-08-04', 'admin', 2);

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
-- Table structure for table `mst_company`
--

CREATE TABLE `mst_company` (
  `id_comp` int(11) NOT NULL,
  `kode_comp` text NOT NULL,
  `nama_comp` text NOT NULL,
  `alamat_comp` text NOT NULL,
  `telp_comp` text NOT NULL,
  `email` text NOT NULL,
  `direktur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_company`
--

INSERT INTO `mst_company` (`id_comp`, `kode_comp`, `nama_comp`, `alamat_comp`, `telp_comp`, `email`, `direktur`) VALUES
(3, 'PGT', 'PT. PANORAMA GRAHA TEKNOLOGI', 'asasa', '12121', 'mname84@gmail.com', 'asasa'),
(4, 'DDU', 'PT DHARMA DWITUNGGAL UTAMA KK', 'tes', '1212', 'mname84@gmail.com', 'dada'),
(5, 'MIM', 'PT. MULTIINTEGRA MEDIKA', '', '', '', ''),
(6, 'MID', 'PT. MULTIINTEGRA DIGITAL', '', '', '', ''),
(12, 'MI', 'PT. MULTIINTEGRA', 'Jl. Berdikari Raya', '021889', 'multiintegra@gmail.com', 'Mr'),
(13, 'JKT', 'PT. JAKARTA KOTA TEKNOLOGI', 'tes', '123', 'tes', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `mst_customer`
--

CREATE TABLE `mst_customer` (
  `id_cust` int(11) NOT NULL,
  `kode_cust` text NOT NULL,
  `nama_cust` text NOT NULL,
  `alamat_cust` text NOT NULL,
  `telp_cust` text NOT NULL,
  `ket_cust` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_customer`
--

INSERT INTO `mst_customer` (`id_cust`, `kode_cust`, `nama_cust`, `alamat_cust`, `telp_cust`, `ket_cust`, `status`) VALUES
(13, 'CUS-03082020-0001', 'Direktorat Jenderal Bea dan Cukai Indonesia', 'Jl. Jend. Ahmad Yani By Pass, RT.12/RW.5, Rawamangun, Kec. Pulo Gadung, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13230', '(021) 1500225', 'OK', 1),
(14, 'CUS-03082020-0002', 'PT. Pertamina Patra Niaga', 'Wisma Tugu II 2nd Floor, JL. HR. Rasuna Said, Kavling C7-9, Kuningan, RT.3/RW.1, Karet, Kuningan, Daerah Khusus Ibukota Jakarta 12920', '(021) 5209009', '', 0),
(15, 'CUS-04082020-0003', 'PT. Brantas Abipraya', 'l. Mayjen DI Panjaitan No.Kav 14, RT.3/RW.11, Cipinang Cempedak, Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13340', '(021) 8516290', '', 0);

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
-- Table structure for table `mst_project`
--

CREATE TABLE `mst_project` (
  `id_project` int(11) NOT NULL,
  `kode_project` text NOT NULL,
  `nama_project` text NOT NULL,
  `kode_cust` text NOT NULL,
  `nama_cust` text NOT NULL,
  `nilai_project` int(11) NOT NULL,
  `peluang` int(11) NOT NULL,
  `sales1` text NOT NULL,
  `sales2` text NOT NULL,
  `sales3` text NOT NULL,
  `sales4` text NOT NULL,
  `ket_project` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mst_sales`
--

CREATE TABLE `mst_sales` (
  `id_sales` int(11) NOT NULL,
  `kode_sales` text NOT NULL,
  `nama_sales` text NOT NULL,
  `jabatan` text NOT NULL,
  `hp` text NOT NULL,
  `email` text NOT NULL,
  `is_active` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mst_sales`
--

INSERT INTO `mst_sales` (`id_sales`, `kode_sales`, `nama_sales`, `jabatan`, `hp`, `email`, `is_active`) VALUES
(5, 'bph', 'bagus puguh 2', '', '4', 'otong@marotong.co.id1', 0),
(6, 'CSD', 'CASMIDI', '', '08128621234', 'casmidiasli@yahoo.co.id', 0),
(7, 'otg', 'otong', '', '09191919', 'otong@otong.co.id', 0),
(8, 'MZR', 'Muhammad Zahra', '', '085314531059', 'mzahra@gmail.com', 0);

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
(24, 'Casmidi Asli', 'casmidiasli@yahoo.co.id', '08128621234', 'admin', '$2y$10$X/CJ0lA8IxifIulrHolXH.l.vHQLr5Lw08RgWZEwbcmUVgXeYh58O', 'Admin', 'foto.jpg', '2019-10-30', 1),
(34, 'Donny K', 'ata.adonia@gmail.com', '08995625604', 'spv', '$2y$10$2gzLpfgcyAyyvDM0h.99geo4Ba4xYC/sDnpugYcVQ2I.mTZ3wPlHK', 'Supervisor', 'default.jpg', '2019-12-08', 1),
(35, 'Adonia Vincent N', 'admin@gmail.com', '08122567898', 'driver', '$2y$10$NYJ4yN/kTlwsNRKAM9.nouu7ojiedpCkadbwzU98lqBgB0VT0AQ4m', 'Gerai', 'avatar51.png', '2019-12-08', 1),
(38, 'Adonia Vincent N', 'natan.adonia@gmail.com', '08122567894', 'user', '$2y$10$aSU94e7Q4TPl79b2LmvrF.o2.E.ITyQpb1HCkisAnDCf/Q9mHgZ3q', 'User', 'avatar52.png', '2020-02-12', 1),
(39, 'gerai', 'casmidiasli@yahoo.co.id', '08999111', 'gerai', '$2y$10$Gqq6XuRJi7Bodj4aQMrn0uy/pfg5n76gEaDNVwx5kzhAaoD.GxKJ.', 'User', '1avatar2.png', '2020-05-17', 1),
(40, 'Betrand Peto', 'mname84@gmail.com', '0888899121', 'manager', '$2y$10$qRME0HeRgv5E9rYh6FFw5OGfTLk4tV8SRwkVpRXBEvak3eYJzYGFm', 'Manager', 'default.jpg', '2020-06-18', 1),
(41, 'Jhony Andreas', 'jon@gmail.com', '123', 'joni', '$2y$10$6kIYukHqGeIbyQfBpuji.O9..6JizEXSZN5ItQH.KroFnsE6tNcyO', 'User', 'default.jpg', '2020-06-22', 1),
(42, 'Muhammad Zahra', 'mname84@gmail.com', '1234', 'zahra', '$2y$10$qiQEhmq4bl/Hjud7d24fY.X9agRsz/BSi3YtoIy/zgeQOA1CEOt3q', 'Admin', 'default.jpg', '2020-06-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashflow`
--

CREATE TABLE `tb_cashflow` (
  `id_cashflow` int(11) NOT NULL,
  `id_project` int(50) NOT NULL,
  `r01` bigint(50) NOT NULL,
  `r02` bigint(50) NOT NULL,
  `r03` bigint(50) NOT NULL,
  `r04` bigint(50) NOT NULL,
  `r05` bigint(50) NOT NULL,
  `r06` bigint(50) NOT NULL,
  `r07` bigint(50) NOT NULL,
  `r08` bigint(50) NOT NULL,
  `r09` bigint(50) NOT NULL,
  `r10` bigint(50) NOT NULL,
  `r11` bigint(50) NOT NULL,
  `r12` bigint(50) NOT NULL,
  `e01` bigint(50) NOT NULL,
  `e02` bigint(50) NOT NULL,
  `e03` bigint(50) NOT NULL,
  `e04` bigint(50) NOT NULL,
  `e05` bigint(50) NOT NULL,
  `e06` bigint(50) NOT NULL,
  `e07` bigint(50) NOT NULL,
  `e08` bigint(50) NOT NULL,
  `e09` bigint(50) NOT NULL,
  `e10` bigint(50) NOT NULL,
  `e11` bigint(50) NOT NULL,
  `e12` bigint(50) NOT NULL,
  `i01` bigint(50) NOT NULL,
  `i02` bigint(50) NOT NULL,
  `i03` bigint(50) NOT NULL,
  `i04` bigint(50) NOT NULL,
  `i05` bigint(50) NOT NULL,
  `i06` bigint(50) NOT NULL,
  `i07` bigint(50) NOT NULL,
  `i08` bigint(50) NOT NULL,
  `i09` bigint(50) NOT NULL,
  `i10` bigint(50) NOT NULL,
  `i11` bigint(50) NOT NULL,
  `i12` bigint(50) NOT NULL,
  `d01` bigint(50) NOT NULL,
  `d02` bigint(50) NOT NULL,
  `d03` bigint(50) NOT NULL,
  `d04` bigint(50) NOT NULL,
  `d05` bigint(50) NOT NULL,
  `d06` bigint(50) NOT NULL,
  `d07` bigint(50) NOT NULL,
  `d08` bigint(50) NOT NULL,
  `d09` bigint(50) NOT NULL,
  `d10` bigint(50) NOT NULL,
  `d11` bigint(50) NOT NULL,
  `d12` bigint(50) NOT NULL,
  `total_revenue` bigint(50) NOT NULL,
  `total_expense` bigint(50) NOT NULL,
  `total_instalasi` bigint(50) NOT NULL,
  `total_differensial` bigint(50) NOT NULL,
  `margin01` bigint(50) NOT NULL,
  `margin02` bigint(50) NOT NULL,
  `margin03` bigint(50) NOT NULL,
  `margin04` bigint(50) NOT NULL,
  `margin05` bigint(50) NOT NULL,
  `margin06` bigint(50) NOT NULL,
  `margin07` bigint(50) NOT NULL,
  `margin08` bigint(50) NOT NULL,
  `margin09` bigint(50) NOT NULL,
  `margin10` bigint(50) NOT NULL,
  `margin11` bigint(50) NOT NULL,
  `margin12` bigint(50) NOT NULL,
  `sr01` varchar(50) NOT NULL,
  `sr02` varchar(50) NOT NULL,
  `sr03` varchar(50) NOT NULL,
  `sr04` varchar(50) NOT NULL,
  `sr05` varchar(50) NOT NULL,
  `sr06` varchar(50) NOT NULL,
  `sr07` varchar(50) NOT NULL,
  `sr08` varchar(50) NOT NULL,
  `sr09` varchar(50) NOT NULL,
  `sr10` varchar(50) NOT NULL,
  `sr11` varchar(50) NOT NULL,
  `sr12` varchar(50) NOT NULL,
  `se01` varchar(50) NOT NULL,
  `se02` varchar(50) NOT NULL,
  `se03` varchar(50) NOT NULL,
  `se04` varchar(50) NOT NULL,
  `se05` varchar(50) NOT NULL,
  `se06` varchar(50) NOT NULL,
  `se07` varchar(50) NOT NULL,
  `se08` varchar(50) NOT NULL,
  `se09` varchar(50) NOT NULL,
  `se10` varchar(50) NOT NULL,
  `se11` varchar(50) NOT NULL,
  `se12` varchar(50) NOT NULL,
  `si01` varchar(50) NOT NULL,
  `si02` varchar(50) NOT NULL,
  `si03` varchar(50) NOT NULL,
  `si04` varchar(50) NOT NULL,
  `si05` varchar(50) NOT NULL,
  `si06` varchar(50) NOT NULL,
  `si07` varchar(50) NOT NULL,
  `si08` varchar(50) NOT NULL,
  `si09` varchar(50) NOT NULL,
  `si10` varchar(50) NOT NULL,
  `si11` varchar(50) NOT NULL,
  `si12` varchar(50) NOT NULL,
  `sd01` varchar(50) NOT NULL,
  `sd02` varchar(50) NOT NULL,
  `sd03` varchar(50) NOT NULL,
  `sd04` varchar(50) NOT NULL,
  `sd05` varchar(50) NOT NULL,
  `sd06` varchar(50) NOT NULL,
  `sd07` varchar(50) NOT NULL,
  `sd08` varchar(50) NOT NULL,
  `sd09` varchar(50) NOT NULL,
  `sd10` varchar(50) NOT NULL,
  `sd11` varchar(50) NOT NULL,
  `sd12` varchar(50) NOT NULL,
  `sm01` varchar(50) NOT NULL,
  `sm02` varchar(50) NOT NULL,
  `sm03` varchar(50) NOT NULL,
  `sm04` varchar(50) NOT NULL,
  `sm05` varchar(50) NOT NULL,
  `sm06` varchar(50) NOT NULL,
  `sm07` varchar(50) NOT NULL,
  `sm08` varchar(50) NOT NULL,
  `sm09` varchar(50) NOT NULL,
  `sm10` varchar(50) NOT NULL,
  `sm11` varchar(50) NOT NULL,
  `sm12` varchar(50) NOT NULL,
  `stotal_revenue` varchar(50) NOT NULL,
  `stotal_expense` varchar(50) NOT NULL,
  `stotal_instalasi` varchar(50) NOT NULL,
  `stotal_differensial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cashflow`
--

INSERT INTO `tb_cashflow` (`id_cashflow`, `id_project`, `r01`, `r02`, `r03`, `r04`, `r05`, `r06`, `r07`, `r08`, `r09`, `r10`, `r11`, `r12`, `e01`, `e02`, `e03`, `e04`, `e05`, `e06`, `e07`, `e08`, `e09`, `e10`, `e11`, `e12`, `i01`, `i02`, `i03`, `i04`, `i05`, `i06`, `i07`, `i08`, `i09`, `i10`, `i11`, `i12`, `d01`, `d02`, `d03`, `d04`, `d05`, `d06`, `d07`, `d08`, `d09`, `d10`, `d11`, `d12`, `total_revenue`, `total_expense`, `total_instalasi`, `total_differensial`, `margin01`, `margin02`, `margin03`, `margin04`, `margin05`, `margin06`, `margin07`, `margin08`, `margin09`, `margin10`, `margin11`, `margin12`, `sr01`, `sr02`, `sr03`, `sr04`, `sr05`, `sr06`, `sr07`, `sr08`, `sr09`, `sr10`, `sr11`, `sr12`, `se01`, `se02`, `se03`, `se04`, `se05`, `se06`, `se07`, `se08`, `se09`, `se10`, `se11`, `se12`, `si01`, `si02`, `si03`, `si04`, `si05`, `si06`, `si07`, `si08`, `si09`, `si10`, `si11`, `si12`, `sd01`, `sd02`, `sd03`, `sd04`, `sd05`, `sd06`, `sd07`, `sd08`, `sd09`, `sd10`, `sd11`, `sd12`, `sm01`, `sm02`, `sm03`, `sm04`, `sm05`, `sm06`, `sm07`, `sm08`, `sm09`, `sm10`, `sm11`, `sm12`, `stotal_revenue`, `stotal_expense`, `stotal_instalasi`, `stotal_differensial`) VALUES
(13, 192, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000, 10000000, 11000000, 12000000, 500000, 600000, 700000, 800000, 900000, 1000000, 1100000, 1200000, 1300000, 1400000, 1500000, 1600000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1100000, 1200000, 1300000, 1400000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1100000, 1200000, 78000000, 12600000, 10200000, 7800000, 100000, 900000, 2400000, 4600000, 7500000, 11100000, 15400000, 20400000, 26100000, 32500000, 39600000, 47400000, '1.000.000', '2.000.000', '3.000.000', '4.000.000', '5.000.000', '6.000.000', '7.000.000', '8.000.000', '9.000.000', '10.000.000', '11.000.000', '12.000.000', '500.000', '600.000', '700.000', '800.000', '900.000', '1.000.000', '1.100.000', '1.200.000', '1.300.000', '1.400.000', '1.500.000', '1.600.000', '300.000', '400.000', '500.000', '600.000', '700.000', '800.000', '900.000', '1.000.000', '1.100.000', '1.200.000', '1.300.000', '1.400.000', '100.000', '200.000', '300.000', '400.000', '500.000', '600.000', '700.000', '800.000', '900.000', '1.000.000', '1.100.000', '1.200.000', '100.000', '900.000', '2.400.000', '4.600.000', '7.500.000', '11.100.000', '15.400.000', '20.400.000', '26.100.000', '32.500.000', '39.600.000', '47.400.000', '78.000.000', '12.600.000', '10.200.000', '7.800.000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cashflow_kontrak`
--

CREATE TABLE `tb_cashflow_kontrak` (
  `id_cashflow_kontrak` int(11) NOT NULL,
  `id_kontrak` int(50) NOT NULL,
  `r01` bigint(50) NOT NULL,
  `r02` bigint(50) NOT NULL,
  `r03` bigint(50) NOT NULL,
  `r04` bigint(50) NOT NULL,
  `r05` bigint(50) NOT NULL,
  `r06` bigint(50) NOT NULL,
  `r07` bigint(50) NOT NULL,
  `r08` bigint(50) NOT NULL,
  `r09` bigint(50) NOT NULL,
  `r10` bigint(50) NOT NULL,
  `r11` bigint(50) NOT NULL,
  `r12` bigint(50) NOT NULL,
  `e01` bigint(50) NOT NULL,
  `e02` bigint(50) NOT NULL,
  `e03` bigint(50) NOT NULL,
  `e04` bigint(50) NOT NULL,
  `e05` bigint(50) NOT NULL,
  `e06` bigint(50) NOT NULL,
  `e07` bigint(50) NOT NULL,
  `e08` bigint(50) NOT NULL,
  `e09` bigint(50) NOT NULL,
  `e10` bigint(50) NOT NULL,
  `e11` bigint(50) NOT NULL,
  `e12` bigint(50) NOT NULL,
  `i01` bigint(50) NOT NULL,
  `i02` bigint(50) NOT NULL,
  `i03` bigint(50) NOT NULL,
  `i04` bigint(50) NOT NULL,
  `i05` bigint(50) NOT NULL,
  `i06` bigint(50) NOT NULL,
  `i07` bigint(50) NOT NULL,
  `i08` bigint(50) NOT NULL,
  `i09` bigint(50) NOT NULL,
  `i10` bigint(50) NOT NULL,
  `i11` bigint(50) NOT NULL,
  `i12` bigint(50) NOT NULL,
  `d01` bigint(50) NOT NULL,
  `d02` bigint(50) NOT NULL,
  `d03` bigint(50) NOT NULL,
  `d04` bigint(50) NOT NULL,
  `d05` bigint(50) NOT NULL,
  `d06` bigint(50) NOT NULL,
  `d07` bigint(50) NOT NULL,
  `d08` bigint(50) NOT NULL,
  `d09` bigint(50) NOT NULL,
  `d10` bigint(50) NOT NULL,
  `d11` bigint(50) NOT NULL,
  `d12` bigint(50) NOT NULL,
  `total_revenue` bigint(50) NOT NULL,
  `total_expense` bigint(50) NOT NULL,
  `total_instalasi` bigint(50) NOT NULL,
  `total_differensial` bigint(50) NOT NULL,
  `margin01` bigint(50) NOT NULL,
  `margin02` bigint(50) NOT NULL,
  `margin03` bigint(50) NOT NULL,
  `margin04` bigint(50) NOT NULL,
  `margin05` bigint(50) NOT NULL,
  `margin06` bigint(50) NOT NULL,
  `margin07` bigint(50) NOT NULL,
  `margin08` bigint(50) NOT NULL,
  `margin09` bigint(50) NOT NULL,
  `margin10` bigint(50) NOT NULL,
  `margin11` bigint(50) NOT NULL,
  `margin12` bigint(50) NOT NULL,
  `sr01` varchar(50) NOT NULL,
  `sr02` varchar(50) NOT NULL,
  `sr03` varchar(50) NOT NULL,
  `sr04` varchar(50) NOT NULL,
  `sr05` varchar(50) NOT NULL,
  `sr06` varchar(50) NOT NULL,
  `sr07` varchar(50) NOT NULL,
  `sr08` varchar(50) NOT NULL,
  `sr09` varchar(50) NOT NULL,
  `sr10` varchar(50) NOT NULL,
  `sr11` varchar(50) NOT NULL,
  `sr12` varchar(50) NOT NULL,
  `se01` varchar(50) NOT NULL,
  `se02` varchar(50) NOT NULL,
  `se03` varchar(50) NOT NULL,
  `se04` varchar(50) NOT NULL,
  `se05` varchar(50) NOT NULL,
  `se06` varchar(50) NOT NULL,
  `se07` varchar(50) NOT NULL,
  `se08` varchar(50) NOT NULL,
  `se09` varchar(50) NOT NULL,
  `se10` varchar(50) NOT NULL,
  `se11` varchar(50) NOT NULL,
  `se12` varchar(50) NOT NULL,
  `si01` varchar(50) NOT NULL,
  `si02` varchar(50) NOT NULL,
  `si03` varchar(50) NOT NULL,
  `si04` varchar(50) NOT NULL,
  `si05` varchar(50) NOT NULL,
  `si06` varchar(50) NOT NULL,
  `si07` varchar(50) NOT NULL,
  `si08` varchar(50) NOT NULL,
  `si09` varchar(50) NOT NULL,
  `si10` varchar(50) NOT NULL,
  `si11` varchar(50) NOT NULL,
  `si12` varchar(50) NOT NULL,
  `sd01` varchar(50) NOT NULL,
  `sd02` varchar(50) NOT NULL,
  `sd03` varchar(50) NOT NULL,
  `sd04` varchar(50) NOT NULL,
  `sd05` varchar(50) NOT NULL,
  `sd06` varchar(50) NOT NULL,
  `sd07` varchar(50) NOT NULL,
  `sd08` varchar(50) NOT NULL,
  `sd09` varchar(50) NOT NULL,
  `sd10` varchar(50) NOT NULL,
  `sd11` varchar(50) NOT NULL,
  `sd12` varchar(50) NOT NULL,
  `sm01` varchar(50) NOT NULL,
  `sm02` varchar(50) NOT NULL,
  `sm03` varchar(50) NOT NULL,
  `sm04` varchar(50) NOT NULL,
  `sm05` varchar(50) NOT NULL,
  `sm06` varchar(50) NOT NULL,
  `sm07` varchar(50) NOT NULL,
  `sm08` varchar(50) NOT NULL,
  `sm09` varchar(50) NOT NULL,
  `sm10` varchar(50) NOT NULL,
  `sm11` varchar(50) NOT NULL,
  `sm12` varchar(50) NOT NULL,
  `stotal_revenue` varchar(50) NOT NULL,
  `stotal_expense` varchar(50) NOT NULL,
  `stotal_instalasi` varchar(50) NOT NULL,
  `stotal_differensial` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cashflow_kontrak`
--

INSERT INTO `tb_cashflow_kontrak` (`id_cashflow_kontrak`, `id_kontrak`, `r01`, `r02`, `r03`, `r04`, `r05`, `r06`, `r07`, `r08`, `r09`, `r10`, `r11`, `r12`, `e01`, `e02`, `e03`, `e04`, `e05`, `e06`, `e07`, `e08`, `e09`, `e10`, `e11`, `e12`, `i01`, `i02`, `i03`, `i04`, `i05`, `i06`, `i07`, `i08`, `i09`, `i10`, `i11`, `i12`, `d01`, `d02`, `d03`, `d04`, `d05`, `d06`, `d07`, `d08`, `d09`, `d10`, `d11`, `d12`, `total_revenue`, `total_expense`, `total_instalasi`, `total_differensial`, `margin01`, `margin02`, `margin03`, `margin04`, `margin05`, `margin06`, `margin07`, `margin08`, `margin09`, `margin10`, `margin11`, `margin12`, `sr01`, `sr02`, `sr03`, `sr04`, `sr05`, `sr06`, `sr07`, `sr08`, `sr09`, `sr10`, `sr11`, `sr12`, `se01`, `se02`, `se03`, `se04`, `se05`, `se06`, `se07`, `se08`, `se09`, `se10`, `se11`, `se12`, `si01`, `si02`, `si03`, `si04`, `si05`, `si06`, `si07`, `si08`, `si09`, `si10`, `si11`, `si12`, `sd01`, `sd02`, `sd03`, `sd04`, `sd05`, `sd06`, `sd07`, `sd08`, `sd09`, `sd10`, `sd11`, `sd12`, `sm01`, `sm02`, `sm03`, `sm04`, `sm05`, `sm06`, `sm07`, `sm08`, `sm09`, `sm10`, `sm11`, `sm12`, `stotal_revenue`, `stotal_expense`, `stotal_instalasi`, `stotal_differensial`) VALUES
(19, 49, 1000000, 2000000, 3000000, 4000000, 5000000, 6000000, 7000000, 8000000, 9000000, 10000000, 11000000, 12000000, 700000, 800000, 900000, 1000000, 1100000, 1200000, 1300000, 1400000, 1500000, 1600000, 1700000, 1800000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000, 1000000, 1100000, 1200000, 1300000, 50000, 100000, 150000, 200000, 250000, 300000, 350000, 400000, 450000, 500000, 550000, 600000, 78000000, 15000000, 9000000, 3900000, 50000, 850000, 2400000, 4700000, 7750000, 11550000, 16100000, 21400000, 27450000, 34250000, 41800000, 50100000, '1.000.000', '2.000.000', '3.000.000', '4.000.000', '5.000.000', '6.000.000', '7.000.000', '8.000.000', '9.000.000', '10.000.000', '11.000.000', '12.000.000', '700.000', '800.000', '900.000', '1.000.000', '1.100.000', '1.200.000', '1.300.000', '1.400.000', '1.500.000', '1.600.000', '1.700.000', '1.800.000', '200.000', '300.000', '400.000', '500.000', '600.000', '700.000', '800.000', '900.000', '1.000.000', '1.100.000', '1.200.000', '1.300.000', '50.000', '100.000', '150.000', '200.000', '250.000', '300.000', '350.000', '400.000', '450.000', '500.000', '550.000', '600.000', '50.000', '850.000', '2.400.000', '4.700.000', '7.750.000', '11.550.000', '16.100.000', '21.400.000', '27.450.000', '34.250.000', '41.800.000', '50.100.000', '78.000.000', '15.000.000', '9.000.000', '3.900.000'),
(20, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kontrak`
--

CREATE TABLE `tb_kontrak` (
  `id_kontrak` int(11) NOT NULL,
  `sess_nama_kontrak` varchar(255) NOT NULL,
  `tgl_project_kontrak` date NOT NULL,
  `perusahaan_kontrak` varchar(255) NOT NULL,
  `kode_customer_kontrak` varchar(50) NOT NULL,
  `no_job_kontrak` varchar(50) NOT NULL,
  `nama_project_kontrak` varchar(255) NOT NULL,
  `nilai_project_kontrak` bigint(150) NOT NULL,
  `snilai_project_kontrak` varchar(150) NOT NULL,
  `peluang_kontrak` int(20) NOT NULL,
  `sales1_kontrak` varchar(255) NOT NULL,
  `sales2_kontrak` varchar(255) NOT NULL,
  `sales3_kontrak` varchar(255) NOT NULL,
  `sales4_kontrak` varchar(255) NOT NULL,
  `keterangan_kontrak` text NOT NULL,
  `alasan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kontrak`
--

INSERT INTO `tb_kontrak` (`id_kontrak`, `sess_nama_kontrak`, `tgl_project_kontrak`, `perusahaan_kontrak`, `kode_customer_kontrak`, `no_job_kontrak`, `nama_project_kontrak`, `nilai_project_kontrak`, `snilai_project_kontrak`, `peluang_kontrak`, `sales1_kontrak`, `sales2_kontrak`, `sales3_kontrak`, `sales4_kontrak`, `keterangan_kontrak`, `alasan`) VALUES
(49, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-001', 'Project Pemasangan Antena Radar Bea Cukai Cab. Jakarta Timur', 450000000, '450.000.000', 10, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 4 Bulan', 'Terjadi Perubahan Waktu Deadline'),
(50, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'KN-MITG-202008-002', 'Project Instalasi Radio', 300000000, '300.000.000', 10, 'bph', 'CSD', 'N/A', 'N/A', 'Deadline 2 Bulan', '');

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
(7, 'Donny Kurniawan', '2020-02-12', 'POJ-12022020-0223-0004', 'Ardi Handoko', '0812256898745', 'Ds. Sengon 3 no 45 rt/rw : 05/06 Salatiga', 'Putri Wijaya', '0812565421456', 'Ds. Amburadul 96 Blora', 0, 1),
(8, '', '2020-06-27', 'POJ-27062020-1313-0005', 'Muhammad Zahra', '085314531058', 'Jl. Letnan Arsyad 4', 'Maulvi Mirza Ahmad', '02188956509', 'Jl. Kranji', 1, 1);

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
-- Table structure for table `tb_project`
--

CREATE TABLE `tb_project` (
  `id_project` int(11) NOT NULL,
  `sess_nama` text NOT NULL,
  `tgl_project` date NOT NULL,
  `perusahaan` text NOT NULL,
  `kode_customer` text NOT NULL,
  `no_job` text NOT NULL,
  `nama_project` text NOT NULL,
  `nilai_project` bigint(50) NOT NULL,
  `snilai_project` varchar(50) NOT NULL,
  `peluang` int(11) NOT NULL,
  `sales1` text NOT NULL,
  `sales2` text NOT NULL,
  `sales3` text NOT NULL,
  `sales4` text NOT NULL,
  `keterangan` text NOT NULL,
  `alasan` text NOT NULL,
  `tgl_update` date NOT NULL,
  `username` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_project`
--

INSERT INTO `tb_project` (`id_project`, `sess_nama`, `tgl_project`, `perusahaan`, `kode_customer`, `no_job`, `nama_project`, `nilai_project`, `snilai_project`, `peluang`, `sales1`, `sales2`, `sales3`, `sales4`, `keterangan`, `alasan`, `tgl_update`, `username`, `status`) VALUES
(192, '', '2020-08-05', 'PGT', 'CUS-03082020-0001', 'MITG-202008-001', 'Project Pembuatan Aplikasi Sistem Monitoring Kapal Laut', 500000000, '500.000.000', 100, 'bph', 'CSD', 'otg', 'MZR', 'Deadline 6 Bulan', 'Clear', '2020-08-05', 'admin', 1);

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
(3, 'POJ-12022020-0223-0004', '2020-02-12', 4, 2000, 8000),
(4, 'POJ-27062020-1313-0005', '2020-06-27', 2, 7000, 14000);

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
-- Indexes for table `log_kontrak`
--
ALTER TABLE `log_kontrak`
  ADD PRIMARY KEY (`id_log_kontrak`);

--
-- Indexes for table `log_project`
--
ALTER TABLE `log_project`
  ADD PRIMARY KEY (`id_log`);

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
-- Indexes for table `mst_company`
--
ALTER TABLE `mst_company`
  ADD PRIMARY KEY (`id_comp`);

--
-- Indexes for table `mst_customer`
--
ALTER TABLE `mst_customer`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `mst_project`
--
ALTER TABLE `mst_project`
  ADD PRIMARY KEY (`id_project`);

--
-- Indexes for table `mst_sales`
--
ALTER TABLE `mst_sales`
  ADD PRIMARY KEY (`id_sales`);

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
-- Indexes for table `tb_cashflow`
--
ALTER TABLE `tb_cashflow`
  ADD PRIMARY KEY (`id_cashflow`);

--
-- Indexes for table `tb_cashflow_kontrak`
--
ALTER TABLE `tb_cashflow_kontrak`
  ADD PRIMARY KEY (`id_cashflow_kontrak`);

--
-- Indexes for table `tb_kontrak`
--
ALTER TABLE `tb_kontrak`
  ADD PRIMARY KEY (`id_kontrak`);

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
-- Indexes for table `tb_project`
--
ALTER TABLE `tb_project`
  ADD PRIMARY KEY (`id_project`);

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
-- AUTO_INCREMENT for table `log_kontrak`
--
ALTER TABLE `log_kontrak`
  MODIFY `id_log_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=280;

--
-- AUTO_INCREMENT for table `log_project`
--
ALTER TABLE `log_project`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

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
-- AUTO_INCREMENT for table `mst_company`
--
ALTER TABLE `mst_company`
  MODIFY `id_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mst_customer`
--
ALTER TABLE `mst_customer`
  MODIFY `id_cust` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mst_kendaraan`
--
ALTER TABLE `mst_kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mst_project`
--
ALTER TABLE `mst_project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mst_sales`
--
ALTER TABLE `mst_sales`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_cashflow`
--
ALTER TABLE `tb_cashflow`
  MODIFY `id_cashflow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_cashflow_kontrak`
--
ALTER TABLE `tb_cashflow_kontrak`
  MODIFY `id_cashflow_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_kontrak`
--
ALTER TABLE `tb_kontrak`
  MODIFY `id_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `tb_project`
--
ALTER TABLE `tb_project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `transaksi_jarak`
--
ALTER TABLE `transaksi_jarak`
  MODIFY `id_transaksi_jarak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi_volume`
--
ALTER TABLE `transaksi_volume`
  MODIFY `id_transaksi_volume` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
