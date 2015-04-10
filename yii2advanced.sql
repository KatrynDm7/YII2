-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2015 г., 03:25
-- Версия сервера: 5.6.19-log
-- Версия PHP: 5.5.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1428418159),
('m130524_201442_init', 1428418166);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=120 ;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `quantity`, `created_at`, `updated_at`, `user_id`, `email`) VALUES
(94, 'ces1', 10, 1, 1428593768, 1428618359, 2, 'mail1@gmail.com'),
(101, 'new', 2, 3, 1428601200, 1428601253, 2, 'mail1@gmail.com'),
(104, 'new', 1, 0, 1428610596, 1428610596, 2, 'mail1@gmail.com'),
(106, 'new', 1, 1, 1428619126, 1428619126, 2, 'mail1@gmail.com'),
(109, 'new1', 1, 0, 1428620002, 1428620002, 2, 'mail1@gmail.com'),
(111, 'new', 11, 1, 1428620306, 1428620306, 6, 'new@mail.com'),
(112, 'apple', 10, 1, 1428621108, 1428621108, 8, 'new@mail.ru'),
(113, 'ball', 20, 0, 1428621147, 1428621147, 8, 'new@mail.ru'),
(114, 'apricot', 10, 5, 1428621168, 1428621168, 8, 'new@mail.ru'),
(118, 'lemon', 5, 1, 1428621817, 1428621817, 8, 'new@mail.ru'),
(119, 'table', 23, 2, 1428621837, 1428621837, 8, 'new@mail.ru');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'RrPtdJ1Di4GO1Ouqr0YxxyuLzYhm5L2W', '$2y$13$Yw.W54hW60RasnDoKbkFy.dYkuamoeJ4PfZmgDg6r82g.xfS7W2WS', NULL, 'mail@gmail.com', 10, 1428419568, 1428419568),
(2, 'x7tYxxrkjrLB5bvrs_X9ZEztOMdTyFVM', '$2y$13$G4Ymxxb2rafsnpxjKiKyA.2jjWTC8/77JEvDVPUoGvWW.C4u8sZsq', NULL, 'mail1@gmail.com', 10, 1428433728, 1428433728),
(5, 'cGqAMWgyjWvIcv7bV6qWwctmXtS8x2su', '$2y$13$XEfUk0knYnXWauxFvcn/yeyG9FP5Ktmdh6tcGcgwgCc3c3YuStGAG', NULL, 'new1@mail.ru', 10, 1428611297, 1428611297),
(6, 'Bp8EsUQyD8YgUYKUzGgMcOFGGxqyfx7u', '$2y$13$XR2NHqdvP.SWOJJ7gLKdHusPpxctb81ajykOou3NM.Q4vn61epP6W', NULL, 'new@mail.com', 10, 1428620263, 1428620263),
(7, 'i4dIkIDSJ0hX1b9TA-RoGFseT00cYG8j', '$2y$13$0qKooaldlkF8L8gThUXyJudT/SGd2PYfvYFa0IZfldxec1c6X3izW', NULL, 'mail1@mail.com', 10, 1428620389, 1428620389),
(8, 'bOfuFiyde9SpPoI0p6MHzgupqzNAHZGi', '$2y$13$MAw8hKaTH8tE3SmhpGSja.aG9/axyC4szyMNnu9RTjEIdJ6H4TG0W', NULL, 'new@mail.ru', 10, 1428621067, 1428621067);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
