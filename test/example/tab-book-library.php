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
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $search?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="13" hidden>
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
    $url = Core::getInstance()->api.'/book/library/data/'.$datalogin['username'].'/search/'.$page.'/'.$itemsperpage.'/'.$datalogin['token'].'/?query='.$search;
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {

                foreach ($data->results as $row => $value) {
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
                }

                echo '<div class="col-md-12">
                        <div class="card card-plain">';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<div class="col-lg-3 col-md-4">
                        <div class="card card-user">
                        <div class="row">
                            <div class="text-center"><a href="#" data-toggle="modal" data-target="#view'.$value->{'Guid'}.'"><img src="' . $value->{'Image_link'} .'" width="80%"></a></div>
                        </div>
                            <div class="text-center"><h3><a href="#" data-toggle="modal" data-target="#view'.$value->{'Guid'}.'">' . $value->{'Title'} .'</a></h3></div>
                            <p class="description text-center">';
                            $datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</p>
                            <hr>
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-md-3 col-md-offset-1">
                                        <h5>' . $value->{'Guid'} .'<br /><small>Unique ID</small></h5>
                                    </div>
                                    <div class="col-md-4">
                                        <h5>' . (($value->{'Price'} == 0)?'Free':$value->{'Price'}) .'<br /><small>Price</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>' . $value->{'Language'} .'<br /><small>Language</small></h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>' . $value->{'Status'} .'<br /><small>Status Payment</small></h5>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>'.(($value->{'StatusID'} == '34')?'<a href="#" data-toggle="modal" data-target="#thankYou">On Library</a>':'<a href="#" data-toggle="modal" data-target="#infoPayment'.$value->{'Guid'}.'">Buy this book</a>').'</h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">';
                                    if ($value->{'Full_link'} == 'You have to make payment first!') {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Sample_file'}.'">Read Sample</a>';
                                    } else {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Full_file'}.'">Read Complete</a>';}
                                        echo '<h5>'.$links.'<br /><small>Download</small></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=13&search='.$search);
                
                //Info Payment
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="infoPayment'.$value->{'Guid'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Payment Information</h4>
                              </div>
                              <form method="post" action="'.$_SERVER['PHP_SELF'].'?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$search.'">
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

                //View Detail
                foreach ($data->results as $name=>$value){
                    echo '<!-- Start Modal -->
                        <div class="modal fade" id="view'.$value->{'Guid'}.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Information Detail</h4>
                              </div>
                              <!-- Start Modal Body -->
                              <div class="modal-body">
                                
                                    <div class="typo-line">
                                        <h2><p class="category">Title</p>'.$value->{'Title'}.'<br><small>';
                                        $datatags = '';
                            foreach ($value->{'Tags'} as $name => $valuetags) {
                                $datatags .= '<a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$valuetags.'">'.$valuetags.'</a>, ';
                            }
                            $datatags = substr($datatags, 0, -2);
                            echo $datatags.'</small> </h2>
                                    </div>
                                    <div class="typo-line">
                                        <p><span class="category">Description</span>'.$value->{'Description'}.'</p>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Author</p><a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Author'}.'">'.$value->{'Author'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Translator</p><a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Translator'}.'">'.$value->{'Translator'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Language</p><a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Language'}.'">'.$value->{'Language'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Type</p><a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Type'}.'">'.$value->{'Type'}.'</a></h5>
                                    </div>
                                    <div class="typo-line">
                                        <h5><p class="category">Publisher</p><a href="modul-book-library.php?m=13&page='.$page.'&itemsperpage='.$itemsperpage.'&search='.$value->{'Publisher'}.'">'.$value->{'Publisher'}.'</a></h5>
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
                                    <div class="typo-line">
                                        <h5><p class="category">Status</p>'.(($value->{'StatusID'} == '34')?'<a href="#" data-toggle="modal" data-target="#thankYou">On Library</a>':'<a href="#" data-toggle="modal" data-target="#infoPayment'.$value->{'Guid'}.'">Buy this book</a>').'</h5>
                                    </div>
                              </div> 
                              <!-- End Modal Body -->
                              <div class="modal-footer">';
                                if ($value->{'Full_link'} == 'You have to make payment first!') {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Sample_file'}.'" class="btn btn-success btn-fill">Read Sample</a>';
                                    } else {$links = '<a href="'.Core::getInstance()->api.'/user/upload/stream/'.$datalogin['token'].'/'.$value->{'Full_file'}.'" class="btn btn-success btn-fill">Read Complete</a>';}
                            echo $links.' 
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <!-- End Modal -->';
                }
                
                    foreach ($data->results as $name=>$value){
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
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                <a href="modul-library-detail.php?m=13&bookid='.$value->{'BookID'}.'&page='.$page.'&itemsperpage='.$itemsperpage.'" class="btn btn-primary">Submit Review</a>
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

                