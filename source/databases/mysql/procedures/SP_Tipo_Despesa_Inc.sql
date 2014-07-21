#
# Definition for the SP_Tipo_Despesa_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Tipo_Despesa_Inc$$

CREATE PROCEDURE SP_Tipo_Despesa_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere tipo de despesa no sistema'
BEGIN

INSERT INTO Tb_Tipos_Despesa
    (Nome, Cod_S_Usuario_Inc)
VALUES
    (sNome, iCodUsuarioInc);

SELECT 'Tipo de despesa adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

