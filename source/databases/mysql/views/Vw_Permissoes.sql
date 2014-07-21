#
# Definition for the Vw_Permissoes view : 
#

DROP VIEW IF EXISTS Vw_Permissoes;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Permissoes AS 
  select 
    Tb_Permissoes.Cod_S_Permissao AS Id,
    Tb_Itens.Cod_S_Item AS CodItem,
    Tb_Itens.Alias AS Alias,
    Tb_Perfis.Cod_S_Perfil AS CodPerfil 
  from 
    ((Tb_Permissoes join Tb_Itens on((Tb_Permissoes.Cod_S_Item = Tb_Itens.Cod_S_Item)))
                    join Tb_Perfis on((Tb_Permissoes.Cod_S_Perfil = Tb_Perfis.Cod_S_Perfil)));
