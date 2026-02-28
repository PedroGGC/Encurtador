-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: encurtador
-- ------------------------------------------------------
-- Server version	8.0.35-0ubuntu0.22.04.1
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `users`
--
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `users` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `users`
--
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */
;
INSERT INTO `users`
VALUES (
        1,
        'Admin User',
        'admin@example.com',
        NULL,
        '$2y$12$Q9U7KjI9X.S.F1GgYqR2eOVzHqCqR0jP8hP9B1J..C0b5C6F7DqLu',
        NULL,
        NOW(),
        NOW()
    );
/*!40000 ALTER TABLE `users` ENABLE KEYS */
;
--
-- Table structure for table `links`
--
DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `links` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
    `original_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
    `clicks` bigint unsigned NOT NULL DEFAULT '0',
    `last_click` timestamp NULL DEFAULT NULL,
    `user_id` bigint unsigned DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `links_code_unique` (`code`),
    KEY `links_user_id_foreign` (`user_id`),
    CONSTRAINT `links_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE
    SET NULL
) ENGINE = InnoDB AUTO_INCREMENT = 7 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping data for table `links`
--
LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */
;
INSERT INTO `links`
VALUES (
        1,
        'AbCdEf',
        'https://laravel.com',
        150,
        NOW(),
        1,
        NOW(),
        NOW()
    ),
    (
        2,
        'XyZ123',
        'https://github.com',
        342,
        NOW(),
        1,
        NOW(),
        NOW()
    ),
    (
        3,
        'QwErTy',
        'https://tailwindui.com',
        10,
        NOW(),
        1,
        NOW(),
        NOW()
    ),
    (
        4,
        'PoIuYt',
        'https://livewire.laravel.com',
        88,
        NOW(),
        1,
        NOW(),
        NOW()
    ),
    (
        5,
        'AsDfGh',
        'https://php.net',
        12,
        NOW(),
        1,
        NOW(),
        NOW()
    ),
    (
        6,
        'ZxCvBn',
        'https://example.com',
        5,
        NOW(),
        NULL,
        NOW(),
        NOW()
    );
/*!40000 ALTER TABLE `links` ENABLE KEYS */
;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */
;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2026-02-28