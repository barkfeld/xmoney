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

require_once 'classes/data.php';
require_once 'classes/tipo_doc.php';

class TFiltroContasPagar extends TFiltro
{

function __construct ($pesquisar)
{
    parent::__construct ($pesquisar);
    
    $this->restaurar ();
}

function criar_filtro ()
{
    $hbox = $this->add_button ('id', $id = new TInteger);
    $id->set_filter ('Id', 'Tb_Contas_Pagar.Cod_S_Conta', ' Id.: ');
    
    $this->add_button ('filial', new TFiliais (null), $hbox);
    $this->add_button ('tipo', new TTipoDoc (null), $hbox);
    
    $hbox = $this->add_button ('fornec', $fornec = new TString);
    $fornec->set_filter ('Fornecedor', 'Tb_Fornecedores.Nome', ' Fornecedor: ', '');
    
    $this->add_button ('ndoc', $ndoc = new TString, $hbox);
    $ndoc->set_filter ('NumDoc', 'NumDoc', ' Num. do Doc.: ');
    
    $hbox = $this->add_button ('valor_doc', $valor_doc = new TFloat);
    $valor_doc->set_filter ('ValorDoc', 'ValorDoc', ' Valor do Doc.: ');
    
    $this->add_button ('n_parc', $n_parc = new TInteger, $hbox);
    $n_parc->set_filter ('Parcela', 'Parcela', ' Parcela: ');
    
    $this->add_button ('dat_emi', $dat_emi = new TData, $hbox);
    $dat_emi->set_filter ('Emissao', 'Tb_Contas_Pagar.DataInc', latin1 (' Emissão: '));
    
    $this->add_button ('dat_venc', $dat_venc = new TData, $hbox);
    $dat_venc->set_filter ('Vencimento', 'Tb_Contas_Pagar.Vencimento', ' Vencimento: ');
}

}; // TFiltroContasPagar

?>
