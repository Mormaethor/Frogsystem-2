<?php
////////////////////////////////
//// Create textarea        ////
////////////////////////////////

function create_editor($name, $text="", $width="", $height="", $class="", $do_smilies=true)
{
    global $global_config_arr;
    global $db;

    if ($name != "") {
        $name2 = 'name="'.$name.'" id="'.$name.'"';
    } else {
        return false;
    }

    if ($width != "") {
        $width2 = 'width:'.$width.'px;';
    }

    if ($height != "") {
        $height2 = 'height:'.$height.'px';
    }

    if ($class != "") {
        $class2 = 'class="'.$class.'"';
    }

    $style = $name2.' '.$class2.' style="'.$width2.' '.$height2.'"';

  $smilies = "";
  if ($do_smilies == true)
  {
    $smilies = '
      <fieldset style="width:46px;">
        <legend class="small" align="left"><font class="small">Smilies</font></legend>
          <table cellpadding="2" cellspacing="0" border="0" width="100%">';

    $zaehler = 0;
    $index = mysql_query("SELECT * FROM fs_smilies ORDER by `order` ASC LIMIT 0, 10", $db);
    while ($smilie_arr = mysql_fetch_assoc($index))
    {
        $smilie_arr[url] = image_url("../images/smilies/", $smilie_arr[id]);

        $smilie_template = '<td><img src="'.$smilie_arr[url].'" alt="" onClick="insert(\''.$name.'\', \''.$smilie_arr[replace_string].'\', \'\')" class="editor_smilies" /></td>';

        $zaehler += 1;
        switch ($zaehler)
        {
            case 1:
                $smilies .= "<tr align=\"center\">\n\r";
                $smilies .= $smilie_template;
                break;
             case 2:
                $zaehler = 0;
                $smilies .= $smilie_template;
                $smilies .= "</tr>\n\r";
                break;
        }
    }
    unset($smilie_arr);
    unset($smilie_template);
    unset($config_arr);

    $smilies .= '</table></fieldset>';
  }
  
    $buttons = "";
    $buttons .= create_editor_button('images/icons/bold.gif', "B", "fett", "insert('$name', '[b]', '[/b]')");
    $buttons .= create_editor_button('images/icons/italic.gif', "I", "kursiv", "insert('$name', '[i]', '[/i]')");
    $buttons .= create_editor_button('images/icons/underline.gif', "U", "unterstrichen", "insert('$name','[u]','[/u]')");
    $buttons .= create_editor_button('images/icons/strike.gif', "S", "durgestrichen", "insert('$name', '[s]', '[/s]')");
    $buttons .= create_editor_seperator();
    $buttons .= create_editor_button('images/icons/center.gif', "CENTER", "zentriert", "insert('$name', '[center]', '[/center]')");
    $buttons .= create_editor_seperator();
    $buttons .= create_editor_button('images/icons/font.gif', "FONT", "Schriftart", "insert_com('$name', 'font', 'Bitte gib die gew�nschte Schriftart ein:', '')");
    $buttons .= create_editor_button('images/icons/color.gif', "COLOR", "Schriftfarbe", "insert_com('$name', 'color', 'Bitte gib die gew�nschte Schriftfarbe (englisches Wort) ein:', '')");
    $buttons .= create_editor_button('images/icons/size.gif', "SIZE", "Schriftgr��e", "insert_com('$name', 'size', 'Bitte gib die gew�nschte Schriftgr��e (Zahl von 1-7) ein:', '')");
    $buttons .= create_editor_seperator();
    $buttons .= create_editor_button('images/icons/img.gif', "IMG", "Bild einf�gen", "insert_mcom('$name', '[img]', '[/img]', 'Bitte gib die URL zu der Grafik ein:', 'http://')");
    $buttons .= create_editor_button('images/icons/cimg.gif', "CIMG", "Content-Image einf�gen", "insert_mcom('$name', '[cimg]', '[/cimg]', 'Bitte gib den Namen des Content-Images (mit Endung) ein:', '')");
    $buttons .= create_editor_seperator();
    $buttons .= create_editor_button('images/icons/url.gif', "URL", "Link einf�gen", "insert_com('$name', 'url', 'Bitte gib die URL ein:', 'http://')");
    $buttons .= create_editor_button('images/icons/home.gif', "HOME", "Projektinternen Link einf�gen", "insert_com('$name', 'home', 'Bitte gib den projektinternen Verweisnamen ein:', '')");
    $buttons .= create_editor_button('images/icons/email.gif', "@", "Email-Link einf�gen", "insert_com('$name', 'email', 'Bitte gib die Email-Adresse ein:', '')");
    $buttons .= create_editor_seperator();
    $buttons .= create_editor_button('images/icons/code.gif', "C", "Code-Bereich einf�gen", "insert('$name', '[code]', '[/code]')");
    $buttons .= create_editor_button('images/icons/quote.gif', "Q", "Zitat einf�gen", "insert('$name', '[quote]', '[/quote]')");
    $buttons .= create_editor_button('images/icons/noparse.gif', "N", "Nicht umzuwandelnden Bereich einf�gen", "insert('$name', '[noparse]', '[/noparse]')");


    $textarea = '<table cellpadding="0" cellspacing="0" border="0" style="padding-bottom:4px">
                     <tr valign="bottom">
                         {buttons}
                     </tr>
                 </table>
                 <table cellpadding="0" cellspacing="0" border="0">
                     <tr valign="top">
                         <td>
                             <textarea {style}>{text}</textarea>
                         </td>
                         <td style="width:4px; empty-cells:show;"></td>
                         <td>
                             {smilies}
                         </td>
                     </tr>
                 </table><br />';
    
    $textarea = str_replace("{style}", $style, $textarea);
    $textarea = str_replace("{text}", $text, $textarea);
    $textarea = str_replace("{buttons}", $buttons, $textarea);
    $textarea = str_replace("{smilies}", $smilies, $textarea);

    return $textarea;
}


