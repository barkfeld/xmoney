#
# Definition for the SP_Tipo_Doc_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Tipo_Doc_Alt$$

CREATE PROCEDURE SP_Tipo_Doc_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAbreviacao	CHAR	(3),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera tipo de documento no sistema'
BEGIN

UPDATE Tb_Tipos_Doc
SET Nome = sNome,
    Abreviacao = sAbreviacao,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Tipo = id;

SELECT 'Tipo de documento alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

