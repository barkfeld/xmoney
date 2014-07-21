#
# Definition for the SP_Conta_Receber_Del procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Conta_Receber_Del$$

CREATE PROCEDURE SP_Conta_Receber_Del(
    	IN	iCodConta	INTEGER (11),
	    IN	sAnotacoes	CHAR	(50),
    	IN	iCodUsuarioInc  INTEGER (11)
	)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
	COMMENT 'Cancela conta a receber cadastrada no sistema'
BEGIN

INSERT INTO Tb_Del_Contas_Receber
    (Cod_S_Conta, Anotacoes, Cod_S_Usuario_Inc, Inativo)
VALUES
    (iCodConta, sAnotacoes, iCodUsuarioInc, 0);

UPDATE Tb_Contas_Receber SET Cod_S_Sit = 3 WHERE Cod_S_Conta = iCodConta;

SELECT 'Conta cancelada com sucesso!' as Mensagem;

END$$

DELIMITER ;

