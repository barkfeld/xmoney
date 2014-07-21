SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Tipos_Produto table : 
#

DROP TABLE IF EXISTS Tb_Tipos_Produto;

CREATE TABLE Tb_Tipos_Produto (
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Abreviacao CHAR(2) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Tipo),
  UNIQUE KEY Cod_S_Tipo (Cod_S_Tipo),
  UNIQUE KEY Abreviacao (Abreviacao),
  UNIQUE KEY Nome (Nome),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Tipos_Produto_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Tipos_Produto table
#

INSERT INTO Tb_Tipos_Produto (Cod_S_Tipo, Nome, Abreviacao, Cod_S_Usuario_Inc) VALUES 
  (1,'Revenda','RV', 1),
  (2,'Venda Casada','VC', 1),
  (3,'Materia Prima','MP', 1),
  (4,'Material de Consumo','MC', 1);

COMMIT;

