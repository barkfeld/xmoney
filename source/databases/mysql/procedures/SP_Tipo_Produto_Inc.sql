#
# Definition for the SP_Tipo_Produto_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Tipo_Produto_Inc$$

CREATE PROCEDURE SP_Tipo_Produto_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAbreviacao	CHAR	(3),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere tipo de produto no sistema'
BEGIN

INSERT INTO Tb_Tipos_Produto
    (Nome, Abreviacao, Cod_S_Usuario_Inc)
VALUES
    (sNome, sAbreviacao, iCodUsuarioInc);

SELECT 'Tipo de produto adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

