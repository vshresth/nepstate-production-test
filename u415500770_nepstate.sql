-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 19, 2025 at 09:26 AM
-- Server version: 10.11.10-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u415500770_nepstate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `region_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `admin_profile_pic` varchar(255) DEFAULT 'dummy_image.png',
  `is_deleted` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `satff` int(11) NOT NULL DEFAULT 0,
  `role_type` varchar(50) DEFAULT NULL,
  `permissions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `lparent`, `lang_id`, `region_id`, `name`, `email`, `username`, `password`, `status`, `session_id`, `admin_profile_pic`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_by`, `satff`, `role_type`, `permissions`) VALUES
(-1, 0, 0, 0, 'Super Admin', 'admin@admin.com', 'Super Admin', '$2y$10$10YfmYg0zG.PvMCT7EcFCuGTBK8Isn3kuWxq/qVmmdvr38QwWcXnC', 1, '', 'https://admin.nepstate.com/images/1725361624_paul-earle-wVjd0eWNqI8-unsplash.jpg', 0, '2024-04-02 09:33:22', 0, '2024-09-03 11:07:04', 0, 0, 0, 'admin', ''),
(36, 0, 0, NULL, 'nep states', 'info@nepstates.com', 'vibewithvss', '$2y$10$VHf1iTVmeCJMEk0LXET1qOK8DMK6BV7Uy9vnf3jrtYPSwp0akWuYG', 1, NULL, 'dummy_image.png', 0, '2025-02-27 07:05:26', 0, '2025-03-03 17:38:16', 0, 0, 0, 'sub_admin', 'Dashboard,Users,Countries,Classified_Categories,Classified,Advertisment,Payment_Plans,Forum,Confession,Blogs,FAQS,Static_Page,Testimonials,Google_Ads,All_Comments,Coupons,Notifications,Settings,Reviews,Blogs_Request'),
(39, 0, 0, NULL, 'Sam Shrestha', 'samshrestha.nepstate@gmail.com', 'samshrestha.nepstate@gmail.com', '$2y$10$vz7jU.THg./buqTt2aaI0OaWeOBRpQ6i.zMgtkm6sFcznRKtZS0H2', 1, NULL, 'dummy_image.png', 0, '2025-03-13 15:15:13', 0, '2025-03-13 15:15:58', 0, 0, 0, 'sub_admin', 'Dashboard,Users,Countries,Classified_Categories,Classified,Advertisment,Payment_Plans,Forum,Confession,Blogs,FAQS,Static_Page,Testimonials,Google_Ads,All_Comments,Coupons,Notifications,Settings,Reviews,Blogs_Request');

-- --------------------------------------------------------

--
-- Table structure for table `admin_cities`
--

CREATE TABLE `admin_cities` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_countries`
--

CREATE TABLE `admin_countries` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `services_fee` double DEFAULT NULL,
  `fee_status` int(11) DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_countries`
--

INSERT INTO `admin_countries` (`id`, `code`, `title`, `flag`, `services_fee`, `fee_status`, `status`) VALUES
(1, 'US', 'United States', 'https://admin.nepstate.com/flags/1717479096.png', 1.97, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_history`
--

CREATE TABLE `admin_login_history` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `date_time` datetime NOT NULL,
  `browser` varchar(150) NOT NULL,
  `platfrom` varchar(150) NOT NULL,
  `user_agent` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `admin_notification`
--

CREATE TABLE `admin_notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=read, 0=unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `role` int(2) NOT NULL DEFAULT 0,
  `assigned_on` datetime NOT NULL,
  `role_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `admin_id`, `role`, `assigned_on`, `role_name`) VALUES
