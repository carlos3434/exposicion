# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.10.10 (MySQL 5.7.27-0ubuntu0.18.04.1)
# Database: exposicion
# Generation Time: 2019-12-08 16:00:51 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table universidades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `universidades`;

CREATE TABLE `universidades` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_publica` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `universidades` WRITE;
/*!40000 ALTER TABLE `universidades` DISABLE KEYS */;

INSERT INTO `universidades` (`id`, `name`, `is_publica`, `created_at`, `updated_at`)
VALUES
	(1,'Universidad Nacional Mayor de San Marcos - UNMSM',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(2,'Universidad Nacional San Antonio Abad del Cusco - UNSAAC',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(3,'Universidad Nacional de Trujillo - UNT',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(4,'Universidad Nacional de San Agustín',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(5,'Universidad Nacional de Ingeniería ',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(6,'Universidad Nacional San Luis Gonzaga de Ica ',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(7,'Universidad Nacional San Cristobal de Huamanga',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(8,'Universidad Nacional del Centro del Perú',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(9,'Universidad Nacional Agraria La Molina ',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(10,'Universidad Nacional de La Amazonía Peruana',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(11,'Universidad Nacional del Altiplano',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(12,'Universidad Nacional de Piura',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(13,'Universidad Nacional de Cajamarca',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(14,'Universidad Nacional Pedro Ruiz Gallo',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(15,'Universidad Nacional Federico Villarreal',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(16,'Universidad Nacional Hermilio Valdizán',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(17,'Universidad Nacional Agraria de la Selva',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(18,'Universidad Nacional Daniel Alcides Carrión',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(19,'Universidad Nacional de Educación Enrique Guzman y Valle',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(20,'Universidad Nacional del Callao',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(21,'Universidad Nacional José Faustino Sanchez Carrión',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(22,'Universidad Nacional Jorge Basadre Grohmann',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(23,'Universidad Nacional Santiago Antúnez de Mayolo',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(24,'Universidad Nacional de San Martín',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(25,'Universidad Nacional de Ucayali',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(26,'Universidad Nacional de Tumbes',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(27,'Universidad Nacional del Santa',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(28,'Universidad Nacional de Huancavelica',1,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(29,'P.U. Católica del Perú',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(30,'U. Peruana Cayetano Heredia',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(31,'U. Católica Santa María',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(32,'U. del Pacífico',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(33,'U. de Lima',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(34,'U. de San Martín de Porres',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(35,'U. Femenina del Sagrado Corazón',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(36,'U. Inca Garcilaso de la Vega',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(37,'U. de Piura',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(38,'U. Ricardo Palma',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(39,'U. Andina Néstor Cáceres Velásquez',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(40,'U. Peruana los Andes',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(41,'U. Peruana Unión',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(42,'U. Andina del Cusco',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(43,'U. de Huánuco',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(44,'U. P. Tecnológica de los Andes',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(45,'U. P. de Tacna',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(46,'U. P. de Chiclayo',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(47,'U. P. San Pedro',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(48,'U. P. Antenor Orrego',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(49,'U. P. Marcelino Champagnat',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(50,'U. José Carlos Mariátegui',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(51,'U. Científica del Perú',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(52,'U. P. César Vallejo',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(53,'U. P. del Norte',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(54,'U. Peruana de Ciencias Aplicadas',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(55,'U. Catolica los Ángeles de Chimbote',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(56,'U. P. San Ignacio de Loyola',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(57,'U. Alas Peruanas',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(58,'U. P. Norbert Wienner',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(59,'U. Católica San Pablo',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(60,'U. P. San Juan Bautista',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(61,'U. Tecnológica del Perú',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(62,'U. Científica del Sur',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(63,'U. Continental de Ciencia e Ingeniería',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(64,'U. Católica Santo Toribio de Mogrovejo',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(65,'U. P. Antonio Guillermo Urrelo',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(66,'U. P. Señor de Sipán',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(67,'U. Católica Sedes Sapientiae',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(68,'Universidad ESAN',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(69,'Facultad de Teología Pontificia y Civil de Lima',0,'2019-08-21 10:57:12','2019-08-21 10:57:12'),
	(70,'U. Peruana de las Américas',0,'2019-08-21 10:57:12','2019-08-21 10:57:12');

/*!40000 ALTER TABLE `universidades` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
