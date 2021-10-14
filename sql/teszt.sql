-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Okt 14. 13:11
-- Kiszolgáló verziója: 10.4.14-MariaDB
-- PHP verzió: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `teszt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

CREATE TABLE `adminok` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `adminok`
--

INSERT INTO `adminok` (`id`) VALUES
(17);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hianyzok`
--

CREATE TABLE `hianyzok` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ulesrend`
--

CREATE TABLE `ulesrend` (
  `id` int(10) UNSIGNED NOT NULL,
  `nev` varchar(100) CHARACTER SET utf8 NOT NULL,
  `sor` tinyint(3) UNSIGNED NOT NULL,
  `oszlop` tinyint(3) UNSIGNED NOT NULL,
  `felhasznalonev` varchar(35) CHARACTER SET latin1 DEFAULT NULL,
  `jelszo` varchar(35) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `ulesrend`
--

INSERT INTO `ulesrend` (`id`, `nev`, `sor`, `oszlop`, `felhasznalonev`, `jelszo`) VALUES
(1, 'Kulhanek László', 1, 1, NULL, NULL),
(2, 'Bakcsányi Dominik', 1, 2, NULL, ''),
(3, 'Füstös Lóránt', 1, 3, NULL, ''),
(4, 'Orosz Zsolt', 1, 4, NULL, ''),
(5, 'Harsányi László', 1, 5, NULL, ''),
(6, '', 1, 6, NULL, ''),
(7, 'Molnár Gergő', 2, 1, NULL, ''),
(9, 'Kereszturi Kevin', 3, 1, NULL, ''),
(10, 'Juhász Levente', 3, 2, NULL, ''),
(11, 'Szabó László', 3, 3, NULL, ''),
(12, 'Sütő Dániel', 3, 4, NULL, ''),
(13, 'Détári Klaudia', 3, 5, NULL, ''),
(14, '', 3, 6, NULL, ''),
(15, 'Fazekas Miklós', 4, 1, NULL, ''),
(16, '', 4, 2, NULL, ''),
(17, 'Gombos János', 4, 3, 'Jani', '4d6f618f683c460286d04611a1a18d6d'),
(18, 'Bicsák József', 4, 4, NULL, '');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminok`
--
ALTER TABLE `adminok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `ulesrend`
--
ALTER TABLE `ulesrend`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `ulesrend`
--
ALTER TABLE `ulesrend`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `adminok`
--
ALTER TABLE `adminok`
  ADD CONSTRAINT `ibfk_tanulo_admin` FOREIGN KEY (`id`) REFERENCES `ulesrend` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `hianyzok`
--
ALTER TABLE `hianyzok`
  ADD CONSTRAINT `ibfk_tanulo_id` FOREIGN KEY (`id`) REFERENCES `ulesrend` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
