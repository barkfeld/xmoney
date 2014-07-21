SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Usuarios table : 
#

DROP TABLE IF EXISTS Tb_Usuarios;

CREATE TABLE Tb_Usuarios (
  Cod_S_Usuario INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Filial INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Perfil INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_EstCivil INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Depto INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Cargo INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Estado INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Sexo INTEGER(11) UNSIGNED NOT NULL,
  Nome CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Usuario CHAR(10) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Senha CHAR(32) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Ativo TINYINT(1) NOT NULL,
  Cracha CHAR(10) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Dependentes INTEGER(11) UNSIGNED NOT NULL,
  Filhos INTEGER(11) UNSIGNED NOT NULL,
  CPF CHAR(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  RG CHAR(15) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Endereco CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Email CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Bairro CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  CEP CHAR(10) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cidade CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Cel CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Tel CHAR(20) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Nascimento DATE NOT NULL,
  Admissao DATE NOT NULL,
  Homologacao DATE DEFAULT NULL,
  Rescisao DATE DEFAULT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME NOT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Usuario),
  UNIQUE KEY Cod_S_Usuario (Cod_S_Usuario),
  UNIQUE KEY Usuario (Usuario),
  UNIQUE KEY Nome (Nome),
  UNIQUE KEY CPF (CPF),
  UNIQUE KEY RG (RG),
  KEY Cod_S_Filial (Cod_S_Filial),
  KEY Cod_S_EstCivil (Cod_S_EstCivil),
  KEY Cod_S_Depto (Cod_S_Depto),
  KEY Cod_S_Cargo (Cod_S_Cargo),
  KEY Cod_S_Estado (Cod_S_Estado),
  KEY Cod_S_Perfil (Cod_S_Perfil),
  KEY Cod_S_Sexo (Cod_S_Sexo),
  CONSTRAINT Tb_Usuarios_Filial FOREIGN KEY (Cod_S_Filial) REFERENCES Tb_Filiais (Cod_S_Filial),
  CONSTRAINT Tb_Usuarios_Cargo FOREIGN KEY (Cod_S_Cargo) REFERENCES Tb_Cargos (Cod_S_Cargo),
  CONSTRAINT Tb_Usuarios_Depto FOREIGN KEY (Cod_S_Depto) REFERENCES Tb_Deptos (Cod_S_Depto),
  CONSTRAINT Tb_Usuarios_Estado FOREIGN KEY (Cod_S_Estado) REFERENCES Tb_Estados (Cod_S_Estado),
  CONSTRAINT Tb_Usuarios_EstCivil FOREIGN KEY (Cod_S_EstCivil) REFERENCES Tb_Est_Civil (Cod_S_EstCivil),
  CONSTRAINT Tb_Usuarios_Perfil FOREIGN KEY (Cod_S_Perfil) REFERENCES Tb_Perfis (Cod_S_Perfil),
  CONSTRAINT Tb_Usuarios_Sexo FOREIGN KEY (Cod_S_Sexo) REFERENCES Tb_Sexos (Cod_S_Sexo)
)ENGINE=InnoDB
AUTO_INCREMENT=2 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Usuarios table
#

INSERT INTO Tb_Usuarios (Cod_S_Usuario, Cod_S_Filial, Cod_S_Perfil, Cod_S_EstCivil, Cod_S_Depto, Cod_S_Cargo, Cod_S_Estado, Cod_S_Sexo, Nome, Usuario, Senha, Ativo, Cracha, Dependentes, Filhos, CPF, RG, Endereco, Email, Bairro, CEP, Cidade, Cel, Tel, Nascimento, Admissao, Homologacao, Rescisao, DataInc, DataAlt, Cod_S_Usuario_Inc, Cod_S_Usuario_Alt)
VALUES (1,1,1,1,9,8,27,1,'Administrador','admin','a3175a452c7a8fea80c62a198a40f6c9',1,'0',0,0,'','','','','','','','','','0000-00-00','0000-00-00','0000-00-00','0000-00-00','0000-00-00 00:00:00','2010-06-29 08:31:02',1,1);

COMMIT;

