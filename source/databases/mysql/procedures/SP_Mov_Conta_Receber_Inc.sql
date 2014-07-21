#
# Definition for the SP_Mov_Conta_Receber_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Mov_Conta_Receber_Inc$$

CREATE PROCEDURE SP_Mov_Conta_Receber_Inc(
	    IN	iCodConta	INTEGER (11),
	    IN	iCodBanco	INTEGER (11),
	    IN	iCodDespesa	INTEGER (11),
	    IN	iCodFormaPgto	INTEGER (11),
	    IN	sJuros		CHAR	(50),
	    IN	sDesconto	CHAR	(50),
	    IN	sTotal		CHAR	(50),
	    IN	sAnotacoes	CHAR	(50),
	    IN	iCodUsuarioInc  INTEGER (11)
	)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
	COMMENT 'Baixa conta a receber no sistema'
BEGIN

INSERT INTO Tb_Mov_Contas_Receber
   (Cod_S_Conta, Cod_S_Banco, Cod_S_Despesa, Cod_S_Forma,
    Juros, Desconto, Total, Anotacoes, Cod_S_Usuario_Inc, Inativo)
VALUES (iCodConta, iCodBanco, iCodDespesa, iCodFormaPgto,
    sJuros, sDesconto, sTotal, sAnotacoes, iCodUsuarioInc, 0);

UPDATE Tb_Contas_Receber SET Cod_S_Sit = 2 WHERE Cod_S_Conta = iCodConta;
SELECT 'Conta a receber baixada com sucesso!' as Mensagem;

END$$

DELIMITER ;

