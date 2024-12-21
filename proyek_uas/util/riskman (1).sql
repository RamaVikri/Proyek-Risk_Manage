-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2024 at 12:53 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskman`
--

-- --------------------------------------------------------

--
-- Table structure for table `risk`
--

CREATE TABLE `risk` (
  `id` int NOT NULL,
  `objective_tujuan` text COLLATE utf8mb4_general_ci,
  `proses_bisnis` text COLLATE utf8mb4_general_ci,
  `risk_category` enum('Resiko Stratejik','Resiko Finansial','Resiko Operasional','Lainnya') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_resiko` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `risk_event` text COLLATE utf8mb4_general_ci,
  `penyebab_resiko` text COLLATE utf8mb4_general_ci,
  `sumber_resiko` enum('Internal','External') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `potensi_kerugian_qualitative` text COLLATE utf8mb4_general_ci,
  `potensi_kerugian_nominal` decimal(15,2) DEFAULT NULL,
  `owner_risk` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_dept_unit` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inherent_risk_likelihood` int DEFAULT NULL,
  `inherent_risk_impact` int DEFAULT NULL,
  `inherent_risk_level` int DEFAULT NULL,
  `pengendalian_ada_tidak` enum('Ada','Tidak Ada') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengendalian_memadai_belum` enum('Memadai','Belum Memadai') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pengendalian_sudah_belum` enum('Sudah','Belum') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `residual_risk_likelihood` int DEFAULT NULL,
  `residual_risk_impact` int DEFAULT NULL,
  `residual_risk_level` int DEFAULT NULL,
  `risk_treatment_accept_reduce` enum('Accept','Reduce') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `risk_treatment_text` text COLLATE utf8mb4_general_ci,
  `jan` tinyint(1) DEFAULT NULL,
  `feb` tinyint(1) DEFAULT NULL,
  `mar` tinyint(1) DEFAULT NULL,
  `apr` tinyint(1) DEFAULT NULL,
  `mei` tinyint(1) DEFAULT NULL,
  `jun` tinyint(1) DEFAULT NULL,
  `jul` tinyint(1) DEFAULT NULL,
  `agu` tinyint(1) DEFAULT NULL,
  `sep` tinyint(1) DEFAULT NULL,
  `okt` tinyint(1) DEFAULT NULL,
  `nov` tinyint(1) DEFAULT NULL,
  `des` tinyint(1) DEFAULT NULL,
  `risk_evidence` text COLLATE utf8mb4_general_ci,
  `target_risk_likelihood` int DEFAULT NULL,
  `target_risk_impact` int DEFAULT NULL,
  `target_risk_level` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `risk`
--

