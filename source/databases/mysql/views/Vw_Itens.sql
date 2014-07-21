#
# Definition for the Vw_Itens view : 
#

DROP VIEW IF EXISTS Vw_Itens;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Itens AS 
  select 
    Tb_Itens.Cod_S_Item AS id,
    Tb_Itens.Descricao AS Descricao,
    Tb_Menus.Cod_S_Menu AS CodMenu,
    Tb_Menus.Nome AS Menu,
    Tb_Menus.Imagem AS Imagem,
    Tb_Secoes.Cod_S_Secao AS CodSecao,
    Tb_Secoes.Nome AS Secao 
  from 
    ((Tb_Itens join Tb_Menus on((Tb_Itens.Cod_S_Menu = Tb_Menus.Cod_S_Menu)))
               join Tb_Secoes on((Tb_Menus.Cod_S_Secao = Tb_Secoes.Cod_S_Secao)));
