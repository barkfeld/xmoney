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

require_once 'classes/cargos.php';
require_once 'classes/deptos.php';
require_once 'classes/est_civil.php';
require_once 'classes/filiais.php';
require_once 'classes/perfis.php';
require_once 'classes/sexos.php';

class TEditaUsuarios extends TJanela
{

/*
 * operacao:
 * i => incluir
 * a => alterar
 */
function __construct ($Parent, $operacao = 'i', $CodUsuario = null)
{
    parent::__construct ($operacao == 'i' ? latin1 ('Usuário - Incluir') : latin1 ('Usuário - Alterar'),
                         null, null, 'usuarios.png');
    
    $this->Parent = $Parent;
    $this->operacao = $operacao;
    $this->CodUsuario = $CodUsuario;
    
    $GLOBALS ['XMONEY_FIELD'] = 'Cod_S_Usuario';
    $GLOBALS ['XMONEY_FIELD_ID'] = $CodUsuario ? $CodUsuario : -1;

    // Id
    $this->pack_start ($hbox = new GtkHBox);
    if ($operacao == 'a')
    {
	$hbox->pack_start ($id = new GtkLabel, false);
	$id->set_markup (' Id.: <b>' . $CodUsuario . '</b>');
    }
    
    // Informacoes
    $this->pack_start ($frame = new GtkFrame (latin1 (' Informações ')));
    $frame->set_border_width (5);
    $frame->add ($vbox = new GtkVBox);
    $vbox->set_border_width (5);
    
    // filial
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->filial = new TFiliais ($this));
    
    // perfil
    $hbox->pack_start ($this->perfil = new TPerfis ($this));
    
    // usuario
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (latin1 (' Usuário: ')), false);
    $hbox->pack_start ($this->usuario = new AEntry (true, true, 'Tb_Usuarios', 'Usuario'));
    
    // ativo
    $hbox->pack_start ($this->ativo = new GtkCheckButton (' Ativo '), false);
    $this->ativo->set_active (1);
    
    // senha
    $hbox->pack_start (new GtkLabel (' Senha: '), false);
    $hbox->pack_start ($this->senha = new AEntry);
    $this->senha->entry->set_visibility (false);
    
    // alterar senha
    $hbox->pack_start ($this->alterar_senha = new GtkCheckButton (' Alterar '), false);
    
    // nome
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Nome: '), false);
    $hbox->pack_start ($this->nome = new AEntry (true, true, 'Tb_Usuarios', 'Nome'));
    
    // endereço
    $hbox->pack_start (new GtkLabel (latin1 (' Endereço: ')), false);
    $hbox->pack_start ($this->endereco = new AEntry (true));
    
    // bairro
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Bairro: '), false);
    $hbox->pack_start ($this->bairro = new AEntry (true));
    
    // cep
    $hbox->pack_start (new GtkLabel (' CEP: '), false);
    $hbox->pack_start ($this->cep = new IEntry (true));
    
    // cidade
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Cidade: '), false);
    $hbox->pack_start ($this->cidade = new AEntry (true));

    // estado
    $hbox->pack_start ($this->estado = new TEstados ($this));
    
    // cpf
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' CPF: '), false);
    $hbox->pack_start ($this->cpf = new IEntry (true, true, 'Tb_Usuarios', 'CPF'));
    
    // rg
    $hbox->pack_start (new GtkLabel (' RG: '), false);
    $hbox->pack_start ($this->rg = new IEntry (true, true, 'Tb_Usuarios', 'RG'));
    
    // nascimento
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->data_nasc = new TData (true));
    $this->data_nasc->label->set_text (' Nascimento: ');
    
    // sexo
    $hbox->pack_start ($this->sexo = new TSexos ($this));
    
    // estado civil
    $hbox->pack_start ($this->est_civil = new TEstCivil ($this));
    
    // dependentes
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Dependentes: '), false);
    $hbox->pack_start ($this->dependentes = new IEntry);
    
    // filhos
    $hbox->pack_start (new GtkLabel (' Filhos: '), false);
    $hbox->pack_start ($this->filhos = new IEntry);
    
    // cracha
    $hbox->pack_start (new GtkLabel (' Cracha: '), false);
    $hbox->pack_start ($this->cracha = new IEntry);
    
    // depto
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->depto = new TDeptos ($this));
    
    // cargo
    $hbox->pack_start ($this->cargo = new TCargos ($this));
    
    // Tel
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start (new GtkLabel (' Tel.: '), false);
    $hbox->pack_start ($this->tel = new IEntry (true));
    
    // Cel
    $hbox->pack_start (new GtkLabel (' Cel.: '), false);
    $hbox->pack_start ($this->cel = new IEntry);
    
    // email
    $hbox->pack_start (new GtkLabel (' e-mail: '), false);
    $hbox->pack_start ($this->email = new AEntry);
    
    // data adm.
    $vbox->pack_start ($hbox = new GtkHBox, false);
    $hbox->pack_start ($this->data_adm = new TData);
    $this->data_adm->label->set_text (latin1 ('Admissão'));
    
    // Data homo.
    $hbox->pack_start ($this->data_homo = new TData);
    $this->data_homo->label->set_text (latin1 ('Homologação'));
    
    // Data resicao
    $hbox->pack_start ($this->data_resc = new TData);
    $this->data_resc->label->set_text (latin1 ('Rescisão'));
    
    // ok
    $this->pack_start ($hbbox = new GtkHButtonBox, false);
    $hbbox->set_layout (Gtk::BUTTONBOX_END);
    $hbbox->pack_start ($this->ok = GtkButton::new_from_stock ('gtk-ok'), false);
    $this->ok->connect ('clicked', array ($this, 'ok_clicked'));
    
    // cancelar
    $hbbox->pack_start ($this->cancelar = GtkButton::new_from_stock ('gtk-cancel'), false);
    $this->cancelar->connect ('clicked', array ($this, 'cancelar_clicked'));
    $this->cancelar->add_accelerator ('clicked', $this->accel_group, Gdk::KEY_Escape, 0, 0);
    
    $this->children_show_all ();
    $this->data_resc->set_next_focus ($this->ok);
    $this->usuario->set_focus ();
}

