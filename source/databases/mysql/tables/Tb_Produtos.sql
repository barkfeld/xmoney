SET FOREIGN_KEY_CHECKS = 0;

#
# Structure for the Tb_Bancos table : 
#

DROP TABLE IF EXISTS Tb_Produtos;

CREATE TABLE Tb_Produtos (
  Cod_S_Produto INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Sit INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Tipo INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Grupo INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Marca INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Compra INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Venda INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Estoque INTEGER(11) UNSIGNED NOT NULL,
  Ativo TINYINT (1) UNSIGNED NOT NULL,
  Modelo CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(50) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Custo FLOAT(9,3) UNSIGNED NOT NULL,
  Margem FLOAT(9,3) UNSIGNED NOT NULL,
  Percentual FLOAT(9,3) UNSIGNED NOT NULL,
  ICMS INTEGER(11) UNSIGNED NOT NULL,
  IPI INTEGER(11) UNSIGNED NOT NULL,
  ClasFiscal INTEGER(11) UNSIGNED NOT NULL,
  QtdeMinima INTEGER(11) UNSIGNED NOT NULL,
  CotaCompra INTEGER(11) UNSIGNED NOT NULL,
  CotaVenda INTEGER(11) UNSIGNED NOT NULL,
  DataInc TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  DataAlt DATETIME DEFAULT NULL,
  Cod_S_Usuario_Inc INTEGER(11) UNSIGNED NOT NULL,
  Cod_S_Usuario_Alt INTEGER(11) DEFAULT NULL,
  UNIQUE KEY Cod_S_Produto (Cod_S_Produto),
  UNIQUE KEY Modelo (Modelo),
  UNIQUE KEY Descricao (Descricao),
  KEY Cod_S_Sit (Cod_S_Sit),
  KEY Cod_S_Tipo (Cod_S_Tipo),
  KEY Cod_S_Grupo (Cod_S_Grupo),
  KEY Cod_S_Marca (Cod_S_Marca),
  KEY Cod_S_Compra (Cod_S_Compra),
  KEY Cod_S_Venda (Cod_S_Venda),
  KEY Cod_S_Estoque (Cod_S_Estoque),
  KEY Cod_S_Usuario_Inc (Cod_S_Usuario_Inc),
  CONSTRAINT Tb_Produtos_Compra FOREIGN KEY (Cod_S_Compra) REFERENCES Tb_Unid_Compras (Cod_S_Unidade) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Estoque FOREIGN KEY (Cod_S_Estoque) REFERENCES Tb_Unid_Estoques (Cod_S_Unidade) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Grupo FOREIGN KEY (Cod_S_Grupo) REFERENCES Tb_Grupos (Cod_S_Grupo) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Marca FOREIGN KEY (Cod_S_Marca) REFERENCES Tb_Marcas (Cod_S_Marca) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Situacao FOREIGN KEY (Cod_S_Sit) REFERENCES Tb_Sit_Produtos (Cod_S_Sit) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Tipo FOREIGN KEY (Cod_S_Tipo) REFERENCES Tb_Tipos_Produto (Cod_S_Tipo) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Venda FOREIGN KEY (Cod_S_Venda) REFERENCES Tb_Unid_Vendas (Cod_S_Unidade) ON UPDATE NO ACTION,
  CONSTRAINT Tb_Produtos_Usuario_Inc FOREIGN KEY (Cod_S_Usuario_Inc) REFERENCES Tb_Usuarios (Cod_S_Usuario) ON UPDATE NO ACTION
)ENGINE=InnoDB
AUTO_INCREMENT=1 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';


