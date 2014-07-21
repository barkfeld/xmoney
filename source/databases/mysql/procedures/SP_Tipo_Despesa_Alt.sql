#
# Definition for the SP_Tipo_Doc_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Tipo_Despesa_Alt$$

CREATE PROCEDURE SP_Tipo_Despesa_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera tipo de despesa no sistema'
BEGIN

UPDATE Tb_Tipos_Despesa
SET Nome = sNome,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Tipo = id;

SELECT 'Tipo de despesa alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

