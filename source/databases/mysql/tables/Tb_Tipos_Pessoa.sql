SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Tipos_Pessoa table : 
#

DROP TABLE IF EXISTS Tb_Tipos_Pessoa;

CREATE TABLE Tb_Tipos_Pessoa (
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(2) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Tipo),
  UNIQUE KEY Cod_S_Tipo (Cod_S_Tipo),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Descricao (Descricao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Tipos_Pessoa_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=3 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Tipos_Pessoa table
#

INSERT INTO Tb_Tipos_Pessoa (Cod_S_Tipo, Nome, Descricao, Cod_S_Usuario_Inc) VALUES 
  (1,'FS','Fisica', 1),
  (2,'JR','Juridica', 1);

COMMIT;

