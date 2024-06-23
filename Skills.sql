-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for cineskills
DROP DATABASE IF EXISTS `cineskills`;
CREATE DATABASE IF NOT EXISTS `cineskills` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `cineskills`;

-- Dumping structure for table cineskills.cinemas
DROP TABLE IF EXISTS `cinemas`;
CREATE TABLE IF NOT EXISTS `cinemas` (
  `id_cinema` int(11) NOT NULL,
  `nome_cinema` varchar(100) NOT NULL DEFAULT '',
  `local_cinema` int(11) NOT NULL,
  PRIMARY KEY (`id_cinema`),
  KEY `FK_cinemas_locais` (`local_cinema`),
  CONSTRAINT `FK_cinemas_locais` FOREIGN KEY (`local_cinema`) REFERENCES `locais` (`id_locais`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.cinemas: ~3 rows (approximately)
DELETE FROM `cinemas`;
INSERT INTO `cinemas` (`id_cinema`, `nome_cinema`, `local_cinema`) VALUES
	(1, 'CinemaNos', 2),
	(2, 'Centro Comercial', 1);

-- Dumping structure for table cineskills.estadodasessao
DROP TABLE IF EXISTS `estadodasessao`;
CREATE TABLE IF NOT EXISTS `estadodasessao` (
  `id_estado_sessao` int(11) NOT NULL,
  `descricao_estado_sessao` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado_sessao`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.estadodasessao: ~2 rows (approximately)
DELETE FROM `estadodasessao`;
INSERT INTO `estadodasessao` (`id_estado_sessao`, `descricao_estado_sessao`) VALUES
	(1, 'ativa/o'),
	(2, 'inativa/o');

-- Dumping structure for table cineskills.filmes
DROP TABLE IF EXISTS `filmes`;
CREATE TABLE IF NOT EXISTS `filmes` (
  `codigo_filme` int(11) NOT NULL,
  `nome_filme` varchar(100) DEFAULT NULL,
  `ano_filme` int(11) DEFAULT NULL,
  `decricao_filme` text DEFAULT NULL,
  `tipoDefilme_filme` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_filme`),
  KEY `FK_filmes_tiposdefilme` (`tipoDefilme_filme`),
  CONSTRAINT `FK_filmes_tiposdefilme` FOREIGN KEY (`tipoDefilme_filme`) REFERENCES `tiposdefilme` (`id_tipo_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.filmes: ~3 rows (approximately)
DELETE FROM `filmes`;
INSERT INTO `filmes` (`codigo_filme`, `nome_filme`, `ano_filme`, `decricao_filme`, `tipoDefilme_filme`) VALUES
	(1, 'Surfs UP', 2013, 'Pinguins Surfistas', 2),
	(2, 'TRANSFORMERS 5', 2025, 'Robots Assassinos', 1);

-- Dumping structure for table cineskills.locais
DROP TABLE IF EXISTS `locais`;
CREATE TABLE IF NOT EXISTS `locais` (
  `id_locais` int(11) NOT NULL,
  `descricao_locais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_locais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.locais: ~2 rows (approximately)
DELETE FROM `locais`;
INSERT INTO `locais` (`id_locais`, `descricao_locais`) VALUES
	(1, 'Évora'),
	(2, 'lisboa'),
	(3, 'Faro');

-- Dumping structure for table cineskills.salas
DROP TABLE IF EXISTS `salas`;
CREATE TABLE IF NOT EXISTS `salas` (
  `codigo_salas` int(11) NOT NULL,
  `descricao_salas` varchar(100) DEFAULT NULL,
  `cinema_salas` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo_salas`),
  KEY `FK_salas_salas` (`cinema_salas`),
  CONSTRAINT `FK_salas_cinemas` FOREIGN KEY (`cinema_salas`) REFERENCES `cinemas` (`id_cinema`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.salas: ~2 rows (approximately)
DELETE FROM `salas`;
INSERT INTO `salas` (`codigo_salas`, `descricao_salas`, `cinema_salas`) VALUES
	(1, 'IMAX', 1),
	(2, 'LowCost', 1);

-- Dumping structure for table cineskills.sessoes
DROP TABLE IF EXISTS `sessoes`;
CREATE TABLE IF NOT EXISTS `sessoes` (
  `id_sessao` int(11) NOT NULL,
  `sala_sessao` int(11) DEFAULT NULL,
  `filme_sessao` int(11) DEFAULT NULL,
  `data_sessao` varchar(50) DEFAULT NULL,
  `hora_sessao` varchar(50) DEFAULT NULL,
  `estado_sessao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sessao`),
  KEY `FK_sessoes_salas` (`sala_sessao`),
  KEY `FK_sessoes_filmes` (`filme_sessao`),
  KEY `FK_sessoes_estadodasessao` (`estado_sessao`),
  CONSTRAINT `FK_sessoes_estadodasessao` FOREIGN KEY (`estado_sessao`) REFERENCES `estadodasessao` (`id_estado_sessao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sessoes_filmes` FOREIGN KEY (`filme_sessao`) REFERENCES `filmes` (`codigo_filme`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_sessoes_salas` FOREIGN KEY (`sala_sessao`) REFERENCES `salas` (`codigo_salas`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.sessoes: ~0 rows (approximately)
DELETE FROM `sessoes`;
INSERT INTO `sessoes` (`id_sessao`, `sala_sessao`, `filme_sessao`, `data_sessao`, `hora_sessao`, `estado_sessao`) VALUES
	(1, 1, 1, '2012-01-01', '23:22', 1);

-- Dumping structure for table cineskills.tiposdefilme
DROP TABLE IF EXISTS `tiposdefilme`;
CREATE TABLE IF NOT EXISTS `tiposdefilme` (
  `id_tipo_filme` int(11) NOT NULL,
  `descricao_tipo_filme` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_filme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table cineskills.tiposdefilme: ~4 rows (approximately)
DELETE FROM `tiposdefilme`;
INSERT INTO `tiposdefilme` (`id_tipo_filme`, `descricao_tipo_filme`) VALUES
	(1, 'Ação'),
	(2, 'Aventura'),
	(3, 'Romance');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
