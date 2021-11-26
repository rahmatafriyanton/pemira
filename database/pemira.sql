-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2021 at 05:34 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemira`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` int(11) NOT NULL,
  `nama_fakultas` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `nama_fakultas`) VALUES
(1, 'Fakultas Ekonomi dan Bisnis'),
(2, 'Fakultas Hukum'),
(3, 'Fakultas Ilmu Kesehatan'),
(4, 'Fakultas Ilmu Komputer'),
(5, 'Fakultas Ilmu Sosial & Ilmu Politik'),
(6, 'Fakultas Kedokteran'),
(7, 'Fakultas Teknik'),
(8, 'Ormawa Universitas');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_pemilihan`
--

CREATE TABLE `hasil_pemilihan` (
  `id` int(11) NOT NULL,
  `pemilihan_id` int(11) NOT NULL,
  `peserta_id` varchar(100) NOT NULL,
  `pemilih_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_pemilihan`
--

INSERT INTO `hasil_pemilihan` (`id`, `pemilihan_id`, `peserta_id`, `pemilih_id`, `created_at`) VALUES
(1, 43, 'cijfw5olsvh1qki9tdoea67k0mv72gcxluajsfpb0fzlnwryic1hngdhptmvhbn8okx2qf3pwtz6dlvkxrmcrpgygyy4t4i3zwn', 1, '2021-11-23 21:41:06'),
(2, 44, '7vwkptoo7zvemd6syrnoayhuuvnkl8pmggrfpkhm3h8eg41sici0xmxijb2nfql4aapawfsjdq1hblryddxt6qbecqfy3wvwxs9', 1, '2021-11-23 23:26:12'),
(3, 44, 'ncpg1llp2hivnerwmwavtticjvaczxxfoxqk8shower5yw6dfnb27onv9hezm8lqg76kjafm3jkqdipuubiohy0jzfdys54t9ls', 3, '2021-11-23 23:28:21'),
(4, 45, 'ncpg1llp2hivnerwmwavtticjvaczxxfoxqk8shower5yw6dfnb27onv9hezm8lqg76kjafm3jkqdipuubiohy0jzfdys54t9ls', 3, '2021-11-24 11:58:35'),
(5, 46, 'kqyodq12be3hsi8f4xsvmpijdf0ioxye5kyerpsldxairgvccr76tnl5c9u4aauku7n09ttvvghambwqbf16df8sjechzlgrwmw', 10, '2021-11-26 11:28:09'),
(6, 46, 'kqyodq12be3hsi8f4xsvmpijdf0ioxye5kyerpsldxairgvccr76tnl5c9u4aauku7n09ttvvghambwqbf16df8sjechzlgrwmw', 11, '2021-11-26 11:28:36'),
(7, 46, 'khf0qa9wayveshenepihkgmomd6ls7qobvxtgfsmzi5anirzbfr5nlv1de38wlizjt3pnf9hgcc4z0ysjdcu2rqjbxc27ptqwvk', 13, '2021-11-26 11:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL,
  `jenjang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `fakultas_id`, `nama_jurusan`, `jenjang`) VALUES
(1, 1, 'Perbankan dan Keuangan', 'D3'),
(2, 1, 'Akuntansi', 'D3'),
(3, 1, 'Manajemen', 'S1'),
(4, 1, 'Akuntansi', 'S1'),
(5, 1, 'Ekonomi Pembangunan', 'S1'),
(6, 1, 'Ekonomi Syariah', 'S1'),
(7, 1, 'Manajemen', 'S2'),
(8, 6, 'Kedokteran', 'S1'),
(9, 6, 'Farmasi', 'S1'),
(10, 7, 'Teknik Mesin', 'S1'),
(11, 7, 'Teknik Industri', 'S1'),
(12, 7, 'Teknik Perkapalan', 'S1'),
(13, 7, 'Teknik Elektro', 'S1'),
(14, 5, 'Ilmu Komunikasi', 'S1'),
(15, 5, 'Hubungan Internasional', 'S1'),
(16, 5, 'Ilmu Politik', 'S1'),
(17, 4, 'Sistem Informasi', 'D3'),
(18, 4, 'Informatika', 'S1'),
(19, 4, 'Sistem Informasi', 'S1'),
(20, 2, 'Hukum', 'S1'),
(21, 2, 'Hukum', 'S2'),
(22, 2, 'Keperawatan', 'D3'),
(23, 2, 'Fisioterapi', 'D3'),
(24, 2, 'Keperawatan', 'S1'),
(25, 2, 'Kesehatan Masyarakat', 'S1'),
(26, 2, 'Gizi', 'S1');

