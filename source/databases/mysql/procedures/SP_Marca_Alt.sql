#
# Definition for the SP_Marca_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Marca_Alt$$

CREATE PROCEDURE SP_Marca_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAtalho		CHAR	(50),
        IN	iAtivo		TINYINT	(1),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera marca no sistema'
BEGIN

UPDATE Tb_Marcas
SET Nome = sNome,
    Atalho = sAtalho,
    Ativo = iAtivo,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Marca = id;

SELECT 'Marca alterada com sucesso!' as Mensagem;

END$$

DELIMITER ;
