SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_End_Fornecedores table : 
#

DROP TABLE IF EXISTS Tb_End_Fornecedores;

CREATE TABLE Tb_End_Fornecedores (
  Cod_S_Endereco INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_For INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL,
  Endereco CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  CEP CHAR(9) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Bairro CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cidade CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cod_S_Estado INTEGER(11) UNSIGNED NOT NULL,
  Contato CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Fone CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Referencia CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATE DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (Cod_S_Endereco),
  UNIQUE KEY Cod_S_Endereco (Cod_S_Endereco),
  KEY Cod_S_For (Cod_S_For),
  KEY Cod_S_Tipo (Cod_S_Tipo),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  KEY Cod_S_Estado (Cod_S_Estado),
  CONSTRAINT Tb_End_Fornecedores_Tipo FOREIGN KEY (Cod_S_Tipo) REFERENCES Tb_Tipos_Endereco (Cod_S_Tipo) ON UPDATE NO ACTION,
  CONSTRAINT Tb_End_Fornecedores_Estado FOREIGN KEY (Cod_S_Estado) REFERENCES Tb_Estados (Cod_S_Estado),
  CONSTRAINT Tb_End_Fornecedores_Fornecedor FOREIGN KEY (Cod_S_For) REFERENCES Tb_Fornecedores (Cod_S_For) ON UPDATE NO ACTION,
  CONSTRAINT Tb_End_Fornecedores_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

