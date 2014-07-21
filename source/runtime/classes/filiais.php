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

class TFiliais extends GtkHBox
{

var $store, $combobox, $it;
var $CodFilial, $Filial;
var $filtro;

function __construct ($Owner)
{
    parent::__construct ();
    
    $this->pack_start (new GtkLabel (' Filial: '), false);
    
    $this->store = new GtkListStore (TYPE_STRING, TYPE_LONG);
    $this->pack_start ($this->combobox = new GtkComboBox ($this->store));
    $this->combobox->pack_start ($cell = new GtkCellRendererText ());
    $this->combobox->set_attributes ($cell, 'text', 0);
    
    $this->combobox->connect ('changed', array ($this, 'filial_changed'));
    
    $this->show_all ();
    
    /*
     * preenche lista
     */
    $db = new Database ($Owner, true);
    if (!$db->link) return;
    
    /*
     * Filiais
     */
    if (!$db->multi_query ('SELECT * FROM Vw_Filiais')) return;
    
    $this->store->clear ();
    unset ($this->it);
    
    while ($line = $db->line ())
    {
	$row = $this->store->append ();
	
	$this->store->set ($row,
			    0, $line ['Nome'],
			    1, $line ['Id']);
	$this->it [$line ['Id']] = $row;
    }
}

function filial_changed ()
{
    $this->Filial = $this->store->get_value ($this->combobox->get_active_iter (), 0);
    $this->CodFilial = $this->store->get_value ($this->combobox->get_active_iter (), 1);
    $this->filter = ' CodFilial = ' . $this->CodFilial;
    $this->filter_print = ' Tb_Filiais.Cod_S_Filial = ' . $this->CodFilial;
}

}; // TFiliais

?>
