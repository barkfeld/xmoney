#
# Definition for the SP_Forma_Pgto_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Forma_Pgto_Alt$$

CREATE PROCEDURE SP_Forma_Pgto_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	iCodTipoDoc	INTEGER	(11),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera forma de pagamento no sistema'
BEGIN

UPDATE Tb_Formas_Pgto
SET Nome = sNome,
    Cod_S_Tipo_Doc = iCodTipoDoc,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Forma = id;

SELECT 'Forma de pagamento alterada com sucesso!' as Mensagem;

END$$

DELIMITER ;

