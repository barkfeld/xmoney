SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Filiais table : 
#

DROP TABLE IF EXISTS Tb_Filiais;

CREATE TABLE Tb_Filiais (
  Cod_S_Filial INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Cli INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_For INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Estado INTEGER(11) UNSIGNED NOT NULL,
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Razao CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cnpj CHAR(18) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Endereco CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Bairro CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cidade CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  CEP CHAR(12) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Tel CHAR(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Fax CHAR(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Email CHAR(35) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  URL CHAR(32) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Dominio CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  PRIMARY KEY (Cod_S_Filial),
  UNIQUE KEY Cod_S_Filial (Cod_S_Filial),
  UNIQUE KEY Cnpj (Cnpj),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY Razao (Razao),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  KEY Cod_S_Cli (Cod_S_Cli),
  KEY Cod_S_For (Cod_S_For),
  KEY Cod_S_Estado (Cod_S_Estado),
  CONSTRAINT Tb_Filial_Estado FOREIGN KEY (Cod_S_Estado) REFERENCES Tb_Estados (Cod_S_Estado)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Filiais table
#

INSERT INTO Tb_Filiais (Cod_S_Filial, Cod_S_Cli, Cod_S_For, Cod_S_Estado, Nome, Razao, Cnpj, Endereco, Bairro, Cidade, CEP, Tel, Fax, Email, URL, Dominio, DataInc, DataAlt, Cod_S_Usuario_Inc, Cod_S_Usuario_Alt)
VALUES (1,1,1,27,'FILIAL 01','','','','','','','','','','','','2010-06-28 07:40:06','2010-06-29 08:30:39',1,1);

COMMIT;

