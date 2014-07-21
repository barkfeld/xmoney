#
# Definition for the Vw_Unid_Estoques view :
#

DROP VIEW IF EXISTS Vw_Unid_Estoques;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Unid_Estoques AS
  select 
    Tb_Unid_Estoques.Cod_S_Unidade AS Id,
    Tb_Unid_Estoques.Nome
  from
    Tb_Unid_Estoques;

