<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>

<body>
    <div class="wrap">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <?php
                    if(isset($_SESSION['error_woocommerceTemplate']))
                    {
                    ?>
                    <div id="message" class="update error fade">
                        <p style="padding:20px;"><strong>Please switch to an WooCommerce  supported theme before using the products.</strong></p>
                    </div><?php unset($_SESSION['error_woocommerceTemplate']);
                    }
                    ?>

                    <h2><?php _e('Newsletter Preview')?></h2>
						                    <div style="padding-bottom:20px;">
						                                   <form method="post" enctype="application/x-www-form-urlencoded" action="?page=<?php echo $_GET['page']?>&options=fullscreen">
										                    
										
										                        <input type="submit" class="form-control btn button-primary" value="Fullscreen Preview">
						                    </form>
						                    </div>
						                    <form method="post" enctype="application/x-www-form-urlencoded" action="?page=<?php echo $_GET['page']?>&export=true">
										                        <input type="hidden" name="export" value="1">
										
										                        <div id="innerNewsletter" style="widtH:100%; overflow: auto;">
										                            <!-- LOAD TEMPLATE -->
										                            <?php
										                           
										                            		echo $newsletter->render($newsletter->get_tpl());
										                           
										                            ?>
										                        </div>
										
										                        <div style="height:15px;">
										                            &nbsp;
										                        </div>
										                        <!--EXPORT ACTIONS -->
										                        <input type="submit" class="form-control btn button-primary" value="Save & Get HTML Code">
						                    </form>
                </div>

                <div class="col-sm-12 col-md-12 col-lg-5">
                    <form id="form"></form>
                    
                    <div style="height:15px;">
                        &nbsp;
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <form method="post" action="admin.php?page=<?php echo FOLDER?>/index.php&setPostType=<?php echo $post_type?>">
                                <label><?php _e('Post Types')?> <select name="action" id="bulk-action-selector-top" onchange="submit();">
                                    <?php foreach ( $post_types as $post_type ) { ?>

                                    <option value="<?php echo $post_type?>" <?php if($_SESSION['search_posttypes'] == $post_type){?> selected="selected" <?php }?>>
                                        <?php echo $post_type?>
                                    </option><?php } ?>
                                </select></label> <input type="search" id="quicksearch" name="quicksearch" placeholder="<?php echo SEARCH_TITLE?>" autofocus="">
                            </form>
                        </div>

                        <div class="col-md-6">
                            <form method="post" action="admin.php?page=<?php echo $_GET['page']?>&switchTheme=post&ref=quick">
                                <label>Themeswitcher <select name="theme" id="bulk-action-selector-top" onchange="submit();">
                                    <?php  foreach($newsletter->tpls as $templates){ ?>

                                    <option value="<?php echo $templates['folder']?>" <?php if($_SESSION['active_layout'] == $templates['folder']){?> selected="selected"<?php }else if(empty($_SESSION['active_layout']) and $templates['folder'] =="default"){ ?> selected="selected" <?php }?>>
                                        <?php echo $templates['name'][0]?> <?php if($templates['woocommerce'][0] =="yes"){?>(WooCommerce Theme) <?php }?>
                                    </option><?php  } ?>
                                </select></label>
                            </form>
                        </div>
                    </div>

                    <div id="result"></div>

                    <div style="height:15px;">
                        &nbsp;
                    </div>

                    <div id="inforeload" style="display:none;">
                        <h3 style="background-color:white; color:red; padding:5px;">Please reload the page for changes.</h3>
                    </div><?php

                    $positions = WOOCOMMERCE_POSITIONS; 

                    if($_SESSION['search_posttypes'] =="product" and empty($positions)){?>
                    
               			     <?php _e('Please activate WooCommerce supported theme before using products.','wp-newsletter-creator')?>
                   
                    <hr>
                  
                    <?php }?>

                    <form method="post" enctype="application/x-www-form-urlencoded" action="admin.php?page=<?php echo FOLDER?>/index.php&setBlog=1">
                        <table class="widefat" id="list" cellpadding="10">
                            <thead>
                                <tr>
                                    <th>Featured Image</th>

                                    <th>Position</th>

                                    <th>Title</th>

                                    <th>Option</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>Featured Image</th>

                                    <th>Position</th>

                                    <th>Title</th>

                                    <th>Option</th>
                                </tr>
                            </tfoot>

                            <tbody>
                                <?php



                                $args = array( 'post_type' => $_SESSION['search_posttypes'], 'posts_per_page' => 50,'order' => 'DESC', 'orderby' => 'post_date' );
                                $loop = new WP_Query( $args );
                                $i = 1;

                                while ( $loop->have_posts() ) : $loop->the_post();

					  setup_postdata($post);
                                $id = get_the_ID();
                                $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'small_preview' );



                           					   include('inc/post.loop.php');
                             					   if($i < 2){ $i++; }else{ $i = 1; }


				     					  wp_reset_postdata();

                                endwhile;



                                ?>
                            </tbody>
                        </table>
                    </form><br style="clear:both;">
                </div>
            </div>
        </div>
    </div>

