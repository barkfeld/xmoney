<?php

/*
 * X-Money - Gestao Empresarial Integrada
 *
 * Copyright (C) 2010 Eneias Ramos de Melo <neneias@gmail.com>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

class TFiltroTransportadoras extends TFiltro
{

function __construct ($pesquisar)
{
    parent::__construct ($pesquisar);
    
    $this->restaurar ();
}

function criar_filtro ()
{
    $hbox = $this->add_button ('id', $id = new TInteger);
    $id->set_filter ('Id', 'Tb_Transportadoras.Cod_S_Trans', ' Id.: ');
    
    $this->add_button ('nome_transportadora', $nome_transp = new TString, $hbox);
    $nome_transp->set_filter ('Nome', 'Tb_Transportadoras.Nome', latin1 (' Nome / Razão: '));
    
    $this->add_button ('tipo_pessoa', new TTipoPessoa (null), $hbox);
    
    $hbox = $this->add_button ('cpf', $cpf = new TString);
    $cpf->set_filter ('CPF', 'Tb_Transportadoras.CPF', ' CPF / CNPJ: ');
    
    $this->add_button ('fone', $fone = new TString, $hbox);
    $fone->set_filter ('Fone', 'Tb_Transportadoras.Fone', ' Fone: ');
    
    $this->add_button ('email', $email = new TString, $hbox);
    $email->set_filter ('Email', 'Tb_Transportadoras.Email', ' e-mail: ');
}

}; // TFiltroTransportadoras

?>
