#
# Definition for the Vw_Tipos_Endereco view : 
#

DROP VIEW IF EXISTS Vw_Tipos_Endereco;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Tipos_Endereco AS 
  select 
    Tb_Tipos_Endereco.Cod_S_Tipo AS Id,
    Tb_Tipos_Endereco.Nome,
    Tb_Tipos_Endereco.Descricao
  from 
    Tb_Tipos_Endereco;
