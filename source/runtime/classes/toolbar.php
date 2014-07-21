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

class TToolbar extends GtkToolbar
{

function __construct ()
{
    parent::__construct ();
    
    $this->set_toolbar_style (Gtk::TOOLBAR_BOTH);
}

function append ($icon, $label, $index, $callback = null)
{
    $button = new GtkToolButton (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $icon), $label);
    $this->add ($button);
    
    $button->set_visible_horizontal (true);
    $button->set_visible_vertical (true);
    
    if ($callback) $button->connect ('clicked', $callback);
    
    return $button;
}

function append_stock ($stock, $index, $callback = null)
{
    $button = GtkToolButton::new_from_stock ($stock);
    $this->add ($button);
    
    $button->set_visible_horizontal (true);
    $button->set_visible_vertical (true);
    
    if ($callback) $button->connect ('clicked', $callback);
    
    return $button;
}

}; // TToolbar

?>
