-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Út 10.Jan 2023, 20:39
-- Verzia serveru: 10.4.25-MariaDB
-- Verzia PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `ticket_system`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', 'Heslo123');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `classrooms`
--

CREATE TABLE `classrooms` (
  `id` int(11) NOT NULL,
  `number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `classrooms`
--

INSERT INTO `classrooms` (`id`, `number`) VALUES
(1, 37),
(2, 22);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `classrooms_admins`
--

CREATE TABLE `classrooms_admins` (
  `user_id` int(11) DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `classrooms_admins`
--

INSERT INTO `classrooms_admins` (`user_id`, `classroom_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pcnumber` varchar(30) DEFAULT NULL,
  `report_status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `reports`
--

INSERT INTO `reports` (`id`, `message`, `classroom_id`, `user_id`, `pcnumber`, `report_status`) VALUES
(1, 'Dataprojektor má poškodený kábel', 1, 2, 'Dataprojektor', 4),
(2, 'Nefunguje klávesnica', 2, 1, 'PC-1', 1),
(3, 'Skúška', 2, 1, 'PC-2', 1),
(4, 'Počítač neexistuje', 2, 0, 'PC-1gsd', 1),
(5, 'Počítač zjedol psa\r\n', 1, 0, 'PC-3asdyxc', 1),
(6, 'Bliká monitor', 2, 0, 'PC-4', 1),
(7, 'Nemá OS', 1, 2, 'PC-8', 1);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `user_logins`
--

CREATE TABLE `user_logins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password_hash` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Sťahujem dáta pre tabuľku `user_logins`
--

INSERT INTO `user_logins` (`id`, `username`, `password_hash`) VALUES
(1, 'Admin', '$2y$10$d1f6TyE6hidjsVv3KH0Mc.kqSpCeiQKIu0oye4KPSyAzLaw.6EqJm'),
(2, 'Ucitel', '$2y$10$XBysFSjasA/nZZNlxnQyn.IYJCCTgjok//dVwV.UxDzzoeltQvV9S');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pre tabuľku `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pre tabuľku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pre tabuľku `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
