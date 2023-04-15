-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2022-01-17 02:24:41
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
-- データベース: `timetable`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ig11`
--

CREATE TABLE `ig11` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ig11`
--

INSERT INTO `ig11` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ig12`
--

CREATE TABLE `ig12` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ig12`
--

INSERT INTO `ig12` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ig21`
--

CREATE TABLE `ig21` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ig21`
--

INSERT INTO `ig21` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ig22`
--

CREATE TABLE `ig22` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ig22`
--

INSERT INTO `ig22` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ri11`
--

CREATE TABLE `ri11` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ri11`
--

INSERT INTO `ri11` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ri12`
--

CREATE TABLE `ri12` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ri12`
--

INSERT INTO `ri12` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ri21`
--

CREATE TABLE `ri21` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ri21`
--

INSERT INTO `ri21` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `ri22`
--

CREATE TABLE `ri22` (
  `times_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `subjects_id_monday` varchar(40) DEFAULT NULL,
  `subjects_id_tuesday` varchar(40) DEFAULT NULL,
  `subjects_id_wednesday` varchar(40) DEFAULT NULL,
  `subjects_id_thursday` varchar(40) DEFAULT NULL,
  `subjects_id_friday` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `ri22`
--

INSERT INTO `ri22` (`times_id`, `start_time`, `ending_time`, `subjects_id_monday`, `subjects_id_tuesday`, `subjects_id_wednesday`, `subjects_id_thursday`, `subjects_id_friday`) VALUES
(1, '09:00:00', '09:45:00', '国語', '国語', '国語', '国語', '国語'),
(2, '09:50:00', '10:35:00', '数学', '数学', '数学', '数学', '数学'),
(3, '10:40:00', '11:25:00', '理科', '理科', '理科', '理科', '理科'),
(4, '11:35:00', '12:15:00', '社会', '社会', '社会', '社会', '社会');

-- --------------------------------------------------------

--
-- テーブルの構造 `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- テーブルのデータのダンプ `subjects`
--

INSERT INTO `subjects` (`subject_id`) VALUES
('体育'),
('保険体育'),
('国語'),
('技術・家庭'),
('数学'),
('理科'),
('社会'),
('美術'),
('英語'),
('音楽');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `ig11`
--
ALTER TABLE `ig11`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ig12`
--
ALTER TABLE `ig12`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ig21`
--
ALTER TABLE `ig21`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ig22`
--
ALTER TABLE `ig22`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ri11`
--
ALTER TABLE `ri11`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ri12`
--
ALTER TABLE `ri12`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ri21`
--
ALTER TABLE `ri21`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `ri22`
--
ALTER TABLE `ri22`
  ADD PRIMARY KEY (`times_id`),
  ADD KEY `subjects_id_monday` (`subjects_id_monday`),
  ADD KEY `subjects_id_tuesday` (`subjects_id_tuesday`),
  ADD KEY `subjects_id_wednesday` (`subjects_id_wednesday`),
  ADD KEY `subjects_id_thursday` (`subjects_id_thursday`),
  ADD KEY `subjects_id_friday` (`subjects_id_friday`);

--
-- テーブルのインデックス `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `ig11`
--
ALTER TABLE `ig11`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ig12`
--
ALTER TABLE `ig12`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ig21`
--
ALTER TABLE `ig21`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ig22`
--
ALTER TABLE `ig22`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ri11`
--
ALTER TABLE `ri11`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ri12`
--
ALTER TABLE `ri12`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ri21`
--
ALTER TABLE `ri21`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- テーブルの AUTO_INCREMENT `ri22`
--
ALTER TABLE `ri22`
  MODIFY `times_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `ig11`
--
ALTER TABLE `ig11`
  ADD CONSTRAINT `ig11_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig11_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig11_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig11_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig11_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ig12`
--
ALTER TABLE `ig12`
  ADD CONSTRAINT `ig12_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig12_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig12_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig12_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig12_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ig21`
--
ALTER TABLE `ig21`
  ADD CONSTRAINT `ig21_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig21_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig21_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig21_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig21_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ig22`
--
ALTER TABLE `ig22`
  ADD CONSTRAINT `ig22_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig22_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig22_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig22_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ig22_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ri11`
--
ALTER TABLE `ri11`
  ADD CONSTRAINT `ri11_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri11_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri11_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri11_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri11_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ri12`
--
ALTER TABLE `ri12`
  ADD CONSTRAINT `ri12_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri12_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri12_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri12_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri12_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ri21`
--
ALTER TABLE `ri21`
  ADD CONSTRAINT `ri21_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri21_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri21_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri21_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri21_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;

--
-- テーブルの制約 `ri22`
--
ALTER TABLE `ri22`
  ADD CONSTRAINT `ri22_ibfk_1` FOREIGN KEY (`subjects_id_monday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri22_ibfk_2` FOREIGN KEY (`subjects_id_tuesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri22_ibfk_3` FOREIGN KEY (`subjects_id_wednesday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri22_ibfk_4` FOREIGN KEY (`subjects_id_thursday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `ri22_ibfk_5` FOREIGN KEY (`subjects_id_friday`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
