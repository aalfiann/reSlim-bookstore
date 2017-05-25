<div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    
<?php 
    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                foreach ($data->result as $row => $value) {
                    if (isset($_POST['submitaddlibrary'.$value->{'BookID'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'BookID' => $value->{'BookID'},
                            'Price' => $value->{'Price'},
                            'Username' => $datalogin['username'] //Username of user login
                        );
                        Core::createProcess(Core::getInstance()->api.'/book/library/new',$post_array,'to Library');
                        echo Core::reloadPage();
                    }
                }

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
                                $datatags .= '<a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=22&bookid='.$bookid.'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'Pages'} .'<br /><small>Pages</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>Language</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:'Free') .'<br /><small>Price</small></h5>
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

                    echo '<div class="col-md-9">
                            <div class="card">
                                <div class="header">
                                    <h4 class="title">Information Detail</h4>
                                </div><hr>
                                <div class="content">
                                    <div class="typo-line">
                                        <h2><p class="category">Title</p>'.$value->{'Title'}.'<br><small>';$datatags = '';
                            foreach ($return_arr as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">Description</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Author</p><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Translator</p><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Language</p><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Type</p><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Publisher</p><a href="modul-book-showroom.php?m=12&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Pages</p>'.$value->{'Pages'}.'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Price</p>' . (($value->{'Price'} != 0)?$value->{'Price'}:'Free') .'</h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Book ID</p>'.$value->{'BookID'}.'</h5>
                                    </div>
                                    <div class="typo-line '.(empty($value->{'ISBN'})?'hidden':'').'">
                                        <h5><p class="category">ISBN</p>'.$value->{'ISBN'}.'</h5>
                                    </div>
                                    <div class="typo-line '.(empty($value->{'Original_released'})?'hidden':'').'">
                                        <h5><p class="category">Original Released</p>'.$value->{'Original_released'}.'</h5>
                                    </div>
                                    <div class="text-center">
                                        <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=12&bookid='.$bookid.'&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
                                            <button type="submit" name="submitaddlibrary'.$value->{'BookID'}.'" class="btn btn-success btn-fill">Add to Library</button>
                                        </form>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>';
                }

                echo '<div class="card">
                            <div class="header">
                                <h4 class="title">Review</h4>
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
                                                            <img src="'.((empty($value->{'Avatar'}))?'assets/img/faces/face-0.jpg':$value->{'Avatar'}).'" alt="Circle Image" class="img-circle img-no-padding img-responsive">
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

                    echo '</div>';
            } else
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

                