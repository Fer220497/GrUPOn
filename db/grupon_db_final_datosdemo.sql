-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-01-2018 a las 22:09:50
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id4129874_grupon`
--
CREATE DATABASE IF NOT EXISTS `id4129874_grupon` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id4129874_grupon`;

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
('cliente@cliente.es', 'viajes'),
('cliente@cliente.es', 'entretenimiento'),
('cliente@cliente.es', 'gastronomia'),
('pepe@gmail.com', 'viajes'),
('pepe@gmail.com', 'gastronomia'),
('clientetest@cliente.es', 'viajes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo`
--

CREATE TABLE `catalogo` (
  `id_catalogo` int(11) NOT NULL,
  `correo` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_categoria` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `catalogo`
--

INSERT INTO `catalogo` (`id_catalogo`, `correo`, `nombre_categoria`, `nombre`) VALUES
(1, 'sevitravel@empresa.com', 'viajes', 'SeviTravel - Vuelos Nacionales'),
(2, 'sevitravel@empresa.com', 'viajes', 'SeviTravel - Vuelos Internacionales'),
(3, 'sevitravel@empresa.com', 'viajes', 'SeviTravel - Naturaleza Andalucía');

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
('cliente@cliente.es', 'Cliencio', 'Cliencez'),
('clientetest@cliente.es', 'Cliente Test', 'Tested'),
('pepe@gmail.com', 'Pepe', 'Pérez');

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
(1, 'cliente@cliente.es', 'De verdad, estoy llorando, es lo mejor que he probado nunca. No quiero volver al mundo real. ', 5),
(2, 'cliente@cliente.es', 'NO COMPREIS LA 5A MATRICULA DE CALCULO ES UNA ESTAFA', 1),
(11, 'cliente@cliente.es', 'Ay no me diga eza cozah :(', 3),
(13, 'cliente@cliente.es', 'Pues no son tan buenos como parece, además el servicio fue lento.', 3),
(13, 'pepe@gmail.com', 'Buenísimos, los mejores de todo el pueblo', 5),
(15, 'cliente@cliente.es', ' alert(‘Test de ataque XSS’);  Amenaza eliminada', 5);

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
(1, 'cliente@cliente.es', 2, '2018-01-20', 1),
(2, 'cliente@cliente.es', 1, '2018-01-20', 1),
(3, 'cliente@cliente.es', 11, '2018-01-20', 1),
(4, 'pepe@gmail.com', 13, '2018-01-21', 1),
(5, 'cliente@cliente.es', 13, '2018-01-21', 1),
(6, 'cliente@cliente.es', 15, '2018-01-23', 1),
(7, 'cliente@cliente.es', 3, '2018-01-23', 1);

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
('ceupo@gmail.com', 'andalucia', '$2y$10$RYuukL7ka1OI0Xfa/I4ixuQIt1duRY3qVx8DciPxV2I6rMpMVUB4O'),
('cinesmadrid@empresa.com', 'madrid', '$2y$10$I6GMK4b9M9iCt7ycv2TvwOitucVGxAvXkkjlh5LKCsLZrc6r7pScq'),
('cliente@cliente.es', 'andalucia', '$2y$10$pK/keSAYcoEIvYQyGqFxW.sC4LcObGG3./.O2b75SxXlZ51pMGLoa'),
('clientetest@cliente.es', 'andalucia', '$2y$10$OXqcE0c6va5cgRwxlly48.aeoJ1qS8bhjt7WaDOwRVJ.OKKwkaSOW'),
('copisteria@upo.es', 'andalucia', '$2y$10$PIZNTm/KZLKdAiLuSz7GOeSlQg352jw6qlis/T1F73/6STqFkd6py'),
('meme@vrchat.ug', 'andalucia', '$2y$10$/M31ptw8OD4ZLp2jUgUf5O0L7L/t.j04CO/ZyOjLLhlgVS13Iz2xS'),
('pepe@gmail.com', 'andalucia', '$2y$10$7wJIg6V.xrEZCuK5VsAO8Oz7eDRFI7haRcJXL./uWeJP/5Hqa8xNi'),
('sevitravel@empresa.com', 'andalucia', '$2y$10$Y8Kr2QvmZ8cHmqEQ9ANu4OaRQ4wZlKkRJT8rg0iBl.sDgLKY9u3LW');

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
('ceupo@gmail.com', 'CEUPO', 'Universidad Pablo de Olavide', 'A78351624', 'https://www.ceupo.upo.com', '98732165401237894560', 963147258, 'ceupo@gmail.com'),
('cinesmadrid@empresa.com', 'Cines Madrid', 'Génova Madrid', 'B12345678', 'https://cinesmadrid.es', '12345678901234567890', 911222333, 'info@cinesmadrid.com'),
('copisteria@upo.es', 'Copisteria UPO', 'Universidad Pablo de Olavide', 'A12378654', 'https://www.copisteria.com', '96385274107418529630', 986357421, 'copisteria@upo.es'),
('meme@vrchat.ug', 'Do you know da we', 'Uganda', 'C12345678', 'http://spiton.com', '00000000000000000001', 696969696, 'doyouknowdawe@ugmail.com'),
('sevitravel@empresa.com', 'SeviTravel', 'Torre Sevilla, Sevilla', 'A12345678', 'https://sevitravel.es', '12345678901234567890', 955666777, 'info@sevitravel.com');

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
('ceupo@gmail.com', 19, '2018-01-21', '2018-01-21', 0),
('ceupo@gmail.com', 22, '2018-01-21', '2018-01-21', 0),
('cinesmadrid@empresa.com', 18, '2018-01-21', '2018-01-21', 0),
('copisteria@upo.es', 7, '2018-01-20', '2018-01-20', 0),
('copisteria@upo.es', 13, '2018-01-20', '2018-01-20', 2),
('copisteria@upo.es', 14, '2018-01-20', '2018-01-20', 0),
('copisteria@upo.es', 15, '2018-01-20', '2018-01-20', 1),
('copisteria@upo.es', 16, '2018-01-20', '2018-01-20', 0),
('copisteria@upo.es', 17, '2018-01-20', '2018-01-20', 0),
('meme@vrchat.ug', 4, '2018-01-20', '2018-01-20', 0),
('meme@vrchat.ug', 6, '2018-01-20', '2018-01-20', 0),
('meme@vrchat.ug', 9, '2018-01-20', '2018-01-20', 0),
('meme@vrchat.ug', 11, '2018-01-20', '2018-01-20', 1),
('meme@vrchat.ug', 12, '2018-01-20', '2018-01-20', 0),
('sevitravel@empresa.com', 1, '2018-01-20', '2018-01-20', 1),
('sevitravel@empresa.com', 2, '2018-01-20', '2018-01-20', 1),
('sevitravel@empresa.com', 3, '2018-01-20', '2018-01-20', 1),
('sevitravel@empresa.com', 5, '2018-01-20', '2018-01-20', 0),
('sevitravel@empresa.com', 8, '2018-01-20', '2018-01-20', 0),
('sevitravel@empresa.com', 10, '2018-01-20', '2018-01-20', 0),
('sevitravel@empresa.com', 20, '2018-01-21', '2018-01-21', 0),
('sevitravel@empresa.com', 21, '2018-01-21', '2018-01-21', 0),
('sevitravel@empresa.com', 23, '2018-01-21', '2018-01-22', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre_categoria` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_ca` varchar(25) COLLATE utf8_spanish2_ci NOT NULL,
  `id_catalogo` int(11) DEFAULT NULL,
  `nombre` varchar(75) COLLATE utf8_spanish2_ci NOT NULL,
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
(1, 'viajes', 'andalucia', NULL, 'Viaje Interdimensional', 4000, 'Viaje a una dimensión donde existen las vacaciones de Navidad. ¿Ah que es muy caro? Pues trabaja. ¿Ah que estás en la carrera aún? Pues sácatela. ¿Ah que te ha quedado cálculo? Pues vete a magis.', 'Tus Sueños', 5, 1, 5, 4, '0.88052600 1516477728.jpg'),
(2, 'entretenimiento', 'andalucia', NULL, '5ª matrícula de Cálculo', 1200, 'El dinero subvencionará los viajes de Sergio.', 'Universidad Pablo de Olavide', 1, 1, 100, 99, '0.46066000 1516479191.png'),
(3, 'salud_y_belleza', 'andalucia', NULL, 'Boletín de EPDs de PA', 30, 'Ponemos este producto en la categoría de salud porque es lo que te faltará cuando acabes todas', 'Universidad Pablo de Olavide', 10, 1, 9, 8, '0.44343000 1516481150.jpg'),
(4, 'entretenimiento', 'andalucia', NULL, 'Ayuda', 1, 'Esto no es un producto, es un mensaje de ayuda para que me saquen de aquí. Llevo encerrado en mi cuarto demasiado, en este tiempo ha nacido mi hija que todavía no me conoce, la última vez que pude ver un partido de fútbol era un Madrid-Barça con Raúl y Ronaldinho.', 'Ciudad del Vaticano', 2, 0, 1, 1, '0.30452400 1516480935.jpg'),
(5, 'entretenimiento', 'andalucia', NULL, 'Mi nota en JavaScript', 1, 'Bueno pues... No es mucho, pero ¿y la bonita que ha quedado la web?', 'Universidad Pablo de Olavide', 99, 0, 2, 2, '0.44958000 1516481102.jpg'),
(6, 'entretenimiento', 'andalucia', NULL, 'Opel Corsa', 8500, 'Vendo Opel Corsa, razón aquí.', 'Forocohes', 10, 0, 1, 1, '0.31949100 1516487234.jpg'),
(7, 'electronica', 'andalucia', NULL, 'Servicio de Documentacion', 50, '¿Cansado de tener que documentar hasta los divs en los HTML? ¿Cansado de tener que explicar que hace una función con un for? ¿Cansado de tener que explicar  el código 2 veces?\r\n\r\nNO TE PREOCUPES MAS!!!!!\r\nContrate nuestro servicio para quitarte todos estos problemas. Nuestro grupo de chinos se encargan de documentar todo su código.', 'Universidad Pablo de Olavide', 30, 0, 9, 9, '0.15150100 1516487369.jpg'),
(8, 'viajes', 'andalucia', 1, 'Vuelo Sevilla - Mallorca', 250, 'Vuelo a PMI desde SVQ para el 24 de Enero a las 16:00 en Ryanair.\r\n', 'Aeropuerto de Sevilla', 10, 0, 5, 5, '0.04139200 1516487602.jpg'),
(9, 'entretenimiento', 'andalucia', NULL, 'Inscripción día EPS', 10, 'Inscribíos porfa plis', 'Universidad Pablo de Olavide', 70, 0, 70, 70, '0.41124600 1516487620.jpeg'),
(10, 'viajes', 'andalucia', 2, 'Vuelo Sevilla - Paris', 400, 'Vuelo salida desde Sevilla a París para el 30 de Enero a las 12:00', 'Aeropuerto de Sevilla', 10, 0, 2, 2, '0.10443100 1516487723.jpg'),
(11, 'entretenimiento', 'andalucia', NULL, 'Tonto el que lo lea xd', 10, 'Caíste weeee', 'Albacete', 20, 1, 1, 0, '0.25563400 1516488002.png'),
(12, 'electronica', 'andalucia', NULL, 'pruebando koza', 2, 'k funsione x fabo', 'Albacete', 12, 0, 1, 1, '0.91845000 1516488363.png'),
(13, 'gastronomia', 'andalucia', NULL, 'Nachos con Queso y Carne', 7, 'Los mejores Nachos con Queso y Carne de toda la provincia. Incluyen salsa Barbacoa y salsa Guacamole', 'Pizzeria Burger-Ton', 10, 2, 30, 28, '0.54712200 1516489814.jpg'),
(14, 'gastronomia', 'andalucia', NULL, 'Arranque Roteño', 9, 'El mejor Arranque Roteño de toda la ciudad en el Bar La Feria', 'Calle Mina, Rota', 25, 0, 50, 50, '0.67543200 1516490164.jpg'),
(15, 'viajes', 'castilla_la_mancha', NULL, 'Camara Reflex', 729, '-Sensor APS-C de 24.2 megapíxeles\r\n-La cámara digital réflex más ligera del mundo con una pantalla de ángulo variable\r\n-Visor óptico de alta calidad y pantalla táctil de ángulo variable\r\n-Conexión Wifi y Bluetooth: visualiza y edita las imágenes en tu smartphone o tablet y compártelas con tus amigos', 'Toledo', 15, 1, 20, 19, '0.99029600 1516490433.jpg'),
(16, 'entretenimiento', 'madrid', NULL, 'VIVE UNA EXPERIENCIA UNICA: JURA DE BANDERA', 20, '¡Para defender a tu patria y el maravilloso sentimiento de ser... ESPAÑOL!!!!!!!!!!!!!!!!!!\r\nCELEBRA LOS LOGROS DE ESPAÑA COMO GANAR 2 EUROCOPAS Y EL MUNDIAL DE SUDÁFRICA\r\n¡¡ARRIBA ESPAÑA!!\r\n¡¡VIVA ESPAÑA!!\r\n\r\nTE ESPERAMOS EN LA PLAZA DE ESPAÑA(tm) EN SEVILLA EL 9 DE JULIO A LAS 9:00\r\n', 'Plaza de ESPAÑA, Sevilla', 40, 0, 500, 500, '0.00036700 1516490934.jpg'),
(17, 'viajes', 'andalucia', NULL, 'Camiseta del Dia de la EPS UPO', 13, 'Camiseta del Dia de la EPS UPO\r\nEl evento creado por el Tito Norbe, Fernando y Pedro.\r\nEl diseño fue creado por Pedro y Juanma', 'Universidad Pablo de Olavide', 20, 0, 70, 70, '0.32654100 1516491487.png'),
(18, 'entretenimiento', 'madrid', NULL, 'Star Wars VII - Ben Swolo', 10, 'Película de Ben Swolo en los cines de Rivas Vaciamadrid', 'Cines Rivas Vaciamadrid', 15, 0, 15, 15, '0.79619800 1516523742.jpg'),
(19, 'salud_y_belleza', 'andalucia', NULL, 'Trabajo de Final de Asignatura valorado  en 4 Pts', 10, '¿Te sientes identificado con la persona de la imagen?¿Has estado trabajando mucho tiempo en un trabajo que solo vale 2 puntos de la nota final?\r\n¡No te preocupes!\r\nAquí tenemos tu solución.\r\nUn trabajo de final de asignatura que tras mas de 176 horas de trabajo, se vera realmente valorado en la nota final.', 'Universidad Pablo de Olavide', 60, 0, 1, 1, '0.33215300 1516528374.jpg'),
(20, 'viajes', 'andalucia', 3, 'Escapada de finde semana al caminito del rey ', 50, 'ATENCIÓN NO RECOMENDADO SI TIENES VERTIGO:\r\nEscapada para el dia 29/1/2018 a el caminito del Rey, autobús, comida y entradas al caminito incluidas.\r\nSalida desde Plaza de Armas a las 09:00', 'Plaza de Armas, Sevilla', 25, 0, 50, 50, '0.01145900 1516544957.jpg'),
(21, 'viajes', 'andalucia', 3, 'Fin de semana en Sierra Nevada', 200, 'Escapada de fin de semana al hotel Reina Nevada en Sierra Nevada del 9 a 11 de Febrero', 'Hotel Reino Nevado, Sierra Nevada', 10, 0, 2, 2, '0.14455800 1516545384.jpg'),
(22, 'entretenimiento', 'andalucia', NULL, 'Figurita de Megumin ', 90, 'Figurita de la magnifica MEGUMIN, personaje de Kono Subarashii Sekai ni Shukufuku wo!', 'Nervion Plaza', 20, 0, 50, 50, '0.72682700 1516546251.jpg'),
(23, 'viajes', 'andalucia', 2, 'Excursión lúdica: observa el procés de primera mano', 200, '¿Cansado de ver el procés por la tele y quieres ir allí a verlo de primera mano? En este viaje te enseñaremos la Cataluña del procés y tendrás la posibilidad de tomar un piscolabis con los personajes más famosos del proces: Gabriel Rufian, Joan Tardà, Anna Gabriel,  Jordi Pujol, Artur Mas...\r\nSalida desde el aeropuerto de sevilla\r\nNota: Carles Puigdemont y Oriol Junqueras no incluído por motivos personales.', 'Aeropuerto de Sevilla', 1, 0, 50, 50, '0.81714600 1516555870.jpg');

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
  ADD PRIMARY KEY (`correo`);

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
  MODIFY `id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  ADD CONSTRAINT `correo.fk.comentario.cuenta` FOREIGN KEY (`correo`) REFERENCES `cuenta` (`correo`) ON DELETE CASCADE ON UPDATE CASCADE,
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
