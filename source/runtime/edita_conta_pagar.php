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

require_once 'classes/fornecedores.php';

class TEditaContaPagar extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodConta = null)
{
    parent::__construct ($operacao == 'i' ? 'Contas a Pagar - Incluir' : 'Contas a Pagar - Alterar',
                         null, null, 'contas_pagar.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodConta = $CodConta;
    
    // tipo doc.
    $this->pack_start ($this->tipo_doc = new TTipoDoc ($this));
    
    // filial
    $this->pack_start ($this->filial = new TFiliais ($this));
    
    // Fornecedor
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->fornecedores = new TFornecedores ($this));
    
    // num doc
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->num_doc = new AEntry (true));
    $this->num_doc->label->set_text (' Num. Doc.: ');
    
    // parcela
    $hbox->pack_start ($this->parcela = new IEntry (true));
    $this->parcela->label->set_text (' Parcela: ');
    
    // vencimento
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->vencimento = new TData (true));
    $this->vencimento->label->set_text (' Vencimento: ');
    
    // valor
    $hbox->pack_start ($this->valor = new TFloat (true));
    $this->valor->label->set_text (' Valor: ');
    
    // anotacoes
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->anotacoes = new AEntry);
    $this->anotacoes->label->set_text (latin1 (' Anotações '));
    
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
    
    // extra
    $this->children_show_all ();
    $this->anotacoes->set_next_focus ($this->ok);
    $this->fornecedores->entry->grab_focus ();
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

function limpa_dados ()
{
    $this->fornecedores->entry->set_text ('');
    $this->num_doc->set_text ('');
    $this->parcela->set_text ('');
    $this->vencimento->set_text ('');
    $this->valor->set_text ('');
    $this->anotacoes->set_text ('');
    $this->fornecedores->entry->grab_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $num_doc = $this->num_doc->get_text ();
    $parcela = $this->parcela->get_text ();
    $vencimento = CDate ($this->vencimento->get_text ());
    $valor = CommaToPoint ($this->valor->get_text ());
    $anotacoes = $this->anotacoes->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Conta_Pagar_Inc';
    else $sql = 'call SP_Conta_Pagar_Alt';
    
    $data = $sql . '(' .
	    String ($this->tipo_doc->CodTipoDoc) . ',' .
	    String ($this->filial->CodFilial) . ',' .
	    String ($this->fornecedores->CodFornecedor) . ',' .
	    String ($num_doc) . ',' .
	    String ($parcela) . ',' .
	    String ($vencimento) . ',' .
	    String ($valor) . ',' .
	    String ($anotacoes) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

}; // TEditaContaPagar

?>
