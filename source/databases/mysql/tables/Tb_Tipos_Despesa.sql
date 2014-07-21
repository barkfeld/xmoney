SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Tipos_Despesa table : 
#

DROP TABLE IF EXISTS Tb_Tipos_Despesa;

CREATE TABLE Tb_Tipos_Despesa (
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Tipo),
  UNIQUE KEY Cod_S_Tipo (Cod_S_Tipo),
  UNIQUE KEY Nome (Nome),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Tipos_Despesa_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=17 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Tipos_Despesa table
#

INSERT INTO Tb_Tipos_Despesa (Cod_S_Tipo, Nome, Cod_S_Usuario_Inc) VALUES 
  (1,'Honorarios Advocaticios',1),
  (2,'Pagamento - DOC',1),
  (3,'Pagamento - TRANSFERENCIA',1),
  (4,'Pagamento - OnLine',1),
  (5,'Cheque',1),
  (6,'Dinheiro',1),
  (7,'Devolucao Total',1),
  (8,'Devolucao Parcial',1),
  (9,'Deposito em Conta',1),
  (10,'Pagamento de Aluguel',1),
  (11,'Pagamento de Contas de Consumo',1),
  (12,'Diferenca de Devolucao',1),
  (13,'Ferias',1),
  (14,'Pagamento de Impostos',1),
  (15,'Pgto de Duplicatas em Cartorio',1),
  (16,'Pagamento de Boleto',1);

COMMIT;

