#
# Definition for the Vw_Tipos_Doc view : 
#

DROP VIEW IF EXISTS Vw_Tipos_Doc;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Tipos_Doc AS 
  select 
    Tb_Tipos_Doc.Cod_S_Tipo AS Id,
    Tb_Tipos_Doc.Nome,
    Tb_Tipos_Doc.Abreviacao
  from 
    Tb_Tipos_Doc;


