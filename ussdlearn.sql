-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 04:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ussdlearn`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(11) NOT NULL,
  `agent_code` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `agent_code`, `full_name`, `pin`, `balance`, `created_at`) VALUES
(1, 'E1010', 'Elias', '5468', 999000.00, '2025-05-04 21:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session_id` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_id`, `phone_number`, `activity`, `created_at`) VALUES
(1, 'ATUid_081cec812ebd4342fd620f25e2478371', '+250785354935', '', '2025-05-04 20:04:42'),
(2, 'ATUid_081cec812ebd4342fd620f25e2478371', '+250785354935', '1', '2025-05-04 20:04:56'),
(3, 'ATUid_081cec812ebd4342fd620f25e2478371', '+250785354935', '1*Elias DUKUZUMUREMYI', '2025-05-04 20:05:08'),
(4, 'ATUid_081cec812ebd4342fd620f25e2478371', '+250785354935', '1*Elias DUKUZUMUREMYI*5468', '2025-05-04 20:05:18'),
(5, 'ATUid_081cec812ebd4342fd620f25e2478371', '+250785354935', '1*Elias DUKUZUMUREMYI*5468*5468', '2025-05-04 20:05:25'),
(6, 'ATUid_9442ab1eb887a47e23ef340395438f3b', '+250785354935', '', '2025-05-04 20:05:33'),
(7, 'ATUid_e0773b7c7b567c7b13ae76b6c08a865e', '+250785354935', '', '2025-05-04 20:20:55'),
(8, 'ATUid_e0773b7c7b567c7b13ae76b6c08a865e', '+250785354935', '3', '2025-05-04 20:21:04'),
(9, 'ATUid_7e410c3a7ece6ccbc683d8612d94e1ae', '+250785354935', '', '2025-05-04 20:21:13'),
(10, 'ATUid_7e410c3a7ece6ccbc683d8612d94e1ae', '+250785354935', '3', '2025-05-04 20:21:17'),
(11, 'ATUid_7e410c3a7ece6ccbc683d8612d94e1ae', '+250785354935', '3*5468', '2025-05-04 20:21:26'),
(12, 'ATUid_509a44be87087cc5a9055755b1b2543d', '+250785354935', '', '2025-05-04 20:21:30'),
(13, 'ATUid_509a44be87087cc5a9055755b1b2543d', '+250785354935', '2', '2025-05-04 20:21:36'),
(14, 'ATUid_509a44be87087cc5a9055755b1b2543d', '+250785354935', '2*5000', '2025-05-04 20:21:42'),
(15, 'ATUid_45987b29e14a51ea3dc6a630b55bbe01', '+250785354935', '', '2025-05-04 20:23:19'),
(16, 'ATUid_45987b29e14a51ea3dc6a630b55bbe01', '+250785354935', '1', '2025-05-04 20:23:26'),
(17, 'ATUid_2d5541db73001c8b0b336ecc8d29f6d6', '+250785354935', '', '2025-05-04 21:57:52'),
(18, 'ATUid_2d5541db73001c8b0b336ecc8d29f6d6', '+250785354935', '2', '2025-05-04 21:58:02'),
(19, 'ATUid_2d5541db73001c8b0b336ecc8d29f6d6', '+250785354935', '2*3000', '2025-05-04 21:58:11'),
(20, 'ATUid_2d5541db73001c8b0b336ecc8d29f6d6', '+250785354935', '2*3000*E1010', '2025-05-04 21:58:27'),
(21, 'ATUid_2d5541db73001c8b0b336ecc8d29f6d6', '+250785354935', '2*3000*E1010*5468', '2025-05-04 21:58:35'),
(22, 'ATUid_4f333c57f23fbd939d2c550008b55d35', '+250785354935', '', '2025-05-11 22:17:16'),
(23, 'ATUid_4f333c57f23fbd939d2c550008b55d35', '+250785354935', '3', '2025-05-11 22:17:22'),
(24, 'ATUid_4f333c57f23fbd939d2c550008b55d35', '+250785354935', '3*234', '2025-05-11 22:17:26'),
(25, 'ATUid_dba377be09797d2ea2f3548368334dfd', '+250785354935', '', '2025-05-11 22:17:29'),
(26, 'ATUid_dba377be09797d2ea2f3548368334dfd', '+250785354935', '3', '2025-05-11 22:17:34'),
(27, 'ATUid_dba377be09797d2ea2f3548368334dfd', '+250785354935', '3*1234', '2025-05-11 22:17:39'),
(28, 'ATUid_909a333fe78b4736c7c867702b461dce', '+250785354935', '', '2025-05-11 22:17:43'),
(29, 'ATUid_909a333fe78b4736c7c867702b461dce', '+250785354935', '3', '2025-05-11 22:18:11'),
(30, 'ATUid_909a333fe78b4736c7c867702b461dce', '+250785354935', '3*123', '2025-05-11 22:18:15'),
(31, 'ATUid_e0a91689d2b33d4d6b3062716c756f27', '+250785354935', '', '2025-05-11 22:18:18'),
(32, 'ATUid_e0a91689d2b33d4d6b3062716c756f27', '+250785354935', '3', '2025-05-11 22:18:22'),
(33, 'ATUid_e0a91689d2b33d4d6b3062716c756f27', '+250785354935', '3*12345', '2025-05-11 22:18:27'),
(34, 'ATUid_47ec9aeae402c85e30e49e99c9118d02', '+250785354935', '', '2025-05-11 22:18:33'),
(35, 'ATUid_47ec9aeae402c85e30e49e99c9118d02', '+250785354935', '3', '2025-05-11 22:18:37'),
(36, 'ATUid_47ec9aeae402c85e30e49e99c9118d02', '+250785354935', '3*5468', '2025-05-11 22:18:43'),
(37, 'ATUid_30d683c6827166044993170920c87537', '+250790055177', '', '2025-05-12 09:11:27'),
(38, 'ATUid_30d683c6827166044993170920c87537', '+250790055177', '1', '2025-05-12 09:11:35'),
(39, 'ATUid_30d683c6827166044993170920c87537', '+250790055177', '1*Ferdinant', '2025-05-12 09:11:43'),
(40, 'ATUid_30d683c6827166044993170920c87537', '+250790055177', '1*Ferdinant*00000', '2025-05-12 09:12:01'),
(41, 'ATUid_30d683c6827166044993170920c87537', '+250790055177', '1*Ferdinant*00000*00000', '2025-05-12 09:12:05'),
(42, 'ATUid_e91edd951d985363f9134c21b578e07d', '+250790055177', '', '2025-05-12 09:12:10'),
(43, 'ATUid_e91edd951d985363f9134c21b578e07d', '+250790055177', '3', '2025-05-12 09:12:16'),
(44, 'ATUid_e91edd951d985363f9134c21b578e07d', '+250790055177', '3*00000', '2025-05-12 09:12:24'),
(45, 'ATUid_2b1b7f915283c4026945357c7c9528d5', '+250790055177', '', '2025-05-12 09:12:51'),
(46, 'ATUid_2b1b7f915283c4026945357c7c9528d5', '+250790055177', '1', '2025-05-12 09:13:02'),
(47, 'ATUid_b9d02738a0b8b92fc97769a317d24988', '+250790055177', '', '2025-05-12 09:13:05'),
(48, 'ATUid_b9d02738a0b8b92fc97769a317d24988', '+250790055177', '2', '2025-05-12 09:13:08'),
(49, 'ATUid_b9d02738a0b8b92fc97769a317d24988', '+250790055177', '2*5000', '2025-05-12 09:13:13'),
(50, 'ATUid_b9d02738a0b8b92fc97769a317d24988', '+250790055177', '2*5000*E1010', '2025-05-12 09:13:40'),
(51, 'ATUid_b9d02738a0b8b92fc97769a317d24988', '+250790055177', '2*5000*E1010*00000', '2025-05-12 09:13:44'),
(52, 'ATUid_a1d6497c6b7219b839837d52d4710dbd', '+250790055177', '', '2025-05-12 09:18:03'),
(53, 'ATUid_c532fa06915c7d9ddd8380ce00391c5b', '+250782472651', '', '2025-05-12 09:18:35'),
(54, 'ATUid_c532fa06915c7d9ddd8380ce00391c5b', '+250782472651', '1', '2025-05-12 09:18:40'),
(55, 'ATUid_c532fa06915c7d9ddd8380ce00391c5b', '+250782472651', '1*Feza', '2025-05-12 09:18:45'),
(56, 'ATUid_c532fa06915c7d9ddd8380ce00391c5b', '+250782472651', '1*Feza*00000', '2025-05-12 09:18:50'),
(57, 'ATUid_c532fa06915c7d9ddd8380ce00391c5b', '+250782472651', '1*Feza*00000*00000', '2025-05-12 09:18:55'),
(58, 'ATUid_e0c9013c38193d9c0f0678f2a25de00c', '+250782472651', '', '2025-05-12 09:18:58'),
(59, 'ATUid_e0c9013c38193d9c0f0678f2a25de00c', '+250782472651', '3', '2025-05-12 09:19:01'),
(60, 'ATUid_e0c9013c38193d9c0f0678f2a25de00c', '+250782472651', '3*00000', '2025-05-12 09:19:06'),
(61, '', '', '', '2025-05-12 10:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `sender_phone` varchar(20) DEFAULT NULL,
  `recipient_phone` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('send','withdraw') NOT NULL,
  `agent_code` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `sender_phone`, `recipient_phone`, `amount`, `type`, `agent_code`, `created_at`) VALUES
(1, '+250785354935', NULL, 3000.00, 'withdraw', 'E1010', '2025-05-04 21:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `pin` varchar(10) NOT NULL,
  `balance` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `phone_number`, `full_name`, `pin`, `balance`, `created_at`) VALUES
(1, '+250785354935', 'Elias DUKUZUMUREMYI', '5468', 47000.00, '2025-05-04 20:05:25'),
(2, '+250790055177', 'Ferdinant', '00000', 0.00, '2025-05-12 09:12:05'),
(3, '+250782472651', 'Feza', '00000', 400.00, '2025-05-12 09:18:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agent_code` (`agent_code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
