-- Notifications table for admin to send notifications to project officers
-- Run this SQL in your database to create the notifications table

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ucode` varchar(255) NOT NULL,
  `orgcode` varchar(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `message` text NOT NULL,
  `recipient_type` enum('all','specific') NOT NULL DEFAULT 'all',
  `recipient_po_id` int(11) DEFAULT NULL COMMENT 'Project officer ID if specific recipient',
  `recipient_po_name` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `create_by` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_orgcode` (`orgcode`),
  KEY `idx_recipient_po_id` (`recipient_po_id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

