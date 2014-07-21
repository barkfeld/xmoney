#
# Definition for the SP_Mov_Conta_Pagar_Del procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Mov_Conta_Pagar_Del$$

CREATE PROCEDURE SP_Mov_Conta_Pagar_Del(
	    IN	iCodMovConta	INTEGER (11),
    	IN	sAnotacoes	CHAR	(50),
    	IN	iCodUsuarioInc  INTEGER (11)
	)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
	COMMENT 'Estorna conta a pagar cadastrada no sistema'
BEGIN

DECLARE CodConta INTEGER (11);

SET CodConta = (SELECT Cod_S_Conta FROM Tb_Mov_Contas_Pagar WHERE Cod_S_Mov = iCodMovConta);

INSERT INTO Tb_Del_Contas_Pagar
    (Cod_S_Conta, Anotacoes, Cod_S_Usuario_Inc, Inativo)
VALUES
    (CodConta, sAnotacoes, iCodUsuarioInc, 1);

UPDATE Tb_Mov_Contas_Pagar SET Inativo = 1 WHERE Cod_S_Mov = iCodMovConta;

UPDATE Tb_Contas_Pagar SET Cod_S_Sit = 1 WHERE Cod_S_Conta = CodConta;

SELECT 'Conta estornada com sucesso!' as Mensagem;

END$$

DELIMITER ;