(1, 1, -1, '2022-06-22 10:13:36', 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `all_notifications`
--

CREATE TABLE `all_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `notification_indicate` varchar(50) DEFAULT NULL,
  `notification_for` varchar(50) NOT NULL COMMENT 'admin => for super admin, user => for users',
  `type` varchar(50) NOT NULL,
  `indicate_id` int(11) DEFAULT NULL,
  `indicate_slug` varchar(255) DEFAULT NULL,
  `indicate_title` text DEFAULT NULL,
  `text` text DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `all_notifications`
--

INSERT INTO `all_notifications` (`id`, `user_id`, `creator_id`, `notification_indicate`, `notification_for`, `type`, `indicate_id`, `indicate_slug`, `indicate_title`, `text`, `comment`, `seen`, `created_at`) VALUES
(7, 72, 72, 'new-message', 'user', 'new-message', 56, 'Nep States', NULL, 'You have received a new message', NULL, 0, '2025-01-23 10:10:00'),
(137, 2, NULL, 'blog', 'admin', 'add-new-blog', 1, 'nepali-businesses-in-the-usa-building-community-and-success', 'Nepali Businesses in the USA: Building Community and Success', 'Request for blog approval', NULL, 1, '2025-03-03 10:51:00'),
(138, 4, NULL, 'signup', 'admin', 'new-signup', 4, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-05 14:02:00'),
(139, 2, NULL, 'promote', 'admin', 'create-ad-for-home-category-page', 8, NULL, NULL, 'Create New create-ad-for-home-category-page by user', NULL, 0, '2025-03-07 09:58:00'),
(140, 2, NULL, 'promote', 'admin', 'create-ad-for-home-category-page', 9, NULL, NULL, 'Create New create-ad-for-home-category-page by user', NULL, 0, '2025-03-07 10:02:00'),
(141, 2, NULL, 'promote', 'admin', 'create-ad-for-home-category-page', 10, NULL, NULL, 'Create New create-ad-for-home-category-page by user', NULL, 0, '2025-03-07 10:04:00'),
(142, 2, NULL, 'promote', 'admin', 'create-ad-for-home-category-page', 11, NULL, NULL, 'Create New create-ad-for-home-category-page by user', NULL, 0, '2025-03-07 10:06:00'),
(143, 2, NULL, 'promote', 'admin', 'create-ad-for-home-category-page', 12, NULL, NULL, 'Create New create-ad-for-home-category-page by user', NULL, 0, '2025-03-07 10:07:00'),
(144, 2, NULL, 'promote', 'admin', 'create-ad-for-blog', 13, NULL, NULL, 'Create New create-ad-for-blog by user', NULL, 0, '2025-03-07 10:10:00'),
(145, 2, NULL, 'promote', 'admin', 'create-ad-for-forum', 14, NULL, NULL, 'Create New create-ad-for-forum by user', NULL, 0, '2025-03-07 10:10:00'),
(146, 2, NULL, 'promote', 'admin', 'create-ad-for-confession', 15, NULL, NULL, 'Create New create-ad-for-confession by user', NULL, 0, '2025-03-07 10:10:00'),
(147, 5, NULL, 'signup', 'admin', 'new-signup', 5, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-09 13:16:00'),
(148, 6, NULL, 'signup', 'admin', 'new-signup', 6, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-09 13:16:00'),
(149, 7, NULL, 'signup', 'admin', 'new-signup', 7, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-09 17:14:00'),
(150, 8, NULL, 'signup', 'admin', 'new-signup', 8, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-09 19:10:00'),
(151, 9, NULL, 'signup', 'admin', 'new-signup', 9, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-10 04:05:00'),
(152, 2, NULL, 'promote', 'admin', 'create-ad-for-home-banner', 16, NULL, NULL, 'Create New create-ad-for-home-banner by user', NULL, 0, '2025-03-12 07:21:00'),
(154, 4, NULL, 'events', 'admin', 'add-new-event', 4, NULL, NULL, 'Create New Events by user', NULL, 0, '2025-03-12 11:39:00'),
(155, 4, NULL, 'promote', 'admin', 'create-ad-for-right-banner', 17, NULL, NULL, 'Create New create-ad-for-right-banner by user', NULL, 0, '2025-03-12 11:39:00'),
(156, 11, NULL, 'signup', 'admin', 'new-signup', 11, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-13 08:24:00'),
(159, 14, NULL, 'signup', 'admin', 'new-signup', 14, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-13 08:49:00'),
(161, 16, NULL, 'signup', 'admin', 'new-signup', 16, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 10:19:00'),
(162, 17, NULL, 'signup', 'admin', 'new-signup', 17, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 10:28:00'),
(163, 18, NULL, 'signup', 'admin', 'new-signup', 18, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 10:30:00'),
(164, 19, NULL, 'signup', 'admin', 'new-signup', 19, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 19:15:00'),
(165, 20, NULL, 'signup', 'admin', 'new-signup', 20, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 20:20:00'),
(166, 21, NULL, 'signup', 'admin', 'new-signup', 21, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 21:10:00'),
(167, 22, NULL, 'signup', 'admin', 'new-signup', 22, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 23:13:00'),
(168, 23, NULL, 'signup', 'admin', 'new-signup', 23, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-18 23:57:00'),
(169, 24, NULL, 'signup', 'admin', 'new-signup', 24, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 08:54:00'),
(170, 25, NULL, 'signup', 'admin', 'new-signup', 25, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 11:35:00'),
(171, 26, NULL, 'signup', 'admin', 'new-signup', 26, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 12:04:00'),
(172, 27, NULL, 'signup', 'admin', 'new-signup', 27, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 13:02:00'),
(173, 28, NULL, 'signup', 'admin', 'new-signup', 28, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 13:04:00'),
(174, 29, NULL, 'signup', 'admin', 'new-signup', 29, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 13:43:00'),
(175, 30, NULL, 'signup', 'admin', 'new-signup', 30, NULL, NULL, 'New Signup by user', NULL, 0, '2025-03-19 13:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `link` int(11) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `uID` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `notif` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL DEFAULT 0,
  `city_id` varchar(100) DEFAULT NULL,
  `is_approved` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `author`, `description`, `link`, `tags`, `image`, `created_at`, `uID`, `status`, `notif`, `country_id`, `city_id`, `is_approved`) VALUES
(1, 'Nepali Businesses in the USA: Building Community and Success', 'nepali-businesses-in-the-usa-building-community-and-success', 'NepState Admin', '<p dir=\"ltr\">Have you ever walked into a Nepali restaurant or shop in the USA and wondered about the story behind it? Nepali businesses in the USA have grown exponentially over the last decade, contributing to the country&rsquo;s diverse entrepreneurial landscape. From small mom-and-pop shops to tech startups, the Nepali community is leaving its mark. Let&rsquo;s dive into how Nepali businesses are flourishing, the challenges they face, and their cultural and economic contributions to the U.S.</p>\r\n<h2 dir=\"ltr\">Why Nepali Businesses Thrive in the USA</h2>\r\n<p dir=\"ltr\">You might be asking yourself, what makes Nepali businesses so successful in a competitive market like the USA? The Nepali community is known for its resilience and hard work. Many entrepreneurs bring skills honed in Nepal and adapt them to the American market. Here&rsquo;s why they thrive:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://en.wikipedia.org/wiki/Nepali_American#Community_support\">Community Support</a>: Nepali Americans often rally around local businesses, creating a strong foundation for success. Have you supported a Nepali business in your area?</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://pmc.ncbi.nlm.nih.gov/articles/PMC5645023/\">Cultural Adaptability</a>: The ability to blend traditional Nepali values with modern business practices helps these businesses thrive.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.census.gov/programs-surveys/economic-census.html\">Diverse Industries</a>: Nepali entrepreneurs are involved in a wide range of sectors, from hospitality and retail to IT and healthcare.<br><br></p>\r\n</li>\r\n</ol>\r\n<p dir=\"ltr\">According to the U.S. Census Bureau, as of 2020, there are over 200,000 people of Nepali origin living in the United States, with significant populations in states like Texas, California, New York, and Virginia.</p>\r\n<h2 dir=\"ltr\">Popular Types of Nepali Businesses</h2>\r\n<p dir=\"ltr\">When you think of Nepali businesses, what comes to mind? Restaurants? Grocery stores? Let&rsquo;s explore the most common sectors:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.yelp.com/\">Nepali Restaurants</a>:</p>\r\n</li>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"2\">\r\n<p dir=\"ltr\" role=\"presentation\">Have you tried momos, dal bhat, or chow mein from a local Nepali restaurant? Nepali cuisine is gaining popularity in cities with large Nepali populations. Restaurants like<a href=\"https://www.rhmomo.com/\">Roadhouse Momo &amp; Grill</a> and<a href=\"https://www.bajekosekuwa.com/outlet/bajeko-sekuwa-the-himalayan-grill-dallas\">Bajeko Sekuwa</a>: serve authentic flavors while appealing to a wider audience.</p>\r\n</li>\r\n</ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://himalayanbazaar.com/\">Grocery Stores</a>:</p>\r\n</li>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"2\">\r\n<p dir=\"ltr\" role=\"presentation\">Stores like<a href=\"https://himalayanbazaar.com/\"> Himalayan Bazaar</a>: offer imported goods that cater to the community, including spices, lentils, and Nepali snacks. What&rsquo;s your go-to item from these stores?</p>\r\n</li>\r\n</ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.techhimalayasolutions.com/\">IT Services and Startups</a>:</p>\r\n</li>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"2\">\r\n<p dir=\"ltr\" role=\"presentation\">Nepali professionals are making waves in the tech industry, founding startups and offering IT consulting services. Companies like<a href=\"https://techstaffinghub.com/\"> TechStaffingHUb</a><a href=\"https://www.cubicit.net/\"> Cubic Technologies</a>: have gained traction in states like California and Texas.</p>\r\n</li>\r\n</ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://nepaltoursusa.com/\">Travel Agencies</a>:</p>\r\n</li>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"2\">\r\n<p dir=\"ltr\" role=\"presentation\">Travel agencies specializing in trips to Nepal and South Asia help connect the diaspora to their roots. Agencies like<a href=\"https://www.nepaltravelsonline.com/\"> Nepal Travels and Tours</a>: provide an essential service to the community.</p>\r\n</li>\r\n</ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://nrna.org/\">Event Management and Cultural Services</a>:</p>\r\n</li>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"2\">\r\n<p dir=\"ltr\" role=\"presentation\">From weddings to festivals, businesses organizing cultural events<a href=\"https://namloevents.com/\"> Namlo Events</a> help preserve Nepali traditions. Have you attended one recently?<br><br></p>\r\n</li>\r\n</ul>\r\n</ol>\r\n<h2 dir=\"ltr\">Challenges Nepali Entrepreneurs Face</h2>\r\n<p><strong id=\"docs-internal-guid-e130d501-7fff-394e-808a-a7548889c561\"><img src=\"https://lh7-rt.googleusercontent.com/docsz/AD_4nXcwWai9vWcbKc5bvc3tuiTxbOExxR6vG5jIrLmy5LQkw7k8X8nABHEbwXbn47BsPrzReRlAZwWoFLhY8JYa9o-HFy-8Qz9hlFbov6z_y1kbOVPkrKyg-NxB8obBLZvH5iiBbYenIA?key=gnFjjRhzVDxnvyy5BvOqBGeD\" width=\"624\" height=\"441\"></strong></p>\r\n<p dir=\"ltr\">Every journey comes with its challenges. Nepali business owners often encounter hurdles like:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Access to Capital: Securing loans or investment funding can be challenging for first-generation entrepreneurs. What resources could help bridge this gap?</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Navigating Regulations: Adapting to U.S. business laws and tax codes can be overwhelming.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Competition: Standing out in competitive markets dominated by larger, established players requires innovation and persistence.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Balancing Tradition and Modernity: Maintaining cultural authenticity while appealing to a diverse customer base is a delicate balance.</p>\r\n</li>\r\n</ol>\r\n<h2 dir=\"ltr\">How NepState Can Help Nepali Businesses</h2>\r\n<p><strong id=\"docs-internal-guid-dc72c54a-7fff-c7ec-4f76-c7b823850df8\"><img src=\"https://lh7-rt.googleusercontent.com/docsz/AD_4nXfJ1jxM-SAcymJGcOmwiLA8Zj01aT4gF8LtZEjRmoJPBXKvJ0XaVu4InrraMUj_SwdfoQNU8OZuBwYSVpKhzjJgugSiT4NksgCW2GuYbi6O90cnY4UucqrvbhXH-jUua4Uk520y?key=gnFjjRhzVDxnvyy5BvOqBGeD\" width=\"624\" height=\"305\"></strong></p>\r\n<p dir=\"ltr\">NepState is a platform dedicated to connecting Nepali businesses with their community and beyond. Explore the platform at<a href=\"https://nepstate.com/\"> NepState</a>. Whether you&rsquo;re looking to list your business, promote your services, or advertise to a broader audience, NepState can help. Here&rsquo;s how:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://nepstate.com/\">Business Listings</a>: Create detailed listings to showcase your offerings.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"classifieds/services\">Advertising Opportunities</a>: Run targeted ads to reach your audience effectively.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"forums\">Community Engagement</a>: Share updates, confessions, or stories through forums and blogs.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"classifieds/jobs\">Job </a>and <a href=\"classifieds/services\">Service Listings:</a> Hire or offer services tailored to the Nepali community.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"classifieds/events\">Events and Networking</a>: Promote or discover events that foster collaboration.</p>\r\n</li>\r\n</ul>\r\n<p dir=\"ltr\">By using NepState, businesses can foster unity and support within the community. If you&rsquo;re a Nepali entrepreneur, why not<a href=\"https://nepstate.com/\"> list your business</a> today?</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h2 dir=\"ltr\">Cultural and Economic Contributions</h2>\r\n<p dir=\"ltr\">Nepali businesses aren&rsquo;t just about profits; they&rsquo;re about impact. Here&rsquo;s how they contribute:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Economic Growth: Nepali-owned businesses create jobs and contribute to local economies. For instance, in Texas alone, Nepali entrepreneurs contribute millions annually to the state economy.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Cultural Exchange: Restaurants, festivals, and cultural events introduce American communities to Nepal&rsquo;s rich heritage.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Philanthropy: Many businesses give back by supporting local charities and initiatives in Nepal, fostering goodwill.</p>\r\n</li>\r\n</ol>\r\n<h2 dir=\"ltr\">Tips for Aspiring Nepali Entrepreneurs</h2>\r\n<p><strong id=\"docs-internal-guid-1eb1d307-7fff-34d0-3595-33c6728a0927\"><img src=\"https://lh7-rt.googleusercontent.com/docsz/AD_4nXedDRwPg7A8VPxVfwf92obnFDIB5GoePH4lfE8JxpiLYxheiVX0e0PeE-ezfbttyhqXNSyHZwoGPGwNnmOc7EAd3dua4hSPq2n3yERBsMpyO6fEGVCU0Q512hHF1unGDRR4f26ObQ?key=gnFjjRhzVDxnvyy5BvOqBGeD\" width=\"624\" height=\"264\"></strong></p>\r\n<p>&nbsp;</p>\r\n<p dir=\"ltr\">If you&rsquo;re thinking about starting your own business, here&rsquo;s some advice for you:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Leverage Community Networks: Join local Nepali associations and chambers of commerce for support and guidance. For example, the<a href=\"https://nrna.org/\"> Non-Resident Nepali Association (NRNA)</a>: offers resources and networking opportunities.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Focus on Authenticity: Highlight the uniqueness of Nepali culture to differentiate your business.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Utilize Technology: Use social media, SEO, and online marketing to reach broader audiences. Do you already have a website or social media presence?</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Seek Mentorship: Connect with successful Nepali entrepreneurs for insights and advice. Who inspires you in your community?<br><br></p>\r\n</li>\r\n</ol>\r\n<h2 dir=\"ltr\">Statistics by State</h2>\r\n<p><strong id=\"docs-internal-guid-e505a5fc-7fff-7ac3-5036-343e830b709d\"><img src=\"https://lh7-rt.googleusercontent.com/docsz/AD_4nXc58wR6tPmPaytPU532Vi83Kkxxga1Ewe6rMcBA1kSu8P-WFtpXdT94Q6_DEn3ax2pTZEUbwp4NBucncC2tf8O82QBNTom9SJWRAJnw5ElIfzdC0Gx7vVSAHz2U3KMWwLuEADHf?key=gnFjjRhzVDxnvyy5BvOqBGeD\" width=\"624\" height=\"393\"></strong></p>\r\n<p dir=\"ltr\">Did you know where most Nepali Americans live? Here&rsquo;s a quick snapshot:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Texas: Home to over 30,000 Nepali residents, with a strong presence of restaurants and IT services.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">California: Over 40,000 Nepali residents, leading in tech startups and travel agencies.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">New York: Approximately 25,000 Nepali residents, with a focus on retail and cultural businesses.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Virginia: Around 15,000 Nepali residents, contributing significantly to the hospitality industry.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Maryland: Nearly 10,000 Nepali residents, with a growing presence in small businesses and community services.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">North Carolina: Approximately 8,000 Nepali residents, known for contributions in retail and professional services.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Colorado: About 7,000 Nepali residents, many of whom are involved in hospitality and tourism-related businesses.<br><br></p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\"><a href=\"https://www.census.gov/topics/population.html\">Source: U.S. Census Bureau, 2020 Data</a></h3>\r\n<h2 dir=\"ltr\">Nepal-Related Resources and Terms</h2>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://us.nepalembassy.gov.np/\">Nepal Embassy DC</a>: A vital hub for the Nepali diaspora in the USA.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://time.is/Nepal\">Nepal Time</a>: Stay connected with Nepali time zones.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://en.wikipedia.org/wiki/Flag_of_Nepal\">Nepal Flag</a>: Learn about the unique design of Nepal\'s national flag.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://nepalicalendar.rat32.com/\">Nepali Calendar</a>: A useful tool for tracking Nepali festivals and dates.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.npl.com.np/\">Nepali Premier League</a>: Follow Nepal&rsquo;s popular cricket league.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.xe.com/currencyconverter/convert/?Amount=1&amp;From=USD&amp;To=NPR\">USD to Nepali Rupee</a>: Current exchange rates.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://ads.google.com/\">Online Advertising for Nepali Businesses</a>: Tools to grow your business visibility.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.avvo.com/\">Nepali Lawyers Near Me</a>: Find legal experts who understand your needs.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\"><a href=\"https://www.immihelp.com/\">Nepali Immigration Lawyer Near Me</a>: Resources for immigration support.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Nepali Confessions: Explore stories and insights shared by the community.<br><br></p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">Conclusion</h2>\r\n<p dir=\"ltr\">Nepali businesses in the USA are a testament to the community&rsquo;s entrepreneurial spirit and adaptability. These ventures not only provide financial opportunities but also serve as bridges between two cultures. So, what can you do to support this thriving community?</p>\r\n<p dir=\"ltr\">Whether you\'re part of the Nepali diaspora or simply an admirer of their resilience, supporting these businesses helps keep their vibrant culture alive. And if you&rsquo;re a business owner, don&rsquo;t miss the opportunity to expand your reach and connect with your community on NepState. Let&rsquo;s celebrate and support the growing Nepali entrepreneurial community in the USA!</p>\r\n<p>&nbsp;</p>', NULL, 'nepalibusinessinusa,nepaliblog,nepalilisting', 'https://nepstate.com/resources/uploads/classified-listing/ec15ef8f19aa7a82a6bf526bbd765d3f.jpg', '2025-03-03 10:51:48', 2, 1, 1, 1, NULL, 1),
(2, 'How to Improve Your Google Rankings with Nepali Business Listings', 'how-to-improve-your-google-rankings-with-nepali-business-listings', 'NepState Admin', '<p>Getting your business to rank higher on&nbsp;<strong>Google search results</strong>&nbsp;is crucial for visibility. One&nbsp;<strong>powerful yet often overlooked strategy</strong>&nbsp;is using&nbsp;<strong>Nepali business listings</strong>&nbsp;to improve SEO.&nbsp;</p>\r\n<p>By listing your business on<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>&nbsp;and other directories, you can:&nbsp;</p>\r\n<ul>\r\n<li>Increase online visibility&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Improve local SEO rankings&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Drive more traffic to your website&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Attract more customers in Nepal and globally&nbsp;</li>\r\n</ul>\r\n<p>In this guide, we&rsquo;ll explore how&nbsp;<strong>Nepali business listings</strong>&nbsp;help&nbsp;<strong>boost your Google rankings</strong>&nbsp;and how to optimise your listings for maximum benefits.&nbsp;</p>\r\n<h2><strong>What Are Nepali Business Listings?</strong>&nbsp;</h2>\r\n<p>A&nbsp;<strong>Nepali business listing</strong>&nbsp;is an online profile that contains essential details about your business, including:&nbsp;</p>\r\n<p>✅ Business name<br>✅ Address<br>✅ Phone number (NAP)<br>✅ Website link<br>✅ Services and products<br>✅ Customer reviews&nbsp;</p>\r\n<p>These listings&nbsp;<strong>help businesses appear in local searches</strong>&nbsp;and enhance credibility.&nbsp;</p>\r\n<h2><strong>Top Nepali Business Listing Websites</strong>&nbsp;</h2>\r\n<table style=\"border-color: black;\">\r\n<tbody>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">Business Listing Site</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">SEO Benefit</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">Best For</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\"><a href=\"https://nepstate.com/\">NepState</a></td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">High domain authority</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">All businesses</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Google My Business</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Local SEO</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Brick-and-mortar stores</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Yelp Nepal</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Customer engagement</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Restaurants, cafes</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Justdial Nepal</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Business discovery</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Service providers</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Facebook Business</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Social media exposure</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Small businesses</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>By listing on <strong>multiple platforms</strong>, businesses&nbsp;<strong>increase their chances of appearing in search results</strong>.&nbsp;</p>\r\n<h2><strong>The SEO Benefits of Nepali Business Listings</strong>&nbsp;</h2>\r\n<p>Nepali business listings&nbsp;<strong>contribute to better SEO</strong>&nbsp;in several ways:&nbsp;</p>\r\n<h3><strong>✅ 1. Improves Local SEO</strong>&nbsp;</h3>\r\n<p>When you&nbsp;<strong>add your business to directories</strong>, Google&nbsp;<strong>recognises your business location</strong>, improving its local search ranking.&nbsp;</p>\r\n<h3><strong>✅ 2. Builds Credibility with Citations</strong>&nbsp;</h3>\r\n<p>A citation is when your business name, address, and phone number (<strong>NAP</strong>) appear consistently across directories.&nbsp;<strong>Google values consistent citations</strong>, making it more likely to rank you higher.&nbsp;</p>\r\n<h3><strong>✅ 3. Increases Website Traffic</strong>&nbsp;</h3>\r\n<p>Most business listings&nbsp;<strong>allow you to add a website link</strong>. More&nbsp;<strong>backlinks from high-authority directories</strong>&nbsp;like NepState&nbsp;<strong>signal trustworthiness</strong>&nbsp;to Google.&nbsp;</p>\r\n<h3><strong>✅ 4. Helps with Google&rsquo;s E-A-T Algorithm</strong>&nbsp;</h3>\r\n<p>Google prioritises businesses that demonstrate:&nbsp;</p>\r\n<ul>\r\n<li><strong>Expertise</strong>&nbsp;in their field&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Authoritativeness</strong>&nbsp;through positive reviews&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Trustworthiness</strong>&nbsp;via verified listings&nbsp;</li>\r\n</ul>\r\n<p>A well-optimised&nbsp;<strong>Nepali business listing</strong>&nbsp;improves&nbsp;<strong>your E-A-T score</strong>, making Google&nbsp;<strong>more likely to rank you higher</strong>.&nbsp;</p>\r\n<h2><strong>How to Optimise Your Nepali Business Listing</strong>&nbsp;</h2>\r\n<p>Simply&nbsp;<strong>listing your business</strong>&nbsp;is&nbsp;<strong>not enough</strong>&mdash;you must&nbsp;<strong>optimise</strong>&nbsp;it for better results.&nbsp;</p>\r\n<h3><strong>1. Provide Complete &amp; Accurate Information</strong></h3>\r\n<p>Make sure your listing&nbsp;<strong>includes the correct business name, address, and phone number</strong>&nbsp;(NAP).&nbsp;<strong>Inconsistent details</strong>&nbsp;can hurt your rankings.&nbsp;</p>\r\n<h3><strong>2. Add Keywords to Your Business Description</strong></h3>\r\n<p>Use relevant&nbsp;<strong>keywords</strong>&nbsp;like:&nbsp;</p>\r\n<ul>\r\n<li>Best&nbsp;<strong>home cleaning services in Nepal</strong>&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Reliable&nbsp;<strong>IT support in Kathmandu</strong>&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Affordable&nbsp;<strong>restaurant in Pokhara</strong>&nbsp;</li>\r\n</ul>\r\n<p>Google uses these&nbsp;<strong>keywords to rank</strong>&nbsp;your listing for relevant searches.&nbsp;</p>\r\n<h3><strong>3. Upload High-Quality Images</strong></h3>\r\n<ul>\r\n<li>Listings with&nbsp;<strong>high-quality images</strong>&nbsp;get&nbsp;<strong>35% more clicks</strong>&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Showcase your&nbsp;<strong>store, office, or products</strong>&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Ensure images are&nbsp;<strong>well-lit and professional</strong>&nbsp;</li>\r\n</ul>\r\n<h3><strong>4. Encourage Customer Reviews</strong></h3>\r\n<p>Google prioritises businesses with&nbsp;<strong>more positive reviews</strong>. Encourage happy customers to&nbsp;<strong>leave feedback on your listing</strong>.&nbsp;</p>\r\n<h3><strong>5. Keep Your Listing Updated</strong></h3>\r\n<p>If your business changes&nbsp;<strong>locations, phone numbers, or services</strong>, update it&nbsp;<strong>immediately</strong>&nbsp;to avoid inconsistencies.&nbsp;</p>\r\n<h2><strong>Choosing the Right Nepali Business Listing Platforms</strong>&nbsp;</h2>\r\n<p>Not all business directories provide the&nbsp;<strong>same SEO benefits</strong>. Choose platforms that:<br>✔ Have&nbsp;<strong>high domain authority</strong><br>✔ Are&nbsp;<strong>trusted by Google</strong><br>✔ Offer&nbsp;<strong>do-follow backlinks</strong>&nbsp;</p>\r\n<h2><strong>Best Platforms for Nepali Businesses</strong>&nbsp;</h2>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">Platform</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">SEO Benefit</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\"><a href=\"https://nepstate.com/\">NepState</a></td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Strong local SEO boost</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Google My Business</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">High local search visibility</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Yelp Nepal</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Customer interaction &amp; reviews</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Facebook Business</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Social media exposure</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Yellow Pages Nepal</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Traditional &amp; online visibility</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>For&nbsp;<strong>maximum exposure</strong>,&nbsp;<strong>list your business on at least 3-5 platforms</strong>.&nbsp;</p>\r\n<h2><strong>How Customer Reviews Impact Search Rankings</strong>&nbsp;</h2>\r\n<h3><strong>1. Google Prioritises Businesses with Reviews</strong></h3>\r\n<p>Businesses with&nbsp;<strong>positive reviews</strong>&nbsp;rank higher because they appear&nbsp;<strong>more trustworthy</strong>.&nbsp;</p>\r\n<h3><strong>2. More Reviews = Higher Click-Through Rates</strong></h3>\r\n<p>Listings with multiple&nbsp;<strong>5-star reviews</strong>&nbsp;get&nbsp;<strong>more clicks</strong>, which boosts rankings.&nbsp;</p>\r\n<h3><strong>3. Responding to Reviews Increases Engagement</strong></h3>\r\n<p>Always&nbsp;<strong>reply to customer reviews</strong>&mdash;Google sees this as&nbsp;<strong>active engagement</strong>, improving rankings.&nbsp;</p>\r\n<h2><strong>How Social Media and Business Listings Work Together</strong>&nbsp;</h2>\r\n<h3><strong>1. Social Media Boosts Business Listing Visibility</strong></h3>\r\n<p>Platforms like&nbsp;<strong>Facebook, Instagram, and LinkedIn</strong>&nbsp;drive traffic to your business listing by:&nbsp;</p>\r\n<ul>\r\n<li><strong>Sharing your listing link</strong>&nbsp;in posts and stories&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Encouraging customers to leave reviews</strong>&nbsp;on both platforms&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Boosting brand awareness</strong>&nbsp;through social engagement&nbsp;</li>\r\n</ul>\r\n<h3><strong>2. Embedding Listings in Social Media Profiles</strong></h3>\r\n<ul>\r\n<li>Add your&nbsp;<strong>Nepali business listing link</strong>&nbsp;to your social media bio&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Pin posts featuring&nbsp;<strong>your listing details</strong>&nbsp;for easy access&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Use&nbsp;<strong>hashtags</strong>&nbsp;like #NepaliBusiness #LocalSEO to increase discoverability&nbsp;</li>\r\n</ul>\r\n<h3><strong>3. Running Ads to Drive Traffic to Your Business Listing</strong></h3>\r\n<p>Facebook and Instagram ads can&nbsp;<strong>direct potential customers</strong>&nbsp;to your business listing,&nbsp;<strong>boosting visits and engagement</strong>.&nbsp;</p>\r\n<h2><strong>How Mobile Optimisation Impacts Business Listings</strong>&nbsp;</h2>\r\n<h3><strong>1. Why Mobile Optimisation Matters</strong></h3>\r\n<ul>\r\n<li>Over&nbsp;<strong>60% of local searches</strong>&nbsp;are done on&nbsp;<strong>mobile devices</strong>.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Google prioritises&nbsp;<strong>mobile-friendly business listings</strong>&nbsp;in rankings.&nbsp;</li>\r\n</ul>\r\n<h3><strong>2. How to Optimise Your Business Listing for Mobile Users</strong></h3>\r\n<p>Ensure&nbsp;<strong>fast-loading pages</strong>&mdash;listings should load within&nbsp;<strong>3 seconds</strong><br>Use&nbsp;<strong>responsive design</strong>&nbsp;that adapts to all screen sizes<br>Make sure&nbsp;<strong>call-to-action buttons (Call Now, Get Directions)</strong>&nbsp;are easy to tap&nbsp;</p>\r\n<h3><strong>3. The Impact of Mobile SEO on Local Rankings</strong></h3>\r\n<p>Google&rsquo;s&nbsp;<strong>mobile-first indexing</strong>&nbsp;means a&nbsp;<strong>mobile-friendly business listing</strong>&nbsp;will rank&nbsp;<strong>higher</strong>&nbsp;than one that isn&rsquo;t optimised.&nbsp;</p>\r\n<h2><strong>Common Mistakes to Avoid in Business Listings</strong>&nbsp;</h2>\r\n<h3><strong>1. Inconsistent NAP Details</strong></h3>\r\n<ul>\r\n<li>Make sure your&nbsp;<strong>business name, address, and phone number</strong>&nbsp;are the same across all directories.&nbsp;</li>\r\n</ul>\r\n<h3><strong>2. Ignoring Customer Reviews</strong></h3>\r\n<ul>\r\n<li>Negative reviews can harm rankings.&nbsp;<strong>Always respond to reviews and engage with customers</strong>.&nbsp;</li>\r\n</ul>\r\n<h3><strong>3. Not Adding Website Links</strong></h3>\r\n<ul>\r\n<li>A business listing without a&nbsp;<strong>website link</strong>&nbsp;loses potential traffic and SEO benefits.&nbsp;</li>\r\n</ul>\r\n<h3><strong>4. Using Low-Quality Images</strong></h3>\r\n<ul>\r\n<li>Poor visuals&nbsp;<strong>reduce customer trust</strong>. Always use&nbsp;<strong>high-quality images</strong>.&nbsp;</li>\r\n</ul>\r\n<h2><strong>Final Thoughts: Take Your Business to the Next Level</strong>&nbsp;</h2>\r\n<p>Using&nbsp;<strong>Nepali business listings</strong>&nbsp;is a&nbsp;<strong>proven strategy</strong>&nbsp;to improve Google rankings. By listing your business on<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>&nbsp;and other high-authority directories, you can:&nbsp;</p>\r\n<p>✅ Increase&nbsp;<strong>local visibility</strong><br>✅ Boost&nbsp;<strong>search rankings</strong><br>✅ Gain&nbsp;<strong>more website traffic</strong><br>✅ Build&nbsp;<strong>credibility &amp; trust</strong>&nbsp;</p>\r\n<p>Don&rsquo;t wait&mdash;<strong>list your business today</strong>&nbsp;and start seeing the benefits!&nbsp;</p>\r\n<p><strong>Need Help?</strong>&nbsp;</p>\r\n<p>Get started with<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>, Nepal&rsquo;s leading business listing platform!&nbsp;</p>', NULL, NULL, 'https://admin.nepstate.com/images/1742361133_undefined (12).jpeg', '2025-03-19 05:12:13', -1, 1, 0, 0, NULL, 1),
(3, 'The Future of Nepali Business Listings: Trends & Innovations', 'the-future-of-nepali-business-listings-trends-innovations', 'NepState Admin', '<p>In today\'s digital landscape,&nbsp;<strong>Nepali business listings</strong>&nbsp;are evolving rapidly, offering new opportunities for businesses to connect with their audience. Whether you\'re a startup or an established brand, staying ahead of the latest trends is crucial.<a href=\"https://nepstate.com/\">&nbsp;NepState</a>&nbsp;is leading the way in providing innovative solutions for business growth.&nbsp;</p>\r\n<h2><strong>Why Nepali Business Listings Matter More Than Ever</strong>&nbsp;</h2>\r\n<p>Business directories are no longer just digital yellow pages. They serve as a vital tool for local SEO, customer acquisition, and brand credibility.&nbsp;</p>\r\n<h3><strong>Key Benefits of Business Listings</strong>&nbsp;</h3>\r\n<ul>\r\n<li><strong>Increased online visibility</strong>&nbsp;&ndash; Appearing in search results for relevant keywords.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Better local SEO ranking</strong>&nbsp;&ndash; Improving chances of appearing in Google&rsquo;s local pack.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Customer trust &amp; credibility</strong>&nbsp;&ndash; Verified listings create confidence.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li><strong>Higher engagement</strong>&nbsp;&ndash; More traffic leads to more inquiries and sales.&nbsp;</li>\r\n</ul>\r\n<h2><strong>The Impact of Business Listings on Nepali Entrepreneurs</strong>&nbsp;</h2>\r\n<p>Nepali entrepreneurs face unique challenges, including&nbsp;<strong>limited digital visibility</strong>&nbsp;and&nbsp;<strong>high competition</strong>. A well-optimised business listing helps small and medium-sized enterprises (SMEs)&nbsp;<strong>gain credibility, attract customers, and boost sales</strong>.&nbsp;</p>\r\n<h3><strong>Empowering Local Businesses</strong>&nbsp;</h3>\r\n<p>Platforms like<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>&nbsp;provide&nbsp;<strong>a cost-effective way for small businesses</strong>&nbsp;to compete with larger brands. By listing their business online, entrepreneurs can reach a&nbsp;<strong>broader audience</strong>&nbsp;without investing heavily in traditional marketing.&nbsp;</p>\r\n<h3><strong>Bridging the Gap Between Online &amp; Offline Customers</strong>&nbsp;</h3>\r\n<p>Many Nepali businesses still rely on&nbsp;<strong>walk-in customers</strong>, but digital listings help them&nbsp;<strong>connect with online shoppers</strong>. A strong presence in business directories ensures that potential customers&nbsp;<strong>find their store before even stepping outside</strong>.&nbsp;</p>\r\n<h2><strong>Emerging Trends in Nepali Business Listings</strong>&nbsp;</h2>\r\n<p>The business listing industry is undergoing major changes. Let\'s explore the latest trends shaping the future.&nbsp;</p>\r\n<h3><strong>AI-Powered Listings for Smarter Searches</strong>&nbsp;</h3>\r\n<p>Artificial Intelligence (AI) is making business directories smarter. AI-driven search functions help customers find the best businesses based on their needs.&nbsp;</p>\r\n<h3><strong>Voice Search Optimisation</strong>&nbsp;</h3>\r\n<p>With the rise of smart assistants like Google Assistant and Alexa, businesses must optimise their listings for voice search.&nbsp;</p>\r\n<h3><strong>Mobile-First Indexing for Nepali Listings</strong>&nbsp;</h3>\r\n<p>More users search for businesses on mobile devices, making&nbsp;<strong>mobile-friendly listings essential</strong>. Platforms like<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>&nbsp;ensure businesses are easily discoverable on mobile.&nbsp;</p>\r\n<h3><strong>Blockchain for Verified Business Listings</strong>&nbsp;</h3>\r\n<p>Blockchain technology is being used to verify business information, reducing fake listings and enhancing trust.&nbsp;</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">Trend</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold;\">Impact on Nepali Business Listings</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">AI-Powered Listings</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Smarter, more personalised searches</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Voice Search Optimisation</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Easier business discovery via voice</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Mobile-First Indexing</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Higher visibility on mobile devices</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px;\">Blockchain Verification</td>\r\n<td style=\"border: 1px solid black; padding: 8px;\">More trust and fewer fake listings</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h2><strong>Innovations Shaping Nepali Business Listings</strong>&nbsp;</h2>\r\n<p>Businesses in Nepal can expect several innovations in the coming years, transforming how listings work.&nbsp;</p>\r\n<h3><strong>Integration of Augmented Reality (AR)</strong>&nbsp;</h3>\r\n<p>AR technology will allow customers to&nbsp;<strong>virtually explore</strong>&nbsp;businesses before visiting in person.&nbsp;</p>\r\n<h3><strong>Advanced Review &amp; Rating Systems</strong>&nbsp;</h3>\r\n<p>Platforms like<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>&nbsp;are enhancing their&nbsp;<strong>review verification</strong>&nbsp;systems to ensure credibility.&nbsp;</p>\r\n<h3><strong>AI Chatbots for Customer Engagement</strong>&nbsp;</h3>\r\n<p>Automated chatbots are helping businesses interact with customers&nbsp;<strong>directly from their listings</strong>.&nbsp;</p>\r\n<h3><strong>Hyper-Personalisation with Big Data</strong>&nbsp;</h3>\r\n<p>Big Data analytics allow platforms to recommend businesses&nbsp;<strong>based on customer behaviour</strong>.&nbsp;</p>\r\n<h2><strong>How Nepali Businesses Can Leverage These Trends</strong>&nbsp;</h2>\r\n<h3><strong>Optimising Your Listing for Maximum Reach</strong>&nbsp;</h3>\r\n<ul>\r\n<li>Keep business information&nbsp;<strong>accurate &amp; updated</strong>.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Use&nbsp;<strong>high-quality images</strong>&nbsp;to attract customers.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Incorporate&nbsp;<strong>relevant keywords</strong>&nbsp;for SEO.&nbsp;</li>\r\n</ul>\r\n<h3><strong>Leveraging AI &amp; Automation</strong>&nbsp;</h3>\r\n<ul>\r\n<li>Invest in&nbsp;<strong>AI-driven marketing</strong>&nbsp;for better engagement.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Use chatbots to&nbsp;<strong>answer customer queries 24/7</strong>.&nbsp;</li>\r\n</ul>\r\n<h3><strong>Strengthening Online Reputation</strong>&nbsp;</h3>\r\n<ul>\r\n<li>Encourage customers to&nbsp;<strong>leave positive reviews</strong>.&nbsp;</li>\r\n</ul>\r\n<ul>\r\n<li>Respond to&nbsp;<strong>negative feedback professionally</strong>.&nbsp;</li>\r\n</ul>\r\n<table style=\"border: 1px solid black; border-collapse: collapse; width: 100%; height: 67.1668px;\">\r\n<tbody>\r\n<tr style=\"height: 16.7917px;\">\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold; height: 16.7917px;\">Innovation</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold; height: 16.7917px;\">How Businesses Can Benefit</td>\r\n</tr>\r\n<tr style=\"height: 16.7917px;\">\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">Augmented Reality (AR)</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">Virtual business previews</td>\r\n</tr>\r\n<tr style=\"height: 16.7917px;\">\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">AI Chatbots</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">Automated customer support</td>\r\n</tr>\r\n<tr style=\"height: 16.7917px;\">\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">Hyper-Personalisation</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 16.7917px;\">Targeted marketing campaigns</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h2><strong>Common Mistakes to Avoid in Nepali Business Listings</strong>&nbsp;</h2>\r\n<p>A business listing is only effective if it\'s&nbsp;<strong>well-optimised</strong>. Many businesses fail to&nbsp;<strong>take full advantage of these platforms</strong>, which results in&nbsp;<strong>low visibility and missed opportunities</strong>.&nbsp;</p>\r\n<h3><strong>Incomplete or Outdated Information</strong>&nbsp;</h3>\r\n<p>A common mistake is&nbsp;<strong>failing to update business details</strong>. Inconsistent phone numbers, outdated addresses, or incorrect website links can lead to&nbsp;<strong>customer frustration and lost sales</strong>.&nbsp;</p>\r\n<h3><strong>Ignoring Customer Reviews</strong>&nbsp;</h3>\r\n<p>Customer reviews&nbsp;<strong>play a crucial role</strong>&nbsp;in building trust. Businesses that&nbsp;<strong>fail to engage with reviewers</strong>&nbsp;(both positive and negative) may appear unprofessional or indifferent to customer concerns.&nbsp;</p>\r\n<h3><strong>Lack of SEO Optimisation</strong>&nbsp;</h3>\r\n<p>A business listing should&nbsp;<strong>include relevant keywords</strong>&nbsp;so it appears in&nbsp;<strong>search engine results</strong>. Without proper SEO, listings may not&nbsp;<strong>attract the right audience</strong>.&nbsp;</p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold; height: 37px;\">Common Mistake</td>\r\n<td style=\"border: 1px solid black; padding: 8px; font-weight: bold; height: 37px;\">Consequence</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37px;\">Outdated business information</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37px;\">Customers lose trust and look elsewhere</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37.6667px;\">Ignoring customer reviews</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37.6667px;\">Damages reputation and reduces credibility</td>\r\n</tr>\r\n<tr>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37px;\">No SEO optimisation</td>\r\n<td style=\"border: 1px solid black; padding: 8px; height: 37px;\">Listing fails to appear in search results</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<h2><strong>The Role of NepState in Transforming Business Listings</strong>&nbsp;</h2>\r\n<p>As one of Nepal\'s&nbsp;<strong>leading business directories</strong>,<a href=\"https://nepstate.com/\">&nbsp;NepState</a>&nbsp;is at the forefront of these innovations.&nbsp;</p>\r\n<h3><strong>What Sets NepState Apart?</strong>&nbsp;</h3>\r\n<p>✅&nbsp;<strong>User-Friendly Interface</strong>&nbsp;&ndash; Easy to navigate and list businesses.<br>✅&nbsp;<strong>Advanced SEO Tools</strong>&nbsp;&ndash; Helps businesses rank higher in search results.<br>✅&nbsp;<strong>Trustworthy Listings</strong>&nbsp;&ndash; Ensures verified and credible businesses.&nbsp;</p>\r\n<h2><strong>How Nepali Business Listings Influence Local SEO</strong>&nbsp;</h2>\r\n<p>A&nbsp;<strong>well-optimised business listing</strong>&nbsp;significantly impacts&nbsp;<strong>local SEO</strong>, helping businesses appear in&nbsp;<strong>Google searches</strong>&nbsp;when users look for relevant services in their area.&nbsp;</p>\r\n<h3><strong>Google My Business &amp; Local Directories</strong>&nbsp;</h3>\r\n<p>Platforms like<a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>, Google My Business, and other&nbsp;<strong>local directories</strong>&nbsp;ensure that businesses rank&nbsp;<strong>higher in local search results</strong>.&nbsp;</p>\r\n<h3><strong>The Importance of NAP Consistency</strong>&nbsp;</h3>\r\n<p><strong>NAP (Name, Address, Phone Number) consistency</strong>&nbsp;across multiple directories&nbsp;<strong>boosts local SEO rankings</strong>. Search engines prioritise&nbsp;<strong>businesses with accurate and uniform information</strong>.&nbsp;</p>\r\n<h3><strong>Leveraging Customer Engagement for SEO</strong>&nbsp;</h3>\r\n<p>Engaging with customers through&nbsp;<strong>reviews, photos, and social media links</strong>&nbsp;improves search rankings. A business with&nbsp;<strong>high engagement</strong>&nbsp;is more likely to appear in&nbsp;<strong>top search results</strong>.&nbsp;</p>\r\n<h2><strong>Final Thoughts &ndash; Future-Proofing Your Business Listing</strong>&nbsp;</h2>\r\n<p>Nepali business listings are no longer just about&nbsp;<strong>name, address, and phone number</strong>. With advancements in AI, AR, blockchain, and mobile-first technology, businesses need to&nbsp;<strong>adapt to stay competitive</strong>.&nbsp;</p>\r\n<p>By&nbsp;<strong>leveraging the latest trends and using platforms like</strong><a href=\"https://nepstate.com/\">&nbsp;<strong>NepState</strong></a>, businesses can&nbsp;<strong>increase visibility, attract more customers, and grow sustainably</strong>.&nbsp;</p>\r\n<p>Would you like to optimise your business listing today? Get started with&nbsp;<strong>NepState and stay ahead of the competition!</strong></p>', NULL, NULL, 'https://admin.nepstate.com/images/1742363034_undefined (13).jpeg', '2025-03-19 05:43:54', -1, 1, 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `bID` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `commenter_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `bID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `likebg` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `text_lorum` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `text_lorum`) VALUES
(1, 0, 'Event', 'events', NULL, NULL, 1, '2023-08-24 06:38:52', '<p>Explore upcoming events that promise entertainment and enrichment.</p>'),
(2, 0, 'Jobs', 'jobs', NULL, NULL, 1, '2023-08-24 06:38:52', '<p>Discover diverse job listings across industries for your professional growth.</p>'),
(3, 0, 'Services', 'services', NULL, NULL, 1, '2023-08-24 06:39:23', '<p>Explore specialized services dedicated to meeting your unique needs.</p>'),
(4, 0, 'IT Trainings', 'it-trainings', NULL, NULL, 1, '2023-08-24 06:39:23', '<p>Access top-notch training programs to boost your IT expertise.</p>'),
(5, 0, 'Roomates & Rentals', 'roomates-rentals', NULL, NULL, 1, '2023-08-24 06:39:42', '<p>Discover ideal roommates and rental options for a harmonious living experience.</p>'),
(6, 1, 'Online', 'online', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(7, 1, 'Concert/Music', 'concert-music', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(8, 1, 'Cultural', 'cultural', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(9, 1, 'Comedy Show', 'comedy-show', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(10, 1, 'Free Events', 'free-events', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(11, 1, 'Upcoming Events', 'upcoming-events', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(12, 1, 'Charity', 'charity', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(13, 1, 'College Events', 'college-events', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(14, 1, 'Others', 'others', NULL, NULL, 1, '2023-08-24 09:44:17', NULL),
(26, 2, 'IT Jobs', 'it-jobs', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(27, 2, 'Online/Remote Jobs', 'onlineremote-jobs', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(28, 2, 'Part Time', 'part-time', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(29, 2, 'Gas Station/ Convenient Store', 'gas-station-convenient-store', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(30, 2, 'Grocery Store', 'grocery-store', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(31, 2, 'Hotels and Restaurants', 'hotels-and-restaurants', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(32, 2, 'Real Estate ', 'real-estate', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(33, 2, 'Administrative', 'administrative', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(34, 2, 'Sales and Marketing', 'sales-and-marketing', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(35, 2, 'Non-Profit / Volunteering', 'nonprofit--volunteering', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(36, 2, 'Others', 'other', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(37, 3, 'Photography/Videography', 'photography-videography', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(38, 3, 'Wedding and Events', 'wedding-and-events', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(39, 3, 'Lawyer', 'lawyer', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(40, 3, 'Online Services', 'online-services', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(41, 3, 'RealEsate', 'realesate', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(42, 3, 'Beauty MakeUp', 'beauty-makeup', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(43, 3, 'Religious and Community Services', 'religious-and-community-services', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(44, 3, 'Events Décor', 'events-dcor', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(45, 3, 'Repair and Tech Support', 'repair-and-tech-support', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(46, 3, 'Automobile repair / Sell', 'automobile-repair--sell', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(47, 3, 'Health Service', 'health-service', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(48, 3, 'Financial and Tax', 'financial-and-tax', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(49, 3, 'Restaurant/Catering', 'restaurant-catering', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(50, 3, 'Travel and Accomodation', 'travel-and-accomodation', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(51, 3, 'Education and Tutor', 'education-and-tutor', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(52, 3, 'Logistics', 'logistics', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(53, 3, 'Care services', 'care-services', NULL, NULL, 1, '2023-08-24 09:50:24', NULL),
(55, 4, 'Developer', 'developer', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(56, 4, 'QA Tester', 'qa-tester', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(57, 4, 'Business Analyst', 'business-analyst', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(58, 4, 'Security', 'security', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(59, 4, 'Networking', 'networking', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(60, 4, 'Data Analyst', 'data-analyst', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(61, 4, 'DataBase', 'database', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(62, 4, 'Machine Learning', 'machine-learning', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(63, 4, 'Bootcamp', 'bootcamp', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(64, 4, 'Others Trainings', 'others', NULL, NULL, 1, '2023-08-24 09:52:44', NULL),
(65, 5, 'Single room', 'single-room', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(66, 5, 'Shared room', 'shared-room', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(67, 5, 'Paying guest', 'paying-guest', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(68, 5, 'Single family House', 'single-family-house', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(69, 5, 'TownHouse', 'townhouse', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(70, 5, 'Basement', 'basement', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(71, 5, 'Garage', 'garage', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(72, 5, 'Commercial Business Rental', 'commercial-business-rental', NULL, NULL, 1, '2023-08-24 09:54:07', NULL),
(73, 39, 'Immigration', 'immigration', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(74, 39, 'Injury', 'injury', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(75, 39, 'Criminal', 'criminal', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(76, 39, 'Family/Business', 'family-business', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(77, 39, 'Administration', 'administration', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(78, 39, 'Real Estate', 'real-estate-2', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(79, 39, 'Tax law', 'tax-law', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(80, 39, 'Bankruptcy', 'bankruptcy', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(81, 39, 'VISA', 'visa', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(82, 39, 'Civil Rights', 'civil-rights', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(83, 39, 'Consumer law', 'consumer-law', NULL, NULL, 1, '2023-08-24 09:57:04', NULL),
(84, 53, 'Day care', 'day-care', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(85, 53, 'Child Care', 'child-care', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(86, 53, 'Elder Care', 'elder-care', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(87, 53, 'Nanny Services', 'nanny-services', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(88, 53, 'Pet Care', 'pet-care', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(89, 53, 'HouseKeeing', 'housekeeing', NULL, NULL, 1, '2023-08-24 09:58:31', NULL),
(90, 3, 'To / From Nepal', 'to-from-nepal', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(91, 3, 'Others', 'others', NULL, NULL, 1, '2023-08-24 09:47:07', NULL),
(94, 2, 'CodeXperts', 'codexperts', NULL, NULL, 1, '2024-08-08 10:14:22', '<p>CodeXperts</p>');

-- --------------------------------------------------------

--
-- Table structure for table `category_images`
--

CREATE TABLE `category_images` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `v_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cat_images`
--

CREATE TABLE `cat_images` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cat_options`
--

CREATE TABLE `cat_options` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `values` longtext DEFAULT NULL,
  `disabled` int(1) NOT NULL DEFAULT 0,
  `price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `title_ar` text DEFAULT NULL,
  `values_ar` text DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `variation_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `file_title` text DEFAULT NULL,
  `file_type` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('vpd1q26r6j5fsoas2ka147s3af54l9c0', '34.116.22.34', 1742343042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034323b61646d696e5f726f6c65737c4e3b),
('r0r8sgculc9l34cnf639m3qogkofl5lr', '34.116.22.34', 1742343042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034323b61646d696e5f726f6c65737c4e3b),
('t3tdqvup6f90td87pkse92p5779s368l', '34.116.22.34', 1742343042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034323b61646d696e5f726f6c65737c4e3b),
('sk2q501nff540jhq6gbq52iqlcelv5r7', '34.116.22.32', 1742343043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034333b61646d696e5f726f6c65737c4e3b),
('gg73p1tcl8rji41q9f74rou9av92s1lm', '34.116.22.33', 1742343043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034333b61646d696e5f726f6c65737c4e3b),
('m8a3nfnt32cll0n5k94tc6lfgkqh8hou', '34.116.22.33', 1742343043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334333034333b61646d696e5f726f6c65737c4e3b),
('sdloc4acllnoiaec8iqh1988itdj0id0', '34.116.22.34', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('bb1bvtqq52u4f7qevr0dmjiisbp0fv6v', '34.116.22.33', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('mi5g5def0vulo119t3h5doo6sqj860ts', '34.116.22.32', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('km2ebsd9lie2fhf9l15tof89f0v7h57r', '34.116.22.34', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('lou9f0li5pass3daiim5donv2m9assk0', '34.116.22.34', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('oijcjpm5hbj5oru1ak586vv9o5s9ob6a', '34.116.22.33', 1742344173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334343137333b61646d696e5f726f6c65737c4e3b),
('9q2rshmjt517t6bms9f12vc6lhe5mipm', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('5o94a89dv0bl3gbjidrk8k82tfag1vde', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('3gea78olgtsrek4gcmk65a9b11meag46', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('6h47dckamhsfoski3rt6j2k9jpee3mio', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('sklneaq3am2ruuvp78m9bua6ornnd00d', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('3gcl2plva5vk2j7v5842h4an4v3tug4t', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('c0tpjj8q4hftbropo2kg8l5345pplsrs', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('ciih8ipgikjqc00op85ejugdket7r6p7', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('r2vn26p5sv6dl4c2ovtih40j472ff66o', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('peih4ul66bsnirod2cm6rl5jh5d4iptq', '2a02:4780:2c:3::5', 1742345170, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353137303b61646d696e5f726f6c65737c4e3b),
('q422mrofnddi20gom16j0lksfji11t0m', '196.251.81.58', 1742345360, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353334343b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a353a22416c696365223b733a383a22757365726e616d65223b733a363a224d794e616d65223b733a353a22656d61696c223b733a32343a227265796e6f6c6473406e6f62696c69732d7573612e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('mrdirusrg5133vdaa5nt77cfp2sdlefb', '107.178.193.32', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('m7p5vgbv1m6166utb1dll4lsubg2b9en', '107.178.193.32', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('9eckg1343bc4d5t60vu9mo5qsalkr48e', '107.178.193.38', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('6l593lbthkm1vt6ombqooqeo8sp3buan', '107.178.193.32', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('ulfqmiqmv6ifq440q7n5c1bietdltt5p', '107.178.193.38', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('toqepn29jckrdgp5tjs5lb2st2kmvio7', '107.178.193.38', 1742345723, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334353732333b61646d696e5f726f6c65737c4e3b),
('3gpdmq3uhadr76i58rdlcoo3dd3moa9n', '196.251.81.58', 1742346269, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334363236323b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a383a225465737455736572223b733a383a22757365726e616d65223b733a383a225465737455736572223b733a353a22656d61696c223b733a31383a22796f726c656e6962407961686f6f2e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('oa5lurkttbtjo078k6ooqunoq7k4gb8t', '165.227.239.53', 1742346328, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334363332383b61646d696e5f726f6c65737c4e3b),
('jqaoh1c5ths4f94s6a9b2b1l56174tsc', '2a0c:b641:3a1:1005::10c', 1742347132, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334373132353b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a353a2248656c6c6f223b733a383a22757365726e616d65223b733a353a22416c696365223b733a353a22656d61696c223b733a32333a22726f6472696775657a7237303540676d61696c2e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('2jkb19d3spr7j1phtbk9j56abloocfm8', '34.98.143.162', 1742348766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736363b61646d696e5f726f6c65737c4e3b),
('tf51p3p368nbn6tg8ene4690qda662gq', '34.98.143.164', 1742348766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736363b61646d696e5f726f6c65737c4e3b),
('q23c5d9sn2sc8l6v1qqh5o2gectm294r', '34.98.143.164', 1742348766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736363b61646d696e5f726f6c65737c4e3b),
('4blhpuhco96ammart83rl6e3v809arcg', '34.98.143.163', 1742348767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736373b61646d696e5f726f6c65737c4e3b),
('56und77ng2qvaugs08p22gfofjff3jji', '34.98.143.163', 1742348767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736373b61646d696e5f726f6c65737c4e3b),
('ep7bliiklt472idgtg6piqg48opoaj00', '34.98.143.163', 1742348767, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383736373b61646d696e5f726f6c65737c4e3b),
('5u85h0o70qpmra83k82p5hvik0cfivha', '34.55.216.123', 1742348960, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936303b61646d696e5f726f6c65737c4e3b),
('qj2qu7hpucch0bhq9ktn1hqntuk8e82l', '34.55.216.123', 1742348962, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936323b61646d696e5f726f6c65737c4e3b),
('qaug9l9n0pd05j3u8guhst9muj6fhhdf', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('4jmfq9t7le0bh2fq6ljer2g8mgs7i56a', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('oer40gg13s19uh0coa2ek4ptt7ln1lmj', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('5jofve6lf73co2nib9dfka4runj5mu5k', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('tpb5etao6iqs0bkc6fre8gml9vmmhsbf', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('j8rrjmmlv5pfijs1mdv3bgvjm2vce7ed', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('irajiuug8cgcm0c7eafrt5f6bph9udup', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('7cblkpva3gl1q9tpf93brkisio9nd8el', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('v1gfosc9lp7j37v5avttpvop8vl1o9je', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('uac5pulligtqm6coic2t34uvj00s3qg5', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('ebi9ibait3u2nmv882undnigokk0ir6l', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('vsd63996j4d8o1gfkg0ec0gc8b74ik2d', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('otovlfs6f1r44tbst500u5tbiegjfb04', '34.55.216.123', 1742348963, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936333b61646d696e5f726f6c65737c4e3b),
('9nqolq7obon1d9b9gkg2etapas0vntu9', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('ctsicfg715f0ceb6bro9mirra9a86b3g', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('i92i251gusuv7pjggmbdgkln7tadehm5', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('kgkibp8qrs2hjbf6rag857o0ores234e', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('chg4u29bjj6q4pbqj6r65rqoanci9tqs', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('ahfgelnmirr3fl4f82q9f4k02bkgn440', '34.55.216.123', 1742348964, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323334383936343b61646d696e5f726f6c65737c4e3b),
('ujegqcu9m0kkqb4e6kmekm8jktuukn5n', '34.116.22.33', 1742355299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353239393b61646d696e5f726f6c65737c4e3b),
('du710c1tg7vqvilbm38cad3m5fhhk4dc', '34.116.22.33', 1742355299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353239393b61646d696e5f726f6c65737c4e3b),
('5866luaaq33cg1nh8pgn2fo2vp9k6cnr', '34.116.22.32', 1742355299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353239393b61646d696e5f726f6c65737c4e3b),
('hcs9but14c9afh89h2gqp5e2ouf36mgf', '34.116.22.32', 1742355299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353239393b61646d696e5f726f6c65737c4e3b),
('sbusbrjdfligq14vfaih5t1g0ldi24hp', '34.116.22.34', 1742355301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353330313b61646d696e5f726f6c65737c4e3b),
('im1qdntuoepj5a56rblde856rv05h231', '34.116.22.32', 1742355301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335353330313b61646d696e5f726f6c65737c4e3b),
('tm5456ra56lfm9d6kvnb3b6jp888c3p0', '34.116.22.34', 1742356014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031343b61646d696e5f726f6c65737c4e3b),
('9m8o1gj62v1f7gmocg6dvho6c5hehnr9', '34.116.22.34', 1742356014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031343b61646d696e5f726f6c65737c4e3b),
('ro5c6altj798rscqi627ug2dpjiepma2', '34.116.22.33', 1742356015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031353b61646d696e5f726f6c65737c4e3b),
('18eghikeg9qb8s03fbhdfafdognj5hul', '34.116.22.32', 1742356015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031353b61646d696e5f726f6c65737c4e3b),
('i98qat85l0rcc4oa7l5gsfk0sbvoaq16', '34.116.22.33', 1742356015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031353b61646d696e5f726f6c65737c4e3b),
('92s5ntnqish5dlsi7jfnme9mca0qq8uc', '34.116.22.32', 1742356015, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363031353b61646d696e5f726f6c65737c4e3b),
('eer1bclt1ljks1kta8ikihj3uv65vmg0', '64.225.52.102', 1742356339, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363333343b61646d696e5f726f6c65737c4e3b),
('1ccbpe9fvph046fa6ehnb5dnbt94lu3e', '34.98.143.164', 1742356428, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432383b61646d696e5f726f6c65737c4e3b),
('il5a9shgfbsafl07phep3ti1kfr4l0kr', '34.98.143.163', 1742356428, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432383b61646d696e5f726f6c65737c4e3b),
('dfq1t9gb4f2vqcnm4k0tprnph8gri22b', '34.98.143.162', 1742356429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432393b61646d696e5f726f6c65737c4e3b),
('lupnhq17gfrj2njt3dtqu084il855s6s', '34.98.143.162', 1742356429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432393b61646d696e5f726f6c65737c4e3b),
('7sb75jbs3034mt8gg3vs4tg5tnucm965', '34.98.143.163', 1742356429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432393b61646d696e5f726f6c65737c4e3b),
('2a5r6uflng7456be9b6q68s107jajkic', '34.98.143.162', 1742356429, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363432393b61646d696e5f726f6c65737c4e3b),
('d1bt0komp9idleasqdr2dl5maoepds82', '88.210.10.79', 1742356596, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335363535383b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('k9pb3pj80ua91ktfhotuug0mvu1ejsfq', '69.255.243.16', 1742357458, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373435363b61646d696e5f726f6c65737c4e3b),
('55gaps59s0n767a7t3bgj7oiddfu587b', '2a03:2880:24ff:72::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('ehfnp4na0lj8bg3o8us17isjc75jdejo', '2a03:2880:24ff:4d::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('beavn85uvka4soun2pqtr40ta7ob5nnn', '2a03:2880:24ff:71::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('3gi93b5qng2bqu8ah1gfta66k8vmcgp8', '2a03:2880:24ff:74::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('ic1bfscrb3gqq5kbr1e2fsr33462ttdg', '2a03:2880:24ff::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('ackfq3jakovtvjrbqm8so6rrqc9cltel', '2a03:2880:24ff:48::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('fv2q1nkvb058b8dib0e5u870o4og80ta', '2a03:2880:24ff:42::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('5vqr3s5ljrcg71hklc0ogttjvv2gkts3', '2a03:2880:24ff:74::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('l6bme5udq4jc5vnl4799j6krrhf1fu6v', '2a03:2880:24ff:72::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('kc1mcm1kceghmsf56e9r5dd5m72i3p8p', '2a03:2880:24ff:70::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('e0t9auoqn0s4e20jpnp1rh9jq643ddcf', '2a03:2880:24ff::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('qm7n0eq40j254e6njtkb8d788mumaf4m', '2a03:2880:24ff:4a::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('ejvtph7h49hhaij449mj8onp20lcn0ih', '2a03:2880:24ff:9::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('ne98l0bdi7cqrpoigdvrq59599efr2f0', '2a03:2880:24ff:6::', 1742357763, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736333b61646d696e5f726f6c65737c4e3b),
('j0aaq2r6ejauou7ac6pluknvg5eiktnk', '2a03:2880:24ff:5::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('dauitv7ej12ivac92t1mveq4hb4i327u', '2a03:2880:24ff:44::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('roh5et98n0rcfpnn9nc004u3ae5p756o', '2a03:2880:24ff:44::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('ms3qejgitjcv2pmvokm65d6pm6tshc9g', '2a03:2880:24ff:7::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('ur42ku8818ld9rhqk2tpuir931vh8nbu', '2a03:2880:24ff:4c::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('sj36ihldt65cnnnqf99qnfp5lmth6nhl', '2a03:2880:24ff:1::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('ohinji1tl9q3t59o4p919pfasbqq63qg', '2a03:2880:24ff:2::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('vqmp3jc3bb444opp7h3idmje4cgjq45r', '2a03:2880:24ff:2::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('0g23jf4qmcfc700iv1slfvja55icssp2', '2a03:2880:24ff:1::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('pn0cjskh6hjo3r7ecqnromo2hujn602b', '2a03:2880:24ff:9::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('qel1d9bin5guouphdpdjrf4kmln909qv', '2a03:2880:24ff:1::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('2fsanbuf8ebcguiqqgse8h4651n666vi', '2a03:2880:24ff:70::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('j2uug76krq60epu2djhmf37j0n13g0ds', '2a03:2880:24ff:4c::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('gcbbomo4rcpd4n7t3qp41u97tug69nmc', '2a03:2880:24ff:5::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('um1f9dmvbfbhdiq21csosj0j53qg8hsv', '2a03:2880:24ff:4a::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('b4uhk4o8aea94e7k9m7t5pm72gigl9g8', '2a03:2880:24ff:70::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('bggdl1l28agsdjteddfcvg0o18iv2dfk', '2a03:2880:24ff:4d::', 1742357764, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736343b61646d696e5f726f6c65737c4e3b),
('lakroh79ai2bnovhdkgbsi130n74tglh', '2a03:2880:24ff:73::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('o8eanj6dmac9ole6cg98f78tf5dvbjn5', '2a03:2880:24ff:44::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('33cv164tb87jikdoceqaiictp23820o1', '2a03:2880:24ff:4a::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('oqep1sv5fleet814c9ud1afkl63kl6ju', '2a03:2880:24ff:4a::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('7t6ksgaqdkde1bra1slnag7tr1nokhjv', '2a03:2880:24ff:73::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('9scdcp1c3l9kcaebutqh4474ni00g06l', '2a03:2880:24ff:2::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('ttlugnnn5rj3trr6r1q8qecp7cqjmkt4', '2a03:2880:24ff:71::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('dmene4iovgp7tjoppcgrqg6oksgs0736', '2a03:2880:24ff:2::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('iuc6mv63rkf5ouda93qisvau0dh6tg99', '2a03:2880:24ff:74::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('j888ij220o9i13abolkno34tv82hjecp', '2a03:2880:24ff:1::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('9ht9tsrhts2fp62h3unr9ukobp4gq4tq', '2a03:2880:24ff:72::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('tn8954vmek82fmhlllb4h3rmqab83ffj', '2a03:2880:24ff:3::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('us9iddp56f9oqeur0v03o3ctol3civ97', '2a03:2880:24ff:44::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('d0nu1v5g56vd1dnhr224rtdh7m8gvbt2', '2a03:2880:24ff:9::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('19llenp24f3p5au3217bj9ntragudi2j', '2a03:2880:24ff:4::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('7gmvmghsovsnk1a5q4bj0pn64q42p1f1', '2a03:2880:24ff:71::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('6sibdp908r6l21t0iqvsefel5f1kr1tb', '2a03:2880:24ff:74::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('jr9dgpgui4qft11bc9mi0272874dl7j6', '2a03:2880:24ff:49::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('e30cbqf0v7aicdgro0ujvn7gcevebu65', '2a03:2880:24ff:6::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('voksvf6eqvk1t06fatd7r8mutpeh88g5', '2a03:2880:24ff::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('vvlgqroi88quga5b24t4piq4ksm5e3oi', '2a03:2880:24ff:2::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('cqjaglkb3bhg4j7hpq1igguvmh4shc4s', '2a03:2880:24ff:74::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('rcu7up1bkdrv41s25g9aros2aaabc1cq', '2a03:2880:24ff:1::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('jsf6gghgir9tcrtcimdotlfpjcem1lns', '2a03:2880:24ff:1::', 1742357765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736353b61646d696e5f726f6c65737c4e3b),
('287eap3tc2efrdnvope3dp3ohqb8qg3a', '2a03:2880:24ff:73::', 1742357766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736363b61646d696e5f726f6c65737c4e3b),
('56mis0nn687dv8nmk4ufm3nsakid56lf', '2a03:2880:24ff:73::', 1742357766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736363b61646d696e5f726f6c65737c4e3b),
('u7dqn20s29gqeapqa87dpfvqr42kqdbo', '2a03:2880:24ff:4::', 1742357766, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373736363b61646d696e5f726f6c65737c4e3b),
('jc66tiesf7tvnm8qmkqen2m37athbsh3', '34.116.22.33', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('5i7s57jof26b2tn89kmrn8lsldpakgfu', '34.116.22.32', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('rkqpfruiu12lb1q6oeq2h696o0o9evt9', '34.116.22.34', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('6r98saiv7cdrnvg5qn29mtt94u68975n', '34.116.22.34', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('mifjkamhodebj5d488261c7s7hakid1d', '34.116.22.34', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('2v1mt81jrsia8a0a8jrmp8j49f8fgub2', '34.116.22.33', 1742357816, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373831363b61646d696e5f726f6c65737c4e3b),
('4q6q3tiu66l9srus10gojaamquafead5', '43.133.220.37', 1742357827, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373832373b61646d696e5f726f6c65737c4e3b),
('0rb85l5sj4ui0jii7jcafjb0gp72930b', '43.133.220.37', 1742357828, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373832383b61646d696e5f726f6c65737c4e3b),
('giusbeju9pvteghv8btdrn0t01vtcbal', '43.133.220.37', 1742357831, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833313b61646d696e5f726f6c65737c4e3b),
('dkbuilffifji85rhpakhnb3otjhjm6a3', '43.133.220.37', 1742357832, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833323b61646d696e5f726f6c65737c4e3b),
('fu6omho0lel2em2i1fv6h05ro59kuso8', '43.133.220.37', 1742357834, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833343b61646d696e5f726f6c65737c4e3b),
('sl6pkuq1b9alclcjrqoou7q8rh0g8gno', '43.133.220.37', 1742357835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833353b61646d696e5f726f6c65737c4e3b),
('3g4t09uft7akb4emis00nd0s7jtqlp8f', '43.133.220.37', 1742357837, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833373b61646d696e5f726f6c65737c4e3b),
('h9ntqmdtghmef7p8leksn4qubslc8cht', '43.133.220.37', 1742357839, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373833393b61646d696e5f726f6c65737c4e3b),
('n71pfh9qc83b3bv1gm1vrsqujd7md35i', '43.133.220.37', 1742357840, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335373834303b61646d696e5f726f6c65737c4e3b),
('tgbq42t5q0jbrck0e58okppvr39or26h', '107.178.192.34', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('ivs3goe1vmutqldkmtqseq9np7t4gsot', '107.178.192.36', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('2fme5eslamg0l4gd3taqael9s75n0pi1', '107.178.192.35', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('3o9b59gckk46ahct5m6kckha6kp3nt2p', '107.178.192.34', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('jesqds8kqmpa3jn5lbkjrq4oq24tffta', '107.178.192.36', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('1vs3tmo23p9h8dlnp721bov5htlk676p', '107.178.192.34', 1742358689, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335383638393b61646d696e5f726f6c65737c4e3b),
('p9kkm0imscopepre94vseqtsm6f43ic7', '34.116.22.34', 1742359616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631363b61646d696e5f726f6c65737c4e3b),
('ko4trofftmp9p04vdml4q2733d5rsgd4', '34.116.22.33', 1742359616, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631363b61646d696e5f726f6c65737c4e3b),
('13t3h5478mjrorfog8hrkcd5oi2b5l2s', '34.116.22.32', 1742359617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631373b61646d696e5f726f6c65737c4e3b),
('ujftjgjln3u8rruuv8go06lnl65qlf95', '34.116.22.34', 1742359617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631373b61646d696e5f726f6c65737c4e3b),
('bfp721g81tvhql2ivvhi53dfhj4jjdbb', '34.116.22.32', 1742359617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631373b61646d696e5f726f6c65737c4e3b),
('h11o0nfce7nblmdog31g948gcugrth6m', '34.116.22.32', 1742359617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393631373b61646d696e5f726f6c65737c4e3b),
('8fs2nb3g76qdbc9dpn5djru1rqulojed', '196.251.81.49', 1742359690, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323335393638353b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a363a224d794e616d65223b733a383a22757365726e616d65223b733a353a2248656c6c6f223b733a353a22656d61696c223b733a32303a2264666f7264303131353240676d61696c2e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('610391lcoh7ovbd3p9qvvagh8ope0hgv', '2401:4900:1f32:3954:76de:e62:b87c:3218', 1742360093, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336303039323b61646d696e5f726f6c65737c4e3b52455455524e7c733a31353a226e65772f706f73742f6576656e7473223b),
('sq2ug12i4q8q6qfb225o7fe17nj9clds', '34.116.22.32', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('qh0387h7f3ojv28bd9eiugq58ovc22u5', '34.116.22.33', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('dqubn6k64pl4dre1rvjrrjip14rsd209', '34.116.22.33', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('g6c45efi3j8e9bqpfp151imkjls3ubtv', '34.116.22.34', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('pa9q5osu27c4e6pm38bp1ajjv2uqnnai', '34.116.22.34', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('ca4atc675abmm6gail48om9kmpfnklls', '34.116.22.33', 1742361419, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313431393b61646d696e5f726f6c65737c4e3b),
('lrbatmsa9lfe2dqa3nga78lrpdg1e5am', '122.173.26.223', 1742361825, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313832353b61646d696e5f726f6c65737c4e3b),
('dp1sqm0fufsoi8m0b3efp5g347cjsj4q', '66.249.70.2', 1742361749, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313734393b61646d696e5f726f6c65737c4e3b),
('1rmsa86r7u55kcbu4ofr1mr3mevbk639', '66.249.70.2', 1742361750, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735303b61646d696e5f726f6c65737c4e3b),
('0d0s7f9te8t2vem9icf70598ukvvtcru', '66.249.70.2', 1742361750, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735303b61646d696e5f726f6c65737c4e3b),
('1v9vasm4n4fas4pabsuhb7e095me16ge', '66.249.70.2', 1742361751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735313b61646d696e5f726f6c65737c4e3b),
('3pfgpmg4gi6e7oae8fn6v7f2k7cnedb1', '66.249.70.2', 1742361751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735313b61646d696e5f726f6c65737c4e3b),
('5eopd76f4s6qoap906plbmk5tou6e96b', '66.249.70.8', 1742361752, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735323b61646d696e5f726f6c65737c4e3b),
('daehcrut79a1b5snhebrhgsuak0mjjnd', '66.249.70.8', 1742361752, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735323b61646d696e5f726f6c65737c4e3b),
('9nnikfcdnocd4e5hrqec51vlstfohrhs', '66.249.70.1', 1742361753, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313735333b61646d696e5f726f6c65737c4e3b),
('89vjlopkl9epinpl0hpa1cqhbievdu69', '122.173.26.223', 1742361835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313832353b61646d696e5f726f6c65737c4e3b),
('ragld2nuhemig4h60r2lr92o67ej2bhd', '2401:4900:1f32:3954:76de:e62:b87c:3218', 1742361943, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336313934313b61646d696e5f726f6c65737c4e3b),
('qofij2oc0aebmpvq80v57qvjr3aed0l8', '2401:4900:1f33:d5d:ac15:2c21:a6ed:6f84', 1742363074, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333037343b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('j8725as9uhtc00j3kpjj4e80qql85bq4', '66.249.89.39', 1742362295, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323239323b61646d696e5f726f6c65737c4e3b),
('6447tbgpu8gdk35tsgo8to6nosgeogf4', '107.178.192.36', 1742362573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537333b61646d696e5f726f6c65737c4e3b),
('8trcnk4f0pfujvcom1621351r2a4t0r4', '107.178.192.36', 1742362573, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537333b61646d696e5f726f6c65737c4e3b),
('bml4i5rlecke027anqmqlhckfcsesdrc', '107.178.192.34', 1742362574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537343b61646d696e5f726f6c65737c4e3b),
('45j5g97697gb2fvn0cac60lcediblkc7', '107.178.192.35', 1742362574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537343b61646d696e5f726f6c65737c4e3b),
('pjd9e3s3d7h8t6nr3pff7cnlqgsmtspt', '107.178.192.35', 1742362574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537343b61646d696e5f726f6c65737c4e3b),
('4ehvapc7rccmebna8nav5msc52s7qgv4', '107.178.192.35', 1742362574, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323537343b61646d696e5f726f6c65737c4e3b),
('4f6mubr1ldjj340f1ls8aefbs7fbea4q', '196.251.81.58', 1742362807, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336323739363b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a343a224a6f686e223b733a383a22757365726e616d65223b733a363a224d794e616d65223b733a353a22656d61696c223b733a31383a226a69616e6f72613140676d61696c2e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('pomrdd8ket2855ti78oo6r0pg81fiosq', '2401:4900:1f33:d5d:ac15:2c21:a6ed:6f84', 1742363167, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333037343b61646d696e5f726f6c65737c4e3b52455455524e7c733a37303a22626c6f672f64657461696c732f7468652d6675747572652d6f662d6e6570616c692d627573696e6573732d6c697374696e67732d7472656e64732d696e6e6f766174696f6e73223b),
('crg2nuitr3v6jq1v9ou59108mcres8u8', '107.178.203.39', 1742363216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231363b61646d696e5f726f6c65737c4e3b),
('vha910ikb0032405ueiji1koaq9snu0m', '107.178.203.38', 1742363217, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231373b61646d696e5f726f6c65737c4e3b),
('4shtkt18nmulp79l4imbvn7ul25f3n2d', '107.178.203.39', 1742363217, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231373b61646d696e5f726f6c65737c4e3b),
('d9567rju9elpoqn0sno8ldase8b42lhj', '107.178.203.39', 1742363218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231383b61646d696e5f726f6c65737c4e3b),
('tjnmi8ubg84gpjcq9lqaffvjrg9kq7hf', '107.178.203.32', 1742363218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231383b61646d696e5f726f6c65737c4e3b),
('bh3am942kilmnb637kl1cvefhg4kkbcd', '107.178.203.38', 1742363218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336333231383b61646d696e5f726f6c65737c4e3b),
('uiajn4gosf4qvcl7e6v83tmmjln1fo45', '2401:4900:1f32:3954:76de:e62:b87c:3218', 1742364297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343239373b61646d696e5f726f6c65737c4e3b),
('mupi0qu07hdl611cqu5svkutvkoloc94', '107.178.203.39', 1742364649, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343634393b61646d696e5f726f6c65737c4e3b),
('vqb2mftlmlhlopiocfoejoru0ikig6dg', '107.178.203.38', 1742364649, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343634393b61646d696e5f726f6c65737c4e3b),
('0fbbl0koria5mn7ec0g1hjs7pifavh0l', '107.178.203.32', 1742364650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343635303b61646d696e5f726f6c65737c4e3b),
('3u75fhil4fearj971amkth94kchonphs', '107.178.203.38', 1742364650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343635303b61646d696e5f726f6c65737c4e3b),
('dups68p06gt5ppio1qcu5f4rc704mkaq', '107.178.203.32', 1742364650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343635303b61646d696e5f726f6c65737c4e3b),
('5kremdqqtrpuf0uqm9a09er0pl18npk3', '107.178.203.32', 1742364650, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336343635303b61646d696e5f726f6c65737c4e3b),
('9atk3em87agk146kvhsatom3ddchkndd', '199.244.88.223', 1742365301, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336353239373b61646d696e5f726f6c65737c4e3b),
('317la489q55iggasjju51se2ii4ht0fj', '80.85.245.187', 1742366200, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363135393b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('jac1ghesuv57u41o95qm17onlvee1ij5', '107.178.224.68', 1742366476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437363b61646d696e5f726f6c65737c4e3b),
('l0h4plh18t995j4fvbhh9h7g88o1n9pq', '107.178.224.68', 1742366476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437363b61646d696e5f726f6c65737c4e3b),
('aub65qi1a2dst62vhl0sgivgltmgv6sv', '107.178.224.66', 1742366476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437363b61646d696e5f726f6c65737c4e3b),
('u6lldhtqsdch5n0u5sv7vqdp9hgsvl01', '107.178.224.68', 1742366476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437363b61646d696e5f726f6c65737c4e3b),
('6p5e36mkh7npd5mfd7v163l4gc54rh5n', '107.178.224.67', 1742366476, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437363b61646d696e5f726f6c65737c4e3b),
('iiroegun1jk8059n47ug31pi5e2udm14', '107.178.224.66', 1742366477, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363437373b61646d696e5f726f6c65737c4e3b),
('0f0cilam29cfl8ot8ma6hlm7m4bqie68', '66.249.70.172', 1742366709, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363730393b61646d696e5f726f6c65737c4e3b),
('9r1nl2aifcdunvj0uhvk3goprsq8nupk', '66.249.70.1', 1742366713, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336363730393b61646d696e5f726f6c65737c4e3b),
('luro0h4h989bjm7br88933p4pe8p42kf', '122.173.30.168', 1742367371, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336373337313b61646d696e5f726f6c65737c4e3b52455455524e7c733a31353a226e65772f706f73742f6576656e7473223b),
('h5fe3mui3db6kfc7472s57chuo4ia0au', '2001:4860:7:505::f7', 1742367043, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336373034333b61646d696e5f726f6c65737c4e3b),
('e49o1cfrktiulq27c56pf337c6qomufs', '2001:4860:7:505::fc', 1742367045, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336373034353b61646d696e5f726f6c65737c4e3b),
('0neegnajsorfemqj4esg43s1t43tt5gv', '122.173.30.168', 1742367373, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336373337313b61646d696e5f726f6c65737c4e3b52455455524e7c733a31353a226e65772f706f73742f6576656e7473223b),
('soao4fvf5m03te0c6mr4j2fs6n210t19', '80.85.245.187', 1742368003, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336373936373b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b696e76616c69647c733a33393a22456d61696c2041646472657373206e6f7420666f756e6420696e206f7572207265636f72647321223b),
('9gfjip9ohojmbmhb17siqhgvlmhav42v', '35.187.133.140', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('4vdmphemddqjbr2r1v3eh281lfov67sf', '35.187.133.140', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('k67hph2iqek14nagh6vqnlmniuf5kh5i', '35.187.133.140', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('btgg3kea618q2r2urcc7bb4s4mh9onnh', '35.187.133.128', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('a4a9ndm8ukq4a20bmtugaca8mksbmu4i', '35.187.133.128', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('c38487k2dke9lqfle564nqpsn85784iv', '35.187.133.140', 1742368619, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336383631393b61646d696e5f726f6c65737c4e3b),
('b3hqgt3l6a5i7ltkl3nmuhf46npn8k23', '66.249.70.8', 1742369202, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393139343b61646d696e5f726f6c65737c4e3b),
('6g5i66u5ddcuf6sctqcga5onth6gpujf', '107.178.193.32', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('d71s93sme4315eu19ocetiqgr1gb48pb', '107.178.193.38', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('9n3p2tda58cgrsjkahuseervj65uho9p', '107.178.193.39', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('5hb44j714es7j45u6ff564fvmia6s91h', '107.178.193.32', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('vmtnv7lna12uto9un2o00g32u3i64k2f', '107.178.193.38', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('hfbb5dq9rsmuf9luebevh38ue29fnmmd', '107.178.193.38', 1742369586, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393538363b61646d696e5f726f6c65737c4e3b),
('bac8motjc1g52q6mbm1kjbvn1eb92ht4', '2a0c:b641:3a1:1005::10c', 1742369603, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323336393539363b61646d696e5f726f6c65737c4e3b73686f775f706f7075705f6c6f67696e7c693a313b5349474e5550464f524d7c613a343a7b733a353a22666e616d65223b733a343a224a6f686e223b733a383a22757365726e616d65223b733a353a22416c696365223b733a353a22656d61696c223b733a31383a226a69616e6f72613140676d61696c2e636f6d223b733a383a2270617373776f7264223b733a393a226e536a653833687569223b7d73686f775f706f7075705f7369676e75707c693a313b),
('2smo4i5fkq3bpmdfapscfbvajj8hdbr8', '34.116.22.33', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('7a17k33hpng8l4fk9opko0bl6svksh79', '34.116.22.34', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('t06odmfqdsmpdmp72oudicp7rn6805ss', '34.116.22.33', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('ovnm51odm718n45q98b4jgknmltid1p2', '34.116.22.34', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('0qtqjb8jgdh9u9h7504ljnkhjjeu2k6q', '34.116.22.33', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('pt77ud9ugv58132tocg9pd16ncf0n8e9', '34.116.22.34', 1742370413, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337303431333b61646d696e5f726f6c65737c4e3b),
('hfrk24g8k6hv75goi9cp2dr1f9t3pkh6', '80.85.246.214', 1742371496, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337313434373b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('li8u6oq22uk2vul6a2l7m4du0ert5gae', '80.85.245.187', 1742371547, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337313530373b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('ahdvo5e1qaabplvaqs2gbkqddgp3asq9', '66.249.70.2', 1742372131, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323132353b61646d696e5f726f6c65737c4e3b),
('56738ke692nm29hdf7gk8kmog02clhqa', '107.178.224.67', 1742372218, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231383b61646d696e5f726f6c65737c4e3b),
('dj97rbdq1nlsoao4485pk4dhck6sust6', '107.178.224.67', 1742372219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231393b61646d696e5f726f6c65737c4e3b),
('5rdi0d3p85alff2bfbsjh6g06uadrngg', '107.178.224.67', 1742372219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231393b61646d696e5f726f6c65737c4e3b),
('ptgknsa87j4gdfp5g4mse2umk38r9rnd', '107.178.224.68', 1742372219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231393b61646d696e5f726f6c65737c4e3b),
('tbgr1l60rd0hjqpgq3mso5d9kggpc35c', '107.178.224.66', 1742372219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231393b61646d696e5f726f6c65737c4e3b),
('2a9tvo0qs7n0oqur2727cb5bcp93nr12', '107.178.224.66', 1742372219, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323231393b61646d696e5f726f6c65737c4e3b),
('n3sfkse2cvjqjcio6upbo03vrhgkv5u0', '15.204.73.228', 1742372384, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323338333b61646d696e5f726f6c65737c4e3b),
('krq0afnnvddgavn1ck0hpa2qepjfgivg', '2001:4860:7:505::fa', 1742372398, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323339383b61646d696e5f726f6c65737c4e3b),
('m5v1r7110vumr18kb1perli96vck957u', '2001:4860:7:405::99', 1742372399, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323339393b61646d696e5f726f6c65737c4e3b),
('jgsbdbs07a83nm5qmqgqgjprs90dag7h', '15.204.73.228', 1742372879, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323837393b61646d696e5f726f6c65737c4e3b),
('bps8v92gh4f0k1v14qmm0s70kb06gsfq', '15.204.73.228', 1742372879, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337323837393b61646d696e5f726f6c65737c4e3b52455455524e7c733a32353a226e65772f706f73742f726f6f6d617465732d72656e74616c73223b),
('h2ge0pfcdjv4i0egn4unne65k4mebimo', '80.85.245.187', 1742373883, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337333835343b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('m1e5cfhlvlpgguhp6jt3rkddi1k9dpum', '66.249.70.8', 1742374119, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343131363b61646d696e5f726f6c65737c4e3b),
('0esrsqg404ptcb74nstdohn1i8u9n8f0', '107.178.224.67', 1742374302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330323b61646d696e5f726f6c65737c4e3b),
('35ud6lbg86fulv42kmh1m363pbb7k6ok', '107.178.224.67', 1742374302, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330323b61646d696e5f726f6c65737c4e3b),
('rsqrenil7drkvvu7qk650umqg39sm4us', '107.178.224.68', 1742374303, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330333b61646d696e5f726f6c65737c4e3b),
('q9uf8j77n5ldanafb7lvrfb0am4odpin', '107.178.224.67', 1742374303, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330333b61646d696e5f726f6c65737c4e3b),
('o1mn43r3lsshbcmi3qjqdfc8sguqnq40', '107.178.224.67', 1742374303, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330333b61646d696e5f726f6c65737c4e3b),
('lsabobad8ct004b1ohj3s6ukbr7pr089', '107.178.224.66', 1742374303, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343330333b61646d696e5f726f6c65737c4e3b),
('cd9juj3g7ahig9t844mcev4eng5cqpir', '80.85.245.250', 1742374585, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343534363b61646d696e5f726f6c65737c4e3b52455455524e7c733a37323a22626c6f672f64657461696c732f6e6570616c692d627573696e65737365732d696e2d7468652d7573612d6275696c64696e672d636f6d6d756e6974792d616e642d73756363657373223b),
('6qrvbtcb29gdfd400fgq3pvvlq0bjdhr', '69.255.243.16', 1742374760, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337343735383b61646d696e5f726f6c65737c4e3b),
('c98sto6tlcv08n17v174ri1ji8nismhq', '110.172.98.2', 1742375338, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353333383b61646d696e5f726f6c65737c4e3b),
('pq6kk6c82i3f5o5gpmv82q625p476se3', '110.172.98.2', 1742375339, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353333393b61646d696e5f726f6c65737c4e3b),
('87fraufufjum450fhhlp17t78sgromgt', '110.172.98.2', 1742375340, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353334303b61646d696e5f726f6c65737c4e3b),
('ncm3d1jjtll1uug3lb6moh4prrou1d2t', '110.172.98.2', 1742375341, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353334313b61646d696e5f726f6c65737c4e3b),
('5rimk2578csgpa9gvgj445pkea1pcfn0', '110.172.98.2', 1742375342, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353334323b61646d696e5f726f6c65737c4e3b),
('ancn5l7k7fu2bmd3tf1a75vmc2jcohpq', '110.172.98.2', 1742375372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353337323b61646d696e5f726f6c65737c4e3b),
('3fvuk83jnn4hvcdkrh6732o7f6a7fvuf', '110.172.98.2', 1742375373, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353337333b61646d696e5f726f6c65737c4e3b),
('1mmlam16nckvqob4ifo1lce6i4ml9mkv', '110.172.98.2', 1742375374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353337343b61646d696e5f726f6c65737c4e3b);
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5rnp6nu08r9bjokimjj01ujc95vp5bjh', '110.172.98.2', 1742375375, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353337353b61646d696e5f726f6c65737c4e3b),
('v1np3aal8k35v673j952ib30nash1vnm', '107.178.192.36', 1742375497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439373b61646d696e5f726f6c65737c4e3b),
('au8acc8m2chgld04crsfqv6lo6oi8e0a', '107.178.192.35', 1742375497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439373b61646d696e5f726f6c65737c4e3b),
('8mbi26iorrr2plqnrcs2f1gaf3h78jh4', '107.178.192.36', 1742375497, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439373b61646d696e5f726f6c65737c4e3b),
('015ju43cc97ftaaud7b88ua03ghpfsf5', '107.178.192.34', 1742375498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439383b61646d696e5f726f6c65737c4e3b),
('1kor44hq95fuush1v1gau48taviu10vm', '107.178.192.34', 1742375498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439383b61646d696e5f726f6c65737c4e3b),
('hpu6trpj5h2qe8n810jndn7ntdilq1b9', '107.178.192.36', 1742375498, 0x5f5f63695f6c6173745f726567656e65726174657c693a313734323337353439383b61646d696e5f726f6c65737c4e3b);

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `confessions`
--

CREATE TABLE `confessions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `uID` int(11) NOT NULL,
  `notif` int(11) NOT NULL DEFAULT 0,
  `type` varchar(25) NOT NULL,
  `nsfw` int(11) NOT NULL DEFAULT 0,
  `cID` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) NOT NULL,
  `city_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confession_comment`
--

CREATE TABLE `confession_comment` (
  `id` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `bID` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` varchar(25) NOT NULL,
  `commenter_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confession_likes`
--

CREATE TABLE `confession_likes` (
  `id` int(11) NOT NULL,
  `bID` int(11) NOT NULL,
  `uID` int(11) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `likebg` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `confession_views`
--

CREATE TABLE `confession_views` (
  `id` int(11) NOT NULL,
  `cID` int(11) NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=forum, 2=confession'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_creator_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `discount_type` tinyint(1) NOT NULL COMMENT '1=Flat, 2=Percent',
  `discount` decimal(8,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Disabled',
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(150) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `code` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `twitter` text DEFAULT NULL,
  `facebook` text DEFAULT NULL,
  `pinterest` text DEFAULT NULL,
  `linkedin` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`id`, `lparent`, `lang_id`, `name`, `subject`, `code`, `email`, `content`, `status`, `twitter`, `facebook`, `pinterest`, `linkedin`, `instagram`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`) VALUES
(1, 0, 2, 'Reset Password', 'Reset Password', 'reset-password', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#FFFFFF\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 18px; line-height: 35px; font-weight: 600; color: #32353b; text-align: inherit;\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit; background: #f0f0f0; padding: 20px;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" width=\"27\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0px; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; color: #515358; text-align: center;\" align=\"center\" width=\"27\" height=\"25\"><a style=\"display: inline-block; width: auto; height: 100%; padding: 7px 20px 6px 20px; font-size: 16px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #ffffff; line-height: 1.54; background: #be1e2d; border: 1px solid #FF7300; text-decoration: none; text-transform: uppercase; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" href=\"[BUTTONLINK]\" target=\"_blank\" rel=\"noopener noreferrer\">[BUTTONTEXT]</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%!important; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%!important; min-width: 100%!important; margin: 0; padding: 0; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table class=\"x_container x_footer-content\" style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, NULL, NULL, NULL, NULL, NULL, '2017-10-16 10:08:01', 1, '2017-11-21 13:43:01', 1, 0, 0),
(3, 0, 2, 'Account Verification', 'Account Verification', 'account-verification', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#FFFFFF\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 18px; line-height: 35px; font-weight: 600; color: #32353b; text-align: inherit;\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit; background: #f0f0f0; padding: 20px;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" width=\"27\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%!important; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%!important; min-width: 100%!important; margin: 0; padding: 0; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table class=\"x_container x_footer-content\" style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, NULL, NULL, NULL, NULL, NULL, '2017-11-03 16:30:58', 1, '2017-11-21 13:38:41', 1, 0, 0),
(4, 0, 2, 'Contact Us', 'Contact Us', 'contact-us', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 18px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; text-align: left; word-break: break-word; border-collapse: collapse!important;\" height=\"40\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; text-align: left;\" height=\"40\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" width=\"22%\" height=\"30\">FULL NAME</td>\r\n<td align=\"center\" width=\"5%\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[SENDER]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Eamil Address</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[EMAIL]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Phone #</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[PHONE]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Subject</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[SUBJECTU]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" colspan=\"3\" height=\"30\">Message:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" colspan=\"3\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr>\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c;\" align=\"center\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; text-align: center; color: #98999c;\" align=\"center\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; text-align: center; color: #98999c;\" align=\"center\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 1, NULL, NULL, NULL, NULL, NULL, '2017-11-08 13:43:47', 1, '2020-06-01 22:46:22', 1, 0, 0),
(5, 1, 1, 'Reset Password', 'Reset Password', 'reset-password', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#FFFFFF\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 18px; line-height: 35px; font-weight: 600; color: #32353b; text-align: inherit;\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit; background: #f0f0f0; padding: 20px;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" width=\"27\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0px; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\', Arial, Helvetica, sans-serif; color: #515358; text-align: center;\" align=\"center\" width=\"27\" height=\"25\"><a style=\"display: inline-block; width: auto; height: 100%; padding: 7px 20px 6px 20px; font-size: 16px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #ffffff; line-height: 1.54; background: #be1e2d; border: 1px solid #FF7300; text-decoration: none; text-transform: uppercase; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;\" href=\"[BUTTONLINK]\" target=\"_blank\" rel=\"noopener noreferrer\">[BUTTONTEXT]</a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%!important; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%!important; min-width: 100%!important; margin: 0; padding: 0; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table class=\"x_container x_footer-content\" style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, NULL, NULL, NULL, NULL, NULL, '2017-10-16 10:08:01', 1, '2017-11-21 13:43:01', 1, 0, 0),
(6, 3, 1, 'Account Verification', 'Account Verification', 'account-verification', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#FFFFFF\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 18px; line-height: 35px; font-weight: 600; color: #32353b; text-align: inherit;\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit; background: #f0f0f0; padding: 20px;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" width=\"27\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%!important; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%!important; min-width: 100%!important; margin: 0; padding: 0; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table class=\"x_container x_footer-content\" style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">&nbsp;</td>\r\n</tr>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, NULL, NULL, NULL, NULL, NULL, '2017-11-03 16:30:58', 1, '2017-11-21 13:38:41', 1, 0, 0),
(7, 4, 1, 'Contact Us', 'Contact Us', 'contact-us', 'info@dedevelopers.com', '<table style=\"width: 800px; text-align: left; margin: 30px auto 0 auto; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; vertical-align: top; border: 10px solid #be1e2d; border-spacing: 0; border-collapse: collapse; background-color: #fff;\" align=\"center\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 30px 10px; font-size: 14px; font-weight: normal; line-height: 19px; vertical-align: top; text-align: left; color: #515358; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; min-width: 100%; margin: 0 0 0px 0; padding: 0; vertical-align: top; text-align: left; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"width: 100%; min-width: 100%; margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse;\">\r\n<tbody>\r\n<tr style=\"padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; vertical-align: top; font-size: 14px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; line-height: 20px; color: #515358; word-break: break-word; border-collapse: collapse!important;\" align=\"center\" valign=\"top\"><a style=\"height: 48px; width: 220px; text-align: center; display: block; clear: both;\" title=\"DeDevelopers\" href=\"[BASEURL]\" target=\"_blank\" rel=\"noopener noreferrer\"><img style=\"width: 100%; border: none; outline: none; text-decoration: none;\" src=\"[LOGO]\" alt=\"[BASEURL]\" /> </a></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 20px auto; line-height: 1; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"width: 100%; margin: 0 auto; padding: 0; vertical-align: top; text-align: inherit; border-spacing: 0; border-collapse: collapse; background-color: #ffffff;\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr style=\"margin: 0; padding: 0; vertical-align: top; text-align: left;\" align=\"left\">\r\n<td style=\"margin: 0; padding: 0; font-size: 13px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; vertical-align: top; text-align: left; word-break: break-word; border-collapse: collapse!important;\" align=\"left\" valign=\"top\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td width=\"5%\">&nbsp;</td>\r\n<td width=\"90%\">\r\n<table width=\"100%\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 18px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; text-align: left; word-break: break-word; border-collapse: collapse!important;\" height=\"40\">Hi [USER]!</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; line-height: 20px; text-align: left;\" height=\"40\">[SUBJECT]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0 0 30px 0; font-size: 12px; line-height: 35px; color: #32353b; text-align: inherit;\">\r\n<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" width=\"22%\" height=\"30\">FULL NAME</td>\r\n<td align=\"center\" width=\"5%\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[SENDER]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Eamil Address</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[EMAIL]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Phone #</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[PHONE]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" height=\"30\">Subject</td>\r\n<td align=\"center\">:</td>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\">[SUBJECTU]</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 0; font-size: 12px; font-weight: bold; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left; text-transform: uppercase;\" colspan=\"3\" height=\"30\">Message:</td>\r\n</tr>\r\n<tr>\r\n<td style=\"margin: 0; padding: 10px 15px; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; color: #515358; text-align: left;\" colspan=\"3\" height=\"25\">[MESSAGE]</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n<td width=\"5%\">&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<hr style=\"width: 100%; height: 2px; margin: 30px auto; text-align: center; border: 0 none; color: #dedede; background-color: #dedede;\" />\r\n<table style=\"width: 100%; border-spacing: 0; border-collapse: collapse; text-align: inherit;\">\r\n<tbody>\r\n<tr>\r\n<td class=\"x_center\" style=\"margin: 0; padding: 0; font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; vertical-align: top; text-align: center; color: #98999c;\" align=\"center\">&copy; 2015 - 2017 DeDevelopers All rights reserved</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; text-align: center; color: #98999c;\" align=\"center\">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style=\"font-size: 12px; font-weight: normal; font-family: \'Open Sans\',Arial,Helvetica,sans-serif; text-align: center; color: #98999c;\" align=\"center\">This is an important notification helping you quickly get the most out of DeDevelopers.&nbsp;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 1, NULL, NULL, NULL, NULL, NULL, '2017-11-08 13:43:47', 1, '2020-06-01 22:46:22', 1, 0, 0),
(17, 4, 1, 'Welcome to NepState ! Connecting Nepalese Globally', 'Signup Email ', 'signup-email', 'info@dedevelopers.com', '<p>We genuinely believe that your business has what it takes to thrive within the Nepali community, and we are excited to support you on this journey. <strong>Stay tuned </strong>&mdash; you&rsquo;ll receive more details soon on how to make the most of <strong>Nepstate</strong>,</p>\r\n<p dir=\"ltr\"><strong>Why Nepstate?</strong></p>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">✅ Connect with the Nepali community in the USA.</p>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">✅ Access jobs, rentals, events, and more.</p>\r\n<p dir=\"ltr\" style=\"text-align: justify;\">✅ Join discussions and build connections.</p>\r\n<p dir=\"ltr\">✅ Very Simple interface to manage your profile.</p>\r\n<p dir=\"ltr\">✅ Expand your customer base and brand presence.</p>\r\n<p dir=\"ltr\">✅ Get updates on blogs, news, and more.<br><br><strong>What makes NepState Different?</strong></p>\r\n<p dir=\"ltr\">✅ <strong>Dedicated SEO Team</strong>&nbsp;<strong>&ndash;</strong> Boost visibility with advanced SEO strategies.</p>\r\n<p dir=\"ltr\">✅ <strong>Email Marketing</strong> <strong>&ndash;</strong> Targeted campaigns for higher reach and engagement.</p>\r\n<p dir=\"ltr\">✅ <strong>Social Media Marketing &ndash;</strong> Promote on Facebook, Instagram, and more.</p>\r\n<p dir=\"ltr\">✅ <strong>User Dashboard Analytics</strong> <strong>&ndash;</strong> Access real-time data and performance insights.</p>\r\n<p dir=\"ltr\">✅ <strong>All-in-One Platform &ndash;</strong> Listings, forums, IT consulting, and community discussions.</p>\r\n<p dir=\"ltr\">✅ <strong>Global Expansion Vision</strong> <strong>&ndash;</strong> Connecting and growing communities worldwide.</p>\r\n<p><strong data-start=\"905\" data-end=\"923\">Special Offer!</strong> Get <strong data-start=\"928\" data-end=\"939\">20% OFF</strong> on your first listing with the code <strong data-start=\"976\" data-end=\"989\">WELCOME20</strong>. Start promoting your business today on NepState!</p>', 1, 'https://nepstate.com', 'https://www.facebook.com/share/15w3nxkoUT/?mibextid=wwXIfr', 'https://pin.it/2Enw6sFPO', 'https://nepstate.com', 'https://www.instagram.com/nepstate_us?igsh=MWNud2JvdzNyY2Y0Ng%3D%3D&utm_source=qr', '2017-11-08 13:43:47', 1, '2025-03-13 03:47:57', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `slug`, `description`, `image`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`, `meta_title`, `meta_keywords`, `meta_description`) VALUES
(1, 'What is NepState?', 'what-is-nepstate', '<p dir=\"ltr\">NepState is a multi-purpose online platform designed to empower businesses, individuals, and communities in Nepal. Our services include:<br>✅ Business Directory &ndash; Connect businesses with potential customers.<br>✅ Digital &amp; Social Media Marketing &ndash; Promote brands, services, and products online.<br>✅ Job Portal &ndash; Post jobs and attract Nepalese professionals.<br>✅ Learning Hub &ndash; Gain insights and skills in IT and business fields.<br>✅ Blog &amp; Confessions &ndash; Share experiences, industry knowledge, and discuss current Nepalese issues.<br>✅ Community Forum &ndash; Engage in discussions on trending topics in Nepal.</p>\r\n<p dir=\"ltr\">Whether you\'re a business owner, job seeker, blogger, or content creator, NepState helps you reach the right audience and grow your presence.</p>\r\n<p>&nbsp;</p>', NULL, 1, '2025-02-28 03:28:20', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, 'Who can list their business on NepState?', 'who-can-list-their-business-on-nepstate', '<p dir=\"ltr\">NepState is for everyone! Whether you\'re a business owner, job seeker, or just looking for a place to stay, you can use NepState to connect with the right people.</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Businesses &ndash; List your shop, restaurant, or service and attract more customers.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Employers &ndash; Post job openings and find the right employees.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Job Seekers &ndash; Discover new job opportunities in Nepal.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">People Looking for Rentals or Roommates &ndash; Find a place to stay or list your rental property.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Freelancers &amp; Service Providers &ndash; Promote your services, from IT solutions to home repairs.</p>\r\n</li>\r\n</ul>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Event Organizers &ndash; List events like concerts, workshops, or meetups to reach a bigger audience.</p>\r\n</li>\r\n</ul>\r\n<p dir=\"ltr\">If you have something to offer or something to find, NepState makes it easy! 🚀</p>\r\n<p>&nbsp;</p>', NULL, 1, '2025-02-28 03:30:29', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3, 'How do I list my business on NepState?', 'how-do-i-list-my-business-on-nepstate', '<p dir=\"ltr\">&nbsp; To list your business, follow these steps:</p>\r\n<ol>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Go to Services menu</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Click on &ldquo;Add listing&rdquo; button</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Sign up for a free account on NepState and fill out the required details.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Choose a payment plan&nbsp;</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Make a payment</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Your listing will be posted instantly</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Go to dashboard to edit your listing</p>\r\n</li>\r\n</ol>\r\n<p style=\"text-align: left;\">&nbsp;</p>', NULL, 1, '2025-02-28 03:38:47', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 'Can I edit my business listing after it is published?', 'can-i-edit-my-business-listing-after-it-is-published', '<p dir=\"ltr\">Yes! You can log into your account and update your business details at any time.</p>\r\n<ol>\r\n<li>Go to profile and login</li>\r\n<li>Click on Dashboard</li>\r\n<li>Click on My Listing&nbsp;</li>\r\n<li>Select the pencil item on your desired listing to edit and save once satisfied.</li>\r\n</ol>', NULL, 1, '2025-02-28 03:43:46', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 'I don’t have a website. Can I still list my business?', 'i-dont-have-a-website-can-i-still-list-my-business', '<p dir=\"ltr\">Yes! You don&rsquo;t need a website to list your business on NepState. We provide you with an online business listing, allowing customers to find you even if you don&rsquo;t have an online presence. Your listing will appear in Google search results, making it easier for potential customers to discover your business. You can also add important details like your phone number, social media links, and services offered, helping people connect with you directly. With NepState, you get online visibility without the need for a website, making it simple to reach more customers and grow your business.</p>', NULL, 1, '2025-02-28 03:45:28', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(6, 'How can I get my business featured on NepState?', 'how-can-i-get-my-business-featured-on-nepstate', '<p data-start=\"132\" data-end=\"192\">You can feature your business on <strong data-start=\"165\" data-end=\"177\">NepState</strong> in two ways:</p>\r\n<ol data-start=\"194\" data-end=\"885\">\r\n<li data-start=\"194\" data-end=\"434\">\r\n<p data-start=\"197\" data-end=\"215\"><strong data-start=\"197\" data-end=\"213\">Ad Post Only</strong></p>\r\n<ul data-start=\"219\" data-end=\"434\">\r\n<li data-start=\"219\" data-end=\"320\">You can directly post an <strong data-start=\"246\" data-end=\"263\">advertisement</strong> in the <strong data-start=\"271\" data-end=\"287\">AD&rsquo;s section</strong> without listing your business.</li>\r\n<li data-start=\"324\" data-end=\"434\">Simply go to the <strong data-start=\"343\" data-end=\"359\">Post Your Ad</strong> section, select an <strong data-start=\"379\" data-end=\"387\">AD #</strong>, and choose where you want to place your ad.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"436\" data-end=\"885\">\r\n<p data-start=\"439\" data-end=\"508\"><strong data-start=\"439\" data-end=\"469\">Business Listing + Ad Post</strong> (Recommended for Maximum Visibility)</p>\r\n<ul data-start=\"512\" data-end=\"885\">\r\n<li data-start=\"512\" data-end=\"637\">First, <strong data-start=\"521\" data-end=\"543\">list your business</strong> under the relevant category, such as <strong data-start=\"581\" data-end=\"634\">IT consulting, services, jobs, rentals, or events</strong>.</li>\r\n<li data-start=\"641\" data-end=\"749\">After listing, you can <strong data-start=\"666\" data-end=\"693\">enhance your visibility</strong> by selecting an <strong data-start=\"710\" data-end=\"726\">ad placement</strong> in the AD&rsquo;s section.</li>\r\n<li data-start=\"753\" data-end=\"885\">This approach helps your business appear in both the <strong data-start=\"808\" data-end=\"827\">listing section</strong> and the <strong data-start=\"836\" data-end=\"861\">advertisement section</strong>, increasing exposure.</li>\r\n</ul>\r\n</li>\r\n</ol>', NULL, 1, '2025-02-28 03:49:46', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(7, 'Can I promote events on NepState?', 'can-i-promote-events-on-nepstate', '<p data-start=\"79\" data-end=\"137\">Yes, you can promote events on <strong data-start=\"110\" data-end=\"122\">NepState</strong> in two ways:</p>\r\n<ol data-start=\"139\" data-end=\"429\">\r\n<li data-start=\"139\" data-end=\"270\">\r\n<p data-start=\"142\" data-end=\"161\"><strong data-start=\"142\" data-end=\"159\">Event Listing</strong></p>\r\n<ul data-start=\"165\" data-end=\"270\">\r\n<li data-start=\"165\" data-end=\"270\">List your event in the <strong data-start=\"190\" data-end=\"208\">Events section</strong> to provide details such as date, location, and description.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"272\" data-end=\"429\">\r\n<p data-start=\"275\" data-end=\"308\"><strong data-start=\"275\" data-end=\"306\">Ad Post for More Visibility</strong></p>\r\n<ul data-start=\"312\" data-end=\"429\">\r\n<li data-start=\"312\" data-end=\"429\">After listing, you can also post an <strong data-start=\"350\" data-end=\"356\">ad</strong> in the <strong data-start=\"364\" data-end=\"380\">AD&rsquo;s section</strong> by selecting an <strong data-start=\"397\" data-end=\"405\">AD #</strong> to get more exposure.</li>\r\n</ul>\r\n</li>\r\n</ol>', NULL, 1, '2025-02-28 03:50:44', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(8, 'How do I attract more customers to my business listing?', 'how-do-i-attract-more-customers-to-my-business-listing', '<p dir=\"ltr\">To increase visibility, you can:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Add high-quality images and videos to your listing.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Encourage customers to leave reviews.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Share your NepState business profile on social media.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Use our featured listing option for premium visibility.</p>\r\n</li>\r\n</ul>', NULL, 1, '2025-02-28 03:51:14', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(9, 'What are customer reviews, and how do they help my business?', 'what-are-customer-reviews-and-how-do-they-help-my-business', '<p dir=\"ltr\">Customer reviews provide social proof and credibility. Positive reviews can attract more customers, while responding to reviews shows good customer service.</p>', NULL, 1, '2025-02-28 03:51:40', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(10, 'How does a business listing help me get more traffic?', 'how-does-a-business-listing-help-me-get-more-traffic', '<p dir=\"ltr\">A listing on NepState improves your online presence, boosts your ranking in search results, and helps potential customers find your business easily.</p>', NULL, 1, '2025-02-28 03:51:57', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(11, 'Does NepState provide analytics for my business listing?', 'does-nepstate-provide-analytics-for-my-business-listing', '<p dir=\"ltr\">Yes! Business owners can access analytics to see how many visitors viewed their profile, how often their business appears in search results, and customer interactions.</p>', NULL, 1, '2025-02-28 03:52:16', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(12, 'Is NepState free to use?', 'is-nepstate-free-to-use', '<p dir=\"ltr\">Yes, creating a basic business listing is free. However, we offer premium options for enhanced visibility and additional marketing tools.</p>', NULL, 1, '2025-02-28 03:52:56', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(13, 'Can I list multiple businesses under one account?', 'can-i-list-multiple-businesses-under-one-account', '<p data-start=\"107\" data-end=\"328\">Yes, you can list <strong data-start=\"125\" data-end=\"148\">multiple businesses</strong> under <strong data-start=\"155\" data-end=\"170\">one account</strong> on <strong data-start=\"174\" data-end=\"186\">NepState</strong>. Each business can be listed separately under the relevant category, such as <strong data-start=\"264\" data-end=\"325\">IT consulting, services, job listings, rentals, or events</strong>.</p>\r\n<p data-start=\"330\" data-end=\"480\">To maximize visibility, you can also choose to <strong data-start=\"377\" data-end=\"389\">post ads</strong> for each business in the <strong data-start=\"415\" data-end=\"431\">AD&rsquo;s section</strong> by selecting an <strong data-start=\"448\" data-end=\"456\">AD #</strong> for better placement.</p>', NULL, 1, '2025-02-28 03:53:38', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(14, 'How do I contact NepState for support or inquiries?', 'how-do-i-contact-nepstate-for-support-or-inquiries', '<p data-start=\"97\" data-end=\"183\">You can contact <strong data-start=\"113\" data-end=\"125\">NepState</strong> for support or inquiries through the following methods:</p>\r\n<ol data-start=\"185\" data-end=\"589\">\r\n<li data-start=\"185\" data-end=\"272\"><strong data-start=\"188\" data-end=\"204\">Contact Form</strong> &ndash; Submit your inquiry via the <strong data-start=\"235\" data-end=\"249\">Contact Us</strong> page on the website.</li>\r\n<li data-start=\"273\" data-end=\"365\"><strong data-start=\"276\" data-end=\"293\">Email Support</strong> &ndash; Reach out via the official <strong data-start=\"323\" data-end=\"340\">support email</strong> listed on the website.</li>\r\n<li data-start=\"366\" data-end=\"501\"><strong data-start=\"369\" data-end=\"397\">WhatsApp &amp; Phone Support</strong> &ndash; Contact NepState directly through <strong data-start=\"434\" data-end=\"463\">WhatsApp or phone support</strong> (details available on the website).</li>\r\n<li data-start=\"502\" data-end=\"589\"><strong data-start=\"505\" data-end=\"521\">Social Media</strong> &ndash; Message <strong data-start=\"532\" data-end=\"565\">NepState\'s social media pages</strong> for quick assistance.</li>\r\n</ol>', NULL, 1, '2025-02-28 03:54:33', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(15, 'What are the benefits of a Ad listing?', 'what-are-the-benefits-of-a-ad-listing', '<p dir=\"ltr\">Premium listings provide:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Higher ranking in search results</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Featured placement on the homepage</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Advanced analytics and insights</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Additional promotional tools</p>\r\n</li>\r\n</ul>', NULL, 1, '2025-02-28 03:55:01', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(16, 'How do I add a blog on NepState?', 'how-do-i-add-a-blog-on-nepstate', '<p data-start=\"78\" data-end=\"130\">To add a blog on <strong data-start=\"95\" data-end=\"107\">NepState</strong>, follow these steps:</p>\r\n<ol data-start=\"132\" data-end=\"634\">\r\n<li data-start=\"132\" data-end=\"219\"><strong data-start=\"135\" data-end=\"161\">Log in to Your Account</strong> &ndash; Ensure you have a registered account on <strong data-start=\"204\" data-end=\"216\">NepState</strong>.</li>\r\n<li data-start=\"220\" data-end=\"306\"><strong data-start=\"223\" data-end=\"249\">Go to the Blog Section</strong> &ndash; Navigate to the <strong data-start=\"268\" data-end=\"276\">Blog</strong> section from the dashboard.</li>\r\n<li data-start=\"307\" data-end=\"413\"><strong data-start=\"310\" data-end=\"336\">Create a New Blog Post</strong> &ndash; Click on <strong data-start=\"348\" data-end=\"362\">\"Add Blog\"</strong> or <strong data-start=\"366\" data-end=\"387\">\"Create New Post\"</strong> and enter your content.</li>\r\n<li data-start=\"414\" data-end=\"503\"><strong data-start=\"417\" data-end=\"445\">Upload Images (Optional)</strong> &ndash; You can include relevant images to enhance your blog.</li>\r\n<li data-start=\"504\" data-end=\"634\"><strong data-start=\"507\" data-end=\"528\">Submit for Review</strong> &ndash; Once completed, submit your blog post. It may go through a <strong data-start=\"590\" data-end=\"608\">review process</strong> before being published.</li>\r\n</ol>', NULL, 1, '2025-02-28 03:55:38', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(17, 'How do I post a confession on NepState?', 'how-do-i-post-a-confession-on-nepstate', '<p data-start=\"85\" data-end=\"193\">Posting a <strong data-start=\"95\" data-end=\"109\">confession</strong> on <strong data-start=\"113\" data-end=\"125\">NepState</strong> is quick and does not require approval. Here&rsquo;s how you can do it:</p>\r\n<ol data-start=\"195\" data-end=\"839\">\r\n<li data-start=\"195\" data-end=\"300\"><strong data-start=\"198\" data-end=\"228\">Log in or Post Anonymously</strong> &ndash; Sign in to <strong data-start=\"242\" data-end=\"254\">NepState</strong> or choose the <strong data-start=\"269\" data-end=\"290\">anonymous posting</strong> option.</li>\r\n<li data-start=\"301\" data-end=\"379\"><strong data-start=\"304\" data-end=\"337\">Go to the Confessions Section</strong> &ndash; Navigate to the <strong data-start=\"356\" data-end=\"371\">Confessions</strong> page.</li>\r\n<li data-start=\"380\" data-end=\"460\"><strong data-start=\"383\" data-end=\"410\">Click \"Post Confession\"</strong> &ndash; Select the option to submit a new confession.</li>\r\n<li data-start=\"461\" data-end=\"574\"><strong data-start=\"464\" data-end=\"489\">Write Your Confession</strong> &ndash; Enter your message and choose whether to post <strong data-start=\"538\" data-end=\"571\">anonymously or with your name</strong>.</li>\r\n<li data-start=\"575\" data-end=\"735\"><strong data-start=\"578\" data-end=\"609\">NSFW Option (If Applicable)</strong> &ndash; If your confession contains sensitive content, you can mark it as <strong data-start=\"678\" data-end=\"706\">NSFW (Not Safe for Work)</strong> for appropriate filtering.</li>\r\n<li data-start=\"736\" data-end=\"839\"><strong data-start=\"739\" data-end=\"759\">Submit Instantly</strong> &ndash; Your confession will be <strong data-start=\"786\" data-end=\"811\">published immediately</strong> without needing approval.</li>\r\n</ol>', NULL, 1, '2025-02-28 03:57:13', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(18, 'How do I post a forum on NepState?', 'how-do-i-post-a-forum-on-nepstate', '<p data-start=\"80\" data-end=\"221\">Posting a <strong data-start=\"90\" data-end=\"110\">forum discussion</strong> on <strong data-start=\"114\" data-end=\"126\">NepState</strong> is easy and allows category selection, including <strong data-start=\"176\" data-end=\"184\">NSFW</strong> if applicable. Follow these steps:</p>\r\n<ol data-start=\"223\" data-end=\"908\">\r\n<li data-start=\"223\" data-end=\"281\"><strong data-start=\"226\" data-end=\"252\">Log in to Your Account</strong> &ndash; Sign in to <strong data-start=\"266\" data-end=\"278\">NepState</strong>.</li>\r\n<li data-start=\"282\" data-end=\"349\"><strong data-start=\"285\" data-end=\"312\">Go to the Forum Section</strong> &ndash; Navigate to the <strong data-start=\"331\" data-end=\"341\">Forums</strong> page.</li>\r\n<li data-start=\"350\" data-end=\"414\"><strong data-start=\"353\" data-end=\"386\">Click \"Create New Forum Post\"</strong> &ndash; Start a new discussion.</li>\r\n<li data-start=\"415\" data-end=\"573\"><strong data-start=\"418\" data-end=\"448\">Enter Your Topic &amp; Content</strong> &ndash;\r\n<ul data-start=\"456\" data-end=\"573\">\r\n<li data-start=\"456\" data-end=\"502\">Add a <strong data-start=\"464\" data-end=\"479\">clear title</strong> for your discussion.</li>\r\n<li data-start=\"506\" data-end=\"573\">Write your <strong data-start=\"519\" data-end=\"555\">post details, question, or topic</strong> for discussion.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"574\" data-end=\"674\"><strong data-start=\"577\" data-end=\"598\">Select a Category</strong> &ndash; Choose the most relevant <strong data-start=\"626\" data-end=\"644\">forum category</strong> from the available options.</li>\r\n<li data-start=\"675\" data-end=\"812\"><strong data-start=\"678\" data-end=\"705\">NSFW Option (If Needed)</strong> &ndash; If your post contains sensitive content, mark it as <strong data-start=\"760\" data-end=\"788\">NSFW (Not Safe for Work)</strong> for proper filtering.</li>\r\n<li data-start=\"813\" data-end=\"908\"><strong data-start=\"816\" data-end=\"836\">Submit Instantly</strong> &ndash; Your forum post will be <strong data-start=\"863\" data-end=\"888\">published immediately</strong> without approval.</li>\r\n</ol>', NULL, 1, '2025-02-28 03:58:14', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(19, 'What are Ad Posts on NepState?', 'what-are-ad-posts-on-nepstate', '<p dir=\"ltr\">Ad Posts are promotional posts that businesses or individuals can create to advertise their products, services, or events. They appear in strategic locations across NepState to maximize visibility.</p>', NULL, 1, '2025-02-28 03:58:49', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(20, 'NepState Categories Explained:', 'nepstate-categories-explained', '<ul>\r\n<li data-start=\"42\" data-end=\"303\">\r\n<p data-start=\"45\" data-end=\"60\"><strong data-start=\"45\" data-end=\"55\">Events</strong> 🎉</p>\r\n<ul data-start=\"64\" data-end=\"303\">\r\n<li data-start=\"64\" data-end=\"213\">A section for posting and discovering <strong data-start=\"104\" data-end=\"123\">upcoming events</strong>, such as <strong data-start=\"133\" data-end=\"210\">cultural programs, meetups, concerts, workshops, and community gatherings</strong>.</li>\r\n<li data-start=\"217\" data-end=\"303\">Users can list events with details like <strong data-start=\"259\" data-end=\"300\">date, time, location, and description</strong>.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"305\" data-end=\"578\">\r\n<p data-start=\"308\" data-end=\"321\"><strong data-start=\"308\" data-end=\"316\">Jobs</strong> 💼</p>\r\n<ul data-start=\"325\" data-end=\"578\">\r\n<li data-start=\"325\" data-end=\"385\">A platform for <strong data-start=\"342\" data-end=\"371\">job seekers and employers</strong> to connect.</li>\r\n<li data-start=\"389\" data-end=\"479\">Employers can <strong data-start=\"405\" data-end=\"426\">post job openings</strong>, and job seekers can <strong data-start=\"448\" data-end=\"476\">apply or browse listings</strong>.</li>\r\n<li data-start=\"483\" data-end=\"578\">Supports various employment types like <strong data-start=\"524\" data-end=\"575\">full-time, part-time, contract, and remote jobs</strong>.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"580\" data-end=\"824\">\r\n<p data-start=\"583\" data-end=\"601\"><strong data-start=\"583\" data-end=\"595\">Services</strong> 🛠️</p>\r\n<ul data-start=\"605\" data-end=\"824\">\r\n<li data-start=\"605\" data-end=\"731\">A place to <strong data-start=\"618\" data-end=\"643\">list or find services</strong>, such as <strong data-start=\"653\" data-end=\"728\">IT consulting, home repair, photography, tutoring, legal help, and more</strong>.</li>\r\n<li data-start=\"735\" data-end=\"824\">Businesses and freelancers can promote their <strong data-start=\"782\" data-end=\"794\">services</strong> to reach potential clients.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"826\" data-end=\"1061\">\r\n<p data-start=\"829\" data-end=\"850\"><strong data-start=\"829\" data-end=\"845\">IT Trainings</strong> 💻</p>\r\n<ul data-start=\"854\" data-end=\"1061\">\r\n<li data-start=\"854\" data-end=\"978\">Dedicated to <strong data-start=\"869\" data-end=\"896\">IT training and courses</strong>, including <strong data-start=\"908\" data-end=\"975\">coding bootcamps, software training, and tech skill development</strong>.</li>\r\n<li data-start=\"982\" data-end=\"1061\">Individuals or institutions can <strong data-start=\"1016\" data-end=\"1035\">offer or enroll</strong> in IT-related programs.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"1063\" data-end=\"1312\">\r\n<p data-start=\"1066\" data-end=\"1094\"><strong data-start=\"1066\" data-end=\"1089\">Roommates &amp; Rentals</strong> 🏠</p>\r\n<ul data-start=\"1098\" data-end=\"1312\">\r\n<li data-start=\"1098\" data-end=\"1159\">A section for <strong data-start=\"1114\" data-end=\"1156\">finding roommates or rental properties</strong>.</li>\r\n<li data-start=\"1163\" data-end=\"1234\">Users can <strong data-start=\"1175\" data-end=\"1212\">list rooms, apartments, or houses</strong> available for rent.</li>\r\n<li data-start=\"1238\" data-end=\"1312\">Ideal for those <strong data-start=\"1256\" data-end=\"1309\">looking for shared housing or independent rentals</strong>.</li>\r\n</ul>\r\n</li>\r\n</ul>', NULL, 1, '2025-02-28 04:00:04', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL),
(21, 'NepState Content Sections Explained:', 'nepstate-content-sections-explained', '<ul>\r\n<li data-start=\"48\" data-end=\"336\">\r\n<p data-start=\"51\" data-end=\"65\"><strong data-start=\"51\" data-end=\"63\">Blogs 📝</strong></p>\r\n<ul data-start=\"69\" data-end=\"336\">\r\n<li data-start=\"69\" data-end=\"141\">A space for users to <strong data-start=\"92\" data-end=\"120\">write and share articles</strong> on various topics.</li>\r\n<li data-start=\"145\" data-end=\"259\">Topics can include <strong data-start=\"166\" data-end=\"256\">travel experiences, personal stories, tech insights, business tips, and community news</strong>.</li>\r\n<li data-start=\"263\" data-end=\"336\">Blogs help in <strong data-start=\"279\" data-end=\"333\">engaging readers and sharing knowledge or opinions</strong>.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"338\" data-end=\"628\">\r\n<p data-start=\"341\" data-end=\"355\"><strong data-start=\"341\" data-end=\"353\">Forum 💬</strong></p>\r\n<ul data-start=\"359\" data-end=\"628\">\r\n<li data-start=\"359\" data-end=\"464\">A <strong data-start=\"363\" data-end=\"386\">discussion platform</strong> where users can post <strong data-start=\"408\" data-end=\"439\">questions, ideas, or topics</strong> for open conversation.</li>\r\n<li data-start=\"468\" data-end=\"561\">Discussions can be <strong data-start=\"489\" data-end=\"504\">categorized</strong> (e.g., tech, lifestyle, career, business, NSFW, etc.).</li>\r\n<li data-start=\"565\" data-end=\"628\">Encourages <strong data-start=\"578\" data-end=\"625\">community interaction and knowledge sharing</strong>.</li>\r\n</ul>\r\n</li>\r\n<li data-start=\"630\" data-end=\"884\">\r\n<p data-start=\"633\" data-end=\"653\"><strong data-start=\"633\" data-end=\"651\">Confessions 🤫</strong></p>\r\n<ul data-start=\"657\" data-end=\"884\">\r\n<li data-start=\"657\" data-end=\"744\">A space for users to <strong data-start=\"680\" data-end=\"741\">anonymously share their thoughts, experiences, or secrets</strong>.</li>\r\n<li data-start=\"748\" data-end=\"819\">No approval is required, and there is an <strong data-start=\"791\" data-end=\"806\">NSFW option</strong> if needed.</li>\r\n<li data-start=\"823\" data-end=\"884\">It provides a <strong data-start=\"839\" data-end=\"861\">judgment-free zone</strong> for open expression.</li>\r\n</ul>\r\n</li>\r\n</ul>', NULL, 1, '2025-02-28 04:00:49', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `parent_id`, `title`, `slug`, `description`, `image`, `status`, `created_at`) VALUES
(1, 0, 'Nepali News', 'nepali-news', '<p>Nepali News</p>', NULL, 1, '2025-03-03 05:36:40'),
(2, 0, 'Immigration', 'immigration', '<p>Immigration</p>', NULL, 1, '2025-03-03 05:37:04'),
(3, 0, 'Latest Affairs', 'latest-affairs', '<p>Latest Affairs</p>', NULL, 1, '2025-03-03 05:37:19'),
(4, 0, 'US VISA', 'us-visa', '<p>US VISA</p>', NULL, 1, '2025-03-03 05:37:33'),
(5, 0, 'Politics', 'politics', '<p>Politics</p>', NULL, 1, '2025-03-03 05:37:50'),
(6, 0, 'Sports', 'sports', '<p>Sports</p>', NULL, 1, '2025-03-03 05:37:59'),
(7, 0, 'Food', 'food', '<p>Food</p>', NULL, 1, '2025-03-03 05:38:11'),
(8, 0, 'KuraKani', 'kurakani', '<p>Kurakani</p>', NULL, 1, '2025-03-03 05:38:20'),
(9, 0, 'IT Guff', 'it-guff', '<p>IT Training Consultancies</p>', NULL, 1, '2025-03-03 05:38:40'),
(10, 0, 'Investment', 'investment', '<p>Investment</p>', NULL, 1, '2025-03-03 05:38:51'),
(11, 0, 'STOCks', 'stocks', '<p>STOCks</p>', NULL, 1, '2025-03-03 05:39:01'),
(12, 0, 'NSFW', 'nsfw', '<p>NSFW</p>', NULL, 1, '2025-03-03 05:39:12'),
(13, 0, 'free stuff', 'free-stuff', '<p>PErks and free stuff</p>', NULL, 1, '2025-03-03 05:39:28');

-- --------------------------------------------------------

--
-- Table structure for table `history_of_before_apply_coupons`
--

CREATE TABLE `history_of_before_apply_coupons` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_select_ad_type` int(11) NOT NULL,
  `plan_amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `discounted_amount` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `direction` varchar(3) DEFAULT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_default` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `direction`, `title`, `slug`, `image`, `status`, `is_default`, `created_at`, `created_by`, `updated_at`, `updated_by`, `is_deleted`, `deleted_by`, `meta_title`, `meta_keywords`, `meta_description`, `lparent`) VALUES
(1, 'RTL', 'Arabic', 'arabic', '8f0d07dd16310d8ef1e26982e65b6e71.png', 1, 0, '2020-05-12 16:33:36', 1, '2021-01-27 01:44:29', 3, 0, 0, NULL, NULL, NULL, 0),
(2, 'LTR', 'English', 'english', '74f4d2e8264fd97080449b8ae92129f5.png', 1, 1, '2020-05-12 16:35:36', 1, '2020-08-24 16:07:18', 3, 0, 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `display_priority` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `cust` int(1) DEFAULT 0,
  `logo_price` decimal(20,2) DEFAULT 0.00,
  `delivery` int(11) DEFAULT 0,
  `delivery_type` varchar(50) DEFAULT NULL,
  `cust_image` varchar(200) DEFAULT NULL,
  `shipping` decimal(20,2) DEFAULT 0.00,
  `vat` decimal(20,2) DEFAULT 0.00,
  `min_qty` int(11) NOT NULL DEFAULT 0,
  `pc_price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `stamps_price` decimal(20,2) DEFAULT 0.00,
  `faces` int(11) NOT NULL DEFAULT 0,
  `faces_from` int(11) NOT NULL DEFAULT 0,
  `faces_to` int(11) NOT NULL DEFAULT 0,
  `faces_price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `colors` int(11) NOT NULL DEFAULT 0,
  `colors_from` int(11) NOT NULL DEFAULT 0,
  `colors_to` int(11) NOT NULL DEFAULT 5,
  `colors_price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `base` int(11) NOT NULL DEFAULT 0,
  `base_price` int(11) NOT NULL DEFAULT 0,
  `sides` int(11) NOT NULL DEFAULT 0,
  `sides_price` int(11) NOT NULL DEFAULT 0,
  `width` int(11) NOT NULL DEFAULT 0,
  `height` int(11) NOT NULL DEFAULT 0,
  `c_title` varchar(200) DEFAULT NULL,
  `c_title_ar` varchar(200) DEFAULT NULL,
  `note_text_en` varchar(255) DEFAULT NULL,
  `note_text_ar` varchar(255) DEFAULT NULL,
  `terms_en` text DEFAULT NULL,
  `terms_ar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

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
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2024_04_02_041621_rename_admin_table_to_admins', 2),
(5, '2024_05_14_085610_create_testimonials_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `desc` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `by` text DEFAULT NULL,
  `by_id` int(11) NOT NULL DEFAULT 0,
  `for_admin` int(1) NOT NULL DEFAULT 0,
  `for_designer` int(1) NOT NULL DEFAULT 0,
  `for_user` int(1) NOT NULL DEFAULT 0,
  `for_production` int(1) NOT NULL DEFAULT 0,
  `admin_read` int(1) NOT NULL DEFAULT 0,
  `designer_read` int(1) NOT NULL DEFAULT 0,
  `production_read` int(1) NOT NULL DEFAULT 0,
  `user_read` int(1) NOT NULL DEFAULT 0,
  `is_payment` int(1) NOT NULL DEFAULT 0,
  `function` varchar(200) DEFAULT NULL,
  `for_purchaser` int(11) NOT NULL DEFAULT 0,
  `for_stock` int(11) NOT NULL DEFAULT 0,
  `puchase_stcok` int(11) NOT NULL DEFAULT 0,
  `is_normal` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notificationss`
--

CREATE TABLE `notificationss` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `notification_type_id` int(5) NOT NULL,
  `table_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `create_at` datetime NOT NULL,
  `push_in` tinyint(4) NOT NULL DEFAULT 0,
  `read_it` tinyint(4) NOT NULL DEFAULT 0,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `notification_type`
--

CREATE TABLE `notification_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `notification_type`
--

INSERT INTO `notification_type` (`id`, `type`) VALUES
(1, 'Contact Lead'),
(2, 'Quote Lead'),
(3, 'New Message'),
(4, 'New Client Register'),
(5, 'New Conversation Started'),
(6, 'New Invoice'),
(7, 'Invoice Paid');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=All;2=Pending;3=Preparing;4=Shipped;5=Review;6=Closed;7=Cancelled;',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `anonymous` int(1) NOT NULL DEFAULT 0,
  `payment_method` int(1) NOT NULL DEFAULT 0,
  `transaction_id` int(11) NOT NULL DEFAULT 0,
  `shipping_id` int(11) NOT NULL DEFAULT 0,
  `shipping_fee` decimal(20,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(20,2) NOT NULL DEFAULT 0.00,
  `total` decimal(20,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(20) DEFAULT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `address_text` text DEFAULT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `payment_object` text DEFAULT NULL,
  `payment_done` int(1) NOT NULL DEFAULT 0,
  `vendor_id` int(11) NOT NULL DEFAULT 0,
  `region_id` int(11) NOT NULL DEFAULT 0,
  `reason` text DEFAULT NULL,
  `cancelled_by` varchar(20) DEFAULT NULL,
  `did_tap_options` int(1) NOT NULL DEFAULT 0,
  `from_web_mobile` int(1) NOT NULL DEFAULT 2,
  `payment_reason_rejct` text DEFAULT NULL,
  `lang_id` int(11) NOT NULL DEFAULT 2,
  `shipping_number` varchar(255) DEFAULT NULL,
  `order_time` varchar(20) DEFAULT NULL,
  `order_date` varchar(205) DEFAULT NULL,
  `special_instructions` text DEFAULT NULL,
  `completed_date` varchar(255) DEFAULT NULL,
  `payment_date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orders_adons`
--

CREATE TABLE `orders_adons` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ar` varchar(255) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `total` decimal(20,2) NOT NULL DEFAULT 0.00,
  `variation` text DEFAULT NULL,
  `female` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_reviews`
--

CREATE TABLE `order_reviews` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `order_id` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 5,
  `review` text DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descriptions` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_2` text DEFAULT NULL,
  `image_3` text DEFAULT NULL,
  `bullets` text DEFAULT NULL,
  `by_default_banner` tinyint(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `slug` text NOT NULL,
  `w_image` varchar(255) DEFAULT 'dummy_image.png',
  `show_sections` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `lparent`, `lang_id`, `title`, `descriptions`, `image`, `image_2`, `image_3`, `bullets`, `by_default_banner`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `ip`, `created_at`, `updated_at`, `is_deleted`, `created_by`, `updated_by`, `deleted_by`, `slug`, `w_image`, `show_sections`) VALUES
(1, 0, 0, 'Privacy Policy', '<h2 dir=\"ltr\">Privacy Policy for NepState</h2>\r\n<p dir=\"ltr\">NepState LLC (\"NepState,\" \"we,\" \"our,\" or \"us\") respects your privacy and is committed to protecting the personal information you share with us. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website (nepstate.com), use our mobile app, or interact with our services (collectively, the \"Services\"). Please read this policy carefully to understand how we process your personal data.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h2 dir=\"ltr\">Information We Collect</h2>\r\n<p dir=\"ltr\">We collect the following types of personal information when you use our Services:</p>\r\n<h3 dir=\"ltr\">Personal Information You Provide to Us</h3>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Account Information: When you create an account, we collect personal information such as your name, email address, username, and other account-related details.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Payment Information: If you make a purchase or subscription, we may collect payment details (credit card numbers, billing address) via third-party payment processors.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Communication: If you contact us (e.g., via email, chat support, or customer service), we collect the information you provide in the communication.</p>\r\n</li>\r\n</ul>\r\n<h3 dir=\"ltr\">Personal Information We Automatically Collect</h3>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Device Information: We automatically collect information about your device, such as the IP address, browser type, operating system, and device identifiers.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Usage Data: We collect information about how you use our Services, such as which pages you visit, the time spent on the site, and any links you click.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Cookies: We use cookies and other tracking technologies to improve your experience. You can control cookie settings through your browser.</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">How We Use Your Information</h2>\r\n<p dir=\"ltr\">We use your personal information to:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Provide and improve the Services, including personalizing your experience.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Process transactions and manage your subscriptions or purchases.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Communicate with you regarding account updates, support requests, and promotional offers.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Ensure the security of our platform and prevent fraud or misuse of the Services.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Comply with legal obligations, including privacy regulations.</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">How We Share Your Information</h2>\r\n<p dir=\"ltr\">We may share your personal information in the following circumstances:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Service Providers: We may share your information with trusted third-party vendors who assist us in operating our website, processing payments, or providing customer support. These vendors are required to protect your data.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Business Transfers: In the event of a merger, acquisition, or sale of all or part of our business, your personal information may be transferred.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Legal Requirements: We may disclose your personal information to comply with legal obligations or to protect our rights, property, or the safety of users.</p>\r\n</li>\r\n</ul>\r\n<h2 dir=\"ltr\">Data Retention</h2>\r\n<p dir=\"ltr\">We retain your personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy or as required by law. When your personal data is no longer needed, we will securely delete or anonymize it.</p>\r\n<h2 dir=\"ltr\">Your Rights</h2>\r\n<p dir=\"ltr\">Depending on your location and the applicable laws, you may have the following rights regarding your personal data:</p>\r\n<ul>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Access: You can request to see the personal data we hold about you.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Correction: You can request to update or correct any inaccuracies in your personal data.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Deletion: You can request that we delete your personal information, subject to certain legal exceptions.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Opt-Out: You can opt out of marketing communications or withdraw your consent for data processing where consent is the legal basis.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Data Portability: You can request to receive a copy of your personal data in a machine-readable format or transfer it to another service provider.</p>\r\n</li>\r\n<li dir=\"ltr\" aria-level=\"1\">\r\n<p dir=\"ltr\" role=\"presentation\">Restrict Processing: You can request that we restrict how we process your personal data in certain circumstances.</p>\r\n</li>\r\n</ul>\r\n<p dir=\"ltr\">To exercise these rights, please contact us at info@nepstate.com.</p>\r\n<h2 dir=\"ltr\">Data Security</h2>\r\n<p dir=\"ltr\">We use administrative, technical, and physical security measures to protect your personal data from unauthorized access, use, or disclosure. However, no method of transmission over the internet or method of electronic storage is 100% secure, so we cannot guarantee absolute security.</p>\r\n<h2 dir=\"ltr\">International Transfers</h2>\r\n<p dir=\"ltr\">Your personal information may be transferred to and processed in countries outside of your home country, including countries where privacy laws may not offer the same level of protection. We take reasonable steps to ensure that your data is handled securely and in accordance with this Privacy Policy.</p>\r\n<h2 dir=\"ltr\">Children&rsquo;s Privacy</h2>\r\n<p dir=\"ltr\">Our Services are not directed to children under the age of 13. We do not knowingly collect personal information from children under 13. If you believe we have collected information from a child, please contact us immediately, and we will take steps to delete such information.</p>\r\n<h2 dir=\"ltr\">Changes to This Privacy Policy</h2>\r\n<p dir=\"ltr\">We may update this Privacy Policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors. When we make changes, we will update the \"Effective Date\" at the top of this page. We encourage you to review this Privacy Policy periodically.</p>\r\n<h2 dir=\"ltr\">Contact Us</h2>\r\n<p dir=\"ltr\">If you have any questions or concerns about this Privacy Policy or how we handle your personal data, please contact us at:</p>\r\n<p dir=\"ltr\">NepState LLC<br>Email: info@nepstate.com</p>', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'privacy-policy', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(2, 0, 0, 'Cookie Policy', '<h2 data-pm-slice=\"1 1 []\">Cookie Policy</h2>\r\n<p>Nepstate (\"we,\" \"our,\" \"us\") uses basic, essential cookies to ensure our website functions properly and provides a smooth browsing experience.</p>\r\n<h3>&nbsp;</h3>\r\n<h3>1. What Are Cookies?</h3>\r\n<p>Cookies are small text files placed on your device when you visit a website. They help the site recognize your device for basic functionality.</p>\r\n<p>&nbsp;</p>\r\n<h3>2. How We Use Cookies</h3>\r\n<p>We use essential cookies to:</p>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>Ensure the website loads and operates correctly.</p>\r\n</li>\r\n<li>\r\n<p>Enhance basic functionality and user experience.</p>\r\n</li>\r\n</ul>\r\n<p>We do not use cookies to collect personal data, track users, or for advertising purposes.</p>\r\n<p>&nbsp;</p>\r\n<h3>3. Managing Cookies</h3>\r\n<p>Since we only use essential cookies, they cannot be disabled through our site. However, you can control and manage cookies through your browser settings.</p>\r\n<p>&nbsp;</p>\r\n<h3>4. Changes to This Policy</h3>\r\n<p>We may update this policy from time to time. Any changes will be posted on this page.</p>\r\n<p>&nbsp;</p>\r\n<h3>5. Contact Us</h3>\r\n<p>For any questions regarding this policy, please contact us at <a>info@nepstate.com</a>.</p>\r\n<p>&nbsp;</p>', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'cookie-policy', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(3, 0, 0, 'Terms & Conditions', '<h1 dir=\"ltr\">Terms and Conditions</h1>\r\n<p dir=\"ltr\">This Terms of Service Agreement (\"Agreement\") is a legal contract between you (the user of NepState\'s website, mobile application, and services) and NepState LLC (\"NepState,\" \"we,\" \"our,\" or \"us\"). By accessing or using NepState&rsquo;s website, mobile app, and services (collectively referred to as the \"Site,\" \"App,\" and \"Services\"), you agree to comply with and be legally bound by these Terms.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Scope of Agreement</h1>\r\n<p dir=\"ltr\">This Agreement governs all access and use of the Site, App, and Services, whether via a browser, mobile app, or any other access method. It applies to all services provided, including but not limited to: browsing, creating an account, posting content, making purchases, or engaging in any other activities on NepState\'s platforms. By using the Site, App, or Services, you confirm that you have read, understood, and agreed to these Terms. If you disagree with any terms, you should immediately stop using the Site, App, or Services.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Definitions</h1>\r\n<p dir=\"ltr\">For clarity, the following definitions apply throughout this Agreement:<br><br>- \"Site\": Refers to NepState\'s official website located at nepstate.com, including any and all pages and features accessible via this domain.<br>- \"App\": Refers to the NepState mobile application, downloadable from official app stores, and includes all associated pages and features of the App.<br>- \"Services\": All products, services, tools, or features offered through the Site and App, including transactions between users, the ability to post or interact with content, use marketplaces, etc.<br>- \"User Account\": A unique profile created by a user to access personalized features of the Site, App, and Services.<br>- \"Consumer\": A user of the Site or App who purchases or utilizes services or products offered by a Provider.<br>- \"Provider\": A user who offers products or services for sale or exchange on the Site or App.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Agreement Acceptance</h1>\r\n<p dir=\"ltr\">By using the Site, App, or Services, you agree to these Terms and any additional policies incorporated herein. Any violations of these Terms could result in the termination of your access to the Site or Services.<br><br>- Modification of Terms: NepState reserves the right to amend, modify, or update these Terms of Service at any time. Updates will be posted on the Site or App, and any such updates will be effective immediately upon publication. You are responsible for reviewing these Terms periodically to ensure you remain in compliance.<br><br>- Notice of Changes: While NepState will attempt to notify you of material changes (via email or notifications within the Site or App), it is ultimately your responsibility to review these changes. Continued use of the Site or Services after modifications signifies your acceptance of the revised Terms.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Eligibility</h1>\r\n<p dir=\"ltr\">The Site, App, and Services are only available to individuals who meet the following criteria:<br><br>- Age Requirement: You must be at least 18 years old or the legal age of majority in your jurisdiction to use the Site, App, and Services.<br>- Legal Capacity: By using the Site or App, you represent and warrant that you have the legal capacity to form a binding contract and comply with these Terms.<br>- Jurisdictional Compliance: If you are located in a jurisdiction that imposes restrictions on access to online platforms, it is your responsibility to ensure that you are in compliance with local laws.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Privacy Policy and Data Usage</h1>\r\n<p dir=\"ltr\">NepState values your privacy. The collection, use, and disclosure of your personal data are governed by NepState&rsquo;s Privacy Policy, which is incorporated into these Terms. This includes, but is not limited to:<br><br>- Data Collection: We collect personal information such as name, email address, payment details, and device data to provide and improve the Services.<br>- Global Compliance: NepState complies with major international data protection regulations, including the General Data Protection Regulation (GDPR) for users in the EU, California Consumer Privacy Act (CCPA) for users in California, and Canadian Personal Information Protection and Electronic Documents Act (PIPEDA) for Canadian users.<br>- Canada (PIPEDA Compliance): Users in Canada are entitled to request access to their personal data, and NepState ensures that data is collected, stored, and used in compliance with PIPEDA, including obtaining consent before collecting sensitive information.<br>- Maryland Compliance: In accordance with the Maryland Personal Information Protection Act (PIPA), NepState ensures that reasonable security measures are in place to protect your personal data. In the event of a data breach affecting Maryland residents, NepState will notify users in compliance with PIPA.<br>- Data Retention: We retain your data only for as long as necessary to fulfill the purposes for which it was collected or as required by law. You have the right to request deletion of your personal information, subject to legal constraints.<br>- Data Sharing: Your personal data may be shared with trusted third-party service providers, such as payment processors or hosting providers, for operational purposes. We do not sell your personal data to third parties.<br>- Security: NepState employs industry-standard security practices to protect personal data but cannot guarantee absolute security. You agree to use the Services responsibly to protect your data.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Description of Services</h1>\r\n<p dir=\"ltr\">NepState provides a platform for Consumers to connect with Providers. The Services include, but are not limited to:<br><br>- Marketplaces: A digital marketplace where Consumers can browse and purchase products and services from Providers.<br>- User Interactions: The ability for Consumers to rate Providers, post reviews, and interact with other users regarding transactions and services.<br>- Tools and Resources: Additional features provided for transaction processing, customer support, and communication between users.<br><br>NepState does not directly sell or provide products or services but acts solely as a facilitator for interactions between Consumers and Providers.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">User Accounts and Responsibilities</h1>\r\n<p dir=\"ltr\">To access certain features of the Site or App, you must create a User Account. When you create an account, you agree to the following:<br><br>- Accurate Information: You must provide accurate, current, and complete information when creating your User Account and maintain the accuracy of that information.<br>- Account Security: You are responsible for maintaining the confidentiality of your account credentials. Any unauthorized use of your account should be reported to NepState immediately.<br>- Access Restrictions: Your account is non-transferable and should not be shared with others.<br><br>NepState reserves the right to suspend or terminate your account if any of the information you provide is false, inaccurate, or violates these Terms.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Payments and Fees</h1>\r\n<p dir=\"ltr\">NepState charges fees for certain Services, such as listing ads or premium features. When using paid features, you agree to the following:<br><br>- Payment Methods: Payment is processed through third-party vendors such as PayPal, Stripe, and other payment processors.<br>- Refunds: Payments made for services are final, except in cases where NepState fails to fulfill its obligations or in case of system errors.<br>- Maryland Consumer Protection: In accordance with the Maryland Consumer Protection Act (CPA), Maryland consumers are entitled to a refund, replacement, or repair if the product or service is defective or not as described. Consumers are entitled to return goods within 15 days of purchase if they are faulty or do not meet expectations.<br>- Taxes: You are responsible for any applicable taxes, duties, or fees associated with your transactions.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Content Ownership and License</h1>\r\n<p dir=\"ltr\">You retain ownership of any content you upload to the Site or App. However, by submitting content, you grant NepState the following rights:<br><br>- License: A worldwide, royalty-free, perpetual, transferable license to use, modify, distribute, and display your content.<br>- Indemnity: You agree that any content you submit will not infringe on any third-party intellectual property rights and you indemnify NepState from any related claims.<br><br>Once submitted, content may be publicly available and can be shared, displayed, and modified by NepState as part of the Services.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Prohibited Activities</h1>\r\n<p dir=\"ltr\">You agree not to engage in the following activities:<br><br>- Illegal Content: Posting content that violates any applicable law, including fraud, harassment, or defamation.<br>- Harmful Activities: Disrupting the operations of the platform through hacking, uploading viruses, or engaging in malicious activities.<br>- Misleading Representations: Impersonating other users or misrepresenting your affiliation with NepState.<br><br>Any violation will result in the immediate suspension or termination of your account, as well as potential legal action.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Dispute Resolution and Arbitration</h1>\r\n<p dir=\"ltr\">In case of a dispute, both Parties agree to resolve disputes through binding arbitration instead of litigation. The arbitration will be conducted by Judicial Arbitration and Mediation Services, Inc. (JAMS) in accordance with its rules.<br><br>- Arbitration Location: The arbitration will occur in Frederick, Maryland.<br>- Arbitration Fees: Costs of arbitration will be shared equally between both Parties, with the prevailing Party entitled to recover fees as permitted by law.<br><br>For Maryland Residents: Any disputes arising from these Terms shall be resolved through binding arbitration in compliance with the Maryland Arbitration Act, and arbitration will be conducted in Maryland.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Limitation of Liability</h1>\r\n<p dir=\"ltr\">NepState\'s liability for any damages, including but not limited to, indirect, incidental, or punitive damages, is limited to the amount you have paid to NepState in the last six (6) months preceding the claim.<br><br>- Exclusion of Liability: NepState is not liable for any damages arising from the use or inability to use the Services, including any loss of data, profits, or business interruption.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Termination and Suspension</h1>\r\n<p dir=\"ltr\">NepState reserves the right to suspend or terminate your account and access to the Site or App for violations of these Terms.<br><br>- For Cause: This includes fraud, illegal activity, or other activities that disrupt the platform or harm other users.<br>- User-Initiated Termination: You may terminate your account by contacting NepState support, subject to the applicable cancellation terms.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Consumer Protection and Refunds</h1>\r\n<p dir=\"ltr\">NepState is committed to complying with all consumer protection laws. If you are a Consumer, you may request refunds under specific conditions, such as product defects or system failures attributable to NepState.<br><br>- Cooling-Off Period: In compliance with applicable laws, you may have a 14-day cooling-off period during which you can cancel certain services without penalty.<br>- Refunds: Refunds will be issued when a service is not rendered as described or if an error occurs during payment processing.<br><br>In accordance with the Maryland Consumer Protection Act (CPA), Maryland consumers are entitled to a refund, replacement, or repair if the product is defective or not as described. Consumers are entitled to return goods within 15 days of purchase if they are faulty or do not meet expectations.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Intellectual Property Protection</h1>\r\n<p dir=\"ltr\">NepState respects intellectual property rights and complies with relevant copyright laws.<br><br>- DMCA Compliance: NepState adheres to the Digital Millennium Copyright Act (DMCA) and will respond to notices of alleged copyright infringement. Users can submit claims to info@nepstate.com.<br>- Third-Party Content: NepState is not responsible for any content uploaded by users or third parties that may infringe on intellectual property rights.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Children&rsquo;s Privacy</h1>\r\n<p dir=\"ltr\">NepState does not knowingly collect personal information from children under 13 years old. If a parent or guardian believes that their child has provided personal data, they should contact NepState immediately for removal.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h1 dir=\"ltr\">Jurisdiction and Governing Law</h1>\r\n<p dir=\"ltr\">This Agreement is governed by the laws of the State of Maryland. Any disputes not resolved through arbitration will be handled by courts in Maryland, which have exclusive jurisdiction.<br><br>For Maryland residents, disputes will be resolved under the Maryland Arbitration Act, and arbitration will be conducted in Maryland.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h2 dir=\"ltr\">Terms of Service &ndash; Business Listings</h2>\r\n<p>&nbsp;</p>\r\n<h3 dir=\"ltr\">1. Business Listings on Nepstate</h3>\r\n<p dir=\"ltr\">1.1 Public Information Usage<br>Nepstate creates business listings using publicly available information, including business name, address, phone number, and email. These details are collected from sources such as public directories, websites, and social media.</p>\r\n<p dir=\"ltr\">1.2 Account Creation &amp; Email Verification<br>When a business is listed on Nepstate, an account is created using the business&rsquo;s publicly available email. This ensures that the business owner or an authorized representative can claim and manage the listing by verifying the email address associated with the business.</p>\r\n<p dir=\"ltr\">1.3 Claiming Your Business<br>Once a listing is created, the business will receive an email containing a verification link. The business owner must verify their email to gain full control over their profile. This allows them to update business details, add promotions, and access additional features.</p>\r\n<p dir=\"ltr\">1.4 Unverified Listings<br>If a business does not verify its listing, the profile will remain visible on Nepstate with the publicly available information. However, only verified businesses can edit or manage their listings.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h3 dir=\"ltr\">2. Business Rights &amp; Removal Requests</h3>\r\n<p dir=\"ltr\">2.1 Opting Out / Requesting Removal<br>Businesses have the right to request removal from Nepstate if they do not wish to be listed. To request removal, business owners can reply to the listing notification email or contact our support team at [Support Email]. Removal requests will be processed within [X] business days.</p>\r\n<p dir=\"ltr\">2.2 Updating or Modifying Business Listings<br>If any information is incorrect or outdated, businesses can update their details by claiming their listing and modifying their profile. If a business prefers not to claim the listing but wants to correct the information, they may contact Nepstate support with the requested changes.</p>\r\n<p dir=\"ltr\">&nbsp;</p>\r\n<h3 dir=\"ltr\">3. Compliance &amp; Legal Considerations</h3>\r\n<p dir=\"ltr\">3.1 No Unauthorized Access<br>Nepstate does not access, modify, or use business emails for any purpose other than sending business listing notifications, verification emails, and essential service updates. Nepstate does not have access to business email inboxes, nor does it create passwords on behalf of businesses.</p>\r\n<p dir=\"ltr\">3.2 Spam Compliance<br>Nepstate complies with email marketing laws, including CAN-SPAM, GDPR, and CCPA where applicable. Businesses can unsubscribe from non-essential emails at any time by clicking the &ldquo;Unsubscribe&rdquo; link in the email or contacting support.</p>\r\n<p dir=\"ltr\">3.3 Liability Disclaimer<br>Nepstate provides business listings as a public service and does not guarantee the accuracy of information retrieved from external sources. Businesses are responsible for verifying and maintaining their own listings. Nepstate is not responsible for any damages or claims arising from incorrect or outdated information displayed on its platform.</p>\r\n<h2>&nbsp;</h2>', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'terms-conditions', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(4, 0, 0, 'Connecting Nepalese Globally with NepState', '<p>Welcome to <strong>NepState</strong>, a platform dedicated to empowering the Nepalese community and fostering connections worldwide. Whether you&rsquo;re an entrepreneur looking to promote your business, an individual seeking opportunities, or someone wanting to engage with a like-minded community, NepState is here to support you.</p>\r\n<h4><strong>Our Mission</strong></h4>\r\n<p>At NepState, we strive to:</p>\r\n<ul>\r\n<li><strong>Promote Nepalese Businesses</strong>: Provide a dedicated space for Nepalese businesses to showcase their offerings and grow within a supportive community.</li>\r\n<li><strong>Strengthen Community Connections</strong>: Build a global Nepalese network where people can share opportunities, culture, and resources.</li>\r\n<li><strong>Foster Opportunities</strong>: Empower individuals and businesses with tools to connect, grow, and thrive together.</li>\r\n</ul>\r\n<h4><strong>What NepState Offers</strong></h4>\r\n<p>NepState is a comprehensive platform designed to meet the needs of the Nepalese community. Our key offerings include:</p>\r\n<ul>\r\n<li>\r\n<p><strong>Business Listings</strong>: Promote and grow your business through our platform. Categories include:</p>\r\n<ul>\r\n<li><strong>Events</strong>: Advertise cultural and community events to bring people together.</li>\r\n<li><strong>Jobs</strong>: Share job opportunities or find your next career move within the Nepalese network.</li>\r\n<li><strong>Services</strong>: Offer or find professional services from trusted members of the community.</li>\r\n<li><strong>IT Trainings</strong>: Create or access training programs tailored to help Nepalese professionals excel.</li>\r\n<li><strong>Roommates and Rentals</strong>: Connect with others looking for roommates or rental spaces.</li>\r\n</ul>\r\n</li>\r\n<li>\r\n<p><strong>Blogs</strong>: Share stories, experiences, and expertise to inspire and connect with the Nepalese community worldwide.</p>\r\n</li>\r\n<li>\r\n<p><strong>Forums</strong>: Participate in discussions about Nepalese culture, businesses, travel, and more.</p>\r\n</li>\r\n<li>\r\n<p><strong>Confessions</strong>: A safe, anonymous space to share thoughts and feelings.</p>\r\n</li>\r\n<li>\r\n<p><strong>Dedicated Ads Section</strong>: Highlight your company&rsquo;s products or services to a targeted Nepalese audience.</p>\r\n</li>\r\n</ul>\r\n<h4><strong>Why Choose NepState?</strong></h4>\r\n<ul>\r\n<li><strong>Nepalese-Focused</strong>: A platform tailored to celebrate and promote the Nepalese community and businesses.</li>\r\n<li><strong>Global Network</strong>: Connect with Nepalese individuals and businesses across the globe.</li>\r\n<li><strong>Community Empowerment</strong>: Designed to uplift and grow a strong Nepalese circle.</li>\r\n<li><strong>Easy to Use</strong>: A user-friendly platform with tools and resources to help you succeed.</li>\r\n</ul>\r\n<h4><strong>Join NepState Today!</strong></h4>\r\n<p>Be part of a thriving global Nepalese community. Whether you&rsquo;re here to grow your business, share your culture, or connect with others, NepState is your partner in building a bigger and stronger Nepalese circle.</p>', 'https://admin.nepstate.com/images/1737007429_image.png', 'https://admin.nepstate.com/images/1737007717_image_2.jpg', 'https://admin.nepstate.com/images/1737006975_image_3.jpg', NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'about-us', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(5, 0, 0, 'Refunds Policy', '<h2 data-pm-slice=\"1 1 []\">Refund Policy</h2>\r\n<p><strong>Effective Date:</strong> [Insert Date]</p>\r\n<p>At Nepstate, we strive to provide quality services. However, due to the nature of our digital offerings, refunds are subject to the following conditions:</p>\r\n<h3>1. Digital Services</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>All sales for digital services (e.g., listings, ads) are <strong>final</strong> once the service is delivered.</p>\r\n</li>\r\n<li>\r\n<p>No refunds will be issued for completed and activated services.</p>\r\n</li>\r\n</ul>\r\n<h3>2. Error or Duplicate Payments</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>If you have been charged in error or made a duplicate payment, please contact us immediately. Eligible refunds will be processed within 10 business days.</p>\r\n</li>\r\n</ul>\r\n<h3>3. Refund Processing</h3>\r\n<ul data-spread=\"false\">\r\n<li>\r\n<p>Approved refunds will be processed using the original payment method within 10 business days.</p>\r\n</li>\r\n</ul>\r\n<h3>4. Contact Us</h3>\r\n<p>If you have questions about our refund policy or need assistance, please contact us at:<br><strong>Email:</strong> <a>info@nepstate.com</a></p>', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'refunds-policy', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(6, 0, 0, 'Sales Terms', '<h2 data-start=\"293\" data-end=\"318\"><strong data-start=\"296\" data-end=\"318\">Sales Terms Policy</strong></h2>\r\n<p data-start=\"357\" data-end=\"483\">By purchasing services from Nepstate (\"we,\" \"our,\" \"us\"), you (\"customer,\" \"you\") agree to the following terms and conditions.</p>\r\n<hr data-start=\"485\" data-end=\"488\">\r\n<h3 data-start=\"490\" data-end=\"519\"><strong data-start=\"494\" data-end=\"517\">1. Services Offered</strong></h3>\r\n<p data-start=\"520\" data-end=\"580\">We provide digital services, including but not limited to:</p>\r\n<ul data-start=\"581\" data-end=\"702\">\r\n<li data-start=\"581\" data-end=\"634\">Listings for jobs, services, rentals, and events.</li>\r\n<li data-start=\"635\" data-end=\"662\">IT Business Listings services.</li>\r\n<li data-start=\"663\" data-end=\"702\">Advertising and marketing services.</li>\r\n</ul>\r\n<hr data-start=\"704\" data-end=\"707\">\r\n<h3 data-start=\"709\" data-end=\"735\"><strong data-start=\"713\" data-end=\"733\">2. Payment Terms</strong></h3>\r\n<ul data-start=\"736\" data-end=\"1058\">\r\n<li data-start=\"736\" data-end=\"838\">All payments must be made in full at the time of purchase unless otherwise agreed upon in writing.</li>\r\n<li data-start=\"839\" data-end=\"926\">Payments are accepted via Apple pay, Google Pay, Stripe supporting payments.</li>\r\n<li data-start=\"927\" data-end=\"1004\">Prices are listed in native country currency and are subject to change without notice.</li>\r\n<li data-start=\"1005\" data-end=\"1058\">Customers are responsible for any applicable taxes.</li>\r\n</ul>\r\n<hr data-start=\"1060\" data-end=\"1063\">\r\n<h3 data-start=\"1065\" data-end=\"1094\"><strong data-start=\"1069\" data-end=\"1092\">3. Service Delivery</strong></h3>\r\n<ul data-start=\"1095\" data-end=\"1330\">\r\n<li data-start=\"1095\" data-end=\"1159\">Digital services are delivered upon confirmation of payment.</li>\r\n<li data-start=\"1160\" data-end=\"1243\">Consulting services will be provided as per the agreement made with the client.</li>\r\n<li data-start=\"1244\" data-end=\"1330\">Listing services will be activated right away after payment confirmation.</li>\r\n</ul>\r\n<hr data-start=\"1332\" data-end=\"1335\">\r\n<h3 data-start=\"1337\" data-end=\"1380\"><strong data-start=\"1341\" data-end=\"1378\">4. Refund and Cancellation Policy</strong></h3>\r\n<ul data-start=\"1381\" data-end=\"1765\">\r\n<li data-start=\"1381\" data-end=\"1523\"><strong data-start=\"1383\" data-end=\"1404\">Digital Services:</strong> Due to the nature of digital products, all sales are final. No refunds will be issued once the service is delivered.</li>\r\n<li><strong data-start=\"1687\" data-end=\"1708\">Listings and Ads:</strong> Once a listing or ad goes live, it cannot be refunded.</li>\r\n</ul>\r\n<hr data-start=\"1767\" data-end=\"1770\">\r\n<h3 data-start=\"1772\" data-end=\"1810\"><strong data-start=\"1776\" data-end=\"1808\">5. Customer Responsibilities</strong></h3>\r\n<ul data-start=\"1811\" data-end=\"1994\">\r\n<li data-start=\"1811\" data-end=\"1912\">Customers are responsible for providing accurate information for listings or ads.</li>\r\n<li data-start=\"1913\" data-end=\"1994\">Nepstate is not responsible for incorrect information provided by the customer.</li>\r\n</ul>\r\n<hr data-start=\"1996\" data-end=\"1999\">\r\n<h3 data-start=\"2001\" data-end=\"2037\"><strong data-start=\"2005\" data-end=\"2035\">6. Limitation of Liability</strong></h3>\r\n<ul data-start=\"2038\" data-end=\"2228\">\r\n<li data-start=\"2038\" data-end=\"2157\">Nepstate is not liable for any indirect, incidental, or consequential damages arising from the use of our services.</li>\r\n<li data-start=\"2158\" data-end=\"2228\">Our maximum liability is limited to the amount paid for the service.</li>\r\n</ul>\r\n<hr data-start=\"2230\" data-end=\"2233\">\r\n<h3 data-start=\"2235\" data-end=\"2264\"><strong data-start=\"2239\" data-end=\"2262\">7. Changes to Terms</strong></h3>\r\n<p data-start=\"2265\" data-end=\"2421\">We may update these terms from time to time. Changes will be posted on this page, and continued use of our services implies acceptance of the updated terms.</p>\r\n<hr data-start=\"2423\" data-end=\"2426\">\r\n<h3 data-start=\"2428\" data-end=\"2451\"><strong data-start=\"2432\" data-end=\"2449\">8. Contact Us</strong></h3>\r\n<p data-start=\"2452\" data-end=\"2534\">For questions regarding these terms, contact us at:<br data-start=\"2503\" data-end=\"2506\"><strong data-start=\"2506\" data-end=\"2516\">Email:</strong> <a rel=\"noopener\" data-start=\"2517\" data-end=\"2534\">info@nepstate.com</a></p>', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'sales-terms', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1');

-- --------------------------------------------------------

--
-- Table structure for table `pages__`
--

CREATE TABLE `pages__` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `descriptions` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `by_default_banner` tinyint(1) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `slug` text NOT NULL,
  `w_image` varchar(255) DEFAULT 'dummy_image.png',
  `show_sections` varchar(255) DEFAULT '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pages__`
--

INSERT INTO `pages__` (`id`, `lparent`, `lang_id`, `title`, `descriptions`, `image`, `by_default_banner`, `meta_title`, `meta_keywords`, `meta_description`, `status`, `ip`, `created_at`, `updated_at`, `is_deleted`, `created_by`, `updated_by`, `deleted_by`, `slug`, `w_image`, `show_sections`) VALUES
(1, 0, 0, 'Privacy Policy', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'privacy-policy', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(2, 0, 0, 'Cookie Policy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'cookie-policy', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(3, 0, 0, 'Terms & Conditions', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'terms-conditions', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1'),
(4, 0, 0, 'About Us', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 0, NULL, NULL, NULL, 1, NULL, '', NULL, 0, NULL, NULL, NULL, 'about-us', 'dummy_image.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1');

-- --------------------------------------------------------

--
-- Table structure for table `payment_plans`
--

CREATE TABLE `payment_plans` (
  `id` int(11) NOT NULL,
  `cID` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `months` int(11) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(255) DEFAULT NULL,
  `category_home_page` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT 'AD#4',
  `website_home_category_section` decimal(20,2) NOT NULL DEFAULT 0.00,
  `website_home_banner` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT 'AD#1',
  `home_middle` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT 'AD#2',
  `web_footer` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT 'AD#3',
  `blog` decimal(20,2) NOT NULL DEFAULT 0.00 COMMENT 'AD#6',
  `cat_right` decimal(20,2) NOT NULL DEFAULT 16.66 COMMENT 'AD#5',
  `confession` decimal(20,2) NOT NULL DEFAULT 13.13 COMMENT 'AD#8',
  `forum` decimal(20,2) NOT NULL DEFAULT 14.14 COMMENT 'AD#7',
  `free_listings_count` int(11) DEFAULT NULL,
  `is_free_plan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_plans`
--

INSERT INTO `payment_plans` (`id`, `cID`, `title`, `months`, `amount`, `status`, `created_at`, `category_home_page`, `website_home_category_section`, `website_home_banner`, `home_middle`, `web_footer`, `blog`, `cat_right`, `confession`, `forum`, `free_listings_count`, `is_free_plan`) VALUES
(1, '1,2,3,4,5', 'Listing Basic Plan  $6.99', 1, 6.99, 1, NULL, 39.99, 0.00, 49.99, 29.99, 25.99, 35.99, 15.99, 35.99, 35.99, NULL, 0),
(2, '1,2,3,4,5', 'Listing Silver plan  $16.99', 3, 16.99, 1, NULL, 95.99, 0.00, 119.99, 69.99, 59.99, 85.99, 39.99, 85.99, 85.99, NULL, 0),
(3, '1,2,3,4,5', 'Listing Gold Plan  $29.99', 6, 29.99, 1, NULL, 165.99, 0.00, 209.99, 125.99, 109.99, 149.99, 65.99, 149.99, 149.99, NULL, 0),
(4, '1,2,3,4,5', 'Listing Platinum Plan  $35.99', 9, 35.99, 1, NULL, 215.99, 0.00, 269.99, 159.99, 139.99, 195.99, 85.99, 195.99, 195.99, NULL, 0),
(5, '1,2,3,4,5', 'Listing Diamond plan  $41.99', 12, 41.99, 1, NULL, 239.99, 0.00, 299.99, 179.99, 155.99, 215.99, 95.99, 215.99, 215.99, NULL, 0),
(9, '', 'Free', 1, 0.00, 1, NULL, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 1.00, 3, 1),
(11, '1,2,3,4,5', 'Promote your Business for FREE on NepState for', 2, 0.00, 1, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0),
(12, '1,2,3,4,5', 'Ad Starter  (Entry-level exposure)', 1, 0.01, 1, NULL, 39.99, 0.00, 49.99, 29.99, 25.99, 35.99, 15.99, 35.99, 35.99, NULL, 0),
(13, '1,2,3,4,5', 'Ad Silver Boost (Enhanced reach)', 3, 0.01, 1, NULL, 95.99, 0.00, 119.99, 69.99, 59.99, 85.99, 39.99, 85.99, 85.99, NULL, 0),
(14, '1,2,3,4,5', 'Ad Gold Spotlight (Premium placement)', 6, 0.01, 1, NULL, 165.99, 0.00, 209.99, 125.99, 109.99, 149.99, 65.99, 149.99, 149.99, NULL, 0),
(15, '1,2,3,4,5', 'Ad Platinum Power (High-impact advertising)', 9, 0.01, 1, NULL, 215.99, 0.00, 269.99, 159.99, 139.99, 195.99, 85.99, 195.99, 195.99, NULL, 0),
(16, '1,2,3,4,5', 'Ad Diamond Elite (Exclusive top-tier exposure)', 12, 0.01, 1, NULL, 239.99, 0.00, 299.99, 179.99, 155.99, 215.99, 95.99, 215.99, 215.99, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `uID` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `json_content` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_cat` varchar(255) DEFAULT NULL,
  `sub_inner` varchar(155) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(255) NOT NULL,
  `schedule` int(11) NOT NULL DEFAULT 0,
  `schedule_time` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `plan_id` int(11) NOT NULL DEFAULT 0,
  `sub_plan_id` varchar(255) DEFAULT NULL,
  `payment_done` int(11) NOT NULL DEFAULT 0,
  `payment_object` text DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `amount_paid` decimal(20,2) NOT NULL DEFAULT 0.00,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `clicks` double NOT NULL DEFAULT 0,
  `payment_status` varchar(255) DEFAULT 'pending',
  `stripe_transaction_id` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `uID`, `title`, `json_content`, `category`, `sub_cat`, `sub_inner`, `slug`, `status`, `created_at`, `schedule`, `schedule_time`, `views`, `plan_id`, `sub_plan_id`, `payment_done`, `payment_object`, `expiry_date`, `amount_paid`, `latitude`, `longitude`, `city`, `state`, `zip_code`, `country`, `country_id`, `city_id`, `clicks`, `payment_status`, `stripe_transaction_id`) VALUES
(5, 20, 'CAFEMANDU - Flavors of Nepal', '{\"is_free_plan\":\"1\",\"category\":\"services\",\"subcategory\":\"restaurant-catering\",\"other_cat\":\"\",\"title\":\"CAFEMANDU - Flavors of Nepal\",\"business_name\":\"CAFEMANDU - Flavors of Nepal\",\"address\":\"3711 N Belt Line Rd, Irving, TX, USA\",\"latitude\":\"32.8575951\",\"longitude\":\"-96.99282889999999\",\"city\":\"Irving\",\"state\":\"Texas\",\"zip_code\":\"75038\",\"country\":\"United States\",\"contact_name\":\"CAFEMANDU\",\"contact_email\":\"flavorsofnepal@gmail.com\",\"contact_number\":\"(469)-647-5067\",\"business_website\":\"https:\\/\\/www.cafemanduirving.com\\/\",\"service_name\":\"Restaurant \",\"tags\":\"\",\"service_tags\":\"Nepalirestaurant,nepali,restaurant\",\"service_category\":\"Restaurant \",\"year_in_business\":\"0\",\"work_hours\":[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"description\":\"\",\"plan\":\"11\",\"coupon_code\":\"\",\"plan_amount\":\"0\",\"sub_plan_amount\":\"0\",\"is_coupon_apply\":\"0\"}', 'services', 'restaurant-catering', NULL, 'cafemandu--flavors-of-nepal', 1, '2025-03-18 20:46:06', 0, NULL, 0, 11, NULL, 1, '', '2025-05-17', 0.00, '32.8575951', '-96.99282889999999', 'Irving', 'Texas', '75038', 'United States', 1, NULL, 9, 'completed', NULL),
(6, 21, 'Bara Nepalese Restaurant and Bar', '{\"is_free_plan\":\"1\",\"category\":\"services\",\"subcategory\":\"restaurant-catering\",\"other_cat\":\"\",\"title\":\"Bara Nepalese Restaurant and Bar\",\"business_name\":\"Bara Nepalese Restaurant and Bar\",\"address\":\"1201 W Airport Fwy Suit#115, Euless, TX, 76040\",\"latitude\":\"\",\"longitude\":\"\",\"city\":\"\",\"state\":\"\",\"zip_code\":\"\",\"country\":\"\",\"contact_name\":\"Bara Nepalese Restaurant and Bar\",\"contact_email\":\"baraktchen@gmail.com\",\"contact_number\":\"(682)-503-6223\",\"business_website\":\"https:\\/\\/baraeuless.com\\/\",\"service_name\":\"Restaurant \",\"tags\":\"\",\"service_tags\":\"Restaurant,nepali,nepalirestaurant,bara\",\"service_category\":\"Restaurant \",\"year_in_business\":\"1\",\"work_hours\":[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"description\":\"\",\"plan\":\"11\",\"coupon_code\":\"\",\"plan_amount\":\"0\",\"sub_plan_amount\":\"0\",\"is_coupon_apply\":\"0\"}', 'services', 'restaurant-catering', NULL, 'bara-nepalese-restaurant-and-bar', 1, '2025-03-18 21:12:26', 0, NULL, 0, 11, NULL, 1, '', '2025-05-17', 0.00, '', '', '', '', '', '', 1, NULL, 7, 'completed', NULL),
(7, 22, 'Everest Kitchen', '{\"is_free_plan\":\"0\",\"category\":\"services\",\"subcategory\":\"restaurant-catering\",\"other_cat\":\"\",\"title\":\"Everest Kitchen\",\"business_name\":\"Everest Kitchen\",\"address\":\"1150 Solano Ave, Albany, CA 94706, USA\",\"latitude\":\"37.8901687\",\"longitude\":\"-122.2974149\",\"city\":\"Albany\",\"state\":\"California\",\"zip_code\":\"94706\",\"country\":\"United States\",\"contact_name\":\"Everest Kitchen\",\"contact_email\":\"Everestkitchenca@gmail.com\",\"contact_number\":\"(510)-679-5079\",\"business_website\":\"\",\"service_name\":\"Restaurant \",\"tags\":\"\",\"service_tags\":\"Restaurant,nepali,nepal\",\"service_category\":\"Restaurant \",\"year_in_business\":\"1\",\"work_hours\":[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\",\"Saturday\",\"Sunday\"],\"description\":\"\"}', 'services', 'restaurant-catering', NULL, 'everest-kitchen', 1, '2025-03-18 23:18:20', 0, NULL, 0, 11, NULL, 1, '', '2025-05-17', 0.00, '37.8901687', '-122.2974149', 'Albany', 'California', '94706', 'United States', 1, NULL, 1, 'completed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_ads`
--

CREATE TABLE `products_ads` (
  `id` int(11) NOT NULL,
  `ad_for` varchar(255) DEFAULT NULL,
  `ad_location` varchar(255) DEFAULT NULL,
  `created_at` varchar(155) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `link` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `uID_pID` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `ad_expires` varchar(100) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 0,
  `payment_status` varchar(50) DEFAULT 'pending',
  `stripe_transaction_id` text DEFAULT NULL,
  `payment_object` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_ads`
--

INSERT INTO `products_ads` (`id`, `ad_for`, `ad_location`, `created_at`, `status`, `link`, `image`, `uID_pID`, `category`, `user_id`, `ad_expires`, `country_id`, `city_id`, `plan_id`, `payment_status`, `stripe_transaction_id`, `payment_object`) VALUES
(8, 'category_home_page', NULL, '2025-03-07', 1, 'https://nepstate.com/', 'https://nepstate.com/resources/uploads/classified-listing/d1a34972db04b476228e9c3e0f2497a1.png', 0, 'events', 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3QzszoRpAAuqajri04eDJCu3', '{\"id\":\"cs_test_a1MB0pLbMevqDEJIZDzUFU1h0ppvS9o2CsFBSSHevwIYEkry73c26rP7m5\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":24473,\"amount_total\":24473,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=8\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741323512,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741409911,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3QzszoRpAAuqajri04eDJCu3\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=8&&types=category_home_page\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(9, 'category_home_page', NULL, '2025-03-07', 1, 'https://nepstate.com/', 'https://nepstate.com/resources/uploads/classified-listing/83828aaf0651eedf2dfd8fd23c5307e3.png', 0, 'jobs', 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3Qzt32RpAAuqajri0FRvUYeJ', '{\"id\":\"cs_test_a139W1l61rJRbaT28Y1QsurFJNtFmZ7ZxdvjgIbPFrj0nKG3rw0FrEWYht\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":24473,\"amount_total\":24473,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=9\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741323704,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Markel Circle\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410103,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3Qzt32RpAAuqajri0FRvUYeJ\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=9&&types=category_home_page\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(10, 'category_home_page', NULL, '2025-03-07', 1, 'https://nepstate.com/', 'https://nepstate.com/resources/uploads/classified-listing/a60cffad74734bb4f38ac69a7a4e820d.png', 0, 'services', 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3Qzt5QRpAAuqajri0oAIST0o', '{\"id\":\"cs_test_a16yFEk4DeOCKZxLDDUpgJdMwdUPle7cUIXvoLzyGbFzljyT9qV9bPhMI4\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":24473,\"amount_total\":24473,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=10\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741323792,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410192,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3Qzt5QRpAAuqajri0oAIST0o\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=10&&types=category_home_page\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(11, 'category_home_page', NULL, '2025-03-07', 1, 'https://nepstate.com/', 'https://nepstate.com/resources/uploads/classified-listing/7cee7f321d5dc0f8d5e0145056f69e32.png', 0, 'it-trainings', 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3Qzt7GRpAAuqajri17NA2eFW', '{\"id\":\"cs_test_a1zL2salE4zclCkp1xwulP7d3KEEMRgg3R8VICllXvJDnoTdGAFpophTxl\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":24473,\"amount_total\":24473,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=11\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741323978,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410378,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3Qzt7GRpAAuqajri17NA2eFW\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=11&&types=category_home_page\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(12, 'category_home_page', NULL, '2025-03-07', 1, 'https://nepstate.com/', 'https://nepstate.com/resources/uploads/classified-listing/3c60524dcb56cb8179285b01c93ea405.png', 0, 'roomates-rentals', 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3Qzt8NRpAAuqajri1NVgZVPI', '{\"id\":\"cs_test_a1vLsl6GbNB1K40d7RPx2v1bEgM0bLaZE4EhKnH4gycHOfyrLw8fW623a9\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":24473,\"amount_total\":24473,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=12\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741324049,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410449,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3Qzt8NRpAAuqajri1NVgZVPI\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=12&&types=category_home_page\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(13, 'blog', 'top_banner', '2025-03-07', 1, '', 'https://nepstate.com/resources/uploads/classified-listing/d8c4735d9e969421716414c27f550d63.png', 0, NULL, 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3QztAvRpAAuqajri1FF5eLJd', '{\"id\":\"cs_test_a1qbkBHrtO4Epv1P3LHdIRP7KiHk7H1fV0FI0Z7CAg3jPMgOp5vAIb8Rqm\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":66075,\"amount_total\":66075,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=13,14,15\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741324204,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410604,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3QztAvRpAAuqajri1FF5eLJd\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=13,14,15&&types=blog,forum,confession\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(14, 'forum', 'top_banner', '2025-03-07', 1, '', 'https://nepstate.com/resources/uploads/classified-listing/8e2029e1d934d0a563a19bd5c67f9a61.png', 0, NULL, 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3QztAvRpAAuqajri1FF5eLJd', '{\"id\":\"cs_test_a1qbkBHrtO4Epv1P3LHdIRP7KiHk7H1fV0FI0Z7CAg3jPMgOp5vAIb8Rqm\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":66075,\"amount_total\":66075,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=13,14,15\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741324204,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410604,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3QztAvRpAAuqajri1FF5eLJd\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=13,14,15&&types=blog,forum,confession\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(15, 'confession', 'top_banner', '2025-03-07', 1, '', 'https://nepstate.com/resources/uploads/classified-listing/6bee72acfe9b50df3f7d95a3aa422f07.png', 0, NULL, 2, '2026-03-02', 1, NULL, 16, 'completed', 'pi_3QztAvRpAAuqajri1FF5eLJd', '{\"id\":\"cs_test_a1qbkBHrtO4Epv1P3LHdIRP7KiHk7H1fV0FI0Z7CAg3jPMgOp5vAIb8Rqm\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":66075,\"amount_total\":66075,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=13,14,15\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741324204,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741410604,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3QztAvRpAAuqajri1FF5eLJd\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=13,14,15&&types=blog,forum,confession\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}'),
(16, 'website_home_banner', NULL, '2025-03-12', 1, 'https://nepstate.com/promote', 'https://nepstate.com/resources/uploads/classified-listing/78bd4e2a097085e5df0ce5dbe69aa3d1.png', 0, NULL, 2, '2026-03-07', 1, NULL, 16, 'completed', 'pi_3R1eusRpAAuqajri0rCoAiei', '{\"id\":\"cs_test_a1Woau4mKJjiFyoU9ybo8u7ChlBusmirQZ93ivkeXmcrF0GDArYOSsIYce\",\"object\":\"checkout.session\",\"adaptive_pricing\":{\"enabled\":false},\"after_expiration\":null,\"allow_promotion_codes\":null,\"amount_subtotal\":30591,\"amount_total\":30591,\"automatic_tax\":{\"enabled\":true,\"liability\":{\"type\":\"self\"},\"status\":\"complete\"},\"billing_address_collection\":null,\"cancel_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_cancel?ids=16\",\"client_reference_id\":null,\"client_secret\":null,\"collected_information\":null,\"consent\":null,\"consent_collection\":null,\"created\":1741746042,\"currency\":\"usd\",\"currency_conversion\":null,\"custom_fields\":[],\"custom_text\":{\"after_submit\":null,\"shipping_address\":null,\"submit\":null,\"terms_of_service_acceptance\":null},\"customer\":null,\"customer_creation\":\"if_required\",\"customer_details\":{\"address\":{\"city\":\"Frederick\",\"country\":\"US\",\"line1\":\"1206 Marsalis Place\",\"line2\":null,\"postal_code\":\"21702\",\"state\":\"MD\"},\"email\":\"nepstates@gmail.com\",\"name\":\"Vivek Shrestha\",\"phone\":null,\"tax_exempt\":\"none\",\"tax_ids\":[]},\"customer_email\":null,\"discounts\":[],\"expires_at\":1741832442,\"invoice\":null,\"invoice_creation\":{\"enabled\":false,\"invoice_data\":{\"account_tax_ids\":null,\"custom_fields\":null,\"description\":null,\"footer\":null,\"issuer\":null,\"metadata\":[],\"rendering_options\":null}},\"livemode\":false,\"locale\":null,\"metadata\":{\"country\":\"IN\"},\"mode\":\"payment\",\"payment_intent\":\"pi_3R1eusRpAAuqajri0rCoAiei\",\"payment_link\":null,\"payment_method_collection\":\"if_required\",\"payment_method_configuration_details\":null,\"payment_method_options\":{\"card\":{\"request_three_d_secure\":\"automatic\"}},\"payment_method_types\":[\"card\"],\"payment_status\":\"paid\",\"phone_number_collection\":{\"enabled\":false},\"recovered_from\":null,\"saved_payment_method_options\":null,\"setup_intent\":null,\"shipping_address_collection\":null,\"shipping_cost\":null,\"shipping_details\":null,\"shipping_options\":[],\"status\":\"complete\",\"submit_type\":null,\"subscription\":null,\"success_url\":\"https:\\/\\/nepstate.com\\/promotion_payment_success?session_id={CHECKOUT_SESSION_ID}&userid=2&&ids=16&&types=website_home_banner\",\"total_details\":{\"amount_discount\":0,\"amount_shipping\":0,\"amount_tax\":0},\"ui_mode\":\"hosted\",\"url\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `product_c_vars`
--

CREATE TABLE `product_c_vars` (
  `id` int(11) NOT NULL,
  `title_en` text DEFAULT NULL,
  `title_ar` text DEFAULT NULL,
  `options` longtext DEFAULT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `gallery` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `gallery`) VALUES
(9, 5, 'https://nepstate.com/resources/uploads/classified-listing/25031825082531.png', 0),
(10, 6, 'https://nepstate.com/resources/uploads/classified-listing/25031825091215.jpg', 0),
(12, 7, 'https://nepstate.com/resources/uploads/classified-listing/25031825111816.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_units`
--

CREATE TABLE `product_units` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `qty_unit` int(11) NOT NULL DEFAULT 0,
  `price` decimal(20,2) NOT NULL DEFAULT 0.00,
  `vat` decimal(20,2) DEFAULT 0.00,
  `region_id` int(11) NOT NULL DEFAULT 0,
  `cost_price` decimal(20,2) DEFAULT 0.00,
  `did_tap_options` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `sale_title` varchar(70) DEFAULT NULL,
  `sale_subtitle` varchar(80) DEFAULT NULL,
  `sale_banner` varchar(200) DEFAULT NULL,
  `vat` decimal(20,2) DEFAULT 0.00,
  `currency` varchar(20) DEFAULT NULL,
  `hidden` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_title` varchar(150) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_logo_small` varchar(255) DEFAULT NULL,
  `confession_rules` longtext NOT NULL,
  `forum_rules` longtext DEFAULT NULL,
  `paragraph` longtext DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `copy_right` text NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `snapchat` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `map_address` text DEFAULT NULL,
  `color_icon` varchar(100) DEFAULT '#000',
  `color_heading` varchar(100) DEFAULT '#000',
  `color_body` varchar(100) DEFAULT '#fff',
  `slider_time` int(11) DEFAULT 5,
  `style_name` varchar(255) DEFAULT 'style.css?version=new',
  `client_title` varchar(255) DEFAULT NULL,
  `client_logo` varchar(255) DEFAULT NULL,
  `show_email` int(1) NOT NULL DEFAULT 1,
  `show_mobile` int(1) NOT NULL DEFAULT 1,
  `show_fb` int(1) NOT NULL DEFAULT 1,
  `show_tw` int(1) NOT NULL DEFAULT 1,
  `show_li` int(1) NOT NULL DEFAULT 1,
  `show_gp` int(1) NOT NULL DEFAULT 1,
  `show_skype` int(1) NOT NULL DEFAULT 1,
  `show_address` int(11) NOT NULL DEFAULT 0,
  `show_chistmas_popup` int(1) DEFAULT 0,
  `site_favicon` varchar(255) DEFAULT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `currency_ar` varchar(20) DEFAULT NULL,
  `currency_space` int(1) NOT NULL DEFAULT 0,
  `currency_position` int(11) NOT NULL DEFAULT 0,
  `shipping_fee` decimal(20,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(20,2) NOT NULL DEFAULT 0.00,
  `twillio_pub` text DEFAULT NULL,
  `twillio_sec` text DEFAULT NULL,
  `site_title_ar` varchar(200) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `frontend_url` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `footer_about_ar` text DEFAULT NULL,
  `hard_region` int(1) NOT NULL DEFAULT 0,
  `meta_title_en` varchar(255) DEFAULT NULL,
  `meta_title_ar` varchar(255) DEFAULT NULL,
  `meta_desc_en` varchar(255) DEFAULT NULL,
  `meta_desc_ar` varchar(255) DEFAULT NULL,
  `meta_keys_en` varchar(255) DEFAULT NULL,
  `meta_keys_ar` varchar(255) DEFAULT NULL,
  `google_ads` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `event` tinyint(1) DEFAULT NULL COMMENT '0=Not show, 1=show',
  `mainheading` longtext DEFAULT NULL,
  `subheading` longtext DEFAULT NULL,
  `list_view` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Not show, 1=show',
  `no_of_lists` bigint(20) DEFAULT NULL,
  `happy_customers` bigint(20) DEFAULT NULL,
  `visitors` bigint(20) DEFAULT NULL,
  `admin_fees_percentage` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_title`, `site_logo`, `site_logo_small`, `confession_rules`, `forum_rules`, `paragraph`, `mobile`, `email`, `copy_right`, `twitter`, `snapchat`, `instagram`, `facebook`, `linkedin`, `google_plus`, `skype`, `address`, `map_address`, `color_icon`, `color_heading`, `color_body`, `slider_time`, `style_name`, `client_title`, `client_logo`, `show_email`, `show_mobile`, `show_fb`, `show_tw`, `show_li`, `show_gp`, `show_skype`, `show_address`, `show_chistmas_popup`, `site_favicon`, `meta_title`, `meta_keywords`, `meta_description`, `currency`, `currency_ar`, `currency_space`, `currency_position`, `shipping_fee`, `tax`, `twillio_pub`, `twillio_sec`, `site_title_ar`, `youtube`, `frontend_url`, `footer_about`, `footer_about_ar`, `hard_region`, `meta_title_en`, `meta_title_ar`, `meta_desc_en`, `meta_desc_ar`, `meta_keys_en`, `meta_keys_ar`, `google_ads`, `event`, `mainheading`, `subheading`, `list_view`, `no_of_lists`, `happy_customers`, `visitors`, `admin_fees_percentage`) VALUES
(1, 'Nepstates', 'https://admin.nepstate.com/images/logo/1739511638.png', '1714029348.jpg', '<h3><strong>Confession Rules</strong></h3>\r\n<p><strong>Rule 1:</strong> Do not include personally identifiable information (e.g., names, addresses, or contact details).</p>\r\n<p><strong>Rule 2:</strong> Be respectful. Do not use offensive, hateful, or discriminatory language.</p>\r\n<p><strong>Rule 3:</strong> Confessions must not contain content related to illegal activities, explicit material, or harm to oneself or others.</p>\r\n<p><strong>Rule 4:</strong> Do not post false claims, rumors, or fabricated stories.</p>\r\n<p><strong>Rule 5:</strong> Tag sensitive or triggering topics appropriately (e.g., &ldquo;TW: Anxiety&rdquo;).</p>\r\n<p><strong>Rule 6:</strong> Confessions are subject to moderation and may be edited or removed if they violate these rules.</p>\r\n<p><strong>Rule 7:</strong> No spam or promotional content is allowed.</p>\r\n<p><strong>Rule 8:</strong> Post one confession at a time to maintain clarity and fairness.<br><br></p>\r\n<h3><strong>Disclaimer for User Accountability</strong></h3>\r\n<p><br><em>\"NepState is a platform for user-generated content and interactions. NepState is not liable for any user-generated content, including opinions, posts, comments, or transactions. Users are solely responsible for ensuring that their activities and content comply with local, national, and international laws and regulations. Any violations are the sole responsibility of the individual user.\"</em></p>', '<h3><strong>Forum Rules</strong></h3>\r\n<p><strong>Rule 1:</strong> Be respectful to all members. Personal attacks, harassment, or hate speech will not be tolerated.</p>\r\n<p><strong>Rule 2:</strong> Post relevant content in the appropriate category. Use clear titles and avoid duplicate or spam posts.</p>\r\n<p><strong>Rule 3:</strong> Tag sensitive or NSFW content appropriately and ensure it complies with forum guidelines.</p>\r\n<p><strong>Rule 4:</strong> Respect the privacy of others. Do not share personal or confidential information without permission.</p>\r\n<p><strong>Rule 5:</strong> Do not share illegal, copyrighted, or misleading content. Always cite sources for factual posts.</p>\r\n<p><strong>Rule 6:</strong> Follow moderator instructions. Report rule violations instead of engaging directly.</p>\r\n<p><strong>Rule 7:</strong> Misconduct or rule violations may lead to warnings, suspension, or permanent bans.<br><br></p>\r\n<h3><strong> Disclaimer for User Accountability</strong></h3>\r\n<p><br><em>\"NepState is a platform for user-generated content and interactions. NepState is not liable for any user-generated content, including opinions, posts, comments, or transactions. Users are solely responsible for ensuring that their activities and content comply with local, national, and international laws and regulations. Any violations are the sole responsibility of the individual user.\"</em></p>', '<ol>\r\n<li>Explore a world of diverse opportunities on our comprehensive listing platform</li>\r\n<li>&nbsp;From upcoming events, diverse job opportunities, and specialized services to top-tier IT training programs, ideal roommates, and rental spaces &mdash; find what you need.</li>\r\n<li>Immerse yourself in insightful blogs and engage in lively discussions, confessions, and community forums.</li>\r\n<li>Elevate your business by promoting your services and reaching a broader audience.</li>\r\n<li>Other businesses can also showcase their offerings in our dedicated AD section. Stay updated with the latest additions in each category.</li>\r\n<li>Your comprehensive experience begins here, connecting you to opportunities and a thriving community.</li>\r\n</ol>', '+3184975447', 'info@nepstate.com', '© 2024 NepStates', 'https://www.twitter.com/', 'https://pin.it/3IgJP0jrc', 'https://www.instagram.com/nepstate_us/', 'https://www.facebook.com/profile.php?id=61571765323490', 'https://www.linkedin.com', '', 'https://www.skype.com', 'Nepstate Address', 'Map', 'rgb(255, 0, 0)', 'rgb(255, 0, 0)', 'rgb(255, 255, 2', 5, 'minfied_css_1535980922.css', 'c_logo', '2794728d21a8434e8eb6834ef5b7352b.png', 0, 0, 0, 0, 0, 0, 0, 0, 1, '1714025520.jpg', NULL, NULL, NULL, NULL, NULL, 0, 0, 0.00, 15.00, 'YOUR_TWILIO_ACCOUNT_SID', 'YOUR_TWILIO_AUTH_TOKEN', NULL, 'https://youtube.com/', 'http://192.168.100.3/front/', 'Explore a world of diverse opportunities on our comprehensive listing platform. From upcoming events, diverse job opportunities, and specialized services to top-tier IT training programs, ideal roommates, and rental spaces — find what you need. Immerse yourself in insightful blogs and engage in lively discussions, confessions, and community forums. Elevate your business by promoting your services and reaching a broader audience. Other businesses can also showcase their offerings in our dedicated AD section. Stay updated with the latest additions in each category. Your comprehensive experience begins here, connecting you to opportunities and a thriving community.', 'اكتشف عالمًا من الفرص المتنوعة على منصة القائمة الشاملة الخاصة بنا. بدءًا من الأحداث القادمة وفرص العمل المتنوعة والخدمات المتخصصة وحتى برامج التدريب عالية المستوى على تكنولوجيا المعلومات وزملاء السكن المثاليين ومساحات الإيجار - يمكنك العثور على ما تحتاجه. انغمس في المدونات الثاقبة وشارك في مناقشات واعترافات ومنتديات مجتمعية حيوية. ارفع مستوى عملك من خلال الترويج لخدماتك والوصول إلى جمهور أوسع. يمكن للشركات الأخرى أيضًا عرض عروضها في قسم الإعلانات المخصص لدينا. ابق على اطلاع بأحدث الإضافات في كل فئة. تجربتك الشاملة تبدأ هنا، وتصلك بالفرص والمجتمع المزدهر.', 1, 'Souq Pack | Online shopping for packaging products in Saudi Arabia & Riyadh', 'سوق باك | تسوق أونلاين منتجات التعبئة والتغليف بالسعودية والرياض', 'Shop from the largest assortment of packaging products in Saudi Arabia, Souq Pack factory meets your business needs, such as bags and cups, plastic boxes, plastic tableware, printed tissues, packing papers and more. Shop now', 'تسوق من أكبر تشكيلة منتجات تعبئة وتغليف بالسعودية ،  مصنع سوق باك يلبى احتياجات أعمالك من أكياس و أكواب , علب بلاستيك , مستلزمات مائدة بلاستيكية , مناديل مطبوعة وأوراق التغليف والمزيد. تسوق الآن', 'Pak market, packaging products store, packaging products shopping', 'سوق باك , متجر منتجات تعبئة وتغليف , تسوق منتجات التعبئة والتغليف', '<script async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4497819153393349\"\r\n     crossorigin=\"anonymous\"></script>\r\n<!-- blog -->\r\nGoogle Ads Script\r\n<ins class=\"adsbygoogle\"\r\n     style=\"display:block\"\r\n     data-ad-client=\"ca-pub-4497819153393349\"\r\n     data-ad-slot=\"3970705062\"\r\n     data-ad-format=\"auto\"\r\n     data-full-width-responsive=\"true\"></ins>\r\n<script>\r\n     (adsbygoogle = window.adsbygoogle || []).push({});\r\n</script>', 1, 'List your upcoming Events with NepState.', '<p>For detailed guidance on using our website and to access frequently asked questions (FAQs), please visit our \'Contact Us\' page and utilize the provided form for any inquiries. We appreciate your engagement and look forward to assisting you.<img src=\"https://giphy.com/gifs/xThuWu82QD3pj4wvEQ\" alt=\"\"></p>', 0, NULL, NULL, NULL, 1.5);

-- --------------------------------------------------------

--
-- Table structure for table `settings_old`
--

CREATE TABLE `settings_old` (
  `id` int(11) NOT NULL,
  `site_title` varchar(150) NOT NULL,
  `site_logo` varchar(255) NOT NULL,
  `site_logo_small` varchar(255) DEFAULT NULL,
  `confession_rules` longtext NOT NULL,
  `forum_rules` longtext DEFAULT NULL,
  `paragraph` longtext DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `copy_right` text NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `snapchat` text DEFAULT NULL,
  `instagram` text DEFAULT NULL,
  `facebook` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `map_address` text DEFAULT NULL,
  `color_icon` varchar(100) DEFAULT '#000',
  `color_heading` varchar(100) DEFAULT '#000',
  `color_body` varchar(100) DEFAULT '#fff',
  `slider_time` int(11) DEFAULT 5,
  `style_name` varchar(255) DEFAULT 'style.css?version=new',
  `client_title` varchar(255) DEFAULT NULL,
  `client_logo` varchar(255) DEFAULT NULL,
  `show_email` int(1) NOT NULL DEFAULT 1,
  `show_mobile` int(1) NOT NULL DEFAULT 1,
  `show_fb` int(1) NOT NULL DEFAULT 1,
  `show_tw` int(1) NOT NULL DEFAULT 1,
  `show_li` int(1) NOT NULL DEFAULT 1,
  `show_gp` int(1) NOT NULL DEFAULT 1,
  `show_skype` int(1) NOT NULL DEFAULT 1,
  `show_address` int(11) NOT NULL DEFAULT 0,
  `show_chistmas_popup` int(1) DEFAULT 0,
  `site_favicon` varchar(255) DEFAULT NULL,
  `meta_title` varchar(250) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `currency_ar` varchar(20) DEFAULT NULL,
  `currency_space` int(1) NOT NULL DEFAULT 0,
  `currency_position` int(11) NOT NULL DEFAULT 0,
  `shipping_fee` decimal(20,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(20,2) NOT NULL DEFAULT 0.00,
  `twillio_pub` text DEFAULT NULL,
  `twillio_sec` text DEFAULT NULL,
  `site_title_ar` varchar(200) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `frontend_url` text DEFAULT NULL,
  `footer_about` text DEFAULT NULL,
  `footer_about_ar` text DEFAULT NULL,
  `hard_region` int(1) NOT NULL DEFAULT 0,
  `meta_title_en` varchar(255) DEFAULT NULL,
  `meta_title_ar` varchar(255) DEFAULT NULL,
  `meta_desc_en` varchar(255) DEFAULT NULL,
  `meta_desc_ar` varchar(255) DEFAULT NULL,
  `meta_keys_en` varchar(255) DEFAULT NULL,
  `meta_keys_ar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `settings_old`
--

INSERT INTO `settings_old` (`id`, `site_title`, `site_logo`, `site_logo_small`, `confession_rules`, `forum_rules`, `paragraph`, `mobile`, `email`, `copy_right`, `twitter`, `snapchat`, `instagram`, `facebook`, `linkedin`, `google_plus`, `skype`, `address`, `map_address`, `color_icon`, `color_heading`, `color_body`, `slider_time`, `style_name`, `client_title`, `client_logo`, `show_email`, `show_mobile`, `show_fb`, `show_tw`, `show_li`, `show_gp`, `show_skype`, `show_address`, `show_chistmas_popup`, `site_favicon`, `meta_title`, `meta_keywords`, `meta_description`, `currency`, `currency_ar`, `currency_space`, `currency_position`, `shipping_fee`, `tax`, `twillio_pub`, `twillio_sec`, `site_title_ar`, `youtube`, `frontend_url`, `footer_about`, `footer_about_ar`, `hard_region`, `meta_title_en`, `meta_title_ar`, `meta_desc_en`, `meta_desc_ar`, `meta_keys_en`, `meta_keys_ar`) VALUES
(1, 'Nepstates', '1714025538.jpg', '1714029348.jpg', '<p>1. Rule # 1 will come here</p>\r\n\r\n<p>2. Rule # 2 will come here</p>\r\n\r\n<p>3. Rule # 3 will come here</p>\r\n\r\n<p>4. Rule # 4 will come here</p>\r\n\r\n<p>5. Rule # 5 will come here</p>\r\n\r\n<p>6. Rule # 6 will come here,</p>', '<p>1. Rule # 1 will come here</p>\r\n\r\n<p>2. Rule # 2 will come hh</p>\r\n\r\n<p>3. Rule # 3 will come here,</p>', '<ol>\r\n	<li>Explore a world of diverse opportunities on our comprehensive listing platform</li>\r\n	<li>&nbsp;From upcoming events, diverse job opportunities, and specialized services to top-tier IT training programs, ideal roommates, and rental spaces &mdash; find what you need.</li>\r\n	<li>Immerse yourself in insightful blogs and engage in lively discussions, confessions, and community forums.</li>\r\n	<li>Elevate your business by promoting your services and reaching a broader audience.</li>\r\n	<li>Other businesses can also showcase their offerings in our dedicated AD section. Stay updated with the latest additions in each category.</li>\r\n	<li>Your comprehensive experience begins here, connecting you to opportunities and a thriving community.</li>\r\n</ol>', '+000 000 0000', 'info@dedevelopers.org', '© 2024 NepStates', 'https://www.twitter.comm', 'https://www.snapchat.com', 'https://www.instagram.com', 'https://www.facebook.com', 'https://www.linkedin.com', '', 'https://www.skype.com', 'Qatar', 'IT Tower, Lahore Pakistan', 'rgb(255, 0, 0)', 'rgb(255, 0, 0)', 'rgb(255, 255, 2', 5, 'minfied_css_1535980922.css', 'c_logo', '2794728d21a8434e8eb6834ef5b7352b.png', 0, 0, 0, 0, 0, 0, 0, 0, 1, '1714025520.jpg', NULL, NULL, NULL, NULL, NULL, 0, 0, 0.00, 15.00, 'YOUR_TWILIO_ACCOUNT_SID', 'YOUR_TWILIO_AUTH_TOKEN', NULL, 'https://youtube.com/', 'http://192.168.100.3/front/', 'Explore a world of diverse opportunities on our comprehensive listing platform. From upcoming events, diverse job opportunities, and specialized services to top-tier IT training programs, ideal roommates, and rental spaces — find what you need. Immerse yourself in insightful blogs and engage in lively discussions, confessions, and community forums. Elevate your business by promoting your services and reaching a broader audience. Other businesses can also showcase their offerings in our dedicated AD section. Stay updated with the latest additions in each category. Your comprehensive experience begins here, connecting you to opportunities and a thriving community.', 'اكتشف عالمًا من الفرص المتنوعة على منصة القائمة الشاملة الخاصة بنا. بدءًا من الأحداث القادمة وفرص العمل المتنوعة والخدمات المتخصصة وحتى برامج التدريب عالية المستوى على تكنولوجيا المعلومات وزملاء السكن المثاليين ومساحات الإيجار - يمكنك العثور على ما تحتاجه. انغمس في المدونات الثاقبة وشارك في مناقشات واعترافات ومنتديات مجتمعية حيوية. ارفع مستوى عملك من خلال الترويج لخدماتك والوصول إلى جمهور أوسع. يمكن للشركات الأخرى أيضًا عرض عروضها في قسم الإعلانات المخصص لدينا. ابق على اطلاع بأحدث الإضافات في كل فئة. تجربتك الشاملة تبدأ هنا، وتصلك بالفرص والمجتمع المزدهر.', 1, 'Souq Pack | Online shopping for packaging products in Saudi Arabia & Riyadh', 'سوق باك | تسوق أونلاين منتجات التعبئة والتغليف بالسعودية والرياض', 'Shop from the largest assortment of packaging products in Saudi Arabia, Souq Pack factory meets your business needs, such as bags and cups, plastic boxes, plastic tableware, printed tissues, packing papers and more. Shop now', 'تسوق من أكبر تشكيلة منتجات تعبئة وتغليف بالسعودية ،  مصنع سوق باك يلبى احتياجات أعمالك من أكياس و أكواب , علب بلاستيك , مستلزمات مائدة بلاستيكية , مناديل مطبوعة وأوراق التغليف والمزيد. تسوق الآن', 'Pak market, packaging products store, packaging products shopping', 'سوق باك , متجر منتجات تعبئة وتغليف , تسوق منتجات التعبئة والتغليف');

-- --------------------------------------------------------

--
-- Table structure for table `site_languages`
--

CREATE TABLE `site_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `site_languages`
--

INSERT INTO `site_languages` (`id`, `name`, `icon`, `type`, `status`) VALUES
(1, 'English', NULL, 'LTR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `region_id` int(11) DEFAULT NULL,
  `lparent` int(11) NOT NULL DEFAULT 0,
  `lang_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `title` varchar(150) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `cID` int(11) NOT NULL DEFAULT 0,
  `parent` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `banner` varchar(200) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `store_followers`
--

CREATE TABLE `store_followers` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_images`
--

CREATE TABLE `store_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `image` varchar(250) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temporary_products`
--

CREATE TABLE `temporary_products` (
  `id` int(11) NOT NULL,
  `uID` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `json_content` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `sub_cat` varchar(255) DEFAULT NULL,
  `sub_inner` varchar(155) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` varchar(255) NOT NULL,
  `schedule` int(11) NOT NULL DEFAULT 0,
  `schedule_time` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `plan_id` int(11) NOT NULL DEFAULT 0,
  `sub_plan_id` varchar(255) DEFAULT NULL,
  `payment_done` int(11) NOT NULL DEFAULT 0,
  `payment_object` text DEFAULT NULL,
  `expiry_date` varchar(20) DEFAULT NULL,
  `amount_paid` decimal(20,2) NOT NULL DEFAULT 0.00,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `clicks` double NOT NULL DEFAULT 0,
  `payment_status` varchar(255) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `temporary_products`
--

INSERT INTO `temporary_products` (`id`, `uID`, `title`, `json_content`, `category`, `sub_cat`, `sub_inner`, `slug`, `status`, `created_at`, `schedule`, `schedule_time`, `views`, `plan_id`, `sub_plan_id`, `payment_done`, `payment_object`, `expiry_date`, `amount_paid`, `latitude`, `longitude`, `city`, `state`, `zip_code`, `country`, `country_id`, `city_id`, `clicks`, `payment_status`) VALUES
(3, 2, 'rghj', '{\"is_free_plan\":\"0\",\"category\":\"services\",\"subcategory\":\"lawyer\",\"other_cat\":\"\",\"title\":\"rghj\",\"business_name\":\"fgh\",\"address\":\"Cumberland Valley Business Alliance, Lincoln Way East, Chambersburg, PA, USA\",\"latitude\":\"39.93738309999999\",\"longitude\":\"-77.6609707\",\"city\":\"Chambersburg\",\"state\":\"Pennsylvania\",\"zip_code\":\"17201\",\"country\":\"United States\",\"contact_name\":\"vbn\",\"contact_email\":\"cvb@dfgh.com\",\"contact_number\":\"(345)-678-9056\",\"business_website\":\"https:\\/\\/ffggg.com\",\"service_name\":\"sdfgh\",\"tags\":\"\",\"service_tags\":\"cvb\",\"service_category\":\"d\",\"year_in_business\":\"2\",\"description\":\"\",\"plan\":\"1\",\"coupon_code\":\"\",\"plan_amount\":\"7.13\",\"sub_plan_amount\":\"7.13\",\"is_coupon_apply\":\"0\"}', 'services', 'lawyer', NULL, 'rghj', 1, '2025-03-18 22:29:15', 0, NULL, 0, 1, NULL, 1, '', '2025-04-17', 7.13, '39.93738309999999', '-77.6609707', 'Chambersburg', 'Pennsylvania', '17201', 'United States', 1, NULL, 0, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `temporary_products_ads`
--

CREATE TABLE `temporary_products_ads` (
  `id` int(11) NOT NULL,
  `ad_for` varchar(255) DEFAULT NULL,
  `ad_location` varchar(255) DEFAULT NULL,
  `created_at` varchar(155) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `link` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `uID_pID` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `ad_expires` varchar(100) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 0,
  `payment_status` varchar(50) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temporary_products_ads`
--

INSERT INTO `temporary_products_ads` (`id`, `ad_for`, `ad_location`, `created_at`, `status`, `link`, `image`, `uID_pID`, `category`, `user_id`, `ad_expires`, `country_id`, `city_id`, `plan_id`, `payment_status`) VALUES
(18, 'website_home_banner', NULL, '2025-03-18', 1, '', 'https://nepstate.com/resources/uploads/classified-listing/868eee38f4b5493ecb6fd1a88f9d7568.png', 0, NULL, 2, '2025-04-17', 1, NULL, 12, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `test` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `test`) VALUES
(5, 'Hassan');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` longtext NOT NULL,
  `stars` tinyint(3) UNSIGNED NOT NULL,
  `designation` varchar(255) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `profile_pic` text DEFAULT 'dummy_image.png',
  `api_logged_sess` text DEFAULT NULL,
  `push_id` text DEFAULT NULL,
  `g_id` text DEFAULT NULL,
  `verify_email` int(11) NOT NULL DEFAULT 0,
  `country_id` int(11) DEFAULT NULL,
  `city_id` varchar(255) DEFAULT NULL,
  `free_listings_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `phone`, `address`, `status`, `created_at`, `session_id`, `profile_pic`, `api_logged_sess`, `push_id`, `g_id`, `verify_email`, `country_id`, `city_id`, `free_listings_count`) VALUES
(2, 'Vivek Shrestha', 'nepstates@gmail.com', '115394546291813235149', '67c89757bebf2ae730b25ef4dc81d2d3', NULL, NULL, 1, '2025-02-27 11:39:34', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLSVC6t1Ga3rmhp6XSglxCkzGj9k03kXvTm9WQ2adh5JdoPwA=s96-c', NULL, NULL, '115394546291813235149', 1, 1, NULL, 2),
(3, 'samm shrestha', 'sambidshrs123@gmail.com', '107085000319018459566', '4a4a44d70701d47212f99a7d5c531749', NULL, NULL, 1, '2025-03-03 22:25:23', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocKhuZaQ-M6d1FqwSpv3UaGCTjta_gbPDBmKOILD-WRJpkxGzXtp4A=s96-c', NULL, NULL, '107085000319018459566', 1, 1, NULL, 0),
(4, 'hassanmurtazai4999@gmail.com', 'hassanmurtazai4999@gmail.com', 'hassanmurtazai4999@gmail.com', '7962245685ca587f519be39f66804f65', NULL, NULL, 1, '2025-03-05 14:02:54', 'TRWNhOAHH4gz3tfVcSoG8eb9e', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(5, 'Alice', 'sbqdkemm@do-not-respond.me', 'TestUser', '5aba2a04161d84b41fe650be4db3e9c3', NULL, NULL, 1, '2025-03-09 13:16:08', 'ojjgbo7Hl7nwNSjYXYVF2ygM7', 'dummy_image.png', NULL, NULL, NULL, 0, 1, 'deleted', 0),
(6, 'John', 'tzithqww@do-not-respond.me', 'MyName', '5aba2a04161d84b41fe650be4db3e9c3', NULL, NULL, 1, '2025-03-09 13:16:08', 'su6kBV4UmcMHqRWE9ESCD5aOw', 'dummy_image.png', NULL, NULL, NULL, 0, 1, 'deleted', 0),
(7, 'MyName', 'prodesignmd@hotmail.com', 'Alice', '5aba2a04161d84b41fe650be4db3e9c3', NULL, NULL, 1, '2025-03-09 17:14:46', 'aXhpxxmR3lshow7pWbADoRkt0', 'dummy_image.png', NULL, NULL, NULL, 0, 1, 'deleted', 0),
(8, 'Hello', 'jennifer-portwood@uiowa.edu', 'John', '5aba2a04161d84b41fe650be4db3e9c3', NULL, NULL, 1, '2025-03-09 19:10:46', 'MkQRrkcBgbMaJoRgQRRG7xWOR', 'dummy_image.png', NULL, NULL, NULL, 0, 1, 'deleted', 0),
(9, 'TestUser', 'johannah1214@gmail.com', 'Hello', '5aba2a04161d84b41fe650be4db3e9c3', NULL, NULL, 1, '2025-03-10 04:05:40', 'ZlS72jXeP2rjun5YG37AvnwKv', 'dummy_image.png', NULL, NULL, NULL, 0, 1, 'deleted', 0),
(11, 'OzafEUhxpEjaix', 'calderonkittism1994@gmail.com', 'mFPfqhglb', '26863b1b9749c033b8743a73fed7f13e', NULL, NULL, 1, '2025-03-13 08:24:28', 'cXUQjUZQe5Y2CMgUZeF7TkA366Tsk0', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(14, 'Sajnee Shrestha', 'shresthasajnee04@gmail.com', 'shresthasajnee04', '081835e8d6bf4496a55057e3a09d0a0f', NULL, NULL, 1, '2025-03-13 08:49:24', 'TnKf6o3gHWXwZNJSNJEoN6Fp9', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(18, 'Hassan CodeXperts', 'hassan.code.xperts@gmail.com', 'hassan.code.xperts@gmail.com', '7962245685ca587f519be39f66804f65', NULL, NULL, 1, '2025-03-18 10:30:36', NULL, 'dummy_image.png', NULL, NULL, NULL, 1, 1, NULL, 0),
(19, 'James', 'antiquesartifact@gmail.com', 'antiquesartifact@gmail.com', '75fab2a9bd10c072a43a5dcac064d599', NULL, NULL, 1, '2025-03-18 19:15:55', NULL, 'dummy_image.png', NULL, NULL, NULL, 1, 1, NULL, 0),
(20, 'CAFEMANDU ', 'flavorsofnepal@gmail.com', 'CAFEMANDU - Flavors of Nepal', '0b6228054ff5339bfdb59ce09a9e3b60', NULL, NULL, 1, '2025-03-18 20:20:37', '4JGJynEc3P9b232sUcLAYwmwu', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 1),
(21, 'Bara Nepalese Restaurant and Bar', 'baraktchen@gmail.com', 'Bara Nepalese Restaurant and Bar', '9b636fc96e929fd5456d58f0dc4fe16d', NULL, NULL, 1, '2025-03-18 21:10:12', 'xEeH3nLJvhhEOQb2GaO5TDXuH', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 1),
(22, 'Everest Kitchen', 'Everestkitchenca@gmail.com', 'Everest Kitchen', '795d676fc4d6d107fc9dabe47fe71ace', NULL, NULL, 1, '2025-03-18 23:13:59', 'PH0sRdtUK0smZhSchb3FWXzBD', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 1),
(23, 'Vivek', 'vxs4608@gmail.com', 'vxs4608', '8ef9b1a0af96eda79b4132932d43128a', NULL, NULL, 1, '2025-03-18 23:57:49', '6R2XzO6zRxYVtDWVTJykbKFWJ', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(24, 'uDXGwtfH', 'lmacdonaldv@gmail.com', 'MbPkFsSiaWc', '6563015a0605574caf9b1b3b29118784', NULL, NULL, 1, '2025-03-19 08:54:54', 'taDcKW8u97zt9ePGJnMRZpYc0MLbYo', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(25, 'cBZovvNvuRZ', 'pastorcal@hotmail.com', 'MriagmNZClmQEB', '36695e235cc2fdcf1568f7fcee2b8fb7', NULL, NULL, 1, '2025-03-19 11:35:01', 'eQAypWma6Zux7MKZ6gBmM4CgEzORpy', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(26, 'UYCKYVqar', 'benjamin.k.hastings@gmail.com', 'bsgMxWzh', '7f04c513ea8d1c5563e73013b74ddad7', NULL, NULL, 1, '2025-03-19 12:04:59', 'Lc8Kk6dKqZG7QY4zGDXKAvrEuHOTWC', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(27, 'VaZTdSATMRhdDqm', 'holgereckner@msn.com', 'xeWPUulCIxjr', 'd40d54abdce40a565d08c05ac3924866', NULL, NULL, 1, '2025-03-19 13:02:47', 'zA3AwbXFEaPws9yfBQ7mHcndGmrA4N', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(28, 'lCCsvYVOhgP', 'rapier225@me.com', 'knFWEWDpyx', '180feb436c85f2e77536249332922943', NULL, NULL, 1, '2025-03-19 13:04:03', 'jwDeOsAJJGAGdURwMr7NoJUXsXkCTl', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(29, 'FEZkbDhOTPQDq', 'axel@kretzsch.eu', 'TnDnnlNyliWUP', 'e98024310dd5f182e3af68e753720d29', NULL, NULL, 1, '2025-03-19 13:43:30', 'sQTRWa9dgCTaK04xDbKk8QtELA9PQJ', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0),
(30, 'FBAYVYNSdFns', 'madisonsdad0312@gmail.com', 'JowiyWwgOvIVZF', 'e11d68f32c5e857ea80db10b5864685d', NULL, NULL, 1, '2025-03-19 13:55:03', 'WUlceesMGYw8GTV3KjNbcwfzVqkT0V', 'dummy_image.png', NULL, NULL, NULL, 0, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_ip`
--

CREATE TABLE `user_ip` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `product_slug` text NOT NULL,
  `product_creator_id` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`id`, `ip`, `product_slug`, `product_creator_id`, `created_at`) VALUES
(1, '69.255.243.16', 'test', 2, '2025-02-27 11:45:16'),
(2, '69.255.243.16', 'photo-2', 2, '2025-02-27 11:45:31'),
(3, '69.255.243.16', 'cafemandu--flavors-of-nepal', 20, '2025-03-18 20:51:33'),
(4, '69.255.243.16', 'bara-nepalese-restaurant-and-bar', 21, '2025-03-18 21:14:27'),
(5, '69.255.243.16', 'everest-kitchen', 22, '2025-03-19 01:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(11) NOT NULL,
  `ip_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`) VALUES
(1, '182.176.93.239'),
(2, '107.178.192.44'),
(3, '107.178.192.33'),
(4, '107.178.192.32'),
(5, '167.99.8.55'),
(6, '66.249.93.97'),
(7, '66.249.93.103'),
(8, '66.249.93.96'),
(9, '66.249.83.1'),
(10, '66.249.83.2'),
(11, '34.116.22.1'),
(12, '34.116.22.7'),
(13, '34.116.21.3'),
(14, '34.116.21.4'),
(15, '69.255.243.16'),
(16, '112.196.90.19'),
(17, '52.231.139.201'),
(18, '52.231.139.203'),
(19, '107.178.203.164'),
(20, '107.178.203.163'),
(21, '107.178.203.162'),
(22, '34.116.22.8'),
(23, '66.102.8.39'),
(24, '66.102.8.32'),
(25, '122.173.25.110'),
(26, '2a02:c206:3015:63::1'),
(27, '212.116.250.16'),
(28, '107.178.224.226'),
(29, '107.178.224.227'),
(30, '107.178.224.228'),
(31, '107.178.193.39'),
(32, '107.178.193.38'),
(33, '107.178.193.32'),
(34, '107.178.224.68'),
(35, '107.178.224.66'),
(36, '107.178.224.67'),
(37, '54.174.58.224'),
(38, '54.174.58.243'),
(39, '54.174.58.247'),
(40, '54.174.58.226'),
(41, '54.174.58.240'),
(42, '54.174.58.235'),
(43, '54.174.58.249'),
(44, '54.174.58.255'),
(45, '54.174.58.234'),
(46, '54.174.58.237'),
(47, '54.174.58.241'),
(48, '43.245.86.30'),
(49, '35.187.139.192'),
(50, '35.187.139.199'),
(51, '35.187.139.198'),
(52, '2a03:2880:30ff:9::'),
(53, '2a03:2880:32ff:8::'),
(54, '2a03:2880:31ff::'),
(55, '2a03:2880:31ff:2::'),
(56, '2a03:2880:31ff:4c::'),
(57, '2a03:2880:31ff:4a::'),
(58, '2a03:2880:31ff:1::'),
(59, '2a03:2880:31ff:73::'),
(60, '2a03:2880:31ff:3::'),
(61, '2a03:2880:31ff:b::'),
(62, '2a03:2880:31ff:70::'),
(63, '2a03:2880:31ff:71::'),
(64, '2a03:2880:31ff:5::'),
(65, '2a03:2880:31ff:4::'),
(66, '2a03:2880:31ff:46::'),
(67, '2a03:2880:31ff:74::'),
(68, '2a03:2880:31ff:47::'),
(69, '2a03:2880:31ff:49::'),
(70, '2a03:2880:31ff:9::'),
(71, '2a03:2880:31ff:6::'),
(72, '31.13.127.112'),
(73, '144.76.22.71'),
(74, '35.187.133.140'),
(75, '35.187.133.129'),
(76, '2a03:2880:21ff:53::'),
(77, '2a03:2880:21ff:40::'),
(78, '107.178.195.66'),
(79, '107.178.195.68'),
(80, '107.178.195.67'),
(81, '107.178.195.100'),
(82, '51.222.253.9'),
(83, '35.187.143.71'),
(84, '107.178.203.66'),
(85, '35.187.143.8'),
(86, '107.178.203.100'),
(87, '35.187.143.7'),
(88, '107.178.203.99'),
(89, '107.178.203.130'),
(90, '35.187.143.70'),
(91, '107.178.203.32'),
(92, '35.187.143.38'),
(93, '35.187.143.32'),
(94, '107.178.203.128'),
(95, '5.133.192.166'),
(96, '34.116.21.5'),
(97, '35.187.143.39'),
(98, '107.178.203.38'),
(99, '107.178.203.39'),
(100, '159.65.29.169'),
(101, '98.159.43.33'),
(102, '98.159.43.37'),
(103, '138.246.253.7'),
(104, '34.98.143.162'),
(105, '34.98.143.163'),
(106, '34.98.143.164'),
(107, '42.236.12.214'),
(108, '35.187.143.1'),
(109, '107.178.203.98'),
(110, '74.125.215.167'),
(111, '74.125.215.166'),
(112, '74.125.215.165'),
(113, '51.222.253.11'),
(114, '54.216.152.7'),
(115, '3.250.214.226'),
(116, '45.77.144.24'),
(117, '67.191.154.29'),
(118, '108.56.150.225'),
(119, '68.230.201.144'),
(120, '73.194.82.229'),
(121, '24.205.120.191'),
(122, '148.74.151.39'),
(123, '174.53.188.239'),
(124, '172.59.172.127'),
(125, '97.200.166.71'),
(126, '97.164.92.189'),
(127, '71.251.20.158'),
(128, '98.230.53.107'),
(129, '47.204.228.99'),
(130, '107.133.93.101'),
(131, '64.176.212.235'),
(132, '43.252.31.64'),
(133, '75.236.48.8'),
(134, '68.0.87.82'),
(135, '134.199.81.135'),
(136, '162.43.234.246'),
(137, '172.223.217.111'),
(138, '205.222.250.28'),
(139, '136.227.177.7'),
(140, '172.85.105.123'),
(141, '104.139.45.251'),
(142, '68.104.196.152'),
(143, '136.227.164.143'),
(144, '93.180.196.21'),
(145, '134.199.90.53'),
(146, '75.117.21.174'),
(147, '98.212.132.196'),
(148, '76.157.198.166'),
(149, '82.97.199.71'),
(150, '82.97.199.5'),
(151, '82.97.199.84'),
(152, '82.97.199.170'),
(153, '76.89.92.63'),
(154, '152.39.149.20'),
(155, '152.39.181.3'),
(156, '208.207.171.139'),
(157, '152.39.161.150'),
(158, '139.5.106.34'),
(159, '136.227.171.23'),
(160, '180.149.22.58'),
(161, '107.141.44.192'),
(162, '152.39.214.88'),
(163, '206.204.36.135'),
(164, '206.204.14.196'),
(165, '134.199.82.217'),
(166, '76.85.41.185'),
(167, '152.39.196.208'),
(168, '73.19.84.178'),
(169, '148.170.28.90'),
(170, '168.151.98.60'),
(171, '161.123.185.93'),
(172, '213.159.13.117'),
(173, '168.151.124.91'),
(174, '82.97.199.95'),
(175, '82.97.199.142'),
(176, '74.193.253.31'),
(177, '82.97.199.237'),
(178, '65.17.184.156'),
(179, '93.180.203.105'),
(180, '206.204.60.197'),
(181, '161.123.219.218'),
(182, '121.91.220.67'),
(183, '70.21.198.66'),
(184, '208.207.136.193'),
(185, '208.207.141.14'),
(186, '161.129.174.214'),
(187, '158.46.209.252'),
(188, '45.197.215.221'),
(189, '176.100.135.70'),
(190, '38.40.6.216'),
(191, '192.153.68.27'),
(192, '152.39.239.136'),
(193, '98.97.83.44'),
(194, '82.97.199.126'),
(195, '82.97.199.160'),
(196, '82.97.199.151'),
(197, '34.200.52.53'),
(198, '98.206.243.132'),
(199, '5.29.18.228'),
(200, '2a03:2880:31ff:4b::'),
(201, '2a03:2880:31ff:45::'),
(202, '2a03:2880:31ff:a::'),
(203, '2a03:2880:31ff:8::'),
(204, '100.24.108.51'),
(205, '35.187.133.128'),
(206, '104.224.90.212'),
(207, '119.42.36.161'),
(208, '154.92.125.181'),
(209, '74.125.213.33'),
(210, '66.249.88.68'),
(211, '66.249.88.66'),
(212, '66.249.88.67'),
(213, '74.125.214.35'),
(214, '66.249.80.103'),
(215, '66.102.7.163'),
(216, '66.249.80.140'),
(217, '66.102.7.162'),
(218, '74.125.214.36'),
(219, '66.249.80.129'),
(220, '66.249.80.128'),
(221, '52.211.23.72'),
(222, '34.45.62.44'),
(223, '2a02:4780:2c:3::5'),
(224, '196.243.240.25'),
(225, '66.249.70.172'),
(226, '66.249.70.173'),
(227, '3.211.127.131'),
(228, '209.74.83.82'),
(229, '2001:4ca0:108:42::7'),
(230, '66.102.8.33'),
(231, '43.128.226.198'),
(232, '2a03:2880:15ff:72::'),
(233, '2a03:2880:15ff:2::'),
(234, '2a03:2880:15ff:71::'),
(235, '2a03:2880:15ff:1::'),
(236, '2a03:2880:15ff:70::'),
(237, '2a03:2880:15ff:73::'),
(238, '2a03:2880:15ff:74::'),
(239, '2a03:2880:15ff::'),
(240, '196.251.71.152'),
(241, '2620:101:2002:11a5:10:8:141:57'),
(242, '51.222.253.10'),
(243, '66.249.70.1'),
(244, '66.249.70.8'),
(245, '143.198.239.107'),
(246, '46.17.174.173'),
(247, '34.222.196.207'),
(248, '51.222.253.18'),
(249, '35.187.143.64'),
(250, '35.87.225.65'),
(251, '107.178.203.129'),
(252, '196.196.53.92'),
(253, '54.236.1.13'),
(254, '34.222.174.117'),
(255, '43.157.202.235'),
(256, '222.79.104.23'),
(257, '51.222.253.2'),
(258, '52.231.139.193'),
(259, '45.156.129.139'),
(260, '45.156.129.137'),
(261, '66.249.88.71'),
(262, '66.249.88.69'),
(263, '66.249.88.70'),
(264, '74.125.213.45'),
(265, '74.125.213.46'),
(266, '74.125.213.44'),
(267, '52.112.49.112'),
(268, '52.112.125.9'),
(269, '170.106.180.246'),
(270, '220.86.88.229'),
(271, '43.153.10.13'),
(272, '52.91.113.244'),
(273, '100.26.235.172'),
(274, '103.129.134.84'),
(275, '34.175.97.134'),
(276, '2a03:2880:31ff:48::'),
(277, '2a03:2880:31ff:50::'),
(278, '2a03:2880:31ff:44::'),
(279, '2a03:2880:31ff:53::'),
(280, '2a03:2880:31ff:72::'),
(281, '2a03:2880:31ff:55::'),
(282, '2a03:2880:31ff:4d::'),
(283, '2a03:2880:31ff:7::'),
(284, '207.46.13.150'),
(285, '111.231.1.45'),
(286, '207.46.13.111'),
(287, '157.55.39.63'),
(288, '107.178.192.38'),
(289, '34.116.22.34'),
(290, '34.116.22.32'),
(291, '34.116.22.33'),
(292, '107.178.192.39'),
(293, '64.23.135.59'),
(294, '44.242.155.73'),
(295, '156.146.36.113'),
(296, '43.157.250.180'),
(297, '2a03:2880:30ff:4::'),
(298, '2a03:2880:30ff:5::'),
(299, '2a03:2880:3ff:73::'),
(300, '2a03:2880:30ff:6::'),
(301, '2a03:2880:30ff:71::'),
(302, '2a03:2880:30ff:73::'),
(303, '2a03:2880:30ff:72::'),
(304, '31.13.115.9'),
(305, '2a03:2880:30ff::'),
(306, '2a03:2880:30ff:8::'),
(307, '107.178.192.37'),
(308, '54.174.58.236'),
(309, '184.154.139.44'),
(310, '2001:418:8006::60'),
(311, '43.159.141.150'),
(312, '68.69.184.202'),
(313, '42.83.147.54'),
(314, '51.222.253.13'),
(315, '43.131.36.84'),
(316, '34.222.207.168'),
(317, '122.173.24.245'),
(318, '104.236.44.95'),
(319, '110.166.71.39'),
(320, '54.211.177.183'),
(321, '52.202.158.182'),
(322, '3.81.141.145'),
(323, '54.217.83.13'),
(324, '209.97.185.132'),
(325, '107.178.192.34'),
(326, '107.178.192.35'),
(327, '107.178.192.36'),
(328, '2a03:2880:31ff:4f::'),
(329, '2a03:2880:31ff:58::'),
(330, '2a03:2880:31ff:51::'),
(331, '2a03:2880:31ff:59::'),
(332, '2a03:2880:25ff:9::'),
(333, '2a03:2880:25ff:72::'),
(334, '2a03:2880:25ff:73::'),
(335, '2a03:2880:25ff:1::'),
(336, '2a03:2880:25ff:6::'),
(337, '2a03:2880:25ff:7::'),
(338, '2a03:2880:25ff:3::'),
(339, '2a03:2880:25ff:70::'),
(340, '2a03:2880:25ff:71::'),
(341, '2a03:2880:25ff:8::'),
(342, '2a03:2880:25ff:5::'),
(343, '2a03:2880:7ff:2::'),
(344, '69.171.234.6'),
(345, '2a03:2880:7ff:70::'),
(346, '2a03:2880:7ff:3::'),
(347, '2a03:2880:7ff:71::'),
(348, '2a03:2880:7ff:4::'),
(349, '2a03:2880:7ff:1::'),
(350, '2a03:2880:7ff:8::'),
(351, '2a03:2880:7ff:6::'),
(352, '2a03:2880:7ff:9::'),
(353, '2a03:2880:7ff::'),
(354, '2a03:2880:7ff:7::'),
(355, '203.2.64.59'),
(356, '65.1.66.45'),
(357, '213.180.203.6'),
(358, '87.250.224.95'),
(359, '43.245.86.60'),
(360, '125.94.144.102'),
(361, '38.54.89.153'),
(362, '2a02:c206:3015:2326::1'),
(363, '74.125.151.172'),
(364, '74.125.151.174'),
(365, '74.125.151.173'),
(366, '74.125.151.160'),
(367, '66.249.79.166'),
(368, '66.249.76.2'),
(369, '66.249.68.39'),
(370, '3.252.61.187'),
(371, '107.178.203.67'),
(372, '107.178.203.68'),
(373, '217.113.194.210'),
(374, '164.92.224.245'),
(375, '66.249.79.34'),
(376, '3.253.237.147'),
(377, '2a03:2880:30ff:3::'),
(378, '2a03:2880:30ff:1::'),
(379, '2a03:2880:30ff:2::'),
(380, '2a03:2880:30ff:70::'),
(381, '110.44.115.222'),
(382, '47.79.7.65'),
(383, '2a03:2880:30ff:7::'),
(384, '2a03:2880:30ff:74::'),
(385, '2a03:2880:12ff:74::'),
(386, '2a03:2880:12ff:70::'),
(387, '2a03:2880:12ff:72::'),
(388, '2a03:2880:12ff:8::'),
(389, '2a03:2880:12ff:1::'),
(390, '2a03:2880:12ff:4::'),
(391, '2a03:2880:12ff:7::'),
(392, '2a03:2880:12ff:73::'),
(393, '2a03:2880:12ff:9::'),
(394, '5.133.192.136'),
(395, '20.171.207.16'),
(396, '34.222.64.1'),
(397, '60.188.57.0'),
(398, '51.222.253.3'),
(399, '122.173.30.231'),
(400, '182.42.105.144'),
(401, '2607:a400:4:97::4'),
(402, '51.222.253.16'),
(403, '2a03:2880:22ff:4::'),
(404, '2a03:2880:22ff:c::'),
(405, '2a03:2880:22ff:72::'),
(406, '2a03:2880:22ff:73::'),
(407, '173.252.107.116'),
(408, '2a03:2880:22ff:3::'),
(409, '2a03:2880:22ff:d::'),
(410, '2a03:2880:22ff:b::'),
(411, '2a03:2880:22ff:8::'),
(412, '2a03:2880:22ff:5::'),
(413, '2a03:2880:22ff:43::'),
(414, '2a03:2880:22ff:71::'),
(415, '2a03:2880:22ff:9::'),
(416, '107.178.203.160'),
(417, '107.178.203.161'),
(418, '121.229.185.160'),
(419, '152.70.171.215'),
(420, '117.62.235.53'),
(421, '178.63.3.29'),
(422, '146.190.171.113'),
(423, '122.173.30.202'),
(424, '47.82.10.66'),
(425, '66.249.66.199'),
(426, '2a03:2880:11ff:74::'),
(427, '2a03:2880:11ff:6::'),
(428, '2a03:2880:11ff::'),
(429, '2a03:2880:11ff:b::'),
(430, '2a03:2880:11ff:7::'),
(431, '2a03:2880:11ff:71::'),
(432, '2a03:2880:11ff:5::'),
(433, '2a03:2880:11ff:2::'),
(434, '2a03:2880:11ff:a::'),
(435, '2a03:2880:11ff:70::'),
(436, '2a03:2880:11ff:41::'),
(437, '173.252.87.7'),
(438, '2a03:2880:11ff:73::'),
(439, '66.249.70.174'),
(440, '182.44.12.37'),
(441, '44.243.78.180'),
(442, '89.169.102.46'),
(443, '222.79.103.59'),
(444, '47.82.10.234'),
(445, '2602:fc2f:100:1400::a'),
(446, '107.174.244.108'),
(447, '107.174.244.108'),
(448, '176.65.134.179'),
(449, '14.215.163.132'),
(450, '140.245.60.134'),
(451, '196.251.81.49'),
(452, '57.151.78.25'),
(453, '2a03:2880:22ff:70::'),
(454, '2a03:2880:22ff:7::'),
(455, '2a03:2880:22ff:6::'),
(456, '173.252.107.113'),
(457, '2a03:2880:22ff::'),
(458, '2a03:2880:22ff:2::'),
(459, '144.76.22.38'),
(460, '2a0c:b641:3a1:1005::10c'),
(461, '34.82.244.149'),
(462, '43.166.128.187'),
(463, '184.154.139.9'),
(464, '18.223.235.97'),
(465, '167.99.89.45'),
(466, '173.212.240.93'),
(467, '47.82.9.116'),
(468, '192.36.136.8'),
(469, '192.121.136.190'),
(470, '192.36.198.147'),
(471, '192.165.45.205'),
(472, '192.36.172.171'),
(473, '192.36.119.194'),
(474, '192.36.121.172'),
(475, '192.36.173.21'),
(476, '51.222.253.8'),
(477, '13.39.84.142'),
(478, '113.199.208.60'),
(479, '142.93.99.16'),
(480, '206.189.11.127'),
(481, '47.82.10.222'),
(482, '84.8.142.45'),
(483, '182.44.67.97'),
(484, '196.251.81.58'),
(485, '3.92.169.120'),
(486, '3.90.33.202'),
(487, '180.110.203.108'),
(488, '103.10.28.184'),
(489, '72.146.40.59'),
(490, '107.173.160.135'),
(491, '207.46.13.36'),
(492, '122.173.31.220'),
(493, '158.69.65.200'),
(494, '67.227.152.36'),
(495, '178.79.178.111'),
(496, '52.27.223.122'),
(497, '196.251.72.3'),
(498, '122.173.26.237'),
(499, '2401:4900:1f33:844b:e6c7:7e7:de0c:bfdd'),
(500, '134.199.78.158'),
(501, '43.130.110.130'),
(502, '2001:67c:6ec:2913:145:220:91:19'),
(503, '145.220.91.19'),
(504, '168.151.233.248'),
(505, '2a03:2880:31ff:4e::'),
(506, '2c0f:6300:c05:3100:719a:83c:abe3:6b87'),
(507, '89.185.80.56'),
(508, '23.158.56.51'),
(509, '170.106.35.187'),
(510, '199.244.88.219'),
(511, '51.222.253.1'),
(512, '47.82.10.197'),
(513, '47.82.10.223'),
(514, '51.222.253.14'),
(515, '47.82.9.51'),
(516, '142.93.223.17'),
(517, '2a03:2880:32ff:4::'),
(518, '2a03:2880:32ff:2::'),
(519, '31.13.103.8'),
(520, '2a03:2880:32ff:1::'),
(521, '2a03:2880:32ff:9::'),
(522, '2a03:2880:32ff:70::'),
(523, '2a03:2880:32ff:72::'),
(524, '2a03:2880:32ff:71::'),
(525, '2a03:2880:32ff:74::'),
(526, '2a03:2880:32ff:7::'),
(527, '2a03:2880:32ff:6::'),
(528, '2a06:4883:d000::f4'),
(529, '2a03:b0c0:2:d0::1495:2001'),
(530, '217.170.194.172'),
(531, '156.146.63.171'),
(532, '2001:67c:289c:4::79'),
(533, '103.10.28.144'),
(534, '40.77.167.64'),
(535, '66.249.70.2'),
(536, '2a06:4882:1000::9'),
(537, '34.90.220.251'),
(538, '195.2.78.89'),
(539, '117.102.77.220'),
(540, '45.148.10.174'),
(541, '64.23.219.235'),
(542, '51.222.253.5'),
(543, '2a03:2880:32ff:3::'),
(544, '2a03:2880:32ff:5::'),
(545, '2a03:2880:32ff:73::'),
(546, '2a03:2880:32ff::'),
(547, '3.233.107.52'),
(548, '52.54.180.101'),
(549, '159.203.89.49'),
(550, '52.159.249.98'),
(551, '94.228.142.87'),
(552, '34.32.221.188'),
(553, '94.228.142.110'),
(554, '35.204.92.109'),
(555, '46.74.66.136'),
(556, '201.220.138.239'),
(557, '5.133.192.131'),
(558, '35.184.18.181'),
(559, '34.41.4.183'),
(560, '2a03:2880:f806:7::'),
(561, '2a03:2880:f806:1::'),
(562, '209.38.243.71'),
(563, '156.224.248.194'),
(564, '119.96.24.54'),
(565, '205.169.39.29'),
(566, '35.93.94.251'),
(567, '205.169.39.1'),
(568, '110.44.115.239'),
(569, '35.95.4.23'),
(570, '2a03:2880:30ff:7e::'),
(571, '2a03:2880:27ff:6::'),
(572, '2a03:2880:27ff:8::'),
(573, '2a03:2880:27ff:7::'),
(574, '2a03:2880:27ff:3::'),
(575, '2a03:2880:27ff:4::'),
(576, '2a03:2880:27ff:1::'),
(577, '2a03:2880:27ff:71::'),
(578, '2a03:2880:27ff:72::'),
(579, '2a03:2880:27ff:74::'),
(580, '2a03:2880:27ff:70::'),
(581, '2a03:2880:27ff:5::'),
(582, '2a03:2880:27ff:9::'),
(583, '2a03:2880:27ff:73::'),
(584, '2a03:2880:27ff::'),
(585, '63.117.14.68'),
(586, '198.92.97.36'),
(587, '193.239.160.12'),
(588, '2601:14b:4100:d680:ec71:3d06:4cd5:13e3'),
(589, '2607:fb91:89e:4848:20e3:dafb:4b1:7315'),
(590, '139.59.92.198'),
(591, '149.56.160.193'),
(592, '34.59.29.132'),
(593, '198.20.67.200'),
(594, '24.7.84.16'),
(595, '51.222.253.12'),
(596, '65.2.127.219'),
(597, '2401:4900:1c6a:61f9:b2fd:c25b:88f0:8a8c'),
(598, '3.8.204.65'),
(599, '122.173.29.186'),
(600, '122.173.26.223'),
(601, '43.153.122.30'),
(602, '122.173.26.120'),
(603, '2604:2dc0:100:19af::'),
(604, '147.135.70.175'),
(605, '34.230.10.96'),
(606, '184.154.139.26'),
(607, '54.91.23.236'),
(608, '120.89.104.17'),
(609, '184.154.76.34'),
(610, '2001:4860:7:70e::8'),
(611, '2001:4860:7:70e::4'),
(612, '217.113.194.209'),
(613, '2600:387:15:4810::9'),
(614, '23.27.211.204'),
(615, '184.174.46.60'),
(616, '45.38.45.147'),
(617, '209.127.191.166'),
(618, '164.92.196.39'),
(619, '106.215.148.53'),
(620, '13.83.167.140'),
(621, '13.83.167.135'),
(622, '13.83.167.139'),
(623, '13.83.167.143'),
(624, '2001:4860:7:505::f6'),
(625, '2001:4860:7:405::a0'),
(626, '2001:4860:7:505::bc'),
(627, '2001:4860:7:405::f5'),
(628, '2604:2dc0:200:1a84::'),
(629, '51.81.208.132'),
(630, '2401:4900:1f33:8926:ff4c:5f9e:c17b:5061'),
(631, '2401:4900:1f32:3954:b8f:cd30:f7f6:bfc1'),
(632, '110.44.115.203'),
(633, '110.249.201.134'),
(634, '110.249.202.166'),
(635, '93.158.70.111'),
(636, '192.121.134.92'),
(637, '151.248.1.103'),
(638, '192.36.53.210'),
(639, '178.73.233.115'),
(640, '185.12.150.17'),
(641, '165.227.239.53'),
(642, '34.55.216.123'),
(643, '64.225.52.102'),
(644, '88.210.10.79'),
(645, '220.247.167.21'),
(646, '2a03:2880:24ff:72::'),
(647, '2a03:2880:24ff:4d::'),
(648, '2a03:2880:24ff:71::'),
(649, '2a03:2880:24ff:74::'),
(650, '2a03:2880:24ff::'),
(651, '2a03:2880:24ff:48::'),
(652, '2a03:2880:24ff:42::'),
(653, '2a03:2880:24ff:70::'),
(654, '2a03:2880:24ff:4a::'),
(655, '2a03:2880:24ff:9::'),
(656, '2a03:2880:24ff:6::'),
(657, '2a03:2880:24ff:5::'),
(658, '2a03:2880:24ff:44::'),
(659, '2a03:2880:24ff:7::'),
(660, '2a03:2880:24ff:4c::'),
(661, '2a03:2880:24ff:1::'),
(662, '2a03:2880:24ff:2::'),
(663, '2a03:2880:24ff:73::'),
(664, '2a03:2880:24ff:3::'),
(665, '2a03:2880:24ff:4::'),
(666, '2a03:2880:24ff:49::'),
(667, '43.133.220.37'),
(668, '2401:4900:1f32:3954:76de:e62:b87c:3218'),
(669, '2401:4900:1f33:d5d:ac15:2c21:a6ed:6f84'),
(670, '66.249.89.39'),
(671, '66.249.89.33'),
(672, '199.244.88.223'),
(673, '80.85.245.187'),
(674, '183.91.75.2'),
(675, '122.173.30.168'),
(676, '2001:4860:7:505::f7'),
(677, '2001:4860:7:505::fc'),
(678, '115.178.25.82'),
(679, '80.85.246.214'),
(680, '103.149.194.104'),
(681, '177.152.106.68'),
(682, '15.204.73.228'),
(683, '2001:4860:7:505::fa'),
(684, '2001:4860:7:405::99'),
(685, '188.121.210.45'),
(686, '80.85.245.250'),
(687, '138.122.164.36'),
(688, '110.172.98.2');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_cities`
--
ALTER TABLE `admin_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_countries`
--
ALTER TABLE `admin_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notification`
--
ALTER TABLE `admin_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_notifications`
--
ALTER TABLE `all_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_images`
--
ALTER TABLE `category_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_images`
--
ALTER TABLE `cat_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_options`
--
ALTER TABLE `cat_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confessions`
--
ALTER TABLE `confessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confession_comment`
--
ALTER TABLE `confession_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confession_likes`
--
ALTER TABLE `confession_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `confession_views`
--
ALTER TABLE `confession_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_coupon_code_unique` (`coupon_code`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_of_before_apply_coupons`
--
ALTER TABLE `history_of_before_apply_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificationss`
--
ALTER TABLE `notificationss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_type`
--
ALTER TABLE `notification_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_adons`
--
ALTER TABLE `orders_adons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_reviews`
--
ALTER TABLE `order_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages__`
--
ALTER TABLE `pages__`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plans`
--
ALTER TABLE `payment_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_ads`
--
ALTER TABLE `products_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_c_vars`
--
ALTER TABLE `product_c_vars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_units`
--
ALTER TABLE `product_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_old`
--
ALTER TABLE `settings_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_languages`
--
ALTER TABLE `site_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_followers`
--
ALTER TABLE `store_followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_images`
--
ALTER TABLE `store_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_products`
--
ALTER TABLE `temporary_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary_products_ads`
--
ALTER TABLE `temporary_products_ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_ip`
--
ALTER TABLE `user_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `admin_cities`
--
ALTER TABLE `admin_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_countries`
--
ALTER TABLE `admin_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `admin_login_history`
--
ALTER TABLE `admin_login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_notification`
--
ALTER TABLE `admin_notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `all_notifications`
--
ALTER TABLE `all_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `category_images`
--
ALTER TABLE `category_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confessions`
--
ALTER TABLE `confessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confession_comment`
--
ALTER TABLE `confession_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confession_likes`
--
ALTER TABLE `confession_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `confession_views`
--
ALTER TABLE `confession_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history_of_before_apply_coupons`
--
ALTER TABLE `history_of_before_apply_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_adons`
--
ALTER TABLE `orders_adons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_reviews`
--
ALTER TABLE `order_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pages__`
--
ALTER TABLE `pages__`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_plans`
--
ALTER TABLE `payment_plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products_ads`
--
ALTER TABLE `products_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_c_vars`
--
ALTER TABLE `product_c_vars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_images`
--
ALTER TABLE `store_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temporary_products`
--
ALTER TABLE `temporary_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `temporary_products_ads`
--
ALTER TABLE `temporary_products_ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_ip`
--
ALTER TABLE `user_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=689;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
