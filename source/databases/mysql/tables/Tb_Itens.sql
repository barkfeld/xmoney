SET FOREIGN_KEY_CHECKS=0;

#
# Structure for the Tb_Itens table : 
#

DROP TABLE IF EXISTS Tb_Itens;

CREATE TABLE Tb_Itens (
  Cod_S_Item INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  Cod_S_Menu INTEGER(11) UNSIGNED NOT NULL,
  Alias CHAR(30) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  Descricao CHAR(40) COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (Cod_S_Item),
  UNIQUE KEY Cod_S_Item (Cod_S_Item),
  KEY Cod_S_Menu (Cod_S_Menu),
  CONSTRAINT Tb_Itens_Menu FOREIGN KEY (Cod_S_Menu) REFERENCES Tb_Menus (Cod_S_Menu)
)ENGINE=InnoDB
AUTO_INCREMENT=120 CHARACTER SET 'utf8' COLLATE 'utf8_general_ci';

#
# Data for the Tb_Itens table
#

INSERT INTO Tb_Itens (Cod_S_Item, Cod_S_Menu, Alias, Descricao) VALUES
  (1,7,'consultar_filiais','Consultar cadastro de filiais'),
  (2,7,'incluir_filial','Incluir filial'),
  (3,7,'alterar_filial','Alterar filial'),
  (4,7,'excluir_filial','Excluir filial'),
  (5,7,'imprimir_filiais','Imprimir lista de filiais'),

  (6,8,'consultar_usuarios','Consultar cadastro de usuários'),
  (7,8,'incluir_usuario','Incluir usuário'),
  (8,8,'alterar_usuario','Alterar usuário'),
  (9,8,'excluir_usuario','Excluir usuário'),
  (10,8,'imprimir_usuarios','Imprimir lista de usuários'),

  (11,10,'consultar_perfis','Consultar cadastro de perfis'),
  (12,10,'incluir_perfil','Incluir perfil'),
  (13,10,'alterar_perfil','Alterar perfil'),
  (14,10,'excluir_perfil','Excluir perfil'),
  (15,10,'imprimir_perfis','Imprimir lista de perfis'),

  (16,1,'consultar_clientes','Consultar cadastro de clientes'),
  (17,1,'incluir_cliente','Incluir cliente'),
  (18,1,'alterar_cliente','Alterar cliente'),
  (19,1,'excluir_cliente','Excluir cliente'),
  (20,1,'imprimir_clientes','Imprimir lista de clientes'),
  (21,1,'enderecos_cliente','Consultar endereços do cliente'),
  (22,1,'incluir_end_cliente','Incluir endereço do cliente'),
  (23,1,'excluir_end_cliente','Excluir endereço do cliente'),
  (24,1,'alterar_end_cliente','Alterar endereço do Cliente'),
  (25,1,'imprimir_end_cliente','Imprimir endereços do cliente'),

  (26,2,'consultar_fornecedores','Consultar cadastro de fornecedores'),
  (27,2,'incluir_fornecedor','Incluir fornecedor'),
  (28,2,'alterar_fornecedor','Alterar fornecedor'),
  (29,2,'excluir_fornecedor','Excluir fornecedor'),
  (30,2,'imprimir_fornecedores','Imprimir lista de fornecedores'),
  (31,2,'enderecos_fornecedor','Consultar endereços do fornecedor'),
  (32,2,'incluir_end_fornecedor','Incluir endereço do fornecedor'),
  (33,2,'alterar_end_fornecedor','Alterar endereço do fornecedor'),
  (34,2,'excluir_end_fornecedor','Excluir endereço do fornecedor'),
  (35,2,'imprimir_end_fornecedor','Imprimir endereços do fornecedor'),

  (36,9,'consultar_transportadoras','Consultar cadastro de transportadoras'),
  (37,9,'incluir_transportadora','Incluir transportadora'),
  (38,9,'alterar_transportadora','Alterar transportadora'),
  (39,9,'excluir_transportadora','Excluir transportadora'),
  (40,9,'imprimir_transportadoras','Imprimir lista de transportadoras'),
  (41,9,'enderecos_transportadora','Consultar endereços da transportadora'),
  (42,9,'incluir_end_transportadora','Incluir endereço da transportadora'),
  (43,9,'alterar_end_transportadora','Alterar endereço da transportadora'),
  (44,9,'excluir_end_transportadora','Excluir endereço da transportadora'),
  (45,9,'imprimir_end_transportadora','Imprimir endereços da transportadora'),

  (46,3,'consultar_bancos','Consultar cadastro de bancos'),
  (47,3,'incluir_banco','Incluir banco'),
  (48,3,'alterar_banco','Alterar banco'),
  (49,3,'excluir_banco','Excluir banco'),
  (50,3,'imprimir_bancos','Imprimir lista de bancos'),

  (51,5,'consultar_contas_pagar','Consultar cadastro de contas a pagar'),
  (52,5,'lancar_conta_pagar','Lançar conta a pagar'),
  (53,5,'baixar_contas_pagar','Baixar contas a pagar'),
  (54,5,'estornar_conta_pagar','Estornar contas a pagar'),
  (55,5,'cancelar_conta_pagar','Cancelar conta a pagar'),
  (56,5,'info_mov_conta_pagar','Info. de mov. de conta a pagar'),
  (57,5,'imprimir_contas_pagar','Imprimir lista de contas a pagar'),

  (58,6,'consultar_contas_receber','Consultar cadastro de contas a receber'),
  (59,6,'lancar_conta_receber','Lançar conta a receber'),
  (60,6,'baixar_contas_receber','Baixar contas a receber'),
  (61,6,'estornar_conta_receber','Estornar conta a receber'),
  (62,6,'cancelar_conta_receber','Cancelar conta a receber'),
  (63,6,'info_mov_conta_receber','Info. de mov. de conta a receber'),
  (64,6,'imprimir_contas_receber','Imprimir lista de contas a receber'),

  (65,4,'consultar_formas_pgto','Consultar cadastro de formas de pagamento'),
  (66,4,'incluir_forma_pgto','Incluir forma de pagamento'),
  (67,4,'alterar_forma_pgto','Alterar forma de pagamento'),
  (68,4,'excluir_forma_pgto','Excluir forma de pagamento'),
  (69,4,'imprimir_formas_pgto','Imprimir lista de formas de pagamento'),

  (70,11,'consultar_tipos_doc','Consultar cadastro de tipos de documento'),
  (71,11,'incluir_tipo_doc','Incluir tipo de documento'),
  (72,11,'alterar_tipo_doc','Alterar tipo de documento'),
  (73,11,'excluir_tipo_doc','Excluir tipo de documento'),
  (74,11,'imprimir_tipos_doc','Imprimir lista de tipos de documento'),

  (75,12,'consultar_tipos_despesa','Consultar cadastro de tipos de despesa'),
  (76,12,'incluir_tipo_despesa','Incluir tipo de despesa'),
  (77,12,'alterar_tipo_despesa','Alterar tipo de despesa'),
  (78,12,'excluir_tipo_despesa','Excluir tipo de despesa'),
  (79,12,'imprimir_tipos_despesa','Imprimir lista de tipos de despesa'),

  (80,13,'consultar_tipos_produto','Consultar cadastro de tipos de produto'),
  (81,13,'incluir_tipo_produto','Incluir tipo de produto'),
  (82,13,'alterar_tipo_produto','Alterar tipo de produto'),
  (83,13,'excluir_tipo_produto','Excluir tipo de produto'),
  (84,13,'imprimir_tipos_produto','Imprimir lista de tipos de produto'),

  (85,14,'consultar_sit_produtos','Consultar cadastro de situações de produto'),
  (86,14,'incluir_sit_produto','Incluir situação de produto'),
  (87,14,'alterar_sit_produto','Alterar situação de produto'),
  (88,14,'excluir_sit_produto','Excluir situação de produto'),
  (89,14,'imprimir_sit_produtos','Imprimir lista de situações de produto'),

  (90,15,'consultar_grupos','Consultar cadastro de grupos'),
  (91,15,'incluir_grupo','Incluir grupo'),
  (92,15,'alterar_grupo','Alterar grupo'),
  (93,15,'excluir_grupo','Excluir grupo'),
  (94,15,'imprimir_grupos','Imprimir lista de grupos'),

  (95,16,'consultar_marcas','Consultar cadastro de marcas'),
  (96,16,'incluir_marca','Incluir marca'),
  (97,16,'alterar_marca','Alterar marca'),
  (98,16,'excluir_marca','Excluir marca'),
  (99,16,'imprimir_marcas','Imprimir lista de marcas'),

  (100,17,'consultar_produtos','Consultar cadastro de produtos'),
  (101,17,'incluir_produto','Incluir produto'),
  (102,17,'alterar_produto','Alterar produto'),
  (103,17,'excluir_produto','Excluir produto'),
  (104,17,'imprimir_produtos','Imprimir lista de produtos'),

  (105,18,'consultar_unid_vendas','Consultar cadastro de unidades de vendas'),
  (106,18,'incluir_unid_venda','Incluir unidade de venda'),
  (107,18,'alterar_unid_venda','Alterar unidade de venda'),
  (108,18,'excluir_unid_venda','Excluir unidade de venda'),
  (109,18,'imprimir_unid_vendas','Imprimir lista de unidades de vendas'),

  (110,19,'consultar_unid_compras','Consultar cadastro de unidades de compras'),
  (111,19,'incluir_unid_compra','Incluir unidade de compra'),
  (112,19,'alterar_unid_compra','Alterar unidade de compra'),
  (113,19,'excluir_unid_compra','Excluir unidade de compra'),
  (114,19,'imprimir_unid_compras','Imprimir lista de unidades de compras'),

  (115,20,'consultar_unid_estoques','Consultar cadastro de unidades de estoques'),
  (116,20,'incluir_unid_estoque','Incluir unidade de estoque'),
  (117,20,'alterar_unid_estoque','Alterar unidade de estoque'),
  (118,20,'excluir_unid_estoque','Excluir unidade de estoque'),
  (119,20,'imprimir_unid_estoques','Imprimir lista de unidades de estoques');

COMMIT;

