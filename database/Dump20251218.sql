-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: adiasoft2025
-- ------------------------------------------------------
-- Server version	8.0.44-0ubuntu0.24.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'Laptops','Equipos portátiles para trabajo y estudio'),(2,'Computadoras de Escritorio','PC armadas y preensambladas'),(3,'Monitores','Pantallas LED y LCD'),(4,'Teclados','Teclados mecánicos y de membrana'),(5,'Mouses','Ratones inalámbricos y cableados'),(6,'Almacenamiento','Discos duros, SSD y memorias USB'),(7,'Componentes','Procesadores, RAM, placas madre, tarjetas de video'),(8,'Impresoras','Impresoras láser e inkjet'),(9,'Redes','Routers, switches, tarjetas de red'),(10,'Audio','Audífonos, parlantes, micrófonos'),(11,'Accesorios','Pads, cables, soportes, mochilas'),(12,'Sillas Gamer','Sillas ergonómicas para gaming');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `documento` varchar(20) DEFAULT NULL,
  `nombres` varchar(120) NOT NULL,
  `apellidos` varchar(120) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'72856341','Juan','Ramírez López','987654321','juan.ramirez@gmail.com','Av. Los Álamos 123'),(2,'73561289','María','Vargas Torres','986532147','maria.vargas@gmail.com','Jr. San Martín 456'),(3,'74891235','Carlos','Pérez Huamán','985413267','carlos.perez@gmail.com','Av. La Marina 890'),(4,'75981234','Ana','García Soto','984512736','ana.garcia@hotmail.com','Av. Los Incas 320'),(5,'71234567','Pedro','Flores Salinas','983217654','pedro.flores@gmail.com','Calle Grau 123'),(6,'75678912','Lucía','Rojas Medina','981234567','lucia.rojas@gmail.com','Av. Arequipa 410'),(7,'74321987','Miguel','Cervantes Ugarte','982145673','miguel.cervantes@gmail.com','Av. Miraflores 245'),(8,'73459812','Rosa','Huamán Flores','984123567','rosa.huaman@gmail.com','Calle Tacna 321'),(9,'74561238','Luis','Chávez Gutiérrez','981237456','luis.chavez@gmail.com','Av. Venezuela 876'),(10,'73124576','Elena','Castillo Pineda','983145762','elena.castillo@gmail.com','Av. Lima 215'),(11,'71249856','Jorge','Valdivia Ramos','981234975','jorge.valdivia@gmail.com','Calle Puno 456'),(12,'72841653','Paola','Sánchez Torres','984316572','paola.sanchez@gmail.com','Av. Ejército 540'),(13,'73615482','Ricardo','Gutiérrez Silva','982541673','ricardo.gutierrez@gmail.com','Av. Salaverry 890'),(14,'74981265','Diana','Meza Cuadros','981267543','diana.meza@gmail.com','Av. Arequipa 620'),(15,'75346128','Héctor','Quispe Ramos','982134567','hector.quispe@gmail.com','Av. Kennedy 300'),(16,'74231689','Gabriela','Núñez Vega','981356748','gabriela.nunez@gmail.com','Calle Misti 102'),(17,'71459823','Sergio','Torres Yupanqui','983246518','sergio.torres@gmail.com','Av. La Salle 410'),(18,'73156829','Andrea','Contreras Poma','984561237','andrea.contreras@gmail.com','Jr. Libertad 450'),(19,'74619845','Rodrigo','Prieto Salas','985412367','rodrigo.prieto@gmail.com','Calle Pizarro 701'),(20,'75236419','Natalia','Cáceres Luna','986531247','natalia.caceres@gmail.com','Av. Los Quechuas 980'),(21,'71984562','Oscar','Montoya Ruiz','986421357','oscar.montoya@gmail.com','Av. La Cultura 420'),(22,'73695481','Liliana','Huertas Ramos','985316427','liliana.huertas@gmail.com','Av. Lima 760'),(23,'74123586','Kevin','Soto Medina','985416237','kevin.soto@gmail.com','Av. Dolores 620'),(24,'72364159','Daniela','Mamani Quispe','986234157','daniela.mamani@gmail.com','Calle Cusco 340'),(25,'75416293','Adrián','Palacios Rojas','982364157','adrian.palacios@gmail.com','Av. Kennedy 540'),(26,'71698234','Lorena','Vásquez Flores','983245671','lorena.vasquez@gmail.com','Av. Ejército 907'),(27,'73981245','Diego','Medina Silva','981364527','diego.medina@gmail.com','Av. Miraflores 120'),(28,'74816253','Ivana','Cruz Huarca','982635174','ivana.cruz@gmail.com','Jr. Pizarro 215'),(29,'72731984','Joel','Ríos Palomino','983246715','joel.rios@gmail.com','Av. La Paz 314'),(30,'75123986','Melisa','Guzmán Ramos','984613275','melisa.guzman@gmail.com','Av. Salaverry 540'),(31,'74215986','Gerson','Chumpitaz León','981246735','gerson.chumpitaz@gmail.com','Av. Lima 387'),(32,'71856429','Araceli','Torres Pinedo','982754316','araceli.torres@gmail.com','Calle Pocollay 230'),(33,'73648921','Tania','Mendoza Salas','982134675','tania.mendoza@gmail.com','Av. Arequipa 900'),(34,'71456928','Ramiro','Vargas Núñez','985271634','ramiro.vargas@gmail.com','Av. Ejército 234'),(35,'75231648','Valeria','Fernández Huerta','982613457','valeria.fernandez@gmail.com','Calle Piérola 650'),(36,'72136458','Marco','Ticona Ramos','981364215','marco.ticona@gmail.com','Av. Grau 890'),(37,'74921683','Fiorella','Tello Valdivia','984216357','fiorella.tello@gmail.com','Av. Perú 650'),(38,'73549821','Alonso','Silva Rojas','983215467','alonso.silva@gmail.com','Av. Miraflores 800'),(39,'74316958','Carmen','Jiménez Cayo','981246357','carmen.jimenez@gmail.com','Calle Atlántida 210'),(40,'72815649','Henry','Apaza Flores','982516437','henry.apaza@gmail.com','Av. Lima 940'),(41,'74859326','Camila','Torres Quispe','981263457','camila.torres@gmail.com','Av. San Juan 560'),(42,'73124598','Jhon','Quispe Huanca','981346572','jhon.quispe@gmail.com','Av. Arequipa 130'),(43,'71458963','Ariana','Loayza Cárdenas','982146375','ariana.loayza@gmail.com','Calle Bolívar 547'),(44,'73921586','Gino','Velarde Pinto','983167254','gino.velarde@gmail.com','Calle Cajamarca 620'),(45,'74591682','Karla','Espinoza Torres','984125673','karla.espinoza@gmail.com','Av. Lima 1050'),(46,'75246913','Mauricio','Ochoa Soto','981257634','mauricio.ochoa@gmail.com','Av. Miraflores 740'),(47,'71654382','Tatiana','Reyes Arias','982516374','tatiana.reyes@gmail.com','Av. Dolores 870'),(48,'74312569','Alex','Gamarra Rojas','981453267','alex.gamarra@gmail.com','Av. Grau 410'),(49,'73294851','Nicol','Quispe Medina','982764153','nicol.quispe@gmail.com','Av. La Cultura 760'),(50,'74192653','Samantha','Muñoz López','984126753','samantha.munoz@gmail.com','Calle Pizarro 890');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compras`
--

DROP TABLE IF EXISTS `compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compras` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `id_proveedor` int NOT NULL,
  `id_usuario` int NOT NULL,
  `fecha_compra` datetime DEFAULT CURRENT_TIMESTAMP,
  `subtotal` decimal(10,2) DEFAULT '0.00',
  `igv` decimal(10,2) DEFAULT '0.00',
  `total` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id_compra`),
  KEY `fk_compra_proveedor` (`id_proveedor`),
  KEY `fk_compra_usuario` (`id_usuario`),
  CONSTRAINT `fk_compra_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`),
  CONSTRAINT `fk_compra_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compras`
--

