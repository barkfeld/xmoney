SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Deptos table : 
#

DROP TABLE IF EXISTS Tb_Deptos;

CREATE TABLE Tb_Deptos (
  Cod_S_Depto INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Depto),
  UNIQUE KEY Cod_S_Dep (Cod_S_Depto),
  UNIQUE KEY Nome (Nome)
)ENGINE=InnoDB
AUTO_INCREMENT=12 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Deptos table
#

INSERT INTO Tb_Deptos (Cod_S_Depto, Nome) VALUES 
  (1,'Compras'),
  (2,'Vendas'),
  (3,'Estoque'),
  (4,'Expedicao'),
  (5,'Contas a Pagar'),
  (6,'Contas a Receber'),
  (7,'Gerencial'),
  (8,'Administrativo'),
  (9,'Tecnologia'),
  (10,'Diretoria'),
  (11,'Escritorio');

COMMIT;

