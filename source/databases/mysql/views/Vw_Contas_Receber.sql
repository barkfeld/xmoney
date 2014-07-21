#
# Definition for the Vw_Contas_Receber view : 
#

DROP VIEW IF EXISTS Vw_Contas_Receber;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Contas_Receber AS 
  select 
    Tb_Contas_Receber.Cod_S_Conta AS Id,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Tipos_Doc.Cod_S_Tipo AS CodTipoDoc,
    Tb_Tipos_Doc.Nome AS TipoDoc,
    Tb_Clientes.Cod_S_Cli AS CodCli,
    Tb_Clientes.Nome AS Cliente,
    Tb_Sit_Conta.Cod_S_Sit AS CodSit,
    Tb_Sit_Conta.Descricao AS Situacao,
    Tb_Contas_Receber.NumDoc AS NumDoc,
    Tb_Contas_Receber.Parcela AS Parcela,
    Tb_Contas_Receber.Vencimento AS Vencimento,
    Tb_Contas_Receber.ValorDoc AS ValorDoc,
    Tb_Contas_Receber.Anotacoes AS Anotacoes,
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Contas_Receber.DataInc AS Emissao,
    Tb_Usuarios.Nome AS Usuario 
  from 
    (((((Tb_Contas_Receber left join Tb_Filiais on((Tb_Contas_Receber.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                         left join Tb_Tipos_Doc on((Tb_Contas_Receber.Cod_S_TipoDoc = Tb_Tipos_Doc.Cod_S_Tipo)))
                         left join Tb_Clientes on((Tb_Contas_Receber.Cod_S_Cli = Tb_Clientes.Cod_S_Cli)))
                         left join Tb_Sit_Conta on((Tb_Contas_Receber.Cod_S_Sit = Tb_Sit_Conta.Cod_S_Sit)))
                         left join Tb_Usuarios on((Tb_Contas_Receber.Cod_S_Usuario_Inc = Tb_Usuarios.Cod_S_Usuario)));


