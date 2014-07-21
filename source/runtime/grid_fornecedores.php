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

class TGridFornecedores extends TGrid
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
                                     TYPE_STRING,
                                     TYPE_STRING,
                                     TYPE_STRING,
                                     GObject::TYPE_BOOLEAN);
    
    $this->colunas = array (array ('Id.',                   'text', 0),
                            array (latin1 ('Nome / Razão'), 'text', 1),
                            array ('Fantasia',              'text', 2),
                            array ('CPF / CNPJ',            'text', 3),
                            array ('I.E.',                  'text', 4),
                            array ('Fone',                  'text', 5),
                            array ('Fone 2',                'text', 6),
                            array ('Fax',                   'text', 7),
                            array ('e-mail',                'text', 8),
                            array ('Site',                  'text', 9),
                            array (latin1 ('Anotações'),    'text', 10),
                            array ('Limite de Compra',      'text', 11),
                            array ('Ativo',                 'active', 12));
    
    parent::__construct ($Parent);
}

}; // TGridFornecedores

?>
