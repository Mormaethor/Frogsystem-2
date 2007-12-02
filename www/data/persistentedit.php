<?php
/*
    Frogsystem Persistent Worlds Script
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

//////////////////////////////////////////
//// Persistente Welten aktualisieren ////
//////////////////////////////////////////

if ($_POST['name'] && $_POST['url'] && $_POST['text'])
{
    settype($_POST['editpersitentid'], 'integer');
    if (isset($_POST['delpersistent']))
    {
        mysql_query("DELETE FROM fsplus_persistent WHERE persistent_id = $_POST[editpersistentid]", $db);
//        systext('Persistente Welt wurde gel�scht.');
	echo'
	<div align="center"><img src="images/design/headline_pwadd.gif" width="400" height="40"></div>
<p>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td>
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
          		<td width="4" height="24"><img src="../images/design/news_head_l.gif" width="4" height="24"></td>
          		<td width="100%" height="24" style="background-image:url(../images/design/news_head_m.gif); height:24px"></td>
          		<td width="4" height="24"><img src="../images/design/news_head_r.gif" width="4" height="24"></td>
        	</tr>
      	</table>
	</td>
</tr>
<tr>
    <td style="background-image:url(../images/design/bg.gif); height:80px" valign="top" align="left">
      	<table width="100%" cellpadding="0" cellspacing="10" border="0">
        	<tr>
		  		<td>
					Der Eintrag der persistenten Welt wurde gel�scht.
				<td>
			</tr>
		</table>
	</td>
 </tr>
  <tr>
    <td>
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
          		<td width="13" height="13" align="left"><img src="../images/design/block_unten_l.gif" width="13" height="13"></td>
          		<td width="100%" style="background-image:url(../images/design/block_unten_m.gif); height:13px"></td>
          		<td width="13" height="13" align="right"><img src="../images/design/block_unten_r.gif" width="13" height="13"></td>
        	</tr>
      	</table>
    </td>
</tr>
</table>
	';
    }
    else
    {
		$datum = mktime(0, 0, 0, $_POST['monat'], $_POST['tag'], $_POST['jahr']);

        $_POST['name'] = savesql($_POST['name']);
        $_POST['url'] = savesql($_POST['url']);
        $_POST['text'] = ereg_replace ('&lt;textarea&gt;', '<textarea>', $_POST['text']);
        $_POST['text'] = ereg_replace ('&lt;/textarea&gt;', '</textarea>', $_POST['text']);
        $_POST['text'] = savesql($_POST['text']);
        $_POST['spiel'] = savesql($_POST['spiel']);
    	$_POST['setting'] = savesql($_POST['setting']);
    	$_POST['genre'] = savesql($_POST['genre']);
    	$_POST['termine'] = savesql($_POST['termine']);
    	$_POST['dlsize'] = savesql($_POST['dlsize']);
    	$_POST['dlsvu'] = savesql($_POST['dlsvu']);
    	$_POST['dlhdu'] = savesql($_POST['dlhdu']);
    	$_POST['dlcep'] = savesql($_POST['dlcep']);
    	$_POST['anmeldung'] = savesql($_POST['anmeldung']);
    	$_POST['handycap'] = savesql($_POST['handycap']);
    	$_POST['dm'] = savesql($_POST['dm']);
    	$_POST['maxzahl'] = savesql($_POST['maxzahl']);
    	$_POST['maxlevel'] = savesql($_POST['maxlevel']);
    	$_POST['expcap'] = savesql($_POST['expcap']);
    	$_POST['fights'] = savesql($_POST['fights']);
    	$_POST['traps'] = savesql($_POST['traps']);
    	$_POST['items'] = savesql($_POST['items']);
    	$_POST['pvp'] = savesql($_POST['pvp']);
    	$_POST['datum'] = savesql($_POST['datum']);
    	$_POST['interview'] = savesql($_POST['interview']);
		settype($_POST['posterid'], 'integer');
    	$_POST['seitenlink'] = savesql($_POST['seitenlink']);
    	$_POST['editpersistentid'] = savesql($_POST['editpersistentid']);

        $update = "UPDATE fsplus_persistent
                   SET persistent_name = '".$_POST['name']."',
                       persistent_url  = '".$_POST['url']."',
                       persistent_text = '".$_POST['text']."',
                       persistent_spiel = '".$_POST['spiel']."',
					   persistent_setting = '".$_POST['setting']."',
					   persistent_genre = '".$_POST['genre']."',
					   persistent_termine = '".$_POST['termine']."',
					   persistent_dlsize = '".$_POST['dlsize']."',
					   persistent_dlsvu = '".$_POST['dlsvu']."',
					   persistent_dlhdu = '".$_POST['dlhdu']."',
					   persistent_dlcep = '".$_POST['dlcep']."',
					   persistent_anmeldung = '".$_POST['anmeldung']."',
					   persistent_handycap = '".$_POST['handycap']."',
					   persistent_dm = '".$_POST['dm']."',
					   persistent_maxzahl = '".$_POST['maxzahl']."',
					   persistent_maxlevel = '".$_POST['maxlevel']."',
					   persistent_expcap = '".$_POST['expcap']."',
					   persistent_fights = '".$_POST['fights']."',
					   persistent_traps = '".$_POST['traps']."',
					   persistent_items = '".$_POST['items']."',
					   persistent_pvp = '".$_POST['pvp']."'
                   WHERE persistent_id = '".$_POST['editpersistentid']."'";
        mysql_query($update, $db);
		echo mysql_error();
		echo'
	<div align="center"><img src="images/design/headline_pwadd.gif" width="400" height="40"></div>
<p>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
    <td>
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
          		<td width="4" height="24"><img src="../images/design/news_head_l.gif" width="4" height="24"></td>
          		<td width="100%" height="24" style="background-image:url(../images/design/news_head_m.gif); height:24px"></td>
          		<td width="4" height="24"><img src="../images/design/news_head_r.gif" width="4" height="24"></td>
        	</tr>
      	</table>
	</td>
</tr>
<tr>
    <td style="background-image:url(../images/design/bg.gif); height:80px" valign="top" align="left">
      	<table width="100%" cellpadding="0" cellspacing="10" border="0">
        	<tr>
		  		<td>
					Der Eintrag der persistenten Welt wurde ge�ndert.
				<td>
			</tr>
		</table>
	</td>
 </tr>
  <tr>
    <td>
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
          		<td width="13" height="13" align="left"><img src="../images/design/block_unten_l.gif" width="13" height="13"></td>
          		<td width="100%" style="background-image:url(../images/design/block_unten_m.gif); height:13px"></td>
          		<td width="13" height="13" align="right"><img src="../images/design/block_unten_r.gif" width="13" height="13"></td>
        	</tr>
      	</table>
    </td>
</tr>
</table>
	';
//        systext("Persistente Welt wurde aktualisiert.");
    }
}

/////////////////////////////////////////
////// Persistente Welt editieren ///////
/////////////////////////////////////////

else
{
    settype($_POST[persistentid], 'integer');
    $index = mysql_query("SELECT * FROM fsplus_persistent WHERE persistent_link = '$pw'", $db);
    $persistent_arr = mysql_fetch_assoc($index);

	$persistent_arr['persistent_text'] = fscode($persistent_arr['persistent_text'], 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
	$persistent_arr['persistent_handycap'] = fscode($persistent_arr['persistent_handycap'], 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

	if(($_SESSION['user_level'] == 'loggedin') && ($persistent_arr['persistent_posterid'] == $_SESSION['user_id']))
	{
	$persistent_arr['persistent_text'] = ereg_replace ("<textarea>", "&lt;textarea&gt;", $persistent_arr['persistent_text']);
    $persistent_arr['persistent_text'] = ereg_replace ("</textarea>", "&lt;/textarea&gt;", $persistent_arr['persistent_text']);

	$persistent_arr['persistent_text'] = stripslashes($persistent_arr['persistent_text']);

    $nowtag = date('d', $persistent_arr['persistent_datum']);
    $nowmonat = date('m', $persistent_arr['persistent_datum']);
    $nowjahr = date('Y', $persistent_arr['persistent_datum']);

    echo'
		<div align="center"><img src="images/design/headline_pwedit.gif" width="400" height="40"></div>
		<p>
		<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
    			<td>
      				<table width="100%" border="0" cellspacing="0" cellpadding="0">
        				<tr>
          					<td width="4" height="24"><img src="../images/design/news_head_l.gif" width="4" height="24"></td>
          					<td width="100%" height="24" style="background-image:url(../images/design/news_head_m.gif); height:24px"></td>
          					<td width="4" height="24"><img src="../images/design/news_head_r.gif" width="4" height="24"></td>
        				</tr>
      				</table>
				</td>
			</tr>
			<tr>
    			<td style="background-image:url(../images/design/bg.gif); height:80px" valign="top" align="left">
      				<table width="100%" cellpadding="0" cellspacing="10" border="0">
        				<tr>
		  					<td>
                    <form action="?go=persistentedit" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="persistentedit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <input type="hidden" value="'.$persistent_arr['persistent_id'].'" name="editpersistentid">
                        <table border="0" cellpadding="4" cellspacing="0" width="100%">
                            <tr>
                                <td class="config" valign="top" width="30%">
                                    Welten-Name:<br>
                                    <font class="font-10">Name der persistenten Welt. Kommt auch in den Hotlink</font>
                                </td>
                                <td class="config" valign="top" width="70%">
                                    <input class="text" name="name" size="50" value="'.$persistent_arr['persistent_name'].'" maxlength="150">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    URL:<br>
                                    <font class="font-10">Link zur persistenten Welt</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="url" size="50" value="'.$persistent_arr['persistent_url'].'" maxlength="255">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Beschreibung:<br>
                                    <font class="font-10">Kurze Beschreibung der Welt</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="text" rows="15" cols="38">'.$persistent_arr['persistent_text'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    F�r welches Spiel:<br>
                                    <font class="font-10">NWN oder NWN 2</font>
                                </td>
                                <td class="config" valign="top">
		';

	if ($persistent_arr['persistent_spiel'] == 1)
		echo'
									<table width="100%">
										<tr>
											<td>
												<input type="radio" name="spiel" value="1" checked="checked"> NWN
											</td>
											<td>
												<input type="radio" name="spiel" value="2"> NWN 2
											</td>
										</tr>
									</table>
			';
	elseif ($persistent_arr['persistent_spiel'] == 2)
		echo' 						<table width="100%">
										<tr>
											<td>
												<input type="radio" name="spiel" value="1"> NWN
											</td>
											<td>
												<input type="radio" name="spiel" value="2" checked="checked"> NWN 2
											</td>
										</tr>
									</table>
			';

	echo'
								</td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Setting:<br>
                                    <font class="font-10">In welches Setting ist die persistente Welt eingebettet:</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="setting" size="1">
		';
	$index = mysql_query('SELECT * FROM fsplus_persistent_setting ORDER BY setting_name', $db);
	while ($setting_arr = mysql_fetch_assoc($index))
	{
		$sele = ($setting_arr['setting_name'] == $persistent_arr['persistent_setting']) ? 'selected' : '';
	echo'
                                        <option '.$sele.'>'.$setting_arr['setting_name'].'</option>
        ';
	}
	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Genre:<br>
                                    <font class="font-10">In welchem Spiel-Genre ist die Welt einzuordnen.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="genre" size="1">
		';
	$index = mysql_query('SELECT * FROM fsplus_persistent_genre ORDER BY genre_name', $db);
	while ($genre_arr = mysql_fetch_assoc($index))
	{
		$sele = ($genre_arr['genre_name'] == $persistent_arr['persistent_genre']) ? 'selected' : '';
	echo'
                                        <option '.$sele.'>'.$genre_arr['genre_name'].'</option>
        ';
	}
	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    PvP:<br>
                                    <font class="font-10">Sind K�mpfe Player vs. Player m�glich?</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="pvp" size="1">
		';
	switch ($persistent_arr['persistent_pvp'])
	{
		case 'ja':
		echo'
										<option selected>ja</option>
										<option>nach Absprache</option>
										<option>nein</option>
										<option>speziell</option>
										<option>k.A.</option>
			';
		break;
		case 'nach Absprache':
		echo'
										<option>ja</option>
										<option selected>nach Absprache</option>
										<option>nein</option>
										<option>speziell</option>
										<option>k.A.</option>
			';
		break;
		case 'nein':
		echo'
										<option>ja</option>
										<option>nach Absprache</option>
										<option selected>nein</option>
										<option>speziell</option>
										<option>k.A.</option>
			';
		break;
		case 'speziell':
		echo'
										<option>ja</option>
										<option>nach Absprache</option>
										<option>nein</option>
										<option selected>speziell</option>
										<option>k.A.</option>
			';
		break;
		case 'k. A.':
		echo'
										<option>ja</option>
										<option>nach Absprache</option>
										<option>nein</option>
										<option>speziell</option>
										<option selected>k.A.</option>
			';
		break;
		default:
		echo'
										<option>ja</option>
										<option>nach Absprache</option>
										<option>nein</option>
										<option>speziell</option>
										<option>k.A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Online-Zeiten:<br>
                                    <font class="font-10">Wann bzw. wie oft ist der Server online.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="termine" size="1">
		';
	switch ($persistent_arr['persistent_termine'])
	{
		case "st�ndig":
		echo'
										<option selected>st�ndig</option>
										<option>regelm��ig</option>
										<option>unregelm��ig</option>
										<option>k. A.</option>
			';
		break;
		case "regelm��ig":
		echo'
										<option>st�ndig</option>
										<option selected>regelm��ig</option>
										<option>unregelm��ig</option>
										<option>k. A.</option>
			';
		break;
		case "unregelm��ig":
		echo'
										<option>st�ndig</option>
										<option>regelm��ig</option>
										<option selected>unregelm��ig</option>
										<option>k. A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>st�ndig</option>
										<option>regelm��ig</option>
										<option>unregelm��ig</option>
										<option selected>k. A.</option>
			';
		break;
		default:
		echo'
										<option>st�ndig</option>
										<option>regelm��ig</option>
										<option>unregelm��ig</option>
										<option>k. A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Downloads:<br>
                                    <font class="font-10">Gr��e der f�r den Server notwendigen Downloads. (HakPaks, Portraits, Musik, etc.)</font>
                                </td>
                                <td class="config" valign="top">
                                    <table width="100%">
										<tr>
		';
	switch($persistent_arr['persistent_dlsize'])
		{
		case "0 bis 25 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB" checked> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="101 bis 250 MB"> 101 bis 250 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		case "26 bis 50 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB" checked> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB"> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		case "51 bis 100 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB" checked> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB"> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		case "101 bis 250 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB" checked> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		case "251 bis 500 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB"> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB" checked> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		case "mehr als 500 MB":
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB"> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB" checked> mehr als 500 MB</td>
			';
		break;
		default:
		echo'
											<td width="50%"><input type="radio" name="dlsize" value="0 bis 25 MB"> 0 bis 25 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="26 bis 50 MB"> 26 bis 50 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="51 bis 100 MB"> 51 bis 100 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 100 MB"> mehr als 100 MB</td>
										</tr>
										<tr>
											<td width="50%"><input type="radio" name="dlsize" value="251 bis 500 MB"> 251 bis 500 MB</td>
											<td width="50%"><input type="radio" name="dlsize" value="mehr als 500 MB"> mehr als 500 MB</td>
			';
		break;
		}
		echo'
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Notwendige Erweiterungen:<br>
                                    <font class="font-10">Was wird an Programmen ben�tigt?</font>
                                </td>
                                <td class="config" valign="top">
                                    <table width="100%">
										<tr>
			';
		if ($persistent_arr['persistent_dlsvu'] == "Schatten von Undernzit")
		echo'
											<td width="50%"><input type="checkbox" name="dlsvu" value="Schatten von Undernzit" checked="checked"> SvU</td>
			';
		else
		echo'
											<td width="50%"><input type="checkbox" name="dlsvu" value="Schatten von Undernzit"> SvU</td>
			';
		if ($persistent_arr['persistent_dlhdu'] == "Horden des Unterreichs")
		echo'
											<td width="50%"><input type="checkbox" name="dlhdu" value="Horden des Unterreichs" checked> HdU</td>
			';
		else
		echo'
											<td width="50%"><input type="checkbox" name="dlhdu" value="Horden des Unterreichs"> HdU</td>
			';
		echo'
										</tr>
										<tr>
			';
		if ($persistent_arr['persistent_dlcep'] == "Community Expansion Pack")
		echo'
											<td width="50%"><input type="checkbox" name="dlcep" value="Community Expansion Pack" checked> CEP</td>
			';
		else
		echo'
											<td width="50%"><input type="checkbox" name="dlcep" value="Community Expansion Pack"> CEP</td>
			';
		if ($persistent_arr['persistent_dlmotb'] == "Mask of the Betrayer")
		echo'
											<td width="50%"><input type="checkbox" name="dlmotb" value="Mask of the Betrayer" checked> MotB</td>
			';
		else
		echo'
											<td width="50%"><input type="checkbox" name="dlmotb" value="Mask of the Betrayer"> MotB</td>
			';
		echo'
										</tr>
									</table>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Anmeldung ab:<br>
                                    <font class="font-10">Ab welchem Level ist eine Anmeldung erforderlich.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="anmeldung" size="1">
		';
	switch ($persistent_arr['persistent_anmeldung'])
	{
		case "von Anfang an":
		echo'
										<option selected>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "Level 1":
		echo'
										<option>von Anfang an</option>
										<option selected>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "Level 2":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option selected>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "Level 3":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option selected>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "Level 4":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option selected>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "Level 5":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option selected>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "&gt; Level 5":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option selected>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "speziell":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option selected>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
		case "nie":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option selected>nie</option>
										<option>k. A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option selected>k. A.</option>
			';
		break;
		default:
		echo'
										<option>von Anfang an</option>
										<option>Level 1</option>
										<option>Level 2</option>
										<option>Level 3</option>
										<option>Level 4</option>
										<option>Level 5</option>
										<option>&gt; Level 5</option>
										<option>speziell</option>
										<option>nie</option>
										<option>k. A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Einschr�nkungen:<br>
                                    <font class="font-10">Rassen, Klassen, Gesinnungen etc., die nicht m�glich sind.</font>
                                </td>
                                <td class="config" valign="top">
                                    <textarea class="text" name="handycap" rows="6" cols="38">'.$persistent_arr['persistent_handycap'].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Anzahl der Spielleiter:<br>
                                    <font class="font-10">Maximale Anzahl der die Spieler betreuenden Spielleiter.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="dm" size="1">
		';
	switch ($persistent_arr['persistent_dm'])
	{
		case "1":
		echo'
										<option selected>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "2":
		echo'
										<option>1</option>
										<option selected>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "3":
		echo'
										<option>1</option>
										<option>2</option>
										<option selected>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "4":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option selected>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "5":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option selected>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "6":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option selected>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "7":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option selected>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "8":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option selected>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "9":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option selected>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "10":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option selected>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "&gt; 10":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option selected>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option selected>k. A.</option>
			';
		break;
		default:
		echo'
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
										<option>6</option>
										<option>7</option>
										<option>8</option>
										<option>9</option>
										<option>10</option>
										<option>&gt; 10</option>
										<option>k. A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Maximale Spieleranzahl:<br>
                                    <font class="font-10">Anzahl der m�glichen maximalen Spieleranzahl auf dem Server.</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxzahl" value="'.$persistent_arr['persistent_maxzahl'].'" size="4" maxlength="4">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    H�chstes erreichbares Level:<br>
                                    <font class="font-10">Welches maximale Level kann ein Spieler erreichen?</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="maxlevel" value="'.$persistent_arr['persistent_maxlevel'].'" size="2" maxlength="50">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Erfahrungspunkte-Begrenzung:<br>
                                    <font class="font-10">Gibt es eine Begrenzung der zu bekommenden Erfahrungspunkte.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="expcap" size="1">
		';
	switch ($persistent_arr['persistent_expcap'])
	{
		case "ja":
		echo'
										<option selected>ja</option>
										<option>nein</option>
										<option>speziell</option>
										<option>k. A.</option>
			';
		break;
		case "nein":
		echo'
										<option>ja</option>
										<option selected>nein</option>
										<option>speziell</option>
										<option>k. A.</option>
			';
		break;
		case "speziell":
		echo'
										<option>ja</option>
										<option>nein</option>
										<option selected>speziell</option>
										<option>k. A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>ja</option>
										<option>nein</option>
										<option>speziell</option>
										<option selected>k. A.</option>
			';
		break;
		default:
		echo'
										<option>ja</option>
										<option>nein</option>
										<option>speziell</option>
										<option>k. A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    K�mpfe:<br>
                                    <font class="font-10">Schwierigkeitsgrad der K�mpfe.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="fights" size="1">
		';
	switch ($persistent_arr[persistent_fights])
	{
		case "keine":
		echo'
										<option selected>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "leicht":
		echo'
										<option>keine</option>
										<option selected>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "mittel":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option selected>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "schwer":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option selected>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "uneinheitlich":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option selected>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option selected>k.A.</option>
			';
		break;
		default:
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Fallen:<br>
                                    <font class="font-10">Schwierigkeitsgrad der Fallen.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="traps" size="1">
		';
	switch ($persistent_arr['persistent_traps'])
	{
		case "keine":
		echo'
										<option selected>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "leicht":
		echo'
										<option>keine</option>
										<option selected>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "mittel":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option selected>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "schwer":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option selected>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "uneinheitlich":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option selected>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option selected>k.A.</option>
			';
		break;
		default:
		echo'
										<option>keine</option>
										<option>leicht</option>
										<option>mittel</option>
										<option>schwer</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Items:<br>
                                    <font class="font-10">H�ufigkeit besonderer/hochwertiger Items.</font>
                                </td>
                                <td class="config" valign="top">
                                	<select name="items" size="1">
		';
	switch ($persistent_arr['persistent_items'])
	{
		case "keine":
		echo'
										<option selected>keine</option>
										<option>selten</option>
										<option>normal</option>
										<option>oft</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "selten":
		echo'
										<option>keine</option>
										<option selected>selten</option>
										<option>normal</option>
										<option>oft</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "normal":
		echo'
										<option>keine</option>
										<option>selten</option>
										<option selected>normal</option>
										<option>oft</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "oft":
		echo'
										<option>keine</option>
										<option>selten</option>
										<option>normal</option>
										<option selected>oft</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "uneinheitlich":
		echo'
										<option>keine</option>
										<option>selten</option>
										<option>normal</option>
										<option>oft</option>
										<option selected>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
		case "k. A.":
		echo'
										<option>keine</option>
										<option>selten</option>
										<option>normal</option>
										<option>oft</option>
										<option>uneinheitlich</option>
										<option selected>k.A.</option>
			';
		break;
		default:
		echo'
										<option>keine</option>
										<option>selten</option>
										<option>normal</option>
										<option>oft</option>
										<option>uneinheitlich</option>
										<option>k.A.</option>
			';
		break;
	}

	echo'
									</select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Persistente Welt l�schen:
                                </td>
                                <td class="config">
                                    <input onClick="alert(this.value)" type="checkbox" name="delpersistent" value="Sicher?">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2">
                                    <input class="button" type="submit" value="Absenden">
                                </td>
                            </tr>
                        </table>
                    </form>
					</td>
				</tr>
			</table>
		</td>
 	</tr>
  	<tr>
    	<td>
      		<table width="100%" border="0" cellspacing="0" cellpadding="0">
        		<tr>
          			<td width="13" height="13" align="left"><img src="../images/design/block_unten_l.gif" width="13" height="13"></td>
          			<td width="100%" style="background-image:url(../images/design/block_unten_m.gif); height:13px"></td>
          			<td width="13" height="13" align="right"><img src="../images/design/block_unten_r.gif" width="13" height="13"></td>
        		</tr>
      		</table>
    	</td>
  	</tr>
</table>
        ';
	}
	elseif ($_SESSION['user_level'] != "loggedin")
	{
	echo'
		<div align="center"><img src="images/design/headline_pwedit.gif" width="400" height="40"></div>
		<p>
		<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
    			<td>
      				<table width="100%" border="0" cellspacing="0" cellpadding="0">
        				<tr>
          					<td width="4" height="24"><img src="../images/design/news_head_l.gif" width="4" height="24"></td>
          					<td width="100%" height="24" style="background-image:url(../images/design/news_head_m.gif); height:24px"></td>
          					<td width="4" height="24"><img src="../images/design/news_head_r.gif" width="4" height="24"></td>
        				</tr>
      				</table>
				</td>
			</tr>
			<tr>
    			<td style="background-image:url(../images/design/bg.gif); height:80px" valign="top" align="left">
      				<table width="100%" cellpadding="0" cellspacing="10" border="0">
        				<tr>
		  					<td>
							Du bist nicht eingeloggt.
							<td>
						</tr>
					</table>
				</td>
 			</tr>
  			<tr>
    			<td>
      				<table width="100%" border="0" cellspacing="0" cellpadding="0">
        				<tr>
          					<td width="13" height="13" align="left"><img src="../images/design/block_unten_l.gif" width="13" height="13"></td>
          					<td width="100%" style="background-image:url(../images/design/block_unten_m.gif); height:13px"></td>
          					<td width="13" height="13" align="right"><img src="../images/design/block_unten_r.gif" width="13" height="13"></td>
        				</tr>
      				</table>
    			</td>
  			</tr>
		</table>
        ';
	}
	elseif (($_SESSION['user_level'] == "loggedin") && ($persistent_arr['persistent_posterid'] != $_SESSION['user_id']))
	{
	echo'
		<div align="center"><img src="images/design/headline_pwedit.gif" width="400" height="40"></div>
		<p>
		<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
    			<td>
      				<table width="100%" border="0" cellspacing="0" cellpadding="0">
        				<tr>
          					<td width="4" height="24"><img src="../images/design/news_head_l.gif" width="4" height="24"></td>
          					<td width="100%" height="24" style="background-image:url(../images/design/news_head_m.gif); height:24px"></td>
          					<td width="4" height="24"><img src="../images/design/news_head_r.gif" width="4" height="24"></td>
        				</tr>
      				</table>
				</td>
			</tr>
			<tr>
    			<td style="background-image:url(../images/design/bg.gif); height:80px" valign="top" align="left">
      				<table width="100%" cellpadding="0" cellspacing="10" border="0">
        				<tr>
		  					<td>
							Du hast nicht das Recht, diesen Eintrag zu editieren. Das ist nur dem Ersteller des Eintrages und der Administration von Planet Neverwinter gestattet.
							<td>
						</tr>
					</table>
				</td>
 			</tr>
  			<tr>
    			<td>
      				<table width="100%" border="0" cellspacing="0" cellpadding="0">
        				<tr>
          					<td width="13" height="13" align="left"><img src="../images/design/block_unten_l.gif" width="13" height="13"></td>
          					<td width="100%" style="background-image:url(../images/design/block_unten_m.gif); height:13px"></td>
          					<td width="13" height="13" align="right"><img src="../images/design/block_unten_r.gif" width="13" height="13"></td>
        				</tr>
      				</table>
    			</td>
  			</tr>
		</table>
        ';
	}
}

?>