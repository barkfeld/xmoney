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

class TEstornaContaReceber extends TJanela
{

function __construct ($Parent, $CodId)
{
    parent::__construct ('Estornar Conta a Receber', 400, -1, 'contas_receber.png');
    
    $this->Parent = $Parent;
    $this->CodId = $CodId;
    
    // Id.
    $this->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (GtkImage::new_from_stock (Gtk::STOCK_CANCEL, Gtk::ICON_SIZE_DIALOG), false);
    $hbox->pack_start ($label = new GtkLabel, false);
    $label->set_markup (' Cod. Id.: <b>' . $CodId . '</b>');
    
    // anotacoes
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (latin1 (' Anotações: ')), false);
    
    $hbox->pack_start ($this->anotacoes = new AEntry (true));
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
     
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->anotacoes->focus_widget = $this->ok;
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->children_show_all ();
    $this->anotacoes->grab_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ()) $this->destroy ();
}

function cancelar_clicked ()
{
    $this->destroy ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $anotacoes = $this->anotacoes->get_text ();
    
    $sql = 'call SP_Mov_Conta_Receber_Del';
    $data = $sql . '(' .
	    String ($this->CodId) . ',' .
	    String ($anotacoes) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    if (!($line = $db->line ())) return;
    
    $db->free_result ();
    
    $this->Parent->pega_dados_mov ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

}; // TEstornaContaReceber

?>
