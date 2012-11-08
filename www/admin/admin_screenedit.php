<?php if (!defined('ACP_GO')) die('Unauthorized access!');

//load config
$FD->loadConfig('screens');
$config_arr = $FD->configObject('screens')->getConfigArray();

//////////////////////////////
//// Screenshot editieren ////
//////////////////////////////

if (isset($_POST['title']) AND $_POST['do'] == 'edit')
{
    settype($_POST['catid'], 'integer');
    settype($_POST['editscreenid'], 'integer');
    $_POST['title'] = savesql($_POST['title']);
    if ($_POST['delscreen'])   // Screenshot l�schen
    {
        mysql_query('DELETE FROM '.$FD->config('pref')."screen WHERE screen_id = $_POST[editscreenid]", $FD->sql()->conn() );
        image_delete('images/screenshots/', $_POST['editscreenid']);
        image_delete('images/screenshots/', "$_POST[editscreenid]_s");
        systext('Screenshot wurde gel&ouml;scht');
    }
    else   // Screenshot editieren
    {
        $update = 'UPDATE '.$FD->config('pref')."screen
                   SET cat_id = $_POST[catid],
                   screen_name = '$_POST[title]'
                   WHERE screen_id = $_POST[editscreenid]";
        mysql_query($update, $FD->sql()->conn() );
        systext('Der Screenshot wurde editiert');
    }
}


//////////////////////////////
//// Screenshot anzeigen /////
//////////////////////////////

elseif (isset($_POST['screenid']))
{

/////////////////////////////
//// Thumb neu erstellen ////
/////////////////////////////


    //security functions
    settype($_POST['screenid'], 'integer');

    if ($_POST['do'] == 'newthumb')
    {
        image_delete('images/screenshots/',$_POST['screenid'].'_s');

        $newthumb = @create_thumb_from(image_url('images/screenshots/',$_POST['screenid'],FALSE, TRUE),$config_arr['screen_thumb_x'],$config_arr['screen_thumb_y']);
        systext(create_thumb_notice($newthumb));
    }

    $index = mysql_query('SELECT * FROM '.$FD->config('pref')."screen WHERE screen_id = $_POST[screenid]", $FD->sql()->conn() );
    $screen_arr = mysql_fetch_assoc($index);

    echo'
                    <form action="" method="post">
                        <input type="hidden" value="screens_edit" name="go">
                        <input type="hidden" value="newthumb" name="do">
                        <input type="hidden" value="'.$screen_arr['screen_id'].'" name="screenid">
                        <table class="content" cellpadding="0" cellspacing="0">
                            <tr><td colspan="2"><h3>Bild bearbeiten</h3><hr></td></tr>
                            <tr>
                                <td class="config" valign="top">
                                    Bild:<br>
                                    <font class="small">Thumbnail des Screenshots</font>
                                </td>
                                <td class="config" valign="top">
                                   <img src="'.image_url('images/screenshots/',$screen_arr['screen_id'].'_s').'?cachebreaker='.time().'" />
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Thumbnail neu erstellen:<br>
                                    <font class="small">Erstellt ein neues Thumbnail von der Vorlage.</font>
                                </td>
                                <td class="config" valign="top" align="left">
                                  <input type="submit" value="Jetzt neu erstellen">
                                </td>
                            </tr>
                    </form>
                    <form action="" method="post">
                        <input type="hidden" value="screens_edit" name="go">
                        <input type="hidden" value="edit" name="do">
                        <input type="hidden" value="'.$screen_arr['screen_id'].'" name="editscreenid">
                            <tr>
                                <td class="config" valign="top">
                                    Bildtitel:<br>
                                    <font class="small">Bilduntertiel (optional)</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" name="title" size="33" value="'.$screen_arr['screen_name'].'" maxlength="255">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Kategorie:<br>
                                    <font class="small">In welche Kategorie soll der Screenshot eingeordnet werden</font>
                                </td>
                                <td class="config" valign="top">
                                    <select name="catid">
    ';
    $index = mysql_query('SELECT * FROM '.$FD->config('pref').'screen_cat WHERE cat_type = 1', $FD->sql()->conn() );
    while ($cat_arr = mysql_fetch_assoc($index))
    {
        $sele = ($screen_arr['cat_id'] == $cat_arr['cat_id']) ? 'selected' : '';
        echo'
                                        <option value="'.$cat_arr['cat_id'].'" '.$sele.'>
                                            '.$cat_arr['cat_name'].'
                                        </option>
        ';
    }
    echo'
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Screenshot l&ouml;schen:
                                </td>
                                <td class="config">
                                   <input onClick=\'delalert ("delscreen", "Soll der Screenshot wirklich gel�scht werden?")\' type="checkbox" name="delscreen" id="delscreen" value="1">
                                </td>
                            </tr>
                            <tr>
                                <td align="center" colspan="2">
                                    <input class="button" type="submit" value="Absenden">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';
}

