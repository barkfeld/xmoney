#
# Definition for the SP_Filial_Inc procedure : 
#

DELIMITER $$

DROP PROCEDURE IF EXISTS SP_Filial_Inc$$

CREATE PROCEDURE SP_Filial_Inc(
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
        IN iCodUsuarioInc INTEGER(11)
    )
    NOT DETERMINISTIC
    MODIFIES SQL DATA
    SQL SECURITY DEFINER
    COMMENT 'Insere filial no sistema'
BEGIN

INSERT INTO Tb_Filiais
    (Cod_S_Estado, Nome, CNPJ, Razao, Endereco, Bairro, CEP, Cidade, Tel, Fax, Email, URL, Dominio,
    Cod_S_Usuario_Inc)
VALUES (iCodEstado, sNome, sCNPJ, sRazao, sEndereco, sBairro, sCEP, sCidade, sTel, sFax, sEmail, sURL, sDominio,
    iCodUsuarioInc);

SELECT 'Filial adicionada com sucesso!' as Mensagem;

END$$

DELIMITER ;
