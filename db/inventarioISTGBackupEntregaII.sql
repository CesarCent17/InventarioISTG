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

/*Table structure for table `administrador` */

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE `administrador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) DEFAULT NULL,
  `apellido` varchar(60) DEFAULT NULL,
  `cedula` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `administrador` */

insert  into `administrador`(`id`,`nombre`,`apellido`,`cedula`) values (1,'MÓNICA MERCEDES','MERINO MOROCHO','0911504579'),(2,'FANY MARIBEL','GANSINO MIRANDA','0921229050'),(3,'HUGO ALFREDO','AGUILAR PÉREZ','0917766313');

/*Table structure for table `area_ubicacion` */

DROP TABLE IF EXISTS `area_ubicacion`;

CREATE TABLE `area_ubicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `area_ubicacion` */

insert  into `area_ubicacion`(`id`,`direccion`) values (1,'COORDINACION DE MARKETING'),(2,'BIBLIOTECA'),(3,'AUDITORIO'),(4,'SALA DE DOCENTES');

/*Table structure for table `campus` */

DROP TABLE IF EXISTS `campus`;

CREATE TABLE `campus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

/*Data for the table `campus` */

insert  into `campus`(`id`,`nombre`,`direccion`) values (2,'COLEGIO GUAYAQUIL','Av. Machala y Carlos Gómez Rendón, Guayaquil, Ecuador.'),(3,'CMI','Av. Quito entre Luis Urdaneta y Padre Solano, Guayaquil, Ecuador. '),(55,'PINO YCAZA','Atarazana');

/*Table structure for table `codigo_institucion` */

DROP TABLE IF EXISTS `codigo_institucion`;

CREATE TABLE `codigo_institucion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(200) DEFAULT NULL,
  `id_institucion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_institucion` (`id_institucion`),
  CONSTRAINT `fk_institucion` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

/*Data for the table `codigo_institucion` */

insert  into `codigo_institucion`(`id`,`codigo`,`id_institucion`) values (177,'ISTG-GYE-00000001',1);

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
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

/*Data for the table `codigo_producto` */

insert  into `codigo_producto`(`id`,`id_codigo_institucion`,`id_producto`) values (156,177,155);

/*Table structure for table `custodio` */

DROP TABLE IF EXISTS `custodio`;

CREATE TABLE `custodio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varbinary(10) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`cedula`),
  UNIQUE KEY `unique_cedula` (`cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=504 DEFAULT CHARSET=utf8;

/*Data for the table `custodio` */

