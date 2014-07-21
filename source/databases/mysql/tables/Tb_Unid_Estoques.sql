SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Unid_Estoques table :
#

DROP TABLE IF EXISTS Tb_Unid_Estoques;

CREATE TABLE Tb_Unid_Estoques (
  Cod_S_Unidade INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Unidade),
  UNIQUE KEY Cod_S_Unidade (Cod_S_Unidade),
  UNIQUE KEY Nome (Nome),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Unid_Estoque_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=10 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

COMMIT;

