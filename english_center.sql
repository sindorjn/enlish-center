-- ====== english_center.sql ======
-- MySQL 5.7 / MariaDB mos skript

CREATE DATABASE IF NOT EXISTS english_center_db
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;   -- << o'zgartirildi

USE english_center_db;

CREATE TABLE IF NOT EXISTS registrations (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  full_name VARCHAR(100) NOT NULL,
  course    VARCHAR(50)  NOT NULL,
  phone     VARCHAR(25)  NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;
-- =================================