////////////////////////////////
//// Create textarea Button ////
////////////////////////////////

function create_editor_button($img_url, $alt, $title, $insert)
{
    global $global_config_arr;
    $javascript = 'onClick="'.$insert.'"';

    $button = '
    <td class="editor_td">
        <div class="editor_button" {javascript}>
            <img src="{img_url}" alt="{alt}" title="{title}" />
        </div>
    </td>';
    $button = str_replace("{img_url}", $global_config_arr[virtualhost].$img_url, $button);
    $button = str_replace("{alt}", $alt, $button);
    $button = str_replace("{title}", $title, $button);
    $button = str_replace("{javascript}", $javascript, $button);

    return $button;
}


////////////////////////////////////
//// Create textarea  Seperator ////
////////////////////////////////////

function create_editor_seperator()
{
    $seperator = '<td class="editor_td_seperator"></td>';
    return $seperator;
}


////////////////////////////////////
//// Templatepage Save Template ////
////////////////////////////////////

function templatepage_save($template_arr)
{
    global $db;

    foreach ($template_arr as $template)
    {
        $save_template = savesql($_POST[$template[name]]);
        mysql_query("update fs_template
                    set $template[name] = '".$_POST[$template[name]]."'
                    where id = '$_POST[design]'", $db);
    }

    unset ($template);
    unset ($template_arr);
}


///////////////////////////////////
//// Templatepage $_POST-Check ////
///////////////////////////////////

function templatepage_postcheck($template_arr)
{
    global $db;
    $return_true = false;
    
    foreach ($template_arr as $template)
    {
        if ($_POST[$template[name]]) {
            $return_true = true;
        }
    }

    unset ($template);
    unset ($template_arr);

    if ($return_true) {
        return true;
    } else {
        return false;
    }
}


/////////////////////////////
//// Create Templatepage ////
/////////////////////////////

function create_templatepage($template_arr, $go)
{
    global $db;

    unset ($return_template);
    // Design ermittlen
    $return_template .= '
                    <div align="left">
                        <form action="'.$PHP_SELF.'" method="post">
                            <input type="hidden" value="'.$go.'" name="go">
                            <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                            <select name="design" onChange="this.form.submit();">
                                <option value="">Design ausw�hlen</option>
                                <option value="">------------------------</option>
    ';

    $index = mysql_query("select id, name from fs_template ORDER BY id", $db);
    while ($design_arr = mysql_fetch_assoc($index))
    {
      $return_template .= '<option value="'.$design_arr[id].'"';
      if ($design_arr[id] == $_POST[design])
        $return_template .= ' selected=selected';
      $return_template .= '>'.$design_arr[name];
      if ($design_arr[id] == $global_config_arr[design])
        $return_template .= ' (aktiv)';
      $return_template .= '</option>';
    }

    $return_template .= '
                            </select> <input class="button" value="Los" type="submit">
                        </form>
                    </div>
    ';
    
    if (($_POST[design] OR $_POST[design]==0) AND $_POST[design]!="")
    {
        foreach ($template_arr as $template_key => $template)
        {
            if ($template == true)
            {
                $index = mysql_query("SELECT $template[name] FROM fs_template WHERE id = '$_POST[design]'", $db);
                $template_arr[$template_key][template] = killhtml(mysql_result($index, 0, $template[name]));
            }
        }
        unset ($template_key);
        unset ($template);
        
        $return_template .= '
        <input type="hidden" value="" name="editwhat">
                    <form action="'.$_SERVER[PHP_SELF].'" method="post">
                        <input type="hidden" value="'.$go.'" name="go">
                        <input type="hidden" value="'.$_POST[design].'" name="design">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
        ';
        
        foreach ($template_arr as $template_key => $template)
        {
            if ($template != false)
            {
                $return_template .= create_templateeditor($template);
            }
            else
            {
                $return_template .= '
                            <tr>
                                <td class="config" colspan="2">
                                    <hr>
                                </td>
                            </tr>';
            }
        }
        unset ($template_key);
        unset ($template);
        
        $return_template .= '
                                    <tr>
                                <td colspan="2">
                                    <input class="button" type="submit" value="Absenden">
                                </td>
                            </tr>
                        </table>
                    </form>
        ';
        
    }
    
    unset ($template_arr);
    return $return_template;
}

////////////////////////////////
//// create template editor ////
////////////////////////////////
function create_templateeditor($editor_arr)
{
    global $db;
    unset ($editor_template);
    
    $editor_template .= '
                            <tr>
                                <td class="config" valign="top">
                                    '.$editor_arr[title].':<br>
                                    <font class="small">'.$editor_arr[description];
                                    
    if (count($editor_arr[help]) >= 1)
    {
        $editor_template .= '<br /><br /><span style="padding-bottom:5px; display:block;">G�ltige Tags:<br /></span>';
        foreach ($editor_arr[help] as $help)
        {
            $editor_template .= insert_tt($help[tag],$help[text],$editor_arr[name]);
        }
    }

    unset ($help);

    $editor_template .= '
                                    </font>
                                <td class="config" valign="top">
                                    <textarea rows="'.$editor_arr[rows].'" cols="'.$editor_arr[cols].'" name="'.$editor_arr[name].'" id="'.$editor_arr[name].'">'.$editor_arr[template].'</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top"></td>
                                <td class="config" valign="top">
                                    <input type="button" class="button" Value="Editor" onClick="openedit(\''.$editor_arr[name].'\')">
                                </td>
                            </tr>
    ';
    
    return $editor_template;
}
////////////////////////
//// Insert Tooltip ////
////////////////////////

function insert_tt($title,$text,$form)
{
   return '
'.$title.' <a class="tooltip" href="#">
<img border="0" src="img/help.png" align="top" />&nbsp;
<span>
 <img border="0" src="img/pointer.png" align="top" alt="->" /> <b>'.$title.'</b><br />'.$text.'
</span></a>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:insert(\''.$form.'\',\''.$title.'\',\'\');"><img border="0" src="img/pointer.png" alt="->" title="einf�gen" align="top" /></a>
<br />
   ';
}


////////////////////////////////
//// Systemmeldung ausgeben ////
////////////////////////////////

function systext($text)
{
   echo '
                    <table border="0" cellpadding="4" cellspacing="0" width="400">
                        <tr>
                            <td class="config" style="text-align:center;">
                                '.$text.'
                            </td>
                        </tr>
                    </table>
                    <p>
   ';
}

////////////////////////////////
//// Seitentitel generieren  ///
//// und Berechtigung pr�fen ///
////////////////////////////////

function createpage($title, $permission, $page)
{
 global $pagetitle;
 global $filetoinc;
 $pagetitle = $title; 
 if ($permission == 1) $filetoinc = $page; 
 else $filetoinc = 'admin_error.php';
}

////////////////////////////////
//// Men� erzeugen           ///
////////////////////////////////

function createmenu($menu_arr)
{
    global $go;
    global $session_url;
    
    end ($menu_arr);
    $end = key($menu_arr);
    reset ($menu_arr);

    foreach ($menu_arr as $key => $value)
    {
        if ($value[show] == true AND $_SESSION["user_level"] == "authorised")
        {
            $menu_class = "menu_link";
            if ($_GET['mid']==$value[id] AND ($go!="login" OR $_SESSION["user_level"] == "authorised")) {
                $menu_class = "menu_link_selected";
            }
            $template .= '<a href="'.$PHP_SELF.'?mid='.$value[id].$session_url.'" target="_self" class="'.$menu_class.'">'.$value[title].'</a>';
            if ($key != $end) {
                $template .= "&nbsp;&nbsp;&nbsp;&nbsp;";
            }
        }
    }

    echo $template;
    unset($template);
}

////////////////////////////////
//// Menu ermitteln          ///
////////////////////////////////

function createmenu_show2arr($navi_arr)
{
    unset($template);

    foreach ($navi_arr[link] as $value)
    {
        $template .= createlink($value);
    }


    if ($template == "") {
        $show_arr[state] = false;
    } else {
        $show_arr[state] = true;
    }
    $show_arr[menu_id] = $navi_arr[menu_id];
    return $show_arr;
}

////////////////////////////////
//// Men� anzeigen           ///
////////////////////////////////

function createmenu_show($show_arr,$menu_id)
{
    foreach ($show_arr as $value)
    {
        if ($value[menu_id] == $menu_id AND $value[state] == true) {
            return true;
        }
    }
    return false;
}

////////////////////////////////
//// Navi erzeugen           ///
////////////////////////////////

function createnavi($navi_arr, $first)
{
    unset($template);

    if ($navi_arr[menu_id] == $_GET['mid'] AND $_SESSION["user_level"] == "authorised") {
        foreach ($navi_arr[link] as $value)
        {
            $template .= createlink($value);
        }

        if ($first == true) {
            $headline_img = "navi_top";
        } else {
            $headline_img = "navi_headline";
        }
    }
    
    if ($template != "") {
        $template = '
            <div id="'.$headline_img.'">
                <img src="img/pointer.png" alt="" style="vertical-align:text-bottom">&nbsp;<b>'.$navi_arr[title].'</b>
                <div id="navi_link">
                    '.$template.'
                </div>
            </div>';
    }
    
    return $template;
}


////////////////////////////////
//// Seitenlink generieren   ///
//// und Berechtigung pr�fen ///
////////////////////////////////

function createlink($page_call, $page_link_title = false, $page_link_url = false, $page_link_perm = false)
{
  global $db;
  global $session_url;

  $index = mysql_query("SELECT * FROM fs_admin_cp WHERE page_call = '$page_call' LIMIT 0,1", $db);
  $createlink_arr = mysql_fetch_assoc($index);

  if ($createlink_arr[permission]!=1)
  {
      $createlink_arr[permission] = $_SESSION[$createlink_arr[permission]];
  }

  if ($page_link_perm!=false)
  {
      $createlink_arr[permission] = $page_link_perm;
  }

  if ($page_link_title!=false)
  {
      $createlink_arr[link_title] = $page_link_title;
  }

  if ($page_link_url!=false)
  {
      $createlink_arr[page_call] = $page_link_url;
  }

  $link_class = "navi";
  if ($_GET['go'] == $page_call)
  {
      $link_class = "navi_selected";
  }
  
  if ($createlink_arr[permission] == 1)
  {
      return'
      <a href="'.$PHP_SELF.'?mid='.$_GET['mid'].'&go='.$createlink_arr[page_call].$session_url.'" class="navi">- </a>
      <a href="'.$PHP_SELF.'?mid='.$_GET['mid'].'&go='.$createlink_arr[page_call].$session_url.'" class="'.$link_class.'">
          '.$createlink_arr[link_title].'</a><br />';
  }
  else
  {
      return "";
  }
}

////////////////////////////////
//// Navi first              ///
////////////////////////////////

function createnavi_first($template)
{
    if (strlen($template) == 0) {
        return true;
    } else {
        return false;
    }
}

////////////////////////////////
//// Navi Permission         ///
////////////////////////////////

function createnavi_perm($perm_arr)
{
    $givePermission = false;
    foreach ($perm_arr as $value) {
        if ($_SESSION[$value] == 1) {
            $givePermission = true;
        } else {
            $givePermission = false;
        }
    }
    if ($perm_arr[0] === true) {
        $givePermission = true;
    }
    return $givePermission;
}

////////////////////////////
//// Pic Upload Meldung ////
////////////////////////////

function upload_img_notice($upload)
{
  switch ($upload)
  {
    case 0:
      return "Das Bild wurde erfolgreich hochgeladen!";
      break;
    case 1:
      return "Ung�ltiger Dateityp!";
      break;
    case 2:
      return "Fehler bei der Bilderstellung!";
      break;
    case 3:
      return "Das Bild ist zu gro�! (Dateigr��e)";
      break;
    case 4:
      return "Das Bild ist zu gro�! (Abmessungen)";
      break;
    case 5:
      return "Das Bild ist entspricht nicht den erforderlichen Abmessungen!";
      break;
  }
}

////////////////////////////////
///// Pic Upload + Thumbnail ///
////////////////////////////////

function upload_img($image, $image_path, $image_name, $image_max_size, $image_max_width, $image_max_height, $quality=100, $only_this_size = false)
{

  //Dateityp ermitteln

  switch ($image['type'])
  {
    case "image/jpeg":
      $source_image = imagecreatefromjpeg($image['tmp_name']);
      $type="jpg";
      break;
    case "image/gif":
      $source_image = imagecreatefromgif($image['tmp_name']);
      $type="gif";
      break;
    case "image/png":
      $source_image = imagecreatefrompng($image['tmp_name']);
      $type="png";
      break;
    default:
      return 1;  // Fehler 1: Ung�ltiger Dateityp!
      break 2;
  }

  //Fehler �berpr�fung

  if (!isset($source_image))
  {
    return 2;  // Fehler 2: Fehler bei der Bilderstellung!
    break;
  }
  if ($image['size'] > $image_max_size)
  {
    return 3;  // Fehler 3: Das Bild ist zu gro�! (Dateigr��e)
    break;
  }
  if ( (imagesx($source_image) > $image_max_width) && (imagesy($source_image) > $image_max_height) )
  {
    return 4;  // Fehler 4: Das Bild ist zu gro�! (Abmessungen)
    break;
  }
  if ( $only_this_size == true AND ( (imagesx($source_image) != $image_max_width) OR (imagesy($source_image) != $image_max_height) ) )
  {
    return 5;  // Fehler 6: Das Bild ist entspricht nicht den erforderlichen Abmessungen!
    break;
  }

  //Bild erstellen

  $full_path = $image_path . $image_name . "." . $type;
  move_uploaded_file($image['tmp_name'], $full_path);
  chmod ($full_path, 0644);

  return 0; // Ausgabe 0: Das Bild wurde erfolgreich hochgeladen!
  clearstatcache();
}

////////////////////////////
/// Create Thumb Meldung ///
////////////////////////////

function create_thumb_notice($upload)
{
  switch ($upload)
  {
    case 0:
      return "Das Thumbnail wurde erfolgreich erstellt!";
      break;
    case 1:
      return "Thumbnail: Ung�ltiger Dateityp!";
      break;
    case 2:
      return "Fehler bei der Thumbnailerstellung!";
      break;
  }
}


///////////////////////////////////
///// Create Thumbnail from IMG ///
///////////////////////////////////

function create_thumb_from($image, $thumb_max_width, $thumb_max_height, $quality=100)
{
  $image_info = pathinfo($image);

  //Dateityp ermitteln

  switch ($image_info['extension'])
  {
    case "jpeg":
      $source_image = imagecreatefromjpeg($image);
      $image_info['name'] = basename ($image,".jpeg");
      break;
    case "jpg":
      $source_image = imagecreatefromjpeg($image);
      $image_info['name'] = basename ($image,".jpg");
      break;
    case "gif":
      $source_image = imagecreatefromgif($image);
      $image_info['name'] = basename ($image,".gif");
      break;
    case "png":
      $source_image = imagecreatefrompng($image);
      $image_info['name'] = basename ($image,".png");
      break;
    default:
      return 1;  // Fehler 1: Ung�ltiger Dateityp!
      break 2;
  }

  //Thumbnail erstellen

    //Abmessungen des Thumbnails ermitteln

    $imgratio = imagesx($source_image) / imagesy($source_image);

    if ($imgratio > 1)  //Querformat
    {
      if ($thumb_max_width/$imgratio <= $thumb_max_height)
      {
        $newwidth = $thumb_max_width;
        $newheight = $thumb_max_width/$imgratio;
      }
      else
      {
        $newheight = $thumb_max_height;
        $newwidth = $thumb_max_height*$imgratio;
      }
    }

    else  //Hochformat
    {
      if ($thumb_max_height*$imgratio <= $thumb_max_width)
      {
        $newheight = $thumb_max_height;
        $newwidth = $thumb_max_height*$imgratio;
      }
      else
      {
        $newwidth = $thumb_max_width;
        $newheight = $thumb_max_width/$imgratio;
      }
    }
    

    if (imagesx($source_image) <= $thumb_max_width AND imagesy($source_image) <= $thumb_max_height)
    {
        $newwidth = imagesx($source_image);
        $newheight = imagesy($source_image);
    }


    //Thumbnail je nach Dateityp erstellen

    if ($image_info['extension']=="jpg" OR $image_info['extension']=="jpeg")
    {
      $thumb = ImageCreateTrueColor($newwidth,$newheight);
      $source = imagecreatefromjpeg($image);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, imagesx($source), imagesy($source));
      $thumb_path = $image_info['dirname']."/".$image_info['name']."_s.".$image_info['extension'];
      imagejpeg($thumb, $thumb_path, $quality);
      chmod ($thumb_path, 0644);
      clearstatcache();
    }
    elseif ($image_info['extension']=="gif")
    {
      $thumb = ImageCreateTrueColor($newwidth,$newheight);
      $source = imagecreatefromgif($image);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, imagesx($source), imagesy($source));
      $thumb_path = $image_info['dirname']."/".$image_info['name']."_s.".$image_info['extension'];
      imagegif($thumb, $thumb_path, $quality);
      chmod ($thumb_path, 0644);
      clearstatcache();
    }
    elseif ($image_info['extension']=="png")
    {
      $thumb = ImageCreateTrueColor($newwidth,$newheight);
      $source = imagecreatefrompng($image);
      imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, imagesx($source), imagesy($source));
      $thumb_path = $image_info['dirname']."/".$image_info['name']."_s.".$image_info['extension'];
      imagepng($thumb, $thumb_path, $quality);
      chmod ($thumb_path, 0644);
      clearstatcache();
    }
    else
    {
      return 2;  // Fehler 2: Es konnte kein Thumbnail erstellt werden!
      break;
    }

  return 0; // Ausgabe 0: Das Bild wurde erfolgreich hochgeladen!
  clearstatcache();
}

