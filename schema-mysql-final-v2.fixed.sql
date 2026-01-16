-- ===========================================
-- Schema MySQL FINAL - Sclépios Gestion IA
-- Généré depuis Source/mysql_schema_gestion_ia.sql + patch roles
-- MySQL 8.0 / utf8mb4
-- ===========================================

CREATE DATABASE IF NOT EXISTS sclepios_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
USE sclepios_db;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- MySQL dump 10.13  Distrib 8.0.44, for Linux (aarch64)
--
-- Host: localhost    Database: gestion_ia
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `gestion_ia`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gestion_ia` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `gestion_ia`;

--
-- Table structure for table `ai_processing_log`
--

DROP TABLE IF EXISTS `ai_processing_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ai_processing_log` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `processing_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_used` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prompt_tokens` int DEFAULT NULL,
  `completion_tokens` int DEFAULT NULL,
  `total_tokens` int DEFAULT NULL,
  `result` json DEFAULT NULL,
  `confidence_score` decimal(3,2) DEFAULT NULL,
  `success` tinyint(1) NOT NULL,
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `processing_duration_ms` int DEFAULT NULL,
  `processed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ai_processing_log_thread` (`email_thread_id`),
  KEY `idx_ai_processing_log_processed_at` (`processed_at`),
  KEY `fk_ai_processing_log_processed_by` (`processed_by`),
  CONSTRAINT `fk_ai_processing_log_processed_by` FOREIGN KEY (`processed_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ai_processing_log_thread` FOREIGN KEY (`email_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ai_suggested_actions`
--

DROP TABLE IF EXISTS `ai_suggested_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ai_suggested_actions` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_type` enum('update_task','create_task','change_status','update_summary') COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_data` json NOT NULL,
  `confidence_score` decimal(3,2) DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reviewed_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reason` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `idx_ai_suggested_actions_status` (`status`),
  KEY `idx_ai_suggested_actions_etablissement` (`etablissement_id`),
  KEY `idx_ai_suggested_actions_thread` (`email_thread_id`),
  KEY `idx_ai_suggested_actions_created_at` (`created_at`),
  KEY `fk_ai_suggested_actions_reviewed_by` (`reviewed_by`),
  CONSTRAINT `fk_ai_suggested_actions_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ai_suggested_actions_reviewed_by` FOREIGN KEY (`reviewed_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_ai_suggested_actions_thread` FOREIGN KEY (`email_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `blocked_ips`
--

DROP TABLE IF EXISTS `blocked_ips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blocked_ips` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blocked_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `blocked_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_blocked_ips_ip` (`ip_address`),
  KEY `idx_blocked_ips_ip_address` (`ip_address`),
  KEY `fk_blocked_ips_blocked_by` (`blocked_by`),
  CONSTRAINT `fk_blocked_ips_blocked_by` FOREIGN KEY (`blocked_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calendar_events`
--

DROP TABLE IF EXISTS `calendar_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendar_events` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendar_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `location` text COLLATE utf8mb4_unicode_ci,
  `video_conference_url` text COLLATE utf8mb4_unicode_ci,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `all_day` tinyint(1) DEFAULT '0',
  `status` enum('confirmed','tentative','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'confirmed',
  `visibility` enum('public','private','default') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `recurrence_rule` text COLLATE utf8mb4_unicode_ci,
  `recurrence_parent_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recurrence_exception_dates` json DEFAULT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tache_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` text COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_calendar_events_calendar` (`calendar_id`),
  KEY `idx_calendar_events_dates` (`start_time`,`end_time`),
  KEY `idx_calendar_events_recurrence_parent` (`recurrence_parent_id`),
  KEY `idx_calendar_events_etablissement` (`etablissement_id`),
  KEY `idx_calendar_events_tache` (`tache_id`),
  KEY `fk_calendar_events_created_by` (`created_by`),
  CONSTRAINT `fk_calendar_events_calendar` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_calendar_events_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_calendar_events_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_calendar_events_recurrence_parent` FOREIGN KEY (`recurrence_parent_id`) REFERENCES `calendar_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_calendar_events_tache` FOREIGN KEY (`tache_id`) REFERENCES `taches` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calendar_shares`
--

DROP TABLE IF EXISTS `calendar_shares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendar_shares` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `calendar_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared_with_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shared_with_email` text COLLATE utf8mb4_unicode_ci,
  `permission` enum('read','write','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'read',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_calendar_shares_calendar_user` (`calendar_id`,`shared_with_user_id`),
  KEY `idx_calendar_shares_calendar` (`calendar_id`),
  KEY `idx_calendar_shares_user` (`shared_with_user_id`),
  KEY `fk_calendar_shares_created_by` (`created_by`),
  CONSTRAINT `fk_calendar_shares_calendar` FOREIGN KEY (`calendar_id`) REFERENCES `calendars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_calendar_shares_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_calendar_shares_shared_with_user` FOREIGN KEY (`shared_with_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `calendars`
--

DROP TABLE IF EXISTS `calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendars` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `color` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('personal','team','establishment','absences','shared') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `is_default` tinyint(1) DEFAULT '0',
  `is_visible` tinyint(1) DEFAULT '1',
  `timezone` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_calendars_owner` (`owner_id`),
  CONSTRAINT `fk_calendars_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `categories_taches`
--

DROP TABLE IF EXISTS `categories_taches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories_taches` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `ordre` int NOT NULL DEFAULT '0',
  `couleur` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_categories_taches_nom` (`nom`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text COLLATE utf8mb4_unicode_ci,
  `fonction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci,
  `telephone` text COLLATE utf8mb4_unicode_ci,
  `est_contact_principal` tinyint(1) DEFAULT '0',
  `type_contact` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_contacts_etablissement` (`etablissement_id`),
  CONSTRAINT `fk_contacts_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `document_audit_log`
--

DROP TABLE IF EXISTS `document_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_audit_log` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `document_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` enum('created','updated','renamed','downloaded','viewed','shared','unshared','permission_changed','deleted','restored','hard_deleted','version_created','tagged','relation_added','relation_removed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `performed_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `old_value` json DEFAULT NULL,
  `new_value` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_document_audit_document` (`document_id`),
  KEY `idx_document_audit_created_at` (`created_at`),
  KEY `idx_document_audit_action` (`action`),
  KEY `fk_document_audit_performed_by` (`performed_by`),
  CONSTRAINT `fk_document_audit_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_audit_performed_by` FOREIGN KEY (`performed_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `document_relations`
--

DROP TABLE IF EXISTS `document_relations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_relations` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_tache_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_contact_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_profile_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_partenaire_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_email_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_rd_user_story_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_support_ticket_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation_type` enum('source','deliverable','contrat','facture','rh','procedure','attachment','reference','archive','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'attachment',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_document_relations_document` (`document_id`),
  KEY `idx_document_relations_etablissement` (`related_etablissement_id`),
  KEY `idx_document_relations_tache` (`related_tache_id`),
  KEY `idx_document_relations_profile` (`related_profile_id`),
  KEY `fk_document_relations_contact` (`related_contact_id`),
  KEY `fk_document_relations_email_thread` (`related_email_thread_id`),
  KEY `fk_document_relations_created_by` (`created_by`),
  CONSTRAINT `fk_document_relations_contact` FOREIGN KEY (`related_contact_id`) REFERENCES `contacts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_relations_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_document_relations_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_relations_email_thread` FOREIGN KEY (`related_email_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_relations_etablissement` FOREIGN KEY (`related_etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_relations_profile` FOREIGN KEY (`related_profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_relations_tache` FOREIGN KEY (`related_tache_id`) REFERENCES `taches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `document_shares`
--

DROP TABLE IF EXISTS `document_shares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_shares` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared_with_user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission_level` enum('view','comment','edit','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shared_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_document_shares_document_user` (`document_id`,`shared_with_user_id`),
  KEY `idx_document_shares_document` (`document_id`),
  KEY `idx_document_shares_user` (`shared_with_user_id`),
  KEY `fk_document_shares_shared_by` (`shared_by`),
  CONSTRAINT `fk_document_shares_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_shares_shared_by` FOREIGN KEY (`shared_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_shares_shared_with` FOREIGN KEY (`shared_with_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `document_storage_quota`
--

DROP TABLE IF EXISTS `document_storage_quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_storage_quota` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quota_bytes` bigint DEFAULT '5368709120',
  `used_bytes` bigint DEFAULT '0',
  `last_updated` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_document_storage_quota_user` (`user_id`),
  CONSTRAINT `fk_document_storage_quota_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size_bytes` bigint NOT NULL,
  `mime_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_bucket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `tags` json DEFAULT NULL,
  `source_type` enum('direct_upload','migrated_tache','migrated_rh','migrated_email','migrated_rd','migrated_onboarding') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `version_number` int DEFAULT '1',
  `is_latest` tinyint(1) DEFAULT '1',
  `replaces_document_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_hard_deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_documents_storage_path` (`storage_path`(191)),
  KEY `idx_documents_created_by` (`created_by`),
  KEY `idx_documents_created_at` (`created_at`),
  KEY `idx_documents_deleted_at` (`deleted_at`),
  KEY `idx_documents_is_hard_deleted` (`is_hard_deleted`),
  KEY `idx_documents_replaces_document_id` (`replaces_document_id`),
  KEY `fk_documents_deleted_by` (`deleted_by`),
  CONSTRAINT `fk_documents_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_documents_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_documents_replaces_document` FOREIGN KEY (`replaces_document_id`) REFERENCES `documents` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_attachments`
--

DROP TABLE IF EXISTS `email_attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_attachments` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_bytes` bigint NOT NULL,
  `storage_bucket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imap_part_id` text COLLATE utf8mb4_unicode_ci,
  `downloaded` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email_attachments_message_filename` (`message_id`,`filename`(191)),
  KEY `idx_email_attachments_message` (`message_id`),
  CONSTRAINT `fk_email_attachments_message` FOREIGN KEY (`message_id`) REFERENCES `email_messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_messages`
--

DROP TABLE IF EXISTS `email_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_messages` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thread_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imap_uid` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_reply_to` text COLLATE utf8mb4_unicode_ci,
  `reference_headers` json DEFAULT NULL,
  `from_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_name` text COLLATE utf8mb4_unicode_ci,
  `to_addresses` json NOT NULL,
  `cc_addresses` json DEFAULT NULL,
  `bcc_addresses` json DEFAULT NULL,
  `reply_to` text COLLATE utf8mb4_unicode_ci,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `body_text` longtext COLLATE utf8mb4_unicode_ci,
  `body_html` longtext COLLATE utf8mb4_unicode_ci,
  `has_attachments` tinyint(1) NOT NULL DEFAULT '0',
  `attachments_count` int NOT NULL DEFAULT '0',
  `sent_date` datetime NOT NULL,
  `received_date` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0',
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `is_sent` tinyint(1) NOT NULL DEFAULT '0',
  `flags` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email_messages_thread_uid` (`thread_id`,`imap_uid`(191)),
  KEY `idx_email_messages_thread` (`thread_id`),
  KEY `idx_email_messages_sent_date` (`sent_date`),
  KEY `idx_email_messages_is_read` (`is_read`),
  CONSTRAINT `fk_email_messages_thread` FOREIGN KEY (`thread_id`) REFERENCES `email_threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_threads`
--

DROP TABLE IF EXISTS `email_threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_threads` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email_account_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thread_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` json NOT NULL,
  `last_message_date` datetime NOT NULL,
  `message_count` int NOT NULL DEFAULT '1',
  `unread_count` int NOT NULL DEFAULT '0',
  `ai_summary` text COLLATE utf8mb4_unicode_ci,
  `ai_extracted_data` json DEFAULT NULL,
  `ai_confidence_score` decimal(3,2) DEFAULT NULL,
  `ai_last_processed_at` datetime DEFAULT NULL,
  `category` text COLLATE utf8mb4_unicode_ci,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_created_etablissement` tinyint(1) DEFAULT '0',
  `needs_manual_review` tinyint(1) DEFAULT '0',
  `reviewed_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email_threads_account_thread` (`user_email_account_id`,`thread_id`(191)),
  KEY `idx_email_threads_etablissement` (`etablissement_id`),
  KEY `idx_email_threads_last_message_date` (`last_message_date`),
  KEY `idx_email_threads_needs_manual_review` (`needs_manual_review`),
  KEY `idx_email_threads_account` (`user_email_account_id`),
  KEY `fk_email_threads_reviewed_by` (`reviewed_by`),
  CONSTRAINT `fk_email_threads_account` FOREIGN KEY (`user_email_account_id`) REFERENCES `user_email_accounts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_email_threads_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_email_threads_reviewed_by` FOREIGN KEY (`reviewed_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `email_to_etablissement_suggestions`
--

DROP TABLE IF EXISTS `email_to_etablissement_suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_to_etablissement_suggestions` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggested_etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `match_confidence` decimal(3,2) DEFAULT NULL,
  `match_reason` text COLLATE utf8mb4_unicode_ci,
  `extracted_data` json DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewed_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reviewed_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_email_to_etablissement_suggestions_thread` (`email_thread_id`),
  KEY `idx_email_to_etablissement_suggestions_status` (`status`(64)),
  KEY `fk_email_to_etablissement_suggestions_etablissement` (`suggested_etablissement_id`),
  KEY `fk_email_to_etablissement_suggestions_reviewed_by` (`reviewed_by`),
  CONSTRAINT `fk_email_to_etablissement_suggestions_etablissement` FOREIGN KEY (`suggested_etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_email_to_etablissement_suggestions_reviewed_by` FOREIGN KEY (`reviewed_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_email_to_etablissement_suggestions_thread` FOREIGN KEY (`email_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquetes_satisfaction_formation`
--

DROP TABLE IF EXISTS `enquetes_satisfaction_formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquetes_satisfaction_formation` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reponse` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nps_score` int DEFAULT NULL,
  `csat_score` int DEFAULT NULL,
  `clarte_pedagogique` int DEFAULT NULL,
  `qualite_supports` int DEFAULT NULL,
  `competence_formateur` int DEFAULT NULL,
  `utilite_percue` int DEFAULT NULL,
  `adaptation_metier` int DEFAULT NULL,
  `duree_appropriee` int DEFAULT NULL,
  `rythme_adapte` int DEFAULT NULL,
  `points_forts` text COLLATE utf8mb4_unicode_ci,
  `points_amelioration` text COLLATE utf8mb4_unicode_ci,
  `suggestions` text COLLATE utf8mb4_unicode_ci,
  `commentaire_libre` text COLLATE utf8mb4_unicode_ci,
  `token_enquete` text COLLATE utf8mb4_unicode_ci,
  `repondu_via` enum('authentifie','lien_public','qr_code') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_enquetes_satisfaction_formation_token` (`token_enquete`(191)),
  KEY `idx_satisfaction_formation_user` (`user_id`),
  KEY `idx_satisfaction_formation_session` (`session_id`),
  CONSTRAINT `fk_satisfaction_formation_session` FOREIGN KEY (`session_id`) REFERENCES `formation_sessions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_satisfaction_formation_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `enquetes_satisfaction_solution`
--

DROP TABLE IF EXISTS `enquetes_satisfaction_solution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `enquetes_satisfaction_solution` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_reponse` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `satisfaction_solution` int DEFAULT NULL,
  `satisfaction_csm` int DEFAULT NULL,
  `facilite_utilisation` int DEFAULT NULL,
  `intuitivite_interface` int DEFAULT NULL,
  `rapidite_execution` int DEFAULT NULL,
  `temps_gagne` int DEFAULT NULL,
  `confort_usage` int DEFAULT NULL,
  `reduction_stress` int DEFAULT NULL,
  `utilite_smr` int DEFAULT NULL,
  `utilite_urgences` int DEFAULT NULL,
  `utilite_pmsi` int DEFAULT NULL,
  `utilite_completion` int DEFAULT NULL,
  `utilite_dictee_vocale` int DEFAULT NULL,
  `recommandation_collegues` int DEFAULT NULL,
  `ressenti_roi` text COLLATE utf8mb4_unicode_ci,
  `fonctionnalites_preferees` text COLLATE utf8mb4_unicode_ci,
  `fonctionnalites_manquantes` text COLLATE utf8mb4_unicode_ci,
  `irritants` text COLLATE utf8mb4_unicode_ci,
  `suggestions` text COLLATE utf8mb4_unicode_ci,
  `commentaire_libre` text COLLATE utf8mb4_unicode_ci,
  `token_enquete` text COLLATE utf8mb4_unicode_ci,
  `repondu_via` enum('authentifie','lien_public','qr_code','email') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_enquetes_satisfaction_solution_token` (`token_enquete`(191)),
  KEY `idx_satisfaction_solution_user` (`user_id`),
  KEY `idx_satisfaction_solution_etablissement` (`etablissement_id`),
  CONSTRAINT `fk_satisfaction_solution_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_satisfaction_solution_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etablissement_user_roles`
--

DROP TABLE IF EXISTS `etablissement_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etablissement_user_roles` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_etablissement_user_roles_user_role` (`user_id`,`role`),
  KEY `idx_etablissement_user_roles_user` (`user_id`),
  KEY `fk_etablissement_user_roles_assigned_by` (`assigned_by`),
  CONSTRAINT `fk_etablissement_user_roles_assigned_by` FOREIGN KEY (`assigned_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_etablissement_user_roles_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etablissement_users`
--

DROP TABLE IF EXISTS `etablissement_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etablissement_users` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` text COLLATE utf8mb4_unicode_ci,
  `fonction` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` text COLLATE utf8mb4_unicode_ci,
  `specialite` text COLLATE utf8mb4_unicode_ci,
  `statut_formation` enum('non_forme','en_cours','forme','a_rafraichir') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non_forme',
  `date_premiere_formation` date DEFAULT NULL,
  `date_derniere_formation` date DEFAULT NULL,
  `nombre_sessions_suivies` int DEFAULT '0',
  `derniere_utilisation` datetime DEFAULT NULL,
  `nombre_connexions` int DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1',
  `compte_verrouille` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_etablissement_users_etablissement_email` (`etablissement_id`,`email`(191)),
  KEY `idx_etablissement_users_etablissement` (`etablissement_id`),
  KEY `idx_etablissement_users_user_id` (`user_id`),
  KEY `idx_etablissement_users_email` (`email`(191)),
  KEY `idx_etablissement_users_statut_formation` (`statut_formation`),
  KEY `fk_etablissement_users_created_by` (`created_by`),
  CONSTRAINT `fk_etablissement_users_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_etablissement_users_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_etablissement_users_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `etablissements`
--

DROP TABLE IF EXISTS `etablissements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `etablissements` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('CHU','CH','Clinique','EHPAD','Autre') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci,
  `code_postal` text COLLATE utf8mb4_unicode_ci,
  `telephone` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('Contractuel','ConformitÃ©','DÃ©ploiement','Formation','Go-Live','Production','Suspendu') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Contractuel',
  `date_signature` date NOT NULL,
  `date_fin_contrat` date DEFAULT NULL,
  `type_offre` text COLLATE utf8mb4_unicode_ci,
  `nombre_licences` int DEFAULT NULL,
  `progression` decimal(5,2) DEFAULT '0.00',
  `commercial_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chef_projet_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `csm_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `derniers_echanges_resume` text COLLATE utf8mb4_unicode_ci,
  `derniers_echanges_updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_etablissements_commercial` (`commercial_id`),
  KEY `idx_etablissements_chef_projet` (`chef_projet_id`),
  KEY `idx_etablissements_csm` (`csm_id`),
  CONSTRAINT `fk_etablissements_chef_projet` FOREIGN KEY (`chef_projet_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_etablissements_commercial` FOREIGN KEY (`commercial_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_etablissements_csm` FOREIGN KEY (`csm_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_attendees`
--

DROP TABLE IF EXISTS `event_attendees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_attendees` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` text COLLATE utf8mb4_unicode_ci,
  `role` enum('organizer','required','optional','admin','commercial','chef_projet','csm','manager','rh','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'required',
  `status` enum('pending','accepted','declined','tentative') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `responded_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_event_attendees_event` (`event_id`),
  KEY `idx_event_attendees_user` (`user_id`),
  CONSTRAINT `fk_event_attendees_event` FOREIGN KEY (`event_id`) REFERENCES `calendar_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_event_attendees_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `event_reminders`
--

DROP TABLE IF EXISTS `event_reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event_reminders` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minutes_before` int NOT NULL DEFAULT '15',
  `type` enum('notification','email','push') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'notification',
  `is_sent` tinyint(1) DEFAULT '0',
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_event_reminders_event` (`event_id`),
  KEY `idx_event_reminders_event_is_sent` (`event_id`,`is_sent`),
  KEY `fk_event_reminders_user` (`user_id`),
  CONSTRAINT `fk_event_reminders_event` FOREIGN KEY (`event_id`) REFERENCES `calendar_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_event_reminders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formation_emargements`
--

DROP TABLE IF EXISTS `formation_emargements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formation_emargements` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_emargement` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `present` tinyint(1) NOT NULL DEFAULT '1',
  `retard_minutes` int DEFAULT NULL,
  `depart_anticipe` tinyint(1) DEFAULT '0',
  `signature_type` enum('canvas','qr_code','manuel') COLLATE utf8mb4_unicode_ci NOT NULL,
  `signature_data` text COLLATE utf8mb4_unicode_ci,
  `signature_storage_path` text COLLATE utf8mb4_unicode_ci,
  `valide_par` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valide_at` datetime DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_formation_emargements_session_user` (`session_id`,`user_id`),
  KEY `idx_emargements_session` (`session_id`),
  KEY `idx_emargements_user` (`user_id`),
  KEY `fk_formation_emargements_valide_par` (`valide_par`),
  CONSTRAINT `fk_formation_emargements_session` FOREIGN KEY (`session_id`) REFERENCES `formation_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_formation_emargements_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_formation_emargements_valide_par` FOREIGN KEY (`valide_par`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `formation_sessions`
--

DROP TABLE IF EXISTS `formation_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formation_sessions` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `type_formation` enum('initiale','perfectionnement','rappel','accompagnement') COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime DEFAULT NULL,
  `duree_heures` decimal(4,2) NOT NULL,
  `lieu` text COLLATE utf8mb4_unicode_ci,
  `modalite` enum('presentiel','distanciel','hybride') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `formateur_nom` text COLLATE utf8mb4_unicode_ci,
  `formateur_prenom` text COLLATE utf8mb4_unicode_ci,
  `formateur_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_participants_prevus` int DEFAULT NULL,
  `nombre_participants_reels` int DEFAULT '0',
  `statut` enum('planifiee','en_cours','terminee','annulee','reportee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'planifiee',
  `qr_code_token` text COLLATE utf8mb4_unicode_ci,
  `qr_code_expires_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_formation_sessions_qr_code_token` (`qr_code_token`(191)),
  KEY `idx_formation_sessions_etablissement` (`etablissement_id`),
  KEY `idx_formation_sessions_date_debut` (`date_debut`),
  KEY `idx_formation_sessions_statut` (`statut`),
  KEY `idx_formation_sessions_formateur` (`formateur_id`),
  KEY `fk_formation_sessions_created_by` (`created_by`),
  CONSTRAINT `fk_formation_sessions_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `fk_formation_sessions_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_formation_sessions_formateur` FOREIGN KEY (`formateur_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forum_comments`
--

DROP TABLE IF EXISTS `forum_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_comments` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_comment_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `upvotes` int DEFAULT '0',
  `modere` tinyint(1) DEFAULT '0',
  `modere_par` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modere_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_forum_comments_post` (`post_id`),
  KEY `idx_forum_comments_user` (`user_id`),
  KEY `idx_forum_comments_parent` (`parent_comment_id`),
  KEY `fk_forum_comments_modere_par` (`modere_par`),
  CONSTRAINT `fk_forum_comments_modere_par` FOREIGN KEY (`modere_par`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_forum_comments_parent` FOREIGN KEY (`parent_comment_id`) REFERENCES `forum_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_forum_comments_post` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_forum_comments_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forum_posts`
--

DROP TABLE IF EXISTS `forum_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_posts` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` enum('pmsi','smr','urgences','completion_dossier','dictee_vocale','astuces','bugs','support','autre') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` json DEFAULT NULL,
  `visibilite` enum('etablissement','global') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'global',
  `upvotes` int DEFAULT '0',
  `nombre_commentaires` int DEFAULT '0',
  `nombre_vues` int DEFAULT '0',
  `epingle` tinyint(1) DEFAULT '0',
  `resolu` tinyint(1) DEFAULT '0',
  `archive` tinyint(1) DEFAULT '0',
  `modere` tinyint(1) DEFAULT '0',
  `modere_par` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modere_at` datetime DEFAULT NULL,
  `raison_moderation` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_forum_posts_user` (`user_id`),
  KEY `idx_forum_posts_etablissement` (`etablissement_id`),
  KEY `idx_forum_posts_theme` (`theme`),
  KEY `idx_forum_posts_visibilite` (`visibilite`),
  KEY `idx_forum_posts_epingle` (`epingle`),
  KEY `fk_forum_posts_modere_par` (`modere_par`),
  CONSTRAINT `fk_forum_posts_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_forum_posts_modere_par` FOREIGN KEY (`modere_par`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_forum_posts_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `forum_votes`
--

DROP TABLE IF EXISTS `forum_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `forum_votes` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `post_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_forum_votes_user_post` (`user_id`,`post_id`),
  UNIQUE KEY `uk_forum_votes_user_comment` (`user_id`,`comment_id`),
  KEY `idx_forum_votes_user` (`user_id`),
  KEY `idx_forum_votes_post` (`post_id`),
  KEY `idx_forum_votes_comment` (`comment_id`),
  CONSTRAINT `fk_forum_votes_comment` FOREIGN KEY (`comment_id`) REFERENCES `forum_comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_forum_votes_post` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_forum_votes_user` FOREIGN KEY (`user_id`) REFERENCES `etablissement_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `modeles_taches`
--

DROP TABLE IF EXISTS `modeles_taches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modeles_taches` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priorite` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `ordre` int DEFAULT '0',
  `delai_jours` int DEFAULT NULL,
  `actif` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_modeles_taches_categorie` (`categorie_id`),
  CONSTRAINT `fk_modeles_taches_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_taches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications_history`
--

DROP TABLE IF EXISTS `notifications_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications_history` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sent',
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `sent_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `metadata` json DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notifications_history_rule` (`rule_id`),
  KEY `idx_notifications_history_sent_at` (`sent_at`),
  CONSTRAINT `fk_notifications_history_rule` FOREIGN KEY (`rule_id`) REFERENCES `notifications_rules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `notifications_rules`
--

DROP TABLE IF EXISTS `notifications_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications_rules` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `conditions` json DEFAULT NULL,
  `recipients` json NOT NULL,
  `email_template` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_notifications_rules_created_by` (`created_by`),
  CONSTRAINT `fk_notifications_rules_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `personal_todos`
--

DROP TABLE IF EXISTS `personal_todos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_todos` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_done` tinyint(1) NOT NULL DEFAULT '0',
  `done_at` datetime DEFAULT NULL,
  `done_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` enum('low','medium','high','urgent') COLLATE utf8mb4_unicode_ci DEFAULT 'medium',
  `due_date` date DEFAULT NULL,
  `due_time` time DEFAULT NULL,
  `reminder_at` datetime DEFAULT NULL,
  `position` int DEFAULT '0',
  `labels` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_personal_todos_user` (`user_id`),
  KEY `idx_personal_todos_project` (`project_id`),
  KEY `idx_personal_todos_etablissement` (`etablissement_id`),
  KEY `idx_personal_todos_due_date` (`due_date`),
  KEY `idx_personal_todos_is_done` (`is_done`),
  KEY `fk_personal_todos_done_by` (`done_by`),
  CONSTRAINT `fk_personal_todos_done_by` FOREIGN KEY (`done_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_personal_todos_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_personal_todos_project` FOREIGN KEY (`project_id`) REFERENCES `todo_projects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_personal_todos_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `two_factor_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `preferences` json DEFAULT NULL,
  `linkedin_url` text COLLATE utf8mb4_unicode_ci,
  `avatar_url` text COLLATE utf8mb4_unicode_ci,
  `fonction` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_profiles_user_id` (`user_id`),
  KEY `idx_profiles_email` (`email`(191)),
  CONSTRAINT `fk_profiles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `profiles_secrets`
--

DROP TABLE IF EXISTS `profiles_secrets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profiles_secrets` (
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `temp_2fa_secret` text COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_profiles_secrets_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_ai_responses`
--

DROP TABLE IF EXISTS `pulse_ai_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_ai_responses` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_message_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prompt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokens_input` int DEFAULT NULL,
  `tokens_output` int DEFAULT NULL,
  `processing_time_ms` int DEFAULT NULL,
  `user_accepted` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_ai_conversation` (`conversation_id`),
  KEY `fk_pulse_ai_original_message` (`original_message_id`),
  KEY `fk_pulse_ai_user` (`user_id`),
  CONSTRAINT `fk_pulse_ai_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_ai_original_message` FOREIGN KEY (`original_message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_ai_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_audit_log`
--

DROP TABLE IF EXISTS `pulse_audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_audit_log` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actor_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` json DEFAULT NULL,
  `status` enum('success','failure','pending') COLLATE utf8mb4_unicode_ci DEFAULT 'success',
  `error_message` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_audit_actor` (`actor_id`),
  KEY `idx_pulse_audit_conversation` (`conversation_id`),
  KEY `idx_pulse_audit_action` (`action`),
  KEY `idx_pulse_audit_created` (`created_at`),
  CONSTRAINT `fk_pulse_audit_actor` FOREIGN KEY (`actor_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_conversation_members`
--

DROP TABLE IF EXISTS `pulse_conversation_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_conversation_members` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','member','guest') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `notification_level` enum('all','mentions','none') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `last_read_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `joined_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invited_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pulse_members_conversation_user` (`conversation_id`,`user_id`),
  KEY `idx_pulse_members_user` (`user_id`),
  KEY `idx_pulse_members_conversation` (`conversation_id`),
  KEY `fk_pulse_members_invited_by` (`invited_by`),
  CONSTRAINT `fk_pulse_members_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_members_invited_by` FOREIGN KEY (`invited_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_members_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_conversations`
--

DROP TABLE IF EXISTS `pulse_conversations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_conversations` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `visibility` enum('private','public') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'private',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_archived` tinyint(1) NOT NULL DEFAULT '0',
  `archived_at` datetime DEFAULT NULL,
  `archived_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_conversations_etablissement` (`etablissement_id`),
  KEY `idx_pulse_conversations_created_by` (`created_by`),
  KEY `idx_pulse_conversations_is_archived` (`is_archived`),
  KEY `fk_pulse_conversations_archived_by` (`archived_by`),
  CONSTRAINT `fk_pulse_conversations_archived_by` FOREIGN KEY (`archived_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_conversations_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_conversations_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_media`
--

DROP TABLE IF EXISTS `pulse_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_media` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` text COLLATE utf8mb4_unicode_ci,
  `file_type` enum('image','video','audio','document','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_bytes` bigint NOT NULL DEFAULT '0',
  `mime_type` text COLLATE utf8mb4_unicode_ci,
  `storage_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_media_message` (`message_id`),
  CONSTRAINT `fk_pulse_media_message` FOREIGN KEY (`message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_message_archive`
--

DROP TABLE IF EXISTS `pulse_message_archive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_message_archive` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_message_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_snapshot` json NOT NULL,
  `deleted_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deletion_reason` text COLLATE utf8mb4_unicode_ci,
  `restored` tinyint(1) NOT NULL DEFAULT '0',
  `restored_at` datetime DEFAULT NULL,
  `restored_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_archive_conversation` (`conversation_id`),
  KEY `idx_pulse_archive_original` (`original_message_id`),
  KEY `fk_pulse_archive_deleted_by` (`deleted_by`),
  KEY `fk_pulse_archive_restored_by` (`restored_by`),
  CONSTRAINT `fk_pulse_archive_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_archive_restored_by` FOREIGN KEY (`restored_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_message_task_links`
--

DROP TABLE IF EXISTS `pulse_message_task_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_message_task_links` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_type` enum('mentions','created_from','status_update') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mentions',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pulse_task_links_message_task` (`message_id`,`task_id`),
  KEY `idx_pulse_task_links_message` (`message_id`),
  KEY `idx_pulse_task_links_task` (`task_id`),
  KEY `idx_pulse_task_links_conversation` (`conversation_id`),
  KEY `fk_pulse_task_links_created_by` (`created_by`),
  CONSTRAINT `fk_pulse_task_links_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_task_links_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_task_links_message` FOREIGN KEY (`message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_task_links_task` FOREIGN KEY (`task_id`) REFERENCES `taches` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_messages`
--

DROP TABLE IF EXISTS `pulse_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_messages` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_html` longtext COLLATE utf8mb4_unicode_ci,
  `parent_message_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message_type` enum('text','system','ai_suggestion','task_update') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `edited_at` datetime DEFAULT NULL,
  `edited_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edit_count` int NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deletion_reason` text COLLATE utf8mb4_unicode_ci,
  `ai_processed` tinyint(1) NOT NULL DEFAULT '0',
  `reaction_count` int NOT NULL DEFAULT '0',
  `reply_count` int NOT NULL DEFAULT '0',
  `mentions` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_pulse_messages_conversation` (`conversation_id`),
  KEY `idx_pulse_messages_user` (`user_id`),
  KEY `idx_pulse_messages_parent` (`parent_message_id`),
  KEY `idx_pulse_messages_created` (`conversation_id`,`created_at`),
  KEY `idx_pulse_messages_deleted_at` (`deleted_at`),
  KEY `fk_pulse_messages_edited_by` (`edited_by`),
  KEY `fk_pulse_messages_deleted_by` (`deleted_by`),
  CONSTRAINT `fk_pulse_messages_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_messages_deleted_by` FOREIGN KEY (`deleted_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_messages_edited_by` FOREIGN KEY (`edited_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_messages_parent` FOREIGN KEY (`parent_message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_messages_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_presence`
--

DROP TABLE IF EXISTS `pulse_presence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_presence` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','away','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `last_seen_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `typing_until` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pulse_presence_user_conversation` (`user_id`,`conversation_id`),
  KEY `idx_pulse_presence_user` (`user_id`),
  KEY `idx_pulse_presence_conversation` (`conversation_id`),
  CONSTRAINT `fk_pulse_presence_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_presence_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pulse_reactions`
--

DROP TABLE IF EXISTS `pulse_reactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pulse_reactions` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emoji` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pulse_reactions_message_user_emoji` (`message_id`,`user_id`,`emoji`),
  KEY `idx_pulse_reactions_message` (`message_id`),
  KEY `fk_pulse_reactions_user` (`user_id`),
  CONSTRAINT `fk_pulse_reactions_message` FOREIGN KEY (`message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_reactions_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rd_epics`
--

DROP TABLE IF EXISTS `rd_epics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd_epics` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `priorite` enum('low','medium','high','critical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `couleur` text COLLATE utf8mb4_unicode_ci,
  `ordre` int DEFAULT '0',
  `statut` enum('todo','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_rd_epics_projet` (`projet_id`),
  CONSTRAINT `fk_rd_epics_projet` FOREIGN KEY (`projet_id`) REFERENCES `rd_projets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rd_projets`
--

DROP TABLE IF EXISTS `rd_projets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd_projets` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('actif','en_pause','termine','archive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `date_debut` date DEFAULT NULL,
  `date_fin_prevue` date DEFAULT NULL,
  `responsable_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couleur` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_rd_projets_responsable` (`responsable_id`),
  CONSTRAINT `fk_rd_projets_responsable` FOREIGN KEY (`responsable_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rd_sprints`
--

DROP TABLE IF EXISTS `rd_sprints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd_sprints` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` int NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `objectif` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('planifie','actif','termine','annule') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'planifie',
  `velocity_prevue` int DEFAULT NULL,
  `velocity_reelle` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_rd_sprints_projet_numero` (`projet_id`,`numero`),
  KEY `idx_rd_sprints_projet` (`projet_id`),
  KEY `idx_rd_sprints_statut` (`statut`),
  CONSTRAINT `fk_rd_sprints_projet` FOREIGN KEY (`projet_id`) REFERENCES `rd_projets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rd_tasks`
--

DROP TABLE IF EXISTS `rd_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd_tasks` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_story_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('todo','in_progress','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'todo',
  `estimation_heures` decimal(5,2) DEFAULT NULL,
  `temps_passe` decimal(5,2) DEFAULT '0.00',
  `responsable_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_rd_tasks_story` (`user_story_id`),
  KEY `idx_rd_tasks_responsable` (`responsable_id`),
  CONSTRAINT `fk_rd_tasks_responsable` FOREIGN KEY (`responsable_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_rd_tasks_story` FOREIGN KEY (`user_story_id`) REFERENCES `rd_user_stories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rd_user_stories`
--

DROP TABLE IF EXISTS `rd_user_stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rd_user_stories` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epic_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sprint_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `criteres_acceptation` json DEFAULT NULL,
  `statut` enum('backlog','todo','in_progress','review','done') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backlog',
  `points` int DEFAULT NULL,
  `priorite` enum('low','medium','high','critical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `responsable_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordre` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_rd_user_stories_projet` (`projet_id`),
  KEY `idx_rd_user_stories_sprint` (`sprint_id`),
  KEY `idx_rd_user_stories_epic` (`epic_id`),
  KEY `idx_rd_user_stories_statut` (`statut`),
  KEY `idx_rd_user_stories_responsable` (`responsable_id`),
  CONSTRAINT `fk_rd_user_stories_epic` FOREIGN KEY (`epic_id`) REFERENCES `rd_epics` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_rd_user_stories_projet` FOREIGN KEY (`projet_id`) REFERENCES `rd_projets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rd_user_stories_responsable` FOREIGN KEY (`responsable_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_rd_user_stories_sprint` FOREIGN KEY (`sprint_id`) REFERENCES `rd_sprints` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ressources_documentaires`
--

DROP TABLE IF EXISTS `ressources_documentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ressources_documentaires` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `categorie` enum('guide','fiche_pratique','vulgarisation','video','webinaire','faq') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_categorie` text COLLATE utf8mb4_unicode_ci,
  `type_fichier` enum('pdf','video','image','lien_externe','document') COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_fichier` text COLLATE utf8mb4_unicode_ci,
  `storage_path` text COLLATE utf8mb4_unicode_ci,
  `taille_ko` int DEFAULT NULL,
  `visible` tinyint(1) DEFAULT '1',
  `public` tinyint(1) DEFAULT '1',
  `roles_cibles` json DEFAULT NULL,
  `nombre_telechargements` int DEFAULT '0',
  `nombre_vues` int DEFAULT '0',
  `ordre` int DEFAULT '0',
  `tags` json DEFAULT NULL,
  `mots_cles` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_ressources_categorie` (`categorie`),
  KEY `idx_ressources_sous_categorie` (`sous_categorie`(191)),
  KEY `idx_ressources_visible` (`visible`),
  KEY `fk_ressources_created_by` (`created_by`),
  CONSTRAINT `fk_ressources_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rh_absences`
--

DROP TABLE IF EXISTS `rh_absences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rh_absences` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `type_absence` enum('conges_payes','maladie','rtt','formation','non_justifie') COLLATE utf8mb4_unicode_ci NOT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('en_attente','validee','refusee') COLLATE utf8mb4_unicode_ci DEFAULT 'en_attente',
  `validee_par` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validee_le` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_rh_absences_profile` (`profile_id`),
  KEY `idx_rh_absences_dates` (`date_debut`,`date_fin`),
  KEY `idx_rh_absences_type` (`type_absence`),
  KEY `idx_rh_absences_validee_par` (`validee_par`),
  CONSTRAINT `fk_rh_absences_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_rh_absences_validee_par` FOREIGN KEY (`validee_par`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rh_objectifs_ca`
--

DROP TABLE IF EXISTS `rh_objectifs_ca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rh_objectifs_ca` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int NOT NULL,
  `trimestre` int NOT NULL,
  `objectif_ca` decimal(15,2) NOT NULL,
  `ca_realise` decimal(15,2) DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_rh_objectifs_profile_annee_trimestre` (`profile_id`,`annee`,`trimestre`),
  KEY `idx_rh_objectifs_profile` (`profile_id`),
  KEY `idx_rh_objectifs_periode` (`annee`,`trimestre`),
  CONSTRAINT `fk_rh_objectifs_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rh_salaires_mensuels`
--

DROP TABLE IF EXISTS `rh_salaires_mensuels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rh_salaires_mensuels` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mois` date NOT NULL,
  `salaire_brut` decimal(15,2) NOT NULL,
  `salaire_net` decimal(15,2) NOT NULL,
  `cotisations_patronales` decimal(15,2) NOT NULL,
  `cotisations_salariales` decimal(15,2) NOT NULL,
  `primes` decimal(15,2) DEFAULT '0.00',
  `heures_supplementaires` decimal(15,2) DEFAULT '0.00',
  `statut` enum('prevu','paye','en_cours') COLLATE utf8mb4_unicode_ci DEFAULT 'prevu',
  `date_paiement` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_rh_salaires_profile_mois` (`profile_id`,`mois`),
  KEY `idx_rh_salaires_profile` (`profile_id`),
  KEY `idx_rh_salaires_mois` (`mois`),
  KEY `idx_rh_salaires_statut` (`statut`),
  CONSTRAINT `fk_rh_salaires_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `security_config`
--

DROP TABLE IF EXISTS `security_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `security_config` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_min_length` int NOT NULL DEFAULT '8',
  `password_require_uppercase` tinyint(1) NOT NULL DEFAULT '1',
  `password_require_lowercase` tinyint(1) NOT NULL DEFAULT '1',
  `password_require_numbers` tinyint(1) NOT NULL DEFAULT '1',
  `password_require_symbols` tinyint(1) NOT NULL DEFAULT '0',
  `password_expiration` int NOT NULL DEFAULT '90',
  `two_factor_required` tinyint(1) NOT NULL DEFAULT '0',
  `session_timeout` int NOT NULL DEFAULT '3600',
  `max_login_attempts` int NOT NULL DEFAULT '5',
  `lockout_duration` int NOT NULL DEFAULT '15',
  `ip_whitelist_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `brute_force_protection` tinyint(1) NOT NULL DEFAULT '1',
  `security_headers` tinyint(1) NOT NULL DEFAULT '1',
  `audit_logging` tinyint(1) NOT NULL DEFAULT '1',
  `login_alerts` tinyint(1) NOT NULL DEFAULT '1',
  `suspicious_activity_alerts` tinyint(1) NOT NULL DEFAULT '1',
  `password_change_alerts` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `security_logs`
--

DROP TABLE IF EXISTS `security_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `security_logs` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log_type` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `location` text COLLATE utf8mb4_unicode_ci,
  `risk_level` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `metadata` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_security_logs_created_at` (`created_at`),
  KEY `idx_security_logs_user_id` (`user_id`),
  KEY `idx_security_logs_type` (`log_type`),
  CONSTRAINT `fk_security_logs_profile` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_config`
--

DROP TABLE IF EXISTS `system_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_config` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_system_config_key` (`key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `system_stats`
--

DROP TABLE IF EXISTS `system_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `system_stats` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metric_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metric_value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `metric_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_system_stats_metric` (`metric_name`(191)),
  KEY `idx_system_stats_recorded_at` (`recorded_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `taches`
--

DROP TABLE IF EXISTS `taches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `taches` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `statut` enum('A faire','En cours','BloquÃ©','TerminÃ©') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A faire',
  `priorite` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `echeance` date DEFAULT NULL,
  `date_realisation` date DEFAULT NULL,
  `responsable_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ordre` int DEFAULT '0',
  `commentaires` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `completed_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pulse_conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pulse_created_from_message_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_pulse_update` datetime DEFAULT NULL,
  `pulse_mention_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_taches_etablissement` (`etablissement_id`),
  KEY `idx_taches_categorie` (`categorie_id`),
  KEY `idx_taches_responsable` (`responsable_id`),
  KEY `idx_taches_pulse_conversation` (`pulse_conversation_id`),
  KEY `fk_taches_completed_by` (`completed_by`),
  CONSTRAINT `fk_taches_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categories_taches` (`id`),
  CONSTRAINT `fk_taches_completed_by` FOREIGN KEY (`completed_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_taches_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_taches_pulse_conversation` FOREIGN KEY (`pulse_conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_taches_responsable` FOREIGN KEY (`responsable_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `todo_project_members`
--

DROP TABLE IF EXISTS `todo_project_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `todo_project_members` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('owner','admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `added_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_todo_project_members_project_user` (`project_id`,`user_id`),
  KEY `idx_todo_project_members_project` (`project_id`),
  KEY `idx_todo_project_members_user` (`user_id`),
  KEY `idx_todo_project_members_added_by` (`added_by`),
  CONSTRAINT `fk_todo_project_members_added_by` FOREIGN KEY (`added_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_todo_project_members_project` FOREIGN KEY (`project_id`) REFERENCES `todo_projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_todo_project_members_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `todo_projects`
--

DROP TABLE IF EXISTS `todo_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `todo_projects` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `color` text COLLATE utf8mb4_unicode_ci,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `is_shared` tinyint(1) DEFAULT '0',
  `position` int DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_todo_projects_owner` (`owner_id`),
  CONSTRAINT `fk_todo_projects_owner` FOREIGN KEY (`owner_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tresorerie_categories`
--

DROP TABLE IF EXISTS `tresorerie_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tresorerie_categories` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('revenu','depense') COLLATE utf8mb4_unicode_ci NOT NULL,
  `couleur` text COLLATE utf8mb4_unicode_ci,
  `ordre` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_tresorerie_categories_code` (`code`),
  KEY `idx_tresorerie_categories_type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tresorerie_depenses`
--

DROP TABLE IF EXISTS `tresorerie_depenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tresorerie_depenses` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `date_prevue` date NOT NULL,
  `date_paiement` date DEFAULT NULL,
  `categorie_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('prevu','paye','annule') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prevu',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `est_recurrent` tinyint(1) DEFAULT '0',
  `frequence` enum('weekly','monthly','quarterly','yearly') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tresorerie_depenses_date_prevue` (`date_prevue`),
  KEY `idx_tresorerie_depenses_categorie` (`categorie_id`),
  KEY `idx_tresorerie_depenses_statut` (`statut`),
  KEY `idx_tresorerie_depenses_source` (`source`),
  CONSTRAINT `fk_tresorerie_depenses_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `tresorerie_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tresorerie_operations_bancaires`
--

DROP TABLE IF EXISTS `tresorerie_operations_bancaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tresorerie_operations_bancaires` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` enum('qonto','autre') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'qonto',
  `external_id` text COLLATE utf8mb4_unicode_ci,
  `date_operation` date NOT NULL,
  `label` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `sens` enum('credit','debit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matched_depense_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matched_revenu_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` json DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tresorerie_ops_date` (`date_operation`),
  KEY `idx_tresorerie_ops_categorie` (`categorie_id`),
  KEY `idx_tresorerie_ops_depense` (`matched_depense_id`),
  KEY `idx_tresorerie_ops_revenu` (`matched_revenu_id`),
  CONSTRAINT `fk_tresorerie_ops_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `tresorerie_categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_tresorerie_ops_matched_depense` FOREIGN KEY (`matched_depense_id`) REFERENCES `tresorerie_depenses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_tresorerie_ops_matched_revenu` FOREIGN KEY (`matched_revenu_id`) REFERENCES `tresorerie_revenus` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tresorerie_revenus`
--

DROP TABLE IF EXISTS `tresorerie_revenus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tresorerie_revenus` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` decimal(15,2) NOT NULL,
  `date_prevue` date NOT NULL,
  `date_encaissement` date DEFAULT NULL,
  `categorie_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('prevu','encaisse','annule') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prevu',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `est_recurrent` tinyint(1) DEFAULT '0',
  `frequence` enum('weekly','monthly','quarterly','yearly') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_id` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_tresorerie_revenus_date_prevue` (`date_prevue`),
  KEY `idx_tresorerie_revenus_categorie` (`categorie_id`),
  KEY `idx_tresorerie_revenus_statut` (`statut`),
  CONSTRAINT `fk_tresorerie_revenus_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `tresorerie_categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_email_accounts`
--

DROP TABLE IF EXISTS `user_email_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_email_accounts` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `encrypted_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imap_host` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imap_port` int NOT NULL DEFAULT '993',
  `imap_use_ssl` tinyint(1) NOT NULL DEFAULT '1',
  `smtp_host` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` int NOT NULL DEFAULT '465',
  `smtp_use_ssl` tinyint(1) NOT NULL DEFAULT '1',
  `last_sync_at` datetime DEFAULT NULL,
  `last_uid_synced` text COLLATE utf8mb4_unicode_ci,
  `sync_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_email_accounts_profile_email` (`profile_id`,`email_address`(191)),
  KEY `idx_user_email_accounts_profile` (`profile_id`),
  CONSTRAINT `fk_user_email_accounts_profile` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_oauth_connections`
--

DROP TABLE IF EXISTS `user_oauth_connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_oauth_connections` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` enum('google','microsoft','zoom','nextcloud') COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refresh_token` text COLLATE utf8mb4_unicode_ci,
  `token_expires_at` datetime DEFAULT NULL,
  `provider_email` text COLLATE utf8mb4_unicode_ci,
  `provider_user_id` text COLLATE utf8mb4_unicode_ci,
  `scopes` json DEFAULT NULL,
  `instance_url` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_oauth_connections_user_provider` (`user_id`,`provider`),
  KEY `idx_user_oauth_connections_user_provider` (`user_id`,`provider`),
  CONSTRAINT `fk_user_oauth_connections_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','commercial','chef_projet','csm','manager','rh','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `assigned_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assigned_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_user_roles_user_role` (`user_id`,`role`),
  KEY `idx_user_roles_role` (`role`),
  KEY `fk_user_roles_assigned_by` (`assigned_by`),
  CONSTRAINT `fk_user_roles_assigned_by` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_user_roles_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_users_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `visio_transcription_participants`
--

DROP TABLE IF EXISTS `visio_transcription_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visio_transcription_participants` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `azure_speaker_id` text COLLATE utf8mb4_unicode_ci,
  `joined_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `left_at` datetime DEFAULT NULL,
  `is_transcribing` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_transcription_participants_session_user` (`session_id`,`user_id`),
  KEY `idx_transcription_participants_session` (`session_id`),
  KEY `fk_transcription_participants_user` (`user_id`),
  CONSTRAINT `fk_transcription_participants_session` FOREIGN KEY (`session_id`) REFERENCES `visio_transcription_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_transcription_participants_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `visio_transcription_segments`
--

DROP TABLE IF EXISTS `visio_transcription_segments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visio_transcription_segments` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `speaker_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `speaker_id` text COLLATE utf8mb4_unicode_ci,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time_ms` bigint DEFAULT NULL,
  `end_time_ms` bigint DEFAULT NULL,
  `is_partial` tinyint(1) DEFAULT '0',
  `confidence` double DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_transcription_segments_session` (`session_id`),
  KEY `idx_transcription_segments_user` (`user_id`),
  KEY `idx_transcription_segments_created_at` (`created_at`),
  CONSTRAINT `fk_transcription_segments_session` FOREIGN KEY (`session_id`) REFERENCES `visio_transcription_sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_transcription_segments_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `visio_transcription_sessions`
--

DROP TABLE IF EXISTS `visio_transcription_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visio_transcription_sessions` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_code` text COLLATE utf8mb4_unicode_ci,
  `external_meeting_url` text COLLATE utf8mb4_unicode_ci,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ended_at` datetime DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partenaire_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','ended','processing','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `summary` text COLLATE utf8mb4_unicode_ci,
  `decisions` json DEFAULT NULL,
  `next_steps` json DEFAULT NULL,
  `full_transcript` longtext COLLATE utf8mb4_unicode_ci,
  `language` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_transcription_sessions_status` (`status`),
  KEY `idx_transcription_sessions_created_by` (`created_by`),
  KEY `idx_transcription_sessions_etablissement` (`etablissement_id`),
  CONSTRAINT `fk_transcription_sessions_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_transcription_sessions_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--


-- ===========================================
-- PATCH v2 (depuis migrations Supabase 20251106220831...)
-- Ajout: groupes_etablissements, etablissements_groupes
-- + colonnes groupe_id dans contacts/taches/email_threads/email_domain_mappings
-- ===========================================

DROP TABLE IF EXISTS `etablissements_groupes`;
DROP TABLE IF EXISTS `groupes_etablissements`;

CREATE TABLE `groupes_etablissements` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,

  `adresse_siege` longtext COLLATE utf8mb4_unicode_ci,
  `code_postal_siege` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_siege` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_domains` json DEFAULT NULL,

  `responsable_commercial_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `responsable_csm_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `nombre_etablissements` int DEFAULT 0,
  `nombre_licences_total` int DEFAULT 0,
  `progression_moyenne` decimal(5,2) DEFAULT 0,

  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `idx_groupes_type` (`type`),
  KEY `idx_groupes_region` (`region`),
  KEY `fk_groupes_resp_commercial` (`responsable_commercial_id`),
  KEY `fk_groupes_resp_csm` (`responsable_csm_id`),
  KEY `fk_groupes_created_by` (`created_by`),
  KEY `fk_groupes_updated_by` (`updated_by`),

  CONSTRAINT `fk_groupes_resp_commercial` FOREIGN KEY (`responsable_commercial_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_groupes_resp_csm` FOREIGN KEY (`responsable_csm_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_groupes_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_groupes_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,

  CONSTRAINT `chk_groupes_type` CHECK (`type` IN ('GHT','Groupe Cliniques','Consortium','Autre'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `etablissements_groupes` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,

  `date_entree` date DEFAULT NULL,
  `date_sortie` date DEFAULT NULL,
  `est_etablissement_principal` tinyint(1) DEFAULT 0,
  `role_dans_groupe` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_etab_groupes_etab_groupe` (`etablissement_id`,`groupe_id`),
  KEY `idx_etab_groupes_etablissement` (`etablissement_id`),
  KEY `idx_etab_groupes_groupe` (`groupe_id`),

  CONSTRAINT `fk_etab_groupes_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_etab_groupes_groupe` FOREIGN KEY (`groupe_id`) REFERENCES `groupes_etablissements` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add groupe_id columns (if not already present)
ALTER TABLE `contacts`
  ADD COLUMN `groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD COLUMN `niveau_contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'etablissement',
  ADD KEY `idx_contacts_groupe` (`groupe_id`),
  ADD CONSTRAINT `fk_contacts_groupe` FOREIGN KEY (`groupe_id`) REFERENCES `groupes_etablissements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chk_contacts_niveau` CHECK (`niveau_contact` IN ('etablissement','groupe'));

ALTER TABLE `taches`
  ADD COLUMN `groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD COLUMN `niveau_tache` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'etablissement',
  ADD KEY `idx_taches_groupe` (`groupe_id`),
  ADD CONSTRAINT `fk_taches_groupe` FOREIGN KEY (`groupe_id`) REFERENCES `groupes_etablissements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chk_taches_niveau` CHECK (`niveau_tache` IN ('etablissement','groupe'));

ALTER TABLE `email_threads`
  ADD COLUMN `groupe_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_email_threads_groupe` (`groupe_id`),
  ADD CONSTRAINT `fk_email_threads_groupe` FOREIGN KEY (`groupe_id`) REFERENCES `groupes_etablissements` (`id`) ON DELETE SET NULL;

-- NOTE: email_domain_mappings is created later in this file (PATCH v2).
-- Columns/constraints will be included in its CREATE TABLE definition.




-- ===========================================
-- PATCH v2: in_app_notifications (migrations 20251105182541...)
-- ===========================================

DROP TABLE IF EXISTS `in_app_notifications`;

CREATE TABLE `in_app_notifications` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` datetime DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `idx_in_app_notifications_user_id` (`user_id`),
  KEY `idx_in_app_notifications_user_is_read` (`user_id`,`is_read`),
  KEY `idx_in_app_notifications_created_at` (`created_at`),
  CONSTRAINT `fk_in_app_notifications_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,

  CONSTRAINT `chk_in_app_notifications_type` CHECK (`type` IN ('ai_suggestion','task_assignment','task_completion','establishment_update','mention','other')),
  CONSTRAINT `chk_in_app_notifications_related_type` CHECK (`related_type` IN ('etablissement','tache','ai_suggestion','email'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: taches_documents (migrations 20250706000018...)
-- ===========================================

DROP TABLE IF EXISTS `taches_documents`;

CREATE TABLE `taches_documents` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tache_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_fichier` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `chemin_fichier` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_mime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taille_fichier` bigint DEFAULT NULL,
  `uploaded_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_taches_documents_tache` (`tache_id`),
  KEY `idx_taches_documents_uploaded_by` (`uploaded_by`),
  CONSTRAINT `fk_taches_documents_tache` FOREIGN KEY (`tache_id`) REFERENCES `taches` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_taches_documents_uploaded_by` FOREIGN KEY (`uploaded_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: email_templates + updated_by columns (migrations 20251104220442...)
-- ===========================================

ALTER TABLE `etablissements`
  ADD COLUMN `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_etablissements_updated_by` (`updated_by`),
  ADD CONSTRAINT `fk_etablissements_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

ALTER TABLE `taches`
  ADD COLUMN `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_taches_updated_by` (`updated_by`),
  ADD CONSTRAINT `fk_taches_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

ALTER TABLE `contacts`
  ADD COLUMN `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_contacts_updated_by` (`updated_by`),
  ADD CONSTRAINT `fk_contacts_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

DROP TABLE IF EXISTS `email_templates`;

CREATE TABLE `email_templates` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `variables` json DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_email_templates_is_active` (`is_active`),
  KEY `idx_email_templates_created_by` (`created_by`),
  CONSTRAINT `fk_email_templates_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: document_folders + documents.folder_id (migrations 20260111183317...)
-- ===========================================

DROP TABLE IF EXISTS `document_folders`;

CREATE TABLE `document_folders` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_folder_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `folder_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `related_etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci,
  `color` text COLLATE utf8mb4_unicode_ci,
  `position` int DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_document_folders_parent` (`parent_folder_id`),
  KEY `idx_document_folders_owner` (`owner_id`),
  KEY `idx_document_folders_type` (`folder_type`),
  KEY `idx_document_folders_etablissement` (`related_etablissement_id`),

  CONSTRAINT `fk_document_folders_parent` FOREIGN KEY (`parent_folder_id`) REFERENCES `document_folders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_folders_owner` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_document_folders_etablissement` FOREIGN KEY (`related_etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_document_folders_type` CHECK (`folder_type` IN ('personal','etablissement','system','shared'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `documents`
  ADD COLUMN `folder_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_documents_folder` (`folder_id`),
  ADD CONSTRAINT `fk_documents_folder` FOREIGN KEY (`folder_id`) REFERENCES `document_folders` (`id`) ON DELETE SET NULL;




-- ===========================================
-- PATCH v2: partenaires + partenaires_contacts (+ email_threads.partenaire_id) (migrations 20251108134026...)
-- ===========================================

DROP TABLE IF EXISTS `partenaires_contacts`;
DROP TABLE IF EXISTS `partenaires`;

CREATE TABLE `partenaires` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_partenaire` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sous_type` text COLLATE utf8mb4_unicode_ci,

  `adresse` longtext COLLATE utf8mb4_unicode_ci,
  `code_postal` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pays` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'France',
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_web` text COLLATE utf8mb4_unicode_ci,
  `email_domains` json DEFAULT NULL,

  `statut_relation` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `date_debut_partenariat` date DEFAULT NULL,
  `date_fin_partenariat` date DEFAULT NULL,
  `responsable_sclepios_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `engagement_score` int DEFAULT 0,
  `dernier_contact` date DEFAULT NULL,
  `prochaine_action` date DEFAULT NULL,
  `valeur_partenariat` decimal(12,2) DEFAULT NULL,

  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `tags` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  KEY `idx_partenaires_type` (`type_partenaire`),
  KEY `idx_partenaires_statut` (`statut_relation`),
  KEY `idx_partenaires_responsable` (`responsable_sclepios_id`),
  KEY `idx_partenaires_ville` (`ville`),

  CONSTRAINT `fk_partenaires_responsable` FOREIGN KEY (`responsable_sclepios_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_partenaires_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_partenaires_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,

  CONSTRAINT `chk_partenaires_type` CHECK (`type_partenaire` IN ('institutionnel','industriel','prestataire')),
  CONSTRAINT `chk_partenaires_statut` CHECK (`statut_relation` IN ('prospect','actif','inactif','termine')),
  CONSTRAINT `chk_partenaires_engagement_score` CHECK (`engagement_score` >= 0 AND `engagement_score` <= 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `partenaires_contacts` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `partenaire_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` text COLLATE utf8mb4_unicode_ci,
  `fonction` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `est_contact_principal` tinyint(1) DEFAULT 0,
  `notes` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_partenaires_contacts_partenaire` (`partenaire_id`),
  KEY `idx_partenaires_contacts_email` (`email`),
  CONSTRAINT `fk_partenaires_contacts_partenaire` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `email_threads`
  ADD COLUMN `partenaire_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ADD KEY `idx_email_threads_partenaire` (`partenaire_id`),
  ADD CONSTRAINT `fk_email_threads_partenaire` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE SET NULL;




-- ===========================================
-- PATCH v2: authorized_ips (migrations 20250712162736...)
-- NOTE: INET -> VARCHAR(45). Les fonctions RLS/IP-check seront implémentées côté API Phalcon.
-- ===========================================

DROP TABLE IF EXISTS `authorized_ips`;

CREATE TABLE `authorized_ips` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_authorized_ips_ip` (`ip_address`),
  KEY `idx_authorized_ips_created_by` (`created_by`),
  CONSTRAINT `fk_authorized_ips_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: ai_analysis_log (migrations 20251109225411...)
-- ===========================================

DROP TABLE IF EXISTS `ai_analysis_log`;

CREATE TABLE `ai_analysis_log` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `analysis_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filters` json DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_ai_analysis_log_user_type` (`user_id`,`analysis_type`),
  KEY `idx_ai_analysis_log_user_type` (`user_id`,`analysis_type`),
  KEY `idx_ai_analysis_log_created` (`created_at`),
  CONSTRAINT `fk_ai_analysis_log_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: pulse_polls / pulse_poll_options / pulse_poll_votes (migrations 20260108072115...)
-- ===========================================

DROP TABLE IF EXISTS `pulse_poll_votes`;
DROP TABLE IF EXISTS `pulse_poll_options`;
DROP TABLE IF EXISTS `pulse_polls`;

CREATE TABLE `pulse_polls` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversation_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_multiple_choice` tinyint(1) NOT NULL DEFAULT 0,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT 0,
  `ends_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_pulse_polls_conversation` (`conversation_id`),
  KEY `idx_pulse_polls_created_by` (`created_by`),
  KEY `idx_pulse_polls_message` (`message_id`),

  CONSTRAINT `fk_pulse_polls_conversation` FOREIGN KEY (`conversation_id`) REFERENCES `pulse_conversations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_polls_message` FOREIGN KEY (`message_id`) REFERENCES `pulse_messages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_pulse_polls_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pulse_poll_options` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` int DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_pulse_poll_options_poll` (`poll_id`),
  CONSTRAINT `fk_pulse_poll_options_poll` FOREIGN KEY (`poll_id`) REFERENCES `pulse_polls` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `pulse_poll_votes` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_pulse_poll_votes_unique` (`poll_id`,`option_id`,`user_id`),
  KEY `idx_pulse_poll_votes_poll` (`poll_id`),
  KEY `idx_pulse_poll_votes_option` (`option_id`),
  KEY `idx_pulse_poll_votes_user` (`user_id`),

  CONSTRAINT `fk_pulse_poll_votes_poll` FOREIGN KEY (`poll_id`) REFERENCES `pulse_polls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_poll_votes_option` FOREIGN KEY (`option_id`) REFERENCES `pulse_poll_options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pulse_poll_votes_user` FOREIGN KEY (`user_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: email_domain_mappings + etablissements email stats (migrations 20251105192929...)
-- NOTE: fonctions/triggers Postgres remplacés par logique API Phalcon (ou cron).
-- ===========================================

ALTER TABLE `etablissements`
  ADD COLUMN `email_domains` json DEFAULT NULL,
  ADD COLUMN `relationship_status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prospect',
  ADD COLUMN `last_email_received_at` datetime DEFAULT NULL,
  ADD COLUMN `last_email_sent_at` datetime DEFAULT NULL,
  ADD COLUMN `engagement_score` int NOT NULL DEFAULT 0,
  ADD KEY `idx_etablissements_relationship_status` (`relationship_status`),
  ADD KEY `idx_etablissements_last_email_received` (`last_email_received_at`);

DROP TABLE IF EXISTS `email_domain_mappings`;

CREATE TABLE `email_domain_mappings` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confidence_level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'high',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_email_domain_mappings_domain` (`domain`),
  KEY `idx_email_domain_mappings_domain` (`domain`),
  KEY `idx_email_domain_mappings_etablissement` (`etablissement_id`),
  KEY `idx_email_domain_mappings_created_by` (`created_by`),

  CONSTRAINT `fk_email_domain_mappings_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_email_domain_mappings_created_by` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `chk_email_domain_mappings_confidence` CHECK (`confidence_level` IN ('high','medium','low'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: customer_health_metrics + customer_activities (migrations 20251109190157...)
-- ===========================================

DROP TABLE IF EXISTS `customer_activities`;
DROP TABLE IF EXISTS `customer_health_metrics`;

CREATE TABLE `customer_health_metrics` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,

  `health_score` int DEFAULT NULL,
  `health_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `adoption_rate` decimal(10,2) DEFAULT NULL,
  `active_users` int NOT NULL DEFAULT 0,
  `total_licenses` int NOT NULL DEFAULT 0,
  `last_login_date` datetime DEFAULT NULL,

  `logins_last_30_days` int NOT NULL DEFAULT 0,
  `features_used_count` int NOT NULL DEFAULT 0,
  `avg_session_duration_minutes` decimal(10,2) DEFAULT NULL,

  `support_tickets_open` int NOT NULL DEFAULT 0,
  `support_tickets_closed_30d` int NOT NULL DEFAULT 0,
  `avg_resolution_time_hours` decimal(10,2) DEFAULT NULL,
  `last_ticket_date` datetime DEFAULT NULL,

  `nps_score` decimal(10,2) DEFAULT NULL,
  `nps_survey_date` datetime DEFAULT NULL,
  `satisfaction_score` int DEFAULT NULL,

  `payment_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on_time',
  `contract_value` decimal(12,2) DEFAULT NULL,
  `contract_start_date` date DEFAULT NULL,
  `contract_end_date` date DEFAULT NULL,

  `calculated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` longtext COLLATE utf8mb4_unicode_ci,

  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_customer_health_etablissement` (`etablissement_id`),
  KEY `idx_health_etablissement` (`etablissement_id`),
  KEY `idx_health_score` (`health_score`),
  KEY `idx_health_status` (`health_status`),
  KEY `idx_contract_end` (`contract_end_date`),

  CONSTRAINT `fk_health_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `chk_health_score` CHECK (`health_score` IS NULL OR (`health_score` >= 0 AND `health_score` <= 100)),
  CONSTRAINT `chk_health_status` CHECK (`health_status` IS NULL OR `health_status` IN ('healthy','at-risk','churn-risk','critical','onboarding')),
  CONSTRAINT `chk_adoption_rate` CHECK (`adoption_rate` IS NULL OR (`adoption_rate` >= 0 AND `adoption_rate` <= 100)),
  CONSTRAINT `chk_nps_score` CHECK (`nps_score` IS NULL OR (`nps_score` >= 0 AND `nps_score` <= 10)),
  CONSTRAINT `chk_satisfaction_score` CHECK (`satisfaction_score` IS NULL OR (`satisfaction_score` >= 1 AND `satisfaction_score` <= 5)),
  CONSTRAINT `chk_payment_status` CHECK (`payment_status` IN ('on_time','late','overdue'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `customer_activities` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,

  `activity_type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,

  `activity_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scheduled_date` datetime DEFAULT NULL,
  `completed_date` datetime DEFAULT NULL,

  `metadata` json DEFAULT NULL,

  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',

  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_activities_etablissement` (`etablissement_id`),
  KEY `idx_activities_type` (`activity_type`),
  KEY `idx_activities_date` (`activity_date`),
  KEY `idx_activities_scheduled` (`scheduled_date`),
  KEY `idx_activities_created_by` (`created_by`),
  KEY `idx_activities_assigned_to` (`assigned_to`),

  CONSTRAINT `fk_activities_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_activities_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_activities_assigned_to` FOREIGN KEY (`assigned_to`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,

  CONSTRAINT `chk_activities_type` CHECK (`activity_type` IN ('qbr','training','support_ticket','escalation','renewal','upsell','nps_survey','health_change','note','meeting','email','incident')),
  CONSTRAINT `chk_activities_status` CHECK (`status` IN ('scheduled','in_progress','completed','cancelled'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




-- ===========================================
-- PATCH v2: Support Tickets System (migrations 20251206192632...)
-- ===========================================

-- 1) user_email_accounts: is_shared
ALTER TABLE `user_email_accounts`
  ADD COLUMN `is_shared` tinyint(1) NOT NULL DEFAULT 0,
  ADD KEY `idx_user_email_accounts_is_shared` (`is_shared`);

-- 2) email_message_id_registry
DROP TABLE IF EXISTS `email_message_id_registry`;

CREATE TABLE `email_message_id_registry` (
  `message_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_seen_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `processed_for_ai` tinyint(1) NOT NULL DEFAULT 0,
  `processed_for_support` tinyint(1) NOT NULL DEFAULT 0,
  `source_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_account_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`message_id`),
  KEY `idx_email_msg_registry_first_seen` (`first_seen_at`),
  KEY `idx_email_msg_registry_thread` (`source_thread_id`),
  KEY `idx_email_msg_registry_account` (`source_account_id`),
  CONSTRAINT `fk_email_msg_registry_thread` FOREIGN KEY (`source_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_email_msg_registry_account` FOREIGN KEY (`source_account_id`) REFERENCES `user_email_accounts` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3) support_tickets
DROP TABLE IF EXISTS `support_ticket_comments`;
DROP TABLE IF EXISTS `support_tickets`;

CREATE TABLE `support_tickets` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_ticket` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `email_thread_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_message_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `etablissement_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partenaire_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tache_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `type_probleme` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'autre',

  `priorite` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moyenne',
  `statut` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nouveau',

  `assigne_a` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `contact_nom` text COLLATE utf8mb4_unicode_ci,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  `ai_summary` longtext COLLATE utf8mb4_unicode_ci,
  `ai_suggested_solution` longtext COLLATE utf8mb4_unicode_ci,
  `ai_category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ai_urgency_score` decimal(3,2) DEFAULT NULL,

  `date_ouverture` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_premiere_reponse` datetime DEFAULT NULL,
  `date_resolution` datetime DEFAULT NULL,
  `date_fermeture` datetime DEFAULT NULL,
  `date_derniere_activite` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `sla_deadline` datetime DEFAULT NULL,
  `sla_breached` tinyint(1) NOT NULL DEFAULT 0,

  `tags` json DEFAULT NULL,

  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,

  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_support_tickets_numero` (`numero_ticket`),
  KEY `idx_support_tickets_statut` (`statut`),
  KEY `idx_support_tickets_etablissement` (`etablissement_id`),
  KEY `idx_support_tickets_assigne` (`assigne_a`),
  KEY `idx_support_tickets_email_thread` (`email_thread_id`),
  KEY `idx_support_tickets_date_ouverture` (`date_ouverture`),

  CONSTRAINT `fk_support_tickets_email_thread` FOREIGN KEY (`email_thread_id`) REFERENCES `email_threads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_support_tickets_etablissement` FOREIGN KEY (`etablissement_id`) REFERENCES `etablissements` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_support_tickets_partenaire` FOREIGN KEY (`partenaire_id`) REFERENCES `partenaires` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_support_tickets_tache` FOREIGN KEY (`tache_id`) REFERENCES `taches` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_support_tickets_assigne` FOREIGN KEY (`assigne_a`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fk_support_tickets_created_by` FOREIGN KEY (`created_by`) REFERENCES `profiles` (`id`) ON DELETE SET NULL,

  CONSTRAINT `chk_support_tickets_type` CHECK (`type_probleme` IN ('bug','question','demande_fonctionnalite','performance','connexion','formation','facturation','autre')),
  CONSTRAINT `chk_support_tickets_priorite` CHECK (`priorite` IN ('basse','moyenne','haute','critique')),
  CONSTRAINT `chk_support_tickets_statut` CHECK (`statut` IN ('nouveau','en_cours','en_attente_client','en_attente_interne','resolu','ferme')),
  CONSTRAINT `chk_support_tickets_ai_urgency` CHECK (`ai_urgency_score` IS NULL OR (`ai_urgency_score` >= 0 AND `ai_urgency_score` <= 1))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4) support_ticket_comments
CREATE TABLE `support_ticket_comments` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ticket_id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  PRIMARY KEY (`id`),
  KEY `idx_ticket_comments_ticket` (`ticket_id`),
  KEY `idx_ticket_comments_author` (`author_id`),

  CONSTRAINT `fk_ticket_comments_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_ticket_comments_author` FOREIGN KEY (`author_id`) REFERENCES `profiles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


SET FOREIGN_KEY_CHECKS = 1;
