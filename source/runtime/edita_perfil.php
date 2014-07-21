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

class TEditaPerfil extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodPerfil = null)
{
    parent::__construct ($operacao == 'i' ? 'Perfis - Incluir' : 'Perfis - Alterar',
                         800, 600, 'perfis.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodPerfil = $CodPerfil;
    
    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Perfil';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodPerfil ? $CodPerfil : -1;
    
    // Id
    $this->pack_start ($hbox = new GtkHBox, false);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodPerfil . '</b>');
    }
    
    // nome
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Perfis', 'Nome'));
    
    // descricao
    $hbox->pack_start (new GtkLabel (latin1 (' Descrição: ')), false);
    $hbox->pack_start ($this->descricao = new AEntry (true, true, 'Tb_Perfis', 'Descricao'));
    
    // Expandir e Sel. Todos
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->expandir = new GtkCheckButton ('Expandir'), false);
    $this->expandir->connect ('toggled', array ($this, 'expandir_toggled'));
    
    $hbox->pack_start ($check = new GtkCheckButton ('Sel. Todos'), false);
    $check->connect ('toggled', array ($this, 'sel_todos_toggled'));
    
    // progresso
    $hbox->pack_start ($this->progresso = new GtkProgressBar);
    
    // Permissoes
    $this->pack_start ($frame = new GtkFrame (latin1 (' Permissões ')));
    $frame->set_border_width (5);
    $frame->add ($scroll_wnd = new GtkScrolledWindow);
    $scroll_wnd->set_border_width (5);
    $scroll_wnd->set_policy (GTK_POLICY_AUTOMATIC, GTK_POLICY_AUTOMATIC);
    $scroll_wnd->add_with_viewport ($this->lista = new GtkVBox);
    
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
    $this->nome->set_focus ();
}

function expandir_toggled ($check)
{
    $children = $this->lista->get_children ();
    
    foreach ($children as $child)
    {
	$child->set_expanded ($check->active);
    }
}

function sel_todos_toggled ($check)
{
    foreach ($this->itens as $key => $value)
    {
	$value->set_active ($check->active);
    }
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

function preenche_itens ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    /*
     * Itens disponiveis
     */
    if (!$db->multi_query ('SELECT * FROM Vw_Itens')) return;
    
    while ($line = $db->line ())
    {
    	$id = $line ['id'];
	$descricao = $line ['Descricao'];
	$cod_menu = $line ['CodMenu'];
	$menu = $line ['Menu'];
	$imagem = $line ['Imagem'];
	$cod_secao = $line ['CodSecao'];
	$secao = latin1 ($line ['Secao']);
	
	// Secao
	if ($this->secoes [$cod_secao] == null)
	{
	    $this->lista->pack_start ($ptr_secao = $this->secoes [$cod_secao] = new GtkExpander (' ' . $secao . ' '), false);
	    $ptr_secao->add (new GtkHBox);
	}
	
	// Menu
	if ($this->menus [$cod_menu] == null)
	{
	    $ptr = $this->menus [$cod_menu] = new GtkFrame (' ' . $menu . ' ');
	    $ptr->set_border_width (5);
	    $ptr->add ($children = new GtkVBox);
	    $children->pack_start (GtkImage::new_from_file ('/usr/share/xmoney/images' . DIRECTORY_SEPARATOR . $imagem));
	    $this->secoes [$cod_secao]->child->pack_start ($ptr, false);
	}
	
	// Item
	if ($this->itens [$id] == null)
	{
	    $ptr = $this->itens [$id] = new GtkCheckButton (' ' . $descricao . ' ');
	    $this->menus [$cod_menu]->child->pack_start ($ptr);
	}
    }
    
    $this->lista->show_all ();
    $this->expandir->set_active (true);
    
    return true;
}

function pega_dados ()
{
    if (!$this->preenche_itens ()) return;
    
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    /*
     * Dados
     */
    if (!$db->multi_query (' SELECT * FROM Vw_Perfis WHERE Id = ' . $this->CodPerfil)) return;
    
    if (!$line = $db->line ()) return;
    
    $this->nome->set_text ($line ['Nome']);
    $this->descricao->set_text ($line ['Descricao']);
    
    /*
     * Permissoes
     */
    if (!$db->multi_query ('SELECT * FROM Vw_Permissoes WHERE CodPerfil = ' . $this->CodPerfil)) return;
    
    while ($line = $db->line ())
    {
    	$cod_item = $line ['CodItem'];
    	
    	$this->itens [$cod_item]->set_active (1);
    }
    
    return true;
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
    
    if ($this->operacao == 'i') $sql = 'call SP_Perfil_Inc';
    else $sql = 'call SP_Perfil_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodPerfil) . ',' .
	    String ($nome) . ',' .
            String ($descricao) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    // Mensagem
    $line = $db->line ();
    $mensagem = $line ['Mensagem'];
    
    if ($this->operacao == 'i')
    {
	$line = $db->line ();
	$CodPerfil = $line ['CodPerfil'];
    }
    
    // limpa BUFFER
    while ($db->line ());
    
    // pega CodPerfil
    if (!$CodPerfil) $CodPerfil = $this->CodPerfil;
    
    // Permissoes
    $db->query (' DELETE FROM Tb_Permissoes WHERE Cod_S_Perfil = ' . $CodPerfil);
    
    foreach ($this->itens as $key => $value)
    {
	if ($value->get_active ())
	{
	    if (!$db->query (' INSERT INTO Tb_Permissoes (Cod_S_Perfil, Cod_S_Item) ' .
	                     ' VALUES (' . String ($CodPerfil) . ',' . String ($key) . ');'))
	    {
		return;
	    }
	    else
	    {
		$this->progresso->pulse ();
		while (Gtk::events_pending ()) Gtk::main_iteration ();
	    }
	}
    }
    
    new Message ($this, $mensagem);
    
    return true;
}

}; // TEditaPerfil

?>
