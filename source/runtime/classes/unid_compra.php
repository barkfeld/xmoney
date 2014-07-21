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

class TUnidCompra extends GtkHBox
{

var $store, $combobox, $it;
var $CodUnidCompra, $UnidCompra;
var $filtro;

function __construct ($Owner)
{
    parent::__construct ();
    
    $this->pack_start (new GtkLabel (' Unid. de Compra: '), false);
    
    $this->store = new GtkListStore (TYPE_STRING, TYPE_STRING, TYPE_LONG);
    $this->pack_start ($this->combobox = new GtkComboBox ($this->store));
    $this->combobox->pack_start ($cell = new GtkCellRendererText ());
    $this->combobox->set_attributes ($cell, 'text', 0);
    $this->combobox->pack_start ($cell = new GtkCellRendererText ());
    $this->combobox->set_attributes ($cell, 'text', 1);
    
    $this->combobox->connect ('changed', array ($this, 'unid_compra_changed'));
    
    $this->show_all ();
    
    /*
     * preenche lista
     */
    $db = new Database ($Owner, true);
    if (!$db->link) return;
    
    /*
     * Unidades de Compra
     */
    if (!$db->multi_query ('SELECT * FROM Vw_Unid_Compras')) return;
    
    $this->store->clear ();
    unset ($this->it);
    
    while ($line = $db->line ())
    {
	$row = $this->store->append ();
	
	$this->store->set ($row,
			    0, $line ['Descricao'],
			    1, $line ['Nome'],
			    2, $line ['Id']);
	$this->it [$line ['Id']] = $row;
    }
}

function unid_compra_changed ()
{
    $this->UnidCompra = $this->store->get_value ($this->combobox->get_active_iter (), 1);
    $this->CodUnidCompra = $this->store->get_value ($this->combobox->get_active_iter (), 2);
    $this->filter = ' CodUnidCompra = ' . $this->CodUnidCompra;
    $this->filter_print = ' Tb_Unid_Compras.Cod_S_Unidade = ' . $this->CodUnidCompra;
}

}; // TUnidCompra

?>
