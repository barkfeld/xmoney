SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Secoes table : 
#

DROP TABLE IF EXISTS Tb_Secoes;

CREATE TABLE Tb_Secoes (
  Cod_S_Secao INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Imagem CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Secao),
  UNIQUE KEY Cod_S_Secao (Cod_S_Secao)
)ENGINE=InnoDB
AUTO_INCREMENT=5 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Secoes table
#

INSERT INTO Tb_Secoes (Cod_S_Secao, Imagem, Nome) VALUES 
  (1,'vendas.png','Vendas'),
  (2,'financeiro.png','Financeiro'),
  (3,'admin.png','Administrativo'),
  (4,'ferramenta.png','Configuração');

COMMIT;

