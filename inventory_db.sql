-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2026. Ápr 14. 18:26
-- Kiszolgáló verziója: 10.4.32-MariaDB
-- PHP verzió: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `inventory_db`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `jelszo` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `regisztracio_ideje` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `felhasznalok`
--

INSERT INTO `felhasznalok` (`id`, `felhasznalonev`, `jelszo`, `email`, `regisztracio_ideje`) VALUES
(1, 'aaaa', '$2y$10$EavckyimOk0vrmMZ7K1RI.Y8dnQJ2.aWt6RVZwwJrQNK77z0SJE1q', NULL, '2026-03-27 00:02:48'),
(2, 'admin', '$2y$10$bAsV/rFnQDb8CSFXvYdZ/.ljptVemaXAkPcGXL4LkejDfm0iEbEgi', NULL, '2026-03-27 00:03:46'),
(3, 'jancsi', '$2y$10$saVI3nrBU0Af1Z2PcXmbJe88lQXqFlvWoYk5WNJNmWJyJ97bTFSQO', NULL, '2026-03-27 00:16:15'),
(4, 'ABLAK', '$2y$10$ObqtmanTXzv7ohdPDDqjkOwXGmGqX44lMU/hFTIpuGx6GYd/BSPLm', NULL, '2026-03-27 00:54:56'),
(5, 'ablaa', '$2y$10$eBrIx3z4zb07GBX8nHSIteH1nNHt/ti73KE1r8g/ptrnITJcsEwWq', NULL, '2026-03-28 12:18:19'),
(6, 'q', '$2y$10$hrEsqi9yHlNv9dgzR4bYNuBjcDiHXhl2Lj7Z58B/LMW2uj/azT/lu', NULL, '2026-03-29 11:30:29'),
(7, 'qqqqq', '$2y$10$AXMnLEh2AMOsCfl8NjQA9uav9lMEUf.MF5Cx1RbAbkH6LBkWU7C.K', NULL, '2026-03-29 20:26:54'),
(8, 'a', '$2y$10$gaREjkmUPybFeCdLdFUtAuTcCM7WOQRKjiKlUm8fL9v7rE.SdM0rK', NULL, '2026-03-29 20:37:25');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `status` enum('aktív','selejt','javítás alatt') DEFAULT 'aktív',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `items`
--

INSERT INTO `items` (`id`, `name`, `category`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(2, 'monitor', 'IT', 3, 'aktív', '2026-03-29 19:48:01', '2026-04-01 16:54:51'),
(3, 'egér', 'IT', 3, 'aktív', '2026-03-29 19:48:01', '2026-03-29 19:48:01'),
(4, 'ceruza', 'íróeszköz', 3, 'aktív', '2026-03-29 19:48:01', '2026-03-29 20:23:55'),
(7, 'bicikli', 'Jármű', 3, 'aktív', '2026-03-29 19:57:42', '2026-03-29 19:57:42'),
(8, 'Csavarhúzó', 'Szerszám', 2, 'aktív', '2026-03-29 20:22:29', '2026-03-29 20:22:29'),
(9, 'Kalapács', 'Szerszám', 5, 'aktív', '2026-03-29 20:38:00', '2026-03-29 20:38:00');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `felhasznalonev` (`felhasznalonev`);

--
-- A tábla indexei `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
