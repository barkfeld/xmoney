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

class TEditaUnidCompra extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodUnidade = null)
{
    parent::__construct ($operacao == 'i' ? 'Unidade de Compra - Incluir' : 'Unidade de Compra - Alterar',
                         null, null, 'unid_compras.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodUnidade = $CodUnidade;

    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Unidade';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodUnidade ? $CodUnidade : -1;
    
    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodUnidade . '</b>');
    }
    
    // nome
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Unid_Compras', 'Nome'));
    
    // descricao
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (latin1 (' Descrição: ')), false);
    $hbox->pack_start ($this->descricao = new AEntry (true, true, 'Tb_Unid_Compras', 'Descricao'));
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
    
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    // extra
    $this->children_show_all ();
    $this->descricao->set_next_focus ($this->ok);
    $this->nome->set_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ())
    {
	$this->Parent->pega_dados ();
	
	if ($this->operacao == 'i') $this->limpa_dados ();
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
    
    $sql = 'SELECT * FROM Vw_Unid_Compras';
    
    if (!$db->multi_query ($sql . ' WHERE Id = ' . $this->CodUnidade)) return;
    
    if ($line = $db->line ())
    {
	$this->nome->set_text ($line ['Nome']);
	$this->descricao->set_text ($line ['Descricao']);
	
	return true;
    }
}

function limpa_dados ()
{
    $this->nome->set_text ('');
    $this->descricao->set_text ('');
    $this->nome->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $nome = $this->nome->get_text ();
    $descricao = $this->descricao->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Unid_Compra_Inc';
    else $sql = 'call SP_Unid_Compra_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodUnidade) . ',' .
            String ($nome) . ',' . 
	    String ($descricao) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

}; // TEditaUnidCompra

?>
