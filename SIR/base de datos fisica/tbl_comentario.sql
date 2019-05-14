-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-05-2019 a las 03:00:59
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sir1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_comentario`
--

CREATE TABLE `tbl_comentario` (
  `id_comentario` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` int(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_comentario`
--

INSERT INTO `tbl_comentario` (`id_comentario`, `nombre`, `correo`, `telefono`, `comentario`, `fecha`) VALUES
(5, 'Jhoan', 'jhoanhenao820@gmail.', 5790660, 'sasasas', '2019-04-25 20:50:13'),
(6, 'camilo', 'camilo@gmail.com', 34343, 'necesito acesoria', '2019-04-27 04:51:30'),
(7, 'mateo', 'mateo@gmail.com', 5790660, 'necesito accesoria', '2019-04-29 13:36:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_comentario`
--
ALTER TABLE `tbl_comentario`
  ADD PRIMARY KEY (`id_comentario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_comentario`
--
ALTER TABLE `tbl_comentario`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
