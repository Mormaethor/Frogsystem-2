<!--section-start::main_body-->
<div align="center"><h2>Persistente Welten</h2></div>
<p>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td valign="top" align="left" colspan="7" width="14%">
      <b><a href="?go=persistentlist&amp;sort=name">Name</a></b>
    </td>
  <tr>
    <td width="14%"><b><a href="?go=persistentlist&amp;sort=setting">Setting</a></b></td>
    <td width="14%"><b><a href="?go=persistentlist&amp;sort=genre">Genre</a></b></td>
    <td width="15%"><b><a href="?go=persistentlist&amp;sort=spiel">Spiel</a></b></td>
    <td width="14%"><b>Addons</b></td>
    <td width="14%"><b><a href="?go=persistentlist&amp;sort=anmeldung">Anmeldung ab</a></b></td>
    <td width="15%"><b><a href="?go=persistentlist&amp;sort=spieler">max. Spieler</a></b></td>
    <td width="14%"><b><a href="?go=persistentlist&amp;sort=level">max. Level</a></b></td>
  </tr>
  <tr><td colspan="7"><br></td></tr>
  {..text..}
</table>
</p>
<!--section-end::main_body-->

<!--section-start::list_entry-->
  <tr>
    <td colspan="6" width="*">
      <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td valign="top" width="16">&rArr;</td>
          <td width="*" align="left">
	        <a href="?go=persistentdetail&amp;pw={..link..}">{..name..}</a>
	      </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="small" width="15%" valign="top" align="left">{..setting..}</td>
    <td class="small" width="15%" valign="top" align="left">{..genre..}</td>
    <td class="small" width="5%" valign="top" align="left">{..spiel..}</td>
    <td class="small" width="20%" valign="top" align="left">{..dlsvu..} {..dlhdu..} {..dlcep..} {..dlmotb..} {..dlsoz..}</td>
    <td class="small" width="15%" valign="top" align="left">{..anmeldung..}</td>
    <td class="small" width="15%" valign="top" align="left">{..maxplayer..}</td>
    <td class="small" width="15%" valign="top" align="left">{..maxlevel..}</td>
  </tr>
  <tr>
    <td colspan="7"><br></td>
  </tr>
<!--section-end::list_entry-->


