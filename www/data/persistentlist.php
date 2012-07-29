<?php
/*
    Frogsystem Persistent Worlds script
    Copyright (C) 2005-2007  Stefan Bollmann
    Copyright (C) 2012  Thoronador (adjustments for alix5)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

    Additional permission under GNU GPL version 3 section 7

    If you modify this Program, or any covered work, by linking or combining it
    with Frogsystem 2 (or a modified version of Frogsystem 2), containing parts
    covered by the terms of Creative Commons Attribution-ShareAlike 3.0, the
    licensors of this Program grant you additional permission to convey the
    resulting work. Corresponding Source for a non-source form of such a
    combination shall include the source code for the parts of Frogsystem used
    as well as that of the covered work.
*/

if (!isset($_GET['sort'])) $_GET['sort'] = 'name';
switch ($_GET['sort'])
{
  case 'setting':
       $orderrule = 'persistent_setting';
       break;
  case 'genre':
       $orderrule = 'persistent_genre';
       break;
  case 'spiel':
	   $orderrule = 'persistent_spiel';
       break;
  case 'anmeldung':
       $orderrule = 'persistent_anmeldung';
       break;
  case 'spieler':
       $orderrule = 'persistent_maxzahl';
       break;
  case 'level':
       $orderrule = 'persistent_maxlevel';
       break;
  default:
       $orderrule = 'persistent_name';
       break;
}//swi
$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` ORDER BY '.$orderrule, $db);
$persistent_list = '';
while ($persistent_arr = mysql_fetch_assoc($index))
{
    $persistent_arr['persistent_text'] = fscode($persistent_arr['persistent_text'], 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

    switch ($persistent_arr['persistent_spiel'])
    {
      case 1:
           $persistent_arr['persistent_spiel'] = 'NwN';
           break;
      case 2:
           $persistent_arr['persistent_spiel'] = 'NwN 2';
           break;
    }//swi

    $template = new template();
    $template->setFile('0_persistent_worlds.tpl');
    $template->load('list_entry');

    $template->tag('link', $persistent_arr['persistent_link']);
    $template->tag('name', $persistent_arr['persistent_name']);
    $template->tag('setting', $persistent_arr['persistent_setting']);
    $template->tag('genre', $persistent_arr['persistent_genre']);
    $template->tag('spiel', $persistent_arr['persistent_spiel']);
    $template->tag('dlsvu', $persistent_arr['persistent_dlsvu']);
    $template->tag('dlhdu', $persistent_arr['persistent_dlhdu']);
    $template->tag('dlcep', $persistent_arr['persistent_dlcep']);
    $template->tag('anmeldung', $persistent_arr['persistent_anmeldung']);
    $template->tag('maxplayer', $persistent_arr['persistent_maxzahl']);
    $template->tag('maxlevel', $persistent_arr['persistent_maxlevel']);

    $persistent_list .= $template->display();
}
unset($persistent_arr);

$template = new template();
$template->setFile('0_persistent_worlds.tpl');
$template->load('main_body');
$template->tag('text', $persistent_list);

unset($persistent_list);

$template = $template->display();
?>