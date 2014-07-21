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

require_once 'cad_bancos.php';
require_once 'cad_clientes.php';
require_once 'cad_contas_pagar.php';
require_once 'cad_contas_receber.php';
require_once 'cad_filiais.php';
require_once 'cad_formas_pgto.php';
require_once 'cad_fornecedores.php';
require_once 'cad_grupos.php';
require_once 'cad_marcas.php';
require_once 'cad_perfis.php';
require_once 'cad_produtos.php';
require_once 'cad_sit_produtos.php';
require_once 'cad_tipos_despesa.php';
require_once 'cad_tipos_doc.php';
require_once 'cad_tipos_produto.php';
require_once 'cad_transportadoras.php';
require_once 'cad_unid_compras.php';
require_once 'cad_unid_estoques.php';
require_once 'cad_unid_vendas.php';
require_once 'cad_usuarios.php';
require_once 'sobre.php';

class TPainel extends GtkScrolledWindow
{

function __construct ($Owner)
{
    parent::__construct ();
    $this->set_policy (Gtk::POLICY_NEVER, Gtk::POLICY_AUTOMATIC);
    
    $this->Owner = $Owner;
    
    $this->add_with_viewport ($this->lista = new GtkVBox);
    $this->lista->set_border_width (5);
    
    $this->preenche_lista ();
}

function button_clicked ($button, $data)
{
    if (!CheckPermissao ($this->Owner, $data [0], true)) return;
    
    $this->Owner->notebook->append (new $data [1]);
}

function sobre_clicked ()
{
    $sobre = new TSobre ($this);
    $sobre->show ();
}

function preenche_lista ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    // Secoes
    $sql = 'SELECT * FROM Tb_Secoes';
    if (!$db->multi_query ($sql)) return;
    
    while ($line = $db->line ())
    {
	$CodSecao = $line ['Cod_S_Secao'];
	$Imagem = $line ['Imagem'];
	$Nome = $line ['Nome'];
	
	$this->lista->pack_start ($ptr = $this->secoes [$CodSecao] = new GtkExpander (''), false);
	$ptr->add (new GtkVBox);
	
	$ptr->set_label_widget ($hbox = new GtkHBox);
	$hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $Imagem), false);
	$hbox->pack_start ($label = new GtkLabel);
	$label->set_markup ('<b>' . $Nome . '</b>');
	$ptr->show_all ();
    }
    
    // Menus
    $sql = 'SELECT * FROM Tb_Menus';
    if (!$db->multi_query ($sql)) return;
    
    while ($line = $db->line ())
    {
	$CodMenu = $line ['Cod_S_Menu'];
	$CodSecao = $line ['Cod_S_Secao'];
	$Imagem = $line ['Imagem'];
	$Nome = $line ['Nome'];
	$Permissao = $line ['Permissao'];
	$Classe = $line ['Classe'];
	
	$this->secoes [$CodSecao]->child->pack_start ($button = new GtkButton);
	$button->set_relief (Gtk::RELIEF_NONE);
	$button->add ($hbox = new GtkHBox);
	$hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . $Imagem), false);
	$hbox->pack_start (new GtkLabel (' ' . $Nome . ' '));
	$button->show_all ();
	
	$button->connect ('clicked', array ($this, 'button_clicked'), array ($Permissao, $Classe));
    }
    
    // Ajuda
    $this->lista->pack_start ($ptr = new GtkExpander (''), false);
    $ptr->set_label_widget ($hbox = new GtkHBox);
    $hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'ajuda.png'), false);
    $hbox->pack_start ($label = new GtkLabel);
    $label->set_markup ('<b>Ajuda</b>');
    $ptr->show_all ();
    
    // Sobre
    $ptr->add ($button = new GtkButton);
    $button->set_relief (Gtk::RELIEF_NONE);
    $button->add ($hbox = new GtkHBox);
    $hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'sobre.png'), false);
    $hbox->pack_start (new GtkLabel ('Sobre'));
    $ptr->show_all ();
    
    $button->connect ('clicked', array ($this, 'sobre_clicked'));
    
    return true;
}

}; // TPainel

?>