insert  into `custodio`(`id`,`cedula`,`nombre`,`apellido`) values (330,'0913002218','EDISON DARWIN','ACEBO CRIOLLO'),(331,'0911831113','FANNY TERESA','AGUILAR BALSECA'),(332,'0917766313','HUGO ALFREDO','AGUILAR PEREZ'),(333,'0920448800','GEOVANNY ARTURO','AGUIRRE BURGOS'),(334,'1103943526','MAYRA MERCEDES','AGUIRRE SAAVEDRA'),(335,'0702137084','ROSA AMAVILIA','AJILA FREIRE'),(336,'0925695280','LOURDES ARELIS','ALARCON SÁNCHEZ'),(337,'0927526616','YADIRA LISBETH','ALAVA LOPEZ'),(338,'0915864524','ANDY EFRAÍN','ALBAN CHANG'),(339,'0920446879','TATIANA MABEL','ALCÍVAR MALDONADO'),(340,'0924001076','RONALD RUPERTO','ÁLVAREZ CASTRO'),(341,'0908117898','IVÁN ERNESTO','AMAT DIAZ'),(342,'0921933560','PATRICIA IVETTE','ANCHUNDIA MESTANZA'),(343,'0930044888','EDGAR OLMEDO','ANDRADE ESPIN'),(344,'0920078904','JENNIFER KATHERINE','ANGULO TOAZA'),(345,'0912607199','CHRISTIAN ROBERTO','ANTON CEDEÑO'),(346,'0911390441','OSCAR OMAR','APOLINARIO ARZUBE'),(347,'0919586271','GALO DANNY','ARTEAGA MEDINA'),(348,'0915583314','BYRON OMAR','ASENCIO RODRIGUEZ'),(349,'0913617692','MARTHA ALEXANDRA','ASPIAZU ESPINOZA'),(350,'0924337801','MIGUEL ALEJANDRO','AUCANCELA LORENTY'),(351,'0911396406','RUTH OBDULIA','BAIDAL TIRCIO'),(352,'0926166299','VERA GEANCARLO','BAJAÑA'),(353,'0919741603','ANTONIO JOFFRE','BAQUE SOLIS'),(354,'0914906474','GLADYS BEATRIZ','BAZURTO ZAMBRANO'),(355,'0930956792','DIEGO ISAAC','BETANCOURT ANANGONO'),(356,'1203461544','JESSICA JANINA','CABEZAS QUINTO'),(357,'0920143666','MARLON ADRIAN','CALDERON GAVILANES'),(358,'0920840063','CHARLES JESUS','CALI NAJERA'),(359,'0921683991','ISABELA MARÍA','CAÑARTE CABRERA'),(360,'0924494669','CRISTHIAN FABIAN','CARREÑO ARCE'),(361,'0915228621','CARLOS XAVIER','CARRIEL GARCÍA'),(362,'0923590814','VERONICA ANDREA','CASTRO DEL PEZO'),(363,'0916030729','JESSICA KATHERINE','CASTRO SORIANO'),(364,'0910351048','ERWIN MARC','CAZAR TROYA'),(365,'1310825011','TERESA MONSERRATE','CEDEÑO IBARRA'),(366,'0918326794','JONATHAN RICARDO','CEDILLO QUITO'),(367,'0956319404','JEAN PIERRE','CHAVEZ MATAMOROS'),(368,'0923376396','LIGIA MARGARITA','CHELE GALARZA'),(369,'1308963105','LUIS ALBERTO','CONSTANTE NAVARRO'),(370,'0922078746','ANDREA YULIANA','CORRAL RUIZ'),(371,'0914625983','WUALTER GERMAN','CRIOLLO PORTILLA'),(372,'0912350485','MÓNICA ALICIA','CRUZ NARANJO'),(373,'0920246410','CHRISTIAN LEOPOLDO','CRUZ OCHOA'),(374,'0940578727','KEVIN DAVID','CRUZ PAZMIÑO'),(375,'0912499324','JOSE LEONARDO','CUADRADO GAGÑAY'),(376,'0925680662','JULIO ADRIAN','DEL POZO VISCARRA'),(377,'0916996184','RONNIE CESAR','DIAZ SORIANO'),(378,'0911524445','ANDRES EDUARDO','ERAZO HERRERA'),(379,'0923046346','JORGE TARQUINO','ERAZO RIVERA'),(380,'0908726342','YURY GALO','ESPINOZA BUSTAMANTE'),(381,'1206948323','KARLA PATRICIA','FELIX RIPALDA'),(382,'0921975694','FRANKLIN FARIED','FREIRE FAJARDO'),(383,'0926223223','ANDERSON FRANCISCO','FREIRE GAIBOR'),(384,'0922217427','FRANKLIN ANTONIO','GALLEGOS ERAZO'),(385,'1205811761','BLANCA ELENA','GALLEGOS ZURITA'),(386,'0921229050','FANNY MARIBEL','GANSINO MIRANDA'),(387,'1711729457','SERGIO DARIO','GARCIA ESCOBAR'),(388,'0925168767','HENRRY NICOLAS','GAVILANES GOMEZ'),(389,'0917743726','SOLANGE MARÍA','GÓMEZ SALTOS'),(390,'0918059734','MARIA FERNANDA','GONZALEZ VILLAGOMEZ'),(391,'0952591121','EVELYN ANDREA','GUAÑO CARBO'),(392,'0803158104','LURDES SABRINA','GUDIÑO GOMEZ'),(393,'0914205372','CESAR ULPIANO','GUERRA TEJADA'),(394,'0926529827','JOSÉ LUIS','HAZ VALERO'),(395,'0909051021','JULIO MIGUEL','HERAS RAMÍREZ'),(396,'0924356264','CHRISTIAN GEOVANNY','HOLGUIN BRITO'),(397,'0940192800','JOSUE ISRAEL','HUNGRIA REGALADO'),(398,'0915781579','PAOLA PATRICIA','JARAMILLO ALCIVAR'),(399,'0930782172','GUSTAVO ANTONIO','LA MOTA TERRANOVA'),(400,'0921340444','DEL ROCIO','LEON ESCOBAR DANEY'),(401,'0915336085','NELSON JOSÉ','LOGROÑO VIVANCO'),(402,'0920833076','NELIER YARAZETH','LÓPEZ FRANCO'),(403,'0924000011','LORENA ISABEL','LUCERO GONZALEZ'),(404,'0941786220','JOSUE ARMANDO','MANTUANO VERA'),(405,'0910399617','MARIA ELENA','MARRIOTT BARRETO'),(406,'0917707960','LUCIA ALEXANDRA','MENDEZ SIBRI'),(407,'0915693758','CÉSAR HUMBERTO','MEDINA ARAGUNDY'),(408,'0919372169','MARTHA LUCRECIA','MEDINA MICOLTA'),(409,'0918851825','JUAN JOSÉ','MENDOZA COBEÑA'),(410,'0924140965','GRACE NATHALIE','MENDOZA ROCAFUERTE'),(411,'0911504579','MONICA MERCEDES','MERINO MOROCHO'),(412,'0917747966','RICARDO DANIEL','MOLESTINA ALVAREZ'),(413,'0924905136','MARIA FERNANDA','MORALES TOURIZ'),(414,'0917404444','MARIA ALEXANDRA','MORENO CAMPOVERDE'),(415,'0950071613','SHIRLEY DENISSE','NARANJO CRIOLLO'),(416,'0909073876','DEL CARMEN','NARANJO SANCHEZ MARIA'),(417,'0911703379','MARCELO EFRAIN','NARVAEZ MOYANO'),(418,'0917336430','CHRISTIAN LEONARDO','NIEVES MENDEZ'),(419,'0919529727','ROXANA KATHERINE','ORDOÑEZ ORELLANA'),(420,'1713425617','LUIS ALBERTO','ORTEGA VEGA'),(421,'1311573867','VICTOR HUGO','PADILLA FARIAS'),(422,'0916302003','JOFFRE RUPERTO','PALADINES RODRIGUEZ'),(423,'0920420221','JOHN GUILLERMO','PALOMEQUE AVILA'),(424,'0911928380','JANET PATRICIA','PANTOJA RODRIGUEZ'),(425,'1311438459','ANDREA JOHANA','PARRALES LOOR'),(426,'0930077631','DEL ROCIO','PARRALES RODRIGUEZ VIVIANA'),(427,'0918432618','CARLOS LUIS','PAZMIÑO PALMA'),(428,'0922925342','DE JESUS','PEÑA PIGUAVE PAUL'),(429,'0922048855','JOHANNA ELIZABETH','PEREZ JARAMILLO'),(430,'0930342282','HARLYN STEVEN','PICHARDO ORDOÑEZ'),(431,'0918492273','RENATTO ANDRES','PIGUAVE HOLGUIN'),(432,'0920515632','VIVIANA FABIOLA','PINOS MEDRANO'),(433,'0925120164','ALEXIS KATHERINE','PIZARRO QUINDE'),(434,'0922255484','JESSICA JOHANNA','PLUAS BURGOS'),(435,'0928282797','LAURA LUCIA','PRECIADO SANDOVAL'),(436,'0917420762','TATIANA IVETTE','QUIMI LING'),(437,'0914816756','JORGE AURELIO','QUIROZ DIAZ'),(438,'0908967607','HOMERO LUDENFORFF','RECALDE URDIALES'),(439,'0910552280','ANA LUISA','REGALADO VARGAS'),(440,'0927124222','JOSE LUIS','RENDON ORTIZ'),(441,'0924724248','RONALD TOMAS','RIVAS FERNANDEZ'),(442,'0913623906','BUCHNER CRANFOD','RIVERA CAVAGNA'),(443,'0910846153','ELENA HERMELINDA','ROBLES LOZANO'),(444,'0931033880','GENESIS BELEN','ROBLES MEDINA'),(445,'0914166772','JIMMY ENRIQUE','RODRÍGUEZ CASTRO'),(446,'0917650145','ALEX LEONEL','RODRIGUEZ BORBOR'),(447,'0911976959','MARTHA JOHANNA','RODRIGUEZ ESTRELLA'),(448,'0915650097','LUIS FERNANDO','ROMERO VERA'),(449,'1309004370','ÁNGEL GUSTAVO','ROMERO CEDEÑO'),(450,'0918873217','LISSETT VERONICA','RONDOY COELLO'),(451,'0925795874','MARIA ELENA','RUIZ SALAZAR'),(452,'0919373043','ARMANDO ANDRÉS','SALAZAR ALVARADO'),(453,'0916400286','GALO ALBERTO','SALCEDO GUTIERREZ'),(454,'0918130436','FLORA VIVIANA','SALGADO ORDOÑEZ'),(455,'0912732146','SILVIA LORENA','SALINAS FALQUEZ'),(456,'0302144159','ESTEFANI ANGELICA','SANCHEZ MORALES'),(457,'0910889369','JOHNNY HILLER','SIGUENCIA CARRION'),(458,'0750074122','NATHALY KATIUSCA','SILVA CORREA'),(459,'0918361023','JOSE VICENTE','SIMBAÑA CEVALLOS'),(460,'0917817728','DEL CARMEN','SOLEDISPA QUIMIS VIVIANA'),(461,'0910845882','GRACIELA CELEDONIA','SOSA BUENO'),(462,'0911291094','MORENO YAZMINA','SOSA'),(463,'1103717854','RICARDO ALONSO','SOTO JARAMILLO'),(464,'0706114253','ANGEL JOSUE','SOTOMAYOR PAZMINO'),(465,'0909343543','FERNANDO ISAAC','SUÉSCUM GUEVARA'),(466,'0922648951','FELIX ROBERTO','TAMAYO CHOEZ'),(467,'0915101620','JOSE LUIS','TAPIA LOPEZ'),(468,'0919705020','JESSICA ALEXANDRA','TAPIA SORIA'),(469,'0923352074','RICHARD MIGUEL','TIGRERO CONTRERAS'),(470,'0915069850','WILLIAM GIOVANNY','TORRES SAMANIEGO'),(471,'0914587043','JIMMY ALFREDO','TOTOY BENITES'),(472,'0909799306','ANA ROSA','TROYA ALVARADO'),(473,'0920433083','CARLA NEREIDA','UTTERMAN MUÑOZ'),(474,'0919213561','MARIANA POLA','VALDEZ CASTILLO'),(475,'0958249682','GLEN ENRIQUE','VALLEJO MACANCELA'),(476,'0908910052','CARLOS ARMANDO','VASCONEZ CLAUDETT'),(477,'1204102907','ANGEL HUMBERTO','VELOZ RODRIGUEZ'),(478,'0915353478','MARÍA EMILIA','VERA BANEGAS'),(479,'0921006862','VERONICA TERESA','VERA CABRERA'),(480,'0919367292','MARIA VANESSA','VERA CEVALLOS'),(481,'0916871379','ERICKA JAZMIN','VERA MARIDUEÑA'),(482,'0950691436','SARA ELIZABETH','VERDESOTO YANEZ'),(483,'0923273429','MELISSA ISABEL','VILCHES CAMPOZANO'),(484,'0918326190','ROBERTO JOSE','ZURITA DEL POZO'),(485,'0909173247','ALMA ROSA','ZEBALLOS PROAÑO'),(486,'0927741090','KARLA MISHELLE','SALAZAR LOPEZ');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `origen_del_bien` */