INSERT INTO `risk` (`id`, `objective_tujuan`, `proses_bisnis`, `risk_category`, `kode_resiko`, `risk_event`, `penyebab_resiko`, `sumber_resiko`, `potensi_kerugian_qualitative`, `potensi_kerugian_nominal`, `owner_risk`, `nama_dept_unit`, `inherent_risk_likelihood`, `inherent_risk_impact`, `inherent_risk_level`, `pengendalian_ada_tidak`, `pengendalian_memadai_belum`, `pengendalian_sudah_belum`, `residual_risk_likelihood`, `residual_risk_impact`, `residual_risk_level`, `risk_treatment_accept_reduce`, `risk_treatment_text`, `jan`, `feb`, `mar`, `apr`, `mei`, `jun`, `jul`, `agu`, `sep`, `okt`, `nov`, `des`, `risk_evidence`, `target_risk_likelihood`, `target_risk_impact`, `target_risk_level`) VALUES
(19, 'Jumlah keluaran penelitian yang memiliki rekognisi nasional / Internasional mencapai 220 karya', 'Akademik', 'Resiko Stratejik', NULL, 'Target Tidak Terpenuhi', 'Kompetensi akademik writing rendah', 'Internal', 'Menurunnya reputasi Universitas', '0.00', 'Nama User', 'Dekan FST', 2, 3, 8, 'Ada', 'Memadai', 'Sudah', 1, 3, 3, 'Accept', 'perbaiki SOP, monitor dengan rutin, Pelatihan akademik writing', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'BA Sidang Skripsi, Laporan IKU Tw 1', 1, 2, 2),
(20, 'Target PNBP 2021 sebesar Rp.135.000.000.000', 'Keuangan', 'Resiko Finansial', NULL, 'Target tidak terpenuhi', 'Mahasiswa banyak yang telat bayar dan cuti karena pandemi', 'External', 'Tungkat Maturitas BLU turun', '5000000000.00', 'Nama User', 'Karo PK', 4, 1, 4, 'Ada', 'Memadai', 'Belum', 3, 1, 3, 'Accept', 'Perbaiki SOP, sosialisasi dan motivasi kpd mahasiswa, optimalisasi pendapatan sektor bisnis', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'BA Verifikasi', 2, 1, 2),
(21, 'Melindungi Keselamatan Pegawai', 'Kepegawaian', 'Resiko Operasional', NULL, 'Gempa Bumi', 'Faktor alam', 'External', 'Terjadinya Korban Jiwa', '0.00', 'Nama User', 'Karo AUK', 1, 5, 5, 'Ada', 'Belum Memadai', 'Belum', -11, 5, 5, 'Accept', 'Perbaiki SOP, monitor dengan rutin, pelatihan tanggap bencana', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'BUKU pedoman SOP', 1, 5, 5),
(22, 'Menguatkan kompetensi anggota SPI', 'SPI', 'Resiko Operasional', NULL, 'Kesalahan dalam melaksanakan tugas', 'SPI hanya sebagai tugas tambahan', 'Internal', 'Menurunnya kinerja', '0.00', 'Nama User', 'Kepala SPI', 2, 3, 6, 'Ada', 'Memadai', 'Sudah', 1, 2, 2, 'Accept', 'Pengembangan kompetensi anggota secara berkala', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 'Laporan pengembangan kompetensi anggota', 1, 1, 1),
(23, 'Melindungi Keselamatan Pegawai', 'SPI', 'Resiko Operasional', NULL, 'Tindakan Kekerasan dari auditi yang berkasus', 'Auditi emosional ketika diperiksa', 'External', 'Auditor menjadi korban kekerasan', '0.00', 'Nama User', 'Kepala SPI', 2, 3, 6, 'Ada', 'Memadai', 'Sudah', 1, 2, 2, 'Accept', 'Sosialisasi program audit kepada pimpinan universitas/bagian/unit/lembaga', 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'Notulen Rapat', 1, 1, 1),
(24, 'Mendeteksi adanya kecurangan/penyimpangan anggaran', 'SPI', 'Resiko Finansial', NULL, 'terjadinya kecurangan anggaran yang mencurigakan', 'kurangnya integritas, kurangnya pengawasan, sistem yang memiliki celah', 'External', 'kerugian uang negara', '0.00', 'Nama User', 'Kepala SPI', 2, 5, 10, 'Ada', 'Memadai', 'Sudah', 1, 5, 5, 'Reduce', 'Program audit, sosialisasi program audit', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'Rekomendasi dari audit SPI', 1, 5, 5),
(25, 'Menjaga kepentingan organisasi', 'SPI', 'Resiko Operasional', NULL, 'Terjadinya konflik of interes', 'Belum ada pemisahan fungsi antara penyusun peraturan', 'Internal', 'Auditor mengabaikan potensi terjadinya kesalahan', '0.00', 'Nama User', 'Kepala SPI', 2, 3, 6, 'Ada', 'Memadai', 'Sudah', 1, 2, 2, 'Accept', 'sosialisasi audit charter secara berkala', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Notulen Rapat', 1, 2, 2),
(26, 'Mengamankan Database SPI', 'SPI', 'Resiko Finansial', NULL, 'Adanya Virus yang merusak database', 'kelalaian pengguna perangkat', 'External', 'Kerusakan database SPI', '0.00', 'Nama User', 'Kepala SPI', 2, 4, 8, 'Ada', 'Memadai', 'Sudah', 1, 3, 3, 'Accept', 'Pembuatan SOP, SOsialisasi SOP', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'SOP Pengguna, Notulen Rapat', 1, 1, 1),
(27, 'Menjaga Independensi dan Obyektifitas auditor SPI', 'SPI', 'Resiko Operasional', NULL, 'Terjadinya penugasan audit yang berpotensi menghalangi', 'Belum adanya pertimbangan penugasan dari segi independensi', 'External', 'Rekomendasi audit yang tidak obyektif dan tidak independen', '0.00', 'Nama User', 'Kepala SPI', 2, 4, 8, 'Ada', 'Memadai', 'Sudah', 1, 3, 3, 'Accept', 'Sosialisasi Audit charter, Penempatan auditor lintas fakultas', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Notulen Rapat', 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `status`) VALUES
(1, 'admin', 'admin123', 'admin', 'admin'),
(2, 'dekanfst', '123dekan', 'Dekan FST', 'Dekan'),
(3, 'kaprodi', '123maria', 'Maria', 'kaprodi'),
(4, 'mustakim', '123', 'Mustakim', 'Kaprodi'),
(16, 'oapngsiti', '123', 'opangsiti1', 'Kaprodi'),
(17, 'rektor123', '123rektor', 'rektor', 'Rektor'),
(18, 'dekan123', '123dekan', 'dekan', 'Dekan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `risk`
--
ALTER TABLE `risk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_resiko` (`kode_resiko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `risk`
--
ALTER TABLE `risk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
