-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15 Jun 2021 pada 07.26
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akses_petugas`
--

CREATE TABLE `akses_petugas` (
  `id_akses` int(30) NOT NULL,
  `nama_akses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `akses_petugas`
--

INSERT INTO `akses_petugas` (`id_akses`, `nama_akses`) VALUES
(1, 'Buku'),
(2, 'Penerbit'),
(3, 'Kategori'),
(4, 'Pengarang'),
(5, 'Peminjaman'),
(6, 'Pengembalian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(50) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `id_penerbit` int(50) NOT NULL,
  `id_pengarang` int(50) NOT NULL,
  `tahun_buku` int(30) NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `stock_buku` int(100) NOT NULL,
  `foto_buku` varchar(255) NOT NULL,
  `id_status_buku` int(10) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `id_penerbit`, `id_pengarang`, `tahun_buku`, `id_kategori`, `stock_buku`, `foto_buku`, `id_status_buku`, `deskripsi`) VALUES
(39, 'Pemograman PHP', 1, 1, 2020, 1, 0, 'php.png', 2, ''),
(40, 'Pemograman Web 1', 1, 1, 2020, 1, 0, 'web.jpg', 1, ''),
(41, 'Pemograman JAVA', 1, 1, 2020, 1, 4, 'java.jpeg', 1, ''),
(42, 'Tanaman Jagung', 2, 5, 2020, 6, 9, 'jagung.jpg', 1, ''),
(43, 'Kesehatan', 2, 5, 2020, 7, 9, 'kesehatan.jpg', 1, ''),
(44, 'Teknologi Digital', 1, 5, 2020, 2, 4, 'teknologi.jpeg', 1, ''),
(45, 'Bahasa Korea Part 1', 2, 5, 2020, 3, 9, 'bahasa.jpg', 1, 'Buku Bahasa Korea Terpau membahas dari awal sampai mahir outputya sampai bisa bahasa korea.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(20) NOT NULL,
  `id_pengirim` int(20) NOT NULL,
  `id_penerima` int(20) NOT NULL,
  `subyek_pesan` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `baca_pesan` enum('Sudah','Belum') NOT NULL DEFAULT 'Belum',
  `tanggal_chat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `chat`
--

INSERT INTO `chat` (`id_chat`, `id_pengirim`, `id_penerima`, `subyek_pesan`, `pesan`, `baca_pesan`, `tanggal_chat`) VALUES
(28, 17, 1, 'Tambahkan Buku', 'Hai', 'Sudah', '2019-12-06'),
(29, 1, 17, 'Re : baik', 'OKE\r\n', 'Belum', '2019-12-06'),
(30, 25, 21, 'hai', 'Halo Dit&nbsp;ï»¿dsds', 'Sudah', '2020-02-28'),
(31, 21, 25, 'Re : oke', 'dsds oke', 'Sudah', '2020-02-28'),
(32, 23, 20, 'Tolong Tambahkan Buku Java', 'Hai Ika, Tolong Tambahkan Buku judul Java ya. Terima Kasih', 'Sudah', '2020-07-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail_pinjam` int(50) NOT NULL,
  `kode_pinjam` int(50) NOT NULL,
  `id_buku` int(50) NOT NULL,
  `id_penerbit` int(50) NOT NULL,
  `id_pengarang` int(50) NOT NULL,
  `id_anggota` int(50) NOT NULL,
  `id_petugas` int(50) NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `kode_status_pinjam` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail_pinjam`, `kode_pinjam`, `id_buku`, `id_penerbit`, `id_pengarang`, `id_anggota`, `id_petugas`, `id_kategori`, `qr_code`, `kode_status_pinjam`) VALUES
(50, 54, 39, 1, 1, 2, 23, 1, '54.jpg', 3),
(51, 55, 39, 1, 1, 2, 23, 1, '55.jpg', 0),
(52, 56, 40, 1, 1, 2, 23, 1, '56.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengembalian`
--

CREATE TABLE `detail_pengembalian` (
  `id_detail_kembali` int(50) NOT NULL,
  `id_kembali` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_pengembalian`
--

INSERT INTO `detail_pengembalian` (`id_detail_kembali`, `id_kembali`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(50) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Komputer'),
(2, 'Teknologi'),
(3, 'Bahasa Dan Sastra'),
(6, 'Pertanian'),
(7, 'Kesehatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `kode_pinjam` int(50) NOT NULL,
  `id_anggota` int(50) NOT NULL,
  `id_buku` int(50) NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `id_petugas` int(50) NOT NULL,
  `id_penerbit` int(50) NOT NULL,
  `id_pengarang` int(50) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kode_status_pinjam` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`kode_pinjam`, `id_anggota`, `id_buku`, `id_kategori`, `id_petugas`, `id_penerbit`, `id_pengarang`, `tgl_pinjam`, `tgl_kembali`, `jumlah`, `kode_status_pinjam`) VALUES
(54, 2, 39, 1, 23, 1, 1, '2020-07-07', '2020-07-14', 1, 5),
(55, 2, 39, 1, 23, 1, 1, '2021-06-14', '2021-06-21', 1, 2),
(56, 2, 40, 1, 23, 1, 1, '2021-06-14', '2021-06-21', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(50) NOT NULL,
  `nama_penerbit` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto_penerbit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat`, `no_hp`, `foto_penerbit`) VALUES
(1, 'Informatika', 'Jln.Gajah Mada', '099897921', 'start.jpg'),
(2, 'Erlangga', 'Jln.Kota', '0890213', 'start.jpg'),
(4, 'Syahril Ramadhan Kurniadi', 'Jln.HR.Rasuna Said', '081310802774', 'ramadhan.jpg'),
(5, 'Syahril Ramadhan Kurnniadi', 'Jln.Hr.Rasuna Said Kuningan Timur Jakarta Selatan', '081310802774', 'ramadhan.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(50) NOT NULL,
  `nama_pengarang` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `foto_pengarang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `alamat`, `no_hp`, `foto_pengarang`) VALUES
(1, 'Syahril Ramadhan', 'Jln.Hr.Rasuna Said - Kuningan Timur', '081310802774', 'ramadhan.jpg'),
(5, 'Syahril', 'Jln. HR.Rasuna Said Kuningan Timur', '081310802774', 'Syahril_biru.jpg'),
(6, 'Ramadhan Kurniadi', 'Jln.Hr.Rasuna Said Kuningan Timur Jakarta Selatan', '081310802774', '1489306882612.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_kembali` int(50) NOT NULL,
  `id_anggota` int(50) NOT NULL,
  `id_detail_pinjam` int(50) NOT NULL,
  `id_buku` int(50) NOT NULL,
  `id_kategori` int(50) NOT NULL,
  `id_penerbit` int(50) NOT NULL,
  `id_pengarang` int(50) NOT NULL,
  `kode_status_pinjam` int(50) NOT NULL,
  `denda` int(50) NOT NULL,
  `keterlambatan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id_kembali`, `id_anggota`, `id_detail_pinjam`, `id_buku`, `id_kategori`, `id_penerbit`, `id_pengarang`, `kode_status_pinjam`, `denda`, `keterlambatan`) VALUES
(2, 2, 50, 39, 1, 1, 1, 5, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(100) NOT NULL,
  `email_petugas` varchar(100) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan','','') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `id_status` int(10) NOT NULL,
  `id_akses` int(10) NOT NULL,
  `tanggal` int(20) NOT NULL,
  `bulan` varchar(30) NOT NULL,
  `tahun` year(4) NOT NULL,
  `online` varchar(50) NOT NULL DEFAULT 'Tidak Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `email_petugas`, `nama_petugas`, `password`, `jenis_kelamin`, `no_hp`, `alamat`, `foto`, `qr_code`, `id_status`, `id_akses`, `tanggal`, `bulan`, `tahun`, `online`) VALUES
(20, 'ikasuciprastiwi@gmail.com', 'Ika Suci Prastiwi', '7965c82127bd8517d2495e8efb12702c', 'Perempuan', '-', 'Jln.Bukit Cengkeh 2 - Kelapa 2 - Kota Depok', 'IMG_20190131_172228.jpg', '20.png', 1, 1, 14, 'June', 2021, 'Tidak Aktif'),
(21, 'radit@gmail.com', 'Radithya Pramuditha Yenadi', 'a0e281c2ac3f9ccf86a0698b49ff2a84', 'Laki-Laki', '-', '-', 'avatar5.png', '21.png', 1, 2, 28, 'February', 2020, 'Tidak Aktif'),
(22, 'rifki@gmail.com', 'Rifki Nur Apriono', '7eb6fb982bdf46685e3083fcd42d8cf0', 'Laki-Laki', '-', '-', 'avatar5.png', '22.png', 1, 2, 25, 'January', 2020, 'Tidak Aktif'),
(23, 'yulianto@gmail.com', 'Muhammad Yulianto Ramadhan', '7b5adea9f129b861e3291e851a9e15e9', 'Laki-Laki', '081310802774', 'Jln.Rasuna Said', 'avatar5.png', '23.png', 1, 5, 14, 'June', 2021, 'Tidak Aktif'),
(24, 'evansbayu@gmail.com', 'Evans Bayu Kristanto', 'da2d85fc730d80a91481980ecc511321', 'Laki-Laki', '-', '-', 'avatar5.png', '24.png', 1, 4, 24, 'January', 2020, 'Tidak Aktif'),
(25, 'syahrilramadhan775@gmail.com', 'Syahril Ramadhan', '560dbdf69d9620f88ee1cfe28173821a', 'Laki-Laki', '081310802774', 'Jln.Hr.Rasuna Said - Kuningan Timur - Jakarta Selatan', 'ramadhan.jpg', '25.png', 1, 1, 14, 'June', 2021, 'Tidak Aktif'),
(26, 'ahmadjaid@gmail.com', 'Ahmad Mujahid', '92d7b76bb2904b17fe8dde2726a6db85', 'Laki-Laki', '-', '-', 'avatar5.png', '', 1, 5, 24, 'January', 2020, 'Tidak Aktif'),
(27, 'ilham@gmail.com', 'Ilham', 'b63d204bf086017e34d8bd27ab969f28', 'Laki-Laki', '6281310802774', 'Jln. Hr. Rasuna Said', 'Syahril.jpg', '27.png', 1, 6, 14, 'June', 2021, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(255) NOT NULL,
  `id_anggota` int(255) NOT NULL,
  `saran` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `saran`
--

INSERT INTO `saran` (`id_saran`, `id_anggota`, `saran`) VALUES
(1, 2, 'Terima Kasih'),
(2, 2, 'Keren'),
(3, 0, 'Keren'),
(4, 2, 'Hebat'),
(5, 2, 'Thank'),
(6, 0, 'Oke'),
(7, 2, 'OKE'),
(8, 2, 'KEO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_buku`
--

CREATE TABLE `status_buku` (
  `id_status_buku` int(10) NOT NULL,
  `status_buku` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_buku`
--

INSERT INTO `status_buku` (`id_status_buku`, `status_buku`) VALUES
(1, 'Tersedia'),
(2, 'Dipinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_peminjaman`
--

CREATE TABLE `status_peminjaman` (
  `kode_status_pinjam` int(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_peminjaman`
--

INSERT INTO `status_peminjaman` (`kode_status_pinjam`, `status`) VALUES
(1, 'Menunggu Konfirmasi'),
(2, 'Berhasil Di Pinjam'),
(3, 'Buku Sedang Di Pinjam'),
(4, 'Buku Belum Tersedia'),
(5, 'Sudah Di Kembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_petugas`
--

CREATE TABLE `status_petugas` (
  `id_status` int(10) NOT NULL,
  `nama_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_petugas`
--

INSERT INTO `status_petugas` (`id_status`, `nama_status`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tingkatan_admin` enum('Super Admin','Admin Biasa') NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `foto_admin` varchar(255) NOT NULL,
  `tanggal` int(50) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  `tahun` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama`, `jenis_kelamin`, `tingkatan_admin`, `no_hp`, `alamat`, `foto_admin`, `tanggal`, `bulan`, `tahun`) VALUES
(1, 'sahrilramadhan59@gmail.com', '560dbdf69d9620f88ee1cfe28173821a', 'Syahril Ramadhan', 'Laki-Laki', 'Super Admin', '081310802774', 'Jln.Hr.Rasuna Said - Kuningan Timur - Jakarta Selatan', 'ramadhan.jpg', 29, 'February', 2020),
(2, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Syahril', 'Laki-Laki', 'Admin Biasa', '081310802774', 'Jln.Hr.Rasuna Said', 'ramadhan.jpg', 14, 'June', 2021);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` int(50) NOT NULL,
  `email_anggota` varchar(100) NOT NULL,
  `password_anggota` varchar(100) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `no_hp_anggota` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `tgl_daftar` date NOT NULL,
  `last_login` datetime NOT NULL,
  `online` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `email_anggota`, `password_anggota`, `nama_anggota`, `no_hp_anggota`, `alamat`, `foto`, `jenis_kelamin`, `tgl_daftar`, `last_login`, `online`) VALUES
(2, 'cumi@gmail.com', '41a1c00408423adad1f3690f527ed705', 'Cumi', '389032432', 'dadasdas', 'ramadhan.jpg', 'Laki-Laki', '2020-07-07', '2020-07-07 23:08:07', 'Sedang Aktif'),
(6, 'sahrilramadhan59@gmail.com', '9089d70c822ce1cfe3ee28a92886d41f', 'Syahril Ramadhan', '081310802774', 'Jln. Hr. Rasuna Said, RT.003 / RW.004 No.20 - Kuningan Timur - Jakarta Selatan', 'Syahril.jpg', 'Laki-Laki', '2020-07-07', '2020-07-07 23:08:30', 'Tidak Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses_petugas`
--
ALTER TABLE `akses_petugas`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail_pinjam`);

--
-- Indexes for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD PRIMARY KEY (`id_detail_kembali`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`kode_pinjam`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_kembali`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `status_buku`
--
ALTER TABLE `status_buku`
  ADD PRIMARY KEY (`id_status_buku`);

--
-- Indexes for table `status_peminjaman`
--
ALTER TABLE `status_peminjaman`
  ADD PRIMARY KEY (`kode_status_pinjam`);

--
-- Indexes for table `status_petugas`
--
ALTER TABLE `status_petugas`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses_petugas`
--
ALTER TABLE `akses_petugas`
  MODIFY `id_akses` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail_pinjam` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  MODIFY `id_detail_kembali` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `kode_pinjam` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_kembali` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `status_buku`
--
ALTER TABLE `status_buku`
  MODIFY `id_status_buku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `status_peminjaman`
--
ALTER TABLE `status_peminjaman`
  MODIFY `kode_status_pinjam` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status_petugas`
--
ALTER TABLE `status_petugas`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  MODIFY `id_anggota` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
