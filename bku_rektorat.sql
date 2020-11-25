-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 25, 2020 at 07:17 AM
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
(1, 40),
(1, 104),
(1, 105);

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
(103, 4, 2, 1, 'fas fa-download', 'Unduh Excel', 'unduh', '1', 1),
(104, 1, 2, 92, 'fas fa-archive', 'Unit', 'unit', '1', 1),
(105, 1, 2, 92, 'fas fa-arrows-alt', 'Kategori Pajak', 'pajak', '1', 1);

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
-- Table structure for table `pajak`
--

CREATE TABLE `pajak` (
  `id` int(11) NOT NULL,
  `jenis` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pajak`
--

INSERT INTO `pajak` (`id`, `jenis`) VALUES
(0, '-'),
(1, 'Setor'),
(2, 'Pungut');

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
(3, 'Transfer langsung');

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
  `trx_id_tahun` int(3) NOT NULL,
  `trx_fk_unit` int(11) NOT NULL,
  `trx_id_pajak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`trx_id`, `trx_nomor_bukti`, `trx_mak`, `trx_uraian`, `trx_jml_kotor`, `trx_ppn`, `trx_pph_21`, `trx_pph_22`, `trx_pph_23`, `trx_pph_4_2`, `trx_jml_bersih`, `trx_tanggal`, `trx_id_jenis_pembayaran`, `trx_id_metode_pembayaran`, `trx_id_unit`, `trx_jenis`, `trx_penerimaan`, `trx_pengeluaran`, `trx_id_tahun`, `trx_fk_unit`, `trx_id_pajak`) VALUES
