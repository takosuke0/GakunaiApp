-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-17 02:24:55
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `attendance`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attendance_log`
--

CREATE TABLE `attendance_log` (
  `id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `students_classes_id` varchar(16) NOT NULL,
  `day_of_week` varchar(12) NOT NULL,
  `timetable_times_id` int(2) DEFAULT NULL,
  `timetable_subjects_id` varchar(40) DEFAULT NULL,
  `attendance_status` varchar(12) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `attendance_rate`
--

CREATE TABLE `attendance_rate` (
  `id` int(11) NOT NULL,
  `students_id` int(11) NOT NULL,
  `timetable_subjects_id` varchar(40) NOT NULL,
  `rate` varchar(4) NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- テーブルの構造 `classes`
--

CREATE TABLE `classes` (
  `class_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `classes`
--

INSERT INTO `classes` (`class_id`) VALUES
('ig11'),
('ig12'),
('ig21'),
('ig22'),
('ri11'),
('ri12'),
('ri21'),
('ri22');

-- --------------------------------------------------------

--
-- テーブルの構造 `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(60) NOT NULL,
  `furigana` varchar(60) NOT NULL,
  `gender` varchar(16) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `password` varchar(255) NOT NULL,
  `classes_id` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `furigana`, `gender`, `email`, `password`, `classes_id`) VALUES
(200001, '曽田航介', 'ソタコウスケ', '男', '200099oy@yse-c.net', '$2y$10$d9Mf0zTr5w86Mmg32CVN0OSbhVHGTngEoolQ6kjSzrvZarpzrVwIi', 'ig21'),
(200002, 'aiueo', 'アイウエオ', '男', 'a@a.aa', '$2y$10$O.GnnLip6BExp/NcPlHbeuB7kPgdkz6w12Ey2t5kYIiS.IwxGJSnm', 'ig22');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_id` (`students_id`) USING BTREE,
  ADD KEY `attendance_log_ibfk_4` (`students_classes_id`),
  ADD KEY `timetable_subjects_id` (`timetable_subjects_id`);

--
-- テーブルのインデックス `attendance_rate`
--
ALTER TABLE `attendance_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_id` (`students_id`),
  ADD KEY `timetable_subjects_id` (`timetable_subjects_id`);

--
-- テーブルのインデックス `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- テーブルのインデックス `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `student_name` (`student_name`),
  ADD KEY `furigana` (`furigana`),
  ADD KEY `classes_id` (`classes_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `attendance_log`
--
ALTER TABLE `attendance_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `attendance_rate`
--
ALTER TABLE `attendance_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200003;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `attendance_log`
--
ALTER TABLE `attendance_log`
  ADD CONSTRAINT `attendance_log_ibfk_1` FOREIGN KEY (`students_id`) REFERENCES `students` (`student_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_log_ibfk_4` FOREIGN KEY (`students_classes_id`) REFERENCES `classes` (`class_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_log_ibfk_5` FOREIGN KEY (`timetable_subjects_id`) REFERENCES `timetable`.`subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `attendance_rate`
--
ALTER TABLE `attendance_rate`
  ADD CONSTRAINT `attendance_rate_ibfk_2` FOREIGN KEY (`students_id`) REFERENCES `students` (`student_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `attendance_rate_ibfk_3` FOREIGN KEY (`timetable_subjects_id`) REFERENCES `timetable`.`subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`class_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
