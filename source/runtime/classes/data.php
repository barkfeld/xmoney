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

class TData extends IEntry
{

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{
    parent::__construct ($required, $duplicated, $table, $field);
    
    $this->label->set_text (' Data: ');
    
    $this->entry->set_editable (false);
    $this->entry->set_max_length (10); /* max 99/99/9999 */
    $this->entry->set_width_chars (10);
    $this->entry->connect ('changed', array ($this, 'data_changed'));
    
    $this->eventbox->add ($button = new GtkButton);
    $button->add (GtkImage::new_from_stock (Gtk::STOCK_PROPERTIES, Gtk::ICON_SIZE_BUTTON));
    $button->connect ('clicked', array ($this, 'prop_clicked'), $this->entry);
    
    $this->extra_key = 47; /* / */
}

function set_filter ($field, $field_print, $label = null)
{
    $this->status->destroy ();
    
    if ($label) $this->label->set_text ($label);
    
    $this->field = $field;
    $this->field_print = $field_print;
}

function data_changed ($entry)
{
    $text = $entry->get_text ();
    if (strlen ($text) && $this->field && $this->field_print)
    {
	$this->filter = $this->field . ' LIKE ' . String (CDate ($text) . '%');
	$this->filter_print = $this->field_print . ' LIKE ' . String (CDate ($text) . '%');
    }
    else
    {
	$this->filter = '';
	$this->filter_print = '';
    }
}

function prop_clicked ($button, $ptr_entry)
{
    $dialog = new GtkDialog ('Escolha uma data ...');
    $pixbuf = $dialog->render_icon (Gtk::STOCK_PROPERTIES, Gtk::ICON_SIZE_BUTTON);
    $dialog->set_icon ($pixbuf);
    $dialog->vbox->pack_start ($calendar = new GtkCalendar);
    $calendar->connect ('day-selected-double-click', array ($this, 'calendar_double_click'), $dialog, $ptr_entry);
    $calendar->show ();
    $dialog->run ();
    $dialog->destroy ();
}

function calendar_double_click ($calendar, $dialog, $entry)
{
    $data = $calendar->get_date ();
    
    $ano = $data [0] > 9 ? $data [0] : '0' . $data [0];
    $cur_mes = $data [1]  + 1;
    $mes = $cur_mes > 9 ? $cur_mes : '0' . $cur_mes;
    $dia = $data [2] > 9 ? $data [2] : '0' . $data [2];
    $entry->set_text ($dia . '/' . $mes . '/' . $ano);
    
    $dialog->destroy ();
}

}; // TData

?>
