<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.$search?>">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <input name="search" type="text" placeholder="<?php echo Core::lang('search_here')?>" class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="14" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('search_here')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
                    
<?php 
    if (isset($_POST['submitupdatelibrary'.(empty($_POST['Guid'])?'':$_POST['Guid'])])){
        $post_array = array(
            'Adminname' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'BookID' => $_POST['bookid'],
            'Username' => $_POST['username'],
            'Status' => $_POST['status']
        );
        Core::updateProcess(Core::getInstance()->api.'/book/library/update',$post_array,Core::lang('library'));
    }
                
    if (isset($_POST['submitdeletelibrary'.(empty($_POST['Guid'])?'':$_POST['Guid'])])){
        $post_array = array(
            'Token' => $datalogin['token'],
            'BookID' => $_POST['bookid'],
            'Username' => $_POST['username'] //Username of the owner of book
        );
        Core::deleteProcess(Core::getInstance()->api.'/book/library/delete',$post_array,Core::lang('from_library'));
    }

    $url = Core::getInstance()->api.'/book/library/data/pending/search/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    // Data Status
    $urlstatus = Core::getInstance()->api.'/book/payment/status/'.$datalogin['token'];
    $datastatus = json_decode(Core::execGetRequest($urlstatus));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('pending_library').'</h4>
                                <p class="category">'.Core::lang('message').': '.$data->{'message'}.'<br>
                                '.Core::lang('shows_no').': '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' '.Core::lang('from_total_data').': '.$data->metadata->{'records_total'}.'</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="export" class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>'.Core::lang('date').'</th>
                                    	<th>'.Core::lang('uniqueid').'</th>
                                    	<th>'.Core::lang('bookid').'</th>
                                        <th>'.Core::lang('title').'</th>
                                        <th>'.Core::lang('price').'</th>
                                        <th>'.Core::lang('status').'</th>
                                        <th>'.Core::lang('username').'</th>
                                        <th>'.Core::lang('manage').'</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'Created_at'} .'</td>';
			        echo '<td>' . $value->{'Guid'} .'</td>';
                    echo '<td>' . $value->{'BookID'} .'</td>';
                    echo '<td>' . $value->{'Title'} .'</td>';
                    echo '<td>' . $value->{'Price'} .'</td>';
                    echo '<td>' . $value->{'Status'} .'</td>';
                    echo '<td>' . $value->{'Username'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'Guid'}.'"><i class="ti-pencil"></i> '.Core::lang('edit').'</a></td>';
                    echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=14&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'Guid'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Manage Pending Library</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=14&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('username').'</label>
                                            <input name="username" type="text" placeholder="'.Core::lang('input_username_library').'" class="form-control border-input" value="'.$value->{'Username'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('bookid').'</label>
                                            <input name="bookid" type="text" placeholder="'.Core::lang('input_bookid').'" class="form-control border-input" value="'.$value->{'BookID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('uniqueid').'</label>
                                            <input name="uniqueid" type="text" placeholder="'.Core::lang('input_uniqueid').'" class="form-control border-input" value="'.$value->{'Guid'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('status').'</label>
                                            <select name="status" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datastatus)) {
                                                            foreach ($datastatus->result as $name => $valuestatus) {
                                                                echo '<option value="'.$valuestatus->{'StatusID'}.'" '.(($valuestatus->{'StatusID'} == $value->{'StatusID'})?'selected':'').'>'.$valuestatus->{'Status'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <input name="Guid" type="text" class="form-control border-input" value="'.$value->{'Guid'}.'" hidden>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletelibrary'.$value->{'Guid'}.'" class="btn btn-danger pull-left">'.Core::lang('delete').'</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">'.Core::lang('cancel').'</button>
                                <button type="submit" name="submitupdatelibrary'.$value->{'Guid'}.'" class="btn btn-primary">'.Core::lang('update').'</button>
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

                