<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flexible-container">
							<iframe src="<?php echo (empty($_GET['file'])?'':Core::getInstance()->basepath.'/plugins/pdf/viewer.php?file='.$_GET['file'])?>" type="application/pdf" width="100%" height="100%" allowFullScreen>
                                <p>Your browser doesn't support iframes. For direct link viewer, just <a href="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>">click here</a>.</p>
                            </iframe>
                        </div>
                        <br>
                        <p class="text-center"><a href="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>/download" download class="btn btn-success"><?php echo Core::lang('download')?></a></p>
                    </div>

                </div>
            </div>
</div>