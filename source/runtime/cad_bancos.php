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

require_once 'edita_banco.php';
require_once 'grid_bancos.php';
require_once 'classes/notebook_page.php';

class TCadBancos extends TNotebookPage
{

function __construct ()
{
    parent::__construct ('Bancos', 'bancos.png');
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'novo_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'editar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2, array ($this, 'excluir_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 3, array ($this, 'imprimir_clicked'));
    
    // grid
    $this->pack_start ($this->grid = new TGridBancos ($this));
  
    $this->incluir->set_sensitive (CheckPermissao ($this, 'incluir_banco'));
    $this->alterar->set_sensitive (CheckPermissao ($this, 'alterar_banco'));
    $this->excluir->set_sensitive (CheckPermissao ($this, 'excluir_banco'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_bancos'));
    
    // preenche lista
    $this->pega_dados ();
}

function novo_clicked ()
{
    $edita_banco = new TEditaBanco ($this);
    $edita_banco->show ();
}

function editar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$edita_banco = new TEditaBanco ($this, 'a', $this->grid->Valores [0]);
	if ($edita_banco->pega_dados ()) $edita_banco->show ();
    }
}

function excluir_clicked ()
{
    if (!$this->grid->pega_dados ()) return;
    
    $id = $this->grid->Valores [0];
    
    $dialog = new Question ($this->Owner, ' Deseja mesmo remover o banco selecionado? ');
    $result = $dialog->ask ();
    if ($result != Gtk::RESPONSE_YES) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $sql = 'DELETE FROM Tb_Bancos WHERE Cod_S_Banco = ' . $id;
    if (!$db->query ($sql)) return;
    
    $this->pega_dados ();
    
    new Message ($this->Owner, latin1 ('Banco removido com sucesso!'));
}

function imprimir_clicked ()
{
    if ($this->grid->pega_dados ()) impressao_geral ('bancos');
}

function voltar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_Bancos ORDER BY Id')) return;
    
    $this->grid->store->clear ();
    
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
			         0, $line ['Id'],
				 1, $line ['Nome'],
				 2, $line ['Agencia'],
				 3, $line ['Conta'],
				 4, $line ['Filial']);
    }
    
    $this->grid->first_line ();
    
    return true;
}

}; // TCadBancos

?>
