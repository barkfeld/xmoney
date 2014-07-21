#
# Definition for the SP_Unid_Compra_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Unid_Compra_Alt$$

CREATE PROCEDURE SP_Unid_Compra_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(2),
        IN	sDescricao	CHAR	(30),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera unidade de compra no sistema'
BEGIN

UPDATE Tb_Unid_Compras
SET Nome = sNome,
    Descricao = sDescricao,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Unidade = id;

SELECT 'Unidade de compra alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

