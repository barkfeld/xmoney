SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Bancos table : 
#

DROP TABLE IF EXISTS Tb_Bancos;

CREATE TABLE Tb_Bancos (
  Cod_S_Banco INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Filial INTEGER(11) UNSIGNED NOT NULL,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Agencia CHAR(10) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Conta CHAR(10) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATE DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Banco),
  UNIQUE KEY Cod_S_Banco (Cod_S_Banco),
  UNIQUE KEY Conta (Conta),
  KEY Cod_S_Filial (Cod_S_Filial),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  KEY Cod_S_Usuario_Alt (Cod_S_Usuario_Alt),
  CONSTRAINT Tb_Bancos_Filial FOREIGN KEY (Cod_S_Filial) REFERENCES Tb_Filiais (Cod_S_Filial) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Bancos_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

