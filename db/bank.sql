CREATE DATABASE  IF NOT EXISTS `bank` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bank`;
-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bank
-- ------------------------------------------------------
-- Server version	8.0.16

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `balance` decimal(11,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(5) NOT NULL DEFAULT 'SEK',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=863058 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (355547,6,199520.96,'USD'),(529612,3,32449.54,'NOK'),(549855,10,828582.55,'NOK'),(573476,7,61028.84,'NOK'),(591838,1,53426.47,'SEK'),(628334,4,5672.00,'DKK'),(728059,8,99880.35,'DKK'),(742107,9,1000100.00,'SEK'),(788358,5,40179.10,'SEK'),(863057,2,206.25,'USD');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_amount` decimal(11,2) NOT NULL,
  `from_account` int(11) NOT NULL,
  `from_currency` varchar(5) NOT NULL DEFAULT 'SEK',
  `to_amount` decimal(11,2) NOT NULL,
  `to_account` int(11) NOT NULL,
  `to_currency` varchar(5) NOT NULL DEFAULT 'SEK',
  `currency_rate` decimal(10,3) NOT NULL DEFAULT '1.000',
  `date` timestamp NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `from_user_id` (`from_account`,`to_account`),
  KEY `to_user_id` (`to_account`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` VALUES (267,12.00,355547,'USD',110.14,529612,'NOK',9.178,'2020-02-06 06:39:00'),(268,100.00,573476,'NOK',10.90,355547,'USD',0.109,'2020-02-06 06:39:17'),(269,100.00,728059,'DKK',14.75,355547,'USD',0.148,'2020-02-06 06:43:54'),(270,100.00,728059,'DKK',14.75,355547,'USD',0.148,'2020-02-06 06:43:57');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobilephone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eugenius','McDougall','emcdougall0','MJvcqxlbNK','076-1234560'),(2,'Lion','Toyer','ltoyer1','1HUTP8BivQ17','076-1234561'),(3,'Blanca','Fussie','bfussie2','INdDBPs9UcW','076-1234562'),(4,'Giffer','Wilstead','gwilstead3','fYz2Bs','076-1234563'),(5,'Charlot','Waggatt','cwaggatt4','Qv69mr','076-1234564'),(6,'Huberto','Biggs','hbiggs5','iVulMzUQ7v1','076-1234565'),(7,'Drusi','Foskew','dfoskew6','4pShbrXSpTLK','076-1234566'),(8,'Sapphire','Vequaud','svequaud7','agN4Bzo3D','076-1234567'),(9,'Stephannie','Gotfrey','sgotfrey8','9LlRq8laWX','076-1234568'),(10,'Giulio','Arnli','garnli9','tSfZJjg','076-1234569');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_users`
--

DROP TABLE IF EXISTS `vw_users`;
/*!50001 DROP VIEW IF EXISTS `vw_users`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_users` AS SELECT 
 1 AS `id`,
 1 AS `firstName`,
 1 AS `lastName`,
 1 AS `username`,
 1 AS `password`,
 1 AS `mobilephone`,
 1 AS `account_id`,
 1 AS `balance`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'bank'
--

--
-- Dumping routines for database 'bank'
--

--
-- Final view structure for view `vw_users`
--

/*!50001 DROP VIEW IF EXISTS `vw_users`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_users` AS select `u`.`id` AS `id`,`u`.`firstName` AS `firstName`,`u`.`lastName` AS `lastName`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`mobilephone` AS `mobilephone`,`a`.`id` AS `account_id`,((select sum(`transactions`.`to_amount`) from `transactions` where (`transactions`.`to_account` = `a`.`id`)) - (select sum(`transactions`.`from_amount`) from `transactions` where (`transactions`.`from_account` = `a`.`id`))) AS `balance` from (`users` `u` join `account` `a` on((`a`.`user_id` = `u`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-06  7:59:59
