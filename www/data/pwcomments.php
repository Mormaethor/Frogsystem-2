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

//Kommentar-Config
$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'news_config`', $db);
$config_arr = mysql_fetch_assoc($index);
//Editor config
$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'editor_config`', $db);
$editor_config = mysql_fetch_assoc($index);

///////////////////
//// Anti-Spam ////
///////////////////
if ( $config_arr['com_antispam'] == 1 && isset($_SESSION['user_id']) && ($_SESSION['user_id']!=0) ) {
    $anti_spam = check_captcha ($_POST['spam'], 0);
} else {
    $anti_spam = check_captcha ($_POST['spam'], $config_arr['com_antispam']);
}

$template = ''; //init template
$message_template = ''; //init messaged

//Daten zu persistenter Welt
$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_link = \''.savesql($_GET['pw'])."' LIMIT 1", $db);
$persistent_arr = mysql_fetch_assoc($index);

if ($persistent_arr === false)
{
  //no PW with that link name found
  $message_template = sys_message($phrases['sysmessage'], 'Zum angegebenen Link existiert keine Persistente Welt.');
}
else
{

//////////////////////////////
//// Kommentar hinzufügen ////
//////////////////////////////

if (isset($_POST['add_comment']))
{
    if (isset($_POST['id'])
        && ($_POST['name'] != '' || isset($_SESSION['user_id']))
        && $_POST['title'] != '' && $_POST['text'] != ''
        && (($anti_spam==TRUE OR isset($_SESSION['user_id']))))
    {
        $_POST['id'] = intval($_POST['id']);
        $_POST['name'] = savesql($_POST['name']);
        $_POST['title'] = savesql($_POST['title']);
        $_POST['text'] = savesql($_POST['text']);
        $commentdate = date('U');

        if (isset($_SESSION['user_id']) && ($_SESSION['user_id']!=0))
        {
            $userid = $_SESSION['user_id'];
            $_POST['name'] = '';
        }
        else
        {
            $userid = 0;
        }

        mysql_query('INSERT INTO `'.$global_config_arr['pref'].'persistent_comments` (persistent_id, comment_poster, comment_poster_id, comment_date, comment_title, comment_text)
                     VALUES (\''.$_POST['id']."',
                             '".$_POST['name']."',
                             '".$userid."',
                             '".$commentdate."',
                             '".$_POST['title']."',
                             '".$_POST['text']."');", $db);

        mysql_query('UPDATE `'.$global_config_arr['pref'].'counter` SET comments=comments+1', $db);
    }
    else
    {
        $reason = '';
        if ( !($_POST['name'] != '' || isset($_SESSION['user_id']))
            || $_POST['title'] == ''
            || $_POST['text'] == '')
        {
            $reason = $phrases['comment_empty'];
        }
        if (!($anti_spam == true))
        {
            $reason .= $phrases['comment_spam'];
        }
        $message_template .= sys_message($phrases['comment_not_added'], $reason);
    }
}

/////////////////////////////
//Persistente Welt anzeigen//
/////////////////////////////

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

  // Kommentaranzahl auslesen
  $index_pwcomms = mysql_query('SELECT persistent_comment_id FROM `'.$global_config_arr['pref'].'persistent_comments` WHERE persistent_id = \''.$persistent_arr['persistent_id']."'", $db);
  $pw_arr['kommentare'] = mysql_num_rows($index_pwcomms);

  // User auslesen
  $index2 = mysql_query('SELECT user_name FROM `'.$global_config_arr['pref'].'user` WHERE user_id = '.$persistent_arr['persistent_posterid'], $db);
  $news_arr['user_name'] = mysql_result($index2, 0, 'user_name');
  $news_arr['user_url'] = '?go=user&amp;id='.$persistent_arr['persistent_posterid'];


  $persistent_arr['persistent_text'] = fscode($persistent_arr['persistent_text'], 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1);
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
    $template->tag('interview', 'Noch kein Interview vorhanden.');
  $template->tag('link', $persistent_arr['persistent_link']);
  $template->tag('kommentar_url', $pw_arr['comment_url']);
  $template->tag('kommentar_anzahl', $pw_arr['kommentare']);
  $template->tag('autor', $news_arr['user_name']);
  $template->tag('autor_profilurl', $news_arr['user_url']);

  $pw_template = $message_template . $template->display();

////////////////////////
// Kommentare erzeugen//
////////////////////////

  // Text formatieren
  $html = ($config_arr['html_code']>=3);
  $fs   = ($config_arr['fs_code']>=3);
  $para = ($config_arr['para_handling']>=3);

  //FScode-Html Anzeige
  $fs_active = ($fs) ? 'an' : 'aus';
  $html_active = ($html) ? 'an' : 'aus';


$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_comments` WHERE persistent_id = \''.$persistent_arr['persistent_id']."' ORDER BY comment_date ASC", $db);

$comments = '';
while ($comment_arr = mysql_fetch_assoc($index))
{

  // User auslesen
  if ($comment_arr['comment_poster_id'] != 0)
  {
    $index2 = mysql_query('SELECT `user_name`, `user_is_admin`, `user_is_staff`, `user_group` FROM `'.$global_config_arr['pref'].'user` WHERE user_id = '.$comment_arr['comment_poster_id'], $db);
    $comment_arr['comment_poster'] = kill_replacements ( mysql_result($index2, 0, 'user_name' ), TRUE );
    $comment_arr['user_is_admin'] = mysql_result($index2, 0, 'user_is_admin');
    $comment_arr['user_is_staff'] = mysql_result($index2, 0, 'user_is_staff');
    $comment_arr['user_group'] = mysql_result($index2, 0, 'user_group');

    if (image_exists('media/user-images/',$comment_arr['comment_poster_id'])) {
      $comment_arr['comment_avatar'] = '<img align="left" src="'.image_url('media/user-images/',$comment_arr['comment_poster_id']).'" alt="'.$comment_arr['comment_poster'].'">';
    } else {
      $comment_arr['comment_avatar'] = '';
    }

    if ( $comment_arr['user_is_staff'] == 1 || $comment_arr['user_is_admin'] == 1 ) {
      $comment_arr['comment_poster'] = '<b>' . $comment_arr['comment_poster'] . '</b>';
    }

    // Benutzer Rang
    $user_arr['rank_data'] = get_user_rank ( $comment_arr['user_group'], $comment_arr['user_is_admin'] );
    $comment_arr['user_rank'] = $user_arr['rank_data']['user_group_rank'];

    // Get User Template
    $template = new template();
    $template->setFile('0_news.tpl');
    $template->load('COMMENT_USER');

    $template->tag('url', '?go=user&amp;id='.$comment_arr['comment_poster_id'] );
    $template->tag('name', $comment_arr['comment_poster'] );
    $template->tag('image', $comment_arr['comment_avatar'] );
    $template->tag('rank', $comment_arr['user_rank'] );

    $template = $template->display ();
    $comment_arr['comment_poster'] = $template;
  }
  else
  {
    $comment_arr['comment_avatar'] = '';
    $comment_arr['comment_poster'] = kill_replacements ( $comment_arr['comment_poster'], TRUE );
    $comment_arr['user_rank'] = '';
  }

  if ($fs) {
    $comment_arr['comment_text'] = fscode( kill_replacements ( $comment_arr['comment_text'] ),$fs,$html,$para, $editor_config['do_bold'], $editor_config['do_italic'], $editor_config['do_underline'], $editor_config['do_strike'], $editor_config['do_center'], $editor_config['do_url'], $editor_config['do_home'], $editor_config['do_email'], $editor_config['do_img'], $editor_config['do_cimg'], $editor_config['do_list'], $editor_config['do_numlist'], $editor_config['do_font'], $editor_config['do_color'], $editor_config['do_size'], $editor_config['do_code'], $editor_config['do_quote'], $editor_config['do_noparse'], $editor_config['do_smilies']);
  } else {
    $comment_arr['comment_text'] = fscode( kill_replacements ( $comment_arr['comment_text'] ), $fs, $html, $para);
  }

  $comment_arr['comment_date'] = date_loc ( $global_config_arr['datetime'] , $comment_arr['comment_date'] );
  $comment_arr['comment_title'] = kill_replacements( $comment_arr['comment_title'], TRUE );

  // Get Comment Template
  $template = new template();
  $template->setFile('0_news.tpl');
  $template->load('COMMMENT_ENTRY');

  $template->tag('titel', $comment_arr['comment_title'] );
  $template->tag('date', $comment_arr['comment_date'] );
  $template->tag('text', $comment_arr['comment_text'] );
  $template->tag('user', $comment_arr['comment_poster'] );
  $template->tag('user_image', $comment_arr['comment_avatar'] );
  $template->tag('user_rank', $comment_arr['user_rank'] );

  $comments .= $template->display();
}//while
unset($comment_arr);


// Get Comments Form Name Template
$form_name = new template();
$form_name->setFile('0_news.tpl');
$form_name->load('COMMENT_FORM_NAME');
$form_name = $form_name->display ();

if ( isset ( $_SESSION['user_name'] ) ) {
  $form_name = kill_replacements ( $_SESSION['user_name'], TRUE );
  $form_name .= '<input type="hidden" name="name" id="name" value="1">';
}

// Get Comments Captcha Template
$form_spam = new template();
$form_spam->setFile('0_news.tpl');
$form_spam->load('COMMENT_CAPTCHA');
$form_spam->tag('captcha_url', FS2_ROOT_PATH . 'resources/captcha/captcha.php?i='.generate_pwd(8) );
$form_spam = $form_spam->display ();

// Get Comments Form Name Template
$form_spam_text = new template();
$form_spam_text->setFile('0_news.tpl');
$form_spam_text->load('COMMENT_CAPTCHA_TEXT');
$form_spam_text = $form_spam_text->display ();


if (
      $config_arr['com_antispam'] == 0 ||
      ( $config_arr['com_antispam'] == 1 && isset($_SESSION['user_id']) && $_SESSION['user_id']!=0) ||
      ( $config_arr['com_antispam'] == 3 && is_in_staff ( $_SESSION['user_id'] ) )
   )
{
  $form_spam = '';
  $form_spam_text = '';
}


//Textarea
$template_textarea = create_textarea('text', '', $editor_config['textarea_width'], $editor_config['textarea_height'], 'text', false, $editor_config['smilies'], $editor_config['bold'], $editor_config['italic'], $editor_config['underline'], $editor_config['strike'], $editor_config['center'], $editor_config['font'], $editor_config['color'], $editor_config['size'], $editor_config['img'], $editor_config['cimg'], $editor_config['url'], $editor_config['home'], $editor_config['email'], $editor_config['code'], $editor_config['quote'], $editor_config['noparse']);

// Get Comment Form Template
$template = new template();
$template->setFile('0_news.tpl');
$template->load('COMMENT_FORM');

$template->tag('news_id', $persistent_arr['persistent_id'] );
$template->tag('name_input', $form_name );
$template->tag('textarea', $template_textarea );
$template->tag('html', $html_active );
$template->tag('fs_code', $fs_active );
$template->tag('captcha', $form_spam );
$template->tag('captcha_text', $form_spam_text  );

$formular_template = $template->display();

$template = $pw_template . $comments . $formular_template;
}//else
?>
