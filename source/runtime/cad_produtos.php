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

require_once 'edita_produto.php';
require_once 'filtro_produtos.php';
require_once 'grid_produtos.php';

class TCadProdutos extends TNotebookPage
{

function __construct ()
{
    parent::__construct ('Produtos', 'produtos.png');
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'novo_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'editar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2, array ($this, 'excluir_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 3, array ($this, 'imprimir_clicked'));
    
    // filtro
    $this->pack_start ($this->filtro = new TFiltroProdutos (array ($this, 'pega_dados')), false);
    
    // grid
    $this->pack_start ($this->grid = new TGridProdutos ($this));
    
    $this->incluir->set_sensitive (CheckPermissao ($this, 'incluir_produto'));
    $this->alterar->set_sensitive (CheckPermissao ($this, 'alterar_produto'));
    $this->excluir->set_sensitive (CheckPermissao ($this, 'excluir_produto'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_produtos'));
}

function novo_clicked ()
{
    $edita_produto = new TEditaProduto ($this);
    $edita_produto->show ();
}

function editar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$edita = new TEditaProduto ($this, 'a', $this->grid->Valores [0]);
	if ($edita->pega_dados ()) $edita->show ();
    }
}

function excluir_clicked ()
{
    if (!$this->grid->pega_dados ()) return;
    
    $id = $this->grid->Valores [0];
    
    $dialog = new Question ($this->Owner, ' Deseja mesmo remover o produto selecionado? ');
    $result = $dialog->ask ();
    if ($result != Gtk::RESPONSE_YES) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $sql = 'DELETE FROM Tb_Produtos WHERE Cod_S_Produto = ' . $id;
    if (!$db->query ($sql)) return;
    
    $this->pega_dados ();
    
    new Message ($this->Owner, 'Produto removido com sucesso!');
}

function imprimir_clicked ()
{
    if ($this->grid->pega_dados ()) impressao_geral ('produtos', $this->filtro->sql_print ());
}

function pega_dados ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Produtos';
    $filtro = $this->filtro->sql ();
    if (!$db->multi_query ($sql . $filtro)) return;
    
    $this->grid->store->clear ();
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
                                 0, $line ['Id'],
				 1, $line ['Grupo'],
		                 2, $line ['Marca'],
				 3, $line ['Modelo'],
				 4, $line ['Descricao'],
				 5, $line ['Ativo'],
				 6, PointToComma ($line ['Custo']),
				 7, PointToComma ($line ['Margem']),
				 8, PointToComma ($line ['Percentual']),
				 9, PointToComma ($line ['ICMS']),
				 10, PointToComma ($line ['IPI']),
				 11, $line ['ClasFiscal'],
				 12, $line ['QtdeMinima'],
				 13, $line ['CotaCompra'],
				 14, $line ['CotaVenda'],
				 15, $line ['Situacao'],
				 16, $line ['Tipo'],
				 17, $line ['UnidCompra'],
				 18, $line ['UnidVenda'],
				 19, $line ['UnidEstoque']);
    }
    $this->grid->first_line ();
    
    return true;
}

}; // TCadProdutos

?>
