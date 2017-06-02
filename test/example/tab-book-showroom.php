<?php 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($_GET['search'],FILTER_SANITIZE_STRING)?>">
                        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <input name="search" type="text" placeholder="<?php echo Core::lang('search_here')?>" class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="12" hidden>
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
    $url = Core::getInstance()->api.'/book/release/data/showroom/'.$datalogin['username'].'/search/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?query='.$search;
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                foreach ($data->results as $row => $value) {
                    if (isset($_POST['submitaddlibrary'.$value->{'BookID'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'BookID' => $value->{'BookID'},
                            'Price' => $value->{'Price'},
                            'Username' => $datalogin['username'] //Username of user login
                        );
                        Core::createProcess(Core::getInstance()->api.'/book/library/new',$post_array,Core::lang('to_library'));
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">';
                $n=$data->metadata->{'number_item_first'};
                $i=1;
                foreach ($data->results as $name => $value) 
	            {
                    echo '<div class="col-lg-4 col-md-6">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><a href="#" data-toggle="modal" data-target="#view'.$value->{'BookID'}.'"><img class="lazyload" data-src="' . $value->{'Image'} .'" width="80%"></a></div>
                        </div>
                            <div class="text-center"><h3><a href="#" data-toggle="modal" data-target="#view'.$value->{'BookID'}.'">' . $value->{'Title'} .'</a></h3></div>
                            <p class="description text-center">';
                            $datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'BookID'} .'<br /><small>'.Core::lang('bookid').'</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>' . $value->{'Pages'} .'<br /><small>'.Core::lang('pages').'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>'.Core::lang('language').'</small></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:Core::lang('free')) .'<br /><small>'.Core::lang('price').'</small></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><button type="submit" name="submitaddlibrary'.$value->{'BookID'}.'" class="btn btn-success text-center">'.Core::lang('add_to_library').'</button></h5>
                                    </div>
                                </div>';
                                if ($value->{'Price'} != 0) {
                                    if ($value->{'Sample_link'} != '' || !empty($value->{'Sample_link'})){
                                        echo '<div class="row">
                                            <div class="col-md-12">
                                            <h5><a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Sample_file'}.'">'.Core::lang('read_sample').'</a><br /><small>'.Core::lang('download').'</small></h5>
                                            </div>
                                        </div>';
                                    }
                                };
                            echo '</div>
                            </form>
                        </div>
                    </div>';
                    if ($i%3==0){
						echo '<div class="clearfix visible-lg-block"></div>';
					}
					if ($i%2==0){
						echo '<div class="clearfix visible-md-block"></div>';
					}
					$i++;
                }

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=12&search='.$search);

                //View Detail
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="view'.$value->{'BookID'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.Core::lang('information_detail').'</h4>
                              </div>
                              <div class="modal-body">
                                
                                    <div class="typo-line">
                                        <h2><p class="category">'.Core::lang('title').'</p>'.$value->{'Title'}.'<br><small>';
                                        $datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">'.Core::lang('description').'</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('author').'</p><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('translator').'</p><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('language').'</p><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('type').'</p><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('publisher').'</p><a href="modul-book-showroom.php?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('pages').'</p>'.$value->{'Pages'}.'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('price').'</p>' . (($value->{'Price'} != 0)?$value->{'Price'}:Core::lang('free')) .'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('bookid').'</p>'.$value->{'BookID'}.'</h5>
                                    </div>
                                    <div class="typo-line '.(empty($value->{'ISBN'})?'hidden':'').'">
                                        <h5><p class="category">ISBN</p>'.$value->{'ISBN'}.'</h5>
                                    </div>
                                    <div class="typo-line '.(empty($value->{'Original_released'})?'hidden':'').'">
                                        <h5><p class="category">'.Core::lang('original_released').'</p>'.$value->{'Original_released'}.'</h5>
                                    </div>
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">'.Core::lang('close').'</button>
                              <a href="modul-showroom-detail.php?m=12&bookid='.$value->{'BookID'}.'&page='.$page.'&itemsperpage='.$itemsperpage.'" class="btn btn-primary  pull-left">'.Core::lang('show_detail').'</a>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=12&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                                <button type="submit" name="submitaddlibrary'.$value->{'BookID'}.'" class="btn btn-success btn-fill">'.Core::lang('add_to_library').'</button>
                              </form>
                              </div>
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

                