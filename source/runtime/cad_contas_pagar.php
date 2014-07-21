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

require_once 'baixa_contas_pagar.php';
require_once 'cancela_conta_pagar.php';
require_once 'edita_conta_pagar.php';
require_once 'estorna_conta_pagar.php';
require_once 'filtro_contas_pagar.php';
require_once 'filtro_del_contas_pagar.php';
require_once 'filtro_mov_contas_pagar.php';
require_once 'grid_contas_pagar.php';
require_once 'grid_del_contas_pagar.php';
require_once 'grid_mov_contas_pagar.php';
require_once 'info_mov_conta_pagar.php';

class TCadContasPagar extends TNotebookPage
{

var $incluir, $baixar, $cancelar, $imprimir, $voltar;
var $notebook, $grid, $mov_grid, $del_grid;
var $InfoLinha;

function __construct ()
{
    parent::__construct ('Contas a Pagar', 'contas_pagar.png');
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->lancar = $toolbar->append_stock ('gtk-add', 0, array ($this, 'lancar_clicked'));
    $this->lancar->set_label (latin1 ('Lançar'));
    $this->baixar = $toolbar->append_stock ('gtk-go-down', 1, array ($this, 'baixar_clicked'));
    $this->baixar->set_label ('Baixar');
    $this->cancelar = $toolbar->append_stock ('gtk-cancel', 2, array ($this, 'cancelar_clicked'));
    $this->estornar = $toolbar->append_stock ('gtk-cancel', 3, array ($this, 'estornar_clicked'));
    $this->estornar->set_label ('Estornar');
    $this->info_mov = $toolbar->append_stock ('gtk-info', 4, array ($this, 'info_mov_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 5, array ($this, 'imprimir_clicked'));
    
    // contas em aberto
    $this->pack_start ($this->notebook = new GtkNotebook);
    $this->notebook->append_page ($vbox = new GtkVBox, new GtkLabel (' Em aberto '));
    $vbox->pack_start ($this->filtro = new TFiltroContasPagar (array ($this, 'pega_dados')), false);
    $vbox->pack_start ($this->grid = new TGridContasPagar ($this));
    
    // contas pagas baixadas
    $this->notebook->append_page ($vbox = new GtkVBox, new GtkLabel (' Baixas '));
    $vbox->pack_start ($this->mov_filtro = new TFiltroMovContasPagar (array ($this, 'pega_dados_mov')), false);
    $vbox->pack_start ($this->mov_grid = new TGridMovContasPagar ($this));

    // contas pagas canceladas
    $this->notebook->append_page ($vbox = new GtkVBox, new GtkLabel (' Canceladas '));
    $vbox->pack_start ($this->del_filtro = new TFiltroDelContasPagar (array ($this, 'pega_dados_del')), false);
    $vbox->pack_start ($this->del_grid = new TGridDelContasPagar ($this));
    
    $this->notebook->connect ('switch-page', array ($this, 'notebook_switch_page'));
    $this->notebook->set_current_page (0);
    
    $this->lancar->set_sensitive (CheckPermissao ($this, 'lancar_conta_pagar'));
    $this->info_mov->set_sensitive (CheckPermissao ($this, 'info_mov_conta_pagar'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_contas_pagar'));
}

function notebook_switch_page ($notebook, $pointer, $page_num)
{
    switch ($page_num)
    {
    case 0: /* ABERTO */
    {
	$this->baixar->set_sensitive (CheckPermissao ($this, 'baixar_contas_pagar'));
	$this->cancelar->set_sensitive (CheckPermissao ($this, 'cancelar_conta_pagar'));
	$this->estornar->set_sensitive (false);
	break;
    }
    case 1: /* PAGO */
    {
	$this->baixar->set_sensitive (false);
        $this->cancelar->set_sensitive (false);
	$this->estornar->set_sensitive (CheckPermissao ($this, 'estornar_conta_pagar'));
	break;
    }
    case 2: /* CANCELADO */
    {
	$this->baixar->set_sensitive (false);
	$this->cancelar->set_sensitive (false);
	$this->estornar->set_sensitive (false);
	break;
    }
    };
}

function lancar_clicked ()
{
    $conta_pagar = new TEditaContaPagar ($this);
    $conta_pagar->show ();
}

function enumerar_linhas ($store, $path, $iter)
{
    $sel = $store->get_value ($iter, 0);
    if ($sel)
    {
	$id = $store->get_value ($iter, 1);
	$this->InfoLinha [$id] = $sel;
    }
}

function baixar_clicked ()
{
    unset ($this->InfoLinha);
    
    $this->grid->store->foreach (array ($this, 'enumerar_linhas'));
    
    if (!isset ($this->InfoLinha))
    {
	new Message ($this->Owner, 'Nenhuma conta selecionada!');
	return;
    }
    
    $contas_pagar = new TBaixaContasPagar ($this, $this->InfoLinha);
    if ($contas_pagar->pega_dados ()) $contas_pagar->show ();
}

function info_mov_clicked ()
{
    $n_page = $this->notebook->get_current_page ();
    if ($n_page == 0) $cur_grid = $this->grid;
    else if ($n_page == 1) $cur_grid = $this->mov_grid;
    else $cur_grid = $this->del_grid;
    
    if ($cur_grid->pega_dados ())
    {
	$info_mov_conta_pagar = new TInfoMovContaPagar ($this, $cur_grid->Valores [1]);
	if ($info_mov_conta_pagar->pega_dados ()) $info_mov_conta_pagar->show ();
    }
}

function cancelar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$conta_pagar = new TCancelaContaPagar ($this, $this->grid->Valores [1]);
	$conta_pagar->show ();
    }
}

function estornar_clicked ()
{
    if ($this->mov_grid->pega_dados ())
    {
	$conta_pagar = new TEstornaContaPagar ($this, $this->mov_grid->Valores [0]);
	$conta_pagar->show ();
    }
}

function imprimir_clicked ()
{
    $page = $this->notebook->get_current_page ();
    switch ($page)
    {
    case 0:
	$modulo = 'contas_pagar';
	$filtro = $this->filtro;
	$grid = $this->grid;
	$extra = ' Tb_Contas_Pagar.Cod_S_Sit = 1 ';
	break;
    case 1:
	$modulo = 'mov_contas_pagar';
	$filtro = $this->mov_filtro;
	$grid = $this->mov_grid;
	$extra = ' Tb_Mov_Contas_Pagar.Inativo = 0 ';
	break;
    case 2:
	$modulo = 'del_contas_pagar';
	$filtro = $this->del_filtro;
	$grid = $this->del_grid;
	$extra = ' Tb_Del_Contas_Pagar.Inativo = 0 ';
	break;
    };
    
    if (!$grid->pega_dados ()) return;
    
    $filtro = $filtro->sql_print ();
    $where = $filtro ? ' AND ' . $extra : ' WHERE ' . $extra;
    
    impressao_geral ($modulo, $filtro . $where);
}

function voltar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Contas_Pagar';
    $filtro = $this->filtro->sql ();
    $extra = $filtro ? ' AND ' : ' WHERE ';
    
    if (!$db->multi_query ($sql . $filtro . $extra . ' CodSit = 1')) return;
    
    $this->grid->store->clear ();
    unset ($this->InfoLinha);
    $this->InfoLinha = null;
    
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
			         1, $line ['Id'],
				 2, $line ['Filial'],
				 3, $line ['Fornecedor'],
				 4, $line ['TipoDoc'],
				 5, $line ['NumDoc'],
				 6, $line ['Parcela'],
				 7, PointToComma ($line ['ValorDoc']),
				 8, FDate ($line ['Emissao']),
				 9, FDate ($line ['Vencimento']));
    }
    
