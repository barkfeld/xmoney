SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Tipos_Doc table : 
#

DROP TABLE IF EXISTS Tb_Tipos_Doc;

CREATE TABLE Tb_Tipos_Doc (
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Abreviacao CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Tipo),
  UNIQUE KEY Cod_S_Tipo (Cod_S_Tipo),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Tipos_Doc_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=16 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Tipos_Doc table
#

INSERT INTO Tb_Tipos_Doc (Cod_S_Tipo, Nome, Abreviacao, Cod_S_Usuario_Inc) VALUES 
  (1,'Boleto','BOL',1),
  (2,'Recibo','REC',1),
  (3,'Pagamento On-Line','ONL',1),
  (4,'Nota Fiscal','NF',1),
  (5,'IPTU','IPT',1),
  (6,'GPS','GPS',1),
  (7,'GARE','GAR',1),
  (8,'Duplicata','DUP',1),
  (9,'Dinheiro','DIN',1),
  (10,'Deposito','DEP',1),
  (11,'DARF','DAR',1),
  (12,'Contas de Consumo','CCO',1),
  (13,'Cheque','CH',1),
  (14,'Cartao de Debito','CD',1),
  (15,'Cartao de Credito','CC',1);

COMMIT;

