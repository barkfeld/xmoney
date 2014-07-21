#
# Definition for the Vw_Fornecedores view : 
#

DROP VIEW IF EXISTS Vw_Fornecedores;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Fornecedores AS 
  select 
    Tb_Fornecedores.Cod_S_For AS Id,
    Tb_Fornecedores.Cod_S_Tipo AS CodTipo,
    Tb_Fornecedores.Nome,
    Tb_Fornecedores.CPF,
    Tb_Fornecedores.Fantasia,
    Tb_Fornecedores.IE,
    Tb_Fornecedores.Suframa,
    Tb_Fornecedores.Fone,
    Tb_Fornecedores.Fone2,
    Tb_Fornecedores.Fax,
    Tb_Fornecedores.Fax2,
    Tb_Fornecedores.Email,
    Tb_Fornecedores.URL,
    Tb_Fornecedores.Anotacoes,
    Tb_Fornecedores.LimiteCompra,
    Tb_Fornecedores.Ativo,
    Tb_Fornecedores.Inativo,
    Tb_Fornecedores.DataAlt,
    Tb_Fornecedores.DataInc,
    Tb_Fornecedores.Cod_S_Usuario_Inc AS CodUsuarioInc,
    Tb_Fornecedores.Cod_S_Usuario_Alt AS CodUsuarioAlt 
  from 
    Tb_Fornecedores;

