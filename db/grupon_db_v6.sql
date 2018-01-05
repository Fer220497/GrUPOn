-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2018 a las 01:17:22
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `apellidos_cliente` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad_autonoma`
--

CREATE TABLE `comunidad_autonoma` (
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `correo` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `pwd` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
  `cuenta_bancaria` int(20) NOT NULL,
  `telefono_empresa` int(9) NOT NULL,
  `email_empresa` varchar(75) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`correo`,`id_producto`),
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
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `correo.fk.compra.cliente` FOREIGN KEY (`correo`) REFERENCES `cliente` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_producto.fk.compra.producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

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