////////////////////////////////
//////// Cookie setzen /////////
////////////////////////////////

function admin_set_cookie($username, $password)
{
    global $db;

    $username = savesql($username);
    $password = savesql($password);
    $index = mysql_query("select * from fs_user where user_name = '$username'", $db);
    $rows = mysql_num_rows($index);
    if ($rows == 0)
    {
        return false;
    }
    else
    {
        $dbisadmin = mysql_result($index, 0, "is_admin");
        if ($dbisadmin == 1)
        {
            $password = md5($password);
            $dbuserpass = mysql_result($index, 0, "user_password");
            $dbuserid = mysql_result($index, 0, "user_id");
            if ($password == $dbuserpass)
            {
                $inhalt = $password . $username;
                setcookie ("login", $inhalt, time()+2592000, "/");
                return true;  // Login akzeptiert
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

////////////////////////////////
/////// Logindaten pr�fen //////
////////////////////////////////

function admin_login($username, $password, $iscookie)
{
    global $db;

    $username = savesql($username);
    $password = savesql($password);
    $index = mysql_query("SELECT * FROM fs_user WHERE user_name = '$username'", $db);
    $rows = mysql_num_rows($index);
    if ($rows == 0)
    {
        return 1;  // Fehlercode 1: User nicht vorhanden
    }
    else
    {
        $dbisadmin = mysql_result($index, 0, "is_admin");
        if ($dbisadmin == 1)
        {
            if ($iscookie===false)
            {
                $password = md5($password);
            }
            $dbuserpass = mysql_result($index, 0, "user_password");
            $dbuserid = mysql_result($index, 0, "user_id");
            if ($password == $dbuserpass)
            {
                $_SESSION["user_level"] = "authorised";
                fillsession($dbuserid);
                return 0;  // Login akzeptiert
            }
            else
            {
                return 2;  // Fehlercode 2: Falsches Passwort
            }
        }
        else
        {
            return 3;  // Fehlercode 3: Keine Zugriffsrechte auf die Admin
        }
    }
}

////////////////////////////////
//////// Session f�llen ////////
////////////////////////////////

function fillsession($uid)
{
   global $db;
   global $data;
   $dbaction = "select * from fs_user where user_id = " . $uid;
   $usertableindex2 = mysql_query($dbaction, $db);

   $_SESSION["user_id"] = $uid;
   $dbusername = mysql_result($usertableindex2, 0, "user_name");
   $_SESSION["user_name"] = $dbusername;
   $dbuserpass = mysql_result($usertableindex2, 0, "user_password");
   $_SESSION["user_pass"] = $dbuserpass;
   $dbusermail = mysql_result($usertableindex2, 0, "user_mail");
   $_SESSION["user_mail"] = $dbusermail;

   $result = mysql_list_fields($data,"fs_permissions");
   $menge = mysql_num_fields($result);
   for($x=1;$x<$menge;$x++)
   {
    $fieldname = mysql_field_name($result,$x);
    $index = mysql_query("select $fieldname from fs_permissions where user_id = $uid", $db);
    $_SESSION[$fieldname] = mysql_result($index, 0, $fieldname);
   }
}

?>