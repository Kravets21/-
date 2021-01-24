-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 15 2021 г., 12:56
-- Версия сервера: 10.1.46-MariaDB
-- Версия PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tz_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buyers`
--

CREATE TABLE IF NOT EXISTS `buyers` (
  `buyer_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `buyers`
--

INSERT INTO `buyers` (`buyer_id`, `name`) VALUES
(1, 'buyer one'),
(2, 'buyer two'),
(3, 'buyer three');

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `request_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `sum` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`request_id`, `buyer_id`, `sum`, `date`) VALUES
(1, 1, 590, '2020-01-01'),
(2, 5, 130, '2020-01-07'),
(3, 2, 758, '2020-05-12'),
(4, 3, 1889, '2020-07-18');

-- --------------------------------------------------------

--
-- Структура таблицы `requests_info`
--

CREATE TABLE IF NOT EXISTS `requests_info` (
  `request_id` int(11) NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `requests_info`
--

INSERT INTO `requests_info` (`request_id`, `info`) VALUES
(1, '[{"name":"\\u0413\\u043e\\u0440\\u043e\\u0434","value":"\\u041a\\u0438\\u0435\\u0432"},{"name":"\\u0418\\u043d\\u0434\\u0435\\u043a\\u0441","value":"0432"}]'),
(6, '[{"name":"\\u0413\\u043e\\u0440\\u043e\\u0434","value":"\\u0425\\u0430\\u0440\\u044c\\u043a\\u043e\\u0432"},{"name":"Hash","value":"utewt7g66287yffhg"}]'),
(3, '[{"name":"\\u0413\\u043e\\u0440\\u043e\\u0434","value":"\\u041b\\u044c\\u0432\\u043e\\u0432"},{"name":"IP","value":"127.0.0.1"}]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buyers`
--
ALTER TABLE `buyers`
  ADD PRIMARY KEY (`buyer_id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buyers`
--
ALTER TABLE `buyers`
  MODIFY `buyer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
