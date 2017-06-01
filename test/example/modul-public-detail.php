<?php 
spl_autoload_register(function ($classname) {require ( $classname . ".php");}); 
//Validation url param
$search = filter_var((empty($_GET['search'])?'':$_GET['search']),FILTER_SANITIZE_STRING);
$bookid = filter_var((empty($_GET['bookid'])?'':$_GET['bookid']),FILTER_SANITIZE_STRING);
$itemsperpage = filter_var((empty($_GET['itemsperpage'])?'10':$_GET['itemsperpage']),FILTER_SANITIZE_STRING);

$url = Core::getInstance()->api.'/book/release/data/read/'.$bookid.'/?apikey='.Core::getInstance()->apikey;
$data = json_decode(Core::execGetRequest($url));
//Data Review
$urlreview = Core::getInstance()->api.'/book/review/data/'.$bookid.'/?apikey='.Core::getInstance()->apikey;
$datareview = json_decode(Core::execGetRequest($urlreview));
?>
<!doctype html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <?php 
        if (!empty($data))
        {
            if ($data->{'status'} == "success")
            {
                foreach ($data->result as $name => $value) 
	            {
                    echo '<title>'.$value->{'Title'}.' - '.Core::getInstance()->title.'</title>
                    <meta name="description" content="'.$value->{'Description'}.'">
                    <meta name="keywords" content="'.$value->{'Tags'}.'">
                    <meta itemprop="name" content="'.$value->{'Title'}.'">
                    <meta itemprop="description" content="'.$value->{'Description'}.'">
                    <meta itemprop="image" content="'.$value->{'Image'}.'">
					<meta name="twitter:card" content="summary_large_image" />
					<meta name="twitter:title" content="'.$value->{'Title'}.'" />
					<meta name="twitter:description" content="'.$value->{'Description'}.'" />
					<meta name="twitter:image" content="'.$value->{'Image'}.'" />
                    <meta property="og:title" content="'.$value->{'Title'}.'" />
                    <meta property="og:type" content="product" />
                    <meta property="og:url" content="'.(isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI].'" />
                    <meta property="og:image" content="'.$value->{'Image'}.'" />
					<meta property="og:site_name" content="'.Core::getInstance()->title.'" />
					<meta property="og:price:amount" content="'.$value->{'Price'}.'" />
					<meta property="og:price:currency" content="'.Core::lang('currency_code').'" />
					<meta property="og:availability" content="instock" />';
                }
            } else {
                echo '<title>'.Core::lang('book_detail').' - '.Core::getInstance()->title.'</title>';
            }
        } else {
          echo '<title>'.Core::lang('book_detail').' - '.Core::getInstance()->title.'</title>';  
        }?>
	<?php include 'global-meta.php';?>
    <?php if (!empty(Core::getInstance()->sharethis)){
        echo '<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property='.Core::getInstance()->sharethis.'&product=inline-share-buttons"></script>';
    }?>
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="black" data-active-color="danger">
        <?php include 'global-menu.php';?>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo Core::lang('book_detail')?></a>
                </div>
                <div class="collapse navbar-collapse">
                </div>
            </div>
        </nav>

            <?php include 'tab-public-detail.php';?>

            <?php include 'global-footer.php';?>


    </div>
</div>
    <?php include'global-js.php';?>
</body>
</html>
