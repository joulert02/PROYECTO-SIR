-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2019 a las 07:00:00
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `s.i.r`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_persona` ()  NO SQL
SELECT * FROM tbl_persona$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_personaById` (IN `id` INT)  NO SQL
SELECT * FROM tbl_persona WHERE id_persona= id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_tipoPersona` ()  NO SQL
SELECT * FROM tbl_tipo_persona$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre_comercial` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `iva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre_comercial`, `propietario`, `telefono`, `direccion`, `email`, `iva`) VALUES
(1, 'Rodillos GBP', 'Liliana Ospina', '7058-7688', 'Bello Antioquia', 'rodillogGBP@gmail.com', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria_producto`
--

CREATE TABLE `tbl_categoria_producto` (
  `id_Categoria` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_categoria_producto`
--

INSERT INTO `tbl_categoria_producto` (`id_Categoria`, `categoria`, `estado`) VALUES
(1, 'Rodillos Felpa Acrilica Y Poliester', 1),
(2, 'Rodillo Felpa Industrial', 0),
(3, 'Linea Economica', 1),
(4, 'Rodillos Felpa Tipo Ovejero', 1),
(5, 'Rodillos Para Textura', 1),
(6, 'Rodillos Felpa Para Pintura Epoxica', 1),
(7, 'Repuestos Para Rodillos', 1),
(8, 'Rodillos En Poliuretano', 1),
(9, 'Rodillos Para Fibra De Vidirio', 1),
(10, 'Otros Rodillos', 1),
(11, 'Herrajes Y Extensiones', 1),
(12, 'Cubetas Plasticas', 1),
(13, 'Productos Para Drywall', 1),
(14, 'Espatulas Plasticas', 1),
(15, 'Equipos Para Pintar (Kits)', 1),
(16, 'Esquineras', 1),
(17, 'Maquinas Para Aplicar Marmolina', 1),
(18, 'Accesorios', 1),
(19, 'Brochas', 1),
(20, 'Espatula De Acero', 1),
(21, 'Lija Antiempaste', 1),
(22, 'Lija Al Agua', 1),
(23, 'Tela Esmeril', 1),
(24, 'Papel De Lija', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_entrada`
--

CREATE TABLE `tbl_detalle_entrada` (
  `entrada_has_prducto` int(11) NOT NULL,
  `Entrada_id_entrada` int(11) NOT NULL,
  `Producto_id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_entrada`
--

INSERT INTO `tbl_detalle_entrada` (`entrada_has_prducto`, `Entrada_id_entrada`, `Producto_id_producto`, `cantidad`) VALUES
(1, 77, 14, 150),
(2, 77, 15, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_pedido`
--

CREATE TABLE `tbl_detalle_pedido` (
  `Pedido_has_Producto` int(11) NOT NULL,
  `Pedido_id_pedido` int(11) DEFAULT NULL,
  `Producto_id_producto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `sub_total1` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `sub_total2` int(11) DEFAULT NULL,
  `iva_total` int(11) DEFAULT NULL,
  `total_pagar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_pedido`
--

INSERT INTO `tbl_detalle_pedido` (`Pedido_has_Producto`, `Pedido_id_pedido`, `Producto_id_producto`, `cantidad`, `precio`, `sub_total1`, `descuento`, `sub_total2`, `iva_total`, `total_pagar`) VALUES
(1, NULL, 14, 1, 5000, 1000, 2, 500, 500, 500),
(2, NULL, 15, 1, 4000, 1000, 2, 500, 500, 500),
(3, NULL, 17, 1, 6000, 1000, 2, 500, 500, 500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_salida`
--

CREATE TABLE `tbl_detalle_salida` (
  `producto_has_salida` int(11) NOT NULL,
  `Salida_id_salida` int(11) NOT NULL,
  `Producto_id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_detalle_salida`
--

INSERT INTO `tbl_detalle_salida` (`producto_has_salida`, `Salida_id_salida`, `Producto_id_producto`, `cantidad`) VALUES
(1, 32, 15, 10),
(2, 32, 14, 10),
(3, 33, 17, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_entrada`
--

CREATE TABLE `tbl_entrada` (
  `id_entrada` int(11) NOT NULL,
  `fecha_entrada` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_entrada`
--

INSERT INTO `tbl_entrada` (`id_entrada`, `fecha_entrada`) VALUES
(77, '2019-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `id_pedido` int(11) NOT NULL,
  `Persona_id_persona` int(11) NOT NULL,
  `num_fact` int(11) NOT NULL,
  `vendedor` varchar(45) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `despachado_por` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `comentarios` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pedido`
--

INSERT INTO `tbl_pedido` (`id_pedido`, `Persona_id_persona`, `num_fact`, `vendedor`, `fecha_pedido`, `fecha_vencimiento`, `despachado_por`, `estado`, `comentarios`) VALUES
(210, 1, 500, 'Liliana Ospina', '2019-05-09', '2019-05-09', 'Recogido', 0, 'graacias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_persona`
--

CREATE TABLE `tbl_persona` (
  `id_persona` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `tipo_documento_tipo_documento` int(11) NOT NULL,
  `documento` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `nro_Celular` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `tipo_persona_tipo_persona` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_persona`
--

INSERT INTO `tbl_persona` (`id_persona`, `nombres`, `apellidos`, `tipo_documento_tipo_documento`, `documento`, `telefono`, `nro_Celular`, `direccion`, `ciudad`, `departamento`, `tipo_persona_tipo_persona`, `estado`) VALUES
(1, 'Mateo', 'Rangel', 1, '1000396112', '4519036', '3122581829', 'Crran 66 #68 - 68', 'Bello', 'Antioquia', 2, 1),
(2, 'Jorge', 'Gonzalez', 1, '4389377354', '4518367', '3122239812', 'Crra 112 B #31 - 44', 'Medellin', 'Antioquia', 2, 1),
(3, 'Maria', 'Lopez', 3, '4126153343', '3512349', '3122238119', 'Clla 100 C #54 - 77', 'Copacabana', 'Antioquia', 2, 1),
(4, 'Lina', 'Rangel', 3, '8746352354', '4519920', '3119837612', 'Clle 98 #94 - 12', 'La Estrella', 'Antioquia', 2, 1),
(5, 'Mariana', 'Quintero', 1, '1020488138', '4819376', '3014589433', 'Clle 66 AA #99 - 12', 'Sabaneta', 'Antioquia', 2, 1),
(6, 'Juan', 'Florez', 2, '1200476332', '4528467', '3133547812', 'Crra 55 F #90 - 99', 'Itagui', 'Antioquia', 2, 2),
(7, 'Jouler', 'Talaigua', 3, '9463517354', '4718934', '3129873641', 'Clle 19 GG #102 - 99', 'Envigado', 'Antioquia', 2, 1),
(8, 'Jhoan', 'Henao', 1, '4421135444', '3518923', '3122988119', 'Crra 11 #55 - 65', 'Bello', 'Antioquia', 2, 1),
(9, 'Sofia', 'Bonilla', 2, '3764523176', '4517730', '3116736644', 'Crra 12 #53 - 98', 'Bello', 'Antioquia', 2, 1),
(10, 'Edwar', 'Gutierres', 1, '4827399555', '3874569', '3147689834', 'Clle 84 #23 - 13', 'Medellin', 'Antioquia', 2, 2),
(11, 'Samuel', 'Torres', 1, '9836746776', '5672340', '3124458711', 'Crra 102 #65 - 21', 'Medellin', 'Antioquia', 2, 1),
(12, 'Angie', 'Bedolla', 1, '5629433243', '6717623', '3118983174', 'Clle 90 C #87 - 27', 'Envigado', 'Antioquia', 2, 1),
(13, 'Mery', 'Gonzales', 1, '4863877765', '3597601', '3130983712', 'Crra 91 H #34 - 32', 'Itagui', 'Antioquia', 2, 1),
(14, 'Sara', 'Toro', 1, '5962744365', '4586630', '3148764587', 'Crra 63 G #44 - 39', 'Itagui', 'Antioquia', 2, 1),
(15, 'Manuela', 'Gutierres', 1, '4729433276', '3875561', '3118743612', 'Clle 99 A #67', 'Copacabana', 'Antioquia', 2, 1),
(16, 'Manuel', 'Rangel', 2, '5627389999', '3894538', '3138974398', 'Clle 22 #77 - 10', 'La Estrella', 'Antioquia', 2, 1),
(17, 'Sebastian', 'Florez', 1, '1000307303', '6583261', '3015228801', 'Crra 98 #99 - 65', 'Medellin', 'Antioquia', 2, 1),
(18, 'Daniel', 'Rodriguez', 1, '1023456683', '5238874', '3149218732', 'Crra 52 #100 - 78', 'Medellin', 'Antioquia', 2, 1),
(19, 'Rodillos Mastder', 'RMD', 3, '6483542141', '3518926', '3122249116', 'Clle 54 A #55 - 23', 'Bogota', 'Cundinamarca', 1, 1),
(20, 'Inversiones GBP', 'IGBP', 3, '7597432118', '2550427', '3028567341', 'Crra 50 C #6 sur - 16', 'Medellin', 'Antioquia', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pqo`
--

CREATE TABLE `tbl_pqo` (
  `id_pqo` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `correo` varchar(20) NOT NULL,
  `telefono` int(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_pqo`
--

INSERT INTO `tbl_pqo` (`id_pqo`, `nombre`, `correo`, `telefono`, `comentario`, `fecha`) VALUES
(6, 'camilo', 'camilo@gmail.com', 34343, 'necesito acesoria', '2019-04-27 04:51:30'),
(7, 'mateo', 'mateo@gmail.com', 5790660, 'necesito accesoria', '2019-04-29 13:36:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `id_producto` int(11) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `nombre_producto` varchar(45) NOT NULL,
  `precio_unitario` int(11) NOT NULL,
  `Categoria_Producto_id_Categoria` int(11) NOT NULL,
  `Persona_id_persona` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`id_producto`, `referencia`, `nombre_producto`, `precio_unitario`, `Categoria_Producto_id_Categoria`, `Persona_id_persona`, `cantidad`, `estado`) VALUES
(14, 'RTHJK', 'Rodillo Pinta-Facil', 5000, 6, 19, 390, 1),
(15, 'FTRU45', 'Rodillo Repintex', 4000, 5, 19, 57, 1),
(16, 'BHJA34', 'Rodillo Popular Felpa', 4500, 6, 19, 22, 1),
(17, 'WFJK32', 'Rodillo Poliamida', 6000, 8, 20, 32, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida`
--

CREATE TABLE `tbl_salida` (
  `id_salida` int(11) NOT NULL,
  `fecha_salida` date NOT NULL,
  `tipo_salida_tipo_salida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_salida`
--

INSERT INTO `tbl_salida` (`id_salida`, `fecha_salida`, `tipo_salida_tipo_salida`) VALUES
(32, '2019-05-08', 2),
(33, '2019-05-08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_documento`
--

CREATE TABLE `tbl_tipo_documento` (
  `tipo_documento` int(11) NOT NULL,
  `nombre_documento` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_documento`
--

INSERT INTO `tbl_tipo_documento` (`tipo_documento`, `nombre_documento`, `estado`) VALUES
(1, 'Cedula de Ciudadania', 0),
(2, 'Cedula de Extranjeria', 0),
(3, 'NIT', 0),
(4, 'Tarjeta de Identidad', 0),
(5, 'Rgistro Civil', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_persona`
--

CREATE TABLE `tbl_tipo_persona` (
  `tipo_persona` int(11) NOT NULL,
  `nombre_tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_persona`
--

INSERT INTO `tbl_tipo_persona` (`tipo_persona`, `nombre_tipo`) VALUES
(1, 'Proveedor'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_salida`
--

CREATE TABLE `tbl_tipo_salida` (
  `tipo_salida` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_tipo_salida`
--

INSERT INTO `tbl_tipo_salida` (`tipo_salida`, `nombre`, `estado`) VALUES
(1, 'Mal estado', 1),
(2, 'Daño', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `codigo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_usuario`, `nombre`, `correo`, `password`, `imagen`, `url`, `codigo`) VALUES
(1, 'Jhoan h', 'jhoanhenao820@gmail.com', 'c93ccd78b2076528346216b3b2f701e6', 'fondo.jpg', 'public/img/fondo.jpg', '0zhu1leyhu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl__usuario`
--

CREATE TABLE `tbl__usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `imagen` varchar(255) DEFAULT 'no_imagen.jpg',
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl__usuario`
--

INSERT INTO `tbl__usuario` (`id_usuario`, `nombre`, `correo`, `password`, `imagen`, `url`) VALUES
(1, 'Jhoan Sebastian', 'jhoanhenao820@gmail.com', '88ca9791c0f2e27a503c23b74896b377', '20170104_211959.jpg', 'img/20170104_211959.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tmp`
--

INSERT INTO `tmp` (`id_tmp`, `id_producto`, `cantidad_tmp`, `precio_tmp`, `session_id`) VALUES
(8, 2, 1, 200.00, 'b2g6l4d937aff8laeauladugbu'),
(7, 1, 1, 100.00, 'b2g6l4d937aff8laeauladugbu'),
(28, 2, 1, 200.00, 'k1515pqkk1ohr3suqf8etrtp3m'),
(29, 1, 1, 100.00, 'k1515pqkk1ohr3suqf8etrtp3m'),
(30, 3, 1, 100.00, 'k1515pqkk1ohr3suqf8etrtp3m'),
(31, 4, 1, 55000.00, 'k1515pqkk1ohr3suqf8etrtp3m');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_entrada`
--

CREATE TABLE `tmp_entrada` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_salida`
--

CREATE TABLE `tmp_salida` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  ADD PRIMARY KEY (`id_Categoria`);

--
-- Indices de la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  ADD PRIMARY KEY (`entrada_has_prducto`),
  ADD KEY `fk_Entrada_has_Producto_Entrada1_idx` (`Entrada_id_entrada`),
  ADD KEY `fk_Entrada_has_Producto_Producto1_idx` (`Producto_id_producto`);

--
-- Indices de la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  ADD PRIMARY KEY (`Pedido_has_Producto`),
  ADD KEY `fk_Pedido_has_Producto_Pedido1_idx` (`Pedido_id_pedido`),
  ADD KEY `fk_Pedido_has_Producto_Producto1_idx` (`Producto_id_producto`);

--
-- Indices de la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  ADD PRIMARY KEY (`producto_has_salida`),
  ADD KEY `fk_Producto_has_Salida_Producto1_idx` (`Producto_id_producto`),
  ADD KEY `fk_Producto_has_Salida_Salida1_idx` (`Salida_id_salida`);

--
-- Indices de la tabla `tbl_entrada`
--
ALTER TABLE `tbl_entrada`
  ADD PRIMARY KEY (`id_entrada`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_Pedido_Persona1_idx` (`Persona_id_persona`);

--
-- Indices de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `fk_Persona_tipo_persona1_idx` (`tipo_persona_tipo_persona`),
  ADD KEY `fk_Persona_tipo_documento1_idx` (`tipo_documento_tipo_documento`);

--
-- Indices de la tabla `tbl_pqo`
--
ALTER TABLE `tbl_pqo`
  ADD PRIMARY KEY (`id_pqo`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_Producto_Persona1_idx` (`Persona_id_persona`),
  ADD KEY `fk_Producto_Categoria_Producto1_idx` (`Categoria_Producto_id_Categoria`);

--
-- Indices de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD PRIMARY KEY (`id_salida`),
  ADD KEY `fk_Salida_tipo_salida1_idx` (`tipo_salida_tipo_salida`);

--
-- Indices de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  ADD PRIMARY KEY (`tipo_documento`);

--
-- Indices de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  ADD PRIMARY KEY (`tipo_persona`);

--
-- Indices de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  ADD PRIMARY KEY (`tipo_salida`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `tmp_entrada`
--
ALTER TABLE `tmp_entrada`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `tmp_salida`
--
ALTER TABLE `tmp_salida`
  ADD PRIMARY KEY (`id_tmp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria_producto`
--
ALTER TABLE `tbl_categoria_producto`
  MODIFY `id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  MODIFY `entrada_has_prducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  MODIFY `Pedido_has_Producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  MODIFY `producto_has_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_entrada`
--
ALTER TABLE `tbl_entrada`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT de la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_pqo`
--
ALTER TABLE `tbl_pqo`
  MODIFY `id_pqo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_documento`
--
ALTER TABLE `tbl_tipo_documento`
  MODIFY `tipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_persona`
--
ALTER TABLE `tbl_tipo_persona`
  MODIFY `tipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  MODIFY `tipo_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `tmp_entrada`
--
ALTER TABLE `tmp_entrada`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tmp_salida`
--
ALTER TABLE `tmp_salida`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_detalle_entrada`
--
ALTER TABLE `tbl_detalle_entrada`
  ADD CONSTRAINT `fk_Entrada_has_Producto_Entrada1` FOREIGN KEY (`Entrada_id_entrada`) REFERENCES `tbl_entrada` (`id_entrada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Entrada_has_Producto_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_pedido`
--
ALTER TABLE `tbl_detalle_pedido`
  ADD CONSTRAINT `fk_Pedido_has_Producto_Pedido1` FOREIGN KEY (`Pedido_id_pedido`) REFERENCES `tbl_pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_has_Producto_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_detalle_salida`
--
ALTER TABLE `tbl_detalle_salida`
  ADD CONSTRAINT `fk_Producto_has_Salida_Producto1` FOREIGN KEY (`Producto_id_producto`) REFERENCES `tbl_producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_has_Salida_Salida1` FOREIGN KEY (`Salida_id_salida`) REFERENCES `tbl_salida` (`id_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `fk_Pedido_Persona1` FOREIGN KEY (`Persona_id_persona`) REFERENCES `tbl_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_persona`
--
ALTER TABLE `tbl_persona`
  ADD CONSTRAINT `fk_Persona_tipo_documento1` FOREIGN KEY (`tipo_documento_tipo_documento`) REFERENCES `tbl_tipo_documento` (`tipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Persona_tipo_persona1` FOREIGN KEY (`tipo_persona_tipo_persona`) REFERENCES `tbl_tipo_persona` (`tipo_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `fk_Producto_Categoria_Producto1` FOREIGN KEY (`Categoria_Producto_id_Categoria`) REFERENCES `tbl_categoria_producto` (`id_Categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_Persona1` FOREIGN KEY (`Persona_id_persona`) REFERENCES `tbl_persona` (`id_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD CONSTRAINT `fk_Salida_tipo_salida1` FOREIGN KEY (`tipo_salida_tipo_salida`) REFERENCES `tbl_tipo_salida` (`tipo_salida`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
