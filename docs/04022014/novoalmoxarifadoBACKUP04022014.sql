/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50612
Source Host           : localhost:3306
Source Database       : novoalmoxarifado

Target Server Type    : MYSQL
Target Server Version : 50612
File Encoding         : 65001

Date: 2014-02-04 14:51:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `categoria`
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `nome` varchar(255) NOT NULL,
  `codigo` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES ('3003 - COMBUSTÍVEIS E LUBRIFICANTES', '3003');
INSERT INTO `categoria` VALUES ('3004 - GAS ENGARRAFADO', '3004');
INSERT INTO `categoria` VALUES ('3007 - GÊNEROS DE ALIMENTAÇÃO', '3007');
INSERT INTO `categoria` VALUES ('3015 - MATERIAL PARA FESTIVIDADES E HOMENAGENS', '3015');
INSERT INTO `categoria` VALUES ('3016 - MATERIAL DE EXPEDIENTE', '3016');
INSERT INTO `categoria` VALUES ('3017 - MATERIAL DE PROCESSAMENTO DE DADOS', '3017');
INSERT INTO `categoria` VALUES ('3019 - MATERIAL DE ACONDICIONAMENTO E EMBALAGEM', '3019');
INSERT INTO `categoria` VALUES ('3020 - MATERIAL DE CAMA E MESA', '3020');
INSERT INTO `categoria` VALUES ('3021 - MATERIAL DE COPA E COZINHA', '3021');
INSERT INTO `categoria` VALUES ('3022 - MATERIAL DE LIMPEZA E PRODUTOS DE HIGIENIZAÇÃO', '3022');
INSERT INTO `categoria` VALUES ('3024 - MATERIAL PARA MANUTENÇÃO DE BENS IMÓVEIS', '3024');
INSERT INTO `categoria` VALUES ('3025 - MATERIAL PARA MANUTENÇÃO DE BENS MÓVEIS', '3025');
INSERT INTO `categoria` VALUES ('3026 - MATERIAL ELÉTRICO', '3026');
INSERT INTO `categoria` VALUES ('3028 - MATERIAL DE PROTEÇÃO E SEGURANÇA', '3028');
INSERT INTO `categoria` VALUES ('3029 - MATERIAL PARA  ÁUDIO, VÍDEO E FOTO', '3029');
INSERT INTO `categoria` VALUES ('3036 - MATERIAL HOSPITALAR', '3036');
INSERT INTO `categoria` VALUES ('3040 - MATERIAL ELETRÔNICO', '3040');
INSERT INTO `categoria` VALUES ('3042 - FERRAMENTAS', '3042');
INSERT INTO `categoria` VALUES ('5233 - EQUIPAMENTOS PARA AUDIO, VIDEO E FOTO', '5233');
INSERT INTO `categoria` VALUES ('5235 - EQUIPAMENTOS DE PROCESSAMENTO DE DADOS', '5235');

-- ----------------------------
-- Table structure for `material`
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `idmaterial` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_ultima_entrada` date DEFAULT NULL,
  `data_ultima_saida` date DEFAULT NULL,
  `qtd_ultima_entrada` int(11) DEFAULT '0',
  `qtd_ultima_saida` int(11) DEFAULT '0',
  `qtd_atual` int(11) DEFAULT '0',
  `categoria_codigo` int(11) NOT NULL,
  `situacao_codigo` varchar(50) NOT NULL DEFAULT 'Ativo',
  PRIMARY KEY (`idmaterial`),
  KEY `fk_material_categoria1_idx` (`categoria_codigo`),
  KEY `fk_material_situacao2_idx` (`situacao_codigo`),
  CONSTRAINT `fk_material_categoria1` FOREIGN KEY (`categoria_codigo`) REFERENCES `categoria` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_material_situacao2` FOREIGN KEY (`situacao_codigo`) REFERENCES `situacao` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES ('300300000089', 'LUBRIFICANTE ANTI-FERRUGEM EM SPRAY', '2014-01-14', null, '6', '0', '16', '3003', 'Ativo');
