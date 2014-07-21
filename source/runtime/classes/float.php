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

class TFloat extends IEntry
{

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{
    parent::__construct ($required, $duplicated, $table, $field);
    
    $this->label->set_text (' Float: ');
    
    $this->entry->set_max_length (12); /* max 999999999,999 */
    $this->entry->set_width_chars (12);
    $this->entry->connect ('changed', array ($this, 'float_changed'));
    
    $this->extra_key = 44; /* , */
}

function set_filter ($field, $field_print, $label = null)
{
    $this->status->destroy ();
    
    if ($label) $this->label->set_text ($label);
    
    $this->field = $field;
    $this->field_print = $field_print;
}

function float_changed ($entry)
{
    $text = $entry->get_text ();
    if (strlen ($text) && $this->field && $this->field_print)
    {
	$this->filter = $this->field . ' = ' . CommaToPoint ($text);
	$this->filter_print = $this->field_print . ' = ' . CommaToPoint ($text);
    }
    else
    {
	$this->filter = '';
	$this->filter_print = '';
    }
}

}; // TFloat

?>
