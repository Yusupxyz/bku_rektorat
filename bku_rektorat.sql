-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 05, 2020 at 01:10 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bku_rektorat`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User'),
(3, 'Dekan', 'Dekan Fakultas Universitas Palangka Raya');

-- --------------------------------------------------------

--
-- Table structure for table `groups_menu`
--

CREATE TABLE `groups_menu` (
  `id_groups` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_menu`
--

INSERT INTO `groups_menu` (`id_groups`, `id_menu`) VALUES
(1, 8),
(1, 89),
(1, 4),
(1, 42),
(1, 43),
(1, 44),
(1, 3),
(2, 3),
(3, 3),
(1, 9),
(2, 9),
(3, 9),
(1, 93),
(1, 94),
(1, 95),
(1, 91),
(1, 1),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(0, 40);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(1, '::1', 'admin', 1604479292),
(2, '::1', 'admin', 1604479300),
(3, '::1', 'admin', 1604479304);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '99',
  `level` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(125) NOT NULL,
  `label` varchar(25) NOT NULL,
  `link` varchar(125) NOT NULL,
  `id` varchar(25) NOT NULL DEFAULT '#',
  `id_menu_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `sort`, `level`, `parent_id`, `icon`, `label`, `link`, `id`, `id_menu_type`) VALUES
(1, 0, 1, 0, 'empty', 'Utama', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 15, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 13, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 12, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 16, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 17, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 18, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 14, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(91, 10, 2, 92, 'far fa-calendar-times', 'Bulan', 'bulan', '12', 1),
(92, 5, 1, 0, 'empty', 'DATA MASTER', '#', '#', 1),
(93, 11, 2, 92, 'fas fa-calendar-times', 'Tahun', 'tahun', '13', 1),
(94, 8, 2, 92, 'fab fa-monero', 'Jenis Pembayaran', 'jenis_pembayaran', '14', 1),
(95, 9, 2, 92, 'fab fa-asymmetrik', 'Metode Pembayaran', 'metode_pembayaran', '15', 1),
(99, 2, 2, 1, 'fas fa-file-contract', 'Kontrol Transaksi', 'transaksi', '#', 1),
(100, 6, 2, 92, 'fas fa-book-reader', 'Pejabat', 'pejabat', '13', 1),
(101, 3, 2, 1, 'fas fa-book-open', 'Buku', 'buku', '#', 1),
(102, 7, 2, 92, 'fas fa-mouse-pointer', 'Atur Laporan', 'setting_laporan', '#', 1),
(103, 4, 2, 1, 'fas fa-download', 'Unduh Excel', 'unduh', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_type`
--

