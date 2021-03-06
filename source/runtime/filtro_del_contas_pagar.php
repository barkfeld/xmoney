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

class TFiltroDelContasPagar extends TFiltro
{

function __construct ($pesquisar)
{
    parent::__construct ($pesquisar);
    
    $this->restaurar ();
}

function criar_filtro ()
{
    $hbox = $this->add_button ('id', $id = new TInteger);
    $id->set_filter ('CodConta', 'Tb_Del_Contas_Pagar.Cod_S_Conta', 'Cod. Conta:');
    
    $this->add_button ('filial', new TFiliais (null), $hbox);
    
    $hbox = $this->add_button ('fornec', $fornec = new TString);
    $fornec->set_filter ('Fornecedor', 'Tb_Fornecedores.Nome', ' Fornecedor: ');
    
    $this->add_button ('ndoc', $ndoc = new TString, $hbox);
    $ndoc->set_filter ('NumDoc', 'NumDoc', ' Num. do Doc.: ');
    
    $hbox = $this->add_button ('valor_doc', $valor_doc = new TFloat);
    $valor_doc->set_filter ('ValorDoc', 'ValorDoc', ' Valor do Doc.: ');
    
    $this->add_button ('parc', $parc = new TInteger, $hbox);
    $parc->set_filter ('Parcela', 'Parcela', 'Parcela', ' Parcela: ');
    
    $this->add_button ('venc',   $venc = new TData, $hbox);
    $venc->set_filter ('Vencimento', 'Vencimento', ' Vencimento: ');
    
    $this->add_button ('cancel', $cancel = new TData, $hbox);
    $cancel->set_filter ('Cancelado', 'Tb_Del_Contas_Pagar.DataInc', ' Cancelamento: ');
}

}; // TFiltroDelContasPagar

?>
