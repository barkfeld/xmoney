#
# Definition for the Vw_Mov_Contas_Receber view : 
#

DROP VIEW IF EXISTS Vw_Mov_Contas_Receber;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Mov_Contas_Receber AS 
  select 
    Tb_Mov_Contas_Receber.Cod_S_Mov AS Id,
    Tb_Contas_Receber.Cod_S_Conta AS CodConta,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Clientes.Cod_S_Cli AS CodCli,
    Tb_Clientes.Nome AS Cliente,
    Tb_Contas_Receber.NumDoc AS NumDoc,
    Tb_Contas_Receber.Vencimento AS Vencimento,
    Tb_Sit_Conta.Cod_S_Sit AS CodSit,
    Tb_Sit_Conta.Descricao AS Situacao,
    Tb_Bancos.Cod_S_Banco AS CodBanco,
    Tb_Bancos.Nome AS Banco,
    Tb_Tipos_Despesa.Cod_S_Tipo AS CodDespesa,
    Tb_Tipos_Despesa.Nome AS Despesa,
    Tb_Formas_Pgto.Cod_S_Forma AS CodFormaPgto,
    Tb_Formas_Pgto.Nome AS FormaPgto,
    Tb_Mov_Contas_Receber.Juros AS Juros,
    Tb_Mov_Contas_Receber.Desconto AS Desconto,
    Tb_Mov_Contas_Receber.Total AS Total,
    Tb_Mov_Contas_Receber.Anotacoes AS Anotacoes,
    Tb_Mov_Contas_Receber.DataInc AS Pagamento,
    Tb_Mov_Contas_Receber.Inativo AS Inativo,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Usuarios.Nome AS Usuario 
  from 
   ((((((((Tb_Mov_Contas_Receber left join Tb_Contas_Receber on((Tb_Mov_Contas_Receber.Cod_S_Conta = Tb_Contas_Receber.Cod_S_Conta)))
                               left join Tb_Filiais on((Tb_Contas_Receber.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                               left join Tb_Clientes on((Tb_Contas_Receber.Cod_S_Cli = Tb_Clientes.Cod_S_Cli)))
                               left join Tb_Bancos on((Tb_Mov_Contas_Receber.Cod_S_Banco = Tb_Bancos.Cod_S_Banco)))
                               left join Tb_Tipos_Despesa on((Tb_Mov_Contas_Receber.Cod_S_Despesa = Tb_Tipos_Despesa.Cod_S_Tipo)))
                               left join Tb_Formas_Pgto on((Tb_Mov_Contas_Receber.Cod_S_Forma = Tb_Formas_Pgto.Cod_S_Forma)))
                               left join Tb_Sit_Conta on((Tb_Contas_Receber.Cod_S_Sit = Tb_Sit_Conta.Cod_S_Sit)))
                               left join Tb_Usuarios on((Tb_Mov_Contas_Receber.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));

