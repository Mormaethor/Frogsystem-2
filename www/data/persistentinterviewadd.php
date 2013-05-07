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

if (isset($_SESSION['user_level']) && ($_SESSION['user_level'] == 'loggedin')
  && isset($_POST['name']) && isset($_POST['url']) && isset($_POST['antwort01'])
  && isset($_POST['antwort02']) && isset($_POST['antwort03']) && isset($_POST['antwort04'])
  && isset($_POST['antwort05']) && isset($_POST['antwort06']) && isset($_POST['antwort07'])
  && isset($_POST['antwort08']) && isset($_POST['antwort09']) && isset($_POST['antwort10'])
  && isset($_POST['antwort11']) && isset($_POST['antwort12']) && isset($_POST['antwort13']))
{
  $datum = time();
  $seitenlink = preg_replace("/\\W/", '', strtolower(str_replace( ' ', '', $_POST['name'])));
  $_POST['antwort01'] = strip_tags($_POST['antwort01']);
  $_POST['antwort02'] = strip_tags($_POST['antwort02']);
  $_POST['antwort03'] = strip_tags($_POST['antwort03']);
  $_POST['antwort04'] = strip_tags($_POST['antwort04']);
  $_POST['antwort05'] = strip_tags($_POST['antwort05']);
  $_POST['antwort06'] = strip_tags($_POST['antwort06']);
  $_POST['antwort07'] = strip_tags($_POST['antwort07']);
  $_POST['antwort08'] = strip_tags($_POST['antwort08']);
  $_POST['antwort09'] = strip_tags($_POST['antwort09']);
  $_POST['antwort10'] = strip_tags($_POST['antwort10']);
  $_POST['antwort11'] = strip_tags($_POST['antwort11']);
  $_POST['antwort12'] = strip_tags($_POST['antwort12']);
  $_POST['antwort13'] = strip_tags($_POST['antwort13']);

  $_POST['name'] = savesql($_POST['name']);
  $_POST['url'] = savesql($_POST['url']);
  $_POST['spiel'] = intval($_POST['spiel']);
  $_POST['antwort01'] = savesql($_POST['antwort01']);
  $_POST['antwort02'] = savesql($_POST['antwort02']);
  $_POST['antwort03'] = savesql($_POST['antwort03']);
  $_POST['antwort04'] = savesql($_POST['antwort04']);
  $_POST['antwort05'] = savesql($_POST['antwort05']);
  $_POST['antwort06'] = savesql($_POST['antwort06']);
  $_POST['antwort07'] = savesql($_POST['antwort07']);
  $_POST['antwort08'] = savesql($_POST['antwort08']);
  $_POST['antwort09'] = savesql($_POST['antwort09']);
  $_POST['antwort10'] = savesql($_POST['antwort10']);
  $_POST['antwort11'] = savesql($_POST['antwort11']);
  $_POST['antwort12'] = savesql($_POST['antwort12']);
  $_POST['antwort13'] = savesql($_POST['antwort13']);

  $index = mysql_query('SELECT persisinterview_name FROM `'.$global_config_arr['pref'].'persisinterview`
                        WHERE persisinterview_name = \''.$_POST['name']."' OR persisinterview_link='".savesql($seitenlink)."'");
  echo mysql_error();
  if (mysql_num_rows($index) == 0)
  {
    mysql_query('INSERT INTO `'.$global_config_arr['pref'].'persisinterview`
                              (persisinterview_name, persisinterview_url,
							   persisinterview_spiel,
							   persisinterview_antwort01, persisinterview_antwort02,
							   persisinterview_antwort03, persisinterview_antwort04,
							   persisinterview_antwort05, persisinterview_antwort06,
							   persisinterview_antwort07, persisinterview_antwort08,
							   persisinterview_antwort09, persisinterview_antwort10,
							   persisinterview_antwort11, persisinterview_antwort12,
							   persisinterview_antwort13, persisinterview_datum,
							   persisinterview_posterid, persisinterview_link)
                 VALUES (\''.$_POST['name']."',
                         '".$_POST['url']."',
                         '".$_POST['spiel']."',
                         '".$_POST['antwort01']."', '".$_POST['antwort02']."',
                         '".$_POST['antwort03']."', '".$_POST['antwort04']."',
                         '".$_POST['antwort05']."', '".$_POST['antwort06']."',
                         '".$_POST['antwort07']."', '".$_POST['antwort08']."',
                         '".$_POST['antwort09']."', '".$_POST['antwort10']."',
                         '".$_POST['antwort11']."', '".$_POST['antwort12']."',
                         '".$_POST['antwort13']."', '".$datum."',
                         '".intval($_SESSION['user_id'])."',
                         '".savesql($seitenlink)."');", $db);

    echo mysql_error();
    $template = sys_message( 'Interview hinzuf&uuml;gen',
                             'Vielen Dank f&uuml;r den Eintrag. Das Interview wurde gespeichert. Alle eingetragenen
                             Details k&ouml;nnen in der Liste aufgerufen werden. &Auml;nderungen an diesem Eintrag k&ouml;nnen nur
                             durch die Seitenadministration vorgenommen werden.');

    $email_betreff = 'Neues Interview @ ' . $global_config_arr['virtualhost'];
    $header = 'From: Neues Interview @ '.$global_config_arr['virtualhost']."\n";
    $header .= 'Reply-To: Neues Interview @ '.$global_config_arr['virtualhost']."\n";
    $header .= "Bcc: \n";
    $header .= 'X-Mailer: PHP/' . phpversion(). "\n";
    $header .= 'X-Sender-IP: '.$_SERVER['REMOTE_ADDR']."\n";
    $header .= 'Content-Type: text/html';

    switch ($_POST['spiel'])
    {
      case 1:
		   $inhalt = 'Bei Planet Neverwinter wurde ein neues Interview über die Persistente Welt <b>'.$_POST['name'].'</b>
				   für das Spiel Neverwinter Nights erstellt. Du findest den Artikel unter folgendem Link:<br>
				   <a href="http://www.planetneverwinter.de/nwn/?go=persistentinterview2&pw='.$seitenlink.'">
				   http://www.planetneverwinter.de/nwn/?go=persistentinterview2&pw='.$seitenlink.'</a><br>
				   Bitte schreibe eine News dazu.<br><br>Vielen Dank';
           break;
      case 2:
           $inhalt = 'Bei Planet Neverwinter wurde eine neues Interview über die Persistente Welt <b>'.$_POST['name'].'</b>
				   für das Spiel Neverwinter Nights 2 erstellt. Du findest den Artikel unter folgendem Link:<br>
				   <a href="http://www.planetneverwinter.de/nwn2/?go=persistentinterview3&pw='.$seitenlink.'">
				   http://www.planetneverwinter.de/nwn2/?go=persistentinterview3&pw='.$seitenlink.'</a><br>
				   Bitte schreibe eine News dazu.<br><br>Vielen Dank';
           break;
    }
    mail($global_config_arr['admin_mail'], $email_betreff, $inhalt, $header);
  }
  else
  {
	$template = sys_message( 'Interview hinzuf&uuml;gen', 'Dieser Eintrag existiert bereits.');
  }
}

elseif (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 'loggedin'))
{
  $template = sys_message ( 'Interview hinzuf&uuml;gen', 'Du bist nicht eingeloggt. Bitte logg dich ein oder registriere dich.' );
}

///////////////////////////////////////
///// Persistente Welten Formular /////
///////////////////////////////////////

else
{
  $template = new template();
  $template->setFile('0_persistent_worlds.tpl');
  $template->load('interview_add_form');
  $template->tag('session_id', session_id());
  $template = $template->display();
}
?>