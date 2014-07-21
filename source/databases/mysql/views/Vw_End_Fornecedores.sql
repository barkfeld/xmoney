#
# Definition for the Vw_End_Fornecedores view : 
#

DROP VIEW IF EXISTS Vw_End_Fornecedores;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_End_Fornecedores AS 
  select 
    Tb_End_Fornecedores.Cod_S_Endereco AS Id,
    Tb_End_Fornecedores.Endereco AS Endereco,
    Tb_End_Fornecedores.CEP AS CEP,
    Tb_End_Fornecedores.Bairro AS Bairro,
    Tb_End_Fornecedores.Cidade AS Cidade,
    Tb_Estados.Cod_S_Estado AS CodEstado,
    Tb_Estados.Nome AS Estado,
    Tb_End_Fornecedores.Contato AS Contato,
    Tb_End_Fornecedores.Fone AS Fone,
    Tb_End_Fornecedores.Referencia AS Referencia,
    Tb_Tipos_Endereco.Cod_S_Tipo AS CodTipo,
    Tb_Tipos_Endereco.Descricao AS Tipo,
    Tb_Fornecedores.Cod_S_For AS CodFor,
    Tb_Fornecedores.Nome AS Fornecedor 
  from 
    (((Tb_End_Fornecedores left join Tb_Tipos_Endereco on((Tb_End_Fornecedores.Cod_S_Tipo = Tb_Tipos_Endereco.Cod_S_Tipo)))
                           left join Tb_Fornecedores on((Tb_End_Fornecedores.Cod_S_For = Tb_Fornecedores.Cod_S_For)))
                           left join Tb_Estados on((Tb_End_Fornecedores.Cod_S_Estado = Tb_Estados.Cod_S_Estado)));
