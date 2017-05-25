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
                                    Core::saveProcess(Core::getInstance()->api.'/user/changepassword',$post_array,'New Password',false);
                                } else {
                                    echo Core::getMessage('danger','Process Saving New Password Failed,','Your confirmation password is not match!');
                                }
                            } 
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title">Change Password</h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input name="password" type="password" placeholder="Please input the old password" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input name="newpassword" type="password" placeholder="Please input the new password" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input name="newpassword1" type="password" placeholder="Please input the new password again." class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitnewpassword" type="submit" class="btn btn-fill btn-wd ">Submit</button>
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
                                Core::saveProcess(Core::getInstance()->api.'/book/user/settings/save',$post_array,'User Settings',false);
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
                                        <h3 class="title">Bank Account</h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input name="fullname" type="text" placeholder="Please input the full name of your" class="form-control border-input" maxlength="50" value="<?php echo $fullname?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>No Account</label>
                                            <input name="account" type="text" placeholder="Please input your number of bank account" class="form-control border-input" maxlength="50" value="<?php echo $account?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input name="bankname" type="text" placeholder="Please input your bank name." class="form-control border-input" maxlength="50" value="<?php echo $bankname?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Bank Address</label>
                                            <textarea name="bankaddress" rows="3" type="text" placeholder="Please input your bank address." class="form-control border-input" maxlength="250" required><?php echo $bankaddress?></textarea>
                                        </div>
                                        <p class="category"><i class="ti-info-alt"></i> You should fill your bank account for process withdrawal.</p>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitsettings" type="submit" class="btn btn-fill btn-wd ">Save Settings</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>