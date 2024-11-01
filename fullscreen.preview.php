 <?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>
<div class="wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
        <a class="btn button-primary" href="?page=<?php echo $_GET['page']?>">Close Preview</a> <hr>
			                        <div id="innerNewsletter">
			                            <!-- LOAD TEMPLATE -->
			                            <?php  										                            		echo $newsletter->render($newsletter->get_tpl()); ?>
			                        </div><!--EXPORT ACTIONS -->
                </div>

                
            </div>
        </div>
</div>
 