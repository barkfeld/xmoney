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

require_once 'classes/float.php';
require_once 'classes/janela.php';

class TEditaCliente extends TJanela
{

/*
 * $Operacao:
 *  i => Incluir
 *  a => Alterar
 */
function __construct ($Parent, $operacao = 'i', $CodCli = null)
{
    parent::__construct ($operacao == 'i' ? 'Cliente - Incluir' : 'Cliente - Alterar',
			 null, null, 'clientes.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodCli = $CodCli;
    
    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Cli';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodCli ? $CodCli : -1;
    
    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodCli . '</b>');
    }
    
    // Pessoa Fisica/Juridica
    $hbox->pack_start ($this->pessoa = new TTipoPessoa ($this), false);
    $this->pessoa->combobox->connect ('changed', array ($this, 'tipo_pessoa_changed'));
    
    // nome / razao social
    $this->pack_start ($frame = new GtkFrame);
    $frame->add ($vbox = new GtkVBox);
    $vbox->pack_start ($hbox = new GtkHBox);
    
    $hbox->pack_start ($this->lbl_nome = new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Clientes', 'Nome'));
    
    // CPF / CNPJ
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start ($this->lbl_cpf = new GtkLabel (' CPF:  '), false);
    $hbox->pack_start ($this->cpf = new AEntry (true, true, 'Tb_Clientes', 'CPF'));
    
    // Dados para Pessoa Juridica
    $vbox->pack_start ($this->expander = new GtkExpander (' Juridico '), false);
    $this->expander->set_sensitive (false);
    $this->expander->add ($vbox = new GtkVBox);
    
    // fantasia
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Fantasia: '), false);
    $hbox->pack_start ($this->fantasia = new AEntry);
    
    // I.E.
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' I.E.: '), false);
    $hbox->pack_start ($this->ie = new AEntry);
    
    // Suframa
    $hbox->pack_start (new GtkLabel (' Suframa: '), false);
    $hbox->pack_start ($this->suframa = new IEntry);
    
    /* Fones */
    $this->pack_start ($frame = new GtkFrame);
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    
    // fone 1
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Fone: '), false);
    $hbox->pack_start ($this->fone = new AEntry);
    
    // fone 2
    $hbox->pack_start (new GtkLabel (' Fone 2: '), false);
    $hbox->pack_start ($this->fone2 = new AEntry);
    
    // fax 1
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Fax: '), false);
    $hbox->pack_start ($this->fax = new AEntry);
    
    // fax 2
    $hbox->pack_start (new GtkLabel (' Fax 2: '), false);
    $hbox->pack_start ($this->fax2 = new AEntry);
    
    // email
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' e-mail: '), false);
    $hbox->pack_start ($this->email = new AEntry);
    
    // site
    $hbox->pack_start (new GtkLabel (' Site: '), false);
    $hbox->pack_start ($this->site = new AEntry);
    
    // anotacoes
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (latin1 (' Anotações: ')), false);
    $hbox->pack_start ($this->anotacoes = new AEntry);
    
    // limite venda
    $this->pack_start ($frame = new GtkFrame);
    $frame->add ($vbox = new GtkVBox);
    $vbox->pack_start ($hbox = new GtkHBox);
    $vbox->set_border_width (5);
    
    $hbox->pack_start ($this->limite_venda = new TFloat, false);
    $this->limite_venda->label->set_text (' Limite de Venda: ');
    // Ativo
    $hbox->pack_start ($this->ativo = new GtkCheckButton (' Ativo '));
    
    // ok + cancelar
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
    
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-apply'), false);
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    // extra
    $this->limite_venda->set_next_focus ($this->ok);
    $this->children_show_all ();
    $this->nome->set_focus ();
}

