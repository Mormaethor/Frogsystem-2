<?php
/*
    This file is part of the Frogsystem Sitemap.
    Copyright (C) 2012  Thoronador

    The Frogsystem Sitemap is free software: you can redistribute it
    and/or modify it under the terms of the GNU General Public License as
    published by the Free Software Foundation, either version 3 of the License,
    or (at your option) any later version.

    The Frogsystem Sitemap is distributed in the hope that it will be
    useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
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


// TODO: - current design/layout is terrible, change it (but keep it simple
//         and straightforward)
//       - pages for articles in exclusion list (to limit the list to reasonable
//         length per page)
//       - localization needed

if (ACP_GO == "sitemap")
{

  require_once(FS2_ROOT_PATH . "includes/sitemap.php");

  //path to sitemap (maybe make that adjustable later on)
  $sitemap_location = FS2_ROOT_PATH.'sitemap.xml';
  //status
  $has_sitemap = file_exists($sitemap_location);

  echo '
  <table class="configtable" cellpadding="4" cellspacing="0">
    <tr>
      <td class="line">Sitemap</td>
    </tr>';

  if (isset($_POST['sitemap_type']))
  {
    if (!isset($_POST['out_ids']))
    {
      $_POST['out_ids'] = array();
    }
    if ($_POST['sitemap_type']=='xml')
    {
      //copy old sitemap (just in case)
      $copy_success = true;
      if ($has_sitemap)
      {
        if (!copy($sitemap_location, $sitemap_location.'.old'))
        {
          echo '    <tr><td class="config"><strong>Fehler</strong> beim Sichern der alten XML-Sitemap.<br><hr class="red"></td></tr>'."\n";
          $copy_success = false;
        }
      }
      if ($copy_success)
      {
        //get new sitemap
        $sitemap_content = sitemapXML($_POST['out_ids']);
        //write content to sitemap file
        $res = fopen($sitemap_location, 'wb');
        if ($res===false)
        {
          echo '    <tr><td class="config"><strong>Fehler</strong> beim Versuch, die Sitemapdatei zu &ouml;ffnen!<br><hr class="red"></td></tr>'."\n";
        }
        else
        {
          //write contents to file
          $status = fwrite($res, $sitemap_content);
          if ($status===false)
          {
            echo '    <tr><td class="config"><strong>Fehler</strong> beim Versuch, die Sitemapdatei zu schreiben!<br><hr class="red"></td></tr>'."\n";
          }
          else
          {
            echo '    <tr><td class="config" style="background-color: #64DC6A;"><strong>XML-Sitemap aktualisiert</strong>, '.$status.' Bytes geschrieben!</td></tr>'."\n";
          }
          fclose($res);
          clearstatcache(); //we need that, because otherwise PHP would use the cached value for file_exists() in the next line
          $has_sitemap = file_exists($sitemap_location);
        }
      }
    }
    else if ($_POST['sitemap_type']!='human')
    {
      echo '    <tr><td class="config"><strong>Ung&uuml;tige Aktion!</strong></td></tr>'."\n";
    }
  }//if

  //show status of XML sitemap
  if ($has_sitemap)
  {
    echo '    <tr><td class="config">XML-Sitemap vorhanden.<br>Die Sitemap befindet sich <a href="'.$sitemap_location.'" target="_blank">hier</a>.</td></tr>'."\n";
    //get time of last modification
    $modified = filemtime($sitemap_location);
    if ($modified===false)
    {
      $modified = 'unbekannt';
    }
    else
    {
      $modified = date('d.m.Y, H:i:s', $modified);
    }
    echo '    <tr><td class="configthin">Letzte Aktualisierung: '.$modified.'</td></tr>'."\n";
  }
  else
  {
    echo '    <tr><td class="config"><strong>Keine</strong> XML-Sitemap vorhanden.</td></tr>'."\n";
  }
  echo '    <tr>'."\n"
      .'      <td class="config" style="height: 20px;"> &nbsp; </td>'."\n"
      .'    </tr>'."\n"
      .'  </table>';

  //human readable sitemap requested?
  if (isset($_POST['sitemap_type']) && ($_POST['sitemap_type']=='human'))
  {
    if (!isset($_POST['out_ids']))
    {
      $_POST['out_ids'] = array();
    }
    $sitemap = sitemapHumanReadable(true, $_POST['out_ids']);
    echo
    '<br><br>
     <table class="configtable" cellpadding="4" cellspacing="0">
      <tr>
        <td class="line" colspan="2">Lesbare Sitemap</td>
      </tr>
      <tr>
        <td class="config">Sitemapcode:</td>
        <td>
          <textarea name="dummy" cols="50" rows="30">'.$sitemap.'</textarea>
        </td>
      </tr>
    </table>'."\n";
  }

  //fields to choose articles that shall be omitted in sitemap
  if (!isset($_POST['sitemap_type']))
  {
    if (!isset($_POST['out_ids']))
    {
      $_POST['out_ids'] = array();
    }
    $ac = $FD->sql()->doQuery('SELECT COUNT(*) AS ac FROM `{..pref..}articles` '
                       .'WHERE `article_url` != \'fscode\'');
    $ac = mysql_fetch_assoc($ac);
    $ac = $ac['ac'];
    echo '<br><br><form action="?go=sitemap" method="post">'."\n"
        .'<table class="configtable" cellpadding="4" cellspacing="0">'
        .'<tr><td class="line" colspan="2">Auszulassende Artikel ausw&auml;hlen ('.$ac.' Datens&auml;tze gefunden)</td></tr>'
        .'<tr><td class="configthin"><small>Hinweis: Der Artikel mit der URL ?go=fscode wird, so vorhanden, immer ausgelassen.</small></td></tr>';
    $result = $FD->sql()->doQuery('SELECT article_id, article_url, article_title, article_date, article_user, article_cat_id, cat_name '
                       .'FROM `{..pref..}articles` LEFT JOIN `{..pref..}articles_cat` ON article_cat_id=cat_id '
                       .'WHERE `article_url` != \'fscode\' ORDER BY `article_url` ASC');
    while ($row = mysql_fetch_assoc($result))
    {
      echo '<tr>'."\n"
          .'  <td class="config">'."\n"
          .'    <span style="float: left;">'.$row['article_title']."</span>\n"
          .'    <span style="float: right;">?go='.$row['article_url'].' (#'.$row['article_id'].")</span><br>\n"
          .'    <span class="small">';
      $first = true;
      if ($row['article_user']>0)
      {
        $sub_query = $FD->sql()->doQuery('SELECT user_name FROM `{..pref..}user`'
                    .'WHERE user_id = \''.$row['article_user'].'\' LIMIT 1');
        $sub_row = mysql_fetch_assoc($sub_query);
        echo 'von <b>'.$sub_row['user_name'].'</b>';
        $first = false;
      }
      if ($row['article_date']!=0)
      {
        if (!$first)
        {
          echo ',';
        }
        echo ' am <b>'.date('d.m.Y', $row['article_date']).'</b>';
        $first = false;
      }
      if (!$first)
      {
        echo ',';
      }
      echo ' in <b>'.$row['cat_name']."</b></span></td>\n";
      //checkbox
      echo '  <td class="config"><input class="select_box" type="checkbox" name="out_ids[]" value="'.$row['article_id'].'"';
      if (in_array($row['article_id'], $_POST['out_ids']))
      {
        echo ' checked="checked"';
      }
      echo '></td>'
          ."\n</tr>\n";
    }//while
    if ($ac==0)
    {
      echo '<tr>'."\n"
          .'  <td class="configthin" colspan="2">Keine nennenswerten Artikel vorhanden.<br>Das wird eine langweilige Sitemap!</td>'."\n"
          ."</tr>\n";
    }
    $human_type = (isset($_POST['sitemap_type']) && ($_POST['sitemap_type']=='human'));
    echo '<tr>'."\n"
        .'  <td class="configthin" colspan="2">'."\n"
        .'    <b>Gew&uuml;nschte Art der Sitemap:</b><br>'
        .'    <input class="pointer "type="radio" name="sitemap_type" value="xml"';
    if (!$human_type)
    {
      echo ' checked="checked"';
    }
    echo "> XML-Sitemap<br>\n"
        .'    <input class="pointer "type="radio" name="sitemap_type" value="human"';
    if ($human_type)
    {
      echo ' checked="checked"';
    }
    echo "> Verst&auml;ndliche Sitemap<br><br>\n"
        .'<input type="submit" value="Sitemap erstellen / aktualisieren">'
        ."  </td>\n</tr>\n"
        ."</table>\n</form>\n";
  }
} //ACP_GO
?>
