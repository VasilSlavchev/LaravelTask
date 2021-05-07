CREATE TABLE `candidates` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `former_employee` int(11) NOT NULL,
  `job_title` varchar(80) NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  FOREIGN KEY (id) REFERENCES candidates (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `candidates` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `former_employee` int(11) NOT NULL,
  `job_title` varchar(80) NOT NULL,
  `company_name` varchar(80) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  FOREIGN KEY (id) REFERENCES candidates (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;