SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Estados table : 
#

DROP TABLE IF EXISTS Tb_Estados;

CREATE TABLE Tb_Estados (
  Cod_S_Estado INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(2) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Estado),
  UNIQUE KEY Cod_S_Estado (Cod_S_Estado),
  UNIQUE KEY Descricao (Descricao),
  UNIQUE KEY Nome (Nome)
)ENGINE=InnoDB
AUTO_INCREMENT=29 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Estados table
#

INSERT INTO Tb_Estados (Cod_S_Estado, Nome, Descricao) VALUES 
  (1,'AC','Acre'),
  (2,'AL','Alagoas'),
  (3,'AM','Amazonas'),
  (4,'AP','Amapa'),
  (5,'BA','Bahia'),
  (6,'CE','Ceara'),
  (7,'DF','Distrito Federal'),
  (8,'ES','Espirito Santo'),
  (10,'GO','Goias'),
  (11,'MA','Maranhao'),
  (12,'MG','Minas Gerais'),
  (13,'MS','Mato Grosso do Sul'),
  (14,'MT','Mato Grosso'),
  (15,'PA','Para'),
  (16,'PB','Paraiba'),
  (17,'PE','Pernambuco'),
  (18,'PI','Piaui'),
  (19,'PR','Parana'),
  (20,'RJ','Rio de Janeiro'),
  (21,'RN','Rio Grande do Norte'),
  (22,'RO','Rondonia'),
  (23,'RR','Roraima'),
  (24,'RS','Rio Grande do Sul'),
  (25,'SC','Santa Catarina'),
  (26,'SE','Sergipe'),
  (27,'SP','Sao Paulo'),
  (28,'TO','Tocantins');

COMMIT;

