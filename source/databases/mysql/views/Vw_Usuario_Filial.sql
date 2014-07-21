#
# Definition for the Vw_Usuario_Filial view : 
#

DROP VIEW IF EXISTS Vw_Usuario_Filial;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Usuario_Filial AS 
  select 
    Tb_Usuarios.Cod_S_Usuario AS CodUsuario,
    Tb_Usuarios.Usuario AS Usuario,
    Tb_Usuarios.Nome AS Nome,
    Tb_Usuarios.Email as Email,
    Tb_Filiais.Cod_S_Filial AS CodFilial,
    Tb_Filiais.Nome AS Filial,
    Tb_Perfis.Cod_S_Perfil AS CodPerfil,
    Tb_Perfis.Nome AS Perfil,
    Tb_Deptos.Cod_S_Depto as CodDepto,
    Tb_Deptos.Nome as Depto,
    Tb_Cargos.Cod_S_Cargo as CodCargo,
    Tb_Cargos.Nome as Cargo
  from 
  ((((Tb_Usuarios left join Tb_Filiais on((Tb_Usuarios.Cod_S_Filial = Tb_Filiais.Cod_S_Filial)))
                  left join Tb_Perfis on((Tb_Usuarios.Cod_S_Perfil = Tb_Perfis.Cod_S_Perfil)))
                  left join Tb_Deptos on((Tb_Usuarios.Cod_S_Depto = Tb_Deptos.Cod_S_Depto)))
                  left join Tb_Cargos on((Tb_Usuarios.Cod_S_Cargo = Tb_Cargos.Cod_S_Cargo)));
