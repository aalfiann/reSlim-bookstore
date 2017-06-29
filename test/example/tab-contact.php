            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                        <?php
                            $aaa=rand(0,5);$bbb=rand(3,9);
                            if (isset($_POST['submitcontact']))
                            {
                                if (($_POST['aaa'] + $_POST['bbb']) == $_POST['key']){
                                    $post_array = array(
                                    	'To' => Core::getInstance()->email,
                                    	'Subject' => filter_var($_POST['subject'],FILTER_SANITIZE_STRING),
                                        'Message' => $_POST['message'],
                                        'From' => filter_var($_POST['email'],FILTER_SANITIZE_EMAIL),
                                        'FromName' => filter_var($_POST['name'],FILTER_SANITIZE_STRING),
                                        'Html' => true,
                                        'CC' => '',
                                        'BCC' => '',
                                        'Attachment' => ''
                                    );
                                    Core::sendMail(Core::getInstance()->api.'/mail/send',$post_array);
                                } else {
                                    echo Core::getMessage('danger',Core::lang('send_message_failed').',',Core::lang('wrong_security_key'));
                                }
                            } 
                        ?>
                            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="header">
                                        <h3 class="title"><?php echo Core::lang('form_contact_us')?></h3>
                                        <hr>
                                    </div>
                                    <div class="content">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('fullname')?></label>
                                            <input name="name" type="text" placeholder="<?php echo Core::lang('input_fullname')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('email')?></label>
                                            <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="<?php echo Core::lang('input_email')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('subject')?></label>
                                            <input name="subject" type="text" placeholder="<?php echo Core::lang('input_subject')?>" class="form-control border-input" maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('message')?></label>
                                            <textarea name="message" rows="3" placeholder="<?php echo Core::lang('input_message')?>" class="form-control border-input" maxlength="255" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo Core::lang('security_key')?>: </label>
                                            <b><?php echo $aaa?> + <?php echo $bbb?> = ?</b><input name="key" type="text" placeholder="<?php echo Core::lang('input_security_key')?>" class="form-control border-input" maxlength="15" required>
                                            <input type="text" name="aaa" value="<?php echo $aaa?>" hidden>
            								<input type="text" name="bbb" value="<?php echo $bbb?>" hidden>
                                        </div>
                                        <hr>
                                        <div class="form-group text-center">
                                            <button name="submitcontact" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('send_message')?></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>