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

require_once 'classes/grupos.php';
require_once 'classes/marcas.php';
require_once 'classes/sit_produto.php';
require_once 'classes/tipo_produto.php';
require_once 'classes/unid_compra.php';
require_once 'classes/unid_estoque.php';
require_once 'classes/unid_venda.php';

class TEditaProduto extends TJanela
{

/*
 * operacao:
 *  i => Incluir
 *  a => Alterar
 */
function __construct ($Parent, $operacao = 'i', $CodProduto = null)
{
    parent::__construct ($operacao == 'i' ? 'Produto - Incluir' : 'Produto - Alterar',
                         null, null, 'produtos.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodProduto = $CodProduto;
    
    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Produto';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodProduto ? $CodProduto : -1;

    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodProduto . '</b>');
    }
    
    // Sit. Produto
    $hbox->pack_start ($this->situacao = new TSitProduto ($this));
    
    // Tipo Produto
    $hbox->pack_start ($this->tipo = new TTipoProduto ($this));
    
    // Ativo
    $hbox->pack_start ($this->ativo = new GtkCheckButton (' Ativo '));
    $this->ativo->set_active (true);
    
    // Grupo
    $this->pack_start ($frame = new GtkFrame, false);
    $frame->add ($vbox = new GtkVBox);
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start ($this->grupos = new TGrupos ($this));
    
    // Marca
    $hbox->pack_start ($this->marcas = new TMarcas ($this));
    
    // Modelo
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (new GtkLabel (' Modelo: '), false);
    $hbox->pack_start ($this->modelo = new AEntry (true, true, 'Tb_Produtos', 'Modelo'));
    
    // Descricao
    $hbox->pack_start (new GtkLabel (latin1 (' Descrição: ')), false);
    $hbox->pack_start ($this->descricao = new AEntry (true, true, 'Tb_Produtos', 'Descricao'));
    
    // Preco custo
    $this->pack_start ($frame = new GtkFrame, false);
    $frame->add ($vbox = new GtkVBox);
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start ($this->custo = new TFloat (true));
    $this->custo->label->set_text (latin1 (' Preço Custo: '));
    
    // Margem
    $hbox->pack_start ($this->margem = new TFloat (true));
    $this->margem->label->set_text (' Margem: ');
    
    // Percentual
    $hbox->pack_start ($this->percentual = new TFloat (true));
    $this->percentual->label->set_text (' Percentual: ');
    
    // ICMS
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->icms = new TInteger (true));
    $this->icms->label->set_text (' ICMS: ');
    
    // IPI
    $hbox->pack_start ($this->ipi = new TInteger (true));
    $this->ipi->label->set_text (' IPI: ');
    
    // Clas. Fiscal
    $hbox->pack_start ($this->clas_fiscal = new TInteger (true));
    $this->clas_fiscal->label->set_text (' Clas. Fiscal: ');
    
    // Qtd Minima
    $this->pack_start ($frame = new GtkFrame, false);
    $frame->add ($vbox = new GtkVBox);
    $vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start ($this->qtde_minima = new TInteger (true), false);
    $this->qtde_minima->label->set_text (latin1 (' Qtde Mínima: '));
    
    // Cota de Compra
    $hbox->pack_start ($this->cota_compra = new TInteger (true), false);
    $this->cota_compra->label->set_text (' Cota de Compra: ');
    
    // Cota de Venda
    $hbox->pack_start ($this->cota_venda = new TInteger (true), false);
    $this->cota_venda->label->set_text (' Cota de Venda: ');
    
    // Unid. de Compra
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->unid_compra = new TUnidCompra ($this), false);
    
    // Unid. de Venda
    $hbox->pack_start ($this->unid_venda = new TUnidVenda ($this), false);
    
    // Unid. de Estoque
    $hbox->pack_start ($this->unid_estoque = new TUnidEstoque ($this), false);
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
     
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->conta->focus_widget = $this->ok;
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->children_show_all ();
    $this->cota_venda->set_next_focus ($this->ok);
    $this->grupos->entry->grab_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ())
    {
	$this->Parent->pega_dados ();
	
	if ($this->operacao == 'i' ) $this->limpa_dados ();
	else $this->destroy ();
    }
}

