#
# Definition for the SP_Conta_Receber_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Conta_Receber_Inc$$

CREATE PROCEDURE SP_Conta_Receber_Inc(
		IN	iCodTipoDoc	INTEGER (11),
		IN	iCodFilial	INTEGER (11),
    	IN	iCodCliente	INTEGER (11),
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
	COMMENT 'Insere conta a receber no sistema'
BEGIN

INSERT INTO Tb_Contas_Receber
    (Cod_S_TipoDoc, Cod_S_Filial, Cod_S_Cli,
    NumDoc, Parcela, Vencimento, ValorDoc, Anotacoes,
    Cod_S_Sit, Cod_S_Usuario_Inc)
VALUES
    (iCodTipoDoc, iCodFilial, iCodCliente,
    sNumDoc, iParcela, sVencimento, sValor, sAnotacoes,
    1, iCodUsuarioInc);

SELECT 'Conta a receber adicionada com sucesso!' as Mensagem;

END$$

DELIMITER ;

