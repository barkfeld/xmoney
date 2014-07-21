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

class TGridEndFornecedores extends TGrid
{

function __construct ($Parent)
{
    $this->ColId = 0;
    // $this->ColSel = 9;
    
    $this->store = new GtkTreeStore (TYPE_LONG,
                                     TYPE_STRING,
	                             TYPE_STRING,
				     TYPE_STRING,
	                             TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING);
    
    $this->colunas = array (array ('Id.',                 'text', 0),
    	                    array ('Tipo',                'text', 1),
                            array (latin1 ('Endereço'),   'text', 2),
                            array ('CEP',                 'text', 3),
			    array ('Bairro',              'text', 4),
			    array ('Cidade',              'text', 5),
			    array ('Estado',              'text', 6),
			    array ('Contato',             'text', 7),
			    array ('Fone',                'text', 8),
			    array (latin1 ('Referência'), 'text', 9));
    
    parent::__construct ($Parent);
}

}; // TGridEndFornecedores

?>