<!--section-start::detail_body-->
<div align="center"><h2>Persistente Welt - Detailseite</h2></div>
<p>
  <table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
      <td align="left" valign="top" width="20%">
        Name:
      </td>
      <td align="left" valign="top" width="*">
        <a href="{..url..}" target="_blank">{..name..}</a>
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Beschreibung:
      </td>
      <td align="left" valign="top">
        {..text..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Spiel:
      </td>
      <td align="left" valign="top">
        {..spiel..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Setting:
      </td>
      <td align="left" valign="top">
        {..setting..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Genre:
      </td>
      <td align="left" valign="top">
        {..genre..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        PvP:
      </td>
      <td align="left" valign="top">
        {..pvp..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Online-Termine:
      </td>
      <td align="left" valign="top">
        {..termine..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Notwendige Downloads:
      </td>
      <td align="left" valign="top">
        {..dlsize..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Notwendige Erweiterungen:
      </td>
      <td align="left" valign="top">
        {..dlsvu..} {..dlhdu..} {..dlcep..} {..dlmotb..} {..dlsoz..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Anmeldung ab:
      </td>
      <td align="left" valign="top">
        {..anmeldung..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Beschr&auml;nkungen:
      </td>
      <td align="left" valign="top">
        {..handycap..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Anzahl der Spielleiter:
      </td>
      <td align="left" valign="top">
        {..dungeonmaster..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Maximale Spieleranzahl:
      </td>
      <td align="left" valign="top">
        {..maxplayer..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Maximal erreichbares Level:
      </td>
      <td align="left" valign="top">
        {..maxlevel..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Beschr&auml;nkung der Erfahrungspunkte:
      </td>
      <td align="left" valign="top">
        {..expcap..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        K&auml;mpfe:
      </td>
      <td align="left" valign="top">
        {..fights..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Fallen:
      </td>
      <td align="left" valign="top">
        {..traps..}
      </td>
    </tr>
    <tr>
      <td align="left" valign="top">
        Besondere oder seltene Items:
      </td>
      <td align="left" valign="top">
        {..items..}
      </td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="top">
        {..interview..}
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <a href="?go=persistentedit&amp;pw={..link..}">Eintrag editieren</a>
      </td>
    </tr>
  </table>
  <br><br>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
	  <td align="left" class="font-10"><a href="{..kommentar_url..}">Kommentare ({..kommentar_anzahl..})</a></td>
      <td align="right" class="font-10">geschrieben von <a href="{..autor_profilurl..}">{..autor..}</a></td>
    </tr>
  </table>
</p>
<!--section-end::detail_body-->


<!--section-start::interview_list_entry-->
  <tr>
    <td><a href="?go=persistentinterview&pw={..link..}">Interview mit {..username..}</a> &uuml;ber die Persistente Welt {..name..}, ein Projekt zu {..spiel..}.</td>
  </tr>
<!--section-end::interview_list_entry-->


<!--section-start::interview_list_no_entries-->
  <tr>
    <td align="center"><b>Keine Interviews vorhanden!</b></td>
  </tr>
<!--section-end::interview_list_no_entries-->


<!--section-start::interview_list_body-->
<div align="center"><h2>Interviewliste</h2></div>
<p>
<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
  {..text..}
</table>
<!--section-end::interview_list_body-->


<!--section-start::interview_detail_body-->
<div align="center"><h2>Interview</h2></div>
<p>
  <table width="100%" cellpadding="0" cellspacing="10" border="0">
    <tr>
	  <td colspan="2"><div align="center"></div>
	    {..autor..} stellt das Projekt der Persistenten Welt {..name..} vor.<strong><br>
	        </strong><br>
	  </td>
	</tr>
    <tr>
      <td width="60" align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Wie hei&szlig;t euer Server und wo findet man ihn?</strong></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">Unser Server hei&szlig;t {..name..} und er ist unter folgender URL zu finden: <a href="{..url..}" target="_blank">{..url..}</a>.<br><br></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Wie lange gibt es euren Server schon oder wann geht er online und zu welchen Zeiten ist er erreichbar?</strong></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort01..}<br><br></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><b>Braucht man eine Anmeldung oder Bewerbung, um auf eurem Server zu spielen und warum?</b></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort02..}<br><br></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Welche Zielgruppe wollt ihr ansprechen und welche Vorraussetzungen muss der Spieler mitbringen? (z.B.: Altersgruppe, Anf&auml;nger, Profis, Rollenspieler, Powergamer, Gelegenheits- und/oder Dauerspieler)</strong></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort03..}<br><br></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Welches Setting benutzt ihr und warum grade dieses? (z.B.: Forgotten  Realms, Planescape, Eberron, Wheel of Time, Vampire, World of Warcraft,  Das Schwarze Auge, Eigenes Setting)</strong></td>
    </tr>
    <tr>
      <td width="60" align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort04..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><b>Beschreibt in einigen S&auml;tzen das Konzept eures Servers.</b></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort05..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong> Welche besondere Features sind auf eurem Server zu finden? (z.B.: Handwerk, PvP-System)</strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort06..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><b>Was sind f&uuml;r euch die drei wichtigsten Aspekte einer Persistenten Welt?</b></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort07..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><b>Gibt es schon Zukunftspl&auml;ne f&uuml;r euren Server und wie sehen sie aus?</b></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort08..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><b> Wie ist euer Server entstanden?</b></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort09..}<b><br><br></b></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Wie gro&szlig; ist euer Staff und sucht ihr weitere bestimmte Mitarbeiter?</strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort10..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Was gef&auml;llt euch so besonders an Neverwinter Nights?</strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort11..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong>Wie seht ihr NWN zum Vergleich von MMORPGs wie z.B. WoW, Everquest etc.? Welche Vor- und Nachteile gibt es?</strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort12..}<br><br></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>PNW:</b></td>
      <td align="left"><strong> Was w&uuml;rdet ihr machen, wenn ihr bei den Obsidian-Entwicklern einen Wunsch frei h&auml;ttet?</strong></td>
    </tr>
    <tr>
      <td align="left" valign="top"><b>{..autor..}:</b></td>
      <td align="left">{..antwort13..}<br><br></td>
    </tr>
    <tr>
      <td width="60" valign="top"><b>PNW:</b></td>
      <td><strong>Vielen Dank f&uuml;r das Interview. Wir w&uuml;nschen eurer Persistenten Welt viel Erfolg.</strong></td>
    </tr>
  </table>
  <br><br>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
	  <td align="left" class="font-10"></td>
      <td align="right" class="font-10">geschrieben von <a href="{..autor_profilurl..}">{..autor..}</a></td>
    </tr>
  </table>
</p>
<!--section-end::interview_detail_body-->


<!--section-start::interview_add_form-->
<style type="text/css">
<!--
.Stil1 {color: #FF0000}
-->
</style>
<div align="center"><h2>Interview hinzuf&uuml;gen</h2></div>
<p>
  <form action="?go=persistentinterviewadd" enctype="multipart/form-data" method="post">
    <input type="hidden" value="persistentinterviewadd" name="go">
    <input type="hidden" value="{..session_id..}" name="PHPSESSID">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
      <tr>
        <td valign="top">
          Server-Name:<span class="Stil1">*</span><br>
          <font class="small">Name der persistenten Welt.</font>
        </td>
        <td valign="top">
          <input class="text" name="name" size="51" maxlength="150">
        </td>
      </tr>
      <tr>
        <td valign="top">
          URL:<span class="Stil1">*</span><br>
          <font class="small">Link zur persistenten Welt.</font>
        </td>
        <td valign="top">
          <input class="text" name="url" value="http://" size="51" maxlength="255">
        </td>
      </tr>
      <tr>
        <td valign="top">
          Auf welchem Spiel baut euer Projekt auf?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <table width="100%">
		    <tr>
			  <td width="50%"><input type="radio" name="spiel" value="1">Neverwinter Nights</td>
			  <td width="50%"><input type="radio" name="spiel" value="2">Neverwinter Nights 2</td>
			</tr>
		  </table>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Wie lange gibt es schon euren Server oder wann geht er online und zu welchen Zeiten ist er
		  erreichbar?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort01" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Braucht man eine Anmeldung oder Bewerbung, um auf eurem Server zu spielen und warum?
		  <span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort02" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Welche Zielgruppe wollt ihr ansprechen und welche Vorraussetzungen muss der Spieler
		  mitbringen? (z.B.: Altergruppe, Anf&auml;nger, Profis, Rollenspieler, Powergamer,
		  Gelegenheits- und/oder Dauerspieler)<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort03" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Welches Setting benutzt ihr und warum grade dieses? (z.B.: Forgotten Realms,
		  Planescape, Eberron, Wheel of Time, Vampire, World of Warcraft, Das Schwarze Auge,
		  Eigenes Setting)<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort04" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Beschreibt in einigen S&auml;tzen das Konzept eures Servers.<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort05" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Welche besondere Features sind auf eurem Server zu finden? (z.B.: Handwerk,
		  PvP-System)<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort06" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Was sind f&uuml;r euch die drei wichtigsten Aspekte eine Persistenten Welt?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort07" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Gibt es schon Zukunftspl&auml;ne f&uuml;r euren Server und wie sehen sie aus?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort08" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Wie ist euer Server entstanden?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort09" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Wie gro&szlig; ist euer Staff und sucht ihr weitere bestimmte Mitarbeiter?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort10" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Was gef&auml;llt euch so besonders an Neverwinter Nights 1 oder 2?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort11" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Wie seht ihr NWN zum Vergleich von MMORPGs wie z.B. WoW, Everquest etc. Welche Vor- und
		  Nachteile gibt es?<span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort12" rows="15" cols="40"></textarea>
        </td>
      </tr>
      <tr>
        <td valign="top">
          Was w&uuml;rdet ihr machen, wenn ihr bei den Obsidianentwicklern einen Wunsch frei h&auml;ttet?
		  <span class="Stil1">*</span>
        </td>
        <td valign="top">
          <textarea class="text" name="antwort13" rows="15" cols="40"></textarea>
        </td>
      </tr>
	  <tr>
	    <td valign="top" colspan="2">
		  Denke bitte daran, dass das Interview nach dem Abschicken nicht mehr bearbeitet werden kann!<br>
		</td>
	  </tr>
      <tr>
        <td align="center" colspan="2">
          <input class="button" type="submit" value="Hinzuf&uuml;gen">
        </td>
      </tr>
    </table>
  </form>
</p>
<!--section-end::interview_add_form-->


<!--section-start::form_add_body-->
<div align="center"><h2>Persistente Welt hinzuf&uuml;gen</h2></div>
<p>

<style type="text/css">
<!--
.Stil1 {color: #FF0000}
-->
</style>

<form action="?go=persistentadd" enctype="multipart/form-data" method="post">
  <input type="hidden" value="persistentadd" name="go">
  <input type="hidden" value="{..session_id..}" name="PHPSESSID">
  <input type="hidden" value="{..user_id..}" name="posterid">
  <table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
      <td valign="top">
        Server-Name:<span class="Stil1">*</span><br>
        <font class="small">Name der persistenten Welt.</font>
      </td>
      <td valign="top">
        <input class="text" name="name" size="51" maxlength="150">
      </td>
    </tr>
    <tr>
      <td valign="top">
        URL:<span class="Stil1">*</span><br>
        <font class="small">Link zur persistenten Welt.</font>
      </td>
      <td valign="top">
        <input class="text" name="url" value="http://" size="51" maxlength="255">
      </td>
    </tr>
    <tr>
      <td valign="top">
        Weltenbeschreibung:<span class="Stil1">*</span><br>
        <font class="small">Kurze Weltenbeschreibung. Was ist das Besondere
		an dieser Welt, was unterscheidet sie von anderen? Bei eigenem Setting
		bitte hier auch dessen Grundlagen kurz auff&uuml;hren. Irgendwelche Handwerker-,
		Gilden-, Sterbesysteme etc.?<br>
		Bitte keine Romane.<br>
		Kein HTML erlaubt! Bitte <a href="?go=fscode" target="_blank">FS-Code</a> benutzen.</font>
      </td>
      <td valign="top">
        <textarea class="text" name="text" rows="15" cols="40"></textarea>
      </td>
    </tr>
    <tr>
      <td valign="top">
        F&uuml;r welches Spiel:<span class="Stil1">*</span><br>
        <font class="small">NwN oder NwN2.</font>
      </td>
      <td valign="top">
        <table width="100%">
		  <tr>
		    <td width="50%"><input type="radio" name="spiel" value="1">NWN</td>
			<td width="50%"><input type="radio" name="spiel" value="2">NWN 2</td>
		  </tr>
		</table>
      </td>
    </tr>
    <tr>
      <td valign="top">
        Setting:<span class="Stil1">*</span><br>
        <font class="small">In welches Setting ist die persistente Welt eingebettet?</font>
      </td>
      <td valign="top">
        <select name="setting" size="1">
		  {..settings..}
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        Genre:<span class="Stil1">*</span><br>
        <font class="small">In welches Spiel-Genre ist die Welt einzuordnen?</font>
      </td>
      <td valign="top">
        <select name="genre" size="1">
          {..genres..}
        </select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        PvP:<br>
        <font class="small">Sind K&auml;mpfe Player vs. Player m&ouml;glich?</font>
      </td>
      <td valign="top">
        <select name="pvp" size="1">
		  <option value="1">ja</option>
		  <option value="2">nach Absprache</option>
		  <option value="3">nein</option>
		  <option value="4">speziell</option>
		  <option value="-1" selected>k.A.</option>
		</select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        Online-Zeiten:<br>
        <font class="small">Wie oft ist der Server online?</font>
      </td>
      <td valign="top">
        <select name="termine" size="1">
		  <option value="1">st&auml;ndig</option>
		  <option value="2">regelm&auml;&szlig;ig</option>
		  <option value="3">unregelm&auml;&szlig;ig</option>
		  <option value="-1" selected>k. A.</option>
		</select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        Downloads:<br>
        <font class="small">Gr&ouml;&szlig;e der f&uuml;r den Server notwendigen Downloads. (HakPaks, Portraits, Musik, etc.)</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Notwendige Erweiterungen:<br>
        <font class="small">Was werden f&uuml;r Erweiterungen ben&ouml;tigt?</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Anmeldung ab:<br>
        <font class="small">Ab welchem Level ist eine Charakter-Anmeldung erforderlich?</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Einschr&auml;nkungen:<br>
        <font class="small">Rassen, Klassen, Gesinnungen etc., die nicht m&ouml;glich sind.</font>
      </td>
      <td valign="top">
        <textarea name="handycap" rows="3" cols="40"></textarea>
      </td>
    </tr>
    <tr>
      <td valign="top">
        Anzahl der Spielleiter:<br>
        <font class="small">Maximale Anzahl der die Spieler betreuenden Spielleiter.</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Maximale Spieleranzahl:<br>
        <font class="small">Anzahl der maximalen gleichzeitig auf dem Server Spielenden.</font>
      </td>
      <td valign="top">
        <input class="text" name="maxzahl" size="4" maxlength="4">
      </td>
    </tr>
    <tr>
      <td valign="top">
        H&ouml;chstes erreichbares Level:<br>
        <font class="small">Welches maximale Level kann ein Spieler erreichen?</font>
      </td>
      <td valign="top">
        <input class="text" name="maxlevel" size="2" maxlength="50">
      </td>
    </tr>
    <tr>
      <td valign="top">
        Erfahrungspunkte- Begrenzung:<br>
        <font class="small">Gibt es eine Begrenzung der pro Woche (Tag, Monat...) zu bekommenden Erfahrungspunkte?</font>
      </td>
      <td valign="top">
        <select name="expcap" size="1">
		  <option value="1">ja</option>
		  <option value="0">nein</option>
		  <option value="2">speziell</option>
		  <option value="-1" selected>k. A.</option>
		</select>
      </td>
    </tr>
    <tr>
      <td valign="top">
        K&auml;mpfe:<br>
        <font class="small">Schwierigkeitsgrad der K&auml;mpfe.</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Fallen:<br>
        <font class="small">Schwierigkeitsgrad der Fallen.</font>
      </td>
      <td valign="top">
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
      <td valign="top">
        Items:<br>
        <font class="small">H&auml;ufigkeit besonderer, hochwertiger oder magischer Items.</font>
      </td>
      <td valign="top">
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
	  <td valign="top" colspan="2">
	    <span class="Stil1">*</span>Pflichtfelder
	  </td>
	</tr>
    <tr>
      <td align="center" colspan="2">
        <input class="button" type="submit" value="Hinzuf&uuml;gen">
      </td>
    </tr>
  </table>
</form>
</p>
<!--section-end::form_add_body-->


<!--section-start::form_edit_body-->
<div align="center"><h2>Persistente Welt &auml;ndern</h2></div>
<p>
  <form action="?go=persistentedit" enctype="multipart/form-data" method="post">
    <input type="hidden" value="persistentedit" name="go">
    <input type="hidden" value="{..session_id..}" name="PHPSESSID">
    <input type="hidden" value="{..persistent_id..}" name="editpersistentid">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
      <tr>
        <td class="config" valign="top" width="30%">
          Welten-Name:<br>
          <font class="small">Name der persistenten Welt. Kommt auch in den Hotlink</font>
        </td>
        <td class="config" valign="top" width="70%">
          <input class="text" name="name" size="50" value="{..name..}" maxlength="150">
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          URL:<br>
          <font class="small">Link zur persistenten Welt</font>
        </td>
        <td class="config" valign="top">
          <input class="text" name="url" size="50" value="{..url..}" maxlength="255">
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Beschreibung:<br>
          <font class="small">Kurze Beschreibung der Welt</font>
        </td>
        <td class="config" valign="top">
          <textarea class="text" name="text" rows="15" cols="38">{..text..}</textarea>
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
			    <input type="radio" name="spiel" value="1" {..nwn1_checked..}> NWN
			  </td>
			  <td>
			    <input type="radio" name="spiel" value="2" {..nwn2_checked..}> NWN 2
			  </td>
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
            {..settings..}
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
            {..genres..}
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
		    <option value="1" {..pvp_yes_selected..}>ja</option>
			<option value="2" {..pvp_arrange_selected..}>nach Absprache</option>
			<option value="3" {..pvp_no_selected..}>nein</option>
			<option value="4" {..pvp_special_selected..}>speziell</option>
			<option value="-1" {..pvp_N/A_selected..}>k.A.</option>
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
            <option value="1" {..uptime_always_selected..}>st&auml;ndig</option>
            <option value="2" {..uptime_regular_selected..}>regelm&auml;&szlig;ig</option>
            <option value="3" {..uptime_irregular_selected..}>unregelm&auml;&szlig;ig</option>
            <option value="-1" {..uptime_N/A_selected..}>k. A.</option>
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
			  <td width="50%"><input type="radio" name="dlsize" value="25" {..dlsize_0_25_checked..}> 0 bis 25 MB</td>
			  <td width="50%"><input type="radio" name="dlsize" value="50" {..dlsize_26_50_checked..}> 26 bis 50 MB</td>
			</tr>
			<tr>
			  <td width="50%"><input type="radio" name="dlsize" value="100" {..dlsize_51_100_checked..}> 51 bis 100 MB</td>
			  <td width="50%"><input type="radio" name="dlsize" value="250" {..dlsize_101_250_checked..}> 101 bis 250 MB</td>
			</tr>
			<tr>
			  <td width="50%"><input type="radio" name="dlsize" value="500" {..dlsize_251_500_checked..}> 251 bis 500 MB</td>
			  <td width="50%"><input type="radio" name="dlsize" value="501" {..dlsize_501_or_more_checked..}> mehr als 500 MB</td>
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
			  <td width="50%"><input type="checkbox" name="dlsvu" value="1" {..exp_svu_checked..}> SvU</td>
			  <td width="50%"><input type="checkbox" name="dlmotb" value="1" {..exp_motb_checked..}> MotB</td>
			</tr>
			<tr>
			  <td width="50%"><input type="checkbox" name="dlhdu" value="1" {..exp_hdu_checked..}> HdU</td>
			  <td width="50%"><input type="checkbox" name="dlsoz" value="1" {..exp_soz_checked..}> SoZ</td>
			</tr>
			<tr>
			  <td width="50%"><input type="checkbox" name="dlcep" value="1" {..exp_cep_checked..}> CEP</td>
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
		    <option value="0" {..reg_start_selected..}>von Anfang an</option>
			<option value="1" {..reg_lvl1_selected..}>Level 1</option>
			<option value="2" {..reg_lvl2_selected..}>Level 2</option>
			<option value="3" {..reg_lvl3_selected..}>Level 3</option>
			<option value="4" {..reg_lvl4_selected..}>Level 4</option>
			<option value="5" {..reg_lvl5_selected..}>Level 5</option>
			<option value="6" {..reg_gt_lvl5_selected..}>&gt; Level 5</option>
			<option value="100" {..reg_special_selected..}>speziell</option>
			<option value="127" {..reg_never_selected..}>nie</option>
			<option value="-1" {..reg_N/A_selected..}>k. A.</option>
		  </select>
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Einschr&auml;nkungen:<br>
          <font class="small">Rassen, Klassen, Gesinnungen etc., die nicht m&ouml;glich sind.</font>
        </td>
        <td class="config" valign="top">
          <textarea class="text" name="handycap" rows="6" cols="38">{..handycap..}</textarea>
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Anzahl der Spielleiter:<br>
          <font class="small">Maximale Anzahl der die Spieler betreuenden Spielleiter.</font>
        </td>
        <td class="config" valign="top">
          <select name="dm" size="1">
		    <option value="1" {..dm_1_selected..}>1</option>
			<option value="2" {..dm_2_selected..}>2</option>
			<option value="3" {..dm_3_selected..}>3</option>
			<option value="4" {..dm_4_selected..}>4</option>
			<option value="5" {..dm_5_selected..}>5</option>
			<option value="6" {..dm_6_selected..}>6</option>
			<option value="7" {..dm_7_selected..}>7</option>
			<option value="8" {..dm_8_selected..}>8</option>
			<option value="9" {..dm_9_selected..}>9</option>
			<option value="10" {..dm_10_selected..}>10</option>
			<option value="11" {..dm_gt_10_selected..}>&gt; 10</option>
			<option value="-1" {..dm_N/A_selected..}>k. A.</option>
          </select>
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Maximale Spieleranzahl:<br>
          <font class="small">Anzahl der m&ouml;glichen maximalen Spieleranzahl auf dem Server.</font>
        </td>
        <td class="config" valign="top">
          <input class="text" name="maxzahl" value="{..maxzahl..}" size="4" maxlength="4">
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          H&ouml;chstes erreichbares Level:<br>
          <font class="small">Welches maximale Level kann ein Spieler erreichen?</font>
        </td>
        <td class="config" valign="top">
          <input class="text" name="maxlevel" value="{..maxlevel..}" size="2" maxlength="50">
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Erfahrungspunkte-Begrenzung:<br>
          <font class="small">Gibt es eine Begrenzung der zu bekommenden Erfahrungspunkte?</font>
        </td>
        <td class="config" valign="top">
          <select name="expcap" size="1">
		    <option value="1" {..expcap_yes_selected..}>ja</option>
			<option value="0" {..expcap_no_selected..}>nein</option>
			<option value="2" {..expcap_special_selected..}>speziell</option>
			<option value="-1" {..expcap_N/A_selected..}>k. A.</option>
		  </select>
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          K&auml;mpfe:<br>
          <font class="small">Schwierigkeitsgrad der K&auml;mpfe.</font>
        </td>
        <td class="config" valign="top">
          <select name="fights" size="1">
		    <option value="0" {..fights_none_selected..}>keine</option>
			<option value="1" {..fights_easy_selected..}>leicht</option>
			<option value="2" {..fights_medium_selected..}>mittel</option>
			<option value="3" {..fights_difficult_selected..}>schwer</option>
			<option value="4" {..fights_different_selected..}>uneinheitlich</option>
			<option value="-1" {..fights_N/A_selected..}>k.A.</option>
		  </select>
        </td>
      </tr>
      <tr>
        <td class="config" valign="top">
          Fallen:<br>
          <font class="small">Schwierigkeitsgrad der Fallen.</font>
        </td>
        <td class="config" valign="top">
          <select name="traps" size="1">
		    <option value="0" {..traps_none_selected..}>keine</option>
			<option value="1" {..traps_easy_selected..}>leicht</option>
			<option value="2" {..traps_medium_selected..}>mittel</option>
			<option value="3" {..traps_difficult_selected..}>schwer</option>
			<option value="4" {..traps_different_selected..}>uneinheitlich</option>
			<option value="-1" {..traps_N/A_selected..}>k.A.</option>
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
		    <option value="0" {..items_none_selected..}>keine</option>
			<option value="1" {..items_rare_selected..}>selten</option>
			<option value="2" {..items_normal_selected..}>normal</option>
			<option value="3" {..items_often_selected..}>oft</option>
			<option value="4" {..items_different_selected..}>uneinheitlich</option>
			<option value="-1" {..items_N/A_selected..}>k.A.</option>
		  </select>
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
        <td align="center" colspan="2">
          <input class="button" type="submit" value="Absenden">
        </td>
      </tr>
    </table>
  </form>
</p>
<!--section-end::form_edit_body-->
