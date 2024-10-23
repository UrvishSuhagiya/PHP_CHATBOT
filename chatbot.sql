-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `chatbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot_messages`
--

CREATE TABLE `bot_messages` (
  `message_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bot_messages`
--

INSERT INTO `bot_messages` (`message_id`, `user_id`, `message`, `created_at`) VALUES
(434, 0, 'Syllabus for Module1 of Section1:\nIntroduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.', '2024-10-14 22:22:28'),
(435, 12, 'syllabus of this course', '2024-10-14 22:23:16'),
(436, 0, 'I\'m sorry, I didn\'t understand that. Could you please rephrase?', '2024-10-14 22:23:16'),
(437, 12, 'syllabus of this subject', '2024-10-14 22:23:35'),
(438, 0, 'Full Syllabus:<br />\nSection1:<br />\n  Module1: Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.<br />\n  Module2: Object Oriented Programming with PHP – Classes, Properties, Methods, Constructor, Destructor, Getter and Setter, Encapsulation, Inheritance, Data Abstraction, Polymorphism<br />\n  Module3: Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs<br />\nSection2:<br />\n  Module1: Introduction to Laravel and MVC, Environment Setup, Routes, Namespaces, Controllers, Views, Request Response, Redirections, Forms, Session, Cookie, Database Connectivity and CRUD operations<br />\n  Module2: Introduction to PHP MyAdmin, connection to MySQL server from PHP, execution of MySQL queries from PHP, receiving data from database server and processing it on webserver using PHP.<br />\n  Module3: Introduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security<br />\n', '2024-10-14 22:23:35'),
(439, 12, 'name of module 3', '2024-10-14 22:23:47'),
(440, 0, 'Name of Module3: Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs', '2024-10-14 22:23:47'),
(441, 12, 'name of module 3 of section 2', '2024-10-14 22:23:57'),
(442, 0, 'Syllabus for Module3 of Section2:\nIntroduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security', '2024-10-14 22:23:57'),
(443, 12, 'name of module 3 of section 2', '2024-10-14 22:27:29'),
(444, 0, 'Syllabus for Module3 of Section2:\nWeb Sockets .Introduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security', '2024-10-14 22:27:29'),
(445, 12, 'name of module 3 of section 2', '2024-10-14 22:31:35'),
(446, 0, 'Syllabus for Module3 of Section2:\nIntroduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security', '2024-10-14 22:31:35'),
(447, 12, 'full syllabus', '2024-10-14 22:39:57'),
(448, 0, 'I\'m sorry, I didn\'t understand that. Could you please rephrase?', '2024-10-14 22:39:57'),
(449, 12, 'give me full syllabus of this subject', '2024-10-14 22:40:28'),
(450, 0, 'Full Syllabus:<br />\nSection1:<br />\n  Module1: Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.<br />\n  Module2: Object Oriented Programming with PHP – Classes, Properties, Methods, Constructor, Destructor, Getter and Setter, Encapsulation, Inheritance, Data Abstraction, Polymorphism<br />\n  Module3: Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs<br />\nSection2:<br />\n  Module1: Introduction to Laravel and MVC, Environment Setup, Routes, Namespaces, Controllers, Views, Request Response, Redirections, Forms, Session, Cookie, Database Connectivity and CRUD operations<br />\n  Module2: Introduction to PHP MyAdmin, connection to MySQL server from PHP, execution of MySQL queries from PHP, receiving data from database server and processing it on webserver using PHP.<br />\n  Module3: Introduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security<br />\n', '2024-10-14 22:40:28'),
(451, 12, 'name of module 3', '2024-10-14 22:41:25'),
(452, 0, 'Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs', '2024-10-14 22:41:25'),
(453, 12, 'name of module 3', '2024-10-14 22:43:04'),
(454, 0, 'Advanced PHP \\n Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs', '2024-10-14 22:43:04'),
(455, 12, 'name of module 1', '2024-10-14 22:43:18'),
(456, 0, 'PHP : /n  Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.', '2024-10-14 22:43:18'),
(457, 12, 'name of module 1', '2024-10-14 22:44:16'),
(458, 0, 'PHP : \\b Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.', '2024-10-14 22:44:16'),
(459, 12, 'name of module 1', '2024-10-14 22:44:52'),
(460, 0, 'Array', '2024-10-14 22:44:52'),
(461, 12, 'name of module 1', '2024-10-14 22:46:15'),
(462, 0, 'Array', '2024-10-14 22:46:15'),
(463, 12, 'name of module 1', '2024-10-14 22:46:17'),
(464, 0, 'Array', '2024-10-14 22:46:17'),
(465, 12, 'name of module 1', '2024-10-14 22:46:17'),
(466, 0, 'Array', '2024-10-14 22:46:17'),
(467, 12, 'name of module 1', '2024-10-14 22:46:17'),
(468, 0, 'Array', '2024-10-14 22:46:17'),
(469, 12, 'name of module 1', '2024-10-14 22:46:17'),
(470, 0, 'Array', '2024-10-14 22:46:17'),
(471, 12, 'name of module 1', '2024-10-14 22:46:18'),
(472, 0, 'Array', '2024-10-14 22:46:18'),
(473, 12, 'name of module 2', '2024-10-14 22:46:26'),
(474, 0, 'Object Oriented PHP : \\n Object Oriented Programming with PHP – Classes, Properties, Methods, Constructor, Destructor, Getter and Setter, Encapsulation, Inheritance, Data Abstraction, Polymorphism', '2024-10-14 22:46:26'),
(475, 12, 'name of module 1', '2024-10-14 22:46:51'),
(476, 0, 'PHP :', '2024-10-14 22:46:51'),
(477, 12, 'name of module 2', '2024-10-14 22:47:44'),
(478, 0, 'Object Oriented PHP', '2024-10-14 22:47:44'),
(479, 12, 'syllabus of module 2', '2024-10-14 22:47:53'),
(480, 0, 'I\'m sorry, I didn\'t understand that. Could you please rephrase?', '2024-10-14 22:47:53'),
(481, 12, 'syllabus of module 2 of section 1', '2024-10-14 22:48:12'),
(482, 0, 'Syllabus for Module2 of Section1:\nObject Oriented PHP', '2024-10-14 22:48:12'),
(483, 12, 'syllabus of module 2 of section 1', '2024-10-14 22:48:39'),
(595, 12, 'hey', '2024-10-16 08:17:04'),
(596, 0, 'Hello! How can I assist you today?', '2024-10-16 08:17:04'),
(597, 12, 'subject name', '2024-10-16 08:17:10'),
(598, 0, 'Course Name : Advanced Web Technologies.', '2024-10-16 08:17:10'),
(599, 12, 'course code', '2024-10-16 08:17:20'),
(600, 0, 'Course Code : SEIT4031.', '2024-10-16 08:17:20'),
(601, 12, 'syllabus', '2024-10-16 08:17:35'),
(602, 0, 'I\'m sorry, I didn\'t understand that. Could you please rephrase?', '2024-10-16 08:17:35'),
(603, 12, 'syllabus of this subject', '2024-10-16 08:17:42'),
(604, 0, 'Full Syllabus:<br />\n<br />\nSection1:<br />\n  <br />\nModule1:<br />\n<b>PHP</b> : Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.<br />\n  <br />\nModule2:<br />\n<b>Object Oriented PHP </b>: Object Oriented Programming with PHP – Classes, Properties, Methods, Constructor, Destructor, Getter and Setter, Encapsulation, Inheritance, Data Abstraction, Polymorphism<br />\n  <br />\nModule3:<br />\n <b>Advanced PHP </b>: Web Scraping using cURL, Regular Expression, Mail function, Web Services & APIs<br />\nSection2:<br />\n  <br />\nModule1:<br />\n <b>PHP MVC Framework-Laravel </b>: Introduction to Laravel and MVC, Environment Setup, Routes, Namespaces, Controllers, Views, Request Response, Redirections, Forms, Session, Cookie, Database Connectivity and CRUD operations<br />\n  <br />\nModule2:<br />\n <b>PHP & MY SQL </b>: Introduction to PHP MyAdmin, connection to MySQL server from PHP, execution of MySQL queries from PHP, receiving data from database server and processing it on webserver using PHP.<br />\n  <br />\nModule3:<br />\n <b>WEB SOCKETS</b> : Introduction to Web sockets, Web socket URIs, Web socket APIs, Opening Handshake, Data Framing, Sending and Receiving Data, Closing the Connections, Error Handling, Web socket Security<br />\n', '2024-10-16 08:17:42'),
(605, 12, 'module 1 of section 1', '2024-10-16 08:18:05'),
(606, 0, 'Syllabus for <b> Module1 </b>of Section1:\n<b>PHP</b> : Introduction to PHP and its syntax, combining PHP and HTML, understanding PHP code blocks like Arrays, Strings, Functions, looping and branching, file handling, processing forms on server side, cookies and sessions.', '2024-10-16 08:18:05'),
(607, 12, 'HTML ?', '2024-10-16 08:18:14'),
(608, 0, 'HTML stands for HyperText Markup Language, the standard markup language for creating web pages.', '2024-10-16 08:18:14'),
(609, 12, 'hello', '2024-10-16 08:25:44'),
(610, 0, 'Hello! How can I assist you today?', '2024-10-16 08:25:44'),
(611, 14, 'nice', '2024-10-16 08:28:27'),
(612, 0, 'I\'m glad you feel that way! How can I help you further?', '2024-10-16 08:28:27'),
(613, 14, 'PHP', '2024-10-16 08:28:46'),
(614, 0, 'PHP is a popular general-purpose scripting language that is especially suited to web development.', '2024-10-16 08:28:46'),
(615, 14, 'ok', '2024-10-16 08:46:32'),
(616, 0, 'I\'m sorry, I didn\'t understand that. Could you please rephrase?', '2024-10-16 08:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `message`, `created_at`) VALUES
(355, 12, 'hi', '2024-10-16 08:15:55'),
(356, 14, 'hello USER 1', '2024-10-16 08:16:42'),
(357, 12, 'hey', '2024-10-16 08:17:04'),
(358, 12, 'hey', '2024-10-16 08:17:04'),
(359, 12, 'subject name', '2024-10-16 08:17:10'),
(360, 12, 'subject name', '2024-10-16 08:17:10'),
(361, 12, 'course code', '2024-10-16 08:17:20'),
(362, 12, 'course code', '2024-10-16 08:17:20'),
(363, 12, 'syllabus', '2024-10-16 08:17:35'),
(364, 12, 'syllabus', '2024-10-16 08:17:35'),
(365, 12, 'syllabus of this subject', '2024-10-16 08:17:42'),
(366, 12, 'syllabus of this subject', '2024-10-16 08:17:42'),
(367, 12, 'module 1 of section 1', '2024-10-16 08:18:05'),
(368, 12, 'module 1 of section 1', '2024-10-16 08:18:05'),
(369, 12, 'HTML ?', '2024-10-16 08:18:14'),
(370, 12, 'HTML ?', '2024-10-16 08:18:14'),
(371, 12, 'hello', '2024-10-16 08:25:44'),
(372, 12, 'hello', '2024-10-16 08:25:44'),
(373, 12, 'WOOOOO', '2024-10-16 08:25:50'),
(374, 14, 'hello', '2024-10-16 08:26:58'),
(375, 12, 'wow', '2024-10-16 08:27:41'),
(376, 14, 'yes', '2024-10-16 08:27:53'),
(377, 14, 'nice', '2024-10-16 08:28:27'),
(378, 14, 'nice', '2024-10-16 08:28:27'),
(379, 14, 'PHP', '2024-10-16 08:28:46'),
(380, 14, 'PHP', '2024-10-16 08:28:46'),
(381, 12, 'ohk', '2024-10-16 08:46:05'),
(382, 14, 'ok', '2024-10-16 08:46:32'),
(383, 14, 'ok', '2024-10-16 08:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `email`, `password`) VALUES
(0, 'Bot', 'bot@chatbot.com', ''),
(12, 'USER-1', 'User1@gmail.com', '48dd3735adbfa359a122cfd25e1436a8'),
(14, 'USER-2', 'User2@gmail.com', '48dd3735adbfa359a122cfd25e1436a8'),
(16, 'USER-3', 'User3@gmail.com', '48dd3735adbfa359a122cfd25e1436a8'),
(22, 'URVISH', 'urvish@gmail.com', '48dd3735adbfa359a122cfd25e1436a8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bot_messages`
--
ALTER TABLE `bot_messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bot_messages`
--
ALTER TABLE `bot_messages`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=617;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bot_messages`
--
ALTER TABLE `bot_messages`
  ADD CONSTRAINT `bot_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
