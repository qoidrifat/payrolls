-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Des 2024 pada 14.43
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
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Bang Quid', 'bangquid@gmail.com', NULL, '$2y$12$9YICpNLSAZJhbyjA5jpR..49TH9BdZhOIE.UBnZi2UAMNuhqLiBc2', 'eyJpdiI6Ii9QNUpFRnJicFlIKzduT3hNMm05Mnc9PSIsInZhbHVlIjoiYWR6ZGVXVmIzd2hvMHB2NE9VbFFIRXN4Ujk3ZWJ2RFV6YThDck9JS3AxND0iLCJtYWMiOiI0ZDFhYTc4OTRjMmM3MGY1ZjA4ODJkNjE0ZjFkOTcyZGFlYzQ5MzIwYTdhZDk5YmE1OWQ0NGJjODI1ZTQ1MTUzIiwidGFnIjoiIn0=', 'eyJpdiI6IlBiMkNMYkM3MWlnMkFIQ0pjK3lWWVE9PSIsInZhbHVlIjoiblcyNDg2OVZmZGZDRGFyNFhOS2syckxkZHNGc29UTzVoakcwQUhSeVFKd1phSTJOUFhCU25ReEQrTnlscjB1VDgxQllIenBXWDcwTUx0WUs0bERjYWorOGR4MFN5d0t1WDc1cXBoZW56S0RaakNsNnpzQUVTbTB4aUhERDFLaTBIdkFLVnljZ2tUdWxMQVBPZGVLMzdvYnhNRlBMSHdkSG9kdkhGRlV6VjJ4U0dHdmhzTXRMSEljOWF1MlZQSUFXVG1HM2hCOGI4MlpOdlBPcmdaMU1iK3hLQUpHdFQvOTBtaU5vSWJERTl6TXdSbDBXZGJFaGRZOVBZcW9LTktxVkNvUUJ0cy80aWljS0IwOCtVa2NNQ2c9PSIsIm1hYyI6IjAzMmUyZGE5YzQ3NWI0ODE4OTAwYWM3NjEyMzc1MjRkMTYyNzYxZDA2NGI1MzZlZmNiMDEwOTMxZTVhOWIwYjgiLCJ0YWciOiIifQ==', '2024-12-14 04:35:03', 'KsepaY3EcMTxV52IgynOKew1N0pUlLjfD3OHzPn58gmts4yYpKTOAG9n3vT6', NULL, NULL, '2024-12-14 04:10:00', '2024-12-14 04:35:03'),
(2, 'Adit Kepo', 'aditkaryawan@gmail.com', NULL, '$2y$12$mCYi6biLAAlSb9g7OMHT8uXFPe3w8y0XKtWNW42SAcic7FRfYEd.a', NULL, NULL, NULL, NULL, NULL, NULL, '2024-12-14 04:11:28', '2024-12-14 04:11:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
