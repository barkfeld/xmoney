SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Del_Contas_Receber table : 
#

DROP TABLE IF EXISTS Tb_Del_Contas_Receber;

CREATE TABLE Tb_Del_Contas_Receber (
  Cod_S_Del INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Conta INTEGER(11) UNSIGNED NOT NULL,
  Anotacoes CHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATE DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  Inativo TINYINT(1) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Del),
  UNIQUE KEY Cod_S_Del (Cod_S_Del),
  KEY Cod_S_Conta (Cod_S_Conta),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Del_Contas_Receber_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Del_Contas_Receber_Conta FOREIGN KEY (Cod_S_Conta) REFERENCES Tb_Contas_Receber (Cod_S_Conta) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

