<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'50':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
					<p class="text-center">
                    <?php 
					if (empty($search)) {
						$chars = '# - ';
					} else {
						$chars = '<b><a href="'.$_SERVER['PHP_SELF'].'?m=13&search=">#</a></b> - ';
					}
                        foreach (range('A', 'Z') as $char) {
							if ($search != $char){
								$chars .= '<b><a href="'.$_SERVER['PHP_SELF'].'?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$char.'">'.$char . '</a></b> - ';
							} else {
								$chars .= $char . " - ";
							}
                        }
						$chars = substr($chars, 0, -3);
						echo $chars;
                    ?>
					</p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-wd btn-default" data-toggle="modal" data-target="#index"><?php echo Core::lang('index_menu')?></button>
                        </div>
                    </div>
                </div>
            </div><hr>
                    <!-- Start Modal -->
                        <div class="modal fade" id="index" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><?php echo Core::lang('index_menu')?></h4>
                              </div>
                              
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <a href="modul-index-author-library.php?m=13" class="btn btn-fill btn-block btn-primary"><?php echo Core::lang('index_list')?> <?php echo Core::lang('author')?></a>
                                        </div>
                                        <div class="form-group">
                                            <a href="modul-index-tags-library.php?m=13" class="btn btn-fill btn-block btn-info"><?php echo Core::lang('index_list')?> <?php echo Core::lang('tags')?></a>
                                        </div>
                                        <div class="form-group">
                                            <a href="modul-index-title-library.php?m=13" class="btn btn-fill btn-block btn-success"><?php echo Core::lang('index_list')?> <?php echo Core::lang('title')?></a>
                                        </div>
                                        <div class="form-group">
                                            <a href="modul-index-publisher-library.php?m=13" class="btn btn-fill btn-block btn-warning"><?php echo Core::lang('index_list')?> <?php echo Core::lang('publisher')?></a>
                                        </div>
                                        <div class="form-group">
                                            <a href="modul-index-type-library.php?m=13" class="btn btn-fill btn-block btn-danger"><?php echo Core::lang('index_list')?> <?php echo Core::lang('type')?></a>
                                        </div>
                                        <div class="form-group">
                                            <a href="modul-index-translator-library.php?m=13" class="btn btn-fill btn-block btn-default"><?php echo Core::lang('index_list')?> <?php echo Core::lang('translator')?></a>
                                        </div>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Core::lang('close')?></button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->
            <div class="container-fluid">
                <div class="row">
               
<?php 
    $url = Core::getInstance()->api.'/book/data/index/author/library/'.$datalogin['username'].'/'.$datalogin['token'].'/'.$page.'/'.$itemsperpage.'/?query='.rawurlencode($search);
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">'.Core::lang('data_author').'</h4>
                                <p class="category">
                                '.Core::lang('shows_no').': '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' '.Core::lang('from_total_data').': '.$data->metadata->{'records_total'}.'</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table id="export" class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                    	<th>'.Core::lang('author').'</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td style="width:100px">' . $n++ .'</td>';
					echo '<td><a href="modul-book-library.php?m=13&page=1&itemsperpage=12&search='.$value->{'Author'}.'">' . $value->{'Author'} .'</a></td>';
        			echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=13&search='.rawurlencode($search));
                
                echo '</div>';
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

                