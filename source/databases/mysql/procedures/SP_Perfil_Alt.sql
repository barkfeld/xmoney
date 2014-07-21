#
# Definition for the SP_Perfil_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Perfil_Alt$$

CREATE PROCEDURE SP_Perfil_Alt(
        IN	id				INTEGER (11),
        IN	sNome			CHAR	(50),
        IN	sDescricao		CHAR	(50),
		IN	iCodUsuarioAlt	INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera perfil no sistema'
BEGIN

UPDATE Tb_Perfis
SET Nome = sNome,
	Descricao = sDescricao,
    Cod_S_Usuario_Alt = iCodUsuarioAlt,
    DataAlt = NOW()
WHERE Cod_S_Perfil = id;

SELECT 'Perfil alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;
