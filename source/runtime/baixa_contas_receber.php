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

class TBaixaContasReceber extends TJanela
{

function __construct ($Parent, $InfoLinha)
{
    parent::__construct ('Contas a Receber - Baixar', 800, 480, 'contas_receber.png');
    
    $this->Parent = $Parent;
    $this->InfoLinha = $InfoLinha;
    
    // info
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (GtkImage::new_from_stock (Gtk::STOCK_GO_DOWN, Gtk::ICON_SIZE_DIALOG), false);
    $hbox->pack_start ($label = new GtkLabel, false);
    $label->set_markup ('<b> Todos os totais devem estar preenchidos! </b>');
    $hbox->pack_start ($frame = new GtkFrame (latin1 (' Informações ')));
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    
    // banco
    $vbox->pack_start ($this->banco = new TBancos ($this));
    
    // tipo de despesa
    $vbox->pack_start ($this->despesa = new TTipoDespesa ($this));
    
    // forma pgto
    $vbox->pack_start ($this->forma_pgto = new TFormaPgto ($this));
    
    // Contas
    $this->pack_start ($frame = new GtkFrame (' Contas a Receber '));
    $frame->add ($scroll = new GtkScrolledWindow);
    $scroll->set_border_width (5);
    $scroll->set_policy (GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);
    $scroll->add_with_viewport ($vbox = new GtkVBox);
    $vbox->pack_start ($this->lista = new GtkTable (count ($InfoLinha) + 1, 8, false), false);
    $this->lista->attach ($label = new GtkLabel, 0,1,0,1);
    $label->set_markup ('<b>Id</b>');
    $this->lista->attach ($label = new GtkLabel, 1,2,0,1);
    $label->set_markup ('<b>Fornecedor</b>');
    $this->lista->attach ($label = new GtkLabel, 2,3,0,1);
    $label->set_markup ('<b>Num. do Doc.</b>');
    $this->lista->attach ($label = new GtkLabel, 3,4,0,1);
    $label->set_markup ('<b>Valor em R$</b>');
    $this->lista->attach ($label = new GtkLabel, 4,5,0,1);
    $label->set_markup ('<b>Juros em R$</b>');
    $this->lista->attach ($label = new GtkLabel, 5,6,0,1);
    $label->set_markup ('<b>Desconto em R$</b>');
    $this->lista->attach ($label = new GtkLabel, 6,7,0,1);
    $label->set_markup ('<b>Total em R$</b>');
    $this->lista->attach ($label = new GtkLabel, 7,8,0,1);
    $label->set_markup ('<b>' . latin1 ('Anotações') . '</b>');
    $vbox->pack_start (new GtkEventBox);
    
    // Valores R$
    $this->pack_start ($frame = new GtkFrame (' Valores em R$ '), false);
    $frame->add ($vbox = new GtkVBox);
    
    // Valor das Contas
    $vbox->pack_start ($this->lbl_valor_contas = new GtkLabel);

    // Valor dos Juros
    $vbox->pack_start ($this->lbl_valor_juros = new GtkLabel);
    
    // Valor das Descontos
    $vbox->pack_start ($this->lbl_valor_descontos = new GtkLabel);

    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
     
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->children_show_all ();
}

function somar_contas ()
{
    $children = $this->lista->get_children ();
    $max = count ($children) / 8;
    
    for ($i = 0; $i < $max - 1; $i ++)
    {
	$juros += CommaToPoint ($children [$i * 8 + 3]->entry->get_text ());
	$descontos += CommaToPoint ($children [$i * 8 + 2]->entry->get_text ());
	$total += CommaToPoint ($children [$i * 8 + 1]->entry->get_text ());
    }
    
    $this->ValorTotal = $total;
    
    $this->lbl_valor_contas->set_markup ('<b>Valor total das faturas: <span color="red">' . PointToComma ($total) . '</span></b>');
    $this->lbl_valor_juros->set_markup ('<b>Valor total dos Juros: <span color="red">' . PointToComma ($juros) . '</span></b>');
    $this->lbl_valor_descontos->set_markup ('<b>Valor total dos Descontos: <span color="red">' . PointToComma ($descontos) . '</span></b>');
    
    return true;
}

function juros_changed ($entry, $data)
{
    $data [2]->entry->set_text ('');
    
    if (($juros = CommaToPoint ($entry->get_text ())) > 0)
    {
	$data [1]->entry->set_text ('');
	$data [2]->entry->set_text (PointToComma ($this->ValorDoc [$data [0]] + $juros));
    }
    else
    {
	$data [2]->entry->set_text (PointToComma ($this->ValorDoc [$data [0]]));
    }
    
    $this->somar_contas ();
}

function desconto_changed ($entry, $data)
{
    $data [2]->entry->set_text ('');
    
    if (($desconto = CommaToPoint ($entry->get_text ())) > 0)
    {
	if ($this->ValorDoc [$data [0]] > $desconto)
	{
	    $data [1]->entry->set_text ('');
	    $data [2]->entry->set_text (PointToComma ($this->ValorDoc [$data [0]] - $desconto));
	}
    }
    else
    {
	$data [2]->entry->set_text (PointToComma ($this->ValorDoc [$data [0]]));
    }
    
    $this->somar_contas ();
}

function ok_clicked ()
{
    if ($this->grava_dados ()) $this->destroy ();
}

function cancelar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Contas_Receber';
    
