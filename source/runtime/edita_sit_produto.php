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

class TEditaSitProduto extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodSit = null)
{
    parent::__construct ($operacao == 'i' ? latin1 ('Situação de Produto - Incluir') : latin1 ('Situação de Produto - Alterar'),
                         null, null, 'sit_produtos.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodSit = $CodSit;

    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Sit';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodSit ? $CodSit : -1;
    
    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodSit . '</b>');
    }
    
    // nome
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Sit_Produtos', 'Nome'));
    
    // abreviacao
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (latin1 (' Abreviação: ')), false);
    $hbox->pack_start ($this->abreviacao = new AEntry (true, true, 'Tb_Sit_Produtos', 'Abreviacao'));
    
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
    $this->abreviacao->set_next_focus ($this->ok);
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
    
    $sql = 'SELECT * FROM Vw_Sit_Produtos';
    
    if (!$db->multi_query ($sql . ' WHERE Id = ' . $this->CodSit)) return;
    
    if ($line = $db->line ())
    {
	$this->nome->set_text ($line ['Nome']);
	$this->abreviacao->set_text ($line ['Abreviacao']);
	
	return true;
    }
}

function limpa_dados ()
{
    $this->nome->set_text ('');
    $this->abreviacao->set_text ('');
    $this->nome->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $nome = $this->nome->get_text ();
    $abreviacao = $this->abreviacao->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Sit_Produto_Inc';
    else $sql = 'call SP_Sit_Produto_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodSit) . ',' .
            String ($nome) . ',' . 
	    String ($abreviacao) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, latin1 ($line ['Mensagem']));
    
    return true;
}

}; // TEditaSitProduto

?>
