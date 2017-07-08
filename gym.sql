-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2017 at 03:44 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gym`
--

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE `exercise` (
  `id_e` int(10) UNSIGNED NOT NULL,
  `mc_id` int(10) UNSIGNED DEFAULT NULL,
  `name_e` varchar(56) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `exercise`
--

INSERT INTO `exercise` (`id_e`, `mc_id`, `name_e`) VALUES
(1, 1, 'Bench Press'),
(2, 1, 'Incline Bench Press'),
(3, 1, 'Decline Bench Press'),
(4, 1, 'Dips For Chest'),
(5, 1, 'Pec-Deck Machine '),
(6, 1, 'Cable Fly'),
(7, 2, ' Barbell Curl'),
(8, 2, 'Dumbbell Curl'),
(9, 2, 'Cable Curl'),
(10, 2, 'Concentration Curls'),
(11, 2, ' Triceps Pushdown'),
(12, 2, 'Bench Dips'),
(13, 2, ' Dumbbell Triceps Extension'),
(14, 2, 'Cable Triceps Extension'),
(15, 3, 'Dumbbell Shoulder Press'),
(16, 3, 'Front Raise'),
(17, 3, 'Machine Shoulder (Military) Press'),
(18, 3, 'Side Lateral Raise'),
(19, 3, ' One-Arm Side Laterals'),
(20, 3, 'Standing Low-Pulley Deltoid Raise'),
(21, 3, ' Reverse Machine Flyes'),
(22, 3, 'Seated Bent-Over Rear Delt Raise'),
(23, 3, 'Face Pulls'),
(24, 4, 'Barbell Deadlift'),
(25, 4, 'Bent-Over Barbell Deadlift'),
(26, 4, 'Wide-Grip Pull-Up'),
(27, 4, 'Wide-Grip Seated Cable Row'),
(28, 4, 'Close-Grip Pull-Down'),
(29, 4, 'Single-Arm Dumbbell Row'),
(30, 4, 'Decline Bench Dumbbell Pull-Over'),
(31, 4, 'Standing T-Bar Row'),
(32, 4, 'Muscle up'),
(33, 4, 'L-sit'),
(34, 5, 'Barbell Squat'),
(35, 5, 'Leg Press'),
(36, 5, 'Dumbbell Walking Lunge'),
(37, 5, 'Leg Extensions'),
(38, 5, 'Lying Leg Curls'),
(39, 5, 'Standing Calf Raises'),
(40, 5, 'Floor Glute-Ham Raise'),
(41, 5, 'Bulgarian Split Lunges'),
(42, 6, 'Ab wheel rollout'),
(43, 6, 'Flutter kick'),
(44, 6, 'Horizontal cable woodchop'),
(45, 6, 'Leg raise'),
(46, 6, 'Medicine ball russian twist'),
(47, 6, 'The Dragon Flag'),
(48, 6, 'Plank'),
(49, 6, 'Side plank'),
(50, 6, 'Sit-up'),
(51, 6, 'Pullup to knee raise');

-- --------------------------------------------------------

--
-- Table structure for table `gym_buddies`
--

CREATE TABLE `gym_buddies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `friend_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gym_buddies`
--

