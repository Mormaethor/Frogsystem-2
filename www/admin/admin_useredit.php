<?php

////////////////////////////
//// User aktualisieren ////
////////////////////////////

if ($_POST[ueusername] && $_POST[ueusermail])
{
    $_POST[username] = savesql($_POST[username]);
    $_POST[usermail] = savesql($_POST[usermail]);
    settype($_POST[ueuserid], 'integer');
    settype($_POST[isadmin], 'integer');
    settype($_POST[showmail], 'integer');

    $regdate = mktime(0, 0, 0, $_POST[tag], $_POST[monat], $_POST[jahr]);
    $_POST[showmail] = ($_POST[showmail] == 1) ? 1 : 0;
 
    // Username schon vorhanden?
    $index = mysql_query("SELECT user_id FROM fs_user WHERE user_name = '$_POST[ueusername]'", $db);
    $rows = mysql_num_rows($index);
    $dbexistid = mysql_result($index, 0, "user_id");

    // Neuer name noch nicht vorhanden, oder gleicher User
    if (($dbexistid == $_POST[ueuserid]) || ($rows == 0))
    {
        if (!isset($_POST[deluser]))
        {
            $_POST[isadmin] = isset($_POST[isadmin]) ? 1 : 0;
            $index = mysql_query("select is_admin from fs_user where user_id = '$_POST[ueuserid]'", $db);
            $dbisadmin = mysql_result($index, 0, "is_admin");

            // Wenn vorher kein Admin, jetzt aber wohl
            if (($_POST[isadmin] == 1) && ($dbisadmin == 0))
            {
                mysql_query("INSERT INTO fs_permissions (user_id)
                             VALUES (".$_POST[ueuserid].")", $db);
            }

            // Wenn vorher Admin, jetzt aber nicht mehr
            if (($_POST[isadmin] == 0) && ($dbisadmin == 1))
            {
                $dbaction = "delete from fs_permissions where user_id = ".$_POST[ueuserid];
                mysql_query($dbaction, $db);
            }

            // Neues Passwort?
            if ($_POST[newpass] != "")
            {
                $ueuserpass = md5($_POST[newpass]);
            }
            else
            {
                $ueuserpass = savesql($_POST[oldpass]);
            }

            $update = "UPDATE fs_user
                       SET user_name     = '$_POST[ueusername]',
                           user_mail     = '$_POST[ueusermail]',
                           user_password = '$ueuserpass',
                           is_admin      = '$_POST[isadmin]',
                           reg_date      = '$regdate',
                           show_mail     = '$_POST[showmail]'
                       WHERE user_id = $_POST[ueuserid]";
            mysql_query($update, $db);

            systext('User wurde ge�ndert');
        } 
        else  // User l�schen
        {
            $dbaction = "delete from fs_permissions where user_id = ".$_POST[ueuserid];
            @mysql_query($dbaction, $db);

            $dbaction = "delete from fs_user where user_id = ".$_POST[ueuserid];
            mysql_query($dbaction, $db);

            mysql_query("update fs_counter set user=user-1", $db);
            systext('User wurde gel�scht');
        }
    }
    else
    {
        systext("Username existiert bereits");
    }
}

////////////////////////////
////// User editieren //////
////////////////////////////

elseif (isset($_POST[euuserid]))
{
    settype($_POST[euuserid], 'integer');
    $index = mysql_query("select * from fs_user where user_id = $_POST[euuserid]", $db);
    $user_arr = mysql_fetch_assoc($index);

    $user_arr[is_admin] = ($user_arr[is_admin] == 1) ? "checked" : "";
    $user_arr[show_mail] = ($user_arr[show_mail] == 1) ? "checked" : "";

    echo'
                    <form action="'.$PHP_SELF.'" method="post">
                        <input type="hidden" value="useredit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <input type="hidden" value="'.$user_arr[user_password].'" name="oldpass">
                        <input type="hidden" value="'.$_POST[euuserid].'" name="ueuserid">
                        <table border="0" cellpadding="4" cellspacing="0" width="600">
                            <tr>
                                <td class="config" valign="top" width="50%">
                                    Name:<br>
                                    <font class="small">Name des Users</font>
                                </td>
                                <td class="config" width="50%" valign="top">
                                    <input class="text" size="30" name="ueusername" value="'.$user_arr[user_name].'" maxlength="100">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    E-Mail:<br>
                                    <font class="small">E-Mail Adresse, an die das Passwort gesendet wird</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" size="30" name="ueusermail" value="'.$user_arr[user_mail].'" maxlength="100">
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Passwort:<br>
                                    <font class="small">Neus Passwort eingeben um das alte zu �ndern</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" type="password" size="30" name="newpass" maxlength="16">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Admin Account:<br>
                                    <font class="small">Erzeugt oder degradiert einen Admin Account</font>
                                </td>
                                <td class="config">
                                    <input type="checkbox" name="isadmin" value="1" '.$user_arr[is_admin].'>
                                </td>
                            </tr>
                            <tr>
                                <td class="config" valign="top">
                                    Datum:<br>
                                    <font class="small">Registriert seit</font>
                                </td>
                                <td class="config" valign="top">
                                    <input class="text" size="2" value="'.date("d",$user_arr[reg_date]).'" name="tag" maxlength="2">
                                    <input class="text" size="2" value="'.date("m",$user_arr[reg_date]).'" name="monat" maxlength="2">
                                    <input class="text" size="4" value="'.date("Y",$user_arr[reg_date]).'" name="jahr" maxlength="4">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Zeige Email:<br>
                                    <font class="small">Zeigt die Email Adresse �ffentlich</font>
                                </td>
                                <td class="config">
                                    <input type="checkbox" name="showmail" value="1" '.$user_arr[show_mail].'>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    User l�schen:<br>
                                    <font class="status"><b>ACHTUNG!</b> kann nicht r�ckg�ngig gemacht werden</font>
                                </td>
                                <td class="config">
                                    <input onClick="alert(this.value)" type="checkbox" name="deluser" value="Sicher?">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" class="button" value="Absenden">
                                </td>
                            </tr>
                        </table>
                    </form>
    ';
}

////////////////////////////
////// User ausw�hlen //////
////////////////////////////

else
{
    echo'
                    <form action="'.$PHP_SELF.'" method="post">
                        <input type="hidden" value="useredit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td align="center" class="config" width="50%">
                                    User Suchen:
                                </td>
                                <td align="center" class="configthin" width="50%">
                                    <input class="text" name="filter" size="30">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input class="button" type="submit" value="Suchen">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <p>
    ';

    if (isset($_POST[filter]))
    {
        echo'
                    <form action="'.$PHP_SELF.'" method="post">
                        <input type="hidden" value="useredit" name="go">
                        <input type="hidden" value="'.session_id().'" name="PHPSESSID">
                        <table border="0" cellpadding="2" cellspacing="0" width="600">
                            <tr>
                                <td align="center" class="config" width="50%">
                                    Username
                                </td>
                                <td align="center" class="config" width="50%">
                                    bearbeiten
                                </td>
                            </tr>
        ';

        $_POST[filter] = savesql($_POST[filter]);
        $index = mysql_query("select * from fs_user where user_name like '%$_POST[filter]%' order by user_name", $db);
        while ($user_arr = mysql_fetch_assoc($index))
        {
            $user_arr[user_name] = killhtml($user_arr[user_name]);
            if ($user_arr[is_admin] == 1)
            {
                $user_arr[user_name] = '<b>' . $user_arr[user_name] . '</b>';
            }
            echo'
                            <tr>
                                <td class="configthin">
                                    '.$user_arr[user_name].'
                                </td>
                                <td class="config">
                                    <input type="radio" name="euuserid" value="'.$user_arr[user_id].'">
                                </td>
                            </tr>
            ';
        }
        echo'
                            <tr>
                                <td colspan="3">
                                    &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input class="button" type="submit" value="editieren">
                                </td>
                            </tr>
                        </table>
                    </form>
        ';
    }
}
?>