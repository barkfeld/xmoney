#
# Definition for the SP_Grupo_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Grupo_Inc$$

CREATE PROCEDURE SP_Grupo_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAtalho		CHAR	(50),
        IN	iAtivo		TINYINT	(1),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere grupo no sistema'
BEGIN

INSERT INTO Tb_Grupos
    (Nome, Atalho, Ativo, Cod_S_Usuario_Inc)
VALUES
    (sNome, sAtalho, iAtivo, iCodUsuarioInc);

SELECT 'Grupo adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

