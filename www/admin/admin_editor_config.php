<?php

/////////////////////////////////////
//// Konfiguration aktualisieren ////
/////////////////////////////////////

if ($_POST[smilies_rows] && $_POST[smilies_rows]>0 AND $_POST[smilies_cols] && $_POST[smilies_cols]>0
 AND $_POST[textarea_width] && $_POST[textarea_width]>0  AND $_POST[textarea_height] && $_POST[textarea_height]>0)
{
    settype($_POST[smilies_rows], 'integer');
    settype($_POST[smilies_cols], 'integer');
    settype($_POST[textarea_width], 'integer');
    settype($_POST[textarea_height], 'integer');
    
    $update = "UPDATE fs_editor_config
               SET smilies_rows = '$_POST[smilies_rows]',
                   smilies_cols = '$_POST[smilies_cols]',
                   textarea_width = '$_POST[textarea_width]',
                   textarea_height = '$_POST[textarea_height]',
                   bold = '$_POST[bold]',
                   italic = '$_POST[italic]',
                   underline = '$_POST[underline]',
                   strike = '$_POST[strike]',
                   center = '$_POST[center]',
                   font = '$_POST[font]',
                   color = '$_POST[color]',
                   size = '$_POST[size]',
                   img = '$_POST[img]',
                   cimg = '$_POST[cimg]',
                   url = '$_POST[url]',
                   home = '$_POST[home]',
                   email = '$_POST[email]',
                   code = '$_POST[code]',
                   quote = '$_POST[quote]',
                   noparse = '$_POST[noparse]',
                   smilies = '$_POST[smilies]'
               WHERE id = 1";
    mysql_query($update, $db);
    systext("Die Konfiguration wurde aktualisiert");
}

/////////////////////////////////////
////// Konfiguration Formular ///////
/////////////////////////////////////

else
{
    $index = mysql_query("SELECT * FROM fs_editor_config", $db);
    $config_arr = mysql_fetch_assoc($index);
    echo'
                    <form action="'.$PHP_SELF.'" method="post">
                        <input type="hidden" value="editorconfig" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
                            <tr>
                                <td class="config" valign="top" width="50%">
                                    Smilies:<br>
                                    <font class="small">Wie viele Smilies werden im Editor angezeigt?</font>
                                </td>
                                <td class="config" valign="top" width="50%">
                                    <input class="text" size="1" name="smilies_rows" value="'.$config_arr[smilies_rows].'" maxlength="2"> Reihen � <input class="text" size="1" name="smilies_cols" value="'.$config_arr[smilies_cols].'" maxlength="2"> Smilies<br /><font class="small">(0 ist nicht zul�ssig)</font>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top" width="50%">
                                    �ffentliche Buttons:<br>
                                    <font class="small">Buttons, die im �ffentlichen Teil angezeigt werden.</font>
                                </td>
                                <td class="config" valign="top" width="50%">

                                    <table cellpadding="0" cellspacing="0">
                                      <tr>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/bold.gif" alt="" title="fett">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/italic.gif" alt="" title="kursiv">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/underline.gif" alt="" title="unterstrichen">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/strike.gif" alt="" title="durchgestrichen">
    </div></td>
    <td class="editor_td_seperator"></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/center.gif" alt="" title="zentriert">
    </div></td>
    <td class="editor_td_seperator"></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/font.gif" alt="" title="Schriftart">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/color.gif" alt="" title="Schriftfarbe">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/size.gif" alt="" title="Schriftgr��e">
    </div></td>
                                      </tr>
                                      <tr>
    <td><input type="checkbox" name="bold" value="1"';
    if ($config_arr[bold] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="italic" value="1"';
    if ($config_arr[italic] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="underline" value="1"';
    if ($config_arr[underline] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="strike" value="1"';
    if ($config_arr[strike] == 1)
      echo " checked=checked";
    echo'/></td>
    
    <td></td>
    
    <td><input type="checkbox" name="center" value="1"';
    if ($config_arr[center] == 1)
      echo " checked=checked";
    echo'/></td>
    
    <td></td>
    
    <td><input type="checkbox" name="font" value="1"';
    if ($config_arr[font] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="color" value="1"';
    if ($config_arr[color] == 1)
      echo " checked=checked";
    echo'/></td>
        <td><input type="checkbox" name="size" value="1"';
    if ($config_arr[size] == 1)
      echo " checked=checked";
    echo'/></td>
                                      </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" style="padding-top:5px;">
                                      <tr>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/img.gif" alt="" title="Bild">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/cimg.gif" alt="" title="Content-Image">
    </div></td>
    <td class="editor_td_seperator"></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/url.gif" alt="" title="Link">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/home.gif" alt="" title="Home-Link">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/email.gif" alt="" title="Email">
    </div></td>
    <td class="editor_td_seperator"></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/code.gif" alt="" title="Code">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/quote.gif" alt="" title="Zitat">
    </div></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/noparse.gif" alt="" title="Noparse-Bereich">
    </div></td>
    <td class="editor_td_seperator"></td>
    <td class="editor_td"><div class="editor_button" style="cursor:default;">
      <img src="'.$global_config_arr[virtualhost].'images/icons/smilie.gif" alt="" title="Smilies">
    </div></td>
                                      </tr>
                                      <tr>
    <td><input type="checkbox" name="img" value="1"';
    if ($config_arr[img] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="cimg" value="1"';
    if ($config_arr[cimg] == 1)
      echo " checked=checked";
    echo'/></td>

    <td></td>

    <td><input type="checkbox" name="url" value="1"';
    if ($config_arr[url] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="home" value="1"';
    if ($config_arr[home] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="email" value="1"';
    if ($config_arr[email] == 1)
      echo " checked=checked";
    echo'/></td>
    
    <td></td>

    <td><input type="checkbox" name="code" value="1"';
    if ($config_arr[code] == 1)
      echo " checked=checked";
    echo'/></td>
    <td><input type="checkbox" name="quote" value="1"';
    if ($config_arr[quote] == 1)
      echo " checked=checked";
    echo'/></td>
        <td><input type="checkbox" name="noparse" value="1"';
    if ($config_arr[noparse] == 1)
      echo " checked=checked";
    echo'/></td>
    
    <td></td>

    <td><input type="checkbox" name="smilies" value="1"';
    if ($config_arr[smilies] == 1)
      echo " checked=checked";
    echo'/></td>
                                      </tr>
                                    </table>

                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top" width="50%">
                                    Textfeld Ausma�e: <font class="small">(Breite x H�he)</font><br>
                                    <font class="small">Welche Gr��e soll das Textfeld haben?</font>
                                </td>
                                <td class="config" valign="top" width="50%">
                                    <input class="text" size="2" name="textarea_width" value="'.$config_arr[textarea_width].'" maxlength="3"> x <input class="text" size="2" name="textarea_height" value="'.$config_arr[textarea_height].'" maxlength="3"> Pixel<br /><font class="small">(0 ist nicht zul�ssig)</font>
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
?>