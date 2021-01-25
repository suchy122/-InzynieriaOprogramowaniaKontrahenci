-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Sty 2021, 14:25
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `database`
--
CREATE DATABASE IF NOT EXISTS `heroku_e5528b8a837b67c` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `heroku_e5528b8a837b67c`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontrahenci`
--

DROP TABLE IF EXISTS `kontrahenci`;
CREATE TABLE `kontrahenci` (
  `ID_kontrahenta` int(11) NOT NULL,
  `Nazwa` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `NIP` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `Bank` varchar(200) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kontrahenci`
--

INSERT INTO `kontrahenci` (`ID_kontrahenta`, `Nazwa`, `NIP`, `Bank`) VALUES
(1, 'Abstergo Entertainment', '1122334455', 'PKO BP, 12 3456 7890 1234 5678 9010 1234');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby_kontaktowe`
--

DROP TABLE IF EXISTS `osoby_kontaktowe`;
CREATE TABLE `osoby_kontaktowe` (
  `ID_osoby_kontaktowej` int(11) NOT NULL,
  `ID_siedziby` int(11) NOT NULL,
  `Imie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Nazwisko` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Telefon` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `Opis` text COLLATE utf8_polish_ci DEFAULT NULL,
  `Adres` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `osoby_kontaktowe`
--

INSERT INTO `osoby_kontaktowe` (`ID_osoby_kontaktowej`, `ID_siedziby`, `Imie`, `Nazwisko`, `Telefon`, `Opis`, `Adres`) VALUES
(1, 1, 'Jan', 'Nowak', '987654321', 'Osoba kontaktowa Abstergo Entertainment.', 'Warszawa, ul. Lewandowskiego 8');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `siedziby`
--

DROP TABLE IF EXISTS `siedziby`;
CREATE TABLE `siedziby` (
  `ID_siedziby` int(11) NOT NULL,
  `Miasto` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Fax` int(20) NOT NULL,
  `Mail` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `Telefon` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `Kod_pocztowy` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `Numer_domu` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `Ulica` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `NIP` varchar(10) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `siedziby`
--

INSERT INTO `siedziby` (`ID_siedziby`, `Miasto`, `Fax`, `Mail`, `Telefon`, `Kod_pocztowy`, `Numer_domu`, `Ulica`, `NIP`) VALUES
(1, 'Warszawa', 123456789, 'contact@abstergo.com', '123456789', '10-213', '34', 'kwiatowa', '1122334455');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `kontrahenci`
--
ALTER TABLE `kontrahenci`
  ADD PRIMARY KEY (`ID_kontrahenta`),
  ADD UNIQUE KEY `NIP` (`NIP`);

--
-- Indeksy dla tabeli `osoby_kontaktowe`
--
ALTER TABLE `osoby_kontaktowe`
  ADD PRIMARY KEY (`ID_osoby_kontaktowej`),
  ADD KEY `ID_siedziby` (`ID_siedziby`);

--
-- Indeksy dla tabeli `siedziby`
--
ALTER TABLE `siedziby`
  ADD PRIMARY KEY (`ID_siedziby`),
  ADD KEY `NIP` (`NIP`) USING BTREE;

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `kontrahenci`
--
ALTER TABLE `kontrahenci`
  MODIFY `ID_kontrahenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `osoby_kontaktowe`
--
ALTER TABLE `osoby_kontaktowe`
  MODIFY `ID_osoby_kontaktowej` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `siedziby`
--
ALTER TABLE `siedziby`
  MODIFY `ID_siedziby` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `osoby_kontaktowe`
--
ALTER TABLE `osoby_kontaktowe`
  ADD CONSTRAINT `osoby_kontaktowe_ibfk_1` FOREIGN KEY (`ID_siedziby`) REFERENCES `siedziby` (`ID_siedziby`);

--
-- Ograniczenia dla tabeli `siedziby`
--
ALTER TABLE `siedziby`
  ADD CONSTRAINT `siedziby_ibfk_1` FOREIGN KEY (`NIP`) REFERENCES `kontrahenci` (`NIP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
