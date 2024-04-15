-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 05:06 PM
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
-- Database: `gestione_libreria`
--
CREATE DATABASE IF NOT EXISTS `gestione_libreria` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gestione_libreria`;

-- --------------------------------------------------------

--
-- Table structure for table `libri`
--

CREATE TABLE `libri` (
  `id` int(10) UNSIGNED NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `autore` varchar(255) NOT NULL,
  `anno_pubblicazione` date NOT NULL,
  `genere` varchar(255) NOT NULL,
  `immagine` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `libri`
--

INSERT INTO `libri` (`id`, `titolo`, `autore`, `anno_pubblicazione`, `genere`, `immagine`) VALUES
(4, 'La sceneggiatura', 'Syd Field', '1991-07-15', 'Saggistica', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQK4cqtjNCQGVcs9iUBJP-wANEMwwhZT6S89hJ0N-NsbnWS16YgBhlVnyPGhYqFhvB1Nzs&usqp=CAU'),
(5, 'Il signore delle mosche', 'William Golding', '1954-09-17', 'Romanzo', 'https://www.ibs.it/images/9788804663065_0_536_0_75.jpg'),
(6, 'Bleach vol.1', 'Tite Kubo', '2002-01-05', 'Manga - Shonen', 'https://mangarden.pl/pol_pl_Bleach-tom-01-9856_1.jpg'),
(12, 'La fattoria degli animali', 'George Orwell', '2024-04-05', 'Allegorico', 'https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcQdUHAXaji0U6lUBHY3cBvsyLPtIrB-no0NXtQIJkWKOxh1XroaSz6n6w7Dk3_n9S_tEF2qLCqMDvXn7dJcxL_gHCjAJHjVOUXyjigim05EDbzuMAA19UCXAg'),
(13, 'Armi, acciaio e malattie', 'Jared Diamond', '1997-04-01', 'Saggistica', 'https://m.media-amazon.com/images/I/71ytQhvhQWL._AC_UF1000,1000_QL80_.jpg'),
(14, 'Il signore degli anelli', 'J.R.R. Tolkien', '1954-07-29', 'Fantasy', 'https://img.illibraio.it/images/9788845294778_92_1000_0_75.jpg'),
(15, 'Dune', 'Frank Herbert', '1965-10-01', 'fantascienza', 'https://m.media-amazon.com/images/I/A1u+2fY5yTL._AC_UF1000,1000_QL80_.jpg'),
(16, 'La luna e sei soldi', 'William Somerset Maugham', '1919-04-15', 'Romanzo', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQSy_oWJfrKf5nbrMKvNt-qee9YpktKaUhiNbCkIVpgYPRnFSyj'),
(17, 'Il guardiano degli innocenti', 'Andrzej Sapkowski', '1993-04-25', 'Fantasy', 'https://m.media-amazon.com/images/I/61Eq7gKOhZL._AC_UF1000,1000_QL80_.jpg'),
(19, 'One Piece Vol.1', 'Eiichiro Oda', '1997-12-24', 'Manga - Shonen', 'https://m.media-amazon.com/images/I/71gqYK-DFHL._AC_UF1000,1000_QL80_.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `libri`
--
ALTER TABLE `libri`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `libri`
--
ALTER TABLE `libri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
