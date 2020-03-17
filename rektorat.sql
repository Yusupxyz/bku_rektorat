-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2019 at 11:53 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rektorat`
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
(1, 1),
(2, 1),
(3, 1),
(1, 3),
(2, 3),
(3, 3),
(1, 40),
(1, 90),
(2, 90),
(3, 90),
(1, 9),
(2, 9),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(4) NOT NULL,
  `kode_kegiatan` varchar(20) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `volume` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jumlah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kode_kegiatan`, `nama_kegiatan`, `volume`, `satuan`, `jumlah`) VALUES
(1, '042.01.01', 'Program Dukungan Manajemen dan Pelaksanaan Tugas Teknis Lainnya Kementerian Riset, Teknologi dan Pendidikan Tinggi', '-', '-', '1272025000'),
(2, '5742', 'Peningkatan Layanan Tridharma Perguruan Tinggi', '-', '-', '1272025000');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_sub`
--

CREATE TABLE `kegiatan_sub` (
  `id_kegiatan_1` int(5) NOT NULL,
  `id_kegiatan` int(5) NOT NULL,
  `kode_kegiatan` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `volume` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_sub`
--

INSERT INTO `kegiatan_sub` (`id_kegiatan_1`, `id_kegiatan`, `kode_kegiatan`, `nama_kegiatan`, `volume`, `satuan`, `jumlah`) VALUES
(1, 1, 'micel', 'anak', '', '', ''),
(3, 2, '5742.001', 'Layanan Pendidikan [Base Line]', '14300', 'Mahasiswa', '749475000');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_sub_1`
--

CREATE TABLE `kegiatan_sub_1` (
  `id_kegiatan_2` int(5) NOT NULL,
  `id_kegiatan_1` int(5) NOT NULL,
  `kode_kegiatan` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `volume` varchar(30) NOT NULL,
  `satuan` varchar(30) NOT NULL,
  `jumlah` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan_sub_1`
--

INSERT INTO `kegiatan_sub_1` (`id_kegiatan_2`, `id_kegiatan_1`, `kode_kegiatan`, `nama_kegiatan`, `volume`, `satuan`, `jumlah`) VALUES
(1, 3, '5742.001.002', 'Layanan Pendidikan Program Sarjana', '-', '-', '749475000');

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
(6, '::1', 'administrator', 1561781326),
(7, '::1', 'administrator', 1561826111),
(10, '::1', 'adeade', 1561843673);

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
(1, 0, 1, 0, 'empty', 'MAIN NAVIGATION', '#', '#', 1),
(3, 1, 2, 1, 'fas fa-tachometer-alt', 'Dashboard', 'dashboard', '#', 1),
(4, 7, 2, 40, 'fas fa-table', 'CRUD Generator', 'crudbuilder', '1', 1),
(8, 5, 2, 40, 'fas fa-bars', 'Menu', 'cms/menu/side-menu', 'navMenu', 1),
(9, 3, 2, 90, 'fab fa-galactic-republic', 'Kegiatan', 'kegiatan', '1', 1),
(40, 4, 1, 0, 'empty', 'SETTING', '#', '#', 1),
(42, 8, 2, 40, 'fas fa-users-cog', 'User', '#', '1', 1),
(43, 9, 3, 42, 'fas fa-angle-double-right', 'Users', 'users', '1', 1),
(44, 10, 3, 42, 'fas fa-angle-double-right', 'Groups', 'groups', '2', 1),
(89, 6, 2, 40, 'fas fa-th-list', 'Menu Type', 'menu_type', 'menu_type', 1),
(90, 2, 1, 0, 'empty', 'UTAMA', '#', '#', 1);

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'WcHCQ5vcXwT1z99BvJUWnu', 1268889823, 1561845194, 1, 'Admin', 'istrator', 'ADMIN', '0'),
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
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `kegiatan_sub`
--
ALTER TABLE `kegiatan_sub`
  ADD PRIMARY KEY (`id_kegiatan_1`),
  ADD KEY `id_kategori` (`id_kegiatan`);

--
-- Indexes for table `kegiatan_sub_1`
--
ALTER TABLE `kegiatan_sub_1`
  ADD PRIMARY KEY (`id_kegiatan_2`),
  ADD KEY `id_kegiatan_1` (`id_kegiatan_1`);

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
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatan_sub`
--
ALTER TABLE `kegiatan_sub`
  MODIFY `id_kegiatan_1` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kegiatan_sub_1`
--
ALTER TABLE `kegiatan_sub_1`
  MODIFY `id_kegiatan_2` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `kegiatan_sub`
--
ALTER TABLE `kegiatan_sub`
  ADD CONSTRAINT `kegiatan_sub_ibfk_1` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatan` (`id_kegiatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kegiatan_sub_1`
--
ALTER TABLE `kegiatan_sub_1`
  ADD CONSTRAINT `kegiatan_sub_1_ibfk_1` FOREIGN KEY (`id_kegiatan_1`) REFERENCES `kegiatan_sub` (`id_kegiatan_1`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
