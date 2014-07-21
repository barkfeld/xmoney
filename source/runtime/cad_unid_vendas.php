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

require_once 'edita_unid_venda.php';
require_once 'grid_unid_vendas.php';

class TCadUnidVendas extends TNotebookPage
{

function __construct ()
{
    parent::__construct (latin1 ('Unidades de Vendas'), 'unid_vendas.png');
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'novo_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'editar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2, array ($this, 'excluir_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 3, array ($this, 'imprimir_clicked'));
    
    // grid
    $this->pack_start ($this->grid = new TGridUnidVendas ($this));
    
    $this->incluir->set_sensitive (CheckPermissao ($this, 'incluir_unid_venda'));
    $this->alterar->set_sensitive (CheckPermissao ($this, 'alterar_unid_venda'));
    $this->excluir->set_sensitive (CheckPermissao ($this, 'excluir_unid_venda'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_unid_vendas'));
    
    // preenche lista
    $this->pega_dados ();
}

function novo_clicked ()
{
    $edita_unid_venda = new TEditaUnidVenda ($this);
    $edita_unid_venda->show ();
}

function editar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$edita_unid_venda = new TEditaUnidVenda ($this, 'a', $this->grid->Valores [0]);
	if ($edita_unid_venda->pega_dados ()) $edita_unid_venda->show ();
    }
}

function excluir_clicked ()
{
    if (!$this->grid->pega_dados ()) return;
    
    $id = $this->grid->Valores [0];
    
    $dialog = new Question ($this->Owner, latin1 ('Deseja mesmo remover a unidade de venda selecionada?'));
    $result = $dialog->ask ();
    if ($result != Gtk::RESPONSE_YES) return;
    
    $db = new Database ($this->Owner, false);
    if (!$db->link) return;
    
    $sql = 'DELETE FROM Tb_Unid_Vendas WHERE Cod_S_Unidade = ' . $id;
    if (!$db->query ($sql)) return;
    
    $this->pega_dados ();
    
    new Message ($this->Owner, 'Unidade de venda removida com sucesso!');
}

function imprimir_clicked ()
{
    if ($this->grid->pega_dados ()) impressao_geral ('unid_vendas');
}

function voltar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Unid_Vendas';
    
    if (!$db->multi_query ($sql)) return;
    
    $this->grid->store->clear ();
    
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
			         0, $line ['Id'],
				 1, $line ['Nome'],
				 2, $line ['Descricao']);
    }
    
    $this->grid->first_line ();
    
    return true;
}

}; // TCadUnidVendas

?>
