-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema mCRM_Database
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mCRM_Database` ;

-- -----------------------------------------------------
-- Schema mCRM_Database
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mCRM_Database` DEFAULT CHARACTER SET utf8 ;
USE `mCRM_Database` ;

-- -----------------------------------------------------
-- Table `mCRM_Database`.`konzern`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`konzern` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`konzern` (
  `idKonzern` INT(11) NOT NULL,
  `Name` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idKonzern`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mCRM_Database`.`filiale`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`filiale` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`filiale` (
  `Filialnummer` INT(11) NOT NULL,
  `Ort` VARCHAR(45) NULL DEFAULT NULL,
  `konzern_idKonzern` INT(11) NOT NULL,
  PRIMARY KEY (`Filialnummer`),
  CONSTRAINT `fk_filiale_konzern1`
    FOREIGN KEY (`konzern_idKonzern`)
    REFERENCES `mCRM_Database`.`konzern` (`idKonzern`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_filiale_konzern1_idx` ON `mCRM_Database`.`filiale` (`konzern_idKonzern` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`abteilung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`abteilung` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`abteilung` (
  `Abteilungsnummer` INT(11) NOT NULL,
  `Abteilungsname` VARCHAR(45) NULL DEFAULT NULL,
  `filiale_Filialnummer` INT(11) NOT NULL,
  PRIMARY KEY (`Abteilungsnummer`, `filiale_Filialnummer`),
  CONSTRAINT `fk_abteilung_filiale1`
    FOREIGN KEY (`filiale_Filialnummer`)
    REFERENCES `mCRM_Database`.`filiale` (`Filialnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_abteilung_filiale1_idx` ON `mCRM_Database`.`abteilung` (`filiale_Filialnummer` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`preis`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`preis` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`preis` (
  `idPreis` INT(11) NOT NULL,
  `Preis` DOUBLE NOT NULL,
  PRIMARY KEY (`idPreis`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mCRM_Database`.`artikel`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`artikel` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`artikel` (
  `Artikelnummer` INT(11) NOT NULL,
  `Bezeichner` VARCHAR(45) NOT NULL,
  `preis_idPreis` INT(11) NULL DEFAULT '1',
  `abteilung_Abteilungsnummer` INT(11) NULL DEFAULT '1',
  `Pic` VARCHAR(45) NULL,
  PRIMARY KEY (`Artikelnummer`),
  CONSTRAINT `fk_artikel_preis`
    FOREIGN KEY (`preis_idPreis`)
    REFERENCES `mCRM_Database`.`preis` (`idPreis`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_artikel_abteilung1`
    FOREIGN KEY (`abteilung_Abteilungsnummer`)
    REFERENCES `mCRM_Database`.`abteilung` (`Abteilungsnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_artikel_preis_idx` ON `mCRM_Database`.`artikel` (`preis_idPreis` ASC);

CREATE INDEX `fk_artikel_abteilung1_idx` ON `mCRM_Database`.`artikel` (`abteilung_Abteilungsnummer` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`sonderaktionen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`sonderaktionen` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`sonderaktionen` (
  `Sonderaktionnummer` INT(11) NOT NULL,
  `Rabatt` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Sonderaktionnummer`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mCRM_Database`.`kundenklasse`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`kundenklasse` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`kundenklasse` (
  `Kundenklasse` INT(11) NOT NULL,
  `Prozentualrabatt` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`Kundenklasse`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mCRM_Database`.`empfehlung`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`empfehlung` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`empfehlung` (
  `idEmpfehlung` INT NOT NULL,
  `artikel_Artikelnummer1` INT(11) NULL,
  `artikel_Artikelnummer2` INT(11) NULL,
  `artikel_Artikelnummer3` INT(11) NULL,
  `artikel_Artikelnummer4` INT(11) NULL,
  `artikel_Artikelnummer5` INT(11) NULL,
  `artikel_Artikelnummer6` INT(11) NULL,
  `artikel_Artikelnummer7` INT(11) NULL,
  `artikel_Artikelnummer8` INT(11) NULL,
  PRIMARY KEY (`idEmpfehlung`),
  CONSTRAINT `fk_Empfehlnug_artikel1`
    FOREIGN KEY (`artikel_Artikelnummer8`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel2`
    FOREIGN KEY (`artikel_Artikelnummer1`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel3`
    FOREIGN KEY (`artikel_Artikelnummer2`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel4`
    FOREIGN KEY (`artikel_Artikelnummer3`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel5`
    FOREIGN KEY (`artikel_Artikelnummer4`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel6`
    FOREIGN KEY (`artikel_Artikelnummer5`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel7`
    FOREIGN KEY (`artikel_Artikelnummer6`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empfehlnug_artikel8`
    FOREIGN KEY (`artikel_Artikelnummer7`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_Empfehlnug_artikel1_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer8` ASC);

CREATE INDEX `fk_Empfehlnug_artikel2_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer1` ASC);

CREATE INDEX `fk_Empfehlnug_artikel3_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer2` ASC);

CREATE INDEX `fk_Empfehlnug_artikel4_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer3` ASC);

CREATE INDEX `fk_Empfehlnug_artikel5_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer4` ASC);

CREATE INDEX `fk_Empfehlnug_artikel6_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer5` ASC);

CREATE INDEX `fk_Empfehlnug_artikel7_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer6` ASC);

CREATE INDEX `fk_Empfehlnug_artikel8_idx` ON `mCRM_Database`.`empfehlung` (`artikel_Artikelnummer7` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`kunde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`kunde` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`kunde` (
  `Kundennummer` INT(11) NOT NULL,
  `Vorname` VARCHAR(45) NULL DEFAULT NULL,
  `Nachname` VARCHAR(45) NULL DEFAULT NULL,
  `Durchschnittsumsatz` DOUBLE NULL DEFAULT NULL,
  `Kunde_inStore` TINYINT(1) NULL DEFAULT NULL,
  `sonderaktionen_Sonderaktionnummer` INT(11) NULL,
  `kundenklasse_Kundenklasse` INT(11) NULL,
  `Pic` VARCHAR(45) NULL,
  `empfehlung_idEmpfehlung` INT NOT NULL,
  PRIMARY KEY (`Kundennummer`),
  CONSTRAINT `fk_kunde_sonderaktionen1`
    FOREIGN KEY (`sonderaktionen_Sonderaktionnummer`)
    REFERENCES `mCRM_Database`.`sonderaktionen` (`Sonderaktionnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kunde_kundenklasse1`
    FOREIGN KEY (`kundenklasse_Kundenklasse`)
    REFERENCES `mCRM_Database`.`kundenklasse` (`Kundenklasse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kunde_empfehlung1`
    FOREIGN KEY (`empfehlung_idEmpfehlung`)
    REFERENCES `mCRM_Database`.`empfehlung` (`idEmpfehlung`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_kunde_sonderaktionen1_idx` ON `mCRM_Database`.`kunde` (`sonderaktionen_Sonderaktionnummer` ASC);

CREATE INDEX `fk_kunde_kundenklasse1_idx` ON `mCRM_Database`.`kunde` (`kundenklasse_Kundenklasse` ASC);

CREATE INDEX `fk_kunde_empfehlung1_idx` ON `mCRM_Database`.`kunde` (`empfehlung_idEmpfehlung` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`kauf`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`kauf` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`kauf` (
  `Menge` INT(11) NOT NULL,
  `Datum` DATE NOT NULL,
  `artikel_Artikelnummer` INT(11) NOT NULL,
  `kunde_Kundennummer` INT(11) NOT NULL,
  PRIMARY KEY (`Datum`, `kunde_Kundennummer`),
  CONSTRAINT `fk_kauf_artikel1`
    FOREIGN KEY (`artikel_Artikelnummer`)
    REFERENCES `mCRM_Database`.`artikel` (`Artikelnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kauf_kunde1`
    FOREIGN KEY (`kunde_Kundennummer`)
    REFERENCES `mCRM_Database`.`kunde` (`Kundennummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_kauf_artikel1_idx` ON `mCRM_Database`.`kauf` (`artikel_Artikelnummer` ASC);

CREATE INDEX `fk_kauf_kunde1_idx` ON `mCRM_Database`.`kauf` (`kunde_Kundennummer` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`rolle`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`rolle` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`rolle` (
  `Rollennummer` TINYINT(1) NOT NULL,
  `Rolle` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`Rollennummer`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mCRM_Database`.`verkäufer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`verkäufer` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`verkäufer` (
  `Mitarbeiternummer` INT(11) NOT NULL AUTO_INCREMENT,
  `Nutzername` VARCHAR(45) NULL DEFAULT NULL,
  `Passwort` VARCHAR(45) NULL DEFAULT NULL,
  `Vorname` VARCHAR(45) NULL DEFAULT NULL,
  `Nachname` VARCHAR(45) NULL DEFAULT NULL,
  `InStore` TINYINT(1) NULL DEFAULT NULL,
  `abteilung_Abteilungsnummer` INT(11) NULL,
  `rolle_Rollennummer` TINYINT(1) NULL,
  `Pic` VARCHAR(45) NULL,
  PRIMARY KEY (`Mitarbeiternummer`),
  CONSTRAINT `fk_verkäufer_abteilung1`
    FOREIGN KEY (`abteilung_Abteilungsnummer`)
    REFERENCES `mCRM_Database`.`abteilung` (`Abteilungsnummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_verkäufer_rolle1`
    FOREIGN KEY (`rolle_Rollennummer`)
    REFERENCES `mCRM_Database`.`rolle` (`Rollennummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_verkäufer_abteilung1_idx` ON `mCRM_Database`.`verkäufer` (`abteilung_Abteilungsnummer` ASC);

CREATE INDEX `fk_verkäufer_rolle1_idx` ON `mCRM_Database`.`verkäufer` (`rolle_Rollennummer` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`notiz`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`notiz` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`notiz` (
  `idNotiz` INT(11) NOT NULL AUTO_INCREMENT,
  `Feedback` VARCHAR(45) NULL DEFAULT NULL,
  `verkäufer_Mitarbeiternummer` INT(11) NOT NULL,
  `kunde_Kundennummer` INT(11) NOT NULL,
  PRIMARY KEY (`idNotiz`),
  CONSTRAINT `fk_notiz_verkäufer1`
    FOREIGN KEY (`verkäufer_Mitarbeiternummer`)
    REFERENCES `mCRM_Database`.`verkäufer` (`Mitarbeiternummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_notiz_kunde1`
    FOREIGN KEY (`kunde_Kundennummer`)
    REFERENCES `mCRM_Database`.`kunde` (`Kundennummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_notiz_verkäufer1_idx` ON `mCRM_Database`.`notiz` (`verkäufer_Mitarbeiternummer` ASC);

CREATE INDEX `fk_notiz_kunde1_idx` ON `mCRM_Database`.`notiz` (`kunde_Kundennummer` ASC);


-- -----------------------------------------------------
-- Table `mCRM_Database`.`verkäuferzukunde`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mCRM_Database`.`verkäuferzukunde` ;

CREATE TABLE IF NOT EXISTS `mCRM_Database`.`verkäuferzukunde` (
  `kunde_Kundennummer` INT(11) NOT NULL,
  `verkäufer_Mitarbeiternummer` INT(11) NOT NULL,
  PRIMARY KEY (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`),
  CONSTRAINT `fk_verkäuferzukunde_kunde1`
    FOREIGN KEY (`kunde_Kundennummer`)
    REFERENCES `mCRM_Database`.`kunde` (`Kundennummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_verkäuferzukunde_verkäufer1`
    FOREIGN KEY (`verkäufer_Mitarbeiternummer`)
    REFERENCES `mCRM_Database`.`verkäufer` (`Mitarbeiternummer`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE INDEX `fk_verkäuferzukunde_kunde1_idx` ON `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer` ASC);

CREATE INDEX `fk_verkäuferzukunde_verkäufer1_idx` ON `mCRM_Database`.`verkäuferzukunde` (`verkäufer_Mitarbeiternummer` ASC);


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`konzern`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`konzern` (`idKonzern`, `Name`) VALUES (1, 'Seelenheimer GmbH');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`filiale`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`filiale` (`Filialnummer`, `Ort`, `konzern_idKonzern`) VALUES (1, 'Mannheim', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`abteilung`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`abteilung` (`Abteilungsnummer`, `Abteilungsname`, `filiale_Filialnummer`) VALUES (1, '1.Stock', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`preis`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (1, 12);
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (2, 23);
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (3, 34);
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (4, 45);
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (5, 56);
INSERT INTO `mCRM_Database`.`preis` (`idPreis`, `Preis`) VALUES (6, 67);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`artikel`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (1, 'Einlegesohle Soho', 1, 1, 'pics/artikel/1.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (2, 'Gummistiefel Terra', 2, 1, 'pics/artikel/2.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (3, 'Wanderschuhe Bernini', 3, 1, 'pics/artikel/3.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (4, 'Parka Poko', 4, 1, 'pics/artikel/4.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (5, 'Windstoppschuh Peckott', 5, 1, 'pics/artikel/5.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (6, 'Skihose Premium', 6, 1, 'pics/artikel/6.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (7, 'Gummistiefel Hydro', 1, 1, 'pics/artikel/7.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (8, 'Wanderschuhe Meindel', 2, 1, 'pics/artikel/8.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (9, 'Schuhe GoreTex', 3, 1, 'pics/artikel/9.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (10, 'Windstopp Peckott', 4, 1, 'pics/artikel/10.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (11, 'Wanderhose Meindel', 5, 1, 'pics/artikel/11.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (12, 'Hand GoreTex', 6, 1, 'pics/artikel/12.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (13, 'Regenjacke Wolfskin', 1, 1, 'pics/artikel/13.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (14, 'Handschuhe Leitner', 2, 1, 'pics/artikel/14.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (15, 'Winterparker Greenland', 3, 1, 'pics/artikel/15.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (16, 'Strickmuetze Bieni', 4, 1, 'pics/artikel/16.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (17, 'Thermomuetze Heater', 5, 1, 'pics/artikel/17.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (18, 'Trailer Evo Scott', 6, 1, 'pics/artikel/18.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (19, 'Raulederschuhe Dixon', 1, 1, 'pics/artikel/19.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (20, 'Glattlederschuhe Dixon', 2, 1, 'pics/artikel/20.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (21, 'Wanderrucksack Nightsky', 3, 1, 'pics/artikel/21.jpg');
INSERT INTO `mCRM_Database`.`artikel` (`Artikelnummer`, `Bezeichner`, `preis_idPreis`, `abteilung_Abteilungsnummer`, `Pic`) VALUES (22, 'Wanderrucksack Deuter', 4, 1, 'pics/artikel/22.jpg');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`sonderaktionen`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`sonderaktionen` (`Sonderaktionnummer`, `Rabatt`) VALUES (1, 25);
INSERT INTO `mCRM_Database`.`sonderaktionen` (`Sonderaktionnummer`, `Rabatt`) VALUES (2, 10);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`kundenklasse`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`kundenklasse` (`Kundenklasse`, `Prozentualrabatt`) VALUES (1, 20);
INSERT INTO `mCRM_Database`.`kundenklasse` (`Kundenklasse`, `Prozentualrabatt`) VALUES (2, 15);
INSERT INTO `mCRM_Database`.`kundenklasse` (`Kundenklasse`, `Prozentualrabatt`) VALUES (3, 10);
INSERT INTO `mCRM_Database`.`kundenklasse` (`Kundenklasse`, `Prozentualrabatt`) VALUES (4, 5);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`empfehlung`pics/kunde/
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`empfehlung` (`idEmpfehlung`, `artikel_Artikelnummer1`, `artikel_Artikelnummer2`, `artikel_Artikelnummer3`, `artikel_Artikelnummer4`, `artikel_Artikelnummer5`, `artikel_Artikelnummer6`, `artikel_Artikelnummer7`, `artikel_Artikelnummer8`) VALUES (1, 1, 2, 3, 4, 5, 6, 7, 8);
INSERT INTO `mCRM_Database`.`empfehlung` (`idEmpfehlung`, `artikel_Artikelnummer1`, `artikel_Artikelnummer2`, `artikel_Artikelnummer3`, `artikel_Artikelnummer4`, `artikel_Artikelnummer5`, `artikel_Artikelnummer6`, `artikel_Artikelnummer7`, `artikel_Artikelnummer8`) VALUES (2, 9, 10, 11, 12, 13, 14, 15, 16);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`kunde`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (1, 'Janus', 'Hundel', 10, 1, 1, 1, 'pics/kunde/Janus.jpg', 1);
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (2, 'Rainer', 'zu Fall', 20, 1, 2, 2, 'pics/kunde/Rainer.jpg', 2);
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (3, 'Otto', 'Tattah', 30, 1, 1, 3, 'pics/kunde/Otto.jpg', 1);
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (4, 'Peter', 'Silie', 40, 1, 1, 4, 'pics/kunde/Peter.jpg', 2);
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (5, 'Izmir', 'Schlecht', 50, 1, 2, 1, 'pics/kunde/Izmir.jpg', 1);
INSERT INTO `mCRM_Database`.`kunde` (`Kundennummer`, `Vorname`, `Nachname`, `Durchschnittsumsatz`, `Kunde_inStore`, `sonderaktionen_Sonderaktionnummer`, `kundenklasse_Kundenklasse`, `Pic`, `empfehlung_idEmpfehlung`) VALUES (6, 'Dieter', 'Belle', 60, 1, 2, 2, 'pics/kunde/Dieter.jpg', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`kauf`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`kauf` (`Menge`, `Datum`, `artikel_Artikelnummer`, `kunde_Kundennummer`) VALUES (1, '12.12.2012', 1, 2);
INSERT INTO `mCRM_Database`.`kauf` (`Menge`, `Datum`, `artikel_Artikelnummer`, `kunde_Kundennummer`) VALUES (2, '12.11.2012', 2, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`rolle`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`rolle` (`Rollennummer`, `Rolle`) VALUES (1, 'Admin');
INSERT INTO `mCRM_Database`.`rolle` (`Rollennummer`, `Rolle`) VALUES (0, 'Nutzer');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`verkäufer`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('admin', '21232f297a57a5a743894a0e4a801fc3', 'Jan', 'Oberle', 1, 1, 1, 'pics/nutzer/Jan.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('jroncossek', '098F6BCD4621D373CADE4E832627B4F6', 'Johannes', 'Roncossek', 1, 1, 1, 'pics/nutzer/Johannes.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('hhundt', '098F6BCD4621D373CADE4E832627B4F6', 'Hildegard', 'Hundt', 0, 1, 0, 'pics/nutzer/Hildegard.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('aschmidt', '098F6BCD4621D373CADE4E832627B4F6', 'Anette', 'Schmidt', 0, 1, 0, 'pics/nutzer/Anette.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('kklangel', '098F6BCD4621D373CADE4E832627B4F6', 'Klaul', 'Klangel', 1, 1, 0, 'pics/nutzer/Klaul.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('lmayer', '098F6BCD4621D373CADE4E832627B4F6', 'Lena', 'Mayer', 0, 1, 0, 'pics/nutzer/Lena.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('mulbrick', '098F6BCD4621D373CADE4E832627B4F6', 'Max', 'Ulbrick', 1, 1, 0, 'pics/nutzer/Max.jpg');
INSERT INTO `mCRM_Database`.`verkäufer` (`Mitarbeiternummer`, `Nutzername`, `Passwort`, `Vorname`, `Nachname`, `InStore`, `abteilung_Abteilungsnummer`, `rolle_Rollennummer`, `Pic`) VALUES ('100', 'deltedummy', '098F6BCD4621D373CADE4E832627B4F6', 'Geloeschter', 'Benutzer', 0, 1, 0, 'pics/nutzer/dummy.jpg');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`notiz`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`notiz` (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('Redet gerne ueber Autos', 1, 1);
INSERT INTO `mCRM_Database`.`notiz` (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('Hat im April einen Sohn bekommen', 2, 2);
INSERT INTO `mCRM_Database`.`notiz` (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('Moechte nicht gesietst werden', 3, 1);
INSERT INTO `mCRM_Database`.`notiz` (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('Freut sich jedes Mal ueber einen Kaffee', 4, 2);
INSERT INTO `mCRM_Database`.`notiz` (`Feedback`, `verkäufer_Mitarbeiternummer`, `kunde_Kundennummer`) VALUES ('Zu Hause ist die Hoelle los', 5, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mCRM_Database`.`verkäuferzukunde`
-- -----------------------------------------------------
START TRANSACTION;
USE `mCRM_Database`;
INSERT INTO `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`) VALUES (1, 1);
INSERT INTO `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`) VALUES (2, 2);
INSERT INTO `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`) VALUES (3, 3);
INSERT INTO `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`) VALUES (4, 4);
INSERT INTO `mCRM_Database`.`verkäuferzukunde` (`kunde_Kundennummer`, `verkäufer_Mitarbeiternummer`) VALUES (5, 5);

COMMIT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
