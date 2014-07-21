#
# Definition for the SP_Banco_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Banco_Alt$$

CREATE PROCEDURE SP_Banco_Alt(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sAgencia	CHAR	(50),
        IN	sConta		CHAR	(50),
        IN	iCodFilial	INTEGER	(11),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera banco no sistema'
BEGIN

UPDATE Tb_Bancos
SET Nome = sNome,
    Agencia = sAgencia,
    Conta = sConta,
    Cod_S_Filial = iCodFilial,
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Banco = id;

SELECT 'Banco alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;

