SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Sit_Conta table : 
#

DROP TABLE IF EXISTS Tb_Sit_Conta;

CREATE TABLE Tb_Sit_Conta (
  Cod_S_Sit INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Descricao CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Sit),
  UNIQUE KEY Cod_S_Sit (Cod_S_Sit),
  UNIQUE KEY Descricao (Descricao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Sit_Conta_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=4 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Sit_Conta table
#

INSERT INTO Tb_Sit_Conta (Cod_S_Sit, Descricao, Cod_S_Usuario_Inc) VALUES 
  (1,'Aberto',1),
  (2,'Pago',1),
  (3,'Cancelado',1);

COMMIT;

