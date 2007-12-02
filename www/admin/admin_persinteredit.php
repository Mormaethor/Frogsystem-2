<?php
/*
    Frogsystem Persistent Worlds Scripts
    Copyright (C) 2005-2007  Stefan Bollmann

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

////////////////////////////////////////////////////
//// persisinterviewe Welten Interview aktualisieren ////
////////////////////////////////////////////////////


if ($_POST[name] && $_POST[url] && $_POST[antwort01] && $_POST[antwort02] && $_POST[antwort03] && $_POST[antwort04] && $_POST[antwort05] && $_POST[antwort06] && $_POST[antwort07] && $_POST[antwort08] && $_POST[antwort09] && $_POST[antwort10] && $_POST[antwort11] && $_POST[antwort12] && $_POST[antwort13])
{

    settype($_POST['editpersisinterviewid'], 'integer');
    if (isset($_POST['delpersisinterview']))
    {
        mysql_query("DELETE FROM fsplus_persisinterview WHERE persisinterview_id = $_POST[editpersisinterviewid]", $db);
        systext('Persistente Welt Interview wurde gel�scht.');
    }
    else
    {
		$datum = mktime(0, 0, 0, $_POST[monat], $_POST[tag], $_POST[jahr]);
        $_POST[name] = savesql($_POST[name]);
    	$_POST[url] = savesql($_POST[url]);
    	$_POST[spiel] = savesql($_POST[spiel]);
		$_POST[antwort01] = savesql($_POST[antwort01]);
        $_POST[antwort01] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort01]);
        $_POST[antwort01] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort01]);
		$_POST[antwort02] = savesql($_POST[antwort02]);
        $_POST[antwort02] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort02]);
        $_POST[antwort02] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort02]);
        $_POST[antwort03] = savesql($_POST[antwort03]);
        $_POST[antwort03] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort03]);
        $_POST[antwort03] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort03]);
        $_POST[antwort04] = savesql($_POST[antwort04]);
        $_POST[antwort04] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort04]);
        $_POST[antwort04] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort04]);
        $_POST[antwort05] = savesql($_POST[antwort05]);
        $_POST[antwort05] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort05]);
        $_POST[antwort05] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort05]);
        $_POST[antwort06] = savesql($_POST[antwort06]);
        $_POST[antwort06] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort06]);
        $_POST[antwort06] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort06]);
        $_POST[antwort07] = savesql($_POST[antwort07]);
        $_POST[antwort07] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort07]);
        $_POST[antwort07] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort07]);
        $_POST[antwort08] = savesql($_POST[antwort08]);
        $_POST[antwort08] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort08]);
        $_POST[antwort08] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort08]);
        $_POST[antwort09] = savesql($_POST[antwort09]);
        $_POST[antwort09] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort09]);
        $_POST[antwort09] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort09]);
        $_POST[antwort10] = savesql($_POST[antwort10]);
        $_POST[antwort10] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort10]);
        $_POST[antwort10] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort10]);
        $_POST[antwort11] = savesql($_POST[antwort11]);
        $_POST[antwort11] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort11]);
        $_POST[antwort11] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort11]);
        $_POST[antwort12] = savesql($_POST[antwort12]);
        $_POST[antwort12] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort12]);
        $_POST[antwort12] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort12]);
        $_POST[antwort13] = savesql($_POST[antwort13]);
        $_POST[antwort13] = ereg_replace ("&lt;textarea&gt;", "<textarea>", $_POST[antwort13]);
        $_POST[antwort13] = ereg_replace ("&lt;/textarea&gt;", "</textarea>", $_POST[antwort13]);
		settype($_POST[posterid], 'integer');

        $update = "UPDATE fsplus_persisinterview
                   SET persisinterview_spiel = '".$_POST[spiel]."',
					   persisinterview_name = '".$_POST[name]."',
					   persisinterview_url = '".$_POST[url]."',
					   persisinterview_antwort01 = '".$_POST[antwort01]."',
                       persisinterview_antwort02 = '".$_POST[antwort02]."',
                       persisinterview_antwort03 = '".$_POST[antwort03]."',
                       persisinterview_antwort04 = '".$_POST[antwort04]."',
					   persisinterview_antwort05 = '".$_POST[antwort05]."',
					   persisinterview_antwort06 = '".$_POST[antwort06]."',
					   persisinterview_antwort07 = '".$_POST[antwort07]."',
					   persisinterview_antwort08 = '".$_POST[antwort08]."',
					   persisinterview_antwort09 = '".$_POST[antwort09]."',
					   persisinterview_antwort10 = '".$_POST[antwort10]."',
					   persisinterview_antwort11 = '".$_POST[antwort11]."',
					   persisinterview_antwort12 = '".$_POST[antwort12]."',
					   persisinterview_antwort13 = '".$_POST[antwort13]."'
                   WHERE persisinterview_id = '".$_POST[editpersisinterviewid]."'";
        mysql_query($update, $db);
//		echo mysql_error();
//		echo mysql_errno();
        systext("Persistente Welten Interview wurde aktualisiert");
    }
}

///////////////////////////////////////////////////
////// persistente Welt Interview editieren ///////
///////////////////////////////////////////////////

elseif ($_POST[persisinterviewid])
{
    settype($_POST[persisinterviewid], 'integer');
    $index = mysql_query("SELECT * FROM fsplus_persisinterview WHERE persisinterview_id = $_POST[persisinterviewid]", $db);
    $persisinterview_arr = mysql_fetch_assoc($index);
	$persisinterview_arr[persisinterview_antwort01] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort01]);
    $persisinterview_arr[persisinterview_antwort01] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort01]);
	$persisinterview_arr[persisinterview_antwort02] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort02]);
    $persisinterview_arr[persisinterview_antwort02] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort02]);
	$persisinterview_arr[persisinterview_antwort03] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort03]);
    $persisinterview_arr[persisinterview_antwort03] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort03]);
	$persisinterview_arr[persisinterview_antwort04] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort04]);
    $persisinterview_arr[persisinterview_antwort04] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort04]);
	$persisinterview_arr[persisinterview_antwort05] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort05]);
    $persisinterview_arr[persisinterview_antwort05] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort05]);
	$persisinterview_arr[persisinterview_antwort06] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort06]);
    $persisinterview_arr[persisinterview_antwort06] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort06]);
	$persisinterview_arr[persisinterview_antwort07] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort07]);
    $persisinterview_arr[persisinterview_antwort07] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort07]);
	$persisinterview_arr[persisinterview_antwort08] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort08]);
    $persisinterview_arr[persisinterview_antwort08] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort08]);
	$persisinterview_arr[persisinterview_antwort09] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort09]);
    $persisinterview_arr[persisinterview_antwort09] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort09]);
	$persisinterview_arr[persisinterview_antwort10] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort10]);
    $persisinterview_arr[persisinterview_antwort10] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort10]);
	$persisinterview_arr[persisinterview_antwort11] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort11]);
    $persisinterview_arr[persisinterview_antwort11] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort11]);
	$persisinterview_arr[persisinterview_antwort12] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort12]);
    $persisinterview_arr[persisinterview_antwort12] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort12]);
	$persisinterview_arr[persisinterview_antwort13] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persisinterview_arr[persisinterview_antwort13]);
    $persisinterview_arr[persisinterview_antwort13] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persisinterview_arr[persisinterview_antwort13]);

	$persisinterview_arr[persisinterview_antwort01] = stripslashes($persisinterview_arr[persisinterview_antwort01]);
	$persisinterview_arr[persisinterview_antwort02] = stripslashes($persisinterview_arr[persisinterview_antwort02]);
	$persisinterview_arr[persisinterview_antwort03] = stripslashes($persisinterview_arr[persisinterview_antwort03]);
	$persisinterview_arr[persisinterview_antwort04] = stripslashes($persisinterview_arr[persisinterview_antwort04]);
	$persisinterview_arr[persisinterview_antwort05] = stripslashes($persisinterview_arr[persisinterview_antwort05]);
	$persisinterview_arr[persisinterview_antwort06] = stripslashes($persisinterview_arr[persisinterview_antwort06]);
	$persisinterview_arr[persisinterview_antwort07] = stripslashes($persisinterview_arr[persisinterview_antwort07]);
	$persisinterview_arr[persisinterview_antwort08] = stripslashes($persisinterview_arr[persisinterview_antwort08]);
	$persisinterview_arr[persisinterview_antwort09] = stripslashes($persisinterview_arr[persisinterview_antwort09]);
	$persisinterview_arr[persisinterview_antwort10] = stripslashes($persisinterview_arr[persisinterview_antwort10]);
	$persisinterview_arr[persisinterview_antwort11] = stripslashes($persisinterview_arr[persisinterview_antwort11]);
	$persisinterview_arr[persisinterview_antwort12] = stripslashes($persisinterview_arr[persisinterview_antwort12]);
	$persisinterview_arr[persisinterview_antwort13] = stripslashes($persisinterview_arr[persisinterview_antwort13]);

    $nowtag = date("d", $persisinterview_arr[persisinterview_datum]);
    $nowmonat = date("m", $persisinterview_arr[persisinterview_datum]);
    $nowjahr = date("Y", $persisinterview_arr[persisinterview_datum]);

    echo'
                    <form action="'.$PHP_SELF.'" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="persinteredit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <input type="hidden" value="'.$persisinterviewid.'" name="editpersisinterviewid">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
                            <tr>
                                <td class="config" valign="top">
                                    Name der persistenten Welt.
                                </td>
                                <td valign="top">
                                    <input class="text" name="name" size="51" maxlength="150" value="'.$persisinterview_arr[persisinterview_name].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Link zur persistenten Welt.
                                </td>
                                <td valign="top">
                                    <input class="text" name="url" size="51" maxlength="255" value="'.$persisinterview_arr[persisinterview_url].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Auf welchem Spiel baut euer Projekt auf?
                                </td>
                                <td valign="top">
                                    <table width="100%">
										<tr>
	';
	switch ($persisinterview_arr[persisinterview_spiel]){
		case 1:
			echo'
											<td class="config" width="50%"><input type="radio" name="spiel" value="1" checked="checked"> NwN</td>
											<td class="config" width="50%"><input type="radio" name="spiel" value="2"> NwN2</td>
			';
		break;
		case 2:
			echo'
											<td class="config" width="50%"><input type="radio" name="spiel" value="1"> NwN</td>
											<td class="config" width="50%"><input type="radio" name="spiel" value="2" checked="checked"> NwN 2</td>
			';
		break;
	}
	echo'
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                            <tr>
                                <td class="config" valign="top">
                                    Wie lange gibt es schon euren Server oder wann geht er online und zu welchen Zeiten ist er
									erreichbar?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort01" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort01].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Braucht man eine Anmeldung oder Bewerbung, um auf eurem Server zu spielen und warum?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort02" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort02].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Welche Zielgruppe wollt ihr ansprechen und welche Vorraussetzungen muss der Spieler
									mitbringen? (z.B.: Altergruppe, Anf�nger, Profis, Rollenspieler, Powergamer,
									Gelegenheits- und/oder Dauerspieler)
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort03" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort03].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Welches Setting benutzt ihr und warum grade dieses? (z.B.: Forgotten Realms,
									Planescape, Eberron, Wheel of Time, Vampire, World of Warkraft, Das Schwarze Auge,
									Eigenes Setting)
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort04" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort04].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Beschreibt in einigen S�tzen das Konzept eures Servers.
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort05" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort05].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Welche besondere Features sind auf eurem Server zu finden. (z.B.: Handwerk,
									PvP-System)
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort06" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort06].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Was sind f�r euch die drei wichtigsten Aspekte eine Persistenten Welt?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort07" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort07].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Gibt es schon Zukunftspl�ne f�r euren Server und wie sehen sie aus?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort08" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort08].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Wie ist euer Server entstanden?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort09" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort09].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Wie gro� ist euer Staff und sucht ihr weitere bestimmte Mitarbeiter?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort10" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort10].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Was gef�llt euch so besonders an Neverwinter Nights 1 oder 2?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort11" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort11].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Wie seht ihr NWN zum Vergleich von MMORPGs wie z.B: WoW, Everquest ect. Welche Vor- und
									Nachteile gibt es?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort12" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort12].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Was w�rdet ihr machen, wenn ihr bei den Obsidianentwicklern einen Wunsch frei h�ttet?
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="antwort13" rows="10" cols="51">'.$persisinterview_arr[persisinterview_antwort13].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    persisinterviewe Welt Interview l�schen:
                                </td>
                                <td class="config">
                                    <input onClick="alert(this.value)" type="checkbox" name="delpersisinterview" value="Sicher?">
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
}

//////////////////////////////////
////// Interview ausw�hlen ///////
//////////////////////////////////

else
{
    echo'
                    <form action="'.$PHP_SELF.'" method="post">
                        <input type="hidden" value="persinteredit" name="go">
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
    $index = mysql_query('SELECT persisinterview_id, persisinterview_name
                          FROM fsplus_persisinterview
                          ORDER BY persisinterview_name', $db);
    while ($persisinterview_arr = mysql_fetch_assoc($index))
    {
        echo'
                            <tr>
                                <td class="configthin">
                                    '.$persisinterview_arr[persisinterview_name].'
                                </td>
                                <td class="config">
                                    <input type="radio" name="persisinterviewid" value="'.$persisinterview_arr['persisinterview_id'].'">
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