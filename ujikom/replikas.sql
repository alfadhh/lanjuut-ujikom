-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 11:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `replikas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'aliif', 'alip', 'anjaskeles'),
(2, 'testing', 'tes', 'b62594a2d24593a88f850f9dbe29dc90');

-- --------------------------------------------------------

--
-- Table structure for table `kandidat`
--

CREATE TABLE `kandidat` (
  `id_kandidat` int(5) NOT NULL,
  `nis` int(8) NOT NULL,
  `nama_calon` varchar(25) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `foto` varchar(55) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `id_kk` int(5) NOT NULL,
  `jumlah_suara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nis`, `nama_calon`, `kelas`, `foto`, `visi`, `misi`, `id_kk`, `jumlah_suara`) VALUES
(1, 10212871, 'Aliif Fadhilah', 'XII RPL 1', '', 'ini adalah visi saya', 'ini misi yang harus di jalankan', 1, 5),
(17, 10212869, 'reffa', 'XII RPL 1', '', 'ini adalah visi', 'ini adalah misi', 1, 1),
(59, 123123, 'azfa', 'asdads', 'uploads/1.jpg', 'adad', 'asdasd', 1, 0),
(60, 123, 'asd', 'asda', 'uploads/2.jpg', 'asdasd', 'asdasd', 1, 2),
(61, 123, 'asd', 'asdasd', 'uploads/4.jpg', 'asdasdasd', 'asdasdasd', 3, 1),
(62, 1231, '12321', '123', 'uploads/ella.jpg', 'asdasd', 'asda', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi_keahlian`
--

CREATE TABLE `konsentrasi_keahlian` (
  `id_kk` int(5) NOT NULL,
  `nama_kk` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsentrasi_keahlian`
--

INSERT INTO `konsentrasi_keahlian` (`id_kk`, `nama_kk`) VALUES
(1, 'Programmer'),
(2, 'Design'),
(3, 'Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `panitia`
--

CREATE TABLE `panitia` (
  `id_panitia` int(5) NOT NULL,
  `nama_panitia` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','panitia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panitia`
--

INSERT INTO `panitia` (`id_panitia`, `nama_panitia`, `username`, `password`, `level`) VALUES
(1, 'bagus', 'bagus', '17b38fc02fd7e92f3edeb6318e3066d8', 'admin'),
(2, 'bagas', 'bagas', 'ee776a18253721efe8a62e4abd29dc47', 'panitia');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` int(5) NOT NULL,
  `nis` int(8) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `keterangan` enum('siswa aktif','alumni') NOT NULL,
  `id_kk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privilege` enum('admins','panitia','kandidat','pemilih') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privilege`) VALUES
(1, 'alip', 'b47ba2c8fc970e73e97c8c2a2ada890d', 'admins'),
(2, 'alpad', 'b47ba2c8fc970e73e97c8c2a2ada890d', 'panitia'),
(3, 'aliif', 'b47ba2c8fc970e73e97c8c2a2ada890d', 'kandidat'),
(4, 'reff', 'b47ba2c8fc970e73e97c8c2a2ada890d', 'pemilih');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indexes for table `konsentrasi_keahlian`
--
ALTER TABLE `konsentrasi_keahlian`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indexes for table `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id_panitia`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `konsentrasi_keahlian`
--
ALTER TABLE `konsentrasi_keahlian`
  MODIFY `id_kk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id_panitia` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id_pemilih` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
