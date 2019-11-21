-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-10-2019 a las 16:39:57
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `RXWuaQvtL6`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--

CREATE TABLE `Users` (
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL primary key,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Company`
--

CREATE TABLE `Company`(
  `idCompany` int COLLATE utf8_unicode_ci NOT NULL AUTO_INCREMENT primary key,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `sourcezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `destinyzone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anomalycontact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addresssigns` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL,
  `latitude` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL,
  `longitude` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL,
  `daysattention` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL, -- serializado
  `openingtime` VARCHAR(55) COLLATE utf8_unicode_ci Not NULL,
  `closingtime` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Route`
--

CREATE TABLE `Route`(
  `numroute` int COLLATE utf8_unicode_ci NOT NULL primary key,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ticketCost` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
  `durationtime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `disability` CHAR COLLATE utf8_unicode_ci NOT NULL,
  `frecuency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `latitude` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL, -- serializado 
  `longitude` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL, -- serializado
  `starttime` VARCHAR(55) COLLATE utf8_unicode_ci Not NULL,
  `finishtime` VARCHAR(255) COLLATE utf8_unicode_ci Not NULL,
  `idCompany` int,
  CONSTRAINT FK_CompanyRoute FOREIGN KEY (`idCompany`)
  REFERENCES Company(`idCompany`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
