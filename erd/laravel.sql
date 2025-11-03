-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 04:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `applied_date` datetime NOT NULL,
  `status` enum('active','expired','closed') NOT NULL DEFAULT 'active',
  `resume` varchar(50) DEFAULT NULL,
  `cover_letter` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `job_id`, `candidate_id`, `applied_date`, `status`, `resume`, `cover_letter`, `created_at`, `updated_at`) VALUES
(4, 2, 4, '2025-11-02 03:09:37', 'active', NULL, NULL, '2025-11-01 21:09:37', '2025-11-01 21:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-ayaan@gmail.com|127.0.0.1', 'i:1;', 1762052493),
('laravel-cache-ayaan@gmail.com|127.0.0.1:timer', 'i:1762052493;', 1762052493);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `user_id`, `resume`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'john.pdf', '021457454', '4/78 Los Angle, USA', '2025-10-19 22:02:15', '2025-10-19 22:02:41'),
(2, 5, 'john.pdf', '0148586356', '4/78 los angle,usa', '2025-10-21 23:59:15', '2025-10-21 23:59:15'),
(4, 8, 'nusrat.pdf', '0148586356', '4/78 Los Angle, USA', '2025-10-29 21:48:02', '2025-10-29 21:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image_path`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Finances', 'category_images/RcoYCUhMhhrUnRsSvclyuFNnzBUW3r87Uwy0zauF.jpg', 1, 0, '2025-10-19 21:57:00', '2025-10-31 23:15:21'),
(3, 'HRM', 'category_images/ioNLiDzWyiNKtamUVOmR89p2sPCvipURadCpFb6g.jpg', 1, 0, '2025-10-22 00:07:56', '2025-10-31 23:15:52'),
(4, 'Technology', 'category_images/V02x0QZNtrjwFaQpXuCEdef4Q6MlawiPMHpFF3jR.jpg', 1, 0, '2025-10-31 23:10:48', '2025-10-31 23:15:59'),
(5, 'Marketing', 'category_images/tkdvpE8sQNNOD1WZcYd561V8e2ryvhTVBYMGfk5r.jpg', 1, 4, '2025-11-01 20:46:22', '2025-11-01 20:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `established_year` int(11) DEFAULT NULL,
  `size` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `field_of_study` varchar(255) DEFAULT NULL,
  `school` varchar(255) DEFAULT NULL,
  `edu_from` varchar(255) DEFAULT NULL,
  `edu_to` varchar(255) DEFAULT NULL,
  `edu_description` text DEFAULT NULL,
  `edu_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `resume_id`, `degree`, `field_of_study`, `school`, `edu_from`, `edu_to`, `edu_description`, `edu_logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'MBA', 'Finance', 'Haward University', '2020-01-20', '2022-02-08', 'MBA Graduate', 'edu_logos/DYYpNB7ZYpuuN6a4ZAiQb7X9HI0Bp6pMpHAQftnI.jpg', '2025-10-19 22:07:05', '2025-10-19 22:07:05'),
