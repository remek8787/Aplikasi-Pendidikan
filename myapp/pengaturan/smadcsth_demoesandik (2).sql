-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Jun 2025 pada 09.33
-- Versi server: 10.6.21-MariaDB-cll-lve-log
-- Versi PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smadcsth_demoesandik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `pulang` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `bulan` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `jjm` varchar(50) DEFAULT NULL,
  `honor` varchar(50) DEFAULT NULL,
  `jenis` varchar(11) DEFAULT NULL,
  `daring` varchar(11) NOT NULL DEFAULT '0',
  `foto` mediumtext DEFAULT NULL,
  `link` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `tanggal`, `nokartu`, `idsiswa`, `kelas`, `idpeg`, `level`, `masuk`, `pulang`, `ket`, `bulan`, `tahun`, `keterangan`, `mesin`, `jjm`, `honor`, `jenis`, `daring`, `foto`, `link`) VALUES
(1, '2025-05-20', NULL, '93', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(2, '2025-05-20', NULL, '94', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(3, '2025-05-20', NULL, '95', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(4, '2025-05-20', NULL, '96', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(5, '2025-05-20', NULL, '97', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(6, '2025-05-20', NULL, '98', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(7, '2025-05-20', NULL, '99', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(8, '2025-05-20', NULL, '100', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL),
(9, '2025-05-20', NULL, '101', 'XII-2', NULL, 'siswa', NULL, NULL, 'A', '05', '2025', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_les`
--

CREATE TABLE `absensi_les` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `pulang` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `bulan` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_mapel`
--

CREATE TABLE `absensi_mapel` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `bulan` varchar(50) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_daringmapel`
--

CREATE TABLE `absen_daringmapel` (
  `id` int(11) NOT NULL,
  `idmateri` int(11) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `bulan` varchar(5) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `absen_daringmapel`
--

INSERT INTO `absen_daringmapel` (`id`, `idmateri`, `mapel`, `idsiswa`, `kelas`, `tanggal`, `jam`, `bulan`, `ket`, `guru`, `tahun`) VALUES
(4, 3, 'BINDO', 2, 'X-1', '2025-05-15', '12:55:59', '05', 'H', 1, '2025'),
(5, 3, 'BINDO', 14, 'X-1', '2025-05-15', '15:48:58', '05', 'H', 1, '2025'),
(6, 3, 'BINDO', 23, 'X-1', '2025-05-16', '03:33:44', '05', 'H', 1, '2025'),
(7, 3, 'BINDO', 2, 'X-1', '2025-05-16', '17:23:11', '05', 'H', 1, '2025'),
(8, 3, 'BINDO', 25, 'X-1', '2025-05-16', '19:27:19', '05', 'H', 1, '2025'),
(9, 3, 'BINDO', 11, 'X-1', '2025-05-16', '20:36:36', '05', 'H', 1, '2025'),
(10, 3, 'BINDO', 5, 'X-1', '2025-05-19', '16:08:45', '05', 'H', 1, '2025'),
(11, 5, 'INFO', 101, 'XII-2', '2025-05-20', '09:47:16', '05', 'H', 7, '2025'),
(12, 3, 'BINDO', 18, 'X-2', '2025-05-20', '11:49:06', '05', 'H', 1, '2025'),
(13, 3, 'BINDO', 0, '', '2025-05-21', '07:31:31', '05', 'H', 1, '2025'),
(14, 3, 'BINDO', 19, 'X-2', '2025-05-21', '13:27:23', '05', 'H', 1, '2025'),
(15, 3, 'BINDO', 18, 'X-2', '2025-05-22', '07:21:14', '05', 'H', 1, '2025'),
(16, 3, 'BINDO', 18, 'X-2', '2025-05-23', '18:43:19', '05', 'H', 1, '2025'),
(17, 6, 'MTK', 2, 'X-2', '2025-05-26', '09:17:27', '05', 'H', 1, '2025'),
(18, 4, 'INFO', 102, 'X-2', '2025-05-26', '16:00:16', '05', 'H', 2, '2025'),
(19, 3, 'BINDO', 2, 'X-2', '2025-05-27', '11:27:09', '05', 'H', 1, '2025'),
(20, 6, 'MTK', 2, 'X-2', '2025-05-28', '08:46:30', '05', 'H', 1, '2025'),
(21, 4, 'INFO', 2, 'X-2', '2025-05-28', '08:53:13', '05', 'H', 2, '2025'),
(22, 6, 'MTK', 6, 'X-2', '2025-05-29', '19:47:31', '05', 'H', 1, '2025'),
(23, 6, 'MTK', 23, 'X-2', '2025-05-30', '13:10:11', '05', 'H', 1, '2025'),
(24, 6, 'MTK', 20, 'X-2', '2025-05-30', '13:31:51', '05', 'H', 1, '2025'),
(25, 6, 'MTK', 27, 'X-2', '2025-05-31', '05:31:28', '05', 'H', 1, '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `absen_gps`
--

CREATE TABLE `absen_gps` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `ket` varchar(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `masuk` varchar(50) DEFAULT NULL,
  `lokasi` text DEFAULT NULL,
  `bulan` varchar(11) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `jadwal` varchar(11) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `kd` varchar(50) DEFAULT NULL,
  `materi` longtext DEFAULT NULL,
  `tujuan` longtext DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` varchar(11) DEFAULT NULL,
  `hadir` varchar(50) DEFAULT NULL,
  `hambatan` text DEFAULT NULL,
  `pemecahan` text DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `agenda`
--

INSERT INTO `agenda` (`id`, `jadwal`, `hari`, `tanggal`, `kelas`, `mapel`, `kd`, `materi`, `tujuan`, `bulan`, `tahun`, `hadir`, `hambatan`, `pemecahan`, `guru`) VALUES
(1, '6', 'Wed', '2025-04-23', 'X-A', '3', NULL, 'Teks Negosiasi ', 'Peserta didik dapat menjelaskan tentang teks negosiasi ', '04', '2025', 'NAN', NULL, NULL, '2'),
(2, '7', 'Tue', '2025-04-15', 'X-A', '3', NULL, 'Teks Negosiasi ', 'Peserta didik dapat menjelaskan tentang teks negosiasi ', '04', '2025', 'NAN', NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alumni`
--

CREATE TABLE `alumni` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(10) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `jk` varchar(50) DEFAULT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `tahun_lulus` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `alumni`
--

INSERT INTO `alumni` (`id`, `id_siswa`, `nis`, `nisn`, `nama`, `kelas`, `jurusan`, `jk`, `tgl_mutasi`, `tahun_lulus`) VALUES
(1, 1, '20221001', '0001', 'ABIWANTA RIZKY WIDYA AGUNG', 'XI-1', 'UMUM', 'L', '2025-05-16', '2025'),
(2, 2, '20221002', '0002', 'AISYAH TRI CAHYA', 'X-2', 'UMUM', 'P', '2025-06-01', '2025'),
(3, 3, '20221003', '0003', 'AISYAH VARDA URIFA', 'X-2', 'UMUM', 'P', '2025-06-01', '2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `id` int(11) NOT NULL,
  `idlemari` varchar(11) DEFAULT NULL,
  `nama_arsip` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `file` text DEFAULT NULL,
  `nomor` varchar(50) DEFAULT NULL,
  `inputer` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `arsip`
--

INSERT INTO `arsip` (`id`, `idlemari`, `nama_arsip`, `tanggal`, `file`, `nomor`, `inputer`) VALUES
(1, '2', 'SS', '2025-03-04', 'Screen Shot 2025-02-26 at 08.21.50.png', '0001 / III / 2025', '2'),
(2, '2', 'tes', '2025-03-04', 'Screenshot 2025-01-23 at 11.15.11.png', '0002 / III / 2025', '7'),
(3, '2', 'data sakit', '2025-05-20', 'anggur.png', '0001 / V / 2025', '5'),
(4, '2', 'Buku Presensi', '2025-05-26', 'duarr.jpg', '0001 / V / 2025', '2'),
(5, '2', 'KArtu UJian', '2025-06-04', 'Kartu_UMPTKIN_Dalilatul Amalia.pdf', '0001 / VI / 2025', '6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_barang` varchar(255) DEFAULT NULL,
  `jumlah` varchar(11) DEFAULT NULL,
  `toko` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `dana` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `bulan` varchar(11) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `baik` varchar(11) DEFAULT '0',
  `ringan` varchar(11) DEFAULT '0',
  `berat` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `banksoal`
--

CREATE TABLE `banksoal` (
  `id_bank` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `idguru` varchar(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `pk` mediumtext DEFAULT NULL,
  `status` varchar(2) DEFAULT NULL,
  `soal_agama` varchar(50) DEFAULT NULL,
  `model` int(11) DEFAULT 0,
  `groupsoal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `banksoal`
--

INSERT INTO `banksoal` (`id_bank`, `kode`, `idguru`, `nama`, `level`, `pk`, `status`, `soal_agama`, `model`, `groupsoal`) VALUES
(9, 'BINDO-A', '2', 'BINDO', '10', 'semua', '1', '', 1, 'AKM'),
(10, 'inf', '7', 'INFO', '12', 'UMUM', '1', 'Islam', 1, 'AKM'),
(11, 'PAT_BINDO10', '9', 'BINDO', '10', 'UMUM', '1', '', 1, 'AKM'),
(12, '000', '67', 'INFO', '10', 'semua', '1', '', 1, 'AKM'),
(13, 'IT', '11', 'INFO', '10', 'semua', '1', '', 1, 'AKM'),
(14, 'PAI', '68', 'PABP', '10', 'semua', '1', 'Islam', 1, 'AKM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bell`
--

CREATE TABLE `bell` (
  `id` int(11) NOT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `nada` varchar(11) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bell`
--

INSERT INTO `bell` (`id`, `hari`, `nada`, `jam`, `ket`) VALUES
(2, 'Sat', '1', '15:24:00', 'tes'),
(3, 'Mon', '2', '08:30:00', 'Jam Ke 2'),
(4, 'Tue', '13', '21:44:00', 'ok');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bell_nada`
--

CREATE TABLE `bell_nada` (
  `idb` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bell_nada`
--

INSERT INTO `bell_nada` (`idb`, `nama`) VALUES
(1, 'JAM PERTAMA'),
(2, 'JAM KEDUA'),
(3, 'JAM KETIGA'),
(4, 'JAM KEEMPAT'),
(5, 'JAM KELIMA'),
(6, 'JAM KEENAM'),
(7, 'JAM KETUJUH'),
(8, 'JAM KEDELAPAN'),
(9, 'JAM KESEMBILAN'),
(10, 'JAM KESEPULUH'),
(11, 'JAM KESEBELAS'),
(12, 'JAM KEDUABELAS'),
(13, 'MAPEL HARI INI SELESAI'),
(14, 'MAPEL AKHIR PEKAN SELESAI'),
(15, 'ISTIRAHAT PERTAMA'),
(16, 'WAKTU ISTIRAHAT PERTAMA SELESAI'),
(17, 'ISTIRAHAT KEDUA'),
(18, 'WAKTU ISTIRAHAT KEDUA SELESAI'),
(19, 'WAKTU IBADAH SHOLAT'),
(20, 'UPACARA BENDERA 5 MENIT LAGI'),
(21, 'UPACARA BENDERA DIMUALAI'),
(22, 'WAKTU IBADAH SHOLAT JUMAT'),
(23, 'SELURUH PESERTA & PENGAWAS UJIAN MEMASUKI RUANGAN'),
(24, 'PESERTA UJIAN DIPERSILAHKAN MENGERJAKAN UJIAN'),
(25, 'WAKTU UJIAN 5 MENIT LAGI'),
(26, 'WAKTU UJIAN TELAH HABIS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `sesi` varchar(10) NOT NULL,
  `ruang` varchar(20) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `ikut` varchar(10) DEFAULT NULL,
  `susulan` varchar(10) DEFAULT NULL,
  `no_susulan` mediumtext DEFAULT NULL,
  `mulai` varchar(10) DEFAULT NULL,
  `selesai` varchar(10) DEFAULT NULL,
  `nama_proktor` varchar(50) DEFAULT NULL,
  `nip_proktor` varchar(50) DEFAULT NULL,
  `nama_pengawas` varchar(50) DEFAULT NULL,
  `nip_pengawas` varchar(50) DEFAULT NULL,
  `catatan` mediumtext DEFAULT NULL,
  `tgl_ujian` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `id_bank`, `sesi`, `ruang`, `jenis`, `ikut`, `susulan`, `no_susulan`, `mulai`, `selesai`, `nama_proktor`, `nip_proktor`, `nama_pengawas`, `nip_pengawas`, `catatan`, `tgl_ujian`) VALUES
(1, 1, '1', 'R1', 'PAS', '38', '2', 'a:2:{i:0;s:5:\"US-22\";i:1;s:5:\"US-23\";}', '09:00', '10:00', 'P_1', '12345', 'Rama', '2345', 'Lancar', '2025-03-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_kategori`
--

CREATE TABLE `bk_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_kategori`
--

INSERT INTO `bk_kategori` (`id`, `kategori`) VALUES
(1, 'Kelakuan'),
(2, 'Kerapihan'),
(3, 'Kerajinan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_pelanggaran`
--

CREATE TABLE `bk_pelanggaran` (
  `id` int(11) NOT NULL,
  `idkat` int(11) NOT NULL,
  `idsub` int(11) DEFAULT NULL,
  `pelanggaran` mediumtext DEFAULT NULL,
  `poin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_pelanggaran`
--

INSERT INTO `bk_pelanggaran` (`id`, `idkat`, `idsub`, `pelanggaran`, `poin`) VALUES
(1, 1, 1, 'Terlambat hadir di sekolah \r\n', 2),
(2, 1, 1, 'Tidak membawa buku paket/pelajaran', 5),
(3, 1, 1, 'TIdak mengerjakan tugas sesuai dengan batas waktu yang ditentukan\r\n', 5),
(4, 1, 1, 'Mencontek/ menconteki', 10),
(5, 1, 1, 'Keluar kelas tanpa ijin guru/kabur', 10),
(6, 1, 1, 'Makan/ minum/ tidur saat PBM tanpa ijin guru/\r\n', 10),
(7, 1, 1, 'Membuat gaduh di kelas\r\n', 5),
(8, 1, 1, 'Tidak mengikuti ekstrakurikuler wajib di sekolah\r\n', 10),
(9, 1, 1, 'Tidak mengikuti upacara bendera\r\n', 10),
(12, 2, 3, 'Tidak menggunakan seragam sekolah sesuai aturan', 5),
(13, 2, 3, 'Baju tidak dimasukan', 5),
(14, 1, 6, 'Menggunakan Narkoba\r\n', 100),
(22, 1, 5, 'Merokok di area lingkungan sekolah', 50),
(23, 2, 2, 'Rambut di cat', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_pesan`
--

CREATE TABLE `bk_pesan` (
  `id` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_pesan`
--

INSERT INTO `bk_pesan` (`id`, `nis`, `pesan`, `waktu`) VALUES
(1, 20221001, 'Assalamualaikum wr.wb\n Kami Informasikan kepada Orang Tua dari *ABIWANTA RIZKY WIDYA AGUNG* bahwa hari ini ananda *ABIWANTA RIZKY WIDYA AGUNG* telah melakukan pelanggaran sekolah berupa Rambut di cat Demikian Informasi yang Kami Sampaikan, Harap menjadi perhatian Bapak/Ibu selaku Orang Tua Siswa\n Wasallamualaikum wr.wb.\n Pesan ini otomatis disampaikan oleh Server SMA NEGERI 1 NUSANTARA', ''),
(2, 20221038, 'Assalamualaikum wr.wb\n Kami Informasikan kepada Orang Tua dari *ANDRE RIZKY YULIANTO* bahwa hari ini ananda *ANDRE RIZKY YULIANTO* telah melakukan pelanggaran sekolah berupa Tidak membawa buku paket/pelajaran Demikian Informasi yang Kami Sampaikan, Harap menjadi perhatian Bapak/Ibu selaku Orang Tua Siswa\n Wasallamualaikum wr.wb.\n Pesan ini otomatis disampaikan oleh Server SMA NEGERI 1 NUSANTARA', ''),
(3, 20221055, 'Assalamualaikum wr.wb\n Kami Informasikan kepada Orang Tua dari *MOH. AVATAR* bahwa hari ini ananda *MOH. AVATAR* telah melakukan pelanggaran sekolah berupa Menggunakan Narkoba\r\n Demikian Informasi yang Kami Sampaikan, Harap menjadi perhatian Bapak/Ibu selaku Orang Tua Siswa\n Wasallamualaikum wr.wb.\n Pesan ini otomatis disampaikan oleh Server SMA NEGERI 1 NUSANTARA', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_siswa`
--

CREATE TABLE `bk_siswa` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `idkat` int(11) DEFAULT NULL,
  `idsub` int(11) DEFAULT NULL,
  `idpel` int(11) DEFAULT NULL,
  `idpres` int(11) DEFAULT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `ket` mediumtext DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `sts` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_siswa`
--

INSERT INTO `bk_siswa` (`id`, `nis`, `kelas`, `tanggal`, `idkat`, `idsub`, `idpel`, `idpres`, `tapel`, `ket`, `poin`, `sts`) VALUES
(1, '20221001', 'X-1', '2025-05-12', 2, 2, 23, NULL, '2024/2025', 'Rambut Ybs dicat ', 5, '0'),
(2, '20221038', 'X-2', '2025-05-15', 1, 1, 2, NULL, '2024/2025', '222\r\n', 5, '0'),
(3, '20221055', 'XI-1', '2025-05-15', 1, 6, 14, NULL, '2024/2025', 'sadasd', 100, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_sp`
--

CREATE TABLE `bk_sp` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `sts` varchar(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_sp`
--

INSERT INTO `bk_sp` (`id`, `nis`, `poin`, `ket`, `tapel`, `sts`) VALUES
(1, '20221055', 100, 'SP3', '2024/2025', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_sub`
--

CREATE TABLE `bk_sub` (
  `id` int(11) NOT NULL,
  `id_kat` int(11) NOT NULL,
  `sub_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_sub`
--

INSERT INTO `bk_sub` (`id`, `id_kat`, `sub_kategori`) VALUES
(1, 1, 'Kegiatan Belajar Mengajar'),
(2, 2, 'Rambut'),
(3, 2, 'Pakaian'),
(4, 3, 'Kehadiran'),
(5, 1, 'Merokok'),
(6, 1, 'Minuman keras'),
(7, 1, 'Pornogafi'),
(8, 1, 'Mencuri'),
(9, 1, 'Memeras'),
(10, 1, 'Penghinaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_surat`
--

CREATE TABLE `bk_surat` (
  `id` int(11) NOT NULL,
  `nosurat` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `sanksi` text NOT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `sts` varchar(11) DEFAULT '0',
  `idsp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bk_tindakan`
--

CREATE TABLE `bk_tindakan` (
  `id` int(11) NOT NULL,
  `tindakan` varchar(50) DEFAULT NULL,
  `ketentuan` mediumtext DEFAULT NULL,
  `minpoin` int(11) DEFAULT NULL,
  `maxpoin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bk_tindakan`
--

INSERT INTO `bk_tindakan` (`id`, `tindakan`, `ketentuan`, `minpoin`, `maxpoin`) VALUES
(2, 'SP1', 'Orang Tua akan dikirim Surat Peringatan ke 1 (SP1) atas tindakan pelanggaan oleh peserta didik mmmmm', 35, 45),
(3, 'SP2', 'Orang Tua akan dikirim Surat Peringatan ke 2 (SP2) atas tindakan pelanggaan oleh peserta didik', 46, 74),
(4, 'SP3', 'Orang Tua akan dikirim Surat Peringatan ke 13(SP3) atas tindakan pelanggaan oleh peserta didik', 75, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `idkategori` int(11) DEFAULT NULL,
  `judul` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `penerbit` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `pengarang` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `barkode` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `ket` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id` int(11) NOT NULL,
  `bln` varchar(5) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `bulan`
--

INSERT INTO `bulan` (`id`, `bln`, `ket`) VALUES
(1, '01', 'Januari'),
(2, '02', 'Februari'),
(3, '03', 'Maret'),
(4, '04', 'April'),
(5, '05', 'Mei'),
(6, '06', 'Juni'),
(7, '07', 'Juli'),
(8, '08', 'Agustus'),
(9, '09', 'September'),
(10, '10', 'Oktober'),
(11, '11', 'Nopember'),
(12, '12', 'Desember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `datareg`
--

CREATE TABLE `datareg` (
  `id` int(11) NOT NULL,
  `nokartu` varchar(50) DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `idjari` varchar(11) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `sts` varchar(11) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `datareg`
--

INSERT INTO `datareg` (`id`, `nokartu`, `idsiswa`, `idpeg`, `level`, `nama`, `idjari`, `serial`, `sts`, `folder`) VALUES
(4, NULL, '4', NULL, 'siswa', 'ALVERO DHIKO LEVANO', '2', 'sVBcIy4ZEV', NULL, NULL),
(5, NULL, '5', NULL, 'siswa', 'ANAVELIA FRANSISCA SIMANJUNTAK', '3', '8OiigCAbPG', NULL, NULL),
(6, NULL, '9', NULL, 'siswa', 'BELLA AYU INDAH SARI', '4', '5rQthd8ggE', NULL, NULL),
(7, NULL, '14', NULL, 'siswa', 'FAKHRI RAHMAD JULIAN', '5', 'PakWpjBWku', NULL, NULL),
(8, NULL, '12', NULL, 'siswa', 'DENIS SABRINA', '6', 'pM8DI0kWQp', NULL, NULL),
(9, NULL, '37', NULL, 'siswa', 'Aji Wahyudi', '7', 'qNgrcYtWHw', NULL, NULL),
(10, NULL, '101', NULL, 'siswa', 'testing', '8', 'Zo6ezxnq8j', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_luar`
--

CREATE TABLE `data_luar` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `data_luar`
--

INSERT INTO `data_luar` (`id`, `idsiswa`, `idpeg`, `jenis`) VALUES
(5, NULL, '3', '1'),
(6, NULL, '4', '1'),
(7, NULL, '3', '1'),
(8, NULL, '2', '1'),
(9, NULL, '10', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `deskripsi`
--

CREATE TABLE `deskripsi` (
  `id` int(11) NOT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `smt` int(11) DEFAULT NULL,
  `ki` varchar(11) DEFAULT NULL,
  `kd` varchar(20) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `disfo`
--

CREATE TABLE `disfo` (
  `id` int(11) NOT NULL,
  `bg` varchar(50) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `teks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `disfo`
--

INSERT INTO `disfo` (`id`, `bg`, `file`, `teks`) VALUES
(1, 'FOTO', 'file71.png', 'Semua Siswa harap melakukan presensi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `download`
--

CREATE TABLE `download` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `download`
--

INSERT INTO `download` (`id`, `idsiswa`, `jenis`, `waktu`) VALUES
(1, '1', 'SKL', '2025-02-18 10:01:36'),
(2, '1', 'SKL', '2025-02-18 10:01:59'),
(3, '1', 'SKL', '2025-02-18 10:03:43'),
(4, '1', 'SKL', '2025-02-18 10:05:21'),
(5, '1', 'SKL', '2025-02-18 10:07:49'),
(6, '91', 'SKL', '2025-02-18 10:19:31'),
(7, '91', 'SKL', '2025-02-21 08:29:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_pendukung`
--

CREATE TABLE `file_pendukung` (
  `id_file` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT 0,
  `nama_file` varchar(50) DEFAULT NULL,
  `status_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `file_pendukung`
--

INSERT INTO `file_pendukung` (`id_file`, `id_bank`, `nama_file`, `status_file`) VALUES
(1, 1, '6915.jpeg', NULL),
(2, 1, '8837.jpeg', NULL),
(3, 1, '4578.png', NULL),
(4, 13, '13_1_1.png', NULL),
(5, 13, '13_2_1.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `informasi`
--

CREATE TABLE `informasi` (
  `id` int(11) NOT NULL,
  `untuk` varchar(2) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `informasi`
--

INSERT INTO `informasi` (`id`, `untuk`, `judul`, `isi`, `waktu`) VALUES
(1, '1', 'WELCOME!', '<p>Selamat datang di Sistem Aplikasi Pendidikan <strong>SMA Negeri 1 Nusantara!</strong></p>', '2025-05-05 08:31:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `total` varchar(50) DEFAULT NULL,
  `reff` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id`, `tanggal`, `idsiswa`, `nama`, `total`, `reff`) VALUES
(1, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219213722'),
(2, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219213935'),
(3, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219214319'),
(4, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219214415'),
(5, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219215252'),
(6, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219222626'),
(7, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219222626'),
(8, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219222729'),
(9, '2025-02-19', '91', 'NABILA AURELIA PUTRI SUSANTO', '', '20250219222729'),
(10, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219223032'),
(11, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219223032'),
(12, '2025-02-19', '1', 'ABIWANTA RIZKY WIDYA AGUNG', '', '20250219223032'),
(13, '2025-03-05', '6', 'ANDREAS NOVA ANDRIANO', '', '20250305121013'),
(14, '2025-03-24', '18', 'HERI PRASETYO', '', '20250324194853'),
(15, '2025-03-28', '2', 'AISYAH TRI CAHYA', '', '20250328105946'),
(16, '2025-03-31', '14', 'FAKHRI RAHMAD JULIAN', '', '20250331111408'),
(17, '2025-05-16', '2', 'AISYAH TRI CAHYA', '', '20250516165313');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id_jadwal` int(11) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `kuri` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id_jadwal`, `tingkat`, `kelas`, `mapel`, `guru`, `hari`, `kuri`) VALUES
(1, '10', 'X-1', '1', 2, 'Mon', '2'),
(2, '10', 'X-1', '1', 2, 'Tue', '2'),
(3, '10', 'X-1', '1', 2, 'Wed', '2'),
(4, '10', 'X-1', '1', 2, 'Thu', '2'),
(5, '10', 'X-1', '1', 2, 'Fri', '2'),
(6, '10', 'X-1', '1', 2, 'Sat', '2'),
(7, '10', 'X-1', '1', 2, 'Sun', '2'),
(8, '10', 'X-1', '9', 4, 'Fri', '2'),
(9, '10', 'X-2', '9', 4, 'Fri', '2'),
(10, '10', 'X-1', '9', 2, 'Fri', '2'),
(11, '10', 'X-1', '1', 2, 'Mon', '2'),
(12, '12', 'XII-2', '9', 7, 'Tue', '2'),
(13, '10', 'X-2', '9', 4, 'Wed', '2'),
(14, '10', 'X-2', '9', 10, 'Thu', '2'),
(15, '10', 'X-2', '1', 68, 'Mon', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jawaban` varchar(50) DEFAULT NULL,
  `jawabx` varchar(50) DEFAULT NULL,
  `jenis` int(11) NOT NULL,
  `esai` mediumtext DEFAULT NULL,
  `jawabmulti` mediumtext DEFAULT NULL,
  `jawabbs` mediumtext DEFAULT NULL,
  `jawaburut` mediumtext DEFAULT NULL,
  `bs1` varchar(5) DEFAULT NULL,
  `bs2` varchar(5) DEFAULT NULL,
  `bs3` varchar(5) DEFAULT NULL,
  `bs4` varchar(5) DEFAULT NULL,
  `bs5` varchar(5) DEFAULT NULL,
  `urut1` mediumtext DEFAULT NULL,
  `urut2` mediumtext DEFAULT NULL,
  `urut3` mediumtext DEFAULT NULL,
  `urut4` mediumtext DEFAULT NULL,
  `urut5` mediumtext DEFAULT NULL,
  `nilai_esai` int(11) NOT NULL DEFAULT 0,
  `ragu` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`id`, `id_siswa`, `npsn`, `id_bank`, `id_soal`, `id_ujian`, `jawaban`, `jawabx`, `jenis`, `esai`, `jawabmulti`, `jawabbs`, `jawaburut`, `bs1`, `bs2`, `bs3`, `bs4`, `bs5`, `urut1`, `urut2`, `urut3`, `urut4`, `urut5`, `nilai_esai`, `ragu`, `status`, `ket`, `skor`) VALUES
(51, 5, NULL, 9, 17, 9, 'A', 'A', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1),
(90, 27, NULL, 9, 17, 9, 'A', 'A', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 1),
(91, 27, NULL, 9, 21, 9, 'www', NULL, 2, 'www', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_dup`
--

CREATE TABLE `jawaban_dup` (
  `id` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jawaban` varchar(50) DEFAULT NULL,
  `jawabx` varchar(50) DEFAULT NULL,
  `jenis` int(11) NOT NULL,
  `esai` mediumtext DEFAULT NULL,
  `jawabmulti` mediumtext DEFAULT NULL,
  `jawabbs` mediumtext DEFAULT NULL,
  `jawaburut` mediumtext DEFAULT NULL,
  `bs1` varchar(5) DEFAULT NULL,
  `bs2` varchar(5) DEFAULT NULL,
  `bs3` varchar(5) DEFAULT NULL,
  `bs4` varchar(5) DEFAULT NULL,
  `bs5` varchar(5) DEFAULT NULL,
  `urut1` mediumtext DEFAULT NULL,
  `urut2` mediumtext DEFAULT NULL,
  `urut3` mediumtext DEFAULT NULL,
  `urut4` mediumtext DEFAULT NULL,
  `urut5` mediumtext DEFAULT NULL,
  `nilai_esai` int(11) NOT NULL DEFAULT 0,
  `ragu` int(11) NOT NULL DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `jawaban_dup`
--

INSERT INTO `jawaban_dup` (`id`, `id_siswa`, `npsn`, `id_bank`, `id_soal`, `id_ujian`, `jawaban`, `jawabx`, `jenis`, `esai`, `jawabmulti`, `jawabbs`, `jawaburut`, `bs1`, `bs2`, `bs3`, `bs4`, `bs5`, `urut1`, `urut2`, `urut3`, `urut4`, `urut5`, `nilai_esai`, `ragu`, `status`, `ket`, `skor`) VALUES
(1, 1, NULL, 4, 7, 0, 'B', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(2, 1, NULL, 4, 11, 0, NULL, NULL, 2, 'a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(3, 1, NULL, 4, 10, 0, NULL, NULL, 4, NULL, NULL, 'B, S, B, S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(4, 1, NULL, 4, 8, 0, NULL, NULL, 3, NULL, 'A, B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(5, 1, NULL, 4, 9, 0, NULL, NULL, 5, NULL, NULL, NULL, 'B, A, C, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(6, 5, NULL, 4, 7, 0, 'A', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(7, 5, NULL, 4, 11, 0, NULL, NULL, 2, 'sjak', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(8, 5, NULL, 4, 10, 0, NULL, NULL, 4, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(9, 5, NULL, 4, 8, 0, NULL, NULL, 3, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(10, 5, NULL, 4, 9, 0, NULL, NULL, 5, NULL, NULL, NULL, 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(11, 4, NULL, 9, 17, 0, 'C', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(12, 4, NULL, 9, 21, 0, NULL, NULL, 2, 'iya', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(13, 4, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, 'B, S, B, S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(14, 4, NULL, 9, 18, 0, NULL, NULL, 3, NULL, 'A, B, C, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(15, 4, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, 'D, B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(16, 5, NULL, 9, 17, 0, 'A', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(17, 5, NULL, 9, 21, 0, NULL, NULL, 2, 'Tidak Diisi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(18, 5, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(19, 5, NULL, 9, 18, 0, NULL, NULL, 3, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(20, 5, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(21, 10, NULL, 9, 17, 0, 'A', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(22, 10, NULL, 9, 21, 0, NULL, NULL, 2, 'aaa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(23, 10, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, 'B, S', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(24, 10, NULL, 9, 18, 0, NULL, NULL, 3, NULL, 'D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(25, 10, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, 'B, C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(26, 11, NULL, 9, 17, 0, 'A', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(27, 11, NULL, 9, 21, 0, NULL, NULL, 2, 'tes', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(28, 11, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(29, 11, NULL, 9, 18, 0, NULL, NULL, 3, NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(30, 11, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, 'D, C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(31, 18, NULL, 9, 17, 0, 'B', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(32, 18, NULL, 9, 21, 0, NULL, NULL, 2, 'mbmbmbmbm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(33, 18, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(34, 18, NULL, 9, 18, 0, NULL, NULL, 3, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(35, 18, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(36, 19, NULL, 9, 17, 0, 'A', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(37, 19, NULL, 9, 21, 0, NULL, NULL, 2, 'lkdsaf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(38, 19, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, 'B, B, B, B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(39, 19, NULL, 9, 18, 0, NULL, NULL, 3, NULL, 'A, B, C, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(40, 19, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, 'B, C, A, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(41, 25, NULL, 9, 17, 0, 'X', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(42, 25, NULL, 9, 21, 0, NULL, NULL, 2, 'Tidak Diisi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(43, 25, NULL, 9, 20, 0, NULL, NULL, 4, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(44, 25, NULL, 9, 18, 0, NULL, NULL, 3, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
(45, 25, NULL, 9, 19, 0, NULL, NULL, 5, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_soal`
--

CREATE TABLE `jawaban_soal` (
  `id_jawaban` int(11) NOT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `idjawab` varchar(50) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `jawab` text DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_tugas`
--

CREATE TABLE `jawaban_tugas` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_tugas` int(11) DEFAULT NULL,
  `jawaban` longtext DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_dikerjakan` datetime DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nilai` varchar(5) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `jawaban_tugas`
--

INSERT INTO `jawaban_tugas` (`id_jawaban`, `id_siswa`, `id_tugas`, `jawaban`, `file`, `tgl_dikerjakan`, `tgl_update`, `nilai`, `status`) VALUES
(1, 2, 3, 'A\r\nB', NULL, '2025-05-27 11:34:20', '2025-05-27 04:34:20', NULL, NULL),
(2, 2, 4, '', NULL, '2025-05-16 19:15:28', '2025-05-16 12:15:28', NULL, NULL),
(3, 101, 5, 'ms office', NULL, '2025-05-20 09:47:54', '2025-05-20 02:48:10', '100', NULL),
(4, 6, 6, 'dodsk', '6_6.pdf', NULL, '2025-05-29 12:47:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_satuan`
--

CREATE TABLE `jenis_satuan` (
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `jenis_satuan`
--

INSERT INTO `jenis_satuan` (`satuan`) VALUES
('Buah'),
('Dus'),
('Kg'),
('Lusin'),
('Meter'),
('Pcs'),
('Rim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jodoh`
--

CREATE TABLE `jodoh` (
  `id_jawaban` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_bank` int(11) NOT NULL DEFAULT 0,
  `id_soal` int(11) NOT NULL DEFAULT 0,
  `id_ujian` int(11) NOT NULL DEFAULT 0,
  `jenis` varchar(50) DEFAULT NULL,
  `jawaburut` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_nama`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idproduk` varchar(11) DEFAULT NULL,
  `jumlah` varchar(11) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `total` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_materi` int(11) DEFAULT NULL,
  `komentar` text DEFAULT NULL,
  `balasan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `jenis` tinyint(2) DEFAULT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id`, `id_user`, `id_materi`, `komentar`, `balasan`, `jenis`, `tgl`, `guru`) VALUES
(1, 102, 4, 'link tidak bisa dibuka pak', NULL, 1, '2025-05-26 09:00:31', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kunci_soal`
--

CREATE TABLE `kunci_soal` (
  `id_bank` int(11) DEFAULT NULL,
  `id_soal` int(11) DEFAULT NULL,
  `id_jawab` varchar(50) DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `skor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kunci_soal`
--

INSERT INTO `kunci_soal` (`id_bank`, `id_soal`, `id_jawab`, `jawaban`, `skor`) VALUES
(9, 17, '17.1', 'A', 1),
(9, 18, '18.1', 'A', 1),
(9, 18, '18.2', 'B', 1),
(9, 18, '18.3', 'D', 1),
(9, 19, '19.1', 'C', 1),
(9, 19, '19.2', 'A', 1),
(9, 19, '19.3', 'B', 1),
(9, 19, '19.4', 'D', 1),
(9, 20, '20.1', 'B', 1),
(9, 20, '20.2', 'S', 1),
(9, 20, '20.3', 'S', 1),
(9, 20, '20.4', 'B', 1),
(9, 21, '21.1', '10', 5),
(11, 22, '22.1', 'B', 2),
(11, 23, '23.1', 'C', 2),
(11, 24, '24.1', 'B', 2),
(11, 25, '25.1', 'B', 2),
(11, 26, '26.1', 'C', 2),
(11, 27, '27.1', 'C', 2),
(11, 28, '28.1', 'C', 2),
(11, 29, '29.1', 'C', 2),
(11, 30, '30.1', 'B', 2),
(11, 31, '31.1', 'C', 2),
(11, 32, '32.1', 'C', 2),
(11, 33, '33.1', 'C', 2),
(11, 34, '34.1', 'C', 2),
(11, 35, '35.1', 'C', 2),
(11, 36, '36.1', 'C', 2),
(11, 37, '37.1', 'C', 2),
(11, 38, '38.1', 'C', 2),
(11, 39, '39.1', 'B', 2),
(11, 40, '40.1', 'C', 2),
(11, 41, '41.1', 'C', 2),
(11, 42, '42.1', 'C', 2),
(11, 43, '43.1', 'B', 2),
(11, 44, '44.1', 'C', 2),
(11, 45, '45.1', 'C', 2),
(11, 46, '46.1', 'C', 2),
(11, 47, '47.1', 'B', 2),
(11, 48, '48.1', 'C', 2),
(11, 49, '49.1', 'B', 2),
(11, 50, '50.1', 'B', 2),
(11, 51, '51.1', 'C', 2),
(11, 52, '52.1', 'C', 2),
(11, 53, '53.1', 'C', 2),
(11, 54, '54.1', 'C', 2),
(11, 55, '55.1', 'B', 2),
(11, 56, '56.1', 'C', 2),
(11, 57, '57.1', 'B', 2),
(11, 58, '58.1', 'B', 2),
(11, 59, '59.1', 'B', 2),
(11, 60, '60.1', 'B', 2),
(11, 61, '61.1', 'B', 2),
(13, 62, '62.1', 'E', 1),
(13, 63, '63.1', 'A', 1),
(14, 64, '64.1', 'B', 1),
(14, 65, '65.1', 'D', 1),
(14, 66, '66.1', 'A', 1),
(14, 66, '66.2', 'B', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurikulum`
--

CREATE TABLE `kurikulum` (
  `id` int(11) NOT NULL,
  `tingkat` varchar(11) DEFAULT NULL,
  `kuri` varchar(1) DEFAULT NULL,
  `model_rapor` varchar(1) DEFAULT NULL,
  `model_kkm` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `kurikulum`
--

INSERT INTO `kurikulum` (`id`, `tingkat`, `kuri`, `model_rapor`, `model_kkm`) VALUES
(1, '10', '2', '2', NULL),
(2, '11', '2', '2', NULL),
(3, '12', '2', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `k_bayar`
--

CREATE TABLE `k_bayar` (
  `kelas` varchar(50) NOT NULL,
  `idb` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `k_bayar`
--

INSERT INTO `k_bayar` (`kelas`, `idb`) VALUES
('X-2', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lingkup`
--

CREATE TABLE `lingkup` (
  `id` int(11) NOT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `materi` text DEFAULT NULL,
  `smt` varchar(11) DEFAULT NULL,
  `lm` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `lingkup`
--

INSERT INTO `lingkup` (`id`, `mapel`, `level`, `materi`, `smt`, `lm`, `guru`) VALUES
(6, '9', '10', 'Pengenalan Komputer dan Perangkat Keras', '2', '1', '4'),
(7, '9', '10', 'Sistem Operasi Komputer', '2', '2', '4'),
(8, '9', '12', 'tentang komputer dan perangkatnya', '2', '1', '7'),
(9, '9', '12', 'softwer ', '2', '2', '7'),
(10, '9', '10', 'Jaringan', '2', '1', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `id_pegawai` varchar(11) DEFAULT NULL,
  `id_siswa` varchar(11) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `text` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `log`
--

INSERT INTO `log` (`id_log`, `id_pegawai`, `id_siswa`, `type`, `text`, `date`, `level`) VALUES
(1, '1', NULL, 'login', 'Masuk', '2025-06-04 06:16:05', 'Pengawas'),
(2, NULL, '20', 'ujian', 'sedang ujian', '2025-06-04 06:18:12', 'siswa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama_mapel` varchar(50) DEFAULT NULL,
  `sikap` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `kode`, `nama_mapel`, `sikap`) VALUES
(1, 'PABP', 'Penddidikan Agama dan Budi Pekerti', NULL),
(2, 'PPKn', 'Pendidikan Pancasila dan Kewarganegaraan', NULL),
(3, 'BINDO', 'Bahasa Indonesia', NULL),
(4, 'MTK', 'Matematika', NULL),
(5, 'IPA', 'Ilmu Pengetahuan Alam', NULL),
(6, 'IPS', 'Ilmu Pengetahuan Sosial', NULL),
(7, 'BING', 'Bahasa Inggris', NULL),
(8, 'PJOK', 'Pendidikan Jasmani Olahraga dan Kesehatan', NULL),
(9, 'INFO', 'Informatika', NULL),
(10, 'PRK', 'Prakarya', NULL),
(11, 'BSUND', 'Bahasa Sunda', NULL),
(12, 'TIK', 'Tekhnologi Indormasi dan Komunikasi', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_ijazah`
--

CREATE TABLE `mapel_ijazah` (
  `idmapel` int(11) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `namamapel` varchar(100) DEFAULT NULL,
  `kelompok` varchar(50) DEFAULT NULL,
  `urut` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `mapel_ijazah`
--

INSERT INTO `mapel_ijazah` (`idmapel`, `tingkat`, `jurusan`, `kode`, `namamapel`, `kelompok`, `urut`) VALUES
(1, '12', 'UMUM', 'PABP', 'Penddidikan Agama dan Budi Pekerti', 'A', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_rapor`
--

CREATE TABLE `mapel_rapor` (
  `idm` int(11) NOT NULL,
  `urut` int(11) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `tingkat` int(11) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `kelompok` varchar(2) DEFAULT NULL,
  `kkm` int(11) DEFAULT NULL,
  `sikap` varchar(11) DEFAULT NULL,
  `kurikulum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `mapel_rapor`
--

INSERT INTO `mapel_rapor` (`idm`, `urut`, `mapel`, `tingkat`, `jurusan`, `kelompok`, `kkm`, `sikap`, `kurikulum`) VALUES
(1, 1, '3', 10, 'UMUM', NULL, NULL, NULL, '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(255) NOT NULL,
  `id_guru` int(255) DEFAULT NULL,
  `kelas` text DEFAULT NULL,
  `mapel` varchar(255) DEFAULT NULL,
  `judul` text DEFAULT NULL,
  `materi` longtext DEFAULT NULL,
  `quiz` varchar(50) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `id_guru`, `kelas`, `mapel`, `judul`, `materi`, `quiz`, `file`, `tgl_mulai`, `youtube`, `tgl`, `status`) VALUES
(3, 1, 'a:2:{i:0;s:3:\"X-1\";i:1;s:3:\"X-2\";}', 'BINDO', 'Teks Negosiasi', '<h2><strong>Pengertian Teks Negosiasi</strong></h2>\r\n<p>Oleh sebab itu, kita bisa tahu nih, kalau&nbsp;<strong>teks negosiasi adalah&nbsp;teks atau tulisan yang berisi kesepakatan antara dua belah pihak, dengan kepentingan berbeda</strong>.&nbsp;Kesepakatan yang dimaksud ini bisa dalam berbagai keperluan, ya. Contohnya seperti kasus tawar menawar di atas.</p>\r\n<p>Biasanya, dalam kegiatan jual beli, pedagang ingin mendapat untung sebanyak-banyaknya, sedangkan pembeli ingin mendapat harga termurah. Akhirnya, dilakukanlah tawar menawar barang agar diperoleh kesepakatan bersama. Dengan tujuan, penjual masih mendapatkan untung, dan pembeli bisa mendapat barang dengan harga yang lebih murah. Paham sampai sini?</p>\r\n<p>&nbsp;</p>\r\n<h2><strong>Tujuan Teks Negosiasi</strong></h2>\r\n<p>Kalau ditelaah dari pengertiannya, mungkin kamu sudah bisa menebak ya,&nbsp;<strong>tujuan teks negosiasi adalah&nbsp;untuk mencapai kesepakatan bersama</strong>&nbsp;antara dua belah pihak yang memiliki kepentingan berbeda. Nah, teks negosiasi nggak hanya digunakan oleh penjual dan pembeli dalam melakukan penawaran bisnis, tapi juga mencari jalan keluar dari masalah yang dihadapi bersama.</p>\r\n<p>&nbsp;</p>\r\n<h2><strong>Ciri-Ciri Teks Negosiasi</strong></h2>\r\n<p>Seperti jenis teks yang lain, teks negosiasi juga memiliki karakteristik atau ciri yang membedakannya dengan teks-teks lainnya. Ciri-ciri teks negosiasi, antara lain:</p>\r\n<ul>\r\n<li>Menghasilkan kesepakatan</li>\r\n<li>Menghasilkan keputusan yang saling menguntungkan</li>\r\n<li>Memprioritaskan kepentingan bersama</li>\r\n<li>Sarana untuk mencari penyelesaian</li>\r\n<li>Mengarah pada tujuan praktis</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p><strong><img src=\"https://cdn-web.ruangguru.com/landing-pages/assets/hs/Ciri-Ciri%20Teks%20Negosiasi.jpg\" alt=\"Ciri-Ciri Teks Negosiasi\" width=\"600\" /></strong></p>', NULL, 'X_Bahasa-Indonesia_KD-3.11_Final.pdf', '2025-05-05 08:00:00', 'FUXuxWH7k7hrcdQY', '2025-05-05', NULL),
(4, 2, 'a:1:{i:0;s:3:\"X-2\";}', 'INFO', 'Materi informatika', '<p>klik link untuk mempelajari materi ini</p>', NULL, NULL, '2025-05-28 15:56:00', 'https://youtube.com', '2025-05-28', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mesin_absen`
--

CREATE TABLE `mesin_absen` (
  `id` int(11) NOT NULL,
  `mesin` varchar(100) DEFAULT NULL,
  `depan` text DEFAULT NULL,
  `belakang` text DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `mesin_absen`
--

INSERT INTO `mesin_absen` (`id`, `mesin`, `depan`, `belakang`, `model`) VALUES
(1, 'RFID', '', '', 'Potrait'),
(2, 'BARCODE', 'depan74.png', 'belakang70.png', 'Potrait'),
(3, 'FINGER PRINT', 'depan31.png', 'belakang53.png', 'Potrait'),
(4, 'FACE RECOGNITION', 'depan21.jpg', 'belakang40.png', 'Landscape');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_bayar`
--

CREATE TABLE `m_bayar` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `model` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `angsuran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_bayar`
--

INSERT INTO `m_bayar` (`id`, `kode`, `nama`, `model`, `jumlah`, `total`, `angsuran`) VALUES
(1, 'SP-2049', 'SPP', 2, 12, 150000, 12500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_buku`
--

CREATE TABLE `m_buku` (
  `idm` int(11) NOT NULL,
  `kategori` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `rak` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_dimensi`
--

CREATE TABLE `m_dimensi` (
  `id_dimensi` int(11) NOT NULL,
  `dimensi` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_dimensi`
--

INSERT INTO `m_dimensi` (`id_dimensi`, `dimensi`) VALUES
(1, 'Beriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia'),
(2, 'Berkebhinekaan Global'),
(3, 'Bergotong-Royong'),
(4, 'Mandiri'),
(5, 'Bernalar Kritis'),
(6, 'Kreatif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_elemen`
--

CREATE TABLE `m_elemen` (
  `id_elemen` int(11) NOT NULL,
  `iddimensi` int(11) NOT NULL,
  `elemen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_elemen`
--

INSERT INTO `m_elemen` (`id_elemen`, `iddimensi`, `elemen`) VALUES
(1, 1, 'Akhlak Beragama'),
(2, 1, 'Akhlak Pribadi'),
(3, 1, 'Akhlak Kepada Manusia'),
(4, 1, 'Akhlak Kepada Alam'),
(5, 1, 'Akhlak Bernegara'),
(6, 2, 'Mengenal dan menghargai budaya'),
(7, 2, 'Komunikasi dan interaksi antar budaya'),
(8, 2, 'Refleksi dan bertanggung jawab terhadap pengalaman kebinekaan'),
(9, 2, 'Berkeadilan Sosial'),
(10, 3, 'Kolaborasi'),
(11, 3, 'Kepedulian'),
(12, 3, 'Berbagi'),
(13, 4, 'Pemahaman diri dan situasi yang dihadap'),
(14, 4, 'Regulasi Diri'),
(15, 5, 'Memperoleh dan memproses informasi dan gagasan'),
(16, 5, 'Menganalisis dan mengevaluasi penalaran dan prosedurnya'),
(17, 5, 'Refleksi pemikiran dan proses berpikir'),
(18, 6, 'Menghasilkan gagasan yang orisinal'),
(19, 6, 'Menghasilkan karya dan tindakan yang orisinal'),
(20, 6, 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_eskul`
--

CREATE TABLE `m_eskul` (
  `id` int(11) NOT NULL,
  `eskul` varchar(100) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_eskul`
--

INSERT INTO `m_eskul` (`id`, `eskul`, `guru`) VALUES
(1, 'Pramuka', 2),
(2, 'Coding', 48);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_hari`
--

CREATE TABLE `m_hari` (
  `idh` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `inggris` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_hari`
--

INSERT INTO `m_hari` (`idh`, `hari`, `inggris`) VALUES
(1, 'Senin', 'Mon'),
(2, 'Selasa', 'Tue'),
(3, 'Rabu', 'Wed'),
(4, 'Kamis', 'Thu'),
(5, 'Jumat', 'Fri'),
(6, 'Sabtu', 'Sat'),
(7, 'Minggu', 'Sun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kurikulum`
--

CREATE TABLE `m_kurikulum` (
  `idk` int(11) NOT NULL,
  `nama_kurikulum` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_kurikulum`
--

INSERT INTO `m_kurikulum` (`idk`, `nama_kurikulum`) VALUES
(1, 'K-13'),
(2, 'K-Merdeka');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_lemari`
--

CREATE TABLE `m_lemari` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_lemari`
--

INSERT INTO `m_lemari` (`id`, `kode`, `nama`, `lokasi`) VALUES
(2, 'LM-I', 'LEMARI I', 'KANTOR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_nilai_proyek`
--

CREATE TABLE `m_nilai_proyek` (
  `nilai` varchar(3) NOT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `m_nilai_proyek`
--

INSERT INTO `m_nilai_proyek` (`nilai`, `ket`) VALUES
('BB', 'Belum Berkembang'),
('BSH', 'Berkembang Sesuai Harapan'),
('MB', 'Mulai Berkembang'),
('SB', 'Sangat Berkembang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_pesan`
--

CREATE TABLE `m_pesan` (
  `id` int(11) NOT NULL,
  `pesan1` mediumtext DEFAULT NULL,
  `pesan2` mediumtext DEFAULT NULL,
  `pesan3` mediumtext DEFAULT NULL,
  `pesan4` mediumtext DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_pesan`
--

INSERT INTO `m_pesan` (`id`, `pesan1`, `pesan2`, `pesan3`, `pesan4`, `ket`) VALUES
(1, 'Assalamualaikum wr.wb', 'Kami informasikan Bahwa Ananda :', 'Telah hadir dalam KBM SMP NEW SANDIK menggunakan Absesi Digital RFID pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(2, 'Assalamualaikum wr.wb.......', 'Kami informasikan Bahwa Ananda :', 'Telah selesai melaksanakan KBM SMP NEW SANDIK menggunakan Absesi Digital RFID pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(3, 'Assalamualaikum wr.wb.', 'Kami informasikan kepada Kepala Sekolah SMP IT Utsman Bin Affan bahwa Sdr/i :', 'Telah hadir dalam KBM SMP IT Utsman Bin Affan menggunakan Absesi Digital *RFID* pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP IT Utsman Bin Affan*', NULL),
(4, 'Assalamualaikum wr.wb.......', 'Kami informasikan kepada Kepala Sekolah SMP NEW SANDIK Bahwa Sdr/i :', 'Telah selesai dalam KBM SMP NEW SANDIK menggunakan Absesi Digital *RFID* pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(5, 'Assalamualaikum wr.wb', 'Kami informasikan Bahwa Ananda', 'Telah hadir dalam Kegiatan Ekstrakurikuler menggunakan Absesi Digital RFID pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(6, 'Assalamualaikum wr.wb.......', 'Kami informasikan Bahwa Ananda', 'Telah selesai dalam mengikuti Kegiatan Ekstrakurikuler menggunakan Absesi Digital RFID pada ', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(7, 'Assalamualaikum wr.wb', 'Kami informasikan kepada Kepala Sekolah SMP NEW SANDIK Bahwa Sdr/i :', 'Telah hadir dalam Kegiatan Ekstrakurikuler SMP NEW SANDIK menggunakan Absesi Digital *RFID* pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL),
(8, 'Assalamualaikum wr.wb.......', 'Kami informasikan kepada Kepala Sekolah SMP NEW SANDIK Bahwa Sdr/i :', 'Telah selesai dalam Kegiatan Ekstrakurikuler SMP NEW SANDIK menggunakan Absesi Digital *RFID* pada', 'Demikian Informasi kami sampaikan untuk menjadi Sarana Monitoring Kepala Sekolah terhadap para pegawai. Terima kasih dan salam hangat dari Kami,Pesan ini tidak perlu dibalas dikirim via *SERVER WA GATEWAY SMP NEW SANDIK*', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_proyek`
--

CREATE TABLE `m_proyek` (
  `id` int(11) NOT NULL,
  `ke` varchar(50) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `fase` varchar(1) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `judul` mediumtext DEFAULT NULL,
  `deskripsi` mediumtext DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_proyek`
--

INSERT INTO `m_proyek` (`id`, `ke`, `tingkat`, `fase`, `kelas`, `judul`, `deskripsi`, `semester`) VALUES
(1, 'Proyek 1', '10', 'E', 'X-A', 'budaya', 'budaya indonesia', 2),
(2, 'Proyek 1', '11', 'F', 'XI-A', 'budaya 11', 'budaya indonesia 11', 2),
(3, 'Proyek 2', '10', 'E', 'X-A', 'tanah air', 'tanah airku', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_rapor`
--

CREATE TABLE `m_rapor` (
  `idr` int(11) NOT NULL,
  `kuri` int(11) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_rapor`
--

INSERT INTO `m_rapor` (`idr`, `kuri`, `model`) VALUES
(1, 1, 'Model 2016'),
(2, 2, 'Model Kurmer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_spiritual`
--

CREATE TABLE `m_spiritual` (
  `id` int(11) NOT NULL,
  `ket` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_spiritual`
--

INSERT INTO `m_spiritual` (`id`, `ket`) VALUES
(1, 'berdoa sebelum dan sesudah melakukan kegiatan'),
(2, 'menjalankan ibadah sesuai dengan agamanya'),
(3, 'memberi salam pada saat awal dan akhir kegiatan'),
(4, 'bersyukur atas nikmat dan karunia Tuhan Yang Maha Esa'),
(5, 'bersyukur ketika berhasil mengerjakan sesuatu'),
(6, 'berserah diri (tawakal) kepada Tuhan setelah berikhtiar atau melakukan usaha'),
(7, 'memelihara hubungan baik dengan sesama umat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sub_elemen`
--

CREATE TABLE `m_sub_elemen` (
  `id_sub` int(11) NOT NULL,
  `iddimensi` int(11) NOT NULL,
  `idelemen` int(11) NOT NULL,
  `sub_elemen` varchar(100) NOT NULL,
  `A` mediumtext DEFAULT NULL,
  `B` mediumtext DEFAULT NULL,
  `C` mediumtext DEFAULT NULL,
  `D` mediumtext DEFAULT NULL,
  `E` mediumtext DEFAULT NULL,
  `F` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `m_sub_elemen`
--

INSERT INTO `m_sub_elemen` (`id_sub`, `iddimensi`, `idelemen`, `sub_elemen`, `A`, `B`, `C`, `D`, `E`, `F`) VALUES
(1, 1, 1, 'Mengenal dan Mencintai Tuhan Yang Maha Esa', 'Mengenali sifat-sifat utama Tuhan bahwa Ia Maha Esa dan Ia adalah Sang Pencipta yang Maha Pengasih dan Maha Penyayang dan mengenali kebaikan dirinya sebagai cerminan sifat Tuhan', 'Memahami sifat-sifat Tuhan utama lainnya dan mengaitkan sifatsifat tersebut dengan konsep dirinya dan ciptaan-Nya', 'Memahami berbagai kualitas atau sifat-sifat Tuhan yang diutarakan dalam kitab suci agama masing-masing dan menghubungkan kualitas-kualitas positif Tuhan dengan sikap pribadinya, serta meyakini firman Tuhan sebagai kebenaran', 'Memahami kehadiran Tuhan dalam kehidupan sehari-hari serta mengaitkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dengan konsep peran manusia di bumi sebagai makhluk Tuhan yang bertanggung jawab', 'Menerapkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dalam ritual ibadahnya baik ibadah yang bersifat personal maupun sosial.', NULL),
(2, 1, 1, 'Pemahaman Agama/Kepercayaan', 'Mengenali unsur-unsur utama agama/kepercayaan (ajaran, ritual keagamaan, kitab suci, dan orang suci/ utusan Tuhan YME).', 'Mengenali unsur-unsur utama agama/kepercayaan (simbol-simbol keagamaan dan sejarah agama/ kepercayaan)', 'Memahami berbagai kualitas atau sifat-sifat Tuhan yang diutarakan dalam kitab suci agama masing-masing dan menghubungkan kualitas-kualitas positif Tuhan dengan sikap pribadinya, serta meyakini firman Tuhan sebagai kebenaran', 'Memahami kehadiran Tuhan dalam kehidupan sehari-hari serta mengaitkan pemahamannya tentang kualitas atau sifat-sifat Tuhan dengan konsep peran manusia di bumi sebagai makhluk Tuhan yang bertanggung jawab', 'Memahami struktur organisasi, unsur-unsur utama agama /kepercayaan dalam konteks Indonesia, memahami kontribusi agama/kepercayaan terhadap peradaban dunia.', NULL),
(3, 1, 1, 'Pelaksanaan Ritual Ibadah', 'Terbiasa melaksanakan ibadah sesuai ajaran agama/kepercayaannya', 'Terbiasa melaksanakan ibadah wajib sesuai tuntunan agama/kepercayaannya', 'Melaksanakan ibadah secara rutin sesuai dengan tuntunan agama/kepercayaan, berdoa mandiri, merayakan, dan memahami makna hari-hari besarnya', 'Melaksanakan ibadah secara rutin dan mandiri sesuai dengan tuntunan agama/kepercayaan, serta berpartisipasi pada perayaan hari-hari besarnya\r\n', 'Melaksanakan ibadah secara rutin dan mandiri serta menyadari arti penting ibadah tersebut dan berpartisipasi aktif pada kegiatan keagamaan atau kepercayaan', NULL),
(4, 1, 2, 'Integritas', 'Membiasakan bersikap jujur terhadap diri sendiri dan orang lain dan berani menyampaikan kebenaran atau fakta', 'Membiasakan melakukan refleksi tentang pentingnya bersikap jujur dan berani menyampaikan kebenaran atau fakta', 'Berani dan konsisten menyampaikan kebenaran atau fakta serta memahami konsekuensi-konsekuensinya untuk diri sendiri', 'Berani dan konsisten menyampaikan kebenaran atau fakta serta memahami konsekuensi-konsekuensinya untuk diri sendiri dan orang lain', 'Menyadari bahwa aturan agama dan sosial merupakan aturan yang baik dan menjadi bagian dari diri sehingga bisa menerapkannya secara bijak dan kontekstual', NULL),
(5, 1, 2, 'Merawat Diri secara Fisik, Mental dan Spiritual', 'Memiliki rutinitas sederhana yang diatur secara mandiri dan dijalankan sehari-hari serta menjaga kesehatan dan keselamatan/keamanan diri dalam semua aktivitas kesehariannya.\r\n', 'Mulai membiasakan diri untuk disiplin, rapi, membersihkan dan merawat tubuh, menjaga tingkah laku dan perkataan dalam semua aktivitas kesehariannya', 'Memperhatikan kesehatan jasmani, mental, dan rohani dengan melakukan aktivitas fisik, sosial, dan ibadah', 'Mengidentifikasi pentingnya menjaga keseimbangan kesehatan jasmani, mental, dan rohani serta berupaya menyeimbangkan aktivitas fisik, sosial dan ibadah', 'Melakukan aktivitas fisik, sosial, dan ibadah secara seimbang.', NULL),
(6, 1, 3, 'Mengutamakan persamaan dengan orang lain dan menghargai perbedaan', 'Mengenali hal-hal yang sama dan berbeda yang dimiliki diri dan temannya dalam berbagai hal, serta memberikan respon secara positif.', 'Terbiasa mengidentifikasi hal-hal yang sama dan berbeda yang dimiliki diri dan temannya dalam berbagai hal serta memberikan respon secara positif.', 'Mengidentifikasi kesamaan dengan orang lain sebagai perekat hubungan sosial dan mewujudkannya dalam aktivitas kelompok. Mulai mengenal berbagai kemungkinan interpretasi dan cara pandang yang berbeda ketika dihadapkan dengan dilema.', 'Mengenal perspektif dan emosi/perasaan dari sudut pandang orang atau kelompok lain yang tidak pernah dijumpai atau dikenalnya. Mengutamakan persamaan dan menghargai perbedaan sebagai alat pemersatu dalam keadaan konflik atau perdebatan.', 'Mengidentifikasi hal yang menjadi permasalahan bersama, memberikan alternatif solusi untuk menjembatani perbedaan dengan mengutamakan kemanusiaan.', NULL),
(7, 1, 3, 'Berempati kepada orang lain', 'Mengidentifikasi emosi, minat dan kebutuhan orang-orang terdekat dan meresponnya secara positif.', 'Terbiasa memberikan apresiasi di lingkungan sekolah dan masyarakat', 'Mulai memandang sesuatu dari perspektif orang lain serta mengidentifikasi kebaikan dan kelebihan orang sekitarnya.', 'Memahami perasaan dan sudut pandang orang dan/atau kelompok lain yang tidak pernah dikenalnya', 'Memahami dan menghargai perasaan dan sudut pandang orang dan/atau kelompok lain.', NULL),
(8, 1, 4, 'Memahami Keterhubungan Ekosistem Bumi', 'Mengidentifikasi berbagai ciptaan Tuhan', 'Memahami keterhubungan antara satu ciptaan dengan ciptaan Tuhan yang lainnya', 'Memahami konsep harmoni dan mengidentifikasi adanya saling ketergantungan antara berbagai ciptaan Tuhan', 'Memahami konsep sebab-akibat di antara berbagai ciptaan Tuhan dan mengidentifikasi berbagai sebab yang mempunyai dampak baik atau buruk, langsung maupun tidak langsung, terhadap alam semesta.\r\n', 'Mengidentifikasi masalah lingkungan hidup di tempat ia tinggal dan melakukan langkah-langkah konkrit yang bisa dilakukan untuk menghindari kerusakan dan menjaga keharmonisan ekosistem yang ada di lingkungannya.', NULL),
(9, 1, 4, 'Menjaga Lingkungan Alam Sekitar', 'Membiasakan bersyukur atas lingkungan alam sekitar dan berlatih untuk menjaganya\r\n', 'Terbiasa memahami tindakan-tindakan yang ramah dan tidak ramah lingkungan serta membiasakan diri untuk berperilaku ramah lingkungan\r\n', 'Mewujudkan rasa syukur dengan terbiasa berperilaku ramah lingkungan dan memahami akibat perbuatan tidak ramah lingkungan dalam lingkup kecil maupun besar.\r\n', 'Mewujudkan rasa syukur dengan berinisiatif untuk menyelesaikan permasalahan lingkungan alam sekitarnya dengan mengajukan alternatif solusi dan mulai menerapkan solusi tersebut.\r\n', 'Mewujudkan rasa syukur dengan membangun kesadaran peduli lingkungan alam dengan menciptakan dan mengimplementasikan solusi dari permasalahan lingkungan yang ada.', NULL),
(10, 1, 5, 'Melaksanakan Hak dan Kewajiban sebagai Warga Negara Indonesia', 'Mengidentifikasi hak dan tanggung jawabnya di rumah, sekolah, dan lingkungan sekitar serta kaitannya dengan keimanan kepada Tuhan YME.\r\n\r\n', 'Mengidentifikasi hak dan tanggung jawab orang-orang di sekitarnya serta kaitannya dengan keimanan kepada Tuhan YME.\r\n', 'Mengidentifikasi dan memahami peran, hak, dan kewajiban dasar sebagai warga negara serta kaitannya dengan keimanan kepada Tuhan YME dan secara sadar mempraktikkannya dalam kehidupan sehari-hari.\r\n', 'Menganalisa peran, hak, dan kewajiban sebagai warga negara, memahami perlunya mengutamakan kepentingan umum di atas kepentingan pribadi sebagai wujud dari keimanannya kepada Tuhan YME.\r\n', 'Memperoleh hak dan melaksanakan kewajiban kewarganegaraan dan terbiasa mendahulukan kepentingan umum di atas kepentingan pribadi sebagai wujud dari keimanannya kepada Tuhan YME.', NULL),
(11, 2, 6, 'Mendalami budaya dan identitas budaya', 'Mengidentifikasi dan mendeskripsikan ide-ide tentang dirinya dan beberapa macam kelompok di lingkungan sekitarnya\r\n', 'Mengidentifikasi dan mendeskripsikan ide-ide tentang dirinya dan berbagai macam kelompok di lingkungan sekitarnya, serta cara orang lain berperilaku dan berkomunikasi dengannya.\r\n', 'Mengidentifikasi dan mendeskripsikan keragaman budaya di sekitarnya; serta menjelaskan peran budaya dan Bahasa dalam membentuk identitas dirinya.\r\n', 'Menjelaskan perubahan budaya seiring waktu dan sesuai konteks, baik dalam skala lokal, regional, dan nasional. Menjelaskan identitas diri yang terbentuk dari budaya bangsa.\r\n', 'Menganalisis pengaruh keanggotaan kelompok lokal, regional, nasional, dan global terhadap pembentukan identitas, termasuk identitas dirinya. Mulai menginternalisasi identitas diri sebagai bagian dari budaya bangsa.', NULL),
(12, 2, 6, 'Mengeksplorasi dan membandingkan pengetahuan budaya, kepercayaan, serta praktiknya', 'Mengidentifikasi dan mendeskripsikan praktik keseharian diri dan budayanya\r\n', 'Mengidentifikasi dan membandingkan praktik keseharian diri dan budayanya dengan orang lain di tempat dan waktu/era yang berbeda.\r\n', 'Mendeskripsikan dan membandingkan pengetahuan, kepercayaan, dan praktik dari berbagai kelompok budaya.\r\n', 'Memahami dinamika budaya yang mencakup pemahaman, kepercayaan, dan praktik keseharian dalam konteks personal dan sosial.\r\n', 'Menganalisis dinamika budaya yang mencakup pemahaman, kepercayaan, dan praktik keseharian dalam rentang waktu yang panjang dan konteks yang luas.', NULL),
(13, 2, 6, 'Menumbuhkan rasa menghormati terhadap keanekaragaman budaya', 'Mendeskripsikan pengalaman dan pemahaman hidup bersama-sama dalam kemajemukan.\r\n', 'Memahami bahwa kemajemukan dapat memberikan kesempatan untuk mendapatkan pengalaman dan pemahaman yang baru.\r\n', 'Mengidentifikasi peluang dan tantangan yang muncul dari keragaman budaya di Indonesia.\r\n', 'Memahami pentingnya melestarikan dan merayakan tradisi budaya untuk mengembangkan identitas pribadi, sosial, dan bangsa Indonesia serta mulai berupaya melestarikan budaya dalam kehidupan sehari-hari.\r\n', 'Memahami pentingnya saling menghormati dalam mempromosikan pertukaran budaya dan kolaborasi dalam dunia yang saling terhubung serta menunjukkannya dalam perilaku.', NULL),
(14, 2, 7, 'Berkomunikasi antar budaya', 'Mengenali bahwa diri dan orang lain menggunakan kata, gambar, dan bahasa tubuh yang dapat memiliki makna yang berbeda di lingkungan sekitarnya\r\n', 'Mendeskripsikan penggunaan kata, tulisan dan bahasa tubuh yang memiliki makna yang berbeda di lingkungan sekitarnya dan dalam suatu budaya tertentu.\r\n', 'Memahami persamaan dan perbedaan cara komunikasi baik di dalam maupun antar kelompok budaya.\r\n', 'Mengeksplorasi pengaruh budaya terhadap penggunaan bahasa serta dapat mengenali risiko dalam berkomunikasi antar budaya.\r\n', 'Menganalisis hubungan antara bahasa, pikiran, dan konteks untuk memahami dan meningkatkan komunikasi antar budaya yang berbeda-beda.', NULL),
(15, 2, 7, 'Mempertimbangkan dan menumbuhkan berbagai perspektif', 'Mengekspresikan pandangannya terhadap topik yang umum dan mendengarkan sudut pandang orang lain yang berbeda dari dirinya dalam lingkungan keluarga dan sekolah\r\n', 'Mengekspresikan pandangannya terhadap topik yang umum dan dapat mengidentifikasi sudut pandang orang lain. Mendengarkan dan membayangkan sudut pandang orang lain yang berbeda dari dirinya pada situasi di ranah sekolah, keluarga, dan lingkungan sekitar.\r\n', 'Membandingkan beragam perspektif untuk memahami permasalahan sehari-hari. Membayangkan dan mendeskripsikan situasi komunitas yang berbeda dengan dirinya ke dalam situasi dirinya dalam konteks lokal dan regional.\r\n', 'Menjelaskan asumsi-asumsi yang mendasari perspektif tertentu. Membayangkan dan mendeskripsikan perasaan serta motivasi komunitas yang berbeda dengan dirinya yang berada dalam situasi yang sulit.\r\n', 'Menyajikan pandangan yang seimbang mengenai permasalahan yang dapat menimbulkan pertentangan pendapat. Memperlakukan orang lain dan budaya yang berbeda darinya dalam posisi setara dengan diri dan budayanya, serta bersedia memberikan pertolongan ketika orang lain berada dalam situasi sulit.', NULL),
(16, 2, 8, 'Refleksi terhadap pengalaman kebinekaan', 'Menyebutkan apa yang telah dipelajari tentang orang lain dari interaksinya dengan kemajemukan budaya di lingkungan sekolah dan rumah\r\n', 'Menyebutkan apa yang telah dipelajari tentang orang lain dari interaksinya dengan kemajemukan budaya di lingkungan sekitar.\r\n', 'Menjelaskan apa yang telah dipelajari dari interaksi dan pengalaman dirinya dalam lingkungan yang beragam.\r\n', 'Merefleksikan secara kritis gambaran berbagai kelompok budaya yang ditemui dan cara meresponnya.\r\n', 'Merefleksikan secara kritis dampak dari pengalaman hidup di lingkungan yang beragam terkait dengan perilaku, kepercayaan serta tindakannya terhadap orang lain.', NULL),
(17, 2, 8, 'Menghilangkan stereotip dan prasangka', 'Mengenali perbedaan tiap orang atau kelompok dan menganggapnya sebagai kewajaran\r\n', 'Mengkonfirmasi dan mengklarifikasi stereotip dan prasangka yang dimilikinya tentang orang atau kelompokdi sekitarnya untuk mendapatkan pemahaman yang lebih baik\r\n', 'Mengkonfirmasi dan mengklarifikasi stereotip dan prasangka yang dimilikinya tentang orang atau kelompok di sekitarnya untuk mendapatkan pemahaman yang lebih baik serta mengidentifikasi pengaruhnya terhadap individu dan kelompok di lingkungan sekitarnya\r\n', 'Mengkonfirmasi, mengklarifikasi dan menunjukkan sikapmenolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa.\r\n', 'Mengkritik dan menolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa serta berinisiatif mengajak orang lain untuk menolak stereotip dan prasangka.', NULL),
(18, 2, 8, 'Menyelaraskan perbedaan budaya', 'Mengidentifikasi perbedaan-perbedaan budaya yang konkrit di lingkungan sekitar\r\n', 'Mengenali bahwa perbedaan budaya mempengaruhi pemahaman antarindividu.\r\n', 'Mencari titik temu nilai budaya yang beragam untuk menyelesaikan permasalahan bersama.\r\n', 'Mengkonfirmasi, mengklarifikasi dan menunjukkan sikapmenolak stereotip serta prasangka tentang gambaran identitas kelompok dan suku bangsa.\r\n', 'Mengetahui tantangan dan keuntungan hidup dalam lingkungan dengan budaya yang beragam, serta memahami pentingnya kerukunan antar budaya dalam kehidupan bersama yang harmonis.', NULL),
(19, 2, 9, 'Aktif membangun masyarakat yang inklusif, adil, dan berkelanjutan\r\n', 'Menjalin pertemanan tanpa memandang perbedaan agama, suku, ras, jenis kelamin, dan perbedaan lainnya, dan mengenal masalah-masalah sosial, ekonomi, dan lingkungan di lingkungan sekitarnya\r\n', 'Mengidentifikasi cara berkontribusi terhadap lingkungan sekolah, rumah dan lingkungan sekitarnya yang inklusif, adil dan berkelanjutan\r\n', 'Membandingkan beberapa tindakan dan praktik perbaikan lingkungan sekolah yang inklusif, adil, dan berkelanjutan, dengan mempertimbangkan dampaknya secara jangka panjang terhadap manusia, alam, dan masyarakat\r\n', 'Mengidentifikasi masalah yang ada di sekitarnya sebagai akibat dari pilihan yang dilakukan oleh manusia, serta dampak masalah tersebut terhadap sistem ekonomi, sosial dan lingkungan, serta mencari solusi yang memperhatikan prinsip-prinsip keadilan terhadap manusia, alam dan masyarakat\r\n', 'Berinisiatif melakukan suatu tindakan berdasarkan identifikasi masalah untuk mempromosikan keadilan, keamanan ekonomi, menopang ekologi dan demokrasi sambil menghindari kerugian jangka panjang terhadap manusia, alam ataupun masyarakat.\r\n', NULL),
(20, 2, 9, 'Berpartisipasi dalam proses pengambilan keputusan bersama', 'Mengidentifikasi pilihan-pilihan berdasarkan kebutuhan dirinya dan orang lain ketika membuat keputusan\r\n', 'Berpartisipasi menentukan beberapa pilihan untuk keperluan bersama berdasarkan kriteria sederhana\r\n', 'Berpartisipasi dalam menentukan kriteria yang disepakati bersama untuk menentukan pilihan dan keputusan untuk kepentingan bersama\r\n', 'Berpartisipasi dalam menentukan kriteria dan metode yang disepakati bersama untuk menentukan pilihan dan keputusan untuk kepentingan bersama melalui proses bertukar pikiran secara cermat dan terbuka dengan panduan pendidik\r\n', 'Berpartisipasi menentukan pilihan dan keputusan untuk kepentingan bersama melalui proses bertukar pikiran secara cermat dan terbuka secara mandiri\r\n', NULL),
(21, 2, 9, 'Memahami peran individu dalam demokrasi', 'Mengidentifikasi peran, hak dan kewajiban warga dalam masyarakat demokratis\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap perilakunya.\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap perilakunya. Menggunakan konsep ini untuk menjelaskan perilaku diri dan orang sekitarnya\r\n', 'Memahami konsep hak dan kewajiban serta implikasinya terhadap ekspresi dan perilakunya. Mulai aktif mengambil sikap dan langkah untuk melindungi hak orang/kelompok lain.\r\n', 'Memahami konsep hak dan kewajiban, serta implikasinya terhadap ekspresi dan perilakunya. Mulai mencari solusi untuk dilema terkait konsep hak dan kewajibannya.\r\n', NULL),
(22, 3, 10, 'Kerja sama', 'Menerima dan melaksanakan tugas serta peran yang diberikan kelompok dalam sebuah kegiatan bersama.\r\n', 'Menampilkan tindakan yang sesuai dengan harapan dan tujuan kelompok.\r\n', 'Menunjukkan ekspektasi (harapan) positif kepada orang lain dalam rangka mencapai tujuan kelompok di lingkungan sekitar (sekolah dan rumah).\r\n', 'Menyelaraskan tindakan sendiri dengan tindakan orang lain untuk melaksanakan kegiatan dan mencapai tujuan kelompok di lingkungan sekitar, serta memberi semangat kepada orang lain untuk bekerja efektif dan mencapai tujuan bersama.\r\n', 'Membangun tim dan mengelola kerjasama untuk mencapai tujuan bersama sesuai dengan target yang sudah ditentukan.\r\n', NULL),
(23, 3, 10, 'Komunikasi untuk mencapai tujuan bersama', 'Memahami informasi sederhana dari orang lain dan menyampaikan informasi sederhana kepada orang lain menggunakan kata-katanya sendiri.\r\n', 'Memahami informasi yang disampaikan (ungkapan pikiran, perasaan, dan keprihatinan) orang lain dan menyampaikan informasi secara akurat menggunakan berbagai simbol dan media\r\n', 'Memahami informasi dari berbagai sumber dan menyampaikan pesan menggunakan berbagai simbol dan media secara efektif kepada orang lain untuk mencapai tujuan bersama\r\n', 'Memahami informasi, gagasan, emosi, keterampilan dan keprihatinan yang diungkapkan oleh orang lain menggunakan berbagai simbol dan media secara efektif, serta memanfaatkannya untuk meningkatkan kualitas hubungan interpersonal guna mencapai tujuan bersama.\r\n', 'Aktif menyimak untuk memahami dan menganalisis informasi, gagasan, emosi, keterampilan dan keprihatinan yang disampaikan oleh orang lain dan kelompok menggunakan berbagai simbol dan media secara efektif, serta menggunakan berbagai strategi komunikasi untuk menyelesaikan masalah guna mencapai berbagai tujuan bersama.\r\n', NULL),
(24, 3, 10, 'Saling-ketergantungan positif', 'Mengenali kebutuhan-kebutuhan diri sendiri yang memerlukan orang lain dalam pemenuhannya.\r\n', 'Menyadari bahwa setiap orang membutuhkan orang lain dalam memenuhi kebutuhannya dan perlunya saling membantu\r\n', 'Menyadari bahwa meskipun setiap orang memiliki otonominya masing-masing, setiap orang membutuhkan orang lain dalam memenuhi kebutuhannya.\r\n', 'Mendemonstrasikan kegiatan kelompok yang menunjukkan bahwa anggota kelompok dengan kelebihan dan kekurangannya masing-masing perlu dan dapat saling membantu memenuhi kebutuhan.\r\n', 'Menyelaraskan kapasitas kelompok agar para anggota kelompok dapat saling membantu satu sama lain memenuhi kebutuhan mereka baik secara individual maupun kolektif.\r\n', NULL),
(25, 3, 10, 'Koordinasi Sosial', 'Melaksanakan aktivitas kelompok sesuai dengan kesepakatan bersama dengan bimbingan, dan saling mengingatkan adanya kesepakatan tersebut.\r\n', 'Menyadari bahwa dirinya memiliki peran yang berbeda dengan orang lain/temannya, serta mengetahui konsekuensi perannya terhadap ketercapaian tujuan.\r\n', 'Menyelaraskan tindakannya sesuai dengan perannya dan mempertimbangkan peran orang lain untuk mencapai tujuan bersama.\r\n', 'Membagi peran dan menyelaraskan tindakan dalam kelompok serta menjaga tindakan agar selaras untuk mencapai tujuan bersama.\r\n', 'Menyelaraskan dan menjaga tindakan diri dan anggota kelompok agar sesuai antara satu dengan lainnya serta menerima konsekuensi tindakannya dalam rangka mencapai tujuan bersama.\r\n', NULL),
(26, 3, 11, 'Tanggap terhadap lingkungan Sosial', 'Peka dan mengapresiasi orang-orang di lingkungan sekitar, kemudian melakukan tindakan sederhana untuk mengungkapkannya.\r\n', 'Peka dan mengapresiasi orang-orang di lingkungan sekitar, kemudian melakukan tindakan untuk menjaga keselarasan dalam berelasi dengan orang lain.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan menjaga keselarasan dalam berelasi dengan orang lain.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan berkontribusi sesuai dengan kebutuhan masyarakat.\r\n', 'Tanggap terhadap lingkungan sosial sesuai dengan tuntutan peran sosialnya dan berkontribusi sesuai dengan kebutuhan masyarakat untuk menghasilkan keadaan yang lebih baik.\r\n', NULL),
(27, 3, 11, 'Persepsi sosial', 'Mengenali berbagai reaksi orang lain di lingkungan sekitar dan penyebabnya.\r\n', 'Memahami berbagai alasan orang lain menampilkan respon tertentu\r\n', 'Menerapkan pengetahuan mengenai berbagai reaksi orang lain dan penyebabnya dalam konteks keluarga, sekolah, serta pertemanan dengan sebaya.\r\n', 'Menggunakan pengetahuan tentang sebab dan alasan orang lain menampilkan reaksi tertentu untuk menentukan tindakan yang tepat agar orang lain menampilkan respon yang diharapkan.\r\n', 'Melakukan tindakan yang tepat agar orang lain merespon sesuai dengan yang diharapkan dalam rangka penyelesaian pekerjaan dan pencapaian tujuan.\r\n', NULL),
(28, 3, 12, 'Berbagi', 'Memberi dan menerima hal yang dianggap berharga dan penting kepada/dari orang-orang di lingkungan sekitar.\r\n', '\"\r\nMemberi dan menerima hal yang dianggap penting dan berharga kepada/dari orang-orang di lingkungan sekitar baik yang dikenal maupun tidak dikenal.\"\r\n', 'Memberi dan menerima hal yang dianggap penting dan berharga kepada/dari orang-orang di lingkungan luas/masyarakat baik yang dikenal maupun tidak dikenal.\r\n', '\"\r\nMengupayakan memberi hal yang dianggap penting dan berharga kepada masyarakat yang membutuhkan bantuan di sekitar tempat tinggal\"\r\n', 'Mengupayakan memberi hal yang dianggap penting dan berharga kepada orang-orang yang membutuhkan di masyarakat yang lebih luas (negara, dunia).\r\n', NULL),
(29, 4, 13, 'Mengenali kualitas dan minat diri serta tantangan yang dihadapi', 'Mengidentifikasi dan menggambarkan kemampuan, prestasi, dan ketertarikannya secara subjektif\r\n', 'Mengidentifikasi kemampuan, prestasi, dan ketertarikannya serta tantangan yang dihadapi berdasarkan kejadian-kejadian yang dialaminya dalam kehidupan sehari-hari.\r\n', 'Menggambarkan pengaruh kualitas dirinya terhadap pelaksanaan dan hasil belajar; serta mengidentifikasi kemampuan yang ingin dikembangkan dengan mempertimbangkan tantangan yang dihadapinya dan umpan balik dari orang dewasa\r\n', 'Membuat penilaian yang realistis terhadap kemampuan dan minat , serta prioritas pengembangan diri berdasarkan pengalaman belajar dan aktivitas lain yang dilakukannya.\r\n', 'Mengidentifikasi kekuatan dan tantangan-tantangan yang akan dihadapi pada konteks pembelajaran, sosial dan pekerjaan yang akan dipilihnya di masa depan.\r\n', NULL),
(30, 4, 13, 'Mengembangkan refleksi diri', 'Melakukan refleksi untuk mengidentifikasi kekuatan dan kelemahan, serta prestasi dirinya.\r\n', 'Melakukan refleksi untuk mengidentifikasi kekuatan, kelemahan, dan prestasi dirinya, serta situasi yang dapat mendukung dan menghambat pembelajaran dan pengembangan dirinya\r\n', 'Melakukan refleksi untuk mengidentifikasi faktor-faktor di dalam maupun di luar dirinya yang dapat mendukung/menghambatnya dalam belajar dan mengembangkan diri; serta mengidentifikasi cara-cara untuk mengatasi kekurangannya.\r\n', 'Memonitor kemajuan belajar yang dicapai serta memprediksi tantangan pribadi dan akademik yang akan muncul berlandaskan pada pengalamannya untuk mempertimbangkan strategi belajar yang sesuai.\r\n', 'Melakukan refleksi terhadap umpan balik dari teman, guru, dan orang dewasa lainnya, serta informasi-informasi karir yang akan dipilihnya untuk menganalisis karakteristik dan keterampilan yang dibutuhkan dalam menunjang atau menghambat karirnya di masa depan.\r\n', NULL),
(31, 4, 14, 'Regulasi emosi', 'Mengidentifikasi perbedaan emosi yang dirasakannya dan situasi-situasi yang menyebabkan-nya; serta mengekspresi-kan secara wajar\r\n', 'Mengetahui adanya pengaruh orang lain, situasi, dan peristiwa yang terjadi terhadap emosi yang dirasakannya; serta berupaya untuk mengekspresikan emosi secara tepat dengan mempertimbangkan perasaan dan kebutuhan orang lain disekitarnya\r\n', 'Memahami perbedaan emosi yang dirasakan dan dampaknya terhadap proses belajar dan interaksinya dengan orang lain; serta mencoba cara-cara yang sesuai untuk mengelola emosi agar dapat menunjang aktivitas belajar dan interaksinya dengan orang lain.\r\n', 'Memahami dan memprediksi konsekuensi dari emosi dan pengekspresiannya dan menyusun langkah-langkah untuk mengelola emosinya dalam pelaksanaan belajar dan berinteraksi dengan orang lain.\r\n', 'Mengendalikan dan menyesuaikan emosi yang dirasakannya secara tepat ketika menghadapi situasi yang menantang dan menekan pada konteks belajar, relasi, dan pekerjaan.\r\n', NULL),
(32, 4, 14, 'Penetapan tujuan belajar, prestasi, dan pengembangan diri serta rencana strategis untuk mencapainya', 'Menetapkan target belajar dan merencanakan waktu dan tindakan belajar yang akan dilakukannya.\r\n', 'Menjelaskan pentingnya memiliki tujuan dan berkomitmen dalam mencapainya serta mengeksplorasi langkah-langkah yang sesuai untuk mencapainya\r\n', 'Menilai faktor-faktor (kekuatan dan kelemahan) yang ada pada dirinya dalam upaya mencapai tujuan belajar, prestasi, dan pengembangan dirinya serta mencoba berbagai strategi untuk mencapainya.\r\n', 'Merancang strategi yang sesuai untuk menunjang pencapaian tujuan belajar, prestasi, dan pengembangan diri dengan mempertimbangkan kekuatan dan kelemahan dirinya, serta situasi yang dihadapi.\r\n', 'Mengevaluasi efektivitas strategi pembelajaran digunakannya, serta menetapkan tujuan belajar, prestasi, dan pengembangan diri secara spesifik dan merancang strategi yang sesuai untuk menghadapi tantangan-tantangan yang akan dihadapi pada konteks pembelajaran, sosial dan pekerjaan yang akan dipilihnya di masa depan.\r\n', NULL),
(33, 4, 14, 'Menunjukkan inisiatif dan bekerja secara mandiri', 'Berinisiatif untuk mengerjakan tugas-tugas rutin secara mandiri dibawah pengawasan dan dukungan orang dewasa\r\n', 'Mempertimbangkan, memilih dan mengadopsi berbagai strategi dan mengidentifikasi sumber bantuan yang diperlukan serta berinisiatif menjalankannya untuk mendapatkan hasil belajar yang diinginkan.\r\n', 'Memahami arti penting bekerja secara mandiri serta inisiatif untuk melakukannya dalam menunjang pembelajaran dan pengembangan dirinya\r\n', 'Mengkritisi efektivitas dirinya dalam bekerja secara mandiri dengan mengidentifikasi hal-hal yang menunjang maupun menghambat dalam mencapai tujuan.\r\n', 'Menentukan prioritas pribadi, berinisiatif mencari dan mengembangkan pengetahuan dan keterampilan yang spesifik sesuai tujuan di masa depan.\r\n', NULL),
(34, 4, 14, 'Mengembangkan pengendalian dan disiplin diri', 'Melaksanakan kegiatan belajar di kelas dan menyelesaikan tugas-tugas dalam waktu yang telah disepakati.\r\n', 'Menjelaskan pentingnya mengatur diri secara mandiri dan mulai menjalankan kegiatan dan tugas yang telah sepakati secara mandiri\r\n', 'Mengidentifikasi faktor-faktor yang dapat mempengaruhi kemampuan dalam mengelola diri dalam pelaksanaan aktivitas belajar dan pengembangan dirinya.\r\n', 'Berkomitmen dan menjaga konsistensi pencapaian tujuan yang telah direncanakannya untuk mencapai tujuan belajar dan pengembangan diri yang diharapkannya\r\n', 'Melakukan tindakan-tindakan secara konsisten guna mencapai tujuan karir dan pengembangan dirinya di masa depan, serta berusaha mencari dan melakukan alternatif tindakan lain yang dapat dilakukan ketika menemui hambatan.\r\n', NULL),
(35, 4, 14, 'Percaya diri, tangguh (resilient), dan adaptif', 'Berani mencoba dan adaptif menghadapi situasi baru serta bertahan mengerjakan tugas-tugas yang disepakati hingga tuntas\r\n', 'Tetap bertahan mengerjakan tugas ketika dihadapkan dengan tantangan dan berusaha menyesuaikan strateginya ketika upaya sebelumnya tidak berhasil.\r\n', 'Menyusun, menyesuaikan, dan mengujicobakan berbagai strategi dan cara kerjanya untuk membantu dirinya dalam penyelesaian tugas yang menantang\r\n', 'Membuat rencana baru dengan mengadaptasi, dan memodifikasi strategi yang sudah dibuat ketika upaya sebelumnya tidak berhasil, serta menjalankan kembali tugasnya dengan keyakinan baru.\r\n', 'Menyesuaikan dan mulai menjalankan rencana dan strategi pengembangan dirinya dengan mempertimbangkan minat dan tuntutan pada konteks belajar maupun pekerjaan yang akan dijalaninya di masa depan, serta berusaha untuk mengatasi tantangan-tantangan yang ditemui.\r\n\r\n\r\nProfil Pelajar Pancasila\r\nPilih Fase\r\n\r\n\r\nFase E\r\n\r\nDimensi & Elemen\r\nBeriman, Bertakwa Kepada Tuhan Yang Maha Esa, dan Berakhlak Mulia\r\nBerkebinekaan Global\r\nBergotong-Royong\r\nMandiri\r\nElemen\r\n\r\n\r\nPemahaman diri dan situasi yang dihadapi\r\n\r\n\r\nRegulasi Diri\r\n\r\nBernalar Kritis\r\nKreatif\"\r\n', NULL),
(36, 5, 15, 'Mengajukan pertanyaan', 'Mengajukan pertanyaan untuk menjawab keingintahuannya dan untuk mengidentifikasi suatu permasalahan mengenai dirinya dan lingkungan sekitarnya.\r\n', 'Mengajukan pertanyaan untuk mengidentifikasi suatu permasalahan dan mengkonfirmasi pemahaman terhadap suatu permasalahan mengenai dirinya dan lingkungan sekitarnya.\r\n', 'Mengajukan pertanyaan untuk membandingkan berbagai informasi dan untuk menambah pengetahuannya.\r\n', 'Mengajukan pertanyaan untuk klarifikasi dan interpretasi informasi, serta mencari tahu penyebab dan konsekuensi dari informasi tersebut.\r\n', 'Mengajukan pertanyaan untuk menganalisis secara kritis permasalahan yang kompleks dan abstrak.\r\n', NULL),
(37, 5, 15, 'Mengidentifikasi, mengklarifikasi, dan mengolah informasi dan gagasan', 'Mengidentifikasi dan mengolah informasi dan gagasan\r\n', 'Mengumpulkan, mengklasifikasikan, membandingkan dan memilih informasi dan gagasan dari berbagai sumber.\r\n', 'Mengumpulkan, mengklasifikasikan, membandingkan, dan memilih informasi dari berbagai sumber, serta memperjelas informasi dengan bimbingan orang dewasa.\r\n', 'Mengidentifikasi, mengklarifikasi, dan menganalisis informasi yang relevan serta memprioritaskan beberapa gagasan tertentu.\r\n', 'Secara kritis mengklarifikasi serta menganalisis gagasan dan informasi yang kompleks dan abstrak dari berbagai sumber. Memprioritaskan suatu gagasan yang paling relevan dari hasil klarifikasi dan analisis.\r\n', NULL),
(38, 5, 16, 'Menganalisis dan mengevaluasi penalaran dan prosedurnya', 'Melakukan penalaran konkrit dan memberikan alasan dalam menyelesaikan masalah dan mengambil keputusan\r\n', 'Menjelaskan alasan yang relevan dalam penyelesaian masalah dan pengambilan keputusan\r\n', 'Menjelaskan alasan yang relevan dan akurat dalam penyelesaian masalah dan pengambilan keputusan\r\n', 'Membuktikan penalaran dengan berbagai argumen dalam mengambil suatu simpulan atau keputusan.\r\n', 'Menganalisis dan mengevaluasi penalaran yang digunakannya dalam menemukan dan mencari solusi serta mengambil keputusan.\r\n', NULL),
(39, 5, 17, 'Merefleksi dan mengevaluasi pemikirannya sendiri', 'Menyampaikan apa yang sedang dipikirkan secara terperinci\r\n', 'Menyampaikan apa yang sedang dipikirkan dan menjelaskan alasan dari hal yang dipikirkan\r\n', 'Memberikan alasan dari hal yang dipikirkan, serta menyadari kemungkinan adanya bias pada pemikirannya sendiri\r\n\r\nProfil Pelajar Pancasila\r\nPilih Fase\r\n\r\n\r\nFase C\r\n\r\nDimensi & Elemen\"\r\n', 'Menjelaskan asumsi yang digunakan, menyadari kecenderungan dan konsekuensi bias pada pemikirannya, serta berusaha mempertimbangkan perspektif yang berbeda.\r\n', 'Menjelaskan alasan untuk mendukung pemikirannya dan memikirkan pandangan yang mungkin berlawanan dengan pemikirannya dan mengubah pemikirannya jika diperlukan.\r\n', NULL),
(40, 6, 18, 'Menghasilkan gagasan yang orisinal', 'Menggabungkan beberapa gagasan menjadi ide atau gagasan imajinatif yang bermakna untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Memunculkan gagasan imajinatif baru yang bermakna dari beberapa gagasan yang berbeda sebagai ekspresi pikiran dan/atau perasaannya.\r\n', 'Mengembangkan gagasan yang ia miliki untuk membuat kombinasi hal yang baru dan imajinatif untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Menghubungkan gagasan yang ia miliki dengan informasi atau gagasan baru untuk menghasilkan kombinasi gagasan baru dan imajinatif untuk mengekspresikan pikiran dan/atau perasaannya.\r\n', 'Menghasilkan gagasan yang beragam untuk mengekspresikan pikiran dan/atau perasaannya, menilai gagasannya, serta memikirkan segala risikonya dengan mempertimbangkan banyak perspektif seperti etika dan nilai kemanusiaan ketika gagasannya direalisasikan.\r\n', NULL),
(41, 6, 19, 'Menghasilkan karya dan tindakan yang orisinal', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya sesuai dengan minat dan kesukaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya sesuai dengan minat dan kesukaannya dalam bentuk karya dan/atau tindakan serta mengapresiasi dan mengkritik karya dan tindakan yang dihasilkan\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan, serta mengevaluasinya dan mempertimbangkan dampaknya bagi orang lain\r\n', 'Mengeksplorasi dan mengekspresikan pikiran dan/atau perasaannya dalam bentuk karya dan/atau tindakan, serta mengevaluasinya dan mempertimbangkan dampak dan risikonya bagi diri dan lingkungannya dengan menggunakan berbagai perspektif.\r\n', NULL),
(42, 6, 20, 'Memiliki keluwesan berpikir dalam mencari alternatif solusi permasalahan', 'Mengidentifikasi gagasan-gagasan kreatif untuk menghadapi situasi dan permasalahan.\r\n', 'Membandingkan gagasan-gagasan kreatif untuk menghadapi situasi dan permasalahan.\r\n', 'berupaya mencari solusi alternatif saat pendekatan yang diambil tidak berhasil berdasarkan identifikasi terhadap situasi\r\n', 'Menghasilkan solusi alternatif dengan mengadaptasi berbagai gagasan dan umpan balik untuk menghadapi situasi dan permasalahan\r\n', 'Bereksperimen dengan berbagai pilihan secara kreatif untuk memodifikasi gagasan sesuai dengan perubahan situasi.\r\n', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `kode_ujian` varchar(30) DEFAULT NULL,
  `ujian_mulai` varchar(20) DEFAULT NULL,
  `ujian_berlangsung` varchar(20) DEFAULT NULL,
  `ujian_selesai` varchar(20) DEFAULT NULL,
  `jml_benar` int(11) DEFAULT NULL,
  `benar_esai` int(11) NOT NULL DEFAULT 0,
  `benar_multi` int(11) NOT NULL DEFAULT 0,
  `benar_bs` int(11) NOT NULL DEFAULT 0,
  `benar_urut` int(11) NOT NULL DEFAULT 0,
  `skor` varchar(255) DEFAULT NULL,
  `skor_esai` varchar(255) DEFAULT NULL,
  `skor_multi` varchar(255) DEFAULT NULL,
  `skor_bs` varchar(255) DEFAULT NULL,
  `skor_urut` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `makskor` int(11) DEFAULT NULL,
  `nilai` mediumtext DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `hasil` int(11) DEFAULT NULL,
  `jawaban_pg` mediumtext DEFAULT NULL,
  `jawaban_esai` longtext DEFAULT NULL,
  `jawaban_multi` mediumtext DEFAULT NULL,
  `jawaban_bs` mediumtext DEFAULT NULL,
  `jawaban_urut` mediumtext DEFAULT NULL,
  `nilai_esai` int(11) DEFAULT NULL,
  `nilai_esai2` mediumtext DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT 0,
  `id_soal` longtext DEFAULT NULL,
  `id_opsi` longtext DEFAULT NULL,
  `id_esai` mediumtext DEFAULT NULL,
  `blok` int(11) NOT NULL DEFAULT 0,
  `server` varchar(50) DEFAULT NULL,
  `browser` int(11) DEFAULT 0,
  `jenis_browser` varchar(50) DEFAULT NULL,
  `jumjawab` varchar(11) DEFAULT NULL,
  `jumsoal` varchar(11) DEFAULT NULL,
  `katrol` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_ujian`, `id_bank`, `id_siswa`, `level`, `kode_ujian`, `ujian_mulai`, `ujian_berlangsung`, `ujian_selesai`, `jml_benar`, `benar_esai`, `benar_multi`, `benar_bs`, `benar_urut`, `skor`, `skor_esai`, `skor_multi`, `skor_bs`, `skor_urut`, `total`, `makskor`, `nilai`, `status`, `ipaddress`, `hasil`, `jawaban_pg`, `jawaban_esai`, `jawaban_multi`, `jawaban_bs`, `jawaban_urut`, `nilai_esai`, `nilai_esai2`, `online`, `id_soal`, `id_opsi`, `id_esai`, `blok`, `server`, `browser`, `jenis_browser`, `jumjawab`, `jumsoal`, `katrol`) VALUES
(2, 1, 1, 1, '10', 'PAS', '2025-02-27 15:33:08', '2025-02-27 15:34:37', '2025-02-27 15:34:44', 1, 0, 0, 0, 0, '1', '0', '2', '2', '0', '5', 17, '29', NULL, '180.252.92.217', 0, 'a:1:{i:1;s:1:\"A\";}', 'a:1:{i:5;s:4:\"huuu\";}', 'a:1:{i:2;s:4:\"A, B\";}', 'a:1:{i:4;s:10:\"S, B, S, B\";}', 'a:1:{i:3;s:1:\"A\";}', NULL, NULL, 0, '1,5,2,4,3,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(4, 2, 4, 5, '10', 'PAS', '2025-03-19 16:20:02', '2025-03-19 16:21:29', '2025-03-19 16:21:31', 1, 0, 0, 0, 0, '1', '4', '1', '0', '0', '6', 17, '35', NULL, '182.1.54.48', 0, 'a:1:{i:7;s:1:\"A\";}', 'a:1:{i:11;s:4:\"sjak\";}', 'a:1:{i:8;s:1:\"A\";}', 'a:1:{i:10;s:0:\"\";}', 'a:1:{i:9;s:1:\"D\";}', NULL, 'a:1:{i:11;s:1:\"4\";}', 0, '7,11,8,10,9,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(5, 2, 4, 1, '10', 'PAS', '2025-03-22 10:09:30', '2025-03-22 10:10:18', '2025-03-22 10:10:21', 0, 0, 0, 0, 0, '0', '0', '2', '2', '2', '6', 17, '35', NULL, '180.253.161.116', 0, 'a:1:{i:7;s:1:\"B\";}', 'a:1:{i:11;s:1:\"a\";}', 'a:1:{i:8;s:4:\"A, B\";}', 'a:1:{i:10;s:10:\"B, S, B, S\";}', 'a:1:{i:9;s:10:\"B, A, C, D\";}', NULL, NULL, 0, '7,11,8,10,9,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(7, 3, 4, 2, '10', 'TES-BI', '2025-03-31 11:42:21', '2025-03-31 11:43:24', NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101.128.115.252', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '7,11,8,10,9,', NULL, NULL, 0, NULL, 0, 'Google Chrome', NULL, NULL, NULL),
(9, 7, 4, 3, '10', 'UJIAN-BARU', '2025-04-30 12:25:46', '2025-04-30 12:28:38', '2025-04-30 12:28:42', 0, 0, 0, 0, 0, '0', '0', '2', '2', '1', '5', 17, '29', NULL, '36.91.60.218', 0, 'a:1:{i:7;s:1:\"B\";}', 'a:1:{i:11;s:10:\"jhhghjgjhj\";}', 'a:1:{i:8;s:4:\"A, B\";}', 'a:1:{i:10;s:10:\"B, B, B, B\";}', 'a:1:{i:9;s:10:\"B, A, D, C\";}', NULL, NULL, 0, '7,11,8,10,9,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(12, 9, 9, 1, '10', 'PAS', '2025-05-15 09:19:27', '2025-05-15 09:19:54', '2025-05-15 09:20:08', 1, 0, 0, 0, 1, '1', '0', '1', '2', '4', '8', 17, '47', NULL, '103.15.214.2', 0, 'a:1:{i:17;s:1:\"A\";}', 'a:1:{i:21;s:4:\"saya\";}', 'a:1:{i:18;s:1:\"A\";}', 'a:1:{i:20;s:10:\"B, S, B, S\";}', 'a:1:{i:19;s:10:\"C, A, B, D\";}', NULL, NULL, 0, '17,21,18,20,19,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(23, 10, 13, 27, '10', 'IT', '2025-05-31 05:48:11', '2025-05-31 05:48:23', '2025-05-31 05:48:29', 1, 0, 0, 0, 0, '1', '', '', '', '', '1', 2, '50', NULL, '125.160.104.100', 0, 'a:2:{i:62;s:1:\"D\";i:63;s:1:\"A\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}', NULL, NULL, 0, '63,62,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '2', '2', NULL),
(26, 11, 14, 27, '10', 'TES-BI', '2025-06-01 11:04:44', '2025-06-01 11:07:44', '2025-06-01 11:06:46', 1, 0, 1, 0, 0, '1', '', '2', '', '', '3', 4, '75', NULL, '103.47.133.108', 0, 'a:2:{i:64;s:1:\"B\";i:65;s:1:\"B\";}', 'a:0:{}', 'a:1:{i:66;s:4:\"A, B\";}', 'a:0:{}', 'a:0:{}', NULL, NULL, 0, '64,65,66,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '3', '3', NULL),
(28, 9, 9, 27, '10', 'PAS', '2025-06-01 11:16:30', '2025-06-01 11:16:40', '2025-06-01 11:17:09', 1, 0, 0, 0, 0, '1', '0', '', '', '', '1', 17, '6', NULL, '103.47.133.108', 0, 'a:1:{i:17;s:1:\"A\";}', 'a:1:{i:21;s:3:\"www\";}', 'a:1:{i:18;N;}', 'a:1:{i:20;N;}', 'a:1:{i:19;N;}', NULL, NULL, 0, '17,21,18,20,19,', NULL, NULL, 0, 'SR-SMAN', 0, 'Google Chrome', '2', '5', NULL),
(29, 9, 9, 4, '10', 'PAS', '2025-06-01 13:02:39', '2025-06-01 13:04:11', '2025-06-01 13:04:13', 1, 0, 0, 0, 0, '1', '0', '0', '3', '1', '5', 17, '29', NULL, '103.114.137.10', 0, 'a:1:{i:17;s:1:\"A\";}', 'a:1:{i:21;s:5:\"kocak\";}', 'a:1:{i:18;s:10:\"A, B, C, D\";}', 'a:1:{i:20;s:10:\"B, S, B, B\";}', 'a:1:{i:19;s:10:\"D, C, B, A\";}', NULL, NULL, 0, '17,21,18,20,19,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(30, 9, 9, 18, '10', 'PAS', '2025-06-01 16:40:57', '2025-06-01 16:42:35', '2025-06-01 16:42:47', 1, 0, 0, 0, 0, '1', '0', '1', '0', '0', '2', 17, '12', NULL, '180.252.119.171', 0, 'a:1:{i:17;s:1:\"A\";}', 'a:1:{i:21;s:7:\"sssssjj\";}', 'a:1:{i:18;s:1:\"A\";}', 'a:1:{i:20;s:0:\"\";}', 'a:1:{i:19;s:1:\"D\";}', NULL, NULL, 0, '17,21,18,20,19,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '5', '5', NULL),
(31, 9, 9, 23, '10', 'PAS', '2025-06-03 11:13:07', '2025-06-03 11:13:08', '2025-06-03 11:13:24', 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '203.128.74.170', 0, 'a:1:{i:17;s:1:\"X\";}', 'a:1:{i:21;s:11:\"Tidak Diisi\";}', 'a:1:{i:18;N;}', 'a:1:{i:20;N;}', 'a:1:{i:19;N;}', NULL, NULL, 0, '17,21,18,20,19,', NULL, NULL, 0, 'SR-SMAN', 0, 'Google Chrome', '0', '5', NULL),
(32, 10, 13, 20, '10', 'IT', '2025-06-04 06:18:12', '2025-06-04 06:18:34', '2025-06-04 06:18:51', 0, 0, 0, 0, 0, '0', '', '', '', '', '0', 2, '0', NULL, '180.253.163.164', 0, 'a:2:{i:62;s:1:\"A\";i:63;s:1:\"C\";}', 'a:0:{}', 'a:0:{}', 'a:0:{}', 'a:0:{}', NULL, NULL, 0, '62,63,', NULL, NULL, 0, 'SR-SMAN', 1, 'Google Chrome', '2', '2', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_formatif`
--

CREATE TABLE `nilai_formatif` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `tinggi` longtext DEFAULT NULL,
  `rendah` longtext DEFAULT NULL,
  `semester` varchar(11) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_harian`
--

CREATE TABLE `nilai_harian` (
  `id` int(11) NOT NULL,
  `hari` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `kuri` varchar(11) DEFAULT NULL,
  `kkm` varchar(11) DEFAULT NULL,
  `nilai` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `materi` varchar(11) DEFAULT NULL,
  `semester` varchar(11) DEFAULT NULL,
  `tapel` varchar(50) DEFAULT NULL,
  `katrol` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_proses`
--

CREATE TABLE `nilai_proses` (
  `idpros` int(11) NOT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `proyek_ke` varchar(50) DEFAULT NULL,
  `catatan` mediumtext DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_proyek`
--

CREATE TABLE `nilai_proyek` (
  `idn` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `idproyek` int(11) DEFAULT NULL,
  `proyek` int(11) DEFAULT NULL,
  `nilai` varchar(5) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_rapor`
--

CREATE TABLE `nilai_rapor` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `nilai3` int(11) DEFAULT NULL,
  `desmin3` mediumtext DEFAULT NULL,
  `desmax3` mediumtext DEFAULT NULL,
  `nilai4` int(11) DEFAULT NULL,
  `desmin4` mediumtext DEFAULT NULL,
  `desmax4` mediumtext DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `semester` varchar(50) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_skl`
--

CREATE TABLE `nilai_skl` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `semester` varchar(11) DEFAULT NULL,
  `ki` varchar(50) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `nilai_skl`
--

INSERT INTO `nilai_skl` (`id`, `kelas`, `nis`, `mapel`, `semester`, `ki`, `nilai`, `jenis`) VALUES
(1, 'XII-1', '20221085', 'PABP', '1', NULL, 80, NULL),
(2, 'XII-1', '20221086', 'PABP', '1', NULL, 80, NULL),
(3, 'XII-1', '20221087', 'PABP', '1', NULL, 80, NULL),
(4, 'XII-1', '20221088', 'PABP', '1', NULL, 80, NULL),
(5, 'XII-1', '20221089', 'PABP', '1', NULL, 80, NULL),
(6, 'XII-1', '20221090', 'PABP', '1', NULL, 80, NULL),
(7, 'XII-1', '20221091', 'PABP', '1', NULL, 80, NULL),
(8, 'XII-1', '20221092', 'PABP', '1', NULL, 80, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_sumatif`
--

CREATE TABLE `nilai_sumatif` (
  `id` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(50) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `khp` varchar(50) DEFAULT NULL,
  `guru` int(11) DEFAULT NULL,
  `semester` varchar(11) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `level` varchar(50) NOT NULL DEFAULT 'admin',
  `jabatan` varchar(50) DEFAULT NULL,
  `sts` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(255) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `walas` varchar(50) DEFAULT NULL,
  `nowa` varchar(13) DEFAULT NULL,
  `tugas` varchar(255) DEFAULT NULL,
  `idjari` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `nip`, `nama`, `level`, `jabatan`, `sts`, `foto`, `jenis`, `walas`, `nowa`, `tugas`, `idjari`) VALUES
(1, 'admin', '$2y$10$t3L.GQrBJJHa5gPSooBuhOiZYk4yFgJT7TqBvqPI1bU57mJFQOrAG', NULL, 'Admin', 'admin', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'admin123', '$2y$10$SYnuj19MQvGia7KxfLj8b.SBU5RyL3ByqNkDy/sk6rsZrwol.xhUW', NULL, 'Admin', 'admin', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '196410121990102001', '123', '196410121990102001', 'Geofanny', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '0855445545445', NULL, NULL),
(11, 'alfarizi', '123', '', 'AHMAD ALFARIZI', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(12, 'khoirul', '123', '', 'Ahmad Khoirul Mufti', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(13, '199808082024211015', '123', '199808082024211015', 'ALDIAN MAHMUD', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(14, '198004032003122003', '123', '198004032003122003', 'Amalia', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(15, '199106102024211012', '123', '199106102024211012', 'Andi Prayoga', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(16, '199602082024212032', '123', '199602082024212032', 'Andika Primartati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(17, 'ari', '123', '', 'ari fatihatul hidayah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(18, '197810272008042003', '123', '197810272008042003', 'Ari Hartati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(19, '197701112011012004', '123', '197701112011012004', 'Arum Wulandari', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(20, '199305032024211020', '123', '199305032024211020', 'Auzar Rifa\'i Syaer Hamta', 'guru', 'Guru', 0, NULL, 'Guru BK', NULL, '', NULL, NULL),
(21, '196812221993031006', '123', '196812221993031006', 'Dedi Supriadi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(22, '196610141991031005', '123', '196610141991031005', 'Didi Santoso', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(23, '199805172024212026', '123', '199805172024212026', 'DIENIKE ELSARAH HANIFAH', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(24, '196601061991032004', '123', '196601061991032004', 'Dra. Hj. Umi Roviah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(25, '196507091992032003', '123', '196507091992032003', 'Dwi Nurmawati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(26, 'eka', '123', '', 'eka sulistiya ningsih', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(27, '196709071995122003', '123', '196709071995122003', 'Eka Susilawati', 'guru', 'Guru', 0, NULL, 'Guru BK', NULL, '', NULL, NULL),
(28, '198612042010011005', '123', '198612042010011005', 'Eko Diantoro', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(29, '197007131994032003', '123', '197007131994032003', 'Elny Sulasni', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(30, '198505232024212012', '123', '198505232024212012', 'Galuh Wiratna Dewi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(31, '197601302014072002', '123', '197601302014072002', 'Hasanah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(32, '196907151992032008', '123', '196907151992032008', 'Heny Trisulistyorini', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(33, '198910082024211011', '123', '198910082024211011', 'Hermi Ismanto', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(34, '196505251999031003', '123', '196505251999031003', 'Hipni', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(35, '196710201991031008', '123', '196710201991031008', 'Kustanto', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(36, '197705022024212003', '123', '197705022024212003', 'Mei Sugiyanti', 'guru', 'Guru', 0, NULL, 'Guru BK', NULL, '', NULL, NULL),
(37, '197705012006042019', '123', '197705012006042019', 'Melly Rakhmawaty', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(38, '198005152014072003', '123', '198005152014072003', 'Miftahul Jannah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(39, 'vita', '123', '', 'NATALIA VITA RIANI', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(40, '198905092014022004', '123', '198905092014022004', 'Neni Evi Putri', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(41, 'nida', '123', '', 'NIDA AMALIYA', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(42, '196508101992032006', '123', '196508101992032006', 'Nurlaena', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(43, '198802252015032004', '123', '198802252015032004', 'Putri Pertiwi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(44, '196903311997021002', '123', '196903311997021002', 'Rahmad Supriyadi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(45, '199212112024212026', '123', '199212112024212026', 'Rahmatun Nisa', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(46, '199702272024212025', '123', '199702272024212025', 'renita febriana', 'guru', 'Guru', 0, NULL, 'Guru BK', NULL, '', NULL, NULL),
(47, '199603012024212034', '123', '199603012024212034', 'reystiani safitri', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(48, '196903021993011001', '123', '196903021993011001', 'Setyo Budi Utomo', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(49, 'jannah', '123', '', 'Siti Miftahul Jannah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(50, '199610282024212036', '123', '199610282024212036', 'SITI ROHIBAH', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(51, '196501191992032002', '123', '196501191992032002', 'Sri Indras Worowati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(52, '196705041997031006', '123', '196705041997031006', 'Suhendar', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(53, '196406251997021001', '123', '196406251997021001', 'Suyadi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(54, '198007042024212007', '123', '198007042024212007', 'Titin Yuliarti', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(55, '196711051989032005', '123', '196711051989032005', 'Tri Harwati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(56, '198710012024211007', '123', '198710012024211007', 'Tri Wahyudi', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(57, '196507051997032002', '123', '196507051997032002', 'Tri Yuli Astuti', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(58, '199202072024212031', '123', '199202072024212031', 'Umi Karomah Al Adawiyah', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(59, '196507041991021002', '123', '196507041991021002', 'Waluya', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(60, '199505122024212025', '123', '199505122024212025', 'Wanda Aryanti', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(61, '199706022024211009', '123', '199706022024211009', 'WILDAN DEBBIE TIANTO', 'guru', 'Guru', 0, NULL, 'Guru BK', NULL, '', NULL, NULL),
(62, '198601222024211003', '123', '198601222024211003', 'Yanuar Indra Irawan', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(63, '198607172011011007', '123', '198607172011011007', 'Yasir Sipung', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(64, '197406152024212005', '123', '197406152024212005', 'Yuni Astuti', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(65, '198506162010012020', '123', '198506162010012020', 'Zuni Purnawati', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '', NULL, NULL),
(66, '', '', '', '', 'guru', 'Guru', 0, NULL, '', NULL, '', NULL, NULL),
(67, '2025', '2025', '2025', 'GURU', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '2025', NULL, NULL),
(68, 'guru', 'guru', '050920', 'Fahrurrozi', 'guru', 'Guru', 0, 'Screenshot_20250525-214606.jpg', 'Guru Mapel', NULL, '088558', NULL, NULL),
(69, 'intan', 'intan', '12345', 'intan', 'staff', NULL, 0, NULL, NULL, NULL, '6283117760971', NULL, NULL),
(70, 'geofanny', '123', '1964101219901020201', 'Geofanny', 'guru', 'Guru', 0, NULL, 'Guru Mapel', NULL, '0855454545454', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_aplikasi` int(11) NOT NULL,
  `aplikasi` varchar(50) DEFAULT NULL,
  `sekolah` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `npsn` varchar(50) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `kode_sekolah` varchar(50) DEFAULT NULL,
  `kepsek` varchar(50) DEFAULT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nowa` varchar(13) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `propinsi` varchar(50) DEFAULT NULL,
  `waktu` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `logokanan` varchar(255) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `id_server` varchar(50) DEFAULT NULL,
  `url_api` varchar(100) DEFAULT NULL,
  `stempel` text DEFAULT NULL,
  `ttd` text DEFAULT NULL,
  `header` text DEFAULT NULL,
  `header_kartu` text DEFAULT NULL,
  `pelanggaran` int(11) NOT NULL DEFAULT 0,
  `kkm` int(11) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `server` varchar(50) NOT NULL DEFAULT 'PUSAT',
  `token_api` text DEFAULT NULL,
  `tanggal_rapor` varchar(50) NOT NULL,
  `tgltrx` varchar(20) DEFAULT NULL,
  `idbayar` varchar(11) DEFAULT NULL,
  `jamkirim` varchar(20) NOT NULL,
  `pk_ttd` varchar(1) NOT NULL DEFAULT '0',
  `pk_stempel` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_aplikasi`, `aplikasi`, `sekolah`, `jenis`, `npsn`, `jenjang`, `kode_sekolah`, `kepsek`, `nip`, `nowa`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `propinsi`, `waktu`, `logo`, `logokanan`, `web`, `fax`, `telp`, `email`, `tp`, `semester`, `id_server`, `url_api`, `stempel`, `ttd`, `header`, `header_kartu`, `pelanggaran`, `kkm`, `mesin`, `server`, `token_api`, `tanggal_rapor`, `tgltrx`, `idbayar`, `jamkirim`, `pk_ttd`, `pk_stempel`) VALUES
(1, 'NEWSANDIK 2025', 'SMA NEGERI 2 JENEPONTO', 'REGULER', '4085365604', 'SMA', 'P-01', 'Dr. George M. Washing, M.Sc.', '0430381381684386', '088203846964', 'Jln. Merdeka Barat', 'Suka', 'Maju', 'Merdeka', 'Nusantara', 'Asia/Jakarta', 'logo35.png', 'logo85.png', 'www.sman1nusantara.sch.id', '2158', '085586868634', 'admin@smanusantara.sch.id', '2024/2025', '2', 'SR-SMAN', 'wa.sman1nusantara.sch.id', 'stempel88.png', 'ttd44.png', 'YAYASAN NUSANTARA', 'KARTU PESERTA ASESMEN SMK', 1, 70, '1', 'https://demo.esandik.my.id/presensi', 'M4L4N9KJ9vUTCuZwEdis', '12 Agustus 2024', '29', '1', '20:24:00', '1', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawas`
--

CREATE TABLE `pengawas` (
  `id_pengawas` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `sesi` varchar(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nowa` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `nama`, `tingkat`, `kelas`, `jurusan`, `ruang`, `sesi`, `username`, `password`, `nowa`, `foto`) VALUES
(1, 'Rachman Hakim, S.Pd.', '10', 'X-1', 'UMUM', 'R-1', '1', 'pengawas', 'pengawas', '0855969686861', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan_terkirim`
--

CREATE TABLE `pesan_terkirim` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `ket` varchar(5) DEFAULT NULL,
  `nowa` varchar(14) DEFAULT NULL,
  `isi` mediumtext DEFAULT NULL,
  `sender` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peskul`
--

CREATE TABLE `peskul` (
  `idp` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `eskul` varchar(50) DEFAULT NULL,
  `guru` varchar(16) DEFAULT NULL,
  `nilai` varchar(50) DEFAULT NULL,
  `ket` mediumtext DEFAULT NULL,
  `semester` varchar(12) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `peskul`
--

INSERT INTO `peskul` (`idp`, `nis`, `kelas`, `eskul`, `guru`, `nilai`, `ket`, `semester`, `tp`) VALUES
(1, '20221002', 'X-2', 'Pramuka', '2', NULL, NULL, '2', '2024/2025'),
(2, '20221003', 'X-2', 'Pramuka', '2', NULL, NULL, '2', '2024/2025'),
(3, '20221085', 'XII-1', 'Pramuka', '2', NULL, NULL, '2', '2024/2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `produk_toko` varchar(100) DEFAULT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `produk_kategori` varchar(11) NOT NULL,
  `produk_beli` varchar(11) DEFAULT NULL,
  `produk_harga` varchar(11) NOT NULL,
  `produk_jumlah` varchar(11) NOT NULL,
  `produk_satuan` varchar(50) DEFAULT NULL,
  `produk_foto1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produk_id`, `produk_toko`, `produk_nama`, `produk_kategori`, `produk_beli`, `produk_harga`, `produk_jumlah`, `produk_satuan`, `produk_foto1`) VALUES
(1, '1', 'Cimol dfdfd', '1', '2500', '3000', '36', 'Pcs', 'sutrisno.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `idp` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `p_proyek` int(11) NOT NULL,
  `p_dimensi` int(11) NOT NULL,
  `p_elemen` int(11) NOT NULL,
  `p_sub` int(11) NOT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `debet` varchar(11) DEFAULT NULL,
  `kredit` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `savsoft_options`
--

CREATE TABLE `savsoft_options` (
  `oid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `score` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `savsoft_qbank`
--

CREATE TABLE `savsoft_qbank` (
  `qid` int(11) NOT NULL,
  `question_type` varchar(100) NOT NULL DEFAULT 'Multiple Choice Single Answer',
  `question` text NOT NULL,
  `description` text NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `no_time_served` int(11) NOT NULL DEFAULT 0,
  `no_time_corrected` int(11) NOT NULL DEFAULT 0,
  `no_time_incorrected` int(11) NOT NULL DEFAULT 0,
  `no_time_unattempted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sinkron`
--

CREATE TABLE `sinkron` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT '0',
  `tanggal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `sinkron`
--

INSERT INTO `sinkron` (`id`, `kode`, `jumlah`, `tanggal`) VALUES
(1, 'SISWA', '0', NULL),
(2, 'PEGAWAI', '0', NULL),
(3, 'MAPEL', '0', NULL),
(4, 'WALAS', '0', NULL),
(5, 'ESKUL', '0', NULL),
(6, 'REGISTER', '0', NULL),
(7, 'ABSENSI', '0', NULL),
(9, 'ABSEN_ESKUL', '0', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `level` varchar(2) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `fase` varchar(1) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `jk` varchar(1) DEFAULT NULL,
  `agama` varchar(50) DEFAULT NULL,
  `nowa` varchar(50) DEFAULT NULL,
  `sts` varchar(1) NOT NULL DEFAULT '0',
  `foto` varchar(255) DEFAULT NULL,
  `idjari` varchar(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `online` int(11) NOT NULL DEFAULT 0,
  `nopes` varchar(50) DEFAULT NULL,
  `server` varchar(50) DEFAULT NULL,
  `sesi` varchar(11) DEFAULT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  `keterangan` varchar(1) DEFAULT NULL,
  `t_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` varchar(50) DEFAULT NULL,
  `stskel` varchar(50) DEFAULT NULL,
  `anakke` varchar(11) DEFAULT NULL,
  `asal_sek` varchar(50) DEFAULT NULL,
  `dikelas` varchar(50) DEFAULT NULL,
  `tgl_terima` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `ayah` varchar(50) DEFAULT NULL,
  `pek_ayah` varchar(50) DEFAULT NULL,
  `ibu` varchar(50) DEFAULT NULL,
  `pek_ibu` varchar(50) DEFAULT NULL,
  `sakit` varchar(11) NOT NULL DEFAULT '0',
  `izin` varchar(11) NOT NULL DEFAULT '0',
  `alpha` varchar(11) NOT NULL DEFAULT '0',
  `prestasi` varchar(100) DEFAULT NULL,
  `tingkat` varchar(100) DEFAULT NULL,
  `juara` varchar(100) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `nokartu` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nisn`, `nama`, `level`, `kelas`, `fase`, `jurusan`, `jk`, `agama`, `nowa`, `sts`, `foto`, `idjari`, `username`, `password`, `online`, `nopes`, `server`, `sesi`, `ruang`, `keterangan`, `t_lahir`, `tgl_lahir`, `stskel`, `anakke`, `asal_sek`, `dikelas`, `tgl_terima`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `ayah`, `pek_ayah`, `ibu`, `pek_ibu`, `sakit`, `izin`, `alpha`, `prestasi`, `tingkat`, `juara`, `catatan`, `saldo`, `nokartu`) VALUES
(4, '20221004', '0004', 'ALVERO DHIKO LEVANO', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '1', '', '2', 'US-4', 'US-4', 0, '20221004', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(5, '20221005', '0005', 'ANAVELIA FRANSISCA SIMANJUNTAK', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '1', '', '3', 'US-5', 'US-5', 1, '20221005', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(6, '20221006', '0006', 'ANDREAS NOVA ANDRIANO', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '087863301421', '0', '', NULL, 'US-6', 'US-6', 1, '20221006', 'SR-SMAN', '1', 'R-1', NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(7, '20221007', '0007', 'AUREL GRESIASEPTIANA', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-7', 'US-7', 1, '20221007', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(8, '20221008', '0008', 'AYESSHA SILVIA AMELLYA', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-8', 'US-8', 0, '20221008', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(9, '20221009', '0009', 'BELLA AYU INDAH SARI', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '1', '', '4', 'US-9', 'US-9', 0, '20221009', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(10, '20221010', '0010', 'DANELA CRISTIANE', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-10', 'US-10', 1, '20221010', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(11, '20221011', '0011', 'DANY SAFA\'AD', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-11', 'US-11', 1, '20221011', 'SR-SMAN', '1', 'R-1', NULL, 'TEST', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(12, '20221012', '0012', 'DENIS SABRINA', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '1', '', '6', 'US-12', 'US-12', 1, '20221012', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(13, '20221013', '0013', 'FADILLAH RAMADHANI', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-13', 'US-13', 1, '20221013', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(14, '20221014', '0014', 'FAKHRI RAHMAD JULIAN', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '1', '', '5', 'US-14', 'US-14', 0, '20221014', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(15, '20221015', '0015', 'FIRA RAHAYU DWIYANING P', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-15', 'US-15', 0, '20221015', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(16, '20221016', '0016', 'Gantari Sastra Paramadiwa', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-16', 'US-16', 0, '20221016', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(17, '20221017', '0017', 'GILANG ANDRIANTAMA', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-17', 'US-17', 0, '20221017', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(18, '20221018', '0018', 'HERI PRASETYO', '10', 'X-2', 'E', 'UMUM', 'L', 'Kristen', '', '0', '', NULL, 'US-18', 'US-18', 0, '20221018', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(19, '20221019', '0019', 'IRFAN ANTONY FAUZAN IBNI', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-19', 'US-19', 1, '20221019', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(20, '20221020', '0020', 'KARINA MEGA KASIH', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-20', 'US-20', 0, '20221020', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(21, '20221021', '0021', 'LUTFI AVRILIA', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-21', 'US-21', 0, '20221021', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(22, '20221022', '0022', 'MUHAMMAD ALIF WALID MAULIDDIN', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-22', 'US-22', 0, '20221022', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(23, '20221023', '0023', 'NICO ANDREAN HASAN EFENDI', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-23', 'US-23', 0, '20221023', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(24, '20221024', '0024', 'PURI AYU CHRISTIANI', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-24', 'US-24', 0, '20221024', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(25, '20221025', '0025', 'RAHMAT RENDI SANTOSO', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-25', 'US-25', 0, '20221025', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(26, '20221026', '0026', 'RAIHAN NUR FATHONI', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-26', 'US-26', 0, '20221026', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(27, '20221027', '0027', 'Riko Yoji Zebrian', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-27', 'US-27', 1, '20221027', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(28, '20221028', '0028', 'ROHMAN ALFIANSYAH', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-28', 'US-28', 0, '20221028', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(29, '20221029', '0029', 'RUSTALINO ADE ENDARTO', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-29', 'US-29', 0, '20221029', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(30, '20221030', '0030', 'RYAN AHMAD AFFANDI', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-30', 'US-30', 0, '20221030', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(31, '20221031', '0031', 'SEPTARIA EKA KRISTANTI', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-31', 'US-31', 0, '20221031', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(32, '20221032', '0032', 'STEVANIA HARVIANING CRISTIANI', '10', 'X-2', 'E', 'UMUM', 'P', 'Kristen', '', '0', '', NULL, 'US-32', 'US-32', 0, '20221032', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(33, '20221033', '0033', 'WIDYA LESTARI', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-33', 'US-33', 0, '20221033', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(34, '20221034', '0034', 'ACHMAD ARIFIN', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-34', 'US-34', 0, '20221034', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(35, '20221035', '0035', 'AISAH CINDY PRATAMA', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-35', 'US-35', 0, '20221035', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(36, '20221036', '0036', 'AISYAH NUR RAHMA', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-36', 'US-36', 0, '20221036', 'SR-SMAN', '1', 'R-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(37, '20221037', '0037', 'Aji Wahyudi', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '1', '', '7', 'US-37', 'US-37', 0, '20221037', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(38, '20221038', '0038', 'ANDRE RIZKY YULIANTO', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-38', 'US-38', 0, '20221038', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(39, '20221039', '0039', 'ANGGUN RITA AMELIA', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-39', 'US-39', 0, '20221039', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(40, '20221040', '0040', 'ANISA KURNIA ISTIANI', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-40', 'US-40', 0, '20221040', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(41, '20221041', '0041', 'BAGAS PRASETYA', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-41', 'US-41', 0, '20221041', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(42, '20221042', '0042', 'BILAL AHMAD', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-42', 'US-42', 0, '20221042', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(43, '20221043', '0043', 'DARIL ALIF ZULKARNAEN', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-43', 'US-43', 0, '20221043', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(44, '20221044', '0044', 'Derian Putra Pratama', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-44', 'US-44', 0, '20221044', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(45, '20221045', '0045', 'ERISTA VELANICA PUTRI', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-45', 'US-45', 0, '20221045', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(46, '20221046', '0046', 'FARAH NADIA TAUFIQY', '10', 'X-2', 'E', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-46', 'US-46', 0, '20221046', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(47, '20221047', '0047', 'FERNANDO VICKY ALVIANSAH', '10', 'X-2', 'E', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-47', 'US-47', 0, '20221047', 'SR-SMAN', '1', 'R-2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(48, '20221048', '0048', 'GABRIELLA NATAZHA SALSABILLA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-48', 'US-48', 0, '20221048', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(49, '20221049', '0049', 'GIOVANO HERNINO SAPUTRA', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-49', 'US-49', 0, '20221049', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(50, '20221050', '0050', 'IQBAL JAUHAR RAVANDA', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-50', 'US-50', 0, '20221050', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(51, '20221051', '0051', 'IZZATUL HASANAH RAFIATUZ ZAHRO', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-51', 'US-51', 0, '20221051', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(52, '20221052', '0052', 'LEITISYA ZEINNARA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-52', 'US-52', 0, '20221052', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(53, '20221053', '0053', 'M. AJI FIKI RAHMATDANI SOFIULLOH', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-53', 'US-53', 0, '20221053', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(54, '20221054', '0054', 'MILA PUTRI MIRANDA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-54', 'US-54', 0, '20221054', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(55, '20221055', '0055', 'MOH. AVATAR', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-55', 'US-55', 0, '20221055', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(56, '20221056', '0056', 'MUHAMMAD HABIBI', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-56', 'US-56', 0, '20221056', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(57, '20221057', '0057', 'Muhhamad Rudianto', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-57', 'US-57', 0, '20221057', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(58, '20221058', '0058', 'NABHAN RADINKA KEVAN', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-58', 'US-58', 0, '20221058', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(59, '20221059', '0059', 'NICO ALFIANO PRATAMA', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-59', 'US-59', 0, '20221059', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(60, '20221060', '0060', 'RAHMAD RIVALDI', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-60', 'US-60', 0, '20221060', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(61, '20221061', '0061', 'RAISYA SOFIA BUNGA FIRDAUS', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-61', 'US-61', 0, '20221061', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(62, '20221062', '0062', 'RANIKA ARUM PRATIWI', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-62', 'US-62', 0, '20221062', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(63, '20221063', '0063', 'RATNA ANIZAH', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-63', 'US-63', 0, '20221063', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(64, '20221064', '0064', 'Riski Maulana', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-64', 'US-64', 0, '20221064', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(65, '20221065', '0065', 'SABIAN SYAUQI ARATA', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-65', 'US-65', 0, '20221065', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(66, '20221066', '0066', 'SALSA WULAN DELIMA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-66', 'US-66', 0, '20221066', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(67, '20221067', '0067', 'VILWA SYEIRA EN NADIA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-67', 'US-67', 0, '20221067', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(68, '20221068', '0068', 'WIGNYO ADAM', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-68', 'US-68', 0, '20221068', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(69, '20221069', '0069', 'ADELIA DWI NURFADILA', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-69', 'US-69', 0, '20221069', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(70, '20221070', '0070', 'AHMAT', '11', 'XI-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-70', 'US-70', 0, '20221070', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(71, '20221071', '0071', 'AIRIN KHORIZAH NUR RAHMAH', '11', 'XI-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-71', 'US-71', 0, '20221071', 'SR-SMAN', '1', 'R3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(72, '20221072', '0072', 'ANDIKA NUR FURQON NASRULLAH', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-72', 'US-72', 0, '20221072', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(73, '20221073', '0073', 'ANITA KURNIAWATI', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-73', 'US-73', 0, '20221073', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(74, '20221074', '0074', 'AYNA RO\'IFFATUL AZIZAH', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-74', 'US-74', 0, '20221074', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(75, '20221075', '0075', 'BILGHIS AZZAHRA', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-75', 'US-75', 0, '20221075', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(76, '20221076', '0076', 'DIAN ILHAM AJI ROHIM', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-76', 'US-76', 0, '20221076', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(77, '20221077', '0077', 'ELVYN ANDHIKA PUTRA PRATAMA', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-77', 'US-77', 0, '20221077', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(78, '20221078', '0078', 'FARHAN NUR HUDA', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-78', 'US-78', 0, '20221078', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(79, '20221079', '0079', 'FITRAH HANUM NIMASAYU', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-79', 'US-79', 0, '20221079', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(80, '20221080', '0080', 'GRIZTA BAYU FEBRIAN FAJAR YUWONO', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-80', 'US-80', 0, '20221080', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(81, '20221081', '0081', 'INGGAR AYU NISWARI', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-81', 'US-81', 0, '20221081', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(82, '20221082', '0082', 'ISYA DIKRI SUDRAJAD', '11', 'XI-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-82', 'US-82', 0, '20221082', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(83, '20221083', '0083', 'KARUNIA EKA PUTRI', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-83', 'US-83', 0, '20221083', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(84, '20221084', '0084', 'LALA PUTRI MAHARANI', '11', 'XI-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-84', 'US-84', 0, '20221084', 'SR-SMAN', '1', 'R4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(85, '20221085', '0085', 'M. FAKHRI ADIS AL-FIKRI', '12', 'XII-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-85', 'US-85', 0, '20221085', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(86, '20221086', '0086', 'MOCHAMAD JUAN RAFANDA YUSWADI', '12', 'XII-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-86', 'US-86', 0, '20221086', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(87, '20221087', '0087', 'MUHAMMAD DAVIN PRAYOGA', '12', 'XII-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-87', 'US-87', 0, '20221087', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(88, '20221088', '0088', 'MUHAMMAD HARIS ALFARIZI', '12', 'XII-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-88', 'US-88', 0, '20221088', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(89, '20221089', '0089', 'MUHAMMAD SYAQIF ALI MAHRUS', '12', 'XII-1', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-89', 'US-89', 0, '20221089', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(90, '20221090', '0090', 'MUTIARA EQUILA KHAIRUNNISA', '12', 'XII-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-90', 'US-90', 0, '20221090', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(91, '20221091', '0091', 'NABILA AURELIA PUTRI SUSANTO', '12', 'XII-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-91', 'US-91', 0, '20221091', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(92, '20221092', '0092', 'NAYLA SA\'BANINA', '12', 'XII-1', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-92', 'US-92', 0, '20221092', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(93, '20221093', '0093', 'NOWHA ABDUL AZIZ', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-93', 'US-93', 0, '20221093', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(94, '20221094', '0094', 'QIBRAN AHMAD FARIQIN', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-94', 'US-94', 0, '20221094', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(95, '20221095', '0095', 'RISA DEWI ANDINI', '12', 'XII-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-95', 'US-95', 0, '20221095', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(96, '20221096', '0096', 'SANDI IRAWAN', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-96', 'US-96', 0, '20221096', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(97, '20221097', '0097', 'VICHO MADA ADHYASTA', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-97', 'US-97', 0, '20221097', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(98, '20221098', '0098', 'VIVIAN RISKY FASHA', '12', 'XII-2', 'F', 'UMUM', 'P', 'Islam', '', '0', '', NULL, 'US-98', 'US-98', 0, '20221098', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(99, '20221099', '0099', 'WALIT HASIN AHMAD', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-99', 'US-99', 0, '20221099', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(100, '20221100', '0100', 'Wildan Al Amin', '12', 'XII-2', 'F', 'UMUM', 'L', 'Islam', '', '0', '', NULL, 'US-100', 'US-100', 0, '20221100', 'SR-SMAN', '1', 'R5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(101, '123123123', '123123123', 'testing', '12', 'XII-2', NULL, 'UMUM', 'L', 'Islam', '', '1', NULL, '8', '4085365604-101', '4085365604-101-OVP', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL),
(102, '3123123123', '7819273812', 'Siswa-xx', '10', 'X-2', NULL, 'UMUM', 'P', 'Konghucu', '', '0', 'duarr.jpg', NULL, '4085365604-102', '4085365604-102-MGI', 0, NULL, NULL, NULL, NULL, NULL, 'Tembagapura', '1 Januari 2000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skkb`
--

CREATE TABLE `skkb` (
  `id` int(11) NOT NULL,
  `header` text NOT NULL,
  `fungsi` int(11) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `fungsi2` int(11) DEFAULT NULL,
  `isi` longtext NOT NULL,
  `foter` text NOT NULL,
  `nosurat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `skkb`
--

INSERT INTO `skkb` (`id`, `header`, `fungsi`, `file`, `fungsi2`, `isi`, `foter`, `nosurat`) VALUES
(1, 'DINAS PENDIDIKAN KABUPATEN CIANJUR', 0, 'images/header518.jpg', 1, '<p>Adalah benar siswa SMP Taruna Bakti Cikadu dan sepanjang pengetahuan kami anak tersebut <strong>Berkelakuan Baik dan tidak pernah terlibat Narkoba</strong>.</p>', '<p>Demikian Surat Keterangan ini kami buat dengan sesungguhnya dan sebenarnya, dan agar dapat dipergunakan sesuai peruntukkannya.</p>', '432.1/STBC/IV/2020mmmmm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skl`
--

CREATE TABLE `skl` (
  `id_skl` int(11) NOT NULL,
  `tingkat` varchar(50) DEFAULT NULL,
  `no_surat` varchar(50) NOT NULL,
  `nama_surat` varchar(50) NOT NULL,
  `tgl_surat` varchar(50) NOT NULL,
  `header` mediumtext DEFAULT NULL,
  `pembuka` mediumtext NOT NULL,
  `isi_surat` mediumtext NOT NULL,
  `penutup` mediumtext NOT NULL,
  `sttd` int(1) NOT NULL,
  `sstempel` int(1) NOT NULL,
  `nilai` int(1) NOT NULL,
  `kelompok` int(1) NOT NULL,
  `dibuka` datetime DEFAULT NULL,
  `ditutup` datetime DEFAULT NULL,
  `tulisan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `skl`
--

INSERT INTO `skl` (`id_skl`, `tingkat`, `no_surat`, `nama_surat`, `tgl_surat`, `header`, `pembuka`, `isi_surat`, `penutup`, `sttd`, `sstempel`, `nilai`, `kelompok`, `dibuka`, `ditutup`, `tulisan`) VALUES
(1, '12', '/STBC/SKL/VI/', 'SURAT KETERANGAN LULUS', '8 Juni 2023', NULL, '<p>Berdasarkan hasil Rapat Dewan Guru SMA Negeri 1 Nusantara&nbsp; tanggal 29 Mei 2025, Kepala SMA Negeri 1 Nusantara Kabupaten Maju, dengan ini menerangkan bahwa :</p>', '<p>Bahwa nama yang tersebut diatas adalah benar Siswa/Siswi SMA Negeri 1 Nusantara&nbsp; dan telah melaksanakan Ujian Sekolah serta dinyatakan :</p>', '<p>Demikian Surat Keterangan Lulus (SKL) ini dibuat dengan sebenarnya untuk dapat digunakan sebagaimana mestinya menjelang diterbitkannya ijazah yang bersangkutan.</p>', 1, 1, 1, 1, '2025-02-18 06:00:00', '2025-02-28 10:00:00', 'tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `nomor` int(11) DEFAULT NULL,
  `soal` longtext DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL,
  `opsi` int(11) DEFAULT NULL,
  `pilA` longtext DEFAULT NULL,
  `pilB` longtext DEFAULT NULL,
  `pilC` longtext DEFAULT NULL,
  `pilD` longtext DEFAULT NULL,
  `pilE` longtext DEFAULT NULL,
  `perA` text DEFAULT NULL,
  `perB` text DEFAULT NULL,
  `perC` text DEFAULT NULL,
  `perD` text DEFAULT NULL,
  `perE` text DEFAULT NULL,
  `jawaban` text DEFAULT NULL,
  `file` longtext DEFAULT NULL,
  `file1` mediumtext DEFAULT NULL,
  `fileA` mediumtext DEFAULT NULL,
  `fileB` mediumtext DEFAULT NULL,
  `fileC` mediumtext DEFAULT NULL,
  `fileD` mediumtext DEFAULT NULL,
  `fileE` mediumtext DEFAULT NULL,
  `ket` text DEFAULT NULL,
  `sts` int(11) DEFAULT 0,
  `max_skor` int(11) DEFAULT 1,
  `jenisjawab` varchar(50) DEFAULT NULL,
  `panjang` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id_soal`, `id_bank`, `nomor`, `soal`, `jenis`, `opsi`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `perA`, `perB`, `perC`, `perD`, `perE`, `jawaban`, `file`, `file1`, `fileA`, `fileB`, `fileC`, `fileD`, `fileE`, `ket`, `sts`, `max_skor`, `jenisjawab`, `panjang`) VALUES
(17, 9, 1, 'SPEKTRUM GELOMBANG ELEKTROMAGNETIK\nKenny sedang melihat artikel mengenai Sains dan menemukan gambar sebagai berikutPada gambar, disajikan berbagai macam gelombang elektromagnetik yang disusun berdasarkan frekuensinya dalam satuan Hz.\nWarna yang memiliki frekuensi lebih tinggi daripada warna hijau, tetapi lebih rendah daripada warna ungu adalah .... ', 1, NULL, 'biru\n', 'jingga\n', 'merah\n', 'kuning\n', '', '', '', '', '', '', 'A', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL),
(18, 9, 2, '\"Kita sering kali melakukan olahraga. Bahkan, orang-orang di sekitar kita juga sering menyarankan kita untuk melakukan aktivitas tersebut. Rupanya, ada keterkaitan antara berolahraga dengan kesehatan fisik dan mental, misalnya terkait dengan perkembangan tubuh dan interaksi sosial.\n     Perlu diketahui bahwa olahraga bermanfaat dalam mencegah risiko berbagai penyakit. Saat tubuh jarang melakukan olahraga, lemak akan menumpuk di dalam tubuh sehingga dapat berujung pada terjadinya obesitas. Namun, dengan berolahraga secara teratur, tumpukan lemak yang ada di dalam tubuh bisa terbakar. Selain itu, saat berolahraga, terjadi kontraksi otot-otot tubuh yang menyebabkan cairan getah bening dapat mengalir dengan lancar. Cairan getah bening merupakan cairan yang mengandung sel-sel darah putih yang berkaitan dengan sistem pertahanan tubuh. Berbeda dengan pembuluh darah, cairan getah bening ini tidak mengalir karena kontraksi jantung, tetapi karena kontraksi otot-otot yang melekat pada rangka tubuh kita.\n     Selain manfaat tersebut, olahraga juga dapat meningkatkan perkembangan tubuh. Aktivitas yang dilakukan selama olahraga akan membantu tubuh untuk lebih cepat berkembang. Ketika berolahraga, terjadi kontraksi otot-otot yang menyebabkan otot lebih terlatih dan akan berkembang dengan baik. Selain itu, aktivitas olahraga yang diiringi gizi seimbang juga dapat membuat metabolisme tubuh menjadi lebih lancar karena hormon pertumbuhan bekerja lebih maksimal.\n     Selain bermanfaat bagi kesehatan fisik, olahraga juga dapat meningkatkan interaksi sosial. Ketika olahraga dilakukan dalam kelompok, misalnya saat bermain sepak bola, basket, dan futsal, terjadi proses perkenalan dengan orang lain, baik dengan orang di dalam tim maupun di luar tim. Selain itu, terjadi proses saling bekerja sama saat bermain atau bertanding. Adanya kompetisi yang sehat dalam permainan olahraga tersebut juga membuat kita menjadi lebih jujur. Akhirnya, kita menjadi terbiasa dalam melakukan \nSelain berolahraga, hal yang perlu kita lakukan untuk menjaga kesehatan fisik dan mental adalah ....  \"\n\n\n\n\n', 3, NULL, 'Mengurangi makan makanan penyebab obesitas\n', 'Meningkatkan interaksi sosial dan sikap saling bekerja sama\n', 'Mengurangi makanan berprotein dan berlemak tinggi\n', 'Memakan makanan bergizi seimbang\n', '', '', '', '', '', '', 'A, B, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 3, NULL, NULL),
(19, 9, 3, '\"Pemerintah melalui Badan Pusat Statistik telah merilis data produktivitas padi dari setiap provinsi di Indonesia. Data tersebut meliputi luas lahan persawahan yang dipanen dan produktivitas lahan panen. Adapun data jumlah produksi per tahun dapat diketahui dengan mengalikan luas lahan panen dan produktivitasnya. Angka produktivitas padi diperoleh melalui survei berupa Gabah Kering Panen (GKP) yang dikonversikan menjadi Gabah Kering Giling (GKG).\n    Pulau Jawa sebagai pulau dengan jumlah penduduk terbanyak masih memerlukan pasokan beras dari daerah lain maupun dari impor. Hal tersebut karena jumlah hasil panen belum dapat mencukupi kebutuhan pangan masyarakat. Berikut data jumlah produksi padi dari perwakilan provinsi di 5 pulau terbesar di Indonesia. \nTentukan urutan provinsi dari yang memiliki jumlah hasil panen tertinggi hingga terendah!\"\n\n\n\n\n', 5, NULL, '92.198.050,77 kuintal\n', '46.786.971,19 kuintal\n', '20.763.612,87 kuintal\n', '11.345.248,95 kuintal\n', '', 'Sumatra Utara\n', 'Jawa Barat\n', 'Kalimantan Selatan\n', 'Sulawesi Selatan\n', '', 'C, A, B, D', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, NULL),
(20, 9, 4, '\"Mina padi adalah suatu bentuk usaha tani gabungan yang memanfaatkan genangan air sawah yang tengah ditanami padi sebagai kolam untuk budidaya ikan. Oleh karena itu, selain mendapat hasil panen yaitu padi, petani yang menerapkan sistem mina padi juga dapat memanen ikan. Pak Made adalah salah satu petani di Bali yang menerapkan sistem mina padi di sawahnya. Pak Made mengatakan bahwa dengan menerapkan sistem mina padi, pendapatan dari hasil panen beliau meningkat. “Akan tetapi, perawatan padi dan ikan pada sistem mina padi memang gampang-gampang susah”, katanya.\nBenih ikan yang ditebar oleh Pak Made di sawah beliau yang seluas 1,5 ha adalah ikan emas dan ikan nila yang masih berukuran 5 cm sampai dengan 8 cm dengan kepadatan 5.000 ekor/ha. Perbandingan benih ikan emas dengan benih ikan nila yang ditebar oleh Pak Made adalah 3 : 2. Harga bibit ikan nila adalah Rp500,00/ekor dan harga bibit ikan emas adalah dua kali lipatnya. Setiap pagi, Pak Made memberi pakan tambahan berupa dedak halus 250 kg/ha untuk ikan yang ada di sawahnya.\nSetelah tujuh puluh hari, Pak Made memanen ikannya tersebut. Total ikan yang dipanen adalah 6.500 kg/ha. Perbandingan hasil panen ikan emas dan ikan nila sama dengan perbandingan benih ikan ketika ditebar. Harga ikan emas dan ikan nila yang dipanen oleh Pak Made berturut-turut adalah Rp30.000,00/kg dan Rp27.000,00/kg. Sekitar 2 bulan kemudian, Pak Made memanen padinya dengan hasil panen 5,7 ton/ha. Pak Made menjualnya dalam bentuk gabah kering panen (GKP) dengan harga Rp5.000,00/kg.\nTentukan benar atau salah pernyataan berikut dengan memberi tanda ? pada kolom yang sesuai!\n\"\n\n\n\n\n', 4, NULL, '• Total benih ikan emas yang ditebar di sawah Pak Made adalah 4.500 ekor\n', '• Total benih ikan nila yang ditebar di sawah Pak Made adalah 2.000 ekor\n', '• Total ikan emas yang dipanen Pak Made adalah 3.900 ekor\n', '• Total ikan nila yang dipanen Pak Made adalah 3.900 ekor\n', '', '', '', '', '', '', 'B, S, S, B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 4, NULL, NULL),
(21, 9, 5, '\"Ayah Lisa adalah seorang petani. Selain menyikapi dampak negatif datangnya musim penghujan, ayah Lisa juga memanfaatkan dampak positif musim penghujan untuk kelangsungan pertaniannya. Menurut ayah Lisa, La Nina memberikan banyak dampak positif pada sektor pertanian. Kemudian, Lisa mencari tahu apa saja dampak positif dari La Nina.  \nDAMPAK POSITIF LA NINA\nDekan Sekolah Vokasi UGM Agus Maryono yang juga merupakan pakar Ekohidrolik dan pelopor restorasi sungai Indonesia mengatakan bahwa seharusnya tahun basah (musim penghujan) bisa dimanfaatkan. Daerah kering dan semi kering juga dapat memanfaatkan air yang berlimpah. Dengan adanya tahun basah, air tanah bisa terisi secara maksimal, begitu pula dengan danau, situ, serta telaga. Alur sungai pun dapat terbentuk dengan sempurna. Masyarakat di sekitar sungai dapat melakukan susur sungai sehingga mereka akan mengetahui sungai yang bisa digunakan untuk mitigasi serta sungai yang memiliki potensi wisata, potensi sumber air, dan potensi perikanan.\nSelain itu, Rizaldi Boer dari Pusat Pengelolaan Risiko dan Peluang Iklim Institut Pertanian Bogor (IPB) mengatakan, La Nina juga mempunyai manfaat bagi pertanian pangan. La Nina memberi peluang untuk percepatan tanam serta perluasan area tanam padi, baik di lahan sawah irigasi, tadah hujan, maupun ladang. Lebih lanjut, La Nina dapat dimanfaatkan untuk meningkatkan areal tanam pada musim hujan, khususnya untuk daerah lahan kering. Petani disarankan untuk memanfaatkan mundurnya akhir musim hujan dengan menanam tanaman umur pendek dan berekonomi tinggi. Tak hanya itu, petani juga dapat melakukan adaptasi teknik budidaya pada daerah endemik banjir dan pertanian lahan kering di lahan gambut.\nDampak positif La Nina yang lain adalah dapat meningkatkan produksi perluasan lahan pasang surut. Lahan pesisir juga akan berkembang lebih baik karena salinitas dapat dikurangi dan perikanan darat bisa dikembangkan lebih awal. Dari segi sumber daya air, menurut Direktur Bina Teknik SDA Kementerian PU-Pera Eko Winar Irianto, kondisi La Nina dapat memenuhi kapasitas energi maksimum pada operasional waduk, sementara dalam kondisi El Nino energi yang dihasilkan akan berkurang.\nBagaimana dampak positif La Nina dari segi sumber daya air?\"\n\n\n\n\n', 2, NULL, '', '', '', '', '', '', '', '', '', '', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5, NULL, NULL),
(22, 11, 1, 'Strategi yang paling efektif dalam bernegosiasi adalah...', 1, NULL, 'Menekan lawan', 'Mencari solusi bersama', 'Menghindar dari diskusi', 'Menolak semua ide', 'Mengubah topik', 'Tidak menciptakan solusi', 'Solusi win-win', 'Tidak komunikatif', 'Tidak terbuka', 'Mengaburkan masalah', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(23, 11, 2, 'Dalam proses negosiasi, penting untuk bersikap...', 1, NULL, 'Agresif', 'Tertutup', 'Asertif', 'Menyerah', 'Emosional', 'Tidak menghargai', 'Tidak responsif', 'Jelas dan tegas', 'Tidak mendengar', 'Tidak sopan', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(24, 11, 3, 'Kesepakatan dalam negosiasi dapat dicapai jika...', 1, NULL, 'Salah satu pihak kalah', 'Kedua pihak saling memahami kebutuhan', 'Tidak ada kompromi', 'Satu pihak memaksakan kehendak', 'Diskusi dihentikan', 'Menang-kalah', 'Ada empati dan pengertian', 'Tidak ada komunikasi', 'Tidak adil', 'Tidak efektif', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(25, 11, 4, 'Jika dalam negosiasi muncul konflik, sikap terbaik adalah...', 1, NULL, 'Menghindari pembicaraan', 'Mendengarkan dan mencari solusi', 'Memotong pembicaraan', 'Menyerang secara verbal', 'Membubarkan pertemuan', 'Tidak produktif', 'Mencari titik temu', 'Tidak menyelesaikan', 'Tidak fokus', 'Emosi', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(26, 11, 5, 'Dalam negosiasi, kompromi berarti...', 1, NULL, 'Mengorbankan semua prinsip', 'Mengikuti semua keinginan pihak lain', 'Memberi dan menerima secara adil', 'Menolak usulan', 'Mengubah tujuan', 'Bukan solusi adil', 'Mengalah terus-menerus', 'Adil dua arah', 'Tidak konsisten', 'Tidak logis', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(27, 11, 6, 'Kesalahan umum dalam negosiasi adalah...', 1, NULL, 'Mencari informasi lawan', 'Mempersiapkan argumen', 'Tidak mendengarkan pihak lain', 'Mengembangkan opsi', 'Mengendalikan emosi', 'Tidak memperhatikan', 'Tidak mendengar', 'Tidak peka', 'Kooperatif', 'Tidak fokus', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(28, 11, 7, 'Hal pertama yang perlu dilakukan saat memulai negosiasi adalah...', 1, NULL, 'Menyerang lawan bicara', 'Menyampaikan tuduhan', 'Menyampaikan maksud dan tujuan', 'Meninggalkan ruangan', 'Menutup diskusi', 'Tidak jelas tujuan', 'Tidak menjelaskan', 'Tujuan menjadi awal', 'Menghindar', 'Tidak sopan', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(29, 11, 8, 'Tujuan dari teknik BATNA ...', 1, NULL, 'Menghindari konflik', 'Mendapatkan semua keinginan', 'Mengetahui alternatif terbaik jika negosiasi gagal', 'Memanipulasi lawan', 'Menutup semua opsi', 'Tidak siap alternatif', 'Tidak punya rencana', 'Ada rencana cadangan', 'Tidak efisien', 'Tidak produktif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(30, 11, 9, 'Negosiasi bisa gagal jika...', 1, NULL, 'Kedua belah pihak terbuka', 'Hanya satu pihak yang menentukan', 'Ada kompromi', 'Ada saling pengertian', 'Ada komunikasi', 'Tidak adil', 'Dominan satu pihak', 'Tidak fleksibel', 'Tidak seimbang', 'Tidak saling percaya', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(31, 11, 10, 'Peran emosi dalam negosiasi adalah...', 1, NULL, 'Harus dihilangkan sepenuhnya', 'Selalu ditunjukkan', 'Dikelola agar tidak merusak proses', 'Digunakan untuk menekan lawan', 'Dijadikan senjata utama', 'Tidak terkontrol', 'Tidak bijak', 'Dikelola secara sehat', 'Tidak sopan', 'Tidak profesional', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(32, 11, 11, 'Apa tujuan utama dari sebuah proses negosiasi?', 1, NULL, 'Memenangkan argumen', 'Menekan pihak lawan', 'Mencapai kesepakatan', 'Menghindari konflik', 'Menjatuhkan lawan', 'Tidak menunjukkan kompromi', 'Tidak menyelesaikan masalah', 'Ada kesepakatan dari dua pihak', 'Tidak ada komunikasi', 'Bukan solusi terbaik', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(33, 11, 12, 'Dalam negosiasi, penting untuk memahami kebutuhan lawan bicara. Mengapa demikian?', 1, NULL, 'Agar bisa mengalahkan mereka', 'Agar bisa membuat mereka setuju tanpa berpikir', 'Agar tercipta solusi yang menguntungkan kedua belah pihak', 'Agar bisa mengabaikan pendapat mereka', 'Agar diskusi berjalan cepat', 'Tidak menjawab kebutuhan mereka', 'Egois', 'Solusi adil dan menguntungkan', 'Sepihak', 'Kurang etis', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(34, 11, 13, 'Ciri khas dari teks negosiasi adalah...', 1, NULL, 'Naratif dan deskriptif', 'Monolog dan subjektif', 'Dialogis dan kompromis', 'Informatif dan kritis', 'Emotif dan persuasif', 'Tidak melibatkan dua pihak', 'Tidak mencari solusi', 'Saling berbicara dan menyepakati', 'Hanya satu pihak', 'Terlalu ekspresif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(35, 11, 14, 'Jika dalam negosiasi satu pihak bersikukuh, apa dampaknya?', 1, NULL, 'Proses akan cepat selesai', 'Kesepakatan mudah tercapai', 'Terjadi jalan buntu', 'Semua pihak merasa diuntungkan', 'Solusi segera ditemukan', 'Tidak memberikan ruang kompromi', 'Tidak adil', 'Tidak lanjut', 'Hanya satu suara', 'Tidak kreatif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(36, 11, 15, 'Yang bukan merupakan langkah dalam bernegosiasi adalah...', 1, NULL, 'Menyampaikan pendapat', 'Mendengarkan lawan bicara', 'Menolak semua usulan', 'Mencari titik temu', 'Mengajukan solusi', 'Proses komunikasi', 'Kompromi', 'Tidak kooperatif', 'Diskusi dua arah', 'Tidak memberi solusi', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(37, 11, 16, 'Apa tujuan menulis teks biografi tokoh inspiratif?', 1, NULL, 'Menghibur pembaca', 'Mengkritik kebijakan', 'Memberi teladan dan motivasi', 'Mengumbar kehidupan pribadi', 'Menyebar gosip', 'Tidak memberikan teladan', 'Tidak inspiratif', 'Memberikan semangat hidup', 'Tidak penting', 'Tidak ilmiah', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(38, 11, 17, 'Informasi penting dalam teks biografi biasanya berisi...', 1, NULL, 'Keinginan pribadi penulis', 'Hal-hal yang belum terbukti', 'Perjalanan hidup tokoh dan kontribusinya', 'Peristiwa fiksi dan imajinasi', 'Kritik terhadap tokoh lain', 'Tidak relevan', 'Tidak faktual', 'Menggambarkan perjuangan tokoh', 'Tidak nyata', 'Tidak mendidik', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(39, 11, 18, 'Teks biografi berbeda dengan autobiografi karena...', 1, NULL, 'Ditulis oleh tokoh itu sendiri', 'Ditulis oleh orang lain', 'Lebih subjektif', 'Lebih panjang', 'Tidak jelas sumbernya', 'Otobiografi bukan orang lain', 'Otobiografi lebih pribadi', 'Biografi pihak ketiga', 'Tidak akurat', 'Tidak sahih', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(40, 11, 19, 'Nilai yang sering muncul dalam teks biografi tokoh sukses adalah...', 1, NULL, 'Hedonisme', 'Konsumtif', 'Ketekunan dan semangat pantang menyerah', 'Sikap apatis', 'Egoisme', 'Tidak memberi teladan', 'Konsumtif', 'Rajin dan tekun', 'Tidak peduli', 'Tidak bermoral', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(41, 11, 20, 'Mengapa teks biografi penting untuk pelajar?', 1, NULL, 'Untuk hiburan semata', 'Untuk meniru semua hal dari tokoh', 'Untuk mengambil pelajaran dan inspirasi hidup', 'Untuk menilai tokoh lain', 'Untuk pamer', 'Tidak mendidik', 'Tidak kontekstual', 'Memberikan inspirasi', 'Hanya menilai orang', 'Tidak jujur', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(42, 11, 21, 'Mengapa penyair menggunakan majas dalam puisi?', 1, NULL, 'Agar puisinya menjadi lebih panjang', 'Untuk membuat pembaca bingung', 'Agar puisi menjadi indah dan penuh makna', 'Supaya puisi terlihat formal', 'Untuk menyamakan semua kata', 'Tidak estetis', 'Membingungkan', 'Indah dan bermakna', 'Terlalu kaku', 'Tidak kreatif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(43, 11, 22, 'Berikut ini yang merupakan ciri puisi modern adalah...', 1, NULL, 'Terikat aturan rima dan bait', 'Bebas dalam struktur dan ekspresi', 'Menggunakan bahasa lama', 'Selalu menggunakan metafora', 'Harus memiliki pantun', 'Terlalu baku', 'Terlalu klasik', 'Kebebasan ekspresi', 'Tidak berkembang', 'Terlalu lama', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(44, 11, 23, 'Perbedaan utama antara puisi dan prosa terletak pada...', 1, NULL, 'Panjang kalimat', 'Tata bahasa', 'Struktur dan penggunaan diksi', 'Jenis huruf', 'Isi cerita', 'Tidak membedakan gaya', 'Sama seperti narasi', 'Estetika bahasa dan struktur', 'Teks biasa', 'Tidak puitis', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(45, 11, 24, 'Mengapa penyair kadang menggunakan simbol dalam puisinya?', 1, NULL, 'Agar lebih sulit dipahami', 'Supaya terlihat canggih', 'Untuk menyampaikan makna secara tidak langsung', 'Untuk memperbanyak kata', 'Agar sesuai rima', 'Tidak memperjelas', 'Tidak menyampaikan pesan', 'Makna tersirat dan kuat', 'Terlalu literal', 'Tidak efektif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(46, 11, 25, 'Puisi dapat menjadi sarana ekspresi perasaan karena...', 1, NULL, 'Menggunakan banyak kata ilmiah', 'Mengikuti struktur esai', 'Mengandung emosi, imajinasi, dan estetika', 'Menghindari tema pribadi', 'Hanya untuk hiburan', 'Tidak menyampaikan perasaan', 'Hanya logika', 'Memuat rasa dan keindahan', 'Tidak ekspresif', 'Hanya teknis', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(47, 11, 26, 'Strategi yang paling efektif dalam bernegosiasi adalah...', 1, NULL, 'Menekan lawan', 'Mencari solusi bersama', 'Menghindar dari diskusi', 'Menolak semua ide', 'Mengubah topik', 'Tidak menciptakan solusi', 'Solusi win-win', 'Tidak komunikatif', 'Tidak terbuka', 'Mengaburkan masalah', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(48, 11, 27, 'Dalam proses negosiasi, penting untuk bersikap...', 1, NULL, 'Agresif', 'Tertutup', 'Asertif', 'Menyerah', 'Emosional', 'Tidak menghargai', 'Tidak responsif', 'Jelas dan tegas', 'Tidak mendengar', 'Tidak sopan', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(49, 11, 28, 'Kesepakatan dalam negosiasi dapat dicapai jika...', 1, NULL, 'Salah satu pihak kalah', 'Kedua pihak saling memahami kebutuhan', 'Tidak ada kompromi', 'Satu pihak memaksakan kehendak', 'Diskusi dihentikan', 'Menang-kalah', 'Ada empati dan pengertian', 'Tidak ada komunikasi', 'Tidak adil', 'Tidak efektif', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(50, 11, 29, 'Jika dalam negosiasi muncul konflik, sikap terbaik adalah...', 1, NULL, 'Menghindari pembicaraan', 'Mendengarkan dan mencari solusi', 'Memotong pembicaraan', 'Menyerang secara verbal', 'Membubarkan pertemuan', 'Tidak produktif', 'Mencari titik temu', 'Tidak menyelesaikan', 'Tidak fokus', 'Emosi', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(51, 11, 30, 'Dalam negosiasi, kompromi berarti...', 1, NULL, 'Mengorbankan semua prinsip', 'Mengikuti semua keinginan pihak lain', 'Memberi dan menerima secara adil', 'Menolak usulan', 'Mengubah tujuan', 'Bukan solusi adil', 'Mengalah terus-menerus', 'Adil dua arah', 'Tidak konsisten', 'Tidak logis', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(52, 11, 31, 'Kesalahan umum dalam negosiasi adalah...', 1, NULL, 'Mencari informasi lawan', 'Mempersiapkan argumen', 'Tidak mendengarkan pihak lain', 'Mengembangkan opsi', 'Mengendalikan emosi', 'Tidak memperhatikan', 'Tidak mendengar', 'Tidak peka', 'Kooperatif', 'Tidak fokus', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(53, 11, 32, 'Hal pertama yang perlu dilakukan saat memulai negosiasi adalah...', 1, NULL, 'Menyerang lawan bicara', 'Menyampaikan tuduhan', 'Menyampaikan maksud dan tujuan', 'Meninggalkan ruangan', 'Menutup diskusi', 'Tidak jelas tujuan', 'Tidak menjelaskan', 'Tujuan menjadi awal', 'Menghindar', 'Tidak sopan', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(54, 11, 33, 'Tujuan dari teknik BATNA (Best Alternative To a Negotiated Agreement) dalam negosiasi adalah...', 1, NULL, 'Menghindari konflik', 'Mendapatkan semua keinginan', 'Mengetahui alternatif terbaik jika negosiasi gagal', 'Memanipulasi lawan', 'Menutup semua opsi', 'Tidak siap alternatif', 'Tidak punya rencana', 'Ada rencana cadangan', 'Tidak efisien', 'Tidak produktif', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(55, 11, 34, 'Negosiasi bisa gagal jika...', 1, NULL, 'Kedua belah pihak terbuka', 'Hanya satu pihak yang menentukan', 'Ada kompromi', 'Ada saling pengertian', 'Ada komunikasi', 'Tidak adil', 'Dominan satu pihak', 'Tidak fleksibel', 'Tidak seimbang', 'Tidak saling percaya', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(56, 11, 35, 'Peran emosi dalam negosiasi adalah...', 1, NULL, 'Harus dihilangkan sepenuhnya', 'Selalu ditunjukkan', 'Dikelola agar tidak merusak proses', 'Digunakan untuk menekan lawan', 'Dijadikan senjata utama', 'Tidak terkontrol', 'Tidak bijak', 'Dikelola secara sehat', 'Tidak sopan', 'Tidak profesional', 'C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(57, 11, 36, 'Tujuan utama menulis teks biografi adalah...', 1, NULL, 'Menjelaskan teori ilmiah', 'Mengungkap kepribadian tokoh untuk diteladani', 'Menyusun daftar riwayat hidup', 'Membuat cerita fiksi', 'Menyampaikan berita terkini', 'Tidak faktual', 'Tidak mendidik', 'Memberi inspirasi', 'Tidak nyata', 'Tidak lengkap', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(58, 11, 37, 'Ciri khas teks biografi adalah...', 1, NULL, 'Mengandung opini penulis secara dominan', 'Berdasarkan fakta kehidupan tokoh', 'Berisi dialog imajinatif', 'Menggunakan bahasa sastra tinggi', 'Tidak berdasarkan data', 'Tidak faktual', 'Tidak akurat', 'Berdasar fakta tokoh', 'Imajiner', 'Tidak edukatif', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(59, 11, 38, 'Yang membedakan teks biografi dari autobiografi adalah...', 1, NULL, 'Gaya bahasa', 'Penulisnya', 'Tokohnya', 'Tempat penulisan', 'Bahasa yang digunakan', 'Sama saja', 'Penulis bukan tokoh itu sendiri', 'Ditulis tokoh', 'Tidak berbeda', 'Hanya fiksi', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(60, 11, 39, 'Keteladanan tokoh dalam biografi penting untuk...', 1, NULL, 'Hiburan semata', 'Mendorong pembaca mengikuti jejak yang baik', 'Menambah jumlah halaman', 'Menarik simpati pembaca', 'Menyajikan kisah dramatis', 'Tidak memberi dampak', 'Tidak memberi semangat', 'Memberi inspirasi', 'Menipu pembaca', 'Hanya opini', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(61, 11, 40, 'Langkah pertama menyusun teks biografi adalah...', 1, NULL, 'Menulis judul', 'Mencari informasi faktual tentang tokoh', 'Mengedit naskah', 'Menentukan latar tempat', 'Menyusun daftar pustaka', 'Tidak perlu riset', 'Tidak penting tokohnya', 'Fakta penting', 'Latar belakang tokoh', 'Tidak berdasarkan fakta', 'B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 2, NULL, NULL),
(62, 13, 1, '<p>DFASFD</p>', 1, NULL, '<p>FDAFAFFFFF</p>', '<p>AAAA</p>', '<p>CCCCCCCCCCCC</p>', '<p>DDDDDDDDDDDDDDDDDDDDD</p>', '<p>EEEEEEEEEEEEEEEEE</p>', NULL, NULL, NULL, NULL, NULL, 'E', '13_1_1.png', '', '', '', '', '', '', NULL, 0, 1, NULL, NULL);
INSERT INTO `soal` (`id_soal`, `id_bank`, `nomor`, `soal`, `jenis`, `opsi`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `perA`, `perB`, `perC`, `perD`, `perE`, `jawaban`, `file`, `file1`, `fileA`, `fileB`, `fileC`, `fileD`, `fileE`, `ket`, `sts`, `max_skor`, `jenisjawab`, `panjang`) VALUES
(63, 13, 2, '<p>harus a&nbsp;&nbsp;<img class=\"img-responsive\" src=\"data:image/png;base64,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AAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAECAvAQAAAAAAEDA/wOxVcEgMSg/QQAAAABJRU5ErkJggg==\" alt=\"\" width=\"2250\" height=\"3000\" /></p>', 1, NULL, '<p>a</p>', '<p>b</p>', '<p>c</p>', '<p>d</p>', '<p>e</p>', NULL, NULL, NULL, NULL, NULL, 'A', '13_2_1.png', '', '', '', '', '', '', NULL, 0, 1, NULL, NULL);
INSERT INTO `soal` (`id_soal`, `id_bank`, `nomor`, `soal`, `jenis`, `opsi`, `pilA`, `pilB`, `pilC`, `pilD`, `pilE`, `perA`, `perB`, `perC`, `perD`, `perE`, `jawaban`, `file`, `file1`, `fileA`, `fileB`, `fileC`, `fileD`, `fileE`, `ket`, `sts`, `max_skor`, `jenisjawab`, `panjang`) VALUES
(64, 14, 1, '<p>Hukum zakat?</p>', 1, NULL, '<p>sunat</p>', '<p>wajib</p>', '<p>makruh</p>', '<p>tidak wajib</p>', '', NULL, NULL, NULL, NULL, NULL, 'B', '', '', '', '', '', '', '', NULL, 0, 1, NULL, NULL),
(65, 14, 2, '<p>kapan liburan?</p>', 1, NULL, '<p>besok</p>', '<p>lusa</p>', '<p>kamis</p>', '<p>jumat</p>', '', NULL, NULL, NULL, NULL, NULL, 'D', '', '', '', '', '', '', '', NULL, 0, 1, NULL, NULL),
(66, 14, 3, '<p>apakah kamu senang libur?</p>', 3, NULL, '<p>iya</p>', '<p>senang</p>', '<p>tidak</p>', '<p>aah bohong kalo tidak</p>', '', NULL, NULL, NULL, NULL, NULL, 'A, B', '', '', '', '', '', '', '', NULL, 0, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sosial`
--

CREATE TABLE `sosial` (
  `ids` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `ket1` mediumtext DEFAULT NULL,
  `ket2` mediumtext DEFAULT NULL,
  `pred` varchar(5) DEFAULT NULL,
  `smt` varchar(11) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `spiritual`
--

CREATE TABLE `spiritual` (
  `ids` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `ket1` mediumtext DEFAULT NULL,
  `ket2` mediumtext DEFAULT NULL,
  `pred` varchar(5) DEFAULT NULL,
  `smt` varchar(11) DEFAULT NULL,
  `tp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `statustrx`
--

CREATE TABLE `statustrx` (
  `id` int(11) NOT NULL,
  `mode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `statustrx`
--

INSERT INTO `statustrx` (`id`, `mode`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idpeg` varchar(11) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `ket` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `aprove` varchar(11) DEFAULT NULL,
  `waktu` varchar(50) DEFAULT NULL,
  `file` text DEFAULT NULL,
  `pesan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id`, `idsiswa`, `idpeg`, `level`, `tanggal`, `ket`, `status`, `aprove`, `waktu`, `file`, `pesan`) VALUES
(5, '1', NULL, 'siswa', '2025-02-27', '1', 1, NULL, NULL, '1.png', 'Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n ABIWANTA RIZKY WIDYA AGUNG\n Hari ini Tidak Hadir karena : SAKIT\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER SMA NEGERI 1 NUSANTARA\nWaktu Server :2025-03-22 10:34:11'),
(6, '6', NULL, 'siswa', '2025-03-04', '1', 1, NULL, NULL, '6.jpg', 'Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n ANDREAS NOVA ANDRIANO\n Hari ini Tidak Hadir karena : SAKIT\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua Siswa terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER SMA NEGERI 1 NUSANTARA\nWaktu Server :2025-03-22 10:34:12'),
(7, NULL, '7', 'pegawai', '2025-03-04', '1', 1, NULL, NULL, '7.png', 'Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n Ananda Syah, S.Pd.\n Hari ini Tidak Hadir karena : SAKIT\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua pegawai terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER SMA NEGERI 1 NUSANTARA\nWaktu Server :2025-03-05 21:01:56'),
(8, NULL, '7', 'pegawai', '2025-03-05', '1', 1, NULL, NULL, '7.png', 'Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n Ananda Syah, S.Pd.\n Hari ini Tidak Hadir karena : SAKIT\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua pegawai terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER SMA NEGERI 1 NUSANTARA\nWaktu Server :2025-03-05 21:02:02'),
(9, 'sdsd', NULL, 'siswa', '2025-03-23', 'sfsfdf', 0, NULL, NULL, 'sdsd.jpg', NULL),
(10, 'a', NULL, 'siswa', '2025-03-23', 'a', 0, NULL, NULL, 'a.phtml', NULL),
(11, NULL, '2', 'pegawai', '2025-04-07', '2', 1, NULL, NULL, '2.docx', 'Assalamualaikum wr wb.....\n\n Kami informasikan bahwa Ananda :\n LIONEL MESSI, S,Pd.\n Hari ini Tidak Hadir karena : IZIN\n\nDemikian Informasi kami sampaikan berdasarkan *Surat Permohonan* yang dikirim ke Sekolah.\n\nInformasi ini untuk menjadi Sarana Monitoring Orang Tua pegawai terhadap putra putrinya. Terima kasih dan salam hangat dari Kami, Pesan ini tidak perlu dibalas\n\nWassalamualaikum wr wb.....\n\nSender : SERVER SMA NEGERI 1 NUSANTARA\nWaktu Server :2025-04-22 08:35:38'),
(12, '101', NULL, 'siswa', '2025-05-20', '1', 0, NULL, NULL, '101.png', NULL),
(13, NULL, '68', 'pegawai', '2025-06-01', '2', 0, NULL, NULL, '68.png', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_barang`
--

CREATE TABLE `s_barang` (
  `id` int(11) NOT NULL,
  `idk` varchar(50) DEFAULT NULL,
  `idl` varchar(50) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jumlah` varchar(50) DEFAULT NULL,
  `baik` varchar(11) DEFAULT NULL,
  `rb` int(11) DEFAULT 0,
  `rs` int(11) NOT NULL DEFAULT 0,
  `rr` int(11) NOT NULL DEFAULT 0,
  `foto` text DEFAULT NULL,
  `foto_rb` text DEFAULT NULL,
  `foto_rs` text DEFAULT NULL,
  `foto_rr` text DEFAULT NULL,
  `kondisi` varchar(50) DEFAULT NULL,
  `atap` varchar(11) DEFAULT NULL,
  `lantai` varchar(11) DEFAULT NULL,
  `dinding` varchar(11) DEFAULT NULL,
  `pintu` varchar(11) DEFAULT NULL,
  `jendela` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_kategori`
--

CREATE TABLE `s_kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `s_kategori`
--

INSERT INTO `s_kategori` (`id`, `kategori`) VALUES
(1, 'Bangunan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `s_lokasi`
--

CREATE TABLE `s_lokasi` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_file`
--

CREATE TABLE `temp_file` (
  `id_file` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT 0,
  `nama_file` varchar(50) DEFAULT NULL,
  `status_file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_finger`
--

CREATE TABLE `temp_finger` (
  `id` int(11) NOT NULL,
  `level` varchar(50) DEFAULT NULL,
  `idjari` int(11) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_pil`
--

CREATE TABLE `temp_pil` (
  `id` int(11) NOT NULL,
  `idbank` int(11) NOT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp_soal`
--

CREATE TABLE `temp_soal` (
  `id` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `idfile` int(11) NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpbayar`
--

CREATE TABLE `tmpbayar` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpbuku`
--

CREATE TABLE `tmpbuku` (
  `kode` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpreg`
--

CREATE TABLE `tmpreg` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmpsis`
--

CREATE TABLE `tmpsis` (
  `nokartu` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id_token` int(11) NOT NULL,
  `token` varchar(6) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `masa_berlaku` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id_token`, `token`, `time`, `masa_berlaku`) VALUES
(1, 'RJAREA', '2025-06-01 04:21:27', '00:15:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `idt` int(11) NOT NULL,
  `nama_toko` varchar(100) DEFAULT NULL,
  `deskrip` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`idt`, `nama_toko`, `deskrip`) VALUES
(1, 'Kantin 1', 'Kantin samping kamar mandi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idbuku` varchar(11) DEFAULT NULL,
  `jml` int(11) NOT NULL DEFAULT 1,
  `tgl_kembali` date DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_kantin`
--

CREATE TABLE `transaksi_kantin` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `idsiswa` varchar(11) DEFAULT NULL,
  `idproduk` varchar(11) DEFAULT NULL,
  `jumlah` varchar(11) DEFAULT NULL,
  `harga` varchar(11) DEFAULT NULL,
  `total_harga` varchar(11) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT '0',
  `ket` int(11) NOT NULL DEFAULT 0,
  `bulan` varchar(11) DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `transaksi_kantin`
--

INSERT INTO `transaksi_kantin` (`id`, `tanggal`, `idsiswa`, `idproduk`, `jumlah`, `harga`, `total_harga`, `status`, `ket`, `bulan`, `tahun`) VALUES
(1, '2025-03-02', '1234567890', '1', '5', '3000', '15000', '2', 0, '03', '2025'),
(2, '2025-03-04', '1234567890', '1', '34', '3000', '102000', '2', 0, '03', '2025'),
(3, '2025-03-05', '6', '1', '16', '3000', '48000', '1', 1, NULL, NULL),
(4, '2025-03-05', '1234567890', '1', '16', '3000', '48000', '2', 0, '03', '2025'),
(5, '2025-03-05', '1234567890', '1', '60', '3000', '180000', '2', 0, '03', '2025'),
(6, '2025-03-23', '1234567890', '1', '2', '3000', '6000', '2', 0, '03', '2025'),
(7, '2025-03-24', '18', '1', '1', '3000', '3000', '1', 0, NULL, NULL),
(8, '2025-03-28', '2', '1', '2', '3000', '6000', '1', 0, NULL, NULL),
(9, '2025-03-31', '14', '1', '2', '3000', '6000', '1', 0, NULL, NULL),
(10, '2025-05-01', '1234567890', '1', '7', '3000', '21000', '2', 0, '05', '2025'),
(11, '2025-05-01', '1234567890', '1', '5', '3000', '15000', '2', 0, '05', '2025'),
(12, '2025-05-16', '2', '1', '8', '3000', '24000', '1', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_bayar`
--

CREATE TABLE `trx_bayar` (
  `id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `blth` varchar(50) DEFAULT NULL,
  `idsiswa` int(11) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idbayar` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  `ke` int(11) DEFAULT NULL,
  `bukti` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(255) NOT NULL,
  `id_guru` int(255) DEFAULT NULL,
  `kelas` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `mapel` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `judul` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tugas` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_guru`, `kelas`, `mapel`, `judul`, `tugas`, `file`, `tgl_mulai`, `tgl_selesai`, `tgl`, `status`) VALUES
(3, 1, 'a:2:{i:0;s:3:\"X-1\";i:1;s:3:\"X-2\";}', 'BINDO', 'Teks Negosiasi', '<p>1. Teks yang berisi bentuk interaksi sosial untuk mencapai kesepakatan antara pihak-pihak yang memiliki kepentingan berbeda disebut....</p>\r\n<p><br />A. teks argumentasi<br />B. teks persuasi<br />C. teks negosiasi<br />D. teks eksplanasi<br />E. teks deskripsi</p>\r\n<p>2.&nbsp;</p>\r\n<p>Di bawah ini pernyataan yang tepat terkait dengan tujuan teks negosiasi adalah....</p>\r\n<p><br />A. menjelaskan gagasan seseorang<br />B. memenangkan pendapat pribadi<br />C. membantu menyelesaikan masalah bersama<br />D. mengajak orang lain menyetujui opini pribadi<br />E. semua pihak menerima hasil kesepakatan bersama</p>', 'X_Bahasa-Indonesia_KD-3.11_Final.pdf', '2025-05-05 08:00:00', '2025-05-27 15:00:00', '2025-05-05 02:20:57', NULL),
(4, 2, 'a:1:{i:0;s:3:\"X-1\";}', 'MTK', 'matematika', '', NULL, '2025-05-16 19:00:00', '2025-05-16 20:00:00', '2025-05-16 12:10:25', NULL),
(5, 7, 'a:2:{i:0;s:5:\"XII-1\";i:1;s:5:\"XII-2\";}', 'INFO', 'software', '<p>sebutkan macam2 software</p>', NULL, '2025-05-19 10:00:00', '2025-05-20 12:00:00', '2025-05-20 02:47:04', NULL),
(6, 1, 'a:1:{i:0;s:3:\"X-2\";}', 'MTK', 'tes', '<p>tes</p>', 'X_Bahasa-Indonesia_KD-3.11_Final.pdf', '2025-05-26 09:02:00', '2025-05-31 09:03:00', '2025-05-28 01:46:12', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tujuan`
--

CREATE TABLE `tujuan` (
  `idt` int(11) NOT NULL,
  `mapel` varchar(11) DEFAULT NULL,
  `level` varchar(11) DEFAULT NULL,
  `idlm` varchar(11) DEFAULT NULL,
  `lm` varchar(11) DEFAULT NULL,
  `tujuan` longtext DEFAULT NULL,
  `tp` varchar(11) DEFAULT NULL,
  `smt` varchar(11) DEFAULT NULL,
  `guru` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `tujuan`
--

INSERT INTO `tujuan` (`idt`, `mapel`, `level`, `idlm`, `lm`, `tujuan`, `tp`, `smt`, `guru`) VALUES
(5, '9', '10', '6', '1', 'Siswa mampu memahami fungsi dan komponen dasar perangkat keras komputer.', '1', '2', '4'),
(6, '9', '10', '6', '1', 'Siswa dapat mengidentifikasi jenis-jenis perangkat keras komputer beserta fungsinya.', '2', '2', '4'),
(7, '9', '12', '9', '2', 'mengetahui softwer ', '1', '2', '7'),
(8, '9', '12', '8', '1', 'mengetahui komputer', '2', '2', '7'),
(9, '9', '10', '10', '1', 'bisa', '1', '2', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

CREATE TABLE `ujian` (
  `id_ujian` int(11) NOT NULL,
  `kode_nama` varchar(255) DEFAULT NULL,
  `id_bank` int(11) DEFAULT NULL,
  `kode_ujian` varchar(30) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jml_soal` int(11) NOT NULL DEFAULT 0,
  `jml_esai` int(11) NOT NULL DEFAULT 0,
  `jml_multi` int(11) NOT NULL DEFAULT 0,
  `jml_bs` int(11) NOT NULL DEFAULT 0,
  `jml_urut` int(11) NOT NULL DEFAULT 0,
  `tampil_bs` int(11) NOT NULL DEFAULT 0,
  `tampil_urut` int(11) NOT NULL DEFAULT 0,
  `tampil_pg` int(11) NOT NULL DEFAULT 0,
  `tampil_esai` int(11) NOT NULL DEFAULT 0,
  `tampil_multi` int(11) NOT NULL DEFAULT 0,
  `lama_ujian` int(11) NOT NULL DEFAULT 0,
  `tgl_ujian` datetime DEFAULT NULL,
  `tgl_selesai` datetime DEFAULT NULL,
  `waktu_ujian` time DEFAULT NULL,
  `selesai_ujian` time DEFAULT NULL,
  `level` varchar(5) DEFAULT NULL,
  `pk` mediumtext DEFAULT NULL,
  `opsi` int(11) DEFAULT 4,
  `sesi` varchar(1) DEFAULT NULL,
  `acak` int(11) DEFAULT 1,
  `token` int(11) DEFAULT 0,
  `status` int(11) DEFAULT NULL,
  `hasil` int(11) DEFAULT 0,
  `kkm` varchar(128) DEFAULT NULL,
  `ulang` int(11) DEFAULT 0,
  `soal_agama` varchar(50) DEFAULT NULL,
  `reset` int(11) DEFAULT 0,
  `pelanggaran` int(11) DEFAULT 0,
  `btnselesai` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id_ujian`, `kode_nama`, `id_bank`, `kode_ujian`, `nama`, `jml_soal`, `jml_esai`, `jml_multi`, `jml_bs`, `jml_urut`, `tampil_bs`, `tampil_urut`, `tampil_pg`, `tampil_esai`, `tampil_multi`, `lama_ujian`, `tgl_ujian`, `tgl_selesai`, `waktu_ujian`, `selesai_ujian`, `level`, `pk`, `opsi`, `sesi`, `acak`, `token`, `status`, `hasil`, `kkm`, `ulang`, `soal_agama`, `reset`, `pelanggaran`, `btnselesai`) VALUES
(9, 'BINDO-A', 9, 'PAS', 'BINDO', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 90, '2025-05-31 00:00:00', '2025-06-28 12:00:00', '00:00:00', NULL, '10', 'semua', 4, '1', 1, 0, 1, 0, NULL, 0, '', 0, 10, 0),
(10, 'IT', 13, 'IT', 'INFO', 2, 0, 0, 0, 0, 0, 0, 2, 0, 0, 90, '2025-05-31 03:00:00', '2025-06-30 06:00:00', '03:00:00', NULL, '10', 'semua', 4, '1', 1, 0, 1, 0, NULL, 0, '', 0, 0, 0),
(11, 'PAI', 14, 'TES-BI', 'PABP', 2, 0, 1, 0, 0, 0, 0, 2, 0, 1, 90, '2025-06-01 10:00:00', '2025-06-01 00:00:00', '10:00:00', NULL, '10', 'semua', 4, '1', 1, 0, 1, 0, NULL, 0, 'Islam', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `waktu`
--

CREATE TABLE `waktu` (
  `id` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `masuk` varchar(50) NOT NULL,
  `pulang` varchar(50) NOT NULL,
  `alpha` varchar(50) NOT NULL,
  `masuk_eskul` varchar(50) DEFAULT NULL,
  `jam_eskul` varchar(50) DEFAULT NULL,
  `pulang_eskul` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `waktu`
--

INSERT INTO `waktu` (`id`, `hari`, `masuk`, `pulang`, `alpha`, `masuk_eskul`, `jam_eskul`, `pulang_eskul`) VALUES
(1, 'Mon', '07:00', '14:00', '08:00:00', '23:00:00', '23:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `walas`
--

CREATE TABLE `walas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `idwalas` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `walas`
--

INSERT INTO `walas` (`id`, `kelas`, `idwalas`) VALUES
(1, 'X-1', '24'),
(2, 'X-2', '16'),
(3, 'XI-1', '4'),
(4, 'XII-1', '5');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absensi_les`
--
ALTER TABLE `absensi_les`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absensi_mapel`
--
ALTER TABLE `absensi_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absen_daringmapel`
--
ALTER TABLE `absen_daringmapel`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `absen_gps`
--
ALTER TABLE `absen_gps`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `banksoal`
--
ALTER TABLE `banksoal`
  ADD PRIMARY KEY (`id_bank`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `bell`
--
ALTER TABLE `bell`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bell_nada`
--
ALTER TABLE `bell_nada`
  ADD PRIMARY KEY (`idb`);

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `bk_kategori`
--
ALTER TABLE `bk_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_pelanggaran`
--
ALTER TABLE `bk_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_pesan`
--
ALTER TABLE `bk_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_siswa`
--
ALTER TABLE `bk_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_sp`
--
ALTER TABLE `bk_sp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_sub`
--
ALTER TABLE `bk_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_surat`
--
ALTER TABLE `bk_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bk_tindakan`
--
ALTER TABLE `bk_tindakan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tindakan` (`tindakan`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `datareg`
--
ALTER TABLE `datareg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_luar`
--
ALTER TABLE `data_luar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `disfo`
--
ALTER TABLE `disfo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `download`
--
ALTER TABLE `download`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `informasi`
--
ALTER TABLE `informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_dup`
--
ALTER TABLE `jawaban_dup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jawaban_soal`
--
ALTER TABLE `jawaban_soal`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `jenis_satuan`
--
ALTER TABLE `jenis_satuan`
  ADD PRIMARY KEY (`satuan`);

--
-- Indeks untuk tabel `jodoh`
--
ALTER TABLE `jodoh`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kurikulum`
--
ALTER TABLE `kurikulum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tingkat` (`tingkat`);

--
-- Indeks untuk tabel `k_bayar`
--
ALTER TABLE `k_bayar`
  ADD PRIMARY KEY (`kelas`);

--
-- Indeks untuk tabel `lingkup`
--
ALTER TABLE `lingkup`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indeks untuk tabel `mapel_ijazah`
--
ALTER TABLE `mapel_ijazah`
  ADD PRIMARY KEY (`idmapel`);

--
-- Indeks untuk tabel `mapel_rapor`
--
ALTER TABLE `mapel_rapor`
  ADD PRIMARY KEY (`idm`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `mesin_absen`
--
ALTER TABLE `mesin_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_bayar`
--
ALTER TABLE `m_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  ADD PRIMARY KEY (`idm`);

--
-- Indeks untuk tabel `m_dimensi`
--
ALTER TABLE `m_dimensi`
  ADD PRIMARY KEY (`id_dimensi`);

--
-- Indeks untuk tabel `m_elemen`
--
ALTER TABLE `m_elemen`
  ADD PRIMARY KEY (`id_elemen`);

--
-- Indeks untuk tabel `m_eskul`
--
ALTER TABLE `m_eskul`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_hari`
--
ALTER TABLE `m_hari`
  ADD PRIMARY KEY (`idh`);

--
-- Indeks untuk tabel `m_kurikulum`
--
ALTER TABLE `m_kurikulum`
  ADD PRIMARY KEY (`idk`);

--
-- Indeks untuk tabel `m_lemari`
--
ALTER TABLE `m_lemari`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_nilai_proyek`
--
ALTER TABLE `m_nilai_proyek`
  ADD PRIMARY KEY (`nilai`);

--
-- Indeks untuk tabel `m_pesan`
--
ALTER TABLE `m_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_proyek`
--
ALTER TABLE `m_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_rapor`
--
ALTER TABLE `m_rapor`
  ADD PRIMARY KEY (`idr`);

--
-- Indeks untuk tabel `m_spiritual`
--
ALTER TABLE `m_spiritual`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `m_sub_elemen`
--
ALTER TABLE `m_sub_elemen`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_harian`
--
ALTER TABLE `nilai_harian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_proses`
--
ALTER TABLE `nilai_proses`
  ADD PRIMARY KEY (`idpros`);

--
-- Indeks untuk tabel `nilai_proyek`
--
ALTER TABLE `nilai_proyek`
  ADD PRIMARY KEY (`idn`);

--
-- Indeks untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_skl`
--
ALTER TABLE `nilai_skl`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_aplikasi`);

--
-- Indeks untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  ADD PRIMARY KEY (`id_pengawas`);

--
-- Indeks untuk tabel `pesan_terkirim`
--
ALTER TABLE `pesan_terkirim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peskul`
--
ALTER TABLE `peskul`
  ADD PRIMARY KEY (`idp`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`idp`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `savsoft_options`
--
ALTER TABLE `savsoft_options`
  ADD PRIMARY KEY (`oid`);

--
-- Indeks untuk tabel `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  ADD PRIMARY KEY (`qid`);

--
-- Indeks untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indeks untuk tabel `skkb`
--
ALTER TABLE `skkb`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `skl`
--
ALTER TABLE `skl`
  ADD PRIMARY KEY (`id_skl`);

--
-- Indeks untuk tabel `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indeks untuk tabel `sosial`
--
ALTER TABLE `sosial`
  ADD PRIMARY KEY (`ids`);

--
-- Indeks untuk tabel `spiritual`
--
ALTER TABLE `spiritual`
  ADD PRIMARY KEY (`ids`);

--
-- Indeks untuk tabel `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `statustrx`
--
ALTER TABLE `statustrx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `s_barang`
--
ALTER TABLE `s_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `s_kategori`
--
ALTER TABLE `s_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `s_lokasi`
--
ALTER TABLE `s_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_file`
--
ALTER TABLE `temp_file`
  ADD PRIMARY KEY (`id_file`);

--
-- Indeks untuk tabel `temp_finger`
--
ALTER TABLE `temp_finger`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_pil`
--
ALTER TABLE `temp_pil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp_soal`
--
ALTER TABLE `temp_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tmpbayar`
--
ALTER TABLE `tmpbayar`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `tmpbuku`
--
ALTER TABLE `tmpbuku`
  ADD KEY `nokartu` (`kode`);

--
-- Indeks untuk tabel `tmpreg`
--
ALTER TABLE `tmpreg`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `tmpsis`
--
ALTER TABLE `tmpsis`
  ADD KEY `nokartu` (`nokartu`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id_token`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`idt`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_kantin`
--
ALTER TABLE `transaksi_kantin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trx_bayar`
--
ALTER TABLE `trx_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- Indeks untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  ADD PRIMARY KEY (`idt`);

--
-- Indeks untuk tabel `ujian`
--
ALTER TABLE `ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `walas`
--
ALTER TABLE `walas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas` (`kelas`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `absensi_les`
--
ALTER TABLE `absensi_les`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `absensi_mapel`
--
ALTER TABLE `absensi_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT untuk tabel `absen_daringmapel`
--
ALTER TABLE `absen_daringmapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `absen_gps`
--
ALTER TABLE `absen_gps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `banksoal`
--
ALTER TABLE `banksoal`
  MODIFY `id_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `bell`
--
ALTER TABLE `bell`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `bell_nada`
--
ALTER TABLE `bell_nada`
  MODIFY `idb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bk_kategori`
--
ALTER TABLE `bk_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `bk_pelanggaran`
--
ALTER TABLE `bk_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `bk_pesan`
--
ALTER TABLE `bk_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bk_siswa`
--
ALTER TABLE `bk_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `bk_sp`
--
ALTER TABLE `bk_sp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bk_sub`
--
ALTER TABLE `bk_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `bk_surat`
--
ALTER TABLE `bk_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bk_tindakan`
--
ALTER TABLE `bk_tindakan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `datareg`
--
ALTER TABLE `datareg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `data_luar`
--
ALTER TABLE `data_luar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `deskripsi`
--
ALTER TABLE `deskripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `disfo`
--
ALTER TABLE `disfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `download`
--
ALTER TABLE `download`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `file_pendukung`
--
ALTER TABLE `file_pendukung`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `informasi`
--
ALTER TABLE `informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT untuk tabel `jawaban_dup`
--
ALTER TABLE `jawaban_dup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `jawaban_soal`
--
ALTER TABLE `jawaban_soal`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT untuk tabel `jawaban_tugas`
--
ALTER TABLE `jawaban_tugas`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jodoh`
--
ALTER TABLE `jodoh`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kurikulum`
--
ALTER TABLE `kurikulum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `lingkup`
--
ALTER TABLE `lingkup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `mapel_ijazah`
--
ALTER TABLE `mapel_ijazah`
  MODIFY `idmapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mapel_rapor`
--
ALTER TABLE `mapel_rapor`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mesin_absen`
--
ALTER TABLE `mesin_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `m_bayar`
--
ALTER TABLE `m_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `m_buku`
--
ALTER TABLE `m_buku`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `m_dimensi`
--
ALTER TABLE `m_dimensi`
  MODIFY `id_dimensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `m_elemen`
--
ALTER TABLE `m_elemen`
  MODIFY `id_elemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `m_eskul`
--
ALTER TABLE `m_eskul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_hari`
--
ALTER TABLE `m_hari`
  MODIFY `idh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `m_kurikulum`
--
ALTER TABLE `m_kurikulum`
  MODIFY `idk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_lemari`
--
ALTER TABLE `m_lemari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `m_pesan`
--
ALTER TABLE `m_pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `m_proyek`
--
ALTER TABLE `m_proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_rapor`
--
ALTER TABLE `m_rapor`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `m_spiritual`
--
ALTER TABLE `m_spiritual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `m_sub_elemen`
--
ALTER TABLE `m_sub_elemen`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `nilai_formatif`
--
ALTER TABLE `nilai_formatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_harian`
--
ALTER TABLE `nilai_harian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_proses`
--
ALTER TABLE `nilai_proses`
  MODIFY `idpros` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_proyek`
--
ALTER TABLE `nilai_proyek`
  MODIFY `idn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_rapor`
--
ALTER TABLE `nilai_rapor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_skl`
--
ALTER TABLE `nilai_skl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `nilai_sumatif`
--
ALTER TABLE `nilai_sumatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_aplikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengawas`
--
ALTER TABLE `pengawas`
  MODIFY `id_pengawas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pesan_terkirim`
--
ALTER TABLE `pesan_terkirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `peskul`
--
ALTER TABLE `peskul`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `savsoft_options`
--
ALTER TABLE `savsoft_options`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `savsoft_qbank`
--
ALTER TABLE `savsoft_qbank`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `sinkron`
--
ALTER TABLE `sinkron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `skkb`
--
ALTER TABLE `skkb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `soal`
--
ALTER TABLE `soal`
  MODIFY `id_soal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `sosial`
--
ALTER TABLE `sosial`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `spiritual`
--
ALTER TABLE `spiritual`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `statustrx`
--
ALTER TABLE `statustrx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `s_barang`
--
ALTER TABLE `s_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `s_kategori`
--
ALTER TABLE `s_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `s_lokasi`
--
ALTER TABLE `s_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_file`
--
ALTER TABLE `temp_file`
  MODIFY `id_file` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_finger`
--
ALTER TABLE `temp_finger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_pil`
--
ALTER TABLE `temp_pil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `temp_soal`
--
ALTER TABLE `temp_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_kantin`
--
ALTER TABLE `transaksi_kantin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `trx_bayar`
--
ALTER TABLE `trx_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tujuan`
--
ALTER TABLE `tujuan`
  MODIFY `idt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `ujian`
--
ALTER TABLE `ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `walas`
--
ALTER TABLE `walas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
