SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Formas_Pgto table : 
#

DROP TABLE IF EXISTS Tb_Formas_Pgto;

CREATE TABLE Tb_Formas_Pgto (
  Cod_S_Forma INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Tipo_Doc INTEGER(11) UNSIGNED NOT NULL,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATE DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Forma),
  UNIQUE KEY Cod_S_Forma (Cod_S_Forma),
  KEY Cod_S_Tipo_Doc (Cod_S_Tipo_Doc),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Formas_Pgto_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Formas_Pgto_Tipo_Doc FOREIGN KEY (Cod_S_Tipo_Doc) REFERENCES Tb_Tipos_Doc (Cod_S_Tipo)
)ENGINE=InnoDB
AUTO_INCREMENT=10 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Formas_Pgto table
#

INSERT INTO Tb_Formas_Pgto (Cod_S_Forma, Cod_S_Tipo_Doc, Nome, DataInc, DataAlt, Cod_S_Usuario_Inc, Cod_S_Usuario_Alt) VALUES 
  (1,1,'Boleto','0000-00-00 00:00:00',NULL,1,1),
  (2,1,'Pagamento Parcial Devolucao','0000-00-00 00:00:00',NULL,1,0),
  (3,1,'Dinheiro','0000-00-00 00:00:00',NULL,1,0),
  (4,1,'Devolucao Total','0000-00-00 00:00:00',NULL,1,0),
  (5,1,'Deposito em Conta','0000-00-00 00:00:00',NULL,1,0),
  (6,1,'Cheque','0000-00-00 00:00:00',NULL,1,0),
  (7,1,'Cartao de Debito','0000-00-00 00:00:00',NULL,1,0),
  (8,1,'Cartao de Credito','0000-00-00 00:00:00',NULL,1,0),
  (9,1,'Boleto Bancario','0000-00-00 00:00:00',NULL,1,0);

COMMIT;

