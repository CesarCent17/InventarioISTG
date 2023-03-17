/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.22-MariaDB : Database - inventorioistg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventorioistg` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `inventorioistg`;

/*Table structure for table `area_ubicacion` */

DROP TABLE IF EXISTS `area_ubicacion`;

CREATE TABLE `area_ubicacion` (
  `id` int(11) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `area_ubicacion` */

insert  into `area_ubicacion`(`id`,`direccion`) values (1,'COORDINACION DE MARKETING'),(3,'BIBLIOTECA'),(4,'AUDITORIO'),(5,'SALA DE DOCENTES');

/*Table structure for table `campus` */

DROP TABLE IF EXISTS `campus`;

CREATE TABLE `campus` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `campus` */

insert  into `campus`(`id`,`nombre`,`direccion`) values (1,'PINO YCAZA','Atarazana'),(2,'COLEGIO GUAYAQUIL','Av. Machala y Carlos Gómez Rendón, Guayaquil, Ecuador.'),(3,'CMI','Av. Quito entre Luis Urdaneta y Padre Solano');

/*Table structure for table `cargo` */

DROP TABLE IF EXISTS `cargo`;

CREATE TABLE `cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `cargo` */

insert  into `cargo`(`id`,`descripcion`) values (1,'GESTOR ADMINISTRATIVO'),(2,'COORDINADOR');

/*Table structure for table `codigo_institucion` */

DROP TABLE IF EXISTS `codigo_institucion`;

CREATE TABLE `codigo_institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_institucion` (`id_institucion`),
  CONSTRAINT `fk_institucion` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8;

/*Data for the table `codigo_institucion` */

insert  into `codigo_institucion`(`id`,`codigo`,`id_institucion`) values (102,'ISTG-GYE-00000001',1),(103,'ISTG-GYE-00000002',1),(104,'ISTG-GYE-00000003',1),(105,'ISTG-GYE-00000004',1),(109,'gdsgdsgsgs',1);

/*Table structure for table `codigo_producto` */

DROP TABLE IF EXISTS `codigo_producto`;

CREATE TABLE `codigo_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_codigo_institucion` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_codigo_institucion` (`id_codigo_institucion`),
  KEY `fk_producto` (`id_producto`),
  CONSTRAINT `fk_codigo_institucion` FOREIGN KEY (`id_codigo_institucion`) REFERENCES `codigo_institucion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

/*Data for the table `codigo_producto` */

insert  into `codigo_producto`(`id`,`id_codigo_institucion`,`id_producto`) values (81,102,83),(82,103,84),(83,104,85),(84,105,86);

/*Table structure for table `custodio` */

DROP TABLE IF EXISTS `custodio`;

CREATE TABLE `custodio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `id_custodio_cargo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_custodio_cargo` (`id_custodio_cargo`),
  CONSTRAINT `fk_custodio_cargo` FOREIGN KEY (`id_custodio_cargo`) REFERENCES `custodio_cargo` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `custodio` */

insert  into `custodio`(`id`,`nombre`,`apellido`,`id_custodio_cargo`) values (1,'FATIMA','YCAZA',1),(2,'JOHANNA','PEREZ',NULL),(3,'ARMANDO','SALAZAR',NULL),(4,'FANNY','GANSINO',NULL),(5,'ERICKA','HENRIQUEZ',NULL),(6,'MELLISA','VILCHES',NULL);

/*Table structure for table `custodio_cargo` */

DROP TABLE IF EXISTS `custodio_cargo`;

CREATE TABLE `custodio_cargo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_custodio` int(11) DEFAULT NULL,
  `id_cargo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cargo` (`id_cargo`),
  KEY `fk_id_custodio` (`id_custodio`),
  CONSTRAINT `fk_cargo` FOREIGN KEY (`id_cargo`) REFERENCES `cargo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_id_custodio` FOREIGN KEY (`id_custodio`) REFERENCES `custodio` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `custodio_cargo` */

insert  into `custodio_cargo`(`id`,`id_custodio`,`id_cargo`) values (1,1,2),(2,4,1);

/*Table structure for table `estado_de_uso` */

DROP TABLE IF EXISTS `estado_de_uso`;

CREATE TABLE `estado_de_uso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `estado_de_uso` */

insert  into `estado_de_uso`(`id`,`estado`) values (1,'EN USO'),(2,'EN CARTON');

/*Table structure for table `estado_fisico` */

DROP TABLE IF EXISTS `estado_fisico`;

CREATE TABLE `estado_fisico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `estado_fisico` */

insert  into `estado_fisico`(`id`,`estado`) values (1,'BUENO'),(2,'MALO'),(3,'REGULAR');

/*Table structure for table `institucion` */

DROP TABLE IF EXISTS `institucion`;

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `institucion` */

insert  into `institucion`(`id`,`nombre`) values (1,'ISTG'),(2,'SENESCYT/SECAP/COLEGIO');

/*Table structure for table `origen_del_bien` */

DROP TABLE IF EXISTS `origen_del_bien`;

CREATE TABLE `origen_del_bien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `origen` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `origen_del_bien` */

insert  into `origen_del_bien`(`id`,`origen`) values (1,'DONADO'),(2,'PRESTADO'),(3,'SENESCYT');

/*Table structure for table `proceso_de_adquisicion` */