CREATE TABLE `menu_type` (
  `id_menu_type` int(11) NOT NULL,
  `type` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_type`
--

INSERT INTO `menu_type` (`id_menu_type`, `type`) VALUES
(1, 'Side menu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bulan`
--

CREATE TABLE `tbl_bulan` (
  `bulan_id` int(11) NOT NULL,
  `bulan_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bulan`
--

INSERT INTO `tbl_bulan` (`bulan_id`, `bulan_nama`) VALUES
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'Nopember'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_pembayaran`
--

CREATE TABLE `tbl_jenis_pembayaran` (
  `jp_id` int(11) NOT NULL,
  `jp_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jenis_pembayaran`
--

INSERT INTO `tbl_jenis_pembayaran` (`jp_id`, `jp_nama`) VALUES
(1, 'Bank'),
(2, 'Tunai'),
(3, 'Transfer BP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_metode_pembayaran`
--

CREATE TABLE `tbl_metode_pembayaran` (
  `mp_id` int(11) NOT NULL,
  `mp_nama` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_metode_pembayaran`
--

INSERT INTO `tbl_metode_pembayaran` (`mp_id`, `mp_nama`) VALUES
(1, 'GU'),
(2, 'LS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pejabat`
--

CREATE TABLE `tbl_pejabat` (
  `pejabat_id` int(11) NOT NULL,
  `pejabat_nama` varchar(100) NOT NULL,
  `pejabat_jabatan` varchar(100) NOT NULL,
  `pejabat_nip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pejabat`
--

INSERT INTO `tbl_pejabat` (`pejabat_id`, `pejabat_nama`, `pejabat_jabatan`, `pejabat_nip`) VALUES
(1, 'ANGELINA SOFYA FRISCILA, ST.', 'PNBP Belanja Non Modal', '198909052014042001'),
(2, 'YOANDITA CHRISTI, S.E., M.Sc.', 'BPP PNBP', '198606182014042001');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saldo_akhir`
--

CREATE TABLE `tbl_saldo_akhir` (
  `sak_id` int(11) NOT NULL,
  `sak_jumlah` double NOT NULL,
  `sak_id_bulan` int(11) NOT NULL,
  `sak_id_tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_saldo_akhir`
--

INSERT INTO `tbl_saldo_akhir` (`sak_id`, `sak_jumlah`, `sak_id_bulan`, `sak_id_tahun`) VALUES
(37, 5000000, 1, 10),
(38, 0, 2, 10),
(39, 0, 3, 10),
(40, 0, 4, 10),
(41, 0, 5, 10),
(42, 0, 6, 10),
(43, 0, 7, 10),
(44, 0, 8, 10),
(45, 0, 9, 10),
(46, 0, 10, 10),
(47, 0, 11, 10),
(48, 0, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saldo_awal`
--

CREATE TABLE `tbl_saldo_awal` (
  `sa_id` int(11) NOT NULL,
  `sa_jumlah` double NOT NULL,
  `sa_id_bulan` int(11) NOT NULL,
  `sa_id_tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_saldo_awal`
--

INSERT INTO `tbl_saldo_awal` (`sa_id`, `sa_jumlah`, `sa_id_bulan`, `sa_id_tahun`) VALUES
(50, 5000000, 1, 10),
(51, 0, 2, 10),
(52, 5000000, 3, 10),
(53, 0, 4, 10),
(54, 0, 5, 10),
(55, 0, 6, 10),
(56, 0, 7, 10),
(57, 0, 8, 10),
(58, 0, 9, 10),
(59, 0, 10, 10),
(60, 0, 11, 10),
(61, 0, 12, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting_laporan`
--

CREATE TABLE `tbl_setting_laporan` (
  `sl_id` int(11) NOT NULL,
  `sl_setting` varchar(100) NOT NULL,
  `sl_data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setting_laporan`
--

INSERT INTO `tbl_setting_laporan` (`sl_id`, `sl_setting`, `sl_data`) VALUES
(1, 'KEMENTERIAN/LEMBAGA', 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN'),
(2, 'UNIT ORGANISASI', 'SEKRETARIAT JENDERAL'),
(3, 'SATUAN KERJA', 'PNBP NON-MODAL UNIVERSITAS PALANGKA RAYA'),
(4, 'ALAMAT', 'JL. YOS SUDARSO PALANGKA RAYA'),
(5, 'TANGGAL DAN NOMOR DIPA', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tahun`
--

CREATE TABLE `tbl_tahun` (
  `tahun_id` int(11) NOT NULL,
  `tahun_nama` int(11) NOT NULL,
  `tahun_status` enum('1','0') NOT NULL COMMENT '1=aktif, 0=tidak aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tahun`
--

INSERT INTO `tbl_tahun` (`tahun_id`, `tahun_nama`, `tahun_status`) VALUES
(10, 2020, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `trx_id` int(11) NOT NULL,
  `trx_nomor_bukti` varchar(100) NOT NULL,
  `trx_mak` varchar(100) NOT NULL,
  `trx_uraian` varchar(500) NOT NULL,
  `trx_jml_kotor` double NOT NULL,
  `trx_ppn` double NOT NULL,
  `trx_pph_21` double NOT NULL,
  `trx_pph_22` double NOT NULL,
  `trx_pph_23` double NOT NULL,
  `trx_pph_4_2` double NOT NULL,
  `trx_jml_bersih` double NOT NULL,
  `trx_tanggal` date NOT NULL,
  `trx_id_jenis_pembayaran` int(11) NOT NULL,
  `trx_id_metode_pembayaran` int(11) NOT NULL,
  `trx_id_unit` varchar(300) NOT NULL,
  `trx_jenis` enum('0','1') NOT NULL,
  `trx_penerimaan` double NOT NULL,
  `trx_pengeluaran` double NOT NULL,
  `trx_id_tahun` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`trx_id`, `trx_nomor_bukti`, `trx_mak`, `trx_uraian`, `trx_jml_kotor`, `trx_ppn`, `trx_pph_21`, `trx_pph_22`, `trx_pph_23`, `trx_pph_4_2`, `trx_jml_bersih`, `trx_tanggal`, `trx_id_jenis_pembayaran`, `trx_id_metode_pembayaran`, `trx_id_unit`, `trx_jenis`, `trx_penerimaan`, `trx_pengeluaran`, `trx_id_tahun`) VALUES
(9, '200431304005195', '', 'Penyediaan Uang Persediaan PNBP Satker UNIVERSITAS PALANGKARAYA Tahun 2020 Sesuai SPP Nomor 00224 Tanggal 18 Maret 2020', 0, 0, 1, 0, 0, 0, 0, '2020-07-07', 1, 2, 'PNBP', '0', 500000000, 0, 10),
(11, '200431304005152', '4257.015.054.A.521115', 'Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Januari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00227 Tangg', 0, 0, 0, 0, 0, 0, 0, '2020-07-06', 1, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '0', 424291998, 0, 10),
(13, '200431304005745', '4257.015.054.A.521115', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Rapat Koordinasi Nasional (Rakornas) Kemenristek/ Badan Riset dan Inovasi Nasional Tahun 2020 (Rakornas RISTEK/BRIN 2020), sesuai dengan surat', 6478656, 0, 0, 0, 0, 0, 6478656, '2020-07-22', 2, 2, 'Estiani Isa Leluni, SH', '0', 0, 6478656, 10),
(14, '200431304005745', '4257.015.054.A.521115', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Rapat Koordinasi Nasional (Rakornas) Kemenristek/ Badan Riset dan Inovasi Nasional Tahun 2020 (Rakornas RISTEK/BRIN 2020), sesuai dengan surat', 6478656, 0, 0, 0, 0, 0, 6478656, '2020-07-22', 2, 2, 'Estiani Isa Leluni, SH', '0', 0, 6478656, 10),
(15, '200431304005745', '4257.015.054.A.521115', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Rapat Koordinasi Nasional (Rakornas) Kemenristek/ Badan Riset dan Inovasi Nasional Tahun 2020 (Rakornas RISTEK/BRIN 2020), sesuai dengan surat', 6478656, 0, 0, 0, 0, 0, 6478656, '2020-07-22', 2, 2, 'Estiani Isa Leluni, SH', '0', 0, 6478656, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_unit`
--

CREATE TABLE `tbl_transaksi_unit` (
  `trxu_id` int(11) NOT NULL,
  `trxu_nomor_bukti` int(3) NOT NULL,
  `trxu_mak` varchar(100) NOT NULL,
  `trxu_uraian` varchar(500) NOT NULL,
  `trxu_jml_kotor` double NOT NULL,
  `trxu_ppn` double NOT NULL,
  `trxu_pph_21` double NOT NULL,
  `trxu_pph_22` double NOT NULL,
  `trxu_pph_23` double NOT NULL,
  `trxu_pph_4_2` double NOT NULL,
  `trxu_jml_bersih` double NOT NULL,
  `trxu_tanggal` date NOT NULL,
  `trxu_id_jenis_pembayaran` int(11) NOT NULL,
  `trxu_id_metode_pembayaran` int(11) NOT NULL,
  `trxu_id_unit` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_unit`
--

INSERT INTO `tbl_transaksi_unit` (`trxu_id`, `trxu_nomor_bukti`, `trxu_mak`, `trxu_uraian`, `trxu_jml_kotor`, `trxu_ppn`, `trxu_pph_21`, `trxu_pph_22`, `trxu_pph_23`, `trxu_pph_4_2`, `trxu_jml_bersih`, `trxu_tanggal`, `trxu_id_jenis_pembayaran`, `trxu_id_metode_pembayaran`, `trxu_id_unit`) VALUES
(2, 13, 'xxxx', 'assasa', 1000000, 0, 0, 0, 0, 0, 1000000, '2020-07-23', 2, 2, 'BPP FISIP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'WcHCQ5vcXwT1z99BvJUWnu', 1268889823, 1604534953, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '127.0.0.1', 'member', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'lHtbqmxsnla1izZ5LcXd9O', 1268889823, 1561843839, 1, 'Operator', 'Apps', 'Prodi', '0'),
(3, '127.0.0.1', 'adeade', '$2y$08$qbEiq9GhlaB8My8TdJXLPuXKxleROxxQGsCArdMBPfa4gabaja3Xm', 'adeade', 'ade.chandra.saputra.tumbai@gmail.com', NULL, 'ads', 0, 'ad', 0, 1561844915, 1, 'ad', 'e', 'adecs', '12424');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(3, 1, 1),
(26, 2, 2),
(27, 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `menu_type`
--
ALTER TABLE `menu_type`
  ADD PRIMARY KEY (`id_menu_type`);

--
-- Indexes for table `tbl_bulan`
--
ALTER TABLE `tbl_bulan`
  ADD PRIMARY KEY (`bulan_id`);

--
-- Indexes for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  ADD PRIMARY KEY (`jp_id`);

--
-- Indexes for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  ADD PRIMARY KEY (`mp_id`);

--
-- Indexes for table `tbl_pejabat`
--
ALTER TABLE `tbl_pejabat`
  ADD PRIMARY KEY (`pejabat_id`);

--
-- Indexes for table `tbl_saldo_akhir`
--
ALTER TABLE `tbl_saldo_akhir`
  ADD PRIMARY KEY (`sak_id`);

--
-- Indexes for table `tbl_saldo_awal`
--
ALTER TABLE `tbl_saldo_awal`
  ADD PRIMARY KEY (`sa_id`);

--
-- Indexes for table `tbl_setting_laporan`
--
ALTER TABLE `tbl_setting_laporan`
  ADD PRIMARY KEY (`sl_id`);

--
-- Indexes for table `tbl_tahun`
--
ALTER TABLE `tbl_tahun`
  ADD PRIMARY KEY (`tahun_id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`trx_id`),
  ADD KEY `trx_id_jenis_pembayaran` (`trx_id_jenis_pembayaran`),
  ADD KEY `trx_id_metode_pembayaran` (`trx_id_metode_pembayaran`),
  ADD KEY `trx_id_tahun` (`trx_id_tahun`);

--
-- Indexes for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  ADD PRIMARY KEY (`trxu_id`),
  ADD KEY `trx_id_metode_pembayaran` (`trxu_id_metode_pembayaran`),
  ADD KEY `trxu_id_jenis_pembayaran` (`trxu_id_jenis_pembayaran`),
  ADD KEY `trxu_nomor_bukti` (`trxu_nomor_bukti`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_bulan`
--
ALTER TABLE `tbl_bulan`
  MODIFY `bulan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_jenis_pembayaran`
--
ALTER TABLE `tbl_jenis_pembayaran`
  MODIFY `jp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pejabat`
--
ALTER TABLE `tbl_pejabat`
  MODIFY `pejabat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_saldo_akhir`
--
ALTER TABLE `tbl_saldo_akhir`
  MODIFY `sak_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_saldo_awal`
--
ALTER TABLE `tbl_saldo_awal`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_setting_laporan`
--
ALTER TABLE `tbl_setting_laporan`
  MODIFY `sl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_tahun`
--
ALTER TABLE `tbl_tahun`
  MODIFY `tahun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  MODIFY `trxu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_2` FOREIGN KEY (`trx_id_jenis_pembayaran`) REFERENCES `tbl_jenis_pembayaran` (`jp_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_3` FOREIGN KEY (`trx_id_metode_pembayaran`) REFERENCES `tbl_metode_pembayaran` (`mp_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_4` FOREIGN KEY (`trx_id_tahun`) REFERENCES `tbl_tahun` (`tahun_id`);

--
-- Constraints for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  ADD CONSTRAINT `tbl_transaksi_unit_ibfk_1` FOREIGN KEY (`trxu_id_jenis_pembayaran`) REFERENCES `tbl_jenis_pembayaran` (`jp_id`),
  ADD CONSTRAINT `tbl_transaksi_unit_ibfk_2` FOREIGN KEY (`trxu_id_metode_pembayaran`) REFERENCES `tbl_metode_pembayaran` (`mp_id`),
  ADD CONSTRAINT `tbl_transaksi_unit_ibfk_3` FOREIGN KEY (`trxu_nomor_bukti`) REFERENCES `tbl_transaksi` (`trx_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
