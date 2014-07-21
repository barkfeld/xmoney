#
# Definition for the SP_Unid_Estoque_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Unid_Estoque_Inc$$

CREATE PROCEDURE SP_Unid_Estoque_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(30),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere unidade de estoque no sistema'
BEGIN

INSERT INTO Tb_Unid_Estoques
    (Nome, Cod_S_Usuario_Inc)
VALUES
    (sNome, iCodUsuarioInc);

SELECT 'Unidade de estoque adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

