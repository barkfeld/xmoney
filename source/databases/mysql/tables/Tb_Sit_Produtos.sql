SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Sit_Produtos table : 
#

DROP TABLE IF EXISTS Tb_Sit_Produtos;

CREATE TABLE Tb_Sit_Produtos (
  Cod_S_Sit INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Abreviacao CHAR(3) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Sit),
  UNIQUE KEY Cod_S_Status (Cod_S_Sit),
  UNIQUE KEY Nome (Abreviacao),
  UNIQUE KEY Abreviacao (Abreviacao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Sit_Produtos_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=7 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Sit_Produtos table
#

INSERT INTO Tb_Sit_Produtos (Cod_S_Sit, Nome, Abreviacao, Cod_S_Usuario_Inc) VALUES 
  (1,'Normal','NRM', 1),
  (2,'Promoção','PRM', 1),
  (3,'Destaque','DST', 1),
  (4,'Lançamento','LÇM', 1),
  (5,'Mais Vendido','MVD', 1),
  (6,'Mais Procurado','MPR', 1);
COMMIT;

