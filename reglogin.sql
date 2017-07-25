-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июл 25 2017 г., 18:46
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
-- Структура таблицы `dostup`
--

CREATE TABLE `dostup` (
  `count` int(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `hash` varbinary(255) NOT NULL,
  `TIME` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ques` text NOT NULL,
  `userid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `name`, `email`, `ques`, `userid`) VALUES
(11, '6', '1@1.ua', '45445645664', 0),
(23, '22', '1@1.ua', 'fdsfdfl;  f;lsdkflsdksdf&#13;&#10;', 22);

-- --------------------------------------------------------

--
-- Структура таблицы `recovery`
--

CREATE TABLE `recovery` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `recovery`
--

INSERT INTO `recovery` (`id`, `code`) VALUES
(20, '0734c4');

-- --------------------------------------------------------

--
-- Структура таблицы `reg_user`
--

CREATE TABLE `reg_user` (
  `id` int(11) NOT NULL,
  `login` varbinary(255) NOT NULL,
  `pass` varbinary(255) NOT NULL,
  `email` varbinary(255) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user',
  `iv` varbinary(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `reg_user`
--

INSERT INTO `reg_user` (`id`, `login`, `pass`, `email`, `type`, `iv`, `status`) VALUES
(4, 0xcf19bf673fde1551885564aca63f9b8d, 0x2432792431322466724536326444354642353558646977787a5748612e376157562e696c2e454e3075433447674c2f45636f706332456f3266634865, '', 'admin', '', '0'),
(22, 0xee9179020b6c7c74d4e47a42275fdfe6, 0x2432792431322455676f4f70564c686b73536c693644717643443376656a7a436e494a676b4631654f4c47483745384955524c67656759494b666853, 0x169836f84238ab833b0a9524088ef4b5, 'user', 0x98c3858ea9e6db657552e88c8adc926a, '0'),
(28, 0x29fe2ff74064e0240a2d85e9e9fdbdc5, 0x243279243132247246627947642e6377387871634b316f5a4a3072574f52363255506942613862316775493957732f796961614833714b535a31544f, 0x169836f84238ab833b0a9524088ef4b5, 'user', 0xe808868e2d6a5c972b59ce6ef475c6cd, '0'),
(29, 0xcd7f98b17c09e1363558e4e07772d5a6, 0x2432792431322453644e59397461394e2f7a58517266305839394753757735766f4c4a474138525541766e6c3135754a646d2e594a7456396f526c43, 0x169836f84238ab833b0a9524088ef4b5, 'user', 0x67076ee496a1328ff5bd4a041b946072, '0');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reg_user`
--
ALTER TABLE `reg_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `reg_user`
--
ALTER TABLE `reg_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
