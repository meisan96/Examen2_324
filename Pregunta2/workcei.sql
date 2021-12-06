-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.3.2-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para workcei
CREATE DATABASE IF NOT EXISTS `workcei` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `workcei`;

-- Volcando estructura para tabla workcei.estudiante
CREATE TABLE IF NOT EXISTS `estudiante` (
  `id` int(11) DEFAULT NULL,
  `ci` varchar(11) DEFAULT NULL,
  `matricula` varchar(11) DEFAULT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla workcei.estudiante: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` (`id`, `ci`, `matricula`, `nombre`, `apellido`, `fecha_nac`, `direccion`) VALUES
	(1, '9170872', '1741134', 'Rodrigo Moises', 'Machaca Mamani', '1995-05-05', 'Villa El Carmen'),
	(2, '8444524', '1741145', 'Estaban', 'Quito Casas', '1997-09-15', 'Villa Salome'),
	(3, '6765552', '1741102', 'Alice', 'Flores Morales', '1999-10-10', 'Satelite'),
	(4, '6855426', '1741122', 'Magaly Carol', 'Villca Conde', '1998-06-30', 'Obrajes');
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;

-- Volcando estructura para tabla workcei.flujo_proceso
CREATE TABLE IF NOT EXISTS `flujo_proceso` (
  `flujo` varchar(2) NOT NULL,
  `proceso` varchar(2) NOT NULL,
  `proceso_sig` varchar(2) NOT NULL,
  `formulario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla workcei.flujo_proceso: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `flujo_proceso` DISABLE KEYS */;
INSERT INTO `flujo_proceso` (`flujo`, `proceso`, `proceso_sig`, `formulario`) VALUES
	('F1', 'P1', 'P2', 'pasos'),
	('F1', 'P2', 'P3', 'nombre'),
	('F1', 'P3', 'P4', 'regprimer'),
	('F1', 'P4', 'P5', 'regsegun'),
	('F1', 'P5', 'P6', 'regtercer'),
	('F1', 'P6', 'P7', 'cargarform'),
	('F1', 'P7', 'F', 'ver');
/*!40000 ALTER TABLE `flujo_proceso` ENABLE KEYS */;

-- Volcando estructura para tabla workcei.frente
CREATE TABLE IF NOT EXISTS `frente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `sigla` varchar(5) DEFAULT NULL,
  `1er` int(11) DEFAULT NULL,
  `2do` int(11) DEFAULT NULL,
  `3er` int(11) DEFAULT NULL,
  `arch` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla workcei.frente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `frente` DISABLE KEYS */;
INSERT INTO `frente` (`id`, `nombre`, `sigla`, `1er`, `2do`, `3er`, `arch`) VALUES
	(11, 'while True Forward', 'WTF', 1, 3, 4, '99fb1ed0-7659-46a7-80c4-5f9e86cddffa.jfif');
/*!40000 ALTER TABLE `frente` ENABLE KEYS */;

-- Volcando estructura para tabla workcei.seguimiento
CREATE TABLE IF NOT EXISTS `seguimiento` (
  `nro` int(11) NOT NULL AUTO_INCREMENT,
  `flujo` varchar(2) DEFAULT NULL,
  `proceso` varchar(2) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `fecha_ini` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`nro`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla workcei.seguimiento: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `seguimiento` DISABLE KEYS */;
INSERT INTO `seguimiento` (`nro`, `flujo`, `proceso`, `id`, `fecha_ini`, `fecha_fin`) VALUES
	(15, 'F1', 'P1', 1, '2021-05-30', '2021-12-06'),
	(16, 'F1', 'P2', 1, '2021-12-06', '2021-12-06'),
	(17, 'F1', 'P3', 1, '2021-12-06', '2021-12-06'),
	(18, 'F1', 'P4', 1, '2021-12-06', '2021-12-06'),
	(19, 'F1', 'P5', 1, '2021-12-06', '2021-12-06'),
	(20, 'F1', 'P6', 1, '2021-12-06', '2021-12-06'),
	(21, 'F1', 'P7', 1, '2021-12-06', '2021-12-06'),
	(22, 'F1', 'F', 1, '2021-12-06', '2021-12-06'),
	(26, 'F1', 'P1', 1, '2021-05-30', '2021-12-06'),
	(27, 'F1', 'P1', 1, '2021-05-30', NULL);
/*!40000 ALTER TABLE `seguimiento` ENABLE KEYS */;

-- Volcando estructura para tabla workcei.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla workcei.usuario: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `user`, `pass`, `rol`) VALUES
	(1, 'rmachaca4', 'moises123', 1),
	(2, 'equito2', 'esteban123', 1),
	(3, 'aflores2', 'alice123', 1),
	(4, 'mvillca', 'magaly123', 1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
