-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Mar 21, 2020 at 02:27 PM
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
(1, 40),
(1, 9),
(2, 9),
(3, 9),
(1, 93),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 91),
(1, 1),
(1, 99),
(1, 100),
(1, 101),
(1, 102);

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
(4, 14, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 12, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(40, 11, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 15, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 16, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 17, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 13, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(91, 8, 2, 92, 'far fa-calendar-times', 'Bulan', 'bulan', '12', 1),
(92, 3, 1, 0, 'empty', 'DATA MASTER', '#', '#', 1),
(93, 9, 2, 92, 'fas fa-calendar-times', 'Tahun', 'tahun', '13', 1),
(94, 4, 2, 92, 'fab fa-monero', 'Jenis Pembayaran', 'jenis_pembayaran', '14', 1),
(95, 5, 2, 92, 'fab fa-asymmetrik', 'Metode Pembayaran', 'metode_pembayaran', '15', 1),
(96, 10, 2, 92, 'fab fa-mizuni', 'Unit', 'unit', '15', 1),
(97, 6, 2, 92, 'fas fa-money-bill-wave', 'Saldo Awal', 'saldo_awal', '16', 1),
(98, 7, 2, 92, 'fas fa-money-bill-wave', 'Saldo Akhir', 'saldo_akhir', '17', 1),
(99, 1, 2, 1, 'fas fa-file-contract', 'Kontrol Transaksi', 'transaksi', '#', 1),
(100, 1, 2, 92, 'fas fa-book-reader', 'Pejabat', 'pejabat', '13', 1),
(101, 4, 2, 1, 'fas fa-book-open', 'Buku', 'buku', '#', 1),
(102, 1, 2, 92, 'fas fa-mouse-pointer', 'Atur Laporan', 'setting_laporan', '#', 1);

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
(1, 'Januari'),
(2, 'Februari'),
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
(2, 'Tunai');

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
-- Table structure for table `tbl_nomor_bukti`
--

CREATE TABLE `tbl_nomor_bukti` (
  `nb_id` int(11) NOT NULL,
  `nb_no` varchar(100) NOT NULL,
  `nb_tanggal` date NOT NULL,
  `uraian` text NOT NULL,
  `tbl_pengeluaran` double NOT NULL,
  `nb_id_tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_nomor_bukti`
--

INSERT INTO `tbl_nomor_bukti` (`nb_id`, `nb_no`, `nb_tanggal`, `uraian`, `tbl_pengeluaran`, `nb_id_tahun`) VALUES
(4, '0000/PNBP Non Modal-UPR/2020', '2020-03-19', 'Bayar ke BPP BUK', 0, 10);

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
  `trx_id_nomor_bukti` int(11) NOT NULL,
  `trx_mak` varchar(100) NOT NULL,
  `trx_penerima` varchar(100) NOT NULL,
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
  `trx_id_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`trx_id`, `trx_id_nomor_bukti`, `trx_mak`, `trx_penerima`, `trx_uraian`, `trx_jml_kotor`, `trx_ppn`, `trx_pph_21`, `trx_pph_22`, `trx_pph_23`, `trx_pph_4_2`, `trx_jml_bersih`, `trx_tanggal`, `trx_id_jenis_pembayaran`, `trx_id_metode_pembayaran`, `trx_id_unit`) VALUES
(4, 4, '5742.994.051.H.521111', '-', 'ATK dan bahan habis pakai, penggandaan, penjilidan, pencetakan, dokumentasi Operasional Rapat Senat Tertutup Universitas Palangka Raya (tgl. 23 Januari 2020)', 2000000, 181818, 0, 0, 0, 0, 1818182, '2020-03-20', 1, 1, 0),
(5, 4, '5742.994.051.H.521111', '-', 'Konsumsi makan rapat senat  [50 ORG x Rp. 40.000 x 1 KEG]', 2000000, 0, 0, 0, 3636, 0, 1996364, '2020-03-21', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `nama`, `deskripsi`) VALUES
(0, 'A', 'Rektorat'),
(15, 'E', 'Fakultas Pertanian'),
(16, 'D', 'Fakultas Ekonomi'),
(17, 'H', 'Fakultas Hukum'),
(18, 'I', 'Fakultas Ilmu Sosial dan Ilmu Politik'),
(19, 'J', 'Fakultas Kedokteran'),
(20, 'C', 'Fakultas Keguruan dan Ilmu Pendidikan'),
(21, 'L', 'Fakultas Matematikan dan Ilmu Pengetahuan Alam'),
(22, 'F', 'Fakultas Teknik'),
(23, 'K', 'Program Pasca Sarjana'),
(24, 'T', 'LAB ALAM'),
(25, 'V', 'UPT Bahasa'),
(26, 'S', 'LAB TERPADU'),
(27, 'Q', 'UPT Laboratorium Lahan Gambut'),
(28, 'N', 'LP3MP'),
(29, 'M', 'LPPM'),
(30, 'Y', 'UPT Perpustakaan'),
(31, 'R', 'UPT TIK');

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'WcHCQ5vcXwT1z99BvJUWnu', 1268889823, 1584790988, 1, 'Admin', 'istrator', 'ADMIN', '0'),
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
-- Indexes for table `tbl_nomor_bukti`
--
ALTER TABLE `tbl_nomor_bukti`
  ADD PRIMARY KEY (`nb_id`);

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
  ADD KEY `trx_id_nomor_bukti` (`trx_id_nomor_bukti`),
  ADD KEY `trx_id_jenis_pembayaran` (`trx_id_jenis_pembayaran`),
  ADD KEY `trx_id_metode_pembayaran` (`trx_id_metode_pembayaran`),
  ADD KEY `trx_id_unit` (`trx_id_unit`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

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
  MODIFY `jp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_metode_pembayaran`
--
ALTER TABLE `tbl_metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_nomor_bukti`
--
ALTER TABLE `tbl_nomor_bukti`
  MODIFY `nb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`trx_id_nomor_bukti`) REFERENCES `tbl_nomor_bukti` (`nb_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_2` FOREIGN KEY (`trx_id_jenis_pembayaran`) REFERENCES `tbl_jenis_pembayaran` (`jp_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_3` FOREIGN KEY (`trx_id_metode_pembayaran`) REFERENCES `tbl_metode_pembayaran` (`mp_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_4` FOREIGN KEY (`trx_id_unit`) REFERENCES `unit` (`id_unit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
