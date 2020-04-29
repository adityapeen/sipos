-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 06:51 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipos`
--

-- --------------------------------------------------------

--
-- Table structure for table `beritaacara`
--

CREATE TABLE `beritaacara` (
  `idacara` int(11) NOT NULL,
  `tglacara` date NOT NULL,
  `idposyandu` int(11) NOT NULL,
  `judul` varchar(128) DEFAULT NULL,
  `pemateri` varchar(32) DEFAULT NULL,
  `notulen` varchar(32) NOT NULL,
  `catatan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beritaacara`
--

INSERT INTO `beritaacara` (`idacara`, `tglacara`, `idposyandu`, `judul`, `pemateri`, `notulen`, `catatan`) VALUES
(1, '2019-12-05', 1, 'Posyandu Bulan Desember', NULL, '3403010505980001', NULL),
(2, '2020-01-05', 1, 'Posyandu Bulan Januari', NULL, '3403010505980001', NULL),
(3, '2020-02-05', 1, 'Posyandu Bulan Februari', NULL, '3403010505980001', NULL),
(22, '2020-03-04', 1, 'Maret 2020', NULL, '3403010505980001', NULL),
(23, '2020-04-05', 1, 'April', NULL, '3403010505980001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `nik` varchar(32) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `kelamin` enum('L','P') NOT NULL,
  `tempatlahir` int(11) DEFAULT NULL,
  `tgllahir` date NOT NULL,
  `alamat` text DEFAULT NULL,
  `pekerjaan` varchar(32) DEFAULT NULL,
  `agama` enum('Islam','Kristen','Katolik','Hindu','Buddha','Kong Hu Cu') NOT NULL,
  `ibu` varchar(32) DEFAULT NULL,
  `ayah` varchar(32) DEFAULT NULL,
  `idposyandu` int(11) NOT NULL,
  `kms` tinyint(1) DEFAULT NULL,
  `statusbantuan` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`nik`, `nama`, `kelamin`, `tempatlahir`, `tgllahir`, `alamat`, `pekerjaan`, `agama`, `ibu`, `ayah`, `idposyandu`, `kms`, `statusbantuan`) VALUES
('3403010105720002', 'Sri Mulyani Murni Astuti', 'P', 3, '1972-05-01', 'Kemorosari II, RT08/RW07', 'PNS', 'Islam', '3403010105720002', '3403011009670001', 2, 0, 'Tidak Ada'),
('3403010505980001', 'Aditya Pratama Nugraha', 'L', 3, '1998-05-05', 'Kemorosari II, RT08, RW07', 'Mahasiswa', 'Islam', NULL, NULL, 2, 0, 'Tidak Ada'),
('3403011', 'Rara', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403011009670001', 'Suwanta', 'L', 5, '1967-09-10', 'Kemorosari II, RT08/RW07', 'PNS', 'Islam', NULL, NULL, 2, 0, 'Tidak Ada'),
('3403011303980001', 'Dini Mutiasari', 'P', NULL, '1998-03-13', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403012', 'Agus Nugroho', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 1, ''),
('34030121', 'Jack Daniel Marvelio', 'L', 5, '2015-03-11', '', '', 'Islam', '3403011', '3403012', 1, 1, 'KIN'),
('34030122', 'Izza Anisa Azahra', 'P', 5, '2015-03-19', '', '', 'Islam', '3403013', '3403014', 1, 1, 'KIN'),
('34030123', 'Adzkia Fatih Kanaya', 'P', 5, '2015-03-28', '', '', 'Islam', '3403015', '3403016', 1, 1, 'KIN'),
('34030124', 'Samuel Jundia Rahma', 'L', 5, '2015-08-24', '', '', 'Islam', '3403017', '3403018', 1, 1, 'NON'),
('3403012406000001', 'Rohmad Fajarudin', 'L', NULL, '2000-06-24', '', 'Mahasiswa', 'Islam', NULL, NULL, 2, 1, ''),
('34030125', 'Charisa Alfahira', 'P', 5, '2015-09-15', '', '', 'Islam', '3403019', '3403020', 1, 1, 'KIN'),
('34030126', 'Septia Arleta', 'P', 5, '2015-09-21', '', '', 'Islam', '3403021', '3403022', 1, 1, 'KIN'),
('34030127', 'Shabrina Zahra Fauziah', 'P', 5, '2015-11-07', '', '', 'Islam', '3403023', '3403024', 1, 1, 'KIN'),
('34030128', 'Raesha Fella Naora', 'P', 5, '2016-01-20', '', '', 'Islam', '3403025', '3403026', 1, 1, 'KIN'),
('3403012811030002', 'Anisa Rizqi Utami', 'P', NULL, '2003-11-28', '', 'Pelajar', 'Islam', NULL, NULL, 2, 1, ''),
('34030129', 'Brian Bagus Zulfikar', 'L', 5, '2016-02-04', '', '', 'Islam', '3403027', '3403028', 1, 1, 'KIN'),
('3403013', 'Hartini', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('34030130', 'Arjuna Nizam', 'L', 5, '2016-03-28', '', '', 'Islam', '3403029', '3403030', 1, 1, 'KIN'),
('34030131', 'Sarah Amelia', 'P', 5, '2016-07-24', '', '', 'Islam', '3403031', '3403032', 1, 1, 'KIN'),
('34030132', 'Alingga Nur Eviyan', 'L', 5, '2016-09-16', '', '', 'Islam', '3403033', '3403034', 1, 1, 'KIN'),
('34030133', 'Geisha Adelia', 'P', 5, '2016-09-21', '', '', 'Islam', '3403035', '3403036', 1, 1, 'KIN'),
('34030134', 'Nadya Asifa Nugraha', 'P', 5, '2017-01-09', '', '', 'Islam', '3403037', '3403038', 1, 1, 'KIN'),
('34030135', 'Luthfi Sakhi Zaidan Ukail', 'L', 5, '2017-02-05', '', '', 'Islam', '3403039', '3403040', 1, 1, 'KIN'),
('34030136', 'Fatan Nur Khalim', 'L', 5, '2017-04-01', '', '', 'Islam', '3403041', '3403042', 1, 1, 'KIN'),
('34030137', 'Baihaqi Hanan Fatih', 'L', 5, '2017-04-24', '', '', 'Islam', '3403043', '3403044', 1, 1, 'KIN'),
('34030138', 'Rifky Mahesa', 'L', 5, '2017-05-20', '', '', 'Islam', '3403045', '3403046', 1, 1, 'KIN'),
('34030139', 'Nada Ainun Mahya', 'P', 5, '2017-07-22', '', '', 'Islam', '3403047', '3403048', 1, 1, 'KIN'),
('3403014', 'Sugiman', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('34030140', 'Anindya Inara Larasati', 'P', 5, '2017-08-24', '', '', 'Islam', '3403049', '3403050', 1, 1, 'KIN'),
('34030141', 'Muhammad Adnan Habibi', 'L', 5, '2017-09-18', '', '', 'Islam', '3403051', '3403052', 1, 1, 'KIN'),
('34030142', 'Nabilla Adellya Hidayat', 'P', 5, '2017-09-26', '', '', 'Islam', '3403053', '3403054', 1, 1, 'KIN'),
('34030143', 'Aqila Putri Asyfa', 'P', 5, '2017-10-07', '', '', 'Islam', '3403055', '3403056', 1, 1, 'KIN'),
('34030144', 'Aqila Mashell Rafaila', 'P', 5, '2017-10-16', '', '', 'Islam', '3403057', '3403058', 1, 1, 'KIN'),
('34030145', 'Sakila Ayudia Inara', 'P', 5, '2017-11-13', '', '', 'Islam', '3403059', '3403060', 1, 1, 'KIN'),
('34030146', 'Hafizh Muazzam Al Ghifari', 'L', 5, '2017-11-30', '', '', 'Islam', '3403061', '3403062', 1, 1, 'KIN'),
('34030147', 'Riko', 'L', 5, '2018-02-08', '', '', 'Islam', '3403063', NULL, 1, 1, 'KIN'),
('34030148', 'Al Khalifi Naufal Z', 'L', 5, '2018-04-10', '', '', 'Islam', '3403065', '3403066', 1, 1, 'KIN'),
('34030149', 'Maula Riski Saputra', 'L', 5, '2018-05-13', '', '', 'Islam', '3403067', '3403068', 1, 1, 'KIN'),
('3403015', 'Ika Nur', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('34030150', 'Alyya Hasna Karmila', 'P', 5, '2018-06-01', '', '', 'Islam', '3403069', '3403070', 1, 1, 'KIN'),
('34030151', 'Fauzi Zidan Al Majid', 'L', 5, '2018-07-21', '', '', 'Islam', '3403023', '3403024', 1, 1, 'KIN'),
('34030152', 'Brian Ragil Pamungkas', 'L', 5, '2018-07-26', 'RT 01', '', 'Islam', '3403071', '3403072', 1, 0, 'NON'),
('34030153', 'Qurota Arsyi Habibah', 'P', 5, '2018-11-01', '', '', 'Islam', '3403073', '3403074', 1, 1, 'KIN'),
('34030154', 'Al Fatah Iqbal Kustianto', 'L', 5, '2018-11-22', '', '', 'Islam', '3403075', '3403076', 1, 1, 'KIN'),
('34030155', 'Ragil Saputra', 'L', 5, '2019-02-04', '', '', 'Islam', '3403077', '3403078', 1, 0, 'KIN'),
('34030156', 'Fahima', 'P', 5, '2019-03-27', '', '', 'Islam', '3403079', NULL, 1, 1, 'KIN'),
('34030157', 'Azlan Zaidan', 'L', 5, '2019-04-21', '', '', 'Islam', '3403081', NULL, 1, 1, 'KIN'),
('34030158', 'Tri Haikal', 'L', 5, '2019-10-01', '', '', 'Islam', '3403083', NULL, 1, 1, 'KIN'),
('34030159', 'Alnayra', 'P', 5, '2019-12-03', '', '', 'Islam', '3403085', NULL, 1, 1, 'KIN'),
('3403016', 'Suroso', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403017', 'Yuliana', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403018', 'Purnomo', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403019', 'Anisa', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403020', 'Suseno', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403021', 'Priskila', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403022', 'Suratno', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403023', 'Alfi', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403024', 'Sumarno', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403025', 'Sutarmi', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403026', 'Sugeng', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403027', 'Etika', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403028', 'Yusuf S', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403029', 'Amin R', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403030', 'Sutrisno', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403031', 'Wijiyati', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403032', 'Rebo', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403033', 'Evi', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403034', 'Nugroho', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403035', 'Diah Widyastuti', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403036', 'Muh Arifin', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403037', 'Yahmini', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403038', 'Agung', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403039', 'Istrianti', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403040', 'Tri Haryanto', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403041', 'Mariam', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403042', 'Murwanto', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403043', 'Nur Rokhani', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403044', 'Ersanto', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403045', 'Tentrem', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403046', 'Heriyanto', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403047', 'Dewik Astuti', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403048', 'Maryadi', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403049', 'Listianawati', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403050', 'Doni Fitr', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403051', 'Erna Suparti', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403052', 'Suyono', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403053', 'Kotimah', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403054', 'Nanang H', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403055', 'Desi Anjarwati', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403056', 'Handi', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403057', 'Sri S', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403058', 'Setiyo Utomo', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403059', 'Jelita', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403060', 'Suyadi', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403061', 'Rustiani', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403062', 'Suwarno', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403063', 'Eka S', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403065', 'Sri', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403066', 'Widodo', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403067', 'Rusti', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403068', 'Mugina', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403069', 'Elis', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403070', 'Totok', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403071', 'Emini', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403072', 'Sugiyono', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403073', 'Eni Rahmawati', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403074', 'Sugiyo', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403075', 'Ika', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403076', 'Suroso', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403077', 'Murtini', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403078', 'Subardi', 'L', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403079', 'Awalina', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403081', 'Khotimah', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403083', 'Wasikem', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, ''),
('3403085', 'Sri Mulyani', 'P', NULL, '1985-03-03', '', '', 'Islam', NULL, NULL, 1, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pengukuran`
--

