SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Unid_Vendas table :
#

DROP TABLE IF EXISTS Tb_Unid_Vendas;

CREATE TABLE Tb_Unid_Vendas (
  Cod_S_Unidade INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(2) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Unidade),
  UNIQUE KEY Cod_S_Unidade (Cod_S_Unidade),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Descricao (Descricao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Unid_Venda_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=10 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Unid_Vendas table
#

INSERT INTO Tb_Unid_Vendas (Cod_S_Unidade, Nome, Descricao, Cod_S_Usuario_Inc) VALUES 
  (1,'PÇ','Peça',1),
  (2,'MT','Metro',1),
  (3,'KL','Kilo',1),
  (4,'DZ','Dúzia',1),
  (5,'CT','Cento',1),
  (6,'ML','Milheiro',1),
  (7,'RM','Resma',1),
  (8,'LT','Litro',1),
  (9,'PR','Par',1);

COMMIT;

