SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Sexos table : 
#

DROP TABLE IF EXISTS Tb_Sexos;

CREATE TABLE Tb_Sexos (
  Cod_S_Sexo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(1) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Sexo),
  UNIQUE KEY Cod_S_Sexo (Cod_S_Sexo),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Descricao (Descricao)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Sexos table
#

INSERT INTO Tb_Sexos (Cod_S_Sexo, Nome, Descricao) VALUES 
  (0,'F','Feminino'),
  (1,'M','Masculino');

COMMIT;

