#
# Definition for the SP_Transportadora_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Transportadora_Alt$$

CREATE PROCEDURE SP_Transportadora_Alt(
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
        IN	sLimiteEntrega	CHAR	(50),
        IN	iAtivo		INTEGER (11),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Altera transportadora no sistema'
BEGIN

UPDATE Tb_Transportadoras
SET Cod_S_Tipo = iCodTipo,
    Nome = sNome,
    CPF = sCPF,
    Fantasia = sFantasia,
    IE = sIE,
    Suframa = sSuframa,
    Fone = sFone,
    Fone2 = sFone2,
    Fax = sFax,
    Fax2 = sFax2,
    Email = sEmail,
    URL = sURL,
    Anotacoes = sAnotacoes,
    LimiteEntrega = sLimiteEntrega,
    Ativo = iAtivo,
    DataAlt = NOW(),
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Trans = id;

SELECT 'Transportadora alterada com sucesso!' as Mensagem;

END$$

DELIMITER ;
