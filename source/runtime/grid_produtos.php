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

class TGridProdutos extends TGrid
{

function __construct ($Parent)
{
	$this->ColId = 0;
	$this->ColSel = 10;
	
	$this->store = new GtkTreeStore (TYPE_LONG,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         Gobject::TYPE_BOOLEAN,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_LONG,
                                         TYPE_LONG,
                                         TYPE_LONG,
                                         TYPE_LONG,
                                         TYPE_LONG,
                                         TYPE_LONG,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING,
                                         TYPE_STRING);

	$this->colunas = array (array ('Id.',           'text', 0),
		                array ('Grupo',         'text', 1),
				array ('Marca',         'text', 2),
				array ('Modelo',        'text', 3),
				array ('Descricao',     'text', 4),
				array ('Ativo',         'active', 5),
				array ('Custo',         'text', 6),
				array ('Margem',        'text', 7),
				array ('Percentual',    'text', 8),
				array ('ICMS',          'text', 9),
				array ('IPI',           'text', 10),
				array ('Clas. Fiscal',  'text', 11),
				array ('Qtde Min.',     'text', 12),
				array ('Cota Compra',   'text', 13),
				array ('Cota Venda',    'text', 14),
				array ('Situacao',      'text', 15),
				array ('Tipo',          'text', 16),
				array ('Unid. Compra',  'text', 17),
				array ('Unid. Venda',   'text', 18),
				array ('Unid. Estoque', 'text', 19));
	
	parent::__construct ($Parent);
}

}; // TGridProdutos

?>
