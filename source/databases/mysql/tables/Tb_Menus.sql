SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Menus table : 
#

DROP TABLE IF EXISTS Tb_Menus;

CREATE TABLE Tb_Menus (
  Cod_S_Menu INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Secao INTEGER(11) UNSIGNED NOT NULL,
  Imagem CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Nome CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Classe CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Permissao CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Menu),
  UNIQUE KEY Cod_S_Menu (Cod_S_Menu),
  KEY Tb_Menus_Secao (Cod_S_Secao),
  CONSTRAINT Tb_Menus_Secao FOREIGN KEY (Cod_S_Secao) REFERENCES Tb_Secoes (Cod_S_Secao)
)ENGINE=InnoDB
AUTO_INCREMENT=21 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Menus table
#

INSERT INTO Tb_Menus (Cod_S_Menu, Cod_S_Secao, Imagem, Nome, Classe, Permissao) VALUES 
  (1,1,'clientes.png',            'Clientes',              'TCadClientes',        'consultar_clientes'),
  (2,1,'fornecedores.png',        'Fornecedores',          'TCadFornecedores',    'consultar_fornecedores'),
  (3,2,'bancos.png',              'Bancos',                'TCadBancos',          'consultar_bancos'),
  (4,3,'formas_pgto.png',         'Formas de Pagamento',   'TCadFormasPgto',      'consultar_formas_pgto'),
  (5,2,'contas_pagar.png',        'Contas a Pagar',        'TCadContasPagar',     'consultar_contas_pagar'),
  (6,2,'contas_receber.png',      'Contas a Receber',      'TCadContasReceber',   'consultar_contas_receber'),
  (7,4,'filiais.png',             'Filiais',               'TCadFiliais',         'consultar_filiais'),
  (8,4,'usuarios.png',            'Usuários',              'TCadUsuarios',        'consultar_usuarios'),
  (9,1,'transportadoras.png',     'Transportadoras',       'TCadTransportadoras', 'consultar_transportadoras'),
  (10,4,'perfis.png',             'Perfis',                'TCadPerfis',          'consultar_perfis'),
  (11,3,'tipos_doc.png',          'Tipos de Documento',    'TCadTiposDoc',        'consultar_tipos_doc'),
  (12,3,'tipos_despesa.png',      'Tipos de Despesa',      'TCadTiposDespesa',    'consultar_tipos_despesa'),
  (13,3,'tipos_produto.png',      'Tipos de Produto',      'TCadTiposProduto',    'consultar_tipos_produto'),
  (14,3,'sit_produtos.png',       'Situações de Produto',  'TCadSitProdutos',     'consultar_sit_produtos'),
  (15,3,'grupos.png',             'Grupos',                'TCadGrupos',          'consultar_grupos'),
  (16,3,'marcas.png',             'Marcas',                'TCadMarcas',          'consultar_marcas'),
  (17,3,'produtos.png',           'Produtos',              'TCadProdutos',        'consultar_produtos'),
  (18,3,'unid_vendas.png',        'Unidades de Vendas',    'TCadUnidVendas',      'consultar_unid_vendas'),
  (19,3,'unid_compras.png',       'Unidades de Compras',   'TCadUnidCompras',     'consultar_unid_compras'),
  (20,3,'unid_estoques.png',      'Unidades de Estoques',  'TCadUnidEstoques',    'consultar_unid_estoques');

COMMIT;

