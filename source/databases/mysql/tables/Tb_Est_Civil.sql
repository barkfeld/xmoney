SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Est_Civil table : 
#

DROP TABLE IF EXISTS Tb_Est_Civil;

CREATE TABLE Tb_Est_Civil (
  Cod_S_EstCivil INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_EstCivil),
  UNIQUE KEY Cod_S_Est (Cod_S_EstCivil),
  UNIQUE KEY Nome (Nome)
)ENGINE=InnoDB
AUTO_INCREMENT=6 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Est_Civil table  (LIMIT 0,500)
#

INSERT INTO Tb_Est_Civil (Cod_S_EstCivil, Nome) VALUES 
  (1,'Solteiro (a)'),
  (2,'Casado (a)'),
  (3,'Divorciado (a)'),
  (4,'Viuvo (a)'),
  (5,'Amaziado (a)');

COMMIT;

