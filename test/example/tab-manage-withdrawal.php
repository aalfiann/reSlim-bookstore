<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($_GET['search'],FILTER_SANITIZE_STRING)?>">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>First Date</label>
                                <input id="firstdate" name="firstdate" type="text" class="form-control border-input" placeholder="First Date" value="<?=((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days")));?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Last Date</label>
                                <input id="lastdate" name="lastdate" type="text" class="form-control border-input" placeholder="Last Date" value="<?=((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d'));?>" required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <label>Search</label>
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $_GET['search']?>">
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
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd ">Search</button>
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
                            Core::createProcess(Core::getInstance()->api.'/book/user/withdraw/new',$post_array,'Withdrawal');
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Withdrawal</h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input name="username" type="text" placeholder="Input your username here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Detail</label>
                                            <textarea name="detail" rows="2" type="text" placeholder="Input your detail here..." maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input name="fullname" type="text" placeholder="Input your fullname here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>No Account</label>
                                            <input name="account" type="text" placeholder="Input your no account here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input name="bankname" type="text" placeholder="Input your no account here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Bank Address</label>
                                            <textarea name="bankaddress" rows="2" type="text" placeholder="Input your bank address here..." maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>No Reference</label>
                                            <input name="noreference" type="text" placeholder="Input your no reference here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="amount" type="text" placeholder="Input your amount here..." maxlength="10" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>From Bank</label>
                                            <input name="frombank" type="text" placeholder="Input your name of bank here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>From Name</label>
                                            <input name="fromname" type="text" placeholder="Input your bank name here..." maxlength="50" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Proof Of Transaction</label>
                                            <textarea name="evidence" rows="2" type="text" placeholder="Input your proof of transaction here..." maxlength="50" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitnewwithdraw" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal">Add new Withdrawal</button>
                            </div>
                        </div>
                    </div>
               
<?php 
    $url = Core::getInstance()->api.'/book/user/withdrawal/'.$datalogin['username'].'/all/'.$_GET['page'].'/'.$_GET['itemsperpage'].'/'.$datalogin['token'].'/?firstdate='.((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days"))).'&lastdate='.((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d')).'&query='.$_GET['search'];
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
                        Core::updateProcess(Core::getInstance()->api.'/book/user/withdraw/update',$post_array,'Withdrawal');
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
                        Core::deleteProcess(Core::getInstance()->api.'/book/user/withdraw/delete',$post_array,'Withdrawal');
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Data Report Withdrawal</h4>
                                <p class="category">Message: '.$data->{'message'}.'<br>
                                Shows no: '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' from total data: '.$data->metadata->{'records_total'}.'</p>
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
                                    	<th>Date Transaction</th>
                                    	<th>Withdraw ID</th>
                                    	<th>Detail</th>
                                    	<th>Username</th>
                                        <th>Fullname</th>
                                        <th>Bank Name</th>
                                    	<th>No Reference</th>
                                        <th>Amount</th>
                                        <th>Via Bank</th>
                                        <th>From</th>
                                        <th>Proof Of Transaction</th>
                                        <th>Admin</th>
                                        <th>Updated at</th>
                                        <th>Updated by</th>
                                        <th>Manage</th>
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
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'WithdrawID'}.'"><i class="ti-pencil"></i> Edit</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=18&firstdate='.((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days"))).'&lastdate='.((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d')).'&search='.$_GET['search']);
                
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
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=18&firstdate='.((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days"))).'&lastdate='.((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d')).'&page='.$_GET['page'].'&itemsperpage='.$_GET['itemsperpage'].'&search='.$_GET['search'].'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Withdraw ID</label>
                                            <input name="withdrawid" type="text" placeholder="Input your withdraw id here..." maxlength="50" class="form-control border-input" value="'.$value->{'WithdrawID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Detail</label>
                                            <textarea name="detail" rows="2" type="text" placeholder="Input your detail here..." maxlength="50" class="form-control border-input" required>'.$value->{'Detail'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Fullname</label>
                                            <input name="fullname" type="text" placeholder="Input your fullname here..." maxlength="50" class="form-control border-input" value="'.$value->{'Fullname'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>No Account</label>
                                            <input name="account" type="text" placeholder="Input your no account here..." maxlength="50" class="form-control border-input" value="'.$value->{'No_Account'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input name="bankname" type="text" placeholder="Input your no account here..." maxlength="50" class="form-control border-input" value="'.$value->{'Bank_Name'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Bank Address</label>
                                            <textarea name="bankaddress" rows="2" type="text" placeholder="Input your bank address here..." maxlength="50" class="form-control border-input" required>'.$value->{'Bank_Address'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>No Reference</label>
                                            <input name="noreference" type="text" placeholder="Input your no reference here..." maxlength="50" class="form-control border-input" value="'.$value->{'No_Reference'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input name="amount" type="text" placeholder="Input your amount here..." maxlength="10" class="form-control border-input" value="'.$value->{'Amount'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>From Bank</label>
                                            <input name="frombank" type="text" placeholder="Input your name of bank here..." maxlength="50" class="form-control border-input" value="'.$value->{'From_Bank'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>From Name</label>
                                            <input name="fromname" type="text" placeholder="Input your bank name here..." maxlength="50" class="form-control border-input" value="'.$value->{'From_Name'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Proof Of Transaction</label>
                                            <textarea name="evidence" rows="2" type="text" placeholder="Input your proof of transaction here..." maxlength="50" class="form-control border-input" required>'.$value->{'Image_Evidence'}.'</textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletewithdraw'.$value->{'WithdrawID'}.'" class="btn btn-danger pull-left">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdatewithdraw'.$value->{'WithdrawID'}.'" class="btn btn-primary">Update</button>
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
                                <h4 class="title">Message: '.$data->{'message'}.'</h4>
                            </div>
                        </div>
                    </div>';
            } 
        }
?>
                            </div>
                        </div>
                    </div>

                