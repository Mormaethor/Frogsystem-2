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

/////////////////////////
//// Setting löschen ////
/////////////////////////

if (isset($_POST['delsetting']))
{
    settype($_POST['delsetting'], 'integer');

	//delete setting
	$index = mysql_query('DELETE FROM `'.$global_config_arr['pref'].'persistent_setting` WHERE setting_id = \''.$_POST['delsetting']."' LIMIT 1", $db);
    //update related persistent world entries to "N/A"
    mysql_query('UPDATE `'.$global_config_arr['pref'].'persistent` SET persistent_setting_id=\'-1\' WHERE persistent_setting_id = \''.$_POST['delsetting']."'", $db);

	systext('Setting wurde gel&ouml;scht');
}
/*
else
{
    systext('Setting konnte nicht gelöscht werden');
}
*/
elseif (isset($_POST['delgenre']))
{
    settype($_POST['delgenre'], 'integer');

	//delete genre
	$index = mysql_query('DELETE FROM `'.$global_config_arr['pref'].'persistent_genre` WHERE genre_id = \''.$_POST['delgenre']."' LIMIT 1", $db);
    //updated related persistent world entries to "N/A"
    mysql_query('UPDATE `'.$global_config_arr['pref'].'persistent` SET persistent_genre_id=\'-1\' WHERE persistent_genre_id = \''.$_POST['delgenre']."'", $db);

	systext('Genre wurde gel&ouml;scht');
}

/////////////////////////
/// Setting auswählen ///
/////////////////////////

else
{
    echo'
                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                        <input type="hidden" value="persistentformdelete" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td class="config" width="50%">
                                    Setting
                                </td>
                                <td class="config" width="30%">
                                    erstellt am
                                </td>
                                <td class="config" width="20%">
                                    l&ouml;schen
                                </td>
                            </tr>
    ';
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_setting` ORDER BY setting_date DESC', $db);
    while ($setting_arr = mysql_fetch_assoc($index))
    {
		$setting_arr['setting_date'] = date('d.m.Y', $setting_arr['setting_date']);
        echo'
                            <tr>
                                <td class="configthin">
                                    '.$setting_arr['setting_name'].'
                                </td>
                                <td class="configthin">
                                    '.$setting_arr['setting_date'].'
                                </td>
                                <td class="config">
                                    <input type="radio" name="delsetting" value="'.$setting_arr['setting_id'].'">
                                </td>
                            </tr>
        ';
    }
    echo'
                            <tr>
                                <td colspan="3">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <input class="button" type="submit" value="L&ouml;schen">
                                </td>
                            </tr>
                        </table>
                    </form>
					<table border="0" cellpadding="2" cellspacing="0" width="600">
                    	<tr>
                        	<td class="config">
                                <div align="center">&nbsp;<br>- oder -<br>&nbsp;</div>
							</td>
						</tr>
					</table>
                    <form action="'.$_SERVER['PHP_SELF'].'" method="post">
                        <input type="hidden" value="persistentformdelete" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td class="config" width="50%">
                                    Genre
                                </td>
                                <td class="config" width="30%">
                                    erstellt am
                                </td>
                                <td class="config" width="20%">
                                    l&ouml;schen
                                </td>
                            </tr>
    ';
    $index = mysql_query('SELECT * FROM `'.$global_config_arr['pref'].'persistent_genre` ORDER BY genre_date DESC', $db);
    while ($genre_arr = mysql_fetch_assoc($index))
    {
		$genre_arr['genre_date'] = date('d.m.Y', $genre_arr['genre_date']);
        echo'
                            <tr>
                                <td class="configthin">
                                    '.$genre_arr['genre_name'].'
                                </td>
                                <td class="configthin">
                                    '.$genre_arr['genre_date'].'
                                </td>
                                <td class="config">
                                    <input type="radio" name="delgenre" value="'.$genre_arr['genre_id'].'">
                                </td>
                            </tr>
        ';
    }
    echo'
                            <tr>
                                <td colspan="3">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="center">
                                    <input class="button" type="submit" value="L&ouml;schen">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';
}
?>
