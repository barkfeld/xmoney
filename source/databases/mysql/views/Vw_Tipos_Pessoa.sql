#
# Definition for the Vw_Tipos_Pessoa view : 
#

DROP VIEW IF EXISTS Vw_Tipos_Pessoa;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Tipos_Pessoa AS 
  select 
    Tb_Tipos_Pessoa.Cod_S_Tipo AS Id,
    Tb_Tipos_Pessoa.Nome,
    Tb_Tipos_Pessoa.Descricao
  from 
    Tb_Tipos_Pessoa;
