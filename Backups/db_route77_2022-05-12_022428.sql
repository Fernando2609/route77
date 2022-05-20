-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_route77
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_bitacora`
--

DROP TABLE IF EXISTS `tbl_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_bitacora` (
  `ID_BITACORA` bigint(20) NOT NULL AUTO_INCREMENT,
  `FECHA` datetime NOT NULL,
  `ID_PERSONA` bigint(20) NOT NULL,
  `ID_MODULO` bigint(20) NOT NULL,
  `ACCION` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `DESCRIPCION` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `COD_REGISTRO` bigint(20) NOT NULL,
  PRIMARY KEY (`ID_BITACORA`),
  KEY `ID_USUARIO` (`ID_PERSONA`),
  KEY `ID_MODULO` (`ID_MODULO`),
  CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`ID_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tbl_bitacora_ibfk_2` FOREIGN KEY (`ID_MODULO`) REFERENCES `tbl_modulo` (`COD_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_bitacora`
--

LOCK TABLES `tbl_bitacora` WRITE;
/*!40000 ALTER TABLE `tbl_bitacora` DISABLE KEYS */;
INSERT INTO `tbl_bitacora` VALUES (2,'2022-05-10 22:13:53',1,1,'Ingreso','Ingresó al módulo',0),(3,'2022-05-10 22:41:21',1,1,'Login','Inicio Sesión',0),(4,'2022-05-10 22:41:21',1,1,'Ingreso','Ingresó al módulo',0),(5,'2022-05-10 22:42:19',1,1,'Login','Inicio Sesión',0),(6,'2022-05-10 22:42:19',1,1,'Ingreso','Ingresó al módulo',0),(7,'2022-05-10 22:43:38',1,1,'Login','Inicio Sesión',0),(8,'2022-05-10 22:43:38',1,1,'Ingreso','Ingresó al módulo',0),(9,'2022-05-10 23:19:30',1,1,'Ingreso','Ingresó al módulo',0),(10,'2022-05-10 23:21:08',1,1,'Ingreso','Ingresó al módulo',0),(11,'2022-05-10 23:21:08',1,1,'Ingreso','Ingresó al módulo',0),(12,'2022-05-10 23:21:57',1,1,'Ingreso','Ingresó al módulo',0),(13,'2022-05-10 23:22:16',1,1,'Ingreso','Ingresó al módulo',0),(14,'2022-05-11 00:02:50',13,1,'Login','Inicio Sesión',0),(15,'2022-05-11 00:02:50',13,1,'Ingreso','Ingresó al módulo',0),(16,'2022-05-11 00:03:36',13,1,'Ingreso','Ingresó al módulo',0),(17,'2022-05-11 15:35:02',1,1,'Ingreso','Ingresó al módulo',0),(18,'2022-05-11 16:42:39',1,1,'Consulta','Consulto al Usuario',0),(19,'2022-05-11 16:42:55',1,1,'Consulta','Consulto al Usuario',0),(20,'2022-05-11 16:43:05',1,1,'Consulta','Consulto al Usuario',0),(21,'2022-05-11 16:43:12',1,1,'Consulta','Consulto al Usuario',0),(22,'2022-05-11 16:44:43',1,1,'Ingreso','Ingresó al módulo',0),(23,'2022-05-11 16:51:44',1,1,'Ingreso','Ingresó al módulo',0),(24,'2022-05-11 16:51:46',1,1,'Ingreso','Ingresó al módulo',0),(25,'2022-05-11 17:07:14',1,1,'Ingreso','Ingresó al módulo',0),(26,'2022-05-11 17:07:16',1,2,'Consulta','Consulto al UsuarioLeonela',0),(27,'2022-05-11 17:07:19',1,1,'Ingreso','Ingresó al módulo',0),(28,'2022-05-11 17:08:43',1,2,'Ingreso','Ingresó al módulo',0),(29,'2022-05-11 17:08:46',1,2,'Consulta','Consulto al UsuarioLeonela',0),(30,'2022-05-11 17:10:57',1,2,'Ingreso','Ingresó al módulo',0),(31,'2022-05-11 17:10:59',1,2,'Consulta','Consultó al Usuario Leonelaen el módulo',0),(32,'2022-05-11 17:31:31',1,2,'Consulta','Consultó al Usuario Reynaldo en el módulo',0),(33,'2022-05-11 17:34:49',1,2,'Ingreso','Ingresó al módulo',0),(34,'2022-05-11 17:35:44',1,2,'Consulta','Consultó al Usuario Leonela en el módulo',0),(35,'2022-05-11 17:50:23',1,2,'Ingreso','Ingresó al módulo',0),(36,'2022-05-11 17:51:15',1,2,'Nuevo','Agrego al Usuario  ',0),(37,'2022-05-11 17:51:20',1,2,'Nuevo','Agrego al Usuario  ',0),(38,'2022-05-11 18:14:54',1,2,'Ingreso','Ingresó al módulo',0),(39,'2022-05-11 18:15:21',1,2,'Consulta','Consultó al Usuario Leonela Pineda',0),(40,'2022-05-11 18:15:47',1,2,'Consulta','Consultó al Usuario Leonela Pineda',0),(41,'2022-05-11 18:15:48',1,2,'Update','Actualizo al Usuario Leonela Pineda',0),(42,'2022-05-11 18:17:19',1,2,'Consulta','Consultó al Usuario José Fernando Ortiz',0),(43,'2022-05-11 18:17:48',1,2,'Consulta','Consultó al Usuario Hugo Paz',0),(44,'2022-05-11 18:24:30',1,2,'Nuevo','Agrego al Usuario José Fernando Santos',0),(45,'2022-05-11 18:24:30',1,2,'Ingreso','Ingresó al módulo',0),(46,'2022-05-11 18:25:03',1,2,'Consulta','Consultó al Usuario José Fernando Santos',0),(47,'2022-05-11 18:25:11',1,2,'Update','Actualizo al Usuario Pedro Martinez Santos',0),(48,'2022-05-11 18:25:24',1,2,'Nuevo','Elimino al Usuario José Fernando Ortiz',0),(49,'2022-05-11 18:25:24',1,2,'Ingreso','Ingresó al módulo',0),(50,'2022-05-11 18:26:35',1,2,'Ingreso','Ingresó al módulo',0),(51,'2022-05-11 18:27:03',1,2,'Nuevo','Elimino al Usuario Pedro Martinez Santos',0),(52,'2022-05-11 18:27:03',1,2,'Ingreso','Ingresó al módulo',0),(53,'2022-05-11 18:46:25',1,2,'Ingreso','Ingresó al módulo',0),(54,'2022-05-11 18:46:27',1,2,'Delete','Eliminó al Usuario Pedro Martinez Santos',0),(55,'2022-05-11 18:46:27',1,2,'Ingreso','Ingresó al módulo',0),(56,'2022-05-11 20:57:41',1,2,'Ingreso','Ingresó al módulo',0),(57,'2022-05-11 21:01:21',1,3,'Ingreso','Ingresó al módulo',0),(58,'2022-05-11 21:01:36',1,3,'Consulta','Consultó al Cliente Juan Orlando Hernandez Alvarado',0),(59,'2022-05-11 21:01:49',1,3,'Consulta','Consultó al Cliente Juan Orlando Hernandez Alvarado',0),(60,'2022-05-11 21:01:51',1,3,'Update','Actualizo al Cliente Juan Orlando Hernandez Alvarado',0),(61,'2022-05-11 21:02:15',1,3,'Ingreso','Ingresó al módulo',0),(62,'2022-05-11 21:03:03',1,3,'Ingreso','Ingresó al módulo',0),(63,'2022-05-11 21:03:08',1,3,'Delete','Eliminó al Cliente Juan Orlando Hernandez Alvarado',0),(64,'2022-05-11 21:03:08',1,3,'Ingreso','Ingresó al módulo',0),(65,'2022-05-12 01:30:58',1,11,'Ingreso','Ingresó al módulo',0),(66,'2022-05-12 01:31:16',1,11,'Nuevo','Registró la Sucursal La Isla',0),(67,'2022-05-12 01:31:16',1,11,'Ingreso','Ingresó al módulo',0),(68,'2022-05-12 01:31:16',1,11,'Ingreso','Ingresó al módulo',0),(69,'2022-05-12 01:31:35',1,11,'Consulta','Consultó la Sucursal La Isla',0),(70,'2022-05-12 01:31:37',1,11,'Update','Actualizo la Sucursal La Isla',0),(71,'2022-05-12 01:31:37',1,11,'Ingreso','Ingresó al módulo',0),(72,'2022-05-12 01:32:33',1,11,'Delete','Eliminó la Sucursal ',0),(73,'2022-05-12 01:32:47',1,11,'Delete','Eliminó la Sucursal ',0),(74,'2022-05-12 01:33:05',1,11,'Ingreso','Ingresó al módulo',0),(75,'2022-05-12 01:34:33',1,11,'Nuevo','Registró la Sucursal La Isla',0),(76,'2022-05-12 01:34:33',1,11,'Ingreso','Ingresó al módulo',0),(77,'2022-05-12 01:34:33',1,11,'Ingreso','Ingresó al módulo',0),(78,'2022-05-12 01:34:36',1,11,'Delete','Eliminó la Sucursal La Isla',0),(79,'2022-05-12 01:34:36',1,11,'Ingreso','Ingresó al módulo',0),(80,'2022-05-12 02:22:08',1,11,'Ingreso','Ingresó al módulo',0),(81,'2022-05-12 02:23:28',1,11,'Ingreso','Ingresó al módulo',0),(82,'2022-05-12 02:23:49',1,11,'Ingreso','Ingresó al módulo',0),(83,'2022-05-12 02:24:12',1,16,'Ingreso','Ingresó al módulo',0);
/*!40000 ALTER TABLE `tbl_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_calendario`
--

DROP TABLE IF EXISTS `tbl_calendario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_calendario` (
  `COD_CALENDARIO` bigint(20) NOT NULL AUTO_INCREMENT,
  `COD_PERSONA` bigint(20) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `color` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `textColor` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dateModificado` datetime NOT NULL,
  PRIMARY KEY (`COD_CALENDARIO`),
  KEY `COD_PERSONA` (`COD_PERSONA`),
  CONSTRAINT `TBL_CALENDARIO_ibfk_1` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_calendario`
--

LOCK TABLES `tbl_calendario` WRITE;
/*!40000 ALTER TABLE `tbl_calendario` DISABLE KEYS */;
INSERT INTO `tbl_calendario` VALUES (4,1,'Subir Proyecto','Subir proyecto al campus virtual esta fecha','2022-04-25 00:00:00','2022-04-25 23:59:00','#0033ff','#ffffff','2022-04-09 16:19:30','2022-04-18 01:54:30'),(5,1,'Realizar Contabilidad','Realizar Contabilidad de ingresos y egresos','2022-04-30 00:00:00','2022-04-30 23:59:00','#ff24ed','#000000','2022-04-09 16:22:08','2022-04-09 16:22:49'),(7,1,'Fin del Periodo','Celebrar','2022-05-07 00:00:00','2022-05-07 23:59:00','#1468f0','#000000','2022-04-18 17:33:02','0000-00-00 00:00:00'),(8,1,'Realizar Contabilidad en Santa Lucia','Realizar Contabilidad','2022-04-16 00:45:00','2022-04-18 15:56:00','#0040ff','#ffffff','2022-04-24 21:52:40','2022-04-24 15:57:46'),(9,1,'Inversiones','Inversiones','2022-04-20 00:00:00','2022-04-20 23:59:00','#2bff00','#000000','2022-04-24 21:53:55','0000-00-00 00:00:00'),(10,1,'Cerrado','Cerrado','2022-04-06 00:00:00','2022-04-10 00:00:00','#ff4000','#ffffff','2022-04-24 21:55:20','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_calendario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoria` (
  `COD_CATEGORIA` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE CATEGORÍA',
  `COD_STATUS` int(11) DEFAULT NULL COMMENT 'CÓDIGO DEL STATUS',
  `DESCRIPCION` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN SOBRE LA CATEGORÍA',
  `NOMBRE` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DE LA CATEGORÍA',
  `PORTADA` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'UBICACIÓN DE LA IMAGEN UTILIZADA EN LA PORTADA',
  `RUTA` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CREADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DEL USUARIO QUE CREÓ LA CATEGORÍA',
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'REGISTRO DE FECHA EN LA QUE SE CREÓ LA CATEGORÍA',
  `MODIFICADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DEL ÚLTIMO USUARIO EN MODIFICAR',
  `FECHA_MODIFICACION` datetime NOT NULL COMMENT 'REGISTRO DE LA ÚLTIMA FECHA DE MODIFICACIÓN',
  PRIMARY KEY (`COD_CATEGORIA`),
  KEY `COD_STATUS` (`COD_STATUS`),
  CONSTRAINT `TBL_CATEGORIA_IBFK_1` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoria`
--

LOCK TABLES `tbl_categoria` WRITE;
/*!40000 ALTER TABLE `tbl_categoria` DISABLE KEYS */;
INSERT INTO `tbl_categoria` VALUES (1,1,'Derivados de la leche','Lacteos','img_bee4fea75cfa2a6e542b0575ad2516f2.jpg','lacteos',1,'2022-03-20 00:11:48',32,'2022-04-21 00:36:17'),(2,1,'Extenso Catálogo de Licores','Cervezas y Licores','img_50ab0b4623f1fb35934750cf73ab51ba.jpg','cervezas-y-licores',1,'2022-02-19 03:19:41',1,'2022-04-19 00:03:15'),(3,1,'Maquillaje y Cosmeticos','Maquillaje','img_ff226895a9e920ccb4f395019684731f.jpg','maquillaje',1,'2022-02-12 02:21:20',1,'2022-04-18 22:32:24'),(4,1,'Artículos del Hogar','Artículos del Hogar','img_5b59bd9c8985f1165a14152df943a677.jpg','articulos-del-hogar',1,'2022-04-18 00:34:38',1,'2022-04-19 09:48:21'),(5,1,'Frescas Y Deliciosas','Frutas Y Vegetales','img_67bcce3e9c78193a009e25370785791f.jpg','frutas-y-vegetales',1,'2022-04-18 23:47:11',0,'0000-00-00 00:00:00'),(6,1,'Pastas de Buena Calidad','Pastas','img_eec94374e5ecd6f1f4da86682cfbedba.jpg','pastas',1,'2022-04-18 23:57:01',0,'0000-00-00 00:00:00'),(7,1,'Productos para Mascotas','Mascotas','img_bec798b8d653225977def8bfd99557df.jpg','mascotas',1,'2022-04-19 00:02:50',0,'0000-00-00 00:00:00'),(8,1,'Cortes de Carne Exquisitos','Carnes','img_bae3f79bb7cb93684e0630b8583f0758.jpg','carnes',1,'2022-04-19 01:55:20',0,'0000-00-00 00:00:00'),(9,1,'¡Por el calor del verano!','Refrescos y bebidas','img_4ddf482a7563b72df4f01583cfc0838b.jpg','refrescos-y-bebidas',32,'2022-04-20 23:57:41',32,'2022-04-21 00:23:15'),(10,1,'Snacks y más','Snacks','portada_categoria.png','snacks',49,'2022-04-24 21:38:32',0,'0000-00-00 00:00:00'),(11,0,'Varios tipos de dispositivos al alcance','Electrónicos','img_7383384c8bbf02032661daffc52e216a.jpg','electronicos',1,'2022-04-24 23:14:57',1,'2022-04-26 22:08:21'),(12,1,'Electrónica','Electrónica','portada_categoria.png','electronica',1,'2022-04-26 22:09:46',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cliente` (
  `COD_CLIENTE` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE CLIENTE',
  `COD_PERSONA` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LA PERSONA',
  PRIMARY KEY (`COD_CLIENTE`),
  KEY `COD_PERSONA` (`COD_PERSONA`),
  CONSTRAINT `CLIENTE_IBFK_1` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,2),(2,14),(3,19),(12,62),(13,63),(14,64),(15,65),(16,66),(17,67),(18,68),(19,69),(20,70),(21,71),(22,72),(23,74),(24,76),(25,77),(36,92);
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contacto`
--

DROP TABLE IF EXISTS `tbl_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contacto` (
  `COD_CONTACTO` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `EMAIL` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `MENSAJE` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `IP` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `DISPOSITIVO` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL,
  `USERAGENT` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  PRIMARY KEY (`COD_CONTACTO`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contacto`
--

LOCK TABLES `tbl_contacto` WRITE;
/*!40000 ALTER TABLE `tbl_contacto` DISABLE KEYS */;
INSERT INTO `tbl_contacto` VALUES (1,'Fernando','josefortizsantos@gmail.com','HOLAAAA','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:42:38'),(2,'Fernando','josefortizsantos@gmail.com','HOLAAAA','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:44:09'),(3,'Fernando','josefortizsantos@gmail.com','HOLAAAAAAAAAAAA','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:50:21'),(4,'Fernando','josefortizsantos@gmail.com','HOLA','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:51:01'),(5,'Fernando','josefortizsantos@gmail.com','Fernadno','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:52:25'),(6,'Fernando','josefortizsantos@gmail.comh','HOLAAAAAAAA','::1','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.44','2022-04-23 02:57:34'),(7,'José Fernando Ortiz Santos','josefortizsantos@gmail.com','Hola como estas','138.94.121.240','PC','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36 Edg/100.0.1185.50','2022-04-26 08:49:20');
/*!40000 ALTER TABLE `tbl_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detalle_compra`
--

DROP TABLE IF EXISTS `tbl_detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_detalle_compra` (
  `COD_DETALLE` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL DETALLE DE COMPRA',
  `COD_ORDEN` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LA ORDEN DE COMPRA',
  `COD_PRODUCTO` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL PRODUCTO QUE SE ESTÁ COMPRANDO',
  `PRECIO` decimal(11,2) NOT NULL COMMENT 'PRECIO DEL PRODUCTO A INGRESAR',
  `CANT_COMPRA` int(11) NOT NULL COMMENT 'CANTIDAD DEL PRODUCTO A INGRESAR',
  PRIMARY KEY (`COD_DETALLE`),
  KEY `COD_ORDEN` (`COD_ORDEN`),
  KEY `COD_PRODUCTO` (`COD_PRODUCTO`),
  CONSTRAINT `TBL_DETALLE_COMPRA_IBFK_1` FOREIGN KEY (`COD_ORDEN`) REFERENCES `tbl_orden_compra` (`COD_ORDEN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_DETALLE_COMPRA_IBFK_2` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_productos` (`COD_PRODUCTO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_compra`
--

LOCK TABLES `tbl_detalle_compra` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_compra` DISABLE KEYS */;
INSERT INTO `tbl_detalle_compra` VALUES (7,5,12,18.00,48),(8,5,2,10.00,10),(9,6,1,10.00,10),(10,7,1,10.00,10),(11,8,1,20.00,100),(12,9,15,20.00,100),(13,10,15,10.00,10),(14,11,15,10.00,10),(15,12,15,10.00,10),(16,13,15,15.00,15),(17,14,1,10.00,10),(18,15,1,50.00,100),(19,15,2,20.00,150),(20,15,15,25.00,500),(21,15,14,10.00,200),(22,16,1,10.00,100),(23,18,1,10.00,100),(24,18,15,25.00,200),(25,19,2,25.00,48),(26,19,13,12.00,20),(27,19,15,23.00,20),(28,20,1,25.00,100),(29,20,2,20.00,24),(30,21,1,25.00,100),(31,21,2,20.00,24),(32,25,1,25.60,100),(33,25,2,20.12,24),(34,26,1,25.60,100),(35,26,2,20.12,24),(36,27,1,20.00,10),(37,27,2,50.00,100),(38,28,15,50.00,10),(39,29,17,20.00,20),(40,30,1,20.00,10),(41,31,21,50.00,10),(42,32,2,20.00,48),(43,32,9,60.00,10),(44,33,19,30.00,50),(45,34,20,20.00,10),(46,35,20,20.00,10),(47,36,1,20.00,20),(48,36,20,20.00,10),(49,37,21,15.00,20),(50,37,3,16.00,48),(51,38,2,30.00,10),(52,38,21,30.00,200),(53,39,10,2000.00,10),(54,40,10,2000.00,1),(55,41,13,15.00,30);
/*!40000 ALTER TABLE `tbl_detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_detalle_pedido`
--

DROP TABLE IF EXISTS `tbl_detalle_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_detalle_pedido` (
  `COD_DETALLE` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL DETALLE PEDIDO',
  `COD_PEDIDO` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL PEDIDO AL CUAL SE ASIGNA EL PRODUCTO',
  `COD_PRODUCTO` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL PRODUCTO AGREGADO AL PEDIDO',
  `PRECIO` decimal(11,2) NOT NULL COMMENT 'PRECIO DEL PRODUCTO A VENDER',
  `CANTIDAD` int(11) NOT NULL COMMENT 'CANTIDAD DEL PRODUCTO A VENDER',
  PRIMARY KEY (`COD_DETALLE`),
  KEY `COD_PEDIDO` (`COD_PEDIDO`),
  KEY `COD_PRODUCTO` (`COD_PRODUCTO`),
  CONSTRAINT `TBL_DETALLE_PEDIDO_IBFK_1` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_productos` (`COD_PRODUCTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_DETALLE_PEDIDO_IBFK_2` FOREIGN KEY (`COD_PEDIDO`) REFERENCES `tbl_pedido` (`COD_PEDIDO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_detalle_pedido`
--

LOCK TABLES `tbl_detalle_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_detalle_pedido` DISABLE KEYS */;
INSERT INTO `tbl_detalle_pedido` VALUES (10,15,1,25.00,4),(11,16,1,25.00,10),(12,17,1,25.00,4),(13,20,1,25.00,3),(14,20,12,25.00,1),(15,20,2,19.00,1),(16,21,13,65.00,10),(17,22,13,65.00,10),(18,22,12,25.00,3),(19,23,13,65.00,10),(20,23,12,25.00,3),(21,24,13,65.00,10),(22,24,12,25.00,5),(23,25,13,65.00,5),(24,25,12,25.00,10),(25,26,1,25.00,2),(26,27,1,25.00,2),(27,28,13,65.00,10),(28,29,2,19.00,3),(29,29,13,65.00,4),(30,30,2,19.00,3),(31,30,13,65.00,4),(32,31,2,19.00,3),(33,31,13,65.00,4),(34,32,2,19.00,3),(35,32,13,65.00,4),(36,33,1,25.00,4),(37,33,2,19.00,5),(38,34,12,25.00,1),(39,35,12,25.00,1),(40,36,1,25.00,1),(41,37,1,25.00,1),(42,38,1,25.00,1),(50,46,1,25.00,3),(51,46,2,19.00,6),(52,46,13,65.00,1),(53,47,12,25.00,3),(54,47,2,19.00,3),(55,48,12,25.00,6),(56,49,13,65.00,10),(57,50,12,25.00,1),(58,51,1,25.00,5),(59,52,13,65.00,3),(63,56,13,65.00,3),(64,57,1,25.00,5),(65,58,12,25.00,2),(66,59,13,65.00,2),(67,60,12,25.00,2),(68,61,12,25.00,2),(69,62,12,25.00,10),(70,67,14,15.00,5),(72,69,14,15.00,13),(73,70,14,15.00,5),(74,71,14,15.99,5),(75,72,15,23.00,10),(76,73,15,23.00,10),(77,74,15,23.00,10),(78,75,17,20.00,1),(79,76,12,22.00,10),(80,77,17,20.00,1),(81,78,2,19.00,1),(82,79,12,22.00,1),(83,80,17,20.00,1),(84,81,15,23.00,1),(85,82,17,20.00,1),(86,83,12,22.00,1),(87,83,15,23.00,3),(88,83,13,65.00,3),(89,84,15,23.00,4),(90,84,13,65.00,3),(91,85,15,23.00,2),(92,85,14,15.99,4),(93,85,13,65.00,2),(94,86,12,22.00,1),(95,86,17,20.00,1),(96,87,17,20.00,5),(97,87,14,15.99,3),(98,88,17,20.00,1),(99,88,14,15.99,2),(100,88,13,65.00,2),(101,89,2,19.00,10),(102,90,19,45.00,11),(103,91,19,45.00,3);
/*!40000 ALTER TABLE `tbl_detalle_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_empresa`
--

DROP TABLE IF EXISTS `tbl_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_empresa` (
  `COD_EMPRESA` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE EMPRESA',
  `NOMBRE_EMPRESA` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DE LA EMPRESA',
  `RAZON_SOCIAL` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'RAZÓN SOCIAL DE LA EMPRESA',
  `GERENTE_GENERAL` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DEL GERENTE GENERAL DE LA EMPRESA',
  `COSTO_ENVIO` int(11) NOT NULL,
  `RTN` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `EMAIL_PEDIDOS` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `EMAIL_EMPRESA` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `TEL_EMPRESA` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CEL_EMPRESA` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `DIRECCION_FACTURA` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CATEGORIAS_SLIDER` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CATEGORIAS_BANNER` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `PEDIDO_MINIMO` int(11) NOT NULL,
  PRIMARY KEY (`COD_EMPRESA`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_empresa`
--

LOCK TABLES `tbl_empresa` WRITE;
/*!40000 ALTER TABLE `tbl_empresa` DISABLE KEYS */;
INSERT INTO `tbl_empresa` VALUES (1,'Estación Route 77','Ser Los Mejores De Honduras','Saúl Zepeda',100,'03011972007276','estacionroutehn@gmail.com','estacionroutehn@gmail.com','+504 22634896','+504 9643-2601','Col. Los Laureles Calle Principal','3,5,4,7','2,6,8',500);
/*!40000 ALTER TABLE `tbl_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_genero`
--

DROP TABLE IF EXISTS `tbl_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_genero` (
  `COD_GENERO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE GÉNERO',
  `DESCRIPCION` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL GÉNERO DEL USUARIO A REGISTRAR',
  PRIMARY KEY (`COD_GENERO`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_genero`
--

LOCK TABLES `tbl_genero` WRITE;
/*!40000 ALTER TABLE `tbl_genero` DISABLE KEYS */;
INSERT INTO `tbl_genero` VALUES (1,'MASCULINO'),(2,'FEMENINO'),(12,'OTRO');
/*!40000 ALTER TABLE `tbl_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_img_producto`
--

DROP TABLE IF EXISTS `tbl_img_producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_img_producto` (
  `COD_IMAGEN` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE IMAGEN',
  `COD_PRODUCTO` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LOS PRODUCTOS ALMACENADOS',
  `IMG` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'UBICACIÓN DE LA IMAGEN GUARDADA',
  PRIMARY KEY (`COD_IMAGEN`),
  KEY `COD_PRODUCTO` (`COD_PRODUCTO`),
  CONSTRAINT `TBL_IMG_PRODUCTO_IBFK_1` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_productos` (`COD_PRODUCTO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_img_producto`
--

LOCK TABLES `tbl_img_producto` WRITE;
/*!40000 ALTER TABLE `tbl_img_producto` DISABLE KEYS */;
INSERT INTO `tbl_img_producto` VALUES (27,14,'pro_75b1b8a1a4a640ff3273d97413664dfa.jpg'),(28,14,'pro_1f0e9d3cd16b6c5767a2dd29eee682c7.jpg'),(29,13,'pro_270072dcdabbc969d1587f1f1ccf9ebc.jpg'),(30,13,'pro_d4d6a065aa30ec9207767f7833e5f538.jpg'),(31,12,'pro_666c58bc5899035ff737b14c70a25f47.jpg'),(45,1,'pro_5e383c4706812480701b9ec344731756.jpg'),(46,2,'pro_fa7e60289ee36a76673148cd33d04594.jpg'),(47,3,'pro_937a5ffaf6dd64899736a69affafebf7.jpg'),(48,12,'pro_6b8bb843d7f8fa06fb2451a3c8750d70.jpg'),(49,4,'pro_6243190ce1066357434a0c25455f877a.jpg'),(52,6,'pro_2599de94254a7e9918d7322de75ba120.jpg'),(53,10,'pro_2d29fe34277340b97df4678251c77fb7.jpg'),(54,11,'pro_ee49a9463e15fddc76d4817b1f397661.jpg'),(56,9,'pro_fe8f78ec194e2fc6570e30d5fdcf43d5.jpg'),(57,5,'pro_65f90863c18fa94d85a062c817ef21f4.jpg'),(58,17,'pro_8e10dce9d3cc9db30533b7b53b41a6ac.jpg'),(59,18,'pro_642d6d80e5577885cad6df5a9af581dc.jpg'),(60,15,'pro_f6c719244eaa1d77582eeef765c42c78.jpg'),(65,16,'pro_e3a2932e0db24fdcf0498eb0113ee4dd.jpg'),(68,16,'pro_b43459e239b12144a8616d3d53cfb251.jpg'),(71,19,'pro_c2e6db961c5771668382d91424a44f14.jpg'),(72,20,'pro_6820ccc2e463543ee820bef2a0ffe81e.jpg'),(73,22,'pro_e8b61d20c399fb2e324b38548bab5813.jpg'),(77,24,'pro_5c530a853f538634714c203b7824dec1.jpg'),(78,24,'pro_bff3c2de752e7df7e195094e79a79555.jpg'),(85,27,'pro_5e895e41d521b59193888b93b14ad2c6.jpg'),(86,28,'pro_4480e5157c28b016a5034458755ab008.jpg');
/*!40000 ALTER TABLE `tbl_img_producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_inventario`
--

DROP TABLE IF EXISTS `tbl_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_inventario` (
  `COD_INVENTARIO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE INVENTARIO',
  `COD_PRODUCTO` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL PRODUCTO ALMACENADO',
  `STOCK` int(11) NOT NULL COMMENT 'CANTIDAD DE PRODUCTO EN INVENTARIO',
  `CANT_VENTA` int(11) NOT NULL COMMENT 'CANTIDAD DE PRODUCTOS VENDIDOS',
  `CANT_COMPRA` int(11) NOT NULL COMMENT 'CANTIDAD DE PRODUCTO INGRESADO',
  `CANT_MINIMA` int(11) NOT NULL COMMENT 'CANTIDAD MÍNIMA PARA ENVIAR ADVERTENCIA',
  PRIMARY KEY (`COD_INVENTARIO`),
  KEY `COD_PRODUCTO` (`COD_PRODUCTO`),
  CONSTRAINT `TBL_INVENTARIO_IBFK_1` FOREIGN KEY (`COD_PRODUCTO`) REFERENCES `tbl_productos` (`COD_PRODUCTO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_inventario`
--

LOCK TABLES `tbl_inventario` WRITE;
/*!40000 ALTER TABLE `tbl_inventario` DISABLE KEYS */;
INSERT INTO `tbl_inventario` VALUES (1,2,1071,16,1105,24),(2,1,755,90,764,30),(3,3,68,0,68,24),(4,4,0,0,0,20),(5,5,0,0,0,0),(6,6,0,0,0,10),(9,9,10,0,10,10),(10,10,11,0,11,10),(11,11,0,0,0,5),(12,12,0,20,2,20),(13,13,112,2,52,100),(14,14,163,25,200,50),(15,15,735,11,745,10),(16,16,0,0,0,50),(17,17,9,6,20,20),(18,18,0,0,0,10),(19,19,36,14,50,20),(20,20,10,0,10,20),(21,21,230,0,230,20),(22,22,0,0,0,100),(23,23,0,0,0,10),(24,24,0,0,0,10),(25,25,0,0,0,10),(26,26,0,0,0,10),(27,27,0,0,0,15),(28,28,0,0,0,15);
/*!40000 ALTER TABLE `tbl_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_modulo`
--

DROP TABLE IF EXISTS `tbl_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_modulo` (
  `COD_MODULO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL MÓDULO',
  `NOMBRE` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DEL MÓDULO',
  `DESCRIPCION` text COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DE LA FUNCIÓN QUE TIENE EL MÓDULO',
  `COD_STATUS` int(11) NOT NULL COMMENT 'CÓDIGO DEL ESTATUS DEL MÓDULO',
  PRIMARY KEY (`COD_MODULO`),
  KEY `COD_STATUS` (`COD_STATUS`),
  CONSTRAINT `TBL_MODULO_IBFK_1` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_modulo`
--

LOCK TABLES `tbl_modulo` WRITE;
/*!40000 ALTER TABLE `tbl_modulo` DISABLE KEYS */;
INSERT INTO `tbl_modulo` VALUES (1,'DASHBOARD','DASHBOARD',1),(2,'USUARIOS','USUARIOS ADMINISTRATIVOS DEL SISTEMA',1),(3,'CLIENTES ','CLIENTES DE TIENDA',1),(4,'PRODUCTOS','TODOS LOS PRODUCTO',1),(5,'PEDIDOS','PEDIDOS DE COMPRA',1),(6,'CATEGORÍAS','CATEGORÍAS TBL_PRODUCTOS',1),(7,'INVENTARIO','INVENTARIO PRODUCTOS ROUTE',1),(8,'Calendario','Calendario en la empresa route77',1),(9,'Empresa','asdasdasd',1),(10,'Proveedores','12131223',1),(11,'Sucursales','Sucursales',1),(12,'Compras','Orden Compra',1),(13,'Suscripciones','Registro de suscripciones de la empresa',1),(14,'Contactos','Mensajes de el formulario contacto',1),(15,'Páginas','Páginas del sitio Web',1),(16,'Backup','Copia de seguridad y restauración de la base de datos',1),(17,'Bitácora','Bitácora del sistema',1);
/*!40000 ALTER TABLE `tbl_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orden_compra`
--

DROP TABLE IF EXISTS `tbl_orden_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_orden_compra` (
  `COD_ORDEN` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE LA ORDEN DE COMPRA',
  `COD_PROVEEDOR` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL PROOVEDOR DE LOS PRODUCTOS',
  `FECHA_COMPRA` datetime NOT NULL COMMENT 'FECHA EN LA CUAL SE HACE LA ORDEN',
  `MONTO` decimal(11,2) NOT NULL COMMENT 'SUMA TOTAL DE TODOS LOS PRODUCTOS EN LA ORDEN',
  `ISV` decimal(11,2) NOT NULL COMMENT 'IMPUESTO SOBRE VENTAS',
  `CREADO_POR` bigint(20) NOT NULL,
  `NO_FACTURA` int(11) NOT NULL,
  PRIMARY KEY (`COD_ORDEN`),
  KEY `COD_PROVEEDOR` (`COD_PROVEEDOR`),
  CONSTRAINT `TBL_ORDEN_COMPRA_IBFK_1` FOREIGN KEY (`COD_PROVEEDOR`) REFERENCES `tbl_proveedores` (`COD_PROVEEDOR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orden_compra`
--

LOCK TABLES `tbl_orden_compra` WRITE;
/*!40000 ALTER TABLE `tbl_orden_compra` DISABLE KEYS */;
INSERT INTO `tbl_orden_compra` VALUES (5,4,'2022-03-01 16:45:03',964.00,15.00,1,312213),(6,1,'2022-03-14 17:11:34',100.00,15.00,1,0),(7,1,'2022-04-14 17:13:51',100.00,15.00,1,123),(8,1,'2022-04-14 17:15:10',2.00,15.00,1,123),(9,1,'2022-04-14 17:43:30',2.00,15.00,1,122131),(10,1,'2022-04-14 18:46:54',100.00,15.00,1,1234),(11,1,'2022-04-14 18:48:01',100.00,15.00,1,123),(12,1,'2022-04-14 18:48:51',100.00,15.00,1,10),(13,1,'2022-04-14 18:50:40',225.00,15.00,1,123),(14,1,'2022-04-14 18:53:30',100.00,15.00,1,2313),(15,1,'2022-04-15 02:19:07',22.00,3375.00,1,41341314),(16,1,'2022-04-15 02:28:50',1.00,150.00,1,41412414),(17,1,'2022-04-15 02:32:55',6.00,900.00,1,414124145),(18,1,'2022-04-15 02:38:57',6000.00,900.00,1,123412213),(19,1,'2022-04-15 03:03:57',1921.20,288.00,1,123123123),(20,1,'2022-04-15 03:07:37',3042.88,456.00,1,3131313),(21,1,'2022-04-15 03:15:23',3042.88,456.00,1,3131313),(22,1,'2022-04-15 03:19:38',3042.88,456.00,1,3131313),(23,1,'2022-04-15 03:20:05',3042.88,456.00,1,3131313),(24,1,'2022-04-15 03:20:22',3042.88,456.00,1,3131313),(25,1,'2022-04-15 03:20:32',3042.88,456.00,1,3131313),(26,1,'2022-04-30 00:00:00',3042.88,456.00,1,2147483647),(27,1,'2022-04-17 01:21:01',5200.00,780.00,1,12231131),(28,1,'2022-04-17 23:36:55',500.00,75.00,1,1231231231),(29,1,'2022-04-18 13:51:52',400.00,60.00,1,12123123),(30,1,'2022-04-18 17:32:10',200.00,30.00,1,3121231),(31,1,'2022-04-23 07:56:42',500.00,75.00,1,5496),(32,1,'2022-04-24 21:35:58',1560.00,234.00,1,76754678),(33,1,'2022-04-25 00:00:01',1500.00,225.00,1,345654),(34,1,'2022-05-09 01:48:43',450.00,0.00,1,121221313),(35,1,'2022-05-09 01:48:48',450.00,0.00,1,121221313),(36,1,'2022-05-09 01:49:54',600.00,0.00,1,121221313),(37,1,'2022-05-09 01:51:19',1228.20,160.00,1,41232123),(38,1,'2022-05-09 16:21:31',6300.00,0.00,1,3123132),(39,1,'2022-05-09 17:57:06',23000.00,3000.00,1,51341),(40,1,'2022-05-09 17:58:04',2300.00,300.00,1,312313254),(41,1,'2022-05-09 17:59:07',450.00,0.00,1,62424212);
/*!40000 ALTER TABLE `tbl_orden_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido`
--

DROP TABLE IF EXISTS `tbl_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido` (
  `COD_PEDIDO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL PEDIDO',
  `COD_PERSONA` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LA PERSONA QUE REGISTRÓ EL PEDIDO',
  `FECHA` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'FECHA EN LA QUE SE REGISTRÓ EL PEDIDO',
  `MONTO` decimal(11,2) NOT NULL COMMENT 'SUMA TOTAL DE TODOS LOS PRODUCTOS EN EL PEDIDO',
  `COSTOENVIO` decimal(11,2) NOT NULL COMMENT 'COSTO DE ENVIÓ',
  `COD_TIPO_PAGO` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LAS OPCIONES PARA RECIBIR EL PAGO',
  `DIRECCION_ENVIO` text COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DIRECCIÓN DE ENTREGA',
  `COD_ESTADO` int(11) NOT NULL COMMENT 'CÓDIGO DE ESTADO DEL PEDIDO',
  `REFERENCIA_COBRO` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `COD_TRANSACCION_PAYPAL` varchar(255) CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `DATOS_PAYPAL` text CHARACTER SET utf8 COLLATE utf8_swedish_ci DEFAULT NULL,
  `CREADO_POR` bigint(20) NOT NULL COMMENT 'USUARIO QUE CREO EL PEDIDO',
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'FECHA EN LA QUE SE CREÓ EL PEDIDO',
  `MODIFICADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DE EL ÚLTIMO USUARIO EN MODIFICAR',
  `FECHA_MODIFICACION` datetime NOT NULL COMMENT 'FECHA DE LA ÚLTIMA MODIFICACIÓN',
  PRIMARY KEY (`COD_PEDIDO`),
  KEY `COD_USUARIO` (`COD_PERSONA`),
  KEY `COD_TIPO_PAGO` (`COD_TIPO_PAGO`),
  KEY `COD_ESTADO` (`COD_ESTADO`),
  CONSTRAINT `TBL_PEDIDO_IBFK_1` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_PEDIDO_IBFK_3` FOREIGN KEY (`COD_TIPO_PAGO`) REFERENCES `tbl_tipo_pago` (`COD_TIPO_PAGO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_PEDIDO_IBFK_4` FOREIGN KEY (`COD_ESTADO`) REFERENCES `tbl_tipo_estado` (`COD_ESTADO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido`
--

LOCK TABLES `tbl_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_pedido` DISABLE KEYS */;
INSERT INTO `tbl_pedido` VALUES (15,1,'2022-03-20 22:50:23',100.00,10.00,2,'Tangamandapio',3,'','','',0,'2022-03-20 22:50:23',0,'2022-03-20 22:53:31'),(16,1,'2022-03-20 23:16:07',250.00,199.00,1,'La Vecindad del Chavo',1,'','','',0,'2022-03-20 23:16:07',0,'0000-00-00 00:00:00'),(17,1,'2022-03-22 18:39:32',100.00,10.00,2,'Florencia Norte',3,'','','',0,'2022-03-22 18:39:32',0,'2022-03-22 18:40:25'),(18,1,'2022-04-01 22:21:31',35.00,10.00,1,'Flor del campo Zona 2, Mi casa',1,NULL,NULL,NULL,0,'2022-04-01 22:21:31',0,'0000-00-00 00:00:00'),(19,1,'2022-04-01 22:27:12',35.00,10.00,1,'Flor del campo Zona 3, Otra casa mia',1,NULL,NULL,NULL,0,'2022-04-01 22:27:12',0,'0000-00-00 00:00:00'),(20,1,'2022-04-01 22:33:15',129.00,10.00,1,'Col. el hato de enmedio, casa 3',1,NULL,NULL,NULL,0,'2022-04-01 22:33:15',0,'0000-00-00 00:00:00'),(21,1,'2022-04-01 22:36:39',650.00,0.00,2,'Col. Las torres, El matadero',1,NULL,NULL,NULL,0,'2022-04-01 22:36:39',0,'0000-00-00 00:00:00'),(22,1,'2022-04-01 22:46:31',725.00,0.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 22:46:31',0,'0000-00-00 00:00:00'),(23,1,'2022-04-01 22:47:03',725.00,0.00,1,'Col. Flor del Campo, 504',1,NULL,NULL,NULL,0,'2022-04-01 22:47:03',0,'0000-00-00 00:00:00'),(24,1,'2022-04-01 22:48:27',775.00,0.00,1,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 22:48:27',0,'0000-00-00 00:00:00'),(25,1,'2022-04-01 22:51:18',575.00,0.00,1,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 22:51:18',0,'0000-00-00 00:00:00'),(26,1,'2022-04-01 22:53:57',60.00,10.00,1,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 22:53:57',0,'0000-00-00 00:00:00'),(27,1,'2022-04-01 22:54:11',60.00,10.00,1,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 22:54:11',0,'0000-00-00 00:00:00'),(28,1,'2022-04-01 23:03:01',650.00,0.00,1,'Col. Flor del Campo, 11101',2,NULL,'8YM43723DX3011454','{\"id\":\"7A7450099E898960Y\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"26.67\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L650\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"8YM43723DX3011454\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"26.67\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-02T05:03:01Z\",\"update_time\":\"2022-04-02T05:03:01Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-02T05:00:55Z\",\"update_time\":\"2022-04-02T05:03:01Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7A7450099E898960Y\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-01 23:03:01',0,'0000-00-00 00:00:00'),(29,1,'2022-04-01 23:27:52',327.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:27:52',0,'0000-00-00 00:00:00'),(30,1,'2022-04-01 23:28:08',327.00,10.00,2,'Col. Flor del Campo, 504',1,NULL,NULL,NULL,0,'2022-04-01 23:28:08',0,'0000-00-00 00:00:00'),(31,1,'2022-04-01 23:29:02',327.00,10.00,2,'Col. Flor del Campo, 504',1,NULL,NULL,NULL,0,'2022-04-01 23:29:02',0,'0000-00-00 00:00:00'),(32,1,'2022-04-01 23:33:58',327.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:33:58',0,'0000-00-00 00:00:00'),(33,1,'2022-04-01 23:35:07',205.00,10.00,2,'Flor del campo Zona 2, Mi casa',1,NULL,NULL,NULL,0,'2022-04-01 23:35:07',0,'0000-00-00 00:00:00'),(34,1,'2022-04-01 23:39:57',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:39:57',0,'0000-00-00 00:00:00'),(35,1,'2022-04-01 23:41:40',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:41:40',0,'0000-00-00 00:00:00'),(36,1,'2022-04-01 23:44:17',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:44:17',0,'0000-00-00 00:00:00'),(37,1,'2022-04-01 23:46:27',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:46:27',0,'0000-00-00 00:00:00'),(38,1,'2022-04-01 23:47:38',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:47:38',0,'0000-00-00 00:00:00'),(39,1,'2022-04-01 23:51:47',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:51:47',0,'0000-00-00 00:00:00'),(40,1,'2022-04-01 23:52:27',35.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:52:27',0,'0000-00-00 00:00:00'),(41,1,'2022-04-01 23:56:44',205.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-01 23:56:44',0,'0000-00-00 00:00:00'),(42,1,'2022-04-02 00:00:49',85.00,10.00,1,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-02 00:00:49',0,'0000-00-00 00:00:00'),(43,1,'2022-04-02 00:01:25',85.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-02 00:01:25',0,'0000-00-00 00:00:00'),(45,1,'2022-04-02 01:10:48',86.00,10.00,1,'Flor del campo Zona 2, 11101',2,NULL,'641590789F655810D','{\"id\":\"0GG102024S275645U\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"3.53\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L86\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"641590789F655810D\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"3.53\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-02T07:10:48Z\",\"update_time\":\"2022-04-02T07:10:48Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-02T07:10:29Z\",\"update_time\":\"2022-04-02T07:10:48Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/0GG102024S275645U\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-02 01:10:48',0,'0000-00-00 00:00:00'),(46,1,'2022-04-05 15:13:48',264.00,10.00,1,'USA, Miami',4,NULL,'1KD91627VM8744945','{\"id\":\"709582511C7326134\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.82\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L264\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"1KD91627VM8744945\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.82\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-05T21:13:48Z\",\"update_time\":\"2022-04-05T21:13:48Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-05T21:13:23Z\",\"update_time\":\"2022-04-05T21:13:48Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/709582511C7326134\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-05 15:13:48',0,'0000-00-00 00:00:00'),(47,1,'2022-04-06 01:16:24',142.00,10.00,1,'QQ, WW',4,NULL,'4C372163YS110874S','{\"create_time\":\"2022-04-06T07:15:37Z\",\"update_time\":\"2022-04-06T07:16:23Z\",\"id\":\"7F538361R17420226\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"payer\":{\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"},\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"}},\"purchase_units\":[{\"description\":\"Compra de articulos en Route 77 por  L142\",\"reference_id\":\"default\",\"amount\":{\"value\":\"5.75\",\"currency_code\":\"USD\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"status\":\"COMPLETED\",\"id\":\"4C372163YS110874S\",\"final_capture\":true,\"create_time\":\"2022-04-06T07:16:23Z\",\"update_time\":\"2022-04-06T07:16:23Z\",\"amount\":{\"value\":\"5.75\",\"currency_code\":\"USD\"},\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/4C372163YS110874S\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"},{\"href\":\"https://api.sandbox.paypal.com/v2/payments/captures/4C372163YS110874S/refund\",\"rel\":\"refund\",\"method\":\"POST\",\"title\":\"POST\"},{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7F538361R17420226\",\"rel\":\"up\",\"method\":\"GET\",\"title\":\"GET\"}]}]}}],\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7F538361R17420226\",\"rel\":\"self\",\"method\":\"GET\",\"title\":\"GET\"}]}',0,'2022-04-06 01:16:24',0,'0000-00-00 00:00:00'),(48,19,'2022-04-06 01:47:51',160.00,10.00,1,'LAS HADAS, VALLE',4,NULL,'4GE28682PD2061717','{\"id\":\"24250260CH2702632\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"6.47\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L160\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"4GE28682PD2061717\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"6.47\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-06T07:47:51Z\",\"update_time\":\"2022-04-06T07:47:51Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-06T07:47:28Z\",\"update_time\":\"2022-04-06T07:47:51Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/24250260CH2702632\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-06 01:47:51',0,'0000-00-00 00:00:00'),(49,19,'2022-04-06 01:51:48',650.00,0.00,1,'Col. Los Laureles, BARRIO #2',2,NULL,'5AH52430S5824271V','{\"id\":\"2YK86895VJ883910P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"26.30\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L650\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"5AH52430S5824271V\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"26.30\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-06T07:51:47Z\",\"update_time\":\"2022-04-06T07:51:47Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-06T07:51:40Z\",\"update_time\":\"2022-04-06T07:51:47Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2YK86895VJ883910P\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-06 01:51:48',0,'0000-00-00 00:00:00'),(50,19,'2022-04-06 01:55:32',35.00,10.00,1,'FLOR DEL CAMPO, LA CANTERA',2,NULL,'0NE94464Y1916112C','{\"id\":\"40J16266M5069691J\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"1.42\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L35\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"0NE94464Y1916112C\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"1.42\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-06T07:55:31Z\",\"update_time\":\"2022-04-06T07:55:31Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-06T07:55:24Z\",\"update_time\":\"2022-04-06T07:55:31Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/40J16266M5069691J\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-06 01:55:32',0,'0000-00-00 00:00:00'),(51,19,'2022-04-06 02:20:13',135.00,10.00,1,'VALLE DE SULA, EL CC',4,NULL,'4VD94482T8502422N','{\"id\":\"7TK423171U7143208\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"5.46\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L135\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"4VD94482T8502422N\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"5.46\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-06T08:20:12Z\",\"update_time\":\"2022-04-06T08:20:12Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-06T08:19:58Z\",\"update_time\":\"2022-04-06T08:20:12Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/7TK423171U7143208\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-06 02:20:13',0,'0000-00-00 00:00:00'),(52,1,'2022-04-06 23:04:27',205.00,10.00,3,'PPP, OOO',3,'333',NULL,NULL,0,'2022-04-06 23:04:27',0,'0000-00-00 00:00:00'),(56,1,'2022-04-09 17:29:30',205.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-09 17:29:30',0,'0000-00-00 00:00:00'),(57,1,'2022-04-14 17:18:22',135.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-14 17:18:22',0,'0000-00-00 00:00:00'),(58,1,'2022-04-14 19:01:29',60.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-14 19:01:29',0,'0000-00-00 00:00:00'),(59,1,'2022-04-14 19:03:02',140.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-14 19:03:02',0,'0000-00-00 00:00:00'),(60,1,'2022-04-14 19:03:52',60.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-14 19:03:52',0,'0000-00-00 00:00:00'),(61,1,'2022-04-14 19:04:42',60.00,10.00,1,'Flor del campo Zona 2, 11101',3,'123',NULL,NULL,0,'2022-04-14 19:04:42',0,'0000-00-00 00:00:00'),(62,1,'2022-04-17 17:23:43',260.00,10.00,2,'Col. Flor del Campo, 11101',1,NULL,NULL,NULL,0,'2022-04-17 17:23:43',0,'0000-00-00 00:00:00'),(67,1,'2022-04-17 23:15:39',85.00,10.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-17 23:15:39',0,'0000-00-00 00:00:00'),(69,1,'2022-04-18 02:40:51',225.00,30.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-18 02:40:51',0,'0000-00-00 00:00:00'),(70,1,'2022-04-18 21:50:44',85.00,10.00,1,'Flor del campo Zona 2, 11101',3,NULL,'13Y94839UA610281D','{\"id\":\"13X72570A96577145\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"3.42\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L85\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"13Y94839UA610281D\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"3.42\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-19T03:50:43Z\",\"update_time\":\"2022-04-19T03:50:43Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-tpf3v1494486@personal.example.com\",\"payer_id\":\"66G328FZP4H4N\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-19T03:50:32Z\",\"update_time\":\"2022-04-19T03:50:43Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/13X72570A96577145\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-18 21:50:44',0,'0000-00-00 00:00:00'),(71,1,'2022-04-19 03:19:43',179.95,100.00,3,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-19 03:19:43',0,'0000-00-00 00:00:00'),(72,1,'2022-04-19 23:34:37',1.00,1000.00,2,'Col. Los Laureles Calle Principal, 11101',1,NULL,NULL,NULL,0,'2022-04-19 23:34:37',0,'0000-00-00 00:00:00'),(73,1,'2022-04-19 23:35:00',1.00,1000.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-19 23:35:00',0,'0000-00-00 00:00:00'),(74,1,'2022-04-19 23:39:38',1.00,1000.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-19 23:39:38',0,'0000-00-00 00:00:00'),(75,1,'2022-04-19 23:45:21',120.00,100.00,2,'Flor del campo Zona 2, 11101',1,NULL,NULL,NULL,0,'2022-04-19 23:45:21',0,'0000-00-00 00:00:00'),(76,63,'2022-04-20 03:38:10',320.00,100.00,1,'Col 19 de Septiembre, Tegucigalpa',4,NULL,'34U490118K543832X','{\"id\":\"0M865575U6697282K\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"13.04\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L320\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"34U490118K543832X\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"13.04\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-20T03:38:09Z\",\"update_time\":\"2022-04-20T03:38:09Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-20T03:37:01Z\",\"update_time\":\"2022-04-20T03:38:09Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/0M865575U6697282K\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-20 03:38:10',0,'0000-00-00 00:00:00'),(77,64,'2022-04-20 03:38:39',120.00,100.00,2,'Col. Mall Premier, Tegucigalpa',1,NULL,NULL,NULL,0,'2022-04-20 03:38:39',0,'0000-00-00 00:00:00'),(78,66,'2022-04-20 03:39:53',119.00,100.00,3,'Villas la concepción, Tegucigalpa',1,NULL,NULL,NULL,0,'2022-04-20 03:39:53',0,'0000-00-00 00:00:00'),(79,66,'2022-04-20 03:47:07',122.00,100.00,1,'La satélite, Jan Pedro jula',5,NULL,'0D332664RV1063326','{\"id\":\"1E943782K14653801\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"4.97\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L122\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"0D332664RV1063326\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"4.97\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-20T03:47:06Z\",\"update_time\":\"2022-04-20T03:47:06Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-tpf3v1494486@personal.example.com\",\"payer_id\":\"66G328FZP4H4N\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-20T03:46:49Z\",\"update_time\":\"2022-04-20T03:47:06Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/1E943782K14653801\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-20 03:47:07',0,'0000-00-00 00:00:00'),(80,69,'2022-04-22 00:43:04',120.00,100.00,2,'home, tegucigalpa',1,NULL,NULL,NULL,0,'2022-04-22 00:43:04',0,'0000-00-00 00:00:00'),(81,71,'2022-04-24 03:46:25',123.00,100.00,2,'Residencial San Ignacio, Nueva York / America',1,NULL,NULL,NULL,0,'2022-04-24 03:46:25',0,'0000-00-00 00:00:00'),(82,1,'2022-04-24 05:31:40',120.00,100.00,3,'Col San Miguel, Tegucigalpa',3,'12345678',NULL,NULL,0,'2022-04-24 05:31:40',0,'0000-00-00 00:00:00'),(83,63,'2022-04-24 19:50:02',386.00,100.00,1,'Col. La Kennedy, Tegicigalpa',2,NULL,'09U40028D6447060C','{\"id\":\"67178896R2395700U\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"15.68\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L386\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"09U40028D6447060C\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"15.68\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-24T19:50:01Z\",\"update_time\":\"2022-04-24T19:50:01Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-24T19:49:27Z\",\"update_time\":\"2022-04-24T19:50:01Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/67178896R2395700U\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-24 19:50:02',0,'0000-00-00 00:00:00'),(84,63,'2022-04-24 19:53:16',387.00,100.00,1,'Col. La Kennedy, Tegucigalpa',2,NULL,'8S9517388L3477825','{\"id\":\"2GL084299F705022P\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"15.73\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L387\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"8S9517388L3477825\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"15.73\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-24T19:53:16Z\",\"update_time\":\"2022-04-24T19:53:16Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-24T19:52:46Z\",\"update_time\":\"2022-04-24T19:53:16Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/2GL084299F705022P\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-24 19:53:16',0,'0000-00-00 00:00:00'),(85,63,'2022-04-24 19:57:10',339.96,100.00,1,'La Kennedy, Tegicigalpa',2,NULL,'04014399W7337304P','{\"id\":\"1DF71558E0174863A\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"13.81\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L339.96\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"04014399W7337304P\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"13.81\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-24T19:57:09Z\",\"update_time\":\"2022-04-24T19:57:09Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-24T19:56:38Z\",\"update_time\":\"2022-04-24T19:57:09Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/1DF71558E0174863A\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-24 19:57:10',0,'0000-00-00 00:00:00'),(86,63,'2022-04-24 20:00:29',142.00,100.00,2,'Col. Los Laureles, Tegucigalpa',3,NULL,NULL,NULL,0,'2022-04-24 20:00:29',0,'0000-00-00 00:00:00'),(87,63,'2022-04-24 21:54:48',247.97,100.00,1,'Col. San Francisco, Tegucigalpa',3,NULL,'5V368156BR676805M','{\"id\":\"3W963593Y4183443C\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.09\"},\"payee\":{\"email_address\":\"sb-wredv8287762@business.example.com\",\"merchant_id\":\"5E2T43PBCLZWQ\"},\"description\":\"Compra de articulos en Route 77 por  L247.97\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Tegucigalpa\",\"admin_area_1\":\"Tegucigalpa\",\"postal_code\":\"12345\",\"country_code\":\"HN\"}},\"payments\":{\"captures\":[{\"id\":\"5V368156BR676805M\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"10.09\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2022-04-24T21:54:47Z\",\"update_time\":\"2022-04-24T21:54:47Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-lrh2t8250598@personal.example.com\",\"payer_id\":\"3KDQTSC5T4SJJ\",\"address\":{\"country_code\":\"HN\"}},\"create_time\":\"2022-04-24T21:54:18Z\",\"update_time\":\"2022-04-24T21:54:47Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/3W963593Y4183443C\",\"rel\":\"self\",\"method\":\"GET\"}]}',0,'2022-04-24 21:54:48',0,'0000-00-00 00:00:00'),(88,76,'2022-04-25 00:44:49',281.98,100.00,2,'Tegucigalpa Lomas del Guijarro, Tegucigalpa',3,NULL,NULL,NULL,0,'2022-04-25 00:44:49',0,'0000-00-00 00:00:00'),(89,76,'2022-04-25 00:45:41',290.00,100.00,2,'Lomas del Guijarro, Tegucigalpa',2,NULL,NULL,NULL,0,'2022-04-25 00:45:41',0,'0000-00-00 00:00:00'),(90,1,'2022-04-25 00:55:27',595.00,100.00,2,'Residencial El trapiche, Tegucigalpa',1,NULL,NULL,NULL,0,'2022-04-25 00:55:27',0,'0000-00-00 00:00:00'),(91,49,'2022-04-25 19:33:40',235.00,100.00,2,'Lomas, Tegucigalpa',3,NULL,NULL,NULL,0,'2022-04-25 19:33:40',1,'2022-04-26 23:33:58');
/*!40000 ALTER TABLE `tbl_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permisos`
--

DROP TABLE IF EXISTS `tbl_permisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permisos` (
  `COD_PERMISO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE PERMISO',
  `COD_ROL` bigint(20) NOT NULL COMMENT 'CÓDIGO DE ROL DEL USUARIO ',
  `COD_MODULO` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL MÓDULO AL CUAL SE OTORGA O QUITA EL PERMISO',
  `R` int(11) NOT NULL COMMENT 'LECTURA',
  `W` int(11) NOT NULL COMMENT 'ESCRITURA',
  `U` int(11) NOT NULL COMMENT 'MODIFICAR',
  `D` int(11) NOT NULL COMMENT 'ELIMINAR',
  PRIMARY KEY (`COD_PERMISO`),
  KEY `COD_ROL` (`COD_ROL`),
  KEY `COD_MODULO` (`COD_MODULO`),
  CONSTRAINT `TBL_PERMISOS_IBFK_1` FOREIGN KEY (`COD_ROL`) REFERENCES `tbl_roles` (`COD_ROL`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_PERMISOS_IBFK_2` FOREIGN KEY (`COD_MODULO`) REFERENCES `tbl_modulo` (`COD_MODULO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1565 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permisos`
--

LOCK TABLES `tbl_permisos` WRITE;
/*!40000 ALTER TABLE `tbl_permisos` DISABLE KEYS */;
INSERT INTO `tbl_permisos` VALUES (322,3,1,0,0,0,0),(323,3,2,0,0,0,0),(324,3,3,0,0,0,0),(325,3,4,0,0,0,0),(326,3,5,0,0,0,0),(327,3,6,0,0,0,0),(1353,4,1,1,0,0,0),(1354,4,2,0,0,0,0),(1355,4,3,0,0,0,0),(1356,4,4,1,1,1,0),(1357,4,5,1,1,1,0),(1358,4,6,1,1,1,0),(1359,4,7,1,0,0,0),(1360,4,8,1,0,0,0),(1361,4,9,0,0,0,0),(1362,4,10,0,1,1,0),(1363,4,11,0,0,0,0),(1364,4,12,1,1,0,0),(1365,4,13,0,0,0,0),(1501,8,1,1,1,1,1),(1502,8,2,1,1,1,1),(1503,8,3,1,0,0,0),(1504,8,4,1,0,0,0),(1505,8,5,1,0,0,0),(1506,8,6,1,0,0,0),(1507,8,7,1,0,0,0),(1508,8,8,1,0,0,0),(1509,8,9,1,0,0,0),(1510,8,10,1,0,0,0),(1511,8,11,1,0,0,0),(1512,8,12,1,0,0,0),(1513,8,13,1,0,0,0),(1514,8,14,0,0,0,0),(1515,8,15,0,0,0,0),(1532,2,1,1,0,0,0),(1533,2,2,0,0,0,0),(1534,2,3,0,0,0,0),(1535,2,4,0,0,0,0),(1536,2,5,1,0,0,0),(1537,2,6,0,0,0,0),(1538,2,7,0,0,0,0),(1539,2,8,0,0,0,0),(1540,2,9,0,0,0,0),(1541,2,10,0,0,0,0),(1542,2,11,0,0,0,0),(1543,2,12,0,0,0,0),(1544,2,13,0,0,0,0),(1545,2,14,0,0,0,0),(1546,2,15,0,0,0,0),(1547,2,16,0,0,0,0),(1548,1,1,1,1,1,1),(1549,1,2,1,1,1,1),(1550,1,3,1,1,1,1),(1551,1,4,1,1,1,1),(1552,1,5,1,1,1,1),(1553,1,6,1,1,1,1),(1554,1,7,1,1,1,1),(1555,1,8,1,1,1,1),(1556,1,9,1,1,1,1),(1557,1,10,1,1,1,1),(1558,1,11,1,1,1,1),(1559,1,12,1,1,1,1),(1560,1,13,1,1,1,1),(1561,1,14,1,1,1,1),(1562,1,15,1,1,1,1),(1563,1,16,1,1,1,1),(1564,1,17,1,1,1,1);
/*!40000 ALTER TABLE `tbl_permisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_personas`
--

DROP TABLE IF EXISTS `tbl_personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_personas` (
  `COD_PERSONA` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE PERSONA',
  `NOMBRES` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DE LA PERSONA',
  `APELLIDOS` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'APELLIDO DE LA PERSONA',
  `EMAIL` varchar(35) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'CORREO DE LA PERSONA',
  `CONTRASEÑA` varchar(150) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'CONTRASEÑA DE LA PERSONA',
  `COD_ROL` bigint(20) NOT NULL COMMENT 'CÓDIGO DEL ROL DE LA PERSONA',
  `COD_STATUS` int(11) NOT NULL COMMENT 'CÓDIGO DEL ESTADO DE LA PERSONA',
  `TELEFONO` int(11) NOT NULL COMMENT 'TELÉFONO DE LA PERSONA',
  `TOKEN` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'UTILIZADO PARA ENVIAR AL USUARIO POR SI OLVIDA LA CONTRASEÑA',
  `CREADO_POR` bigint(20) DEFAULT NULL COMMENT 'USUARIO QUE HIZO REGISTRO',
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'FECHA EN LA QUE SE REGISTRÓ A LA PERSONA',
  `MODIFICADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DEL ÚLTIMO USUARIO EN MODIFICAR',
  `FECHA_MODIFICACION` datetime NOT NULL COMMENT 'REGISTRO DE LA ÚLTIMA FECHA DE MODIFICACIÓN',
  `DATE_LOGIN` datetime NOT NULL COMMENT 'FECHA EN LA QUE LA PERSONA INICIO SESIÓN',
  PRIMARY KEY (`COD_PERSONA`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  KEY `COD_ROL` (`COD_ROL`),
  KEY `COD_ROL_2` (`COD_ROL`),
  KEY `COD_STATUS` (`COD_STATUS`),
  CONSTRAINT `TBL_PERSONAS_IBFK_4` FOREIGN KEY (`COD_ROL`) REFERENCES `tbl_roles` (`COD_ROL`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_PERSONAS_IBFK_6` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_personas`
--

LOCK TABLES `tbl_personas` WRITE;
/*!40000 ALTER TABLE `tbl_personas` DISABLE KEYS */;
INSERT INTO `tbl_personas` VALUES (1,'José Fernando','Ortiz','josefortizsantos@gmail.com','65d452d53579e16d2fdf9228577b6eac314b59163f1c6ad43b61032109d3f608',1,1,98912135,'',51,'2022-02-12 02:22:51',1,'2022-05-08 21:44:40','2022-05-10 22:43:38'),(2,'PEDRO','LOPEZ','plopez@gmail.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',2,1,98912132,'',51,'2022-02-12 02:23:15',1,'2022-04-16 22:43:51','2022-03-25 01:42:11'),(5,'FRANCISCA','LAGOS','flagoss@gmail.com','123',3,1,98912132,'',1,'2022-02-12 02:25:44',1,'2022-04-09 02:53:28','2022-02-12 02:23:22'),(6,'MARIO','PEREZ','MPEREZ@GMAIL.COM','',1,0,9898131,'',0,'2022-02-15 21:25:36',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(13,'Leonela','Pineda','lypineda@unah.hn','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',8,1,97737659,'',1,'2022-02-17 19:53:21',1,'2022-05-11 18:15:48','2022-05-11 00:02:50'),(14,'LD','LJHBS','G@GMAIL.COM','100',2,1,98795600,'',1,'2022-02-17 21:24:30',1,'2022-02-17 21:25:06','0000-00-00 00:00:00'),(18,'CRISTIANO','IZAGUIRRE','czaguire@gmail.com','',3,1,9898989,'',1,'2022-02-18 23:33:55',1,'2022-04-04 02:18:25','0000-00-00 00:00:00'),(19,'CARLOS','ALMENDAREZ','ALMENDAREZC@GMAIL.COM','100',2,1,98103650,'',1,'2022-02-19 00:30:39',1,'2022-02-19 00:32:11','0000-00-00 00:00:00'),(20,'CAROLINA FRANCISCA','GONZALES','cgonz@gmail.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',1,2,91006354,'',1,'2022-02-19 00:34:29',1,'2022-03-24 01:12:55','0000-00-00 00:00:00'),(32,'Hugo','Paz','hugo.paz@unah.hn','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',4,1,98142814,'',1,'2022-03-22 18:24:11',1,'2022-04-20 23:33:33','2022-04-22 00:10:30'),(49,'Kevin','Rodriguez','krodriguezz@unah.hn','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',1,1,32301533,'',1,'2022-03-24 17:37:43',1,'2022-04-24 05:05:51','2022-04-25 19:33:06'),(50,'Fernando','Ortiz','josefortizsan121os@gmail.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',1,0,505050574,'',1,'2022-03-24 17:48:10',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'DARLIN YOHANA','MARTEL','darlin.matamoros123@unah.hn','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',1,0,505050574,'',1,'2022-03-24 22:39:44',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'Pedro','Gomez','pgomez@gmail.com','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3',1,0,9898998,'',1,'2022-03-24 22:41:53',1,'2022-03-25 00:56:56','0000-00-00 00:00:00'),(53,'HUIG','PIZA','ffernandada@gmail.com','',3,1,123123123,'',1,'2022-04-04 02:10:56',1,'2022-04-18 17:31:38','0000-00-00 00:00:00'),(62,'Pedro Enrique','Bustillo','josefortizsantos20000@gmail.com','95e56aa6c537557c35ed141fc054822fdd050187fa161e7da186abda2871bed3',2,1,94877564,'',NULL,'2022-04-18 14:06:02',0,'0000-00-00 00:00:00','2022-04-18 14:07:22'),(63,'Victor','García','victorbustillo2000@gmail.com','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',2,1,97484752,'',NULL,'2022-04-20 03:35:02',1,'2022-04-25 02:19:13','2022-04-25 02:20:27'),(64,'Gaby','Maradiaga','ggmaradiaga@unah.hn','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',2,1,97514276,'',NULL,'2022-04-20 03:36:23',1,'2022-04-20 23:34:05','2022-05-04 02:00:26'),(65,'Jafet','Giron','reynaldo.giron31@gmail.com','05e0b1ff69d7eb776fde986b622558b424c9744e6cce2eec9a52acceb8f24903',2,1,22222222,'',NULL,'2022-04-20 03:37:51',65,'2022-04-25 01:25:16','2022-04-25 02:22:18'),(66,'Alejandro','Izaguirre','alej@gmail.com','dd75ba64297196aa490cf83772f5373aa4e6ee78544374604d95ac5117d3beda',2,1,98142814,'',NULL,'2022-04-20 03:39:30',1,'2022-04-20 23:33:55','0000-00-00 00:00:00'),(67,'Laura','Bozzo','lauaritabozzo@gmaail.com','a1908d81dd32d6e768cd02ed8e3ac704f8086164852fe44d8e01c4f45fc2888b',2,0,97987889,'',1,'2022-04-20 04:10:24',1,'2022-04-20 04:12:36','0000-00-00 00:00:00'),(68,'Luis','Garcia','enriquegarsan@hotmail.com','8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92',2,1,94956573,'',NULL,'2022-04-20 17:35:50',68,'2022-04-20 17:39:52','2022-04-20 17:37:00'),(69,'Test','Test','test@test.com','1ee1fbff077d45b975c0a0b08d4b155670fc3503be1179ff750d7c79587e7e7b',2,1,56789845,'',NULL,'2022-04-22 00:41:59',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'Eileen Arabelle','Rivera','eileenaa.bracamonteaa@unah.hn','613ba10fb44ebe2c8c121c748d59083ac92aafdd9891d0073d0a8d12c84abe63',2,1,50505058,'',NULL,'2022-04-22 08:42:05',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,'Juan Orlando','Hernandez Alvarado','juancito.jodido@gmail.com','d258729cdd62c74b34d7953995313f205f7fe9100c42aad210e088d794a3302c',2,0,22668844,'',NULL,'2022-04-24 03:45:20',1,'2022-05-11 21:01:51','0000-00-00 00:00:00'),(72,'Fragoso','Diaz','josjdosd@gmail.com','1fb54a53280c22005e97da446ba16dcea2ca58a7835176db7ee94ecfa68f1830',2,1,94877564,'',NULL,'2022-04-24 04:27:01',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,'Jafet','Giron Flores','reynaldo.giron@unah.hn','ae528a6d8308a30428d133358cb0c053646ac189f6a2e326aeeaa7c7486fb31e',3,0,98989800,'',1,'2022-04-24 05:05:21',1,'2022-04-25 02:10:08','2022-04-24 08:50:13'),(74,'Hikn','Hjvn','ji@gmail.com','7876460a2729a1b1feadeb9618755fb216ec36ff91f186659119290e5339c192',2,1,65125111,'',NULL,'2022-04-24 08:01:16',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,'David Alejandro','Romero','davidromero@gmail.com','',3,0,94904305,'',1,'2022-04-24 22:44:06',1,'2022-04-24 22:48:28','0000-00-00 00:00:00'),(76,'Carmen','Flores','kazrodriguez97@gmail.com','f0cb9b281e1480e3092281cec04ed610b18fe3f70bc7fee085b29142e932329d',2,0,39874563,'',49,'2022-04-24 23:35:45',1,'2022-04-25 01:36:44','2022-04-25 00:43:01'),(77,'Rosa','Flores','raquel@gmail.com','2e314f2228feae8494cdc888293f11b4ff2035f97e822e9da5d7693d4c343dcb',2,0,98787455,'',1,'2022-04-25 01:18:51',1,'2022-04-25 01:30:47','0000-00-00 00:00:00'),(78,'Reynaldo','Giron Flores','reynaldo@gmail.com','ae528a6d8308a30428d133358cb0c053646ac189f6a2e326aeeaa7c7486fb31e',4,1,87456325,'',1,'2022-04-25 02:24:05',1,'2022-05-11 17:32:53','2022-04-25 02:49:30'),(79,'Carolina','Mendoza','carolina@gmail.com','e81f05b54b3bf054c30e411a7d10d9d5edf5db10cea586d95869fb4e91325cf3',2,0,87965456,'',1,'2022-04-25 02:34:39',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,'Cristian','Garcia','caolina@gmail.com','37f807c3bd67a3dbd1c3919d10c616dfc206b0cb3f0148b3e61c35ec9ebfa448',3,0,88153145,'',1,'2022-04-25 03:00:57',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,'Carlita','Pineda','carla@gmail.com','5951dbb16d5514fc139eeecfad2fcba86b868767a0d82f09a02f1b838e0ccdd9',4,0,95687456,'',1,'2022-04-25 03:09:05',1,'2022-04-25 03:19:09','0000-00-00 00:00:00'),(92,'José Fernando','Santos','josefortizsantos2000@gmail.com','65d452d53579e16d2fdf9228577b6eac314b59163f1c6ad43b61032109d3f608',2,1,2147483647,'',NULL,'2022-04-27 03:24:16',0,'0000-00-00 00:00:00','2022-05-09 18:00:45'),(98,'Pedro Martinez','Santos','jfortizsas@unah.hn','65d452d53579e16d2fdf9228577b6eac314b59163f1c6ad43b61032109d3f608',1,0,50505057,'',1,'2022-05-11 18:24:30',1,'2022-05-11 18:25:11','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_post`
--

DROP TABLE IF EXISTS `tbl_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_post` (
  `COD_POST` bigint(20) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CONTENIDO` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `PORTADA` varchar(255) COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `RUTA` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `COD_STATUS` int(11) NOT NULL,
  `FECHA_CREACION` datetime NOT NULL,
  PRIMARY KEY (`COD_POST`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_post`
--

LOCK TABLES `tbl_post` WRITE;
/*!40000 ALTER TABLE `tbl_post` DISABLE KEYS */;
INSERT INTO `tbl_post` VALUES (1,'Inicio','<div class=\"container text-center p-t-80\"><hr /><div class=\"p-t-80\"><h1 class=\"ltext-103 cl5\">Nuestras Marcas</h1></div><div class=\"row\"><div class=\"col-md-3\"><img src=\"https://estacionroute77.com/Assets/tienda/images/m1.png\" alt=\"Marca1\" width=\"110\" height=\"110\" /></div><div class=\"col-md-3\"><img src=\"https://estacionroute77.com/Assets/tienda/images/m2.png\" alt=\"Marca2\" width=\"128\" height=\"128\" /></div><div class=\"col-md-3\"><img src=\"https://estacionroute77.com/Assets/tienda/images/m3.png\" alt=\"Marca3\" width=\"128\" height=\"128\" /></div><div class=\"col-md-3\"><img src=\"https://estacionroute77.com/Assets/tienda/images/m4.png\" alt=\"Marca4\" width=\"128\" height=\"128\" /></div></div></div>','','inicio',1,'2022-04-25 23:33:19'),(2,'Tienda','<p>Tienda Donde se muestran los Productos</p>','','tienda',1,'2022-04-25 18:35:15'),(3,'Carrito','<p>Carrito</p>','','carrito',1,'2022-04-25 23:33:58'),(4,'Nosotros','<section class=\"bg0 p-t-75 p-b-120\"><div class=\"container\"><div class=\"row p-b-70\"><div class=\"col-md-7 col-lg-8\"><div class=\"p-t-7 p-r-85 p-r-15-lg p-r-0-md\"><h3 class=\"mtext-111 cl2 p-b-16\">Nuestra Historia</h3><p class=\"stext-113 cl6 p-b-26\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.</p><p class=\"stext-113 cl6 p-b-26\">Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula.</p><p class=\"stext-113 cl6 p-b-26\">Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879</p></div></div><div class=\"col-11 col-md-5 col-lg-4 m-lr-auto\"><div class=\"how-bor1 \"><div class=\"hov-img0\"><img src=\"https://estacionroute77.com/Assets/images/Logo4.jpg\" alt=\"IMG\" width=\"500\" height=\"500\" /></div></div></div></div><div class=\"row\"><div class=\"order-md-2 col-md-7 col-lg-8 p-b-30\"><div class=\"p-t-7 p-l-85 p-l-15-lg p-l-0-md\"><h3 class=\"mtext-111 cl2 p-b-16\">Our Mission</h3><p class=\"stext-113 cl6 p-b-26\">Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida. Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.</p><div class=\"bor16 p-l-29 p-b-9 m-t-22\"><p class=\"stext-114 cl6 p-r-40 p-b-11\">Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\"t really do it, they just saw something. It seemed obvious to them after a while.</p><span class=\"stext-111 cl8\"> - Steve Job&rsquo;s </span></div></div></div><div class=\"order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30\"><div class=\"how-bor2\"><div class=\"hov-img0\"><img src=\"https://estacionroute77.com/Assets/images/logo3.png\" alt=\"IMG\" width=\"358\" height=\"375\" /></div></div></div></div></div></section>','img_a259a88fa1ef7cf85b18882c3f14f4d2.jpg','nosotros',1,'2022-04-23 16:31:16'),(5,'Contacto','<div class=\"map\"><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d70511.05790730675!2d-87.21387267511322!3d14.08602999316045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sEstaci%C3%B3n%20Route%2077!5e0!3m2!1ses-419!2shn!4v1650948803505!5m2!1ses-419!2shn\" width=\"100%\" height=\"600\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>','img_a199c6a02d658058b87eea6e522a0e89.jpg','contacto',2,'2022-04-25 17:53:22'),(6,'Preguntas Frecuentes','<ul><li><strong>&iquest;C&uacute;al es el tiempo de entrega de los productos?</strong></li></ul><p style=\"padding-left: 40px;\">R//Lorem ipsum dolor sit amet consectetur, adipisicing elit. Suscipit minima culpa dolores quaerat aut accusamus placeat libero distinctio veniam saepe nam voluptatem voluptates, nobis rem enim voluptatum animi sit necessitatibus</p><ul><li><strong>&iquest;D&oacute;nde estan ubicados?</strong></li></ul><p style=\"padding-left: 40px;\">R//&nbsp;Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis delectus minus perspiciatis, illo unde voluptas consectetur odio ab mollitia, numquam sed veritatis quis recusandae ex reprehenderit maxime suscipit provident aspernatur.</p><ul><li><strong>&iquest;D&oacute;nde hace entregas?</strong></li></ul><p style=\"padding-left: 40px;\">R//&nbsp;Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis delectus minus perspiciatis, illo unde voluptas consectetur odio ab mollitia, numquam sed veritatis quis recusandae ex reprehenderit maxime suscipit provident aspernatur.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>','','preguntas-frecuentes',1,'2022-04-25 23:38:34'),(7,'Términos Y Condiciones','<p>A continuaci&oacute;n se describen los terminos y condiciones de la tienda Online Estaci&oacute;n Route 77</p><ol><li>Termino uno</li><li>Condici&oacute;n dos</li><li>Termino Tres</li></ol><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore alias illum commodi, est quaerat iure qui error consectetur, placeat laboriosam obcaecati laborum quo, sapiente modi. Adipisci, tempora. Iste, ipsa minus?</p><p>Lorem ipsum, dolor sit amet cosectetur adipisicing elit. Facilis id aperiam cupiditate, incidunt magnam adipisci libero ullam nisi soluta sunt, corrupti similique nihil necessitatibus dolorum culpa. Ut beatae perspiciatis quidem.</p>','','terminos-y-condiciones',1,'2022-04-26 00:03:32'),(8,'Sucursales','<section class=\"py-5 text-center\"><div class=\"container\"><p>Visitanos en nuestras sucursales, y disfruta de la variedad de productos que tenemos.</p><span style=\"color: #ffffff;\"><a class=\"btn btn-info\" style=\"color: #ffffff;\" href=\"../../route77/tienda\">VER PRODUCTOS</a></span></div></section><div class=\"py-5 bg-light\"><div class=\"container\"><div class=\"row\"><div class=\"col-md-4\"><div class=\"card mb-4 box-shadow hov-img0\"><img src=\"../../Assets/tienda/images/SantaLucia.jpg\" alt=\"Sucural uno\" width=\"100%\" height=\"100%\" /><div class=\"card-body\"><p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p><p>Direcci&oacute;n: Santa Lucia frente a la Laguna<br />Tel&eacute;fono: 4654645 <br />Correo: info@abelosh.com</p></div></div></div><div class=\"col-md-4\"><div class=\"card mb-4 box-shadow hov-img0\"><img src=\"../../Assets/tienda/images/SantaLucia.jpg\" alt=\"Sucural uno\" width=\"100%\" height=\"100%\" /><div class=\"card-body\"><p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p><p>Direcci&oacute;n: Col. Los Laureles, Calle principal <br />Tel&eacute;fono: 4654645 <br />Correo: info@abelosh.com</p></div></div></div><div class=\"col-md-4\"><div class=\"card mb-4 box-shadow hov-img0\"><img src=\"../../Assets/tienda/images/SantaLucia.jpg\" alt=\"Sucural uno\" width=\"100%\" height=\"100%\" /><div class=\"card-body\"><p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p><p>Direcci&oacute;n: Residecial Las Hadas <br />Tel&eacute;fono: 4654645 <br />Correo: info@abelosh.com</p></div></div></div></div></div></div>','img_304c222b9d12411e0cf209ed21f24029.jpg','sucursales',1,'2022-04-26 00:09:49'),(9,'Not Found','<h3>Oops! P&aacute;gina No Encontrada.</h3><p>No se encontro la p&aacute;gina que ha solicitado, por favor revisa la url. o regresa a ver nuestros productos</p>','','not-found',1,'2022-04-26 03:02:11');
/*!40000 ALTER TABLE `tbl_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_productos` (
  `COD_PRODUCTO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE LOS PRODUCTOS',
  `COD_CATEGORIA` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LAS CATEGORÍAS ALMACENADAS',
  `COD_BARRA` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'CÓDIGO DE BARRA DEL PRODUCTO',
  `NOMBRE` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DEL PRODUCTO A REGISTRAR',
  `DESCRIPCION` text COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL PRODUCTO A REGISTRAR',
  `PRECIO` decimal(11,2) NOT NULL COMMENT 'PRECIO DEL PRODUCTO A REGISTRAR',
  `RUTA` varchar(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `CREADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DE USUARIO QUE REGISTRÓ EL PRODUCTO',
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'FECHA EN LA QUE SE REGISTRÓ EL PRODUCTO',
  `MODIFICADO_POR` bigint(20) NOT NULL COMMENT 'REGISTRO DEL ÚLTIMO USUARIO QUE SE REGISTRÓ',
  `FECHA_MODIFICACION` datetime NOT NULL COMMENT 'REGISTRO DE LA ÚLTIMA FECHA DE MODIFICACIÓN',
  `COD_STATUS` int(11) NOT NULL COMMENT 'CÓDIGO DEL ESTADO DEL PRODUCTO',
  PRIMARY KEY (`COD_PRODUCTO`),
  KEY `COD_CATEGORIA` (`COD_CATEGORIA`),
  KEY `COD_STATUS` (`COD_STATUS`),
  CONSTRAINT `TBL_PRODUCTOS_IBFK_1` FOREIGN KEY (`COD_CATEGORIA`) REFERENCES `tbl_categoria` (`COD_CATEGORIA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_PRODUCTOS_IBFK_2` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_productos`
--

LOCK TABLES `tbl_productos` WRITE;
/*!40000 ALTER TABLE `tbl_productos` DISABLE KEYS */;
INSERT INTO `tbl_productos` VALUES (1,4,'123123123123','Pasta Colgate','<p>ARTICULOS PARA EL HOGAR</p>',25.00,'pasta-colgate',1,'2022-02-12 02:39:56',1,'2022-04-19 10:01:12',1),(2,2,'32141545322','Salvavida','<h1>PRIMOS!!</h1>',19.00,'salvavida',1,'2022-02-12 02:39:56',1,'2022-04-19 02:14:18',1),(3,2,'12345643234','Cerveza Imperial','<p>Cerveza Imperial 100% Hecha en Casa&nbsp;<span style=\"text-decoration: underline;\">HONDURAS</span></p>',20.00,'cerveza-imperial',1,'2022-02-20 01:33:57',1,'2022-04-19 02:16:59',1),(4,1,'123456786','Leche Leyde','<p>Leche Leyde</p><ul><li>Deliciosa</li><li>Nutritiva</li><li>Barata</li></ul>',25.00,'leche-leyde',1,'2022-02-27 22:57:46',1,'2022-04-19 03:15:16',1),(5,3,'12345612378','Sombras Victoria Sec','<p>Paleta de sombras rosa marca Victoria Secret</p><p>20 colores&nbsp;</p>',25.00,'sombras-victoria-secret',0,'2022-03-18 00:01:59',1,'2022-04-19 10:19:16',1),(6,4,'123456787','Cubiertos','<p>Cubiertos de acero inoxidable de buena calidad</p>',55.00,'cubiertos',0,'2022-03-18 00:11:11',1,'2022-04-19 21:26:45',1),(9,7,'12345678','Dog Chow','<p>5 Libras de Dog Chow para esos <strong>perros </strong>que andan detr&aacute;s de ti mi amor.</p><p>&nbsp;</p>',95.00,'dog-chow',0,'2022-03-22 18:34:21',1,'2022-04-19 09:31:16',1),(10,4,'1234567898765000','Microondas','<p>muebles de todo tipo</p>',1500.00,'microondas',1,'2022-03-31 14:25:55',1,'2022-04-19 03:11:12',1),(11,4,'2345654545','Regleta','<p>&iquest;Estas sin lugar para conectar tus aparatos?</p><h3>No te preocupes m&aacute;s! ROUTE 77 tiene la soluci&oacute;n</h3><p>Regleta a solo 80 lempiras</p>',80.00,'regleta',1,'2022-03-31 14:37:23',1,'2022-04-19 03:12:48',1),(12,2,'2345665676','Cerveza Barena','<p>Cerveza Barena, Refrescante</p>',22.00,'cerveza-barena',1,'2022-03-31 17:50:25',1,'2022-04-19 02:18:05',1),(13,6,'43141341','Espaguetti','<p>Espaguetti para comer en familia&nbsp;</p>',65.00,'espaguetti',1,'2022-03-31 21:27:57',1,'2022-04-19 03:14:49',1),(14,5,'12231223131','Manzana','<p>Porque a Newton le cayo una en la cabeza, no desaproveches la oprtunidad y comete una deliciosa manzana recien cortada del &aacute;rbol.</p><h2>&nbsp;</h2>',15.99,'manzana',1,'2022-04-06 17:41:05',1,'2022-04-19 03:20:05',1),(15,1,'1234512123','Leche Sula 1 litro','<p>Leche Sula:&nbsp;</p><p>No busques m&aacute;s la leche que m&aacute;s le gusta a los Hondure&ntilde;os es Leche Sula</p>',23.00,'leche-sula-1-litro',1,'2022-04-14 17:41:12',1,'2022-04-20 01:33:24',1),(16,1,'21312312','Malteada sabor fresa Sula','<p>Malteada de sabor fresa Marca sula</p>',17.00,'malteada-sabor-fresa-sula',1,'2022-04-18 00:32:52',1,'2022-04-20 01:48:23',1),(17,3,'321321321','Estuche para maquillaje','<p>Estuche para maquillaje tipo maletin con espejo y luces</p>',20.00,'estuche-para-maquillaje',1,'2022-04-18 00:35:04',1,'2022-04-20 01:59:00',1),(18,3,'234235235','Labial','<p>Labial rojo&nbsp;</p>',80.00,'labial',1,'2022-04-19 10:27:13',0,'0000-00-00 00:00:00',1),(19,9,'1313131212','Coca Cola 1.5 litros','<p>Compra una Coca Cola 1.5 litros</p>',45.00,'coca-cola-15-litros',1,'2022-04-20 04:16:52',32,'2022-04-21 00:24:32',1),(20,1,'132654654','Jugo Del Valle mediano','<p>Jugo de naranja del valle</p>',11.00,'jugo-del-valle-mediano',32,'2022-04-21 00:33:31',32,'2022-04-21 00:34:02',1),(21,1,'123123123','Jugo Natura Melocoton','<p>Sabor melocot&oacute;n de lata</p>',12.00,'jugo-natura-melocoton',1,'2022-04-22 00:50:42',49,'2022-04-24 21:30:49',1),(22,9,'111012','Sprite','<p>Refresco 125 ml.</p>',30.00,'sprite',1,'2022-04-22 00:50:52',1,'2022-04-22 00:51:50',0),(23,9,'510532120','Canada dry portátil','<p>Refresco</p>',18.00,'canada-dry-portatil',1,'2022-04-23 02:50:25',1,'2022-04-23 03:02:46',0),(24,9,'123456789','Hershey','<p>Chocolate</p>',25.00,'hershey',49,'2022-04-24 21:21:59',49,'2022-04-24 21:23:10',0),(25,10,'23545455','Zambos','<p>Zambos con chile&nbsp;</p>',25.00,'zambos',49,'2022-04-24 21:42:08',0,'0000-00-00 00:00:00',0),(26,10,'2323333','Zambo','<p>Zambo con chile</p>',25.00,'zambo',49,'2022-04-24 21:45:29',0,'0000-00-00 00:00:00',0),(27,10,'21234564454','Zambos con chile','<p>Picositos con limon y sal</p>',28.00,'zambos-con-chile',49,'2022-04-24 21:52:47',49,'2022-04-24 22:36:17',0),(28,10,'23456656761344','Zambo con chile','<p>Picositos con limon y sal</p>',28.00,'zambo-con-chile',49,'2022-04-24 22:38:01',49,'2022-04-24 22:40:05',0);
/*!40000 ALTER TABLE `tbl_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_proveedores`
--

DROP TABLE IF EXISTS `tbl_proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_proveedores` (
  `COD_PROVEEDOR` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE PROVEEDOR',
  `COD_PERSONA` bigint(20) NOT NULL COMMENT 'CÓDIGO PERSONA DEL PROOVEDOR',
  `NOMBRE_EMPRESA` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DE LA EMPRESA',
  `RTN` int(20) NOT NULL COMMENT 'REGISTRO TRUBUTARIO NACIONAL NUMÉRICO',
  `UBICACION` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'UBICACIÓN DEL PROVEEDOR',
  PRIMARY KEY (`COD_PROVEEDOR`),
  KEY `COD_PERSONA` (`COD_PERSONA`),
  CONSTRAINT `TBL_PROVEEDORES_IBFK_1` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_proveedores`
--

LOCK TABLES `tbl_proveedores` WRITE;
/*!40000 ALTER TABLE `tbl_proveedores` DISABLE KEYS */;
INSERT INTO `tbl_proveedores` VALUES (1,5,'PRICEMART',98908908,'LAS UVAS'),(2,6,'LA COLONIA2',98909809,'LA FLOR'),(4,18,'CERVECERIA HONDUREÑA SA',9989123,'LA GRANJA'),(5,53,'No Se',123123,'Por Ahi En La Calle'),(6,75,'Inversiones Romero',2147483647,'Colonia Centroamerica Oeste');
/*!40000 ALTER TABLE `tbl_proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_redes_sociales`
--

DROP TABLE IF EXISTS `tbl_redes_sociales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_redes_sociales` (
  `COD_RED_SOCIAL` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE RED SOCIAL',
  `COD_EMPRESA` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LA EMPRESA',
  `DESCRIPCION` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DE LA RED SOCIAL',
  `ENLACE` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'ENLACE DE LA RED SOCIAL DE LA EMPRESA',
  PRIMARY KEY (`COD_RED_SOCIAL`),
  KEY `COD_EMPRESA` (`COD_EMPRESA`),
  CONSTRAINT `TBL_REDES_SOCIALES_IBFK_1` FOREIGN KEY (`COD_EMPRESA`) REFERENCES `tbl_empresa` (`COD_EMPRESA`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_redes_sociales`
--

LOCK TABLES `tbl_redes_sociales` WRITE;
/*!40000 ALTER TABLE `tbl_redes_sociales` DISABLE KEYS */;
INSERT INTO `tbl_redes_sociales` VALUES (1,1,'FACEBOOK','https://www.facebook.com/estacion77/'),(2,1,'whatsapp','94877564'),(3,1,'Instagram','https://www.instagram.com/estacion_77/');
/*!40000 ALTER TABLE `tbl_redes_sociales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reembolso`
--

DROP TABLE IF EXISTS `tbl_reembolso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_reembolso` (
  `COD_REEMBOLSO` bigint(20) NOT NULL AUTO_INCREMENT,
  `COD_PEDIDO` bigint(20) NOT NULL,
  `COD_TRANSACCION` varchar(255) COLLATE utf8_swedish_ci NOT NULL,
  `DATOS_REEMBOLSO` text COLLATE utf8_swedish_ci NOT NULL,
  `OBSERVACION` text COLLATE utf8_swedish_ci NOT NULL,
  `STATUS` varchar(150) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`COD_REEMBOLSO`),
  KEY `COD_PEDIDO` (`COD_PEDIDO`),
  CONSTRAINT `TBL_REEMBOLSO_ibfk_1` FOREIGN KEY (`COD_PEDIDO`) REFERENCES `tbl_pedido` (`COD_PEDIDO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reembolso`
--

LOCK TABLES `tbl_reembolso` WRITE;
/*!40000 ALTER TABLE `tbl_reembolso` DISABLE KEYS */;
INSERT INTO `tbl_reembolso` VALUES (1,47,'36X95954BP875211P','{\"id\":\"36X95954BP875211P\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/36X95954BP875211P\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4C372163YS110874S\",\"rel\":\"up\",\"method\":\"GET\"}]}','AAA','COMPLETED'),(2,48,'9DA84135UY4368923','{\"id\":\"9DA84135UY4368923\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/9DA84135UY4368923\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4GE28682PD2061717\",\"rel\":\"up\",\"method\":\"GET\"}]}','PRODUCTO VENCIDO','COMPLETED'),(3,51,'8VA964105R132590V','{\"id\":\"8VA964105R132590V\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/8VA964105R132590V\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/4VD94482T8502422N\",\"rel\":\"up\",\"method\":\"GET\"}]}','BARRIO PELIGROSO','COMPLETED'),(10,79,'2T153544JR667693X','{\"id\":\"2T153544JR667693X\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/2T153544JR667693X\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/0D332664RV1063326\",\"rel\":\"up\",\"method\":\"GET\"}]}','Ya no lo necesita','COMPLETED'),(11,76,'9VD65814GR387780N','{\"id\":\"9VD65814GR387780N\",\"status\":\"COMPLETED\",\"links\":[{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/refunds\\/9VD65814GR387780N\",\"rel\":\"self\",\"method\":\"GET\"},{\"href\":\"https:\\/\\/api.sandbox.paypal.com\\/v2\\/payments\\/captures\\/34U490118K543832X\",\"rel\":\"up\",\"method\":\"GET\"}]}','Productos Vencido','COMPLETED');
/*!40000 ALTER TABLE `tbl_reembolso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_roles` (
  `COD_ROL` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE ROL',
  `NOM_ROL` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DEL ROL DEL USUARIO',
  `DESCRIPCION` text COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL TIPO DE ROL AL CUAL PERTENECE EL USUARIO',
  `COD_STATUS` int(11) NOT NULL COMMENT 'CODIGO DEL STATUS DEL ROL',
  PRIMARY KEY (`COD_ROL`),
  KEY `COD_STATUS` (`COD_STATUS`),
  KEY `COD_STATUS_2` (`COD_STATUS`),
  CONSTRAINT `TBL_ROLES_IBFK_1` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_roles`
--

LOCK TABLES `tbl_roles` WRITE;
/*!40000 ALTER TABLE `tbl_roles` DISABLE KEYS */;
INSERT INTO `tbl_roles` VALUES (1,'Administrador','Administrador',1),(2,'Cliente','Cliente',1),(3,'Proveedor','Proveedor',1),(4,'Encargado','Encargado de Tienda',1),(5,'FINANZAS','TESORA FINANZAS EMPRESA',0),(7,'REPARTIDOR','REPARTE PRODUCTO',0),(8,'Supervisor','Supervisor de la tienda',1),(10,'Motorista','Motorista de la tienda',0),(11,'Control de calidad','Controla imágenes y nombres de productos.',0),(12,'wewe55','werw',0),(13,'Editor','Editor de route 77',0),(14,'Contador route 77','Contador tienda Route 77',0),(15,'Contador Route','Contador tienda Route 77',0),(16,'Contador negocio','Contador tienda Route 77',0),(17,'Contador del negocio','Contador tienda Route 77',0);
/*!40000 ALTER TABLE `tbl_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_status` (
  `COD_STATUS` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL STATUS',
  `DESCRIPCION` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL STATUS',
  PRIMARY KEY (`COD_STATUS`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_status`
--

LOCK TABLES `tbl_status` WRITE;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
INSERT INTO `tbl_status` VALUES (0,'ELIMINADO'),(1,'ACTIVO'),(2,'INACTIVO');
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sucursal`
--

DROP TABLE IF EXISTS `tbl_sucursal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sucursal` (
  `COD_SUCURSAL` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE LA SUCURSAL',
  `NOMBRE` varchar(25) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'NOMBRE DE LA SUCURSAL',
  `DIRECCION` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DE LA SUCURSAL',
  PRIMARY KEY (`COD_SUCURSAL`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sucursal`
--

LOCK TABLES `tbl_sucursal` WRITE;
/*!40000 ALTER TABLE `tbl_sucursal` DISABLE KEYS */;
INSERT INTO `tbl_sucursal` VALUES (1,'Los Laureles','Calle Principal. Col. Los Laureles'),(2,'Las Hadas','Centro Comercial Las Hadas'),(3,'Santa Lucia','Santa Lucia, Frente A La Laguna');
/*!40000 ALTER TABLE `tbl_sucursal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_suscripciones`
--

DROP TABLE IF EXISTS `tbl_suscripciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_suscripciones` (
  `COD_SUSCRIPCION` bigint(20) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `EMAIL` varchar(200) COLLATE utf8mb4_swedish_ci NOT NULL,
  `FECHA_CREACION` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'FECHA EN LA QUE SE REGISTRO EL PRODUCTO',
  PRIMARY KEY (`COD_SUSCRIPCION`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_suscripciones`
--

LOCK TABLES `tbl_suscripciones` WRITE;
/*!40000 ALTER TABLE `tbl_suscripciones` DISABLE KEYS */;
INSERT INTO `tbl_suscripciones` VALUES (1,'Kevin Zuniga','kazro@gmail.com','2022-04-18 15:24:53'),(3,'Hola','prueba@gmail.com','2022-04-18 15:35:20'),(4,'Kevin','prueba@gmail.coom','2022-04-18 15:36:41'),(5,'Fer','fer@gmail.com','2022-04-18 15:38:18'),(6,'Reynaldo De Funes','ryn@gmail.com','2022-04-18 15:43:48'),(9,'Jafet De Montoya','reyluz@gmail.com','2022-04-18 15:47:36'),(10,'Leonela','chinos@gmail.com','2022-04-18 15:52:00'),(11,'Alejandra','ale@gmail.com','2022-04-18 17:33:28'),(12,'Jairo','jairo@gmail.com','2022-04-18 21:27:52'),(15,'Fernando Ortiz','josefortizsantos@gmail.com','2022-04-20 03:10:01'),(16,'Alejandra La Novia De Kevin','alejandraveca95@gmail.com','2022-04-20 03:20:03'),(17,'José','jfortizs@unah.hn','2022-04-20 03:26:31'),(18,'José','josefortizsantos@hotmail.com','2022-04-20 03:28:17'),(19,'Allyson G','allysongarcia993@gmail.com','2022-04-24 16:59:01'),(20,'Kevin R Zuniga','karro@gmail.com','2022-04-25 03:22:30'),(21,'Kevin R','gjgjf@gmail.com','2022-04-25 04:55:35');
/*!40000 ALTER TABLE `tbl_suscripciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_telefono_empresa`
--

DROP TABLE IF EXISTS `tbl_telefono_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_telefono_empresa` (
  `COD_TELEFONO_EMPRESA` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL TELÉFONO EMPRESARIAL',
  `COD_EMPRESA` bigint(20) NOT NULL COMMENT 'CÓDIGO DE LA EMPRESA',
  `TELEFONO` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'TELÉFONO DE LA EMPRESA',
  PRIMARY KEY (`COD_TELEFONO_EMPRESA`),
  KEY `COD_EMPRESA` (`COD_EMPRESA`),
  CONSTRAINT `TBL_TELEFONO_EMPRESA_IBFK_1` FOREIGN KEY (`COD_EMPRESA`) REFERENCES `tbl_empresa` (`COD_EMPRESA`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_telefono_empresa`
--

LOCK TABLES `tbl_telefono_empresa` WRITE;
/*!40000 ALTER TABLE `tbl_telefono_empresa` DISABLE KEYS */;
INSERT INTO `tbl_telefono_empresa` VALUES (1,1,'98990087'),(2,1,'96432601'),(3,1,'22634806');
/*!40000 ALTER TABLE `tbl_telefono_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_estado`
--

DROP TABLE IF EXISTS `tbl_tipo_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_estado` (
  `COD_ESTADO` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DE ESTADO',
  `DESCRIPCION` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL ESTADO',
  PRIMARY KEY (`COD_ESTADO`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_estado`
--

LOCK TABLES `tbl_tipo_estado` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_estado` DISABLE KEYS */;
INSERT INTO `tbl_tipo_estado` VALUES (1,'PENDIENTE'),(2,'APROBADO'),(3,'COMPLETO'),(4,'REEMBOLSADO'),(5,'CANCELADO'),(6,'ENTREGADO');
/*!40000 ALTER TABLE `tbl_tipo_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_pago`
--

DROP TABLE IF EXISTS `tbl_tipo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_pago` (
  `COD_TIPO_PAGO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL TIPO DE PAGO',
  `DESCRIPCION` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'DESCRIPCIÓN DEL TIPO DE PAGO',
  `TIPO_PAGO` varchar(25) COLLATE utf8mb4_swedish_ci DEFAULT NULL COMMENT 'NOMBRE DEL TIPO DE PAGO',
  `COD_STATUS` int(11) NOT NULL COMMENT 'ESTADO DEL TIPO DE PAGO',
  PRIMARY KEY (`COD_TIPO_PAGO`),
  KEY `COD_STATUS` (`COD_STATUS`),
  CONSTRAINT `TBL_TIPO_PAGO_IBFK_1` FOREIGN KEY (`COD_STATUS`) REFERENCES `tbl_status` (`COD_STATUS`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_pago`
--

LOCK TABLES `tbl_tipo_pago` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_pago` DISABLE KEYS */;
INSERT INTO `tbl_tipo_pago` VALUES (1,'PAYPAL','PAYPAL',1),(2,'EFECTIVO','EFECTIVO',1),(3,'CHEQUE','BANCO',1);
/*!40000 ALTER TABLE `tbl_tipo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuarios` (
  `COD_USUARIO` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'CÓDIGO DEL USUARIO',
  `COD_PERSONA` bigint(20) NOT NULL COMMENT 'CODIGO DE PERSONA',
  `COD_SUCURSAL` int(11) NOT NULL COMMENT 'CÓDIGO DE LA SUCURSAL DONDE PERTENECE EL USUARIO',
  `DNI` varchar(15) COLLATE utf8mb4_swedish_ci NOT NULL COMMENT 'IDENTIDAD DEL USUARIO',
  `COD_GENERO` int(11) NOT NULL COMMENT 'CÓDIGO DEL GÉNERO',
  PRIMARY KEY (`COD_USUARIO`),
  UNIQUE KEY `DNI` (`DNI`),
  KEY `COD_PERSONA` (`COD_PERSONA`),
  KEY `COD_SUCURSAL` (`COD_SUCURSAL`),
  KEY `COD_GENERO` (`COD_GENERO`),
  CONSTRAINT `TBL_USUARIOS_IBFK_1` FOREIGN KEY (`COD_PERSONA`) REFERENCES `tbl_personas` (`COD_PERSONA`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_USUARIOS_IBFK_2` FOREIGN KEY (`COD_SUCURSAL`) REFERENCES `tbl_sucursal` (`COD_SUCURSAL`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `TBL_USUARIOS_IBFK_3` FOREIGN KEY (`COD_GENERO`) REFERENCES `tbl_genero` (`COD_GENERO`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuarios`
--

LOCK TABLES `tbl_usuarios` WRITE;
/*!40000 ALTER TABLE `tbl_usuarios` DISABLE KEYS */;
INSERT INTO `tbl_usuarios` VALUES (1,1,1,'9098082123321',1),(4,13,1,'21652652',2),(17,32,1,'33895426',1),(33,49,1,'0801123989878',1),(34,50,1,'909808905',1),(35,51,1,'08011239894124',1),(36,52,1,'1234455667',1),(37,73,1,'0981289653108',1),(38,78,1,'9874563215235',1),(39,79,1,'0536555584205',2),(40,80,1,'5478962222222',1),(41,81,1,'0801195465488',2),(47,98,1,'0801123989872',1);
/*!40000 ALTER TABLE `tbl_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-12  2:24:28
