<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="flexible-container">
                            <object data="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>" type="application/pdf" width="100%" height="100%">
                                <param name="allowFullScreen" value="true">
                                <embed src="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>" type="application/pdf" width="100%" height="100%" allowFullScreen="true">
                            </object>
                        </div>
                        <br>
                        <p class="text-center"><a href="<?php echo (empty($_GET['file'])?'':$_GET['file'])?>/download" download class="btn btn-success">Download</a></p>
                    </div>

                </div>
            </div>
</div>