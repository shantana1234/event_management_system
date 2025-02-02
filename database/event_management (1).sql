-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2025 at 05:46 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` text DEFAULT NULL,
  `event_date` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_status` enum('draft','publish') NOT NULL DEFAULT 'draft',
  `max_attendee` int(11) DEFAULT NULL,
  `public_form_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_description`, `event_date`, `user_id`, `event_status`, `max_attendee`, `public_form_link`, `created_at`, `updated_at`) VALUES
(1, 'Tech Conference 2025', 'A major technical conference focused on the latest trends in technology.', '2025-05-10', 1, 'publish', 10, NULL, '2025-02-02 15:57:59', '2025-02-02 16:22:01'),
(2, 'AI Seminar', 'A seminar on the advancements in Artificial Intelligence.', '2025-06-15', 2, 'draft', 15, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(3, 'Web Development Bootcamp', 'An intensive bootcamp for learning web development from scratch.', '2025-07-20', 3, 'publish', 18, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(4, 'Blockchain Summit', 'Exploring the potential of blockchain technology.', '2025-08-01', 1, 'draft', 12, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(5, 'Digital Marketing Workshop', 'A workshop on how to excel in digital marketing.', '2025-09-10', 2, 'publish', 10, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(6, 'Cybersecurity Conference', 'An event focused on the latest trends in cybersecurity.', '2025-10-05', 3, 'draft', 15, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(7, 'Data Science Bootcamp', 'Learn data science with hands-on projects in this 2-week bootcamp.', '2025-11-15', 1, 'publish', 18, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(8, 'Startup Pitch Competition', 'A competition for the most promising startup ideas.', '2025-12-01', 2, 'draft', 20, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(9, 'UX/UI Design Workshop', 'A hands-on workshop for learning UX/UI design principles.', '2025-01-10', 3, 'publish', 14, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(10, 'Cloud Computing Summit', 'The future of cloud computing and its applications in business.', '2025-02-25', 1, 'draft', 16, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(11, 'AI in Healthcare Symposium', 'A symposium on how AI is transforming the healthcare industry.', '2025-03-30', 2, 'publish', 13, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(12, 'Software Engineering Conference', 'A conference on best practices in software engineering.', '2025-04-05', 3, 'draft', 19, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(13, 'Virtual Reality Expo', 'An expo showcasing the latest in virtual reality technology.', '2025-06-20', 1, 'publish', 10, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(14, 'FinTech Conference', 'A conference exploring the future of financial technology.', '2025-07-15', 2, 'draft', 17, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(15, 'Mobile App Development Workshop', 'Learn to build mobile applications in this 3-day workshop.', '2025-08-20', 3, 'publish', 20, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(17, 'Marketing Strategies Summit', 'A summit for the best strategies in modern marketing.', '2025-10-10', 2, 'publish', 16, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(18, 'Artificial Intelligence Workshop', 'Learn the basics of AI through hands-on coding and projects.', '2025-11-20', 3, 'draft', 12, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(19, 'IoT Innovations Summit', 'An event showcasing the latest innovations in the Internet of Things.', '2025-12-10', 1, 'publish', 15, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59'),
(20, 'Cloud Security Conference', 'A conference about securing data in the cloud environment.', '2025-01-15', 2, 'draft', 13, NULL, '2025-02-02 15:57:59', '2025-02-02 15:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `event_attendees`
--

CREATE TABLE `event_attendees` (
  `attendee_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `attendee_name` varchar(255) NOT NULL,
  `attendee_email` varchar(255) NOT NULL,
  `attendee_phone` varchar(20) NOT NULL,
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_attendees`
--

INSERT INTO `event_attendees` (`attendee_id`, `event_id`, `attendee_name`, `attendee_email`, `attendee_phone`, `registration_date`) VALUES
(1, 1, 'John Doe', 'attendee1@gmail.com', '1234567890', '2025-02-02 16:02:02'),
(2, 1, 'Jane Smith', 'attendee2@gmail.com', '1234567891', '2025-02-02 16:02:02'),
(3, 1, 'Robert Johnson', 'attendee3@gmail.com', '1234567892', '2025-02-02 16:02:02'),
(4, 1, 'Emily Davis', 'attendee4@gmail.com', '1234567893', '2025-02-02 16:02:02'),
(5, 1, 'Michael Brown', 'attendee5@gmail.com', '1234567894', '2025-02-02 16:02:02'),
(6, 1, 'Sarah Williams', 'attendee6@gmail.com', '1234567895', '2025-02-02 16:02:02'),
(7, 1, 'David Jones', 'attendee7@gmail.com', '1234567896', '2025-02-02 16:02:02'),
(8, 1, 'Mary Garcia', 'attendee8@gmail.com', '1234567897', '2025-02-02 16:02:02'),
(9, 1, 'James Miller', 'attendee9@gmail.com', '1234567898', '2025-02-02 16:02:02'),
(10, 1, 'Patricia Wilson', 'attendee10@gmail.com', '1234567899', '2025-02-02 16:02:02'),
(11, 2, 'Linda Moore', 'attendee11@gmail.com', '1234567801', '2025-02-02 16:02:02'),
(12, 2, 'William Taylor', 'attendee12@gmail.com', '1234567802', '2025-02-02 16:02:02'),
(13, 2, 'Elizabeth Anderson', 'attendee13@gmail.com', '1234567803', '2025-02-02 16:02:02'),
(14, 2, 'Thomas Thomas', 'attendee14@gmail.com', '1234567804', '2025-02-02 16:02:02'),
(15, 2, 'Jessica Jackson', 'attendee15@gmail.com', '1234567805', '2025-02-02 16:02:02'),
(16, 2, 'Charles White', 'attendee16@gmail.com', '1234567806', '2025-02-02 16:02:02'),
(17, 2, 'Christopher Harris', 'attendee17@gmail.com', '1234567807', '2025-02-02 16:02:02'),
(18, 2, 'Angela Martin', 'attendee18@gmail.com', '1234567808', '2025-02-02 16:02:02'),
(19, 2, 'Steven Thompson', 'attendee19@gmail.com', '1234567809', '2025-02-02 16:02:02'),
(20, 2, 'Karen Garcia', 'attendee20@gmail.com', '1234567810', '2025-02-02 16:02:02'),
(21, 3, 'Daniel Lee', 'attendee21@gmail.com', '1234567811', '2025-02-02 16:02:02'),
(22, 3, 'Nancy Walker', 'attendee22@gmail.com', '1234567812', '2025-02-02 16:02:02'),
(23, 3, 'Matthew Allen', 'attendee23@gmail.com', '1234567813', '2025-02-02 16:02:02'),
(24, 3, 'Laura Young', 'attendee24@gmail.com', '1234567814', '2025-02-02 16:02:02'),
(25, 3, 'Mark Hernandez', 'attendee25@gmail.com', '1234567815', '2025-02-02 16:02:02'),
(26, 3, 'Susan King', 'attendee26@gmail.com', '1234567816', '2025-02-02 16:02:02'),
(27, 3, 'Brian Wright', 'attendee27@gmail.com', '1234567817', '2025-02-02 16:02:02'),
(28, 3, 'Kimberly Lopez', 'attendee28@gmail.com', '1234567818', '2025-02-02 16:02:02'),
(29, 3, 'Edward Scott', 'attendee29@gmail.com', '1234567819', '2025-02-02 16:02:02'),
(30, 3, 'Deborah Green', 'attendee30@gmail.com', '1234567820', '2025-02-02 16:02:02'),
(31, 4, 'Alice Adams', 'attendee31@gmail.com', '1234567821', '2025-02-02 16:02:02'),
(32, 4, 'John Baker', 'attendee32@gmail.com', '1234567822', '2025-02-02 16:02:02'),
(33, 4, 'Jessica Bell', 'attendee33@gmail.com', '1234567823', '2025-02-02 16:02:02'),
(34, 4, 'David Clark', 'attendee34@gmail.com', '1234567824', '2025-02-02 16:02:02'),
(35, 4, 'Olivia Lewis', 'attendee35@gmail.com', '1234567825', '2025-02-02 16:02:02'),
(36, 4, 'Matthew Allen', 'attendee36@gmail.com', '1234567826', '2025-02-02 16:02:02'),
(37, 4, 'Sophia Young', 'attendee37@gmail.com', '1234567827', '2025-02-02 16:02:02'),
(38, 4, 'Jacob Martin', 'attendee38@gmail.com', '1234567828', '2025-02-02 16:02:02'),
(39, 4, 'Mason Walker', 'attendee39@gmail.com', '1234567829', '2025-02-02 16:02:02'),
(40, 4, 'Liam Robinson', 'attendee40@gmail.com', '1234567830', '2025-02-02 16:02:02'),
(41, 5, 'Henry Wright', 'attendee41@gmail.com', '1234567831', '2025-02-02 16:02:02'),
(42, 5, 'Isabella Harris', 'attendee42@gmail.com', '1234567832', '2025-02-02 16:02:02'),
(43, 5, 'George Walker', 'attendee43@gmail.com', '1234567833', '2025-02-02 16:02:02'),
(44, 5, 'Harper Lee', 'attendee44@gmail.com', '1234567834', '2025-02-02 16:02:02'),
(45, 5, 'Grace Johnson', 'attendee45@gmail.com', '1234567835', '2025-02-02 16:02:02'),
(46, 5, 'Gabriel Clark', 'attendee46@gmail.com', '1234567836', '2025-02-02 16:02:02'),
(47, 5, 'Sophia Nelson', 'attendee47@gmail.com', '1234567837', '2025-02-02 16:02:02'),
(48, 5, 'Abigail Moore', 'attendee48@gmail.com', '1234567838', '2025-02-02 16:02:02'),
(49, 5, 'Ethan King', 'attendee49@gmail.com', '1234567839', '2025-02-02 16:02:02'),
(50, 5, 'Avery Lee', 'attendee50@gmail.com', '1234567840', '2025-02-02 16:02:02'),
(51, 6, 'Aiden Davis', 'attendee51@gmail.com', '1234567841', '2025-02-02 16:02:02'),
(52, 6, 'Scarlett White', 'attendee52@gmail.com', '1234567842', '2025-02-02 16:02:02'),
(53, 6, 'Amelia Clark', 'attendee53@gmail.com', '1234567843', '2025-02-02 16:02:02'),
(54, 6, 'Carter Harris', 'attendee54@gmail.com', '1234567844', '2025-02-02 16:02:02'),
(55, 6, 'Benjamin Robinson', 'attendee55@gmail.com', '1234567845', '2025-02-02 16:02:02'),
(56, 6, 'Chloe Scott', 'attendee56@gmail.com', '1234567846', '2025-02-02 16:02:02'),
(57, 6, 'Mia Allen', 'attendee57@gmail.com', '1234567847', '2025-02-02 16:02:02'),
(58, 6, 'Isaac Nelson', 'attendee58@gmail.com', '1234567848', '2025-02-02 16:02:02'),
(59, 6, 'Luna Carter', 'attendee59@gmail.com', '1234567849', '2025-02-02 16:02:02'),
(60, 6, 'Harper Brown', 'attendee60@gmail.com', '1234567850', '2025-02-02 16:02:02'),
(61, 7, 'Lucas Scott', 'attendee61@gmail.com', '1234567851', '2025-02-02 16:02:02'),
(62, 7, 'Ella Moore', 'attendee62@gmail.com', '1234567852', '2025-02-02 16:02:02'),
(63, 7, 'Logan Harris', 'attendee63@gmail.com', '1234567853', '2025-02-02 16:02:02'),
(64, 7, 'Wyatt Robinson', 'attendee64@gmail.com', '1234567854', '2025-02-02 16:02:02'),
(65, 7, 'Evelyn Adams', 'attendee65@gmail.com', '1234567855', '2025-02-02 16:02:02'),
(66, 7, 'Matthew Lewis', 'attendee66@gmail.com', '1234567856', '2025-02-02 16:02:02'),
(67, 7, 'Jack White', 'attendee67@gmail.com', '1234567857', '2025-02-02 16:02:02'),
(68, 7, 'Charlotte Moore', 'attendee68@gmail.com', '1234567858', '2025-02-02 16:02:02'),
(69, 7, 'Oliver Young', 'attendee69@gmail.com', '1234567859', '2025-02-02 16:02:02'),
(70, 7, 'Jackson Johnson', 'attendee70@gmail.com', '1234567860', '2025-02-02 16:02:02'),
(71, 8, 'Grace Thompson', 'attendee71@gmail.com', '1234567861', '2025-02-02 16:02:02'),
(72, 8, 'Sophia Robinson', 'attendee72@gmail.com', '1234567862', '2025-02-02 16:02:02'),
(73, 8, 'Ethan Clark', 'attendee73@gmail.com', '1234567863', '2025-02-02 16:02:02'),
(74, 8, 'Mason Lee', 'attendee74@gmail.com', '1234567864', '2025-02-02 16:02:02'),
(75, 8, 'Liam Walker', 'attendee75@gmail.com', '1234567865', '2025-02-02 16:02:02'),
(76, 8, 'Charlotte Davis', 'attendee76@gmail.com', '1234567866', '2025-02-02 16:02:02'),
(77, 8, 'Ava King', 'attendee77@gmail.com', '1234567867', '2025-02-02 16:02:02'),
(78, 8, 'Amelia Taylor', 'attendee78@gmail.com', '1234567868', '2025-02-02 16:02:02'),
(79, 8, 'James Nelson', 'attendee79@gmail.com', '1234567869', '2025-02-02 16:02:02'),
(80, 8, 'Lily Allen', 'attendee80@gmail.com', '1234567870', '2025-02-02 16:02:02'),
(81, 9, 'John Wilson', 'attendee81@gmail.com', '1234567871', '2025-02-02 16:02:02'),
(82, 9, 'Sofia Miller', 'attendee82@gmail.com', '1234567872', '2025-02-02 16:02:02'),
(83, 9, 'Jackson Davis', 'attendee83@gmail.com', '1234567873', '2025-02-02 16:02:02'),
(84, 9, 'Ethan Thomas', 'attendee84@gmail.com', '1234567874', '2025-02-02 16:02:02'),
(85, 9, 'Harper Lee', 'attendee85@gmail.com', '1234567875', '2025-02-02 16:02:02'),
(86, 9, 'Nolan Martin', 'attendee86@gmail.com', '1234567876', '2025-02-02 16:02:02'),
(87, 9, 'Olivia Moore', 'attendee87@gmail.com', '1234567877', '2025-02-02 16:02:02'),
(88, 9, 'Avery Johnson', 'attendee88@gmail.com', '1234567878', '2025-02-02 16:02:02'),
(89, 9, 'Ryan Lee', 'attendee89@gmail.com', '1234567879', '2025-02-02 16:02:02'),
(90, 9, 'Jacob Robinson', 'attendee90@gmail.com', '1234567880', '2025-02-02 16:02:02'),
(91, 10, 'Chloe Anderson', 'attendee91@gmail.com', '1234567881', '2025-02-02 16:02:02'),
(92, 10, 'Ella Brown', 'attendee92@gmail.com', '1234567882', '2025-02-02 16:02:02'),
(93, 10, 'William Wilson', 'attendee93@gmail.com', '1234567883', '2025-02-02 16:02:02'),
(94, 10, 'Benjamin White', 'attendee94@gmail.com', '1234567884', '2025-02-02 16:02:02'),
(95, 10, 'Lucas Thomas', 'attendee95@gmail.com', '1234567885', '2025-02-02 16:02:02'),
(96, 10, 'Emma Harris', 'attendee96@gmail.com', '1234567886', '2025-02-02 16:02:02'),
(97, 10, 'Harper Green', 'attendee97@gmail.com', '1234567887', '2025-02-02 16:02:02'),
(98, 10, 'Liam Johnson', 'attendee98@gmail.com', '1234567888', '2025-02-02 16:02:02'),
(99, 10, 'Evelyn Martin', 'attendee99@gmail.com', '1234567889', '2025-02-02 16:02:02'),
(100, 10, 'Aiden Wilson', 'attendee100@gmail.com', '1234567890', '2025-02-02 16:02:02'),
(101, 11, 'John Doe', 'attendee101@gmail.com', '1234567890', '2025-02-02 16:04:15'),
(102, 11, 'Jane Smith', 'attendee102@gmail.com', '1234567891', '2025-02-02 16:04:15'),
(103, 11, 'Robert Johnson', 'attendee103@gmail.com', '1234567892', '2025-02-02 16:04:15'),
(104, 11, 'Emily Davis', 'attendee104@gmail.com', '1234567893', '2025-02-02 16:04:15'),
(105, 11, 'Michael Brown', 'attendee105@gmail.com', '1234567894', '2025-02-02 16:04:15'),
(106, 11, 'Sarah Williams', 'attendee106@gmail.com', '1234567895', '2025-02-02 16:04:15'),
(107, 11, 'David Jones', 'attendee107@gmail.com', '1234567896', '2025-02-02 16:04:15'),
(108, 11, 'Mary Garcia', 'attendee108@gmail.com', '1234567897', '2025-02-02 16:04:15'),
(109, 11, 'James Miller', 'attendee109@gmail.com', '1234567898', '2025-02-02 16:04:15'),
(110, 11, 'Patricia Wilson', 'attendee110@gmail.com', '1234567899', '2025-02-02 16:04:15'),
(111, 12, 'Linda Moore', 'attendee111@gmail.com', '1234567801', '2025-02-02 16:04:15'),
(112, 12, 'William Taylor', 'attendee112@gmail.com', '1234567802', '2025-02-02 16:04:15'),
(113, 12, 'Elizabeth Anderson', 'attendee113@gmail.com', '1234567803', '2025-02-02 16:04:15'),
(114, 12, 'Thomas Thomas', 'attendee114@gmail.com', '1234567804', '2025-02-02 16:04:15'),
(115, 12, 'Jessica Jackson', 'attendee115@gmail.com', '1234567805', '2025-02-02 16:04:15'),
(116, 12, 'Charles White', 'attendee116@gmail.com', '1234567806', '2025-02-02 16:04:15'),
(117, 12, 'Christopher Harris', 'attendee117@gmail.com', '1234567807', '2025-02-02 16:04:15'),
(118, 12, 'Angela Martin', 'attendee118@gmail.com', '1234567808', '2025-02-02 16:04:15'),
(119, 12, 'Steven Thompson', 'attendee119@gmail.com', '1234567809', '2025-02-02 16:04:15'),
(120, 12, 'Karen Garcia', 'attendee120@gmail.com', '1234567810', '2025-02-02 16:04:15'),
(121, 13, 'Daniel Lee', 'attendee121@gmail.com', '1234567811', '2025-02-02 16:04:15'),
(122, 13, 'Nancy Walker', 'attendee122@gmail.com', '1234567812', '2025-02-02 16:04:15'),
(123, 13, 'Matthew Allen', 'attendee123@gmail.com', '1234567813', '2025-02-02 16:04:15'),
(124, 13, 'Laura Young', 'attendee124@gmail.com', '1234567814', '2025-02-02 16:04:15'),
(125, 13, 'Mark Hernandez', 'attendee125@gmail.com', '1234567815', '2025-02-02 16:04:15'),
(126, 13, 'Susan King', 'attendee126@gmail.com', '1234567816', '2025-02-02 16:04:15'),
(127, 13, 'Brian Wright', 'attendee127@gmail.com', '1234567817', '2025-02-02 16:04:15'),
(128, 13, 'Kimberly Lopez', 'attendee128@gmail.com', '1234567818', '2025-02-02 16:04:15'),
(129, 13, 'Edward Scott', 'attendee129@gmail.com', '1234567819', '2025-02-02 16:04:15'),
(130, 13, 'Deborah Green', 'attendee130@gmail.com', '1234567820', '2025-02-02 16:04:15'),
(131, 14, 'Alice Adams', 'attendee131@gmail.com', '1234567821', '2025-02-02 16:04:15'),
(132, 14, 'John Baker', 'attendee132@gmail.com', '1234567822', '2025-02-02 16:04:15'),
(133, 14, 'Jessica Bell', 'attendee133@gmail.com', '1234567823', '2025-02-02 16:04:15'),
(134, 14, 'David Clark', 'attendee134@gmail.com', '1234567824', '2025-02-02 16:04:15'),
(135, 14, 'Olivia Lewis', 'attendee135@gmail.com', '1234567825', '2025-02-02 16:04:15'),
(136, 14, 'Matthew Allen', 'attendee136@gmail.com', '1234567826', '2025-02-02 16:04:15'),
(137, 14, 'Sophia Young', 'attendee137@gmail.com', '1234567827', '2025-02-02 16:04:15'),
(138, 14, 'Jacob Martin', 'attendee138@gmail.com', '1234567828', '2025-02-02 16:04:15'),
(139, 14, 'Mason Walker', 'attendee139@gmail.com', '1234567829', '2025-02-02 16:04:15'),
(140, 14, 'Liam Robinson', 'attendee140@gmail.com', '1234567830', '2025-02-02 16:04:15'),
(141, 15, 'Henry Wright', 'attendee141@gmail.com', '1234567831', '2025-02-02 16:04:15'),
(142, 15, 'Isabella Harris', 'attendee142@gmail.com', '1234567832', '2025-02-02 16:04:15'),
(143, 15, 'George Walker', 'attendee143@gmail.com', '1234567833', '2025-02-02 16:04:15'),
(144, 15, 'Harper Lee', 'attendee144@gmail.com', '1234567834', '2025-02-02 16:04:15'),
(145, 15, 'Grace Johnson', 'attendee145@gmail.com', '1234567835', '2025-02-02 16:04:15'),
(146, 15, 'Gabriel Clark', 'attendee146@gmail.com', '1234567836', '2025-02-02 16:04:15'),
(147, 15, 'Sophia Nelson', 'attendee147@gmail.com', '1234567837', '2025-02-02 16:04:15'),
(148, 15, 'Abigail Moore', 'attendee148@gmail.com', '1234567838', '2025-02-02 16:04:15'),
(149, 15, 'Ethan King', 'attendee149@gmail.com', '1234567839', '2025-02-02 16:04:15'),
(150, 15, 'Avery Lee', 'attendee150@gmail.com', '1234567840', '2025-02-02 16:04:15'),
(161, 17, 'Lucas Scott', 'attendee161@gmail.com', '1234567851', '2025-02-02 16:04:15'),
(162, 17, 'Ella Moore', 'attendee162@gmail.com', '1234567852', '2025-02-02 16:04:15'),
(163, 17, 'Logan Harris', 'attendee163@gmail.com', '1234567853', '2025-02-02 16:04:15'),
(164, 17, 'Wyatt Robinson', 'attendee164@gmail.com', '1234567854', '2025-02-02 16:04:15'),
(165, 17, 'Evelyn Adams', 'attendee165@gmail.com', '1234567855', '2025-02-02 16:04:15'),
(166, 17, 'Matthew Lewis', 'attendee166@gmail.com', '1234567856', '2025-02-02 16:04:15'),
(167, 17, 'Jack White', 'attendee167@gmail.com', '1234567857', '2025-02-02 16:04:15'),
(168, 17, 'Charlotte Moore', 'attendee168@gmail.com', '1234567858', '2025-02-02 16:04:15'),
(169, 17, 'Oliver Young', 'attendee169@gmail.com', '1234567859', '2025-02-02 16:04:15'),
(170, 17, 'Jackson Johnson', 'attendee170@gmail.com', '1234567860', '2025-02-02 16:04:15'),
(171, 18, 'Grace Thompson', 'attendee171@gmail.com', '1234567861', '2025-02-02 16:04:15'),
(172, 18, 'Sophia Robinson', 'attendee172@gmail.com', '1234567862', '2025-02-02 16:04:15'),
(173, 18, 'Ethan Clark', 'attendee173@gmail.com', '1234567863', '2025-02-02 16:04:15'),
(174, 18, 'Mason Lee', 'attendee174@gmail.com', '1234567864', '2025-02-02 16:04:15'),
(175, 18, 'Liam Walker', 'attendee175@gmail.com', '1234567865', '2025-02-02 16:04:15'),
(176, 18, 'Charlotte Davis', 'attendee176@gmail.com', '1234567866', '2025-02-02 16:04:15'),
(177, 18, 'Ava King', 'attendee177@gmail.com', '1234567867', '2025-02-02 16:04:15'),
(178, 18, 'Amelia Taylor', 'attendee178@gmail.com', '1234567868', '2025-02-02 16:04:15'),
(179, 18, 'James Nelson', 'attendee179@gmail.com', '1234567869', '2025-02-02 16:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','editor') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'shantana', 'shantanamirdha2016@gmail.com', '$2y$10$A.w2NxPf/wXanu/U37Gg2.pKzr2uY.gNVF8TZDWBeu7rajhYuE88.', 'user', '2025-02-02 16:11:20', '2025-02-02 16:11:46'),
(2, 'Admin', 'admin@gmail.com', '$2y$10$oO1F4NOkiKJseAxO.W0NxeZQVUbPEvlwQ2p0J/IeNlt.BIdY6mije', 'admin', '2025-02-02 16:17:03', '2025-02-02 16:25:15'),
(3, 'Michael Johnson', 'michael.johnson@gmail.com', '$2y$10$2M7JRuD9HbQcv/9EuYxNxu9BNq37hGxz7R1KZp2ekHcDbJhoWh0/W', 'user', '2025-02-02 16:18:27', '2025-02-02 16:18:27'),
(4, 'Emily Davis', 'emily.davis@gmail.com', '$2y$10$2M7JRuD9HbQcv/9EuYxNxu9BNq37hGxz7R1KZp2ekHcDbJhoWh0/W', 'user', '2025-02-02 16:18:27', '2025-02-02 16:18:27'),
(5, 'Robert Wilson', 'robert.wilson@gmail.com', '$2y$10$TrN6q5Eq1tMeLs7s6F2A4uhjztxUOUy9HET2yZ94gtdT2.Yc8yHnW', 'admin', '2025-02-02 16:18:27', '2025-02-02 16:18:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD PRIMARY KEY (`attendee_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `event_attendees`
--
ALTER TABLE `event_attendees`
  MODIFY `attendee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `event_attendees`
--
ALTER TABLE `event_attendees`
  ADD CONSTRAINT `event_attendees_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
