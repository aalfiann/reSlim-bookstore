<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
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
                                <input name="m" type="text" class="form-control border-input" value="17" hidden>
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
                                'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING),
                                'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING)                                            
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/submitbook/new',$post_array,Core::lang('new_submit'));
                        }
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('add_new_submit')?></h4>
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
                                            <label><?php echo Core::lang('image')?></label>
                                            <input name="imagelink" type="text" placeholder="<?php echo Core::lang('input_image')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('title')?></label>
                                            <input name="title" type="text" placeholder="<?php echo Core::lang('input_title')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('description')?></label>
                                            <textarea name="description" type="text" rows="3" maxlength="250" placeholder="<?php echo Core::lang('input_description')?>" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('author')?></label>
                                            <input name="author" type="text" placeholder="<?php echo Core::lang('input_author')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('language')?></label>
                                            <input name="language" type="text" placeholder="<?php echo Core::lang('input_language')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('translator')?></label>
                                            <input name="translator" type="text" placeholder="<?php echo Core::lang('input_translator')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('publisher')?></label>
                                            <input name="publisher" type="text" placeholder="<?php echo Core::lang('input_publisher')?>" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input name="isbn" type="text" placeholder="<?php echo Core::lang('input_isbn')?>" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('original_released')?></label>
                                            <input name="released" id="firstdate" type="text" placeholder="<?php echo Core::lang('input_original')?>" class="form-control border-input">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('tags')?></label>
                                            <input name="tags" type="text" placeholder="<?php echo Core::lang('input_tags')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('pages')?></label>
                                            <input name="pages" type="text" placeholder="<?php echo Core::lang('input_pages')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('sample_link')?></label>
                                            <textarea name="samplelink" rows="2" type="text" placeholder="<?php echo Core::lang('input_sample')?>" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('full_link')?></label>
                                            <textarea name="fulllink" rows="2" type="text" placeholder="<?php echo Core::lang('input_full')?>" class="form-control border-input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Core::lang('cancel')?></button>
                                <button type="submit" name="submitnewbook" class="btn btn-primary"><?php echo Core::lang('submit')?></button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal"><?php echo Core::lang('add_new_submit')?></button>
                            </div>
                        </div>
                    </div>
<?php 
    $url = Core::getInstance()->api.'/book/submitbook/data/all/'.$datalogin['username'].'/search/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?query='.rawurlencode($search);
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
                            'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING),
                            'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING)
                        );
                        Core::updateProcess(Core::getInstance()->api.'/book/submitbook/update',$post_array,Core::lang('submit_book'));
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
                        Core::deleteProcess(Core::getInstance()->api.'/book/submitbook/delete',$post_array,Core::lang('from_submit'));
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('data_submit_book').'</h4>
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
                                        <th>'.Core::lang('purpose').'</th>
                                    	<th>'.Core::lang('created').'</th>
                                    	<th>'.Core::lang('submitid').'</th>
                                    	<th>'.Core::lang('title').'</th>
                                        <th>'.Core::lang('author').'</th>
                                        <th>'.Core::lang('translator').'</th>
                                        <th>'.Core::lang('language').'</th>
                                        <th>'.Core::lang('publisher').'</th>
                                        <th>'.Core::lang('pages').'</th>
                                        <th>'.Core::lang('status').'</th>
                                        <th>'.Core::lang('manage').'</th>
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
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'SubmitBookID'}.'"><i class="ti-pencil"></i> '.Core::lang('edit').'</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=17&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'SubmitBookID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.Core::lang('update_submit').'</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=17&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('submitid').'</label>
                                            <input name="submitbookid" type="text" placeholder="'.Core::lang('input_submitid').'" class="form-control border-input" value="'.$value->{'SubmitBookID'}.'" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('purpose').'</label>
                                            <select name="purpose" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <option value="paid">paid</option>
                                                <option value="free">free</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('image').'</label>
                                            <input name="imagelink" type="text" placeholder="'.Core::lang('input_image').'" class="form-control border-input" value="'.$value->{'Image'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('title').'</label>
                                            <input name="title" type="text" placeholder="'.Core::lang('input_title').'" class="form-control border-input" value="'.$value->{'Title'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('description').'</label>
                                            <textarea name="description" rows="3" type="text" placeholder="'.Core::lang('input_description').'" class="form-control border-input" required>'.$value->{'Description'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('author').'</label>
                                            <input name="author" type="text" placeholder="'.Core::lang('input_author').'" class="form-control border-input" value="'.$value->{'Author'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('language').'</label>
                                            <input name="language" type="text" placeholder="'.Core::lang('input_language').'" class="form-control border-input" value="'.$value->{'Language'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('translator').'</label>
                                            <input name="translator" type="text" placeholder="'.Core::lang('input_translator').'" class="form-control border-input" value="'.$value->{'Translator'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('publisher').'</label>
                                            <input name="publisher" type="text" placeholder="'.Core::lang('input_publisher').'" class="form-control border-input" value="'.$value->{'Publisher'}.'" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input name="isbn" type="text" placeholder="'.Core::lang('input_isbn').'" class="form-control border-input" value="'.$value->{'ISBN'}.'" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('original_released').'</label>
                                            <input name="released" id="firstdate" type="text" placeholder="'.Core::lang('input_original').'" class="form-control border-input" value="'.$value->{'Original_released'}.'" >
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('tags').'</label>';
                                            $datatags = '';
                                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                                $datatags .= $valuetags.', ';
                                            }
                                            $datatags = substr($datatags, 0, -2);
                                            echo '<input name="tags" type="text" placeholder="'.Core::lang('input_tags').'" class="form-control border-input" value="'.$datatags.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('pages').'</label>
                                            <input name="pages" type="text" placeholder="'.Core::lang('input_pages').'" class="form-control border-input" value="'.$value->{'Pages'}.'" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('sample_link').'</label>
                                            <textarea name="samplelink" rows="2" type="text" placeholder="'.Core::lang('input_sample').'" class="form-control border-input" required>'.$value->{'Sample_link'}.'</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('full_link').'</label>
                                            <textarea name="fulllink" rows="2" type="text" placeholder="'.Core::lang('input_full').'" class="form-control border-input" required>'.$value->{'Full_link'}.'</textarea>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeletebook'.$value->{'SubmitBookID'}.'" class="btn btn-danger pull-left '.(($value->{'StatusID'} != '35')?'hidden':'').'">'.Core::lang('delete').'</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">'.Core::lang('cancel').'</button>
                                <button type="submit" name="submitupdatebook'.$value->{'SubmitBookID'}.'" class="btn btn-primary '.(($value->{'StatusID'} != '35')?'hidden':'').'">'.Core::lang('update').'</button>
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

                