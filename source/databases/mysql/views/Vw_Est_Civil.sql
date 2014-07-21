#
# Definition for the Vw_Est_Civil view : 
#

DROP VIEW IF EXISTS Vw_Est_Civil;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Est_Civil AS 
  select 
    Tb_Est_Civil.Cod_S_EstCivil AS Id,
    Tb_Est_Civil.Nome
  from 
    Tb_Est_Civil;
