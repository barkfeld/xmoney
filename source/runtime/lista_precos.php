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
require_once 'filtro_lista_precos.php';
require_once 'grid_lista_precos.php';

class TListaPrecos extends TNotebookPage
{

function __construct ()
{
    parent::__construct (latin1 ('Lista de Preços'), 'lista_precos.png');
    
    $this->tipo = $tipo;
    $this->CodId = $CodId;
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'novo_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'editar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2, array ($this, 'excluir_clicked'));
    
    /*
    if ($tipo == 'n')
    {
    }
    else
    {
	switch ($tipo)
	{
	case 'cc': // Cotacao de Compra
	{
	    $lbl_anexo = 'na Cotacao de Compra';
	    break;
	}
	case 'cv': // Cotacao de Venda
	{
	    $lbl_anexo = 'na Cotacao de Venda';
	    break;
	}
	case 'pc': // Pedido de Compra
	{
	    $lbl_anexo = 'no Pedido de Compra';
	    break;
	}
	case 'pv': // Pedido de Venda
	{
	    $lbl_anexo = 'no Pedido de Venda';
	    break;
	}
	};
	
	$hbox->pack_start ($eventbox = new GtkEventBox);
	$eventbox->add ($label = new GtkLabel);
	$label->set_markup ('<b>Anexar os itens selecionados ' . $lbl_anexo . ': ' . $CodId . '</b>');
    }
    
    if ($tipo == 'n' || $tipo == 'cc')
    {
	$hbox->pack_start ($this->cot_compra = new GtkButton ('Cot. Compra'), false);
	$this->cot_compra->set_image (GtkImage::new_from_file (XMImage ('cotacao_compra.png')));
	$this->cot_compra->connect ('clicked', array ($this, 'cotped_compra_venda_clicked'), 'cc');
	// $this->incluir->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Insert, 0, 0);
    }
    
    if ($tipo == 'n' || $tipo == 'cv')
    {
	$hbox->pack_start ($this->cot_venda = new GtkButton ('Cot. Venda'), false);
	$this->cot_venda->set_image (GtkImage::new_from_file (XMImage ('cotacao_venda.png')));
	$this->cot_venda->connect ('clicked', array ($this, 'cotped_compra_venda_clicked'), 'cv');
	// $this->incluir->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Insert, 0, 0);
    }
    
    if ($tipo == 'n' || $tipo == 'pc')
    {
	$hbox->pack_start ($this->ped_compra = new GtkButton ('Ped. Compra'), false);
	$this->ped_compra->set_image (GtkImage::new_from_file (XMImage ('pedido_compra.png')));
	$this->ped_compra->connect ('clicked', array ($this, 'cotped_compra_venda_clicked'), 'pc');
	// $this->incluir->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Insert, 0, 0);
    }
    
    if ($tipo == 'n' || $tipo == 'pv')
    {
	$hbox->pack_start ($this->ped_venda = new GtkButton ('Ped. Venda'), false);
	$this->ped_venda->set_image (GtkImage::new_from_file (XMImage ('pedido_venda.png')));
	$this->ped_venda->connect ('clicked', array ($this, 'cotped_compra_venda_clicked'), 'pv');
	// $this->incluir->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Insert, 0, 0);
    }
    
    if ($tipo == 'n')
    {
	$hbox->pack_start ($this->imprimir = GtkButton::new_from_stock ('gtk-print-preview'), false);
	$this->imprimir->connect ('clicked', array ($this, 'imprimir_clicked'));
	$this->imprimir->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_p, Gdk::CONTROL_MASK, 0);
    }
    */
    
    // filtro
    $this->pack_start ($this->filtro = new TFiltroListaPrecos (array ($this, 'pega_dados')), false);
    
    // grid
    $this->pack_start ($this->grid = new TGridListaPrecos ($this));
    
    return;
    
    // cli / for
    $this->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($cli_for = new GtkButton, false);
    $cli_for->add (GtkImage::new_from_stock ('gtk-orientation-portrait', Gtk::ICON_SIZE_BUTTON));
    $cli_for->connect ('clicked', array ($this, 'cli_for_clicked'));
    
