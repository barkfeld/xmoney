SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Marcas table :
#

DROP TABLE IF EXISTS Tb_Marcas;

CREATE TABLE Tb_Marcas (
  Cod_S_Marca INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Atalho CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Ativo TINYINT(1) UNSIGNED NOT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Marca),
  UNIQUE KEY Cod_S_Marca (Cod_S_Marca),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Atalho (Atalho),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Marcas_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

COMMIT;

