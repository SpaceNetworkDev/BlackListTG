-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Nov 06, 2022 alle 17:14
-- Versione del server: 8.0.26
-- Versione PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `tgid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `bot`
--

CREATE TABLE `bot` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `bottoken`
--

CREATE TABLE `bottoken` (
  `ID` int NOT NULL,
  `token` text NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `tgid` varchar(256) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pref` int NOT NULL,
  `support` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `sblwait`
--

CREATE TABLE `sblwait` (
  `id` int NOT NULL,
  `oggetto` varchar(255) NOT NULL,
  `last` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `scammers`
--

CREATE TABLE `scammers` (
  `id` int NOT NULL,
  `tgid` text NOT NULL,
  `PROVE` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DESCRIZIONE` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `banby` int NOT NULL,
  `data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `supporters`
--

CREATE TABLE `supporters` (
  `id` int NOT NULL,
  `tgid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `tempscammer`
--

CREATE TABLE `tempscammer` (
  `id` int NOT NULL,
  `tgid` text NOT NULL,
  `PROVE` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `DESCRIZIONE` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `banby` int NOT NULL,
  `data` text NOT NULL,
  `randomid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `tgid` text NOT NULL,
  `rep` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `tgid`, `rep`) VALUES
(1, '2045635982', 0),
(2, '5587399361', 0),
(3, '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `vips`
--

CREATE TABLE `vips` (
  `id` int NOT NULL,
  `tgid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `bottoken`
--
ALTER TABLE `bottoken`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `scammers`
--
ALTER TABLE `scammers`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `supporters`
--
ALTER TABLE `supporters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tgid` (`tgid`);

--
-- Indici per le tabelle `tempscammer`
--
ALTER TABLE `tempscammer`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `vips`
--
ALTER TABLE `vips`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `bot`
--
ALTER TABLE `bot`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `bottoken`
--
ALTER TABLE `bottoken`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `scammers`
--
ALTER TABLE `scammers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT per la tabella `supporters`
--
ALTER TABLE `supporters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `tempscammer`
--
ALTER TABLE `tempscammer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `vips`
--
ALTER TABLE `vips`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
