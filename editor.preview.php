 <?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>
<div class="wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <form method="post" enctype="application/x-www-form-urlencoded" action="?page=<?php echo $_GET['page']?>&export=true">
                        <input type="hidden" name="export" value="1">
			                        <div id="innerNewsletter">
			                            <!-- LOAD TEMPLATE -->
			                            <?php   echo $newsletter->preview($_POST['file']); ?>
			                        </div><!--EXPORT ACTIONS -->
                    </form>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-6">
                    <?php  include('inc/export.info.php'); 
	                    
	                    echo'<textarea id="editor"  class="textareaPreview" style="width:99%; height:50vh; >'; echo $newsletter->preview($_POST['file']); echo'</textarea> <div id="result"></div>'; 
	                 ?>

                    <div id="message" class="updated notice is-dismissible">
                        <p><?php _e('Copy and Paste this Code into your choosen E-Mail Marketing Provider.','wp-newsletter-creator')?></p><button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php _e('Dismiss this notice.','wp-newsletter-creator')?></span></button>
                    </div>
                    
                    
              
					 
                </div><br style="clear:both;">
            </div>
        </div>
</div>
 