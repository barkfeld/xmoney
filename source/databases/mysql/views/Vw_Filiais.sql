#
# Definition for the Vw_Filiais view : 
#

DROP VIEW IF EXISTS Vw_Filiais;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Filiais AS 
  select 
    Tb_Filiais.Cod_S_Filial AS Id,
    Tb_Filiais.Cod_S_Cli AS CodCli,
    Tb_Filiais.Cod_S_For AS CodFor,
    Tb_Filiais.Cod_S_Estado AS CodEstado,
    Tb_Filiais.Nome,
    Tb_Filiais.Razao,
    Tb_Filiais.Cnpj,
    Tb_Filiais.Endereco,
    Tb_Filiais.Bairro,
    Tb_Filiais.Cidade,
    Tb_Filiais.CEP,
    Tb_Filiais.Tel,
    Tb_Filiais.Fax,
    Tb_Filiais.Email,
    Tb_Filiais.URL,
    Tb_Filiais.Dominio,
    Tb_Filiais.DataInc,
    Tb_Filiais.DataAlt,
    Tb_Filiais.Cod_S_Usuario_Inc AS CodUsuarioInc,
    Tb_Filiais.Cod_S_Usuario_Alt AS CodUsuarioAlt 
  from 
    Tb_Filiais;
