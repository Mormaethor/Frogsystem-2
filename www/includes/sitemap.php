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
//       - option to create a human-readable sitemap (i.e. not XML but (X)HTML)


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
  $raw_text = str_replace('&', '&amp;', $raw_text);
  //replace the rest
  return str_replace(array("'", '"', '>', '<'), array('&apos;', '&quot;', '&gt;', '&lt;'), $raw_text);
}//function

/* returns a string containing the content of a XML sitemap */
function sitemapXML()
{
  global $FD, $global_config_arr;
  //start with sitemap's content
  $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'."\n"
            .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
  //add main page first
  $v_host = $global_config_arr['virtualhost'];
  $sitemap .= '  <url>'."\n"
             .'    <loc>'.$v_host.'</loc>'."\n"
             .'    <changefreq>hourly</changefreq>'."\n"
             .'  </url>'."\n";
  //now the articles
  $query = mysql_query ('SELECT article_url FROM `'.$global_config_arr['pref'].'articles` '
                       .'WHERE `article_url` != \'fscode\' ORDER BY `article_url` ASC',
                      $FD->sql()->conn() );
  while ($row=mysql_fetch_assoc($query))
  {
    $sitemap .= '  <url>'."\n"
               .'    <loc>'.sitemapEntityEscape($v_host.'?go='.$row['article_url']).'</loc>'."\n"
               .'  </url>'."\n";
  }//while
  //end with closing urlset tag
  $sitemap .= '</urlset>';
  return $sitemap;
}//function

?>