    $this->grid->first_line ();
    
    return true;
}

function pega_dados_mov ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Mov_Contas_Pagar';
    $filtro = $this->mov_filtro->sql ();
    $extra = ' Inativo = 0 ';
    $where = $filtro ? ' AND ' . $extra : ' WHERE ' . $extra;
    
    if (!$db->multi_query ($sql . $filtro . $where)) return;
    
    $this->mov_grid->store->clear ();
    
    while ($line = $db->line ())
    {
	$row = $this->mov_grid->store->append ();
	$this->mov_grid->store->set ($row,
	                             0, $line ['Id'],
			             1, $line ['CodConta'],
				     2, $line ['Filial'],
				     3, $line ['Fornecedor'],
				     4, $line ['NumDoc'],
				     5, $line ['Banco'],
				     6, $line ['Despesa'],
				     7, $line ['FormaPgto'],
				     8, PointToComma ($line ['Juros']),
				     9, PointToComma ($line ['Desconto']),
				     10, PointToComma ($line ['Total']),
				     11, FDate ($line ['Pagamento']));
    }
    
    $this->mov_grid->first_line ();
    
    return true;
}

function pega_dados_del ()
{
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Del_Contas_Pagar';
    $filtro = $this->del_filtro->sql ();
    $extra = ' Inativo = 0 ';
    $where = $filtro ? ' AND ' . $extra : ' WHERE ' . $extra;
    
    if (!$db->multi_query ($sql . $filtro . $where)) return;
    
    $this->del_grid->store->clear ();
    
    while ($line = $db->line ())
    {
	$row = $this->del_grid->store->append ();
	$this->del_grid->store->set ($row,
			             0, $line ['Id'],
			             1, $line ['CodConta'],
				     2, $line ['Filial'],
				     3, $line ['Fornecedor'],
				     4, $line ['NumDoc'],
				     5, $line ['Parcela'],
				     6, PointToComma ($line ['ValorDoc']),
				     7, FDate ($line ['Vencimento']),
				     8, FDate ($line ['Cancelado']));
    }
    
    $this->del_grid->first_line ();
    
    return true;
}

}; // TCadContasReceber

?>