    $hbox->pack_start ($this->box_cli_for = new GtkHBox);
    $cli_for->clicked ();
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
    if ($this->grid->pega_dados ())
    {
	$question = new Question ($this, 'Deseja remover o produto selecionado?');
	if ($question->ask () == Gtk::RESPONSE_YES)
	{
	    $db = new Database ($this);
	    if (!$db->conexao) return;
	    
	    $query = 'UPDATE Tb_Produtos SET Inativo = 1 WHERE Cod_S_Pro = ' . $this->grid->Valores [0];
	    
	    if ($db->run ('sistema', $query)); $this->pega_dados ();
	}
    }
}

function imprimir_clicked ()
{
    if ($this->grid->pega_dados ()) impressao_geral ('produtos', $this->filtro->sql ());
}

function cli_for_clicked ()
{
    unset ($this->CodCliFor);
    
    $children = $this->box_cli_for->get_children ();
    foreach ($children as $child) $child->destroy ();
    
    $this->tipo_cli_for = $this->tipo_cli_for == 0 ? '1' : '0';
    
    // Ativa / Desativa controles
    if (isset ($this->cot_compra)) $this->cot_compra->set_sensitive ($this->tipo_cli_for == '0' ? false : true);
    if (isset ($this->cot_venda)) $this->cot_venda->set_sensitive ($this->tipo_cli_for == '0' ? true : false);
    if (isset ($this->ped_compra)) $this->ped_compra->set_sensitive ($this->tipo_cli_for == '0' ? false : true);
    if (isset ($this->ped_venda)) $this->ped_venda->set_sensitive ($this->tipo_cli_for == '0' ? true : false);
    
    // Cliente / Fornecedor
    $this->box_cli_for->pack_start (new GtkLabel ($this->tipo_cli_for == '0' ? ' Cliente: ' : ' Fornecedor: '), false);
    
    $completion = new GtkEntryCompletion;
    $completion->set_model ($this->st_cli_for = new GtkListStore (TYPE_STRING, TYPE_LONG));
    $completion->set_text_column (0);
    $completion->pack_start ($cell = new GtkCellRendererText());
    $completion->set_attributes($cell, 'text', 1);
    $completion->connect ('match-selected', array ($this, 'cli_for_selected'));
    $this->box_cli_for->pack_start ($this->cli_for = new GtkEntry);
    $this->cli_for->set_completion ($completion);
    
    $this->box_cli_for->pack_start (new GtkEventBox);
    $this->box_cli_for->show_all ();
    
    $this->preenche_campos ();
}

function pega_dados ()
{
    // $sql = file_get_contents ('/srv/xmoney/sql/lista_preco');
    $sql = 'SELECT * FROM Vw_Lista_Preco';
    $filtro = $this->filtro->sql ();
    $and_or_where = $filtro ? ' AND ' : ' WHERE ';
    $where = $and_or_where . ' Inativo = 0 ';
    
    $db = new Database ($this->Owner, true);
    if (!$db->conexao) return;
    
    if (!$db->run ('sistema', $sql . $filtro . $where)) return;
    
    $this->grid->store->clear ();
    while ($linha = $db->line ())
    {
	$preco_venda = PrecoVenda ($linha ['Custo'], $linha ['Margem']);
	
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
                                 0, $linha ['Id'],
				 1, $linha ['Grupo'],
		                 2, $linha ['Marca'],
				 3, $linha ['Modelo'],
				 4, $linha ['Descricao'],
				 5, PointToComma ($preco_venda),
				 6, $linha ['ICMS'],
				 7, $linha ['IPI'],
				 8, PointToComma ($linha ['Reservado']),
				 9, PointToComma ($linha ['Disponivel']),
				 10, 0);
    }
    $this->grid->first_line ();
    
    return true;
}

/*
 * Insere nova cotacao ou pedido no sistema e retorna ID.
 *
 * $tipo: Tipo de Cotacao ou Pedido
 *  cc => cotacao de compra
 *  cv => cotacao de venda
 *  pc => pedido de compra
 *  pv => pedido de venda
 */