INSERT INTO `gym_buddies` (`id`, `user_id`, `friend_id`) VALUES
(123, 13, 1),
(127, 4, 1),
(129, 3, 1),
(106, 5, 1),
(103, 1, 5),
(136, 7, 3),
(131, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` datetime DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `date`, `msg`) VALUES
(8, '2017-05-22 09:15:34', '3fast(1) deleted picture Joker'),
(7, '2017-05-22 09:15:26', '3fast(1) added picture Joker'),
(9, '2017-05-22 09:16:35', '3fast(1) added picture Lmao'),
(10, '2017-05-22 09:16:37', '3fast(1) deleted picture Lmao'),
(11, '2017-05-22 09:18:58', '3fast(1) added picture Some nigga'),
(12, '2017-05-22 09:20:50', '3fast(1) has updated information'),
(13, '2017-05-22 09:23:41', '3fast(1) has updated information'),
(14, '2017-05-22 09:23:41', '3fast(1) has new credetials: gname=3fast2, name=Jovan, lname=R'),
(15, '2017-05-22 09:24:45', '3fast2(1) has updated information'),
(16, '2017-05-22 09:24:45', '3fast2(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(17, '2017-05-22 09:47:00', '3fast(1) is now friend with 4you(2)'),
(18, '2017-05-22 09:54:26', '4you(2) and 3fast(1) are no longer friends'),
(21, '2017-05-22 09:56:00', '4you(2) wants to be friend with 3fast(1)'),
(22, '2017-05-22 09:56:09', '4you(2) revoked friend request for 3fast(1)'),
(23, '2017-05-22 09:56:29', '4you(2) wants to be friend with 3fast(1)'),
(24, '2017-05-22 09:56:39', 'm8(3) and 3fast(1) are no longer friends'),
(25, '2017-05-22 09:56:39', 'm8(3) wants to be friend with 3fast(1)'),
(26, '2017-05-22 09:57:00', '3fast(1) is now friend with 4you(2)'),
(27, '2017-05-22 09:57:07', '3fast(1) declined friend request from m8(3)'),
(28, '2017-05-22 09:57:33', '3fast(1) wants to be friend with m8(3)'),
(29, '2017-05-22 09:57:42', 'm8(3) declined friend request from 3fast(1)'),
(32, '2017-05-22 10:02:42', 'damn(5) changed his password'),
(33, '2017-05-22 10:03:33', 'damn(5) changed his password'),
(34, '2017-05-22 10:07:12', 'damn(5) changed his password'),
(35, '2017-05-22 10:09:45', 'damn(5) changed his password'),
(44, '2017-05-26 08:53:57', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(43, '2017-05-26 08:53:57', '3fast(1) has updated information'),
(42, '2017-05-22 10:57:17', 'dna() created account'),
(41, '2017-05-22 10:55:01', 'dna() created account'),
(45, '2017-05-26 08:53:57', '3fast(1) has updated profile picture'),
(46, '2017-05-26 10:25:04', 'humble created account'),
(47, '2017-05-26 10:34:17', 'humble created account'),
(48, '2017-05-26 10:44:47', 'humble created account'),
(49, '2017-05-26 11:01:36', 'humble(10) changed his password'),
(50, '2017-05-26 11:03:14', 'humble(10) changed his password'),
(51, '2017-05-26 21:42:05', '4you(2) and 3fast(1) are no longer friends'),
(52, '2017-05-26 21:42:06', '4you(2) wants to be friend with 3fast(1)'),
(53, '2017-05-29 07:43:14', 'humble created account'),
(54, '2017-05-29 07:48:37', 'humble created account'),
(55, '2017-05-29 07:57:46', 'humble(12) changed his password'),
(56, '2017-05-29 14:46:20', 'pilistorac created account'),
(57, '2017-05-29 14:47:22', 'pilistorac(13) has updated information'),
(58, '2017-05-29 14:47:22', 'pilistorac(13) has new credetials: gname=dikili, name=Husein, lname=Adamovic'),
(59, '2017-05-29 14:47:22', 'pilistorac(13) has updated profile picture'),
(60, '2017-05-29 14:48:19', 'dikili(13) wants to be friend with 3fast(1)'),
(61, '2017-05-29 14:48:46', '3fast(1) is now friend with pilistorac(13)'),
(62, '2017-05-29 14:48:48', '3fast(1) declined friend request from 4you(2)'),
(63, '2017-05-29 16:37:53', '3fast(1) wants to be friend with 4you(2)'),
(64, '2017-05-29 16:37:55', '3fast(1) revoked friend request for 4you(2)'),
(65, '2017-05-29 23:27:48', '3fast(1) added picture Death'),
(66, '2017-05-29 23:29:28', '3fast(1) added picture Lmao'),
(67, '2017-05-29 23:29:42', '3fast(1) added picture Some nigga'),
(68, '2017-05-29 23:31:45', '3fast(1) deleted picture Some nigga'),
(69, '2017-05-29 23:31:47', '3fast(1) deleted picture Lmao'),
(70, '2017-05-29 23:31:48', '3fast(1) deleted picture Death'),
(71, '2017-05-29 23:31:56', '3fast(1) added picture Some nigga'),
(72, '2017-05-29 23:37:16', '3fast(1) added picture Some nigga'),
(73, '2017-05-29 23:37:43', '3fast(1) deleted picture Some nigga'),
(74, '2017-05-29 23:37:44', '3fast(1) deleted picture Some nigga'),
(75, '2017-05-29 23:37:51', '3fast(1) added picture Some nigga'),
(76, '2017-05-29 23:43:42', '3fast(1) added picture Some nigga'),
(77, '2017-05-29 23:44:30', '3fast(1) added picture Some nigga'),
(78, '2017-05-29 23:44:32', '3fast(1) deleted picture Some nigga'),
(79, '2017-05-29 23:44:33', '3fast(1) deleted picture Some nigga'),
(80, '2017-05-29 23:44:34', '3fast(1) deleted picture Some nigga'),
(81, '2017-05-29 23:45:08', '3fast(1) added picture Some nigga'),
(82, '2017-05-29 23:45:32', '3fast(1) added picture Some nigga'),
(83, '2017-05-29 23:46:10', '3fast(1) added picture Some nigga'),
(84, '2017-05-29 23:46:12', '3fast(1) deleted picture Some nigga'),
(85, '2017-05-29 23:46:12', '3fast(1) deleted picture Some nigga'),
(86, '2017-05-29 23:46:13', '3fast(1) deleted picture Some nigga'),
(87, '2017-05-29 23:51:25', '3fast(1) has updated information'),
(88, '2017-05-29 23:51:25', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(89, '2017-05-29 23:51:26', '3fast(1) has updated profile picture'),
(90, '2017-05-29 23:52:17', '3fast(1) has updated information'),
(91, '2017-05-29 23:52:17', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(92, '2017-05-29 23:52:17', '3fast(1) has updated profile picture'),
(93, '2017-05-29 23:52:53', '3fast(1) has updated information'),
(94, '2017-05-29 23:52:53', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(95, '2017-05-29 23:52:53', '3fast(1) has updated profile picture'),
(96, '2017-05-30 22:13:02', '3fast(1) added picture Joker'),
(97, '2017-05-30 22:13:32', '3fast(1) added picture Joker'),
(98, '2017-05-30 22:13:45', '3fast(1) has updated information'),
(99, '2017-05-30 22:13:45', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(100, '2017-05-30 22:13:46', '3fast(1) has updated profile picture'),
(101, '2017-05-30 22:15:52', '3fast(1) has updated information'),
(102, '2017-05-30 22:15:52', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(103, '2017-05-30 22:15:52', '3fast(1) has updated profile picture'),
(104, '2017-05-30 22:17:05', '3fast(1) has updated information'),
(105, '2017-05-30 22:17:05', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(106, '2017-05-30 22:17:05', '3fast(1) has updated profile picture'),
(107, '2017-05-30 22:22:01', '3fast(1) has updated information'),
(108, '2017-05-30 22:22:01', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(109, '2017-05-30 22:22:02', '3fast(1) has updated profile picture'),
(110, '2017-05-30 22:26:06', '3fast(1) has updated information'),
(111, '2017-05-30 22:26:06', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(112, '2017-05-30 22:26:06', '3fast(1) has updated profile picture'),
(113, '2017-05-30 22:26:26', '3fast(1) has updated information'),
(114, '2017-05-30 22:26:26', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(115, '2017-05-30 22:26:26', '3fast(1) has updated profile picture'),
(116, '2017-05-30 22:30:54', '3fast(1) has updated information'),
(117, '2017-05-30 22:30:54', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(118, '2017-05-30 22:30:54', '3fast(1) has updated profile picture'),
(119, '2017-05-30 22:36:57', '3fast(1) has updated information'),
(120, '2017-05-30 22:36:57', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(121, '2017-05-30 22:36:57', '3fast(1) has updated profile picture'),
(122, '2017-05-30 22:37:30', '3fast(1) has updated information'),
(123, '2017-05-30 22:37:30', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(124, '2017-05-30 22:37:30', '3fast(1) has updated profile picture'),
(125, '2017-05-30 23:49:33', '4you(2) has updated information'),
(126, '2017-05-30 23:49:33', '4you(2) has new credetials: gname=4you, name=, lname='),
(127, '2017-05-30 23:49:33', '4you(2) has updated profile picture'),
(128, '2017-05-30 23:49:54', 'm8(3) has updated information'),
(129, '2017-05-30 23:49:54', 'm8(3) has new credetials: gname=m8, name=, lname='),
(130, '2017-05-30 23:49:54', 'm8(3) has updated profile picture'),
(131, '2017-05-30 23:50:14', 'brah(4) has updated information'),
(132, '2017-05-30 23:50:14', 'brah(4) has new credetials: gname=brah, name=, lname='),
(133, '2017-05-30 23:50:14', 'brah(4) has updated profile picture'),
(134, '2017-05-30 23:50:29', 'damn(5) has updated information'),
(135, '2017-05-30 23:50:29', 'damn(5) has new credetials: gname=damn, name=, lname='),
(136, '2017-05-30 23:50:29', 'damn(5) has updated profile picture'),
(137, '2017-05-30 23:51:02', 'dna(7) has updated information'),
(138, '2017-05-30 23:51:02', 'dna(7) has new credetials: gname=dna, name=, lname='),
(139, '2017-05-30 23:51:02', 'dna(7) has updated profile picture'),
(140, '2017-05-30 23:51:28', 'humble(12) has updated information'),
(141, '2017-05-30 23:51:28', 'humble(12) has new credetials: gname=humble, name=, lname='),
(142, '2017-05-30 23:51:29', 'humble(12) has updated profile picture'),
(143, '2017-05-31 00:16:51', '3fast(1) wants to be friend with 4you(2)'),
(144, '2017-05-31 00:35:28', 'm8(3) wants to be friend with 3fast(1)'),
(145, '2017-05-31 17:13:34', '3fast(1) has updated information'),
(146, '2017-05-31 17:13:34', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(147, '2017-05-31 17:13:34', '3fast(1) has updated profile picture'),
(148, '2017-06-01 21:12:28', '3fast(1) has updated information'),
(149, '2017-06-01 21:12:28', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(150, '2017-06-01 21:12:29', '3fast(1) has updated profile picture'),
(151, '2017-06-01 21:13:36', '3fast(1) has updated information'),
(152, '2017-06-01 21:13:36', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(153, '2017-06-01 21:13:36', '3fast(1) has updated profile picture'),
(154, '2017-06-01 21:18:17', '3fast(1) has updated information'),
(155, '2017-06-01 21:18:17', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(156, '2017-06-01 21:18:18', '3fast(1) has updated profile picture'),
(157, '2017-06-03 11:45:05', '3fast(1) has updated information'),
(158, '2017-06-03 11:45:05', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(159, '2017-06-03 11:45:06', '3fast(1) has updated profile picture'),
(160, '2017-06-03 11:45:15', '3fast(1) has updated information'),
(161, '2017-06-03 11:45:15', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(162, '2017-06-03 11:45:15', '3fast(1) has updated profile picture'),
(163, '2017-06-03 11:46:50', '3fast(1) has updated information'),
(164, '2017-06-03 11:46:50', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(165, '2017-06-03 11:46:50', '3fast(1) has updated profile picture'),
(166, '2017-06-03 11:52:53', '3fast(1) has updated information'),
(167, '2017-06-03 11:52:53', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(168, '2017-06-03 11:52:53', '3fast(1) has updated profile picture'),
(169, '2017-06-03 11:58:42', '3fast(1) has updated information'),
(170, '2017-06-03 11:58:42', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(171, '2017-06-03 11:58:42', '3fast(1) has updated profile picture'),
(172, '2017-06-03 11:58:51', '3fast(1) has updated information'),
(173, '2017-06-03 11:58:51', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(174, '2017-06-03 11:58:51', '3fast(1) has updated profile picture'),
(175, '2017-06-03 11:58:58', '3fast(1) has updated information'),
(176, '2017-06-03 11:58:58', '3fast(1) has new credetials: gname=3fast, name=Jovan, lname=Radenkovic'),
(177, '2017-06-03 11:58:58', '3fast(1) has updated profile picture'),
(178, '2017-06-03 13:41:03', '3fast(1) has updated profile information'),
(179, '2017-06-05 13:43:57', '3fast(1) has logged out.'),
(180, '2017-06-01 00:00:00', 'test created account'),
(181, '2017-06-05 23:47:02', 'test(14) has logged in.'),
(182, '2017-06-05 23:48:28', 'test(14) has logged out.'),
(183, '2017-06-06 00:02:16', '3fast(1) has logged in.'),
(184, '2017-06-06 00:04:12', '3fast(1) has logged out.'),
(185, '2017-06-07 13:24:26', '3fast(1) has logged in.'),
(186, '2017-06-07 13:24:37', '3fast(1) wants to be friend with brah(4)'),
(187, '2017-06-26 11:24:13', '3fast(1) has logged out.'),
(188, '2017-06-26 11:25:50', '3fast(1) has logged in.'),
(189, '2017-06-26 11:39:39', '3fast(1) has logged out.'),
(190, '2017-06-26 11:39:53', '3fast(1) has logged in.'),
(191, '2017-06-26 11:47:31', '3fast(1) has updated profile information'),
(192, '2017-06-26 11:56:56', '3fast(1) has logged out.'),
(193, '2017-06-26 11:57:06', '3fast(1) has logged in.'),
(194, '2017-06-26 11:59:25', '3fast(1) has logged out.'),
(195, '2017-06-26 11:59:41', '3fast(1) has logged in.'),
(196, '2017-06-26 12:37:11', '3fast(1) has updated profile information'),
(197, '2017-06-26 12:37:22', '3fast(1) has updated profile information'),
(198, '2017-06-26 12:37:32', '3fast(1) has updated profile information'),
(199, '2017-06-26 12:40:18', '3fast(1) has updated profile information'),
(200, '2017-06-26 12:40:28', '3fast(1) has updated profile information'),
(201, '2017-06-26 12:40:34', '3fast(1) has updated profile information'),
(202, '2017-06-26 12:40:44', '3fast(1) has updated profile information'),
(203, '2017-06-26 12:40:51', '3fast2(1) has updated profile information'),
(204, '2017-06-26 12:41:44', '3fast(1) has updated profile information'),
(205, '2017-06-26 12:41:48', '3fast(1) has updated profile information'),
(206, '2017-06-26 12:49:33', '3fast(1) has updated profile information'),
(207, '2017-06-26 12:50:37', '3fast(1) has updated profile information'),
(208, '2017-06-26 12:50:56', '3fast(1) has updated profile information'),
(209, '2017-06-26 12:53:54', '3fast(1) has logged out.'),
(210, '2017-06-26 12:54:12', '3fast(1) has logged in.'),
(211, '2017-06-26 13:05:21', '3fast(1) has updated profile information'),
(212, '2017-06-26 23:21:02', '3fast(1) has logged in.'),
(213, '2017-06-27 13:07:39', '3fast(1) has logged in.'),
(214, '2017-06-27 13:30:07', '3fast(1) has logged in.'),
(215, '2017-06-27 13:38:43', '3fast(1) has logged out.'),
(216, '2017-06-27 13:38:52', '3fast(1) has logged in.'),
(217, '2017-06-27 13:38:58', '3fast(1) has logged out.'),
(218, '2017-06-27 13:39:02', '3fast(1) has logged in.'),
(219, '2017-06-27 13:45:14', '3fast(1) has logged out.'),
(220, '2017-06-27 13:45:18', '4you(2) has logged in.'),
(221, '2017-06-27 13:46:00', '4you(2) added picture Watch Dogs 2'),
(222, '2017-06-27 14:00:38', '4you(2) added picture Wd 2'),
(223, '2017-06-27 14:01:30', '4you(2) added picture wd2'),
(224, '2017-06-27 14:01:48', '4you(2) added picture wd2'),
(225, '2017-06-27 16:38:16', '4you(2) has logged out.'),
(226, '2017-06-27 16:51:32', '3fast(1) has logged in.'),
(227, '2017-06-29 14:25:53', '3fast(1) has logged out.'),
(228, '2017-06-29 14:27:39', '3fast(1) has logged in.'),
(229, '2017-06-29 15:49:13', '3fast(1) added picture jhvjh'),
(230, '2017-06-29 15:52:44', '3fast(1) has logged out.'),
(231, '2017-06-29 15:52:54', '3fast(1) has logged in.'),
(232, '2017-06-29 15:53:30', '3fast(1) has logged out.'),
(233, '2017-06-29 15:54:09', '3fast(1) has logged in.'),
(234, '2017-06-29 16:14:40', '3fast(1) has logged out.'),
(235, '2017-06-29 16:20:00', '3fast(1) has logged in.'),
(236, '2017-06-29 16:30:14', '3fast(1) has logged out.'),
(237, '2017-06-29 16:30:18', '4you(2) has logged in.'),
(238, '2017-06-29 16:32:01', '4you(2) has logged out.'),
(239, '2017-06-29 16:32:05', '3fast(1) has logged in.'),
(240, '2017-06-29 16:36:51', '3fast(1) has logged out.'),
(241, '2017-06-29 16:36:58', '3fast(1) has logged in.'),
(242, '2017-06-29 16:37:04', '3fast(1) has logged out.'),
(243, '2017-06-29 16:37:07', '4you(2) has logged in.'),
(244, '2017-06-29 16:37:12', '4you(2) has logged out.'),
(245, '2017-06-29 16:37:15', '3fast(1) has logged in.'),
(246, '2017-06-29 16:53:05', '3fast(1) has logged out.'),
(247, '2017-06-29 16:53:19', '3fast(1) has logged in.'),
(248, '2017-06-29 16:54:31', '3fast(1) has logged out.'),
(249, '2017-06-29 16:58:24', '3fast(1) has logged in.'),
(250, '2017-06-29 17:00:03', '3fast(1) has logged out.'),
(251, '2017-06-29 17:00:08', '4you(2) has logged in.'),
(252, '2017-06-29 17:03:29', '4you(2) has logged out.'),
(253, '2017-06-29 17:03:40', '3fast(1) has logged in.'),
(254, '2017-06-29 17:04:12', '3fast(1) has logged out.'),
(255, '2017-06-29 17:05:12', '4you(2) has logged in.'),
(256, '2017-06-29 17:06:00', '4you(2) has logged out.'),
(257, '2017-06-29 17:06:10', '3fast(1) has logged in.'),
(258, '2017-06-29 17:08:36', '3fast(1) has logged out.'),
(259, '2017-06-29 17:13:23', '4you(2) has logged in.'),
(260, '2017-06-29 18:22:36', '4you(2) deleted picture Watch Dogs 2'),
(261, '2017-06-29 18:23:26', '4you(2) deleted picture Wd 2'),
(262, '2017-06-29 18:23:46', '4you(2) deleted picture Wd 2'),
(263, '2017-06-29 18:29:17', '4you(2) declined friend request from 3fast(1)'),
(264, '2017-06-29 21:42:41', '4you(2) has updated profile information'),
(265, '2017-06-29 21:42:55', '4you(2) has updated profile information'),
(266, '2017-06-29 21:46:13', '4you(2) has updated profile information'),
(267, '2017-06-29 21:46:53', '4you(2) has updated profile information'),
(268, '2017-06-29 21:47:23', '4you(2) has updated profile information'),
(269, '2017-06-29 21:47:49', '4you(2) has updated profile information'),
(270, '2017-06-29 21:48:36', '4you(2) has updated profile information'),
(271, '2017-06-29 21:49:02', '4you(2) has updated profile information'),
(272, '2017-06-29 21:49:16', '4you(2) has updated profile information'),
(273, '2017-06-29 21:49:46', '4you(2) has updated profile information'),
(274, '2017-06-29 21:49:49', '4you(2) has updated profile information'),
(275, '2017-06-29 21:49:57', '4you(2) has updated profile information'),
(276, '2017-06-29 21:50:35', '4you(2) has updated profile information'),
(277, '2017-06-29 21:51:07', '4you(2) has updated profile information'),
(278, '2017-06-29 21:51:30', '4you(2) has updated profile information'),
(279, '2017-06-29 21:52:08', '4you(2) has updated profile information'),
(280, '2017-06-29 21:53:29', '4you(2) has updated profile information'),
(281, '2017-06-29 21:53:31', '4you(2) has updated profile information'),
(282, '2017-06-29 21:53:58', '4you(2) has updated profile information'),
(283, '2017-06-29 21:54:19', '4you(2) has updated profile information'),
(284, '2017-06-29 21:55:10', '4you(2) has updated profile information'),
(285, '2017-06-29 21:55:27', '4you(2) has updated profile information'),
(286, '2017-06-29 21:56:02', '4you(2) has updated profile information'),
(287, '2017-06-29 21:56:22', '4you(2) has updated profile information'),
(288, '2017-06-29 21:56:41', '4you(2) has updated profile information'),
(289, '2017-06-29 22:01:50', '4you(2) has logged out.'),
(290, '2017-06-29 22:02:20', '4you(2) has logged in.'),
(291, '2017-06-29 22:05:19', '4you(2) has logged out.'),
(292, '2017-06-29 22:05:24', '4you(2) has logged in.'),
(293, '2017-06-29 22:30:58', '4you(2) has logged out.'),
(294, '2017-06-29 22:31:09', '4you(2) has logged in.'),
(295, '2017-06-29 22:33:08', '4you(2) has logged out.'),
(296, '2017-06-29 22:35:16', 'm8(3) has logged in.'),
(297, '2017-06-29 22:35:28', 'm8(3) added picture The Crew'),
(298, '2017-06-29 22:35:42', 'm8(3) has logged out.'),
(299, '2017-06-29 22:37:24', '4you(2) has logged in.'),
(300, '2017-06-29 22:41:06', '4you(2) has logged out.'),
(301, '2017-06-29 22:41:10', '3fast(1) has logged in.'),
(302, '2017-06-29 22:42:09', '3fast(1) has logged out.'),
(303, '2017-06-29 22:42:12', '4you(2) has logged in.'),
(304, '2017-06-29 22:43:40', '4you(2) has updated profile information'),
(305, '2017-06-29 22:43:46', '4you(2) has updated profile information'),
(306, '2017-06-29 22:43:54', '4you(2) has logged out.'),
(307, '2017-06-29 22:47:36', 'aaa@aaa.aaa(1) has logged in.'),
(308, '2017-06-29 22:54:05', '3fast(1) has logged out.'),
(309, '2017-06-29 22:54:10', '3fast() didnt enter all fields.'),
(310, '2017-06-29 22:55:10', 'aaa@aaa.aaa() didnt enter all fields.'),
(311, '2017-06-29 22:56:55', '3fa() didnt enter all fields.'),
(312, '2017-06-29 22:57:19', 'Someone entered wrong gym_name.'),
(313, '2017-06-29 22:58:01', 'Someone entered wrong email.'),
(314, '2017-06-29 22:58:46', 'aaa@aaa.aaa() has entered wrong password.'),
(315, '2017-06-29 23:01:24', '() didnt enter all fields.'),
(316, '2017-06-29 23:01:50', '() didnt enter all fields.'),
(317, '2017-06-29 23:03:49', '() didnt enter all fields in pass change.'),
(318, '2017-06-29 23:04:34', '3fast(1) didnt enter all fields corectly.'),
(319, '2017-06-29 23:06:12', '3fast(1) has logged in.'),
(320, '2017-06-30 08:51:22', '3fast(1) has logged out.'),
(321, '2017-06-30 22:44:11', '3fast(1) has logged in.'),
(322, '2017-06-30 22:47:18', '3fast(1) has logged out.'),
(323, '2017-06-30 22:47:36', '3fast(1) has logged in.'),
(324, '2017-06-30 23:33:52', '3fast(1) is now following 4you(2)'),
(325, '2017-06-30 23:33:56', '3fast(1) is no longer following (2)'),
(326, '2017-06-30 23:48:28', '3fast(1) has logged out.'),
(327, '2017-07-02 08:33:03', '3fast(1) has logged in.'),
(328, '2017-07-02 08:34:48', '3fast(1) has logged out.'),
(329, '2017-07-02 08:34:55', '3fast(1) has logged in.'),
(330, '2017-07-02 09:20:46', '3fast(1) is no longer following (13)'),
(331, '2017-07-03 20:53:28', '3fast(1) has logged out.'),
(332, '2017-07-03 20:53:35', '3fast(1) has logged in.'),
(333, '2017-07-03 21:28:18', '3fast(1) has logged out.'),
(334, '2017-07-03 21:28:54', '3fast(1) has logged in.'),
(335, '2017-07-03 21:31:12', '3fast(1) has logged out.'),
(336, '2017-07-03 21:32:08', '3fast(1) has logged in.'),
(337, '2017-07-03 21:39:35', '3fast(1) has logged out.'),
(338, '2017-07-03 21:41:53', '3fast(1) has logged in.'),
(339, '2017-07-03 22:42:47', '3fast(1) has logged out.'),
(340, '2017-07-03 22:46:53', '4you() has entered wrong password.'),
(341, '2017-07-03 22:46:59', '4you(2) has logged in.'),
(342, '2017-07-03 22:47:15', '4you(2) has logged out.'),
(343, '2017-07-03 22:47:19', 'm8(3) has logged in.'),
(344, '2017-07-03 22:47:28', 'm8(3) is now following 3fast(1)'),
(345, '2017-07-03 22:47:47', 'm8(3) has logged out.'),
(346, '2017-07-04 08:34:17', '3fast(1) has logged in.'),
(347, '2017-07-05 00:51:46', '3fast(1) has logged out.'),
(348, '2017-07-05 00:52:06', '4you(2) has logged in.'),
(349, '2017-07-05 00:53:00', '4you(2) has logged out.'),
(350, '2017-07-05 00:53:10', '3fast(1) has logged in.'),
(351, '2017-07-06 01:12:44', '3fast(1) has logged in.'),
(352, '2017-07-06 14:58:14', '3fast(1) has logged in.'),
(353, '2017-07-06 16:59:58', '3fast(1) has logged out.'),
(354, '2017-07-06 17:00:04', '4you(2) has logged in.'),
(355, '2017-07-06 17:24:49', '4you(2) has logged out.'),
(356, '2017-07-06 17:25:00', '3fast(1) has logged in.'),
(357, '2017-07-06 17:55:49', '3fast(1) is no longer following (3)'),
(358, '2017-07-06 17:55:56', '3fast(1) is now following m8(3)'),
(359, '2017-07-06 17:56:40', '3fast(1) is no longer following (3)'),
(360, '2017-07-06 17:56:42', '3fast(1) is now following m8(3)'),
(361, '2017-07-06 17:58:20', '3fast(1) has logged out.'),
(362, '2017-07-06 22:15:57', '3fast(1) has logged in.'),
(363, '2017-07-06 22:18:55', '3fast(1) has logged out.'),
(364, '2017-07-07 11:39:56', '3fast(1) has logged in.'),
(365, '2017-07-07 12:14:24', '3fast(1) has logged out.'),
(366, '2017-07-07 12:14:29', '4you(2) has logged in.'),
(367, '2017-07-07 12:46:21', '4you(2) has logged out.'),
(368, '2017-07-07 22:28:45', '3fast(1) has logged in.'),
(369, '2017-07-07 22:29:08', '3fast(1) has logged out.'),
(370, '2017-07-07 22:36:01', '3fast(1) has logged in.'),
(371, '2017-07-08 00:35:35', '3fast(1) has logged out.'),
(374, '2017-07-08 10:48:29', '3fast(1) has logged in.'),
(375, '2017-07-08 10:56:10', '3fast(1) has logged out.'),
(376, '2017-07-08 10:58:27', '3fast(1) has logged in.'),
(377, '2017-07-08 11:04:04', '3fast(1) has logged out.'),
(378, '2017-07-08 11:18:45', '4you(2) changed his password'),
(379, '2017-07-08 11:20:00', '4you(2) changed his password'),
(380, '2017-07-08 13:27:56', '3fast(1) has logged in.'),
(381, '2017-07-08 13:28:17', '3fast(1) added picture sniper'),
(382, '2017-07-08 13:29:42', '3fast(1) added picture uyfiy'),
(383, '2017-07-08 13:30:02', '3fast(1) added picture jhv'),
(384, '2017-07-08 13:31:19', '3fast(1) added picture hcmnc'),
(385, '2017-07-08 13:31:34', '3fast(1) added picture gfjkfg'),
(386, '2017-07-08 13:32:38', '3fast(1) added picture fjfg'),
(387, '2017-07-08 13:32:50', '3fast(1) added picture fjfgkg'),
(388, '2017-07-08 13:32:54', '3fast(1) deleted picture Joker'),
(389, '2017-07-08 13:32:57', '3fast(1) deleted picture Joker'),
(390, '2017-07-08 13:32:59', '3fast(1) deleted picture Joker'),
(391, '2017-07-08 13:33:00', '3fast(1) deleted picture Joker'),
(392, '2017-07-08 13:33:02', '3fast(1) deleted picture Joker'),
(393, '2017-07-08 13:33:03', '3fast(1) deleted picture Joker'),
(394, '2017-07-08 13:33:05', '3fast(1) deleted picture Joker'),
(395, '2017-07-08 13:33:06', '3fast(1) deleted picture Joker'),
(396, '2017-07-08 13:40:35', '3fast(1) has logged out.'),
(397, '2017-07-08 13:40:39', 'test(14) has logged in.'),
(398, '2017-07-08 13:40:53', 'test(14) has logged out.'),
(399, '2017-07-08 14:01:52', '3fast(1) has logged in.'),
(400, '2017-07-08 14:29:01', '3fast(1) added picture gfn'),
(401, '2017-07-08 14:29:10', '3fast(1) added picture jkh'),
(402, '2017-07-08 14:31:25', '3fast(1) deleted picture Joker'),
(403, '2017-07-08 14:31:28', '3fast(1) deleted picture Joker'),
(404, '2017-07-08 15:11:47', 'admin(1) has logged out.'),
(405, '2017-07-08 15:11:59', 'pecko(2) has logged in.'),
(406, '2017-07-08 15:13:45', 'pecko(2) has updated profile information'),
(407, '2017-07-08 15:14:06', 'pecko(2) has updated profile information'),
(408, '2017-07-08 15:14:09', 'pecko(2) has updated profile information'),
(409, '2017-07-08 15:15:46', 'pecko(2) has updated profile information'),
(410, '2017-07-08 15:15:53', 'pecko(2) has updated profile information'),
(411, '2017-07-08 15:18:13', 'pecko(2) has updated profile information'),
(412, '2017-07-08 15:18:18', 'pecko(2) has updated profile information'),
(413, '2017-07-08 15:18:22', 'pecko(2) has updated profile information'),
(414, '2017-07-08 15:18:29', 'pecko(2) has updated profile information'),
(415, '2017-07-08 15:18:48', 'pecko(2) has updated profile information'),
(416, '2017-07-08 15:18:53', 'pecko(2) has updated profile information'),
(417, '2017-07-08 15:18:58', 'pecko(2) has updated profile information'),
(418, '2017-07-08 15:19:43', 'pecko(2) has updated profile information'),
(419, '2017-07-08 15:19:46', 'pecko(2) has updated profile information'),
(420, '2017-07-08 15:20:03', 'pecko(2) has updated profile information'),
(421, '2017-07-08 15:20:34', 'pecko(2) has updated profile information'),
(422, '2017-07-08 15:20:42', 'pecko(2) has updated profile information'),
(423, '2017-07-08 15:21:55', 'pecko(2) deleted picture Wd 2'),
(424, '2017-07-08 15:21:57', 'pecko(2) deleted picture Wd 2'),
(425, '2017-07-08 15:21:59', 'pecko(2) deleted picture wd2'),
(426, '2017-07-08 15:22:16', 'pecko(2) added picture Keep Calm'),
(427, '2017-07-08 15:22:43', 'pecko(2) deleted picture Keep Calm'),
(428, '2017-07-08 15:23:16', 'pecko(2) added picture '),
(429, '2017-07-08 15:26:08', 'pecko(2) deleted picture '),
(430, '2017-07-08 15:26:09', 'pecko(2) deleted picture '),
(431, '2017-07-08 15:26:10', 'pecko(2) deleted picture '),
(432, '2017-07-08 15:26:22', 'pecko(2) added picture '),
(433, '2017-07-08 15:26:23', 'pecko(2) deleted picture '),
(434, '2017-07-08 15:51:50', 'pecko(2) added picture Keep Calm'),
(435, '2017-07-08 15:51:52', 'pecko(2) deleted picture Keep Calm'),
(436, '2017-07-08 15:52:16', 'pecko(2) deleted picture Keep Calm'),
(437, '2017-07-08 15:53:27', 'pecko(2) added picture Keep Calm'),
(438, '2017-07-08 15:54:23', 'pecko(2) deleted picture Keep Calm'),
(439, '2017-07-08 15:54:24', 'pecko(2) added picture Keep Calm'),
(440, '2017-07-08 15:54:25', 'pecko(2) deleted picture Keep Calm'),
(441, '2017-07-08 15:54:41', 'pecko(2) deleted picture Keep Calm'),
(442, '2017-07-08 15:54:42', 'pecko(2) deleted picture Keep Calm'),
(443, '2017-07-08 15:54:48', 'pecko(2) added picture Keep Calm'),
(444, '2017-07-08 15:55:02', 'pecko(2) added picture '),
(445, '2017-07-08 15:55:10', 'pecko(2) deleted picture Keep Calm'),
(446, '2017-07-08 15:55:38', 'pecko(2) added picture '),
(447, '2017-07-08 15:56:08', 'pecko(2) has logged out.'),
(448, '2017-07-08 15:56:22', 'dzony(3) has logged in.'),
(449, '2017-07-08 15:56:37', 'dzony(3) has updated profile information'),
(450, '2017-07-08 15:56:39', 'dzony(3) has updated profile information'),
(451, '2017-07-08 15:57:32', 'dzony(3) has logged out.'),
(452, '2017-07-08 15:57:40', 'dzony(3) has logged in.'),
(453, '2017-07-08 16:01:55', 'dzony(3) has logged out.'),
(454, '2017-07-08 16:02:02', 'pecko(2) has logged in.'),
(455, '2017-07-08 16:03:57', 'pecko(2) has logged out.'),
(456, '2017-07-08 16:04:03', 'dzony(3) has logged in.'),
(457, '2017-07-08 16:21:15', 'dzony(3) has logged out.'),
(458, '2017-07-08 16:21:23', 'pecko(2) has logged in.'),
(459, '2017-07-08 16:22:05', 'pecko(2) is now following dzony(3)'),
(460, '2017-07-08 16:23:12', 'pecko(2) is no longer following (3)'),
(461, '2017-07-08 16:27:49', 'pecko(2) is now following dzony(3)'),
(462, '2017-07-08 16:28:37', 'pecko(2) is no longer following (3)'),
(463, '2017-07-08 16:29:04', 'pecko(2) is now following dzony(3)'),
(464, '2017-07-08 16:29:27', 'pecko(2) is no longer following (3)'),
(465, '2017-07-08 16:29:34', 'pecko(2) is now following dzony(3)'),
(466, '2017-07-08 16:30:08', 'pecko(2) is no longer following (3)'),
(467, '2017-07-08 16:31:40', 'pecko(2) has logged out.'),
(468, '2017-07-08 16:31:45', 'dzony(3) has logged in.'),
(469, '2017-07-08 16:31:50', 'dzony(3) deleted picture The Crew'),
(470, '2017-07-08 16:32:00', 'dzony(3) added picture lift'),
(471, '2017-07-08 16:32:32', 'dzony(3) added picture dumbbells'),
(472, '2017-07-08 16:32:42', 'dzony(3) has logged out.'),
(473, '2017-07-08 16:33:07', 'dikili(7) has logged in.'),
(474, '2017-07-08 16:33:38', 'dikili(7) has updated profile information'),
(475, '2017-07-08 16:33:42', 'dikili(7) has updated profile information'),
(476, '2017-07-08 16:34:02', 'dikili(7) is now following dzony(3)'),
(477, '2017-07-08 16:34:46', 'dikili(7) added picture snatch'),
(478, '2017-07-08 16:34:57', 'dikili(7) added picture kettlebell'),
(479, '2017-07-08 16:35:03', 'dikili(7) has logged out.'),
(480, '2017-07-08 16:35:15', 'ZzlosS(4) has logged in.'),
(481, '2017-07-08 16:35:51', 'ZzlosS(4) has updated profile information'),
(482, '2017-07-08 16:35:53', 'ZzlosS(4) has updated profile information'),
(483, '2017-07-08 16:36:51', 'ZzlosS(4) has updated profile information'),
(484, '2017-07-08 16:36:59', 'ZzlosS(4) has updated profile information'),
(485, '2017-07-08 16:37:08', 'ZzlosS(4) added picture gym'),
(486, '2017-07-08 16:37:22', 'ZzlosS(4) added picture Chest'),
(487, '2017-07-08 16:46:49', 'ZzlosS(4) has logged out.'),
(488, '2017-07-08 16:46:57', '3fast(5) has logged in.'),
(489, '2017-07-08 16:47:53', '3fast(5) has updated profile information'),
(490, '2017-07-08 16:47:59', '3fast(5) has updated profile information'),
(491, '2017-07-08 16:48:02', '3fast(5) has updated profile information'),
(492, '2017-07-08 16:48:27', '3fast(5) added picture Repeat'),
(493, '2017-07-08 16:49:10', '3fast(5) added picture Gym'),
(494, '2017-07-08 16:49:23', '3fast(5) has logged out.'),
(495, '2017-07-08 16:49:35', 'micika() has entered wrong password.'),
(496, '2017-07-08 16:49:41', 'micika() has entered wrong password.'),
(497, '2017-07-08 16:50:15', 'micika(12) changed his password'),
(498, '2017-07-08 16:50:20', 'micika(12) has logged in.'),
(499, '2017-07-08 16:50:47', 'micika(12) has updated profile information'),
(500, '2017-07-08 16:50:51', 'micika(12) has updated profile information'),
(501, '2017-07-08 16:51:25', 'micika(12) added picture Triceps'),
(502, '2017-07-08 16:51:36', 'micika(12) added picture tri'),
(503, '2017-07-08 16:51:52', 'micika(12) has logged out.'),
(504, '2017-07-08 16:52:03', 'ziva_sila() has entered wrong password.'),
(505, '2017-07-08 16:52:32', 'ziva_sila(13) changed his password'),
(506, '2017-07-08 16:52:36', 'ziva_sila(13) has logged in.'),
(507, '2017-07-08 16:53:06', 'ziva_sila(13) has updated profile information'),
(508, '2017-07-08 16:53:14', 'ziva_sila(13) has updated profile information'),
(509, '2017-07-08 16:53:22', 'ziva_sila(13) added picture Sila'),
(510, '2017-07-08 16:53:37', 'ziva_sila(13) added picture Fit'),
(511, '2017-07-08 16:54:30', 'ziva_sila(13) has logged out.'),
(512, '2017-07-08 16:54:38', 'strawberry() has entered wrong password.'),
(513, '2017-07-08 16:55:04', 'strawberry(14) changed his password'),
(514, '2017-07-08 16:55:10', 'strawberry(14) has logged in.'),
(515, '2017-07-08 16:55:28', 'strawberry(14) added picture Motto'),
(516, '2017-07-08 16:56:01', 'strawberry(14) added picture Rope'),
(517, '2017-07-08 16:56:24', 'strawberry(14) has logged out.'),
(518, '2017-07-08 16:56:32', 'micika(12) has logged in.'),
(519, '2017-07-08 16:59:55', 'micika(12) has logged out.'),
(520, '2017-07-08 17:00:03', 'strawberry(14) has logged in.'),
(521, '2017-07-08 17:03:27', 'strawberry(14) has logged out.'),
(522, '2017-07-08 17:03:32', 'admin(1) has logged in.'),
(523, '2017-07-08 17:03:49', 'admin(1) has updated profile information'),
(524, '2017-07-08 17:03:52', 'admin(1) has updated profile information'),
(525, '2017-07-08 17:04:00', 'admin(1) deleted picture Joker'),
(526, '2017-07-08 17:04:01', 'admin(1) deleted picture Joker'),
(527, '2017-07-08 17:04:01', 'admin(1) deleted picture Joker'),
(528, '2017-07-08 17:04:01', 'admin(1) deleted picture Joker'),
(529, '2017-07-08 17:04:02', 'admin(1) deleted picture Joker'),
(530, '2017-07-08 17:04:02', 'admin(1) deleted picture Joker'),
(531, '2017-07-08 17:04:03', 'admin(1) deleted picture Joker'),
(532, '2017-07-08 17:04:03', 'admin(1) deleted picture Some nigga'),
(533, '2017-07-08 17:04:10', 'admin(1) added picture Keep Calm'),
(534, '2017-07-08 17:04:21', 'admin(1) has logged out.'),
(535, '2017-07-08 17:25:39', '3fast() has entered wrong password.'),
(536, '2017-07-08 17:25:47', 'admin(1) has logged in.'),
(537, '2017-07-08 17:30:00', 'admin(1) has logged out.'),
(538, '2017-07-08 17:35:23', 'admin(1) has logged in.');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(10) UNSIGNED NOT NULL,
  `gym_name` varchar(20) DEFAULT '',
  `email` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `question1` varchar(30) NOT NULL,
  `question2` varchar(30) NOT NULL,
  `q1_id` varchar(255) DEFAULT '',
  `q2_id` varchar(255) DEFAULT '',
  `name` varchar(46) DEFAULT '',
  `lname` varchar(46) DEFAULT '',
  `gender` int(11) DEFAULT '1',
  `birth_date` date DEFAULT NULL,
  `information` varchar(4096) DEFAULT '',
  `pic_date` datetime DEFAULT NULL,
  `pic_path` varchar(50) DEFAULT '',
  `role` int(11) DEFAULT '1',
  `public` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `gym_name`, `email`, `pass`, `question1`, `question2`, `q1_id`, `q2_id`, `name`, `lname`, `gender`, `birth_date`, `information`, `pic_date`, `pic_path`, `role`, `public`) VALUES
(1, 'admin', 'aaa@aaa.aaa', 'c03e13a5c7d8887fc1d322c73e19ea6f', 'admir', 'Stimac', '1', '1', 'admin', 'admin', 1, '2017-04-11', 'Random text', '2017-07-08 17:03:52', 'images/1/profile/1.png', 2, 1),
(2, 'pecko', 'bbb@bbb.bbb', 'd0295e0ec43b220b7eb97f2caa2e4c4d', 'pera', 'Fight Club', '1', '2', 'Petar', 'Peric', 1, '2017-06-02', 'Profile information text', '2017-07-08 15:20:42', 'images/2/profile/2.png', 1, 0),
(3, 'dzony', 'ccc@ccc.ccc', 'bddeff0c7b527605ee50a715a6138e56', 'RMD', 'Gladiator', '2', '2', 'Nikola', 'Jokic', 1, '2017-04-11', 'Profile information text', '2017-07-08 15:56:39', 'images/3/profile/3.png', 1, 0),
(4, 'ZzlosS', 'ddd@ddd.ddd', 'fa250a9332c979a865495868ace53bc4', 'Basketball', 'Bodiroga', '3', '1', 'Strahinja', 'Stojadinovic', 1, '2017-05-08', 'Profile information text', '2017-07-08 16:36:59', 'images/4/profile/4.png', 1, 1),
(5, '3fast', 'eee@eee.eee', '1129a756bc3c021271d98b1659c53661', 'Basketball', 'Batman', '3', '2', 'Jovan', 'Radenkovic', 1, '2017-01-03', 'Profile information text', '2017-07-08 16:48:02', 'images/5/profile/5.png', 1, 1),
(7, 'dikili', 'fff@fff.fff', 'a372e78d78a36fb5f69f9447b1926d1e', 'Football', 'Kezman', '3', '1', 'Dimitrije', 'Adamovic', 1, '2016-09-14', 'Profile information text', '2017-07-08 16:33:42', 'images/7/profile/7.png', 1, 0),
(12, 'micika', 'ggg@ggg.ggg', 'a0c8e84e976b6b7709c4b2acc1a2163a', 'micika', 'Plavi Slon', '1', '3', 'Milica', 'Micic', 2, '2017-02-22', 'Profile information text', '2017-07-08 16:50:51', 'images/12/profile/12.png', 1, 1),
(13, 'ziva_sila', 'hhh@hhh.hhh', 'ffe3c486f4b0083ebbd09b3b182ca8ad', 'zivka', 'Undisputed', '1', '2', 'Zivadinka', 'Simonovic', 2, '2017-05-25', 'Profile information text', '2017-07-08 16:53:14', 'images/13/profile/13.png', 3, 0),
(14, 'strawberry', 'iii@iii.iii', '63996e0041fb07135fc2cba871f29108', 'jagoda', 'Varljivo leto', '1', '2', 'Jagodinka', 'Simonovic', 2, '2017-06-01', '', NULL, 'img/default_avatar.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `muscle_group`
--

CREATE TABLE `muscle_group` (
  `id_m` int(10) UNSIGNED NOT NULL,
  `name_mc` varchar(56) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `muscle_group`
--

INSERT INTO `muscle_group` (`id_m`, `name_mc`) VALUES
(1, 'Chest'),
(2, 'Arms'),
(3, 'Shoulders'),
(4, 'Back'),
(5, 'Legs'),
(6, 'Abs');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `pic_path` varchar(50) DEFAULT '',
  `pic_like` int(11) DEFAULT '0',
  `pic_desc` varchar(255) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user_id`, `date_update`, `pic_path`, `pic_like`, `pic_desc`) VALUES
