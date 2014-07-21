#
# Definition for the SP_End_Transportadora_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_End_Transportadora_Alt$$

CREATE PROCEDURE SP_End_Transportadora_Alt(
        IN	id		INTEGER (11),
        IN	iCodTrans	INTEGER (11),
        IN	iCodTipo	INTEGER (11),
        IN	sEndereco	CHAR	(50),
        IN	sCEP		CHAR	(50),
        IN	sBairro		CHAR	(50),
        IN	sCidade		CHAR	(50),
        IN	iCodEstado	INTEGER (11),
        IN	sContato	CHAR	(50),
        IN	sFone		CHAR	(50),
        IN	sReferencia	CHAR	(50),
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Altera endereco da transportadora no sistema'
BEGIN

UPDATE Tb_End_Transportadoras
SET Cod_S_Trans = iCodTrans,
    Cod_S_Tipo = iCodTipo,
    Endereco = sEndereco,
    CEP = sCEP,
    Bairro = sBairro,
    Cidade = sCidade,
    Cod_S_Estado = iCodEstado,
    Contato = sContato,
    Fone = sFone,
    Referencia = sReferencia,
    DataAlt = NOW(),
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Endereco = id;

SELECT 'Endereco da transportadora alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;
