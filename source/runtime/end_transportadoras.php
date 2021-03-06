<?php

/*
 * X-Money - Gestao Empresarial Integrada
 *
 * Copyright (C) 2010 - Eneias Ramos de Melo <neneias@gmail.com>
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

require_once 'edita_end_transportadora.php';
require_once 'grid_end_transportadoras.php';

class TEndTransportadora extends TNotebookPage
{

function __construct ($CodTrans, $NomeTrans)
{
    $this->CodTrans = $CodTrans;
    
    parent::__construct (latin1 ('Endereços da Transportadora'), 'enderecos.png');
    
    // toolbar
    $this->pack_start ($toolbar = new TToolbar, false);
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'incluir_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'alterar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2,  array ($this, 'excluir_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 3, array ($this, 'imprimir_clicked'));
    
    // grid
    $this->pack_start ($this->grid = new TGridEndTransportadoras ($this));
    
    // info transportadora
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($label = new GtkLabel, false);
    $label->set_markup ('<b> Cod. Transp.: </b>' . $CodTrans);
    $hbox->pack_start ($label = new GtkLabel);
    $label->set_markup ('<b> Transportadora </b>' . $NomeTrans);

    $this->incluir->set_sensitive (CheckPermissao ($this, 'incluir_end_transportadora'));
    $this->alterar->set_sensitive (CheckPermissao ($this, 'alterar_end_transportadora'));
    $this->excluir->set_sensitive (CheckPermissao ($this, 'excluir_end_transportadora'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_end_transportadora'));
}

function incluir_clicked ($button)
{
    $endereco = new TEditaEndTransportadora ($this, 'i', $this->CodTrans);
    $endereco->show ();
}

function alterar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$endereco = new TEditaEndTransportadora ($this, 'a', $this->CodTrans, $this->grid->Valores [0]);
	if ($endereco->pega_dados ()) $endereco->show ();
    }
}

function excluir_clicked ()
{
    if (!$this->grid->pega_dados ()) return;
    
    $id = $this->grid->Valores [0];
    
    $dialog = new Question ($this->Owner, latin1 (' Deseja mesmo remover o endereço selecionado ? '));
    $resp = $dialog->ask ();
    if ($resp != Gtk::RESPONSE_YES) return;
    
    $sql = ' DELETE FROM Tb_End_Transportadoras WHERE Cod_S_Endereco = ' . $id;
    
    $db = new Database ($this->Owner, false);
    if (!$db->link) return;
    
    if (!$db->query ($sql)) return;
    
    $this->pega_dados ();
    
    new Message ($this->Owner, latin1 ('Endereço da transportadora removido com sucesso!'));
}

function imprimir_clicked ($button)
{
    if ($this->grid->pega_dados ()) impressao_geral ('end_transportadoras');
}

function voltar_clicked ($button)
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_End_Transportadoras WHERE CodTrans = ' . $this->CodTrans)) return;
    
    $this->grid->store->clear ();
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
	                         0, $line ['Id'],
			         1, $line ['Tipo'],
			         2, $line ['Endereco'],
			         3, $line ['CEP'],
			         4, $line ['Bairro'],
			         5, $line ['Cidade'],
			         6, $line ['Estado'],
			         7, $line ['Contato'],
			         8, $line ['Fone'],
			         9, $line ['Referencia']);
    }
    
    $this->grid->first_line ();
    
    return true;
}

}; // TEndTransportadoras

?>
