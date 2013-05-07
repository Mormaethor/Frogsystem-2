<?php
/*
    Frogsystem Persistent Worlds Script
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

//////////////////////////////////////////
//// Persistente Welten aktualisieren ////
//////////////////////////////////////////

if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['text']))
{
    settype($_POST['editpersitentid'], 'integer');
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_id = '.$_POST['editpersistentid'].' LIMIT 1', $db);
    if (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 'loggedin'))
    {
      $template = sys_message ( 'Persistente Welt bearbeiten', 'Du bist nicht eingeloggt.' );
    }
    elseif (mysql_num_rows($index)<=0)
    {
      $template = sys_message ( 'Persistente Welt bearbeiten', 'Es existiert kein Eintrag zu diesem Namen!' );
    }
    elseif ((false===($row=mysql_fetch_assoc($index))) || ($row['persistent_posterid'] != $_SESSION['user_id']))
    {
      $template = sys_message ( 'Persistente Welt bearbeiten',
                                'Du hast nicht das Recht, diesen Eintrag zu editieren. Das ist nur dem Ersteller des Eintrages und der Administration gestattet.' );
    }
    elseif (isset($_POST['delpersistent']))
    {
      mysql_query('DELETE FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_id = '.$_POST['editpersistentid'].' LIMIT 1', $db);
      $template = sys_message ( 'Persistente Welt bearbeiten', 'Der Eintrag der persistenten Welt wurde gel&ouml;scht.' );
    }
    else
    {
      $datum = time();

      $_POST['name'] = savesql($_POST['name']);
      $_POST['url'] = savesql($_POST['url']);
      $_POST['text'] = str_ireplace ('&lt;textarea&gt;', '<textarea>', $_POST['text']);
      $_POST['text'] = str_ireplace ('&lt;/textarea&gt;', '</textarea>', $_POST['text']);
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
      $_POST['seitenlink'] = savesql($_POST['seitenlink']);
      $_POST['editpersistentid'] = savesql($_POST['editpersistentid']);

      $update = 'UPDATE `'.$global_config_arr['pref'].'persistent`
                   SET persistent_name = \''.$_POST['name']."',
                       persistent_url  = '".$_POST['url']."',
                       persistent_text = '".$_POST['text']."',
                       persistent_spiel = '".$_POST['spiel']."',
					   persistent_setting_id = '".$_POST['setting']."',
					   persistent_genre_id = '".$_POST['genre']."',
					   persistent_termine = '".$_POST['termine']."',
					   persistent_dlsize = '".$_POST['dlsize']."',
					   persistent_dlsvu = '".$_POST['dlsvu']."',
					   persistent_dlhdu = '".$_POST['dlhdu']."',
					   persistent_dlcep = '".$_POST['dlcep']."',
					   persistent_dlmotb = '".$_POST['dlmotb']."',
					   persistent_dlsoz = '".$_POST['dlsoz']."',
					   persistent_anmeldung = '".$_POST['anmeldung']."',
					   persistent_handycap = '".$_POST['handycap']."',
					   persistent_dm = '".$_POST['dm']."',
					   persistent_maxzahl = '".$_POST['maxzahl']."',
					   persistent_maxlevel = '".$_POST['maxlevel']."',
					   persistent_expcap = '".$_POST['expcap']."',
					   persistent_fights = '".$_POST['fights']."',
					   persistent_traps = '".$_POST['traps']."',
					   persistent_items = '".$_POST['items']."',
					   persistent_pvp = '".$_POST['pvp']."',
					   persistent_datum = '".$datum."'
                   WHERE persistent_id = '".$_POST['editpersistentid']."'";
      mysql_query($update, $db);
      $template = sys_message ( 'Persistente Welt bearbeiten', 'Der Eintrag der persistenten Welt wurde ge&auml;ndert.' );
    }
}

/////////////////////////////////////////
////// Persistente Welt editieren ///////
/////////////////////////////////////////

else
{
    settype($_POST['persistentid'], 'integer');
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_link = \''.savesql($_GET['pw'])."'", $db);
    $persistent_arr = mysql_fetch_assoc($index);

    $persistent_arr['persistent_text'] = stripslashes($persistent_arr['persistent_text']);
    $persistent_arr['persistent_handycap'] = stripslashes($persistent_arr['persistent_handycap']);

    if(isset($_SESSION['user_level']) && ($_SESSION['user_level'] == 'loggedin') && ($persistent_arr['persistent_posterid'] == $_SESSION['user_id']))
    {
      $persistent_arr['persistent_text'] = str_replace ('<textarea>', '&lt;textarea&gt;', $persistent_arr['persistent_text']);
      $persistent_arr['persistent_text'] = str_replace ('</textarea>', '&lt;/textarea&gt;', $persistent_arr['persistent_text']);

      $persistent_arr['persistent_text'] = stripslashes($persistent_arr['persistent_text']);

      $template = new template();
      $template->setFile('0_persistent_worlds.tpl');
      $template->load('form_edit_body');

      $template->tag('session_id', session_id());
      $template->tag('persistent_id', $persistent_arr['persistent_id']);
      $template->tag('name', $persistent_arr['persistent_name']);
      $template->tag('url', $persistent_arr['persistent_url']);
      $template->tag('text', $persistent_arr['persistent_text']);
      $template->tag('nwn1_checked', ($persistent_arr['persistent_spiel'] == 1) ? 'checked="checked"' : '' );
      $template->tag('nwn2_checked', ($persistent_arr['persistent_spiel'] == 2) ? 'checked="checked"' : '' );

      $settings = '';
      $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_setting` ORDER BY setting_name', $db);
      while ($setting_arr = mysql_fetch_assoc($index))
	  {
        $sele = ($setting_arr['setting_id'] == $persistent_arr['persistent_setting_id']) ? ' selected' : '';
        $settings .= '<option value="'.$setting_arr['setting_id'].'"'.$sele.'>'.$setting_arr['setting_name'].'</option>'."\n";
      }
      if ($settings=='')
      {
        $settings = '<option value="-1" selected>k. A.</option>'."\n";
      }
      $template->tag('settings', $settings);

      $genres = '';
      $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_genre` ORDER BY genre_name', $db);
      while ($genre_arr = mysql_fetch_assoc($index))
      {
        $sele = ($genre_arr['genre_id'] == $persistent_arr['persistent_genre_id']) ? ' selected' : '';
        $genres .= '<option value="'.$genre_arr['genre_id'].'"'.$sele.'>'.$genre_arr['genre_name'].'</option>'."\n";
      }
      if ($genres=='')
      {
        $genres = '<option value="-1" selected>k. A.</option>'."\n";
      }
      $template->tag('genres', $genres);

      //PVP selection "tags" (more like conditions in admin template)
      $template->tag('pvp_yes_selected', ($persistent_arr['persistent_pvp'] == 1) ? 'selected' : '' );
      $template->tag('pvp_arrange_selected', ($persistent_arr['persistent_pvp'] == 2) ? 'selected' : '' );
      $template->tag('pvp_no_selected', ($persistent_arr['persistent_pvp'] == 3) ? 'selected' : '' );
      $template->tag('pvp_special_selected', ($persistent_arr['persistent_pvp'] == 4) ? 'selected' : '' );
      $template->tag('pvp_N/A_selected', (($persistent_arr['persistent_pvp'] <= -1) || ($persistent_arr['persistent_pvp'] > 4)) ? 'selected' : '' );

      //online time selection "tags" (i.e. "conditions")
      $template->tag('uptime_always_selected', ($persistent_arr['persistent_termine'] == 1) ? 'selected' : '' );
      $template->tag('uptime_regular_selected', ($persistent_arr['persistent_termine'] == 2) ? 'selected' : '' );
      $template->tag('uptime_irregular_selected', ($persistent_arr['persistent_termine'] == 3) ? 'selected' : '' );
      $template->tag('uptime_N/A_selected', (($persistent_arr['persistent_termine'] <= -1) || ($persistent_arr['persistent_termine'] > 3)) ? 'selected' : '' );

      //download size selection "tags" (conditions)
      $dl_string = getPersistentDLSizeAsString($persistent_arr['persistent_dlsize']);
      $template->tag('dlsize_0_25_checked', ($dl_string == '0 bis 25 MB') ? 'checked' : '' );
      $template->tag('dlsize_26_50_checked', ($dl_string == '26 bis 50 MB') ? 'checked' : '' );
      $template->tag('dlsize_51_100_checked', ($dl_string == '51 bis 100 MB') ? 'checked' : '' );
      $template->tag('dlsize_101_250_checked', ($dl_string == '101 bis 250 MB') ? 'checked' : '' );
      $template->tag('dlsize_251_500_checked', ($dl_string == '251 bis 500 MB') ? 'checked' : '' );
      $template->tag('dlsize_501_or_more_checked', ($dl_string == 'mehr als 500 MB') ? 'checked' : '' );

      //expansion selection "tags" (i.e. condition work-around)
      $template->tag('exp_svu_checked', ($persistent_arr['persistent_dlsvu'] != 0) ? 'checked' : '' );
      $template->tag('exp_hdu_checked', ($persistent_arr['persistent_dlhdu'] != 0) ? 'checked' : '' );
      $template->tag('exp_cep_checked', ($persistent_arr['persistent_dlcep'] != 0) ? 'checked' : '' );
      $template->tag('exp_motb_checked', ($persistent_arr['persistent_dlmotb'] != 0) ? 'checked' : '' );
      $template->tag('exp_soz_checked', ($persistent_arr['persistent_dlsoz'] != 0) ? 'checked' : '' );

      //character registration selection "tags" (conditions)
      $template->tag('reg_start_selected', ($persistent_arr['persistent_anmeldung'] == 0) ? 'selected' : '' );
      $template->tag('reg_lvl1_selected', ($persistent_arr['persistent_anmeldung'] == 1) ? 'selected' : '' );
      $template->tag('reg_lvl2_selected', ($persistent_arr['persistent_anmeldung'] == 2) ? 'selected' : '' );
      $template->tag('reg_lvl3_selected', ($persistent_arr['persistent_anmeldung'] == 3) ? 'selected' : '' );
      $template->tag('reg_lvl4_selected', ($persistent_arr['persistent_anmeldung'] == 4) ? 'selected' : '' );
      $template->tag('reg_lvl5_selected', ($persistent_arr['persistent_anmeldung'] == 5) ? 'selected' : '' );
      $template->tag('reg_gt_lvl5_selected', (($persistent_arr['persistent_anmeldung'] >= 6) && ($persistent_arr['persistent_anmeldung'] < 100)) ? 'selected' : '' );
      $template->tag('reg_special_selected', ($persistent_arr['persistent_anmeldung'] == 100) ? 'selected' : '' );
      $template->tag('reg_never_selected', ($persistent_arr['persistent_anmeldung'] == 127) ? 'selected' : '' );
      $template->tag('reg_N/A_selected', ($persistent_arr['persistent_anmeldung'] <= -1) ? 'selected' : '' );

      $template->tag('handycap', $persistent_arr['persistent_handycap']);

      //DM selection "tags" (conditions)
      $template->tag('dm_1_selected', ($persistent_arr['persistent_dm'] == 1) ? 'selected' : '' );
      $template->tag('dm_2_selected', ($persistent_arr['persistent_dm'] == 2) ? 'selected' : '' );
      $template->tag('dm_3_selected', ($persistent_arr['persistent_dm'] == 3) ? 'selected' : '' );
      $template->tag('dm_4_selected', ($persistent_arr['persistent_dm'] == 4) ? 'selected' : '' );
      $template->tag('dm_5_selected', ($persistent_arr['persistent_dm'] == 5) ? 'selected' : '' );
      $template->tag('dm_6_selected', ($persistent_arr['persistent_dm'] == 6) ? 'selected' : '' );
      $template->tag('dm_7_selected', ($persistent_arr['persistent_dm'] == 7) ? 'selected' : '' );
      $template->tag('dm_8_selected', ($persistent_arr['persistent_dm'] == 8) ? 'selected' : '' );
      $template->tag('dm_9_selected', ($persistent_arr['persistent_dm'] == 9) ? 'selected' : '' );
      $template->tag('dm_10_selected', ($persistent_arr['persistent_dm'] == 10) ? 'selected' : '' );
      $template->tag('dm_gt_10_selected', ($persistent_arr['persistent_dm'] > 10) ? 'selected' : '' );
      $template->tag('dm_N/A_selected', ($persistent_arr['persistent_dm'] <= -1) ? 'selected' : '' );

      $template->tag('maxzahl', $persistent_arr['persistent_maxzahl']);
      $template->tag('maxlevel', $persistent_arr['persistent_maxlevel']);

      //EXP cap selection "tags" (conditions)
      $template->tag('expcap_yes_selected', ($persistent_arr['persistent_expcap'] == 1) ? 'selected' : '' );
      $template->tag('expcap_no_selected', ($persistent_arr['persistent_expcap'] == 0) ? 'selected' : '' );
      $template->tag('expcap_special_selected', ($persistent_arr['persistent_expcap'] == 2) ? 'selected' : '' );
      $template->tag('expcap_N/A_selected', (($persistent_arr['persistent_expcap'] <= -1) || ($persistent_arr['persistent_expcap'] > 2)) ? 'selected' : '' );

      //fights difficulty selection "tags" (conditions)
      $template->tag('fights_none_selected', ($persistent_arr['persistent_fights'] == 0) ? 'selected' : '' );
      $template->tag('fights_easy_selected', ($persistent_arr['persistent_fights'] == 1) ? 'selected' : '' );
      $template->tag('fights_medium_selected', ($persistent_arr['persistent_fights'] == 2) ? 'selected' : '' );
      $template->tag('fights_difficult_selected', ($persistent_arr['persistent_fights'] == 3) ? 'selected' : '' );
      $template->tag('fights_different_selected', ($persistent_arr['persistent_fights'] == 4) ? 'selected' : '' );
      $template->tag('fights_N/A_selected', (($persistent_arr['persistent_fights'] <= -1) || ($persistent_arr['persistent_fights'] > 4)) ? 'selected' : '' );

      //traps difficulty selection "tags" (conditions... I'm starting to get tired of this!)
      $template->tag('traps_none_selected', ($persistent_arr['persistent_traps'] == 0) ? 'selected' : '' );
      $template->tag('traps_easy_selected', ($persistent_arr['persistent_traps'] == 1) ? 'selected' : '' );
      $template->tag('traps_medium_selected', ($persistent_arr['persistent_traps'] == 2) ? 'selected' : '' );
      $template->tag('traps_difficult_selected', ($persistent_arr['persistent_traps'] == 3) ? 'selected' : '' );
      $template->tag('traps_different_selected', ($persistent_arr['persistent_traps'] == 4) ? 'selected' : '' );
      $template->tag('traps_N/A_selected', (($persistent_arr['persistent_traps'] <= -1) || ($persistent_arr['persistent_traps'] > 4)) ? 'selected' : '' );

      //item frequency selection "tags" (conditions)
      $template->tag('items_none_selected', ($persistent_arr['persistent_items'] == 0) ? 'selected' : '' );
      $template->tag('items_rare_selected', ($persistent_arr['persistent_items'] == 1) ? 'selected' : '' );
      $template->tag('items_normal_selected', ($persistent_arr['persistent_items'] == 2) ? 'selected' : '' );
      $template->tag('items_often_selected', ($persistent_arr['persistent_items'] == 3) ? 'selected' : '' );
      $template->tag('items_different_selected', ($persistent_arr['persistent_items'] == 4) ? 'selected' : '' );
      $template->tag('items_N/A_selected', (($persistent_arr['persistent_items'] <= -1) || ($persistent_arr['persistent_items'] > 4)) ? 'selected' : '' );

      $template = $template->display();
    }
    elseif (!isset($_SESSION['user_level']) || ($_SESSION['user_level'] != 'loggedin'))
    {
      $template = sys_message ( 'Persistente Welt bearbeiten', 'Du bist nicht eingeloggt.' );
    }
    elseif (($_SESSION['user_level'] == 'loggedin') && ($persistent_arr['persistent_posterid'] != $_SESSION['user_id']))
    {
      $template = sys_message ( 'Persistente Welt bearbeiten',
                                'Du hast nicht das Recht, diesen Eintrag zu editieren. Das ist nur dem Ersteller des Eintrages und der Administration von Planet Neverwinter gestattet.' );
    }
}
?>