function tipo_pessoa_changed ($list)
{
    $tipo = $this->pessoa->store->get_value ($this->pessoa->combobox->get_active_iter (), 1);
    
    if (!strcmp ($tipo, "JR")) /* Juridica */
    {
	$this->expander->set_sensitive (true);
	$this->expander->set_expanded (true);
	$this->lbl_nome->set_text (latin1 (' Razão: '));
	$this->lbl_cpf->set_text (' CNPJ: ');
	$this->fantasia->set_focus ();
    }
    else /* Fisica */
    {
	$this->expander->set_expanded (false);
	$this->expander->set_sensitive (false);
	$this->lbl_nome->set_text (' Nome: ');
	$this->lbl_cpf->set_text (' CPF: ');
	$this->nome->set_focus ();
    }
}

function ok_clicked ($button)
{
    if ($this->grava_dados ())
    {
	$this->Parent->pega_dados ();
	
	if ($this->operacao == 'i') $this->limpa_campos ();
	else $this->destroy ();
    }
}

function cancelar_clicked ($button)
{
    $this->destroy ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $nome = $this->nome->get_text ();
    $cpf = $this->cpf->get_text ();
    $fantasia = $this->fantasia->get_text ();
    $ie = $this->ie->get_text ();
    $suframa = $this->suframa->get_text ();
    
    $fone = $this->fone->get_text ();
    $fone2 = $this->fone2->get_text ();
    $fax = $this->fax->get_text ();
    $fax2 = $this->fax2->get_text ();
    $email = $this->email->get_text ();
    $url = $this->site->get_text ();
    $anotacoes = $this->anotacoes->get_text ();
    
    $limite_venda = $this->limite_venda->get_text ();
    $ativo = $this->ativo->get_active ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Cliente_Inc';
    else $sql = 'call SP_Cliente_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodCli) . ',' .
	    String ($this->pessoa->CodTipoPessoa) . ',' .
            String ($nome) . ',' . 
            String ($cpf) . ',' .
            String ($fantasia) . ',' .
            String ($ie) . ',' .
            String ($suframa) . ',' .
            String ($fone) . ',' .
            String ($fone2) . ',' .
            String ($fax) . ',' .
            String ($fax2) . ',' .
            String ($email) . ',' .
            String ($url) . ',' .
	    String ($anotacoes) . ',' .
	    String (CommaToPoint ($limite_venda)) . ',' .
	    String ($ativo) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_Clientes WHERE Id = ' . $this->CodCli)) return;
    
    if (!$line = $db->line ()) return;
    
    $this->pessoa->combobox->set_active_iter ($this->pessoa->it [$line ['CodTipo']]);
    
    $this->nome->set_text ($line ['Nome']);
    $this->cpf->set_text ($line ['CPF']);
    
    $this->fantasia->set_text ($line ['Fantasia']);
    $this->ie->set_text ($line ['IE']);
    $this->suframa->set_text ($line ['Suframa']);
    
    $this->fone->set_text ($line ['Fone']);
    $this->fone2->set_text ($line ['Fone2']);
    $this->fax->set_text ($line ['Fax']);
    $this->fax2->set_text ($line ['Fax2']);
	
    $this->email->set_text ($line ['Email']);
    $this->site->set_text ($line ['URL']);
    $this->anotacoes->set_text ($line ['Anotacoes']);
    
    $this->limite_venda->set_text (PointToComma ($line ['LimiteVenda']));
    $this->ativo->set_active ($line ['Ativo']);
    
    return true;
}

function limpa_campos ()
{
    $this->nome->set_text ('');
    $this->cpf->set_text ('');
    $this->fantasia->set_text ('');
    $this->ie->set_text ('');
    $this->suframa->set_text ('');
    
    $this->fone->set_text ('');
    $this->fone2->set_text ('');
    $this->fax->set_text ('');
    $this->fax2->set_text ('');
    $this->email->set_text ('');
    $this->site->set_text ('');
    $this->anotacoes->set_text ('');
    $this->limite_venda->set_text ('');
    
    $this->nome->set_focus ();
}

}; // TEditaCliente

?>
