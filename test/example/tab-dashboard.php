<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="<?php $_SERVER['PHP_SELF'].'?search='.filter_var($_GET['search'],FILTER_SANITIZE_STRING)?>">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>First Date</label>
                                <input id="firstdate" name="firstdate" type="text" class="form-control border-input" placeholder="First Date" value="<?=((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days")));?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Last Date</label>
                                <input id="lastdate" name="lastdate" type="text" class="form-control border-input" placeholder="Last Date" value="<?=((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d'));?>" required>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-9 col-sm-9 col-xs-12">
                            <div class="form-group">
                                <label>Search</label>
                                <input name="search" type="text" placeholder="Search here..." class="form-control border-input" value="<?php echo $_GET['search']?>">
                            </div>
                            <div class="form-group hidden">
                                <input name="m" type="text" class="form-control border-input" value="3" hidden>
                                <input name="page" type="text" class="form-control border-input" value="1" hidden>
                                <input name="itemsperpage" type="text" class="form-control border-input" value="10" hidden>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-2">
                            <div class="form-group">
                                <label></label>
                                <button name="submitsearch" type="submit" class="btn btn-fill btn-wd ">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><hr>
            <div class="container-fluid">
                <div class="row">
               
<?php 
    $url = Core::getInstance()->api.'/book/report/sales/'.$datalogin['username'].'/all/'.$_GET['page'].'/'.$_GET['itemsperpage'].'/'.$datalogin['token'].'/?firstdate='.((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days"))).'&lastdate='.((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d')).'&query='.$_GET['search'];
    $data = json_decode(Core::execGetRequest($url));

    if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                echo '<div class="col-md-12">
                        <div class="card card-plain">
                            <div class="header">
                                <h4 class="title text-uppercase">Data Report Sales</h4>
                                <p class="category">Message: '.$data->{'message'}.'<br>
                                Shows no: '.$data->metadata->{'number_item_first'}.' - '.$data->metadata->{'number_item_last'}.' from total data: '.$data->metadata->{'records_total'}.'</p>
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
                                    	<th>Date Range</th>
                                    	<th>Book ID</th>
                                    	<th>Title</th>
                                    	<th>Pages</th>
                                        <th>Price</th>
                                        <th>Total Income</th>
                                    	<th>Total Sales</th>
                                        <th>Total Royalti User</th>
                                        <th>Total Royalti Company</th>
                                        <th>Royalti Username</th>
                                    </thead>
                                    <tbody>';
                $n=$data->metadata->{'number_item_first'};
                foreach ($data->results as $name => $value) 
	            {
                    echo '<tr>';
                    echo '<td>' . $n++ .'</td>';
                    echo '<td>' . $value->{'DateRange'} .'</td>';
			        echo '<td>' . $value->{'BookID'} .'</td>';
        			echo '<td>' . $value->{'Title'} .'</td>';
                	echo '<td>' . $value->{'Pages'} .'</td>';
                	echo '<td>' . $value->{'Price'} .'</td>';
            	    echo '<td>' . $value->{'Total_Income'} .'</td>';
    	    		echo '<td>' . $value->{'Total_Sales'} .'</td>';
                    echo '<td>' . $value->{'Total_Royalti_User'} .'</td>';
                    echo '<td>' . $value->{'Total_Royalti_Company'} .'</td>';
                    echo '<td>' . $value->{'Royalti_Username'} .'</td>';
	    	    	echo '</tr>';              
                }
                echo '</tbody>
                </table>';

                echo '</div>
                </div>';

                $pagination = new Pagination;
                echo $pagination->makePagination($data,$_SERVER['PHP_SELF'].'?m=3&firstdate='.((!empty($_GET['firstdate']))?$_GET['firstdate']:date('Y-m-d',strtotime("-30 days"))).'&lastdate='.((!empty($_GET['lastdate']))?$_GET['lastdate']:date('Y-m-d')).'&search='.$_GET['search']);
                
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

                