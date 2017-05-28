<?php 
//Validation url param
$username = filter_var((empty($_GET['username'])?'':$_GET['username']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                        if (isset($_POST['submitupdate']))
                        {
                            $post_array = array(
                            	'Username' => $_POST['username'],
                                'Fullname' => $_POST['fullname'],
                                'Address' => $_POST['address'],
                                'Phone' => $_POST['phone'],
                                'Email' => $_POST['email'],
                                'Aboutme' => $_POST['aboutme'],
                                'Avatar' => $_POST['avatar'],
                                'Role' => $_POST['role'],
                                'Status' => $_POST['status'],
                                'Token' => $datalogin['token']
                            );
                            Core::update(Core::getInstance()->api.'/user/update',$post_array);
                        } 
                    ?>
<?php 
    // Data User
    $url = Core::getInstance()->api.'/user/profile/'.$username.'/'.$datalogin['token'];
    $data = json_decode(Core::execGetRequest($url));

    // Data Role
    $urlrole = Core::getInstance()->api.'/user/role/'.$datalogin['token'];
    $datarole = json_decode(Core::execGetRequest($urlrole));

    // Data Status
    $urlstatus = Core::getInstance()->api.'/user/status/'.$datalogin['token'];
    $datastatus = json_decode(Core::execGetRequest($urlstatus));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                    echo '<div class="col-lg-12 col-md-12">
                        <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="'.((empty($data->result[0]->{'Avatar'}))?'assets/img/faces/face-0.jpg':$data->result[0]->{'Avatar'}).'" alt="'.$data->result[0]->{'Username'}.'"/>
                                  <h4 class="title">'.$data->result[0]->{'Fullname'}.'<br />
                                     <a href="'.Core::getInstance()->basepath.'/modul-view-profile.php?username='.$data->result[0]->{'Username'}.'"><small>@'.$data->result[0]->{'Username'}.'</small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                    '.$data->result[0]->{'Aboutme'}.'
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h5>'.Core::lang('role').'<br /><small>'.$data->result[0]->{'Role'}.'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>'.Core::lang('status').'<br /><small>'.$data->result[0]->{'Status'}.'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>'.Core::lang('registered').'<br /><small>'.$data->result[0]->{'Created_at'}.'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>'.Core::lang('last_updated').'<br /><small>'.$data->result[0]->{'Updated_at'}.'</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">'.Core::lang('edit_profile').'</h4>
                            </div>
                            <div class="content">
                                <form action="'.$_SERVER['PHP_SELF'].'?m=5&username='.$username.'" method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>'.Core::lang('username').'</label>
                                                <input type="text" name="username" class="form-control border-input" value="'.$data->result[0]->{'Username'}.'" maxlength="50" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>'.Core::lang('fullname').'</label>
                                                <input type="text" name="fullname" class="form-control border-input" placeholder="Input your fullname" value="'.$data->result[0]->{'Fullname'}.'" maxlength="50" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>'.Core::lang('address').'</label>
                                                <textarea name="address" rows="3" class="form-control border-input" placeholder="Here can be your address ..." maxlength="255">'.$data->result[0]->{'Address'}.'</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>'.Core::lang('phone').'</label>
                                                <input type="text" name="phone" class="form-control border-input" placeholder="Input your phone number" maxlength="15" value="'.$data->result[0]->{'Phone'}.'" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>'.Core::lang('email').'</label>
                                                <input type="email" name="email" class="form-control border-input" placeholder="Input your email address" maxlength="50" value="'.$data->result[0]->{'Email'}.'" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>'.Core::lang('about_me').'</label>
                                                <textarea name="aboutme" rows="5" class="form-control border-input" placeholder="Here can be your description">'.$data->result[0]->{'Aboutme'}.'</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>'.Core::lang('avatar').'</label>
                                                <input type="text" name="avatar" class="form-control border-input" placeholder="Please input url image for Your Avatar." value="'.$data->result[0]->{'Avatar'}.'">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>'.Core::lang('role').'</label>
                                                    <select name="role" style="max-height:200px; overflow-y:scroll; overflow-x:hidden;" class="form-control border-input" required>';
                                                        if (!empty($datarole)) {
                                                            foreach ($datarole->result as $name => $value) {
                                                                echo '<option value="'.$value->{'RoleID'}.'" '.(($value->{'Role'} == $data->result[0]->{'Role'})?'selected':'').'>'.$value->{'Role'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>'.Core::lang('status').'</label>
                                                    <select name="status" style="max-height:200px; overflow-y:scroll; overflow-x:hidden;" class="form-control border-input" required>';
                                                        if (!empty($datastatus)) {
                                                            foreach ($datastatus->result as $name => $value) {
                                                                echo '<option value="'.$value->{'StatusID'}.'" '.(($value->{'Status'} == $data->result[0]->{'Status'})?'selected':'').'>'.$value->{'Status'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button name="submitupdate" type="submit" class="btn btn-info btn-fill btn-wd">'.Core::lang('update_profile').'</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>';
            }
            else
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title" style="border-left: 6px solid pink;padding: 15px">'.$data->{'message'}.'</h4>
                            </div>
                        </div>
                    </div>';
            } 
        }
?>
                
                </div>
            </div>
        </div>

                