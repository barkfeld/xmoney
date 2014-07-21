#
# Definition for the Vw_Del_Contas_Receber view : 
#

DROP VIEW IF EXISTS Vw_Del_Contas_Receber;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Del_Contas_Receber AS 
  select 
    Tb_Del_Contas_Receber.Cod_S_Del AS Id,
    Tb_Contas_Receber.Cod_S_Conta AS CodConta,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Clientes.Cod_S_Cli AS CodCli,
    Tb_Clientes.Nome AS Cliente,
    Tb_Contas_Receber.NumDoc AS NumDoc,
    Tb_Contas_Receber.Parcela AS Parcela,
    Tb_Contas_Receber.ValorDoc AS ValorDoc,
    Tb_Contas_Receber.Vencimento AS Vencimento,
    Tb_Del_Contas_Receber.DataInc AS Cancelado,
    Tb_Del_Contas_Receber.Anotacoes AS Anotacoes,
    Tb_Del_Contas_Receber.Inativo AS Inativo,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Usuarios.Nome AS Usuario 
  from 
    ((((Tb_Del_Contas_Receber left join Tb_Contas_Receber on((Tb_Del_Contas_Receber.Cod_S_Conta = Tb_Contas_Receber.Cod_S_Conta)))
                            left join Tb_Filiais on((Tb_Contas_Receber.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                            left join Tb_Clientes on((Tb_Contas_Receber.Cod_S_Cli = Tb_Clientes.Cod_S_Cli)))
                            left join Tb_Usuarios on((Tb_Del_Contas_Receber.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));


