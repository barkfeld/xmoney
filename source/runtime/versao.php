<?php

/*
 * X-Money: Gestao Empresarial Integrada
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

define ('WIN_OS', !strncmp (PHP_OS, 'WIN', 3));

define ('XMONEY_MAIOR_VERSAO', 0);
define ('XMONEY_MENOR_VERSAO', 3);
define ('XMONEY_REVISAO_VERSAO', 0);
define ('XMONEY_VERSAO', XMONEY_MAIOR_VERSAO . '.' . XMONEY_MENOR_VERSAO . '.' . XMONEY_REVISAO_VERSAO);
define ('XMONEY_DESC_VERSAO', latin1 ('Versão ') . XMONEY_VERSAO);

define ('XMONEY_IMAGES', WIN_OS ? 'images' : '/usr/share/xmoney/images');
define ('XMONEY_TITULO', 'X-Money');
define ('XMONEY_DESCRICAO', latin1 ('Gestão Empresarial Integrada'));
define ('XMONEY_SITE', 'http://www.gamuza.com.br/xmoney');
define ('XMONEY_COPYRIGHT', latin1 ('Copyright © 2010 Enéias Ramos de Melo'));

define ('XMONEY_CONF_SERVIDOR', WIN_OS ? 'etc/server.conf' : '/etc/xmoney/server.conf');
define ('XMONEY_CONF_HOME', '.xmoney' . DIRECTORY_SEPARATOR . 'sql.conf');
define ('XMONEY_HOME', WIN_OS ? getenv ('HOMEDRIVE') . getenv ('HOMEPATH') : getenv ('HOME'));
define ('XMONEY_DATABASES', WIN_OS ? 'databases' : '/usr/share/xmoney/databases');

define ('XMONEY_IMP_GERAL', WIN_OS ? ' start rel_geral ' : ' /usr/share/xmoney/sbin/print/geral ');
define ('XMONEY_SPOOL', WIN_OS ? XMONEY_HOME . DIRECTORY_SEPARATOR . '.xmoney' . DIRECTORY_SEPARATOR . 'spool' : '/var/spool/xmoney');

define ('XMONEY_LICENCA', WIN_OS ? 'doc' . DIRECTORY_SEPARATOR . 'LICENSE' : '/usr/share/xmoney/doc/LICENSE');
define ('XMONEY_AUTORES', WIN_OS ? 'doc' . DIRECTORY_SEPARATOR . 'AUTHORS' : '/usr/share/xmoney/doc/AUTHORS');

?>
