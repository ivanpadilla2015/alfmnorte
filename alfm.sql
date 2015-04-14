-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-01-2013 a las 04:17:00
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `alfm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE IF NOT EXISTS `contratos` (
  `id_contrato` int(20) NOT NULL AUTO_INCREMENT,
  `num_contrato` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(20) NOT NULL,
  `id_tipo_contrato` int(20) NOT NULL,
  `valorcontrato` int(50) NOT NULL,
  `valoradicion` int(50) NOT NULL,
  `registro_pres_inic` int(50) NOT NULL,
  `fechacontrato` date NOT NULL,
  `interadmi` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `objetocontrato` text COLLATE utf8_spanish_ci NOT NULL,
  `saldo` int(50) NOT NULL,
  `id_dependencia` int(5) NOT NULL,
  PRIMARY KEY (`id_contrato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `num_contrato`, `id_proveedor`, `id_tipo_contrato`, `valorcontrato`, `valoradicion`, `registro_pres_inic`, `fechacontrato`, `interadmi`, `objetocontrato`, `saldo`, `id_dependencia`) VALUES
(1, '012333', 1, 1, 50000000, 10000000, 5555555, '2012-12-20', 'N/a', 'compra de carns para los comedores de tropa', 60000000, 1),
(2, '542416', 2, 5, 7000000, 0, 88888, '2012-12-13', '5697', 'compra de todo para los comedores de tropa', 7000000, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dependencias`
--

CREATE TABLE IF NOT EXISTS `dependencias` (
  `id_dependencia` int(5) NOT NULL AUTO_INCREMENT,
  `nombre_depen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_dependencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `dependencias`
--

INSERT INTO `dependencias` (`id_dependencia`, `nombre_depen`) VALUES
(1, 'Comedores de Tropas'),
(2, 'Servitienda'),
(3, 'Cad'),
(4, 'Combustible'),
(5, 'Servicios Administrativos'),
(6, 'Ingenierio Alimentos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nitproveedor` int(50) NOT NULL,
  `correo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `nitproveedor`, `correo`, `telefono`, `direccion`) VALUES
(1, 'UNION TEMPORAL LA RECETTA CARNICOS CDAL', 0, '', '', ''),
(2, 'LA SONRISA S.A.', 0, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_contratos`
--

CREATE TABLE IF NOT EXISTS `tipos_contratos` (
  `id_tipo_contrato` int(20) NOT NULL AUTO_INCREMENT,
  `nombretipo` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_contrato`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tipos_contratos`
--

INSERT INTO `tipos_contratos` (`id_tipo_contrato`, `nombretipo`) VALUES
(1, 'Suministro'),
(2, 'Compraventa'),
(5, 'Prestacion de Servicios'),
(6, 'Consultoria'),
(7, 'Obras'),
(8, 'Pestacion de Servicios  Profesionales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `correo` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `login` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `pass` char(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `correo`, `login`, `pass`) VALUES
(1, 'ivan padilla molinares', 'ivan@yahoo.com', 'furia', '1234'),
(2, 'hilda hoyos', 'hoyos@hotmail.com', 'hilda', '123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
