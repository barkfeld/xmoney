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

require_once 'painel.php';
require_once 'versao.php';
require_once 'classes/janela.php';
require_once 'classes/notebook.php';

class TJanelaPrincipal extends TJanela
{

function __construct ()
{
    parent::__construct (XMONEY_TITULO . ' - ' . XMONEY_DESCRICAO . ' - ' . XMONEY_DESC_VERSAO,
                         800, 600, 'logo.png');
    
    $this->connect ('delete_event', array ($this, delete_event));
    
    // Painel
    $this->pack_start ($hpaned = new GtkHPaned);
    $hpaned->pack1 ($this->painel = new TPainel ($this), false, true);
    
    // Notebook
    $hpaned->pack2 ($this->notebook = new TNotebook ($this), true, true);
    
    // status
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($filial = new GtkLabel);
    $filial->set_markup ('<b> Filial: </b>' . $GLOBALS ['Filial']);
    $hbox->pack_start ($usuario = new GtkLabel);
    $usuario->set_markup ('<b>' . latin1 (' Usuário: ') . '</b>' . $GLOBALS ['Usuario']);
    $hbox->pack_start ($nome = new GtkLabel);
    $nome->set_markup ('<b> Nome: </b>' . $GLOBALS ['Nome']);
    $hbox->pack_start ($this->data = new GtkLabel);
    
    $this->children_show_all ();
    
    Gtk::timeout_add (1000, array ($this, 'data_timeout'));
    
    define ('XMONEY_JANELA_PRINCIPAL', $this);
}

function data_timeout ()
{
    $this->data->set_markup ('<b>' . latin1 (strftime ('%c')) . '</b>');
    
    return true;
}

function delete_event ()
{
    $dialog = new Question ($this->Owner, 'Sair do X-Money?');
    $result = $dialog->ask ();
    if ($result == Gtk::RESPONSE_YES) exit (0);
    else return true;
}

}; // TJanelaPrincipal

function ExecJanelaPrincipal ()
{
    $GLOBALS ['XMONEY_JANELA_PRINCIPAL'] = $principal = new TJanelaPrincipal;
    $principal->show ();
    $principal->maximize ();
}

?>
