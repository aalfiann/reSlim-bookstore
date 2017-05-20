<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($_GET['search'],FILTER_SANITIZE_STRING)?>">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $_GET['search']?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="17" hidden>
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
                        if (isset($_POST['submitnewbook']))
                        {
                            $post_array = array(
                                'Username' => $datalogin['username'],
                                'Token' => $datalogin['token'],
                                'SampleLink' => filter_var($_POST['samplelink'],FILTER_SANITIZE_STRING),
                                'FullLink' => filter_var($_POST['fulllink'],FILTER_SANITIZE_STRING),
                                'ImageLink' => filter_var($_POST['imagelink'],FILTER_SANITIZE_STRING),
                                'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
                                'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
                                'Author' => filter_var($_POST['author'],FILTER_SANITIZE_STRING),
                                'Language' => filter_var($_POST['language'],FILTER_SANITIZE_STRING),
                                'Translator' => filter_var($_POST['translator'],FILTER_SANITIZE_STRING),
                                'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
                                'Pages' => filter_var($_POST['pages'],FILTER_SANITIZE_STRING),
                                'Purpose' => filter_var($_POST['purpose'],FILTER_SANITIZE_STRING),
                                'Publisher' => filter_var($_POST['publisher'],FILTER_SANITIZE_STRING),
                                'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING)                                              
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/submitbook/new',$post_array,'New Submit Book');
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add new Submit Book</h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <select name="purpose" type="text" style='max-height:200px; overflow-y:scroll; overflow-x:hidden;' class="form-control border-input">
                                                <option value="paid">paid</option>
                                                <option value="free">free</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input name="imagelink" type="text" placeholder="Input your image link here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Input your title here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" type="text" rows="3" maxlength="250" placeholder="Input your title here..." class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" type="text" placeholder="Input your author here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <input name="language" type="text" placeholder="Input your language here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Translator</label>
                                            <input name="translator" type="text" placeholder="Input your translator here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <input name="publisher" type="text" placeholder="Input your publisher here..." class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input name="isbn" type="text" placeholder="Input your isbn here..." class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Tags</label>
                                            <input name="tags" type="text" placeholder="Input your tags here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Pages</label>
                                            <input name="pages" type="text" placeholder="Input your pages here..." class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Sample Link</label>
                                            <textarea name="samplelink" rows="2" type="text" placeholder="Input your sample link here..." class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Full Link</label>
                                            <textarea name="fulllink" rows="2" type="text" placeholder="Input your full link here..." class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitnewbook" class="btn btn-primary">Submit</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal">Add new Submit Book</button>
                            </div>
                        </div>
                    </div>
<?php 
    $url = Core::getInstance()->api.'/book/submitbook/data/all/'.$datalogin['username'].'/search/'.$_GET['page'].'/'.$_GET['itemsperpage'].'/'.$datalogin['token'].'/?query='.$_GET['search'];
    $data = json_decode(Core::execGetRequest($url));

    // Data Status Release
    $urlstatus = Core::getInstance()->api.'/book/submitbook/status/'.$datalogin['token'];
    $datastatus = json_decode(Core::execGetRequest($urlstatus));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitupdatebook'.$value->{'SubmitBookID'}]))
                    {
                        $post_array = array(
                            'Username' => $datalogin['username'],
                            'Token' => $datalogin['token'],
                            'SampleLink' => filter_var($_POST['samplelink'],FILTER_SANITIZE_STRING),
                            'FullLink' => filter_var($_POST['fulllink'],FILTER_SANITIZE_STRING),
                            'ImageLink' => filter_var($_POST['imagelink'],FILTER_SANITIZE_STRING),
                            'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
                            'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
                            'Author' => filter_var($_POST['author'],FILTER_SANITIZE_STRING),
                            'Language' => filter_var($_POST['language'],FILTER_SANITIZE_STRING),
                            'Translator' => filter_var($_POST['translator'],FILTER_SANITIZE_STRING),
                            'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
                            'Pages' => filter_var($_POST['pages'],FILTER_SANITIZE_STRING),
                            'Purpose' => filter_var($_POST['purpose'],FILTER_SANITIZE_STRING),
                            'StatusID' => filter_var($value->{'StatusID'},FILTER_SANITIZE_STRING),
                            'BookID' => filter_var($value->{'BookID'},FILTER_SANITIZE_STRING),
                            'SubmitBookID' => filter_var($_POST['submitbookid'],FILTER_SANITIZE_STRING),
                            'Publisher' => filter_var($_POST['publisher'],FILTER_SANITIZE_STRING),
                            'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING)
                        );
                        Core::updateProcess(Core::getInstance()->api.'/book/submitbook/update',$post_array,'Submit Book');
                        echo Core::reloadPage();
                    }
                }

                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitdeletebook'.$value->{'SubmitBookID'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'SubmitBookID' => $_POST['submitbookid']
                        );
                        Core::deleteProcess(Core::getInstance()->api.'/book/submitbook/delete',$post_array,'from Submit Book');
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Data Submit Book</h4>
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
                                        <th>Purpose</th>
                                    	<th>Created</th>
                                    	<th>Submit ID</th>
                                    	<th>Title</th>
                                        <th>Author</th>
                                        <th>Translator</th>
                                        <th>Language</th>
                                        <th>Publisher</th>
                                        <th>Pages</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'Purpose'} .'</td>';
                    echo '<td>' . $value->{'Created_at'} .'</td>';
			        echo '<td>' . $value->{'SubmitBookID'} .'</td>';
        			echo '<td>' . $value->{'Title'} .'</td>';
                    echo '<td>' . $value->{'Author'} .'</td>';
                	echo '<td>' . $value->{'Translator'} .'</td>';
                	echo '<td>' . $value->{'Language'} .'</td>';
                    echo '<td>' . $value->{'Publisher'} .'</td>';
            	    echo '<td>' . $value->{'Pages'} .'</td>';
                    echo '<td>' . $value->{'Status'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'SubmitBookID'}.'"><i class="ti-pencil"></i> Edit</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=17&search='.$_GET['search']);
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'SubmitBookID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Update Submit Book</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=17&page='.$_GET['page'].'&itemsperpage='.$_GET['itemsperpage'].'&search='.$_GET['search'].'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Submit ID</label>
                                            <input name="submitbookid" type="text" placeholder="Input your submit book id here..." class="form-control border-input" value="'.$value->{'SubmitBookID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <select name="purpose" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <option value="paid">paid</option>
                                                <option value="free">free</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input name="imagelink" type="text" placeholder="Input your image link here..." class="form-control border-input" value="'.$value->{'Image'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" type="text" placeholder="Input your title here..." class="form-control border-input" value="'.$value->{'Title'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Decription</label>
                                            <textarea name="description" rows="3" type="text" placeholder="Input your description here..." class="form-control border-input" required>'.$value->{'Description'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" type="text" placeholder="Input your author here..." class="form-control border-input" value="'.$value->{'Author'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Language</label>
                                            <input name="language" type="text" placeholder="Input your language here..." class="form-control border-input" value="'.$value->{'Language'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Translator</label>
                                            <input name="translator" type="text" placeholder="Input your translator here..." class="form-control border-input" value="'.$value->{'Translator'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Publisher</label>
                                            <input name="publisher" type="text" placeholder="Input your publisher here..." class="form-control border-input" value="'.$value->{'Publisher'}.'" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input name="isbn" type="text" placeholder="Input your isbn here..." class="form-control border-input" value="'.$value->{'ISBN'}.'" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Tags</label>';
                                            $datatags = '';
                                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                                $datatags .= $valuetags.', ';
                                            }
                                            $datatags = substr($datatags, 0, -2);
                                            echo '<input name="tags" type="text" placeholder="Input your tags here..." class="form-control border-input" value="'.$datatags.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Pages</label>
                                            <input name="pages" type="text" placeholder="Input your pages here..." class="form-control border-input" value="'.$value->{'Pages'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Sample Link</label>
                                            <textarea name="samplelink" rows="2" type="text" placeholder="Input your sample link here..." class="form-control border-input" required>'.$value->{'Sample_link'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Full Link</label>
                                            <textarea name="fulllink" rows="2" type="text" placeholder="Input your full link here..." class="form-control border-input" required>'.$value->{'Full_link'}.'</textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletebook'.$value->{'SubmitBookID'}.'" class="btn btn-danger pull-left '.(($value->{'StatusID'} == '3')?'hidden':'').'">Delete</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submitupdatebook'.$value->{'SubmitBookID'}.'" class="btn btn-primary '.(($value->{'StatusID'} == '3')?'hidden':'').'">Update</button>
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

                