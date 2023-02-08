-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               8.0.31 - MySQL Community Server - GPL
-- Server Betriebssystem:        Linux
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Exportiere Datenbank Struktur für db
CREATE DATABASE IF NOT EXISTS `db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db`;

-- Exportiere Struktur von Tabelle db.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int NOT NULL,
  `is_correct` enum('1','0') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `answer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foreign_key` (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Die Antworten nach Fragen Sortiert';

-- Exportiere Daten aus Tabelle db.answers: ~150 rows (ungefähr)
REPLACE INTO `answers` (`id`, `question_id`, `is_correct`, `answer`) VALUES
	(1, 1, '0', 'Europe'),
	(2, 1, '0', 'Asia'),
	(3, 1, '1', 'South America'),
	(4, 1, '0', 'Australia'),
	(5, 1, '0', 'North America'),
	(6, 2, '1', 'Freddie Mercury'),
	(7, 2, '0', 'David Bowie'),
	(8, 2, '0', 'Elton John'),
	(9, 2, '0', 'Bruce Springsteen'),
	(10, 2, '0', 'John Lennon'),
	(11, 3, '0', 'Hey Jude'),
	(12, 3, '0', 'Imagine'),
	(13, 3, '1', 'Let it Be'),
	(14, 3, '0', 'Yesterday'),
	(15, 3, '0', 'Help!'),
	(16, 4, '0', 'Giacomo Puccini'),
	(17, 4, '0', 'Wolfgang Amadeus Mozart'),
	(18, 4, '1', 'Gioachino Rossini'),
	(19, 4, '0', 'Ludwig van Beethoven'),
	(20, 4, '0', 'Giuseppe Verdi'),
	(21, 5, '0', 'Swan Lake'),
	(22, 5, '1', 'The Nutcracker'),
	(23, 5, '0', 'The Sleeping Beauty'),
	(24, 5, '0', 'Romeo and Juliet'),
	(25, 5, '0', 'Cinderella'),
	(26, 6, '1', 'Rhapsody in Blue'),
	(27, 6, '0', 'Concerto in F'),
	(28, 6, '0', 'An American in Paris'),
	(29, 6, '0', 'Prelude No. 2'),
	(30, 6, '0', 'Piano Concerto No. 2'),
	(31, 7, '1', 'Russia'),
	(32, 7, '0', 'Canada'),
	(33, 7, '0', 'China'),
	(34, 7, '0', 'United States'),
	(35, 7, '0', 'Antarctica'),
	(36, 8, '0', 'Paris'),
	(37, 8, '0', 'Madrid'),
	(38, 8, '0', 'Berlin'),
	(39, 8, '1', 'Rome'),
	(40, 8, '0', 'London'),
	(41, 9, '1', 'Euro'),
	(42, 9, '0', 'Dollar'),
	(43, 9, '0', 'Pound'),
	(44, 9, '0', 'Yen'),
	(45, 9, '0', 'Franc'),
	(46, 10, '0', 'South Africa'),
	(47, 10, '0', 'Nigeria'),
	(48, 10, '0', 'Egypt'),
	(49, 10, '1', 'Ethiopia'),
	(50, 10, '0', 'Morocco'),
	(51, 11, '0', 'Monaco'),
	(52, 11, '0', 'San Marino'),
	(53, 11, '1', 'Vatican City'),
	(54, 11, '0', 'Nauru'),
	(55, 11, '0', 'Tuvalu'),
	(56, 12, '1', 'All Eyez on Me'),
	(57, 12, '0', 'The Chronic'),
	(58, 12, '0', 'The Slim Shady LP'),
	(59, 12, '0', 'Ready to Die'),
	(60, 12, '0', 'Life After Death'),
	(61, 13, '1', 'Led Zeppelin'),
	(62, 13, '0', 'Black Sabbath'),
	(63, 13, '0', 'The Who'),
	(64, 13, '0', 'Deep Purple'),
	(65, 13, '0', 'Pink Floyd'),
	(66, 14, '1', 'Thriller'),
	(67, 14, '0', 'Beat It'),
	(68, 14, '0', 'Billie Jean'),
	(69, 14, '0', 'Bad'),
	(70, 14, '0', 'Man in the Mirror'),
	(71, 15, '0', 'Suspicious Minds'),
	(72, 15, '0', 'Blue Suede Shoes'),
	(73, 15, '0', 'Heartbreak Hotel'),
	(74, 15, '0', 'Hound Dog'),
	(75, 15, '1', 'Love Me Tender'),
	(76, 16, '0', 'Someone Like You'),
	(77, 16, '0', 'Hello'),
	(78, 16, '1', 'Set Fire to the Rain'),
	(79, 16, '0', 'Rolling in the Deep'),
	(80, 16, '0', 'Skyfall'),
	(81, 17, '1', 'Missing in Action'),
	(82, 17, '0', 'Invasion U.S.A.'),
	(83, 17, '0', 'The Octagon'),
	(84, 17, '0', 'Delta Force'),
	(85, 17, '0', 'Code of Silence'),
	(86, 18, '1', 'Carlos Ray Norris'),
	(87, 18, '0', 'Charles Richard Norris'),
	(88, 18, '0', 'Charles Robert Norris'),
	(89, 18, '0', 'Charles Raymond Norris'),
	(90, 18, '0', 'Carl Richard Norris'),
	(91, 19, '1', 'Martial Arts'),
	(92, 19, '0', 'Comedian'),
	(93, 19, '0', 'Actor'),
	(94, 19, '0', 'Philanthropist'),
	(95, 19, '0', 'Politician'),
	(96, 20, '1', '10th Degree Black Belt'),
	(97, 20, '0', '8th Degree Black Belt'),
	(98, 20, '0', '9th Degree Black Belt'),
	(99, 20, '0', '7th Degree Black Belt'),
	(100, 20, '0', '6th Degree Black Belt'),
	(101, 21, '1', '1940'),
	(102, 21, '0', '1941'),
	(103, 21, '0', '1942'),
	(104, 21, '0', '1943'),
	(105, 21, '0', '1944'),
	(106, 22, '0', 'Felis catus'),
	(107, 22, '1', 'Felis silvestris catus'),
	(108, 22, '0', 'Panthera tigris'),
	(109, 22, '0', 'Canis lupus'),
	(110, 22, '0', 'Equus caballus'),
	(111, 23, '1', 'Lion'),
	(112, 23, '0', 'Tiger'),
	(113, 23, '0', 'Jaguar'),
	(114, 23, '0', 'Leopard'),
	(115, 23, '0', 'Elephant'),
	(116, 24, '1', 'Ostrich'),
	(117, 24, '0', 'Emu'),
	(118, 24, '0', 'Kiwi'),
	(119, 24, '0', 'Pelican'),
	(120, 24, '0', 'Swan'),
	(121, 25, '1', 'Bumblebee Bat'),
	(122, 25, '0', 'Pygmy Shrew'),
	(123, 25, '0', 'Etruscan Shrew'),
	(124, 25, '0', 'Harvest Mouse'),
	(125, 25, '0', 'African Pygmy Mouse'),
	(126, 26, '1', 'Eagle'),
	(127, 26, '0', 'Hawk'),
	(128, 26, '0', 'Falcon'),
	(129, 26, '0', 'Owl'),
	(130, 26, '0', 'Pelican'),
	(131, 27, '1', 'Avengers: Endgame'),
	(132, 27, '0', 'Avatar'),
	(133, 27, '0', 'Titanic'),
	(134, 27, '0', 'Star Wars: The Force Awakens'),
	(135, 27, '0', 'Avengers: Infinity War'),
	(136, 28, '0', '1917'),
	(137, 28, '1', 'Parasite'),
	(138, 28, '0', 'Joker'),
	(139, 28, '0', 'The Irishman'),
	(140, 28, '0', 'Once Upon a Time in Hollywood'),
	(141, 29, '1', 'Frank Darabont'),
	(142, 29, '0', 'Martin Scorsese'),
	(143, 29, '0', 'Quentin Tarantino'),
	(144, 29, '0', 'Steven Spielberg'),
	(145, 29, '0', 'David Fincher'),
	(146, 30, '1', 'Harrison Ford'),
	(147, 30, '0', 'Tom Hanks'),
	(148, 30, '0', 'Matt Damon'),
	(149, 30, '0', 'Brad Pitt'),
	(150, 30, '0', 'George Clooney');

-- Exportiere Struktur von Tabelle db.questions
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `topic` enum('music','ch-norris','animals','movies','d-n-d','astronautics','technology','ai','geography','sports','science','informatics','gen-knowledge') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('SINGLE','MULTIPLE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'SINGLE',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'animal.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exportiere Daten aus Tabelle db.questions: ~30 rows (ungefähr)
REPLACE INTO `questions` (`id`, `topic`, `question`, `type`, `image`) VALUES
	(1, 'geography', 'On which continent lies São Paulo?', 'SINGLE', 'animal.jpg'),
	(2, 'music', 'Who is the lead singer of the band "Queen"?', 'SINGLE', 'animal.jpg'),
	(3, 'music', 'What is the most famous song of the band "Beatles"?', 'SINGLE', 'animal.jpg'),
	(4, 'music', 'Who is the author of the famous opera "The Barber of Seville"?', 'SINGLE', 'animal.jpg'),
	(5, 'music', 'What is the name of the famous melody composed by Tchaikovsky in 1875-76?', 'SINGLE', 'animal.jpg'),
	(6, 'music', 'What is the name of the famous jazz standard composed by George Gershwin in 1924?', 'SINGLE', 'animal.jpg'),
	(7, 'geography', 'What is the largest country in the world by area?', 'SINGLE', 'animal.jpg'),
	(8, 'geography', 'What is the capital city of Italy?', 'SINGLE', 'animal.jpg'),
	(9, 'geography', 'What is the currency used in Spain?', 'SINGLE', 'animal.jpg'),
	(10, 'geography', 'Which African country is known as the "Horn of Africa"?', 'SINGLE', 'animal.jpg'),
	(11, 'geography', 'What is the smallest country in the world by area?', 'SINGLE', 'animal.jpg'),
	(12, 'music', 'What is the name of the famous hip-hop album released by Tupac in 1996?', 'SINGLE', 'animal.jpg'),
	(13, 'music', 'Who is the author of the famous rock song "Stairway to Heaven"?', 'SINGLE', 'animal.jpg'),
	(14, 'music', 'What is the name of the famous song performed by Michael Jackson in 1982?', 'SINGLE', 'animal.jpg'),
	(15, 'music', 'What is the name of the famous song performed by Elvis Presley in 1957?', 'SINGLE', 'animal.jpg'),
	(16, 'music', 'What is the name of the famous song performed by Adele in 2011?', 'SINGLE', 'animal.jpg'),
	(17, 'ch-norris', 'Which movie starred Chuck Norris as the lead role?', 'SINGLE', 'animal.jpg'),
	(18, 'ch-norris', 'What is the real name of Chuck Norris?', 'SINGLE', 'animal.jpg'),
	(19, 'ch-norris', 'What is Chuck Norris famous for?', 'SINGLE', 'animal.jpg'),
	(20, 'ch-norris', 'What kind of belt does Chuck Norris hold in martial arts?', 'SINGLE', 'animal.jpg'),
	(21, 'ch-norris', 'Which year was Chuck Norris born?', 'SINGLE', 'animal.jpg'),
	(22, 'animals', 'What is the scientific name for domestic cat?', 'SINGLE', 'animal.jpg'),
	(23, 'animals', 'Which animal is known as the king of the jungle?', 'SINGLE', 'animal.jpg'),
	(24, 'animals', 'What is the largest living bird by height?', 'SINGLE', 'animal.jpg'),
	(25, 'animals', 'What is the smallest mammal in the world?', 'SINGLE', 'animal.jpg'),
	(26, 'animals', 'What is the national bird of the United States?', 'SINGLE', 'animal.jpg'),
	(27, 'movies', 'What is the highest-grossing movie of all time (unadjusted for inflation)?', 'SINGLE', 'animal.jpg'),
	(28, 'movies', 'Which movie won the Best Picture Oscar in 2020?', 'SINGLE', 'animal.jpg'),
	(29, 'movies', 'Who directed the movie "The Shawshank Redemption"?', 'SINGLE', 'animal.jpg'),
	(30, 'movies', 'What is the real name of the actor who played Indiana Jones?', 'SINGLE', 'animal.jpg');

-- Exportiere Struktur von Tabelle db.summary
CREATE TABLE IF NOT EXISTS `summary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  `answer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `correct` tinyint NOT NULL DEFAULT '0',
  `timest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Quiz Log des Opportunity quizes';

-- Exportiere Daten aus Tabelle db.summary: ~21 rows (ungefähr)
REPLACE INTO `summary` (`id`, `user_id`, `question_id`, `answer`, `correct`, `timest`) VALUES
	(1, 1, 1, '3', 3, '1675163623'),
	(2, 1, 7, '1', 1, '1675163627'),
	(3, 1, 8, '4', 4, '1675163632'),
	(4, 1, 9, '1', 1, '1675163638'),
	(5, 1, 10, '1', 4, '1675163645'),
	(6, 1, 11, '3', 3, '1675163655'),
	(7, 1, 2, '1', 1, '1675163997'),
	(8, 1, 3, '1', 3, '1675164000'),
	(9, 1, 4, '1', 3, '1675164004'),
	(10, 1, 5, '1', 2, '1675164007'),
	(11, 1, 6, '1', 1, '1675164011'),
	(12, 1, 12, '1', 1, '1675164014'),
	(13, 1, 13, '1', 1, '1675164018'),
	(14, 1, 14, '1', 1, '1675164022'),
	(15, 1, 15, '1', 5, '1675164025'),
	(16, 1, 16, '1', 3, '1675164028'),
	(17, 1, 17, '4', 1, '1675164238'),
	(18, 1, 18, '1', 1, '1675164244'),
	(19, 1, 19, '3', 1, '1675164249'),
	(20, 1, 20, '1', 1, '1675164255'),
	(21, 1, 21, '1', 1, '1675164259');

-- Exportiere Struktur von Tabelle db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `password_sha256` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'standard@email.com',
  `created_at` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Benutzer Tabelle oop Project 1 PHP Quiz';

-- Exportiere Daten aus Tabelle db.users: ~1 rows (ungefähr)
REPLACE INTO `users` (`id`, `username`, `password_sha256`, `email`, `created_at`, `last_login`, `ip`, `score`) VALUES
	(1, 'Trojan', 'dd67797d20b32f6df658be198b2fcd9d4e78fc6dc6861f798a10cc9b657c5417', 'sven.bledt@gmail.com', '1674738529', '1675842125', '172.22.0.1', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
