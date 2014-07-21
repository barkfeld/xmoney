#
# Definition for the SP_Fornecedor_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Fornecedor_Inc$$

CREATE PROCEDURE SP_Fornecedor_Inc(
        IN	id		INTEGER (11),
        IN	iCodTipo	INTEGER (11),
        IN	sNome		CHAR	(50),
        IN	sCPF		CHAR	(50),
        IN	sFantasia	CHAR	(50),
        IN	sIE		CHAR	(50),
        IN	sSuframa	CHAR	(50),
        IN	sFone		CHAR	(50),
        IN	sFone2		CHAR	(50),
        IN	sFax		CHAR	(50),
        IN	sFax2		CHAR	(50),
        IN	sEmail		CHAR	(50),
        IN	sURL		CHAR	(50),
        IN	sAnotacoes	CHAR	(50),
        IN	sLimiteCompra	CHAR	(50),
        IN	iAtivo		INTEGER (11),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Insere Fornecedor no sistema'
BEGIN

INSERT INTO Tb_Fornecedores
    (Cod_S_Tipo,
    Nome, CPF, Fantasia, IE, Suframa,
    Fone, Fone2, Fax, Fax2, Email, URL, Anotacoes,
    LimiteCompra, Ativo,
    Cod_S_Usuario_Inc)
VALUES
    (iCodTipo,
    sNome, sCPF, sFantasia, sIE, sSuframa,
    sFone, sFone2, sFax, sFax2, sEmail, sURL, sAnotacoes,
    sLimiteCompra, iAtivo,
    iCodUsuarioInc);

SELECT 'Fornecedor adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;
