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


// TODO: - allow exclusion of certain articles besides the fscode article
//       - add <lastmod> attributes (maybe after that modification thing is implemented)


/* replaces all special characters with their respective entity as described by
   the sitemap standard

   parameters:
       raw-text - the unescaped text

   returns:
       the escaped text
*/
function sitemapEntityEscape($raw_text)
{
  // '&' to '&amp;' goes first to avoid trouble with other escape sequences
  // $raw_text = str_replace('&', '&amp;', $raw_text);
  // no & escaping, url() function seems to do that for us
  //replace the rest
  return str_replace(array("'", '"', '>', '<'), array('&apos;', '&quot;', '&gt;', '&lt;'), $raw_text);
}//function

/* returns a string containing the content of a XML sitemap */
function sitemapXML()
{
  global $FD;
  //start with sitemap's content
  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
  //add main page first
  $v_host = sitemapEntityEscape($FD->cfg('virtualhost'));
  $sitemap .= '  <url>'."\n"
             .'    <loc>'.$v_host.'</loc>'."\n"
             .'    <changefreq>hourly</changefreq>'."\n"
             .'  </url>'."\n";
  //If main page is not the standard (news), then add the news page.
  if (($FD->cfg('home')==1) && ($FD->cfg('home_text')!='news'))
  {
    $sitemap .= '  <url>'."\n"
             .'    <loc>'.sitemapEntityEscape(url('news', array(), true)).'</loc>'."\n"
             .'    <changefreq>hourly</changefreq>'."\n"
             .'  </url>'."\n";
  }
  //now the articles
  $query =  $FD->sql()->doQuery('SELECT article_url FROM `{..pref..}articles` '
                       .'WHERE `article_url` != \'fscode\' ORDER BY `article_url` ASC');
  while ($row=mysql_fetch_assoc($query))
  {
    $sitemap .= '  <url>'."\n"
               .'    <loc>'.sitemapEntityEscape(url($row['article_url'], array(), true)).'</loc>'."\n"
               .'  </url>'."\n";
  }//while
  //...and the downloads - open/public downloads only
  $query =  $FD->sql()->doQuery('SELECT dl_id FROM `{..pref..}dl` WHERE `dl_open`=1');
  while ($row=mysql_fetch_assoc($query))
  {
    $sitemap .= '  <url>'."\n"
               .'    <loc>'.sitemapEntityEscape(url('dlfile', array('id' => $row['dl_id']), true)).'</loc>'."\n"
               .'  </url>'."\n";
  }//while
  //...and the gallery categories - not sure about this one, search engines might not like it
  $query =  $FD->sql()->doQuery('SELECT cat_id FROM `{..pref..}screen_cat` WHERE `cat_visibility`=1');
  while ($row=mysql_fetch_assoc($query))
  {
    $sitemap .= '  <url>'."\n"
               .'    <loc>'.sitemapEntityEscape(url('gallery', array('catid' => $row['cat_id']), true)).'</loc>'."\n"
               .'  </url>'."\n";
  }//while
  //end with closing urlset tag
  $sitemap .= '</urlset>';
  return $sitemap;
}//function

