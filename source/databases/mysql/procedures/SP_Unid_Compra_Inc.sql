#
# Definition for the SP_Unid_Compra_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Unid_Compra_Inc$$

CREATE PROCEDURE SP_Unid_Compra_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(2),
        IN	sDescricao	CHAR	(30),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere unidade de compra no sistema'
BEGIN

INSERT INTO Tb_Unid_Compras
    (Nome, Descricao, Cod_S_Usuario_Inc)
VALUES
    (sNome, sDescricao, iCodUsuarioInc);

SELECT 'Unidade de compra adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

