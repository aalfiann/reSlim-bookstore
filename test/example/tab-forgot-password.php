            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-3 col-md-offset-1 col-sm-offset-2">
                        <?php
                            if (isset($_POST['submitforgot']))
                            {
                                $post_array = array(
                                    'Email' => $_POST['email']
                                );
                                Core::forgotPassword($post_array);
                            } 
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title"><?php echo Core::lang('request_reset_password')?></h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('email')?></label>
                                            <input name="email" type="email" placeholder="<?php echo Core::lang('input_email')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitforgot" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('reset_password')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>