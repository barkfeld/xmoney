SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Cargos table:
#

DROP TABLE IF EXISTS Tb_Cargos;

CREATE TABLE Tb_Cargos (
  Cod_S_Cargo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Cargo),
  UNIQUE KEY Cod_S_Cargo (Cod_S_Cargo),
  UNIQUE KEY Nome (Nome)
)ENGINE=InnoDB
AUTO_INCREMENT=11 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Cargos table
#

INSERT INTO Tb_Cargos (Cod_S_Cargo, Nome) VALUES 
  (1,'Vendedor'),
  (2,'Gerente'),
  (3,'Administrador'),
  (4,'Diretor'),
  (5,'Supervisor'),
  (6,'Estoquista'),
  (7,'Office-boy'),
  (8,'Analista'),
  (9,'Auxiliar'),
  (10,'Motorista');

COMMIT;

