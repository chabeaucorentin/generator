--
-- Database : generator
--

-- --------------------------------------------------------

--
-- Dumping data for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
	`field_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`field_type` ENUM('number', 'text', 'image') NOT NULL,
	`field_code` VARCHAR(50) NOT NULL,
	`field_content` TEXT NOT NULL DEFAULT 'a:0:{}',
	`field_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Dumping data for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
	`setting_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
	`setting_key` VARCHAR(50) NOT NULL,
	`setting_value` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES
('name', 'Generator'),
('description', 'Generator est un système de génération d&#039;énoncés qui rend vos contenus attractifs à l&#039;aide de champs aléatoires'),
('keywords', 'générateur, énoncés, champs, gestion, nombre, texte, image, remplissage'),
('delimiter', '##'),
('theme', 'light');

-- --------------------------------------------------------

--
-- Dumping data for table `wordings`
--

CREATE TABLE IF NOT EXISTS `wordings` (
	`wording_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`wording_title` VARCHAR(50) NOT NULL,
	`wording_content` LONGTEXT NOT NULL,
	`wording_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`wording_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