insert  into `origen_del_bien`(`id`,`origen`) values (1,'DONADO'),(2,'PRESTADO'),(3,'SENESCYT'),(4,'SECAP');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `observaciones` varchar(250) DEFAULT NULL,
  `#_acta` varchar(4) DEFAULT NULL,
  `proceso_de_adquisicion` varchar(80) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `id_campus` int(11) DEFAULT NULL,
  `id_area_ubicacion` int(11) DEFAULT NULL,
  `id_origen_del_bien` int(11) DEFAULT NULL,
  `id_custodio` int(11) DEFAULT NULL,
  `id_estado_de_uso` int(11) DEFAULT NULL,
  `id_estado_fisico` int(11) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `oculto` tinyint(1) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_administrador` int(11) DEFAULT NULL,
  `id_tipo_acta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_campus` (`id_campus`),
  KEY `fk_area_ubicacion` (`id_area_ubicacion`),
  KEY `fk_origen_del_bien` (`id_origen_del_bien`),
  KEY `fk_custodio` (`id_custodio`),
  KEY `fk_estado_de_uso` (`id_estado_de_uso`),
  KEY `fk_estado_fisico` (`id_estado_fisico`),
  KEY `fk_id_usuario` (`id_usuario`),
  KEY `fk_administrador` (`id_administrador`),
  KEY `fk_tipo_acta` (`id_tipo_acta`),
  CONSTRAINT `fk_administrador` FOREIGN KEY (`id_administrador`) REFERENCES `administrador` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_area_ubicacion` FOREIGN KEY (`id_area_ubicacion`) REFERENCES `area_ubicacion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_custodio` FOREIGN KEY (`id_custodio`) REFERENCES `custodio` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estado_de_uso` FOREIGN KEY (`id_estado_de_uso`) REFERENCES `estado_de_uso` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_estado_fisico` FOREIGN KEY (`id_estado_fisico`) REFERENCES `estado_fisico` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_origen_del_bien` FOREIGN KEY (`id_origen_del_bien`) REFERENCES `origen_del_bien` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_tipo_acta` FOREIGN KEY (`id_tipo_acta`) REFERENCES `tipo_acta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

/*Data for the table `producto` */

insert  into `producto`(`id`,`nombre`,`descripcion`,`observaciones`,`#_acta`,`proceso_de_adquisicion`,`año`,`id_campus`,`id_area_ubicacion`,`id_origen_del_bien`,`id_custodio`,`id_estado_de_uso`,`id_estado_fisico`,`fecha_registro`,`oculto`,`id_usuario`,`id_administrador`,`id_tipo_acta`) values (155,'ARCHIVADOR AEREO','ARCHIVADOR AEREO METALICO C/AZUL','','70','DONACION FATIMA YCAZA',NULL,55,1,1,NULL,1,1,'2023-03-25 12:18:02',1,19,NULL,11);

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `rol` */

