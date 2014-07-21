#
# Definition for the Vw_Marcas view :
#

DROP VIEW IF EXISTS Vw_Marcas;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Marcas AS
  select 
    Tb_Marcas.Cod_S_Marca AS Id,
    Tb_Marcas.Nome,
    Tb_Marcas.Atalho,
    Tb_Marcas.Ativo
  from
    Tb_Marcas;

