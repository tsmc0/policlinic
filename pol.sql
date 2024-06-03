-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 10 2024 г., 21:49
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pol`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctor`
--

CREATE TABLE `doctor` (
  `id` int(11) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regID` int(11) NOT NULL,
  `date_create` int(11) NOT NULL,
  `profID` int(11) NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `timePerClient` int(11) NOT NULL,
  `login` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctor`
--

INSERT INTO `doctor` (`id`, `first_name`, `last_name`, `father_name`, `regID`, `date_create`, `profID`, `avatar`, `timePerClient`, `login`, `password`) VALUES
(1, 'Светлана ', 'Архипова', 'Александровна', 1, 123456789, 1, '', 5, 'arhipova_sa', '$2y$13$OrpdSEkFBAoTkDA4TlyFI.34Hk4FIIHW5JMJVQQIYbe3pWCmt3vDO'),
(2, 'Татьяна', 'Шестакова', 'Александровна', 1, 123456789, 1, '', 8, NULL, NULL),
(3, 'Екатерина', 'Архипова', 'Борисовна', 2, 1212121, 2, '', 10, NULL, NULL),
(4, 'Анна', 'Благинина', 'Владимировна', 4, 212121, 3, '', 20, NULL, NULL),
(5, 'Лариса', 'Сташкевич', 'Владимировна', 3, 212121, 4, '', 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `doctorSpec`
--

CREATE TABLE `doctorSpec` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctorSpec`
--

INSERT INTO `doctorSpec` (`id`, `title`) VALUES
(1, 'ПЕДИАТР'),
(2, 'ОФТАЛЬМОЛОГ'),
(3, 'СТОМАТОЛОГ ДЕТСКИЙ'),
(4, 'ДЕРМАТОВЕНЕРОЛОГ');

-- --------------------------------------------------------

--
-- Структура таблицы `doctorTabel`
--

CREATE TABLE `doctorTabel` (
  `id` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `workingDayStart` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `workingDayEnd` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clientType` int(11) NOT NULL DEFAULT 0,
  `freeDay` tinyint(1) NOT NULL DEFAULT 0,
  `isTaken` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctorTabel`
--

INSERT INTO `doctorTabel` (`id`, `docID`, `workingDayStart`, `workingDayEnd`, `clientType`, `freeDay`, `isTaken`) VALUES
(1, 1, '13.05.2024 08:00', '13.05.2024 10:00', 0, 0, 0),
(2, 1, '15.05.2024 10:30', '15.05.2024 11:30', 0, 0, 0),
(3, 3, '16.05.2024 15:00', '16.05.2024 17:30', 0, 0, 0),
(4, 1, '20.05.2024 08:00', '20.05.2024 10:35', 0, 0, 0),
(5, 2, '05.06.2024 08:00', '05.06.2024 10:00', 0, 0, 0),
(6, 5, '05.06.2024 10:00', '05.06.2024 12:00', 0, 0, 0),
(8, 1, '11.06.2024 10:00', '11.06.2024 13:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `doctorTake`
--

CREATE TABLE `doctorTake` (
  `id` int(11) NOT NULL,
  `docID` int(11) NOT NULL,
  `regID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `time_write` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `doctorTake`
--

INSERT INTO `doctorTake` (`id`, `docID`, `regID`, `userID`, `time_write`) VALUES
(1, 1, 1, 1, '13.05.2024 08:45'),
(2, 1, 1, 1, '15.05.2024 10:30'),
(3, 1, 1, 1, '15.05.2024 10:35'),
(4, 1, 1, 1, '20.05.2024 10:05'),
(5, 3, 1, 1, '16.05.2024 16:00'),
(6, 2, 1, 1, '05.06.2024 08:40'),
(7, 5, 1, 1, '05.06.2024 10:30'),
(8, 1, 1, 1, '10.06.2024 10:30');

-- --------------------------------------------------------

--
-- Структура таблицы `policlinic`
--

CREATE TABLE `policlinic` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `policlinic`
--

INSERT INTO `policlinic` (`id`, `title`, `address`, `type`) VALUES
(1, 'ГБУ \"Курганская детская поликлиника\" / Педиатрическое отделение №9', 'КУРГАН, МЕХАНИЧЕСКИЙ ПОСЕЛОК, 42', 0),
(2, 'ГБУ \"Курганская детская поликлиника\" / Педиатрическое отделение №2', 'КУРГАН, КОНСТИТУЦИИ, 42', 0),
(3, 'ГБУ \"Курганская детская поликлиника\" / Кабинет зубного врача', 'КУРГАН, КАРЕЛЬЦЕВА, 111/1', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeral` int(11) NOT NULL,
  `polID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `region`
--

INSERT INTO `region` (`id`, `title`, `district`, `numeral`, `polID`) VALUES
(1, 'Участок 49', 'Курган, ул 8 Марта Ч(102-120), 115-133, Н(115-133), 102-133\r\nКурган, ул Вагонная\r\nКурган, ул Жуковского\r\nКурган, ул Ивана Земнухова Ч(2-22), Н(1-35)\r\nКурган, ул Калинина 2\r\nКурган, ул Кольцевая Н(1-53)\r\nКурган, ул Котовского 11, 22\r\nКурган, ул Лермонтова Н(1-35), 2-68, Ч(2-68), 1-35\r\nКурган, ул Луначарского 4, 2\r\nКурган, ул Малая Южная\r\nКурган, ул Мамина-сибиряка\r\nКурган, ул Молодёжи Н(1-11), Ч(2-12)\r\nКурган, пер Молодёжи 1-11, 2-12\r\nКурган, ул Озёрная\r\nКурган, ул Октябрьская Ч(2-36), Н(1-27)\r\nКурган, ул Омская Н(1-41), Ч(2-10)\r\nКурган, ул Отдыха 2, 4Б, Н(1-5), 8, 2Б\r\nКурган, ул Панфилова Ч(2-70)\r\nКурган, ул Партизанская Ч(110-126), 110-126\r\nКурган, ул Петропавловская 17Б, Н(1-31), 174, Ч(2-32)\r\nКурган, ул Пионерская Ч(2-8), Н(1-5)\r\nКурган, ул Правды 67-124, 108-124\r\nКурган, ул Садовая Н(1-49), Ч(2-24)\r\nКурган, ул Шевелёвская\r\nКурган, ул Южная Ч(18-28), 40, Н(75-93)\r\nКурган, ул Ястржембского 40Б', 49, 1),
(2, 'Участок 55', 'Курган, ул Бурова-петрова 96, 79, 96Г, 98, 98Г\r\nКурган, ул Дзержинского 46А, 40А, 52, 46, 54А, 52Б, 38, 44, 42, 50, 36, 34, 54, 32, 52А\r\nКурган, ул Кирпичная\r\nКурган, ул Некрасова 17, 37, 63, 73, 29, 15А, 41, 25, 30, 33, 35, 23, 31', 55, 2),
(3, 'Участок 55', 'ttt', 55, 1),
(4, 'Участок 55', '-', 55, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_birth` date NOT NULL,
  `date_create` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `regionID` int(11) NOT NULL,
  `polID` int(11) NOT NULL,
  `authKey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `medPolis` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `father_name`, `username`, `date_birth`, `date_create`, `email`, `password`, `regionID`, `polID`, `authKey`, `medPolis`, `isAdmin`) VALUES
(1, 'Иванов', 'Иван', 'Иванович', 'ivanov_ii', '2004-10-09', 1715707507, 'stem@ya.ru', '$2y$13$OrpdSEkFBAoTkDA4TlyFI.34Hk4FIIHW5JMJVQQIYbe3pWCmt3vDO', 1, 1, 'kIveDvspRLcprgpaj3_gNbs1qZ-9gHzi', '123-123-123-123', 1),
(2, 'Анатолий', 'Александров', 'Викторович', 'tolyan_av', '2006-09-09', 1717481489, 'tolyan288@gmail.com', '$2y$13$XtiYQzc3aC0IP0tfBq0mh.XSy/0tw2kpBSy3absQNYehlxcxQBD5i', 2, 2, 'H4CXv-M_GIAE-Q4ZZl9mI3-nL3dRfagm', '12345-999-4343', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `profID` (`profID`),
  ADD KEY `regID` (`regID`);

--
-- Индексы таблицы `doctorSpec`
--
ALTER TABLE `doctorSpec`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `doctorTabel`
--
ALTER TABLE `doctorTabel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `docID` (`docID`);

--
-- Индексы таблицы `doctorTake`
--
ALTER TABLE `doctorTake`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `docID` (`docID`),
  ADD KEY `regID` (`regID`),
  ADD KEY `userID` (`userID`);

--
-- Индексы таблицы `policlinic`
--
ALTER TABLE `policlinic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `polID` (`polID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `polID` (`polID`),
  ADD KEY `regionID` (`regionID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctor`
--
ALTER TABLE `doctor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `doctorSpec`
--
ALTER TABLE `doctorSpec`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `doctorTabel`
--
ALTER TABLE `doctorTabel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `doctorTake`
--
ALTER TABLE `doctorTake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `policlinic`
--
ALTER TABLE `policlinic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`profID`) REFERENCES `doctorSpec` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`regID`) REFERENCES `region` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `doctorTabel`
--
ALTER TABLE `doctorTabel`
  ADD CONSTRAINT `doctortabel_ibfk_1` FOREIGN KEY (`docID`) REFERENCES `doctor` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `doctorTake`
--
ALTER TABLE `doctorTake`
  ADD CONSTRAINT `doctortake_ibfk_1` FOREIGN KEY (`docID`) REFERENCES `doctor` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctortake_ibfk_2` FOREIGN KEY (`regID`) REFERENCES `region` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `doctortake_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `region_ibfk_1` FOREIGN KEY (`polID`) REFERENCES `policlinic` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`polID`) REFERENCES `policlinic` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`regionID`) REFERENCES `region` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
