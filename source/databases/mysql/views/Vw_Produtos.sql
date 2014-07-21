#
# Definition for the Vw_Produtos view :
#

DROP VIEW IF EXISTS Vw_Produtos;

CREATE ALGORITHM=MERGE SQL SECURITY DEFINER VIEW Vw_Produtos AS
  select 
    Tb_Produtos.Cod_S_Produto AS Id,
    Tb_Sit_Produtos.Cod_S_Sit as CodSit,
    Tb_Sit_Produtos.Nome as Situacao,
    Tb_Tipos_Produto.Cod_S_Tipo as CodTipo,
    Tb_Tipos_Produto.Nome as Tipo,
    Tb_Grupos.Cod_S_Grupo as CodGrupo,
    Tb_Grupos.Nome as Grupo,
    Tb_Marcas.Cod_S_Marca as CodMarca,
    Tb_Marcas.Nome as Marca,
    Tb_Unid_Compras.Cod_S_Unidade as CodCompra,
    Tb_Unid_Compras.Nome as UnidCompra,
    Tb_Unid_Vendas.Cod_S_Unidade as CodVenda,
    Tb_Unid_Vendas.Nome as UnidVenda,
    Tb_Unid_Estoques.Cod_S_Unidade as CodEstoque,
    Tb_Unid_Estoques.Nome as UnidEstoque,
    Tb_Produtos.Ativo,
    Tb_Produtos.Modelo,
    Tb_Produtos.Descricao,
    Tb_Produtos.Custo,
    Tb_Produtos.Margem,
    Tb_Produtos.Percentual,
    Tb_Produtos.ICMS,
    Tb_Produtos.IPI,
    Tb_Produtos.ClasFiscal,
    Tb_Produtos.QtdeMinima,
    Tb_Produtos.CotaCompra,
    Tb_Produtos.CotaVenda
  from
(((((((Tb_Produtos left join Tb_Sit_Produtos  on((Tb_Produtos.Cod_S_Sit = Tb_Sit_Produtos.Cod_S_Sit)))
                 left join Tb_Tipos_Produto on((Tb_Produtos.Cod_S_Tipo = Tb_Tipos_Produto.Cod_S_Tipo)))
                 left join Tb_Grupos        on((Tb_Produtos.Cod_S_Grupo = Tb_Grupos.Cod_S_Grupo)))
                 left join Tb_Marcas        on((Tb_Produtos.Cod_S_Marca = Tb_Marcas.Cod_S_Marca)))
                 left join Tb_Unid_Compras  on((Tb_Produtos.Cod_S_Compra = Tb_Unid_Compras.Cod_S_Unidade)))
                 left join Tb_Unid_Vendas   on((Tb_Produtos.Cod_S_Venda = Tb_Unid_Vendas.Cod_S_Unidade)))
                 left join Tb_Unid_Estoques  on((Tb_Produtos.Cod_S_Estoque = Tb_Unid_Estoques.Cod_S_Unidade)));

