-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.31 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para reactivos_db
CREATE DATABASE IF NOT EXISTS `reactivos_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `reactivos_db`;

-- Volcando estructura para tabla reactivos_db.tblreactivos
CREATE TABLE IF NOT EXISTS `tblreactivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `inventario_inicial` decimal(10,2) DEFAULT NULL,
  `compras` decimal(10,2) DEFAULT NULL,
  `consumo` decimal(10,2) DEFAULT NULL,
  `existencia` decimal(10,2) DEFAULT NULL,
  `inventario_muestras` decimal(10,2) DEFAULT NULL,
  `gasto_por_dia` decimal(10,2) DEFAULT NULL,
  `inventario_en_dias` int DEFAULT NULL,
  `dias_en_surtir` int DEFAULT NULL,
  `inventario_al_llegar` decimal(10,2) DEFAULT NULL,
  `punto_reorden` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla reactivos_db.tblreactivos: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `tblreactivos` DISABLE KEYS */;
INSERT INTO `tblreactivos` (`id`, `nombre`, `unidad`, `inventario_inicial`, `compras`, `consumo`, `existencia`, `inventario_muestras`, `gasto_por_dia`, `inventario_en_dias`, `dias_en_surtir`, `inventario_al_llegar`, `punto_reorden`) VALUES
	(1, 'Sulfato de Potasio', 'kg', 9.50, 0.00, 0.00, 9.50, 63.00, 0.30, NULL, 32, NULL, 20);
/*!40000 ALTER TABLE `tblreactivos` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
