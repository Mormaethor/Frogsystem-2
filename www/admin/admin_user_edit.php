<?php
///////////////////
//// Functions ////
///////////////////

function user_name_free_or_itself ( $USERNAME, $USER_ID ) {
    global $FD;

    $USER_ID = savesql ( $USER_ID );
    $USERNAME = savesql ( $USERNAME );
    $index = mysql_query ( '
                            SELECT `user_id`
                            FROM `'.$FD->config('pref')."user`
                            WHERE `user_name` = '".$USERNAME."'
                            LIMIT 0,1
    ", $FD->sql()->conn() );
    if ( mysql_num_rows ( $index ) > 0 && $USER_ID != mysql_result ( $index, 0, 'user_id' ) ) {
        return FALSE;
    } else {
        return TRUE;
    }
}

/////////////////////
//// Load Config ////
/////////////////////
$index = mysql_query ( 'SELECT * FROM '.$FD->config('pref')."user_config WHERE `id` = '1'", $FD->sql()->conn() );
$config_arr = mysql_fetch_assoc ( $index );


/////////////////////
//// update user ////
/////////////////////

if (

        isset ( $_POST['sended'] ) && $_POST['sended'] == 'edit'
        && isset ( $_POST['user_action'] ) && $_POST['user_action'] == 'edit'
        && isset ( $_POST['user_id'] ) && $_POST['user_id'] != 1 && $_POST['user_id'] != $_SESSION['user_id']

        && $_POST['user_name'] && $_POST['user_name'] != '' && user_name_free_or_itself ( $_POST['user_name'], $_POST['user_id'] ) == TRUE
        && $_POST['user_mail'] && $_POST['user_mail'] != ''
        && ( ( (
            ( $_POST['newpwd'] && $_POST['newpwd'] != '' && $_POST['wdhpwd'] && $_POST['wdhpwd'] != '' && $_POST['newpwd'] == $_POST['wdhpwd'] )
            || $_POST['gen_password'] == 1
        ) && $_POST['new_password'] == 1 ) || $_POST['new_password'] == 0 )
        && $_POST['d'] && $_POST['d'] > 0 && $_POST['d'] <= 31
        && $_POST['m'] && $_POST['m'] > 0 && $_POST['m'] <= 12
        && $_POST['y'] && $_POST['y'] >= 0
    )
{
    // security functions
    $_POST['user_id'] = savesql ( $_POST['user_id'] );
    $_POST['user_name'] = savesql ( $_POST['user_name'] );
    $_POST['user_mail'] = savesql ( $_POST['user_mail'] );
    $_POST['user_homepage'] = savesql ( $_POST['user_homepage'] );
    $_POST['user_icq'] = savesql ( $_POST['user_icq'] );
    $_POST['user_aim'] = savesql ( $_POST['user_aim'] );
    $_POST['user_wlm'] = savesql ( $_POST['user_wlm'] );
    $_POST['user_yim'] = savesql ( $_POST['user_yim'] );
    $_POST['user_skype'] = savesql ( $_POST['user_skype'] );

    settype ( $_POST['gen_password'], 'integer' );
    settype ( $_POST['user_is_staff'], 'integer' );
    settype ( $_POST['user_show_mail'], 'integer' );

    // get other data
    $date_arr = getsavedate ( $_POST['d'], $_POST['m'], $_POST['y'], 0, 0, 0 );
    $user_date = mktime ( 0, 0, 0, $date_arr['m'], $date_arr['d'], $date_arr['y'] );

    if ( $_POST['user_group'] == 'admin' && $_POST['user_is_staff'] == 1 ) {
        $_POST['user_group'] = 0;
        $_POST['user_is_admin'] = 1;
    } else {
        $_POST['user_is_admin'] = 0;
    }
    settype($_POST['user_group'], 'integer');

    if ( $_POST['user_is_staff'] == 0 ) {
        $_POST['user_group'] = 0;
        $_POST['user_is_admin'] = 0;
    }

    if ( $_POST['user_homepage'] == 'http://' ) {
        $_POST['user_homepage'] = '';
    }

    if ( $_POST['new_password'] == 1 && $_POST['gen_password'] == 1 ) {
        $_POST['newpwd'] = generate_pwd ( 15 );
    }
    $user_salt = generate_pwd ( 10 );
    $pw_update = "
                        `user_password` = '".md5 ( $_POST['newpwd'].$user_salt )."',
                        `user_salt` = '".$user_salt."',
    ";
    if ( $_POST['new_password'] != 1 ) {
        $pw_update = '';
    }

    $index = mysql_query ( '
                            SELECT `user_is_staff`, `user_is_admin`
                            FROM '.$FD->config('pref')."user
                            WHERE `user_id` = '".$_POST['user_id']."'
                            LIMIT 0,1
    ", $FD->sql()->conn() );
    $was_staff = mysql_result ( $index, 0, 'user_is_staff' );
    $was_admin = mysql_result ( $index, 0, 'user_is_admin' );

    // user is not longer in staff
    if ( $was_staff == 1 && $_POST['user_is_staff'] == 0 ) {
        mysql_query ('
                        DELETE
                        FROM '.$FD->config('pref')."user_permissions
                        WHERE `perm_for_group` = '0'
                        AND `x_id` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );
    }

    // MySQL-Queries
    mysql_query ( '
                    UPDATE `'.$FD->config('pref')."user`
                    SET
                        `user_name` = '".$_POST['user_name']."',
                        ".$pw_update."
                        `user_mail` = '".$_POST['user_mail']."',
                        `user_is_staff` = '".$_POST['user_is_staff']."',
                        `user_group` = '".$_POST['user_group']."',
                        `user_is_admin` = '".$_POST['user_is_admin']."',
                        `user_reg_date` = '".$user_date."',
                        `user_show_mail` = '".$_POST['user_show_mail']."',
                        `user_homepage` = '".$_POST['user_homepage']."',
                        `user_icq` = '".$_POST['user_icq']."',
                        `user_aim` = '".$_POST['user_aim']."',
                        `user_wlm` = '".$_POST['user_wlm']."',
                        `user_yim` = '".$_POST['user_yim']."',
                        `user_skype` = '".$_POST['user_skype']."'
                    WHERE `user_id` = '".$_POST['user_id']."'
    ", $FD->sql()->conn() );
    $message = $FD->text("admin", "changes_saved");

    // image operations
    if ( $_POST['user_pic_delete'] == 1 ) {
        if ( image_delete ( 'images/avatare/', $_POST['user_id'] ) ) {
        $message .= '<br>' . $FD->text("admin", "image_deleted");
      } else {
        $message .= '<br>' . $FD->text("admin", "image_not_deleted");
      }
    } elseif ( $_FILES['user_pic']['name'] != '' ) {
        $upload = upload_img ( $_FILES['user_pic'], 'images/avatare/', $_POST['user_id'], $config_arr['avatar_size']*1024, $config_arr['avatar_x'], $config_arr['avatar_y'] );
        $message .= '<br>' . upload_img_notice ( $upload );
    }

    if ( $_POST['new_password'] == 1 ) {
        // send email
        $mm = new MailManager();

        $content = get_email_template ('change_password');
        $content = str_replace ( '{..user_name..}', unslash ( $_POST['user_name'] ), $content );
        $content = str_replace ( '{..new_password..}', $_POST['newpwd'], $content );

        $subject = $FD->text('frontend', 'mail_password_changed_on') . $FD->cfg('virtualhost');

        $mail = new Mail($mm->getDefaultSender(), unslash($_POST['user_mail']), $subject, $content, $mm->getHtmlConfig(), true);

        if ($mail->send()) {
            $message .= '<br>'.$FD->text("frontend", "mail_new_password_sended");
        } else {
            $message .= '<br>'.$FD->text("frontend", "mail_new_password_not_sended");
        }
    }

    // Display Message
    systext ( $message, $FD->text("admin", "info") );

    // save Vars
    $filter = $_POST['filter'];

    // Unset Vars
    unset ( $_POST );

    // rewrite Vars
    $_POST['filter'] = $filter;
    $_POST['search'] = 1;
}

// delete user
elseif (
        isset ( $_POST['sended'] ) && $_POST['sended'] == 'delete'
        && isset ( $_POST['user_action'] ) && $_POST['user_action'] == 'delete'
        && isset ( $_POST['user_id'] ) && $_POST['user_id'] != 1 && $_POST['user_id'] != $_SESSION['user_id']
        && isset ( $_POST['user_delete'] )
    )
{
    if ( $_POST['user_delete'] == 1 ) {
        // Security-Functions
        settype ( $_POST['user_id'], 'integer' );

        // get data from db
        $index = mysql_query ( '
                                SELECT `user_name`
                                FROM '.$FD->config('pref')."user
                                WHERE `user_id` = '".$_POST['user_id']."'
                                LIMIT 0,1
        ", $FD->sql()->conn() );
        $user_arr = mysql_fetch_assoc ( $index );

        // Delete Permissions
        mysql_query ( '
                        DELETE
                        FROM '.$FD->config('pref')."user_permissions
                        WHERE `perm_for_group` = '0'
                        AND `x_id` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update stats
        mysql_query ( '
                        UPDATE '.$FD->config('pref').'counter
                        SET `user` = `user`-1
        ', $FD->sql()->conn() );

        // update groups
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."user_groups
                        SET `user_group_user` = '1'
                        WHERE `user_group_user` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update articles
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."articles
                        SET `article_user` = '0'
                        WHERE `article_user` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update articles_cat
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."articles_cat
                        SET `cat_user` = '1'
                        WHERE `cat_user` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update dl
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."dl
                        SET `user_id` = '1'
                        WHERE `user_id` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update news
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."news
                        SET `user_id` = '1'
                        WHERE `user_id` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update news_cat
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."news_cat
                        SET `cat_user` = '1'
                        WHERE `cat_user` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // update news_comments
        mysql_query ( '
                        UPDATE '.$FD->config('pref')."news_comments
                        SET `comment_poster_id` = '0',
                            `comment_poster` = '".$user_arr['user_name']."'
                        WHERE `comment_poster_id` = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );

        // MySQL-Delete-Query
        mysql_query ('
                        DELETE FROM '.$FD->config('pref')."user
                         WHERE user_id = '".$_POST['user_id']."'
        ", $FD->sql()->conn() );
        $message = 'Benutzer wurde erfolgreich gel&ouml;scht';

        // Delete Image
        if ( image_delete ( 'images/avatare/', $_POST['user_id'] ) ) {
            $message .= '<br>' . $FD->text("admin", "image_deleted");
        }
    } else {
        $message = 'Benutzer wurde nicht gel&ouml;scht';
    }

    // Display Message
    systext ( $message, $FD->text("admin", "info") );

    // save Vars
    $filter = $_POST['filter'];

    // Unset Vars
    unset ( $_POST );

    // rewrite Vars
    $_POST['filter'] = $filter;
    $_POST['search'] = 1;
}



//////////////////////
//// Display Form ////
//////////////////////

if (  isset ( $_POST['user_id'] ) && $_POST['user_action'] )
{
    // security functions
    settype ( $_POST['user_id'], 'integer' );

    // Edit user
    if ( $_POST['user_action'] == 'edit' )
    {


        // Display Error Messages
        if ( $_POST['sended'] == 'edit' ) {
            if ( $_POST['user_id'] == 1 ) {
                $message[] = 'Der Super-Administrator kann nicht bearbeitet werden';
            }
            if ( $_POST['user_id'] == $_SESSION['user_id'] ) {
                $message[] = 'Sie k&ouml;nnen sich nicht selbst bearbeiten';
            }
            if ( user_name_free_or_itself ( $_POST['user_name'], $_POST['user_id'] ) == FALSE ) {
                $message[] = 'Der angegebene Benutzername existiert bereits';
            }
            if ( $_POST['newpwd'] != $_POST['wdhpwd'] && $_POST['gen_password'] != 1 && $_POST['new_password'] == 1 ) {
                $message[] = 'Das Passwort muss zweimal identisch eingegeben werden';
            }
            $message = implode ( '<br>', $message );
            if ( strlen ( $message ) == 0 ) {
                $message = $FD->text("admin", "note_notfilled");
            }
            systext ( $message, $FD->text("admin", "error"), TRUE );
        } else {
            $index = mysql_query ( '
                                    SELECT *
                                    FROM '.$FD->config('pref')."user
                                    WHERE `user_id` = '".$_POST['user_id']."'
                                    LIMIT 0,1
            ", $FD->sql()->conn() );
            $user_arr = mysql_fetch_assoc ( $index );
            putintopost ( $user_arr );
            $_POST['d'] = date ( 'd', $_POST['user_reg_date'] );
            $_POST['m'] = date ( 'm', $_POST['user_reg_date'] );
            $_POST['y'] = date ( 'Y', $_POST['user_reg_date'] );
            $_POST['new_password'] = 0;
            $_POST['gen_password'] = 1;
            if ( $_POST['user_homepage'] == '' ) {
                $_POST['user_homepage'] = 'http://';
            }
            if ( $user_arr['user_is_admin'] == 1 ) {
                $_POST['user_group'] = 'admin';
            }
        }

        // get other data
        if ( $_POST['user_is_staff'] == 1 ) {
            $display_arr['group_tr'] = 'default';
        } else {
            $display_arr['group_tr'] = 'hidden';
        }

        if ( $_POST['new_password'] == 1 ) {
            $display_arr['pwd_tr'] = 'default';
            $display_arr['pwd_gen_tr'] = 'default';
        } else {
            $display_arr['pwd_tr'] = 'hidden';
            $display_arr['pwd_gen_tr'] = 'hidden';
        }

        if ( $_POST['gen_password'] == 1 ) {
            $display_arr['pwd_tr'] = 'hidden';
        } else {
            $display_arr['pwd_tr'] = 'default';
        }

        // security functions
        $_POST['user_name'] = killhtml ( $_POST['user_name'] );
        $_POST['user_mail'] = killhtml ( $_POST['user_mail'] );
        $_POST['newpwd'] = killhtml ( $_POST['newpwd'] );
        $_POST['wdhpwd'] = killhtml ( $_POST['wdhpwd'] );
        $_POST['user_homepage'] = killhtml ( $_POST['user_homepage'] );
        $_POST['user_icq'] = killhtml ( $_POST['user_icq'] );
        $_POST['user_aim'] = killhtml ( $_POST['user_aim'] );
        $_POST['user_wlm'] = killhtml ( $_POST['user_wlm'] );
        $_POST['user_yim'] = killhtml ( $_POST['user_yim'] );
        $_POST['user_skype'] = killhtml ( $_POST['user_skype'] );

        settype ( $_POST['gen_password'], 'integer' );
        settype ( $_POST['user_is_staff'], 'integer' );
        if ( $_POST['user_group'] != 'admin' ) {
            settype ( $_POST['user_group'], 'integer' );
        }
        settype ( $_POST['user_show_mail'], 'integer' );

        // filter
        $_POST['filter'] = savesql ( $_POST['filter'] );

        // get oterh data
        $date_arr = getsavedate ( $_POST['d'], $_POST['m'], $_POST['y'], 0, 0, 0, TRUE );
        $nowbutton_array = array( 'd', 'm', 'y' );

        // Display Form
        echo '
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="go" value="user_edit">
                        <input type="hidden" name="user_action" value="edit">
                        <input type="hidden" name="sended" value="edit">
                        <input type="hidden" name="user_id" value="'.$_POST['user_id'].'">
                        <input type="hidden" name="filter" value="'.$_POST['filter'].'">
                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr><td class="line" colspan="2">Hauptinformationen</td></tr>
                            <tr>
                                <td class="config">
                                    Benutzername:<br>
                                    <span class="small">Das Pseudonym des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="30" maxlength="100" name="user_name" value="'.$_POST['user_name'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    E-Mail:<br>
                                    <span class="small">E-Mail-Adresse, an die das Passwort gesendet wird.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="30" maxlength="100" name="user_mail" value="'.$_POST['user_mail'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Registrierdatum:<br>
                                    <span class="small">Datum, an dem der Benutzer registriert wurde.</span>
                                </td>
                                <td class="config">
                                    <span class="small">
                                        <input class="text" size="3" maxlength="2" id="d" name="d" value="'.$date_arr['d'].'"> .
                                        <input class="text" size="3" maxlength="2" id="m" name="m" value="'.$date_arr['m'].'"> .
                                        <input class="text" size="5" maxlength="4" id="y" name="y" value="'.$date_arr['y'].'">&nbsp;
                                    </span>
                                    '.js_nowbutton ( $nowbutton_array, $FD->text("admin", "today") ).'
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Neues Passwort:<br>
                                    <span class="small">Erstellt ein neues Passwort f&uuml;r den Benutzer.</span>
                                </td>
                                <td class="config">
                                    <input class="pointer" type="checkbox" name="new_password" value="1" '.getchecked( $_POST['new_password'], 1 ).'
                                        onChange="show_hidden(document.getElementById(\'genpwd_tr\'), this, true);
                                        show_hidden(document.getElementById(\'newpwd_tr\'), document.getElementById(\'genpwd\'), !(document.getElementById(\'genpwd\').checked) && !(this.checked));
                                        show_hidden(document.getElementById(\'wdhpwd_tr\'), document.getElementById(\'genpwd\'), !(document.getElementById(\'genpwd\').checked) && !(this.checked))"
                                    >
                                </td>
                            </tr>
                            <tr class="'.$display_arr['pwd_gen_tr'].'" id="genpwd_tr">
                                <td class="config">
                                    Passwort generieren:<br>
                                    <span class="small">Erstellt f&uuml;r den Benutzer ein zuf&auml;lliges Passwort.</span>
                                </td>
                                <td class="config">
                                    <input class="pointer" type="checkbox" name="gen_password" id="genpwd" value="1" '.getchecked( $_POST['gen_password'], 1 ).'
                                        onChange="show_hidden(document.getElementById(\'newpwd_tr\'), this, false);
                                        show_hidden(document.getElementById(\'wdhpwd_tr\'), this, false)"
                                    >
                                </td>
                            </tr>
                            <tr class="'.$display_arr['pwd_tr'].'" id="newpwd_tr">
                                <td class="config">
                                    Passwort:<br>
                                    <span class="small">Das Passwort des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" type="password" size="30" maxlength="100" name="newpwd" value="'.$_POST['newpwd'].'">
                                </td>
                            </tr>
                            <tr class="'.$display_arr['pwd_tr'].'" id="wdhpwd_tr">
                                <td class="config">
                                    Passwort wiederholen:<br>
                                    <span class="small">Sicherheits-Wiederholung des Passworts.</span>
                                </td>
                                <td class="config">
                                    <input class="text" type="password" size="30" maxlength="100" name="wdhpwd" value="'.$_POST['wdhpwd'].'">
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr><td class="line" colspan="2">Zus&auml;tzliche Einstellungen</td></tr>
                            <tr align="left" valign="top">
                                <td class="config">
                                    Benutzer-Bild: <span class="small">(optional)</span>
        ';
        if ( image_exists ( 'images/avatare/', $_POST['user_id'] ) ) {
            echo '<br><br><img src="'.image_url( 'images/avatare/', $_POST['user_id'] ).'" alt="" border="0"><br><br>';
        }
        echo '
                                </td>
                                <td class="config">
                                    <input class="text" name="user_pic" type="file" size="35"><br>
                                    <span class="small">['.$FD->text("admin", "max").' '.$config_arr['avatar_x'].' '.$FD->text("admin", "resolution_x").' '.$config_arr['avatar_y'].' '.$FD->text("admin", "pixel").'] ['.$FD->text("admin", "max").' '.$config_arr['avatar_size'].' '.$FD->text("admin", "kib").']</span>
        ';
        if ( image_exists ( 'images/avatare/', $_POST['user_id'] ) ) {
            echo '
                                    <br>
                                    <span class="small"><b>Nur ausw&auml;hlen, wenn das bisherige Bild &uuml;berschrieben werden soll!</b></span><br><br>
                                    <input class="pointer middle" type="checkbox" name="user_pic_delete" id="upd" value="1"
                                        onClick=\'delalert ("upd", "Soll das aktuelle Benutzer-Bild wirklich gel�scht werden?")\'
                                    >
                                    <span class="small middle"><b>Bild l&ouml;schen?</b></span><br><br>
            ';
        }
        echo '
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Mitarbeiter:<br>
                                    <span class="small">Benutzer arbeitet an der Seite mit.</span>
                                </td>
                                <td class="config">
                                    <input class="pointer" type="checkbox" name="user_is_staff" value="1" '.getchecked ( $_POST['user_is_staff'], 1 ).'
                                        onChange="show_hidden(document.getElementById(\'group_tr\'), this, true)"
                                    >
                                </td>
                            </tr>
                            <tr class="'.$display_arr['group_tr'].'" id="group_tr">
                                <td class="config">
                                    Gruppe:<br>
                                    <span class="small">Gruppe, der der Benutzer angeh&ouml;rt.</span>
                                </td>
                                <td class="config">
                                    <select name="user_group" size="1">
                                        <option value="0"'.getselected ( $_POST['user_group'], 0 ).'>keine Gruppe</option>
        ';

        $index = mysql_query ('
                                SELECT `user_group_id`, `user_group_name`
                                FROM '.$FD->config('pref')."user_groups
                                WHERE `user_group_id` > 0
                                ORDER BY `user_group_name`
        ", $FD->sql()->conn() );

        while ( $group_arr = mysql_fetch_assoc( $index ) ) {
            echo '<option value="'.$group_arr['user_group_id'].'" '.getselected ( $_POST['user_group'], $group_arr['user_group_id'] ).'>
                '.$group_arr['user_group_name'].'</option>';
        }

        $index = mysql_query ('
                                SELECT `user_group_id`, `user_group_name`
                                FROM '.$FD->config('pref').'user_groups
                                WHERE `user_group_id` = 0
                                ORDER BY `user_group_name`
                                LIMIT 0,1
        ', $FD->sql()->conn() );
        $group_arr = mysql_fetch_assoc( $index );
        echo '<option value="admin" '.getselected ( $_POST['user_group'], 'admin' ).'>'.$group_arr['user_group_name'].' (alle Rechte)</option>';

        echo '
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    E-Mail anzeigen:<br>
                                    <span class="small">E-Mail-Adresse im Profil anzeigen.</span>
                                </td>
                                <td class="config">
                                  <input class="pointer" type="checkbox" name="user_show_mail" value="1" '.getchecked ( $_POST['user_show_mail'], 1 ).'>
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr><td class="line" colspan="2">Kontaktinformationen</td></tr>
                            <tr>
                                <td class="config">
                                    Homepage: <span class="small">(optional)</span><br>
                                    <span class="small">Homepage des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="30" maxlength="100" name="user_homepage" value="'.$_POST['user_homepage'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    ICQ: <span class="small">(optional)</span><br>
                                    <span class="small">ICQ-Nummer des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="20" maxlength="50" name="user_icq" value="'.$_POST['user_icq'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    AOL Instant Messenger: <span class="small">(optional)</span><br>
                                    <span class="small">AIM-Name des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="20" maxlength="50" name="user_aim" value="'.$_POST['user_aim'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Windows Live Messenger: <span class="small">(optional)</span><br>
                                    <span class="small">Windows Live E-Mail-Adresse des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="20" maxlength="50" name="user_wlm" value="'.$_POST['user_wlm'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Yahoo! Messenger: <span class="small">(optional)</span><br>
                                    <span class="small">Y!M-Username des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="20" maxlength="50" name="user_yim" value="'.$_POST['user_yim'].'">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    Skype: <span class="small">(optional)</span><br>
                                    <span class="small">Skype-ID des Benutzers.</span>
                                </td>
                                <td class="config">
                                    <input class="text" size="20" maxlength="50" name="user_skype" value="'.$_POST['user_skype'].'">
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="buttontd" colspan="2">
                                    <button class="button_new" type="submit">
                                        '.$FD->text("admin", "button_arrow").' '.$FD->text("admin", "save_long").'
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
        ';

    // Delete User
    } elseif ( $_POST['user_action'] == 'delete' && $_POST['user_id'] != 1  && $_POST['user_id'] != $_SESSION['user_id'] ) {
        // get data from db
        $index = mysql_query ( '
                                SELECT `user_name`
                                FROM '.$FD->config('pref')."user
                                WHERE `user_id` = '".$_POST['user_id']."'
                                LIMIT 0,1
        ", $FD->sql()->conn() );
        $user_arr = mysql_fetch_assoc ( $index );

        // security functions
        $user_arr['user_name'] = killhtml ( $user_arr['user_name'] );
        $_POST['filter'] = savesql ( $_POST['filter'] );

        echo '
                    <form action="" method="post">
                        <input type="hidden" name="go" value="user_edit">
                        <input type="hidden" name="user_action" value="delete">
                        <input type="hidden" name="sended" value="delete">
                        <input type="hidden" name="user_id" value="'.$_POST['user_id'].'">
                        <input type="hidden" name="filter" value="'.$_POST['filter'].'">
                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr><td class="line" colspan="2">Benutzer l&ouml;schen</td></tr>
                            <tr>
                                <td class="configthin">
                                    Soll der Benutzer wirklich gel&ouml;scht werden: <b>'.$user_arr['user_name'].'</b>
                                </td>
                                <td class="config right top" style="padding: 0px;">
                                '.get_yesno_table ( 'user_delete' ).'
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="buttontd" colspan="2">
                                    <button class="button_new" type="submit">
                                        '.$FD->text("admin", "button_arrow").' '.$FD->text("admin", "do_button_long").'
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
        ';
    }
}



////////////////////////////
////// User ausw�hlen //////
////////////////////////////

if ( !isset ( $_POST['user_id'] ) )
{
    // dislplay search form
    echo '
                    <form action="" method="post">
                        <input type="hidden" name="go" value="user_edit">
                        <input type="hidden" name="search" value="1">
                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr><td class="line" colspan="2">Benutzer suchen</td></tr>
                            <tr>
                                <td class="config">
                                    Name oder E-Mail-Adresse enth&auml;lt:
                                </td>
                                <td class="config right">
                                    <input class="text" size="50" name="filter" value="'.killhtml ( $_POST['filter'] ).'">
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="buttontd" colspan="2">
                                    <button class="button_new" type="submit">
                                        '.$FD->text("admin", "button_arrow").' '."Nach Benutzern suchen".'
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form>
    ';

    if ( isset ( $_POST['search'] ) ) {
        //security functions
        $_POST['filter'] = savesql ( $_POST['filter'] );

        // start display
        echo '
                    <form action="" method="post">
                        <input type="hidden" name="go" value="user_edit">
                        <input type="hidden" name="filter" value="'.$_POST['filter'].'">
                        <input type="hidden" name="search" value="1">
                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr><td class="space"></td></tr>
                            <tr><td class="space"></td></tr>
                            <tr><td class="line" colspan="5">Benutzer ausw&auml;hlen</td></tr>
        ';

        // get users from db
        $index = mysql_query ( '
                                SELECT `user_id`, `user_name`, `user_mail`, `user_is_staff`, `user_is_admin`
                                FROM '.$FD->config('pref')."user
                                WHERE ( `user_name` LIKE '%".$_POST['filter']."%' OR `user_mail` LIKE '%".$_POST['filter']."%' )
                                AND `user_id` != '".$_SESSION['user_id']."'
                                AND `user_id` != '1'
                                  ORDER BY user_name
        ", $FD->sql()->conn() );

        // users found
        if ( mysql_num_rows ( $index ) > 0 ) {
            // display table head
            echo '
                            <tr>
                                <td class="config">Name</td>
                                <td class="config">E-Mail</td>
                                <td class="config" width="20">&nbsp;&nbsp;Mitarbeiter&nbsp;&nbsp;</td>
                                <td class="config" width="20">&nbsp;&nbsp;Administrator&nbsp;&nbsp;</td>
                                <td class="config" width="20"></td>
                            </tr>
            ';

            // display users
            while ( $user_arr = mysql_fetch_assoc ( $index ) ) {

                // get other data
                if ( $user_arr['user_is_staff'] == 1 ) {
                    $user_arr['staff_text'] = 'Ja';
                } else {
                    $user_arr['staff_text'] = 'Nein';
                }

                if ( $user_arr['user_is_admin'] == 1 ) {
                    $user_arr['admin_text'] = 'Ja';
                } else {
                    $user_arr['admin_text'] = 'Nein';
                }

                if ( $_POST['filter'] != '' ) {
                    $user_arr['user_name'] = highlight ($_POST['filter'], killhtml($user_arr['user_name']));
                    $user_arr['user_mail'] = highlight ($_POST['filter'], killhtml($user_arr['user_mail']));
                } else {
                    $user_arr['user_name'] = killhtml ( $user_arr['user_name'] );
                    $user_arr['user_mail'] = killhtml ( $user_arr['user_mail'] );
                }

                echo '
                            <tr class="pointer" id="tr_'.$user_arr['user_id'].'"
                                onmouseover="'.color_list_entry ( 'input_'.$user_arr['user_id'], '#EEEEEE', '#64DC6A', 'this' ).'"
                                onmouseout="'.color_list_entry ( 'input_'.$user_arr['user_id'], 'transparent', '#49c24f', 'this' ).'"
                                onclick="'.color_click_entry ( 'input_'.$user_arr['user_id'], '#EEEEEE', '#64DC6A', 'this', TRUE ).'"
                            >
                                <td class="configthin middle">'.$user_arr['user_name'].'</td>
                                <td class="configthin middle">'.$user_arr['user_mail'].'</td>
                                <td class="configthin middle center">'.killhtml($user_arr['staff_text']).'</td>
                                <td class="configthin middle center">'.killhtml($user_arr['admin_text']).'</td>
                                <td class="config top center">
                                    <input class="pointer" type="radio" name="user_id" id="input_'.$user_arr['user_id'].'" value="'.$user_arr['user_id'].'"
                                                    onclick="'.color_click_entry ( 'this', '#EEEEEE', '#64DC6A', 'tr_'.$user_arr['user_id'], TRUE ).'"
                                </td>
                            </tr>
                ';
            }

            // display footer with button
            echo'
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="right" colspan="5">
                                    <select name="user_action" size="1">
                                        <option value="edit">'.$FD->text("admin", "selection_edit").'</option>
                                        <option value="delete">'.$FD->text("admin", "selection_del").'</option>
                                    </select>
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="buttontd" colspan="5">
                                    <button class="button_new" type="submit">
                                        '.$FD->text("admin", "button_arrow").' '.$FD->text("admin", "do_button_long").'
                                    </button>
                                </td>
                            </tr>
            ';

        // no users found
        } else {

            echo'
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="config center" colspan="5">Keine Benutzer gefunden!</td>
                            </tr>
                            <tr><td class="space"></td></tr>
            ';
        }
        echo '
                        </table>
                    </form>
        ';
    }
}
?>
