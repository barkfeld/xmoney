SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Contas_Receber table : 
#

DROP TABLE IF EXISTS Tb_Contas_Receber;

CREATE TABLE Tb_Contas_Receber (
  Cod_S_Conta INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Filial INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_TipoDoc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Cli INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Sit INTEGER(11) UNSIGNED NOT NULL,
  NumDoc CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Parcela INTEGER(11) UNSIGNED NOT NULL,
  Vencimento DATE NOT NULL,
  ValorDoc FLOAT(9,3) UNSIGNED NOT NULL,
  Anotacoes CHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Conta),
  UNIQUE KEY Cod_S_Conta (Cod_S_Conta),
  KEY Cod_S_Cli (Cod_S_Cli),
  KEY Cod_S_Sit (Cod_S_Sit),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  KEY Tb_Contas_Receber_Filial (Cod_S_Filial),
  KEY Tb_Contas_Receber_TipoDoc (Cod_S_TipoDoc),
  CONSTRAINT Tb_Contas_Receber_SitConta FOREIGN KEY (Cod_S_Sit) REFERENCES Tb_Sit_Conta (Cod_S_Sit),
  CONSTRAINT Tb_Contas_Receber_Filial FOREIGN KEY (Cod_S_Filial) REFERENCES Tb_Filiais (Cod_S_Filial) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Contas_Receber_Cliente FOREIGN KEY (Cod_S_Cli) REFERENCES Tb_Clientes (Cod_S_Cli) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Contas_Receber_TipoDoc FOREIGN KEY (Cod_S_TipoDoc) REFERENCES Tb_Tipos_Doc (Cod_S_Tipo)
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

