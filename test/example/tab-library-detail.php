<?php
//Validation url param
$bookid = filter_var((empty($_GET['bookid'])?'':$_GET['bookid']),FILTER_SANITIZE_STRING);
$page = filter_var((empty($_GET['page'])?'1':$_GET['page']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);
?>
<div class="content">
            
            <div class="container-fluid">
                <div class="row">
                    
<?php 
$url = Core::getInstance()->api.'/book/library/data/'.$datalogin['username'].'/read/'.$bookid.'/'.$datalogin['token'];
$data = json_decode(Core::execGetRequest($url));

//Data Review
$urlreview = Core::getInstance()->api.'/book/review/data/'.$bookid.'/?apikey='.Core::getInstance()->apikey;
$datareview = json_decode(Core::execGetRequest($urlreview));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                foreach ($data->result as $row => $value) {
                    if (isset($_POST['submitdeletelibrary'.$value->{'Guid'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'BookID' => $_POST['bookid'],
                            'Username' => $datalogin['username'] //Username of the owner of book
                        );
                        Core::deleteProcess(Core::getInstance()->api.'/book/library/delete',$post_array,'from Library');
                        echo Core::reloadPage();
                    }

                    if (isset($_POST['submitreview'.$value->{'Guid'}]))
                    {
                        $post_array = array(
                            'Token' => $datalogin['token'],
                            'BookID' => $bookid,
                            'Username' => $datalogin['username'], //Username of the owner of book
                            'Detail' => $_POST['review']
                        );
                        Core::createProcess(Core::getInstance()->api.'/book/review/new',$post_array,'Review');
                        echo Core::reloadPage();
                    }
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">';
                foreach ($data->result as $name => $value) 
	            {
                    
                    echo '<div class="col-lg-3 col-md-4">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><img src="' . $value->{'Image_link'} .'" width="80%"></div>
                        </div>
                            <div class="text-center"><h3>' . $value->{'Title'} .'</h3></div>
                            <p class="description text-center">';$datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=22&bookid='.$bookid.'">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'Guid'} .'<br /><small>Unique ID</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>' . (($value->{'Price'} != 0)?$value->{'Price'}:'Free') .'<br /><small>Price</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">' . $value->{'Language'} .'</a><br /><small>Language</small></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>' . $value->{'Status'} .'<br /><small>Status Payment</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>'.(($value->{'StatusID'} == '34')?'<a href="#" data-toggle="modal" data-target="#thankYou">On Library</a>':'<a href="#" data-toggle="modal" data-target="#infoPayment'.$value->{'Guid'}.'">Buy this book</a>').'</h5>
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
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">Description</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Author</p><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Translator</p><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Language</p><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Type</p><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Publisher</p><a href="modul-book-library.php?m=13&page=1&itemsperpage='.$itemsperpage.'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
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
                                    <div class="text-center">';
                                        if ($value->{'Full_link'} == 'You have to make payment first!') {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Sample_file'}.'" class="btn btn-success btn-fill">Read Sample</a>';
                                    } else {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Full_file'}.'" class="btn btn-success btn-fill">Read Complete</a>';}
                            echo $links;
                                    echo '</div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>';
                }

                

                echo '<div class="card">
                            <div class="header">
                                <h4 class="title">Review</h4>
                            </div><hr>
                            <!-- Start Submit Review -->
                            <div class="content '.(($value->{'StatusID'} == '34')?'':'hidden').'">
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=13&bookid='.$bookid.'&page='.$page.'&itemsperpage='.$itemsperpage.'">
                                <div class="form-group">
                                    <textarea name="review" rows="2" class="form-control border-input" placeholder="Here can be your review ..." maxlength="250"></textarea>
                                </div>
                                 <p class="category"><i class="ti-minus"></i> Users can submit only one review in every book<br><i class="ti-minus"></i> Html code is not allowed</p>
                                <div class="text-center">
                                    <button type="submit" name="submitreview'.$value->{'Guid'}.'" class="btn btn-primary" data-dismiss="modal">Submit Review</button>    
                                </div>
                                <hr>
                            </form>
                            </div>
                            <!-- End Submit Review -->
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

                    //Info Payment
                foreach ($data->result as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="infoPayment'.$value->{'Guid'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Payment Information</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=13&bookid='.$bookid.'&itemsperpage='.$itemsperpage.'">
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>For payment information you can contact the admin via Whatsapp: '.Core::getInstance()->hotline.'.<br><br>And do not forget to include a Unique ID code.</p>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <input name="bookid" type="text" class="form-control border-input hidden" value="'.$value->{'BookID'}.'">
                                <button type="submit" name="submitdeletelibrary'.$value->{'Guid'}.'" class="btn btn-danger pull-left">Delete</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->';
                }

                    //Thank you
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="thankYou" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Thank You</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>Your book will be permanently saved in your library as long as ever.<br><br> Thank You.</p>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

                