/* returns a string containing the HTML code for a human-readable sitemap

   parameters:
       full - (bool) if set to true, the code contains the full URLs, otherwise
              URLs are relative
*/
function sitemapHumanReadable($full)
{
  global $FD;
  settype($full, 'boolean');

  $v_host = $FD->cfg('virtualhost');
  //start with list
  $sitemap = '<ul>'."\n";
  //home comes first
  $sitemap .= '  <li><a href="'.$v_host.'">Hauptseite</a></li>'."\n";
  //news page next (we list it anyway, although it might be the same as the main page in most cases)
  $sitemap .= '  <li><a href="'.url('news', array(), $full).'">Hauptseite</a></li>'."\n";
  //articles
  $sitemap .= '  <li><strong>Artikel</strong>'."\n"
             .'    <ul>'."\n";
  $query =  $FD->sql()->doQuery('SELECT article_url, article_title, article_cat_id, cat_id, cat_name FROM `{..pref..}articles` '
                       .'LEFT JOIN `{..pref..}articles_cat` ON article_cat_id=cat_id '
                       .'WHERE `article_url` != \'fscode\' ORDER BY `cat_name` ASC, `article_url` ASC');
  $last_cat = -1;
  $cat_open = false;
  while ($row=mysql_fetch_assoc($query))
  {
    //new category started?
    if ($last_cat!=$row['cat_id'])
    {
      //Do we need to end a previous category?
      if ($cat_open)
      {
        $sitemap .= '        </ul>'."\n"
                   .'      </li>'."\n";
      }
      //start new category
      $sitemap .= '      <li><strong>Kategorie: '.$row['cat_name'].'</strong>'."\n"
                 .'        <ul>'."\n";
      $cat_open = true;
      $last_cat = $row['cat_id'];
    }
    //next article
    $sitemap .= '          <li><a href="'.url($row['article_url'], array(), $full).'">'.$row['article_title'].'</a></li>'."\n";
  }//while
  //Do we need to end a previous category?
  if ($cat_open)
  {
    $sitemap .= "        </ul>\n      </li>\n";
  }
  //close <ul> and <li> tag for articles
  $sitemap .= "    </ul>\n  </li>\n";

  //downloads
  $sitemap .= '  <li><strong>Downloads</strong>'."\n"
             .'    <ul>'."\n";
  $query =  $FD->sql()->doQuery('SELECT dl_id, `{..pref..}dl`.cat_id AS cat_id, dl_name, `{..pref..}dl_cat`.cat_id, cat_name FROM `{..pref..}dl` '
                       .'LEFT JOIN `{..pref..}dl_cat` ON `{..pref..}dl`.cat_id=`{..pref..}dl_cat`.cat_id '
                       .'WHERE `dl_open`=1 ORDER BY `cat_name` ASC, `dl_name` ASC');
  $last_cat = -1;
  $cat_open = false;
  while ($row=mysql_fetch_assoc($query))
  {
    //new dl category started?
    if ($last_cat!=$row['cat_id'])
    {
      //Do we need to end a previous category?
      if ($cat_open)
      {
        $sitemap .= '        </ul>'."\n"
                   .'      </li>'."\n";
      }
      //start new category
      $sitemap .= '      <li><a href="'.url('download', array('cat_id' => $row['cat_id']), $full).'"><strong>Kategorie: '.$row['cat_name'].'</strong></a>'."\n"
                 .'        <ul>'."\n";
      $cat_open = true;
      $last_cat = $row['cat_id'];
    }
    //next download
    $sitemap .= '          <li><a href="'.url('dlfile', array('id' => $row['dl_id']), $full).'">'.$row['dl_name'].'</a></li>'."\n";
  }//while
  //Do we need to end a previous category?
  if ($cat_open)
  {
    $sitemap .= "        </ul>\n      </li>\n";
    $cat_open = false;
  }
  //close <ul> and <li> tag for downloads
  $sitemap .= "    </ul>\n  </li>\n";

  //screenshots
  $sitemap .= '  <li><a href="'.url('gallery', array(), $full).'"><strong>Screenshots</strong></a>'."\n"
             .'    <ul>'."\n";
  $query =  $FD->sql()->doQuery('SELECT cat_id, cat_name FROM `{..pref..}screen_cat` '
                       .'WHERE `cat_visibility`=1 ORDER BY `cat_name` ASC');
  while ($row=mysql_fetch_assoc($query))
  {
    //next gallery category
    $sitemap .= '      <li><a href="'.url('gallery', array('catid' => $row['cat_id']), $full).'">'.$row['cat_name'].'</a></li>'."\n";
  }//while
  //close <ul> and <li> tag for screenshots
  $sitemap .= "    </ul>\n  </li>\n";

  //end with closing list tag
  $sitemap .= '</ul>';
  return $sitemap;
}//function

?>
