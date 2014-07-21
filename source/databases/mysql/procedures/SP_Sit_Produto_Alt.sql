#
# Definition for the SP_Sit_Produto_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Sit_Produto_Alt$$

CREATE PROCEDURE SP_Sit_Produto_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAbreviacao	CHAR	(3),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Situação tipo de produto no sistema'
BEGIN

UPDATE Tb_Sit_Produtos
SET Nome = sNome,
    Abreviacao = sAbreviacao,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Sit = id;

SELECT 'Situação de produto alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

