<?php
///////////////////////
//// DB Login Data ////
///////////////////////
$host = "localhost";                //Hostname
$user = "frogsystem";                //Database User
$data = "test";                //Database Name
$pass = "frogsystem";                //Password
$pref = "";                //Tabellenpr�fix

$file = TRUE;

////////////////////////
////// DB Connect //////
////////////////////////

@$db = mysql_connect($host, $user, $pass);
if ( $db !== FALSE )
{
    mysql_select_db($data,$db);
    unset($host);
    unset($user);
    unset($pass);
}
?>