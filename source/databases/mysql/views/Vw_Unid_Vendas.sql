#
# Definition for the Vw_Unid_Vendas view :
#

DROP VIEW IF EXISTS Vw_Unid_Vendas;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Unid_Vendas AS
  select 
    Tb_Unid_Vendas.Cod_S_Unidade AS Id,
    Tb_Unid_Vendas.Nome,
    Tb_Unid_Vendas.Descricao
  from
    Tb_Unid_Vendas;

