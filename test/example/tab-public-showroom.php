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
                                <input name="m" type="text" class="form-control border-input" value="22" hidden>
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
    $url = Core::getInstance()->api.'/book/release/data/publish/search/'.$page.'/'.$itemsperpage.'/?apikey='.Core::getInstance()->apikey.'&query='.$search;
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                echo '<div class="col-md-12">
                        <div class="card card-plain">';
                $n=$data->metadata->{'number_item_first'};
                $i=1;
                foreach ($data->results as $name => $value) 
	            {
                    echo '<div class="col-lg-4 col-md-6">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><a href="modul-public-detail.php?m=22&bookid='.$value->{'BookID'}.'&itemsperpage='.$itemsperpage.'"><img src="' . $value->{'Image'} .'" width="80%"></a></div>
                        </div>
                            <div class="text-center"><h3><a href="modul-public-detail.php?m=22&bookid='.$value->{'BookID'}.'&itemsperpage='.$itemsperpage.'">' . $value->{'Title'} .'</a></h3></div>
                            <p class="description text-center">';
                            $datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-public-showroom.php?m=22&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=22&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'BookID'} .'<br /><small>'.Core::lang('bookid').'</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>' . $value->{'Pages'} .'<br /><small>'.Core::lang('pages').'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5><a href="modul-public-showroom.php?m=22&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>'.Core::lang('language').'</small></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:Core::lang('free')) .'<br /><small>'.Core::lang('price').'</small></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5><button type="button" data-toggle="modal" data-target="#DoLogin" class="btn btn-success text-center">'.Core::lang('add_to_library').'</button></h5>
                                    </div>
                                </div>';
                                
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
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=22&search='.$search);
                    
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="DoLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">'.Core::lang('information').'</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>'.Core::lang('information_login').'</p>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <a href="modul-login.php?m=1" class="btn btn-success">'.Core::lang('go_login_page').'</a>
                              </div>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->';
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

                