#
# Definition for the Vw_Unid_Compras view :
#

DROP VIEW IF EXISTS Vw_Unid_Compras;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Unid_Compras AS
  select 
    Tb_Unid_Compras.Cod_S_Unidade AS Id,
    Tb_Unid_Compras.Nome,
    Tb_Unid_Compras.Descricao
  from
    Tb_Unid_Compras;

