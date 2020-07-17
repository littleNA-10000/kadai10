-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 
-- サーバのバージョン： 5.6.34-log
-- PHP Version: 7.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_user_table`
--

CREATE TABLE `gs_user_table` (
  `id` int(11) NOT NULL,
  `lid` varchar(255) NOT NULL,
  `lpw` varchar(255) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_user_table`
--

INSERT INTO `gs_user_table` (`id`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(2, 'test2', '$2y$10$2qrtPWzphpM.H2pO2NcZJO4VuxR8fPadVuUiIZXCnoDfMbxjEp1vi', 1, 0),
(3, 'test3', '$2y$10$fY7l1RmfzV08s/TAXnQwZun74yo5f63LsWamvuAMr6y.ONnr1JYRK', 0, 0),
(5, 'test4', '$2y$10$8TPkLRwjAtrL1k6hF.zore8C6WWIBtbJBTGoeFmPVz02RRF3jfsh2', 0, 0),
(7, 'aaa', '$2y$10$3fqB7G1su7G7o9HJ7RSJzOas8d7wZIWctV.qpFYkA85eWJ2WtG5HC', 0, 0),
(8, 'bbb', '$2y$10$SH6ZfJxOphXlqMse/iya8eOUQ5Pv/eS/uz/B4wjn9JwZChd0XOnSO', 0, 0),
(9, 'ccc', '$2y$10$mMI0QOUtKgcKytj/cyY22u/iViTEmvPLuo5A1.B7AFH357D/Xpwem', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_user_table`
--
ALTER TABLE `gs_user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
