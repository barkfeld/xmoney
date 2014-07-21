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


class TEntry extends GtkHBox
{

var $label, $entry, $eventbox, $status;
var $required, $duplicated, $table, $field;
var $text, $length, $trim_length;

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{
    parent::__construct ();
    
    $this->pack_start ($this->label = new GtkLabel, false);
    $this->pack_start ($this->entry = new GtkEntry);
    $this->pack_start ($this->eventbox = new GtkEventBox, false);
    $this->pack_start ($this->status = GtkImage::new_from_stock (Gtk::STOCK_DIALOG_QUESTION, Gtk::ICON_SIZE_BUTTON), false);
    
    $this->required = $required;
    $this->duplicated = $duplicated;
    $this->table = $table;
    $this->field = $field;
    
    $entry_next_focus = $GLOBALS ['ENTRY_NEXT_FOCUS'];
    if ($entry_next_focus instanceof GtkWidget) EntrySetNextFocus ($entry_next_focus, $this->entry);
    
    $this->entry->connect ('changed', array ($this, '__tentry_changed'));
    $this->entry->connect ('focus_in_event', array ($this, '__tentry_focus_in_event'));
    $this->entry->connect ('focus_out_event', array ($this, '__tentry_focus_out_event'));
    
    $GLOBALS ['ENTRY_NEXT_FOCUS'] = $this->entry;
}

function __tentry_changed ($entry)
{
    $this->text = $this->entry->get_text ();
    $this->length = strlen ($this->text);
    $this->trim_length = strlen (trim ($this->text));
    
    $this->check_required (false);
}

function __tentry_focus_in_event ()
{
    $this->set_fg ('black');
    $this->set_bg ('orange');
    $this->entry->select_region (0, strlen ($this->text));
}

function __tentry_focus_out_event ()
{
    $this->set_bg ('white');
    
    $this->check_required (false);
}

function set_bg ($color)
{
    $this->entry->modify_base (Gtk::STATE_NORMAL, GdkColor::parse ($color));
}

function set_fg ($color)
{
    $this->entry->modify_text (Gtk::STATE_NORMAL, GdkColor::parse ($color));
}

function set_text ($text = '')
{
    $this->entry->set_text ($text);
}

function get_text ()
{
    return $this->entry->get_text ();
}

function set_ok ()
{
    if (isset ($this->status)) $this->status->set_from_stock (Gtk::STOCK_OK, Gtk::ICON_SIZE_BUTTON);
}

function set_warning ()
{
    if (isset ($this->status)) $this->status->set_from_stock (Gtk::STOCK_DIALOG_WARNING, Gtk::ICON_SIZE_BUTTON);
}

function check_required ($break_tab)
{
    if (!$this->required)
    {
	$this->set_ok ();
	return true;
    }
    
    if (!$this->trim_length)
    {
	if ($break_tab) $this->entry->grab_focus ();
	$this->set_warning ();
	return;
    }
    
    $this->set_bg ('white');
    $this->set_ok ();
    return true;
}

function check_duplicated ($Owner, $break_tab)
{
    if (!$this->duplicated)
    {
	$this->set_ok ();
	return true;
    }
    
    $db = new Database ($Owner, true);
    if (!$db->link) return;
    
    if (!$db->multi_query (' SELECT ' . $this->field .
                           ' FROM ' . $this->table .
                           ' WHERE ' . $this->field .
                           " LIKE '" . $this->text . "'" .
                           ' AND ' . $GLOBALS ['XMONEY_FIELD'] . ' != ' . $GLOBALS ['XMONEY_FIELD_ID'])) return;
    
    if ($db->line ())
    {
	if ($break_tab) $this->entry->grab_focus ();
	$this->set_warning ();
	return;
    }
    
    $this->set_bg ('white');
    $this->set_ok ();
    return true;
}

function set_focus ()
{
    $this->entry->grab_focus ();
}

function set_next_focus ($focus)
{
    EntrySetNextFocus ($this->entry, $focus);
}

}; // TEntry


class AEntry extends TEntry
{

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{
    parent::__construct ($required, $duplicated, $table, $field);
    
    $this->entry->set_max_length (50);
    
    $this->entry->connect ('changed', array ($this, '__aentry_changed'));
}

function __aentry_changed ($entry)
{
    for ($i = 0; $i < $this->length; $i ++)
    {
	$key = ord ($letter = substr ($this->text, $i, 1));
	
	if ($key == 32 /* Space */
	    || $key == 37 /* % */
	    || $key == 44 /* , */
	    || $key == 45 /* - */
	    || $key == 46 /* . */
	    || $key == 47 /* / */
	    || ($key >= 48 && $key <= 57) /* 0 - 9 */
	    || $key == 64 /* @ */
	    || ($key >= 65 && $key <= 90) /* A - Z */
	    || ($key == 95) /* _ */
	    || ($key >= 97 && $key <= 122) /* a - z */
	    || $key == 231 /* ç */
	    || $key == 199) /* Ç */
	    $text = $text . $letter;
    }
    
    $this->set_text ($text);
}

}; // AEntry


class IEntry extends TEntry
{

var $no_space, $extra_key;

function __construct ($required = false, $duplicated = false, $table = null, $field = null)
{    
    parent::__construct ($required, $duplicated, $table, $field);
    
    $this->entry->set_max_length (11);
    $this->no_space = 1;
    
    $this->entry->connect ('changed', array ($this, '__ientry_changed'));
}

function __ientry_changed ($entry)
{
    for ($i = 0; $i < $this->length; $i ++)
    {
	$key = ord ($letter = substr ($this->text, $i, 1));
	
	if ($key == $this->extra_key
	    /* || $key == $this->extra_key2 */
	    || ($key == 32 && !$this->no_space)
	    || ($key >= 48 && $key <= 57)) /* only numbers */
	    $text = $text . $letter;
    }
    
    $this->set_text ($text);
}

}; // IEntry

?>
