#
# Definition for the SP_Grupo_Alt procedure :
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Grupo_Alt$$

CREATE PROCEDURE SP_Grupo_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAtalho		CHAR	(50),
        IN	iAtivo		TINYINT	(1),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera grupo no sistema'
BEGIN

UPDATE Tb_Grupos
SET Nome = sNome,
    Atalho = sAtalho,
    Ativo = iAtivo,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Grupo = id;

SELECT 'Grupo alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;
