#
# Definition for the SP_Sit_Produto_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Sit_Produto_Inc$$

CREATE PROCEDURE SP_Sit_Produto_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAbreviacao	CHAR	(3),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere situação de produto no sistema'
BEGIN

INSERT INTO Tb_Sit_Produtos
    (Nome, Abreviacao, Cod_S_Usuario_Inc)
VALUES
    (sNome, sAbreviacao, iCodUsuarioInc);

SELECT 'Situação de produto adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

