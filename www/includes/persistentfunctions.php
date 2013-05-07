<?php
/*
    Frogsystem Persistent Worlds Script functions
    Copyright (C) 2012  Thoronador

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

function getPersistentDLSizeAsString($dlsize)
{
  if ($dlsize>=0)
  {
    if ($dlsize<=25) return '0 bis 25 MB';
    if ($dlsize<=50) return '26 bis 50 MB';
    if ($dlsize<=100) return '51 bis 100 MB';
    if ($dlsize<=250) return '101 bis 250 MB';
    if ($dlsize<=500) return '251 bis 500 MB';
    return 'mehr als 500 MB';
  }//if
  return 'k. A.';
}//func

function getPersistentDMAsString($dm)
{
  if ($dm>0)
  {
    if ($dm<=10) return $dm;
    return '&gt; 10';
  }//if
  return 'k. A.';
}//func

function getPersistentDifficultyAsString($diff)
{
  if ($diff==0) return 'keine';
  if ($diff==1) return 'leicht';
  if ($diff==2) return 'mittel';
  if ($diff==3) return 'schwer';
  if ($diff==4) return 'uneinheitlich';
  return 'k. A.';
}

function getPersistentFrequencyAsString($diff)
{
  if ($diff==0) return 'keine';
  if ($diff==1) return 'selten';
  if ($diff==2) return 'normal';
  if ($diff==3) return 'oft';
  if ($diff==4) return 'uneinheitlich';
  return 'k. A.';
}

function getPersistentPvPAsString($pvp)
{
  if ($pvp==1) return 'ja';
  if ($pvp==2) return 'nach Absprache';
  if ($pvp==3) return 'nein';
  if ($pvp==4) return 'speziell';
  return 'k. A.';
}

function getPersistentUptimeAsString($uptime)
{
  if ($uptime==1) return 'st&auml;ndig';
  if ($uptime==2) return 'regelm&auml;&szlig;ig';
  if ($uptime==3) return 'unregelm&auml;&szlig;ig';
  return 'k. A.';
}

function getPersistentEXPCapAsString($exp)
{
  if ($exp==0) return 'nein';
  if ($exp==1) return 'ja';
  if ($exp==2) return 'speziell';
  return 'k. A.';
}

function getPersistentRegAsString($reg)
{
  if ($reg==0) return 'von Anfang an';
  if ($reg==1) return 'Level 1';
  if ($reg==2) return 'Level 2';
  if ($reg==3) return 'Level 3';
  if ($reg==4) return 'Level 4';
  if ($reg==5) return 'Level 5';
  if ($reg==6) return '&gt; Level 5';
  if ($reg==100) return 'speziell';
  if ($reg==127) return 'nie';
  return 'k. A.';
}
?>