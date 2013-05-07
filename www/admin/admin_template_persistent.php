<?php
  $TEMPLATE_GO = 'tpl_persistent';
  $TEMPLATE_FILE = '0_persistent_worlds.tpl';
  $TEMPLATE_EDIT = array();

  //TODO: localize titles and descriptions

  $TEMPLATE_EDIT[] = array (
    'name' => 'main_body',
    'title' => 'Persis. Welten-Body (Liste)',
    'description' => 'Liste der Persistenten Welten',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'text', 'text' => 'Auflistung der Eintr&auml;ge der persistenten Welten' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'list_entry',
    'title' => 'Eintrag (Liste)',
    'description' => 'Ansicht eines Eintrages in der Liste',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'name', 'text' => 'Name der persistenten Welt' ),
        array ( 'tag' => 'link', 'text' => 'Linkerweiterung zur Detailseite der persistenten Welt' ),
        array ( 'tag' => 'setting', 'text' => 'Setting' ),
        array ( 'tag' => 'genre', 'text' => 'Genre' ),
        array ( 'tag' => 'spiel', 'text' => 'Spiel (NWN oder NWN 2)' ),
        array ( 'tag' => 'dlsvu', 'text' => 'Schatten von Undernzit, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlhdu', 'text' => 'Horden des Unterreichs, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlcep', 'text' => 'Community Expansion Pack, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlmotb', 'text' => 'Mask of the Betrayer, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlsoz', 'text' => 'Storm of Zehir, falls ben&ouml;tigt' ),
        array ( 'tag' => 'anmeldung', 'text' => 'Anmeldungsmodalit&auml;ten der PW' ),
        array ( 'tag' => 'maxplayer', 'text' => 'max. Spieleranzahl' ),
        array ( 'tag' => 'maxlevel', 'text' => 'max. erreichbares Level' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'detail_body',
    'title' => 'Detail-Body',
    'description' => 'Detailseite einer persistenten Welt',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'name', 'text' => 'Name der persistenten Welt' ),
        array ( 'tag' => 'url', 'text' => 'Link zur Persistenten Welt' ),
        array ( 'tag' => 'text', 'text' => 'Beschreibungstext' ),
        array ( 'tag' => 'spiel', 'text' => 'Spiel (NWN oder NWN 2)' ),
        array ( 'tag' => 'setting', 'text' => 'Setting' ),
        array ( 'tag' => 'genre', 'text' => 'Genre' ),
        array ( 'tag' => 'pvp', 'text' => 'PvP-Einstellungen des Servers' ),
        array ( 'tag' => 'termine', 'text' => 'Online-Zeiten der PW' ),
        array ( 'tag' => 'dlsize', 'text' => 'Gr&ouml;&szlig;e der notwendigen Downloads' ),
        array ( 'tag' => 'dlsvu', 'text' => 'Schatten von Undernzit, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlhdu', 'text' => 'Horden des Unterreichs, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlcep', 'text' => 'Community Expansion Pack, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlmotb', 'text' => 'Mask of the Betrayer, falls ben&ouml;tigt' ),
        array ( 'tag' => 'dlsoz', 'text' => 'Storm of Zehir, falls ben&ouml;tigt' ),
        array ( 'tag' => 'anmeldung', 'text' => 'Anmeldungsmodalit&auml;ten der PW' ),
        array ( 'tag' => 'handycap', 'text' => 'Beschr&auml;nkungen der PW' ),
        array ( 'tag' => 'dungeonmaster', 'text' => 'Anzahl der Spielleiter' ),
        array ( 'tag' => 'maxplayer', 'text' => 'max. Spieleranzahl' ),
        array ( 'tag' => 'maxlevel', 'text' => 'max. erreichbares Level' ),
        array ( 'tag' => 'expcap', 'text' => 'Beschr&auml;nkung der Erfahrungspunkte' ),
        array ( 'tag' => 'fights', 'text' => 'Schwierigkeit der K&auml;mpfe' ),
        array ( 'tag' => 'traps', 'text' => 'Schwierigkeit der Fallen' ),
        array ( 'tag' => 'items', 'text' => 'H&auml;ufigkeit seltener/besonderer Gegenst&auml;nde' ),
        array ( 'tag' => 'interview', 'text' => 'Link zum PW-Interview, falls vorhanden' ),
        array ( 'tag' => 'link', 'text' => 'Seiteninterne Linkerweiterung der persistenten Welt' ),
        array ( 'tag' => 'kommentar_url', 'text' => 'Link zur Kommentarseite der PW' ),
        array ( 'tag' => 'kommentar_anzahl', 'text' => 'Anzahl der zur PW vorhandenen Kommentare' ),
        array ( 'tag' => 'autor_profilurl', 'text' => 'Link zum Profil des Eintragsautors' ),
        array ( 'tag' => 'autor', 'text' => 'Autor des PW-Eintrages' )
    )
  );

  //TODO: insert interwiew list template stuff here

  $TEMPLATE_EDIT[] = array (
    'name' => 'interview_list_entry',
    'title' => 'Eintrag in der Interviewliste',
    'description' => 'Ansicht eines Eintrages in der Interviewliste',
    'rows' => 5,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'name', 'text' => 'Name der persistenten Welt' ),
        array ( 'tag' => 'link', 'text' => 'Linkerweiterung zur Interviewseite der persistenten Welt' ),
        array ( 'tag' => 'spiel', 'text' => 'Spiel (NWN oder NWN 2)' ),
        array ( 'tag' => 'username', 'text' => 'Name des Autors des Interviews' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'interview_list_no_entries',
    'title' => 'Keine Eintr&auml;ge in der Interviewliste',
    'description' => 'Ansicht der der Interviewlisteneintr&auml;ge, falls keine Interviews vorhanden sind',
    'rows' => 5,
    'cols' => 66,
    'help' => array ()
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'interview_list_body',
    'title' => 'Interviewliste',
    'description' => 'Ansicht der kompletten Interviewliste',
    'rows' => 8,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'text', 'text' => 'Liste der Eintr&auml;ge' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'interview_detail_body',
    'title' => 'Interview-Body',
    'description' => 'Ansicht eines Interviews',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'name', 'text' => 'Name der persistenten Welt' ),
        array ( 'tag' => 'url', 'text' => 'Link zur Persistenten Welt' ),
        array ( 'tag' => 'autor', 'text' => 'Autor des Interviews' ),
        array ( 'tag' => 'autor_profilurl', 'text' => 'Link zum Profil des Interviewautors' ),
        //Jetzt wird's richtig kreativ!
        array ( 'tag' => 'antwort01', 'text' => 'Antwort auf die erste Frage' ),
        array ( 'tag' => 'antwort02', 'text' => 'Antwort auf die zweite Frage' ),
        array ( 'tag' => 'antwort03', 'text' => 'Antwort auf die dritte Frage' ),
        array ( 'tag' => 'antwort04', 'text' => 'Antwort auf die vierte Frage' ),
        array ( 'tag' => 'antwort05', 'text' => 'Antwort auf die f&uuml;nfte Frage' ),
        array ( 'tag' => 'antwort06', 'text' => 'Antwort auf die sechste Frage' ),
        array ( 'tag' => 'antwort07', 'text' => 'Antwort auf die siebte Frage' ),
        array ( 'tag' => 'antwort08', 'text' => 'Antwort auf die achte Frage' ),
        array ( 'tag' => 'antwort09', 'text' => 'Antwort auf die neunte Frage' ),
        array ( 'tag' => 'antwort10', 'text' => 'Antwort auf die zehnte Frage' ),
        array ( 'tag' => 'antwort11', 'text' => 'Antwort auf die elfte Frage' ),
        array ( 'tag' => 'antwort12', 'text' => 'Antwort auf die zw&ouml;lfte Frage' ),
        array ( 'tag' => 'antwort13', 'text' => 'Antwort auf die dreizehnte Frage' )
    )
  );
  
  $TEMPLATE_EDIT[] = array (
    'name' => 'interview_add_form',
    'title' => 'Interview-Formular',
    'description' => 'Formular zum Eintragen eines neuen PW-Interviews',
    'rows' => 25,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'session_id', 'text' => 'PHP-Session-ID des Nutzers' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'form_add_body',
    'title' => 'Welt eintragen',
    'description' => 'Formular zum Eintragen einer neuen PW',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'session_id', 'text' => 'PHP-Session-ID' ),
        array ( 'tag' => 'user_id', 'text' => 'Datenbank-ID des eintragenden Nutzers' ),
        array ( 'tag' => 'settings', 'text' => 'Liste der zur Auswahl stehenden Settings' ),
        array ( 'tag' => 'genres', 'text' => 'Liste der zur Auswahl stehenden Genres' )
    )
  );

  $TEMPLATE_EDIT[] = array (
    'name' => 'form_edit_body',
    'title' => 'Welt bearbeiten',
    'description' => 'Formular zum &Auml;ndern eines PW-Eintrages',
    'rows' => 10,
    'cols' => 66,
    'help' => array (
        array ( 'tag' => 'session_id', 'text' => 'PHP-Session-ID' ),
        array ( 'tag' => 'persistent_id', 'text' => 'Datenbank-ID der bearbeiteten PW' ),
        array ( 'tag' => 'name', 'text' => 'Name der persistenten Welt' ),
        array ( 'tag' => 'url', 'text' => 'Link zur Persistenten Welt' ),
        array ( 'tag' => 'text', 'text' => 'Beschreibungstext' ),
        array ( 'tag' => 'settings', 'text' => 'Liste der zur Auswahl stehenden Settings' ),
        array ( 'tag' => 'genres', 'text' => 'Liste der zur Auswahl stehenden Genres' ),
        array ( 'tag' => 'handycap', 'text' => 'Beschr&auml;nkungen der PW' ),
        array ( 'tag' => 'maxzahl', 'text' => 'max. Spieleranzahl' ),
        array ( 'tag' => 'maxlevel', 'text' => 'max. erreichbares Level' ),
        array ( 'tag' => 'und_noch_mehr', 'text' => '...und das sind viele Behelfstags, daher ist die Tagliste nicht komplett' ),
    )
  );

//////////////////////////
//// Intialise Editor ////
//////////////////////////

echo templatepage_init ($TEMPLATE_EDIT, $TEMPLATE_GO, $TEMPLATE_FILE);
?>
