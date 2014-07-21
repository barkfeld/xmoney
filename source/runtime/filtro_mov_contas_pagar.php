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

require_once 'classes/bancos.php';
require_once 'classes/forma_pgto.php';
require_once 'classes/tipo_despesa.php';

class TFiltroMovContasPagar extends TFiltro
{

function __construct ($pesquisar)
{
    parent::__construct ($pesquisar);
    
    $this->restaurar ();
}

function criar_filtro ()
{
    $hbox = $this->add_button ('id', $id = new TInteger);
    $id->set_filter ('CodConta', 'Tb_Mov_Contas_Pagar.Cod_S_Conta', 'Cod. Conta:');
    
    $this->add_button ('filial', new TFiliais (null), $hbox);
    $this->add_button ('banco', new TBancos (null), $hbox);
    
    $hbox = $this->add_button ('fornec', $fornec = new TString);
    $fornec->set_filter ('Fornecedor', 'Tb_Fornecedores.Nome', ' Fornecedor: ');
    
    $this->add_button ('ndoc', $ndoc = new TString, $hbox);
    $ndoc->set_filter ('NumDoc', 'NumDoc', ' Num. do Doc.: ');
    
    $this->add_button ('dia_pgto', $dia_pgto = new TData, $hbox);
    $dia_pgto->set_filter ('Pagamento', 'Tb_Mov_Contas_Pagar.DataInc', ' Data Pgto: ');
    
    $hbox = $this->add_button ('tipo_desp', new TTipoDespesa (null));
    $this->add_button ('form_pgto', new TFormaPgto (null), $hbox);
    
    $hbox = $this->add_button ('juros', $juros = new TFloat);
    $juros->set_filter ('Juros', 'Juros', ' Juros: ');
    
    $this->add_button ('desc', $desc = new TFloat, $hbox);
    $desc->set_filter ('Desconto', 'Desconto', ' Desconto: ');
    
    $this->add_button ('total', $total = new TFloat, $hbox);
    $total->set_filter ('Total', 'Total', ' Valor Pago: ');
}

}; // TFiltroMovContasPagar

?>
