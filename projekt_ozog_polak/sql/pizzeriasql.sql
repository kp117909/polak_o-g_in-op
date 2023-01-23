-- --------------------------------------------------------
-- Host:                         51.77.56.204
-- Wersja serwera:               5.5.45 - MySQL Community Server (GPL)
-- Serwer OS:                    Win64
-- HeidiSQL Wersja:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Zrzut struktury bazy danych pizzeria
CREATE DATABASE IF NOT EXISTS `pizzeria` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `pizzeria`;

-- Zrzut struktury tabela pizzeria.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) DEFAULT NULL,
  `cena` int(11) DEFAULT NULL,
  `img` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 CHECKSUM=1;

-- Zrzucanie danych dla tabeli pizzeria.menu: ~7 rows (około)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `nazwa`, `cena`, `img`) VALUES
	(1, 'Capriciosa', 23, '../png/classic.png'),
	(2, 'Wiejska', 19, '../png/margherita.png'),
	(3, 'Nowa', 51, '../png/ham.png'),
	(4, 'Kizzersy', 32, '../png/oriental.png'),
	(5, 'Miejska', 32, '../png/ham.png'),
	(6, 'Newest', 22, '../png/oriental.png'),
	(7, NULL, NULL, NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;

-- Zrzut struktury tabela pizzeria.pizza_skladnik
CREATE TABLE IF NOT EXISTS `pizza_skladnik` (
  `id_pizza` int(11) NOT NULL,
  `id_skladnika` int(11) DEFAULT NULL,
  KEY `fk2` (`id_skladnika`) USING BTREE,
  KEY `fk1` (`id_pizza`),
  CONSTRAINT `fk1` FOREIGN KEY (`id_pizza`) REFERENCES `menu` (`id`),
  CONSTRAINT `fk2` FOREIGN KEY (`id_skladnika`) REFERENCES `skladniki` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli pizzeria.pizza_skladnik: ~24 rows (około)
/*!40000 ALTER TABLE `pizza_skladnik` DISABLE KEYS */;
INSERT INTO `pizza_skladnik` (`id_pizza`, `id_skladnika`) VALUES
	(1, 3),
	(2, 6),
	(2, 5),
	(2, 9),
	(2, 12),
	(1, 5),
	(1, 1),
	(1, 8),
	(3, 5),
	(3, 1),
	(3, 9),
	(3, 11),
	(4, 2),
	(4, 7),
	(4, 10),
	(4, 12),
	(5, 7),
	(5, 8),
	(5, 10),
	(5, 13),
	(6, 18),
	(6, 19),
	(6, 1),
	(6, 9);
/*!40000 ALTER TABLE `pizza_skladnik` ENABLE KEYS */;

-- Zrzut struktury tabela pizzeria.skladniki
CREATE TABLE IF NOT EXISTS `skladniki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(50) DEFAULT '',
  `cena` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli pizzeria.skladniki: ~18 rows (około)
/*!40000 ALTER TABLE `skladniki` DISABLE KEYS */;
INSERT INTO `skladniki` (`id`, `nazwa`, `cena`) VALUES
	(1, 'Kukurydza', 3),
	(2, 'Boczek', 4),
	(3, 'Szynka', 3),
	(5, 'Cebula', 4),
	(6, 'Oliwki', 3),
	(7, 'Kebab', 6),
	(8, 'Mozarella', 3),
	(9, 'Oregano', 2),
	(10, 'Papryka', 2),
	(11, 'Pieczarki', 3),
	(12, 'Szpinak', 2),
	(13, 'Zurawina', 3),
	(14, 'Pomidory', 3),
	(15, 'Rukola', 2),
	(16, 'Ogorek', 3),
	(17, 'Nutella', 5),
	(18, 'Czosnek', 2),
	(19, 'Feta', 3);
/*!40000 ALTER TABLE `skladniki` ENABLE KEYS */;

-- Zrzut struktury procedura pizzeria.skladniki_nazwa_menu_pizza
DELIMITER //
CREATE PROCEDURE `skladniki_nazwa_menu_pizza`()
BEGIN
SELECT skladniki.nazwa FROM skladniki LEFT JOIN pizza_skladnik ON pizza_skladnik.id_skladnika = skladniki.id LEFT JOIN menu ON menu.id = pizza_skladnik.id_pizza WHERE menu.id = 2;
END//
DELIMITER ;

-- Zrzut struktury tabela pizzeria.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` varchar(55) NOT NULL,
  `password` varchar(255) NOT NULL,
  `city` varchar(50) DEFAULT '',
  `address` varchar(50) DEFAULT '',
  `nr_zamieszkania` varchar(50) DEFAULT '',
  `isadmin` int(11) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli pizzeria.user: ~2 rows (około)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `first_name`, `last_name`, `display_name`, `email`, `phonenumber`, `password`, `city`, `address`, `nr_zamieszkania`, `isadmin`) VALUES
	(1, 'Jan', 'Nowak', 'Naeczek', 'KK@kk.pl', '873-214-553', '$2y$10$G1NES3CaWPY6.SS/GKE1I.E4n09.QgUvvH9CQOwh3IWGwWoQJAw6W', 'Rzeszów', 'Kopisto 22', '222/3B', 1),
	(2, 'Ulica', 'Cie', 'Wyjasni', 'ulica@ciewyjasni.com', '353-312-532', '$2y$10$NIB/IbMjdgr.tV6rVoCTEefJEao4Aj8zFhuNSIfuhdNI6NNNIYtWG', 'Rzeszow', 'Meijski', '22', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Zrzut struktury tabela pizzeria.zamowienia
CREATE TABLE IF NOT EXISTS `zamowienia` (
  `id_zam` int(11) DEFAULT NULL,
  `nazwa_pizzy` varchar(50) DEFAULT NULL,
  `skladniki` longtext,
  `cena` double DEFAULT NULL,
  `ilosc` int(11) DEFAULT NULL,
  `rozmiar` varchar(50) DEFAULT 'Mała 28cm | + 0 zł',
  `data` datetime DEFAULT NULL,
  `notatka` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli pizzeria.zamowienia: ~86 rows (około)
/*!40000 ALTER TABLE `zamowienia` DISABLE KEYS */;
INSERT INTO `zamowienia` (`id_zam`, `nazwa_pizzy`, `skladniki`, `cena`, `ilosc`, `rozmiar`, `data`, `notatka`) VALUES
	(1, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(1, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(2, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(2, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(2, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(3, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(3, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(3, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(4, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(4, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(5, 'Własna', 'Mozarella, Oliwki, Oregano, ', 27, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(5, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(6, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(6, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(7, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 5, 'Mała', '2022-06-02 23:51:04', NULL),
	(7, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 3, 'Mała', '2022-06-02 23:51:04', NULL),
	(8, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 138, 6, 'Mała', '2022-06-02 23:51:04', NULL),
	(8, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(9, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 114, 6, 'Mała', '2022-06-02 23:51:04', NULL),
	(10, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 38, 2, 'Mała', '2022-06-02 23:51:04', NULL),
	(11, 'Własna', 'Kukurydza, Mozarella, Oliwki, Oregano, ', 30, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(12, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 253, 11, 'Mała', '2022-06-02 23:51:04', NULL),
	(12, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(12, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(13, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(13, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(14, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(14, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 115, 5, 'Mała', '2022-06-02 23:51:04', NULL),
	(14, 'Własna', 'Papryka, Pieczarki, Pomidory, Rukola, ', 87, 3, 'Mała', '2022-06-02 23:51:04', NULL),
	(15, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(23, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(24, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(25, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 58, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(26, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 58, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(27, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 161, 7, 'Mała', '2022-06-02 23:51:04', NULL),
	(27, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 390, 15, 'Mała', '2022-06-02 23:51:04', NULL),
	(27, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 174, 3, 'Mała', '2022-06-02 23:51:04', NULL),
	(28, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 161, 7, 'Mała', '2022-06-02 23:51:04', NULL),
	(28, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 390, 15, 'Mała', '2022-06-02 23:51:04', NULL),
	(28, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 174, 3, 'Mała', '2022-06-02 23:51:04', NULL),
	(28, 'Własna', 'Mozarella, Oliwki, Oregano, Papryka, Pieczarki, Pomidory, Rukola, Szpinak, Szynka, Zurawina, ', 58, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(29, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(30, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 58, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(31, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 64, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(33, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 64, 1, 'Mała', '2022-06-02 23:51:04', NULL),
	(34, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 116, 2, 'Średnia', '2022-06-02 23:51:04', NULL),
	(34, 'Własna', 'Boczek, Kukurydza, Mozarella, Pieczarki, Pomidory, ', 240, 5, 'Duża', '2022-06-02 23:51:04', NULL),
	(35, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 52, 2, 'Średnia', '2022-06-02 23:51:04', NULL),
	(35, 'Własna', 'Kukurydza, Mozarella, Oliwki, Pomidory, Rukola, ', 276, 6, 'Duża', '2022-06-02 23:51:04', NULL),
	(35, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-02 21:51:04', NULL),
	(39, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-02 21:51:04', NULL),
	(40, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 320, 5, 'Duża', '2022-06-03 22:58:08', NULL),
	(40, 'Własna', 'Pieczarki, Pomidory, Rukola, Szynka, Zurawina, ', 80, 2, 'Średnia', '2022-06-03 22:58:08', NULL),
	(41, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 15:12:51', ''),
	(41, 'Miejska', ' Kebab, Mozarella, Papryka, Zurawina,', 32, 1, 'Mała', '2022-06-06 15:12:51', ''),
	(42, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 15:16:34', 'Specjalna nottka'),
	(43, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 15:24:13', 'Varying modal content\r\nHave a bunch of buttons that all trigger the same modal with slightly different contents? Use event.relatedTarget and HTML data-* attributes (possibly via jQuery) to vary the contents of the modal depending on which button was clicked.\r\n'),
	(44, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 16:37:54', ''),
	(45, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 16:38:49', ''),
	(46, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 0, 2, 'Duża', '2022-06-06 16:47:23', ''),
	(47, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 0, 1, 'Mała', '2022-06-06 16:47:46', ''),
	(49, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:20:36', ''),
	(50, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:24:09', ''),
	(55, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:27:19', ''),
	(56, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:28:10', ''),
	(57, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:29:08', ''),
	(58, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:31:35', ''),
	(59, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:32:35', ''),
	(61, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:35:07', ''),
	(66, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:38:54', ''),
	(70, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:44:11', ''),
	(77, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:53:43', ''),
	(78, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:55:41', ''),
	(79, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:56:08', ''),
	(80, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 17:57:12', ''),
	(82, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 23, 1, 'Mała', '2022-06-06 17:57:44', ''),
	(84, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 17:59:50', ''),
	(85, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 18:02:34', ''),
	(87, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 51, 1, 'Mała', '2022-06-06 18:02:46', ''),
	(89, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 18:03:48', ''),
	(90, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 19, 1, 'Mała', '2022-06-06 18:04:13', ''),
	(91, 'Capriciosa', ' Szynka, Cebula, Kukurydza, Mozarella,', 21, 1, 'Mała', '2022-06-06 18:04:37', ''),
	(92, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 173, 3, 'Duża', '2022-06-06 18:05:26', ''),
	(92, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 117, 5, 'Średnia', '2022-06-06 18:05:26', ''),
	(93, 'Nowa', ' Cebula, Kukurydza, Oregano, Pieczarki,', 156.6, 3, 'Średnia', '2022-06-06 18:08:02', 'Na Grubym'),
	(93, 'Wiejska', ' Oliwki, Cebula, Oregano, Szpinak,', 28.8, 1, 'Duża', '2022-06-06 18:08:02', 'Na Grubym');
/*!40000 ALTER TABLE `zamowienia` ENABLE KEYS */;

-- Zrzut struktury tabela pizzeria.zarzadzanie_zamowieniami
CREATE TABLE IF NOT EXISTS `zarzadzanie_zamowieniami` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `nr_telefonu` varchar(50) DEFAULT NULL,
  `adress` varchar(50) DEFAULT NULL,
  `nr_zamieszkania` varchar(50) DEFAULT NULL,
  `miasto` varchar(50) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- Zrzucanie danych dla tabeli pizzeria.zarzadzanie_zamowieniami: ~93 rows (około)
/*!40000 ALTER TABLE `zarzadzanie_zamowieniami` DISABLE KEYS */;
INSERT INTO `zarzadzanie_zamowieniami` (`id`, `email`, `nr_telefonu`, `adress`, `nr_zamieszkania`, `miasto`) VALUES
	(1, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(2, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(3, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(4, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(5, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(6, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(7, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(8, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(9, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(10, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(11, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(12, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(13, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(14, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(15, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(16, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(17, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(18, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(19, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(20, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(21, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(22, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(23, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(24, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(25, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(26, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(27, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(28, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(29, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(30, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(31, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(32, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(33, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(34, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(35, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(36, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(37, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(38, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(39, 'ulica@ciewyjasni.com', '999997998', 'Meijski', '22', 'Rzeszow'),
	(40, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(41, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(42, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(43, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(44, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(45, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(46, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(47, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(48, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(49, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(50, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(51, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(52, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(53, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(54, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(55, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(56, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(57, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(58, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(59, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(60, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(61, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(62, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(63, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(64, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(65, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(66, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(67, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(68, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(69, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(70, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(71, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(72, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(73, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(74, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(75, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(76, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(77, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(78, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(79, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(80, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(81, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(82, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(83, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(84, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(85, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(86, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(87, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(88, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(89, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(90, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(91, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(92, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów'),
	(93, 'KK@kk.pl', '7899945646', 'Kopisto 22', '222/3B', 'Rzeszów');
/*!40000 ALTER TABLE `zarzadzanie_zamowieniami` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
