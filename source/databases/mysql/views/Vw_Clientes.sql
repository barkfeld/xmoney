#
# Definition for the Vw_Clientes view : 
#

DROP VIEW IF EXISTS Vw_Clientes;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Clientes AS 
  select 
    Tb_Clientes.Cod_S_Cli AS Id,
    Tb_Clientes.Cod_S_Tipo AS CodTipo,
    Tb_Clientes.Nome,
    Tb_Clientes.CPF,
    Tb_Clientes.Fantasia,
    Tb_Clientes.IE,
    Tb_Clientes.Suframa,
    Tb_Clientes.Fone,
    Tb_Clientes.Fone2,
    Tb_Clientes.Fax,
    Tb_Clientes.Fax2,
    Tb_Clientes.Email,
    Tb_Clientes.URL,
    Tb_Clientes.Anotacoes,
    Tb_Clientes.LimiteVenda,
    Tb_Clientes.Ativo,
    Tb_Clientes.Inativo,
    Tb_Clientes.DataAlt,
    Tb_Clientes.DataInc,
    Tb_Clientes.Cod_S_Usuario_Inc AS CodUsuarioInc,
    Tb_Clientes.Cod_S_Usuario_Alt AS CodUsuarioAlt 
  from 
    Tb_Clientes;

