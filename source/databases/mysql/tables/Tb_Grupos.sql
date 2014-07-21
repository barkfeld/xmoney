SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Grupos table :
#

DROP TABLE IF EXISTS Tb_Grupos;

CREATE TABLE Tb_Grupos (
  Cod_S_Grupo INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Atalho CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Ativo TINYINT(1) UNSIGNED NOT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Grupo),
  UNIQUE KEY Cod_S_Grupo (Cod_S_Grupo),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Atalho (Atalho),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Grupos_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

COMMIT;