CREATE TABLE `pengukuran` (
  `idpengukuran` int(11) NOT NULL,
  `idacara` int(11) NOT NULL,
  `idpetugas` varchar(32) NOT NULL,
  `nik` varchar(32) NOT NULL,
  `berat` decimal(4,2) NOT NULL,
  `tinggi` decimal(4,1) DEFAULT NULL,
  `kepala` decimal(4,1) DEFAULT NULL,
  `keterangan` varchar(12) DEFAULT NULL,
  `asi` tinyint(1) DEFAULT NULL,
  `vitamina` tinyint(1) DEFAULT NULL,
  `beratumur` int(11) DEFAULT NULL,
  `tinggiumur` int(11) DEFAULT NULL,
  `berattinggi` int(11) DEFAULT NULL,
  `statusbantuan` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengukuran`
--

INSERT INTO `pengukuran` (`idpengukuran`, `idacara`, `idpetugas`, `nik`, `berat`, `tinggi`, `kepala`, `keterangan`, `asi`, `vitamina`, `beratumur`, `tinggiumur`, `berattinggi`, `statusbantuan`) VALUES
(30, 1, '3403010505980001', '34030157', '8.20', '70.0', '45.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(31, 1, '3403010505980001', '34030155', '6.80', '67.0', '43.5', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(32, 1, '3403010505980001', '34030158', '5.70', '57.0', '38.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(33, 2, '3403010505980001', '34030159', '4.70', NULL, NULL, 'B', 0, 0, NULL, NULL, NULL, 'KIN'),
(34, 2, '3403010505980001', '34030157', '9.20', '70.1', NULL, '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(35, 2, '3403010505980001', '34030156', '9.20', '68.4', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(36, 2, '3403010505980001', '34030158', '6.30', '59.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(37, 2, '3403010505980001', '34030155', '7.30', NULL, NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(38, 3, '3403010505980001', '34030159', '5.20', '88.4', '48.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(39, 3, '3403010505980001', '34030156', '9.00', '73.0', '44.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(40, 3, '3403010505980001', '34030155', '7.20', '69.0', '45.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(41, 3, '3403010505980001', '34030157', '8.40', '73.0', '47.0', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(42, 3, '3403010505980001', '34030158', '6.70', '61.8', '42.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(44, 1, '3403010505980001', '34030153', '8.90', '77.0', '47.0', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(45, 1, '3403010505980001', '34030151', '10.00', '74.5', '46.5', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(46, 1, '3403010505980001', '34030148', '11.70', '79.5', '47.5', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(47, 1, '3403010505980001', '34030150', '10.10', '76.0', '49.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(48, 1, '3403010505980001', '34030149', '10.10', '78.0', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(49, 2, '3403010505980001', '34030148', '11.70', '79.5', NULL, '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(50, 2, '3403010505980001', '34030151', '10.20', '76.1', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(51, 2, '3403010505980001', '34030147', '11.70', '81.2', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(52, 2, '3403010505980001', '34030152', '11.80', '75.5', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(53, 2, '3403010505980001', '34030154', '9.40', NULL, NULL, '', 0, 0, NULL, NULL, NULL, 'KIN'),
(54, 2, '3403010505980001', '34030150', '10.70', '76.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(55, 2, '3403010505980001', '34030149', '10.50', '80.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(56, 2, '3403010505980001', '34030153', '8.70', '77.0', NULL, 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(57, 3, '3403010505980001', '34030153', '8.70', '74.4', '47.0', '2T', 0, 0, NULL, NULL, NULL, 'NON'),
(58, 3, '3403010505980001', '34030150', '9.80', '78.3', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(59, 3, '3403010505980001', '34030151', '9.50', '78.2', '47.5', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(60, 3, '3403010505980001', '34030148', '11.20', '82.5', '47.5', '2T', 0, 0, NULL, NULL, NULL, 'NON'),
(61, 3, '3403010505980001', '34030149', '10.30', '72.0', '47.5', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(62, 3, '3403010505980001', '34030154', '9.20', '75.0', '47.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(63, 3, '3403010505980001', '34030152', '10.90', '77.5', '49.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(64, 3, '3403010505980001', '34030150', '9.80', '78.3', '48.0', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(65, 1, '3403010505980001', '34030141', '14.40', '88.0', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(66, 1, '3403010505980001', '34030134', '14.20', '90.0', '49.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(67, 1, '3403010505980001', '34030138', '12.10', '89.0', NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(68, 1, '3403010505980001', '34030143', '14.20', '89.3', '48.5', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(69, 1, '3403010505980001', '34030136', '13.90', '88.0', '49.5', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(70, 1, '3403010505980001', '34030140', '12.60', '86.0', '47.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(71, 1, '3403010505980001', '34030146', '9.70', '78.0', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(72, 1, '3403010505980001', '34030142', '13.70', '88.0', '50.0', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(73, 1, '3403010505980001', '34030137', '11.50', '86.0', '48.0', 'O', 0, 0, NULL, NULL, NULL, 'KIN'),
(74, 2, '3403010505980001', '34030142', '14.20', '89.9', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(75, 2, '3403010505980001', '34030134', '14.50', '90.9', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(76, 2, '3403010505980001', '34030143', '13.80', '89.0', NULL, 'O', 0, 0, NULL, NULL, NULL, 'KIN'),
(77, 2, '3403010505980001', '34030140', '13.00', '89.9', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(78, 2, '3403010505980001', '34030139', '11.40', '86.1', NULL, 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(79, 2, '3403010505980001', '34030141', '13.70', '88.2', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(80, 2, '3403010505980001', '34030146', '10.00', '78.6', NULL, '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(81, 2, '3403010505980001', '34030136', '14.20', '88.2', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(82, 2, '3403010505980001', '34030138', '12.70', '88.2', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(83, 3, '3403010505980001', '34030145', '10.90', '84.5', '49.0', 'O', 0, 0, NULL, NULL, NULL, 'KIN'),
(84, 3, '3403010505980001', '34030146', '10.00', '78.8', '48.9', 'O', 0, 0, NULL, NULL, NULL, 'KIN'),
(85, 3, '3403010505980001', '34030136', '13.70', '88.0', '50.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(86, 3, '3403010505980001', '34030138', '12.20', '88.2', '51.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(87, 3, '3403010505980001', '34030141', '13.20', '85.5', '50.0', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(88, 3, '3403010505980001', '34030137', '11.30', '86.0', '48.0', 'O', 0, 0, NULL, NULL, NULL, 'KIN'),
(89, 3, '3403010505980001', '34030134', '14.30', '89.4', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(90, 3, '3403010505980001', '34030143', '13.70', '87.0', '48.0', '2T', 0, 0, NULL, NULL, NULL, 'KIN'),
(91, 3, '3403010505980001', '34030142', '13.60', '88.0', '50.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(92, 3, '3403010505980001', '34030139', '11.20', '83.0', '48.0', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(93, 1, '3403010505980001', '34030127', '13.30', '97.0', NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(94, 1, '3403010505980001', '34030130', '15.40', '101.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(95, 1, '3403010505980001', '34030135', '14.10', '94.0', NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(96, 1, '3403010505980001', '34030132', '13.10', '91.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(97, 1, '3403010505980001', '34030128', '14.30', '95.5', NULL, '2T', 0, 0, NULL, NULL, NULL, 'NON'),
(98, 1, '3403010505980001', '34030131', '12.50', '90.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(99, 1, '3403010505980001', '34030123', '15.70', '105.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(100, 2, '3403010505980001', '34030127', '14.00', '93.3', '48.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(101, 2, '3403010505980001', '34030131', '12.80', '90.0', '51.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(102, 2, '3403010505980001', '34030132', '12.50', '94.0', '48.5', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(103, 2, '3403010505980001', '34030130', '15.10', '96.0', '49.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(104, 2, '3403010505980001', '34030135', '15.20', '94.0', '50.0', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(105, 3, '3403010505980001', '34030131', '13.20', '90.1', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(106, 3, '3403010505980001', '34030132', '12.70', '94.0', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(107, 3, '3403010505980001', '34030135', '15.00', '96.6', NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(108, 1, '3403010505980001', '34030122', '15.20', '98.0', '50.5', 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(109, 1, '3403010505980001', '34030125', '18.90', '106.0', '50.0', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(110, 1, '3403010505980001', '34030126', '13.90', '99.0', '46.5', 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(111, 1, '3403010505980001', '34030121', '21.00', '111.0', '52.0', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(112, 2, '3403010505980001', '34030127', '14.10', '93.5', NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(113, 2, '3403010505980001', '34030125', '18.70', '106.7', NULL, 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(114, 2, '3403010505980001', '34030123', '15.50', NULL, NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(115, 2, '3403010505980001', '34030122', '14.60', '99.2', NULL, 'T', 0, 0, NULL, NULL, NULL, 'KIN'),
(116, 2, '3403010505980001', '34030121', '21.00', '112.7', NULL, '2T', 0, 0, NULL, NULL, NULL, 'NON'),
(117, 2, '3403010505980001', '34030128', '14.70', NULL, NULL, 'N', 0, 0, NULL, NULL, NULL, 'KIN'),
(118, 2, '3403010505980001', '34030126', '14.00', NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, 'NON'),
(119, 3, '3403010505980001', '34030135', '14.90', NULL, '50.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(120, 3, '3403010505980001', '34030130', '14.60', '95.2', '50.0', 'O', 0, 0, NULL, NULL, NULL, 'NON'),
(121, 3, '3403010505980001', '34030126', '13.50', '98.0', '47.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(122, 3, '3403010505980001', '34030122', '14.50', '96.6', '50.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(123, 3, '3403010505980001', '34030127', '13.70', '91.7', '49.0', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(124, 3, '3403010505980001', '34030123', '15.30', '105.0', '50.5', 'T', 0, 0, NULL, NULL, NULL, 'NON'),
(125, 3, '3403010505980001', '34030131', '13.00', '90.5', '50.0', 'O', 0, 0, NULL, NULL, NULL, 'NON'),
(126, 3, '3403010505980001', '34030132', '12.80', '92.0', '50.0', 'O', 0, 0, NULL, NULL, NULL, 'NON'),
(127, 3, '3403010505980001', '34030121', '21.20', '111.0', '53.0', 'N', 0, 0, NULL, NULL, NULL, 'NON'),
(129, 22, '34030130', '34030130', '16.50', NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, NULL),
(130, 23, '3403010505980001', '34030130', '16.70', NULL, NULL, 'N', 0, 1, NULL, NULL, NULL, 'KIN'),
(131, 23, '3403010505980001', '34030134', '14.70', '0.0', '0.0', 'O', 0, 1, NULL, NULL, NULL, 'KIN');

-- --------------------------------------------------------

--
-- Table structure for table `tbdesa`
--

CREATE TABLE `tbdesa` (
  `iddesa` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `idkec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbdesa`
--

INSERT INTO `tbdesa` (`iddesa`, `nama`, `idkec`) VALUES
(1, 'Hargomulyo', 18),
(2, 'Mertelu', 18),
(3, 'Ngalang', 18),
(4, 'Sampang', 18),
(5, 'Serut', 18),
(6, 'Tegalrejo', 18),
(7, 'Watugajah', 18),
(8, 'Wonosari', 1),
(9, 'Baleharjo', 1),
(10, 'Kepek', 1),
(11, 'Piyaman', 1),
(12, 'Pulutan', 1),
(13, 'Selang', 1),
(14, 'Gari', 1),
(15, 'Karangtengah', 1),
(16, 'Karangrejek', 1),
(17, 'Siraman', 1),
(18, 'Wunung', 1),
(19, 'Mulo', 1),
(20, 'Duwet', 1),
(21, 'Wareng', 1),
(22, 'Giring', 13),
(23, 'Bogor', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbkabupaten`
--

CREATE TABLE `tbkabupaten` (
  `idkab` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `idprov` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkabupaten`
--

INSERT INTO `tbkabupaten` (`idkab`, `nama`, `idprov`) VALUES
(1, 'Kota Yogyakarta', 1),
(2, 'Sleman', 1),
(3, 'Bantul', 1),
(4, 'Kulonprogo', 1),
(5, 'Gunungkidul', 1),
(6, 'Magelang', 2),
(7, 'Wonogiri', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbkecamatan`
--

CREATE TABLE `tbkecamatan` (
  `idkec` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `idkab` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkecamatan`
--

INSERT INTO `tbkecamatan` (`idkec`, `nama`, `idkab`) VALUES
(1, 'Wonosari', 5),
(2, 'Tepus', 5),
(3, 'Tanjungsari', 5),
(4, 'Semin', 5),
(5, 'Semanu', 5),
(6, 'Saptosari', 5),
(7, 'Rongkop', 5),
(8, 'Purwosari', 5),
(9, 'Ponjong', 5),
(10, 'Playen', 5),
(11, 'Patuk', 5),
(12, 'Panggang', 5),
(13, 'Paliyan', 5),
(14, 'Nglipar', 5),
(15, 'Ngawen', 5),
(16, 'Karangmojo', 5),
(17, 'Girisubo', 5),
(18, 'Gedangsari', 5),
(19, 'Mungkid', 6),
(20, 'Srumbung', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbposyandu`
--

CREATE TABLE `tbposyandu` (
  `idposyandu` int(11) NOT NULL,
  `namaposyandu` varchar(32) NOT NULL,
  `dusun` varchar(32) NOT NULL,
  `iddesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbposyandu`
--

INSERT INTO `tbposyandu` (`idposyandu`, `namaposyandu`, `dusun`, `iddesa`) VALUES
(1, 'Posyandu Melati', 'Jetis', 1),
(2, 'Posyandu Mawar', 'Kemorosari II', 11),
(3, 'Posyandu Anggrek', 'Kepek', 10),
(6, 'Posyandu Dahlia', 'Gedangan', 1),
(7, 'Posyandu Kenanga', 'Bulu', 1),
(8, 'Posyandu Kamboja', 'Balong', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbprovinsi`
--

CREATE TABLE `tbprovinsi` (
  `idprov` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbprovinsi`
--

INSERT INTO `tbprovinsi` (`idprov`, `nama`) VALUES
(1, 'D.I.Yogyakarta'),
(2, 'Jawa Tengah');

-- --------------------------------------------------------

--
-- Table structure for table `tbpuskesmas`
--

CREATE TABLE `tbpuskesmas` (
  `idpuskesmas` int(11) NOT NULL,
  `namapuskesmas` varchar(32) NOT NULL,
  `idkec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpuskesmas`
--

INSERT INTO `tbpuskesmas` (`idpuskesmas`, `namapuskesmas`, `idkec`) VALUES
(1, 'Puskesmas Gedangsari I', 18),
(2, 'Puskesmas Wonosari', 1),
(3, 'Puskesmas Nglipar', 14);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `aktif` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `nik` varchar(32) DEFAULT NULL,
  `unitkerja` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `aktif`, `date_created`, `username`, `nik`, `unitkerja`) VALUES
(13, 'Aditya Pratama Nugraha', 'aditya@yahoo.com', 'default.jpg', '21232f297a57a5a743894a0e4a801fc3', 2, 0, 1581209365, 'adit', '', 0),
(14, 'Aditya Pratama Nugraha', 'super@admin.com', 'default.jpg', '$2y$10$llBg6uoqHUAID148mQH6pe6Y8WCPuWWUxvy.X8Yhdtuwbrsbp/OGm', 1, 1, 1581209624, 'admin', '3403010505980001', 1),
(15, 'Aditya Pratama Nugraha', 'adityapeen@yahoo.com', 'default.jpg', '$2y$10$ELzl1ZAaKRKTta.k2rMKzOoyH1StHDdfsW1vamXNjBsfXKFj.Fbfm', 2, 0, 1581325620, '', '', 0),
(16, 'Administrator', 'root@admin.com', 'default.jpg', '$2y$10$qbV9bYWXZVybGa6OhF/Y2.9Gbe8Oce6BD8UTgcE497VP5fh1XgztO', 2, 0, 1581325803, 'root', '', 0),
(19, 'Dini Mutiasari', 'dini@mail.com', 'default.jpg', '$2y$10$UKe8L/aXO5vaT5jn7MMbW.lSsOpWqBfUTLeWFv1bk/oPxb3TghJy2', 2, 1, 1581753481, 'dini', '3403011303980001', 1),
(20, 'Dewik Astuti', NULL, 'default.jpg', '$2y$10$dEogPc.XolEkCPNmzPX80OPyqdkRBX.ST5TArD/7FYFcXVbHaHPIC', 3, 1, 1586015589, 'dewik', '3403047', 1),
(23, 'Maryadi', NULL, 'default.jpg', '$2y$10$3RQwZSnllE3lgD1eDNZOa.mamqu9lk9es64mZ.aXr7gko2FtWIeT.', 3, 1, 1586015937, 'maryadi', '3403048', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 2, 2),
(6, 2, 3),
(8, 3, 3),
(12, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'MASTER'),
(2, 'PUSKESMAS'),
(3, 'POSYANDU'),
(4, 'PENDUDUK');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Puskesmas'),
(3, 'Kader'),
(4, 'Ortu');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `url` varchar(64) NOT NULL,
  `icon` varchar(32) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Daerah', 'admin/daerah', 'fas fa-fw fa-globe-asia', 1),
(2, 1, 'Posyandu', 'admin/posyandu', 'fas fa-fw fa-stethoscope', 1),
(3, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-cog', 1),
(4, 3, 'Berita Acara', 'posyandu/acara', 'fas fa-fw fa-calendar-check', 1),
(5, 3, 'Pengukuran', 'posyandu/pengukuran', 'fas fa-fw fa-ruler-combined', 1),
(6, 3, 'Peserta', 'posyandu/peserta', 'fas fa-child', 1),
(7, 2, 'Buat Akun', 'user/adduser', 'fas fa-fw fa-user', 0),
(8, 2, 'Kelola User', 'puskesmas/userlist', 'fas fa-fw fa-table', 1),
(9, 4, 'Data Penduduk', 'user/penduduk', 'fas fa-address-card', 1),
(10, 4, 'Tambah Penduduk', 'user/tambahpenduduk', 'fas fa-user-edit', 0),
(11, 3, 'Rekap Data', 'posyandu/rekap', 'fas fa-fw fa-chart-bar', 1),
(14, 1, 'User', 'admin/userlist', 'fas fa-fw fa-user', 1),
(15, 2, 'Posyandu', 'puskesmas/posyandu', 'fas fa-fw fa-first-aid', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beritaacara`
--
ALTER TABLE `beritaacara`
  ADD PRIMARY KEY (`idacara`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `tempatlahir` (`tempatlahir`),
  ADD KEY `idposyandu` (`idposyandu`),
  ADD KEY `ibu` (`ibu`),
  ADD KEY `ayah` (`ayah`);

--
-- Indexes for table `pengukuran`
--
ALTER TABLE `pengukuran`
  ADD PRIMARY KEY (`idpengukuran`);

--
-- Indexes for table `tbdesa`
--
ALTER TABLE `tbdesa`
  ADD PRIMARY KEY (`iddesa`),
  ADD KEY `idkec` (`idkec`);

--
-- Indexes for table `tbkabupaten`
--
ALTER TABLE `tbkabupaten`
  ADD PRIMARY KEY (`idkab`),
  ADD KEY `idprov` (`idprov`);

--
-- Indexes for table `tbkecamatan`
--
ALTER TABLE `tbkecamatan`
  ADD PRIMARY KEY (`idkec`),
  ADD KEY `idkab` (`idkab`);

--
-- Indexes for table `tbposyandu`
--
ALTER TABLE `tbposyandu`
  ADD PRIMARY KEY (`idposyandu`),
  ADD KEY `iddesa` (`iddesa`);

--
-- Indexes for table `tbprovinsi`
--
ALTER TABLE `tbprovinsi`
  ADD PRIMARY KEY (`idprov`);

--
-- Indexes for table `tbpuskesmas`
--
ALTER TABLE `tbpuskesmas`
  ADD PRIMARY KEY (`idpuskesmas`),
  ADD KEY `idkecamatan` (`idkec`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beritaacara`
--
ALTER TABLE `beritaacara`
  MODIFY `idacara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pengukuran`
--
ALTER TABLE `pengukuran`
  MODIFY `idpengukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `tbdesa`
--
ALTER TABLE `tbdesa`
  MODIFY `iddesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbkabupaten`
--
ALTER TABLE `tbkabupaten`
  MODIFY `idkab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbkecamatan`
--
ALTER TABLE `tbkecamatan`
  MODIFY `idkec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbposyandu`
--
ALTER TABLE `tbposyandu`
  MODIFY `idposyandu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbprovinsi`
--
ALTER TABLE `tbprovinsi`
  MODIFY `idprov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbpuskesmas`
--
ALTER TABLE `tbpuskesmas`
  MODIFY `idpuskesmas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`tempatlahir`) REFERENCES `tbkabupaten` (`idkab`),
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`idposyandu`) REFERENCES `tbposyandu` (`idposyandu`),
  ADD CONSTRAINT `penduduk_ibfk_3` FOREIGN KEY (`ibu`) REFERENCES `penduduk` (`nik`),
  ADD CONSTRAINT `penduduk_ibfk_4` FOREIGN KEY (`ayah`) REFERENCES `penduduk` (`nik`);

--
-- Constraints for table `tbdesa`
--
ALTER TABLE `tbdesa`
  ADD CONSTRAINT `tbdesa_ibfk_1` FOREIGN KEY (`idkec`) REFERENCES `tbkecamatan` (`idkec`);

--
-- Constraints for table `tbkabupaten`
--
ALTER TABLE `tbkabupaten`
  ADD CONSTRAINT `tbkabupaten_ibfk_1` FOREIGN KEY (`idprov`) REFERENCES `tbprovinsi` (`idprov`);

--
-- Constraints for table `tbkecamatan`
--
ALTER TABLE `tbkecamatan`
  ADD CONSTRAINT `tbkecamatan_ibfk_1` FOREIGN KEY (`idkab`) REFERENCES `tbkabupaten` (`idkab`);

--
-- Constraints for table `tbposyandu`
--
ALTER TABLE `tbposyandu`
  ADD CONSTRAINT `tbposyandu_ibfk_1` FOREIGN KEY (`iddesa`) REFERENCES `tbdesa` (`iddesa`);

--
-- Constraints for table `tbpuskesmas`
--
ALTER TABLE `tbpuskesmas`
  ADD CONSTRAINT `tbpuskesmas_ibfk_1` FOREIGN KEY (`idkec`) REFERENCES `tbkecamatan` (`idkec`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `user_sub_menu_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `user_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
