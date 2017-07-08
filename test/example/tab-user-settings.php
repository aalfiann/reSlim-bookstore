            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-3 col-md-offset-1 col-sm-offset-1">
                        <?php
                            if (isset($_POST['submitnewpassword']))
                            {
                                if ($_POST['newpassword'] == $_POST['newpassword1']){
                                    $post_array = array(
                                        'Username' => $datalogin['username'],
                                        'Token' => $datalogin['token'],
                                        'Password' => $_POST['password'],
                                        'NewPassword' => $_POST['newpassword']
                                    );
                                    Core::saveProcess(Core::getInstance()->api.'/user/changepassword',$post_array,Core::lang('new_password'),false);
                                } else {
                                    echo Core::getMessage('danger',Core::lang('change_password_failed').',',Core::lang('your_password_is_not_match'));
                                }
                            } 
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title"><?php echo Core::lang('change_password')?></h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('old_password')?></label>
                                            <input name="password" type="password" placeholder="<?php echo Core::lang('input_old_password')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('new_password')?></label>
                                            <input name="newpassword" type="password" id="password1-input" placeholder="<?php echo Core::lang('input_new_password')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('confirm_password')?></label>
                                            <input name="newpassword1" type="password" id="password2-input" placeholder="<?php echo Core::lang('reinput_new_password')?>" class="form-control border-input" maxlength="50" required>
                                            <div id="password-info"></div>
                                        </div>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitnewpassword" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('submit')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-3 col-md-offset-1 col-sm-offset-2">
                        <?php
                            if (isset($_POST['submitsettings']))
                            {
                                $post_array = array(
                                    'Username' => $datalogin['username'],
                                    'Token' => $datalogin['token'],
                                    'Fullname' => $_POST['fullname'],
                                    'Account' => $_POST['account'],
                                    'BankName' => $_POST['bankname'],
                                    'BankAddress' => $_POST['bankaddress']
                                );
                                Core::saveProcess(Core::getInstance()->api.'/book/user/settings/save',$post_array,Core::lang('user_settings'),false);
                            } 
             
                            $url = Core::getInstance()->api.'/book/user/settings/read/'.$datalogin['username'].'/'.$datalogin['token'];
                            $data = json_decode(Core::execGetRequest($url));
                            $fullname = '';
                            $account = '';
                            $bankname = '';
                            $bankaddress = '';

                            if (!empty($data)){
                                if ($data->{'status'} == "success"){
                                    foreach ($data->result as $name => $value) {
                                        $fullname = $value->{'Fullname'};
                                        $account = $value->{'No_Account'};
                                        $bankname = $value->{'Bank_Name'};
                                        $bankaddress = $value->{'Bank_Address'};
                                    }
                                }
                            }
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title"><?php echo Core::lang('bank_account')?></h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('fullname')?></label>
                                            <input name="fullname" type="text" placeholder="<?php echo Core::lang('input_fullname')?>" class="form-control border-input" maxlength="50" value="<?php echo $fullname?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_no_account')?></label>
                                            <input name="account" type="text" placeholder="<?php echo Core::lang('input_bank_no_account')?>" class="form-control border-input" maxlength="50" value="<?php echo $account?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_name')?></label>
                                            <input name="bankname" type="text" placeholder="<?php echo Core::lang('input_bank_name')?>" class="form-control border-input" maxlength="50" value="<?php echo $bankname?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_address')?></label>
                                            <textarea name="bankaddress" rows="3" type="text" placeholder="<?php echo Core::lang('input_bank_address')?>" class="form-control border-input" maxlength="250" required><?php echo $bankaddress?></textarea>
                                        </div>
                                        <p class="category"><i class="ti-info-alt"></i> <?php echo Core::lang('info_bank_account')?></p>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitsettings" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('save_settings')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>