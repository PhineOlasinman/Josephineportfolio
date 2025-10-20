-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2025 at 09:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- Database: `portfolio`
-- --------------------------------------------------------

--CREATE DATABASE IF NOT EXISTS `portfolio` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
--USE `portfolio`;

-- --------------------------------------------------------
-- Table structure for table `portfolio_db`
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `portfolio_db` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(100) DEFAULT NULL,
  `is_active` TINYINT(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Dumping data for table `projects`
-- --------------------------------------------------------

INSERT INTO `pprtfolio_db` (`id`, `title`, `description`, `link`, `created_at`, `created_by`, `is_active`) VALUES
(8, 'tatat', 'atat', 'https://www.test.comxxxxxx', '2025-10-17 04:34:01', 'tatatata', 1),
(9, 'test', 'atata', 'http://example.com/', '2025-10-17 04:34:15', 'fsadfsafa', 1);

COMMIT;
--CREATE DATABASE portfolio_db;

--USE portfolio_db;

--CREATE TABLE users (
 -- id INT AUTO_INCREMENT PRIMARY KEY,
 -- fname VARCHAR(50) NOT NULL,
 --- lname VARCHAR(50) NOT NULL,
 -- email VARCHAR(100) NOT NULL UNIQUE,
 -- password VARCHAR(255) NOT NULL,
 -- created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
--);