-- --------------------------------------------------------

--
-- Table structure for table `master_pemilihan`
--

CREATE TABLE `master_pemilihan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fakultas_id` int(11) NOT NULL,
  `ormawa_id` int(11) NOT NULL,
  `nama_acara` varchar(255) NOT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pemilihan`
--

INSERT INTO `master_pemilihan` (`id`, `user_id`, `fakultas_id`, `ormawa_id`, `nama_acara`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(46, 8, 8, 1, 'Pemilihan Ketua BEM', '2021-11-01 00:12:00', '2021-11-24 11:30:05', '2021-11-26 07:51:47', '0000-00-00 00:00:00'),
(47, 8, 4, 2, 'Pemilihan Ketua KSM Android', '2021-12-01 10:12:00', '2021-12-01 23:12:00', '2021-11-26 10:29:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_pemilihan_pemilih`
--

CREATE TABLE `master_pemilihan_pemilih` (
  `id` int(11) NOT NULL,
  `pemilihan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `token` varchar(10) NOT NULL,
  `sudah_memilih` tinyint(4) NOT NULL DEFAULT 0,
  `tanggal_memilih` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pemilihan_pemilih`
--

INSERT INTO `master_pemilihan_pemilih` (`id`, `pemilihan_id`, `user_id`, `nim`, `nama_lengkap`, `email`, `fakultas`, `jurusan`, `token`, `sudah_memilih`, `tanggal_memilih`) VALUES
(20, 46, 8, '2010511133', 'Rahmat Afriyanton', '2010511133@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ibywgd', 0, NULL),
(21, 46, 9, '2010511129', 'Dafa Rabbani', '2010511129@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'gussqm', 0, NULL),
(22, 46, 10, '2010511200', 'Dimas', '2010511200@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'imtiua', 1, '2021-11-26 05:28:09'),
(23, 46, 11, '2010511201', 'Zaki', '2010511201@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'jfixqu', 1, '2021-11-26 05:28:36'),
(24, 46, 12, '2010511202', 'Budi', '2010511202@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'mgquec', 0, NULL),
(25, 46, 13, '2010511203', 'Glyn Needham', '2010511203@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ybydru', 1, '2021-11-26 05:29:11'),
(26, 46, 14, '2010511204', 'Weronika Blair', '2010511204@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'uyagji', 0, NULL),
(27, 46, 15, '2010511205', 'Larry Lister', '2010511205@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'nbwsmq', 0, NULL),
(28, 46, 16, '2010511206', 'Hector Stephens', '2010511206@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'xkiujc', 0, NULL),
(29, 46, 17, '2010511207', 'acques Singleton', '2010511207@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ipblso', 0, NULL),
(30, 47, 8, '2010511133', 'Rahmat Afriyanton', '2010511133@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ekcvby', 0, NULL),
(31, 47, 9, '2010511129', 'Dafa Rabbani', '2010511129@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'hnpglb', 0, NULL),
(32, 46, 10, '2010511200', 'Dimas', '2010511200@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'imtiua', 1, '2021-11-26 05:28:09'),
(33, 46, 11, '2010511201', 'Zaki', '2010511201@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'jfixqu', 1, '2021-11-26 05:28:36'),
(34, 47, 12, '2010511202', 'Budi', '2010511202@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'wyrdxo', 0, NULL),
(35, 46, 13, '2010511203', 'Glyn Needham', '2010511203@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ybydru', 1, '2021-11-26 05:29:11'),
(36, 47, 14, '2010511204', 'Weronika Blair', '2010511204@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'ckbopg', 0, NULL),
(37, 47, 15, '2010511205', 'Larry Lister', '2010511205@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'uqwxny', 0, NULL),
(38, 47, 16, '2010511206', 'Hector Stephens', '2010511206@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'mpusof', 0, NULL),
(39, 47, 17, '2010511207', 'acques Singleton', '2010511207@mahasiswa.upnvj.ac.id', 'Fakultas Ilmu Komputer', 'Informatika', 'horbbk', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_pemilihan_peserta`
--

CREATE TABLE `master_pemilihan_peserta` (
  `id` int(11) NOT NULL,
  `peserta_id` varchar(100) NOT NULL,
  `pemilihan_id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_a` enum('ketua','wakil_ketua') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pemilihan_peserta`
--

INSERT INTO `master_pemilihan_peserta` (`id`, `peserta_id`, `pemilihan_id`, `nim`, `nama_lengkap`, `email`, `fakultas`, `jurusan`, `photo`, `is_a`) VALUES
(39, 'kqyodq12be3hsi8f4xsvmpijdf0ioxye5kyerpsldxairgvccr76tnl5c9u4aauku7n09ttvvghambwqbf16df8sjechzlgrwmw', 46, '2010511200', 'Dimas', '', 'Fakultas Ilmu Komputer', 'Informatika', './assets/images/profil_peserta/20211126052641.png', 'ketua'),
(40, 'kqyodq12be3hsi8f4xsvmpijdf0ioxye5kyerpsldxairgvccr76tnl5c9u4aauku7n09ttvvghambwqbf16df8sjechzlgrwmw', 46, '2010511201', 'Zaki', '', 'Fakultas Ilmu Komputer', 'Informatika', './assets/images/profil_peserta/20211126052641.png', 'wakil_ketua'),
(41, 'khf0qa9wayveshenepihkgmomd6ls7qobvxtgfsmzi5anirzbfr5nlv1de38wlizjt3pnf9hgcc4z0ysjdcu2rqjbxc27ptqwvk', 46, '2010511202', 'Budi', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'ketua'),
(42, 'khf0qa9wayveshenepihkgmomd6ls7qobvxtgfsmzi5anirzbfr5nlv1de38wlizjt3pnf9hgcc4z0ysjdcu2rqjbxc27ptqwvk', 46, '2010511203', 'Glyn Needham', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'wakil_ketua'),
(43, 'k366ygifwlnfmo1qxt9vrjclriq08mexlc4z8t1rr7feapbhintbdgposwav4mq0s2jdwhtxdkcgnujxdsyquualbemszcyowvn', 47, '2010511200', 'Dimas', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'ketua'),
(44, 'k366ygifwlnfmo1qxt9vrjclriq08mexlc4z8t1rr7feapbhintbdgposwav4mq0s2jdwhtxdkcgnujxdsyquualbemszcyowvn', 47, '2010511201', 'Zaki', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'wakil_ketua'),
(45, 'rpckp13mtpszqgn59mcbosu2igypg68oxanjkifbf4ef9ag1sj00we77lewlzrbxknvmlrqxm2ivaqcdojqz5uf4djwiw3vbdty', 47, '2010511202', 'Budi', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'ketua'),
(46, 'rpckp13mtpszqgn59mcbosu2igypg68oxanjkifbf4ef9ag1sj00we77lewlzrbxknvmlrqxm2ivaqcdojqz5uf4djwiw3vbdty', 47, '2010511203', 'Glyn Needham', '', 'Fakultas Ilmu Komputer', 'Informatika', NULL, 'wakil_ketua');

-- --------------------------------------------------------

--
-- Table structure for table `master_pemilihan_visi_misi`
--

CREATE TABLE `master_pemilihan_visi_misi` (
  `id` int(11) NOT NULL,
  `pemilihan_id` int(11) NOT NULL,
  `peserta_id` varchar(100) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pemilihan_visi_misi`
--

INSERT INTO `master_pemilihan_visi_misi` (`id`, `pemilihan_id`, `peserta_id`, `visi`, `misi`, `created_at`, `created_by`) VALUES
(4, 46, 'kqyodq12be3hsi8f4xsvmpijdf0ioxye5kyerpsldxairgvccr76tnl5c9u4aauku7n09ttvvghambwqbf16df8sjechzlgrwmw', 'Lorem ipsum dolor sit amet consectetur adipisicing, elit. Quae soluta, cupiditate mollitia explicabo sit eos voluptate dignissimos. Reiciendis itaque, exercitationem ipsum quisquam quam pariatur omnis consequuntur blanditiis iusto facilis obcaecati ad molestias fugit reprehenderit minus rerum consequatur ullam hic amet odio similique autem. Ipsum vel id explicabo laborum error architecto labore, tempora aliquam qui incidunt quos nihil vitae numquam quod consequuntur sit magnam quam in corrupti molestias rerum iste quo asperiores eum. Doloremque suscipit praesentium eum, perspiciatis commodi adipisci temporibus officia, in necessitatibus tempore explicabo hic incidunt deleniti quia vel ipsum corrupti animi impedit cumque, unde tenetur! Similique, sapiente, expedita?<br>', '<ul><li>Lorem ipsum dolor sit amet consectetur adipisicing, elit</li><li>Lorem ipsum dolor sit amet consectetur adipisicing, elit</li><li>Lorem ipsum dolor sit amet consectetur adipisicing, elit</li><li>Lorem ipsum dolor sit amet consectetur adipisicing, elit</li><li>Lorem ipsum dolor sit amet consectetur adipisicing, elit</li></ul>', '2021-11-26 11:26:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ormawa`
--

CREATE TABLE `ormawa` (
  `id` int(11) NOT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `nama_ormawa` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ormawa`
--

INSERT INTO `ormawa` (`id`, `fakultas_id`, `user_id`, `nama_ormawa`, `logo`) VALUES
(1, 8, 8, 'Bem Universitas ', './assets/images/logo_ormawa/20211117025010.png'),
(2, 4, 8, 'KSM Android', ''),
(3, 4, 8, 'KSM Robotika', ''),
(5, 1, 18, 'Himpunan Mahasiswa Ekonomi', '');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'user', '2021-10-27 04:43:14', '2021-10-27 04:43:14'),
(2, 'moderator', '2021-10-27 04:43:14', '2021-10-27 04:43:14'),
(3, 'admin', '2021-10-27 04:43:14', '2021-10-27 04:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `jenjang` varchar(10) NOT NULL,
  `jurusan_id` int(11) DEFAULT NULL,
  `fakultas_id` int(11) DEFAULT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_activated` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nama_lengkap`, `password`, `jenjang`, `jurusan_id`, `fakultas_id`, `jenis_kelamin`, `nim`, `created_date`, `updated_at`, `is_activated`) VALUES
(8, '2010511133@mahasiswa.upnvj.ac.id', 'Rahmat Afriyanton', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511133', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(9, '2010511129@mahasiswa.upnvj.ac.id', 'Dafa Rabbani', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511129', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(10, '2010511200@mahasiswa.upnvj.ac.id', 'Dimas', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511200', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(11, '2010511201@mahasiswa.upnvj.ac.id', 'Zaki', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511201', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(12, '2010511202@mahasiswa.upnvj.ac.id', 'Budi', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511202', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(13, '2010511203@mahasiswa.upnvj.ac.id', 'Glyn Needham', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511203', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(14, '2010511204@mahasiswa.upnvj.ac.id', 'Weronika Blair', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511204', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(15, '2010511205@mahasiswa.upnvj.ac.id', 'Larry Lister', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511205', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(16, '2010511206@mahasiswa.upnvj.ac.id', 'Hector Stephens', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511206', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(17, '2010511207@mahasiswa.upnvj.ac.id', 'acques Singleton', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511207', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(18, '2010511300@mahasiswa.upnvj.ac.id', 'Dean Higgins', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511300', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(19, '2010511301@mahasiswa.upnvj.ac.id', 'Reuben Villalobos', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511301', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(20, '2010511302@mahasiswa.upnvj.ac.id', 'Bilaal Shaw', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511202', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(21, '2010511303@mahasiswa.upnvj.ac.id', 'Tasmin Davies', '23fb875c0054673f6de4f28d964d464a', 'S1', 18, 4, 'Laki-Laki', '2010511203', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(22, '2010511304@mahasiswa.upnvj.ac.id', 'Lleyton Turner', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511304', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(23, '2010511305@mahasiswa.upnvj.ac.id', 'Kimberly Tang', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511305', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(24, '2010511306@mahasiswa.upnvj.ac.id', 'Natasha O\'Moore', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511306', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1),
(25, '2010511307@mahasiswa.upnvj.ac.id', 'Arian Gardiner', '23fb875c0054673f6de4f28d964d464a', 'S1', 4, 1, 'Laki-Laki', '2010511307', '2021-11-26 07:37:36', '2021-11-26 01:38:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`created_at`, `updated_at`, `role_id`, `user_id`) VALUES
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 8),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 9),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 10),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 11),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 12),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 13),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 14),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 15),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 16),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 17),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 18),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 19),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 20),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 21),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 22),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 23),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 24),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 1, 25),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 2, 8),
('2021-11-26 07:38:21', '2021-11-26 07:38:21', 3, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_pemilihan`
--
ALTER TABLE `hasil_pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pemilihan`
--
ALTER TABLE `master_pemilihan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pemilihan_pemilih`
--
ALTER TABLE `master_pemilihan_pemilih`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pemilihan_peserta`
--
ALTER TABLE `master_pemilihan_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pemilihan_visi_misi`
--
ALTER TABLE `master_pemilihan_visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ormawa`
--
ALTER TABLE `ormawa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `userId` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fakultas`
--
ALTER TABLE `fakultas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hasil_pemilihan`
--
ALTER TABLE `hasil_pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_pemilihan`
--
ALTER TABLE `master_pemilihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `master_pemilihan_pemilih`
--
ALTER TABLE `master_pemilihan_pemilih`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `master_pemilihan_peserta`
--
ALTER TABLE `master_pemilihan_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `master_pemilihan_visi_misi`
--
ALTER TABLE `master_pemilihan_visi_misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ormawa`
--
ALTER TABLE `ormawa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