    $i = 1;
    
    foreach ($this->InfoLinha as $key => $value)
    {
	if (!$db->multi_query ($sql . ' WHERE Id = ' . $key)) return;
	
	$line = $db->line ();
	
	if ($line ['CodSit'] != 1)
	{
	    new Message ($this, 'Selecione somente contas que estao em ABERTO!');
	    return;
	}
	
	$id = $line ['Id'];
	$valor_doc = $line ['ValorDoc'];
	
	$this->ValorDoc [$id] = $valor_doc;
	
	$this->lista->attach (new GtkLabel ($id), 0, 1, $i, $i + 1);
	$this->lista->attach (new GtkLabel ($line ['Cliente']), 1, 2, $i, $i + 1);
	$this->lista->attach (new GtkLabel ($line ['NumDoc']), 2, 3, $i, $i + 1);
	$this->lista->attach (new GtkLabel (PointToComma ($valor_doc)), 3, 4, $i, $i + 1);
	$this->lista->attach ($juros = new TFloat, 4, 5, $i, $i + 1, 0,0,0,0);
	$juros->label->destroy ();
	$this->lista->attach ($desconto = new TFloat, 5, 6, $i, $i + 1, 0,0,0,0);
	$desconto->label->destroy ();
	$this->lista->attach ($total = new TFloat, 6, 7, $i, $i + 1, 0,0,0,0);
	$total->label->destroy ();
	$total->entry->set_editable (false);
	$this->lista->attach ($anotacoes = new AEntry, 7, 8, $i, $i + 1);
	
	$juros->entry->connect ('changed', array ($this, 'juros_changed'), array ($id, $desconto, $total));
	$desconto->entry->connect ('changed', array ($this, 'desconto_changed'), array ($id, $juros, $total));
	
	++ $i;
    }
    
    $anotacoes->focus_widget = $this->ok;
    $this->lista->show_all ();
    
    return true;
}

function grava_dados ()
{
    if ($this->ValorTotal > 0)
    {
	/* WOW! Totais OK! */
    }
    else
    {
	new Message ($this, 'Todos os totais devem estar preenchidos!');
	return;
    }
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $sql = 'call SP_Mov_Conta_Receber_Inc';
    $children = $this->lista->get_children ();
    $max = count ($children) / 8;
    
    $i = 0;
    
    foreach ($this->InfoLinha as $key => $value)
    {
	$anotacoes = $children [$i * 8]->get_text ();
	$total = $children [$i * 8 + 1]->entry->get_text ();
	$desconto = $children [$i * 8 + 2]->entry->get_text ();
	$juros = $children [$i * 8 + 3]->entry->get_text ();
	$id = $children [$i * 8 + 7]->get_text ();
	
	$data = $sql . '(' .
	    String ($key) . ',' .
            String ($this->banco->CodBanco) . ',' .
	    String ($this->despesa->CodTipoDespesa) . ',' .
	    String ($this->forma_pgto->CodFormaPgto) . ',' .
	    String ($juros) . ',' .
	    String ($desconto) . ',' .
	    String ($total) . ',' .
	    String ($anotacoes) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
	
	if (!$db->multi_query ($data)) return;
	
	// Limpa Buffer
	while ($db->line ());
	
	// printf ("%s\n", $line ['Mensagem']);
	
	++ $i;
    }
    
    $this->Parent->pega_dados ();
    new Message ($this, 'Conta(s) a Receber baixada(s) com sucesso!');
    
    return true;
}


}; // TBaixaContasReceber


?>
