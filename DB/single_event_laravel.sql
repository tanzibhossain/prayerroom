-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2024 at 12:35 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `single_event_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Morshedul Arefin', 'admin@gmail.com', 'admin_1717493029.jpg', '$2y$12$I2/lLC6jmIfpQ7P0UkkeS.BINvTlik66YGNa76bkz0Zs.N1/FKfEm', '', '2024-06-04 01:49:48', '2024-06-04 03:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint UNSIGNED NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subheading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `heading`, `subheading`, `text`, `background`, `event_date`, `event_time`, `created_at`, `updated_at`) VALUES
(1, 'Event and Conference Website', 'September 20-24, 2024, California', 'Join us at our next networking event and conference! Connect with industry professionals, engage in insightful discussions, and attend hands-on workshops. Learn from experts, collaborate on innovative ideas, and build lasting relationships.', 'home_banner_1723539103.jpg', '12/25/2024', '10:20:00', '2024-08-13 00:20:02', '2024-12-09 02:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `home_counters`
--

CREATE TABLE `home_counters` (
  `id` bigint UNSIGNED NOT NULL,
  `item1_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item1_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item1_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item2_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item2_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item2_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item3_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item3_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item3_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item4_icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item4_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item4_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_counters`
--

INSERT INTO `home_counters` (`id`, `item1_icon`, `item1_number`, `item1_title`, `item2_icon`, `item2_number`, `item2_title`, `item3_icon`, `item3_number`, `item3_title`, `item4_icon`, `item4_number`, `item4_title`, `background`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fa fa-calendar', '7', 'Days', 'fa fa-user', '20', 'Speakers', 'fa fa-users', '50', 'Attendees', 'fa fa-th-list', '15', 'Sponsors', 'home_counter_1724045539.jpg', 'Show', '2024-08-18 23:09:02', '2024-08-18 23:32:19');

-- --------------------------------------------------------

--
-- Table structure for table `home_welcomes`
--

CREATE TABLE `home_welcomes` (
  `id` bigint UNSIGNED NOT NULL,
  `heading` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_welcomes`
--

