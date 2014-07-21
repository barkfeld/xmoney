#
# Definition for the Vw_Sit_Produtos view :
#

DROP VIEW IF EXISTS Vw_Sit_Produtos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Sit_Produtos AS 
  select 
    Tb_Sit_Produtos.Cod_S_Sit AS Id,
    Tb_Sit_Produtos.Nome,
    Tb_Sit_Produtos.Abreviacao
  from 
    Tb_Sit_Produtos;