DROP TABLE IF EXISTS `proceso_de_adquisicion`;

CREATE TABLE `proceso_de_adquisicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proceso` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `proceso_de_adquisicion` */

insert  into `proceso_de_adquisicion`(`id`,`proceso`) values (1,'DONACION FATIMA YCAZA'),(2,'DONACION FREDDY INTRIAGO'),(3,'DONACIÓN JANETH NOROÑA'),(4,'DONACION DE SENESCYT'),(5,'PRESTAMO COLEGIO PINO YCAZA'),(6,'DONACION COLEGIO GUAYAQUIL'),(7,'DONACION LOBELIA CISNEROS'),(8,'DONACION DE ESTUDIANTES'),(9,'DONACION IESS'),(10,'DONACION LUCIANO TERAN');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `acta_de_donacion` tinyint(1) DEFAULT NULL,
  `#_acta` varchar(4) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `id_campus` int(11) DEFAULT NULL,
  `id_area_ubicacion` int(11) DEFAULT NULL,
  `id_origen_del_bien` int(11) DEFAULT NULL,
  `id_custodio` int(11) DEFAULT NULL,
  `id_proceso_de_adquisicion` int(11) DEFAULT NULL,
  `id_estado_de_uso` int(11) DEFAULT NULL,
  `id_estado_fisico` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campus` (`id_campus`),
  KEY `fk_area_ubicacion` (`id_area_ubicacion`),
  KEY `fk_origen_del_bien` (`id_origen_del_bien`),
  KEY `fk_custodio` (`id_custodio`),
  KEY `fk_proceso_de_adquisicion` (`id_proceso_de_adquisicion`),
  KEY `fk_estado_de_uso` (`id_estado_de_uso`),
  KEY `fk_estado_fisico` (`id_estado_fisico`),
  KEY `fk_id_usuario` (`id_usuario`),
  CONSTRAINT `fk_area_ubicacion` FOREIGN KEY (`id_area_ubicacion`) REFERENCES `area_ubicacion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_campus` FOREIGN KEY (`id_campus`) REFERENCES `campus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_custodio` FOREIGN KEY (`id_custodio`) REFERENCES `custodio` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estado_de_uso` FOREIGN KEY (`id_estado_de_uso`) REFERENCES `estado_de_uso` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estado_fisico` FOREIGN KEY (`id_estado_fisico`) REFERENCES `estado_fisico` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_origen_del_bien` FOREIGN KEY (`id_origen_del_bien`) REFERENCES `origen_del_bien` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_proceso_de_adquisicion` FOREIGN KEY (`id_proceso_de_adquisicion`) REFERENCES `proceso_de_adquisicion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

insert  into `producto`(`id`,`nombre`,`descripcion`,`observaciones`,`acta_de_donacion`,`#_acta`,`año`,`id_campus`,`id_area_ubicacion`,`id_origen_del_bien`,`id_custodio`,`id_proceso_de_adquisicion`,`id_estado_de_uso`,`id_estado_fisico`,`fecha_registro`,`id_usuario`) values (83,'ARCHIVADOR AEREO','ARCHIVADOR AEREO METALICO C/AZUL',NULL,1,'70',NULL,1,1,1,NULL,1,1,1,'2023-03-17 12:42:02',7),(84,'DISPENSADOR DE AGUA ','DISPENSADOR DE AGUA MARCA SMC',NULL,1,'71',NULL,1,1,1,NULL,2,1,1,'2023-03-17 12:43:44',7),(85,'ROUTER','ROUTER  MARCA D-LINK COLOR NEGRO SERIE RZSQ2HB000630',NULL,1,'55',2018,1,1,1,NULL,NULL,NULL,NULL,'2023-03-17 12:45:08',7),(86,'SILLON','SILLON CINCO GARRUCHAS COLOR NEGRO','ACTA ENTREGA RECEPCION DE BIENES ENTRE LA DIRECCION DISTRITAL 09D06 EDUCACION Y EL INSTITUTO TECNOLOGICO SUPERIOR GUAYAQUIL 1 DE MARZO DEL 2019',NULL,NULL,NULL,1,1,NULL,NULL,NULL,NULL,NULL,'2023-03-17 12:47:00',7);

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

insert  into `rol`(`id`,`descripcion`) values (1,'Administrador'),(2,'Usuario General');

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `cedula` varchar(10) DEFAULT NULL,
  `contraseña` varchar(120) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  `id_usuario_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellido`,`cedula`,`contraseña`,`email`,`activo`,`id_usuario_rol`) values (6,'test','test','test','$2y$10$pZ0nJ0QhyNTCnrr0tNqPzOcX7YHjspFvUdsqdxD3Sj/teJtbSQ02S','cesarcent17@outlook.com',1,1),(7,'root','root','root','$2y$10$BfiyRByPZy0vtAPiGa0Hg.G/4JFLjQKE99bn9PSvtqHDfZ7ei2fWK','root@gmail.com',1,2);

/*Table structure for table `usuario_rol` */

DROP TABLE IF EXISTS `usuario_rol`;

CREATE TABLE `usuario_rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuario` (`id_usuario`),
  KEY `fk_rol` (`id_rol`),
  CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `usuario_rol` */

insert  into `usuario_rol`(`id`,`id_usuario`,`id_rol`) values (1,6,2),(2,7,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
