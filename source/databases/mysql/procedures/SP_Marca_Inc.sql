#
# Definition for the SP_Marca_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Marca_Inc$$

CREATE PROCEDURE SP_Marca_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAtalho		CHAR	(50),
        IN	iAtivo		TINYINT	(1),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere marca no sistema'
BEGIN

INSERT INTO Tb_Marcas
    (Nome, Atalho, Ativo, Cod_S_Usuario_Inc)
VALUES
    (sNome, sAtalho, iAtivo, iCodUsuarioInc);

SELECT 'Marca adicionada com sucesso!' as Mensagem;

END$$

DELIMITER ;

