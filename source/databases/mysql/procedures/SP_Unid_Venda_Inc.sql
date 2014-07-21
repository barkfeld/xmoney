#
# Definition for the SP_Unid_Venda_Inc procedure:
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Unid_Venda_Inc$$

CREATE PROCEDURE SP_Unid_Venda_Inc(
        IN	id		INTEGER (11),
        IN	sNome		CHAR	(2),
        IN	sDescricao	CHAR	(30),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere unidade de venda no sistema'
BEGIN

INSERT INTO Tb_Unid_Vendas
    (Nome, Descricao, Cod_S_Usuario_Inc)
VALUES
    (sNome, sDescricao, iCodUsuarioInc);

SELECT 'Unidade de venda adicionado com sucesso!' as Mensagem;

END$$

DELIMITER ;

