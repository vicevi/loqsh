-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2023 at 11:14 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loqsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `b`
--

CREATE TABLE `b` (
  `id` int NOT NULL,
  `b` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `t` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `a` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `css` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `j` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `i`
--

CREATE TABLE `i` (
  `id` int NOT NULL,
  `g` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `m` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `i` mediumblob NOT NULL,
  `u` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a` varchar(256) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m`
--

CREATE TABLE `m` (
  `id` int NOT NULL,
  `b` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `g` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `t` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `s` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `m` varchar(2048) COLLATE utf8mb4_general_ci NOT NULL,
  `i` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `a` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `w` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `e` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `n`
--

CREATE TABLE `n` (
  `id` int NOT NULL,
  `t` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `c` varchar(10240) COLLATE utf8mb4_general_ci NOT NULL,
  `w` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t`
--

CREATE TABLE `t` (
  `id` int NOT NULL,
  `b` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `g` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `t` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `m` varchar(2048) COLLATE utf8mb4_general_ci NOT NULL,
  `i` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `w` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `p` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `e` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `u`
--

CREATE TABLE `u` (
  `id` int NOT NULL,
  `u` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `p` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `e` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `j` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `r` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b`
--
ALTER TABLE `b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i`
--
ALTER TABLE `i`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m`
--
ALTER TABLE `m`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `n`
--
ALTER TABLE `n`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t`
--
ALTER TABLE `t`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `u`
--
ALTER TABLE `u`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b`
--
ALTER TABLE `b`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i`
--
ALTER TABLE `i`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m`
--
ALTER TABLE `m`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `n`
--
ALTER TABLE `n`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t`
--
ALTER TABLE `t`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `u`
--
ALTER TABLE `u`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
