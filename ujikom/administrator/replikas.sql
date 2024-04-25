-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Apr 2024 pada 09.49
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

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
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(5) NOT NULL,
  `nama_admin` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'aliif', 'alip', 'anjaskeles'),
(2, 'testing', 'tes', 'b62594a2d24593a88f850f9dbe29dc90');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kandidat`
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
-- Dumping data untuk tabel `kandidat`
--

INSERT INTO `kandidat` (`id_kandidat`, `nis`, `nama_calon`, `kelas`, `foto`, `visi`, `misi`, `id_kk`, `jumlah_suara`) VALUES
(1, 10212871, 'Aliif Fadhilah', 'XII RPL 1', '', 'ini adalah visi saya', 'ini misi yang harus di jalankan', 1, 4),
(17, 10212869, 'reffa', 'XII RPL 1', '', 'ini adalah visi', 'ini adalah misi', 1, 1),
(50, 10212869, 'tes', 'XII RPL 1', 'uploads/download.jpeg', 'ini adalah visi', 'ini adalah misi', 2, 1),
(53, 123213, 'tesdrive', 'XII RPL 2', 'uploads/download.jpeg', 'afsaf', 'af', 1, 1),
(54, 123213, 'tesdrive', 'XII RPL 2', 'uploads/download (1).jpeg', 'afsaf', 'af', 1, 1),
(55, 123213, 'ahmda', 'XII RPL 2', 'uploads/download.jpeg', 'ini adalah visi', 'af', 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsentrasi_keahlian`
--

CREATE TABLE `konsentrasi_keahlian` (
  `id_kk` int(5) NOT NULL,
  `nama_kk` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konsentrasi_keahlian`
--

INSERT INTO `konsentrasi_keahlian` (`id_kk`, `nama_kk`) VALUES
(1, 'Programmer'),
(2, 'Design'),
(3, 'Multimedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `panitia`
--

CREATE TABLE `panitia` (
  `id_panitia` int(5) NOT NULL,
  `nama_panitia` varchar(25) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('admin','panitia') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` int(5) NOT NULL,
  `nis` int(8) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `keterangan` enum('siswa aktif','alumni') NOT NULL,
  `id_kk` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  ADD PRIMARY KEY (`id_kandidat`);

--
-- Indeks untuk tabel `konsentrasi_keahlian`
--
ALTER TABLE `konsentrasi_keahlian`
  ADD PRIMARY KEY (`id_kk`);

--
-- Indeks untuk tabel `panitia`
--
ALTER TABLE `panitia`
  ADD PRIMARY KEY (`id_panitia`);

--
-- Indeks untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kandidat`
--
ALTER TABLE `kandidat`
  MODIFY `id_kandidat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `konsentrasi_keahlian`
--
ALTER TABLE `konsentrasi_keahlian`
  MODIFY `id_kk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `panitia`
--
ALTER TABLE `panitia`
  MODIFY `id_panitia` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id_pemilih` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
