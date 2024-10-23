
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- Database: `chatbot`
--

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
