#
# Definition for the SP_Forma_Pgto_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Forma_Pgto_Inc$$

CREATE PROCEDURE SP_Forma_Pgto_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	iCodTipoDoc	INTEGER	(11),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere forma de pagamento no sistema'
BEGIN

INSERT INTO Tb_Formas_Pgto
    (Nome, Cod_S_Tipo_Doc, Cod_S_Usuario_Inc)
VALUES
    (sNome, iCodTipoDoc, iCodUsuarioInc);

SELECT 'Forma de pagamento adicionada com sucesso!' as Mensagem;

END$$

DELIMITER ;

