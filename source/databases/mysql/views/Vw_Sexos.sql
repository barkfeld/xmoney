#
# Definition for the Vw_Sexos view : 
#

DROP VIEW IF EXISTS Vw_Sexos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Sexos AS 
  select 
    Tb_Sexos.Cod_S_Sexo AS Id,
    Tb_Sexos.Nome,
    Tb_Sexos.Descricao
  from 
    Tb_Sexos;
