<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($_GET['search'],FILTER_SANITIZE_STRING)?>">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $_GET['search']?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="11" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd ">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
                    <?php 
                        if (isset($_POST['submitnewtype']))
                        {
                            $post_array = array(
                                'Token' => $datalogin['token'],
                                'Name' => filter_var($_POST['name'],FILTER_SANITIZE_STRING)
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/type/new',$post_array,'New Book Type');
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Type</h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Type Name</label>
                                            <input name="name" type="text" placeholder="Input new type here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitnewtype" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal">Add new Type</button>
                            </div>
                        </div>
                    </div>
<?php 
    $url = Core::getInstance()->api.'/book/type/data/search/'.$datalogin['token'].'/'.$_GET['page'].'/'.$_GET['itemsperpage'].'/?query='.$_GET['search'];
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitupdatetype'.$value->{'TypeID'}]))
                    {
                        $post_array = array(
                            'Name' => $_POST['name'],
                            'Token' => $datalogin['token'],
                            'TypeID' => $_POST['typeid']
                        );
                        Core::updateProcess(Core::getInstance()->api.'/book/type/update',$post_array,'Book Type');
                        echo Core::reloadPage();
                    }
                }

                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitdeletetype'.$value->{'TypeID'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'TypeID' => $_POST['typeid']
                        );
                        Core::deleteProcess(Core::getInstance()->api.'/book/type/delete',$post_array,'Book Type');
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Data Type</h4>
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
                                    	<th>TypeID</th>
                                    	<th>Type</th>
                                    	<th>Manage</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'TypeID'} .'</td>';
			        echo '<td>' . $value->{'Name'} .'</td>';
        			echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'TypeID'}.'"><i class="ti-pencil"></i> Edit</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=11&search='.$_GET['search']);
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'TypeID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Type</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=11&page='.$_GET['page'].'&itemsperpage='.$_GET['itemsperpage'].'&search='.$_GET['search'].'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Type ID</label>
                                            <input name="typeid" type="text" placeholder="Input your type id here..." class="form-control border-input" value="'.$value->{'TypeID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Type Name</label>
                                            <input name="name" type="text" placeholder="Input your type name here..." class="form-control border-input" value="'.$value->{'Name'}.'" required>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletetype'.$value->{'TypeID'}.'" class="btn btn-danger pull-left">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdatetype'.$value->{'TypeID'}.'" class="btn btn-primary">Update</button>
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

                