-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2021 at 04:53 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qr_doc_luca`
--

-- --------------------------------------------------------

--
-- Table structure for table `doc_library`
--

CREATE TABLE `doc_library` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `controlled_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_version_number` tinyint(4) NOT NULL DEFAULT 1,
  `department_owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_classification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_issue_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_file_url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'approved',
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doc_library`
--
ALTER TABLE `doc_library`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doc_library`
--
ALTER TABLE `doc_library`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
