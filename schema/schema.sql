
CREATE DATABASE IF NOT EXISTS `exads` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `exads`;

CREATE TABLE IF NOT EXISTS `tv_series` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `channel` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

INSERT IGNORE INTO `tv_series` (`id`, `title`, `channel`, `gender`) VALUES
(1, 'The Boys', 'Prime', 'Drama'),
(2, 'Game of Thrones', 'HBO', 'Adventure'),
(3, 'DareDevil', 'Netflix', 'Action');

-- exads.tv_series_intervals definition

CREATE TABLE IF NOT EXISTS `tv_series_intervals` (
  `id_tv_series` int NOT NULL,
  `week_day` varchar(100) DEFAULT NULL,
  `show_time` varchar(100) DEFAULT NULL,
  KEY `tv_series_intervals_FK` (`id_tv_series`),
  CONSTRAINT `tv_series_intervals_FK` FOREIGN KEY (`id_tv_series`) REFERENCES `tv_series` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8;

