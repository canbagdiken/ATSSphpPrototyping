-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 16 Mar 2017, 14:23:09
-- Sunucu sürümü: 5.5.51-38.2
-- PHP Sürümü: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `se315_traffic`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(15) NOT NULL,
  `activeroad` int(15) NOT NULL,
  `type` int(15) NOT NULL,
  `curpos` int(255) NOT NULL,
  `curspeed` int(15) NOT NULL,
  `nextroad` int(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `car`
--

INSERT INTO `car` (`id`, `activeroad`, `type`, `curpos`, `curspeed`, `nextroad`) VALUES
(1, 1, 1, 60, 20, 2),
(2, 5, 1, 120, 40, 4),
(3, 5, 1, 240, 20, 4),
(4, 4, 1, 910, 35, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cartypes`
--

CREATE TABLE IF NOT EXISTS `cartypes` (
  `id` int(15) NOT NULL,
  `length` int(15) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cartypes`
--

INSERT INTO `cartypes` (`id`, `length`, `image`) VALUES
(1, 1, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `connections`
--

CREATE TABLE IF NOT EXISTS `connections` (
  `id` int(25) NOT NULL,
  `wayfrom` int(15) NOT NULL,
  `wayto` int(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Tablo döküm verisi `connections`
--

INSERT INTO `connections` (`id`, `wayfrom`, `wayto`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 5),
(4, 3, 4),
(5, 4, 1),
(6, 5, 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `junctions`
--

CREATE TABLE IF NOT EXISTS `junctions` (
  `id` int(15) NOT NULL,
  `type` int(15) NOT NULL,
  `posx` int(15) NOT NULL,
  `posy` int(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `junctions`
--

INSERT INTO `junctions` (`id`, `type`, `posx`, `posy`) VALUES
(1, 1, 1140, 20),
(2, 1, 1810, 20),
(3, 1, 1140, 450);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roads`
--

CREATE TABLE IF NOT EXISTS `roads` (
  `id` int(15) NOT NULL,
  `maxspeed` int(15) NOT NULL,
  `minspeed` int(15) NOT NULL,
  `length` int(15) NOT NULL,
  `type` int(15) NOT NULL,
  `posx` int(15) NOT NULL,
  `posy` int(15) NOT NULL,
  `posr` int(15) NOT NULL,
  `nextroad` int(15) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roads`
--

INSERT INTO `roads` (`id`, `maxspeed`, `minspeed`, `length`, `type`, `posx`, `posy`, `posr`, `nextroad`) VALUES
(1, 120, 45, 1000, 1, 150, 45, 0, 2),
(2, 150, 45, 590, 1, 1230, 45, 0, 3),
(3, 70, 30, 360, 0, 1216, 100, 90, 4),
(4, 150, 45, 1000, 1, 1150, 526, 180, 5),
(5, 0, 0, 730, 0, 1860, 118, 148, 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cartypes`
--
ALTER TABLE `cartypes`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `connections`
--
ALTER TABLE `connections`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `junctions`
--
ALTER TABLE `junctions`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Tablo için indeksler `roads`
--
ALTER TABLE `roads`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `car`
--
ALTER TABLE `car`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Tablo için AUTO_INCREMENT değeri `cartypes`
--
ALTER TABLE `cartypes`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `connections`
--
ALTER TABLE `connections`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Tablo için AUTO_INCREMENT değeri `junctions`
--
ALTER TABLE `junctions`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `roads`
--
ALTER TABLE `roads`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
