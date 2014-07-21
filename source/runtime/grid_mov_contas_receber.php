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

class TGridMovContasReceber extends TGrid
{

function __construct ($Parent)
{
    $this->ColId = 0;
    //$this->ColSel = 16;
    
    $this->store = new GtkTreeStore (TYPE_LONG,
                                     TYPE_LONG,
                                     TYPE_STRING,
                                     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING,
				     TYPE_STRING);
    
    $this->colunas = array (array ('Id.',                     'text', 0),
                            array ('Cod. Conta',              'text', 1),
                            array ('Filial',                  'text', 2),
                            array ('Cliente',                 'text', 3),
                            array ('Num. Doc.',               'text', 4),
			    array (latin1 ('Conta Bancária'), 'text', 5),
			    array ('Tipo de Despesa',         'text', 6),
			    array ('Forma de Pgto.',          'text', 7),
			    array ('Juros R$',                'text', 8),
			    array ('Desconto R$',             'text', 9),
			    array ('Valor Pago R$',           'text', 10),
			    array ('Dia do Pgto.',            'text', 11));
    
    parent::__construct ($Parent);
}

}; // TGridMovContasReceber

?>
