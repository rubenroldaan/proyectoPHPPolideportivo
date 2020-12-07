-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2020 a las 23:30:10
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `egho`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_instalaciones`
--

CREATE TABLE `horario_instalaciones` (
  `id` int(11) NOT NULL,
  `hora_inicio` int(2) NOT NULL,
  `hora_fin` int(2) NOT NULL,
  `id_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `horario_instalaciones`
--

INSERT INTO `horario_instalaciones` (`id`, `hora_inicio`, `hora_fin`, `id_instalacion`) VALUES
(1, 10, 22, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones`
--

CREATE TABLE `instalaciones` (
  `id_instalacion` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `precio` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `instalaciones`
--

INSERT INTO `instalaciones` (`id_instalacion`, `nombre`, `descripcion`, `imagen`, `precio`) VALUES
(1, 'Piscina olímpica', 'Piscina de tamaño olímpico de 50x25 metros. Consta de 8 carriles para los nadadores y un sistema de control de temperatura basada en el ambiente.', '1', 80.00),
(2, 'Pista de tenis', 'Pista de tenis estándar.', '2', 30.00),
(3, 'Pista de padel', 'Pista de padel estándar', '3', 25.00),
(4, 'Campo de futbol', 'Campo de futbol sala', '4', 40.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` int(2) NOT NULL,
  `hora_fin` int(2) NOT NULL,
  `precio` double(5,2) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `fecha`, `hora_inicio`, `hora_fin`, `precio`, `id_user`, `id_instalacion`) VALUES
(1, '2020-12-11', 8, 13, 60.00, 1, 1),
(2, '2021-01-07', 14, 16, 25.00, 1, 1),
(3, '2020-12-11', 15, 16, 20.00, 1, 1),
(4, '2020-12-05', 11, 14, 22.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `mail` varchar(70) NOT NULL,
  `passwd` varchar(15) NOT NULL,
  `dni` char(9) NOT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `rol` enum('A','R','D','') NOT NULL DEFAULT 'D'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `nombre`, `apellido1`, `apellido2`, `mail`, `passwd`, `dni`, `imagen`, `rol`) VALUES
(1, 'Ruben', '', '', 'rubenroldan149@hotmail.com', 'ruben', '77241229F', '77241229F.png', 'A'),
(6, 'pechipao', 'creations', 'montoya', 'pechipao@hotmail.com', 'pechipao', 'aaaaaaaaa', NULL, 'D');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horario_instalaciones`
--
ALTER TABLE `horario_instalaciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_instalacion` (`id_instalacion`);

--
-- Indices de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  ADD PRIMARY KEY (`id_instalacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horario_instalaciones`
--
ALTER TABLE `horario_instalaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  MODIFY `id_instalacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
