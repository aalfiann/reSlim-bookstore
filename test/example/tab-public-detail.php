<div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    
<?php 
    $url = Core::getInstance()->api.'/book/release/data/read/'.$_GET['bookid'].'/?apikey='.Core::getInstance()->apikey;
    $data = json_decode(Core::execGetRequest($url));

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
                    echo '<div class="col-lg-3 col-md-4">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><img src="' . $value->{'Image'} .'" width="80%"></div>
                        </div>
                            <div class="text-center"><h3>' . $value->{'Title'} .'</h3></div>
                            <p class="description text-center">';$datatags = '';
                            foreach ($return_arr as $name => $valuetags) {
                                $datatags .= '<a href="modul-public-showroom.php?m=13&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=22&bookid='.$_GET['bookid'].'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'Pages'} .'<br /><small>Pages</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>Language</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:'Free') .'<br /><small>Price</small></h5>
                                    </div>
                                </div>';
                                
                            echo '</div>
                            </form>
                        </div>
                    </div>';

                    echo '<div class="col-md-9">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Information Detail</h4>
                                </div><hr>
                                <div class="content">
                                    <div class="typo-line">
                                        <h2><p class="category">Title</p>'.$value->{'Title'}.'<br><small>';$datatags = '';
                            foreach ($return_arr as $name => $valuetags) {
                                $datatags .= '<a href="modul-public-showroom.php?m=13&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">Description</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Author</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Translator</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Language</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Type</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Publisher</p><a href="modul-public-showroom.php?m=22&page=1&itemsperpage='.$_GET['itemsperpage'].'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Pages</p>'.$value->{'Pages'}.'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Price</p>'.$value->{'Price'}.'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Book ID</p>'.$value->{'BookID'}.'</h5>
                                    </div>
                                    <div class="typo-line '.(empty($value->{'ISBN'})?'hidden':'').'">
                                        <h5><p class="category">ISBN</p>'.$value->{'ISBN'}.'</h5>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" data-toggle="modal" data-target="#DoLogin" class="btn btn-info btn-fill btn-wd">Add to Library</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>';
                }

                echo '</div>
                </div>';

                
                    
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="DoLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Information</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>You should login or create new account.<br><br> Sign up is free and always will be.</p>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <a href="modul-login.php?m=1" class="btn btn-success">Go Login Page</a>
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

                