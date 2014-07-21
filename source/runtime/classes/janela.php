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

class TJanela extends GtkWindow
{

function __construct ($titulo, $width, $height, $icone)
{
    parent::__construct ();
    
    $this->set_transient_for ($GLOBALS ['XMONEY_JANELA_PRINCIPAL']);
    $this->set_modal (true);
    $this->set_title ($titulo);
    $this->set_border_width (5);
    
    if ($width && $height) $this->set_default_size ($width, $height);
    else $this->set_resizable (false);
    
    $this->set_position (Gtk::WIN_POS_CENTER);
    $this->set_icon_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $icone);
    
    // accelgroup
    $this->add_accel_group ($this->accel_group = new GtkAccelGroup);
    
    // default_container
    $this->add ($this->main_vbox = new GtkVBox);
    $this->main_vbox->show ();
}

function pack_start ($widget, $expand = true)
{
    $this->main_vbox->pack_start ($widget, $expand);
}

function children_show_all ()
{
    $this->main_vbox->show_all ();
}

function check_dados ($instance = null)
{
    $result = true;
    
    $entry_class = 'TEntry';
    foreach ($this as $child)
    {
	if ($child instanceof $entry_class)
	{
	    if (!$child->check_required (true))
	    {
		new Message ($this, latin1 ('Ops! Este campo é requerido!'), Gtk::MESSAGE_WARNING);
		$result = false;
		break;
	    }
	    
	    if (!$child->check_duplicated ($this, true))
	    {
		new Message ($this, latin1 ('Ops! Já existe um registro com o mesmo valor deste campo!'), Gtk::MESSAGE_WARNING);
		$result = false;
		break;
	    }
	}
    }
    
    return $result;
}

}; // TJanela

?>
