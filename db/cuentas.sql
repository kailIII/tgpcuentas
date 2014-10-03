-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-10-2014 a las 14:19:33
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cuentas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banco`
--

CREATE TABLE IF NOT EXISTS `banco` (
  `nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE IF NOT EXISTS `cuentas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_id` int(6) NOT NULL,
  `cta` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `saf` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `organismo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `denominacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `banco` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `actoadm` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaini` date DEFAULT NULL,
  `cerrada` smallint(6) DEFAULT '0',
  `actobaja` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecbaja` date DEFAULT NULL,
  `observaciones` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `baja` smallint(6) DEFAULT '0',
  `fecbajainicio` date DEFAULT NULL,
  `inibaj` smallint(6) DEFAULT '0',
  `fdopropio` varchar(20) COLLATE utf8_spanish_ci DEFAULT 'Operativa',
  `iconofp` varchar(25) COLLATE utf8_spanish_ci DEFAULT 'cont/img_cuenta_op.jpg',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=563 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firm_ctas`
--

CREATE TABLE IF NOT EXISTS `firm_ctas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cta` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` int(11) DEFAULT NULL,
  `resalta` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaalta` date DEFAULT NULL,
  `resbaja` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechabaja` date DEFAULT NULL,
  `idcuenta` int(11) DEFAULT '0',
  `baja` smallint(6) DEFAULT '0',
  `fechareg` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idcuenta` (`idcuenta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2642 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firm_datos`
--

CREATE TABLE IF NOT EXISTS `firm_datos` (
  `dni` int(11) DEFAULT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saf` int(11) DEFAULT '0',
  `domicilio` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `cargo` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `baja` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `personasdni` (`dni`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=671 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `perfil` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci PACK_KEYS=0 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resoluciones`
--

CREATE TABLE IF NOT EXISTS `resoluciones` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_cuenta` int(5) NOT NULL,
  `cuenta` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `motivo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `saf`
--

CREATE TABLE IF NOT EXISTS `saf` (
  `servicio` int(11) DEFAULT '0',
  `cod_ser` char(4) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  UNIQUE KEY `servicio` (`servicio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saf` int(11) DEFAULT NULL,
  `sector` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_saf` char(4) COLLATE utf8_spanish_ci NOT NULL,
  `baja` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=256 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_perfil` int(5) NOT NULL,
  `ape_nom` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
