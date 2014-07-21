#
# Definition for the Vw_Perfis view : 
#

DROP VIEW IF EXISTS Vw_Perfis;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Perfis AS 
  select 
    Tb_Perfis.Cod_S_Perfil AS Id,
    Tb_Perfis.Nome,
    Tb_Perfis.Descricao
  from 
    Tb_Perfis;
