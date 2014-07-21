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

require_once 'db.php';
require_once 'dialogs.php';
require_once 'suporte.php';

class TWizard extends GtkDialog
{

var $setup_area, $connection, $build_db, $progress, $ok, $cancel;
var $host_master, $username_master, $password_master, $database_master, $port_master;
var $host_slave, $username_slave, $password_slave, $database_slave, $port_slave, $slave_db;

function __construct ()
{
    parent::__construct ();
    
    $this->set_border_width (10);
    $this->set_title (latin1 ('Configuração do X-Money'));
    $this->set_icon_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png');
    
    $this->vbox->pack_start ($hbox = new GtkHBox);
    $hbox->pack_start (GtkImage::new_from_file (XMONEY_IMAGES . DIRECTORY_SEPARATOR . 'logo.png'));
    $hbox->pack_start ($vbox = new GtkVBox);
    $vbox->pack_start ($label = new GtkLabel, false);
    $label->set_markup (latin1 ("\n\n<b>Olá! Bem-vindo ao assistente de configuração do X-Money!</b>\n\n" .
                                "Antes de iniciar o sistema, preciso coletar algumas informações."));
    $this->vbox->pack_start (new GtkHSeparator, false);
    $this->vbox->pack_start ($this->setup_area = new GtkVBox);
    
    $this->ok = $this->add_button ('Co_nectar', Gtk::RESPONSE_OK);
    $this->cancel = $this->add_button ('_Cancelar', Gtk::RESPONSE_CANCEL);
    $this->vbox->show_all ();
}

function get_config ()
{
    // Leitura conf. do usuario
    $config = parse_ini_file (XMONEY_HOME . DIRECTORY_SEPARATOR . XMONEY_CONF_HOME);
    if ($config)
    {
	/*
	 * Escrita
	 */
	$connection_type = $config ['connection_type'];
	$connection_name = $config ['connection_name'];
	$host_master = $config ['host_master'];
	$username_master = $config ['username_master'];
	$password_master = $config ['password_master'];
	$database_master = $config ['database_master'];
	$port_master = $config ['port_master'];
	
	/*
	 * Leitura
	 */
	$host_slave = $config ['host_slave'];
	$username_slave = $config ['username_slave'];
	$password_slave = $config ['password_slave'];
	$database_slave = $config ['database_slave'];
	$port_slave = $config ['port_slave'];
	
	if (!isset ($connection_type) || !isset ($connection_name)
	    || !$host_master || !$username_master || !$password_master || !$database_master || !$port_master
	    || !$host_slave || !$username_slave || !$password_slave || !$database_slave || !$port_slave)
	{
	    new Message ($this, latin1 ('Configuração de acesso ao banco de dados inválida!'), Gtk::MESSAGE_ERROR);
	}
	else
	{
	    /*
	     * Escrita
	     */
	    $GLOBALS ['DB_CONNECTION_TYPE'] = $connection_type;
	    $GLOBALS ['DB_CONNECTION_NAME'] = $connection_name;
	    $GLOBALS ['DB_HOST_MASTER'] = $host_master;
	    $GLOBALS ['DB_USERNAME_MASTER'] = $username_master;
	    $GLOBALS ['DB_PASSWORD_MASTER'] = $password_master;
	    $GLOBALS ['DB_NAME_MASTER'] = $database_master;
	    $GLOBALS ['DB_PORT_MASTER'] = $port_master ? $port_master : 3306;
	    
	    /*
	     * Leitura
	     */
	    $GLOBALS ['DB_HOST_SLAVE'] = $host_slave;
	    $GLOBALS ['DB_USERNAME_SLAVE'] = $username_slave;
	    $GLOBALS ['DB_PASSWORD_SLAVE'] = $password_slave;
	    $GLOBALS ['DB_NAME_SLAVE'] = $database_slave;
	    $GLOBALS ['DB_PORT_SLAVE'] = $port_slave ? $port_slave : 3306;
	    
	    return true;
	}
    }
}

function destroy_setup_area ()
{
    $children = $this->setup_area->get_children ();
    foreach ($children as $child) $child->destroy ();
}

function slave_db_toggled ($button)
{
    $this->host_slave->set_sensitive ($button->active);
    $this->username_slave->set_sensitive ($button->active);
    $this->password_slave->set_sensitive ($button->active);
    $this->database_slave->set_sensitive ($button->active);
    $this->port_slave->set_sensitive ($button->active);
    
    if ($button->active)
    {
	$this->host_slave->grab_focus ();
    }
    else
    {
	$this->host_slave->set_text ($this->host_master->get_text ());
	$this->username_slave->set_text ($this->username_master->get_text ());
	$this->password_slave->set_text ($this->password_master->get_text ());
	$this->database_slave->set_text ($this->database_master->get_text ());
	$this->port_slave->set_text ($this->port_master->get_text ());
    }
}

function setup_config ()
{
    $this->destroy_setup_area ();
    
    $this->setup_area->pack_start ($label = new GtkLabel ("\nPrimeiro, preciso saber como conectar ao banco de dados ...\n"), false);
    
    /*
     * Escrita
     */
    // Host
    $this->setup_area->pack_start ($notebook = new GtkNotebook);
    $notebook->append_page ($table = new GtkTable, new GtkLabel (' Escrita '));
    $table->attach (new GtkLabel ('Host:'), 0,1,0,1);
    $table->attach ($this->host_master = new GtkEntry, 1,2,0,1);
    $host_master = $GLOBALS ['DB_HOST_MASTER'];
    $this->host_master->set_text ($host_master ? $host_master : 'localhost');
    
    // Porta
    $table->attach (new GtkLabel ('Porta:'), 2,3,0,1);
    $table->attach ($this->port_master = GtkSpinButton::new_with_range (1, 65535, 1), 3,4,0,1);
    $port_master = $GLOBALS ['DB_PORT_MASTER'];
    $this->port_master->set_value ($port_master ? $port_master : 3306);
    
    // Usuario
    $table->attach (new GtkLabel ('Usuario:'), 0,1,1,2);
    $table->attach ($this->username_master = new GtkEntry, 1,2,1,2);
    $username_master = $GLOBALS ['DB_USERNAME_MASTER'];
    $this->username_master->set_text ($username_master ? $username_master : 'xmoney');
    
    // Senha
    $table->attach (new GtkLabel ('Senha:'), 2,3,1,2);
    $table->attach ($this->password_master = new GtkEntry, 3,4,1,2);
    $this->password_master->set_visibility (false);
    $this->password_master->set_text ($GLOBALS ['DB_PASSWORD_MASTER']);
    
    // Banco
    $table->attach (new GtkLabel ('Nome da Base de Dados:'), 0,1,2,3);
    $table->attach ($this->database_master = new GtkEntry, 1,2,2,3);
    $database_master = $GLOBALS ['DB_NAME_MASTER'];
    $this->database_master->set_text ($database_master ? $database_master : 'xmoney');
    
    // Conexao
    $table->attach ($this->connection = GtkComboBox::new_text (), 2,3,2,3);
    $files = scandir (XMONEY_DATABASES);
    foreach ($files as $ptr => $sfile)
    {
	if ($sfile == '.' || $sfile == '..' || !is_dir (XMONEY_DATABASES . DIRECTORY_SEPARATOR . $sfile)) continue;
	
	$this->connection->append_text ($sfile);
    }
    $connection_type = $GLOBALS ['DB_CONNECTION_TYPE'];
    $this->connection->set_active ($connection_type ? $connection_type : '0');
    
    // Configurar
    $table->attach ($build_db = new GtkCheckButton ('Configurar base de dados'), 3,4,2,3);
    $config = parse_ini_file (XMONEY_CONF_SERVIDOR);
    $build_db->set_sensitive ($config ['build_database']);
    
    EntrySetNextFocus ($this->host_master, $this->port_master);
    EntrySetNextFocus ($this->port_master, $this->username_master);
    EntrySetNextFocus ($this->username_master, $this->password_master);
    EntrySetNextFocus ($this->password_master, $this->database_master);
    
    /*
     * Leitura
     */
    // Banco
    $notebook->append_page ($table = new GtkTable, new GtkLabel (' Leitura '));
    $table->attach (new GtkLabel ('Host:'), 0,1,0,1);
    $table->attach ($this->host_slave = new GtkEntry, 1,2,0,1);
    $host_slave = $GLOBALS ['DB_HOST_SLAVE'];
    $this->host_slave->set_text ($host_slave ? $host_slave : 'localhost');
    
    // Porta
    $table->attach (new GtkLabel ('Porta:'), 2,3,0,1);
    $table->attach ($this->port_slave = GtkSpinButton::new_with_range (1, 65535, 1), 3,4,0,1);
    $port_slave = $GLOBALS ['DB_PORT_SLAVE'];
    $this->port_slave->set_value ($port_slave ? $port_slave : 3306);
    
    // Usuario
    $table->attach (new GtkLabel ('Usuario:'), 0,1,1,2);
    $table->attach ($this->username_slave = new GtkEntry, 1,2,1,2);
    $username_slave = $GLOBALS ['DB_USERNAME_SLAVE'];
    $this->username_slave->set_text ($username_slave ? $username_slave : 'xmoney');
    
    // Senha
    $table->attach (new GtkLabel ('Senha:'), 2,3,1,2);
    $table->attach ($this->password_slave = new GtkEntry, 3,4,1,2);
    $this->password_slave->set_visibility (false);
    
    // Banco
    $table->attach (new GtkLabel ('Nome da Base de Dados:'), 0,1,2,3);
    $table->attach ($this->database_slave = new GtkEntry, 1,2,2,3);
    $database_slave = $GLOBALS ['DB_NAME_SLAVE'];
    $this->database_slave->set_text ($database_slave ? $database_slave : 'xmoney');
    
    // Usar separadamente
    $table->attach ($slave_db = new GtkCheckButton ('Usar separadamente'), 3,4,2,3);
    $slave_db->connect ('toggled', array ($this, 'slave_db_toggled'));
    $config = parse_ini_file (XMONEY_CONF_SERVIDOR);
    $slave_db->set_sensitive ($config ['slave_database']);
    $slave_db->toggled ();
    
    EntrySetNextFocus ($this->host_slave, $this->port_slave);
    EntrySetNextFocus ($this->port_slave, $this->username_slave);
    EntrySetNextFocus ($this->username_slave, $this->password_slave);
    EntrySetNextFocus ($this->password_slave, $this->database_slave);
    
    $this->setup_area->show_all ();
    $this->host_master->grab_focus ();
    $response = parent::run ();
    
    /*
     * Escrita
     */
    $connection_type = $this->connection->get_active ();
    $connection_name = $this->connection->get_active_text ();
    $host_master = $this->host_master->get_text ();
    $username_master = $this->username_master->get_text ();
    $password_master = $this->password_master->get_text ();
    $database_master = $this->database_master->get_text ();
    $port_master = $this->port_master->get_text ();
    $this->build_db = $build_db->get_active ();
    
    /*
     * Leitura
     */
    $slave_db->toggled ();
    $host_slave = $this->host_slave->get_text ();
    $username_slave = $this->username_slave->get_text ();
    $password_slave = $this->password_slave->get_text ();
    $database_slave = $this->database_slave->get_text ();
    $port_slave = $this->port_slave->get_text ();
    
    if ($response != Gtk::RESPONSE_OK) exit (1);
    
    file_put_contents (XMONEY_HOME . DIRECTORY_SEPARATOR . XMONEY_CONF_HOME,
	               "connection_type = " . $connection_type . "\n" .
	               "connection_name = " . $connection_name . "\n" .
	               "host_master     = " . $host_master . "\n" .
	               "username_master = " . $username_master . "\n" .
	               "password_master = " . $password_master . "\n" .
	               "database_master = " . $database_master . "\n" .
	               "port_master     = " . $port_master . "\n" .
	               "host_slave     = " . $host_slave . "\n" .
	               "username_slave = " . $username_slave . "\n" .
	               "password_slave = " . $password_slave . "\n" .
	               "database_slave = " . $database_slave . "\n" .
	               "port_slave = " . $port_slave . "\n");
    
    return true;
}

function test_connection ()
{
    $master = new Database ($this, false);
    $slave = new Database ($this, true);
    
    return $master->link && $slave->link;
}

function setup_db ()
{
    $this->destroy_setup_area ();
    
    $this->setup_area->pack_start ($label = new GtkLabel);
    $label->set_markup ("\nAgora vou configurar a base de dados do sistema!\nClique em <b>Configurar</b> para continuar ...\n");
    $this->ok->child->set_markup ('<b>Configurar</b>');
    $this->setup_area->pack_start ($info = new GtkLabel);
    $this->setup_area->pack_start ($pass = new GtkLabel);
    $this->setup_area->pack_start ($this->progress = new GtkProgressBar);
    $this->setup_area->show_all ();
    
    $response = parent::run ();
    if ($response == Gtk::RESPONSE_OK)
    {
	$info->set_markup ('<b>Configurando base de dados para o X-Money ...</b>');
	$this->cancel->set_sensitive (false);
	$this->ok->set_sensitive (false);
	
	$connection = $this->connection->get_active_text ();
	$path = XMONEY_DATABASES . DIRECTORY_SEPARATOR . $connection;
	
	// comandos SQL
	$commands = parse_ini_file ($path . DIRECTORY_SEPARATOR . 'commands.conf');
	$sql_cmd = $commands ['command'];
	$sql_host_opt = $commands ['host_option'];
	$sql_username_opt = $commands ['username_option'];
	$sql_password_opt = $commands ['password_option'];
	$sql_database_opt = $commands ['database_option'];
	$sql_port_opt = $commands ['port_option'];
	if (!$sql_cmd
	    || !$sql_host_opt || !$sql_username_opt || !$sql_password_opt
	    || !$sql_database_opt || !$sql_port_opt)
	{
	    new Message ($this, latin1 ("Informações inválidas para construir a base de dados!\nPor favor, verifique!"), Gtk::MESSAGE_ERROR);
	    $this->cancel->set_sensitive (true);
	    $this->ok->set_sensitive (true);
	    $this->ok->grab_focus ();
	    
	    return;
	}
	else
	{
	    $GLOBALS ['SQL_COMMAND'] = $sql_cmd;
	    $GLOBALS ['SQL_HOST_OPTION'] = $sql_host_opt;
	    $GLOBALS ['SQL_USERNAME_OPTION'] = $sql_username_opt;
	    $GLOBALS ['SQL_PASSWORD_OPTION'] = $sql_password_opt;
	    $GLOBALS ['SQL_DATABASE_OPTION'] = $sql_database_opt;
	    $GLOBALS ['SQL_PORT_OPTION'] = $sql_port_opt;
	}
	
	$pass->set_text ('Tabelas ...');
	DoIteration ();
	$tables_retval = $this->mysql_script_dir ($path . DIRECTORY_SEPARATOR . 'tables');
	
	$pass->set_text ('Visoes ...');
	DoIteration ();
	$views_retval = $this->mysql_script_dir ($path . DIRECTORY_SEPARATOR . 'views');
	
	$pass->set_text ('Procedimentos ...');
	DoIteration ();
	$procedures_retval = $this->mysql_script_dir ($path . DIRECTORY_SEPARATOR . 'procedures');
	
	if ($tables_retval && $views_retval && $procedures_retval)
	{
	    new Message ($this, latin1 ("Agora você pode acessar o sistema!\n" .
	                                "Na tela de login use admin tanto para usuário como para a senha."));
	    return true;
	}
	else
	{
	    new Message ($this, 'Falhou! Por favor, tente novamente!', Gtk::MESSAGE_ERROR);
	    $this->cancel->set_sensitive (true);
	    $this->ok->set_sensitive (true);
	    $this->ok->grab_focus ();
	}
    }
    else
    {
	exit (1);
    }
}

function mysql_script_dir ($path)
{
    $files = scandir ($path);
    $cfiles = count ($files);
    
    $result = true;
    
    foreach ($files as $ptr => $sfile)
    {
	if ($sfile == '.' || $sfile == '..' || is_dir ($path . DIRECTORY_SEPARATOR . $sfile)) continue;
	
	if ($this->mysql_script_file ($path, $sfile))
	{
	    $this->progress->set_fraction ((($ptr * 100) / $cfiles) / 100);
	    DoIteration ();
	}
	else
	{
	    $result = false;
	    break;
	}
    }
    
    $this->progress->set_fraction (1);
    DoIteration ();
    
    return $result;
}

function mysql_script_file ($path, $file)
{
    printf ("Importando: %s\n", $file);
    
    system ($GLOBALS ['SQL_COMMAND'] . ' ' . $GLOBALS ['SQL_HOST_OPTION'] . '=' . $GLOBALS ['DB_HOST_MASTER'] . ' ' .
            $GLOBALS ['SQL_USERNAME_OPTION'] . '=' . $GLOBALS ['DB_USERNAME_MASTER'] . ' ' .
            $GLOBALS ['SQL_PASSWORD_OPTION'] . '=' . $GLOBALS ['DB_PASSWORD_MASTER'] . ' ' .
            $GLOBALS ['SQL_DATABASE_OPTION'] . '=' . $GLOBALS ['DB_NAME_MASTER'] . ' ' .
            $GLOBALS ['SQL_PORT_OPTION'] . '=' . $GLOBALS ['DB_PORT_MASTER'] . ' ' .
            ' < ' . $path . DIRECTORY_SEPARATOR . $file, $retval);
    
    if ($retval != 0) die (1);
    
    return $retval == 0 ? true : false;
}

function run ()
{
    while (true)
    {
	if (!$this->get_config () || !$this->test_connection ())
	{
	    if ($this->setup_config ()) continue;
	}
	
	if (!$this->build_db) break;
	
	if (!$this->setup_db ()) continue;
	else $this->build_db = false;
    }
}

}; // TWizard


function ExecWizard ()
{
    $wizard = new TWizard;
    $wizard->run ();
    $wizard->destroy ();
}

?>
