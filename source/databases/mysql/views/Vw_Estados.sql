#
# Definition for the Vw_Estados view : 
#

DROP VIEW IF EXISTS Vw_Estados;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Estados AS 
  select 
    Tb_Estados.Cod_S_Estado AS Id,
    Tb_Estados.Nome,
    Tb_Estados.Descricao
  from 
    Tb_Estados;
