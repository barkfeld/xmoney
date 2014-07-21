#
# Definition for the Vw_Tipos_Produto view : 
#

DROP VIEW IF EXISTS Vw_Tipos_Produto;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Tipos_Produto AS 
  select 
    Tb_Tipos_Produto.Cod_S_Tipo AS Id,
    Tb_Tipos_Produto.Nome,
    Tb_Tipos_Produto.Abreviacao
  from 
    Tb_Tipos_Produto;


