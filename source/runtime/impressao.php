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

function impressao_geral ($modulo, $filtro = null)
{
    file_put_contents (XMONEY_SPOOL . DIRECTORY_SEPARATOR . $GLOBALS ['CodUsuario'] . '.sql', $filtro);
    
    if (($fp = popen (XMONEY_IMP_GERAL . ' ' . XMONEY_DATABASES . DIRECTORY_SEPARATOR . $GLOBALS ['DB_CONNECTION_NAME'] . '/print/' . $modulo, 'r')) < 0)
    {
	new Message ($GLOBALS ['XMONEY_JANELA_PRINCIPAL'], latin1 ('Ops! Não consegui gerar o relatório de impressão!'), Gtk::MESSAGE_ERROR);
	return;
    }
    else
    {
	while (!feof ($fp))
	{
        print fread ($fp, 1024);
        flush(); 
	}
	pclose ($fp);
    }
    
    if (vis_impressao () != 0)
    {
	new Message ($this, latin1 ('Ops! Não consegui executar o visualizador de impressão!'), Gtk::MESSAGE_ERROR);
	return;
    }
    
    return true;
}

function exec_prog_impressao ()
{
	$fp = popen ($GLOBALS ['PDF_VIEWER'] . ' "' . XMONEY_SPOOL . DIRECTORY_SEPARATOR . $GLOBALS ['CodUsuario'] . '.pdf"', 'r');
	while (!feof ($fp))
	{
	  print fread ($fp, 1024);
        flush(); 
	}
	$GLOBALS ['PRINT_STATUS'] = pclose ($fp);
}

function vis_impressao ()
{
    if (WIN_OS)
    {
        exec_prog_impressao ();

        return;
    }

    $pid = pcntl_fork ();
    if ($pid < 0)
    {
	new Message ($this, 'Erro Interno Fatal chamando FORK!', Gtk::MESSAGE_ERROR);
	die ('vis_impressao::fork');
    }
    else if ($pid == 0)
    {
        exec_prog_impressao ();

	posix_kill (getmypid (), 9);
    }
    else
    {
	pcntl_wait ($pid);
    }
    
    return $GLOBALS ['PRINT_STATUS'];
}

?>
