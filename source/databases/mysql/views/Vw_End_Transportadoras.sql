#
# Definition for the Vw_End_Transportadoras view : 
#

DROP VIEW IF EXISTS Vw_End_Transportadoras;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_End_Transportadoras AS 
  select 
    Tb_End_Transportadoras.Cod_S_Endereco AS Id,
    Tb_End_Transportadoras.Endereco AS Endereco,
    Tb_End_Transportadoras.CEP AS CEP,
    Tb_End_Transportadoras.Bairro AS Bairro,
    Tb_End_Transportadoras.Cidade AS Cidade,
    Tb_Estados.Cod_S_Estado AS CodEstado,
    Tb_Estados.Nome AS Estado,
    Tb_End_Transportadoras.Contato AS Contato,
    Tb_End_Transportadoras.Fone AS Fone,
    Tb_End_Transportadoras.Referencia AS Referencia,
    Tb_Tipos_Endereco.Cod_S_Tipo AS CodTipo,
    Tb_Tipos_Endereco.Descricao AS Tipo,
    Tb_Transportadoras.Cod_S_Trans AS CodTrans,
    Tb_Transportadoras.Nome AS Transportadoras 
  from 
    (((Tb_End_Transportadoras left join Tb_Tipos_Endereco on((Tb_End_Transportadoras.Cod_S_Tipo = Tb_Tipos_Endereco.Cod_S_Tipo)))
                              left join Tb_Transportadoras on((Tb_End_Transportadoras.Cod_S_Trans = Tb_Transportadoras.Cod_S_Trans)))
                              left join Tb_Estados on((Tb_End_Transportadoras.Cod_S_Estado = Tb_Estados.Cod_S_Estado)));
