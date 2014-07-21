#
# Definition for the Vw_End_Clientes view : 
#

DROP VIEW IF EXISTS Vw_End_Clientes;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_End_Clientes AS 
  select 
    Tb_End_Clientes.Cod_S_Endereco AS Id,
    Tb_End_Clientes.Endereco AS Endereco,
    Tb_End_Clientes.CEP AS CEP,
    Tb_End_Clientes.Bairro AS Bairro,
    Tb_End_Clientes.Cidade AS Cidade,
    Tb_Estados.Cod_S_Estado AS CodEstado,
    Tb_Estados.Nome AS Estado,
    Tb_End_Clientes.Contato AS Contato,
    Tb_End_Clientes.Fone AS Fone,
    Tb_End_Clientes.Referencia AS Referencia,
    Tb_Tipos_Endereco.Cod_S_Tipo AS CodTipo,
    Tb_Tipos_Endereco.Descricao AS Tipo,
    Tb_Clientes.Cod_S_Cli AS CodCliente,
    Tb_Clientes.Nome AS Cliente 
  from 
    (((Tb_End_Clientes left join Tb_Tipos_Endereco on((Tb_End_Clientes.Cod_S_Tipo = Tb_Tipos_Endereco.Cod_S_Tipo)))
                       left join Tb_Clientes on((Tb_End_Clientes.Cod_S_Cli = Tb_Clientes.Cod_S_Cli)))
                       left join Tb_Estados on((Tb_End_Clientes.Cod_S_Estado = Tb_Estados.Cod_S_Estado)));
