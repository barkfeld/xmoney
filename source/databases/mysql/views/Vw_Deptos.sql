#
# Definition for the Vw_Deptos view : 
#

DROP VIEW IF EXISTS Vw_Deptos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Deptos AS 
  select 
    Tb_Deptos.Cod_S_Depto AS Id,
    Tb_Deptos.Nome
  from 
    Tb_Deptos;
