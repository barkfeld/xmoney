<?php

/*
 * X-Money - Gestao Empresarial Integrada
 *
 * Copyright (C) 2010 - Eneias Ramos de Melo <neneias@gmail.com>
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

class Message extends GtkMessageDialog
{

function __construct ($Owner, $text, $type = Gtk::MESSAGE_INFO, $buttons = Gtk::BUTTONS_OK)
{
    parent::__construct ($Owner,
		         Gtk::DIALOG_MODAL,
			 $type,
			 $buttons,
			 $text);
    $this->set_title ('X-Money - Mensagem');
    $this->set_transient_for ($Owner);
    $this->set_position (GTK_WIN_POS_CENTER);
    $this->set_icon_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png');
    
    parent::run();
    parent::destroy();
}

} // Message


class Question extends GtkMessageDialog
{

function __construct ($Owner, $text, $type = Gtk::MESSAGE_QUESTION, $buttons = Gtk::BUTTONS_YES_NO)
{
    parent::__construct ($Owner,
                         Gtk::DIALOG_MODAL,
			 $type,
			 $buttons,
			 $text);
    $this->set_title ('X-Money - Pergunta');
    $this->set_transient_for ($Owner);
    $this->set_position (GTK_WIN_POS_CENTER);
    $this->set_icon_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png');
}

function ask ()
{
    $response = parent::run();
    parent::destroy ();
    
    return $response;
}

} // Question

?>
