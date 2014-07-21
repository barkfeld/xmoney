#
# Definition for the SP_Produto_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Produto_Alt$$

CREATE PROCEDURE SP_Produto_Alt(
        IN	id		INTEGER (11),
        IN	iCodSit		INTEGER	(11),
        IN	iCodTipo	INTEGER	(11),
        IN	iAtivo		INTEGER	(11),
        IN	iCodGrupo	INTEGER	(11),
        IN	iCodMarca	INTEGER	(11),
        IN	sModelo		CHAR	(50),
        IN	sDescricao	CHAR	(50),
        IN	sCusto		CHAR	(50),
        IN	sMargem		CHAR	(50),
        IN	sPercentual	CHAR	(50),
        IN	iICMS		INTEGER	(11),
        IN	iIPI		INTEGER	(11),
        IN	iClasFiscal	INTEGER	(11),
        IN	iQtdeMinima	INTEGER	(11),
        IN	iCotaCompra	INTEGER	(11),
        IN	iCotaVenda	INTEGER	(11),
        IN	iCodCompra	INTEGER	(11),
        IN	iCodVenda	INTEGER	(11),
        IN	iCodEstoque	INTEGER	(11),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera produto no sistema'
BEGIN

UPDATE Tb_Produtos
SET Cod_S_Sit = iCodSit,
    Cod_S_Tipo = iCodTipo,
    Ativo = iAtivo,
    Cod_S_Grupo = iCodGrupo,
    Cod_S_Marca = iCodMarca,
    Modelo = sModelo,
    Descricao = sDescricao,
    Custo = sCusto,
    Margem = sMargem,
    Percentual = sPercentual,
    ICMS = iICMS,
    IPI = iIPI,
    ClasFiscal = iClasFiscal,
    QtdeMinima = iQtdeMinima,
    CotaCompra = iCotaCompra,
    CotaVenda = iCotaVenda,
    Cod_S_Compra = iCodCompra,
    Cod_S_Venda = iCodVenda,
    Cod_S_Estoque = iCodEstoque,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Produto = id;

SELECT 'Produto alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

