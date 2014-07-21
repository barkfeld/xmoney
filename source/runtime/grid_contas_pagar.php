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

class TGridContasPagar extends TGrid
{

function __construct ($Parent)
{
    $this->ColId = 1;
    $this->ColSel = 0;
    
    $this->store = new GtkTreeStore (GObject::TYPE_BOOLEAN,
				     TYPE_LONG,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_LONG,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING);
    
    $this->colunas = array (array ('Sel',              'active', 0),
			    array ('Id.',              'text', 1),
                            array ('Filial',           'text', 2),
			    array ('Fornecedor',       'text', 3),
	                    array ('Tipo do Doc.',     'text', 4),
			    array ('Num. do Doc.',     'text', 5),
			    array ('Parcela',          'text', 6),
			    array ('Valor do Doc. R$', 'text', 7),
			    array (latin1 ('Emissão'), 'text', 8),
			    array ('Vencimento',       'text', 9));
    
    parent::__construct ($Parent);
}

}; // TGridContasPagar

?>
