#
# Definition for the Vw_Formas_Pgto view : 
#

DROP VIEW IF EXISTS Vw_Formas_Pgto;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Formas_Pgto AS 
  select 
    Tb_Formas_Pgto.Cod_S_Forma AS Id,
    Tb_Formas_Pgto.Nome AS Nome,
    Tb_Tipos_Doc.Cod_S_Tipo AS CodTipoDoc,
    Tb_Tipos_Doc.Nome AS TipoDoc 
  from 
    (Tb_Formas_Pgto left join Tb_Tipos_Doc on((Tb_Formas_Pgto.Cod_S_Tipo_Doc = Tb_Tipos_Doc.Cod_S_Tipo)));


