<?php 
spl_autoload_register(function ($classname) {require ( $classname . ".php");});
$datalogin = Core::checkSessions();?>
<!doctype html>
<html lang="<?php echo Core::getInstance()->setlang?>">
<head>
    <title><?php echo Core::lang('invoice')?> - <?php echo Core::getInstance()->title?></title>
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
                    <a class="navbar-brand" href="#"><?php echo Core::lang('invoice_data')?></a>
                </div>
                <?php include 'global-nav.php';?>
            </div>
        </nav>

            <?php include 'tab-invoice-library.php';?>

            <?php include 'global-footer.php';?>


    </div>
</div>
    <?php include'global-js.php';?>
    <script type="text/javascript">
        $(function(){
            $("#searchpremium").autocomplete({
                source:function (request, response) {
					$.ajax({
						url: "<?php echo Core::getInstance()->api?>/book/data/completion/premium/<?php echo $datalogin['username']?>/<?php echo $datalogin['token']?>/?query=" + request.term,
						dataType: 'json',
						success: function( data ) {
							if(data.status=='success'){
								response(data.result);
							} else {
								response(null);
							}
						},
						error: function( data ) {
							console.log( "ERROR:  " + data );
						}
					});
				},
                minLength:3,
                search:function(){$(this).addClass('ui-autocomplete-loading');},
                open:function(){$(this).removeClass('ui-autocomplete-loading');},
                delay: 1000,
                autoFocus:true
            });
    	});
    </script>
</body>
</html>
