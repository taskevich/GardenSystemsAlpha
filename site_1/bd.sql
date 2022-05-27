-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 25 2022 г., 11:47
-- Версия сервера: 10.5.15-MariaDB-10+deb11u1
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `badyaga`
--
CREATE DATABASE IF NOT EXISTS `badyaga` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `badyaga`;

-- --------------------------------------------------------

--
-- Структура таблицы `culture`
--

CREATE TABLE `culture` (
  `Plant` varchar(20) NOT NULL,
  `NormalTempAir` float NOT NULL,
  `NormalTempEarth` float NOT NULL,
  `NormalHumidity` float NOT NULL,
  `MaxTempAir` float NOT NULL,
  `MaxTempEarth` int(11) NOT NULL,
  `MaxHumidity` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
-- Ошибка считывания данных таблицы badyaga.culture: #1064 - У вас ошибка в запросе. Изучите документацию по используемой версии MariaDB на предмет корректного синтаксиса около 'FROM `badyaga`.`culture`' на строке 1

-- --------------------------------------------------------

--
-- Структура таблицы `stats`
--

CREATE TABLE `stats` (
  `id` int(11) NOT NULL,
  `temp_air` float NOT NULL,
  `temp_earth` float NOT NULL,
  `light` int(11) NOT NULL,
  `humidity` double NOT NULL,
  `humidity_air` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
-- Ошибка считывания данных таблицы badyaga.stats: #1064 - У вас ошибка в запросе. Изучите документацию по используемой версии MariaDB на предмет корректного синтаксиса около 'FROM `badyaga`.`stats`' на строке 1

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;
-- Ошибка считывания данных таблицы badyaga.users: #1064 - У вас ошибка в запросе. Изучите документацию по используемой версии MariaDB на предмет корректного синтаксиса около 'FROM `badyaga`.`users`' на строке 1

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `culture`
--
ALTER TABLE `culture`
  ADD UNIQUE KEY `Plant` (`Plant`);

--
-- Индексы таблицы `stats`
--
ALTER TABLE `stats`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `stats`
--
ALTER TABLE `stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
