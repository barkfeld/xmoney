#
# Definition for the SP_Unid_Estoque_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Unid_Estoque_Alt$$

CREATE PROCEDURE SP_Unid_Estoque_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(30),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera unidade de estoque no sistema'
BEGIN

UPDATE Tb_Unid_Estoques
SET Nome = sNome,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Unidade = id;

SELECT 'Unidade de estoque alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

