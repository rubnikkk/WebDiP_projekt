-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2022 at 03:10 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdip2021x037`
--

-- --------------------------------------------------------

--
-- Table structure for table `benzinska_postaja`
--

CREATE TABLE `benzinska_postaja` (
  `id_benzinske_postaje` int(11) NOT NULL,
  `lokacija` int(11) NOT NULL,
  `radno_vrijeme` varchar(45) NOT NULL,
  `broj_mjesta` int(11) NOT NULL,
  `moderator` int(11) NOT NULL,
  `ukupno_natoceno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `benzinska_postaja`
--

INSERT INTO `benzinska_postaja` (`id_benzinske_postaje`, `lokacija`, `radno_vrijeme`, `broj_mjesta`, `moderator`, `ukupno_natoceno`) VALUES
(1, 1, '07:00-23:59', 3, 1, 3076),
(2, 3, '07:00-23:59', 3, 7, 4500),
(3, 2, '00:00-23:59', 4, 10, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `dnevnik`
--

CREATE TABLE `dnevnik` (
  `id_zapisa` int(11) NOT NULL,
  `tip_zapisa` varchar(100) NOT NULL,
  `zapis` varchar(100) NOT NULL,
  `vrijeme` date NOT NULL,
  `id_korisnika` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dnevnik`
--

INSERT INTO `dnevnik` (`id_zapisa`, `tip_zapisa`, `zapis`, `vrijeme`, `id_korisnika`) VALUES
(57, '1', 'Prijavio se korisnik admin', '2022-06-17', 1),
(58, '1', 'Odjavio se korisnik admin', '2022-06-17', 1),
(59, 'Prijava/odj', 'Prijavio se korisnik admin', '2022-06-17', 1),
(60, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(61, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(62, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(63, 'Rad s bazom', 'Zahtjev za registraciju ansa123', '2022-06-17', 14),
(64, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(65, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(66, 'Rad s bazom', 'Neuspješna prijava admin', '2022-06-17', 1),
(67, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(68, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(69, 'Ostale radnje', 'Zatražena nova lozinka ana', '2022-06-17', 2),
(70, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(71, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(72, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(73, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(74, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(75, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(76, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(77, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(78, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(79, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(80, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-17', 1),
(81, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(82, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(83, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(84, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(85, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(86, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(87, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(88, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(89, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(90, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(91, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(92, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(93, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(94, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(95, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(96, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(97, 'Prijava/odjava', 'Neuspješna prijava korni', '2022-06-17', 4),
(98, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-17', 1),
(99, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-18', 1),
(100, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-18', 1),
(101, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-19', 1),
(102, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-19', 1),
(103, 'Prijava/odjava', 'Prijavio se korisnik moderator', '2022-06-19', 7),
(104, 'Prijava/odjava', 'Odjavio se korisnik moderator', '2022-06-19', 7),
(105, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-19', 1),
(106, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-19', 1),
(107, 'Prijava/odjava', 'Prijavio se korisnik moderator', '2022-06-19', 7),
(108, 'Prijava/odjava', 'Odjavio se korisnik moderator', '2022-06-19', 7),
(109, 'Prijava/odjava', 'Prijavio se korisnik registrirani', '2022-06-19', 15),
(110, 'Prijava/odjava', 'Odjavio se korisnik registrirani', '2022-06-19', 15),
(111, 'Prijava/odjava', 'Prijavio se korisnik registrirani', '2022-06-19', 15),
(112, 'Prijava/odjava', 'Prijavio se korisnik registrirani', '2022-06-20', 15),
(113, 'Prijava/odjava', 'Odjavio se korisnik registrirani', '2022-06-20', 15),
(114, 'Prijava/odjava', 'Prijavio se korisnik moderator', '2022-06-20', 7),
(115, 'Prijava/odjava', 'Odjavio se korisnik moderator', '2022-06-20', 7),
(116, 'Prijava/odjava', 'Neuspješna prijava admin', '2022-06-20', 1),
(117, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-20', 1),
(118, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-20', 1),
(119, 'Prijava/odjava', 'Prijavio se korisnik moderator', '2022-06-20', 7),
(120, 'Prijava/odjava', 'Odjavio se korisnik moderator', '2022-06-20', 7),
(121, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-20', 1),
(122, 'Prijava/odjava', 'Odjavio se korisnik admin', '2022-06-20', 1),
(123, 'Prijava/odjava', 'Neuspješna prijava moderator', '2022-06-20', 7),
(124, 'Prijava/odjava', 'Prijavio se korisnik moderator', '2022-06-20', 7),
(125, 'Prijava/odjava', 'Odjavio se korisnik moderator', '2022-06-20', 7),
(126, 'Prijava/odjava', 'Prijavio se korisnik admin', '2022-06-20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gorivo_na_benzinskoj`
--

CREATE TABLE `gorivo_na_benzinskoj` (
  `id_zapisa` int(11) NOT NULL,
  `id_benzinske` int(11) NOT NULL,
  `id_goriva` int(11) NOT NULL,
  `cijena` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `status` varchar(45) NOT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gorivo_na_benzinskoj`
--

INSERT INTO `gorivo_na_benzinskoj` (`id_zapisa`, `id_benzinske`, `id_goriva`, `cijena`, `kolicina`, `status`, `datum`) VALUES
(1, 1, 4, 12, 9848, 'na raspolaganju', NULL),
(3, 1, 2, 16, 4348, 'na raspolaganju', NULL),
(5, 1, 2, 14, 1258, 'na raspolaganju', '0000-00-00'),
(6, 2, 1, 15, 10000, 'na raspolaganju', '2022-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnika` int(11) NOT NULL,
  `id_uloge` int(11) NOT NULL,
  `ime` varchar(45) NOT NULL,
  `prezime` varchar(45) NOT NULL,
  `godina_rodenja` int(11) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `lozinka` varchar(45) NOT NULL,
  `lozinka_sha256` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `broj_telefona` varchar(45) NOT NULL,
  `datum_registracije` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `broj_neuspjesnih_prijava` int(11) NOT NULL,
  `uvjeti_koristenja` varchar(45) NOT NULL,
  `aktivacijski_kod` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnika`, `id_uloge`, `ime`, `prezime`, `godina_rodenja`, `korisnicko_ime`, `lozinka`, `lozinka_sha256`, `email`, `broj_telefona`, `datum_registracije`, `status`, `broj_neuspjesnih_prijava`, `uvjeti_koristenja`, `aktivacijski_kod`) VALUES
(1, 1, 'Ana', 'Horvat', 2000, 'admin', 'admin', '8C6976E5B5410415BDE908BD4DEE', 'ahorvat3@foi.hr', '1234567', '2022-06-09', 1, 0, '1', 'aktivacijskiKod'),
(2, 2, 'Ana', 'Horvat', 2000, 'ana', '0b2b50a5', 'eca0a02f7dbb94310208e88e5a5e66ec', 'anahorvat2210@gmail.com', '', '2022-06-10', 0, 0, 'prihvaćeni', ''),
(3, 3, 'Ana', 'Horvat', 2000, 'ana123', 'ana', '276b6c4692e78d4799c12ada515bc3e4', 'ana@gmail.com', '1234545', '2022-06-10', 0, 8, 'prihvaćeni', 'aa12830f002548c1efa179dd00f5256e'),
(4, 3, 'Kornelija', 'Horvat', 1999, 'korni', 'korn123', 'b6952dad2a06458b545f07866a27b069', 'petnuija@email.com', '0918254', '2022-06-10', 0, 4, 'prihvaćeni', 'efb2fcbda2769a27eac523b65b105cca'),
(5, 3, 'Jasminka', 'Jasmin', 1990, 'jaca', '86d39f48', '460d4e07b63f4c0e2e0f707c401846b1', 'jasminka@mail.com', '12345678', '2022-06-10', 0, 0, 'prihvaćeni', '6a4ce6b3aa443ece27b616bf76bcc8cb'),
(6, 3, 'Marijan', 'Horvat', 1990, 'mar123', '13dee75f', '9880c35d8804ed40f467de976963966b', 'marijan@email.com', '12345689', '2022-06-10', 1, 0, 'prihvaćeni', '1ab9ff704bfd49262e985e4c6e34d036'),
(7, 2, 'Marija', 'Marijić', 1976, 'moderator', 'moderator', 'kriptiranaLozinka', 'moderator@email.com', '12233452', '2000-12-12', 1, 0, '1', 'aktivacijskikod'),
(8, 3, 'Asdads', 'Adsads', 2000, 'korisnika123', '123', '202cb962ac59075b964b07152d234b70', 'email@gmail.com', '12345', '2022-06-16', 0, 0, 'prihvaćeni', '85271f62583240275c7d35d7489b9e3e'),
(9, 3, 'Petunija', 'Prezime', 2000, 'ana123', '123', '202cb962ac59075b964b07152d234b70', 'behabi2671@qqhow.com', '123', '2022-06-16', 0, 8, 'prihvaćeni', 'b1e2b8bbd3537f24bf03846db9f9df98'),
(10, 2, 'Ime', 'Prezime', 1999, 'ime123', '123', '202cb962ac59075b964b07152d234b70', 'nejasi9477@exoacre.com', '123456789', '2022-06-17', 0, 0, 'prihvaćeni', 'f97f662a91814ab447da94c2806f3ddc'),
(11, 3, 'Test', 'Test', 2000, 'test2', 'test', '098f6bcd4621d373cade4e832627b4f6', 'nejasi9471@exoacre.com', '1234', '2022-06-17', 0, 0, 'prihvaćeni', '91459d7b3848434619287c1c7484552a'),
(12, 3, 'Ana', 'Horvat', 1999, 'rega', 'regica', 'f4e6462fb02626d6370889644d9711e3', 'nejasi9177@exoacre.com', '123124', '2022-06-17', 1, 0, 'prihvaćeni', '7983a38a5db202e48e08cb4ec58a7437'),
(13, 3, 'Ksfadsf', 'Kdsfadsf', 1999, '123ana', '123', '202cb962ac59075b964b07152d234b70', 'nejsi94777@exoacre.com', '342342', '2022-06-17', 0, 0, 'prihvaćeni', '2ad67f0e74675193572f30e8acda2d85'),
(14, 3, 'AASDSA', 'ADSDSA', 1999, 'ansa123', '123', '202cb962ac59075b964b07152d234b70', 'nejasi9@exoacre.com', '123', '2022-06-17', 1, 0, 'prihvaćeni', 'fc822fbffaf9cbf8a2984a904f9001b0'),
(15, 3, 'registrirani', 'registrirani', 2001, 'registrirani', 'registrirani', 'assadssadsa7655d7saf8f87t', 'registrirani@mail.com', '123456', '2022-06-15', 1, 0, '1', 'adssadasdsa67');

-- --------------------------------------------------------

--
-- Table structure for table `lokacija_benzinske_postaje`
--

CREATE TABLE `lokacija_benzinske_postaje` (
  `id_lokacije_benzinske_postaje` int(11) NOT NULL,
  `mjesto` varchar(45) NOT NULL,
  `ulica` varchar(45) NOT NULL,
  `kucni_broj` int(11) NOT NULL,
  `postanski_broj` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lokacija_benzinske_postaje`
--

INSERT INTO `lokacija_benzinske_postaje` (`id_lokacije_benzinske_postaje`, `mjesto`, `ulica`, `kucni_broj`, `postanski_broj`) VALUES
(1, 'Virovitica', 'Duga ulica', 22, 41000),
(2, 'Varaždin', 'Međimurska', 128, 42000),
(3, 'Mala Subotica', 'Najbolja ulica', 22, 40321);

-- --------------------------------------------------------

--
-- Table structure for table `mjesto_na_benzinskoj`
--

CREATE TABLE `mjesto_na_benzinskoj` (
  `id_mjesta` int(11) NOT NULL,
  `benzinska_postaja` int(11) NOT NULL,
  `vrsta_goriva` int(11) NOT NULL,
  `status_mjesta` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mjesto_na_benzinskoj`
--

INSERT INTO `mjesto_na_benzinskoj` (`id_mjesta`, `benzinska_postaja`, `vrsta_goriva`, `status_mjesta`) VALUES
(1, 1, 3, 'čeka naplatu'),
(4, 1, 3, 'čeka naplatu'),
(5, 1, 1, 'čeka naplatu'),
(7, 1, 1, 'čeka naplatu'),
(8, 1, 3, 'otvorena'),
(9, 1, 2, 'otvorena'),
(10, 1, 2, 'otvorena');

-- --------------------------------------------------------

--
-- Table structure for table `tocenje_goriva`
--

CREATE TABLE `tocenje_goriva` (
  `id_korisnika` int(11) NOT NULL,
  `id_vozila` int(11) NOT NULL,
  `id_mjesta_na_benzinskoj` int(11) NOT NULL,
  `kolicina` double NOT NULL,
  `kilometri` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tocenje_goriva`
--

INSERT INTO `tocenje_goriva` (`id_korisnika`, `id_vozila`, `id_mjesta_na_benzinskoj`, `kolicina`, `kilometri`, `datum`) VALUES
(15, 5, 1, 250, 250, '2022-06-20'),
(1, 6, 8, 66, 10000, '2022-06-20'),
(1, 6, 8, 66, 10000, '2022-06-20'),
(1, 5, 7, 10, 10, '2022-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `uloga_korisnika`
--

CREATE TABLE `uloga_korisnika` (
  `id_uloge_korinika` int(11) NOT NULL,
  `naziv_uloge` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `uloga_korisnika`
--

INSERT INTO `uloga_korisnika` (`id_uloge_korinika`, `naziv_uloge`) VALUES
(1, 'administrator'),
(2, 'moderator'),
(3, 'registrirani'),
(4, 'neregistrirani');

-- --------------------------------------------------------

--
-- Table structure for table `vozilo`
--

CREATE TABLE `vozilo` (
  `id_vozila` int(11) NOT NULL,
  `korisnik` int(11) NOT NULL,
  `marka` varchar(45) NOT NULL,
  `vrsta` varchar(45) NOT NULL,
  `potrosnja` varchar(45) NOT NULL,
  `registracija` varchar(45) NOT NULL,
  `brojac` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vozilo`
--

INSERT INTO `vozilo` (`id_vozila`, `korisnik`, `marka`, `vrsta`, `potrosnja`, `registracija`, `brojac`) VALUES
(5, 15, 'BMW', 'Model 2', '10 l/km', 'VZ 1234 HH', 145276),
(6, 15, 'Suzuki', 'Swift', '5 l/km', 'CK 2210 AH', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vrsta_goriva`
--

CREATE TABLE `vrsta_goriva` (
  `id_vrste_goriva` int(11) NOT NULL,
  `naziv_vrste_goriva` varchar(45) NOT NULL,
  `dobavljac` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vrsta_goriva`
--

INSERT INTO `vrsta_goriva` (`id_vrste_goriva`, `naziv_vrste_goriva`, `dobavljac`) VALUES
(1, 'Dizel', 'Ina'),
(2, 'Benzin', 'Ina'),
(3, 'Plavi dizel', 'Ina'),
(4, 'Novo gorivo', 'Ina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `benzinska_postaja`
--
ALTER TABLE `benzinska_postaja`
  ADD PRIMARY KEY (`id_benzinske_postaje`);

--
-- Indexes for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD PRIMARY KEY (`id_zapisa`),
  ADD KEY `id_korisnika_fk_2` (`id_korisnika`);

--
-- Indexes for table `gorivo_na_benzinskoj`
--
ALTER TABLE `gorivo_na_benzinskoj`
  ADD PRIMARY KEY (`id_zapisa`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnika`),
  ADD KEY `id_uloge_fk` (`id_uloge`);

--
-- Indexes for table `lokacija_benzinske_postaje`
--
ALTER TABLE `lokacija_benzinske_postaje`
  ADD PRIMARY KEY (`id_lokacije_benzinske_postaje`);

--
-- Indexes for table `mjesto_na_benzinskoj`
--
ALTER TABLE `mjesto_na_benzinskoj`
  ADD PRIMARY KEY (`id_mjesta`),
  ADD KEY `id_benzinske_postaje_fk` (`benzinska_postaja`),
  ADD KEY `id_vrste_goriva_fk` (`vrsta_goriva`);

--
-- Indexes for table `tocenje_goriva`
--
ALTER TABLE `tocenje_goriva`
  ADD KEY `id_korisnika_fk_1` (`id_korisnika`),
  ADD KEY `id_vozila_fk` (`id_vozila`),
  ADD KEY `id_mjesta_na_benzinskoj_fk` (`id_mjesta_na_benzinskoj`);

--
-- Indexes for table `uloga_korisnika`
--
ALTER TABLE `uloga_korisnika`
  ADD PRIMARY KEY (`id_uloge_korinika`);

--
-- Indexes for table `vozilo`
--
ALTER TABLE `vozilo`
  ADD PRIMARY KEY (`id_vozila`),
  ADD KEY `id_korisnika_fk` (`korisnik`);

--
-- Indexes for table `vrsta_goriva`
--
ALTER TABLE `vrsta_goriva`
  ADD PRIMARY KEY (`id_vrste_goriva`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `benzinska_postaja`
--
ALTER TABLE `benzinska_postaja`
  MODIFY `id_benzinske_postaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dnevnik`
--
ALTER TABLE `dnevnik`
  MODIFY `id_zapisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `gorivo_na_benzinskoj`
--
ALTER TABLE `gorivo_na_benzinskoj`
  MODIFY `id_zapisa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lokacija_benzinske_postaje`
--
ALTER TABLE `lokacija_benzinske_postaje`
  MODIFY `id_lokacije_benzinske_postaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mjesto_na_benzinskoj`
--
ALTER TABLE `mjesto_na_benzinskoj`
  MODIFY `id_mjesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `uloga_korisnika`
--
ALTER TABLE `uloga_korisnika`
  MODIFY `id_uloge_korinika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vozilo`
--
ALTER TABLE `vozilo`
  MODIFY `id_vozila` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vrsta_goriva`
--
ALTER TABLE `vrsta_goriva`
  MODIFY `id_vrste_goriva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dnevnik`
--
ALTER TABLE `dnevnik`
  ADD CONSTRAINT `id_korisnika_fk_2` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `id_uloge_fk` FOREIGN KEY (`id_uloge`) REFERENCES `uloga_korisnika` (`id_uloge_korinika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mjesto_na_benzinskoj`
--
ALTER TABLE `mjesto_na_benzinskoj`
  ADD CONSTRAINT `id_benzinske_postaje_fk` FOREIGN KEY (`benzinska_postaja`) REFERENCES `benzinska_postaja` (`id_benzinske_postaje`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_vrste_goriva_fk` FOREIGN KEY (`vrsta_goriva`) REFERENCES `vrsta_goriva` (`id_vrste_goriva`) ON UPDATE CASCADE;

--
-- Constraints for table `tocenje_goriva`
--
ALTER TABLE `tocenje_goriva`
  ADD CONSTRAINT `id_korisnika_fk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_mjesta_na_benzinskoj_fk` FOREIGN KEY (`id_mjesta_na_benzinskoj`) REFERENCES `mjesto_na_benzinskoj` (`id_mjesta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_vozila_fk` FOREIGN KEY (`id_vozila`) REFERENCES `vozilo` (`id_vozila`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vozilo`
--
ALTER TABLE `vozilo`
  ADD CONSTRAINT `id_korisnika_fk` FOREIGN KEY (`korisnik`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
