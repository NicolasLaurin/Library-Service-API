-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2021 at 10:09 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_bookstore_db`
--
CREATE DATABASE IF NOT EXISTS `library_bookstore_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `library_bookstore_db`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `ISBN` varchar(15) NOT NULL COMMENT 'ISBN_13',
  `book_name` varchar(256) NOT NULL,
  `author_name` varchar(256) NOT NULL,
  `category_name` varchar(256) NOT NULL COMMENT 'This can be anything that categorises the book. (Ex: ''adventure'', ''teen'')',
  `book_type` varchar(256) NOT NULL COMMENT 'The type or format of the book. (Ex: ''hardcover'', ''paperback'')',
  `num_of_pages` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `book_name`, `author_name`, `category_name`, `book_type`, `num_of_pages`) VALUES
('9780062073495', 'Murder on the Orient Express: A Hercule Poirot Mystery', 'Agatha Christie', 'Detective Fiction', 'Hardcover', 288),
('9780441013593', 'Dune', 'Frank Herbert', 'Science-Fiction', 'Paperback', 704),
('9781408855652', 'Harry Potter and the Philosopher\'s Stone', 'J. K. Rowling', 'Fantasy', 'Paperback', 342);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `clientName` varchar(60) NOT NULL,
  `licenseNumber` varchar(256) NOT NULL,
  `licenseStartDate` date NOT NULL DEFAULT current_timestamp(),
  `licenseEndDate` date NOT NULL,
  `licenseKey` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `clientName`, `licenseNumber`, `licenseStartDate`, `licenseEndDate`, `licenseKey`) VALUES
(1, 'Nicolas', 'ABC123', '2021-11-24', '2021-12-29', 'KEYABC123'),
(2, 'Sebastian', 'ABC123', '2021-11-24', '2021-01-09', 'KEYABC123');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
CREATE TABLE `loans` (
  `loan_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `book_ISBN` varchar(15) NOT NULL COMMENT 'ISBN_13',
  `request_date` date NOT NULL DEFAULT current_timestamp(),
  `return_date` date NOT NULL,
  `status` varchar(256) NOT NULL COMMENT 'The status of the loan: (''borrowed'', ''returned'')'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`loan_id`, `client_id`, `book_ISBN`, `request_date`, `return_date`, `status`) VALUES
(1, 2, '9780441013593', '0000-00-00', '2021-12-15', 'borrowed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`loan_id`),
  ADD KEY `loan_to_clients` (`client_id`),
  ADD KEY `loan_to_books` (`book_ISBN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `loan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loan_to_books` FOREIGN KEY (`book_ISBN`) REFERENCES `books` (`ISBN`),
  ADD CONSTRAINT `loan_to_clients` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