INSERT INTO `material` VALUES ('300300000322', 'QUEROSENE 100% DESTILADO DE PETROLEO', '2013-11-14', '2014-01-03', '10', '1', '9', '3003', 'Ativo');
INSERT INTO `material` VALUES ('300700031252', 'AÃ‡UCAR REFINADO E TRITURADO  KG-- UNIDADE', '2014-01-02', '2014-01-14', '90', '37', '168', '3007', 'Ativo');
INSERT INTO `material` VALUES ('300700031909', 'CAFÉ TORRADA E MOÍDO - KG', '2014-01-02', '2014-01-14', '20', '30', '65', '3007', 'Ativo');
INSERT INTO `material` VALUES ('3016000000041', 'MARCADOR DESCARTÁVEL P/ QUADRO - PRETO', '2012-10-25', '2014-01-14', '4', '1', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('3016000000042', 'MARCADOR DESCARTÁVEL P/ QUADRO - VERMELHO', '2012-10-25', '2013-11-25', '5', '2', '9', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000005', 'APOIO/DESCANSO PARA PÉS', '2013-10-15', '2014-01-14', '3', '4', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('3016000000066', 'PASTA PARA ARQUIVO - UNIDADE', '2014-01-21', null, '12', '0', '12', '3016', 'Ativo');
INSERT INTO `material` VALUES ('3016000000121', 'CARTOLINA COLORSET -COR  VERMELHA -FOLHA', '2014-01-02', null, '100', '0', '100', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000018', 'AGENDA PERMANENTE', '2014-01-02', '2014-01-30', '6', '1', '3', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000026', 'ALMOFADA P/CARIMBO Nï¿½ 02 - AZUL', '2013-11-14', '2013-12-26', '12', '2', '8', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000038', 'MARCADOR DESCARTÁVEL P/QUADRO BRANCO - AZUL', '2012-10-25', '2013-11-29', '5', '2', '4', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000182', 'BOBINA PARA FAX', '2008-08-09', '2011-11-29', '5', '1', '4', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000190', 'BORRACHA LAPIS TINTA AZUL VERMELHA', '2014-01-02', '2014-01-21', '48', '3', '70', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000263', 'CAIXA DE PLASTICO PARA ARQUIVO-350 X 240 X 150', '2011-01-19', '2012-09-20', '50', '3', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000506', 'CLIPS NIQUELADO Nº 0 - CAIXA', '2014-01-14', '2013-12-26', '3', '4', '32', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000530', 'CLIPS NIQUELADO Nº 6/0 - CAIXA', '2011-11-29', '2013-12-26', '2', '2', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000557', 'COLA EM BASTÃO - UNIDADE', '2014-01-02', '2014-01-30', '48', '24', '101', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000611', 'COLA BRANCA P/ PAPEL 90 G. - UNIDADE', '2012-12-28', '2014-01-24', '72', '3', '56', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600000689', 'CORRETIVO LÍQUIDO - UNIDADE', '2012-12-28', '2014-01-23', '24', '1', '26', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600001006', 'TESOURA AÇO INOX', '2014-01-02', '2014-01-14', '12', '2', '16', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600001073', 'EXTRATOR DE GRAMPOS - TIPO ESPÁTULA', '2013-04-12', '2013-09-27', '24', '2', '15', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600001170', 'ESTILETE  ESTREITO COM LÂMINA DE AÇO', '2013-02-28', '2013-07-01', '1', '5', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600001405', 'FITA ADESIVA, CORPO CELULOSE VERMELHA - ROLO', '2012-01-09', '2014-01-30', '50', '2', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600001529', 'FITA P/MAQUINA DE ESCREVER IBM - REF. 6746', '2007-12-04', '2013-01-25', '2', '1', '8', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002037', 'GRAMPO PARA GRAMPEADOR-26/6', '2014-01-02', '2013-11-29', '10', '1', '26', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002045', 'GRAMPO PARA GRAMPEADOR 9/12 - 9/14 - CAIXA C/5000', '2010-12-03', '2011-04-27', '2', '1', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002223', 'LÁPIS GRAFITE Nº 2', '2012-12-28', '2013-11-22', '24', '2', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002436', 'LIVRO PARA  ATAS - 100 FOLHAS PAUTADAS UNID.', '2011-02-09', '2013-10-01', '5', '1', '4', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002452', 'LIVRO PROTOCOLO - 100 FOLHAS PAUTADAS', '2014-01-02', '2013-08-30', '3', '1', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002592', 'PAPEL CONTATO PRETO  - 10M - ROLO', '2005-04-26', '2010-12-03', '2', '1', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600002800', 'PAPEL BRANCO P/REPRODUÇÕES - OFÍCIO 2 - RESMA', '2014-01-14', '2013-08-22', '2', '2', '48', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003068', 'PASTA  AZ  TAMANHO OFICIO -DORSO LARGO. UNID.', '2013-06-21', '2014-01-14', '8', '1', '3', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003084', 'PASTA CATALOGO COM PARAFUSOS E 50 SACOS', '2013-06-21', '2014-01-30', '12', '2', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003297', 'PERCEVEJO METAL, CABEÇA REDONDA,  CX  C/100 UNID.', '2005-04-26', '2013-03-26', '39', '1', '25', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003424', 'RÉGUA PLÁSTICA - 30CM', '2013-07-10', '2013-11-29', '12', '3', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003440', 'RÉGUA PLÁSTICA - 50CM', '2012-07-03', '2013-11-27', '2', '1', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003491', 'CARTOLINA COLORSET - COR LARANJA', '2011-08-18', '2013-11-29', '40', '20', '80', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600003530', 'GRAFITE - 0,5 2B COM 12 MINAS - 60MM X 12PCS', '2013-03-13', '2014-01-14', '12', '2', '1', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004048', 'ESTILETE LARGO COM LAMINA DE AÇO-UNID.', '2012-05-24', '2013-01-03', '10', '2', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004129', 'CARTOLINA COLORSET - PRETA', '2014-01-21', '2012-09-28', '300', '10', '300', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004137', 'CARTOLINA COLORSET - COR VERDE', '2014-01-14', '2013-11-29', '10', '20', '18', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004145', 'CARTOLINA COLORSET - COR AZUL', '2011-10-17', '2014-01-14', '100', '38', '45', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004153', 'CARTOLINA COLORSET - AMARELA', '2014-01-21', '2014-01-23', '300', '100', '200', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004170', 'CARTOLINA COLORSET - COR ROSA', '2010-06-08', '2014-01-30', '50', '4', '47', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004315', 'AGENDA P/TELEFONES E ENDEREÇOS', '2014-01-21', '2014-01-30', '5', '2', '4', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004552', 'PAPEL BRANCO PARA REPRODUÇÕES - A4 - RESMA', '2013-09-16', '2014-01-29', '150', '4', '115', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004684', 'CARTOLINA COMUM - COR BRANCA', '2012-03-16', '2013-11-27', '150', '10', '26', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004846', 'PERFURADOR', '2012-07-03', '2013-08-21', '1', '1', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600004927', 'APAGADOR  PARA  QUADRO BRANCO MAGNETICO - UND', '2013-02-06', '2013-09-23', '2', '1', '1', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600005079', 'CANETA TIPO MARCADOR P/ RETROPROJETOR - AZUL', '2013-01-25', '2013-11-22', '1', '1', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600005346', 'LAPISEIRA Nº 0,5MM - COM CLIPES, PONTA  DE METAL', '2013-06-21', '2014-01-14', '12', '2', '15', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600005362', 'LAPISEIRA Nº 0,9MM - COM CLIPES E PONTA DE METAL', '2011-11-29', '2013-05-21', '2', '1', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600006512', 'PAPEL CARTA - 216 X 279MM - RESMA', '2006-03-17', '2012-08-22', '8', '1', '6', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600006997', 'LAPIS MARCA-TEXTO  -  VERDE', '2014-01-02', '2014-01-30', '48', '4', '41', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007055', 'CARTOLINA COMUM - COR AMARELA', '2012-04-30', '2013-11-27', '60', '10', '105', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007071', 'CARTOLINA COMUM - COR ROSA', '2009-05-26', '2013-11-27', '33', '10', '18', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007098', 'CARTOLINA GUACHE - VERDE LODO', '2013-01-25', '2013-11-27', '6', '15', '41', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007209', 'ENVELOPE KRAFT OURO  - 110  X  170MM - UNIDADE', '2005-04-29', '2013-10-21', '1698', '5', '929', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007225', 'ENVELOPE KRAFT OURO,1/2OFÍCIO -180 X 250MM - UNID.', '2009-07-22', '2014-01-24', '1000', '30', '641', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007233', 'ENVELOPE KRAFT OURO,1/2OFÍCIO -200 X 280MM - UNID.', '2005-04-29', '2013-12-26', '4500', '6', '1899', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007616', 'PAPEL AZUL PARA REPRODUÃ‡ÃƒO- A4- RESMA', '2014-01-02', '2014-01-30', '12', '1', '11', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007624', 'PAPEL VERDE PARA REPRODUÃ‡ÃƒO A4 - RESMA', '2014-01-02', null, '12', '0', '12', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007632', 'PAPEL AMARELO PARA REPRODUÃ‡ÃƒO - A4 -RESMA', '2014-01-02', '2014-01-30', '12', '1', '11', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007640', 'PAPEL ROSEO PARA REPRODUÃ‡ÃƒO A4 -RESMA', '2014-01-02', '2014-01-30', '12', '1', '11', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600007870', 'FITA ADESIVA, CORPO CELULOSE INCOLOR, 12MM X 30M', '2014-01-02', '2013-11-25', '24', '5', '46', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008060', 'ENVELOPE PARDO  - 170  X  110MM - UNID.', '2005-04-29', '2013-07-25', '1300', '10', '1011', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008493', 'BANDEJA EXPEDIENTE', '2013-02-21', '2013-08-30', '5', '2', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008752', 'CLIPS NIQUELADO Nº 4/0 - CAIXA', '2011-06-08', '2013-03-22', '20', '1', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008795', 'LAPIS MARCA-TEXTO  -  ROSA', '2009-05-11', '2013-01-23', '12', '2', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008930', 'GRAFITE PARA LAPISEIRA Nº 0,9 - COM 12 MINAS', '2011-10-17', '2013-11-22', '12', '1', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600008949', 'LAPIS MARCA TEXTO AMARELO LIMÃO', '2013-11-14', '2014-01-23', '24', '1', '9', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009139', 'PORTA CLIPS/LAPIS/LEMBRETE', '2013-07-10', '2013-11-26', '5', '1', '3', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009449', 'CLIPS NIQUELADO Nº 8/0 - CAIXA', '2013-01-25', '2013-07-25', '1', '1', '3', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009538', 'PASTA DE CARTOLINA COM TRILHO - VERDE', '2011-01-19', '2013-01-25', '50', '2', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009554', 'PASTA DE CARTOLINA COM ABAS E ELASTICO COR VERDE', '2013-10-15', '2013-11-25', '30', '4', '11', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009660', 'BORRACHA  PLASTICA PARA ESCRITA A LAPIS- UNID-', '2012-03-16', '2014-01-14', '5', '8', '35', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009848', 'CANETA TIPO MARCADOR P/RETROPROJETOR - PRETA', '2013-05-15', '2014-01-30', '12', '3', '5', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600009856', 'CANETA TIPO MARCADOR P/RETROPROJETOR - VERMELHA', '2013-04-12', '2014-01-30', '3', '2', '1', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600010340', 'CARTOLINA GUACHE COR  BRANCA, - UNIDADE.', '2013-04-12', '2013-11-29', '200', '10', '150', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600010757', 'ALFINETE PARA MAPA - CAIXA COM 50 UNIDADES', '2012-06-18', '2013-12-26', '10', '1', '8', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600011044', 'ENVELOPE BRANCO (AÉREO) - 114 X 229MM - UNIDADE', '2005-04-29', '2014-01-30', '3000', '10', '2367', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600011214', 'ENVELOPE BRANCO 1/2 OFÃCIO - 165x230MM - UNIDADE', '2013-07-11', '2014-01-24', '1500', '30', '1230', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600011940', 'FITA CORRIGIVEL P/ MAQUINA IBM', '2006-11-23', '2012-07-04', '1', '2', '6', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600012199', 'CLIPS COLORIDO NÂº 2 - CAIXA', '2014-01-02', '2014-01-30', '15', '2', '32', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600090362', 'PASTA DE CARTOLINA COM ABAS E ELASTICO COR AZUL', '2014-01-02', '2014-01-27', '50', '5', '79', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600090401', 'PASTA DE CARTOLINA COM TRILHO, PLATICIZADA- AZUL', '2014-01-02', '2013-11-25', '24', '4', '70', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600090520', 'PAPEL CONTATO TRANSPARENTE - 25M - ROLO', '2014-01-02', '2014-01-30', '24', '4', '39', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600090972', 'ENVELOPE BRANCO OFÍCIO - 229 X 324MM - UNID.', '2013-09-16', '2013-12-26', '500', '8', '582', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091100', 'BLOCO AUTO-ADESIVO REMOVIVEIS - BLOCO', '2013-11-14', '2014-01-30', '24', '4', '4', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091592', 'ENVELOPE PARDO 1/2 OFÍCIO  - 162  X  229MM - UNID.', '2012-05-24', '2013-11-29', '1000', '30', '860', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091643', 'GRAMPEADOR 26/6', '2012-07-25', '2013-11-29', '12', '2', '7', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091833', 'PAPEL PESO 40 TAM (210X297) RESMA COM 250 FOLHAS', '2014-01-02', '2013-11-29', '48', '4', '89', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091873', 'CRACHÁ COM CORDÃO - UNIDADE', '2014-01-02', '2014-01-29', '300', '1', '279', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600091952', 'PASTA SUSPENSA MARMORIZADA PLASTICIZADA', '2012-10-24', '2013-08-30', '50', '5', '30', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092120', 'COLA BRANCA - FRASCO DE 500G - UNIDADE', '2013-10-15', '2014-01-30', '12', '4', '6', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092163', 'PASTA DE CARTOLINA COM TRILHO AMARELA-UNIDADE', '2014-01-14', '2014-01-27', '4', '5', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092201', 'COLCHETE - Nº 15  - CAIXA.', '2011-09-13', '2012-07-04', '2', '1', '2', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092220', 'ENVELOPE KRAFT OURO  - 370  X  450MM - UNIDADE', '2012-12-28', '2013-10-22', '500', '100', '1256', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092230', 'PAPEL A4 RECICLADO - RESMA', '2014-01-14', '2014-01-30', '2', '2', '62', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092238', 'FITA ADESIVA DUPLA FACE - UNIDADE', '2014-01-14', '2014-01-27', '9', '5', '59', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092281', 'CANETA ESFEROGRÁFICA -  AZUL', '2014-01-02', '2014-01-30', '50', '4', '158', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092283', 'CANETA ESFEROGRÁFICA - VERMELHA', '2013-11-14', '2014-01-27', '100', '5', '170', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092290', 'TINTA PARA CARINBO ,COR, AZUL', '2013-02-28', '2013-11-22', '1', '1', '0', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092373', 'FITA ADESIVA MONOFACE 12 X 10 - AMARELA - ROLO', '2011-04-28', '2014-01-14', '450', '1', '354', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092376', 'BOBINA PARA IMPRESSORA TERMICA- UNIDADE', '2014-01-02', '2014-01-27', '180', '60', '290', '3016', 'Ativo');
INSERT INTO `material` VALUES ('301600092389', 'CARTOLINA COLORSET - MARROM', '2012-07-03', '2013-11-27', '20', '13', '23', '3016', 'Ativo');
INSERT INTO `material` VALUES ('3017000000131', 'PENTE DE MEMÓRIA 2GB DDR2 800MHZ', '2012-10-16', '2013-02-21', '10', '2', '8', '3017', 'Ativo');
INSERT INTO `material` VALUES ('3017000000139', 'CARTUCHO DE TINTA IMPRESSORA HP-AMARELO (CN048AL)', '2014-01-10', null, '2', '0', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('3017000000140', 'CARTUCHO DE TINTA P/IMPRESSORA HP-AZUL (CN046AL)', '2014-01-10', null, '2', '0', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('3017000000141', 'CARTUCHO DE TINTA IMPRESSORA HP-MAGENTA (CN047AL)', '2014-01-10', null, '2', '0', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('3017000000142', 'CARTUCHO DE TINTA P/IMPRESSORA HP-PRETO (CN045AL)', '2013-12-05', null, '1', '0', '1', '3017', 'Ativo');
INSERT INTO `material` VALUES ('3017000000168', 'CARTUCHO P/IMPRESSORA HP LASERFET (CF280X)', '2013-11-14', '2013-11-28', '2', '1', '5', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700000096', 'CARTUCHO P/ IMPRESSORA SAMSUNG', '2012-12-27', null, '2', '0', '4', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700000132', 'PENTE DE MEMORIA 2GB PARA NOTEBOOK DDR2 800MHZ', '2013-06-18', '2013-08-07', '1', '1', '1', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700003027', 'TECLADO BÁSICO', '2007-02-05', '2012-06-11', '3', '1', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700003663', 'ETIQUETA COLANTE FACE LISA - CAIXA', '2014-01-02', '2014-01-17', '12', '12', '7', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700004813', 'ETIQUETA ADESIVA PARA IMPRESSORA A LAZER-70 X 33mm', '2014-01-02', '2014-01-17', '12', '5', '16', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700007233', 'MINI TECLADO REDUZIDO', '2012-08-22', '2012-08-22', '2', '3', '1', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700066641', 'CARTUCHO DE TONER P/IMPRESSORA LASER - C4092A', '2009-12-29', '2013-02-27', '2', '1', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700068693', 'CARTUCHO P/IMPRESSORA LEX MARK - PRETO REF. 16', '2013-06-14', '2014-01-03', '4', '1', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700068700', 'CARTUCHO IMPRESSORA LEX MARK-COLOR-REF. 26', '2012-06-04', '2012-07-04', '1', '1', '2', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700068970', 'TECLADO P/COMPUTADOR PADRÃO ABNT2-USB', '2009-02-04', '2014-01-17', '10', '3', '6', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069300', 'CARTUCHO IMPRESSORA LASER - Q2612A - HP 3050', '2013-11-14', '2014-01-29', '3', '1', '6', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069613', 'ETIQUETA MULTI USO  P/ DORSO  A4355 - CAIXA', '2014-01-17', '2014-01-30', '5', '5', '10', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069641', 'FONTE CHAVEADA - 400 W ATX C/ CABO P4', '2009-10-22', '2011-10-07', '5', '1', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069661', 'DRIVE DE CD-RW / DVD', '2009-02-26', '2009-03-26', '10', '1', '9', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069772', 'KIT DE CAIXAS ACUSTICAS P/COMPUTADOR', '2012-11-22', '2014-01-17', '1', '1', '1', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700069851', 'CARTUCHO P/IMPRESSORA HP 930', '2012-07-03', '2013-09-26', '4', '1', '7', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070020', 'CARTUCHO IMPRESSORA HP 5440 - COLOR - C9361W', '2013-01-25', '2013-12-11', '1', '1', '1', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070116', 'MOUSE USB SCROLL 3 BOTÕES 600 DPI (PRETO/PRATA)', '2009-02-04', '2009-10-30', '10', '2', '6', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070302', 'CARTUCHO P/ IMPRESSORA XEROX PHASER 3200', '2012-12-27', '2012-11-29', '5', '1', '7', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070325', 'LEITOR DE IMPRESSÃO DIGITAL COM SDK', '2010-06-10', '2012-03-20', '8', '1', '6', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070352', 'LEITOR DE CÓDIGO DE BARRAS', '2014-01-02', '2013-09-10', '4', '1', '16', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070371', 'CARTUCHO P/IMPRESSORA HP 5440 - PRETO C9512FL', '2012-07-03', '2014-01-17', '2', '1', '3', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070401', 'ETIQUETA AUTO ADESIVA  P/ REMESSA', '2010-03-17', '2012-03-30', '12', '1', '5', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070411', 'CARTUCHO P/IMPRESSORA HP 3525 - PRETO', '2013-11-14', '2013-11-26', '4', '1', '7', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070412', 'CARTUCHO P/IMPRESSORA HP 3525 - CYAN', '2013-11-14', '2014-01-27', '3', '1', '5', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070413', 'CARTUCHO P/IMPRESSORA HP 3525 - YELLOW', '2013-11-14', '2014-01-27', '3', '1', '4', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070414', 'CARTUCHO P/IMPRESSORA HP 3525 - MAGENTA', '2013-11-14', '2013-11-26', '2', '1', '5', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070419', 'DVD+RW REGRAVÁVEL', '2010-03-23', '2014-01-17', '100', '1', '79', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070420', 'CD-RW - REGRAVÁVEL', '2013-11-14', '2013-03-27', '20', '1', '20', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070421', 'DVD - R GRAVAEL', '2012-12-27', '2013-11-25', '60', '10', '19', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070422', 'PENDRIVE - 8 GB - UNIDADE', '2012-11-22', '2012-12-27', '5', '1', '4', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070423', 'CD-R GRAVAVEL', '2013-05-15', '2013-11-22', '54', '6', '44', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301700070427', 'PENTE DE MEMORIA PC DDR2-MEMORIADDR2 512MB; -P....', '2013-06-18', '2010-05-27', '1', '2', '2', '3017', 'Ativo');
INSERT INTO `material` VALUES ('301900000011', 'FITA  ADESIVA PAPEL KRAFT - 48 X 50', '2013-02-28', '2013-11-22', '17', '1', '0', '3019', 'Ativo');
INSERT INTO `material` VALUES ('301900001036', 'FITA ADESIVA CREPE - 19 X 50M', '2012-07-03', '2013-09-20', '2', '3', '0', '3019', 'Ativo');
INSERT INTO `material` VALUES ('301900002458', 'FITA GOMADA DUPLA FACE 19MM X 30MM - UNIDADE', '2013-01-25', '2014-01-17', '2', '13', '2', '3019', 'Ativo');
INSERT INTO `material` VALUES ('301900003349', 'FITA ADESIVA CORPO CELULOSE INCOLOR 48X50', '2014-01-21', '2014-01-30', '48', '12', '44', '3019', 'Ativo');
INSERT INTO `material` VALUES ('301900012930', 'SACO PLÁSTICO LISO TRANSPARENTE - PACOTE C/ 100', '2011-11-30', '2013-10-22', '100', '2', '68', '3019', 'Ativo');
INSERT INTO `material` VALUES ('301900012986', 'CAIXA PARA CD-ROM -UNID.', '2012-05-24', '2013-07-25', '200', '5', '0', '3019', 'Ativo');
INSERT INTO `material` VALUES ('302100000419', 'FOSFORO - 10 CAIXAS', '2013-09-16', '2014-01-17', '10', '3', '9', '3021', 'Ativo');
INSERT INTO `material` VALUES ('302100000494', 'PANO DE COPA EM TECIDO 100% ALGODÃO', '2013-09-16', '2014-01-17', '10', '4', '9', '3021', 'Ativo');
INSERT INTO `material` VALUES ('302100000826', 'PANO DE BANDEJA, EM TECIDO BORDADO', '2007-02-05', '2012-03-30', '6', '5', '0', '3021', 'Ativo');
INSERT INTO `material` VALUES ('302100001806', 'COPO P/ AGUA -PACOTE COM 100', '2013-08-13', '2014-01-17', '500', '616', '607', '3021', 'Ativo');
INSERT INTO `material` VALUES ('302100001814', 'COPO P/ CAFÉ - PACOTE COM 100', '2013-08-13', '2014-01-17', '250', '178', '1060', '3021', 'Ativo');
INSERT INTO `material` VALUES ('302100003337', 'GARRAFA PARA ÁGUA , 1 LITRO - VIDRO TRANSPARENTE', '2005-11-17', '2013-02-28', '3', '3', '2', '3021', 'Ativo');
INSERT INTO `material` VALUES ('3022000000069', 'DESODORIZADOR DE AR SPLAY 360 ML', '2013-11-14', '2014-01-17', '48', '37', '35', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000348', 'FLANELA PARA LIMPEZA', '2014-01-02', '2014-01-30', '200', '4', '338', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000372', 'ESPONJA DE LÁ DE AÇO CARBONO - PACOTE', '2014-01-02', '2014-01-17', '200', '1', '229', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000410', 'LUSTRA MOVEIS - 200ML - UNIDADE', '2014-01-02', '2014-01-17', '100', '21', '198', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000585', 'SABÃO EM PEDRA NEUTRO - TABLETE', '2014-01-02', '2014-01-17', '20', '8', '44', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000623', 'SABONETE LIQUIDO NEUTRO  -  2000ML', '2014-01-02', '2014-01-17', '120', '28', '160', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200000666', 'SAPONÁCEO EM PÓ - 300G', '2013-02-28', '2013-08-02', '20', '2', '18', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001301', 'PAPEL HIGIENICO  ROLO', '2014-01-21', '2014-01-03', '1500', '1168', '3810', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001433', 'PASTILHA SANITÁRIA - 40G', '2012-12-28', '2014-01-17', '250', '46', '0', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001530', 'ÁGUA SANITÁRIA', '2013-11-14', '2014-01-17', '96', '65', '139', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001700', 'LIMPA VIDRO E ACRÍLICO COM BIO-ALCOOL', '2014-01-02', '2014-01-17', '48', '7', '170', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001824', 'INSETICIDA EM AEROSOL', '2014-01-17', '2014-01-03', '1', '3', '4', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200001913', 'SODA CAUSTICA - LATA', '2014-01-17', '2013-12-02', '3', '3', '21', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200002219', 'CERA LÍQUIDA P/ASSOALHO - INCOLOR - 5 L.t.', '2014-01-02', '2014-01-17', '10', '12', '24', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200002545', 'SACO PLASTICO PARA LIXO - 50 L', '2014-01-02', '2014-01-03', '6', '9', '12', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030390', 'ESPONJA DE LIMPEZA DUPLA FACE - UNIDADE', '2014-01-02', '2014-01-17', '100', '13', '133', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030401', 'TOALHA DE PAPEL - COR BRANCA - PCT C/2', '2013-07-10', '2014-01-30', '500', '4', '584', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030493', 'DETERGENTE NEUTRO PARA LOUÇA', '2014-01-02', '2014-01-17', '12', '2', '18', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030552', 'LIMPADOR COM BRILHO PARA PISO-FRASCO', '2014-01-02', '2014-01-17', '24', '2', '22', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030702', 'DESINFETANTE BACTERICIDA', '2014-01-02', '2014-01-03', '120', '82', '263', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030782', 'ÁLCOOL  ETÍLICO  HIDRATADO 70% UNID.', '2014-01-21', '2014-01-27', '72', '1', '71', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030980', 'SACO PLÁSTICO PARA LIXO - 100 L - CENTO', '2014-01-02', '2014-01-03', '15', '7', '51', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200030992', 'SACO PLÁSTICO PARA LIXO - 30 L - CENTO', '2014-01-02', '2014-01-03', '12', '6', '37', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200031033', 'PANO DE LIMPEZA ESPECIAL - PACOTE 5 UNIDADE', '2014-01-17', '2014-01-03', '2', '6', '26', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200031172', 'SACO DE ALGODÃO', '2013-11-14', '2014-01-03', '150', '18', '257', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200031207', 'SABÃƒO EM PÃ“ CAIXA COM 500 G', '2014-01-02', '2014-01-03', '100', '7', '124', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200031222', 'TOALHA DE PAPEL COR CREME--FARDO', '2014-01-02', '2014-01-03', '500', '54', '1841', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302200031227', 'ALCOOL ETILICO HIDRATADO EM GEL - FRASCO', '2014-01-17', '2014-01-27', '2', '1', '1', '3022', 'Ativo');
INSERT INTO `material` VALUES ('302400002026', 'TRINCHA DE 1\" COM CABO MADEIRA', '2012-10-29', '2013-01-25', '10', '7', '2', '3024', 'Ativo');
INSERT INTO `material` VALUES ('302400007214', 'TRINCHA DE 1/2\" COM CABO MADEIRA', '2012-10-29', '2014-01-17', '10', '1', '8', '3024', 'Ativo');
INSERT INTO `material` VALUES ('3028000000122', 'MASCARA PROTETORA CONTRA Pï¿½ E ODOR COM ELASTICO-', '2013-11-14', '2014-01-30', '30', '150', '602', '3028', 'Ativo');
INSERT INTO `material` VALUES ('3028000000130', 'LUVA EM LATEX NATURAL PAR', '2013-11-14', '2014-01-27', '400', '50', '280', '3003', 'Ativo');
INSERT INTO `material` VALUES ('302800000024', 'ÓCULOS DE SEGURANÇA TIPO ÁGUIA', '2012-05-28', '2013-01-25', '20', '4', '21', '3028', 'Ativo');
INSERT INTO `material` VALUES ('302800000047', 'FITA DE DETECÇÃO 3M MODELO DS-B2-N- CAIXA', '2013-07-03', '2014-01-30', '15', '1', '0', '3028', 'Ativo');
INSERT INTO `material` VALUES ('302800001709', 'LUVA DE SEGURANÇA DE RASPA DE COURO -PAR', '2012-06-20', null, '4', '0', '4', '3028', 'Ativo');
INSERT INTO `material` VALUES ('302800001710', 'LUVA DE SEGURANÇA COM PIGMENTOS EM PVC -PAR', '2012-06-20', null, '4', '0', '4', '3028', 'Ativo');
INSERT INTO `material` VALUES ('303600001890', 'LÂMINA CIRURGICA Nº 20 - UNIDADE', '2011-11-24', '2013-08-26', '500', '100', '300', '3036', 'Ativo');
INSERT INTO `material` VALUES ('303600015722', 'ALGODÃƒO HIDROFILO - ROLO', '2013-07-10', '2013-07-25', '20', '2', '18', '3036', 'Ativo');
INSERT INTO `material` VALUES ('523501481301', 'GRAVADOR DE CD ROM PADRÃO IDE, INTERNO', '2009-02-20', null, '2', '0', '2', '5235', 'Ativo');
INSERT INTO `material` VALUES ('523501482738', 'DISCO RÍGIDO SATA II 250 GB', '2012-07-05', '2011-05-20', '1', '1', '9', '5235', 'Ativo');

-- ----------------------------
-- Table structure for `menu`
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) NOT NULL,
  `link` varchar(40) NOT NULL,
  `action` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmenu`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', 'Entrar', 'index', '1');
INSERT INTO `menu` VALUES ('2', 'Quem somos', 'quemsomos', '1');
INSERT INTO `menu` VALUES ('3', 'Fale conosco', 'faleconosco', '1');
INSERT INTO `menu` VALUES ('4', 'Cliente', 'cliente', '1');
INSERT INTO `menu` VALUES ('5', 'Minha área', 'minhaarea', '1');
INSERT INTO `menu` VALUES ('6', 'Sair', 'logoff', '1');
INSERT INTO `menu` VALUES ('7', 'Editar Usuario', 'editarusuario', '0');
INSERT INTO `menu` VALUES ('8', 'Deletar Usuario', 'deletarusuario', '0');
INSERT INTO `menu` VALUES ('9', 'Visualizar Setores', 'setor', '0');
INSERT INTO `menu` VALUES ('10', 'Visualizar Usuarios', 'usuario', '0');
INSERT INTO `menu` VALUES ('11', 'Cadastrar Usuario', 'cadastrarusuario', '0');
INSERT INTO `menu` VALUES ('12', 'Editar Setor', 'editarsetor', '0');
INSERT INTO `menu` VALUES ('13', 'Cadastrar Setor', 'cadastrarsetor', '0');
INSERT INTO `menu` VALUES ('14', 'Deletar Setor', 'deletarsetor', '0');
INSERT INTO `menu` VALUES ('15', 'Requisições', 'requisicoes', '1');
INSERT INTO `menu` VALUES ('16', 'Visualizar Material', 'material', '0');
INSERT INTO `menu` VALUES ('17', 'Visualizar Requisições', 'requisicao', '0');
INSERT INTO `menu` VALUES ('18', 'Cadastrar Material', 'cadastrarmaterial', '0');
INSERT INTO `menu` VALUES ('19', 'Cadastrar Requisição', 'cadastrarrequisicao', '0');
INSERT INTO `menu` VALUES ('20', 'Deletar Material', 'deletarmaterial', '0');
INSERT INTO `menu` VALUES ('21', 'Deletar Requisição', 'deletarrequisicao', '0');
INSERT INTO `menu` VALUES ('22', 'Editar Material', 'editarmaterial', '0');
INSERT INTO `menu` VALUES ('23', 'Editar Requisição', 'editarrequisicao', '0');

-- ----------------------------
-- Table structure for `movimentacao_estoque`
-- ----------------------------
DROP TABLE IF EXISTS `movimentacao_estoque`;
CREATE TABLE `movimentacao_estoque` (
  `data_movimentacao` datetime NOT NULL,
  `quantidade_inserida` int(11) NOT NULL DEFAULT '0',
  `quantidade_retirada` int(11) NOT NULL DEFAULT '0',
  `quantidade_atual_mov` int(11) NOT NULL DEFAULT '0',
  `usuario_atendente` int(11) NOT NULL,
  `usuario_atendido` int(11) NOT NULL,
  `material_idmaterial` varchar(45) NOT NULL,
  `tipo_nome` varchar(50) NOT NULL,
  KEY `fk_gerenciamento_estoque_usuario1_idx` (`usuario_atendente`),
  KEY `fk_movimentacao_estoque_material1_idx` (`material_idmaterial`),
  KEY `fk_movimentacao_estoque_usuario1_idx` (`usuario_atendido`),
  KEY `fk_movimentacao_estoque_tipo2_idx` (`tipo_nome`),
  CONSTRAINT `fk_gerenciamento_estoque_usuario1` FOREIGN KEY (`usuario_atendente`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_material1` FOREIGN KEY (`material_idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_usuario1` FOREIGN KEY (`usuario_atendido`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_movimentacao_estoque_tipo2` FOREIGN KEY (`tipo_nome`) REFERENCES `tipo` (`nome`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of movimentacao_estoque
-- ----------------------------

-- ----------------------------
-- Table structure for `permissao`
-- ----------------------------
DROP TABLE IF EXISTS `permissao`;
CREATE TABLE `permissao` (
  `usuario_idusuario` int(11) NOT NULL,
  `menu_idmenu` int(11) NOT NULL,
  KEY `fk_permissao_usuario1_idx` (`usuario_idusuario`),
  KEY `fk_permissao_menu1_idx` (`menu_idmenu`),
  CONSTRAINT `fk_permissao_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permissao_menu1` FOREIGN KEY (`menu_idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permissao
-- ----------------------------
INSERT INTO `permissao` VALUES ('29', '4');
INSERT INTO `permissao` VALUES ('29', '5');
INSERT INTO `permissao` VALUES ('29', '6');
INSERT INTO `permissao` VALUES ('29', '7');
INSERT INTO `permissao` VALUES ('29', '9');
INSERT INTO `permissao` VALUES ('29', '10');
INSERT INTO `permissao` VALUES ('29', '12');
INSERT INTO `permissao` VALUES ('29', '13');
INSERT INTO `permissao` VALUES ('29', '15');
INSERT INTO `permissao` VALUES ('29', '16');
INSERT INTO `permissao` VALUES ('29', '17');
INSERT INTO `permissao` VALUES ('29', '18');
INSERT INTO `permissao` VALUES ('29', '19');
INSERT INTO `permissao` VALUES ('29', '21');
INSERT INTO `permissao` VALUES ('29', '22');
INSERT INTO `permissao` VALUES ('29', '23');

-- ----------------------------
-- Table structure for `requisicao`
-- ----------------------------
DROP TABLE IF EXISTS `requisicao`;
CREATE TABLE `requisicao` (
  `idrequisicao` int(11) NOT NULL AUTO_INCREMENT,
  `momento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_idusuario` int(11) NOT NULL,
  `status_status` varchar(45) NOT NULL,
  PRIMARY KEY (`idrequisicao`),
  KEY `fk_requisicao_usuario1_idx` (`usuario_idusuario`),
  KEY `fk_requisicao_status1_idx` (`status_status`),
  CONSTRAINT `fk_requisicao_usuario1` FOREIGN KEY (`usuario_idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_status1` FOREIGN KEY (`status_status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of requisicao
-- ----------------------------

-- ----------------------------
-- Table structure for `requisicao_material`
-- ----------------------------
DROP TABLE IF EXISTS `requisicao_material`;
CREATE TABLE `requisicao_material` (
  `qtdentregue` int(11) NOT NULL DEFAULT '0',
  `requisicao_idrequisicao` int(11) NOT NULL,
  `material_idmaterial` varchar(45) NOT NULL,
  `status_status` varchar(45) NOT NULL,
  KEY `fk_requisicao_material_material1_idx` (`material_idmaterial`),
  KEY `fk_requisicao_material_status1_idx` (`status_status`),
  KEY `fk_requisicao_has_material_requisicao1` (`requisicao_idrequisicao`),
  CONSTRAINT `fk_requisicao_has_material_requisicao1` FOREIGN KEY (`requisicao_idrequisicao`) REFERENCES `requisicao` (`idrequisicao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_material_material1` FOREIGN KEY (`material_idmaterial`) REFERENCES `material` (`idmaterial`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_requisicao_material_status1` FOREIGN KEY (`status_status`) REFERENCES `status` (`status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of requisicao_material
-- ----------------------------

-- ----------------------------
-- Table structure for `setor`
-- ----------------------------
DROP TABLE IF EXISTS `setor`;
CREATE TABLE `setor` (
  `codigo` varchar(45) NOT NULL,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of setor
-- ----------------------------
INSERT INTO `setor` VALUES ('ALMOXA', 'Almoxarifado');
INSERT INTO `setor` VALUES ('CPD', 'Centro de Processamento de Dados');
INSERT INTO `setor` VALUES ('CBS', 'Coordenação das Bibliotecas Setoriais');
INSERT INTO `setor` VALUES ('DAU', 'Divisão de Apoio ao Usuário');
INSERT INTO `setor` VALUES ('DST', 'Divisão de Serviços Técnicos');
INSERT INTO `setor` VALUES ('SCIRC', 'Seção de Circulação');
INSERT INTO `setor` VALUES ('SCE', 'Seção de Coleções Especiais');
INSERT INTO `setor` VALUES ('SC', 'Seção de Compras');
INSERT INTO `setor` VALUES ('SIR', 'Seção de Informação e Referência');
INSERT INTO `setor` VALUES ('SA', 'Secretaria Administrativa');
INSERT INTO `setor` VALUES ('SDI', 'Setor de Doação e Intercâmcio');
INSERT INTO `setor` VALUES ('SRD', 'Setor de Repositórios Digitais');
INSERT INTO `setor` VALUES ('SR', 'Setor de Restauração');

-- ----------------------------
-- Table structure for `situacao`
-- ----------------------------
DROP TABLE IF EXISTS `situacao`;
CREATE TABLE `situacao` (
  `codigo` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of situacao
-- ----------------------------
INSERT INTO `situacao` VALUES ('Ativo');
INSERT INTO `situacao` VALUES ('Inativo');

-- ----------------------------
-- Table structure for `status`
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `status` varchar(45) NOT NULL,
  PRIMARY KEY (`status`),
  UNIQUE KEY `status_UNIQUE` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------

-- ----------------------------
-- Table structure for `tipo`
-- ----------------------------
DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`nome`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo
-- ----------------------------
INSERT INTO `tipo` VALUES ('Aquisição');
INSERT INTO `tipo` VALUES ('Devolução');

-- ----------------------------
-- Table structure for `tipousuario`
-- ----------------------------
DROP TABLE IF EXISTS `tipousuario`;
CREATE TABLE `tipousuario` (
  `idtipousuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(60) NOT NULL,
  PRIMARY KEY (`idtipousuario`),
  UNIQUE KEY `tipo_UNIQUE` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipousuario
-- ----------------------------
INSERT INTO `tipousuario` VALUES ('1', 'Administrador');
INSERT INTO `tipousuario` VALUES ('2', 'Comum');

-- ----------------------------
-- Table structure for `usuario`
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `setor_codigo` varchar(45) NOT NULL,
  `tipousuario_idtipousuario` int(11) NOT NULL,
  `situacao_codigo` varchar(50) NOT NULL DEFAULT 'Ativo',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_usuario_setor1_idx` (`setor_codigo`),
  KEY `fk_usuario_tipousuario1_idx` (`tipousuario_idtipousuario`),
  KEY `fk_usuario_situacao2_idx` (`situacao_codigo`),
  CONSTRAINT `fk_usuario_setor1` FOREIGN KEY (`setor_codigo`) REFERENCES `setor` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_tipousuario1` FOREIGN KEY (`tipousuario_idtipousuario`) REFERENCES `tipousuario` (`idtipousuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_situacao2` FOREIGN KEY (`situacao_codigo`) REFERENCES `situacao` (`codigo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', 'Tereza', 'Tereza Cristina Medeiros de Andrade', 'df88c5ebbd81a3ed180609d9ea5cae27', 'SA', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('2', 'marcio', 'Márcio P. Mariano', '7f1a65908b05238c21c134c764c89e28', 'SA', '1', 'Ativo');
INSERT INTO `usuario` VALUES ('3', 'socorro', 'Maria do Socorro do Nascimento', '3dc29711456f1a732b010293d2700516', 'SCE', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('4', 'eliezer', 'Eliezer Pinheiro Lima', '63c17d596f401acb520efe4a2a7a01ee', 'DST', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('5', 'erica', 'Erica Simony Fernandes de Melo', 'c0f971d8cd24364f2029fcb9ac7b71f5', 'SIR', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('6', 'elisangela', 'Elisangela Alves de Moura', 'aa0aaa6d129bd12d9787ac441f571fe8', 'SC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('7', 'Ana Luiza', 'Ana Luiza Medeiros', 'a800f3e3ad747367679ff2d58f62f307', 'SCIRC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('8', 'janio', 'Janio Cesar', '2b09ee9dffa41296a243aef2cdafec9a', 'CPD', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('9', 'Margareth', 'MARGARETH RÉGIA DE LÁRA MENEZES', '8e8402a76367b3404bbac7f235d451c7', 'CBS', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('10', 'matheus', 'Matheus Lisboa', '71f6278d140af599e06ad9bf1ba03cb0', 'SC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('11', 'clediane', 'Clediane de Araújo Guedes', '253614bbac999b38b5b60cae531c4969', 'SRD', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('12', 'zairasrc', 'Zaira Atanazio Ferreira', 'f7ce3d8a8e903a3ccd84673c03f3a9fb', 'SR', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('13', 'wel', 'Wellington Rodrigues da Silva', 'c18dc61c9affb5281ac7c251662f39e1', 'CPD', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('14', 'nandotonny', 'Fernando Antonny Guerra Alves', '8b9615202dfe0e3af6542ac3483314be', 'SDI', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('15', 'guilherme', 'Guilherme Henrique Pereira de Carvalho', 'bdcc41211aa62a8f10f26d1a2d1727bf', 'SA', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('16', 'euzebia', 'Euzébia Pontes', '2ba1245d06438825e8768a6b388982a4', 'SCIRC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('17', 'scarabeidae', 'Thiago Araújo da Silva', 'd50d27d18b8bb91255161afbe85e8b95', 'SC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('18', 'marcel', 'Marcel de Freitas', '2e2aea6862287ce2cb2f1237235d7054', 'CPD', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('19', 'josianaregis', 'Josiana Florencio', 'a45958517604f5cd90d6ee51ad9cfdb6', 'DAU', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('20', 'lysandra', 'Lysandra Galvão', '17a103af914c12612d82d6be53c06648', 'SA', '1', 'Ativo');
INSERT INTO `usuario` VALUES ('21', 'ithalo', 'José Ithalo de Araújo', 'c295dbad8e8dcfe43607b06df0ac3f32', 'SCIRC', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('22', 'silvestre', 'Silvestre Gomes Martins', 'b3b4d2dbedc99fe843fd3dedb02f086f', 'ALMOXA', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('23', 'jefferson', 'Jefferson Bruno Lima de Melo', 'fa131721954c3ddae16ee67620ffb2e0', 'ALMOXA', '1', 'Ativo');
INSERT INTO `usuario` VALUES ('24', 'fernanda', 'Fernanda de Medeiros Ferreira Aquino', 'f976b57bb9dd27aa2e7e7df2825893a6', 'SIR', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('25', 'martha', 'Martha Aparecida Silva Nascimento', '9a6e4b89dfa7859f84a84a132be6ffe8', 'DAU', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('26', 'solange', 'Solange Pinon', '28b0eb6a294557fe2f4b242741083a2a', 'SCE', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('27', 'zaira', 'Zaira Atanázio ', '8208974663db80265e9bfe7b222dcb18', 'SR', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('28', 'raimundomuniz', 'Raimundo Muniz de Oliveira', '1b36ea1c9b7a1c3ad668b8bb5df7963f', 'SIR', '2', 'Ativo');
INSERT INTO `usuario` VALUES ('29', 'italo', 'italo bolsista', 'd4e6cf61d0076542a3572ba4af9e3977', 'CPD', '1', 'Ativo');
