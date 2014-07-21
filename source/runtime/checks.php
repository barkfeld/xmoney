<?php

/*
 * X-Money - Gestao Empresarial Integrada
 *
 * Copyright (C) 2010 - Eneias Ramos de Melo <neneias@gmail.com>
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

function CheckPermissao ($Owner, $tag, $show = false)
{
    $db = new Database ($Owner, true);
    if (!$db->link) return;
    
    $sql = 'SELECT * FROM Vw_Permissoes';
    
    $db->multi_query ($sql . ' WHERE CodPerfil = ' . $GLOBALS ['CodPerfil'] . ' AND Alias = ' . String ($tag));
    
    if ($db->line ())
    {
	return true;
    }
    else
    {
	if ($show) new Message ($Owner, latin1 ('Você não tem permissão para acessar esse recurso no sistema!'));
    }
}

function CheckSistema ()
{
    $config = parse_ini_file (XMONEY_CONF_SERVIDOR);
    $pdf_viewer = $config ['pdf_viewer'];
    $GLOBALS ['PDF_VIEWER'] = $pdf_viewer ? $pdf_viewer : 'evince';
    
    $pdf_viewer = $config ['mail_viewer'];
    $GLOBALS ['MAIL_VIEWER'] = $mail_viewer ? $mail_viewer : 'thunderbird';
    
    $debug = $config ['debug'];
    $GLOBALS ['DEBUG'] = $debug ? $debug : '0';
}

?>
