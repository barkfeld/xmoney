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

class TFiltro extends GtkExpander
{

var $vbox;
var $pesquisar, $limpar;
var $focus, $lista;

/*
 * $pesquisar => callback para GtkButton pesquisar.
 */
function __construct ($pesquisar)
{
    parent::__construct (' Filtro ');
    
    $this->set_expanded (true);
    
    $this->add ($hbox = new GtkHBox);
    $hbox->pack_start ($this->vbox = new GtkVBox);
    $this->vbox->pack_start (new GtkEventBox);
    $hbox->pack_start ($vbox = new GtkVBox, false);
    
    // pesquisar
    $vbox->pack_start ($this->localizar = GtkButton::new_from_stock ('gtk-find'), false);
    $this->localizar->connect ('clicked', $pesquisar);
    
    // restaurar
    $vbox->pack_start ($this->limpar = GtkButton::new_from_stock ('gtk-clear'), false);
    $this->limpar->connect ('clicked', array ($this, 'restaurar'));
    
    // fill empty space
    $vbox->pack_start (new GtkEventBox);
    
    $this->show_all ();
}

function add_button ($id, $objeto, $hbox = null)
{
    if ($hbox == null) $hbox = new GtkHBox;
    $this->vbox->pack_start ($hbox, false);
    $hbox->pack_start ($this->lista [$id] = $objeto, true);
    $hbox->show_all ();
    
    return $hbox;
}

function limpar ()
{
    $children = $this->vbox->get_children ();
    
    foreach ($children as $child) $child->destroy ();
    
    unset ($this->lista);
}

function restaurar ()
{
    $this->limpar ();
    $this->criar_filtro ();
    $this->focus = $this->lista ['id']->entry;
    $this->set_focus ();
}

function set_focus ()
{
    $this->focus->grab_focus ();
}

/*
 * Monta estrutura da clausula WHERE
 * com base nos campos e retorna.
 */
function sql ()
{
    foreach ($this->lista as $obj)
    {
	if ($obj->filter)
	{
	    if ($sql) $sql = $sql . ' AND ' . $obj->filter;
	    else $sql = $obj->filter;
	}
    }
    
    if ($sql) return ' WHERE ' . $sql;
}

/*
 * Monta estrutura da clausula WHERE
 * com base nos campos e retorna.
 * obs: IMPRESSAO
 */
function sql_print ()
{
    foreach ($this->lista as $obj)
    {
	if ($obj->filter_print)
	{
	    if ($sql_print) $sql_print = $sql_print . ' AND ' . $obj->filter_print;
	    else $sql_print = $obj->filter_print;
	}
    }
    
    if ($sql_print) return ' WHERE ' . $sql_print;
}

}; // TFiltro

?>
