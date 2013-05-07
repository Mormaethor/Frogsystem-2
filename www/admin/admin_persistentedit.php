<?php
/*
    Frogsystem Persistent Worlds Scripts
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

//////////////////////////////////////////
//// Persistente Welten aktualisieren ////
//////////////////////////////////////////

if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['text']))
{
    settype($_POST['editpersitentid'], 'integer');
    if (isset($_POST['delpersistent']))
    {
        mysql_query('DELETE FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_id = '.$_POST['editpersistentid'].' LIMIT 1', $db);
		mysql_query('DELETE FROM `'.$global_config_arr['pref'].'pwoftheweek` WHERE pwoftheweek_id = '.$_POST['editpersistentid'].' LIMIT 1', $db);
        mysql_query('DELETE FROM `'.$global_config_arr['pref'].'persistent_comments` WHERE persistent_id = \''.$_POST['editpersistentid']."'", $db);
		$numcomments = mysql_affected_rows($db);
        mysql_query('UPDATE `'.$global_config_arr['pref'].'counter SET comments = comments - '.$numcomments, $db);
        systext('Persistente Welt wurde gel&ouml;scht.');
    }
    else
    {
		$datum = mktime(0, 0, 0, $_POST['monat'], $_POST['tag'], $_POST['jahr']);

        $_POST['name'] = savesql($_POST['name']);
        $_POST['url'] = savesql($_POST['url']);
        $_POST['text'] = savesql($_POST['text']);
        $_POST['text'] = ereg_replace ('&lt;textarea&gt;', '<textarea>', $_POST['text']);
        $_POST['text'] = ereg_replace ('&lt;/textarea&gt;', '</textarea>', $_POST['text']);
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
		settype($_POST[posterid], 'integer');
    	$_POST['seitenlink'] = savesql($_POST['seitenlink']);

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
					   persistent_datum = '".$datum."',
					   persistent_interview = '".$_POST['interview']."',
					   persistent_link = '".$_POST['seitenlink']."'
                   WHERE persistent_id = '".$_POST['editpersistentid']."'";
        mysql_query($update, $db);
        echo mysql_error();
		$update = 'UPDATE `'.$global_config_arr['pref'].'pwoftheweek`
                   SET pwoftheweek_name = \''.$_POST['name']."'
                   WHERE pwoftheweek_id = '".$_POST['editpersistentid']."'";
        mysql_query($update, $db);
		echo mysql_error();
        systext('Persistente Welt wurde aktualisiert');
    }
}

/////////////////////////////////////////
////// Persistente Welt editieren ///////
/////////////////////////////////////////

elseif (isset($_POST['persistentid']))
{
    settype($_POST['persistentid'], 'integer');
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent` WHERE persistent_id = \''.$_POST['persistentid']."'", $db);
    $persistent_arr = mysql_fetch_assoc($index);
	$persistent_arr['persistent_text'] = str_ireplace ('<textarea>', '&lt;textarea&gt;', $persistent_arr['persistent_text']);
    $persistent_arr['persistent_text'] = str_ireplace ('</textarea>', '&lt;/textarea&gt;', $persistent_arr['persistent_text']);

	$persistent_arr['persistent_text'] = stripslashes($persistent_arr['persistent_text']);

    $nowtag = date('d', $persistent_arr['persistent_datum']);
    $nowmonat = date('m', $persistent_arr['persistent_datum']);
    $nowjahr = date('Y', $persistent_arr['persistent_datum']);

    echo'
                    <form action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="persistentedit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <input type="hidden" value="'.$_POST['persistentid'].'" name="editpersistentid">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
                            <tr>
                                <td class="config" valign="top">
                                    Welten-Name:<br>
                                    <font class="small">Name der persistenten Welt. Kommt auch in den Hotlink</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="name" size="51" value="'.$persistent_arr['persistent_name'].'" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    URL:<br>
                                    <font class="small">Link zur persistenten Welt</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="url" size="51" value="'.$persistent_arr['persistent_url'].'" maxlength="255">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Beschreibung:<br>
                                    <font class="small">Kurze Beschreibung der Welt</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="text" rows="5" cols="51">'.$persistent_arr['persistent_text'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    F&uuml;r welches Spiel:<br>
                                    <font class="small">NWN oder NWN 2</font>
                                </td>
                                <td class="config" valign="top">
									<table width="100%">
										<tr>
											<td>
												<input type="radio" name="spiel" value="1"';
    if ($persistent_arr['persistent_spiel'] == 1) echo ' checked="checked"';
    echo '> NWN
											</td>
											<td>
												<input type="radio" name="spiel" value="2"';
	if ($persistent_arr['persistent_spiel'] == 2) echo ' checked="checked"';
	echo '> NWN 2
											</td>
										</tr>
									</table>
								</td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Setting:<br>
                                    <font class="small">In welches Setting ist die persistente Welt eingebettet?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="setting" size="1">
		';
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_setting` ORDER BY setting_name', $db);
    if (mysql_num_rows($index) == 0) echo '<option value="-1">k. A.</option>';
    while ($setting_arr = mysql_fetch_assoc($index))
    {
       $sele = ($setting_arr['setting_id'] == $persistent_arr['persistent_setting_id']) ? ' selected' : '';
       echo '<option value="'.$setting_arr['setting_id'].'"'.$sele.'>'.$setting_arr['setting_name'].'</option>';
    }
	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Genre:<br>
                                    <font class="small">In welchem Spiel-Genre ist die Welt einzuordnen?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="genre" size="1">
		';
	$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_genre` ORDER BY genre_name', $db);
	if (mysql_num_rows($index) == 0) echo '<option value="-1">k. A.</option>';
	while ($genre_arr = mysql_fetch_assoc($index))
	{
		$sele = ($genre_arr['genre_id'] == $persistent_arr['persistent_genre_id']) ? ' selected' : '';
        echo '<option value="'.$genre_arr['genre_id'].'"'.$sele.'>'.$genre_arr['genre_name'].'</option>';
	}
	$pvp_1_sele = ($persistent_arr['persistent_pvp']==1) ? ' selected' : '';
	$pvp_2_sele = ($persistent_arr['persistent_pvp']==2) ? ' selected' : '';
	$pvp_3_sele = ($persistent_arr['persistent_pvp']==3) ? ' selected' : '';
	$pvp_4_sele = ($persistent_arr['persistent_pvp']==4) ? ' selected' : '';
	$pvp_neg1_sele = ($persistent_arr['persistent_pvp']<=-1) ? ' selected' : '';
	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    PvP:<br>
                                    <font class="small">Sind K&auml;mpfe Player vs. Player m&ouml;glich?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="pvp" size="1">
										<option value="1"'.$pvp_1_sele.'>ja</option>
										<option value="2"'.$pvp_2_sele.'>nach Absprache</option>
										<option value="3"'.$pvp_3_sele.'>nein</option>
										<option value="4"'.$pvp_4_sele.'>speziell</option>
										<option value="-1"'.$pvp_neg1_sele.'>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Online-Zeiten:<br>
                                    <font class="small">Wann bzw. wie oft ist der Server online?</font>
                                </td>
                                <td class="config" valign="top">';
    $termine_1_sele = ($persistent_arr['persistent_termine']==1) ? ' selected' : '';
    $termine_2_sele = ($persistent_arr['persistent_termine']==2) ? ' selected' : '';
    $termine_3_sele = ($persistent_arr['persistent_termine']==3) ? ' selected' : '';
    $termine_neg1_sele = ($persistent_arr['persistent_termine']<=-1) ? ' selected' : '';
    echo '
                                	<select name="termine" size="1">
										<option value="1"'.$termine_1_sele.'>st&auml;ndig</option>
										<option value="2"'.$termine_2_sele.'>regelm&auml;&szlig;ig</option>
										<option value="3"'.$termine_3_sele.'>unregelm&auml;&szlig;ig</option>
										<option value="-1"'.$termine_neg1_sele.'>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Downloads:<br>
                                    <font class="small">Gr&ouml;&szlig;e der f&uuml;r den Server notwendigen Downloads. (HakPaks, Portraits, Musik, etc.)</font>
                                </td>
                                <td class="config" valign="top">
                                    <table width="100%">
										<tr>';
    $dl_0_25_checked = ((0<=$persistent_arr['persistent_dlsize']) && ($persistent_arr['persistent_dlsize']<=25)) ? ' checked' : '';
    $dl_26_50_checked = ((26<=$persistent_arr['persistent_dlsize']) && ($persistent_arr['persistent_dlsize']<=50)) ? ' checked' : '';
    $dl_51_100_checked = ((51<=$persistent_arr['persistent_dlsize']) && ($persistent_arr['persistent_dlsize']<=100)) ? ' checked' : '';
    $dl_101_250_checked = ((101<=$persistent_arr['persistent_dlsize']) && ($persistent_arr['persistent_dlsize']<=250)) ? ' checked' : '';
    $dl_251_500_checked = ((251<=$persistent_arr['persistent_dlsize']) && ($persistent_arr['persistent_dlsize']<=500)) ? ' checked' : '';
    $dl_501_plus_checked = (501<=$persistent_arr['persistent_dlsize']) ? ' checked' : '';
	echo'
											<td width="50%"><input type="radio" name="dlsize" value="25"'.$dl_0_25_checked.'> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="50"'.$dl_26_50_checked.'> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="100"'.$dl_51_100_checked.'> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="250"'.$dl_101_250_checked.'> 101 bis 250 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="500"'.$dl_251_500_checked.'> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="501"'.$dl_501_plus_checked.'> mehr als 500 MB</td>
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Notwendige Erweiterungen:<br>
                                    <font class="small">Was wird an Programmen ben&ouml;tigt?</font>
                                </td>
                                <td class="config" valign="top">
                                    <table width="100%">
										<tr>'."\n";
    $svu_checked = ($persistent_arr['persistent_dlsvu']!=0) ? ' checked' : '';
    $hdu_checked = ($persistent_arr['persistent_dlhdu']!=0) ? ' checked' : '';
    $cep_checked = ($persistent_arr['persistent_dlcep']!=0) ? ' checked' : '';
    $motb_checked = ($persistent_arr['persistent_dlmotb']!=0) ? ' checked' : '';
    $soz_checked = ($persistent_arr['persistent_dlsoz']!=0) ? ' checked' : '';
    echo '
   											<td width="50%"><input type="checkbox" name="dlsvu" value="1"'.$svu_checked.'> SvU</td>
											<td width="50%"><input type="checkbox" name="dlmotb" value="1"'.$motb_checked.'> MotB</td>
										</tr>
										<tr>
											<td width="50%"><input type="checkbox" name="dlhdu" value="1" '.$hdu_checked.'> HdU</td>
											<td width="50%"><input type="checkbox" name="dlsoz" value="1" '.$soz_checked.'> SoZ</td>
										</tr>
										<tr>
											<td width="50%"><input type="checkbox" name="dlcep" value="1" '.$cep_checked.'> CEP</td>
											<td width="50%">&nbsp;</td>
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Anmeldung ab:<br>
                                    <font class="small">Ab welchem Level ist eine Anmeldung erforderlich?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="anmeldung" size="1">
		';
    $reg_0_selected = ($persistent_arr['persistent_anmeldung']==0) ? ' selected' : '';
    $reg_1_selected = ($persistent_arr['persistent_anmeldung']==1) ? ' selected' : '';
    $reg_2_selected = ($persistent_arr['persistent_anmeldung']==2) ? ' selected' : '';
    $reg_3_selected = ($persistent_arr['persistent_anmeldung']==3) ? ' selected' : '';
    $reg_4_selected = ($persistent_arr['persistent_anmeldung']==4) ? ' selected' : '';
    $reg_5_selected = ($persistent_arr['persistent_anmeldung']==5) ? ' selected' : '';
    $reg_gt_5_selected = ((5<$persistent_arr['persistent_anmeldung']) && ($persistent_arr['persistent_anmeldung']<100)) ? ' selected' : '';
    $reg_special_selected = ($persistent_arr['persistent_anmeldung']==100) ? ' selected' : '';
    $reg_never_selected = ($persistent_arr['persistent_anmeldung']==127) ? ' selected' : '';
    $reg_kA_selected = ($persistent_arr['persistent_anmeldung']<=-1) ? ' selected' : '';
	echo '
										<option value="0"'.$reg_0_selected.'>von Anfang an</option>
										<option value="1"'.$reg_1_selected.'>Level 1</option>
										<option value="2"'.$reg_2_selected.'>Level 2</option>
										<option value="3"'.$reg_3_selected.'>Level 3</option>
										<option value="4"'.$reg_4_selected.'>Level 4</option>
										<option value="5"'.$reg_5_selected.'>Level 5</option>
										<option value="6"'.$reg_gt_5_selected.'>&gt; Level 5</option>
										<option value="100"'.$reg_special_selected.'>speziell</option>
										<option value="127"'.$reg_never_selected.'>nie</option>
										<option value="-1"'.$reg_kA_selected.'>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Einschr&auml;nkungen:<br>
                                    <font class="small">Rassen, Klassen, Gesinnungen etc., die nicht m&ouml;glich sind.</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="handycap" rows="3" cols="51">'.$persistent_arr['persistent_handycap'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Anzahl der Spielleiter:<br>
                                    <font class="small">Maximale Anzahl der die Spieler betreuenden Spielleiter.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="dm" size="1">';
    $dm_1_selected = ($persistent_arr['persistent_dm']==1) ? ' selected' : '';
    $dm_2_selected = ($persistent_arr['persistent_dm']==2) ? ' selected' : '';
    $dm_3_selected = ($persistent_arr['persistent_dm']==3) ? ' selected' : '';
    $dm_4_selected = ($persistent_arr['persistent_dm']==4) ? ' selected' : '';
    $dm_5_selected = ($persistent_arr['persistent_dm']==5) ? ' selected' : '';
    $dm_6_selected = ($persistent_arr['persistent_dm']==6) ? ' selected' : '';
    $dm_7_selected = ($persistent_arr['persistent_dm']==7) ? ' selected' : '';
    $dm_8_selected = ($persistent_arr['persistent_dm']==8) ? ' selected' : '';
    $dm_9_selected = ($persistent_arr['persistent_dm']==9) ? ' selected' : '';
    $dm_10_selected = ($persistent_arr['persistent_dm']==10) ? ' selected' : '';
    $dm_gt10_selected = ($persistent_arr['persistent_dm']>10) ? ' selected' : '';
    $dm_kA_selected = ($persistent_arr['persistent_dm']<0) ? ' selected' : '';
	echo'
										<option value="1"'.$dm_1_selected.'>1</option>
										<option value="2"'.$dm_2_selected.'>2</option>
										<option value="3"'.$dm_3_selected.'>3</option>
										<option value="4"'.$dm_4_selected.'>4</option>
										<option value="5"'.$dm_5_selected.'>5</option>
										<option value="6"'.$dm_6_selected.'>6</option>
										<option value="7"'.$dm_7_selected.'>7</option>
										<option value="8"'.$dm_8_selected.'>8</option>
										<option value="9"'.$dm_9_selected.'>9</option>
										<option value="10"'.$dm_10_selected.'>10</option>
										<option value="11"'.$dm_gt10_selected.'>&gt; 10</option>
										<option value="-1"'.$dm_kA_selected.'>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Maximale Spieleranzahl:<br>
                                    <font class="small">Anzahl der m&ouml;glichen maximalen Spieleranzahl auf dem Server.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxzahl" value="'.$persistent_arr['persistent_maxzahl'].'" size="4" maxlength="4">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    H&ouml;chstes erreichbares Level:<br>
                                    <font class="small">Welches maximale Level kann ein Spieler erreichen?</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxlevel" value="'.$persistent_arr['persistent_maxlevel'].'" size="2" maxlength="50">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Erfahrungspunkte-Begrenzung:<br>
                                    <font class="small">Gibt es eine Begrenzung der zu bekommenden Erfahrungspunkte?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="expcap" size="1">';
    $expcap_1_selected = ($persistent_arr['persistent_expcap']==1) ? ' selected' : '';
    $expcap_2_selected = ($persistent_arr['persistent_expcap']==2) ? ' selected' : '';
    $expcap_0_selected = ($persistent_arr['persistent_expcap']==0) ? ' selected' : '';
    $expcap_neg1_selected = (($persistent_arr['persistent_expcap']<=-1) || ($persistent_arr['persistent_expcap']>2)) ? ' selected' : '';
    echo '
										<option value="1"'.$expcap_1_selected.'>ja</option>
										<option value="0"'.$expcap_0_selected.'>nein</option>
										<option value="2"'.$expcap_2_selected.'>speziell</option>
										<option value="-1"'.$expcap_neg1_selected.'>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    K&auml;mpfe:<br>
                                    <font class="small">Schwierigkeitsgrad der K&auml;mpfe.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="fights" size="1">';
    $fights_0_selected = ($persistent_arr['persistent_fights']==0) ? ' selected' : '';
    $fights_1_selected = ($persistent_arr['persistent_fights']==1) ? ' selected' : '';
    $fights_2_selected = ($persistent_arr['persistent_fights']==2) ? ' selected' : '';
    $fights_3_selected = ($persistent_arr['persistent_fights']==3) ? ' selected' : '';
    $fights_4_selected = ($persistent_arr['persistent_fights']==4) ? ' selected' : '';
    $fights_kA_selected = (($persistent_arr['persistent_fights']<=-1) || ($persistent_arr['persistent_fights']>4)) ? ' selected' : '';
    echo '
										<option value="0"'.$fights_0_selected.'>keine</option>
										<option value="1"'.$fights_1_selected.'>leicht</option>
										<option value="2"'.$fights_2_selected.'>mittel</option>
										<option value="3"'.$fights_3_selected.'>schwer</option>
										<option value="4"'.$fights_4_selected.'>uneinheitlich</option>
										<option value="-1" '.$fights_kA_selected.'>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Fallen:<br>
                                    <font class="small">Schwierigkeitsgrad der Fallen.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="traps" size="1">';
    $traps_0_selected = ($persistent_arr['persistent_traps']==0) ? ' selected' : '';
    $traps_1_selected = ($persistent_arr['persistent_traps']==1) ? ' selected' : '';
    $traps_2_selected = ($persistent_arr['persistent_traps']==2) ? ' selected' : '';
    $traps_3_selected = ($persistent_arr['persistent_traps']==3) ? ' selected' : '';
    $traps_4_selected = ($persistent_arr['persistent_traps']==4) ? ' selected' : '';
    $traps_kA_selected = (($persistent_arr['persistent_traps']<=-1) || ($persistent_arr['persistent_traps']>4)) ? ' selected' : '';
    echo '
										<option value="0" '.$traps_0_selected.'>keine</option>
										<option value="1"'.$traps_1_selected.'>leicht</option>
										<option value="2"'.$traps_2_selected.'>mittel</option>
										<option value="3"'.$traps_3_selected.'>schwer</option>
										<option value="4"'.$traps_4_selected.'>uneinheitlich</option>
										<option value="-1"'.$traps_kA_selected.'>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Items:<br>
                                    <font class="small">H&auml;ufigkeit besonderer/hochwertiger Items.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="items" size="1">';
    $items_0_selected = ($persistent_arr['persistent_items']==0) ? ' selected' : '';
    $items_1_selected = ($persistent_arr['persistent_items']==1) ? ' selected' : '';
    $items_2_selected = ($persistent_arr['persistent_items']==2) ? ' selected' : '';
    $items_3_selected = ($persistent_arr['persistent_items']==3) ? ' selected' : '';
    $items_4_selected = ($persistent_arr['persistent_items']==4) ? ' selected' : '';
    $items_kA_selected = (($persistent_arr['persistent_items']<=-1) || ($persistent_arr['persistent_items']>4)) ? ' selected' : '';
    echo '
										<option value="0" '.$items_0_selected.'>keine</option>
										<option value="1" '.$items_1_selected.'>selten</option>
										<option value="2" '.$items_2_selected.'>normal</option>
										<option value="3" '.$items_3_selected.'>oft</option>
										<option value="4" '.$items_4_selected.'>uneinheitlich</option>
										<option value="-1" '.$items_kA_selected.'>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Datum:<br>
                                    <font class="small">Wann wurde diese persistente Welt eingetragen? (TT MM JJJJ)</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" size="2" name="tag" value="'.$nowtag.'" maxlength="2">
                                    <input class="text" size="2" name="monat" value="'.$nowmonat.'" maxlength="2">
                                    <input class="text" size="4" name="jahr" value="'.$nowjahr.'" maxlength="4">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Interview:<br>
                                    <font class="small">Falls ein Interview von Planet Neverwinter mit den Serverbetreibern gef&uuml;hrt wurde, bitte die Artikel-URL angeben.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="interview" value="'.$persistent_arr['persistent_interview'].'" size="51" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Interner Link:<br>
                                    <font class="small">Link zum Profilblatt innerhalb von PNW. Wird an das ?go= angehangen.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="seitenlink" value="'.$persistent_arr['persistent_link'].'" size="51" maxlength="255">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Persistente Welt l&ouml;schen:
                                </td>
                                <td class="config">
                                    <input onClick="alert(this.value)" type="checkbox" name="delpersistent" value="Sicher?">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="button" type="submit" value="Absenden">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';

    // Kommentare anzeigen
    echo'
                    <p>
                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                        <input type="hidden" value="pwcommentedit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td align="center" class="config" colspan="4">
                                    Kommentare
                                </td>
                            </tr>
                            <tr>
                                <td class="config" width="30%">
                                    Titel
                                </td>
                                <td class="config" width="30%">
                                    Poster
                                </td>
                                <td class="config" width="25%">
                                    Datum
                                </td>
                                <td class="config" width="15%">
                                    bearbeiten
                                </td>
                            </tr>
    ';

    // Kommentare auflisten
    $index = mysql_query('SELECT persistent_comment_id, comment_title, comment_date, comment_poster, comment_poster_id
                          FROM `'.$global_config_arr['pref'].'persistent_comments`
                          WHERE persistent_id = '.$persistent_arr['persistent_id'].'
                          ORDER BY comment_date DESC', $db);
    echo mysql_error();
    if (mysql_num_rows($index) === 0)
    {
	  echo '<tr>
              <td class="configthin" colspan="4" style="text-align: center;">Keine Kommentare vorhanden.</td>
            </tr>';
    }
    while ($comment_arr = mysql_fetch_assoc($index))
    {
        $dbcommentposterid = $comment_arr['comment_poster_id'];
        if ($comment_arr['comment_poster_id'] != 0)
        {
            $userindex = mysql_query('SELECT user_name FROM `'.$global_config_arr['pref'].'user` WHERE user_id = '.$comment_arr['comment_poster_id'], $db);
            $comment_arr['comment_poster'] = mysql_result($userindex, 0, 'user_name');
        }
        $comment_arr['comment_date'] = date('d.m.Y' , $comment_arr['comment_date']) . ' um ' . date('H:i' , $comment_arr['comment_date']);
        echo '
                            <tr>
                                <td class="configthin">
                                    '.$comment_arr['comment_title'].'
                                </td>
                                <td class="configthin">
                                    '.$comment_arr['comment_poster'].'
                                </td>
                                <td class="configthin">
                                    '.$comment_arr['comment_date'].'
                                </td>
                                <td class="configthin">
                                    <input type="radio" name="commentid" value="'.$comment_arr['persistent_comment_id'].'">
                                </td>
                            </tr>
        ';
    }
    echo'
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="4">
                                    <input class="button" type="submit" value="Kommentar bearbeiten">
                                </td>
                            </tr>
                        </table>
                    </form>
        ';
}

/////////////////////////////////////////
////// Persistente Welt auswählen ///////
/////////////////////////////////////////

else
{
    echo'
                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                        <input type="hidden" value="persistentedit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td class="config" width="40%">
                                    Welten-Name
                                </td>
                                <td class="config" width="20%">
                                    bearbeiten
                                </td>
                            </tr>
    ';
    $index = mysql_query('SELECT persistent_id, persistent_name
                          FROM `'.$global_config_arr['pref'].'persistent`
                          ORDER BY persistent_name', $db);
    if (mysql_num_rows($index) == 0)
    {
      echo '<tr>
              <td class="configthin" colspan="2" style="text-align: center;">Keine Persistenten Welten eingetragen!</td>
            </tr>';
    }
    while ($persistent_arr = mysql_fetch_assoc($index))
    {
        echo'
                            <tr>
                                <td class="configthin">
                                    '.$persistent_arr['persistent_name'].'
                                </td>
                                <td class="config">
                                    <input type="radio" name="persistentid" value="'.$persistent_arr['persistent_id'].'">
                                </td>
                            </tr>
        ';
    }
    echo'
                            <tr>
                                <td colspan="4">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <input class="button" type="submit" value="editieren">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';
}
?>
