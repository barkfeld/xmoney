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

class TEditaFilial extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodFilial = null)
{
    parent::__construct ($operacao == 'i' ? 'Filial - Incluir' : 'Filial - Alterar',
                         null, null, 'filiais.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodFilial = $CodFilial;
    
    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Filial';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodFilial ? $CodFilial : -1;

    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodFilial . '</b>');
    }
    
    // nome
    $this->pack_start ($frame = new GtkFrame (latin1 (' Informações ')), false);
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Filiais', 'Nome'));
    
    // cnpj
    $hbox->pack_start (new GtkLabel (' CNPJ: '), false);
    $hbox->pack_start ($this->cnpj = new IEntry (true, true, 'Tb_Filiais', 'CNPJ'));
    $this->cnpj->entry->set_max_length (14);
    
    // razao
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (latin1 (' Razão: ')), false);
    $hbox->pack_start ($this->razao = new AEntry (true, true, 'Tb_Filiais', 'Razao'));
    
    // endereço
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (latin1 (' Endereço: ')), false);
    $hbox->pack_start ($this->endereco = new AEntry (true));
    
    // cep
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' CEP: '), false);
    $hbox->pack_start ($this->cep = new IEntry (true));
    
    // bairro
    $hbox->pack_start (new GtkLabel (' Bairro: '), false);
    $hbox->pack_start ($this->bairro = new AEntry (true));
    
    // cidade
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Cidade: '), false);
    $hbox->pack_start ($this->cidade = new AEntry (true));
    
    // estado
    $hbox->pack_start ($this->estado = new TEstados ($this));
    
    // telefone
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Telefone: '), false);
    $hbox->pack_start ($this->tel = new IEntry (true));
    
    // fax
    $hbox->pack_start (new GtkLabel (' Fax: '), false);
    $hbox->pack_start ($this->fax = new IEntry);
    
    // Email
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' e-mail: '), false);
    $hbox->pack_start ($this->email = new AEntry (true));
    
    // url
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Site: '), false);
    $hbox->pack_start ($this->url = new AEntry);
    
    // dominio
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (latin1 (' Domíio: ')), false);
    $hbox->pack_start ($this->dominio = new AEntry);
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
     
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->dominio->focus_widget = $this->ok;
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->children_show_all ();
    $this->dominio->set_next_focus ($this->ok);
    $this->nome->grab_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ())
    {
	if ($this->Parent) $this->Parent->pega_dados ();
	
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
    
    if (!$db->multi_query ('SELECT * FROM Vw_Filiais WHERE Id = ' . $this->CodFilial)) return;
    
    if ($line = $db->line ())
    {
	$this->nome->set_text ($line ['Nome']);
	$this->razao->set_text ($line ['Razao']);
	$this->cnpj->set_text ($line ['Cnpj']);
	$this->endereco->set_text ($line ['Endereco']);
	$this->bairro->set_text ($line ['Bairro']);
	$this->cep->set_text ($line ['CEP']);
	$this->cidade->set_text ($line ['Cidade']);
	$this->estado->combobox->set_active_iter ($this->estado->it [$line ['CodEstado']]);
	$this->tel->set_text ($line ['Tel']);
	$this->fax->set_text ($line ['Fax']);
	$this->email->set_text ($line ['Email']);
	$this->url->set_text ($line ['URL']);
	$this->dominio->set_text ($line ['Dominio']);
	
	return true;
    }
}

function limpa_dados ()
{
    $this->nome->set_text ('');
    $this->razao->set_text ('');
    $this->cnpj->set_text ('');
    $this->endereco->set_text ('');
    $this->bairro->set_text ('');
    $this->cidade->set_text ('');
    $this->cep->set_text ('');
    $this->tel->set_text ('');
    $this->fax->set_text ('');
    $this->email->set_text ('');
    $this->url->set_text ('');
    $this->dominio->set_text ('');
    $this->nome->entry->grab_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $nome = $this->nome->get_text ();
    $cnpj = $this->cnpj->get_text ();
    $razao = $this->razao->get_text ();
    $endereco = $this->endereco->get_text ();
    $bairro = $this->bairro->get_text ();
    $cep = $this->cep->get_text ();
    $cidade = $this->cidade->get_text ();
    $tel = $this->tel->get_text ();
    $fax = $this->fax->get_text ();
    $email = $this->email->get_text ();
    $url = $this->url->get_text ();
    $dominio = $this->dominio->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Filial_Inc';
    else $sql = 'call SP_Filial_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodFilial) . ',' .
	    String ($this->estado->CodEstado) . ',' .
            String ($nome) . ',' . 
            String ($cnpj) . ',' .
            String ($razao) . ',' .
            String ($endereco) . ',' .
            String ($bairro) . ',' .
            String ($cep) . ',' .
            String ($cidade) . ',' .
            String ($tel) . ',' .
            String ($fax) . ',' .
            String ($email) . ',' .
            String ($url) . ',' .
	    String ($dominio) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

}; // TEditaFilial

?>
