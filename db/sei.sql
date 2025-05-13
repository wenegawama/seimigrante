-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
-- -----------------------------------------------------
-- Schema sei
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sei
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sei` DEFAULT CHARACTER SET latin1 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`category` (
  `category_id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`category_id`));

USE `sei` ;

-- -----------------------------------------------------
-- Table `sei`.`atividade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`atividade` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `duracao` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sei`.`pais`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`pais` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(100) NOT NULL,
  `continente` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sei`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `celular` INT(11) NOT NULL,
  `genero` ENUM('Masculino', 'Feminino', 'Outro') NOT NULL,
  `pais` INT(11) NOT NULL,
  `email_login` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `perfil` INT(1) NOT NULL,
  `ativo` TINYINT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_login` (`email_login` ASC) VISIBLE,
  INDEX `pais` (`pais` ASC) VISIBLE,
  CONSTRAINT `imigrante_ibfk_1`
    FOREIGN KEY (`pais`)
    REFERENCES `sei`.`pais` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sei`.`local`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`local` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(255) NOT NULL,
  `cep` INT(8) NOT NULL,
  `numero` INT(5) NOT NULL,
  `complemento` VARCHAR(100) NOT NULL,
  `contato` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sei`.`evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`evento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `local` INT(11) NOT NULL,
  `atividade` INT(11) NOT NULL,
  `pais` INT(11) NOT NULL,
  `data` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `cep` INT(8) NULL DEFAULT NULL,
  `observacao` TEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `local` (`local` ASC) VISIBLE,
  INDEX `atividade` (`atividade` ASC) VISIBLE,
  INDEX `fk_evento_pais1_idx` (`pais` ASC) VISIBLE,
  CONSTRAINT `evento_ibfk_2`
    FOREIGN KEY (`local`)
    REFERENCES `sei`.`local` (`id`),
  CONSTRAINT `evento_ibfk_3`
    FOREIGN KEY (`atividade`)
    REFERENCES `sei`.`atividade` (`id`),
  CONSTRAINT `fk_evento_pais1`
    FOREIGN KEY (`pais`)
    REFERENCES `sei`.`pais` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `sei`.`encontro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sei`.`encontro` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `usuario` INT(11) NOT NULL,
  `evento` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `imigrante` (`usuario` ASC) VISIBLE,
  INDEX `evento` (`evento` ASC) VISIBLE,
  CONSTRAINT `encontro_ibfk_1`
    FOREIGN KEY (`usuario`)
    REFERENCES `sei`.`usuario` (`id`),
  CONSTRAINT `encontro_ibfk_2`
    FOREIGN KEY (`evento`)
    REFERENCES `sei`.`evento` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

