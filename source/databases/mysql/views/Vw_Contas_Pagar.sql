#
# Definition for the Vw_Contas_Pagar view : 
#

DROP VIEW IF EXISTS Vw_Contas_Pagar;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Contas_Pagar AS 
  select 
    Tb_Contas_Pagar.Cod_S_Conta AS Id,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Tipos_Doc.Cod_S_Tipo AS CodTipoDoc,
    Tb_Tipos_Doc.Nome AS TipoDoc,
    Tb_Fornecedores.Cod_S_For AS CodFornec,
    Tb_Fornecedores.Nome AS Fornecedor,
    Tb_Sit_Conta.Cod_S_Sit AS CodSit,
    Tb_Sit_Conta.Descricao AS Situacao,
    Tb_Contas_Pagar.NumDoc AS NumDoc,
    Tb_Contas_Pagar.Parcela AS Parcela,
    Tb_Contas_Pagar.Vencimento AS Vencimento,
    Tb_Contas_Pagar.ValorDoc AS ValorDoc,
    Tb_Contas_Pagar.Anotacoes AS Anotacoes,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Contas_Pagar.DataInc AS Emissao,
    Tb_Usuarios.Nome AS Usuario 
  from 
    (((((Tb_Contas_Pagar left join Tb_Filiais on((Tb_Contas_Pagar.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                         left join Tb_Tipos_Doc on((Tb_Contas_Pagar.Cod_S_TipoDoc = Tb_Tipos_Doc.Cod_S_Tipo)))
                         left join Tb_Fornecedores on((Tb_Contas_Pagar.Cod_S_For = Tb_Fornecedores.Cod_S_For)))
                         left join Tb_Sit_Conta on((Tb_Contas_Pagar.Cod_S_Sit = Tb_Sit_Conta.Cod_S_Sit)))
                         left join Tb_Usuarios on((Tb_Contas_Pagar.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));


