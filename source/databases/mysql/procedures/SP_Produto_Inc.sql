#
# Definition for the SP_Produto_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Produto_Inc$$

CREATE PROCEDURE SP_Produto_Inc(
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
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere produto no sistema'
BEGIN

INSERT INTO Tb_Produtos
    (Cod_S_Sit, Cod_S_Tipo, Ativo, Cod_S_Grupo, Cod_S_Marca, Modelo, Descricao,
     Custo, Margem, Percentual, ICMS, IPI, ClasFiscal,
     QtdeMinima, CotaCompra, CotaVenda,
     Cod_S_Compra, Cod_S_Venda, Cod_S_Estoque,
     Cod_S_Usuario_Inc)
VALUES
    (iCodSit, iCodTipo, iAtivo, iCodGrupo, iCodMarca, sModelo, sDescricao,
     sCusto, sMargem, sPercentual, iICMS, iIPI, iClasFiscal,
     iQtdeMinima, iCotaCompra, iCotaVenda,
     iCodCompra, iCodVenda, iCodEstoque,
     iCodUsuarioInc);

SELECT 'Produto adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

