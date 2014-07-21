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

class TEditaEndTransportadora extends TJanela
{

/*
 * $Operacao
 *  i => incluir
 *  a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodTrans, $CodId = null)
{
    parent::__construct ($operacao == 'i' ? latin1 ('Novo endereço') : latin1 ('Alterar endereço'),
                         null, null, 'enderecos.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodTrans = $CodTrans;
    $this->CodId = $CodId;
    
    // Id e Tipo
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $this->CodId . '</b>');
    }
    $hbox->pack_start ($this->tipo = new TTipoEndereco ($this));
    
    // endereco
    $this->pack_start ($frame = new GtkFrame);
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel ('Endereco: '), false);
    $hbox->pack_start ($this->endereco = new AEntry (true));
    
    // cep
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel ('CEP: '), false);
    $hbox->pack_start ($this->cep = new AEntry (true));
    
    // bairro
    $hbox->pack_start (new GtkLabel ('Bairro: '), false);
    $hbox->pack_start ($this->bairro = new AEntry (true));
    
    // cidade
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel ('Cidade: '), false);
    $hbox->pack_start ($this->cidade = new AEntry (true));
    
    // estado
    $hbox->pack_start ($this->estado = new TEstados ($this));
    
    // contato
    $this->pack_start ($frame = new GtkFrame);
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel ('Contato: '), false);
    $hbox->pack_start ($this->contato = new AEntry);
    
    // fone
    $hbox->pack_start (new GtkLabel ('Fone: '), false);
    $hbox->pack_start ($this->fone = new AEntry);
    
    // referencia
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (latin1 ('Referência: ')), false);
    $hbox->pack_start ($this->referencia = new AEntry);
    
    // ok e cancelar
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
    
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->referencia->set_next_focus ($this->ok);
    $this->children_show_all ();
    $this->endereco->set_focus ();
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
    $this->endereco->set_text ('');
    $this->cep->set_text ('');
    $this->bairro->set_text ('');
    $this->cidade->set_text ('');
    $this->contato->set_text ('');
    $this->fone->set_text ('');
    $this->referencia->set_text ('');
    $this->endereco->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $endereco = $this->endereco->get_text ();
    $bairro = $this->bairro->get_text ();
    $cep = $this->cep->get_text ();
    $cidade = $this->cidade->get_text ();
    $contato = $this->contato->get_text ();
    $fone = $this->fone->get_text ();
    $referencia = $this->referencia->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_End_Transportadora_Inc';
    else $sql = 'call SP_End_Transportadora_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodId) . ',' .
	    String ($this->CodTrans) . ',' .
	    String ($this->tipo->CodTipoEndereco) . ',' .
            String ($endereco) . ',' . 
            String ($cep) . ',' .
            String ($bairro) . ',' .
            String ($cidade) . ',' .
            String ($this->estado->CodEstado) . ',' .
            String ($contato) . ',' .
            String ($fone) . ',' .
            String ($referencia) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';

    if (!$db->multi_query ($data)) return;
    
    if (!$line = $db->line ()) return;
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_End_Transportadoras WHERE Id = ' . $this->CodId)) return;
    
    if (!$line = $db->line ()) return;
    
    $this->tipo->combobox->set_active_iter ($this->tipo->it [$line ['CodTipo']]);
    $this->endereco->set_text ($line ['Endereco']);
    $this->cep->set_text ($line ['CEP']);
    $this->bairro->set_text ($line ['Bairro']);
    $this->cidade->set_text ($line ['Cidade']);
    $this->estado->combobox->set_active_iter ($this->estado->it [$line ['CodEstado']]);
    $this->contato->set_text ($line ['Contato']);
    $this->fone->set_text ($line ['Fone']);
    $this->referencia->set_text ($line ['Referencia']);
    
    return true;
}

}; // TEditaEndTransportadora

?>
