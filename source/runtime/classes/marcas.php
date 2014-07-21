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

class TMarcas extends GtkHBox
{

var $store, $it;
var $CodMarca, $Marca;
var $filtro;

function __construct ($Owner)
{
    parent::__construct ();
    
    $this->pack_start (new GtkLabel (' Marca: '), false);
    
    $completion = new GtkEntryCompletion;
    $completion->set_model ($this->store = new GtkListStore (TYPE_STRING, TYPE_LONG));
    $completion->set_text_column (0);
    $completion->pack_start ($cell = new GtkCellRendererText());
    $completion->set_attributes($cell, 'text', 1);
    $completion->connect ('match-selected', array ($this, 'marca_selected'));
    $this->pack_start ($this->entry = new GtkEntry);
    $this->entry->set_completion ($completion);
    
    $this->show_all ();
    
    /*
     * preenche lista
     */
    $db = new Database ($Owner, true);
    if (!$db->link) return;
    
    /*
     * Fornecedores
     */
    if (!$db->multi_query ('SELECT * FROM Vw_Marcas')) return;
    
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

function marca_selected ($widget, $model, $iter)
{
    $this->Marca = $model->get_value ($iter, 0);
    $this->CodMarca = $model->get_value ($iter, 1);
    $this->filter = ' CodMarca = ' . $this->CodMarca;
    $this->filter_print = ' Tb_Marcas.Cod_S_Marca = ' . $this->CodMarca;
}

}; // TMarcas

?>
