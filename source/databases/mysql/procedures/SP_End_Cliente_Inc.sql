#
# Definition for the SP_End_Cliente_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_End_Cliente_Inc$$

CREATE PROCEDURE SP_End_Cliente_Inc(
        IN	id		INTEGER (11),
        IN	iCodCliente	INTEGER (11),
        IN	iCodTipo	INTEGER (11),
        IN	sEndereco	CHAR	(50),
        IN	sCEP		CHAR	(50),
        IN	sBairro		CHAR	(50),
        IN	sCidade		CHAR	(50),
        IN	iCodEstado	INTEGER (11),
        IN	sContato	CHAR	(50),
        IN	sFone		CHAR	(50),
        IN	sReferencia	CHAR	(50),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Insere endereco de cliente no sistema'
BEGIN

INSERT INTO Tb_End_Clientes
   (Cod_S_Cli, Cod_S_Tipo,
    Endereco, CEP, Bairro, Cidade, Cod_S_Estado,
    Contato, Fone, Referencia,
    Cod_S_Usuario_Inc)
VALUES
    (iCodCliente, iCodTipo,
    sEndereco, sCEP, sBairro, sCidade, iCodEstado,
    sContato, sFone, sReferencia,
    iCodUsuarioInc);

SELECT 'Endereco do cliente adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;