insert  into `rol`(`id`,`descripcion`) values (1,'Administrador'),(2,'Usuario General');

/*Table structure for table `tipo_acta` */

DROP TABLE IF EXISTS `tipo_acta`;

CREATE TABLE `tipo_acta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `tipo_acta` */

insert  into `tipo_acta`(`id`,`descripcion`) values (11,'ACTA DE DONACIÓN'),(12,'ACTA DE ENTREGA');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`apellido`,`cedula`,`contraseña`,`email`,`activo`,`id_usuario_rol`) values (17,'Mónica Mercedes','Merino Morocho','0911504579','$2y$10$vV.hLyKzmosTktwXJmNLp.qBU5gAPnbxsYU9dHJbTvsN43B9vD9tO','',1,8),(18,'Fany Maribel','Gansino Miranda','0921229050','$2y$10$hMAARxO87BDeJVEWM2dViO2ve7nGQX9uFTYsIo97vYyyJzg37RuKO','',1,9),(19,'Mayra','Aguirre Saavedra','1103943526','$2y$10$3kkkfG2VGlsSEalpxGIwb.Mihx82MbpAApayiM3pkpmNt9NeeH596','',1,10),(20,'Hugo Alfredo','Aguilar Pérez','0917766313','$2y$10$Bpr/XbUafhE/xwwr3omymuiOh8SVplNlQzsN.mvQ2e4S2.mqrrroi','',1,11);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*Data for the table `usuario_rol` */

insert  into `usuario_rol`(`id`,`id_usuario`,`id_rol`) values (8,17,2),(9,18,1),(10,19,1),(11,20,2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