function cancelar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ('SELECT * FROM Vw_Produtos WHERE Id = ' . $this->CodProduto)) return;
    
    if ($line = $db->line ())
    {
	$this->situacao->combobox->set_active_iter ($this->situacao->it [$line ['CodSit']]);
	$this->tipo->combobox->set_active_iter ($this->tipo->it [$line ['CodTipo']]);
	$this->grupos->entry->set_text ($line ['Grupo']);
	$this->grupos->CodGrupo = $line ['CodGrupo'];
	$this->marcas->entry->set_text ($line ['Marca']);
	$this->marcas->CodMarca = $line ['CodMarca'];
	$this->ativo->set_active ($line ['Ativo']);
	$this->modelo->set_text ($line ['Modelo']);
	$this->descricao->set_text ($line ['Descricao']);
	$this->custo->set_text (PointToComma ($line ['Custo']));
	$this->margem->set_text (PointToComma ($line ['Margem']));
	$this->percentual->set_text (PointToComma ($line ['Percentual']));
	$this->icms->set_text ($line ['ICMS']);
	$this->ipi->set_text ($line ['IPI']);
	$this->clas_fiscal->set_text ($line ['ClasFiscal']);
	$this->qtde_minima->set_text ($line ['QtdeMinima']);
	$this->cota_compra->set_text ($line ['CotaCompra']);
	$this->cota_venda->set_text ($line ['CotaVenda']);
	$this->unid_compra->combobox->set_active_iter ($this->unid_compra->it [$line ['CodCompra']]);
	$this->unid_venda->combobox->set_active_iter ($this->unid_venda->it [$line ['CodVenda']]);
	$this->unid_estoque->combobox->set_active_iter ($this->unid_estoque->it [$line ['CodEstoque']]);
	
	return true;
    }
}

function limpa_dados ()
{
    $this->modelo->set_text ('');
    $this->descricao->set_text ('');
    $this->custo->set_text ('');
    $this->margem->set_text ('');
    $this->percentual->set_text ('');
    $this->icms->set_text ('');
    $this->ipi->set_text ('');
    $this->clas_fiscal->set_text ('');
    $this->qtde_minima->set_text ('');
    $this->cota_compra->set_text ('');
    $this->cota_venda->set_text ('');
    $this->modelo->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $modelo = $this->modelo->get_text ();
    $descricao = $this->descricao->get_text ();
    $custo = $this->custo->get_text ();
    $margem = $this->margem->get_text ();
    $percentual = $this->percentual->get_text ();
    $icms = $this->icms->get_text ();
    $ipi = $this->ipi->get_text ();
    $clas_fiscal = $this->clas_fiscal->get_text ();
    $qtde_minima = $this->qtde_minima->get_text ();
    $cota_compra = $this->cota_compra->get_text ();
    $cota_venda = $this->cota_venda->get_text ();
    
    if ($this->operacao == 'i') $sql = 'call SP_Produto_Inc';
    else $sql = 'call SP_Produto_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodProduto) . ',' .
            String ($this->situacao->CodSitProduto) . ',' . 
            String ($this->tipo->CodTipoProduto) . ',' .
            String ($this->ativo->get_active ()) . ',' .
            String ($this->grupos->CodGrupo) . ',' .
            String ($this->marcas->CodMarca) . ',' .
            String ($modelo) . ',' .
            String ($descricao) . ',' .
            String (CommaToPoint ($custo)) . ',' .
            String (CommaToPoint ($margem)) . ',' .
            String (CommaToPoint ($percentual)) . ',' .
            String ($icms) . ',' .
            String ($ipi) . ',' .
            String ($clas_fiscal) . ',' .
            String ($qtde_minima) . ',' .
            String ($cota_compra) . ',' .
            String ($cota_venda) . ',' .
            String ($this->unid_compra->CodUnidCompra) . ',' .
            String ($this->unid_venda->CodUnidVenda) . ',' .
            String ($this->unid_estoque->CodUnidEstoque) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    
    $db->free_result ();
    
    new Message ($this, $line ['Mensagem']);
    
    return true;
}

}; // TEditaProduto

?>
