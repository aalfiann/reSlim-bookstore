<?php 
spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!doctype html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <title>Reader - <?php echo Core::getInstance()->title?></title>
	<?php include 'global-meta.php';?>
    <!-- Responsive Iframe -->
    <style>.flexible-container {position:relative;height:0;padding-bottom:100%;overflow:hidden;} .flexible-container iframe, .flexible-container object, .flexible-container embed {position:absolute;top:0;left:0;width:100%;height:100%;}</style>
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
        <?php include 'global-menu.php';?>
    </div>

    <div class="main-panel">
		

            <?php include 'tab-reader.php';?>

            <?php include 'global-footer.php';?>


    </div>
</div>
    <?php include'global-js.php';?>
</body>
</html>
