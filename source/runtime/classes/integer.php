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

require_once 'entrys.php';

class TInteger extends IEntry
{

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{
    parent::__construct ($required, $duplicated, $table, $field);
    
    $this->label->set_text (' Integer: ');
    
    $this->entry->set_max_length (11); /* max 99999999999 */
    $this->entry->set_width_chars (11);
    $this->entry->connect ('changed', array ($this, 'integer_changed'));
}

function set_filter ($field, $field_print, $label = null)
{
    $this->status->destroy ();
    
    if ($label) $this->label->set_text ($label);
    
    $this->field = $field;
    $this->field_print = $field_print;
}

function integer_changed ($entry)
{
    $text = $entry->get_text ();
    if (strlen ($text) && $this->field && $this->field_print)
    {
	$this->filter = $this->field . ' = ' . $text;
	$this->filter_print = $this->field_print . ' = ' . $text;
    }
    else
    {
	$this->filter = '';
	$this->filter_print = '';
    }
}

}; // TInteger

?>
