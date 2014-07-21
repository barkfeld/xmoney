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

class TSobre extends GtkAboutDialog
{

function __construct ()
{
    parent::__construct ();
    $this->set_transient_for ($GLOBALS ['XMONEY_JANELA_PRINCIPAL']);
    $this->set_modal (true);
    
    $this->set_icon (GdkPixbuf::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png'));
    $this->set_logo (GdkPixbuf::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png'));
    
    $this->set_name (XMONEY_TITULO);
    $this->set_version (XMONEY_DESC_VERSAO);
    $this->set_comments (XMONEY_DESCRICAO);
    $this->set_copyright (XMONEY_COPYRIGHT);
    
    $this->set_license (latin1 (file_get_contents (XMONEY_LICENCA)));
    $this->set_authors (array (file_get_contents (XMONEY_AUTORES)));
    
    $this->set_url_hook (array ($this, 'site_clicked'));
    $this->set_email_hook (array ($this, 'email_clicked'));
    $this->set_website ('http://www.gamuza.com.br/xmoney');
    $this->set_website_label ('Website do X-Money');
    
    // Maybe a Bug???
    foreach ($this->action_area as $child)
    {
	if ($child instanceof GtkButton) $child->connect ('clicked', array ($this, 'close_event'));
    }
}

function close_event ()
{
    $this->destroy ();
}

function site_clicked ($about, $address)
{
    printf ("Lançando [%s]\n", $address);
}

function email_clicked ($about, $address)
{
    $mail_to = 'mailto:' . $address . '?subject=Referente ao X-Money';
    printf ("Lançando [%s]\n", $mail_to);
    
    system ($GLOBALS ['MAIL_VIEWER'] . ' ' . $mail_to, $result);
    if ($result != 0) new Message ($this->Owner, latin1 ('Ops! Não consegui executar o seu cliente de e-mail!'), Gtk::MESSAGE_ERROR);
}

}; // TSobre

?>
