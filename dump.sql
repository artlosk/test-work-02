-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 26 2018 г., 19:23
-- Версия сервера: 5.7.20
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sibers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role` smallint(1) NOT NULL DEFAULT '0',
  `firstname` varchar(64) DEFAULT NULL,
  `lastname` varchar(64) DEFAULT NULL,
  `gender` smallint(1) NOT NULL,
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `role`, `firstname`, `lastname`, `gender`, `dob`) VALUES
(1, 'root', 'e10adc3949ba59abbe56e057f20f883e', 1, '', '', 0, NULL),
(15, 'test01', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test01', 'Test01', 0, '2018-08-19'),
(16, 'test02', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test02', 'Test02', 0, '2011-08-19'),
(17, 'test03', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test03', 'Test03', 0, '2010-08-19'),
(18, 'test04', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test04', 'Test04', 0, '2011-09-19'),
(19, 'test05', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test05', 'Test05', 0, '1987-06-06'),
(20, 'test06', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test06', 'Test06', 0, '1988-08-08'),
(21, 'test07', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test07', 'Test07', 0, '1985-01-01'),
(22, 'test08', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test08', 'Test08', 0, '1959-02-02'),
(23, 'test09', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test09', 'Test09', 0, '1955-03-03'),
(24, 'test10', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test10', 'Test10', 0, '1956-04-04'),
(25, 'test11', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test11', 'Test11', 0, '1975-05-05'),
(26, 'test12', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test12', 'Test12', 0, '1980-06-06'),
(27, 'test13', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test13', 'Test13', 0, '1987-07-07'),
(28, 'test14', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test14', 'Test14', 0, '1983-08-08'),
(29, 'test15', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test15', 'Test15', 0, '1986-01-01'),
(30, 'test16', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test16', 'Test16', 0, '1959-09-01'),
(31, 'test17', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test17', 'Test17', 0, '2018-08-19'),
(32, 'test18', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test18', 'Test18', 0, '2011-08-19'),
(33, 'test19', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test19', 'Test19', 0, '2010-08-19'),
(34, 'test20', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test20', 'Test20', 0, '2011-09-19'),
(35, 'test21', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test21', 'Test21', 0, '1987-06-06'),
(36, 'test22', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test22', 'Test22', 0, '1988-08-08'),
(37, 'test23', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test23', 'Test23', 0, '1985-01-01'),
(38, 'test24', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test24', 'Test24', 0, '1959-02-02'),
(39, 'test25', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test25', 'Test25', 0, '1955-03-03'),
(40, 'test26', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test26', 'Test26', 0, '1956-04-04'),
(41, 'test27', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test27', 'Test27', 0, '1975-05-05'),
(42, 'test28', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test28', 'Test28', 0, '1980-06-06'),
(43, 'test29', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test29', 'Test29', 0, '1987-07-07'),
(44, 'test30', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test30', 'Test30', 0, '1983-08-08'),
(45, 'test31', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test31', 'Test31', 0, '1986-01-01'),
(46, 'test32', 'e10adc3949ba59abbe56e057f20f883e', 0, 'Test32', 'Test32', 0, '1959-09-01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u-login` (`login`) USING BTREE,
  ADD KEY `i-role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
