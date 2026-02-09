-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jan 2025 pada 18.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wire_content`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Cuti') NOT NULL DEFAULT 'Hadir',
  `foto_absensi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `absensis`
--

INSERT INTO `absensis` (`id`, `karyawan_id`, `date`, `check_in`, `check_out`, `status`, `foto_absensi`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-12-01', '01:11:09', '02:11:17', 'Hadir', 'absensi-photos/01JGVNSRSVC7SX4G229MGS1FKA.webp', '2024-12-14 11:11:28', '2025-01-05 09:47:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nomor_telepon` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `npwp` varchar(255) DEFAULT NULL,
  `nomor_rekening_bank` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `status` enum('Tetap','Kontrak','Harian') NOT NULL DEFAULT 'Tetap',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `karyawans`
--

INSERT INTO `karyawans` (`id`, `nik`, `nama`, `email`, `nomor_telepon`, `tanggal_lahir`, `alamat`, `npwp`, `nomor_rekening_bank`, `position`, `status`, `created_at`, `updated_at`, `deleted_at`, `department_id`) VALUES
(1, '097671726588', 'Adidan Pratama', 'adipratama@gmail.com', '08542197525', '2004-08-10', 'Jl Karang Asem', '8791645461287', '001753689126', 'Guru', 'Kontrak', '2024-12-14 07:12:38', '2024-12-14 07:12:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfigurasi_penggajians`
--

CREATE TABLE `konfigurasi_penggajians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_percentage` decimal(5,2) DEFAULT NULL,
  `tarif_lembur_perjam` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggajians`
--

CREATE TABLE `penggajians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal_penggajian` date NOT NULL,
  `gaji_pokok` decimal(15,2) NOT NULL,
  `tunjangan` decimal(15,2) DEFAULT NULL,
  `upah_lembur` decimal(15,2) DEFAULT NULL,
  `bonus` decimal(15,2) DEFAULT NULL,
  `potongan` decimal(15,2) DEFAULT NULL,
  `gaji_bersih` decimal(15,2) NOT NULL DEFAULT 0.00,
  `periode_penggajian` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penggajians`
--

INSERT INTO `penggajians` (`id`, `karyawan_id`, `tanggal_penggajian`, `gaji_pokok`, `tunjangan`, `upah_lembur`, `bonus`, `potongan`, `gaji_bersih`, `periode_penggajian`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-11-01', 2000000.00, 300000.00, 200000.00, 200000.00, 300000.00, 2400000.00, 'Oktober 2024', '2025-01-05 09:21:54', '2025-01-05 09:21:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(2, 'view_any_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(3, 'create_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(4, 'update_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(5, 'restore_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(6, 'restore_any_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(7, 'replicate_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(8, 'reorder_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(9, 'delete_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(10, 'delete_any_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(11, 'force_delete_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(12, 'force_delete_any_karyawan', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(13, 'view_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(14, 'view_any_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(15, 'create_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(16, 'update_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(17, 'restore_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(18, 'restore_any_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(19, 'replicate_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(20, 'reorder_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(21, 'delete_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(22, 'delete_any_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(23, 'force_delete_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(24, 'force_delete_any_penggajian', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(25, 'view_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(26, 'view_any_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(27, 'create_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(28, 'update_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(29, 'delete_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(30, 'delete_any_role', 'admin', '2024-12-14 07:23:24', '2024-12-14 07:23:24'),
(31, 'create_karyawan', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12'),
(32, 'update_karyawan', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12'),
(33, 'view_karyawan', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12'),
(34, 'view_penggajian', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12'),
(35, 'create_penggajian', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12'),
(36, 'update_penggajian', 'web', '2024-12-14 07:24:12', '2024-12-14 07:24:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongans`
--

CREATE TABLE `potongans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `potongan_penggajian`
--

CREATE TABLE `potongan_penggajian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penggajian_id` bigint(20) UNSIGNED NOT NULL,
  `potongan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangans`
--

CREATE TABLE `tunjangans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_tunjangan` varchar(255) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangan_penggajian`
--

CREATE TABLE `tunjangan_penggajian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penggajian_id` bigint(20) UNSIGNED NOT NULL,
  `tunjangan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_karyawan_id_foreign` (`karyawan_id`);

--
-- Indeks untuk tabel `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_nama_unique` (`nama`);

--
-- Indeks untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawans_nik_unique` (`nik`),
  ADD UNIQUE KEY `karyawans_email_unique` (`email`),
  ADD KEY `karyawans_department_id_foreign` (`department_id`);

--
-- Indeks untuk tabel `konfigurasi_penggajians`
--
ALTER TABLE `konfigurasi_penggajians`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penggajians`
--
ALTER TABLE `penggajians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penggajians_karyawan_id_foreign` (`karyawan_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `potongans`
--
ALTER TABLE `potongans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `potongan_penggajian`
--
ALTER TABLE `potongan_penggajian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `potongan_penggajian_penggajian_id_foreign` (`penggajian_id`),
  ADD KEY `potongan_penggajian_potongan_id_foreign` (`potongan_id`);

--
-- Indeks untuk tabel `tunjangans`
--
ALTER TABLE `tunjangans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tunjangan_penggajian`
--
ALTER TABLE `tunjangan_penggajian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tunjangan_penggajian_penggajian_id_foreign` (`penggajian_id`),
  ADD KEY `tunjangan_penggajian_tunjangan_id_foreign` (`tunjangan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `konfigurasi_penggajians`
--
ALTER TABLE `konfigurasi_penggajians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penggajians`
--
ALTER TABLE `penggajians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `potongans`
--
ALTER TABLE `potongans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `potongan_penggajian`
--
ALTER TABLE `potongan_penggajian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tunjangans`
--
ALTER TABLE `tunjangans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tunjangan_penggajian`
--
ALTER TABLE `tunjangan_penggajian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `karyawans`
--
ALTER TABLE `karyawans`
  ADD CONSTRAINT `karyawans_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `penggajians`
--
ALTER TABLE `penggajians`
  ADD CONSTRAINT `penggajians_karyawan_id_foreign` FOREIGN KEY (`karyawan_id`) REFERENCES `karyawans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `potongan_penggajian`
--
ALTER TABLE `potongan_penggajian`
  ADD CONSTRAINT `potongan_penggajian_penggajian_id_foreign` FOREIGN KEY (`penggajian_id`) REFERENCES `penggajians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `potongan_penggajian_potongan_id_foreign` FOREIGN KEY (`potongan_id`) REFERENCES `potongans` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tunjangan_penggajian`
--
ALTER TABLE `tunjangan_penggajian`
  ADD CONSTRAINT `tunjangan_penggajian_penggajian_id_foreign` FOREIGN KEY (`penggajian_id`) REFERENCES `penggajians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tunjangan_penggajian_tunjangan_id_foreign` FOREIGN KEY (`tunjangan_id`) REFERENCES `tunjangans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
