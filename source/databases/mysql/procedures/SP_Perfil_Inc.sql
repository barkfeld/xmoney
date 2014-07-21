#
# Definition for the SP_Perfil_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Perfil_Inc$$

CREATE PROCEDURE SP_Perfil_Inc(
        IN	id				INTEGER (11),
        IN	sNome			CHAR	(50),
        IN	sDescricao		CHAR	(50),
		IN	iCodUsuarioInc	INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere perfil no sistema'
BEGIN

INSERT INTO Tb_Perfis
    (Nome, Descricao, Cod_S_Usuario_Inc)
VALUES (sNome, sDescricao, iCodUsuarioInc);

SELECT 'Perfil adicionado com sucesso!' as Mensagem;
SELECT MAX(Cod_S_Perfil) as CodPerfil FROM Tb_Perfis;

END$$

DELIMITER ;
