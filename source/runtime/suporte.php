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

/*
 * Ajusta evento para tecla ENTER
 */
function __entry_next_focus_event ($widget, $event, $focus)
{
    if ($event->keyval == Gdk::KEY_Return || $event->keyval == Gdk::KEY_KP_Enter) $focus->grab_focus ();
}

function EntrySetNextFocus ($widget, $focus)
{
    $widget->connect ('key_press_event', '__entry_next_focus_event', $focus);
}

/*
 * Executa eventos pendentes do GTK
 */
function DoIteration ()
{
    while (gtk::events_pending ())
	gtk::main_iteration ();
}

/*
 * Substitui ' ' por '%' ...
 */
function SpacesToPercents ($text)
{
    for ($i = 0; $i < strlen ($text); $i ++)
    {
	$letter = substr ($text, $i, 1);
	$result = $letter == ' ' ? $result . '%' : $result . $letter;
    }
    
    return $result;
}

/*
 * Substitui '.' de string por ','
 */
function PointToComma ($value)
{
    $can_change = true;
    
    for ($i = strlen ($value) - 1; $i >= 0; $i --)
    {
	$letter = substr ($value, $i, 1);
	if ($letter == '.' && $can_change)
	{
	    $letter = ',';
	    $can_change = false;
	}
	
	$result = $letter . $result;
    }
    
    return $result;
}

/*
 * Substitui ',' de string por '.'
 */
function CommaToPoint ($value)
{
    $can_change = true;
    
    for ($i = strlen ($value) - 1; $i >= 0; $i --)
    {
	$letter = substr ($value, $i, 1);
	if ($letter == ',' && $can_change)
	{
	    $letter = '.';
	    $can_change = false;
	}
	
	$result = $letter . $result;
    }
    
    return $result;
}

/*
 * Retorna valor em formato monetario.
 */
function Currency ($value)
{
    return money_format ('%.2n', $value);
}

function IsAlpha ($text)
{
    $errors = 0;
    $length = strlen ($text);
	
    for ($i = 0; $i < $length; $i ++)
    {
	$num = ord (substr ($text, $i, 1));
	
	if ($num == 32 /* Space */
	    || $num == 37 /* % */
	    || $num == 44 /* , */
	    || $num == 45 /* - */
	    || $num == 46 /* . */
	    || $num == 47 /* / */
	    || ($num >=48 && $num <= 57) /* 0-9 */
	    || $num == 64 /* @ */
	    || ($num >= 65 && $num <= 90) /* A-Z */
	    || ($num >= 97 && $num <= 122)) /* a-z */
	    continue;
	else
	    $errors ++;
    }
       
    return ($errors == 0 ? true : false);
}

function IsInt ($text)
{
    $errors = 0;
    $length = strlen ($text);
    
    for ($i = 0; $i < $length; $i ++)
    {
	$num = ord (substr ($text, $i, 1));
	
	if ($num == 32 /* Space */
	    || ($num >=48 && $num <= 57)) /* 0-9 */
	    continue;
	else
	    $errors ++;
    }
    
    return ($errors == 0 ? true : false);
}

function IsString ($text)
{
    $errors = 0;
    $length = strlen ($text);
    
    for ($i = 0; $i < $length; $i ++)
    {
	$num = ord (substr ($text, $i, 1));
	
	if ($num == 32 /* Space */
	    || ($num >=65 && $num <= 90) /* A - Z */
	    || ($num >=97 && $num <= 122)) /* a - z */
	    continue;
	else
	    $errors ++;
    }
    
    return ($errors == 0 ? true : false);
}

/*
 * Converte formato data do MySQL
 * para formato data do Sistema.
 *
 * 2009-03-24 => 24/03/2009
 */
function FDate ($date)
{
    if (!strlen ($date)) return;
    
    $year = substr ($date, 0, 4);
    $month = substr ($date, 5, 2);
    $day = substr ($date, 8, 2);
    
    if ($day >= 1 && $day <= 31
	&& ($month >= 1 && $month <= 12)
	&& ($year >= 1 && $year <= 9999))
	return ($day . '/' . $month . '/' . $year);
}

/*
 * Converte formato data do Sistema
 * para o formato data do MySQL.
 *
 * 23/04/2009 => 2009-04-23
 */
function CDate ($date)
{
    if (!strlen ($date)) return;
    
    $year = substr ($date, 6, 4);
    $month = substr ($date, 3, 2);
    $day = substr ($date, 0, 2);
    
    if ($day >= 1 && $day <= 31
	&& ($month >= 1 && $month <= 12)
	&& ($year >= 1 && $year <= 9999))
	return ($year . '-' . $month . '-' . $day);
}

/*
 * Retorna data e hora do MySQL
 * em formato completo (DATA..HORA)
 * com Data AJUSTADA.
 */
function FDateTime ($date)
{
    $fdate = FDate ($date);
    $ftime = substr ($date, 11);
    if (!strcmp ($ftime, '00:00:00')) $ftime = '';
    
    return $fdate . ' ' . $ftime;
}

/*
 * Coloca aspa simples ' na string ...
 */
function String ($str)
{
    return ("'" . $str . "'");
}

/*
 * Suporte para acentos
 */
function latin1 ($str)
{
    return utf8_decode ($str);
}

/*
 * Mensagens no terminal
 */
function debug ($msg)
{
printf ("debug: [date_time=%s][ssh_client=%s][ssh_tty=%s][user=%s][display=%s][%s]\n",
        strftime ('%c'),
        $_SERVER ['SSH_CLIENT'], $_SERVER ['SSH_TTY'], $_SERVER ['USER'], $_SERVER ['DISPLAY'],
        $msg);
}

?>
