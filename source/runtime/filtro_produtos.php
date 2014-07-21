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

class TFiltroProdutos extends TFiltro
{

function __construct ($pesquisar)
{
    parent::__construct ($pesquisar);
    
    $this->restaurar_clicked ();
}

function restaurar_clicked ()
{
    $this->limpar ();
    $this->criar_filtro ();
}

function criar_filtro ()
{
    $hbox = $this->add_button ('id', $id = new TInteger);
    $id->set_filter ('Id', 'Tb_Produtos.Cod_S_Produto', ' Id.: ');
    
    $this->add_button ('tipo', new TTipoProduto (null), $hbox);
    $this->add_button ('status', new TSitProduto (null), $hbox);
    
    $hbox = $this->add_button ('grupo', $grupo = new TString);
    $grupo->set_filter ('Grupo', 'Tb_Grupos.Nome', ' Grupo: ');
    
    $this->add_button ('marca', $marca = new TString, $hbox);
    $marca->set_filter ('Marca', 'Tb_Marcas.Nome', ' Marca: ');
    
    $hbox = $this->add_button ('modelo', $modelo = new TString);
    $modelo->set_filter ('Modelo', 'Tb_Produtos.Modelo', ' Modelo: ');
    
    $this->add_button ('desc', $desc = new TString, $hbox);
    $desc->set_filter ('Descricao', 'Tb_Produtos.Descricao', latin1 (' Descrição: '));
}

}; // TFiltroProdutos

?>
