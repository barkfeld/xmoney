#
# Definition for the Vw_Mov_Contas_Pagar view : 
#

DROP VIEW IF EXISTS Vw_Mov_Contas_Pagar;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Mov_Contas_Pagar AS 
  select 
    Tb_Mov_Contas_Pagar.Cod_S_Mov AS Id,
    Tb_Contas_Pagar.Cod_S_Conta AS CodConta,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Fornecedores.Cod_S_For AS CodFor,
    Tb_Fornecedores.Nome AS Fornecedor,
    Tb_Contas_Pagar.NumDoc AS NumDoc,
    Tb_Contas_Pagar.Vencimento AS Vencimento,
    Tb_Sit_Conta.Cod_S_Sit AS CodSit,
    Tb_Sit_Conta.Descricao AS Situacao,
    Tb_Bancos.Cod_S_Banco AS CodBanco,
    Tb_Bancos.Nome AS Banco,
    Tb_Tipos_Despesa.Cod_S_Tipo AS CodDespesa,
    Tb_Tipos_Despesa.Nome AS Despesa,
    Tb_Formas_Pgto.Cod_S_Forma AS CodFormaPgto,
    Tb_Formas_Pgto.Nome AS FormaPgto,
    Tb_Mov_Contas_Pagar.Juros AS Juros,
    Tb_Mov_Contas_Pagar.Desconto AS Desconto,
    Tb_Mov_Contas_Pagar.Total AS Total,
    Tb_Mov_Contas_Pagar.Anotacoes AS Anotacoes,
    Tb_Mov_Contas_Pagar.DataInc AS Pagamento,
    Tb_Mov_Contas_Pagar.Inativo AS Inativo,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Usuarios.Nome AS Usuario 
  from 
   ((((((((Tb_Mov_Contas_Pagar left join Tb_Contas_Pagar on((Tb_Mov_Contas_Pagar.Cod_S_Conta = Tb_Contas_Pagar.Cod_S_Conta)))
                               left join Tb_Filiais on((Tb_Contas_Pagar.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                               left join Tb_Fornecedores on((Tb_Contas_Pagar.Cod_S_For = Tb_Fornecedores.Cod_S_For)))
                               left join Tb_Bancos on((Tb_Mov_Contas_Pagar.Cod_S_Banco = Tb_Bancos.Cod_S_Banco)))
                               left join Tb_Tipos_Despesa on((Tb_Mov_Contas_Pagar.Cod_S_Despesa = Tb_Tipos_Despesa.Cod_S_Tipo)))
                               left join Tb_Formas_Pgto on((Tb_Mov_Contas_Pagar.Cod_S_Forma = Tb_Formas_Pgto.Cod_S_Forma)))
                               left join Tb_Sit_Conta on((Tb_Contas_Pagar.Cod_S_Sit = Tb_Sit_Conta.Cod_S_Sit)))
                               left join Tb_Usuarios on((Tb_Mov_Contas_Pagar.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));

