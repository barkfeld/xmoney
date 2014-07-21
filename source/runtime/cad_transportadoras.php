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

require_once 'edita_transportadora.php';
require_once 'end_transportadoras.php';
require_once 'filtro_transportadoras.php';
require_once 'grid_transportadoras.php';

class TCadTransportadoras extends TNotebookPage
{

function __construct ()
{
    parent::__construct ('Transportadoras', 'transportadoras.png');
    
    // barra de ferramentas
    $this->pack_start ($toolbar = new TToolbar, false);
    
    $this->incluir = $toolbar->append_stock ('gtk-add', 0, array ($this, 'novo_clicked'));
    $this->alterar = $toolbar->append_stock ('gtk-edit', 1, array ($this, 'editar_clicked'));
    $this->excluir = $toolbar->append_stock ('gtk-delete', 2, array ($this, 'excluir_clicked'));
    $this->enderecos = $toolbar->append ('enderecos.png', latin1 ('Endereços'), 3, array ($this, 'enderecos_clicked'));
    $this->imprimir = $toolbar->append_stock ('gtk-print-preview', 4, array ($this, 'imprimir_clicked'));

    // filtro
    $this->pack_start ($this->filtro = new TFiltroTransportadoras (array ($this, 'pega_dados')), false);
    
    // grid
    $this->pack_start ($this->grid = new TGridTransportadoras ($this));
    
    $this->filtro->set_focus ();
    
    $this->incluir->set_sensitive (CheckPermissao ($this, 'incluir_transportadora'));
    $this->alterar->set_sensitive (CheckPermissao ($this, 'alterar_transportadora'));
    $this->excluir->set_sensitive (CheckPermissao ($this, 'excluir_transportadora'));
    $this->imprimir->set_sensitive (CheckPermissao ($this, 'imprimir_transportadoras'));
    $this->enderecos->set_sensitive (CheckPermissao ($this, 'enderecos_transportadora'));
}

function novo_clicked ()
{
    $edita = new TEditaTransportadora ($this);
    $edita->show ();
}

function enderecos_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$enderecos = new TEndTransportadora ($this->grid->Valores [0], $this->grid->Valores [1]);
	if ($enderecos->pega_dados ()) $this->Parent->append ($enderecos);
    }
}

function editar_clicked ()
{
    if ($this->grid->pega_dados ())
    {
	$edita = new TEditaTransportadora ($this, 'a', $this->grid->Valores [0]);
	if ($edita->pega_dados ()) $edita->show ();
    }
}

function excluir_clicked ()
{
    if (!$this->grid->pega_dados ()) return;
    
    $id = $this->grid->Valores [0];
    
    $dialog = new Question ($this->Owner, ' Deseja mesmo remover a transportadora selecionada? ');
    $resp = $dialog->ask ();
    if ($resp != Gtk::RESPONSE_YES) return;
    
    $db = new Database ($this->Owner, false);
    if (!$db->link) return;
    
    $sql = ' DELETE FROM Tb_Transportadoras WHERE Cod_S_Trans = ' . $id;
    if (!$db->query ($sql)) return;
    
    $this->pega_dados ();
    
    new Message ($this->Owner, 'Transportadora removida com sucesso!');
}

function imprimir_clicked ()
{
    if ($this->grid->pega_dados ()) impressao_geral ('transportadoras', $this->filtro->sql_print ());
}

function pega_dados ()
{
    $sql = 'SELECT * FROM Vw_Transportadoras';
    $where = $this->filtro->sql ();
    
    $db = new Database ($this->Owner, true);
    if (!$db->link) return;
    
    if (!$db->multi_query ($sql . $where)) return;
    
    $this->grid->store->clear ();
    while ($line = $db->line ())
    {
	$row = $this->grid->store->append ();
	$this->grid->store->set ($row,
				 0, $line ['Id'],
				 1, $line ['Nome'],
				 2, $line ['Fantasia'],
				 3, $line ['CPF'],
				 4, $line ['IE'],
				 5, $line ['Fone'],
				 6, $line ['Fone2'],
				 7, $line ['Fax'],
				 8, $line ['Email'],
				 9, $line ['URL'],
				 10, $line ['Anotacoes'],
				 11, PointToComma ($line ['LimiteEntrega']),
				 12, $line ['Ativo']);
    }
    
    $this->grid->first_line ();
    
    return true;
}

}; // TCadTransportadoras

?>
