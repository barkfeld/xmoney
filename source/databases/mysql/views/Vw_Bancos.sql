#
# Definition for the Vw_Bancos view : 
#

DROP VIEW IF EXISTS Vw_Bancos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Bancos AS 
  select 
    Tb_Bancos.Cod_S_Banco AS Id,
    Tb_Bancos.Nome AS Nome,
    Tb_Bancos.Agencia AS Agencia,
    Tb_Bancos.Conta AS Conta,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial 
  from 
    (Tb_Bancos left join Tb_Filiais on((Tb_Bancos.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)));

