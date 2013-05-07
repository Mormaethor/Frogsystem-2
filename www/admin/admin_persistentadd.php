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

/////////////////////////////////////
//// Persistente Welt einstellen ////
/////////////////////////////////////

if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['text']) && isset($_POST['spiel']))
{
	$datum = mktime(0, 0, 0, $_POST['monat'], $_POST['tag'], $_POST['jahr']);

    $_POST['name'] = savesql($_POST['name']);
    $_POST['url'] = savesql($_POST['url']);
    $_POST['text'] = savesql($_POST['text']);
    $_POST['spiel'] = savesql($_POST['spiel']);
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

	$index = mysql_query('SELECT persistent_name, persistent_link FROM `'.$global_config_arr['pref'].'persistent`'
	                    .' WHERE persistent_name = \''.$_POST['name']."' OR persistent_link='".$_POST['seitenlink']."'");
    if ((mysql_num_rows($index) == 0) && ($_POST['seitenlink']!=''))
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
                         '".$_POST['posterid']."',
                         '".$_POST['seitenlink']."');", $db);
        echo mysql_error();
        systext('Persistente Welt wurde gespeichert.');
    }
    elseif (mysql_num_rows($index) == 0)
    {
        systext('Diese persistente Welt exitiert bereits.');
    }
    else
    {
        systext('Kein g&uuml;ltiger Seitenlink!');
    }
}

///////////////////////////////////////
///// Persistente Welten Formular /////
///////////////////////////////////////

