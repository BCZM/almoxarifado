SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `novoalmoxarifado` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
CREATE SCHEMA IF NOT EXISTS `almoxarifado` DEFAULT CHARACTER SET latin1 ;
USE `novoalmoxarifado` ;

-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`setor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`setor` (
  `codigo` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC),
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  PRIMARY KEY (`codigo`))
ENGINE = InnoDB;


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
-- Table `novoalmoxarifado`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `setor_codigo` VARCHAR(45) NOT NULL,
  `tipousuario_idtipousuario` INT NOT NULL,
  PRIMARY KEY (`idusuario`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  INDEX `fk_usuario_setor1_idx` (`setor_codigo` ASC),
  INDEX `fk_usuario_tipousuario1_idx` (`tipousuario_idtipousuario` ASC),
  CONSTRAINT `fk_usuario_setor1`
    FOREIGN KEY (`setor_codigo`)
    REFERENCES `novoalmoxarifado`.`setor` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipousuario1`
    FOREIGN KEY (`tipousuario_idtipousuario`)
    REFERENCES `novoalmoxarifado`.`tipousuario` (`idtipousuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `codigo` INT NOT NULL,
  UNIQUE INDEX `codigo_UNIQUE` (`codigo` ASC),
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`material`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`material` (
  `idmaterial` VARCHAR(45) NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `data_ultima_entrada` DATE NULL,
  `data_ultima_saida` DATE NULL,
  `qtd_ultima_entrada` INT NULL DEFAULT 0,
  `qtd_ultima_saida` INT NULL DEFAULT 0,
  `qtd_atual` INT NULL DEFAULT 0,
  `categoria_codigo` INT NOT NULL,
  PRIMARY KEY (`idmaterial`),
  INDEX `fk_material_categoria1_idx` (`categoria_codigo` ASC),
  CONSTRAINT `fk_material_categoria1`
    FOREIGN KEY (`categoria_codigo`)
    REFERENCES `novoalmoxarifado`.`categoria` (`codigo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`status` (
  `idstatus` INT NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idstatus`),
  UNIQUE INDEX `status_UNIQUE` (`status` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`requisicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`requisicao` (
  `idrequisicao` INT NOT NULL AUTO_INCREMENT,
  `momento` TIMESTAMP NOT NULL,
  `usuario_idusuario` INT NOT NULL,
  `status_idstatus` INT NOT NULL,
  PRIMARY KEY (`idrequisicao`),
  INDEX `fk_requisicao_usuario1_idx` (`usuario_idusuario` ASC),
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
  `status_idstatus` INT NOT NULL,
  `requisicao_idrequisicao` INT NOT NULL,
  `material_idmaterial` VARCHAR(45) NOT NULL,
  INDEX `fk_requisicao_has_material_status1_idx` (`status_idstatus` ASC),
  INDEX `fk_requisicao_material_material1_idx` (`material_idmaterial` ASC),
  CONSTRAINT `fk_requisicao_has_material_status1`
    FOREIGN KEY (`status_idstatus`)
    REFERENCES `novoalmoxarifado`.`status` (`idstatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_has_material_requisicao1`
    FOREIGN KEY (`requisicao_idrequisicao`)
    REFERENCES `novoalmoxarifado`.`requisicao` (`idrequisicao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_material_material1`
    FOREIGN KEY (`material_idmaterial`)
    REFERENCES `novoalmoxarifado`.`material` (`idmaterial`)
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
-- Table `novoalmoxarifado`.`movimentacao_estoque`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`movimentacao_estoque` (
  `data_movimentacao` DATETIME NOT NULL,
  `quantidade_inserida` INT NOT NULL DEFAULT 0,
  `quantidade_retirada` INT NOT NULL DEFAULT 0,
  `quantidade_atual_mov` INT NOT NULL DEFAULT 0,
  `usuario_atendente` INT NOT NULL,
  `usuario_atendido` INT NOT NULL,
  `material_idmaterial` VARCHAR(45) NOT NULL,
  INDEX `fk_gerenciamento_estoque_usuario1_idx` (`usuario_atendente` ASC),
  INDEX `fk_movimentacao_estoque_material1_idx` (`material_idmaterial` ASC),
  INDEX `fk_movimentacao_estoque_usuario1_idx` (`usuario_atendido` ASC),
  CONSTRAINT `fk_gerenciamento_estoque_usuario1`
    FOREIGN KEY (`usuario_atendente`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_material1`
    FOREIGN KEY (`material_idmaterial`)
    REFERENCES `novoalmoxarifado`.`material` (`idmaterial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_usuario1`
    FOREIGN KEY (`usuario_atendido`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `novoalmoxarifado`.`aquisicao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `novoalmoxarifado`.`aquisicao` (
  `data_aquicisao` DATETIME NOT NULL,
  `quantidade_inserida` INT NOT NULL DEFAULT 0,
  `quantidade_atual_mov` INT NOT NULL DEFAULT 0,
  `usuario_operador` INT NOT NULL,
  `material_idmaterial` VARCHAR(45) NOT NULL,
  INDEX `fk_gerenciamento_estoque_usuario1_idx` (`usuario_operador` ASC),
  INDEX `fk_movimentacao_estoque_material1_idx` (`material_idmaterial` ASC),
  CONSTRAINT `fk_gerenciamento_estoque_usuario10`
    FOREIGN KEY (`usuario_operador`)
    REFERENCES `novoalmoxarifado`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_material10`
    FOREIGN KEY (`material_idmaterial`)
    REFERENCES `novoalmoxarifado`.`material` (`idmaterial`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;
