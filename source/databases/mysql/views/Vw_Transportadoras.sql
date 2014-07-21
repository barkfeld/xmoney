#
# Definition for the Vw_Transportadoras view : 
#

DROP VIEW IF EXISTS Vw_Transportadoras;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Transportadoras AS 
  select 
    Tb_Transportadoras.Cod_S_Trans AS Id,
    Tb_Transportadoras.Cod_S_Tipo AS CodTipo,
    Tb_Transportadoras.Nome,
    Tb_Transportadoras.CPF,
    Tb_Transportadoras.Fantasia,
    Tb_Transportadoras.IE,
    Tb_Transportadoras.Suframa,
    Tb_Transportadoras.Fone,
    Tb_Transportadoras.Fone2,
    Tb_Transportadoras.Fax,
    Tb_Transportadoras.Fax2,
    Tb_Transportadoras.Email,
    Tb_Transportadoras.URL,
    Tb_Transportadoras.Anotacoes,
    Tb_Transportadoras.LimiteEntrega,
    Tb_Transportadoras.Ativo,
    Tb_Transportadoras.Inativo,
    Tb_Transportadoras.DataAlt,
    Tb_Transportadoras.DataInc,
    Tb_Transportadoras.Cod_S_Usuario_Inc AS CodUsuarioInc,
    Tb_Transportadoras.Cod_S_Usuario_Alt AS CodUsuarioAlt 
  from 
    Tb_Transportadoras;

