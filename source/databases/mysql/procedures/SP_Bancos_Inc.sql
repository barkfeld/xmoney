#
# Definition for the SP_Banco_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Banco_Inc$$

CREATE PROCEDURE SP_Banco_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAgencia	CHAR	(50),
        IN	sConta		CHAR	(50),
        IN	iCodFilial	INTEGER	(11),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere banco no sistema'
BEGIN

INSERT INTO Tb_Bancos
    (Nome, Agencia, Conta, Cod_S_Filial, Cod_S_Usuario_Inc)
VALUES
    (sNome, sAgencia, sConta, iCodFilial, iCodUsuarioInc);

SELECT 'Banco adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

