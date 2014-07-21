#
# Definition for the Vw_Cargos view : 
#

DROP VIEW IF EXISTS Vw_Cargos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Cargos AS 
  select 
    Tb_Cargos.Cod_S_Cargo AS Id,
    Tb_Cargos.Nome
  from 
    Tb_Cargos;

