<div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    
<?php 
    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                echo '<div class="col-md-12">
                        <div class="card card-plain">';
                foreach ($data->result as $name => $value) 
	            {
                    $return_arr = null;
				    $names = $value->{'Tags'};	
					$named = preg_split( "/[;,@#]/", $names );
					foreach($named as $name){
					    if ($name != null){$return_arr[] = trim($name);}
					}
                    echo '<div class="col-lg-4 col-md-4">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><img class="lazyload" data-src="' . $value->{'Image'} .'" width="80%"></div>
                        </div>
                            <div class="text-center"><h3>' . $value->{'Title'} .'</h3></div>
                            <p class="description text-center">';$datatags = '';
                            foreach ($return_arr as $name => $valuetags) {
                                $datatags .= '<a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=22&bookid='.$bookid.'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'Pages'} .'<br /><small>'.Core::lang('pages').'</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>'.Core::lang('language').'</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:Core::lang('free')) .'<br /><small>'.Core::lang('price').'</small></h5>
                                    </div>
                                </div>';
                                if (!empty(Core::getInstance()->sharethis)) {
                                    echo '<div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <h5><div class="sharethis-inline-share-buttons"></div><br /></h5>
                                    </div>
                                </div>';
                                }
                                
                            echo '</div>
                            </form>
                        </div>
                    </div>';

                    echo '<div class="col-md-8">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">'.Core::lang('information_detail').'</h4>
                                </div><hr>
                                <div class="content">
                                    <div class="typo-line">
                                        <h2><p class="category">'.Core::lang('title').'</p>'.$value->{'Title'}.'<br><small>';$datatags = '';
                            foreach ($return_arr as $name => $valuetags) {
                                $datatags .= '<a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">'.Core::lang('description').'</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('author').'</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('translator').'</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('language').'</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('type').'</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">'.Core::lang('publisher').'</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
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
                                    <div class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#DoLogin" class="btn btn-info btn-fill btn-wd">'.Core::lang('add_to_library').'</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>';
                }

                echo '<div class="card">
                            <div class="header">
                                <h4 class="title">'.Core::lang('review').'</h4>
                            </div><hr>
                            <div class="content" style="overflow-y: auto; height:600px;">
                                <ul class="list-unstyled team-members">';
                                if (!empty($datareview)){
                                    if ($datareview->{'status'} == "success"){
                                        foreach ($datareview->result as $row => $value) {
                                            echo '<li>
                                                <div class="row">
                                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1">
                                                        <div class="avatar">
                                                            <img data-src="'.((empty($value->{'Avatar'}))?'assets/img/faces/face-0.jpg':$value->{'Avatar'}).'" alt="Circle Image" class="img-circle img-no-padding img-responsive lazyload">
                                                        </div>'.$value->{'Username'}.'
                                                    </div>
                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-11">
                                                    <p class="category" style="border-left: 6px solid grey;padding: 15px">'.$value->{'Detail'}.'</p>
                                                        <blockquote><small>'.$value->{'Created_at'}.'</small></blockquote>
                                                    </div>
                                                </div>
                                            </li>';
                                        }
                                    } else {
                                        echo '<li>
                                                <div class="row">
                                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-11">
                                                    <p class="category" style="border-left: 6px solid pink;padding: 15px">'.$datareview->{'message'}.'</p>
                                                    </div>
                                                </div>
                                            </li>';
                                    }
                                };
                                        echo '</ul>
                            </div>
                        </div>';

                echo '</div>
                    </div>';

                
                    
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

                