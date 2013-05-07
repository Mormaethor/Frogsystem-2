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

$persisinterview_list = '';
$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persisinterview` ORDER BY persisinterview_name', $db);
while ($persisinterview_arr = mysql_fetch_assoc($index))
{
  // Username auslesen
  $index3 = mysql_query('SELECT user_name FROM `'.$global_config_arr['pref'].'user` WHERE user_id = '.$persisinterview_arr['persisinterview_posterid'], $db);
  $persisinterview_arr['user_name'] = mysql_result($index3, 0, 'user_name');

  switch ($persisinterview_arr['persisinterview_spiel'])
  {
    case 1:
         $persisinterview_arr['persisinterview_spiel'] = 'Neverwinter Nights';
         break;
    case 2:
         $persisinterview_arr['persisinterview_spiel'] = 'Neverwinter Nights 2';
         break;
    default:
         $persisinterview_arr['persisinterview_spiel'] = '(unbekanntes Spiel)';
         break;
  }

  $template = new template();
  $template->setFile('0_persistent_worlds.tpl');
  $template->load('interview_list_entry');

  $template->tag('spiel', $persisinterview_arr['persisinterview_spiel']);
  $template->tag('link', $persisinterview_arr['persisinterview_link']);
  $template->tag('name', $persisinterview_arr['persisinterview_name']);
  $template->tag('username', $persisinterview_arr['user_name']);

  $persisinterview_list .= $template->display();
}
unset($persistent_arr);

if ($persisinterview_list==='')
{
  $template = new template();
  $template->setFile('0_persistent_worlds.tpl');
  $template->load('interview_list_no_entries');
  $persisinterview_list = $template->display();
}

$template = new template();
$template->setFile('0_persistent_worlds.tpl');
$template->load('interview_list_body');

$template->tag('text', $persisinterview_list);
unset($persisinterview_list);

$template = $template->display();
?>