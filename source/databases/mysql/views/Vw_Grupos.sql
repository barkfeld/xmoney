#
# Definition for the Vw_Grupos view : 
#

DROP VIEW IF EXISTS Vw_Grupos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Grupos AS
  select 
    Tb_Grupos.Cod_S_Grupo AS Id,
    Tb_Grupos.Nome,
    Tb_Grupos.Atalho,
    Tb_Grupos.Ativo
  from
    Tb_Grupos;

