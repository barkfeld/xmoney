#
# Definition for the Vw_Usuarios view : 
#

DROP VIEW IF EXISTS Vw_Usuarios;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Usuarios AS 
  select 
    Tb_Usuarios.Cod_S_Usuario AS Id,
    Tb_Usuarios.Cod_S_Filial AS CodFilial,
    Tb_Usuarios.Cod_S_Perfil AS CodPerfil,
    Tb_Usuarios.Cod_S_Sexo AS CodSexo,
    Tb_Usuarios.Cod_S_EstCivil AS CodEstCivil,
    Tb_Usuarios.Cod_S_Depto AS CodDepto,
    Tb_Usuarios.Cod_S_Cargo AS CodCargo,
    Tb_Usuarios.Cod_S_Estado AS CodEstado,
    Tb_Usuarios.Nome,
    Tb_Usuarios.Usuario,
    Tb_Usuarios.Senha,
    Tb_Usuarios.Ativo,
    Tb_Usuarios.Cracha,
    Tb_Usuarios.Dependentes,
    Tb_Usuarios.Filhos,
    Tb_Usuarios.CPF,
    Tb_Usuarios.RG,
    Tb_Usuarios.Endereco,
    Tb_Usuarios.Email,
    Tb_Usuarios.Bairro,
    Tb_Usuarios.CEP,
    Tb_Usuarios.Cidade,
    Tb_Usuarios.Cel,
    Tb_Usuarios.Tel,
    Tb_Usuarios.Nascimento,
    Tb_Usuarios.Admissao,
    Tb_Usuarios.Homologacao,
    Tb_Usuarios.Rescisao,
    Tb_Usuarios.DataInc,
    Tb_Usuarios.DataAlt,
    Tb_Usuarios.Cod_S_Usuario_Inc AS CodUsuarioInc,
    Tb_Usuarios.Cod_S_Usuario_Alt AS CodUsuarioAlt 
  from 
    Tb_Usuarios;