(223, '200431304005152', '4257.015.054.A.521115', 'Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Januari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00227', 0, 0, 0, 0, 0, 0, 0, '2020-03-18', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '0', 424292000, 0, 10, 0, 0),
(224, '200431304005152x', '4257.015.054.A.521115', 'Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Januari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00227', 424292000, 2, 0, 0, 0, 0, 424291998, '2020-03-18', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 0, 424292000, 10, 0, 0),
(225, '200431304005153', '4257.015.054.A.521115', 'Honorarium - Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Februari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00228', 0, 0, 0, 0, 0, 0, 0, '2020-03-18', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '0', 432667000, 0, 10, 0, 0),
(226, '200431304005153x', '4257.015.054.A.521115', 'Honorarium - Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Februari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00228', 432667000, 0, 0, 0, 0, 0, 432667000, '2020-03-18', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 0, 432667000, 10, 0, 0),
(227, '200431304005195', '', 'Uang Persediaan', 0, 0, 0, 0, 0, 0, 0, '2020-11-23', 1, 1, 'BPP PNBP', '0', 500000000, 0, 10, 0, 0),
(228, '200431304005196', '', 'Kas - LS perjalanan dinas (No. Cek : CGJ495326)', 0, 0, 0, 0, 0, 0, 0, '2020-03-23', 1, 2, 'BPP PNBP', '0', 261541498, 0, 10, 0, 0),
(229, '0001/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Daftar Ulang Calon Peserta PPRA LX TA 2020 Lemhanas dari Unsur ASN, sesuai dengan surat tugas No. 2/UN24/KP/2020, tgl. 2 Januari 2020', 2841802, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Prof. Dr. I Nyoman Sudyana, M.Sc', '1', 0, 2841802, 10, 0, 0),
(230, '0002/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rapat Koordinasi Persiapan Pelaksanaan Latihan Dasar CPNS TA. 2020, sesuai dengan surat tugas No. 26/UN24/KP/2020, tgl. 22 Januari 2020', 600000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dra. Ruli Meiliawati, M.Pd.', '1', 0, 600000, 10, 0, 0),
(231, '0003/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rapat Koordinasi Persiapan Pelaksanaan Latihan Dasar CPNS TA. 2020, sesuai dengan surat tugas No. 26/UN24/KP/2020, tgl. 22 Januari 2020', 600000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi, S.E., M.Si', '1', 0, 600000, 10, 0, 0),
(232, '0004/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Rapat Koordinasi Pembinaan Pengadaan Barang dan Jasa di Lingkungan Kementerian Pendidikan dan Kebudayaan, sesuai dengan surat tugas No. 49/UN24/KP/2020, tgl. 3 Februari 2020', 3174594, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, S.T.', '1', 0, 3174594, 10, 0, 0),
(233, '0005/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Acara &#34;Forum Koordinasi BPK dan Pengawas Internal dalam rangka Mewujudkan Transparansi dan Akuntabilitas Keuangan Negara di Lingkungan PTN dan PTNBH, sesuai dengan surat tugas No. 3/UN24/KP/2020, tgl. 6 Januari 2020', 4959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Riamona Sadelman Tulis', '1', 0, 4959400, 10, 0, 0),
(234, '0006/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Acara &#34;Forum Koordinasi BPK dan Pengawas Internal dalam rangka Mewujudkan Transparansi dan Akuntabilitas Keuangan Negara di Lingkungan PTN dan PTNBH, sesuai dengan surat tugas No. 3/UN24/KP/2020, tgl. 6 Januari 2020', 4959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Yanetri Asi, SP., M.Si., Ph.D', '1', 0, 4959400, 10, 0, 0),
(235, '0007/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan Konsultasi Pembentukan UkpBJ/ULP UPR Kemendikbud, sesuai dengan surat tugas No. 8/UN24/KP/2020, tgl. 8 Januari 2020', 6096100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '1', 0, 6096100, 10, 0, 0),
(236, '0008/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan Konsultasi Pembentukan UkpBJ/ULP UPR Kemendikbud, sesuai dengan surat tugas No. 8/UN24/KP/2020, tgl. 8 Januari 2020', 6096100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST.', '1', 0, 6096100, 10, 0, 0),
(237, '0009/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Revisi 01 RKAKL UPR Tahun 2020 di Bagian Perencanaan dan Keuangan Kemenristekdikti, sesuai dengan surat tugas No.11/UN24/KP/2020, tgl. 10 Januari 2020', 5517100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Betty Yoice, S.E., M.Si.', '1', 0, 5517100, 10, 0, 0),
(238, '0010/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Revisi 01 RKAKL UPR Tahun 2020 di Bagian Perencanaan dan Keuangan Kemenristekdikti, sesuai dengan surat tugas No.11/UN24/KP/2020, tgl. 10 Januari 2020', 5517100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Erniaty, S.Pi., M.Si.', '1', 0, 5517100, 10, 0, 0),
(239, '0011/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4918472, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, S.E.', '1', 0, 4918472, 10, 0, 0),
(240, '0012/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4446000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Fanuel Nugroho S., S.Kom.', '1', 0, 4446000, 10, 0, 0),
(241, '0013/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4579100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, S.E.', '1', 0, 4579100, 10, 0, 0),
(242, '0014/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4579100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mardianus', '1', 0, 4579100, 10, 0, 0),
(243, '0015/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 4541200, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rusdiana', '1', 0, 4541200, 10, 0, 0),
(244, '0016/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 4604700, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, S.E.', '1', 0, 4604700, 10, 0, 0),
(245, '0017/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 3213200, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mardianus', '1', 0, 3213200, 10, 0, 0),
(246, '0018/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-BARAT) Tahun 2020&#34; sesuai dengan surat tugas No.21/UN24/KP/2020, tgl. 21 Januari 2020', 3593000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '1', 0, 3593000, 10, 0, 0),
(247, '0019/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-BARAT) Tahun 2020&#34; sesuai dengan surat tugas No.21/UN24/KP/2020, tgl. 21 Januari 2020', 3941500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Vincentius Abdi Gunawan, ST., MT.', '1', 0, 3941500, 10, 0, 0),
(248, '0020/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Rapat Koordinasi dalam Rangka Persiapan SKD untuk Pengadaan CPNS Kemdikbud Formasi TA. 2019, sesuai dengan surat tugas No.31/UN24/KP/2020, tgl. 27 Januari 2020', 4506400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi', '1', 0, 4506400, 10, 0, 0),
(249, '0021/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Rapat Koordinasi dalam Rangka Persiapan SKD untuk Pengadaan CPNS Kemdikbud Formasi TA. 2019, sesuai dengan surat tugas No.31/UN24/KP/2020, tgl. 27 Januari 2020', 4836400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Eka Surya Usop, S.Kom., M.Kom.', '1', 0, 4836400, 10, 0, 0),
(250, '0022/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 5026000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Agung Fauzan Sugiarto, S., S.Kom.', '1', 0, 5026000, 10, 0, 0),
(251, '0023/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 3286000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST', '1', 0, 3286000, 10, 0, 0),
(252, '0024/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 5241000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mario Septa Embang, S.Hut', '1', 0, 5241000, 10, 0, 0),
(253, '0025/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Rapat Koordinasi Nasional (Rakornas) Kemenristek/ Badan Riset dan Inovasi Nasional Tahun 2020 (Rakornas RISTEK/BRIN 2020), sesuai dengan surat tugas No.33/UN24/KP/2020, tgl. 27 Januari 2020', 2805300, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '1', 0, 2805300, 10, 0, 0),
(254, '0026/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Menghadiri Undangan Diskusi Forum Perguruan Tinggi untuk Desa (Forum PERTIDES), sesuai dengan surat tugas No.44/UN24/KP/2020, tgl. 29 Januari 2020', 3086900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '1', 0, 3086900, 10, 0, 0),
(255, '0027/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Menghadiri Undangan Diskusi Forum Perguruan Tinggi untuk Desa (Forum PERTIDES), sesuai dengan surat tugas No.51/UN24/KP/2020, tgl. 3 Februari 2020', 7516900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '1', 0, 7516900, 10, 0, 0),
(256, '0028/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Pendampingan Penandatanganan MoU Universitas Palangka Raya dengan Universitas Negeri Makassar, sesuai dengan surat tugas No.48/UN24/KP/2020, tgl. 3 Februari 2020', 6566020, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Estiani Isa Leluni, SH', '1', 0, 6566020, 10, 0, 0),
(257, '0029/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Penerimaan Tenaga Satuan Pengamanan, sesuai dengan surat tugas No.70/UN24/KP/2020, tgl. 10 Februari 2020', 4428671, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, SE.', '1', 0, 4428671, 10, 0, 0),
(258, '0030/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka 1. Mengantar Berkas Pensiun Pendidik dan Tenaga Kependidikan; 2. Mengantar Berkas Usulan Kenaikan Pangkat Pendidik dan Tenaga Kependidikan Periode April 2020; 3. Mengantar Berkas Usulan Kenaikan Pangkat Jabatan Fungsional Tertentu Pranata Laboratorium Pendidikan (PLP); 4. Konsultasi tentang SK Pensiun Pendidik dan Tenaga Kependidikan yangt masih dalam proses TMT 2019 hingga 2020., sesuai dengan surat tugas No.71/UN24/KP/2020, tgl. 10 Februari 2020', 5974900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Teralistia Sadek', '1', 0, 5974900, 10, 0, 0),
(259, '0031/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka 1. Mengantar Berkas Pensiun Pendidik dan Tenaga Kependidikan; 2. Mengantar Berkas Usulan Kenaikan Pangkat Pendidik dan Tenaga Kependidikan Periode April 2020; 3. Mengantar Berkas Usulan Kenaikan Pangkat Jabatan Fungsional Tertentu Pranata Laboratorium Pendidikan (PLP); 4. Konsultasi tentang SK Pensiun Pendidik dan Tenaga Kependidikan yangt masih dalam proses TMT 2019 hingga 2020., sesuai dengan surat tugas No.71/UN24/KP/2020, tgl. 10 Februari 2020', 4854900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Movi Yuana, S.E.', '1', 0, 4854900, 10, 0, 0),
(260, '0032/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5466140, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Drs. Tampung N. Saman, M.Lib.', '1', 0, 5466140, 10, 0, 0),
(261, '0033/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5456140, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. H. Kuswari, S.Pd., M.Si', '1', 0, 5456140, 10, 0, 0),
(262, '0034/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5016390, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Ir. Untung Darung, MP', '1', 0, 5016390, 10, 0, 0),
(263, '0035/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 6610000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Bhayu Rama, ST., MBA., Ph.D', '1', 0, 6610000, 10, 0, 0),
(264, '0036/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 0, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ampuh Sakti Sariffulah', '1', 0, 0, 10, 0, 0),
(265, '0037/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 0, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '1', 0, 0, 10, 0, 0),
(266, '0038/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi masalah kepegawaian ke Biro SDM Kemendikbud, sesuai dengan surat tugas No.82/UN24/KP/2020, tgl. 19 Februari 2020', 6478656, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Drs. Wijoko Lestariono, M.Si.', '1', 0, 6478656, 10, 0, 0),
(267, '0039/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Workshop Pemetaan atas Permasalahan dalam Bidang Pendidikan Tinggi Pasca Reorganisasi Kementerian Pendidikan dan Kebudayaan, sesuai dengan surat tugas No.86/UN24/KP/2020, tgl. 20 Februari 2020', 6783800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Bhayu Rama, ST., MBA., Ph.D', '1', 0, 6783800, 10, 0, 0),
(268, '0040/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Pengukuhan Dewan Riset Daerah (DRD) Kabupaten Sukamara Masa Bakti Periode Tahun 2020 - 2022, sesuai dengan surat tugas No.88/UN24/KP/2020, tgl. 14 Februari 2020', 2348900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '1', 0, 2348900, 10, 0, 0),
(269, '0041/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi dan Menyerahkan Laporan Keuangan Semester II Tahun Anggaran 2019, sesuai dengan surat tugas No.106/UN24/KP/2020, tgl. 24 Februari 2020', 4384000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, SE.', '1', 0, 4384000, 10, 0, 0),
(270, '0042/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 1480000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ir. Emmy Uthanya Antang, M.Si', '1', 0, 1480000, 10, 0, 0),
(271, '0043/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 1380000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Fanuel Nugroho S., S.Kom', '1', 0, 1380000, 10, 0, 0),
(272, '0044/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 980000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Betty Yoice, S.Kom., M.Cs', '1', 0, 980000, 10, 0, 0),
(273, '0045/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 980000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '1', 0, 980000, 10, 0, 0),
(274, '0046/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4227804, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, SE', '1', 0, 4227804, 10, 0, 0),
(275, '0047/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4888094, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST', '1', 0, 4888094, 10, 0, 0),
(276, '0048/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 6645738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Florensius Yantriantho, S.E.', '1', 0, 6645738, 10, 0, 0),
(277, '0049/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4845738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Petrus Adi Susilo, S.Pd.', '1', 0, 4845738, 10, 0, 0),
(278, '0050/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4205738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Heppi Wulandari, S.Psi., M.Si. -', '1', 0, 4205738, 10, 0, 0),
(279, '0051/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4805738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Annastasia Pratama Wulan Sari', '1', 0, 4805738, 10, 0, 0),
(280, '0052/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Pedoman PKTBT (Penguatan Kompetensi Teknis Bidang Tugas) Latsar CPNS dan Aplikasi SIM Penilaian PKTBT, sesuai dengan surat tugas No.119/UN24/KP/2020, tgl. 27 Februari 2020', 3499898, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Hendrick Anggi Permana, S.H.', '1', 0, 3499898, 10, 0, 0),
(281, '0053/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Pedoman PKTBT (Penguatan Kompetensi Teknis Bidang Tugas) Latsar CPNS dan Aplikasi SIM Penilaian PKTBT, sesuai dengan surat tugas No.119/UN24/KP/2020, tgl. 27 Februari 2020', 3499898, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Teralistia Sadek', '1', 0, 3499898, 10, 0, 0),
(282, '0054/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Reviu Peta Jabatan dan Sinkronisasi Data Bezetting Pegawai di lIngkungan Institusi dan Universitas , sesuai dengan surat tugas No.147/UN24/KP/2020, tgl. 9 Maret 2020', 1140667, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi', '1', 0, 1140667, 10, 0, 0),
(283, '0055/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 8043500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Ir. Hj. Masliani, MP', '1', 0, 8043500, 10, 0, 0),
(284, '0056/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 8043500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Sutan P. Silitonga, STP., MT., MT', '1', 0, 8043500, 10, 0, 0),
(285, '0057/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 10123500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Rudi Waluyo, ST., MT', '1', 0, 10123500, 10, 0, 0),
(286, '0058/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-Barat) Tahun 2020, sesuai dengan surat tugas No25/UN24/KP/2020, tgl. 22 Januari 2020', 4922800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Rudi Waluyo, ST., MT', '1', 0, 4922800, 10, 0, 0),
(287, '0059/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-Barat) Tahun 2020, sesuai dengan surat tugas No25/UN24/KP/2020, tgl. 22 Januari 2020', 6458800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Sutan P. Silitonga, STP., MT., MT', '1', 0, 6458800, 10, 0, 0),
(288, '0060/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Peraturan LKPP No. 10 Tahun 2018, tentang Pedoman Pelaksanaan Tender/Seleksi Internasional dan Sosialisasi Peraturan Pengadaan Barang/Jasa Pemerintah yang dibiayai dengan Pinjaman /Hibah Luar Negeri (PBJP PHLN), sesuai dengan surat tugas No. 157/UN24/KP/2020, tgl. 12 Maret 2020', 959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Agung Fauzan Sugiarto, A.Md', '1', 0, 959400, 10, 0, 0),
(289, '0061/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Peraturan LKPP No. 10 Tahun 2018, tentang Pedoman Pelaksanaan Tender/Seleksi Internasional dan Sosialisasi Peraturan Pengadaan Barang/Jasa Pemerintah yang dibiayai dengan Pinjaman /Hibah Luar Negeri (PBJP PHLN), sesuai dengan surat tugas No. 157/UN24/KP/2020, tgl. 12 Maret 2020', 959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mario Septa Embang, S.Hut', '1', 0, 959400, 10, 0, 0),
(291, 'aa1212', '12', '1', 0, 0, 0, 0, 0, 0, 0, '2020-11-16', 2, 2, 'qww', '0', 1234, 0, 10, 0, 0),
(292, 'ass', '5742.994.051.H.521111a', 'asa', 0, 0, 0, 0, 0, 0, 0, '2020-11-02', 3, 2, '', '0', 12, 0, 10, 0, 0),
(293, 'assa', '1w', 'aw', 0, 0, 0, 0, 0, 0, 0, '2020-11-20', 3, 2, '', '0', 1123, 0, 10, 1, 0),
(296, '0122/PNBP Non Modal-UPR/2020', '', 'Penggantian Uang Persediaan Untuk Keperluan Belanja Barang Fakultas MIPA (GUP 4 PNBP)', 5400000, 380000, 0, 57000, 0, 0, 4963000, '2020-11-19', 2, 2, '', '0', 0, 5400000, 10, 1, 0),
(298, 'assasas', '5742.994.051.H.521111', 'sd', 12313, 123, 0, 0, 0, 0, 12190, '2020-11-18', 2, 2, 'dsd', '1', 0, 12313, 10, 0, 0),
(299, 'assffxxxx', '5742.994.051.H.521111', 'asa', 12345, 115, 0, 0, 0, 0, 12230, '2020-11-27', 1, 1, '', '1', 0, 12345, 10, 2, 2),
(300, '0061/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Peraturan LKPP No. 10 Tahun 2018, tentang Pedoman Pelaksanaan Tender/Seleksi Internasional dan Sosialisasi Peraturan Pengadaan Barang/Jasa Pemerintah yang dibiayai dengan Pinjaman /Hibah Luar Negeri (PBJP PHLN), sesuai dengan surat tugas No. 157/UN24/KP/2020, tgl. 12 Maret 2020', 959400, 11, 0, 0, 0, 0, 959389, '2020-11-20', 2, 2, 'Mario Septa Embang, S.Hut', '0', 0, 959400, 10, 0, 1);

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
  `trxu_id_metode_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transaksi_unit`
--

INSERT INTO `tbl_transaksi_unit` (`trxu_id`, `trxu_nomor_bukti`, `trxu_mak`, `trxu_uraian`, `trxu_jml_kotor`, `trxu_ppn`, `trxu_pph_21`, `trxu_pph_22`, `trxu_pph_23`, `trxu_pph_4_2`, `trxu_jml_bersih`, `trxu_tanggal`, `trxu_id_jenis_pembayaran`, `trxu_id_metode_pembayaran`) VALUES
(3, 296, '4257.015.051.VI.521111', 'Biaya ATK Bulan Januari', 2090000, 190000, 0, 28500, 0, 0, 1871500, '2020-11-19', 2, 2),
(4, 293, 'as', 'as', 123, 0, 0, 0, 0, 0, 123, '2020-11-24', 2, 1),
(5, 296, 'as', 'qw', 123449, 0, 0, 0, 0, 0, 123455, '2020-11-23', 2, 2),
(6, 299, 'as', 'as', 4456643, 0, 0, 0, 0, 0, 4456657, '2020-11-20', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `nama`) VALUES
(0, '-'),
(1, 'BPP FISIP'),
(2, 'BPP TEKNIK');

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
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'ZrI8y5PWXp9d6IIIXxRS8O', 1268889823, 1606142983, 1, 'Admin', 'istrator', 'ADMIN', '0'),
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
-- Indexes for table `pajak`
--
ALTER TABLE `pajak`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `trx_id_tahun` (`trx_id_tahun`),
  ADD KEY `trx_fk_unit` (`trx_fk_unit`),
  ADD KEY `trx_id_pajak` (`trx_id_pajak`);

--
-- Indexes for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  ADD PRIMARY KEY (`trxu_id`),
  ADD KEY `trx_id_metode_pembayaran` (`trxu_id_metode_pembayaran`),
  ADD KEY `trxu_id_jenis_pembayaran` (`trxu_id_jenis_pembayaran`),
  ADD KEY `trxu_nomor_bukti` (`trxu_nomor_bukti`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `menu_type`
--
ALTER TABLE `menu_type`
  MODIFY `id_menu_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pajak`
--
ALTER TABLE `pajak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  MODIFY `trxu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `tbl_transaksi_ibfk_4` FOREIGN KEY (`trx_id_tahun`) REFERENCES `tbl_tahun` (`tahun_id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_5` FOREIGN KEY (`trx_fk_unit`) REFERENCES `unit` (`id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_6` FOREIGN KEY (`trx_id_pajak`) REFERENCES `pajak` (`id`);

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
