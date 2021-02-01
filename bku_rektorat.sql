-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 01, 2021 at 02:50 PM
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
(281, '200431304005152', '4257.015.054.A.521115', 'Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Januari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00227', 424292000, 0, 0, 0, 0, 0, 0, '0000-00-00', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 424292000, 0, 10, 5, 0),
(282, '200431304005152x', '4257.015.054.A.521115', 'Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Januari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00227', 424292000, 0, 0, 0, 0, 0, 0, '0000-00-00', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 0, 424292000, 10, 5, 0),
(283, '200431304005153', '4257.015.054.A.521115', 'Honorarium - Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Februari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00228', 432667000, 0, 0, 0, 0, 0, 0, '0000-00-00', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 432667000, 0, 10, 5, 0),
(284, '200431304005153', '4257.015.054.A.521115', 'Honorarium - Pembayaran Belanja Barang Sesuai Dengan SK.No.37/UN24/KP/2020. Tgl.10 Februari 2020. Bulan Februari 2020. (Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020). Sesuai SPP Nomor 00228', 432667000, 0, 0, 0, 0, 0, 0, '0000-00-00', 3, 2, 'Tenaga Kontrak Pramubakti, Petugas Kebersihan, Pengemudi & Satpam Bersumber Dari Anggaran PNBP T.A.2020', '1', 0, 432667000, 10, 5, 0),
(285, 'CGJ495326-1', '', 'Kas (Uang Persediaan)', 0, 0, 0, 0, 0, 0, 0, '2020-03-23', 1, 1, 'BPP PNBP', '1', 500000000, 0, 10, 5, 0),
(286, 'CGJ495326-2', '', 'Kas (LS Perjalanan Dinas)', 0, 0, 0, 0, 0, 0, 0, '2020-03-23', 1, 2, 'BPP PNBP', '1', 261541498, 0, 10, 5, 0),
(287, '0001/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Daftar Ulang Calon Peserta PPRA LX TA 2020 Lemhanas dari Unsur ASN, sesuai dengan surat tugas No. 2/UN24/KP/2020, tgl. 2 Januari 2020', 2841802, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Prof. Dr. I Nyoman Sudyana, M.Sc', '0', 0, 2841802, 10, 5, 0),
(288, '0002/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rapat Koordinasi Persiapan Pelaksanaan Latihan Dasar CPNS TA. 2020, sesuai dengan surat tugas No. 26/UN24/KP/2020, tgl. 22 Januari 2020', 600000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dra. Ruli Meiliawati, M.Pd.', '0', 0, 600000, 10, 5, 0),
(289, '0003/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rapat Koordinasi Persiapan Pelaksanaan Latihan Dasar CPNS TA. 2020, sesuai dengan surat tugas No. 26/UN24/KP/2020, tgl. 22 Januari 2020', 600000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi, S.E., M.Si', '0', 0, 600000, 10, 5, 0),
(290, '0004/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Rapat Koordinasi Pembinaan Pengadaan Barang dan Jasa di Lingkungan Kementerian Pendidikan dan Kebudayaan, sesuai dengan surat tugas No. 49/UN24/KP/2020, tgl. 3 Februari 2020', 3174594, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, S.T.', '0', 0, 3174594, 10, 5, 0),
(291, '0005/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Acara &#34;Forum Koordinasi BPK dan Pengawas Internal dalam rangka Mewujudkan Transparansi dan Akuntabilitas Keuangan Negara di Lingkungan PTN dan PTNBH, sesuai dengan surat tugas No. 3/UN24/KP/2020, tgl. 6 Januari 2020', 4959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Riamona Sadelman Tulis', '0', 0, 4959400, 10, 5, 0),
(292, '0006/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Acara &#34;Forum Koordinasi BPK dan Pengawas Internal dalam rangka Mewujudkan Transparansi dan Akuntabilitas Keuangan Negara di Lingkungan PTN dan PTNBH, sesuai dengan surat tugas No. 3/UN24/KP/2020, tgl. 6 Januari 2020', 4959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Yanetri Asi, SP., M.Si., Ph.D', '0', 0, 4959400, 10, 5, 0),
(293, '0007/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan Konsultasi Pembentukan UkpBJ/ULP UPR Kemendikbud, sesuai dengan surat tugas No. 8/UN24/KP/2020, tgl. 8 Januari 2020', 6096100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '0', 0, 6096100, 10, 5, 0),
(294, '0008/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan Konsultasi Pembentukan UkpBJ/ULP UPR Kemendikbud, sesuai dengan surat tugas No. 8/UN24/KP/2020, tgl. 8 Januari 2020', 6096100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST.', '0', 0, 6096100, 10, 5, 0),
(295, '0009/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Revisi 01 RKAKL UPR Tahun 2020 di Bagian Perencanaan dan Keuangan Kemenristekdikti, sesuai dengan surat tugas No.11/UN24/KP/2020, tgl. 10 Januari 2020', 5517100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Betty Yoice, S.E., M.Si.', '0', 0, 5517100, 10, 5, 0),
(296, '0010/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Revisi 01 RKAKL UPR Tahun 2020 di Bagian Perencanaan dan Keuangan Kemenristekdikti, sesuai dengan surat tugas No.11/UN24/KP/2020, tgl. 10 Januari 2020', 5517100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Erniaty, S.Pi., M.Si.', '0', 0, 5517100, 10, 5, 0),
(297, '0011/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4918472, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, S.E.', '0', 0, 4918472, 10, 5, 0),
(298, '0012/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4446000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Fanuel Nugroho S., S.Kom.', '0', 0, 4446000, 10, 5, 0),
(299, '0013/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4579100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, S.E.', '0', 0, 4579100, 10, 5, 0),
(300, '0014/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited, sesuai dengan surat tugas No.10/UN24/KP/2020, tgl. 09 Januari 2020', 4579100, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mardianus', '0', 0, 4579100, 10, 5, 0),
(301, '0015/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 4541200, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rusdiana', '0', 0, 4541200, 10, 5, 0),
(302, '0016/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 4604700, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, S.E.', '0', 0, 4604700, 10, 5, 0),
(303, '0017/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Rekonsiliasi SAK dan SIMAK BMN sertta Penyusunan Laporan Keuangan TA. 2019 Kemenristekdikti Unaudited sesuai dengan surat tugas No.19/UN24/KP/2020, tgl. 20 Januari 2020', 3213200, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mardianus', '0', 0, 3213200, 10, 5, 0),
(304, '0018/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-BARAT) Tahun 2020&#34; sesuai dengan surat tugas No.21/UN24/KP/2020, tgl. 21 Januari 2020', 3593000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '0', 0, 3593000, 10, 5, 0),
(305, '0019/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-BARAT) Tahun 2020&#34; sesuai dengan surat tugas No.21/UN24/KP/2020, tgl. 21 Januari 2020', 3941500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Vincentius Abdi Gunawan, ST., MT.', '0', 0, 3941500, 10, 5, 0),
(306, '0020/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Rapat Koordinasi dalam Rangka Persiapan SKD untuk Pengadaan CPNS Kemdikbud Formasi TA. 2019, sesuai dengan surat tugas No.31/UN24/KP/2020, tgl. 27 Januari 2020', 4506400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi', '0', 0, 4506400, 10, 5, 0),
(307, '0021/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Rapat Koordinasi dalam Rangka Persiapan SKD untuk Pengadaan CPNS Kemdikbud Formasi TA. 2019, sesuai dengan surat tugas No.31/UN24/KP/2020, tgl. 27 Januari 2020', 4836400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Eka Surya Usop, S.Kom., M.Kom.', '0', 0, 4836400, 10, 5, 0),
(308, '0022/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 5026000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Agung Fauzan Sugiarto, S., S.Kom.', '0', 0, 5026000, 10, 5, 0),
(309, '0023/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 3286000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST', '0', 0, 3286000, 10, 5, 0),
(310, '0024/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Bimtek Perencanaan PBJ TA. 2020 Satuan Kerja Perguruan Tinggi Negeri, sesuai dengan surat tugas No.32/UN24/KP/2020, tgl. 23 Januari 2020', 5241000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mario Septa Embang, S.Hut', '0', 0, 5241000, 10, 5, 0),
(311, '0025/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Rapat Koordinasi Nasional (Rakornas) Kemenristek/ Badan Riset dan Inovasi Nasional Tahun 2020 (Rakornas RISTEK/BRIN 2020), sesuai dengan surat tugas No.33/UN24/KP/2020, tgl. 27 Januari 2020', 2805300, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '0', 0, 2805300, 10, 5, 0),
(312, '0026/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Menghadiri Undangan Diskusi Forum Perguruan Tinggi untuk Desa (Forum PERTIDES), sesuai dengan surat tugas No.44/UN24/KP/2020, tgl. 29 Januari 2020', 3086900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '0', 0, 3086900, 10, 5, 0),
(313, '0027/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Menghadiri Undangan Diskusi Forum Perguruan Tinggi untuk Desa (Forum PERTIDES), sesuai dengan surat tugas No.51/UN24/KP/2020, tgl. 3 Februari 2020', 7516900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Kusnida Indrajaya, M.Si.', '0', 0, 7516900, 10, 5, 0),
(314, '0028/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Pendampingan Penandatanganan MoU Universitas Palangka Raya dengan Universitas Negeri Makassar, sesuai dengan surat tugas No.48/UN24/KP/2020, tgl. 3 Februari 2020', 6566020, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Estiani Isa Leluni, SH', '0', 0, 6566020, 10, 5, 0),
(315, '0029/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Penerimaan Tenaga Satuan Pengamanan, sesuai dengan surat tugas No.70/UN24/KP/2020, tgl. 10 Februari 2020', 4428671, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, SE.', '0', 0, 4428671, 10, 5, 0),
(316, '0030/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka 1. Mengantar Berkas Pensiun Pendidik dan Tenaga Kependidikan; 2. Mengantar Berkas Usulan Kenaikan Pangkat Pendidik dan Tenaga Kependidikan Periode April 2020; 3. Mengantar Berkas Usulan Kenaikan Pangkat Jabatan Fungsional Tertentu Pranata Laboratorium Pendidikan (PLP); 4. Konsultasi tentang SK Pensiun Pendidik dan Tenaga Kependidikan yangt masih dalam proses TMT 2019 hingga 2020., sesuai dengan surat tugas No.71/UN24/KP/2020, tgl. 10 Februari 2020', 5974900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Teralistia Sadek', '0', 0, 5974900, 10, 5, 0),
(317, '0031/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka 1. Mengantar Berkas Pensiun Pendidik dan Tenaga Kependidikan; 2. Mengantar Berkas Usulan Kenaikan Pangkat Pendidik dan Tenaga Kependidikan Periode April 2020; 3. Mengantar Berkas Usulan Kenaikan Pangkat Jabatan Fungsional Tertentu Pranata Laboratorium Pendidikan (PLP); 4. Konsultasi tentang SK Pensiun Pendidik dan Tenaga Kependidikan yangt masih dalam proses TMT 2019 hingga 2020., sesuai dengan surat tugas No.71/UN24/KP/2020, tgl. 10 Februari 2020', 4854900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Movi Yuana, S.E.', '0', 0, 4854900, 10, 5, 0),
(318, '0032/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5466140, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Drs. Tampung N. Saman, M.Lib.', '0', 0, 5466140, 10, 5, 0),
(319, '0033/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5456140, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. H. Kuswari, S.Pd., M.Si', '0', 0, 5456140, 10, 5, 0),
(320, '0034/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri dan Mengikuti Kegiatan Lokakarya &#34;Kepemimpinan Perguruan Tinggi Era 4.0&#34;., sesuai dengan surat tugas No.58/UN24/KP/2020, tgl. 7 Januari 2020', 5016390, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Ir. Untung Darung, MP', '0', 0, 5016390, 10, 5, 0),
(321, '0035/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 6610000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Bhayu Rama, ST., MBA., Ph.D', '0', 0, 6610000, 10, 5, 0),
(322, '0036/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 0, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ampuh Sakti Sariffulah', '0', 0, 0, 10, 5, 0),
(323, '0037/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri Undangan Kegiatan Rapat Kerja Nasional (Rakernas) Forum Wakil/Pembantu Rektor II Perguruan Tinggi se-Indonesia, sesuai dengan surat tugas No.69/UN24/KP/2020, tgl. 12 Februari 2020', 0, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '0', 0, 0, 10, 5, 0),
(324, '0038/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi masalah kepegawaian ke Biro SDM Kemendikbud, sesuai dengan surat tugas No.82/UN24/KP/2020, tgl. 19 Februari 2020', 6478656, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Drs. Wijoko Lestariono, M.Si.', '0', 0, 6478656, 10, 5, 0),
(325, '0039/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Workshop Pemetaan atas Permasalahan dalam Bidang Pendidikan Tinggi Pasca Reorganisasi Kementerian Pendidikan dan Kebudayaan, sesuai dengan surat tugas No.86/UN24/KP/2020, tgl. 20 Februari 2020', 6783800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Bhayu Rama, ST., MBA., Ph.D', '0', 0, 6783800, 10, 5, 0),
(326, '0040/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Pengukuhan Dewan Riset Daerah (DRD) Kabupaten Sukamara Masa Bakti Periode Tahun 2020 - 2022, sesuai dengan surat tugas No.88/UN24/KP/2020, tgl. 14 Februari 2020', 2348900, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '0', 0, 2348900, 10, 5, 0),
(327, '0041/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi dan Menyerahkan Laporan Keuangan Semester II Tahun Anggaran 2019, sesuai dengan surat tugas No.106/UN24/KP/2020, tgl. 24 Februari 2020', 4384000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Sarif Hidayat, SE.', '0', 0, 4384000, 10, 5, 0),
(328, '0042/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 1480000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ir. Emmy Uthanya Antang, M.Si', '0', 0, 1480000, 10, 5, 0),
(329, '0043/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 1380000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Fanuel Nugroho S., S.Kom', '0', 0, 1380000, 10, 5, 0),
(330, '0044/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 980000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Betty Yoice, S.Kom., M.Cs', '0', 0, 980000, 10, 5, 0),
(331, '0045/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Konsultasi Tata Cara Perhitungan BKT dan UKT di Universitas Lambung Mangkurat, sesuai dengan surat tugas No.120/UN24/KP/2020, tgl. 2 Maret 2020', 980000, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Rollis, SH., MH', '0', 0, 980000, 10, 5, 0),
(332, '0046/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4227804, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Suwandy, SE', '0', 0, 4227804, 10, 5, 0),
(333, '0047/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4888094, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Ade Kristianto, ST', '0', 0, 4888094, 10, 5, 0),
(334, '0048/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 6645738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Florensius Yantriantho, S.E.', '0', 0, 6645738, 10, 5, 0),
(335, '0049/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4845738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Petrus Adi Susilo, S.Pd.', '0', 0, 4845738, 10, 5, 0),
(336, '0050/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4205738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Heppi Wulandari, S.Psi., M.Si. -', '0', 0, 4205738, 10, 5, 0),
(337, '0051/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Sosialisasi dan Bimtek Sistem Informasi Pengadaan Langsung (SIMPeL) Kementerian Pendidikan dan Kebudayaan RI, sesuai dengan surat tugas No.83/UN24/KP/2020, tgl. 19 Februari 2020', 4805738, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Annastasia Pratama Wulan Sari', '0', 0, 4805738, 10, 5, 0),
(338, '0052/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Pedoman PKTBT (Penguatan Kompetensi Teknis Bidang Tugas) Latsar CPNS dan Aplikasi SIM Penilaian PKTBT, sesuai dengan surat tugas No.119/UN24/KP/2020, tgl. 27 Februari 2020', 3499898, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Hendrick Anggi Permana, S.H.', '0', 0, 3499898, 10, 5, 0),
(339, '0053/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Pedoman PKTBT (Penguatan Kompetensi Teknis Bidang Tugas) Latsar CPNS dan Aplikasi SIM Penilaian PKTBT, sesuai dengan surat tugas No.119/UN24/KP/2020, tgl. 27 Februari 2020', 3499898, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Teralistia Sadek', '0', 0, 3499898, 10, 5, 0),
(340, '0054/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Kegiatan Reviu Peta Jabatan dan Sinkronisasi Data Bezetting Pegawai di lIngkungan Institusi dan Universitas , sesuai dengan surat tugas No.147/UN24/KP/2020, tgl. 9 Maret 2020', 1140667, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Antoni Yahya Cristiadi', '0', 0, 1140667, 10, 5, 0),
(341, '0055/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 8043500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Ir. Hj. Masliani, MP', '0', 0, 8043500, 10, 5, 0),
(342, '0056/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 8043500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Sutan P. Silitonga, STP., MT., MT', '0', 0, 8043500, 10, 5, 0),
(343, '0057/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Bimbingan Teknis Penyusunan Laporan Kinerja Program Studi (LKPS) dan Laporan Evaluasi Diri (LED) IAPS 4.0 Berbasis Standar Nasional Dikti, sesuai dengan surat tugas No.54/UN24/KP/2020, tgl. 4 Februari 2020', 10123500, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Rudi Waluyo, ST., MT', '0', 0, 10123500, 10, 5, 0),
(344, '0058/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-Barat) Tahun 2020, sesuai dengan surat tugas No25/UN24/KP/2020, tgl. 22 Januari 2020', 4922800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Rudi Waluyo, ST., MT', '0', 0, 4922800, 10, 5, 0),
(345, '0059/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Menghadiri kegiatan &#34;Focus Group Discussion (FGD) Pembahasan POB dan Peluncuran Seleksi Mandiri Masuk PTN Wilayah Barat (SMM PTN-Barat) Tahun 2020, sesuai dengan surat tugas No25/UN24/KP/2020, tgl. 22 Januari 2020', 6458800, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Dr. Sutan P. Silitonga, STP., MT., MT', '0', 0, 6458800, 10, 5, 0),
(346, '0060/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Peraturan LKPP No. 10 Tahun 2018, tentang Pedoman Pelaksanaan Tender/Seleksi Internasional dan Sosialisasi Peraturan Pengadaan Barang/Jasa Pemerintah yang dibiayai dengan Pinjaman /Hibah Luar Negeri (PBJP PHLN), sesuai dengan surat tugas No. 157/UN24/KP/2020, tgl. 12 Maret 2020', 959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Agung Fauzan Sugiarto, A.Md', '0', 0, 959400, 10, 5, 0),
(347, '0061/PNBP Non Modal-UPR/2020', '4257.015.051.D.524111', 'Biaya Perjalanan Dinas Dalam Rangka Mengikuti Sosialisasi Peraturan LKPP No. 10 Tahun 2018, tentang Pedoman Pelaksanaan Tender/Seleksi Internasional dan Sosialisasi Peraturan Pengadaan Barang/Jasa Pemerintah yang dibiayai dengan Pinjaman /Hibah Luar Negeri (PBJP PHLN), sesuai dengan surat tugas No. 157/UN24/KP/2020, tgl. 12 Maret 2020', 959400, 0, 0, 0, 0, 0, 0, '2020-03-24', 2, 2, 'Mario Septa Embang, S.Hut', '0', 0, 959400, 10, 5, 0);

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
(2, 'BPP TEKNIK'),
(3, 'BPP Fakultas Ekonomi dan Bisnis'),
(4, 'Subbag Hutala'),
(5, 'BPP PNBP');

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
  `phone` varchar(20) DEFAULT NULL,
  `foto` longtext NOT NULL,
  `foto_nama` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `foto`, `foto_nama`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'ZrI8y5PWXp9d6IIIXxRS8O', 1268889823, 1612187412, 1, 'Admin', 'istrator', 'ADMIN', '0', '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', 'log2.png'),
(2, '127.0.0.1', 'member', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'member@member.com', '', 'm0vyKu2zW7L8PTG20bquF.707e055aeea8a30aca', 1541329145, 'lHtbqmxsnla1izZ5LcXd9O', 1268889823, 1561843839, 1, 'Operator', 'Apps', 'Prodi', '0', '', ''),
(3, '127.0.0.1', 'adeade', '$2y$08$qbEiq9GhlaB8My8TdJXLPuXKxleROxxQGsCArdMBPfa4gabaja3Xm', 'adeade', 'ade.chandra.saputra.tumbai@gmail.com', NULL, 'ads', 0, 'ad', 0, 1561844915, 1, 'ad', 'e', 'adecs', '12424', '', '');

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
  MODIFY `sak_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_saldo_awal`
--
ALTER TABLE `tbl_saldo_awal`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `trx_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT for table `tbl_transaksi_unit`
--
ALTER TABLE `tbl_transaksi_unit`
  MODIFY `trxu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `tbl_transaksi_unit_ibfk_3` FOREIGN KEY (`trxu_nomor_bukti`) REFERENCES `tbl_transaksi` (`trx_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
