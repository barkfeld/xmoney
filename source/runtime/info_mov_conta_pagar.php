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

require_once 'grid_info_mov_conta_pagar.php';

class TInfoMovContaPagar extends TJanela
{

function __construct ($Parent, $CodConta)
{
    parent::__construct (latin1 ('Movimentação da Conta'), 600, 300, 'contas_pagar.png');
    
    $this->Parent = $Parent;
    $this->CodConta = $CodConta;
    
    // CodConta, TipoDoc e NumDoc
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->cod_conta = new GtkLabel);
    $hbox->pack_start ($this->tipo_doc = new GtkLabel);
    $hbox->pack_start ($this->num_doc = new GtkLabel);
    
    $this->pack_start ($vbox = new GtkVBox);
    $vbox->pack_start ($this->grid = new TGridInfoMovContaPagar ($this));
    
    $vbox->pack_start ($this->fechar = GtkButton::new_from_stock ('gtk-close'), false);
    $this->fechar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    $this->fechar->connect ('clicked', array ($this, 'fechar_clicked'));
    
    $this->children_show_all ();
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    // Lançamentos
    if (!$db->multi_query ('SELECT * FROM Vw_Contas_Pagar WHERE Id = ' . $this->CodConta)) return;
    
    $line = $db->line ();
    $this->cod_conta->set_markup ('<b>Cod. Conta: <span color="red">' . $this->CodConta . '</span></b>');
    $this->tipo_doc->set_markup ('<b>Tipo de Doc.: <span color="red">' . $line ['TipoDoc'] . '</span></b>');
    $this->num_doc->set_markup ('<b>Numero do Doc.: <span color="red">' . $line ['NumDoc'] . '</span></b>');
    
    $row = $this->grid->store->append ();
    $this->grid->store->set ($row,
                             0, $line ['Id'],
                             1, 'Lancamento',
                             2, FDateTime ($line ['Emissao']),
                             3, $line ['Anotacoes'],
                             4, $line ['Usuario']);
    
    // Baixas
    if (!$db->multi_query ('SELECT * FROM Vw_Mov_Contas_Pagar WHERE CodConta = ' . $this->CodConta)) return;
    
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
	                         0, $line ['Id'],
				 1, 'Baixa',
				 2, FDateTime ($line ['Pagamento']),
				 3, $line ['Anotacoes'],
				 4, $line ['Usuario']);
    }
    
    // Cancelamentos
    if (!$db->multi_query ('SELECT * FROM Vw_Del_Contas_Pagar WHERE CodConta = ' . $this->CodConta)) return;
    
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
	                         0, $line ['Id'],
				 1, 'Cancelamento',
				 2, FDateTime ($line ['Cancelado']),
				 3, $line ['Anotacoes'],
				 4, $line ['Usuario']);
    }
    
    $this->grid->first_line ();
    
    return true;
}

function fechar_clicked ()
{
    $this->destroy ();
}

}; // TInfoMovContasPagar


?>