/////////////////////////////
/// Screenshot Kategorien ///
/////////////////////////////

else
{
    if (isset($_POST['screencatid']))
    {
        settype($_POST['screencatid'], 'integer');
        $wherecat = 'WHERE cat_id = ' . $_POST['screencatid'];
    }

    echo'
                    <form action="" method="post">
                        <input type="hidden" value="screens_edit" name="go">
                        <table class="content" cellpadding="0" cellspacing="0">
                            <tr><td><h3>Kategorie ausw�hlen</h3><hr></td></tr>
                            <tr>
                                <td class="thin" width="40%">
                                    Dateien der Kategorie
                                    <select name="screencatid">
    ';
    $index = mysql_query('SELECT * FROM '.$FD->config('pref').'screen_cat WHERE cat_type = 1', $FD->sql()->conn() );
    while ($cat_arr = mysql_fetch_assoc($index))
    {
        $sele = ($_POST['screencatid'] == $cat_arr['cat_id']) ? 'selected' : '';
        echo'
                                        <option value="'.$cat_arr['cat_id'].'" '.$sele.'>
                                            '.$cat_arr['cat_name'].'
                                        </option>
        ';
    }
    echo'
                                    </select>
                                    <input type="submit" value="Anzeigen">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';

//////////////////////////////
//// Screenshot ausw�hlen ////
//////////////////////////////

    if (isset($_POST['screencatid']))
    {
        echo'<br>
                    <form action="" method="post">
                        <input type="hidden" value="screens_edit" name="go">
                        <table class="content" cellpadding="0" cellspacing="0">
                            <tr><td colspan="4"><h3>Bild ausw�hlen</h3><hr></td></tr>
                            <tr>
                                <td class="config" width="30%">
                                    Bild
                                </td>
                                <td class="config" width="35%">
                                    Titel
                                </td>
                                <td class="config" width="35%">
                                    Kategorie
                                </td>
                                <td class="config" width="15%">
                                    
                                </td>
                            </tr>
        ';
        $index = mysql_query('SELECT * FROM '.$FD->config('pref')."screen $wherecat ORDER BY screen_id DESC", $FD->sql()->conn() );
        while ($screen_arr = mysql_fetch_assoc($index))
        {
            $index2 = mysql_query('SELECT cat_name FROM '.$FD->config('pref')."screen_cat WHERE cat_id = $screen_arr[cat_id]", $FD->sql()->conn() );
            $db_cat_name = mysql_fetch_row($index2);
            $db_cat_name = $db_cat_name[0];

            echo'
                            <tr style="cursor:pointer;"
                                onmouseover="javascript:this.style.backgroundColor=\'#EEEEEE\'"
                                onmouseout="javascript:this.style.backgroundColor=\'transparent\'"
                                onClick=\'document.getElementById("'.$screen_arr['screen_id'].'").checked="true";\'>
                                <td class="configthin">
                                    <img src="'.image_url('images/screenshots/',killhtml(unslash($screen_arr['screen_id'])).'_s').'"  style="max-width:200px; max-height:100px;">
                                </td>
                                <td class="thin">
                                    '.killhtml(unslash($screen_arr['screen_name'])).'
                                </td>
                                <td class="thin">
                                    '.killhtml(unslash($db_cat_name)).'
                                </td>
                                <td class="thin">
                                    <input type="radio" name="screenid" id="'.$screen_arr['screen_id'].'" value="'.$screen_arr['screen_id'].'">
                                </td>
                            </tr>
            ';
        }
        echo'
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td colspan="4" class="buttontd">
                                    <button type="submit" value="1" class="button_new" name="sended">
                                        '.$FD->text('admin', 'button_arrow').' Bild bearbeiten
                                    </button>
                                </td>
                            </tr>                            
                        </table>
                    </form>
        ';
    }
}
?>