function nova_cotacao_pedido ($tipo)
{
    $db = new Database ($this);
    if (!$db->conexao) return;
    
    switch ($tipo)
    {
    case 'cc': /* Cotacao de Compra */
    {
	$sql = ' SP_Cotacao_Compra_Inc ';
	break;
    }
    case 'cv': /* Cotacao de Venda */
    {
	$sql = ' SP_Cotacao_Venda_Inc ';
	break;
    }
    case 'pc': /* Pedido de Compra */
    {
	$sql = ' SP_Pedido_Compra_Inc ';
	break;
    }
    case 'pv': /* Pedido de Venda */
    {
	$sql = ' SP_Pedido_Venda_Inc ';
	break;
    }
    default:
    {
	return;
	break;
    }
    };
    
    $data = ' call ' . $sql . '(' .
	    String ($GLOBALS ['CodFilial']) . ',' .
	    String ($this->CodCliFor) . ',' .
	    String ($GLOBALS ['CodUsuario']) .
	    ');';
    
    if (!$db->run ('sistema', $data)) return;
    
    // pega ID
    if (!$linha = $db->line ()) return;
    return $linha ['CodId'];
}

function enumerar_linhas ($store, $path, $iter)
{
    $sel = $store->get_value ($iter, 10); // Selecao
    if ($sel)
    {
        $id = $store->get_value ($iter, 0); // Id
        $this->InfoLinha [$id] = $sel;
    }
}

function cotped_compra_venda ($tipo)
{
    switch ($tipo)
    {
    case 'cc': /* Cotacao de Compra */
    {
	$tabela = ' Tb_Itens_Cotacao_Compra ';
	$campo_id = ' Cod_S_CotCompra ';
	break;
    }
    case 'cv': /* Cotacao de Venda */
    {
	$tabela = ' Tb_Itens_Cotacao_Venda ';
	$campod_id = ' Cod_S_CotVenda ';
	break;
    }
    case 'pc': /* Pedido de Compra */
    {
	$tabela = ' Tb_Itens_Pedido_Compra ';
	$campo_id = ' Cod_S_PedCompra ';
	break;
    }
    case 'pv': /* Pedido de Venda */
    {
	$tabela = ' Tb_Itens_Pedido_Venda ';
	$campo_id = ' Cod_S_PedVenda ';
	break;
    }
    default:
    {
	return;
	break;
    }
    };

    unset ($this->InfoLinha);
    
    $this->grid->store->foreach (array ($this, 'enumerar_linhas'));
    
    if (!isset ($this->InfoLinha))
    {
	new Message ($this, 'Nenhum item selecionado!');
	return;
    }
    
    if ($this->CodId)
    {
	$CodId = $this->CodId;
    }
    else
    {
	if (!$id = $this->nova_cotacao_pedido ($tipo)) return;
	else $CodId = $id;
    }
    
    $db = new Database ($this);
    if (!$db->conexao) return;
    
    foreach ($this->InfoLinha as $key => $value)
    {
	if ($value)
	{
	    if (!$db->query ('sistema', ' INSERT INTO ' . $tabela . '(' . $campo_id . ',Cod_S_Pro)' .
	                     ' VALUES (' . String ($CodId) . ',' . String ($key) . ');')) return;
	}
    }
    
    switch ($tipo)
    {
    case 'cc': /* Cotacao de Compra */
    {
	if ($this->Parent instanceof TEditaCompra) $lista = $this->Parent;
	else $lista = new TEditaCompra ($this, 'c', 'a', $CodId);
	
	break;
    }
    case 'cv': /* Cotacao de Venda */
    {
	if ($this->Parent instanceof TEditaVenda) $lista = $this->Parent;
	else $lista = new TEditaVenda ($this, 'c', 'a', $CodId);
	
	break;
    }
    case 'pc': /* Pedido de Compra */
    {
	if ($this->Parent instanceof TEditaCompra) $lista = $this->Parent;
	else $lista = new TEditaCompra ($this, 'p', 'a', $CodId);
	
	break;
    }
    case 'pv': /* Pedido de Venda */
    {
	if ($this->Parent instanceof TEditaVenda) $lista = $this->Parent;
	else $lista = new TEditaVenda ($this, 'p', 'a', $CodId);
	
	break;
    }
    };
    
    if ($lista->atualizar ()) $lista->show ();
}

function cotped_compra_venda_clicked ($button, $data)
{
    $this->cotped_compra_venda ($data);
}

}; // TListaPrecos

?>
