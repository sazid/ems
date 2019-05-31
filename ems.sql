-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2019 at 08:28 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `value` text NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `value`, `question_id`) VALUES
(3, 'A', 2),
(4, 'B', 2),
(5, 'C', 2),
(6, 'D', 2),
(9, 'sdf', 4),
(10, 'fd', 4),
(11, 'fg', 5),
(12, 'hg', 5),
(13, 'A', 6),
(14, 'B', 6),
(15, 'C', 6),
(16, 'D', 6),
(17, '', 7),
(18, '', 7),
(22, 'A*', 11),
(23, 'Diajkstra\'s Algorithm', 11),
(24, 'Prim\'s Algorithm', 11);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `code`, `active`) VALUES
(1, 'Web Technologies', '3101', 1),
(2, 'Computer Graphics', '3201', 1),
(3, 'Compiler Design', '3110', 1),
(4, 'Artificial Intelligence', '3211', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `name`, `start`, `end`, `course_id`) VALUES
(33, 'First AI Exam', '2019-05-14 18:00:00', '2019-05-21 18:00:00', 4),
(37, 'Hello Exam Two', '2019-05-26 17:00:00', '2019-05-28 20:00:00', 1),
(38, 'Test AI Exam', '2019-05-04 18:00:00', '2019-05-05 18:00:00', 4),
(40, 'Exam with 2 questions', '2019-05-06 18:00:00', '2019-05-14 18:00:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mark` double NOT NULL,
  `submission_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `title`, `type`, `course_id`) VALUES
(1, 'Test descriptive', 'descriptive', 1),
(2, 'Test mcq', 'mcq', 1),
(3, 'Test file', 'file', 1),
(4, 'asdfasdf', 'mcq', 1),
(5, 'test question 2', 'mcq', 1),
(6, 'Test MCQ Question', 'mcq', 1),
(7, 'What is AI?', 'descriptive', 4),
(11, 'UCS algorithm is similar to...', 'mcq', 4);

-- --------------------------------------------------------

--
-- Table structure for table `question_set`
--

CREATE TABLE `question_set` (
  `id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_set`
--

INSERT INTO `question_set` (`id`, `exam_id`, `question_id`) VALUES
(10, 38, 7),
(19, 33, 7),
(25, 40, 7),
(26, 40, 11),
(71, 37, 1),
(72, 37, 2),
(73, 37, 3),
(74, 37, 6);

-- --------------------------------------------------------

--
-- Table structure for table `submission`
--

CREATE TABLE `submission` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `value` text NOT NULL,
  `submission_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submission`
--

INSERT INTO `submission` (`id`, `type`, `value`, `submission_time`, `user_id`, `question_id`, `exam_id`) VALUES
(7, 'descriptive', 'Hello World, Descriptive answer', '2019-05-31 08:15:00', 2, 1, 37),
(8, 'mcq', 'B', '2019-05-31 08:15:00', 2, 2, 37),
(9, 'file', '1559283116.jpg', '2019-05-31 08:15:00', 2, 3, 37),
(10, 'mcq', 'D', '2019-05-31 08:15:35', 2, 2, 37),
(11, 'mcq', 'B', '2019-05-31 08:15:35', 2, 6, 37);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `type`, `email`, `active`, `name`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@ems.com', 1, 'Admin'),
(2, 'sazid', 'sazid', 'student', 'sazid@test.com', 1, 'Mohammed Sazid Al Rashid'),
(3, 'alamin', 'alamin', 'faculty', 'alamin@aiub.edu', 1, 'MD Al Amin'),
(7, 'hello', 'hello', 'student', 'hello@hello.com', 1, 'Hello World'),
(8, 'asdf', 'asdfasdf', 'faculty', 'asdf@asdf.asdf', 1, 'asdfasdf'),
(14, 'gfgfgfg', 'bbbbbb', 'faculty', 'bb@bb.bb', 0, 'bbbbbbb'),
(15, 'another', 'another', 'student', 'ano@ano.com', 1, 'Another User'),
(16, 'faculty', 'faculty', 'faculty', 'faculty@faculty.com', 1, 'Faculty');

-- --------------------------------------------------------

--
-- Table structure for table `user_course_map`
--

CREATE TABLE `user_course_map` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_course_map`
--

INSERT INTO `user_course_map` (`id`, `user_id`, `course_id`) VALUES
(23, 3, 4),
(24, 7, 4),
(25, 16, 2),
(26, 2, 2),
(27, 3, 1),
(28, 16, 1),
(29, 2, 1),
(30, 15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answer_question_id` (`question_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exam_course_id` (`course_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_marks_submission_id` (`submission_id`),
  ADD KEY `fk_marks_exam_id` (`exam_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_course_id` (`course_id`);

--
-- Indexes for table `question_set`
--
ALTER TABLE `question_set`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_question_set_exam_id` (`exam_id`),
  ADD KEY `fk_question_set_question_id` (`question_id`);

--
-- Indexes for table `submission`
--
ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_submission_user_id` (`user_id`),
  ADD KEY `fk_submission_question_id` (`question_id`),
  ADD KEY `fk_submission_exam_id` (`exam_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`) USING BTREE,
  ADD UNIQUE KEY `user_unique_email` (`email`) USING BTREE;

--
-- Indexes for table `user_course_map`
--
ALTER TABLE `user_course_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_course_map_user_id` (`user_id`),
  ADD KEY `fk_user_course_map_course_id` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_set`
--
ALTER TABLE `question_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `submission`
--
ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_course_map`
--
ALTER TABLE `user_course_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `fk_answer_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `fk_exam_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `fk_marks_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `fk_marks_submission_id` FOREIGN KEY (`submission_id`) REFERENCES `submission` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`);

--
-- Constraints for table `question_set`
--
ALTER TABLE `question_set`
  ADD CONSTRAINT `fk_question_set_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `fk_question_set_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`);

--
-- Constraints for table `submission`
--
ALTER TABLE `submission`
  ADD CONSTRAINT `fk_submission_exam_id` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `fk_submission_question_id` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `fk_submission_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user_course_map`
--
ALTER TABLE `user_course_map`
  ADD CONSTRAINT `fk_user_course_map_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `fk_user_course_map_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
