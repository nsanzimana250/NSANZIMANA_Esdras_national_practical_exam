-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2024 at 01:09 PM
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
-- Database: `igitego_FC_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cards`
--

CREATE TABLE `Cards` (
  `card_id` int(11) NOT NULL,
  `cardName` varchar(255) NOT NULL,
  `Player_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `issue_date` varchar(255) NOT NULL,
  `expiry_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Contract`
--

CREATE TABLE `Contract` (
  `Player_id` int(11) NOT NULL,
  `FromDate` varchar(255) NOT NULL,
  `expiryDate` varchar(255) NOT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Matchs`
--

CREATE TABLE `Matchs` (
  `Match_id` int(11) NOT NULL,
  `Studium_id` int(11) NOT NULL,
  `MatchDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Player`
--

CREATE TABLE `Player` (
  `Player_id` int(11) NOT NULL,
  `PlayerFirstName` varchar(255) NOT NULL,
  `PlayerLastName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Studium`
--

CREATE TABLE `Studium` (
  `Studium_id` int(11) NOT NULL,
  `StudiumName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `User_id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`User_id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'nsanzimana', 'esdras', 'esdras@gmail.com', 'esdrasesdras'),
(2, 'japhet', 'moise', 'japhet@gmail.com', '123123'),
(3, 'keza', 'koko', 'keza@gmail', '888888'),
(4, 'keza', 'koko', 'koko@gmail.com', '8888888');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cards`
--
ALTER TABLE `Cards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `Player_id` (`Player_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `Contract`
--
ALTER TABLE `Contract`
  ADD KEY `Player_id` (`Player_id`);

--
-- Indexes for table `Matchs`
--
ALTER TABLE `Matchs`
  ADD PRIMARY KEY (`Match_id`),
  ADD KEY `Match_ibfk_1` (`Studium_id`);

--
-- Indexes for table `Player`
--
ALTER TABLE `Player`
  ADD PRIMARY KEY (`Player_id`);

--
-- Indexes for table `Studium`
--
ALTER TABLE `Studium`
  ADD PRIMARY KEY (`Studium_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cards`
--
ALTER TABLE `Cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Matchs`
--
ALTER TABLE `Matchs`
  MODIFY `Match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Player`
--
ALTER TABLE `Player`
  MODIFY `Player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Studium`
--
ALTER TABLE `Studium`
  MODIFY `Studium_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cards`
--
ALTER TABLE `Cards`
  ADD CONSTRAINT `Cards_ibfk_1` FOREIGN KEY (`Player_id`) REFERENCES `Player` (`Player_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Cards_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `Matchs` (`Match_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Contract`
--
ALTER TABLE `Contract`
  ADD CONSTRAINT `Contract_ibfk_1` FOREIGN KEY (`Player_id`) REFERENCES `Player` (`Player_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Matchs`
--
ALTER TABLE `Matchs`
  ADD CONSTRAINT `Matchs_ibfk_1` FOREIGN KEY (`Studium_id`) REFERENCES `Studium` (`Studium_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
