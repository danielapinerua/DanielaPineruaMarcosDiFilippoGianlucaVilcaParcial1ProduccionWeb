-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-04-2026 a las 18:49:12
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
-- Base de datos: `agencia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','empleado') DEFAULT 'empleado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(1, 'admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(2, 'Daniela', 'daniela@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'empleado'),
(3, 'Marcos', 'marcos@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'empleado'),
(4, 'Gianluca', 'gianluca@mail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `anio` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `transmision` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `marca`, `modelo`, `anio`, `precio`, `tipo`, `color`, `imagen`, `usuario_id`, `transmision`) VALUES
(1, 'Volkswagen', 'Fox', 2012, 12500000.00, 'Auto', 'Rojo', '1776560364', 1, 'Manual'),
(2, 'Jeep', 'Compass', 2020, 40500000.00, 'SUV', 'Gris', '1776561298', 1, 'Automatica'),
(3, 'Peugeot', '208', 2022, 22000000.00, 'Auto', 'Blanco', '1776561514', 1, 'Automatica'),
(4, 'Toyota', 'Corolla', 2023, 25000000.00, 'Auto', 'Blanco', '1776561683', 1, 'Automatica'),
(5, 'Fiat', 'Cronos', 2025, 30000000.00, 'Auto', 'Rojo', '1776561754', 1, 'Automatica'),
(6, 'Ford', 'Focus', 2015, 15000000.00, 'Auto', 'Azul', '1776561877', 1, 'Manual'),
(7, 'Chevrolet', 'Onix', 2018, 17000000.00, 'Auto', 'Rojo', '1776562013', 1, 'Manual'),
(8, 'Ford', 'Ranger Raptor', 2023, 80000000.00, 'Pick-up', 'Azul', '1776562146', 1, 'Automatica'),
(9, 'Citroen', 'C3', 2018, 16000000.00, 'Auto', 'Rojo', '1776562300', 1, 'Automatica'),
(10, 'Renault', 'Sandero', 2018, 16500000.00, 'Auto', 'Negro', '1776562435', 1, 'Manual'),
(11, 'Fiat', '500', 2015, 20500000.00, 'Auto', 'Blanco', '1776562532', 1, 'Manual'),
(12, 'Renault', 'Kangoo', 2016, 14000000.00, 'Utilitario', 'Blanco', '1776562639', 1, 'Manual'),
(13, 'Citroen', 'C4', 2013, 8500000.00, 'Auto', 'Negro', '1776613881', 2, 'Manual'),
(14, 'Jeep', 'Renegade', 2018, 21500000.00, 'SUV', 'Bordo', '1776614079', 3, 'Manual'),
(15, 'Renault', 'Captur', 2021, 22000000.00, 'SUV', 'Gris', '1776614199', 4, 'Manual'),
(18, 'Chevrolet', 'Agile', 2012, 12500000.00, 'Auto', 'Azul', '1776702463', 2, 'Manual'),
(19, 'Ford', 'Fiesta', 2018, 15000000.00, 'Auto', 'Blanco', '1776702594', 3, 'Automatica'),
(20, 'Chevrolet', 'Silverado', 2023, 85000000.00, 'Pick-up', 'Negro', '1776702833', 4, 'Automatica'),
(21, 'Toyota', 'Hilux', 2025, 75000000.00, 'Pick-up', 'Rojo', '1776702943', 2, 'Automatica'),
(22, 'Nissan', 'Kicks', 2020, 25500000.00, 'SUV', 'Rojo', '1776703053', 3, 'Automatica'),
(23, 'Honda', 'Civic', 2023, 33000000.00, 'Auto', 'Blanco', '1776703208', 4, 'Automatica'),
(24, 'Hyundai', 'Creta', 2024, 30000000.00, 'SUV', 'Gris', '1776703362', 2, 'Automatica'),
(25, 'Peugeot', '206', 2012, 8500000.00, 'Auto', 'Rojo', '1776703462', 3, 'Manual'),
(27, 'Volkswagen', 'Polo', 2020, 17500000.00, 'Auto', 'Blanco', '1776703648', 4, 'Manual');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
