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

class TGrid extends GtkScrolledWindow
{

var $treeview, $store, $model, $iter;
var $ColId, $Id, $ColSel, $Sel;
var $QtdColunas, $Valores;
var $colunas, $celulas, $keypressed;
var $info_linha, $params_info_linha;
var $LinhasColor;
var $popup_menu;
var $SelToggled;
var $Tags;

function __construct ($Parent)
{
    parent::__construct ();
    $this->set_policy (GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);
    
    $this->Parent = $Parent;
    
    $this->treeview = new GtkTreeView ($this->store);
    $this->treeview->set_enable_search (false);
    $this->treeview->connect ('button_press_event', array ($this, 'grid_button_press_event'));
    $this->treeview->connect ('key_press_event', array ($this, 'grid_key_press_event'));
    $this->treeview->show ();
    $this->add ($this->treeview);
    
    $i = 0;
    while ($this->colunas [$i][0])
    {
	$this->colunas [$i][3] = $this->new_column ($this->colunas [$i][0],
    	                                            $this->colunas [$i][1],
    			                            $this->colunas [$i][2]);
	$i ++;
    }
    
    $this->QtdColunas = $i;
}

function grid_key_press_event ($treeview, $event)
{
    switch ($event->keyval)
    {
    case Gdk::KEY_Return:
    case Gdk::KEY_KP_Enter:
    {
	if ($this->Parent->alterar instanceof GtkToolButton) $this->Parent->alterar->emit ('clicked');
	break;
    }
    case Gdk::KEY_Delete:
    {
	if ($this->Parent->excluir instanceof GtkToolButton) $this->Parent->excluir->emit ('clicked');
	break;
    }
    };
}

function grid_button_press_event ($treeview, $event)
{
    if ($event->button == 1 && $event->type == 5 /* Duplo Click */)
    {
	if ($this->Parent->alterar instanceof GtkToolButton) $this->Parent->alterar->emit ('clicked');
    }
}

function new_column ($label, $cell_type, $index)
{
	//check cell type
	if ($cell_type == 'text')
	{
		$this->celulas [$index] = new GtkCellRendererText;
	}
	elseif ($cell_type == 'active')
	{
		$this->celulas [$index] = new GtkCellRendererToggle;
		
		$this->celulas [$index]->connect ('toggled', array ($this, 'sel_toggled'));
	}
	elseif ($cell_type == 'pixbuf')
	{
	    $this->celulas [$index] = new GtkCellRendererPixbuf;
	}
	
	$column = new GtkTreeViewColumn ($label,
	                                 $this->celulas [$index],
					 $cell_type,
					 $index);
	$column->set_reorderable (true);
	$column->set_sort_column_id ($index);
	$column->set_resizable (true);
	$column->connect ('clicked', array ($this, 'column_clicked'));
	$this->treeview->append_column ($column);
	
	return $column;
}

function column_clicked ($column)
{
    $this->treeview->grab_focus ();
}

function sel_toggled ($renderer, $row)
{
    if (isset ($this->ColSel))
    {
	$iter = $this->store->get_iter ($row);
	$cell = $this->store->get_value ($iter, $this->ColSel);
	
	$value = $this->keypressed ? $cell : !$cell;
	$this->store->set ($iter, $this->ColSel, $value);
    }
}

function pega_dados ()
{
    $selection = $this->treeview->get_selection ();
    list ($this->model, $this->iter) = $selection->get_selected ();
    
    if (!$this->iter)
    {
	$this->Id = null;
	$this->Sel = null;
	
	return;
    }
    
    if ($this->ColId)
	$this->Id = $this->model->get_value ($this->iter, $this->ColId /* Id */ );
    
    if ($this->ColSel)
	$this->Sel = $this->model->get_value ($this->iter, $this->ColSel /* Sel */);
    
    unset ($this->Valores);
    for ($i = 0; $i < $this->QtdColunas; $i ++)
	$this->Valores [$i] = $this->model->get_value ($this->iter, $i);
    
    return true;
}

function first_line ()
{
    $this->treeview->grab_focus ();
    $selection = $this->treeview->get_selection ();
    $selection->select_path ('0');
}

}; // TGrid

?>
