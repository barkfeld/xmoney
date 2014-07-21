#
# Definition for the SP_Filial_Alt procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Filial_Alt$$

CREATE PROCEDURE SP_Filial_Alt(
        IN id INTEGER(11),
        IN iCodEstado INTEGER (11),
        IN sNome CHAR(50),
        IN sCNPJ CHAR(50),
        IN sRazao CHAR(50),
        IN sEndereco CHAR(50),
        IN sBairro CHAR(50),
        IN sCEP CHAR(50),
        IN sCidade CHAR(50),
        IN sTel CHAR(50),
        IN sFax CHAR(50),
        IN sEmail CHAR(50),
        IN sURL CHAR(50),
        IN sDominio CHAR(50),
        IN iCodUsuarioAlt INTEGER(11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Altera filial no sistema'
BEGIN

UPDATE Tb_Filiais
SET Cod_S_Estado = iCodEstado,
    Nome = sNome,
    CNPJ = sCNPJ,
    Razao = sRazao,
    Endereco = sEndereco,
    Bairro = sBairro,
    CEP = sCEP,
    Cidade = sCidade,
    Tel = sTel,
    Fax = sFax,
    Email = sEmail,
    URL = sURL,
    Dominio = sDominio,
    DataAlt = NOW(),
    Cod_S_Usuario_Alt = iCodUsuarioAlt
WHERE Cod_S_Filial = id;

SELECT 'Filial alterada com sucesso!' as Mensagem;

END$$

DELIMITER ;
