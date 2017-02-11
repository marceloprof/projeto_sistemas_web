-- MySQL Script generated by MySQL Workbench
-- 02/02/17 15:21:50
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ceadifmg
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ceadifmg
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ceadifmg` DEFAULT CHARACTER SET utf8 ;
USE `ceadifmg` ;

-- -----------------------------------------------------
-- Table `ceadifmg`.`cadastroAluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ceadifmg`.`cadastroAluno` (
  `idcadastroAluno` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `RG` VARCHAR(12) NOT NULL,
  `dataNascimento` DATE NOT NULL,
  `curso` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcadastroAluno`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;