LOCK TABLES `compras` WRITE;
/*!40000 ALTER TABLE `compras` DISABLE KEYS */;
INSERT INTO `compras` VALUES (1,1,1,'2025-10-11 00:00:00',9569.49,1722.51,11292.00),(2,2,3,'2025-10-13 00:00:00',9825.08,1768.52,11593.60),(3,3,5,'2025-10-16 00:00:00',7436.44,1338.56,8775.00),(4,4,2,'2025-10-18 00:00:00',4667.80,840.20,5508.00),(5,5,4,'2025-10-21 00:00:00',8889.58,1600.12,10489.70),(6,6,7,'2025-10-23 00:00:00',8552.29,1539.41,10091.70),(7,7,10,'2025-10-26 00:00:00',19233.05,3461.95,22695.00),(8,8,8,'2025-10-28 00:00:00',9547.46,1718.54,11266.00),(9,9,6,'2025-10-31 00:00:00',1833.05,329.95,2163.00),(10,10,9,'2025-11-02 00:00:00',11674.58,2101.42,13776.00),(11,11,3,'2025-11-05 00:00:00',3850.85,693.15,4544.00),(12,12,4,'2025-11-07 00:00:00',9160.17,1648.83,10809.00),(13,13,2,'2025-11-10 00:00:00',9982.71,1796.89,11779.60),(14,14,6,'2025-11-12 00:00:00',654.24,117.76,772.00),(15,15,1,'2025-11-15 00:00:00',8049.66,1448.94,9498.60),(16,16,5,'2025-11-17 00:00:00',10249.15,1844.85,12094.00),(17,17,9,'2025-11-20 00:00:00',14488.98,2608.02,17097.00),(18,18,7,'2025-11-22 00:00:00',1601.69,288.31,1890.00),(19,19,10,'2025-11-25 00:00:00',6597.46,1187.54,7785.00),(20,20,3,'2025-11-27 00:00:00',8556.36,1540.14,10096.50),(21,21,1,'2025-11-30 00:00:00',7857.29,1414.31,9271.60),(22,22,4,'2025-12-02 00:00:00',12229.66,2201.34,14431.00),(23,23,8,'2025-12-05 00:00:00',5283.90,951.10,6235.00),(24,24,6,'2025-12-07 00:00:00',10584.41,1905.19,12489.60),(25,25,7,'2025-12-10 00:00:00',8894.07,1600.93,10495.00);
/*!40000 ALTER TABLE `compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configuracion` (
  `id_config` int NOT NULL AUTO_INCREMENT,
  `moneda` varchar(10) NOT NULL,
  `simbolo` varchar(5) NOT NULL,
  `igv` decimal(5,2) NOT NULL,
  `incluye_igv` tinyint(1) DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_config`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'PEN','S/.',18.00,1,'2025-12-15 06:09:34');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_compra`
--

DROP TABLE IF EXISTS `detalle_compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_compra` (
  `id_detalle_compra` int NOT NULL AUTO_INCREMENT,
  `id_compra` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_compra`),
  KEY `fk_dcompra_compra` (`id_compra`),
  KEY `fk_dcompra_producto` (`id_producto`),
  CONSTRAINT `fk_dcompra_compra` FOREIGN KEY (`id_compra`) REFERENCES `compras` (`id_compra`),
  CONSTRAINT `fk_dcompra_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_compra`
--

LOCK TABLES `detalle_compra` WRITE;
/*!40000 ALTER TABLE `detalle_compra` DISABLE KEYS */;
INSERT INTO `detalle_compra` VALUES (1,1,3,3,3499.00,10497.00),(2,1,14,5,159.00,795.00),(3,2,1,4,1999.90,7999.60),(4,2,9,6,599.00,3594.00),(5,3,7,5,1599.00,7995.00),(6,3,23,6,130.00,780.00),(7,4,10,4,1199.00,4796.00),(8,4,17,8,89.00,712.00),(9,5,5,3,2899.90,8699.70),(10,5,26,10,179.00,1790.00),(11,6,2,3,2299.90,6899.70),(12,6,11,8,399.00,3192.00),(13,7,8,4,5599.00,22396.00),(14,7,13,10,29.90,299.00),(15,8,4,6,1599.00,9594.00),(16,8,29,8,209.00,1672.00),(17,9,15,7,89.00,623.00),(18,9,21,10,25.00,250.00),(19,9,33,10,129.00,1290.00),(20,10,6,4,3299.00,13196.00),(21,10,24,20,29.00,580.00),(22,11,12,6,699.00,4194.00),(23,11,41,10,35.00,350.00),(24,12,3,3,3499.00,10497.00),(25,12,44,8,39.00,312.00),(26,13,5,4,2899.90,11599.60),(27,13,18,6,30.00,180.00),(28,14,22,10,30.00,300.00),(29,14,37,8,59.00,472.00),(30,15,2,4,2299.90,9199.60),(31,15,13,10,29.90,299.00),(32,16,7,6,1599.00,9594.00),(33,16,30,10,250.00,2500.00),(34,17,8,3,5599.00,16797.00),(35,17,18,10,30.00,300.00),(36,18,15,10,89.00,890.00),(37,18,23,5,130.00,650.00),(38,18,45,10,35.00,350.00),(39,19,10,5,1199.00,5995.00),(40,19,26,10,179.00,1790.00),(41,20,6,3,3299.00,9897.00),(42,20,16,5,39.90,199.50),(43,21,1,4,1999.90,7999.60),(44,21,14,8,159.00,1272.00),(45,22,3,4,3499.00,13996.00),(46,22,24,15,29.00,435.00),(47,23,12,4,699.00,2796.00),(48,23,11,6,399.00,2394.00),(49,23,29,5,209.00,1045.00),(50,24,5,4,2899.90,11599.60),(51,24,17,10,89.00,890.00),(52,25,4,5,1599.00,7995.00),(53,25,30,10,250.00,2500.00);
/*!40000 ALTER TABLE `detalle_compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NOT NULL,
  `id_producto` int NOT NULL,
  `cantidad` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_detalle_venta`),
  KEY `fk_dventa_venta` (`id_venta`),
  KEY `fk_dventa_producto` (`id_producto`),
  CONSTRAINT `fk_dventa_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `fk_dventa_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,1,1,5,1999.90,9999.50),(2,1,21,6,129.00,774.00),(3,2,9,4,599.00,2396.00),(4,2,22,7,299.00,2093.00),(5,3,13,5,29.90,149.50),(6,3,17,4,39.90,159.60),(7,4,25,8,89.00,712.00),(8,4,29,6,899.00,5394.00),(9,5,5,4,2899.90,11599.60),(10,5,26,7,159.00,1113.00),(11,6,11,4,399.00,1596.00),(12,6,9,4,599.00,2396.00),(13,7,45,7,999.00,6993.00),(14,7,24,6,29.00,174.00),(15,8,33,6,139.00,834.00),(16,8,2,5,2299.90,11499.50),(17,9,17,4,39.90,159.60),(18,9,14,4,159.00,636.00),(19,10,6,5,3299.00,16495.00),(20,10,21,7,129.00,903.00),(21,11,1,4,1999.90,7999.60),(22,11,23,8,179.00,1432.00),(23,12,3,5,3499.00,17495.00),(24,12,14,5,159.00,795.00),(25,13,9,4,599.00,2396.00),(26,13,27,6,899.00,5394.00),(27,14,11,4,399.00,1596.00),(28,14,18,6,89.00,534.00),(29,15,2,6,2299.90,13799.40),(30,15,37,7,39.00,273.00),(31,16,12,4,699.00,2796.00),(32,16,26,6,159.00,954.00),(33,17,7,5,1599.00,7995.00),(34,17,15,6,399.00,2394.00),(35,18,8,4,5599.00,22396.00),(36,18,24,7,29.00,203.00),(37,19,10,4,1199.00,4796.00),(38,19,21,7,129.00,903.00),(39,20,3,4,3499.00,13996.00),(40,20,40,8,399.00,3192.00),(41,21,1,6,1999.90,11999.40),(42,21,14,5,159.00,795.00),(43,22,7,5,1599.00,7995.00),(44,22,20,6,49.90,299.40),(45,23,9,4,599.00,2396.00),(46,23,23,7,179.00,1253.00),(47,24,12,5,699.00,3495.00),(48,24,13,4,29.90,119.60),(49,25,2,4,2299.90,9199.60),(50,25,35,5,35.00,175.00),(51,26,4,7,1599.00,11193.00),(52,26,14,4,159.00,636.00),(53,27,5,6,2899.90,17399.40),(54,27,23,5,179.00,895.00),(55,28,10,5,1199.00,5995.00),(56,28,37,5,39.00,195.00),(57,29,6,6,3299.00,19794.00),(58,29,39,8,129.00,1032.00),(59,30,7,4,1599.00,6396.00),(60,30,21,7,129.00,903.00),(61,31,3,5,3499.00,17495.00),(62,31,13,4,29.90,119.60),(63,32,11,4,399.00,1596.00),(64,32,24,6,29.00,174.00),(65,33,8,7,5599.00,39193.00),(66,33,19,7,149.00,1043.00),(67,34,1,6,1999.90,11999.40),(68,34,13,4,29.90,119.60),(69,35,12,5,699.00,3495.00),(70,35,41,7,59.00,413.00),(71,36,15,6,399.00,2394.00),(72,36,25,8,89.00,712.00),(73,37,18,5,89.00,445.00),(74,37,29,7,899.00,6293.00),(75,38,2,4,2299.90,9199.60),(76,38,38,6,179.00,1074.00),(77,39,7,7,1599.00,11193.00),(78,39,16,6,39.90,239.40),(79,40,9,4,599.00,2396.00),(80,40,13,4,29.90,119.60),(81,41,1,7,1999.90,13999.30),(82,41,42,7,25.00,175.00),(83,42,10,6,1199.00,7194.00),(84,42,37,7,39.00,273.00),(85,43,3,5,3499.00,17495.00),(86,43,21,6,129.00,774.00),(87,44,4,4,1599.00,6396.00),(88,44,23,5,179.00,895.00),(89,45,7,6,1599.00,9594.00),(90,45,44,8,99.00,792.00),(91,46,5,6,2899.90,17399.40),(92,46,13,4,29.90,119.60),(93,47,2,5,2299.90,11499.50),(94,47,43,6,49.00,294.00),(95,48,8,6,5599.00,33594.00),(96,48,13,4,29.90,119.60),(97,49,11,6,399.00,2394.00),(98,49,25,8,89.00,712.00),(99,50,3,7,3499.00,24493.00),(100,50,14,5,159.00,795.00),(101,51,35,1,35.00,35.00);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `stock_actual` int DEFAULT '0',
  PRIMARY KEY (`id_inventario`),
  KEY `fk_inventario_producto` (`id_producto`),
  CONSTRAINT `fk_inventario_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (1,1,0),(2,2,0),(3,3,0),(4,4,5),(5,5,0),(6,6,0),(7,7,0),(8,8,0),(9,9,0),(10,10,0),(11,11,4),(12,12,2),(13,13,1),(14,14,0),(15,15,7),(16,16,9),(17,17,20),(18,18,10),(19,19,0),(20,20,2),(21,21,0),(22,22,11),(23,23,0),(24,24,36),(25,25,0),(26,26,12),(27,27,0),(28,28,2),(29,29,3),(30,30,23),(31,31,3),(32,32,3),(33,33,14),(34,34,8),(35,35,4),(36,36,5),(37,37,9),(38,38,0),(39,39,2),(40,40,0),(41,41,13),(42,42,13),(43,43,9),(44,44,5),(45,45,5),(46,46,3),(47,47,5),(48,48,2);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_sistema`
--

DROP TABLE IF EXISTS `log_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_sistema` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `tabla` varchar(100) DEFAULT NULL,
  `operacion` varchar(20) DEFAULT NULL,
  `descripcion` text,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_sistema`
--

LOCK TABLES `log_sistema` WRITE;
/*!40000 ALTER TABLE `log_sistema` DISABLE KEYS */;
INSERT INTO `log_sistema` VALUES (1,'usuarios','INSERT','Registro de nuevo usuario administrador','2025-12-15 01:09:34'),(2,'roles','INSERT','Creación de roles del sistema','2025-12-15 01:09:34'),(3,'usuarios_roles','INSERT','Asignación de roles iniciales','2025-12-15 01:09:34'),(4,'clientes','INSERT','Registro de cliente Juan Ramírez','2025-12-15 01:09:34'),(5,'productos','INSERT','Carga inicial de productos tecnológicos','2025-12-15 01:09:34'),(6,'categorias','INSERT','Registro de categorías tecnológicas','2025-12-15 01:09:34'),(7,'proveedores','INSERT','Ingreso de proveedores principales','2025-12-15 01:09:34'),(8,'compras','INSERT','Compra inicial de mercadería','2025-12-15 01:09:34'),(9,'detalle_compra','INSERT','Registro de productos en la compra 001','2025-12-15 01:09:34'),(10,'inventario','UPDATE','Actualización de stock tras compra inicial','2025-12-15 01:09:34'),(11,'ventas','INSERT','Venta registrada al cliente María Vargas','2025-12-15 01:09:34'),(12,'detalle_venta','INSERT','Producto vendido en la venta 001','2025-12-15 01:09:34'),(13,'pago_venta','INSERT','Pago registrado con método Yape','2025-12-15 01:09:34'),(14,'movimiento_inventario','INSERT','Salida de inventario por venta','2025-12-15 01:09:34'),(15,'inventario','UPDATE','Reducción de stock por venta','2025-12-15 01:09:34'),(16,'log_sistema','INSERT','Registro de evento automático','2025-12-15 01:09:34'),(17,'clientes','UPDATE','Actualización de datos de cliente','2025-12-15 01:09:34'),(18,'usuarios','UPDATE','Modificación de datos de usuario','2025-12-15 01:09:34'),(19,'productos','UPDATE','Modificación de precios','2025-12-15 01:09:34'),(20,'compras','UPDATE','Corrección del total','2025-12-15 01:09:34'),(21,'detalle_compra','UPDATE','Ajuste en cantidades adquiridas','2025-12-15 01:09:34'),(22,'inventario','UPDATE','Ajuste por diferencia de stock','2025-12-15 01:09:34'),(23,'movimiento_inventario','INSERT','Ajuste de inventario negativo','2025-12-15 01:09:34'),(24,'ventas','UPDATE','Actualización de venta por error en detalle','2025-12-15 01:09:34'),(25,'detalle_venta','UPDATE','Corrección de unidades vendidas','2025-12-15 01:09:34'),(26,'pago_venta','UPDATE','Actualización del método de pago','2025-12-15 01:09:34'),(27,'usuarios_roles','INSERT','Asignación de nuevo rol','2025-12-15 01:09:34'),(28,'roles','UPDATE','Corrección de descripción de rol','2025-12-15 01:09:34'),(29,'clientes','DELETE','Eliminación de cliente duplicado','2025-12-15 01:09:34'),(30,'productos','DELETE','Eliminación de producto discontinuado','2025-12-15 01:09:34'),(31,'inventario','UPDATE','Ajuste por conteo físico','2025-12-15 01:09:34'),(32,'compras','INSERT','Nueva compra registrada','2025-12-15 01:09:34'),(33,'detalle_compra','INSERT','Productos añadidos en compra nueva','2025-12-15 01:09:34'),(34,'ventas','INSERT','Nueva venta registrada','2025-12-15 01:09:34'),(35,'detalle_venta','INSERT','Detalle añadido en venta','2025-12-15 01:09:34'),(36,'pago_venta','INSERT','Pago registrado mediante Plin','2025-12-15 01:09:34'),(37,'movimiento_inventario','INSERT','Entrada de inventario por proveedor','2025-12-15 01:09:34'),(38,'usuarios','INSERT','Nuevo usuario vendedor registrado','2025-12-15 01:09:34'),(39,'clientes','INSERT','Ingreso de nuevo cliente','2025-12-15 01:09:34'),(40,'productos','INSERT','Producto agregado al catálogo','2025-12-15 01:09:34'),(41,'roles','INSERT','Nuevo rol creado','2025-12-15 01:09:34'),(42,'usuarios_roles','DELETE','Rol eliminado por el administrador','2025-12-15 01:09:34'),(43,'usuarios','UPDATE','Cambio de contraseña realizado','2025-12-15 01:09:34'),(44,'movimiento_inventario','UPDATE','Corrección en cantidad de ajuste','2025-12-15 01:09:34'),(45,'detalle_compra','DELETE','Eliminación de ítem duplicado','2025-12-15 01:09:34'),(46,'detalle_venta','DELETE','Eliminación de ítem erróneo','2025-12-15 01:09:34'),(47,'inventario','INSERT','Nuevo producto añadido con stock inicial','2025-12-15 01:09:34'),(48,'log_sistema','INSERT','Registro general del sistema','2025-12-15 01:09:34'),(49,'usuarios','LOGIN','Inicio de sesión exitoso del usuario admin','2025-12-15 01:09:34'),(50,'usuarios','LOGIN','Inicio de sesión fallido por contraseña incorrecta','2025-12-15 01:09:34'),(51,'ventas','INSERT','Nueva venta registrada ID=51 por usuario=41','2025-12-15 01:11:08'),(52,'ventas','INSERT','Venta registrada ID 51.','2025-12-15 01:11:08');
/*!40000 ALTER TABLE `log_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodo_pago`
--

DROP TABLE IF EXISTS `metodo_pago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodo_pago` (
  `id_metodo_pago` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_metodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodo_pago`
--

LOCK TABLES `metodo_pago` WRITE;
/*!40000 ALTER TABLE `metodo_pago` DISABLE KEYS */;
INSERT INTO `metodo_pago` VALUES (1,'Efectivo','Pago en efectivo'),(2,'Tarjeta','Pago con tarjeta débito/crédito'),(3,'Yape','Pago mediante Yape'),(4,'Plin','Pago mediante Plin');
/*!40000 ALTER TABLE `metodo_pago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimiento_inventario`
--

DROP TABLE IF EXISTS `movimiento_inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimiento_inventario` (
  `id_movimiento` int NOT NULL AUTO_INCREMENT,
  `id_producto` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tipo` enum('entrada','salida','ajuste') NOT NULL,
  `cantidad` int NOT NULL,
  `motivo` varchar(255) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_movimiento`),
  KEY `fk_mov_producto` (`id_producto`),
  KEY `fk_mov_usuario` (`id_usuario`),
  CONSTRAINT `fk_mov_producto` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  CONSTRAINT `fk_mov_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimiento_inventario`
--

LOCK TABLES `movimiento_inventario` WRITE;
/*!40000 ALTER TABLE `movimiento_inventario` DISABLE KEYS */;
INSERT INTO `movimiento_inventario` VALUES (1,3,1,'entrada',3,NULL,'Compra #1','2025-12-15 01:09:34'),(2,14,1,'entrada',5,NULL,'Compra #1','2025-12-15 01:09:34'),(3,1,1,'entrada',4,NULL,'Compra #2','2025-12-15 01:09:34'),(4,9,1,'entrada',6,NULL,'Compra #2','2025-12-15 01:09:34'),(5,7,1,'entrada',5,NULL,'Compra #3','2025-12-15 01:09:34'),(6,23,1,'entrada',6,NULL,'Compra #3','2025-12-15 01:09:34'),(7,10,1,'entrada',4,NULL,'Compra #4','2025-12-15 01:09:34'),(8,17,1,'entrada',8,NULL,'Compra #4','2025-12-15 01:09:34'),(9,5,1,'entrada',3,NULL,'Compra #5','2025-12-15 01:09:34'),(10,26,1,'entrada',10,NULL,'Compra #5','2025-12-15 01:09:34'),(11,2,1,'entrada',3,NULL,'Compra #6','2025-12-15 01:09:34'),(12,11,1,'entrada',8,NULL,'Compra #6','2025-12-15 01:09:34'),(13,8,1,'entrada',4,NULL,'Compra #7','2025-12-15 01:09:34'),(14,13,1,'entrada',10,NULL,'Compra #7','2025-12-15 01:09:34'),(15,4,1,'entrada',6,NULL,'Compra #8','2025-12-15 01:09:34'),(16,29,1,'entrada',8,NULL,'Compra #8','2025-12-15 01:09:34'),(17,15,1,'entrada',7,NULL,'Compra #9','2025-12-15 01:09:34'),(18,21,1,'entrada',10,NULL,'Compra #9','2025-12-15 01:09:34'),(19,33,1,'entrada',10,NULL,'Compra #9','2025-12-15 01:09:34'),(20,6,1,'entrada',4,NULL,'Compra #10','2025-12-15 01:09:34'),(21,24,1,'entrada',20,NULL,'Compra #10','2025-12-15 01:09:34'),(22,12,1,'entrada',6,NULL,'Compra #11','2025-12-15 01:09:34'),(23,41,1,'entrada',10,NULL,'Compra #11','2025-12-15 01:09:34'),(24,3,1,'entrada',3,NULL,'Compra #12','2025-12-15 01:09:34'),(25,44,1,'entrada',8,NULL,'Compra #12','2025-12-15 01:09:34'),(26,5,1,'entrada',4,NULL,'Compra #13','2025-12-15 01:09:34'),(27,18,1,'entrada',6,NULL,'Compra #13','2025-12-15 01:09:34'),(28,22,1,'entrada',10,NULL,'Compra #14','2025-12-15 01:09:34'),(29,37,1,'entrada',8,NULL,'Compra #14','2025-12-15 01:09:34'),(30,2,1,'entrada',4,NULL,'Compra #15','2025-12-15 01:09:34'),(31,13,1,'entrada',10,NULL,'Compra #15','2025-12-15 01:09:34'),(32,7,1,'entrada',6,NULL,'Compra #16','2025-12-15 01:09:34'),(33,30,1,'entrada',10,NULL,'Compra #16','2025-12-15 01:09:34'),(34,8,1,'entrada',3,NULL,'Compra #17','2025-12-15 01:09:34'),(35,18,1,'entrada',10,NULL,'Compra #17','2025-12-15 01:09:34'),(36,15,1,'entrada',10,NULL,'Compra #18','2025-12-15 01:09:34'),(37,23,1,'entrada',5,NULL,'Compra #18','2025-12-15 01:09:34'),(38,45,1,'entrada',10,NULL,'Compra #18','2025-12-15 01:09:34'),(39,10,1,'entrada',5,NULL,'Compra #19','2025-12-15 01:09:34'),(40,26,1,'entrada',10,NULL,'Compra #19','2025-12-15 01:09:34'),(41,6,1,'entrada',3,NULL,'Compra #20','2025-12-15 01:09:34'),(42,16,1,'entrada',5,NULL,'Compra #20','2025-12-15 01:09:34'),(43,1,1,'entrada',4,NULL,'Compra #21','2025-12-15 01:09:34'),(44,14,1,'entrada',8,NULL,'Compra #21','2025-12-15 01:09:34'),(45,3,1,'entrada',4,NULL,'Compra #22','2025-12-15 01:09:34'),(46,24,1,'entrada',15,NULL,'Compra #22','2025-12-15 01:09:34'),(47,12,1,'entrada',4,NULL,'Compra #23','2025-12-15 01:09:34'),(48,11,1,'entrada',6,NULL,'Compra #23','2025-12-15 01:09:34'),(49,29,1,'entrada',5,NULL,'Compra #23','2025-12-15 01:09:34'),(50,5,1,'entrada',4,NULL,'Compra #24','2025-12-15 01:09:34'),(51,17,1,'entrada',10,NULL,'Compra #24','2025-12-15 01:09:34'),(52,4,1,'entrada',5,NULL,'Compra #25','2025-12-15 01:09:34'),(53,30,1,'entrada',10,NULL,'Compra #25','2025-12-15 01:09:34'),(64,1,1,'salida',5,NULL,'Venta #1','2025-12-15 01:09:34'),(65,21,1,'salida',6,NULL,'Venta #1','2025-12-15 01:09:34'),(66,9,1,'salida',4,NULL,'Venta #2','2025-12-15 01:09:34'),(67,22,1,'salida',7,NULL,'Venta #2','2025-12-15 01:09:34'),(68,13,1,'salida',5,NULL,'Venta #3','2025-12-15 01:09:34'),(69,17,1,'salida',4,NULL,'Venta #3','2025-12-15 01:09:34'),(70,25,1,'salida',8,NULL,'Venta #4','2025-12-15 01:09:34'),(71,29,1,'salida',6,NULL,'Venta #4','2025-12-15 01:09:34'),(72,5,1,'salida',4,NULL,'Venta #5','2025-12-15 01:09:34'),(73,26,1,'salida',7,NULL,'Venta #5','2025-12-15 01:09:34'),(74,11,1,'salida',4,NULL,'Venta #6','2025-12-15 01:09:34'),(75,9,1,'salida',4,NULL,'Venta #6','2025-12-15 01:09:34'),(76,45,1,'salida',7,NULL,'Venta #7','2025-12-15 01:09:34'),(77,24,1,'salida',6,NULL,'Venta #7','2025-12-15 01:09:34'),(78,33,1,'salida',6,NULL,'Venta #8','2025-12-15 01:09:34'),(79,2,1,'salida',5,NULL,'Venta #8','2025-12-15 01:09:34'),(80,17,1,'salida',4,NULL,'Venta #9','2025-12-15 01:09:34'),(81,14,1,'salida',4,NULL,'Venta #9','2025-12-15 01:09:34'),(82,6,1,'salida',5,NULL,'Venta #10','2025-12-15 01:09:34'),(83,21,1,'salida',7,NULL,'Venta #10','2025-12-15 01:09:34'),(84,1,1,'salida',4,NULL,'Venta #11','2025-12-15 01:09:34'),(85,23,1,'salida',8,NULL,'Venta #11','2025-12-15 01:09:34'),(86,3,1,'salida',5,NULL,'Venta #12','2025-12-15 01:09:34'),(87,14,1,'salida',5,NULL,'Venta #12','2025-12-15 01:09:34'),(88,9,1,'salida',4,NULL,'Venta #13','2025-12-15 01:09:34'),(89,27,1,'salida',6,NULL,'Venta #13','2025-12-15 01:09:34'),(90,11,1,'salida',4,NULL,'Venta #14','2025-12-15 01:09:34'),(91,18,1,'salida',6,NULL,'Venta #14','2025-12-15 01:09:34'),(92,2,1,'salida',6,NULL,'Venta #15','2025-12-15 01:09:34'),(93,37,1,'salida',7,NULL,'Venta #15','2025-12-15 01:09:34'),(94,12,1,'salida',4,NULL,'Venta #16','2025-12-15 01:09:34'),(95,26,1,'salida',6,NULL,'Venta #16','2025-12-15 01:09:34'),(96,7,1,'salida',5,NULL,'Venta #17','2025-12-15 01:09:34'),(97,15,1,'salida',6,NULL,'Venta #17','2025-12-15 01:09:34'),(98,8,1,'salida',4,NULL,'Venta #18','2025-12-15 01:09:34'),(99,24,1,'salida',7,NULL,'Venta #18','2025-12-15 01:09:34'),(100,10,1,'salida',4,NULL,'Venta #19','2025-12-15 01:09:34'),(101,21,1,'salida',7,NULL,'Venta #19','2025-12-15 01:09:34'),(102,3,1,'salida',4,NULL,'Venta #20','2025-12-15 01:09:34'),(103,40,1,'salida',8,NULL,'Venta #20','2025-12-15 01:09:34'),(104,1,1,'salida',6,NULL,'Venta #21','2025-12-15 01:09:34'),(105,14,1,'salida',5,NULL,'Venta #21','2025-12-15 01:09:34'),(106,7,1,'salida',5,NULL,'Venta #22','2025-12-15 01:09:34'),(107,20,1,'salida',6,NULL,'Venta #22','2025-12-15 01:09:34'),(108,9,1,'salida',4,NULL,'Venta #23','2025-12-15 01:09:34'),(109,23,1,'salida',7,NULL,'Venta #23','2025-12-15 01:09:34'),(110,12,1,'salida',5,NULL,'Venta #24','2025-12-15 01:09:34'),(111,13,1,'salida',4,NULL,'Venta #24','2025-12-15 01:09:34'),(112,2,1,'salida',4,NULL,'Venta #25','2025-12-15 01:09:34'),(113,35,1,'salida',5,NULL,'Venta #25','2025-12-15 01:09:34'),(114,4,1,'salida',7,NULL,'Venta #26','2025-12-15 01:09:34'),(115,14,1,'salida',4,NULL,'Venta #26','2025-12-15 01:09:34'),(116,5,1,'salida',6,NULL,'Venta #27','2025-12-15 01:09:34'),(117,23,1,'salida',5,NULL,'Venta #27','2025-12-15 01:09:34'),(118,10,1,'salida',5,NULL,'Venta #28','2025-12-15 01:09:34'),(119,37,1,'salida',5,NULL,'Venta #28','2025-12-15 01:09:34'),(120,6,1,'salida',6,NULL,'Venta #29','2025-12-15 01:09:34'),(121,39,1,'salida',8,NULL,'Venta #29','2025-12-15 01:09:34'),(122,7,1,'salida',4,NULL,'Venta #30','2025-12-15 01:09:34'),(123,21,1,'salida',7,NULL,'Venta #30','2025-12-15 01:09:34'),(124,3,1,'salida',5,NULL,'Venta #31','2025-12-15 01:09:34'),(125,13,1,'salida',4,NULL,'Venta #31','2025-12-15 01:09:34'),(126,11,1,'salida',4,NULL,'Venta #32','2025-12-15 01:09:34'),(127,24,1,'salida',6,NULL,'Venta #32','2025-12-15 01:09:34'),(128,8,1,'salida',7,NULL,'Venta #33','2025-12-15 01:09:34'),(129,19,1,'salida',7,NULL,'Venta #33','2025-12-15 01:09:34'),(130,1,1,'salida',6,NULL,'Venta #34','2025-12-15 01:09:34'),(131,13,1,'salida',4,NULL,'Venta #34','2025-12-15 01:09:34'),(132,12,1,'salida',5,NULL,'Venta #35','2025-12-15 01:09:34'),(133,41,1,'salida',7,NULL,'Venta #35','2025-12-15 01:09:34'),(134,15,1,'salida',6,NULL,'Venta #36','2025-12-15 01:09:34'),(135,25,1,'salida',8,NULL,'Venta #36','2025-12-15 01:09:34'),(136,18,1,'salida',5,NULL,'Venta #37','2025-12-15 01:09:34'),(137,29,1,'salida',7,NULL,'Venta #37','2025-12-15 01:09:34'),(138,2,1,'salida',4,NULL,'Venta #38','2025-12-15 01:09:34'),(139,38,1,'salida',6,NULL,'Venta #38','2025-12-15 01:09:34'),(140,7,1,'salida',7,NULL,'Venta #39','2025-12-15 01:09:34'),(141,16,1,'salida',6,NULL,'Venta #39','2025-12-15 01:09:34'),(142,9,1,'salida',4,NULL,'Venta #40','2025-12-15 01:09:34'),(143,13,1,'salida',4,NULL,'Venta #40','2025-12-15 01:09:34'),(144,1,1,'salida',7,NULL,'Venta #41','2025-12-15 01:09:34'),(145,42,1,'salida',7,NULL,'Venta #41','2025-12-15 01:09:34'),(146,10,1,'salida',6,NULL,'Venta #42','2025-12-15 01:09:34'),(147,37,1,'salida',7,NULL,'Venta #42','2025-12-15 01:09:34'),(148,3,1,'salida',5,NULL,'Venta #43','2025-12-15 01:09:34'),(149,21,1,'salida',6,NULL,'Venta #43','2025-12-15 01:09:34'),(150,4,1,'salida',4,NULL,'Venta #44','2025-12-15 01:09:34'),(151,23,1,'salida',5,NULL,'Venta #44','2025-12-15 01:09:34'),(152,7,1,'salida',6,NULL,'Venta #45','2025-12-15 01:09:34'),(153,44,1,'salida',8,NULL,'Venta #45','2025-12-15 01:09:34'),(154,5,1,'salida',6,NULL,'Venta #46','2025-12-15 01:09:34'),(155,13,1,'salida',4,NULL,'Venta #46','2025-12-15 01:09:34'),(156,2,1,'salida',5,NULL,'Venta #47','2025-12-15 01:09:34'),(157,43,1,'salida',6,NULL,'Venta #47','2025-12-15 01:09:34'),(158,8,1,'salida',6,NULL,'Venta #48','2025-12-15 01:09:34'),(159,13,1,'salida',4,NULL,'Venta #48','2025-12-15 01:09:34'),(160,11,1,'salida',6,NULL,'Venta #49','2025-12-15 01:09:34'),(161,25,1,'salida',8,NULL,'Venta #49','2025-12-15 01:09:34'),(162,3,1,'salida',7,NULL,'Venta #50','2025-12-15 01:09:34'),(163,14,1,'salida',5,NULL,'Venta #50','2025-12-15 01:09:34'),(191,35,41,'salida',1,'Venta de producto','VENTA-51','2025-12-15 01:11:08');
/*!40000 ALTER TABLE `movimiento_inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pago_venta`
--

DROP TABLE IF EXISTS `pago_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pago_venta` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_venta` int NOT NULL,
  `id_metodo_pago` int NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_pago`),
  KEY `fk_pago_venta` (`id_venta`),
  KEY `fk_pago_metodo` (`id_metodo_pago`),
  CONSTRAINT `fk_pago_metodo` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodo_pago` (`id_metodo_pago`),
  CONSTRAINT `fk_pago_venta` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pago_venta`
--

LOCK TABLES `pago_venta` WRITE;
/*!40000 ALTER TABLE `pago_venta` DISABLE KEYS */;
INSERT INTO `pago_venta` VALUES (1,1,1,10773.50),(2,2,3,4489.00),(3,3,2,309.10),(4,4,3,6106.00),(5,5,3,12712.60),(6,6,2,3992.00),(7,7,3,7167.00),(8,8,3,12333.50),(9,9,4,795.60),(10,10,2,17398.00),(11,11,3,9431.60),(12,12,4,18290.00),(13,13,2,7790.00),(14,14,1,2130.00),(15,15,1,14072.40),(16,16,3,3750.00),(17,17,4,10389.00),(18,18,3,22599.00),(19,19,3,5699.00),(20,20,2,17188.00),(21,21,3,12794.40),(22,22,3,8294.40),(23,23,1,3649.00),(24,24,4,3614.60),(25,25,4,9374.60),(26,26,2,11829.00),(27,27,3,18294.40),(28,28,4,6190.00),(29,29,1,20826.00),(30,30,2,7299.00),(31,31,4,17614.60),(32,32,2,1770.00),(33,33,2,40236.00),(34,34,4,12119.00),(35,35,3,3908.00),(36,36,1,3106.00),(37,37,1,6738.00),(38,38,3,10273.60),(39,39,4,11432.40),(40,40,1,2515.60),(41,41,4,14174.30),(42,42,3,7467.00),(43,43,2,18269.00),(44,44,3,7291.00),(45,45,2,10386.00),(46,46,2,17519.00),(47,47,3,11793.50),(48,48,3,33713.60),(49,49,1,3106.00),(50,50,1,25288.00);
/*!40000 ALTER TABLE `pago_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int NOT NULL AUTO_INCREMENT,
  `id_categoria` int NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `estado` tinyint DEFAULT '1',
  PRIMARY KEY (`id_producto`),
  KEY `fk_producto_categoria` (`id_categoria`),
  CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,1,'Laptop HP 250 G8','Intel i5, 8GB RAM, 256GB SSD',1999.90,1),(2,1,'Laptop Lenovo IdeaPad 3','Ryzen 5, 8GB RAM, 512GB SSD',2299.90,1),(3,1,'Laptop ASUS VivoBook','Intel i7, 16GB RAM, 512GB SSD',3499.00,1),(4,1,'Laptop Acer Aspire 5','Intel i3, 8GB RAM, 256GB SSD',1599.00,1),(5,2,'PC Gamer Ryzen 5 5600G','16GB RAM, 512GB SSD',2899.90,1),(6,2,'PC Intel Core i5 10400F','16GB RAM, GTX 1650',3299.00,1),(7,2,'PC Oficina Dell Optiplex','8GB RAM, 256GB SSD',1599.00,1),(8,2,'PC Gamer Core i7 10700F','RTX 3060, 16GB RAM',5599.00,1),(9,3,'Monitor Samsung 24\"','IPS, 75Hz, Full HD',599.00,1),(10,3,'Monitor LG 27\"','IPS, 144Hz, QHD',1199.00,1),(11,3,'Monitor AOC 22\"','LED, Full HD',399.00,1),(12,3,'Monitor HP 24F','IPS, Full HD',699.00,1),(13,4,'Teclado Logitech K120','Teclado básico USB',29.90,1),(14,4,'Teclado Redragon Kumara','Mecánico RGB',159.00,1),(15,4,'Teclado Razer BlackWidow','Mecánico gamer',399.00,1),(16,4,'Teclado Genius Smart','Membrana silencioso',39.90,1),(17,5,'Mouse Logitech M170','Inalámbrico',39.90,1),(18,5,'Mouse Redragon Griffin','RGB gamer',89.00,1),(19,5,'Mouse Razer Viper Mini','Gamer ultraligero',149.00,1),(20,5,'Mouse HP X200','Inalámbrico',49.90,1),(21,6,'SSD Kingston 240GB','A400 2.5\"',129.00,1),(22,6,'SSD Samsung EVO 500GB','NVMe M.2',299.00,1),(23,6,'HDD Seagate 1TB','3.5\" SATA',179.00,1),(24,6,'USB Kingston 64GB','DT Exodia',29.00,1),(25,7,'Memoria RAM 8GB DDR4','Crucial 2666MHz',89.00,1),(26,7,'Memoria RAM 16GB DDR4','Corsair 3200MHz',159.00,1),(27,7,'Procesador Ryzen 5 5600X','12 hilos, 4.4GHz',899.00,1),(28,7,'Tarjeta Madre ASUS B450','AM4',459.00,1),(29,8,'Impresora Epson L3250','EcoTank inalámbrica',899.00,1),(30,8,'Impresora HP LaserJet 107w','Láser monocromática',599.00,1),(31,8,'Impresora Canon G3110','Multifuncional',699.00,1),(32,8,'Impresora Brother HL-L2320D','Dúplex automático',650.00,1),(33,9,'Router TP-Link Archer C6','1200Mbps',139.00,1),(34,9,'Switch TP-Link 8 Puertos','Gigabit',99.00,1),(35,9,'Adaptador WiFi USB','300Mbps',35.00,1),(36,9,'Router Huawei AX3','WiFi 6',199.00,1),(37,10,'Audífonos Logitech H111','Alámbricos',39.00,1),(38,10,'Micrófono Fifine K669','USB',179.00,1),(39,10,'Parlantes Logitech Z200','10W',129.00,1),(40,10,'Audífonos HyperX Cloud II','Gamer',399.00,1),(41,11,'Mouse Pad Grande RGB','XL',59.00,1),(42,11,'Cable HDMI 2.0 2m','Alta velocidad',25.00,1),(43,11,'Soporte para Laptop','Metálico plegable',49.00,1),(44,11,'Mochila Targus','Para laptop de 15.6\"',99.00,1),(45,12,'Silla Gamer DXRacer','Ergonómica premium',999.00,1),(46,12,'Silla Gamer Redragon','Respaldo alto',699.00,1),(47,12,'Silla Ergonómica Mesh','Apoyo lumbar',359.00,1),(48,12,'Silla Gamer HyperX','Con cojines',849.00,1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `id_proveedor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `ruc` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Deltron S.A.','20100070970','014235678','contacto@deltron.com.pe','Av. Venezuela 1580, Lima'),(2,'Memory Kings','20538765941','014567890','ventas@memorykings.com.pe','Av. Wilson 1234, Lima'),(3,'Infotec Perú','20457812390','014678345','info@infotec.com.pe','Av. Universitaria 345, Lima'),(4,'Yamoshi Computers','20657823451','014789321','ventas@yamoshi.com.pe','Av. Ejército 502, Arequipa'),(5,'Impacto Tecnología','20567483920','014678912','ventas@impacto.pe','Av. Garcilaso 140, Cusco'),(6,'Tecnosys Perú','20123456789','012345678','contacto@tecnosys.pe','Av. Grau 456, Lima'),(7,'Compuvision','20678934512','017895621','ventas@compuvision.pe','Jr. Puno 140, Lima'),(8,'PC Link','20598734120','017856439','info@pclink.pe','Av. Arequipa 410, Lima'),(9,'TecnoWorld','20634567812','017563412','contacto@tecnoworld.pe','Av. Mariscal 450, Trujillo'),(10,'Computronic','20576543821','016754321','ventas@computronic.pe','Av. La Marina 1300, Lima'),(11,'TechMaster','20599867231','016732167','contacto@techmaster.pe','Av. Salaverry 540, Lima'),(12,'CompuMarket','20687432210','016542317','ventas@compumarket.pe','Av. Los Incas 245, Cusco'),(13,'DigitalStore','20561347821','016321765','info@digitalstore.pe','Av. América Sur 980, Trujillo'),(14,'Infosec Perú','20612354987','016789543','contacto@infosec.pe','Av. Ejército 430, Arequipa'),(15,'TechImport','20698712345','016701234','ventas@techimport.pe','Av. Javier Prado 760, Lima'),(16,'PC Perú','20677123412','016789310','ventas@pcperu.pe','Av. La Cultura 300, Cusco'),(17,'HardTech','20612398467','016732589','ventas@hardtech.pe','Calle Mercaderes 100, Arequipa'),(18,'MegaTech','20589321045','016712349','info@megatech.pe','Av. Angamos 120, Lima'),(19,'ElectroPerú','20700321459','016789650','ventas@electroperu.pe','Av. Arequipa 650, Lima'),(20,'TecnoRed','20560781234','016789001','info@tecnored.pe','Av. Brasil 321, Lima'),(21,'RedSys','20655123477','015678923','contacto@redsys.pe','Av. Salaverry 900, Lima'),(22,'SysTech','20567123984','015678203','info@systech.pe','Av. América Norte 421, Trujillo'),(23,'PeruPC','20681234981','015612387','ventas@perupc.pe','Av. Dolores 410, Arequipa'),(24,'MicroDigital','20567123411','015632178','info@microdigital.pe','Av. Grau 1200, Lima'),(25,'HyperTech','20677234987','015684210','ventas@hypertech.pe','Av. Aviación 450, Lima'),(26,'CompuStar','20589237466','015617849','info@compustar.pe','Av. Pardo 300, Cusco'),(27,'CompuShop','20689127845','015789342','ventas@compushop.pe','Av. Independencia 890, Lima'),(28,'DigitalPro','20700123458','015789120','contacto@digitalpro.pe','Av. Miraflores 123, Arequipa'),(29,'TechGlobal','20567892341','015678439','info@techglobal.pe','Av. Los Próceres 801, Lima'),(30,'InfoTech','20567891245','015789634','ventas@infotech.pe','Av. La Marina 500, Lima'),(31,'TecnoPlus','20656789123','015789226','info@tecnoplus.pe','Av. España 320, Trujillo'),(32,'ByteCenter','20589912345','015786432','ventas@bytecenter.pe','Av. Kennedy 540, Arequipa'),(33,'CompuMega','20651234987','015786941','info@compumega.pe','Av. Angamos 403, Lima'),(34,'GigaStore','20699872145','015764839','ventas@gigastore.pe','Av. Brasil 201, Lima'),(35,'Digital Perú','20567834129','015786420','contacto@digitalperu.pe','Av. Miraflores 750, Trujillo'),(36,'PowerTech','20634598231','015678901','ventas@powertech.pe','Av. Kennedy 630, Arequipa'),(37,'MasterPC','20700672145','015623874','info@masterpc.pe','Av. Alfonso Ugarte 500, Lima'),(38,'Infotech Solutions','20567891022','015678221','ventas@infotechsolutions.pe','Av. Tacna 120, Lima'),(39,'SoftHardware','20678912045','015612309','info@softhardware.pe','Av. Perú 340, Lima'),(40,'TecnoVision','20567129847','015678145','ventas@tecnovision.pe','Av. Dolores 500, Arequipa'),(41,'PeruDigital','20678123901','015789554','contacto@perudigital.pe','Av. Mansiche 432, Trujillo'),(42,'TecnoByte','20689127345','015789211','info@tecnobyte.pe','Av. Pardo 251, Cusco'),(43,'MegaStore','20700123981','015789010','ventas@megastore.pe','Av. Universitaria 327, Lima'),(44,'DigitalMax','20655532110','015789221','ventas@digitalmax.pe','Av. España 900, Trujillo'),(45,'PC Global','20578932104','015789991','contacto@pcglobal.pe','Av. Lima 780, Arequipa'),(46,'TecHardware','20655567812','015789662','ventas@techardware.pe','Av. Las Begonias 401, Lima'),(47,'Electronix','20578912455','015789777','info@electronix.pe','Av. Miraflores 901, Trujillo'),(48,'MegaDigital','20667823149','015753109','ventas@megadigital.pe','Av. Ejército 511, Arequipa'),(49,'TecnoWare','20578934511','015789500','info@tecnoware.pe','Av. Angamos 310, Lima');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador','Acceso total al sistema'),(2,'Vendedor','Gestiona ventas y clientes'),(3,'Almacenero','Gestiona inventario y productos'),(4,'Supervisor','Supervisa actividades del sistema'),(5,'Tecnico','Brinda soporte técnico interno'),(6,'Invitado','Acceso limitado de solo lectura');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `estado` tinyint DEFAULT '1',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74839201','Carlos Alberto','Gómez Salazar','carlos.gomez@adiasoft.com','986541230',1,'2025-12-15 01:09:34'),(2,'mgutierrez','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72649182','María Fernanda','Gutiérrez Pinto','maria.gp@adiasoft.com','987321540',1,'2025-12-15 01:09:34'),(3,'jramirez','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','70328410','José Luis','Ramírez Huamán','jose.rh@adiasoft.com','965412387',1,'2025-12-15 01:09:34'),(4,'lquiroz','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74562381','Lucía Alejandra','Quiroz Medina','lucia.quiroz@adiasoft.com','951234766',1,'2025-12-15 01:09:34'),(5,'dvaldivia','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78123455','Diego Armando','Valdivia Soto','diego.valdivia@adiasoft.com','941256870',1,'2025-12-15 01:09:34'),(6,'rhuamani','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71324985','Rodrigo Manuel','Huamani Aedo','rodrigo.huamani@adiasoft.com','954123687',1,'2025-12-15 01:09:34'),(7,'jlopez','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','73241578','Javier','López Rivera','javier.lopez@adiasoft.com','987564210',1,'2025-12-15 01:09:34'),(8,'sofia.m','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72564391','Sofía','Martínez Ramos','sofia.mr@adiasoft.com','912345678',1,'2025-12-15 01:09:34'),(9,'karen.p','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74891236','Karen','Paredes Flores','karen.pf@adiasoft.com','965478321',1,'2025-12-15 01:09:34'),(10,'marco.t','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71928364','Marco Antonio','Tito Aguilar','marco.tito@adiasoft.com','998761234',1,'2025-12-15 01:09:34'),(11,'fserrano','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71823490','Fernando','Serrano Paz','fernando.serrano@adiasoft.com','922341780',1,'2025-12-15 01:09:34'),(12,'brenda.q','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','70234918','Brenda','Quispe Lazo','brenda.quispe@adiasoft.com','987654310',1,'2025-12-15 01:09:34'),(13,'ricardo.m','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','73829164','Ricardo','Mamani Choque','ricardo.mc@adiasoft.com','988123456',1,'2025-12-15 01:09:34'),(14,'alejandra.h','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','79234120','Alejandra','Huamán Torres','ale.huaman@adiasoft.com','952347810',1,'2025-12-15 01:09:34'),(15,'camila.v','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78123094','Camila','Vargas Cárdenas','camila.v@adiasoft.com','986543218',1,'2025-12-15 01:09:34'),(16,'andres.r','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','75643091','Andrés','Ríos Medina','andres.rios@adiasoft.com','945612308',1,'2025-12-15 01:09:34'),(17,'jessica.p','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','70491382','Jéssica','Puma Huanca','jessica.p@adiasoft.com','934568721',1,'2025-12-15 01:09:34'),(18,'juanr','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72659012','Juan','Rojas Núñez','juan.rojas@adiasoft.com','987650432',1,'2025-12-15 01:09:34'),(19,'melissa.s','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78541236','Melissa','Silva Torres','melissa.silva@adiasoft.com','912458760',1,'2025-12-15 01:09:34'),(20,'alvaro.c','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71589324','Álvaro','Cárdenas Flores','alvaro.cf@adiasoft.com','923456781',1,'2025-12-15 01:09:34'),(21,'pablo.r','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74851230','Pablo','Rivas Lozano','pablo.rivas@adiasoft.com','987001234',1,'2025-12-15 01:09:34'),(22,'susana.h','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','73658920','Susana','Huarcaya Álvarez','susana.h@adiasoft.com','923780451',1,'2025-12-15 01:09:34'),(23,'oscar.d','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72834910','Óscar','Durán Pérez','oscar.duran@adiasoft.com','951780234',1,'2025-12-15 01:09:34'),(24,'valeria.p','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71204598','Valeria','Puma Salas','valeria.ps@adiasoft.com','941258763',1,'2025-12-15 01:09:34'),(25,'fabiola.m','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78931254','Fabiola','Mendoza Chura','fabiola.mc@adiasoft.com','987651230',1,'2025-12-15 01:09:34'),(26,'renato.s','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72560193','Renato','Salas Mejía','renato.salas@adiasoft.com','987412365',1,'2025-12-15 01:09:34'),(27,'dayana.l','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78451263','Dayana','López Ponce','dayana.lp@adiasoft.com','954123760',1,'2025-12-15 01:09:34'),(28,'german.v','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74123658','Germán','Vilca Chambi','german.vc@adiasoft.com','963214587',1,'2025-12-15 01:09:34'),(29,'roxana.t','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72345109','Roxana','Torres Valdez','roxana.tv@adiasoft.com','912367894',1,'2025-12-15 01:09:34'),(30,'cesar.m','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74892015','César','Mamani Lima','cesar.ml@adiasoft.com','983457210',1,'2025-12-15 01:09:34'),(31,'edwin.f','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78231094','Edwin','Farfán Ccama','edwin.fc@adiasoft.com','998761230',1,'2025-12-15 01:09:34'),(32,'romina.z','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','71928301','Romina','Zegarra León','romina.zl@adiasoft.com','987000213',1,'2025-12-15 01:09:34'),(33,'martin.c','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','70456823','Martín','Castillo Torres','martin.ct@adiasoft.com','989345120',1,'2025-12-15 01:09:34'),(34,'paola.a','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74812930','Paola','Acuña Díaz','paola.ad@adiasoft.com','954780123',1,'2025-12-15 01:09:34'),(35,'victor.p','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','74981236','Víctor','Ponce Huarca','victor.ph@adiasoft.com','998345120',1,'2025-12-15 01:09:34'),(36,'rosario.m','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72769014','Rosario','Mamani Choque','rosario.mc@adiasoft.com','932450981',1,'2025-12-15 01:09:34'),(37,'carlos.v','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','75823910','Carlos','Vera Huerta','carlos.vera@adiasoft.com','963210548',1,'2025-12-15 01:09:34'),(38,'manuel.d','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','78456302','Manuel','Dávalos Cuno','manuel.dc@adiasoft.com','987412300',1,'2025-12-15 01:09:34'),(39,'leslie.r','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','72349810','Leslie','Ramos Flores','leslie.rf@adiasoft.com','954678321',1,'2025-12-15 01:09:34'),(40,'alexis.h','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','79123468','Alexis','Huillca Peña','alexis.hp@adiasoft.com','981236547',1,'2025-12-15 01:09:34'),(41,'loquita_apestosa','$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq','70707070','Nely','Mayta','nely@admin.com','999888777',1,'2025-12-15 01:09:34');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios_roles`
--

DROP TABLE IF EXISTS `usuarios_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios_roles` (
  `id_usuario` int NOT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`,`id_rol`),
  KEY `fk_ur_rol` (`id_rol`),
  CONSTRAINT `fk_ur_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `fk_ur_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios_roles`
--

LOCK TABLES `usuarios_roles` WRITE;
/*!40000 ALTER TABLE `usuarios_roles` DISABLE KEYS */;
INSERT INTO `usuarios_roles` VALUES (1,1),(41,1),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,3),(17,3),(18,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(25,3),(26,4),(27,4),(28,4),(29,4),(30,4),(31,4),(32,4),(33,4),(34,4),(35,4),(36,5),(37,5),(38,5),(39,5),(40,5);
/*!40000 ALTER TABLE `usuarios_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id_venta` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `fecha_venta` datetime DEFAULT CURRENT_TIMESTAMP,
  `subtotal` decimal(10,2) DEFAULT '0.00',
  `igv` decimal(10,2) DEFAULT '0.00',
  `total` decimal(10,2) DEFAULT '0.00',
  `estado` enum('ACTIVA','ANULADA') DEFAULT 'ACTIVA',
  PRIMARY KEY (`id_venta`),
  KEY `fk_venta_cliente` (`id_cliente`),
  KEY `fk_venta_usuario` (`id_usuario`),
  CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,1,1,'2025-11-11 00:00:00',9130.08,1643.42,10773.50,'ACTIVA'),(2,2,3,'2025-11-11 00:00:00',3804.24,684.76,4489.00,'ACTIVA'),(3,3,5,'2025-11-12 00:00:00',261.95,47.15,309.10,'ACTIVA'),(4,4,2,'2025-11-12 00:00:00',5174.58,931.42,6106.00,'ACTIVA'),(5,5,4,'2025-11-13 00:00:00',10773.39,1939.21,12712.60,'ACTIVA'),(6,6,7,'2025-11-14 00:00:00',3383.05,608.95,3992.00,'ACTIVA'),(7,7,10,'2025-11-14 00:00:00',6073.73,1093.27,7167.00,'ACTIVA'),(8,8,8,'2025-11-15 00:00:00',10452.12,1881.38,12333.50,'ACTIVA'),(9,9,6,'2025-11-16 00:00:00',674.24,121.36,795.60,'ACTIVA'),(10,10,9,'2025-11-16 00:00:00',14744.07,2653.93,17398.00,'ACTIVA'),(11,11,3,'2025-11-17 00:00:00',7992.88,1438.72,9431.60,'ACTIVA'),(12,12,4,'2025-11-17 00:00:00',15500.00,2790.00,18290.00,'ACTIVA'),(13,13,2,'2025-11-18 00:00:00',6601.69,1188.31,7790.00,'ACTIVA'),(14,14,6,'2025-11-19 00:00:00',1805.08,324.92,2130.00,'ACTIVA'),(15,15,1,'2025-11-19 00:00:00',11925.76,2146.64,14072.40,'ACTIVA'),(16,16,5,'2025-11-20 00:00:00',3177.97,572.03,3750.00,'ACTIVA'),(17,17,9,'2025-11-21 00:00:00',8804.24,1584.76,10389.00,'ACTIVA'),(18,18,7,'2025-11-21 00:00:00',19151.69,3447.31,22599.00,'ACTIVA'),(19,19,10,'2025-11-22 00:00:00',4829.66,869.34,5699.00,'ACTIVA'),(20,20,3,'2025-11-22 00:00:00',14566.10,2621.90,17188.00,'ACTIVA'),(21,21,1,'2025-11-23 00:00:00',10842.71,1951.69,12794.40,'ACTIVA'),(22,22,4,'2025-11-24 00:00:00',7029.15,1265.25,8294.40,'ACTIVA'),(23,23,8,'2025-11-24 00:00:00',3092.37,556.63,3649.00,'ACTIVA'),(24,24,6,'2025-11-25 00:00:00',3063.22,551.38,3614.60,'ACTIVA'),(25,25,7,'2025-11-26 00:00:00',7944.58,1430.02,9374.60,'ACTIVA'),(26,1,2,'2025-11-26 00:00:00',10024.58,1804.42,11829.00,'ACTIVA'),(27,2,5,'2025-11-27 00:00:00',15503.73,2790.67,18294.40,'ACTIVA'),(28,3,7,'2025-11-27 00:00:00',5245.76,944.24,6190.00,'ACTIVA'),(29,4,9,'2025-11-28 00:00:00',17649.15,3176.85,20826.00,'ACTIVA'),(30,5,10,'2025-11-29 00:00:00',6185.59,1113.41,7299.00,'ACTIVA'),(31,6,4,'2025-11-29 00:00:00',14927.63,2686.97,17614.60,'ACTIVA'),(32,7,1,'2025-11-30 00:00:00',1500.00,270.00,1770.00,'ACTIVA'),(33,8,3,'2025-11-30 00:00:00',34098.31,6137.69,40236.00,'ACTIVA'),(34,9,8,'2025-12-01 00:00:00',10270.34,1848.66,12119.00,'ACTIVA'),(35,10,6,'2025-12-02 00:00:00',3311.86,596.14,3908.00,'ACTIVA'),(36,11,9,'2025-12-02 00:00:00',2632.20,473.80,3106.00,'ACTIVA'),(37,12,1,'2025-12-03 00:00:00',5710.17,1027.83,6738.00,'ACTIVA'),(38,13,4,'2025-12-04 00:00:00',8706.44,1567.16,10273.60,'ACTIVA'),(39,14,3,'2025-12-04 00:00:00',9688.47,1743.93,11432.40,'ACTIVA'),(40,15,5,'2025-12-05 00:00:00',2131.86,383.74,2515.60,'ACTIVA'),(41,16,8,'2025-12-05 00:00:00',12012.12,2162.18,14174.30,'ACTIVA'),(42,17,6,'2025-12-06 00:00:00',6327.97,1139.03,7467.00,'ACTIVA'),(43,18,10,'2025-12-07 00:00:00',15482.20,2786.80,18269.00,'ACTIVA'),(44,19,2,'2025-12-07 00:00:00',6178.81,1112.19,7291.00,'ACTIVA'),(45,20,7,'2025-12-08 00:00:00',8801.69,1584.31,10386.00,'ACTIVA'),(46,21,3,'2025-12-09 00:00:00',14846.61,2672.39,17519.00,'ACTIVA'),(47,22,5,'2025-12-09 00:00:00',9994.49,1799.01,11793.50,'ACTIVA'),(48,23,9,'2025-12-10 00:00:00',28570.85,5142.75,33713.60,'ACTIVA'),(49,24,4,'2025-12-10 00:00:00',2632.20,473.80,3106.00,'ACTIVA'),(50,25,8,'2025-12-11 00:00:00',21430.51,3857.49,25288.00,'ACTIVA'),(51,40,41,'2025-12-15 01:11:08',29.66,5.34,35.00,'ACTIVA');
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-18 18:08:15
