#
# Definition for the Vw_Tipos_Despesa view :
#

DROP VIEW IF EXISTS Vw_Tipos_Despesa;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Tipos_Despesa AS 
  select 
    Tb_Tipos_Despesa.Cod_S_Tipo AS Id,
    Tb_Tipos_Despesa.Nome
  from 
    Tb_Tipos_Despesa;

