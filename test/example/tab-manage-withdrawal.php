<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
$firstdate = ((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days")));
$lastdate = ((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d'));
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.$search?>">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo Core::lang('first_date')?></label>
                                <input id="firstdate" name="firstdate" type="text" class="form-control border-input" placeholder="<?php echo Core::lang('first_date')?>" value="<?php echo $firstdate?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo Core::lang('last_date')?></label>
                                <input id="lastdate" name="lastdate" type="text" class="form-control border-input" placeholder="<?php echo Core::lang('last_date')?>" value="<?php echo $lastdate?>" required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <label><?php echo Core::lang('search')?></label>
                                <input name="search" type="text" placeholder="<?php echo Core::lang('search_here')?>" class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="18" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <label></label>
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('search')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        if (isset($_POST['submitnewwithdraw']))
                        {
                            $post_array = array(
                                'Adminname' => $datalogin['username'],
                                'Username' => $_POST['username'],
                                'Token' => $datalogin['token'],
                                'Detail' => filter_var($_POST['detail'],FILTER_SANITIZE_STRING),
                                'Fullname' => filter_var($_POST['fullname'],FILTER_SANITIZE_STRING),
                                'Account' => filter_var($_POST['account'],FILTER_SANITIZE_STRING),
                                'BankName' => filter_var($_POST['bankname'],FILTER_SANITIZE_STRING),
                                'BankAddress' => filter_var($_POST['bankaddress'],FILTER_SANITIZE_STRING),
                                'NoReference' => filter_var($_POST['noreference'],FILTER_SANITIZE_STRING),
                                'Amount' => filter_var($_POST['amount'],FILTER_SANITIZE_STRING),
                                'FromBank' => filter_var($_POST['frombank'],FILTER_SANITIZE_STRING),
                                'FromName' => filter_var($_POST['fromname'],FILTER_SANITIZE_STRING),
                                'Evidence' => filter_var($_POST['evidence'],FILTER_SANITIZE_STRING)
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/user/withdraw/new',$post_array,Core::lang('withdrawal'));
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('add_new_withdrawal')?></h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('username')?></label>
                                            <input name="username" type="text" placeholder="<?php echo Core::lang('input_withdraw_username')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('detail')?></label>
                                            <textarea name="detail" rows="2" type="text" placeholder="<?php echo Core::lang('input_withdraw_detail')?>" maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('fullname')?></label>
                                            <input name="fullname" type="text" placeholder="<?php echo Core::lang('input_withdraw_fullname')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_no_account')?></label>
                                            <input name="account" type="text" placeholder="<?php echo Core::lang('input_withdraw_account')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_name')?></label>
                                            <input name="bankname" type="text" placeholder="<?php echo Core::lang('input_withdraw_bankname')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('bank_address')?></label>
                                            <textarea name="bankaddress" rows="2" type="text" placeholder="<?php echo Core::lang('input_withdraw_bankaddress')?>" maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('no_reference')?></label>
                                            <input name="noreference" type="text" placeholder="<?php echo Core::lang('input_withdraw_reference')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('amount')?></label>
                                            <input name="amount" type="text" placeholder="<?php echo Core::lang('input_withdraw_amount')?>" maxlength="10" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('from_bank')?></label>
                                            <input name="frombank" type="text" placeholder="<?php echo Core::lang('input_withdraw_frombank')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('from_name')?></label>
                                            <input name="fromname" type="text" placeholder="<?php echo Core::lang('input_withdraw_fromname')?>" maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('proof_of_transaction')?></label>
                                            <textarea name="evidence" rows="2" type="text" placeholder="<?php echo Core::lang('input_withdraw_pot')?>" maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                <button type="submit" name="submitnewwithdraw" class="btn btn-primary"><?php echo Core::lang('submit')?></button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal"><?php echo Core::lang('add_new_withdrawal')?></button>
                            </div>
                        </div>
                    </div>
               
<?php 
    $url = Core::getInstance()->api.'/book/user/withdrawal/'.$datalogin['username'].'/all/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?firstdate='.$firstdate.'&lastdate='.$lastdate.'&query='.$search;
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitupdatewithdraw'.$value->{'WithdrawID'}]))
                    {
                        $post_array = array(
                            'Adminname' => $datalogin['username'],
                            'Token' => $datalogin['token'],
                            'WithdrawID' => $_POST['withdrawid'],
                            'Fullname' => $_POST['fullname'],
                            'Account' => $_POST['account'],
                            'BankName' => $_POST['bankname'],
                            'BankAddress' => $_POST['bankaddress'],
                            'NoReference' => $_POST['noreference'],
                            'Amount' => $_POST['amount'],
                            'FromBank' => $_POST['frombank'],
                            'FromName' => $_POST['fromname'],
                            'Evidence' => $_POST['evidence'],
                            'Detail' => $_POST['detail']
                        );
                        Core::updateProcess(Core::getInstance()->api.'/book/user/withdraw/update',$post_array,Core::lang('withdrawal'));
                        echo Core::reloadPage();
                    }
                }

                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitdeletewithdraw'.$value->{'WithdrawID'}]))
                    {
                        $post_array = array(
                            'Username' => $datalogin['username'],
                            'Token' => $datalogin['token'],
                            'WithdrawID' => $_POST['withdrawid']
                        );
                        Core::deleteProcess(Core::getInstance()->api.'/book/user/withdraw/delete',$post_array,Core::lang('withdrawal'));
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('data_report_withdrawal').'</h4>
                                <p class="category">'.Core::lang('message').': '.$data->{'message'}.'<br>
                                '.Core::lang('shows_no').': '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' '.Core::lang('from_total_data').': '.$data->metadata->{'records_total'}.'</p>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		    				    			<p><i class="ti-zip"></i> Export Data <b class="caret"></b></p>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'excel\',escape:\'false\'});">Export XLS</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'doc\',escape:\'false\'});">Export DOC</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'txt\',escape:\'false\'});">Export TXT</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'csv\',escape:\'false\'});">Export CSV</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'pdf\',pdfFontSize:\'7\',escape:\'false\'});">Export PDF</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'sql\'});">Export SQL</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'xml\',escape:\'false\'});">Export XML</a></li>
                                            <li><a href="#" onClick ="$(\'#export\').tableExport({type:\'json\',escape:\'false\'});">Export JSON</a></li>
                                        </ul>
                                    </div>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="export" class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>'.Core::lang('date_transaction').'</th>
                                    	<th>'.Core::lang('withdrawid').'</th>
                                    	<th>'.Core::lang('detail').'</th>
                                    	<th>'.Core::lang('username').'</th>
                                        <th>'.Core::lang('fullname').'</th>
                                        <th>'.Core::lang('bank_name').'</th>
                                    	<th>'.Core::lang('no_reference').'</th>
                                        <th>'.Core::lang('amount').'</th>
                                        <th>'.Core::lang('via_bank').'</th>
                                        <th>'.Core::lang('from').'</th>
                                        <th>'.Core::lang('proof_of_transaction').'</th>
                                        <th>'.Core::lang('admin').'</th>
                                        <th>'.Core::lang('updated_at').'</th>
                                        <th>'.Core::lang('updated_by').'</th>
                                        <th>'.Core::lang('manage').'</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'Date_Transaction'} .'</td>';
			        echo '<td>' . $value->{'WithdrawID'} .'</td>';
        			echo '<td>' . $value->{'Detail'} .'</td>';
                	echo '<td>' . $value->{'Username'} .'</td>';
                	echo '<td>' . $value->{'Fullname'} .'</td>';
            	    echo '<td>' . $value->{'Bank_Name'} .'</td>';
    	    		echo '<td>' . $value->{'No_Reference'} .'</td>';
                    echo '<td>' . $value->{'Amount'} .'</td>';
                    echo '<td>' . $value->{'From_Bank'} .'</td>';
                    echo '<td>' . $value->{'From_Name'} .'</td>';
                    echo '<td><a href="' . $value->{'Image_Evidence'} .'">' . $value->{'Image_Evidence'} .'</a></td>';
                    echo '<td>' . $value->{'Adminname'} .'</td>';
                    echo '<td>' . $value->{'Updated_at'} .'</td>';
                    echo '<td>' . $value->{'Updated_by'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'WithdrawID'}.'"><i class="ti-pencil"></i> '.Core::lang('edit').'</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=18&firstdate='.$firstdate.'&lastdate='.$lastdate.'&search='.$search);
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'WithdrawID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Withdrawal</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=18&firstdate='.$firstdate.'&lastdate='.$lastdate.'&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('withdrawid').'</label>
                                            <input name="withdrawid" type="text" placeholder="'.Core::lang('input_withdraw_id').'" maxlength="50" class="form-control border-input" value="'.$value->{'WithdrawID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('detail').'</label>
                                            <textarea name="detail" rows="2" type="text" placeholder="'.Core::lang('input_withdraw_detail').'" maxlength="50" class="form-control border-input" required>'.$value->{'Detail'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('fullname').'</label>
                                            <input name="fullname" type="text" placeholder="'.Core::lang('input_withdraw_fullname').'" maxlength="50" class="form-control border-input" value="'.$value->{'Fullname'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('bank_no_account').'</label>
                                            <input name="account" type="text" placeholder="'.Core::lang('input_withdraw_account').'" maxlength="50" class="form-control border-input" value="'.$value->{'No_Account'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('bank_name').'</label>
                                            <input name="bankname" type="text" placeholder="'.Core::lang('input_withdraw_bankname').'" maxlength="50" class="form-control border-input" value="'.$value->{'Bank_Name'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('bank_address').'</label>
                                            <textarea name="bankaddress" rows="2" type="text" placeholder="'.Core::lang('input_withdraw_bankaddress').'" maxlength="50" class="form-control border-input" required>'.$value->{'Bank_Address'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('no_reference').'</label>
                                            <input name="noreference" type="text" placeholder="'.Core::lang('input_withdraw_reference').'" maxlength="50" class="form-control border-input" value="'.$value->{'No_Reference'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('amount').'</label>
                                            <input name="amount" type="text" placeholder="'.Core::lang('input_withdraw_amount').'" maxlength="10" class="form-control border-input" value="'.$value->{'Amount'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('from_bank').'</label>
                                            <input name="frombank" type="text" placeholder="'.Core::lang('input_withdraw_frombank').'" maxlength="50" class="form-control border-input" value="'.$value->{'From_Bank'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('from_name').'</label>
                                            <input name="fromname" type="text" placeholder="'.Core::lang('input_withdraw_fromname').'" maxlength="50" class="form-control border-input" value="'.$value->{'From_Name'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('proof_of_transaction').'</label>
                                            <textarea name="evidence" rows="2" type="text" placeholder="'.Core::lang('input_withdraw_pot').'" maxlength="50" class="form-control border-input" required>'.$value->{'Image_Evidence'}.'</textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletewithdraw'.$value->{'WithdrawID'}.'" class="btn btn-danger pull-left">'.Core::lang('delete').'</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">'.Core::lang('cancel').'</button>
                                <button type="submit" name="submitupdatewithdraw'.$value->{'WithdrawID'}.'" class="btn btn-primary">'.Core::lang('update').'</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->';
                }
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

                