(72, 1, '2017-07-08 17:04:10', 'images/1/album/20170708170410.jpg', 0, 'Keep Calm'),
(58, 3, '2017-07-08 16:32:00', 'images/3/album/20170708163200.jpg', 0, 'lift'),
(55, 2, '2017-07-08 15:54:48', 'images/2/album/20170708155448.jpg', 0, 'Keep Calm'),
(57, 2, '2017-07-08 15:55:38', 'images/2/album/20170708155538.jpg', 0, ''),
(59, 3, '2017-07-08 16:32:32', 'images/3/album/20170708163232.jpg', 0, 'dumbbells'),
(60, 7, '2017-07-08 16:34:46', 'images/7/album/20170708163446.jpg', 0, 'snatch'),
(61, 7, '2017-07-08 16:34:57', 'images/7/album/20170708163457.jpg', 0, 'kettlebell'),
(62, 4, '2017-07-08 16:37:08', 'images/4/album/20170708163708.jpg', 0, 'gym'),
(63, 4, '2017-07-08 16:37:22', 'images/4/album/20170708163722.jpg', 0, 'Chest'),
(64, 5, '2017-07-08 16:48:27', 'images/5/album/20170708164827.jpg', 0, 'Repeat'),
(65, 5, '2017-07-08 16:49:10', 'images/5/album/20170708164910.jpg', 0, 'Gym'),
(66, 12, '2017-07-08 16:51:25', 'images/12/album/20170708165125.jpg', 0, 'Triceps'),
(67, 12, '2017-07-08 16:51:36', 'images/12/album/20170708165136.jpg', 0, 'tri'),
(68, 13, '2017-07-08 16:53:22', 'images/13/album/20170708165322.jpg', 0, 'Sila'),
(69, 13, '2017-07-08 16:53:37', 'images/13/album/20170708165337.jpg', 0, 'Fit'),
(70, 14, '2017-07-08 16:55:28', 'images/14/album/20170708165528.jpg', 0, 'Motto'),
(71, 14, '2017-07-08 16:56:01', 'images/14/album/20170708165601.jpg', 0, 'Rope');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id_p` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `day` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `muscle_group_id` int(10) UNSIGNED DEFAULT NULL,
  `ex1_id` int(10) UNSIGNED DEFAULT NULL,
  `ex2_id` int(10) UNSIGNED DEFAULT NULL,
  `ex3_id` int(10) UNSIGNED DEFAULT NULL,
  `ex4_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id_p`, `user_id`, `day`, `from`, `to`, `muscle_group_id`, `ex1_id`, `ex2_id`, `ex3_id`, `ex4_id`) VALUES
(11, 1, 3, 9, 10, 3, 15, 16, 18, 22),
(10, 1, 2, 10, 11, 2, 7, 8, 11, 13),
(4, 1, 4, 13, 14, 6, 42, 46, 47, 49),
(5, 1, 5, 14, 15, 5, 34, 35, 34, 38),
(6, 1, 6, 9, 10, 3, 16, 17, 19, 23),
(9, 1, 1, 9, 10, 1, 1, 3, 5, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exercise`
--
ALTER TABLE `exercise`
  ADD PRIMARY KEY (`id_e`),
  ADD KEY `mc_id` (`mc_id`);

--
-- Indexes for table `gym_buddies`
--
ALTER TABLE `gym_buddies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muscle_group`
--
ALTER TABLE `muscle_group`
  ADD PRIMARY KEY (`id_m`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `muscle_group_id` (`muscle_group_id`),
  ADD KEY `ex1_id` (`ex1_id`),
  ADD KEY `ex2_id` (`ex2_id`),
  ADD KEY `ex3_id` (`ex3_id`),
  ADD KEY `ex4_id` (`ex4_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exercise`
--
ALTER TABLE `exercise`
  MODIFY `id_e` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `gym_buddies`
--
ALTER TABLE `gym_buddies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=539;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `muscle_group`
--
ALTER TABLE `muscle_group`
  MODIFY `id_m` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id_p` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