function ok_clicked ()
{
    if ($this->grava_dados ())
    {
	$this->Parent->pega_dados ();
	
	if ($this->operacao == 'i') $this->limpa_dados ();
	else $this->destroy ();
    }
}

function cancelar_clicked ()
{
    $this->destroy ();
}

function pega_dados ()
{
    $db = new Database ($this, true);
    if (!$db->link) return;
    
    /*
     * Dados
     */
    if (!$db->multi_query (' SELECT * FROM Vw_Usuarios WHERE Id = ' . $this->CodUsuario)) return;
    
    if (!$line = $db->line ()) return;
    
    $this->filial->combobox->set_active_iter ($this->filial->it [$line ['CodFilial']]);
    $this->perfil->combobox->set_active_iter ($this->perfil->it [$line ['CodPerfil']]);
    $this->usuario->set_text ($line ['Usuario']);
    $this->nome->set_text ($line ['Nome']);
    $this->ativo->set_active ($line ['Ativo']);
    $this->endereco->set_text ($line ['Endereco']);
    $this->bairro->set_text ($line ['Bairro']);
    $this->cep->set_text ($line ['CEP']);
    $this->cidade->set_text ($line ['Cidade']);
    $this->estado->combobox->set_active_iter ($this->estado->it [$line ['CodEstado']]);
    $this->cpf->set_text ($line ['CPF']);
    $this->rg->set_text ($line ['RG']);
    $this->sexo->combobox->set_active_iter ($this->sexo->it [$line ['CodSexo']]);
    $this->est_civil->combobox->set_active_iter ($this->est_civil->it [$line ['CodEstCivil']]);
    $this->dependentes->set_text ($line ['Dependentes']);
    $this->filhos->set_text ($line ['Filhos']);
    $this->depto->combobox->set_active_iter ($this->depto->it [$line ['CodDepto']]);
    $this->cargo->combobox->set_active_iter ($this->cargo->it [$line ['CodCargo']]);
    $this->cracha->set_text ($line ['Cracha']);
    $this->email->set_text ($line ['Email']);
    $this->tel->set_text ($line ['Tel']);
    $this->cel->set_text ($line ['Cel']);
    $this->data_nasc->set_text (FDate ($line ['Nascimento']));
    $this->data_adm->set_text (FDate ($line ['Admissao']));
    $this->data_homo->set_text (FDate ($line ['Homologacao']));
    $this->data_resc->set_text (FDate ($line ['Rescisao']));
    
    return true;
}

