#
# Definition for the SP_Usuario_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Usuario_Alt$$

CREATE PROCEDURE SP_Usuario_Alt(
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
        IN	iCodSexo	INTEGER	(11),
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
        IN	iCodUsuarioAlt  INTEGER (11)
    )
    NOT DETERMINISTIC
    CONTAINS SQL
    SQL SECURITY DEFINER
    COMMENT 'Altera usuario no sistema'
BEGIN

UPDATE Tb_Usuarios
SET Cod_S_Filial = iCodFilial,
    Cod_S_Estado = iCodEstado,
    Cod_S_EstCivil = iCodCivil,
    Cod_S_Perfil = iCodPerfil,
    Usuario = sUsuario,
    Nome = sNome,
    Ativo = iAtivo,
    Endereco = sEndereco,
    Bairro = sBairro,
    CEP = sCEP,
    Cidade = sCidade,
    CPF = sCPF,
    RG = sRG,
    Nascimento = sDataNasc,
    Cod_S_Sexo = iCodSexo,
    Dependentes = iDependentes,
    Filhos = iFilhos,
    Cod_S_Depto = iDepto,
    Cod_S_Cargo = iCargo,
    Cracha = iCracha,
    Tel = sTel,
    Cel = sCel,
    Email = sEmail,
    Admissao = sDataAdm,
    Homologacao = sDataHomo,
    Rescisao = sDataResc,
    Cod_S_Usuario_Alt = iCodUsuarioAlt,
    DataAlt = NOW()
WHERE Cod_S_Usuario = id;

SELECT 'Usuario alterado com sucesso!' as Mensagem;

END$$

DELIMITER ;
