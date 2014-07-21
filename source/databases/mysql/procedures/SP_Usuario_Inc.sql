#
# Definition for the SP_Usuario_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Usuario_Inc$$

CREATE PROCEDURE SP_Usuario_Inc(
        IN	id		INTEGER (11),
        IN	iCodFilial	INTEGER (11),
        IN	iCodEstado	INTEGER (11),
        IN	iCodCivil	INTEGER (11),
        IN	iCodPerfil	INTEGER (11),
        IN	sUsuario	CHAR	(50),
        IN	sNome		CHAR	(50),
        IN	iAtivo		INTEGER (11),
        IN	sEndereco	CHAR	(50),
        IN	sBairro		CHAR	(50),
        IN	sCEP		CHAR	(50),
        IN	sCidade		CHAR	(50),
        IN	sCPF		CHAR	(50),
        IN	sRG		CHAR	(50),
        IN	sDataNasc	CHAR	(50),
        IN	iCodSexo	INTEGER (11),
        IN	iDependentes	INTEGER	(11),
        IN	iFilhos		INTEGER	(11),
        IN	iDepto		INTEGER	(11),
        IN	iCargo		INTEGER	(11),
        IN	iCracha		INTEGER	(11),
        IN	sTel		CHAR	(50),
        IN	sCel		CHAR	(50),
        IN	sEmail		CHAR	(50),
        IN	sDataAdm	CHAR	(50),
        IN	sDataHomo	CHAR	(50),
        IN	sDataResc	CHAR	(50),
        IN	iCodUsuarioInc  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Insere usuario no sistema'
BEGIN

INSERT INTO Tb_Usuarios
   (Cod_S_Filial, Cod_S_Estado, Cod_S_EstCivil, Cod_S_Perfil,
    Usuario, Nome, Ativo, Endereco, Bairro, CEP, Cidade,
    CPF, RG, Nascimento, Cod_S_Sexo, Dependentes, Filhos,
    Cod_S_Depto, Cod_S_Cargo, Cracha, Tel, Cel, Email,
    Admissao, Homologacao, Rescisao, Cod_S_Usuario_Inc)
VALUES (iCodFilial, iCodEstado, iCodCivil, iCodPerfil,
    sUsuario, sNome, iAtivo, sEndereco, sBairro, sCEP, sCidade,
    sCPF, sRG, sDataNasc, iCodSexo, iDependentes, iFilhos,
    iDepto, iCargo, iCracha, sTel, sCel, sEmail,
    sDataAdm, sDataHomo, sDataResc, iCodUsuarioInc);

SELECT 'Usuario adicionado com sucesso!' as Mensagem;
SELECT MAX(Cod_S_Usuario) as CodUsuario FROM Tb_Usuarios;

END$$

DELIMITER ;