else
{
    echo'
                    <form action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="persistentadd" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
                            <tr>
                                <td class="config" valign="top">
                                    Welten-Name:<br>
                                    <font class="small">Name der persistenten Welt. Kommt auch in den Hotlink.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="name" size="51" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    URL:<br>
                                    <font class="small">Link zur persistenten Welt.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="url" size="51" maxlength="255" value="http://">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Autor:<br>
                                    <font class="small">Eintrag erstellt von:</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" size="30" id="username" name="poster" maxlength="100" disabled>
                                    <input type="hidden" id="userid" name="posterid">
                                    <input onClick=\'open("admin_finduser.php","Poster","width=360,height=300,screenX=50,screenY=50,scrollbars=YES")\' class="button" type="button" value="Suchen">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Weltenbeschreibung:<br>
                                    <font class="small">Kurze Weltenbeschreibung</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="text" rows="15" cols="51"></textarea>
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
											<td width="50%"><input type="radio" name="spiel" value="1"> NWN</td>
											<td width="50%"><input type="radio" name="spiel" value="2"> NWN 2</td>
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Setting:<br>
                                    <font class="small">In welches Setting ist die persistente Welt eingebettet:</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="setting" size="1">
		';
	$index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_setting` ORDER BY setting_name', $db);
    if (mysql_num_rows($index)==0)
    {
      echo'<option value="-1">k. A.</option>';
    }
	while ($setting_arr = mysql_fetch_assoc($index))
	{
      echo'<option value="'.$setting_arr['setting_id'].'">'.$setting_arr['setting_name'].'</option>';
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
    if (mysql_num_rows($index)==0)
    {
      echo'<option value="-1">k. A.</option>';
    }
    while ($genre_arr = mysql_fetch_assoc($index))
    {
      echo '<option value="'.$genre_arr['genre_id'].'">'.$genre_arr['genre_name'].'</option>';
    }
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
										<option value="1">ja</option>
										<option value="2">nach Absprache</option>
										<option value="3">nein</option>
										<option value="4">speziell</option>
										<option value="-1">k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Online-Zeiten:<br>
                                    <font class="small">Wann bzw. wie oft ist der Server online?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="termine" size="1">
										<option value="1">st&auml;ndig</option>
										<option value="2">regelm&auml;&szlig;ig</option>
										<option value="3">unregelm&auml;&szlig;ig</option>
										<option value="-1">k. A.</option>
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
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="25"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="50"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="100"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="250"> 101 bis 250 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="500"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="501"> mehr als 500 MB</td>
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
										<tr>
                                            <td width="50%"><input type="checkbox" name="dlsvu" value="1">SvU</td>
                                            <td width="50%"><input type="checkbox" name="dlmotb" value="1">MotB</td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="checkbox" name="dlhdu" value="1">HdU</td>
                                            <td width="50%"><input type="checkbox" name="dlsoz" value="1">SoZ</td>
                                        </tr>
                                        <tr>
                                            <td width="50%"><input type="checkbox" name="dlcep" value="1">CEP</td>
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
										<option value="0">von Anfang an</option>
										<option value="1">Level 1</option>
										<option value="2">Level 2</option>
										<option value="3">Level 3</option>
										<option value="4">Level 4</option>
										<option value="5">Level 5</option>
										<option value="6">&gt; Level 5</option>
										<option value="100">speziell</option>
										<option value="127">nie</option>
										<option value="-1" selected>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Einschr&auml;nkungen:<br>
                                    <font class="small">Rassen, Klassen, Gesinnungen etc., die nicht m&ouml;glich sind.</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="handycap" rows="3" cols="51"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Anzahl der Spielleiter:<br>
                                    <font class="small">Maximale Anzahl der die Spieler betreuenden Spielleiter.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="dm" size="1">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">&gt; 10</option>
										<option value="-1" selected>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Maximale Spieleranzahl:<br>
                                    <font class="small">Anzahl der m&ouml;glichen maximalen Spieleranzahl auf dem Server.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxzahl" size="4" maxlength="4">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Höchstes erreichbares Level:<br>
                                    <font class="small">Welches maximale Level kann ein Spieler erreichen?</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxlevel" size="2" maxlength="50">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Erfahrungspunkte-Begrenzung:<br>
                                    <font class="small">Gibt es eine Begrenzung der zu bekommenden Erfahrungspunkte?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="expcap" size="1">
										<option value="1">ja</option>
										<option value="0">nein</option>
										<option vaue="2">speziell</option>
										<option value="-1" selected>k. A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Kämpfe:<br>
                                    <font class="small">Schwierigkeitsgrad der K&auml;mpfe:</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="fights" size="1">
										<option value="0">keine</option>
										<option value="1">leicht</option>
										<option value="2">mittel</option>
										<option value="3">schwer</option>
										<option value="4">uneinheitlich</option>
										<option value="-1" selected>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Fallen:<br>
                                    <font class="small">Schwierigkeitsgrad der Fallen:</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="traps" size="1">
										<option value="0">keine</option>
										<option value="1">leicht</option>
										<option value="2">mittel</option>
										<option value="3">schwer</option>
										<option value="4">uneinheitlich</option>
										<option value="-1" selected>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Items:<br>
                                    <font class="small">H&auml;ufigkeit besonderer/hochwertiger Items.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="items" size="1">
										<option value="0">keine</option>
										<option value="1">selten</option>
										<option value="2">normal</option>
										<option value="3">oft</option>
										<option value="4">uneinheitlich</option>
										<option value="-1" selected>k.A.</option>
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Datum:<br>
                                    <font class="small">Wann wurde diese persistente Welt eingetragen? (TT MM JJJJ)</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" size="2" name="tag" maxlength="2" value="'.date('d').'">
                                    <input class="text" size="2" name="monat" maxlength="2" value="'.date('m').'">
                                    <input class="text" size="4" name="jahr" maxlength="4" value="'.date('Y').'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Interview:<br>
                                    <font class="small">Falls ein Interview von Planet Neverwinter mit den Serverbetreibern gef&uuml;hrt wurde, bitte die Artikel-URL angeben.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="interview" size="51" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Interner Link:<br>
                                    <font class="small">Link zum Profilblatt innerhalb von PNW. Wird an das ?go= angehangen.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="seitenlink" size="51" maxlength="255">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2">
                                    <input class="button" type="submit" value="Hinzuf&uuml;gen">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';
}
?>
