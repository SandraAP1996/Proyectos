-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 27-10-2019 a las 16:51:24
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registro`
--
CREATE DATABASE IF NOT EXISTS `registro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `registro`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `user` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`user`, `email`) VALUES
('adrian', 'adrian@mail.com'),
('alex', 'alex@mail.com'),
('ana', 'ana@mail.com'),
('andres', 'andres@mail.com'),
('carlos', 'carlos@mail.com'),
('elena', 'elena@mail.com'),
('eva', 'eva@mail.com'),
('isabel', 'isabel@mail.com'),
('javi', 'javi@mail.com'),
('jorge', 'jorge@mail.com'),
('lucas', 'lucas@mail.com'),
('manuel', 'manuel@mail.com'),
('marcos', 'marcos@mail.com'),
('nerea', 'nerea@mail.com'),
('noelia', 'noelia@mail.com'),
('pablo', 'pablo@mail.com'),
('rosa', 'rosa@mail.com'),
('susana', 'susana@mail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`user`),
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


GRANT USAGE ON *.* TO 'registro'@'localhost' IDENTIFIED BY PASSWORD '*337931FC64BFE25E4E24730C4C16B6A6A402578C';

GRANT ALL PRIVILEGES ON `registro`.* TO 'registro'@'localhost';