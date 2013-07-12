# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.16-log
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2013-07-11 16:59:58
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for monnezza
DROP DATABASE IF EXISTS `monnezza`;
CREATE DATABASE IF NOT EXISTS `monnezza` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `monnezza`;


# Dumping structure for table monnezza.conferimenti_monnezza
DROP TABLE IF EXISTS `conferimenti_monnezza`;
CREATE TABLE IF NOT EXISTS `conferimenti_monnezza` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DATA` datetime NOT NULL,
  `TIPOLOGIA` int(10) unsigned NOT NULL,
  `OPERATORE` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `FK_TIPOLOGIA_MONNEZZA` (`TIPOLOGIA`),
  KEY `FK_OPERATORE` (`OPERATORE`),
  CONSTRAINT `FK_conferimenti_monnezza_operatori` FOREIGN KEY (`OPERATORE`) REFERENCES `operatori` (`ID`),
  CONSTRAINT `FK_TIPOLOGIA_MONNEZZA` FOREIGN KEY (`TIPOLOGIA`) REFERENCES `tipologia_monnezza` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.


# Dumping structure for table monnezza.operatori
DROP TABLE IF EXISTS `operatori`;
CREATE TABLE IF NOT EXISTS `operatori` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL DEFAULT '0',
  `PASSWORD` varchar(15) NOT NULL DEFAULT '0',
  `DESCRIZIONE` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USERNAME` (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.


# Dumping structure for table monnezza.tipologia_monnezza
DROP TABLE IF EXISTS `tipologia_monnezza`;
CREATE TABLE IF NOT EXISTS `tipologia_monnezza` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CODICE` varchar(10) NOT NULL DEFAULT '0',
  `DESCRIZIONE` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CODICE` (`CODICE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
