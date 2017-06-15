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
                                <input name="m" type="text" class="form-control border-input" value="23" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd "><?php echo Core::lang('search')?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        if (isset($_POST['submitnewpublisher']))
                        {
                            $post_array = array(
                                'Token' => $datalogin['token'],
                                'Name' => filter_var($_POST['name'],FILTER_SANITIZE_STRING)
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/publisher/new',$post_array,Core::lang('new_publisher'));
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('add_new_publisher')?></h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('publisher_name')?></label>
                                            <input name="name" type="text" placeholder="Input new publisher here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                <button type="submit" name="submitnewpublisher" class="btn btn-primary"><?php echo Core::lang('submit')?></button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal"><?php echo Core::lang('add_new_publisher')?></button>
                            </div>
                        </div>
                    </div>
<?php 
    if (isset($_POST['submitupdatepublisher'.(empty($_POST['PublisherID'])?'':$_POST['PublisherID'])])){
        $post_array = array(
            'Name' => $_POST['name'],
            'Token' => $datalogin['token'],
            'PublisherID' => $_POST['publisherid']
        );
        Core::updateProcess(Core::getInstance()->api.'/book/publisher/update',$post_array,Core::lang('publisher'));
    }

    if (isset($_POST['submitdeletepublisher'.(empty($_POST['PublisherID'])?'':$_POST['PublisherID'])])){
        $post_array = array(
            'Token' => $datalogin['token'],
            'PublisherID' => $_POST['publisherid']
        );
        Core::deleteProcess(Core::getInstance()->api.'/book/publisher/delete',$post_array,Core::lang('from_publisher'));
    }

    $url = Core::getInstance()->api.'/book/publisher/data/search/'.$datalogin['token'].'/'.$page.'/'.$itemsperpage.'/?query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('data_publisher').'</h4>
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
                                    	<th>'.Core::lang('publisherid').'</th>
                                    	<th>'.Core::lang('publisher').'</th>
                                    	<th>'.Core::lang('manage').'</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'PublisherID'} .'</td>';
			        echo '<td>' . $value->{'Name'} .'</td>';
        			echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'PublisherID'}.'"><i class="ti-pencil"></i> '.Core::lang('edit').'</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=23&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'PublisherID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.Core::lang('update_publisher').'</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=23&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('publisherid').'</label>
                                            <input name="publisherid" type="text" placeholder="'.Core::lang('input_publisherid').'" class="form-control border-input" value="'.$value->{'PublisherID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('publisher_name').'</label>
                                            <input name="name" type="text" placeholder="'.Core::lang('input_publisher').'" class="form-control border-input" value="'.$value->{'Name'}.'" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group hidden">
                                    <input name="PublisherID" type="text" class="form-control border-input" value="'.$value->{'PublisherID'}.'" hidden>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletepublisher'.$value->{'PublisherID'}.'" class="btn btn-danger pull-left">'.Core::lang('delete').'</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdatepublisher'.$value->{'PublisherID'}.'" class="btn btn-primary">'.Core::lang('update').'</button>
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

                