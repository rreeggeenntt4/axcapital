-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 12 2023 г., 13:59
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `axcapital`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `descr` text DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `descr`, `parent_id`) VALUES
(1, 'Category 1', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 2),
(2, 'Category 2', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 8),
(3, 'Catecory 3', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 9),
(4, 'Category 1 1', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 5),
(5, 'Category 1 2', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 1),
(6, 'Category 1 1 1', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 4),
(7, 'Category 1 1 1 1', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 3),
(8, 'Category 1 1 1 1 1', 'Акционерное общество «Кама», занимающееся разработкой «нового российского электромобиля», в ходе презентации в Москве представило первый функциональный образец отечественного электромобиля «Атом». Сборка первой модели запланирована на 2024 год, запуск в серийное производство планируется начать в 2025 году. До конца этого года будут проводиться тестирования батареи (на основе литий-ионных ячеек), созданной совместно с «Рэнера» (входит в ГК «Росатом»), а также подвески, рулевой системы и шасси. Для испытаний в августе этого года изготовят 13 электромобилей. Кроме того, «в скором времени» планируется объявить площадку, на которой будет вестись производство в РФ.', 7),
(9, 'Category 4', '', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` char(255) DEFAULT NULL,
  `email` char(255) NOT NULL,
  `pass` char(255) NOT NULL,
  `salt` char(255) NOT NULL,
  `created_at` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `pass`, `salt`, `created_at`) VALUES
(1, 'admin', 'admin@axcapital.loc', 'ec28cab4ecb4a06eda1a69fe3228d78f99d1041d', 'hAHQfWlfl3833n0hyCpE', '2023-05-12 13:32:16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
