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
                                <input id="search" name="search" type="text" placeholder="<?php echo Core::lang('search_here')?>" class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="15" hidden>
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
                        if (isset($_POST['submitnewrelease']))
                        {
                            $post_array = array(
                                'Username' => $datalogin['username'],
                                'Token' => $datalogin['token'],
                                'SampleLink' => filter_var($_POST['samplelink'],FILTER_SANITIZE_STRING),
                                'FullLink' => filter_var($_POST['fulllink'],FILTER_SANITIZE_STRING),
                                'ImageLink' => filter_var($_POST['imagelink'],FILTER_SANITIZE_STRING),
                                'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
                                'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
                                'AuthorID' => filter_var($_POST['authorid'],FILTER_SANITIZE_STRING),
                                'LanguageID' => filter_var($_POST['languageid'],FILTER_SANITIZE_STRING),
                                'TranslatorID' => filter_var($_POST['translatorid'],FILTER_SANITIZE_STRING),
                                'PublisherID' => filter_var($_POST['publisherid'],FILTER_SANITIZE_STRING),
                                'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING),
                                'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING),
                                'TypeID' => filter_var($_POST['typeid'],FILTER_SANITIZE_STRING),
                                'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
                                'Pages' => filter_var($_POST['pages'],FILTER_SANITIZE_STRING),
                                'Price' => filter_var($_POST['price'],FILTER_SANITIZE_STRING)                                                              
                            );
                            Core::createProcess(Core::getInstance()->api.'/book/release/new',$post_array,Core::lang('new_release'));
                        }

                        // Data Author
                        $urlauthor = Core::getInstance()->api.'/book/author/data/'.$datalogin['token'];
                        $dataauthor = json_decode(Core::execGetRequest($urlauthor));

                        // Data Language
                        $urllanguage = Core::getInstance()->api.'/book/language/data/'.$datalogin['token'];
                        $datalanguage = json_decode(Core::execGetRequest($urllanguage));

                        // Data Translator
                        $urltranslator = Core::getInstance()->api.'/book/translator/data/'.$datalogin['token'];
                        $datatranslator = json_decode(Core::execGetRequest($urltranslator));

                        // Data Type
                        $urltype = Core::getInstance()->api.'/book/type/data/'.$datalogin['token'];
                        $datatype = json_decode(Core::execGetRequest($urltype));

                        // Data Publisher
                        $urlpublisher = Core::getInstance()->api.'/book/publisher/data/'.$datalogin['token'];
                        $datapublisher = json_decode(Core::execGetRequest($urlpublisher));

                        // Data Status Release
                        $urlstatus = Core::getInstance()->api.'/book/release/status/'.$datalogin['token'];
                        $datastatus = json_decode(Core::execGetRequest($urlstatus));
                    ?>
                    <!-- Start Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('add_new_release')?></h4>
                              </div>
                              <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('image')?></label>
                                            <input name="imagelink" type="text" placeholder="<?php echo Core::lang('input_image')?>" class="form-control border-input" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('title')?></label>
                                            <input name="title" type="text" placeholder="<?php echo Core::lang('title')?>" class="form-control border-input" required>
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
                                            <select name="authorid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <?php if (!empty($dataauthor)) {
                                                            foreach ($dataauthor->result as $name => $valueauthor) {
                                                                echo '<option value="'.$valueauthor->{'AuthorID'}.'">'.$valueauthor->{'Name'}.'</option>';
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('language')?></label>
                                            <select name="languageid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <?php if (!empty($datalanguage)) {
                                                            foreach ($datalanguage->result as $name => $valuelanguage) {
                                                                echo '<option value="'.$valuelanguage->{'LanguageID'}.'">'.$valuelanguage->{'Name'}.'</option>';
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('translator')?></label>
                                            <select name="translatorid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <?php if (!empty($datatranslator)) {
                                                            foreach ($datatranslator->result as $name => $valuetranslator) {
                                                                echo '<option value="'.$valuetranslator->{'TranslatorID'}.'">'.$valuetranslator->{'Name'}.'</option>';
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('type')?></label>
                                            <select name="typeid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <?php if (!empty($datatype)) {
                                                            foreach ($datatype->result as $name => $valuetype) {
                                                                echo '<option value="'.$valuetype->{'TypeID'}.'">'.$valuetype->{'Name'}.'</option>';
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><?php echo Core::lang('publisher')?></label>
                                            <select name="publisherid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">
                                                <?php if (!empty($datapublisher)) {
                                                            foreach ($datapublisher->result as $name => $valuepublisher) {
                                                                echo '<option value="'.$valuepublisher->{'PublisherID'}.'">'.$valuepublisher->{'Name'}.'</option>';
                                                            }
                                                        }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input name="isbn" type="text" placeholder="<?php echo Core::lang('input_isbn')?>" class="form-control border-input" >
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
                                            <label><?php echo Core::lang('price')?></label>
                                            <input name="price" type="text" placeholder="<?php echo Core::lang('input_price')?>" class="form-control border-input" required>
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
                                <button type="submit" name="submitnewrelease" class="btn btn-primary"><?php echo Core::lang('submit')?></button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
                    <div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <button type="submit" class="btn btn-wd" data-toggle="modal" data-target="#myModal"><?php echo Core::lang('add_new_release')?></button>
                            </div>
                        </div>
                    </div>
<?php 
    if (isset($_POST['submitupdaterelease'.(empty($_POST['BookID'])?'':$_POST['BookID'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'SampleLink' => filter_var($_POST['samplelink'],FILTER_SANITIZE_STRING),
            'FullLink' => filter_var($_POST['fulllink'],FILTER_SANITIZE_STRING),
            'ImageLink' => filter_var($_POST['imagelink'],FILTER_SANITIZE_STRING),
            'Title' => filter_var($_POST['title'],FILTER_SANITIZE_STRING),
            'Description' => filter_var($_POST['description'],FILTER_SANITIZE_STRING),
            'AuthorID' => filter_var($_POST['authorid'],FILTER_SANITIZE_STRING),
            'LanguageID' => filter_var($_POST['languageid'],FILTER_SANITIZE_STRING),
            'TranslatorID' => filter_var($_POST['translatorid'],FILTER_SANITIZE_STRING),
            'PublisherID' => filter_var($_POST['publisherid'],FILTER_SANITIZE_STRING),
            'ISBN' => filter_var($_POST['isbn'],FILTER_SANITIZE_STRING),
            'Released' => filter_var($_POST['released'],FILTER_SANITIZE_STRING),
            'TypeID' => filter_var($_POST['typeid'],FILTER_SANITIZE_STRING),
            'Tags' => filter_var($_POST['tags'],FILTER_SANITIZE_STRING),
            'Pages' => filter_var($_POST['pages'],FILTER_SANITIZE_STRING),
            'Price' => filter_var($_POST['price'],FILTER_SANITIZE_STRING),
            'StatusID' => filter_var($_POST['statusid'],FILTER_SANITIZE_STRING),
            'BookID' => filter_var($_POST['bookid'],FILTER_SANITIZE_STRING)
        );
        Core::updateProcess(Core::getInstance()->api.'/book/release/update',$post_array,Core::lang('release_book'));
    }
                
    if (isset($_POST['submitdeleterelease'.(empty($_POST['BookID'])?'':$_POST['BookID'])])){
        $post_array = array(
            'Username' => $datalogin['username'],
            'Token' => $datalogin['token'],
            'BookID' => $_POST['bookid']
        );
        Core::deleteProcess(Core::getInstance()->api.'/book/release/delete',$post_array,Core::lang('from_release'));
    }

    $url = Core::getInstance()->api.'/book/release/data/all/search/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('data_release_book').'</h4>
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
                                    	<th>'.Core::lang('created').'</th>
                                    	<th>'.Core::lang('bookid').'</th>
                                        <th>'.Core::lang('type').'</th>
                                    	<th>'.Core::lang('title').'</th>
                                        <th>'.Core::lang('author').'</th>
                                        <th>'.Core::lang('translator').'</th>
                                        <th>'.Core::lang('language').'</th>
                                        <th>'.Core::lang('publisher').'</th>
                                        <th>'.Core::lang('pages').'</th>
                                        <th>'.Core::lang('price').'</th>
                                        <th>'.Core::lang('status').'</th>
                                        <th>'.Core::lang('manage').'</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'Created_at'} .'</td>';
			        echo '<td>' . $value->{'BookID'} .'</td>';
                    echo '<td>' . $value->{'Type'} .'</td>';
        			echo '<td>' . $value->{'Title'} .'</td>';
                    echo '<td>' . $value->{'Author'} .'</td>';
                	echo '<td>' . $value->{'Translator'} .'</td>';
                	echo '<td>' . $value->{'Language'} .'</td>';
                    echo '<td>' . $value->{'Publisher'} .'</td>';
            	    echo '<td>' . $value->{'Pages'} .'</td>';
                    echo '<td>' . ((empty($value->{'Price'}) || $value->{'Price'}==0)?'Free':$value->{'Price'}) .'</td>';
                    echo '<td>' . $value->{'Status'} .'</td>';
                    echo '<td><a href="#" data-toggle="modal" data-target="#'.$value->{'BookID'}.'"><i class="ti-pencil"></i> '.Core::lang('edit').'</a></td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=15&search='.rawurlencode($search));
                
                echo '</div>';
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="'.$value->{'BookID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.Core::lang('update_release').'</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=15&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('bookid').'</label>
                                            <input name="bookid" type="text" placeholder="'.Core::lang('input_bookid').'" class="form-control border-input" value="'.$value->{'BookID'}.'" readonly>
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
                                            <select name="authorid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($dataauthor)) {
                                                            foreach ($dataauthor->result as $name => $valueauthor) {
                                                                echo '<option value="'.$valueauthor->{'AuthorID'}.'" '.(($valueauthor->{'AuthorID'} == $value->{'AuthorID'})?'selected':'').'>'.$valueauthor->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('language').'</label>
                                            <select name="languageid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datalanguage)) {
                                                            foreach ($datalanguage->result as $name => $valuelanguage) {
                                                                echo '<option value="'.$valuelanguage->{'LanguageID'}.'" '.(($valuelanguage->{'LanguageID'} == $value->{'LanguageID'})?'selected':'').'>'.$valuelanguage->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('translator').'</label>
                                            <select name="translatorid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datatranslator)) {
                                                            foreach ($datatranslator->result as $name => $valuetranslator) {
                                                                echo '<option value="'.$valuetranslator->{'TranslatorID'}.'" '.(($valuetranslator->{'TranslatorID'} == $value->{'TranslatorID'})?'selected':'').'>'.$valuetranslator->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('type').'</label>
                                            <select name="typeid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datatype)) {
                                                            foreach ($datatype->result as $name => $valuetype) {
                                                                echo '<option value="'.$valuetype->{'TypeID'}.'" '.(($valuetype->{'TypeID'} == $value->{'TypeID'})?'selected':'').'>'.$valuetype->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('publisher').'</label>
                                            <select name="publisherid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
                                                if (!empty($datapublisher)) {
                                                            foreach ($datapublisher->result as $name => $valuepublisher) {
                                                                echo '<option value="'.$valuepublisher->{'PublisherID'}.'" '.(($valuepublisher->{'PublisherID'} == $value->{'PublisherID'})?'selected':'').'>'.$valuepublisher->{'Name'}.'</option>';
                                                            }
                                                        }
                                                    echo '</select>
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
                                            <label>'.Core::lang('price').'</label>
                                            <input name="price" type="text" placeholder="'.Core::lang('input_price').'" class="form-control border-input" value="'.$value->{'Price'}.'" required>
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
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>'.Core::lang('status').'</label>
                                            <select name="statusid" type="text" style=\'max-height:200px; overflow-y:scroll; overflow-x:hidden;\' class="form-control border-input">';
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
                                    <input name="BookID" type="text" class="form-control border-input" value="'.$value->{'BookID'}.'" hidden>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="submit" name="submitdeleterelease'.$value->{'BookID'}.'" class="btn btn-danger pull-left">'.Core::lang('delete').'</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">'.Core::lang('cancel').'</button>
                                <button type="submit" name="submitupdaterelease'.$value->{'BookID'}.'" class="btn btn-primary">'.Core::lang('update').'</button>
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

                