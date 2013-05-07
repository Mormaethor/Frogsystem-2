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


/////////////////////////////////////
//// Persistente Welt einstellen ////
/////////////////////////////////////

if (isset($_SESSION['user_level']) && ($_SESSION['user_level'] == 'loggedin') && isset($_POST['name']) && isset($_POST['url']) && isset($_POST['text']) && isset($_POST['spiel']))
{
    $datum = time();

    $seitenlink = preg_replace("/\\W/", '', strtolower(str_replace( ' ', '', $_POST['name'])));
    $_POST['text'] = strip_tags($_POST['text']);

    $_POST['name'] = savesql($_POST['name']);
    $_POST['url'] = savesql($_POST['url']);
    $_POST['text'] = savesql($_POST['text']);
    $_POST['spiel'] = intval($_POST['spiel']);
    $_POST['setting'] = intval($_POST['setting']);
    $_POST['genre'] = intval($_POST['genre']);
    $_POST['termine'] = intval($_POST['termine']);
    $_POST['dlsize'] = intval($_POST['dlsize']);
    $_POST['dlsvu'] = (isset($_POST['dlsvu']) && ($_POST['dlsvu']!=0)) ? 1 : 0;
    $_POST['dlhdu'] = (isset($_POST['dlhdu']) && ($_POST['dlhdu']!=0)) ? 1 : 0;
    $_POST['dlcep'] = (isset($_POST['dlcep']) && ($_POST['dlcep']!=0)) ? 1 : 0;
    $_POST['dlmotb'] = (isset($_POST['dlmotb']) && ($_POST['dlmotb']!=0)) ? 1 : 0;
    $_POST['dlsoz'] = (isset($_POST['dlsoz']) && ($_POST['dlsoz']!=0)) ? 1 : 0;
    $_POST['anmeldung'] = intval($_POST['anmeldung']);
    $_POST['handycap'] = savesql($_POST['handycap']);
    $_POST['dm'] = intval($_POST['dm']);
    $_POST['maxzahl'] = savesql($_POST['maxzahl']);
    $_POST['maxlevel'] = savesql($_POST['maxlevel']);
    $_POST['expcap'] = intval($_POST['expcap']);
    $_POST['fights'] = intval($_POST['fights']);
    $_POST['traps'] = intval($_POST['traps']);
    $_POST['items'] = intval($_POST['items']);
    $_POST['pvp'] = intval($_POST['pvp']);
    $_POST['interview'] = savesql($_POST['interview']);
    settype($_POST['posterid'], 'integer');

	$index = mysql_query('SELECT persistent_name FROM `'.$global_config_arr['pref'].'persistent`
	                      WHERE persistent_name = \''.$_POST['name']."' OR persistent_link='".savesql($seitenlink)."' LIMIT 1");
    if (mysql_num_rows($index) == 0)
    {
      mysql_query('INSERT INTO `'.$global_config_arr['pref'].'persistent` (persistent_name,
                      persistent_url, persistent_text, persistent_spiel,
                      persistent_setting_id, persistent_genre_id,
                      persistent_termine,
                      persistent_dlsize,
                      persistent_dlsvu, persistent_dlhdu, persistent_dlcep,
                      persistent_dlmotb, persistent_dlsoz,
                      persistent_anmeldung, persistent_handycap, persistent_dm,
                      persistent_maxzahl, persistent_maxlevel, persistent_expcap,
                      persistent_fights, persistent_traps, persistent_items,
                      persistent_pvp, persistent_datum, persistent_interview,
                      persistent_posterid, persistent_link)
                 VALUES (\''.$_POST['name']."',
                         '".$_POST['url']."', '".$_POST['text']."', '".$_POST['spiel']."',
                         '".$_POST['setting']."', '".$_POST['genre']."',
                         '".$_POST['termine']."',
                         '".$_POST['dlsize']."',
                         '".$_POST['dlsvu']."', '".$_POST['dlhdu']."', '".$_POST['dlcep']."',
                         '".$_POST['dlmotb']."', '".$_POST['dlsoz']."',
                         '".$_POST['anmeldung']."', '".$_POST['handycap']."', '".$_POST['dm']."',
                         '".$_POST['maxzahl']."', '".$_POST['maxlevel']."', '".$_POST['expcap']."',
                         '".$_POST['fights']."', '".$_POST['traps']."', '".$_POST['items']."',
                         '".$_POST['pvp']."', '".$datum."', '".$_POST['interview']."',
                         '".intval($_SESSION['user_id'])."',
                         '".savesql($seitenlink)."');", $db);

      $template = sys_message ( 'Persistente Welt hinzuf&uuml;gen',
                   'Vielen Dank für den Eintrag. Die persistente Welt wurde gespeichert. Alle eingetragenen
					Details können in der Liste aufgerufen werden. Änderungen an diesem Eintrag können nur
					durch dich oder die Seitenadministration vorgenommen werden.' );

	  $email_betreff = $phrases['newpersistentworld'] . ' @ ' . $global_config_arr['virtualhost'];
      $header = 'From: '.$phrases['newpersistentworld'].' @ '.$global_config_arr['virtualhost']."\n";
      $header .= 'Reply-To: '.$phrases['newpersistentworld'].' @ '.$global_config_arr['virtualhost']."\n";
      $header .= "Bcc: \n";
      $header .= 'X-Mailer: PHP/' . phpversion(). "\n";
      $header .= 'X-Sender-IP: '.$_SERVER['REMOTE_ADDR']."\n";
      $header .= 'Content-Type: text/html';

      switch ($_POST['spiel'])
      {
	    case 1:
		     $inhalt = 'Bei Planet Neverwinter wurde eine neue Persistente Welt namens <b>'.$_POST['name'].'</b>
                      für das Spiel Neverwinter Nights vorgestellt. Du findest den Artikel unter folgendem Link:<br>
                      <a href="http://www.planetneverwinter.de/nwn/?go=persistentdetail2&pw='.$seitenlink.'">
                      http://www.planetneverwinter.de/nwn/?go=persistentdetail2&pw='.$seitenlink.'</a><br>
                      Bitte schreibe eine News dazu.<br><br>Vielen Dank';
             break;
        case 2:
             $inhalt = 'Bei Planet Neverwinter wurde eine neue Persistente Welt namens <b>'.$_POST['name'].'</b>
				   für das Spiel Neverwinter Nights 2 vorgestellt. Du findest den Artikel unter folgendem Link:<br>
				   <a href="http://www.planetneverwinter.de/nwn2/?go=persistentdetail3&pw='.$seitenlink.'">
				   http://www.planetneverwinter.de/nwn2/?go=persistentdetail3&pw='.$seitenlink.'</a><br>
				   Bitte schreibe eine News dazu.<br><br>Vielen Dank';
             break;
      }//swi
      mail($global_config_arr['admin_mail'], $email_betreff, $inhalt, $header);

	}
	else
    {
	  $template = sys_message ( 'Persistente Welt hinzuf&uuml;gen', 'Dieser Eintrag existiert bereits.' );
    }
}

elseif ((!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 'loggedin')) && isset($_POST['name']) && isset($_POST['url']) && isset($_POST['text']) && isset($_POST['spiel']))
{
  $template = sys_message ( 'Persistente Welt hinzuf&uuml;gen',
                            'Du bist nicht eingeloggt. Bitte logge dich ein oder registriere dich.' );
}

///////////////////////////////////////
///// Persistente Welten Formular /////
///////////////////////////////////////

else
{
  $settings = '';
  $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_setting` ORDER BY setting_name', $db);
  while ($setting_arr = mysql_fetch_assoc($index))
  {
	$settings .= '<option value="'.$setting_arr['setting_id'].'">'.$setting_arr['setting_name'].'</option>'."\n";
  }
  if ($settings=='')
  {
    $settings = '<option value="-1">k. A.</option>'."\n";
  }

  $genres = '';
  $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_genre` ORDER BY genre_name', $db);
  while ($genre_arr = mysql_fetch_assoc($index))
  {
    $genres .= '<option value="'.$genre_arr['genre_id'].'">'.$genre_arr['genre_name'].'</option>'."\n";
  }
  if ($genres=='')
  {
    $genres = '<option value="-1">k. A.</option>'."\n";
  }

  $template = new template();
  $template->setFile('0_persistent_worlds.tpl');
  $template->load('form_add_body');

  $template->tag('session_id', session_id());
  $template->tag('user_id', isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '0');
  $template->tag('settings', $settings);
  $template->tag('genres', $genres);

  $template = $template->display();
}
?>
