<?php spl_autoload_register(function ($classname) {require ( $classname . ".php");});$datalogin = Core::checkSessions();
// Redirect to dashboard page
if (Core::getRole($datalogin['token']) == '3') {
    Core::goToPage('modul-book-showroom.php?m=12&page=1&itemsperpage=12&search=');
};?>
<!doctype html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <title><?php echo Core::lang('settings')?> - <?php echo Core::getInstance()->title?></title>
	<?php include 'global-meta.php';?>
</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">
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
                    <a class="navbar-brand" href="#"><?php echo Core::lang('settings')?></a>
                </div>
                <?php include 'global-nav.php';?>
            </div>
        </nav>

            <?php include 'tab-settings.php';?>

            <?php include 'global-footer.php';?>


    </div>
</div>
    <?php include'global-js.php';?>
</body>
</html>
