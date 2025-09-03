-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2025 at 05:15 PM
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
-- Database: `e-learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Vinay Sahani', 'vinay@admin.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `comment_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`comment_id`, `course_id`, `user_name`, `comment`, `created_at`) VALUES
(4, 32, 'Shivam Singh', 'hii me', '2025-08-21 14:50:50'),
(5, 32, 'Shivam Singh', 'hii me', '2025-08-21 14:50:50'),
(6, 33, 'VINAY', 'hello codeWithHarry', '2025-08-21 16:14:56'),
(7, 34, 'pain', 'OP video bhai😍', '2025-08-29 15:12:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblcompleted_courses`
--

CREATE TABLE `tblcompleted_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `completed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcompleted_courses`
--

INSERT INTO `tblcompleted_courses` (`id`, `user_id`, `course_id`, `completed_at`) VALUES
(5, 2, 31, '2025-08-21 15:38:17'),
(6, 12, 33, '2025-08-21 16:15:03'),
(7, 12, 33, '2025-08-21 16:15:03'),
(8, 13, 31, '2025-08-29 14:45:54'),
(10, 13, 33, '2025-08-29 14:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourses`
--

CREATE TABLE `tblcourses` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `instructor` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `thumbnail` varchar(50) NOT NULL,
  `rating` decimal(5,1) NOT NULL DEFAULT 3.0,
  `duration` varchar(20) NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourses`
--

INSERT INTO `tblcourses` (`id`, `title`, `description`, `instructor`, `category`, `price`, `thumbnail`, `rating`, `duration`, `created_at`, `video`) VALUES
(30, 'Sigma Web Dev', 'hello this is web dev course', 'me', 'web', 999.00, '../uploads/thumbnails/WebDEV.jpeg', 3.0, '6 hr', '20-08-2025', NULL),
(31, 'HTML one Shot', 'this is desc', 'me', 'web Dev', 399.00, '../uploads/thumbnails/C++-Advanced.jpg', 3.0, '1 hr', '20-08-2025', NULL),
(32, 'CSS one Shot', 'CSS ', 'me', 'Web', 999.00, '../uploads/thumbnails/C++-Beginner.jpeg', 3.0, '1 hr', '20-08-2025', NULL),
(33, 'Sigma Web Dev', 'hii', 'codeWithHarry', 'Web Dev', 1199.00, '../uploads/thumbnails/WebDEV.jpeg', 3.0, '2 Hours', '20-08-2025', NULL),
(34, 'Python', 'Do you want me to fix the SQL', 'Vinayy', 'Python', 799.00, '../uploads/thumbnails/python-advance.png', 3.0, '1 hour', '29-08-2025', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllessons`
--

CREATE TABLE `tbllessons` (
  `lesson_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lesson_number` int(11) NOT NULL,
  `lesson_title` varchar(255) NOT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `transcript` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbllessons`
--

INSERT INTO `tbllessons` (`lesson_id`, `course_id`, `lesson_number`, `lesson_title`, `video_path`, `transcript`) VALUES
(1, 31, 1, 'Html Full', '../uploads/videos/video2.mp4', 'nothing to say seriously'),
(2, 32, 1, 'intro', '../uploads/videos/video1.mp4', 'no'),
(3, 32, 2, 'basic', '../uploads/videos/video2.mp4', 'no'),
(4, 33, 1, 'Full Course', '../uploads/videos/video3.mp4', 'no dude'),
(5, 34, 1, 'Intro', '../uploads/videos/video1.mp4', '👉 Do you want me to fix the SQL (This Month + Platform Fee calculation) and give you the corrected PHP/SQL block? That way your revenue analytics will be accurate instead of placeholders.'),
(6, 34, 2, 'Advance', '../uploads/videos/video2.mp4', '👉 Do you want me to fix the SQL (This Month + Platform Fee calculation) and give you the corrected PHP/SQL block? That way your revenue analytics will be accurate instead of placeholders.');

-- --------------------------------------------------------

--
-- Table structure for table `tblmycourses`
--

CREATE TABLE `tblmycourses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrolled_at` varchar(20) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmycourses`
--

INSERT INTO `tblmycourses` (`id`, `user_id`, `course_id`, `enrolled_at`, `price`) VALUES
(11, 2, 32, '20-08-2025', 399.00),
(19, 14, 33, '29-08-2025', NULL),
(20, 15, 32, '29-08-2025', NULL),
(21, 16, 34, '29-08-2025', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `mehod` varchar(50) NOT NULL DEFAULT 'card',
  `category` varchar(50) NOT NULL,
  `paid_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`id`, `user_id`, `course_id`, `amount`, `mehod`, `category`, `paid_at`) VALUES
(1, 13, 31, 399.00, 'card', 'web Dev', '29-08-2025'),
(2, 14, 33, 1199.00, 'card', 'Web Dev', '29-08-2025'),
(3, 15, 32, 999.00, 'card', 'Web', '29-08-2025'),
(4, 16, 34, 799.00, 'card', 'Python', '29-08-2025');

-- --------------------------------------------------------

--
-- Table structure for table `tblresources`
--

CREATE TABLE `tblresources` (
  `resource_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `resource_name` varchar(255) DEFAULT NULL,
  `resource_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `created_at` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(2, 'Shivam Singh', 'shiv@m.com', '121212', '15-08-2025'),
(3, 'tester', 'test@m.m', '123321', '16-08-2025'),
(4, 'Vishal', 'vishal@v.c', '112211', '16-08-2025'),
(12, 'VINAY', 'vinay@a.c', '112211', '21-08-2025'),
(13, 'itachi Uchia', 'itachi@uc', '112233', '29-08-2025'),
(14, 'sasuke', 'sas@ke', 'sakura', '29-08-2025'),
(15, 'naruto', 'uzumaki@n', 'hinata', '29-08-2025'),
(16, 'pain', 'pain@nagato', '787878', '29-08-2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tblcompleted_courses`
--
ALTER TABLE `tblcompleted_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tblcourses`
--
ALTER TABLE `tblcourses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllessons`
--
ALTER TABLE `tbllessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `fk_course` (`course_id`);

--
-- Indexes for table `tblmycourses`
--
ALTER TABLE `tblmycourses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tblresources`
--
ALTER TABLE `tblresources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblcompleted_courses`
--
ALTER TABLE `tblcompleted_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblcourses`
--
ALTER TABLE `tblcourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbllessons`
--
ALTER TABLE `tbllessons`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmycourses`
--
ALTER TABLE `tblmycourses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblresources`
--
ALTER TABLE `tblresources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `tblcomments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblcompleted_courses`
--
ALTER TABLE `tblcompleted_courses`
  ADD CONSTRAINT `tblcompleted_courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblcompleted_courses_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbllessons`
--
ALTER TABLE `tbllessons`
  ADD CONSTRAINT `fk_course` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblmycourses`
--
ALTER TABLE `tblmycourses`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD CONSTRAINT `tblpayments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblpayments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`);

--
-- Constraints for table `tblresources`
--
ALTER TABLE `tblresources`
  ADD CONSTRAINT `tblresources_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tblcourses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
