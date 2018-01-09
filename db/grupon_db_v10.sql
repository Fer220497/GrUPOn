-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2018 a las 14:51:34
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupon`
--
CREATE DATABASE IF NOT EXISTS `grupon` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `grupon`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afinidades`
--

CREATE TABLE `afinidades` (
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `afinidades`
--

INSERT INTO `afinidades` (`correo`, `nombre_categoria`) VALUES
('cliencio@cliente.com', 'viajes'),
('cliencio@cliente.com', 'entretenimiento'),
('cliencio@cliente.com', 'electronica'),
('cliencio@cliente.com', 'ropa'),
('cliencio@cliente.com', 'salud_y_belleza'),
('cliencio@cliente.com', 'deporte'),
('cli@cli.es', 'viajes'),
('cli@cli.es', 'electronica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_catalogo`, `correo`, `nombre_categoria`, `nombre`) VALUES
(1, 'empresa1@empresa.com', 'viajes', 'viajes a japon'),
(2, 'empresa1@empresa.com', 'viajes', 'viajes a japon'),
(3, 'empresa1@empresa.com', 'gastronomia', 'comidas en sevilla'),
(4, 'empresa1@empresa.com', 'ropa', 'ropa invierno verano 2019');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`nombre_categoria`) VALUES
('deporte'),
('electronica'),
('entretenimiento'),
('gastronomia'),
('ropa'),
('salud_y_belleza'),
('viajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`correo`, `nombre_cliente`, `apellidos_cliente`) VALUES
('cli@cli.es', 'Clippy', 'Clippo Cleppo'),
('cliencio@cliente.com', 'Cliencio', 'Cliencez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_producto` int(11) NOT NULL,
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish2_ci NOT NULL,
  `valoracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_producto`, `correo`, `comentario`, `valoracion`) VALUES
(1, 'cli@cli.es', 'VIVA JAPON OME ESO SI QUE SON UNO SEÃ‘ORE WENO E O NO COMPARE', 5),
(1, 'cliencio@cliente.com', 'PUES A MI ME HA PARECIDO UNA MIERDA, NOT ENOUGH LOLIS 0/5', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `correo`, `id_producto`, `fecha`, `cantidad`) VALUES
(1, 'cli@cli.es', 1, '2018-01-07', 1),
(2, 'cliencio@cliente.com', 1, '2018-01-09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad_autonoma`
--

CREATE TABLE `comunidad_autonoma` (
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `comunidad_autonoma`
--

INSERT INTO `comunidad_autonoma` (`nombre_ca`) VALUES
('andalucia'),
('aragon'),
('asturias'),
('canarias'),
('cantabria'),
('castilla_la_mancha'),
('castilla_y_leon'),
('catalunya'),
('ceuta'),
('extremadura'),
('galicia'),
('islas_baleares'),
('la_rioja'),
('madrid'),
('melilla'),
('murcia'),
('navarra'),
('pais_vasco'),
('valencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `pwd` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`correo`, `nombre_ca`, `pwd`) VALUES
('cli@cli.es', 'ceuta', '$2y$10$8MvGlLvIjlCRb0DvXrDBU.Om1tEHMXMP9ixtml1ShD2wVLFp.D1kW'),
('cli@cliente.es', 'islas_baleares', '$2y$10$aewgj5dCuzv3KLsu5dHaFeI/O8wqIHJLsU5H0/d5VuxiW4wcxZbC2'),
('cliencia@cliente.com', 'melilla', '$2y$10$CbpjGGB8gpiRfq1Uc.nYTuibcYAQcSll2uSUscpL1usBfnhLzSCme'),
('cliencio@cliente.com', 'canarias', '$2y$10$9GDUVV.oI6BePnmPGRidWeGjnGBB/UEE9ujEi4lbFNhgwDouVBHcq'),
('empresa1@empresa.com', 'andalucia', '$2y$10$T5p1Ina5KHw0FWYa21aqrO5RPwT800WBGCo0ofhT5iz63.Kg.7an2'),
('empresa2@empresa.com', 'asturias', '$2y$10$7M7VqKrtIg5aNheJBORolu3IA4sJwBTOUCTva59MsJJFAm0zWGiqG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `nif_empresa` varchar(9) COLLATE utf8_spanish2_ci NOT NULL,
  `web_empresa` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `cuenta_bancaria` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono_empresa` int(9) NOT NULL,
  `email_empresa` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`correo`, `nombre_empresa`, `direccion_empresa`, `nif_empresa`, `web_empresa`, `cuenta_bancaria`, `telefono_empresa`, `email_empresa`) VALUES
('empresa1@empresa.com', 'Pedrainer', 'sevilla, calle sierpes, 2', 'A12345678', 'https://pedro2.com/', '12345678901234567890', 987654321, 'pedro@maricon.com'),
('empresa2@empresa.com', 'Empresa2', 'sevilla, calle paris, 2', 'B12345678', 'https://empresa2.es', '12345678901234567890', 999888777, 'empresa2info@empresa.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lanzamientos`
--

CREATE TABLE `lanzamientos` (
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `num_ventas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `lanzamientos`
--

INSERT INTO `lanzamientos` (`correo`, `id_producto`, `fecha_ini`, `fecha_fin`, `num_ventas`) VALUES
('empresa1@empresa.com', 1, '2018-01-03', '0000-00-00', 5),
('empresa1@empresa.com', 2, '2018-01-05', '0000-00-00', 0),
('empresa1@empresa.com', 3, '2018-01-05', '0000-00-00', 0),
('empresa1@empresa.com', 6, '2018-01-05', '2018-01-06', 1),
('empresa1@empresa.com', 7, '2018-01-05', '2018-01-05', 0),
('empresa1@empresa.com', 8, '2018-01-05', '2018-01-05', 0),
('empresa1@empresa.com', 9, '2018-01-05', '2018-01-05', 0),
('empresa2@empresa.com', 10, '2018-01-07', '2018-01-07', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_catalogo` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` float NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci NOT NULL,
  `localizacion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `porcentaje_descuento` int(3) NOT NULL,
  `cantidad_vendida` int(100) NOT NULL,
  `cantidad_total` int(100) NOT NULL,
  `cantidad_disponible` int(100) NOT NULL,
  `ruta_imagen` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre_categoria`, `nombre_ca`, `id_catalogo`, `nombre`, `precio`, `descripcion`, `localizacion`, `porcentaje_descuento`, `cantidad_vendida`, `cantidad_total`, `cantidad_disponible`, `ruta_imagen`) VALUES
(1, 'deporte', 'andalucia', 1, 'jap', 123, '23143', 'adew', 2, 5, 432, 427, ''),
(2, 'viajes', 'cantabria', 4, 'uvuvwevwevwe', 20, 'seq', 'lelele', 5, 0, 5, 5, ''),
(3, 'viajes', 'cantabria', 4, 'Ã‘EÃ‘EÃ‘EÃ‘EÃ‘EÃ‘E', 2042, 'seq', 'lelele', 5, 0, 5, 5, ''),
(6, 'entretenimiento', 'canarias', 2, 'LIKULAU', 250, 'BEST BOYE', 'TAIWAN', 1, 1, 1, 0, '0.71136800 1515156128.jpg'),
(7, 'viajes', 'andalucia', 1, '3424', 2432, '1431', '3143', 3141, 0, 343, 343, '0.78358500 1515156940.jpg'),
(8, 'viajes', 'andalucia', 2, '34242', 2342430, '242342', '23423', 234234, 0, 43423, 43423, '0.76981000 1515157112.jpg'),
(9, 'viajes', 'andalucia', 3, 'erwre', 123, 'rerwrw', '123', 123, 0, 123, 123, '0.46414000 1515157990.PNG'),
(10, 'gastronomia', 'asturias', NULL, 'FABADA WENA', 11, 'uwuwuwu', 'oviedo', 3, 0, 7, 7, '0.91625800 1515327465.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afinidades`
--
ALTER TABLE `afinidades`
  ADD KEY `cuenta.fk.afinidades.cliente` (`correo`),
  ADD KEY `nombre_cateogria.fk.afinidades.categoria` (`nombre_categoria`);

--
-- Indices de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD PRIMARY KEY (`id_catalogo`),
  ADD KEY `correo.fk.catalogo.empresa` (`correo`),
  ADD KEY `nombre_categoria.fk.catalogo.categoria` (`nombre_categoria`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nombre_categoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`correo`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_producto`,`correo`),
  ADD KEY `correo.fk.comentario.cuenta` (`correo`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `correo.fk.compra.cuenta` (`correo`),
  ADD KEY `id_producto.fk.compra.producto` (`id_producto`);

--
-- Indices de la tabla `comunidad_autonoma`
--
ALTER TABLE `comunidad_autonoma`
  ADD PRIMARY KEY (`nombre_ca`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`correo`),
  ADD KEY `nombre_ca.fk.cuenta.comunidad_autonoma` (`nombre_ca`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`correo`),
  ADD UNIQUE KEY `nif_empresa` (`nif_empresa`);

--
-- Indices de la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  ADD PRIMARY KEY (`correo`,`id_producto`),
  ADD KEY `id_producto.fk.lanzamientos.producto` (`id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `nombre_ca.fk.producto.comunidad_autonoma` (`nombre_ca`),
  ADD KEY `catalogo_id.fk.producto.catalogo` (`id_catalogo`),
  ADD KEY `nombre_categoria.fk.producto.categoria` (`nombre_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogo`
--
ALTER TABLE `catalogo`
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afinidades`
--
ALTER TABLE `afinidades`
  ADD CONSTRAINT `cuenta.fk.afinidades.cliente` FOREIGN KEY (`correo`) REFERENCES `cliente` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nombre_cateogria.fk.afinidades.categoria` FOREIGN KEY (`nombre_categoria`) REFERENCES `categoria` (`nombre_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `catalogo`
--
ALTER TABLE `catalogo`
  ADD CONSTRAINT `correo.fk.catalogo.empresa` FOREIGN KEY (`correo`) REFERENCES `empresa` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nombre_categoria.fk.catalogo.categoria` FOREIGN KEY (`nombre_categoria`) REFERENCES `categoria` (`nombre_categoria`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `correo.fk.cliente.cuenta` FOREIGN KEY (`correo`) REFERENCES `cuenta` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `correo.fk.comentario.cuenta` FOREIGN KEY (`correo`) REFERENCES `cuenta` (`correo`),
  ADD CONSTRAINT `id_producto.fk.comentario.producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `correo.fk.compra.cuenta` FOREIGN KEY (`correo`) REFERENCES `cuenta` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto.fk.compra.producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `nombre_ca.fk.cuenta.comunidad_autonoma` FOREIGN KEY (`nombre_ca`) REFERENCES `comunidad_autonoma` (`nombre_ca`);

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD CONSTRAINT `correo.fk.empresa.cuenta` FOREIGN KEY (`correo`) REFERENCES `cuenta` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lanzamientos`
--
ALTER TABLE `lanzamientos`
  ADD CONSTRAINT `correo.fk.lanzamientos.empresa` FOREIGN KEY (`correo`) REFERENCES `empresa` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto.fk.lanzamientos.producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `catalogo_id.fk.producto.catalogo` FOREIGN KEY (`id_catalogo`) REFERENCES `catalogo` (`id_catalogo`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `nombre_ca.fk.producto.comunidad_autonoma` FOREIGN KEY (`nombre_ca`) REFERENCES `comunidad_autonoma` (`nombre_ca`),
  ADD CONSTRAINT `nombre_categoria.fk.producto.categoria` FOREIGN KEY (`nombre_categoria`) REFERENCES `categoria` (`nombre_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
