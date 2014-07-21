SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Clientes table : 
#

DROP TABLE IF EXISTS Tb_Clientes;

CREATE TABLE Tb_Clientes (
  Cod_S_Cli INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL,
  Nome CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  CPF CHAR(16) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Fantasia CHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  IE CHAR(20) COLLATE utf8_general_ci DEFAULT NULL,
  Suframa CHAR(12) COLLATE utf8_general_ci DEFAULT NULL,
  Fone CHAR(16) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Fone2 CHAR(16) COLLATE utf8_general_ci DEFAULT NULL,
  Fax CHAR(16) COLLATE utf8_general_ci DEFAULT NULL,
  Fax2 CHAR(16) COLLATE utf8_general_ci DEFAULT NULL,
  Email CHAR(30) COLLATE utf8_general_ci DEFAULT NULL,
  URL CHAR(30) COLLATE utf8_general_ci DEFAULT NULL,
  Anotacoes CHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  LimiteVenda FLOAT(9,3) UNSIGNED NOT NULL,
  Ativo TINYINT(1) UNSIGNED NOT NULL,
  Inativo TINYINT(1) UNSIGNED NOT NULL,
  DataAlt DATE DEFAULT '0000-00-00',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (Cod_S_Cli),
  UNIQUE KEY Cod_S_Cli (Cod_S_Cli),
  KEY Cod_S_Tipo (Cod_S_Tipo),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Cliente_Tipo FOREIGN KEY (Cod_S_Tipo) REFERENCES Tb_Tipos_Pessoa (Cod_S_Tipo),
  CONSTRAINT Tb_Cliente_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

