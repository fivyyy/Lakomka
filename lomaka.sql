-- --------------------------------------------------------
-- База данных: lomaka
-- Магазин лакомств для питомцев
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `lomaka` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `lomaka`;

-- --------------------------------------------------------
-- Таблица: users
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Данные: два пользователя
-- Пароли зашифрованы через bcrypt
-- Администратор: admin@lakomka.ru / admin123
-- Пользователь:  user@lakomka.ru  / user123
-- --------------------------------------------------------

INSERT INTO `users` (`name`, `email`, `phone`, `password`, `is_admin`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(
  'Администратор',
  'admin@lakomka.ru',
  NULL,
  '$2y$12$lNLKKG81f6G8fBF/brCuQekfjkTZWq7DpMRfRcsU3iioJXmxJIcr.',
  1,
  NOW(),
  NULL,
  NOW(),
  NOW()
),
(
  'Тестовый Пользователь',
  'user@lakomka.ru',
  NULL,
  '$2y$12$hoy/V7BnfQsdyU/fFaCy6OTVV7QmxM1drdhIvN54YToPUeX4MPwNC',
  0,
  NOW(),
  NULL,
  NOW(),
  NOW()
);

-- --------------------------------------------------------
-- Таблица: sessions (для хранения сессий Laravel)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Таблица: migrations (нужна Laravel)
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2024_01_01_000000_create_users_table', 1),
('2024_01_01_000001_create_sessions_table', 1);
