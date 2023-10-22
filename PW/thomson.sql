-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2023 a las 22:38:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `thomson`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llenados`
--

CREATE TABLE `llenados` (
  `cliente` varchar(100) NOT NULL,
  `zona` varchar(100) NOT NULL,
  `cantidad` float NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `llenados`
--

INSERT INTO `llenados` (`cliente`, `zona`, `cantidad`, `fecha`) VALUES
('Prueba', 'Canta Claro', 1, '2023-10-22 22:35:46');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `llenados`
--
ALTER TABLE `llenados`
  ADD PRIMARY KEY (`cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
