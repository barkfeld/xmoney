SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Mov_Contas_Pagar table : 
#

DROP TABLE IF EXISTS Tb_Mov_Contas_Pagar;

CREATE TABLE Tb_Mov_Contas_Pagar (
  Cod_S_Mov INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Conta INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Banco INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Forma INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Despesa INTEGER(11) UNSIGNED NOT NULL,
  Juros FLOAT(9,3) UNSIGNED NOT NULL,
  Desconto FLOAT(9,3) UNSIGNED NOT NULL,
  Total FLOAT(9,3) UNSIGNED NOT NULL,
  Anotacoes CHAR(50) COLLATE utf8_general_ci DEFAULT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATE DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) UNSIGNED DEFAULT NULL,
  Inativo TINYINT(1) UNSIGNED NOT NULL,
  PRIMARY KEY (Cod_S_Mov),
  UNIQUE KEY Cod_S_Mov (Cod_S_Mov),
  KEY Cod_S_Conta (Cod_S_Conta),
  KEY Cod_S_Banco (Cod_S_Banco),
  KEY Cod_S_Forma (Cod_S_Forma),
  KEY Cod_S_Despesa (Cod_S_Despesa),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Mov_Contas_Pagar_Banco FOREIGN KEY (Cod_S_Banco) REFERENCES Tb_Bancos (Cod_S_Banco) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Mov_Contas_Pagar_Conta FOREIGN KEY (Cod_S_Conta) REFERENCES Tb_Contas_Pagar (Cod_S_Conta) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Mov_Contas_Pagar_Despesa FOREIGN KEY (Cod_S_Despesa) REFERENCES Tb_Tipos_Despesa (Cod_S_Tipo),
  CONSTRAINT Tb_Mov_Contas_Pagar_Forma_Pgto FOREIGN KEY (Cod_S_Forma) REFERENCES Tb_Formas_Pgto (Cod_S_Forma),
  CONSTRAINT Tb_Mov_Contas_Pagar_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

