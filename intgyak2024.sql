-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost:3306
-- Létrehozás ideje: 2024. Ápr 06. 11:48
-- Kiszolgáló verziója: 8.0.36-0ubuntu0.22.04.1
-- PHP verzió: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `intgyak2024`
--
CREATE DATABASE IF NOT EXISTS `intgyak2024` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `intgyak2024`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `vezeteknev` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keresztnev` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `felhasznalonev` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jelszo` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neme` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `szuletesiev` year DEFAULT NULL,
  `hirlevel` tinyint(1) DEFAULT NULL,
  `leiras` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `vezeteknev`, `keresztnev`, `email`, `felhasznalonev`, `jelszo`, `neme`, `szuletesiev`, `hirlevel`, `leiras`, `created_at`) VALUES
(2, 'teszt', 'Elek', 'teszt@elek.hu', 'tesztelek', 'af5f28cef700dabb9a2d614289371e8d6d5f4f87910f9f478fee15e631fdd443', 'Férfi', 1961, 1, 'Teszt elek ', '2024-04-06 10:44:53'),
(3, 'caxa@mailinator.com', 'bafeno@mailinator.com', 'henykunu@mailinator.com', 'vuqemegex@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Nő', 1969, 1, 'Adipisicing dolor cu', '2024-04-06 10:44:53'),
(4, 'caxa@mailinator.com', 'bafeno@mailinator.com', 'henykunu@mailinator.com', 'vuqemegex@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Nő', 1969, 1, 'Adipisicing dolor cu', '2024-04-06 10:44:53'),
(5, 'caxa@mailinator.com', 'bafeno@mailinator.com', 'henykunu@mailinator.com', 'vuqemegex@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Nő', 1969, 1, 'Adipisicing dolor cu', '2024-04-06 10:44:53'),
(6, 'caxa@mailinator.com', 'bafeno@mailinator.com', 'henykunu@mailinator.com', 'vuqemegex@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Nő', 1969, 1, 'Adipisicing dolor cu', '2024-04-06 10:44:53'),
(8, 'zosezerow@mailinator.com', 'tylo@mailinator.com', 'zakoduga@mailinator.com', 'lotak@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Férfi', 1961, 0, 'Incidunt id volupt', '2024-04-06 10:52:20'),
(9, 'zosezerow@mailinator.com', 'tylo@mailinator.com', 'zakoduga@mailinator56.com', 'lotak@mailinator.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Férfi', 1961, 0, 'Incidunt id volupt', '2024-04-06 10:52:35'),
(10, 'zosezerow@mailinator.com', 'tylo@mailinator.com', 'zakoduga@mailinaewtor56.com', 'lotak@mailinatewror.com', '566aba2c276f6cd7d4872b793107d64c749678213b5c96b7c25445c674583af8', 'Férfi', 1961, 0, 'Incidunt id volupt', '2024-04-06 10:54:15');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