INSERT INTO `home_welcomes` (`id`, `heading`, `description`, `photo`, `button_text`, `button_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Welcome To Our Website', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s stan when an unknown printer took a galley of type and scramble. Lorem Ipsum is simply dummy text of the printing and typesetting industry.\r\n\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s stan when an unknown printer took a galley of type and scramble. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'home_welcome_1723550451.jpg', 'Read More', '#', 'Show', '2024-08-13 05:51:56', '2024-08-13 06:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_03_094105_create_admins_table', 1),
(5, '2024_08_13_060653_create_home_banners_table', 2),
(7, '2024_08_13_114831_create_home_welcomes_table', 3),
(8, '2024_08_19_050433_create_home_counters_table', 4),
(9, '2024_08_19_060211_create_speakers_table', 5),
(10, '2024_08_19_102601_create_schedule_days_table', 6),
(11, '2024_08_19_110337_create_schedules_table', 7),
(12, '2024_12_09_091810_create_schedule_speaker_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint UNSIGNED NOT NULL,
  `schedule_day_id` bigint NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `schedule_day_id`, `name`, `title`, `description`, `location`, `time`, `photo`, `item_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Session 1', 'Introduction to PHP and Laravel', 'Join our experts, John Smith and Pat Flynn, as they guide you through the fundamentals of PHP and how it integrates with Laravel to build robust web applications. Perfect for beginners and those looking to enhance their web development skills.', 'Tim Center (3rd Floor), 34, Park Street, NYC, USA', '09:00 AM - 09:45 AM', 'schedule_1724066515.jpg', 1, '2024-08-19 05:21:55', '2024-08-19 07:43:03'),
(2, 1, 'Session 2', 'Advanced SEO Technique', 'Discover advanced SEO strategies with Robin Hood, a seasoned SEO expert, to improve your website\'s visibility and ranking on search engines. This session is ideal for professionals looking to stay ahead in the competitive digital landscape.', 'Tim Center (3rd Floor), 34, Park Street, NYC, USA', '10:00 AM - 10:30 AM', 'schedule_1724066730.jpg', 2, '2024-08-19 05:25:30', '2024-08-19 05:25:30'),
(3, 2, 'Session 1', 'Introduction to Artificial Intelligence', 'Dive into the world of AI with Dr. Paul Smith, a leading researcher in the field. This session will cover the basics of artificial intelligence, its applications, and the future potential of AI technologies.', 'Rokman Hall (5th Floor), 76 Park Street, NYC, USA', '10:00 AM - 10:45 AM', 'schedule_1724066787.jpg', 1, '2024-08-19 05:26:27', '2024-08-19 05:26:27'),
(4, 2, 'Session 2', 'Machine Learning for Beginners', 'Join Alex Johnson, a machine learning expert, as he simplifies the concepts of machine learning. This session is perfect for those new to the field, providing an overview of algorithms, models, and real-world applications.', 'Rokman Hall (5th Floor), 76 Park Street, NYC, USA', '11:00 AM - 11:30 AM', 'schedule_1724066849.jpg', 2, '2024-08-19 05:27:29', '2024-08-19 05:27:29');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_days`
--

CREATE TABLE `schedule_days` (
  `id` bigint UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_days`
--

INSERT INTO `schedule_days` (`id`, `day`, `date1`, `order1`, `created_at`, `updated_at`) VALUES
(1, 'Day 1', 'Sep 20, 2024', '1', '2024-08-19 04:37:55', '2024-08-19 04:47:14'),
(2, 'Day 2', 'Sep 21, 2024', '2', '2024-08-19 04:38:49', '2024-08-19 04:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_speaker`
--

CREATE TABLE `schedule_speaker` (
  `id` bigint UNSIGNED NOT NULL,
  `schedule_id` bigint UNSIGNED NOT NULL,
  `speaker_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule_speaker`
--

INSERT INTO `schedule_speaker` (`id`, `schedule_id`, `speaker_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(5, 3, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6nXO7yg0zLbKQqUaDjvweIJ82RXnV9ijKWK6TBgn', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQ082Mk9IZTk1WUx4MUtwZEd4RG5WMm9wOHl5aGpTWFlUR3lIRGZ2TiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zcGVha2VyLXNjaGVkdWxlL2luZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733747642),
('bzAHsYmWCxSmYlBsmXkef6sPBQLVXJVY1zOdBEf2', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibldCb2czSWRITEUwUHIwdVpqN2RWc21ZMTVNbEc0NmJtenZWRXpHNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733734198),
('umNaYA37cOwOJv5XGQKv2MeBBuOSoB7ypJT17uE9', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2xBVzhrSVc3OHNmcFAxcEc5RW1pczFUTWQzTlpxRXpET1dtNEFPUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1733732530);

-- --------------------------------------------------------

--
-- Table structure for table `speakers`
--

CREATE TABLE `speakers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `biography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `speakers`
--

INSERT INTO `speakers` (`id`, `name`, `slug`, `designation`, `photo`, `email`, `phone`, `biography`, `address`, `website`, `facebook`, `twitter`, `linkedin`, `instagram`, `created_at`, `updated_at`) VALUES
(2, 'John Sword', 'john-sword', 'Founder, BB Company', 'speaker_1724056096.jpg', 'john@example.com', '123-322-1248', 'He is a renowned User Experience (UX) designer with over 15 years of experience in the field. He holds a Master\'s degree in Human-Computer Interaction from Carnegie Mellon University. Throughout his career, John has worked with top-tier tech companies, including Google and Apple, where he led teams in designing user-friendly interfaces for a range of digital products. His expertise lies in creating seamless and engaging user experiences that not only meet but exceed user expectations.\r\n\r\nIn addition to his professional accomplishments, John is a sought-after speaker and educator. He regularly conducts workshops and seminars at major design conferences worldwide, sharing his insights and knowledge with aspiring designers and industry veterans alike.', '43, Park Street, NYC, USA', 'https://www.example.com', '#', '#', '#', '#', '2024-08-19 00:50:33', '2024-08-19 02:28:16'),
(3, 'Danny Allen', 'danny-allen', 'Founder, AA Company', 'speaker_1724055270.jpg', 'danny@example.com', '111-222-3333', 'He is a renowned User Experience (UX) designer with over 15 years of experience in the field. He holds a Master\'s degree in Human-Computer Interaction from Carnegie Mellon University. Throughout his career, John has worked with top-tier tech companies, including Google and Apple, where he led teams in designing user-friendly interfaces for a range of digital products. His expertise lies in creating seamless and engaging user experiences that not only meet but exceed user expectations.\r\n\r\nIn addition to his professional accomplishments, John is a sought-after speaker and educator. He regularly conducts workshops and seminars at major design conferences worldwide, sharing his insights and knowledge with aspiring designers and industry veterans alike.', '43, Park Street, NYC, USA', 'https://www.example.com', '#', '#', '#', '#', '2024-08-19 02:14:30', '2024-08-19 02:26:37'),
(4, 'Steven Gragg', 'steven-gragg', 'Founder, CC Company', 'speaker_1724056075.jpg', 'steven@example.com', '111-222-3322', 'He is a renowned User Experience (UX) designer with over 15 years of experience in the field. He holds a Master\'s degree in Human-Computer Interaction from Carnegie Mellon University. Throughout his career, John has worked with top-tier tech companies, including Google and Apple, where he led teams in designing user-friendly interfaces for a range of digital products. His expertise lies in creating seamless and engaging user experiences that not only meet but exceed user expectations.\r\n\r\nIn addition to his professional accomplishments, John is a sought-after speaker and educator. He regularly conducts workshops and seminars at major design conferences worldwide, sharing his insights and knowledge with aspiring designers and industry veterans alike.', '43, Park Street, NYC, USA', 'https://www.example.com', '#', '#', '#', '#', '2024-08-19 02:27:55', '2024-08-19 02:27:55'),
(5, 'Jordan Parker', 'jordan-parker', 'Founder, DD Company', 'speaker_1724056154.jpg', 'jordan@example.com', '111-222-1122', 'He is a renowned User Experience (UX) designer with over 15 years of experience in the field. He holds a Master\'s degree in Human-Computer Interaction from Carnegie Mellon University. Throughout his career, John has worked with top-tier tech companies, including Google and Apple, where he led teams in designing user-friendly interfaces for a range of digital products. His expertise lies in creating seamless and engaging user experiences that not only meet but exceed user expectations.\r\n\r\nIn addition to his professional accomplishments, John is a sought-after speaker and educator. He regularly conducts workshops and seminars at major design conferences worldwide, sharing his insights and knowledge with aspiring designers and industry veterans alike.', '43, Park Street, NYC, USA', 'https://www.example.com', '#', '#', '#', '#', '2024-08-19 02:29:14', '2024-08-19 03:31:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0=pending, 1=active, 2=suspended',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `password`, `phone`, `country`, `address`, `state`, `city`, `zip`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Smith', 'smith@gmail.com', 'user_1722249473.jpg', '$2y$12$e.oxYabhjXHBrwnI95qePO1Nut9rGApP3J4xq.Pi5aEFXueVNrOge', '123-333-2232', 'USA', '23 Street Road', 'NYC', 'NYC', '82342', '', '1', '2024-07-28 19:13:27', '2024-07-29 04:37:53'),
(2, 'David', 'david@gmail.com', NULL, '$2y$12$FxClW126x1wE27/5cyiM0ufCIB25UeKhU2xczofudIYUbPFWKvnia', NULL, NULL, NULL, NULL, NULL, NULL, '', '1', '2024-07-29 04:14:56', '2024-07-29 04:16:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_counters`
--
ALTER TABLE `home_counters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_welcomes`
--
ALTER TABLE `home_welcomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_days`
--
ALTER TABLE `schedule_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_speaker`
--
ALTER TABLE `schedule_speaker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_speaker_schedule_id_foreign` (`schedule_id`),
  ADD KEY `schedule_speaker_speaker_id_foreign` (`speaker_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `speakers`
--
ALTER TABLE `speakers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `speakers_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_counters`
--
ALTER TABLE `home_counters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `home_welcomes`
--
ALTER TABLE `home_welcomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_days`
--
ALTER TABLE `schedule_days`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule_speaker`
--
ALTER TABLE `schedule_speaker`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `speakers`
--
ALTER TABLE `speakers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule_speaker`
--
ALTER TABLE `schedule_speaker`
  ADD CONSTRAINT `schedule_speaker_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_speaker_speaker_id_foreign` FOREIGN KEY (`speaker_id`) REFERENCES `speakers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
