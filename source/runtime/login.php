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

class TLogin extends GtkDialog
{

var $username, $password, $connected;

function __construct ()
{
    parent::__construct ();
    
    $this->set_border_width (10);
    $this->set_title ('X-Money - Login');
    $this->set_icon_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png');
    
    $this->vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png'));
    $hbox->pack_start ($vbox = new GtkVBox);
    $vbox->pack_start ($frame = new GtkFrame (latin1 (' Digite suas informações para acessar o sistema: ')));
    $frame->set_border_width (10);
    $frame->add ($table = new GtkTable);
    $table->attach (new GtkLabel ('Usuario:'), 0,1,0,1);
    $table->attach ($this->username = new GtkEntry, 1,2,0,1);
    $table->attach (new GtkLabel ('Senha:'), 0,1,1,2);
    $table->attach ($this->password = new GtkEntry, 1,2,1,2);
    $this->password->set_visibility (false);
    
    $this->ok = $this->add_button ('_Ok', Gtk::RESPONSE_OK);
    $this->add_button ('_Cancelar', Gtk::RESPONSE_CANCEL);
    
    EntrySetNextFocus ($this->username, $this->password);
    EntrySetNextFocus ($this->password, $this->ok);
    $this->vbox->show_all ();
}

function run ()
{

$db = new Database ($this, true);
if (!$db->link) exit (1);

while (true)
{
    $this->username->grab_focus ();
    $response = parent::run ();
    $username = $this->username->get_text ();
    $password = $this->password->get_text ();
    
    if ($response != Gtk::RESPONSE_OK) exit (1);
    
    if (!$username || !$password)
    {
	new Message ($this, latin1 ('Usuário e senha devem ser informados!'), Gtk::MESSAGE_ERROR);
	continue;
    }
    
    $sql = 'SELECT Cod_S_Usuario FROM Tb_Usuarios WHERE Ativo = 1 AND Senha LIKE ' . String (md5 ($username . '@' . $password));
    if (!$db->multi_query ($sql)) continue;
    
    if (!$line = $db->line ())
    {
	new Message ($this, latin1 ('Usuário ou senha incorreta!', Gtk::MESSAGE_ERROR));
	continue;
    }
    else
    {
	$CodUsuario = $line ['Cod_S_Usuario'];
	putenv ('XMONEY_UID=' . $CodUsuario);
    }
    
    $sql = 'SELECT * FROM Vw_Usuario_Filial WHERE CodUsuario = ' . $CodUsuario;
    if (!$db->multi_query ($sql)) continue;
    
    if (!$line = $db->line ())
    {
	new Message ($this, latin1 ('Usuário não encontrado!', Gtk::MESSAGE_ERROR));
	continue;
    }
    else
    {
	$GLOBALS ['CodUsuario'] = $CodUsuario;
	$GLOBALS ['Usuario'] = $line ['Usuario'];
	$GLOBALS ['Nome'] = $line ['Nome'];
	$GLOBALS ['CodFilial'] = $line ['CodFilial'];
	$GLOBALS ['Filial'] = $line ['Filial'];
	$GLOBALS ['CodPerfil'] = $line ['CodPerfil'];
	$GLOBALS ['Perfil'] = $line ['Perfil'];
	
	break;
    }
}

}

} // TLogin


function ExecLogin ()
{
    $login = new TLogin;
    $login->run ();
    $login->destroy ();
}

?>
