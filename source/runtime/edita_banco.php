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

require_once 'classes/filiais.php';
require_once 'classes/janela.php';

class TEditaBanco extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodBanco = null)
{
    parent::__construct ($operacao == 'i' ? 'Bancos - Incluir' : 'Bancos - Alterar',
                         null, null, 'bancos.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodBanco = $CodBanco;

    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Banco';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodBanco ? $CodBanco : -1;
    
    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodBanco . '</b>');
    }
    
    // Filial
    $hbox->pack_start ($this->filial = new TFiliais ($this));
    
    // nome
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Bancos', 'Nome'));
    
    // agencia
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Agencia: '), false);
    $hbox->pack_start ($this->agencia = new AEntry (true, true, 'Tb_Bancos', 'Agencia'));
    
    // conta
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Conta: '), false);
    $hbox->pack_start ($this->conta = new AEntry (true, true, 'Tb_Bancos', 'Conta'));
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
     
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->conta->focus_widget = $this->ok;
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->conta->set_next_focus ($this->ok);
    $this->children_show_all ();
    $this->nome->set_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ())
    {
	$this->Parent->pega_dados ();
	
	if ($this->operacao == 'i' ) $this->limpa_dados ();
	else $this->destroy ();
    }
}

function cancelar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_Bancos WHERE Id = ' . $this->CodBanco)) return;
    
    if ($line = $db->line ())
    {
	$this->nome->set_text ($line ['Nome']);
	$this->agencia->set_text ($line ['Agencia']);
	$this->conta->set_text ($line ['Conta']);
	$this->filial->combobox->set_active_iter ($this->filial->it [$line ['CodFilial']]);
	
	return true;
    }
}

function limpa_dados ()
{
    $this->nome->set_text ('');
    $this->agencia->set_text ('');
    $this->conta->set_text ('');
    $this->nome->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    if ($this->operacao == 'a') $id = $this->id->get_text ();
    $nome = $this->nome->get_text ();
    $agencia = $this->agencia->get_text ();
    $conta = $this->conta->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Banco_Inc';
    else $sql = 'call SP_Banco_Alt';
    
    $data = $sql . '(' .
	    String ($id) . ',' .
            String ($nome) . ',' . 
            String ($agencia) . ',' .
	    String ($conta) . ',' .
	    String ($this->filial->CodFilial) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
	$line = $db->line ();
	
	$db->free_result ();

	new Message ($this, $line ['Mensagem']);
	
	return true;
}

}; // TEditaBanco


?>
