SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `novoalmoxarifado` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `novoalmoxarifado` ;

-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`tipousuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`tipousuario` (
  `idtipousuario` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(60) NOT NULL,
  UNIQUE INDEX `tipo_UNIQUE` (`tipo` ASC),
  PRIMARY KEY (`idtipousuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`situacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`situacao` (
  `codigo` VARCHAR(50) NOT NULL,
  `idsituacao` INT NOT NULL AUTO_INCREMENT,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  PRIMARY KEY (`idsituacao`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`setor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`setor` (
  `codigo` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `idsetor` INT NOT NULL AUTO_INCREMENT,
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  PRIMARY KEY (`idsetor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `tipousuario_idtipousuario` INT NOT NULL DEFAULT 2,
  `situacao_idsituacao` INT NOT NULL DEFAULT 1,
  `setor_idsetor` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  INDEX `fk_usuario_tipousuario1_idx` (`tipousuario_idtipousuario` ASC),
  INDEX `fk_usuario_situacao2_idx` (`situacao_idsituacao` ASC),
  INDEX `fk_usuario_setor1_idx` (`setor_idsetor` ASC),
  CONSTRAINT `fk_usuario_tipousuario1`
    FOREIGN KEY (`tipousuario_idtipousuario`)
    REFERENCES `novoalmoxarifado`.`tipousuario` (`idtipousuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_situacao2`
    FOREIGN KEY (`situacao_idsituacao`)
    REFERENCES `novoalmoxarifado`.`situacao` (`idsituacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_setor1`
    FOREIGN KEY (`setor_idsetor`)
    REFERENCES `novoalmoxarifado`.`setor` (`idsetor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`categoria` (
  `nome` VARCHAR(255) NOT NULL,
  `codigo` INT NOT NULL,
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`material` (
  `codigo` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `data_ultima_entrada` DATE NULL,
  `data_ultima_saida` DATE NULL,
  `qtd_ultima_entrada` INT NULL DEFAULT 0,
  `qtd_ultima_saida` INT NULL DEFAULT 0,
  `qtd_atual` INT NULL DEFAULT 0,
  `categoria_idcategoria` INT NOT NULL,
  `situacao_idsituacao` INT NOT NULL DEFAULT 1,
  `idmaterial` INT NOT NULL AUTO_INCREMENT,
  INDEX `fk_material_categoria1_idx` (`categoria_idcategoria` ASC),
  PRIMARY KEY (`idmaterial`),
  INDEX `fk_material_situacao2_idx` (`situacao_idsituacao` ASC),
  CONSTRAINT `fk_material_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `novoalmoxarifado`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_situacao2`
    FOREIGN KEY (`situacao_idsituacao`)
    REFERENCES `novoalmoxarifado`.`situacao` (`idsituacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`status` (
  `nome` VARCHAR(45) NOT NULL,
  `idstatus` INT NOT NULL AUTO_INCREMENT,
  UNIQUE INDEX `status_UNIQUE` (`nome` ASC),
  PRIMARY KEY (`idstatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`requisicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`requisicao` (
  `idrequisicao` INT NOT NULL AUTO_INCREMENT,
  `codigo` VARCHAR(45) NOT NULL,
  `momento` TIMESTAMP NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  `status_idstatus` INT NOT NULL,
  PRIMARY KEY (`idrequisicao`),
  INDEX `fk_requisicao_usuario1_idx` (`usuario_idusuario` ASC),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  INDEX `fk_requisicao_status1_idx` (`status_idstatus` ASC),
  CONSTRAINT `fk_requisicao_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_status1`
    FOREIGN KEY (`status_idstatus`)
    REFERENCES `novoalmoxarifado`.`status` (`idstatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`requisicao_material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`requisicao_material` (
  `qtdentregue` INT NOT NULL DEFAULT 0,
  `requisicao_idrequisicao` INT NOT NULL,
  `material_idmaterial` VARCHAR(45) NOT NULL,
  `status_idstatus` INT NOT NULL,
  INDEX `fk_requisicao_material_material1_idx` (`material_idmaterial` ASC),
  INDEX `fk_requisicao_material_status1_idx` (`status_idstatus` ASC),
  CONSTRAINT `fk_requisicao_has_material_requisicao1`
    FOREIGN KEY (`requisicao_idrequisicao`)
    REFERENCES `novoalmoxarifado`.`requisicao` (`idrequisicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_material_material1`
    FOREIGN KEY (`material_idmaterial`)
    REFERENCES `novoalmoxarifado`.`material` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_material_status1`
    FOREIGN KEY (`status_idstatus`)
    REFERENCES `novoalmoxarifado`.`status` (`idstatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`menu` (
  `idmenu` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(25) NOT NULL,
  `link` VARCHAR(40) NOT NULL,
  `action` INT NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmenu`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  UNIQUE INDEX `link_UNIQUE` (`link` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`permissao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`permissao` (
  `usuario_idusuario` INT NOT NULL,
  `menu_idmenu` INT NOT NULL,
  INDEX `fk_permissao_usuario1_idx` (`usuario_idusuario` ASC),
  INDEX `fk_permissao_menu1_idx` (`menu_idmenu` ASC),
  CONSTRAINT `fk_permissao_usuario1`
    FOREIGN KEY (`usuario_idusuario`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissao_menu1`
    FOREIGN KEY (`menu_idmenu`)
    REFERENCES `novoalmoxarifado`.`menu` (`idmenu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`tipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`tipo` (
  `nome` VARCHAR(50) NOT NULL,
  `idtipo` INT NOT NULL AUTO_INCREMENT,
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  PRIMARY KEY (`idtipo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`movimentacao_estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`movimentacao_estoque` (
  `data_movimentacao` DATETIME NOT NULL,
  `quantidade_inserida` INT NOT NULL DEFAULT 0,
  `quantidade_retirada` INT NOT NULL DEFAULT 0,
  `quantidade_atual_mov` INT NOT NULL DEFAULT 0,
  `usuario_atendente` INT NOT NULL,
  `usuario_atendido` INT NOT NULL,
  `tipo_idtipo` INT NOT NULL,
  `material_idmaterial` INT NOT NULL,
  INDEX `fk_gerenciamento_estoque_usuario1_idx` (`usuario_atendente` ASC),
  INDEX `fk_movimentacao_estoque_usuario1_idx` (`usuario_atendido` ASC),
  INDEX `fk_movimentacao_estoque_tipo2_idx` (`tipo_idtipo` ASC),
  INDEX `fk_movimentacao_estoque_material1_idx` (`material_idmaterial` ASC),
  CONSTRAINT `fk_gerenciamento_estoque_usuario1`
    FOREIGN KEY (`usuario_atendente`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_usuario1`
    FOREIGN KEY (`usuario_atendido`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_tipo2`
    FOREIGN KEY (`tipo_idtipo`)
    REFERENCES `novoalmoxarifado`.`tipo` (`idtipo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_material1`
    FOREIGN KEY (`material_idmaterial`)
    REFERENCES `novoalmoxarifado`.`material` (`idmaterial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `novoalmoxarifado`.`tipousuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `novoalmoxarifado`;
INSERT INTO `novoalmoxarifado`.`tipousuario` (`idtipousuario`, `tipo`) VALUES (1, 'Administrador');
INSERT INTO `novoalmoxarifado`.`tipousuario` (`idtipousuario`, `tipo`) VALUES (2, 'Comum');

COMMIT;


-- -----------------------------------------------------
-- Data for table `novoalmoxarifado`.`situacao`
-- -----------------------------------------------------
START TRANSACTION;
USE `novoalmoxarifado`;
INSERT INTO `novoalmoxarifado`.`situacao` (`codigo`, `idsituacao`) VALUES ('Ativo', 1);
INSERT INTO `novoalmoxarifado`.`situacao` (`codigo`, `idsituacao`) VALUES ('Inativo', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `novoalmoxarifado`.`tipo`
-- -----------------------------------------------------
START TRANSACTION;
USE `novoalmoxarifado`;
INSERT INTO `novoalmoxarifado`.`tipo` (`nome`, `idtipo`) VALUES ('Aquisição', NULL);
INSERT INTO `novoalmoxarifado`.`tipo` (`nome`, `idtipo`) VALUES ('Devolução', NULL);

COMMIT;

