#
# Definition for the SP_Conta_Pagar_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Conta_Pagar_Inc$$

CREATE PROCEDURE SP_Conta_Pagar_Inc(
		IN	iCodTipoDoc	INTEGER (11),
		IN	iCodFilial	INTEGER (11),
    	IN	iCodFornecedor	INTEGER (11),
    	IN	sNumDoc		CHAR	(50),
    	IN	iParcela	INTEGER	(11),
    	IN	sVencimento	CHAR	(50),
    	IN	sValor		CHAR	(50),
	    IN	sAnotacoes	CHAR	(50),
	    IN	iCodUsuarioInc  INTEGER (11)
	)
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
	COMMENT 'Insere conta a pagar no sistema'
BEGIN

INSERT INTO Tb_Contas_Pagar
    (Cod_S_TipoDoc, Cod_S_Filial, Cod_S_For,
    NumDoc, Parcela, Vencimento, ValorDoc, Anotacoes,
    Cod_S_Sit, Cod_S_Usuario_Inc)
VALUES
    (iCodTipoDoc, iCodFilial, iCodFornecedor,
    sNumDoc, iParcela, sVencimento, sValor, sAnotacoes,
    1, iCodUsuarioInc);

SELECT 'Conta a pagar adicionada com sucesso!' as Mensagem;

END$$

DELIMITER ;