function limpa_dados ()
{
    $this->usuario->set_text ('');
    $this->nome->set_text ('');
    $this->senha->set_text ('');
    $this->endereco->set_text ('');
    $this->bairro->set_text ('');
    $this->cep->set_text ('');
    $this->cidade->set_text ('');
    $this->cpf->set_text ('');
    $this->rg->set_text ('');
    $this->dependentes->set_text ('');
    $this->filhos->set_text ('');
    $this->cracha->set_text ('');
    $this->email->set_text ('');
    $this->tel->set_text ('');
    $this->cel->set_text ('');
    $this->data_nasc->set_text ('');
    $this->data_adm->set_text ('');
    $this->data_homo->set_text ('');
    $this->data_resc->set_text ('');
    
    $this->usuario->set_focus ();
}

function grava_dados ()
{
    if (!$this->check_dados ()) return;
    
    $db = new Database ($this, false);
    if (!$db->link) return;
    
    $usuario = $this->usuario->get_text ();
    $nome = $this->nome->get_text ();
    $senha = $this->senha->get_text ();
    $endereco = $this->endereco->get_text ();
    $bairro = $this->bairro->get_text ();
    $cep = $this->cep->get_text ();
    $cidade = $this->cidade->get_text ();
    $cpf = $this->cpf->get_text ();
    $rg = $this->rg->get_text ();
    $dependentes = $this->dependentes->get_text ();
    $filhos = $this->filhos->get_text ();
    $cracha = $this->cracha->get_text ();
    $email = $this->email->get_text ();
    $tel = $this->tel->get_text ();
    $cel = $this->cel->get_text ();
    $data_nasc = CDate ($this->data_nasc->get_text ());
    $data_adm = CDate ($this->data_adm->get_text ());
    $data_homo = CDate ($this->data_homo->get_text ());
    $data_resc = CDate ($this->data_resc->get_text ());
    
    if ($this->operacao == 'i') $sql = 'call SP_Usuario_Inc';
    else $sql = 'call SP_Usuario_Alt';
    
    $data = $sql . '(' .
	    String ($this->CodUsuario) . ',' .
	    String ($this->filial->CodFilial) . ',' .
	    String ($this->estado->CodEstado) . ',' .
	    String ($this->est_civil->CodEstCivil) . ',' .
	    String ($this->perfil->CodPerfil) . ',' .
	    String ($usuario) . ',' .
            String ($nome) . ',' .
            String ($this->ativo->get_active ()) . ',' .
            String ($endereco) . ',' .
            String ($bairro) . ',' .
            String ($cep) . ',' .
            String ($cidade) . ',' .
            String ($cpf) . ',' .
            String ($rg) . ',' .
            String ($data_nasc) . ',' .
            String ($this->sexo->CodSexo) . ',' .
            String ($dependentes) . ',' .
            String ($filhos) . ',' .
            String ($this->depto->CodDepto) . ',' .
            String ($this->cargo->CodCargo) . ',' .
            String ($cracha) . ',' .
            String ($tel) . ',' .
            String ($cel) . ',' .
            String ($email) . ',' .
            String ($data_adm) . ',' .
            String ($data_homo) . ',' .
            String ($data_resc) . ',' .
	    $GLOBALS ['CodUsuario'] .
	    ');';
    
    if (!$db->multi_query ($data)) return;
    
    $line = $db->line ();
    $CodUsuario = $line ['CodUsuario'];
    $mensagem = $line ['Mensagem'];
    
    // limpa BUFFER
    while ($db->line ());
    
    if ($this->alterar_senha->get_active ())
    {
	if (!$CodUsuario) $CodUsuario = $this->CodUsuario;
	
	$sql = ' UPDATE Tb_Usuarios SET Senha = ' . String (md5 ($usuario . '@' . $senha)) . ' WHERE Cod_S_Usuario = ' . $CodUsuario;
	$db->query ($sql);
    }
    
    new Message ($this, $mensagem);
    
    return true;
}

}; // TEditaUsuario

?>
