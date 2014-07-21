#
# Definition for the Vw_Del_Contas_Pagar view : 
#

DROP VIEW IF EXISTS Vw_Del_Contas_Pagar;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Del_Contas_Pagar AS 
  select 
    Tb_Del_Contas_Pagar.Cod_S_Del AS Id,
    Tb_Contas_Pagar.Cod_S_Conta AS CodConta,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Fornecedores.Cod_S_For AS CodFor,
    Tb_Fornecedores.Nome AS Fornecedor,
    Tb_Contas_Pagar.NumDoc AS NumDoc,
    Tb_Contas_Pagar.Parcela AS Parcela,
    Tb_Contas_Pagar.ValorDoc AS ValorDoc,
    Tb_Contas_Pagar.Vencimento AS Vencimento,
    Tb_Del_Contas_Pagar.DataInc AS Cancelado,
    Tb_Del_Contas_Pagar.Anotacoes AS Anotacoes,
    Tb_Del_Contas_Pagar.Inativo AS Inativo,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Usuarios.Nome AS Usuario 
  from 
    ((((Tb_Del_Contas_Pagar left join Tb_Contas_Pagar on((Tb_Del_Contas_Pagar.Cod_S_Conta = Tb_Contas_Pagar.Cod_S_Conta)))
                            left join Tb_Filiais on((Tb_Contas_Pagar.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                            left join Tb_Fornecedores on((Tb_Contas_Pagar.Cod_S_For = Tb_Fornecedores.Cod_S_For)))
                            left join Tb_Usuarios on((Tb_Del_Contas_Pagar.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));


