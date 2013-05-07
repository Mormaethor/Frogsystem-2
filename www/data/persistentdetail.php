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

  require_once(FS2_ROOT_PATH .'includes/persistentfunctions.php');

  $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_link = \''.savesql($_GET['pw'])."'", $db);
  if (($index!==false) && (false!==($persistent_arr = mysql_fetch_assoc($index))))
  {
    //setting
    $query = mysql_query('SELECT setting_id, setting_name FROM `'.$global_config_arr['pref'].'persistent_setting`
                          WHERE setting_id='.$persistent_arr['persistent_setting_id'].' LIMIT 1', $db);
    if ($row = mysql_fetch_assoc($query))
    {
      $persistent_arr['setting_name'] = $row['setting_name'];
    }
    else
    {
      $persistent_arr['setting_name'] = 'k. A.';
    }

    //genre
    $query = mysql_query('SELECT genre_id, genre_name FROM `'.$global_config_arr['pref'].'persistent_genre`
                          WHERE genre_id='.$persistent_arr['persistent_genre_id'].' LIMIT 1', $db);
    if ($row = mysql_fetch_assoc($query))
    {
      $persistent_arr['genre_name'] = $row['genre_name'];
    }
    else
    {
      $persistent_arr['genre_name'] = 'k. A.';
    }

    // Kommentare
    $pw_arr['comment_url'] = '?go=pwcomments&amp;pw='.$_GET['pw'];

    // Kommentare lesen
    $index_pwcomms = mysql_query('SELECT persistent_comment_id FROM `'.$global_config_arr['pref'].'persistent_comments` WHERE persistent_id=\''.$persistent_arr['persistent_id']."'", $db);
    $pw_arr['kommentare'] = mysql_num_rows($index_pwcomms);

    // User auslesen
    $index2 = mysql_query('SELECT user_name FROM `'.$global_config_arr['pref'].'user` WHERE user_id = '.$persistent_arr['persistent_posterid'].' LIMIT 1', $db);
    $news_arr['user_name'] = mysql_result($index2, 0, 'user_name');
    $news_arr['user_url'] = '?go=profil&amp;userid='.$persistent_arr['persistent_posterid'];

    //FS-Codes ersetzen
    $persistent_arr['persistent_text'] = fscode($persistent_arr['persistent_text'], 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1);
    $persistent_arr['persistent_handycap'] = fscode($persistent_arr['persistent_handycap'], 1, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1);

    switch ($persistent_arr['persistent_spiel'])
    {
      case 1:
           $persistent_arr['persistent_spiel'] = 'NwN';
           break;
      case 2:
           $persistent_arr['persistent_spiel'] = 'NwN 2';
           break;
    }

    $template = new template();
    $template->setFile('0_persistent_worlds.tpl');
    $template->load('detail_body');

    $template->tag('name', $persistent_arr['persistent_name']);
    $template->tag('url', $persistent_arr['persistent_url']);
    $template->tag('text', $persistent_arr['persistent_text']);
    $template->tag('spiel', $persistent_arr['persistent_spiel']);
    $template->tag('setting', $persistent_arr['setting_name']);
    $template->tag('genre', $persistent_arr['genre_name']);
    $template->tag('pvp', getPersistentPvPAsString($persistent_arr['persistent_pvp']));
    $template->tag('termine', getPersistentUptimeAsString($persistent_arr['persistent_termine']));
    $template->tag('dlsize', getPersistentDLSizeAsString($persistent_arr['persistent_dlsize']));
    $template->tag('dlsvu', ($persistent_arr['persistent_dlsvu']!=0) ? 'Schatten von Undernzit' : '');
    $template->tag('dlhdu', ($persistent_arr['persistent_dlhdu']!=0) ? 'Horden des Unterreichs' : '');
    $template->tag('dlcep', ($persistent_arr['persistent_dlcep']!=0) ? 'Community Expansion Pack' : '');
    $template->tag('dlmotb', ($persistent_arr['persistent_dlmotb']!=0) ? 'Mask of the Betrayer' : '');
    $template->tag('dlsoz', ($persistent_arr['persistent_dlsoz']!=0) ? 'Storm of Zehir' : '');
    $template->tag('anmeldung', getPersistentRegAsString($persistent_arr['persistent_anmeldung']));
    $template->tag('handycap', $persistent_arr['persistent_handycap']);
    $template->tag('dungeonmaster', getPersistentDMAsString($persistent_arr['persistent_dm']));
    $template->tag('maxplayer', $persistent_arr['persistent_maxzahl']);
    $template->tag('maxlevel', $persistent_arr['persistent_maxlevel']);
    $template->tag('expcap', getPersistentEXPCapAsString($persistent_arr['persistent_expcap']));
    $template->tag('fights', getPersistentDifficultyAsString($persistent_arr['persistent_fights']));
    $template->tag('traps',  getPersistentDifficultyAsString($persistent_arr['persistent_traps']));
    $template->tag('items', getPersistentFrequencyAsString($persistent_arr['persistent_items']));
    if ($persistent_arr['persistent_interview'] != NULL)
      $template->tag('interview', '<a href='.$persistent_arr['persistent_interview'].'>zum Interview</a>');
    else
      $template->tag('interview', '');
    $template->tag('link', $persistent_arr['persistent_link']);
    $template->tag('kommentar_url', $pw_arr['comment_url']);
    $template->tag('kommentar_anzahl', $pw_arr['kommentare']);
    $template->tag('autor', $news_arr['user_name']);
    $template->tag('autor_profilurl', $news_arr['user_url']);
    unset($persistent_arr);

    $template = $template->display();
  }
  elseif ($index===false)
  {
    //should never happen on "production server"
    $template = sys_message ( 'Persistente Welt anzeigen', 'Es ist ein Datenbankfehler aufgetreten!' );
  }
  else
  {
    $template = sys_message ( 'Persistente Welt anzeigen', 'Die angegebene persistente Welt existiert nicht!' );
  }
?>
