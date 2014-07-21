SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Perfis table : 
#

DROP TABLE IF EXISTS Tb_Perfis;

CREATE TABLE Tb_Perfis (
  Cod_S_Perfil INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Perfil),
  UNIQUE KEY Cod_S_Perfil (Cod_S_Perfil),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Descricao (Descricao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Perfis_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=12 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Perfis table
#

INSERT INTO Tb_Perfis (Cod_S_Perfil, Nome, Descricao, DataInc, DataAlt, Cod_S_Usuario_Inc, Cod_S_Usuario_Alt)
VALUES (1,'administrador','Administrador do Sistema','0000-00-00 00:00:00',NULL,1,NULL);

COMMIT;