(2, 2, 'MBA', 'Finance', 'Haward University', '2020-01-20', '2022-02-08', 'MBA Graduate', 'edu_logos/p88uKeqiByQYriCFjU8guDKOH2lSTYtCBROAa2hJ.jpg', '2025-10-19 22:08:24', '2025-10-19 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `user_id`, `company_name`, `website`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'TechWorld', NULL, '021457454', '4/78 los angle,usa', '2025-10-19 21:51:46', '2025-11-01 21:01:29'),
(2, 6, 'TechWorld', 'http://mishel.online', '0148586356', '4/78 los angle,usa', '2025-10-22 00:00:22', '2025-10-22 00:00:22'),
(3, 9, NULL, NULL, NULL, NULL, '2025-10-26 21:01:14', '2025-10-26 21:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `employer_packages`
--

CREATE TABLE `employer_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employer_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exp_from` varchar(255) DEFAULT NULL,
  `exp_to` varchar(255) DEFAULT NULL,
  `exp_description` text DEFAULT NULL,
  `exp_logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `resume_id`, `company_name`, `title`, `exp_from`, `exp_to`, `exp_description`, `exp_logo`, `created_at`, `updated_at`) VALUES
(1, 1, 'TechWorld', 'Executive', '2024-01-20', '2025-10-20', 'TechWorld Executive', 'exp_logos/qazoYsDHyrwWrH6WNusoMacp0MrC0CEF0WAcgViQ.jpg', '2025-10-19 22:07:05', '2025-10-19 22:07:05'),
(2, 2, 'TechWorld', 'Executive', '2024-01-20', '2025-10-20', 'TechWorld Executive', 'exp_logos/OnZoxqmWr9PBQKgRratU0LkXOrMX1kyogg0uL8C3.jpg', '2025-10-19 22:08:24', '2025-10-19 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `application_email` varchar(255) DEFAULT NULL,
  `application_url` varchar(255) DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_email`, `title`, `location`, `category_id`, `tags`, `description`, `application_email`, `application_url`, `closing_date`, `company_name`, `website`, `tagline`, `cover_image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'sharmin@gmail.com', 'Financial Manager', 'USA', 1, 'Finance, Manager', 'Managing a company\'s financial health through activities like budgeting, financial reporting, and forecasting. Core duties include recording daily transactions, processing invoices, and reconciling accounts payable and receivable.Core duties include recording daily transactions, processing invoices, and reconciling accounts payable and receivable.', 'sharmin@gmail.com', 'http://127.0.0.1:8000/job-apply', '2025-10-25', 'it world', 'http://127.0.0.1:8000/', 'Finance', 'job_covers/DaBNigFJ6GbVb9dFzTL6slUPtJkgnh8hiH0uSqPi.jpg', 'active', '2025-10-19 22:54:25', '2025-10-31 23:39:46'),
(2, 'sharmin@gmail.com', 'HRM', 'USA', 3, 'HRM, Manager', 'Developing and implementing HR policies and procedures\nCreating strategic HR plans\nAdministering compensation and benefits programs\nActing as a liaison between upper management and employees', 'sharmin@gmail.com', 'http://127.0.0.1:8000/job-apply', '2025-10-25', 'World Tech', 'http://127.0.0.1:8000/', 'HRM', 'job_covers/5DgvW0vkZzSIzwFBqnIKbNppfb1KSde6rg47huFw.jpg', 'active', '2025-10-22 00:09:16', '2025-10-22 00:09:16'),
(3, 'mishel@gmail.com', 'Software Engineer', 'USA', 4, 'Engineer, Software Engineer', 'a professional who designs, develops, tests, and maintains software applications by applying engineering principles to create high-quality, dependable, and effective software.', 'mishel@gmail.com', 'http://127.0.0.1:8000/job-apply', '2025-11-22', 'TechWorld', 'http://127.0.0.1:8000/', 'TechWorld', 'job_covers/8nPNSIjF7HSMOsT5GeW48VEvXYecvK6Uo2U4mGUq.jpg', 'active', '2025-11-01 21:04:59', '2025-11-01 21:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `job_alerts`
--

CREATE TABLE `job_alerts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contract_type` varchar(255) NOT NULL DEFAULT 'full‑time',
  `frequency` varchar(255) NOT NULL DEFAULT 'daily',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_bookmarks`
--

CREATE TABLE `job_bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `candidate_id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `saved_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_locations`
--

CREATE TABLE `job_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_views`
--

CREATE TABLE `job_views` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `viewed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `application_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `sent_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '2025_10_08_050141_create_categories_table', 1),
(4, '2025_10_08_064028_create_applications_table', 1),
(5, '2025_10_08_064036_create_candidates_table', 1),
(6, '2025_10_12_172011_create_jobs_table', 1),
(7, '2025_10_12_173621_create_resumes_table', 1),
(8, '2025_10_12_173653_create_educations_table', 1),
(9, '2025_10_12_173656_create_experiences_table', 1),
(10, '2025_10_12_173659_create_skills_table', 1),
(11, '2025_10_17_073032_create_roles_table', 1),
(12, '2025_10_17_073121_add_role_id_to_users_table', 1),
(13, '2025_10_17_073342_create_employers_table', 1),
(14, '2025_10_19_062347_create_job_alerts_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 3, 'Profile', 'Your profile information was updated successfully.', 1, '2025-11-01 00:25:12', '2025-11-01 00:26:47'),
(2, 1, 'Profile', 'Your profile information was updated successfully.', 0, '2025-11-01 00:26:21', '2025-11-01 00:26:21'),
(3, 2, 'Profile', 'Your profile information was updated successfully.', 0, '2025-11-01 00:26:23', '2025-11-01 00:26:23'),
(4, 8, 'Profile', 'Your profile information was updated successfully.', 0, '2025-11-01 00:26:39', '2025-11-01 00:26:39'),
(5, 6, 'Profile', 'Your profile information was updated successfully.', 0, '2025-11-01 21:01:10', '2025-11-01 21:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration_days` int(11) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `price`, `duration_days`, `features`, `created_at`, `updated_at`) VALUES
(1, 'Basic Plan', 19.99, 30, 'Access to basic features, Email support', '2025-11-01 05:18:13', '2025-11-01 05:18:13'),
(2, 'Standard Plan', 49.99, 90, 'Access to all basic features, Priority support, Monthly reports', '2025-11-01 05:18:13', '2025-11-01 05:18:13'),
(3, 'Premium Plan', 99.99, 180, 'All Standard Plan features, Advanced analytics, Dedicated account manager', '2025-11-01 05:18:13', '2025-11-01 05:18:13'),
(4, 'Enterprise Plan', 199.99, 365, 'All Premium features, API access, Custom integrations, 24/7 support', '2025-11-01 05:18:13', '2025-11-01 05:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resumes`
--

CREATE TABLE `resumes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profession_title` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `pre_hour` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resumes`
--

INSERT INTO `resumes` (`id`, `user_id`, `name`, `email`, `profession_title`, `location`, `web`, `pre_hour`, `age`, `cover_image`, `created_at`, `updated_at`) VALUES
(1, NULL, 'john', 'john@gmail.com', 'Executive', 'USA', NULL, '$100', 30, 'covers/132nk3s1npEJ9Fev4eUZ8IW3pk4xPCVTGQ4sn77I.jpg', '2025-10-19 22:07:05', '2025-10-19 22:07:05'),
(2, NULL, 'john', 'john@gmail.com', 'Executive', 'USA', NULL, '$100', 30, 'covers/6zbNdWjLWxsVpQEhs0OhDjVdD5IhyLtLmXnleWrh.jpg', '2025-10-19 22:08:24', '2025-10-19 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-10-20 03:49:43', '2025-10-20 03:49:43'),
(2, 'candidate', '2025-10-20 03:49:43', '2025-10-20 03:49:43'),
(3, 'employer', '2025-10-20 03:50:15', '2025-10-20 03:50:15');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resume_id` bigint(20) UNSIGNED NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `skill_percent` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `resume_id`, `skill_name`, `skill_percent`, `created_at`, `updated_at`) VALUES
(1, 1, 'CRM', 100, '2025-10-19 22:07:05', '2025-10-19 22:07:05'),
(2, 2, 'CRM', 100, '2025-10-19 22:08:24', '2025-10-19 22:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('pending','active') NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ayaan Mohammad', 'ayaan@gmail.com', NULL, '$2y$12$Mpiv7uYEqpGBccbih/IoK.5KjamaLbRd1YyxnlhDmwESYyMUkRzf6', 'active', NULL, '2025-10-19 21:51:46', '2025-11-01 00:26:21'),
(2, 2, 'john', 'john@gmail.com', NULL, '$2y$12$HRl39J0ZBYgi2R9WxHLpI.vf5npMTI99DLxpl5VeKYQ5pSzRMewgu', 'active', NULL, '2025-10-19 22:02:15', '2025-11-01 00:26:23'),
(3, 1, 'admin', 'admin@gmail.com', NULL, '$2y$12$kdygzVd7OYgxBaQJcnDKquvf7DtB1cuEUCYWFPV4nNdeHqOEg.50e', 'active', NULL, '2025-10-20 21:52:54', '2025-11-01 00:25:12'),
(4, 3, 'Lima Akter', 'lima@gmail.com', NULL, '$2y$12$aOgncbY.xHdSjTYqCRjhUuWjaa7Mstuiq7kpNLrPmCpMxu60SascW', '', NULL, '2025-10-20 22:33:20', '2025-10-20 22:33:20'),
(5, 2, 'johny', 'johny@gmail.com', NULL, '$2y$12$7MghmmvTpeTDO.esMmwl.uiQdaYs/I0oaPQMpJRzbOJByW7GQO07W', '', NULL, '2025-10-21 23:59:15', '2025-10-21 23:59:15'),
(6, 3, 'mishel', 'mishel@gmail.com', NULL, '$2y$12$dPyqIcRu3KLt6XmVd/bM0uJqYOH/QFSm/K3ODYLcxuO4m8GOoaz3e', 'active', NULL, '2025-10-22 00:00:22', '2025-11-01 21:01:10'),
(8, 2, 'Nusrat', 'nusrat@gmail.com', NULL, '$2y$12$wLZaD0HYeJwFJiR1iQT6Z.D1AsnD.zQWtUQB8CIFhmUK.q6fLuWEO', 'active', NULL, '2025-10-26 20:54:07', '2025-11-01 00:26:39'),
(9, 3, 'Nihal', 'nihal@gmail.com', NULL, '$2y$12$ESw5fcuew8ZcZaCMb9vqOOPJxq5V7rvVy3aAPOqy30/MGOvFKKNG2', '', NULL, '2025-10-26 21:01:14', '2025-10-26 21:01:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_job_id_foreign` (`job_id`),
  ADD KEY `applications_candidate_id_foreign` (`candidate_id`);

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
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `candidates_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educations_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employers_user_id_foreign` (`user_id`);

--
-- Indexes for table `employer_packages`
--
ALTER TABLE `employer_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_packages_employer_id_foreign` (`employer_id`),
  ADD KEY `employer_packages_package_id_foreign` (`package_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_category_id_foreign` (`category_id`);

--
-- Indexes for table `job_alerts`
--
ALTER TABLE `job_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_alerts_user_id_foreign` (`user_id`);

--
-- Indexes for table `job_bookmarks`
--
ALTER TABLE `job_bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_bookmarks_seeker_id_foreign` (`candidate_id`),
  ADD KEY `job_bookmarks_job_id_foreign` (`job_id`);

--
-- Indexes for table `job_locations`
--
ALTER TABLE `job_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `job_views`
--
ALTER TABLE `job_views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_views_job_id_foreign` (`job_id`),
  ADD KEY `job_views_viewer_id_foreign` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`),
  ADD KEY `messages_application_id_foreign` (`application_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `resumes`
--
ALTER TABLE `resumes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resumes_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skills_resume_id_foreign` (`resume_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employer_packages`
--
ALTER TABLE `employer_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_alerts`
--
ALTER TABLE `job_alerts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_bookmarks`
--
ALTER TABLE `job_bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_locations`
--
ALTER TABLE `job_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_views`
--
ALTER TABLE `job_views`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resumes`
--
ALTER TABLE `resumes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_candidate_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `candidates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `educations_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employers`
--
ALTER TABLE `employers`
  ADD CONSTRAINT `employers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employer_packages`
--
ALTER TABLE `employer_packages`
  ADD CONSTRAINT `employer_packages_employer_id_foreign` FOREIGN KEY (`employer_id`) REFERENCES `employers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `employer_packages_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `job_alerts`
--
ALTER TABLE `job_alerts`
  ADD CONSTRAINT `job_alerts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_bookmarks`
--
ALTER TABLE `job_bookmarks`
  ADD CONSTRAINT `job_bookmarks_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_bookmarks_seeker_id_foreign` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_views`
--
ALTER TABLE `job_views`
  ADD CONSTRAINT `job_views_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `job_views_viewer_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resumes`
--
ALTER TABLE `resumes`
  ADD CONSTRAINT `resumes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `skills_resume_id_foreign` FOREIGN KEY (`resume_id`) REFERENCES `resumes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
