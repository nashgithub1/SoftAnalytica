-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 07:48 AM
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
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(5) NOT NULL,
  `question_no` varchar(5) NOT NULL,
  `question` varchar(500) NOT NULL,
  `option1` varchar(100) NOT NULL,
  `option2` varchar(100) NOT NULL,
  `option3` varchar(100) NOT NULL,
  `option4` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question_no`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `category`) VALUES
(2, '1', '1+1 = ??', '1', '60', '20', '4', '1', 'Skill 01'),
(3, '2', '1+1 = ??', '1', '2', '3', '4', '1', 'Skill 01'),
(4, '3', '5+5=??', '2', '5', '8', '10', '10', 'Skill 01'),
(5, '4', '10+10=??', '10', '20', '30', '40', '10', 'Skill 01'),
(6, '5', 'what is hiba name ??', 'hiba ', 'ljshuk', 'asdas', 'asas', 'hiba', 'Skill 01'),
(11, '1', '', '', '', '', '', '', 'inital test '),
(12, '6', 'Eng lang first letter ??', 'A', 'B', 'C', 'D', 'A', 'Skill 01');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_category`
--

CREATE TABLE `quiz_category` (
  `id` int(5) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quiz_time_in_minutes` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_category`
--

INSERT INTO `quiz_category` (`id`, `category`, `quiz_time_in_minutes`) VALUES
(1, 'Skill 01', '20'),
(3, 'skill 2', '25'),
(6, 'inital test ', '20');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(5) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `quiz_type` varchar(100) NOT NULL,
  `total_question` varchar(10) NOT NULL,
  `correct_answer` varchar(10) NOT NULL,
  `wrong_answer` varchar(10) NOT NULL,
  `quiz_time` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_name`, `quiz_type`, `total_question`, `correct_answer`, `wrong_answer`, `quiz_time`) VALUES
(6, 'Akhlaaq', 'Skill 01', '9', '5', '4', '2024-06-12'),
(7, 'Akhlaaq', 'Skill 01', '6', '3', '0', '2024-06-12'),
(8, 'Akhlaaq', 'Skill 01', '6', '3', '0', '2024-06-12'),
(9, 'Akhlaaq', 'Skill 01', '6', '3', '0', '2024-06-12'),
(10, 'Akhlaaq', 'Skill 01', '6', '2', '1', '2024-06-12'),
(11, 'Akhlaaq', 'Skill 01', '5', '2', '1', '2024-06-12'),
(12, 'Akhlaaq', 'Skill 01', '5', '2', '3', '2024-06-12'),
(13, 'Akhlaaq', 'Skill 01', '5', '2', '3', '2024-06-12'),
(14, 'Akhlaaq', 'Skill 01', '6', '5', '1', '2024-06-12'),
(15, 'Akhlaaq', 'Skill 01', '6', '5', '1', '2024-06-12'),
(16, 'Akhlaaq', 'Skill 01', '6', '1', '2', '2024-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `account_activation_hash` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`, `reset_token_hash`, `reset_token_expires_at`, `account_activation_hash`) VALUES
(5, 'team', 'troubleshoutersrusl@gmail.com', '$2y$10$vJyvtd5uXMfzpPVQRwmpE.ZCN/DrIuX7XAyE4vFumjsT/5kaDQCoW', '76ffc3da8a5e06fb33a192c9727e340e4eb738962071cded45d58ee708056db7', '2024-06-02 08:45:02', NULL),
(7, 'Nasra', 'fathinazi36@gmail.com', '$2y$10$mRePCKn8/hN.7T8CuGh8HOWIeBCD8AtEvLohYuvt/0IkkYh6al7/6', 'fa1b41285193be23a16545012522941d8f4790292d8d31952ffce87fbdbeb387', '2024-06-09 07:42:20', '1f861c6c48eea0d2963e87cd0a315d45cd4c765acd9c383fb1742b47c8df96b6'),
(12, 'Akhlaaq', 'akhlaaqmsd@gmail.com', '$2y$10$TjAVRyastYB5mTvlSr1cEONoS2YNRryOkhNSIlkidAvS.YA3iNcPu', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_category`
--
ALTER TABLE `quiz_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD UNIQUE KEY `account_activation_hash` (`account_activation_hash`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quiz_category`
--
ALTER TABLE `quiz_category`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
