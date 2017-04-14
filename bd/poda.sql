-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-04-2016 a las 19:07:41
-- Versión del servidor: 5.6.23
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `poda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `liga` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `liga`) VALUES
(1, 'cat1', '34'),
(2, 'cat2', '34'),
(3, 'cat3', '34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `liga` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `nombre`, `liga`) VALUES
(38, 'boca', '27'),
(39, 'river', '27'),
(40, 'san lorenzo', '28'),
(41, 'racing', '28'),
(42, 'adsasd', '29'),
(43, 'b', '30'),
(44, 'c', '31'),
(45, 'n', '32'),
(46, 'boca', '33'),
(47, 'river', '33'),
(48, 'e11', '34'),
(49, 'e12', '34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE IF NOT EXISTS `jugadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `fecha_nacimiento` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `equipo` varchar(255) NOT NULL,
  `id_liga` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `nombre`, `apellido`, `fecha_nacimiento`, `dni`, `equipo`, `id_liga`, `categoria`) VALUES
(52, 'Christian', 'Russo', '1991-12-01', '35561654', '38', '27', ''),
(53, 'Ayelen', 'Sanchez', '1991-12-01', '333333', '39', '27', ''),
(54, 'dasdas', 'dsadas', '2016-03-03', '1312312', '40', '28', ''),
(55, 'dasdas', 'dasda', '2016/04/21', '1', '45', '32', ''),
(56, 'dasdas', 'dasda', '21/04/2016', '1', '45', '32', ''),
(57, 'sad', 'jhhj', '12/12/212121', '121212', '46', '33', ''),
(58, 'dasdad', 'dsad', '11/11/1111', '131312', '46', '33', ''),
(59, 'dasdad', 'dsad', '11/11/1111', '131312', '46', '33', ''),
(60, 'jhjhjj', 'jhjh', '12/12/12121', '21212', '45', '32', ''),
(61, 'dadas', 'asdad', '31/03/2313', '213123', '45', '32', ''),
(62, 'tes', 'tes', '11/11/1111', '12321321', '48', '34', '1'),
(63, '23113', '21312', '11/11/1111', '13123', '48', '34', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE IF NOT EXISTS `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`) VALUES
(27, 'nordelta'),
(28, 'surdelta'),
(29, 'dasdas'),
(30, 'b'),
(31, 'c'),
(32, 'n'),
(33, 'facu'),
(34, 'tests');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `administrador` varchar(255) NOT NULL,
  `id_liga` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `administrador`, `id_liga`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', ''),
(29, 'nordelta', '$2y$10$qivH3DDddNv.uSt8s2yMpeSxRwD/cKi7dFPM7n6ce7IDdMoeak0X.', '0', '27'),
(30, 'surdelta', '$2y$10$IX70pz0cIE4GQMaj3vIh.upiTFmAcYBiDGfdZzkVFpbadq3h50/l6', '0', '28'),
(31, 'a', '$2y$10$SZVfbJI44gsUNwLZOzwf9eXH5.30FQyR4u1wbgwCkkRzxZz.WgV/i', '0', '29'),
(32, 'b', '$2y$10$LP81jvg1NYJWoY6BN1fDpO4Hu6yxSxLzO96b.UsaNWwcuxM5y91ye', '0', '30'),
(33, 'c', '$2y$10$8p8Z2tnxInrfzldjjKPjSe5.NcK/cQMVF0aziwapFFob.NdjYeeI.', '0', '31'),
(34, 'n', '7b8b965ad4bca0e41ab51de7b31363a1', '0', '32'),
(35, 'facu', 'f8e0920f29985ad1a2724161e86faa65', '0', '33'),
(36, 't', 'e358efa489f58062f10dd7316b65649e', '0', '34');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
