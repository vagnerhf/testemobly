-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: mobly
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristica`
--
-- ORDER BY:  `id`

INSERT INTO `caracteristica` VALUES (1,'Característica 1','Descrição para Característica 1'),(2,'Característica 2','Descrição para Característica 2'),(3,'Característica 3','Descrição para Característica 3'),(4,'Característica 4','Descrição para Característica 4'),(5,'Característica 5','Descrição para Característica 5'),(6,'Característica 6','Descrição para Característica 6');

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--
-- ORDER BY:  `id`

INSERT INTO `categoria` VALUES (1,'Categoria 1','Descrição para Categoria 1'),(2,'Categoria 2','Descrição para Categoria 2'),(3,'Categoria 3','Descrição para Categoria 3');

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--
-- ORDER BY:  `version`

INSERT INTO `migration_versions` VALUES ('20180322222027'),('20180323175947'),('20180323190350'),('20180323190542'),('20180323191017'),('20180323194457'),('20180324201138'),('20180324202638');

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `endereco` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `complemento` longtext COLLATE utf8mb4_unicode_ci,
  `bairro` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrinho` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--
-- ORDER BY:  `id`

INSERT INTO `pedido` VALUES (1,'Vagner Henrique Ferreira','Av. Anton Philps','759',NULL,'Vila Herminia','[{\"preco\":\"100.00\",\"imagem\":\"http:\\/\\/joygayler.com\\/wp-content\\/uploads\\/2014\\/03\\/Product_Chair.jpg\",\"categorias\":[],\"caracteristicas\":[],\"quantidade\":1,\"id\":1,\"nome\":\"Produto 1\",\"descricao\":\"Uma descri\\u00e7\\u00e3o para o Produto 1\"},{\"preco\":\"500.00\",\"imagem\":\"http:\\/\\/joygayler.com\\/wp-content\\/uploads\\/2014\\/03\\/Product_Chair.jpg\",\"categorias\":[],\"caracteristicas\":[],\"quantidade\":1,\"id\":5,\"nome\":\"Produto 5\",\"descricao\":\"Uma descri\\u00e7\\u00e3o para o Produto 5\"},{\"preco\":\"900.00\",\"imagem\":\"http:\\/\\/joygayler.com\\/wp-content\\/uploads\\/2014\\/03\\/Product_Chair.jpg\",\"categorias\":[],\"caracteristicas\":[],\"quantidade\":1,\"id\":9,\"nome\":\"Produto 9\",\"descricao\":\"Uma descri\\u00e7\\u00e3o para o Produto 9\"}]');

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--
-- ORDER BY:  `id`

INSERT INTO `produto` VALUES (1,'Produto 1',100.00,'Uma descrição para o Produto 1','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(2,'Produto 2',200.00,'Uma descrição para o Produto 2','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(3,'Produto 3',300.00,'Uma descrição para o Produto 3','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(4,'Produto 4',400.00,'Uma descrição para o Produto 4','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(5,'Produto 5',500.00,'Uma descrição para o Produto 5','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(6,'Produto 6',600.00,'Uma descrição para o Produto 6','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(7,'Produto 7',700.00,'Uma descrição para o Produto 7','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(8,'Produto 8',800.00,'Uma descrição para o Produto 8','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(9,'Produto 9',900.00,'Uma descrição para o Produto 9','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg'),(10,'Produto 10',1000.00,'Uma descrição para o Produto 10','http://joygayler.com/wp-content/uploads/2014/03/Product_Chair.jpg');

--
-- Table structure for table `produtos_caracteristicas`
--

DROP TABLE IF EXISTS `produtos_caracteristicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_caracteristicas` (
  `id_produto` int(11) NOT NULL,
  `id_caracteristica` int(11) NOT NULL,
  PRIMARY KEY (`id_produto`,`id_caracteristica`),
  KEY `IDX_D673ED1D8231E0A7` (`id_produto`),
  KEY `IDX_D673ED1DA4FB134F` (`id_caracteristica`),
  CONSTRAINT `FK_D673ED1D8231E0A7` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  CONSTRAINT `FK_D673ED1DA4FB134F` FOREIGN KEY (`id_caracteristica`) REFERENCES `caracteristica` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_caracteristicas`
--
-- ORDER BY:  `id_produto`,`id_caracteristica`

INSERT INTO `produtos_caracteristicas` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(2,1),(2,2),(2,3),(3,4),(3,5),(3,6);

--
-- Table structure for table `produtos_categorias`
--

DROP TABLE IF EXISTS `produtos_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos_categorias` (
  `id_produto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_produto`,`id_categoria`),
  KEY `IDX_DC71F4A78231E0A7` (`id_produto`),
  KEY `IDX_DC71F4A7CE25AE0A` (`id_categoria`),
  CONSTRAINT `FK_DC71F4A78231E0A7` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  CONSTRAINT `FK_DC71F4A7CE25AE0A` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos_categorias`
--
-- ORDER BY:  `id_produto`,`id_categoria`

INSERT INTO `produtos_categorias` VALUES (1,1),(1,2),(1,3),(2,1),(3,1),(4,1),(5,2),(6,2),(7,2),(8,3),(9,3),(10,3);
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
