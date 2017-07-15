-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 16 2017 г., 00:41
-- Версия сервера: 10.1.23-MariaDB-9+deb9u1
-- Версия PHP: 7.0.19-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `reglogin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `reg_user`
--

CREATE TABLE `reg_user` (
  `id` int(11) NOT NULL,
  `login` varbinary(255) NOT NULL,
  `pass` varbinary(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reg_user`
--

INSERT INTO `reg_user` (`id`, `login`, `pass`, `name`, `type`) VALUES
(4, 0xcf19bf673fde1551885564aca63f9b8d, 0x2432792431322466724536326444354642353558646977787a5748612e376157562e696c2e454e3075433447674c2f45636f706332456f3266634865, '', 'admin'),
(5, 0xe9a1849f30ecc96d2084e9cff5be3853, 0x2432792431322433526e7345664872565a4a70666b752e78735955334f6c34336f6368413252357a6f496a4d6c4a6f79592f31382f45636b4848424f, '', 'user'),
(13, 0xcf19bf673fde1551885564aca63f9b8d, 0x24327924313224727975745571324373664d5161765848574b6b6a6d4f45736c496f75726174453234642f4739543542346c4c674f623050567a7169, '', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `reg_user`
--
ALTER TABLE `reg_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `reg_user`
--
ALTER TABLE `reg_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
