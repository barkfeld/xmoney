<?php

/*
 * X-Money: Gestao Empresarial Integrada
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

require_once 'notebook_page.php';

class TNotebook extends GtkNotebook
{

function __construct ($Owner)
{
    parent::__construct ();
    
    $this->set_scrollable (true);
    $this->popup_enable ();
    $this->Owner = $Owner;
    
    $this->append_background ();
}

function close_button ($button, $data)
{
    $this->set_current_page ($data);
    
    if ($this->get_n_pages ()) $this->remove_page ($this->get_current_page ());
    
    if (!$this->get_n_pages ()) $this->append_background ();
}

function xmoney_close_clicked ()
{
    $dialog = new Question ($this->Owner, 'Sair do X-Money?');
    $result = $dialog->ask ();
    if ($result != Gtk::RESPONSE_YES) return;
    
    Gtk::main_quit ();
}

function append ($page)
{
    $this->remove_background ();
    
    $page->Parent = $this;
    $page->Owner = $this->Owner;
    
    // Icone + Rotulo
    $guide = new GtkHBox;
    if ($page->Icon) $guide->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $page->Icon), false);
    $guide->pack_start (new GtkLabel (' ' . $page->Title . ' '));
    
    // Fechar
    $guide->pack_start ($close = new GtkButton);
    $close->set_image (GtkImage::new_from_stock (Gtk::STOCK_CLOSE, Gtk::ICON_SIZE_BUTTON));
    
    $guide->show_all ();
    
    // Guia
    $menu_item = new GtkHBox;
    if ($page->Icon) $menu_item->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $page->Icon), false);
    $menu_item->pack_start (new GtkLabel (' ' . $page->Title . ' '));
    $menu_item->show_all ();
    
    $scroll = new GtkScrolledWindow;
    $scroll->set_policy (Gtk::POLICY_AUTOMATIC, Gtk::POLICY_AUTOMATIC);
    $scroll->add_with_viewport ($page);
    $scroll->show_all ();
    
    $current = $this->append_page_menu ($scroll, $guide, $menu_item);
    $this->set_current_page ($current);
    
    // Close signal
    if ($this->background) $close->connect ('clicked', array ($this, 'xmoney_close_clicked'), $current);
    else $close->connect ('clicked', array ($this, 'close_button'), $current);
    
    return $current;
}

function append_background ()
{
    if (!$this->get_n_pages ())
    {
	$this->background = true;
	$this->append ($page = new TNotebookPage ('X-Money', null));
	$page->pack_start ($image = GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'fundo.png'));
	$image->show ();
    }
}

function remove_background ()
{
    if ($this->get_n_pages () == 1 && $this->background)
    {
	$this->remove_page ($this->get_current_page ());
	$this->background = false;
    }
}

}; // TNotebook

?>
