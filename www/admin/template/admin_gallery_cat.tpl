<!--DEF::add-->                    <form action="" method="post">
                        <input type="hidden" name="go" value="<!--TEXT::ACP_GO-->">
                        <input type="hidden" name="cat_action" value="add">

                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr>
                                <td class="line" colspan="2">
                                    <!--LANG::viewer_title-->
                                </td>
                            </tr>
                            <tr>
                                <td class="config right_space">
                                    <span class="small">'.$admin_phrases[news][new_cat_name].':</span>
                                </td>
                                <td class="config">
                                    <span class="small">'.$admin_phrases[news][new_cat_image].': '.$admin_phrases[common][optional].'</span>
                                </td>
                            </tr>
                            <tr valign="top">
                                <td class="config">
                                    <input class="text" name="cat_name" size="40" maxlength="100" value="'.$_POST['cat_name'].'">
                                </td>
                                <td class="config">
                                    <input name="cat_pic" type="file" size="30" class="text"><br>
                                    <span class="small">
                                        ['.$admin_phrases[common][max].' '.$news_config_arr[cat_pic_x].' '.$admin_phrases[common][resolution_x].' '.$news_config_arr[cat_pic_y].' '.$admin_phrases[common][pixel].'] ['.$admin_phrases[common][max].' '.$news_config_arr[cat_pic_size].' '.$admin_phrases[common][kib].']
                                    </span>
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            <tr>
                                <td class="buttontd" colspan="2">
                                    <button type="submit" name="sended" value="1" class="button_new">
                                        <!--COMMON::button_arrow-->
                                        <!--COMMON::save_changes_button-->
                                    </button>
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                        </table>
                    </form><!--ENDDEF-->

<!--DEF::edit-->                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="go" value="<!--TEXT::ACP_GO-->">
                        <input type="hidden" name="cat_action" value="edit">
                        <input type="hidden" name="cat_id" value="<!--TEXT::cat_id-->">

                        <table class="configtable" cellpadding="4" cellspacing="0">
                            <tr>
                                <td class="line" colspan="2">
                                    <!--LANG::main_settings-->
                                </td>
                            </tr>
                            <tr>
                                <td class="config right_space">
                                    <!--LANG::name-->:<br>
                                    <span class="small"><!--LANG::name_desc--></span>
                                </td>
                                <td>
                                    <input class="text" name="cat_name" size="40" maxlength="100" value="<!--TEXT::cat_name-->">
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    <!--LANG::subcat-->:<br>
                                    <span class="small"><!--LANG::subcat_desc--></span>
                                </td>
                                <td>
                                    <select name="cat_subcat_of" size="1">
                                        <option value="0"><!--COMMON::no_subcat--></option>
                                        <option value="-1">------</option>
                                        <!--TEXT::subcat_options-->
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    <!--LANG::date-->:<br>
                                    <span class="small"><!--LANG::date_desc--></span>
                                </td>
                                <td class="config">
                                    <input type="date" class="text" size="30" maxlength="10" id="cat_date" name="cat_date" value="<!--TEXT::cat_date-->">
                                    <!--TEXT::today-->
                                    <!--TEXT::reset_date-->
                                </td>
                            </tr>
                            <tr>
                                <td class="config"
                                    <!--LANG::user-->:<br>
                                    <span class="small"><!--LANG::user_desc--></span>
                                </td>
                                <td class="config">
                                    <input type="text" class="text" size="30" maxlength="255" id="username" name="cat_user_name" value="<!--TEXT::cat_user_name-->">
                                    <input type="hidden" id="userid" name="cat_user" value="<!--TEXT::cat_user-->">
                                    <input type="button" class="button" onClick='<!--TEXT::find_user-->' value="<!--COMMON::change-->">
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            
                            <tr>
                                <td class="line" colspan="2">
                                    <!--LANG::optional_settings-->
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    <!--LANG::cat_img-->:
                                    <span class="small">(<!--COMMON::optional-->)</span><br>
                                    <span class="small"><!--LANG::cat_img_desc--></span><br><br>

                                <!--IF::image_exists?true-->
                                    <img src="<!--TEXT::image_url-->" alt="<!--TEXT::cat_name-->" border="0">
                                    <table>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="cat_pic_delete" id="cpd" value="1" onClick='delalert("cpd", "<!--COMMON::js_delete_image-->")'>
                                            </td>
                                            <td>
                                                <span class="small"><b><!--COMMON::delete_image--></b></span>
                                            </td>
                                        </tr>
                                    </table>
                                <!--ELSE-->
                                    <span class="small"><!--COMMON::no_image--></span><br>
                                <!--ENDIF-->
                                    <br>
                                </td>
                                <td class="config">
                                    <input name="cat_img" type="file" size="40" class="text"><br>
                                <!--IF::image_exists?true-->
                                    <span class="small"><b><!--COMMON::replace_img--></b></span><br>
                                <!--ENDIF-->
                                    <span class="small">
                                         [<!--COMMON::max-->
                                         <!--TEXT::config_img_x-->
                                         <!--COMMON::resolution_x-->
                                         <!--TEXT::config_img_y-->
                                         <!--COMMON::pixel-->]
                                         [<!--COMMON::max-->
                                         <!--TEXT::config_img_size-->
                                         <!--COMMON::kib-->]
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td class="config">
                                    <!--LANG::description-->:
                                    <span class="small">(<!--COMMON::optional-->)</span><br>
                                    <span class="small"><!--LANG::description_desc--></span>
                                </td>
                                <td class="config">
                                    <textarea class="text" name="cat_description" rows="5" cols="50" wrap="virtual">
                                        <!--TEXT::cat_description-->
                                    </textarea>
                                </td>
                            </tr>
                            <tr><td class="space"></td></tr>
                            
                            <tr>
                                <td class="buttontd" colspan="2">
                                    <button type="submit" name="sended" value="1" class="button_new">
                                        <!--COMMON::button_arrow-->
                                        <!--COMMON::save_changes_button-->
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </form><!--ENDDEF-->


<!--DEF::delete_entry-->
                                        <li><!--TEXT::cat_name--> (#<!--TEXT::cat_id-->) <a href="<!--TEXT::cat_url-->" target="_blank">�&nbsp;<!--COMMON::show--></a><br>
                                        (<!--TEXT::cat_type-->, <!--TEXT::cat_visibility-->)</li><!--ENDDEF-->

<!--DEF::delete-->
                                    <ul><!--TEXT::previews-->
                                    </ul>
                                    <p>
                                        <b><!--LANG::delete_info--></b>
                                    </p><!--ENDDEF-->