<?php 
spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!doctype html>
<html>
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="assets/img/reslim.ico">
<link rel="icon" type="image/png" sizes="96x96" href="assets/img/reslim.ico">
<link rel="canonical" href="<?php echo (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1, user-scalable=0' name='viewport' />
<meta name="format-detection" content="telephone=no"/>
<title>Reader - <?php echo Core::getInstance()->title?></title>
<!-- Responsive Iframe -->
<style>.flexible-container {position:relative;height:auto;min-height:800px;padding-bottom:100%;overflow:hidden;} .flexible-container iframe, .flexible-container object, .flexible-container embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>
</head>
<body style="margin:0;padding:0;">
<div class="flexible-container">
<iframe src="<?php echo (empty($_GET['file'])?'':Core::getInstance()->basepath.'/plugins/pdf/viewer.php?file='.$_GET['file'])?>" type="application/pdf" allowFullScreen>
<p>Your browser doesn't support iframes. For direct link viewer, just <a href="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>">click here</a>.</p>
</iframe>
</div>
<?php include 'analytics.php';?>
</body>
</html>