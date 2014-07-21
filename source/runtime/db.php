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

require_once 'suporte.php';

class Database
{

var $Parent;
var $link, $query, $result, $line;

function __construct ($Owner, $slave)
{
    $this->Parent = $Owner;
    
    $this->link = new mysqli ($slave ? $GLOBALS ['DB_HOST_SLAVE'] : $GLOBALS ['DB_HOST_MASTER'],
                              $slave ? $GLOBALS ['DB_USERNAME_SLAVE'] : $GLOBALS ['DB_USERNAME_MASTER'],
                              $slave ? $GLOBALS ['DB_PASSWORD_SLAVE'] : $GLOBALS ['DB_PASSWORD_MASTER'],
                              $slave ? $GLOBALS ['DB_NAME_SLAVE'] : $GLOBALS ['DB_NAME_MASTER'],
                              $slave ? $GLOBALS ['DB_PORT_SLAVE'] : $GLOBALS ['DB_PORT_MASTER']);
    
    // Obs: Compatibilidade com versoes PHP abaixo de 5.2.9
    if (mysqli_connect_errno ())
    {
	new Message ($Owner, latin1 ("Ops! Não consegui conectar ao banco de dados do sistema!\nPor favor, tente novamente!\n\n") .
	                     mysqli_connect_error (), Gtk::MESSAGE_ERROR);
	$this->link = null;
    }
    else
    {
	$this->link->autocommit (true);
    }
}

function query ($query)
{
    if ($GLOBALS ['DEBUG']) debug ('db::query=' . $query);
    
    if ($this->link->query ($this->query = $query)) return true;
    
    $this->error ();
}

function multi_query ($query)
{
    if ($GLOBALS ['DEBUG']) debug ('db::multi_query=' . $query);
    
    if ($this->link->multi_query ($this->query = $query)) return $this->store_result ();
    
    $this->error ();
}

function error ()
{
    switch ($this->link->errno)
    {
	case 1062: // Dados duplicados
	{
	    new Message ($this->Parent, latin1 ('Alguma informação semelhante já existe no sistema!'));
	    break;
	}
	case 1451: // Foreign key - DELETAR DADOS
	{
	    new Message ($this->Parent, latin1 ('Esse registro é necessário em outras tabelas do sistema!'));
	    break;
	}
	case 1452: // Foreign key - ADD DADOS
	{
	    new Message ($this->Parent, 'Selecione todos os dados das listas suspensas!');
	    break;
	}
	default:
	{
	    new Message ($this->Parent, 'Erro: ' . $this->link->errno . "\n" . $this->link->error, Gtk::MESSAGE_ERROR);
	    break;
	}
    };
}

function store_result ()
{
    if (($this->result = $this->link->store_result ())) return true;
}

function next_result ()
{
    return $this->link->next_result ();
}

function free_result ()
{
    $this->result->free ();
}

function num_rows ()
{
    return $this->result->num_rows;
}

function line ()
{
    $line = $this->result->fetch_array ();
    
    if ($line == null)
    {
	$this->free_result ();
	
	if ($this->next_result ())
	{
	    if ($this->store_result ())
	    {
		return $this->result->fetch_array ();
	    }
	}
    }
    
    return $line;
}

} // Database

?>
