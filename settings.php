<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); 
	
	
	
if($newsletter->sys_woocommerce){
                    $woocommerceTitle = 'WooCommerce Settings';
}else{
                     $woocommerceTitle = "<span style='color:red;'>WooCommerce Settings (not activated)</span>";
}


$tabs = array( 'default' => 'Default Settings', 'woo' => $woocommerceTitle, 'translations' => 'Translation' );

if(isset($_GET['tab'])){
                     $current = $_GET['tab'];
}else{
                      $current = 'default'; 
}
              
echo '<div id="icon-themes" class="icon32"><br></div>';
               
               
echo '<h2 class="nav-tab-wrapper">';
foreach( $tabs as $tab => $name ){
   
                    $class = ( $tab == $current ) ? ' nav-tab-active' : '';
  
                    echo "<a class='nav-tab$class' href='?page=".FOLDER."/index.php/options&tab=$tab'>$name</a>";
            
}
echo '</h2>';
            
?>
            
<div class="wrap">


<h3><?php _e('Settings');?></h3>
      
          
            <div id="message" class="error fade">
                <p><strong>Color settings just effect when "Default" Theme is choosen or template is supporting the WPCN Color scheme placeholders.</strong></p>
            </div>

<form method="post" action="admin.php?page=<?php echo FOLDER?>/index.php/options">
          
          
    






            <table class="form-table" <?php if($current =="default"){}else{?> style="display:none;" <?php }?>>

                <tr valign="top">
                    <th scope="row"><?php _e('Background Color')?>:</th>

                    <td><input type="text" class="colorfield" name="background_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-background-color' ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row">
                        <h2>Top Section</h2>
                    </th>

                    <td height="40"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Top Background Color')?>:</th>

                    <td><input type="text" class="colorfield" name="first_background_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-first-background-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Top Headline Color')?>:</th>

                    <td><input type="text" class="colorfield" name="first_headline_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-first-headline-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Top Text Color')?>:</th>

                    <td><input type="text" class="colorfield" name="first_text_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-first-text-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Top URL Color')?>:</th>

                    <td><input type="text" class="colorfield" name="first_url_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-first-url-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Top Link Border Color')?>:</th>

                    <td><input type="text" class="colorfield" name="first_url_border_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-first-url-border-color' ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row">
                        <h2>Box 1</h2>
                    </th>

                    <td height="40"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX1 Background Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box1_background_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box1-background-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX1 Headline Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box1_headline_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box1-headline-color' ); ?>"></td>
                </tr>

   <tr valign="top">
     <th scope="row"><?php _e('BOX1 Text Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box1_text_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box1-text-color' ); ?>"></td>
         </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 1 URL Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box1_url_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box1-url-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 1 URL Border Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box1_url_border_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box1-url-border-color' ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row">
                        <h2>Box 2</h2>
                    </th>

                    <td height="40"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 2 Background Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box2_background_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box2-background-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 2 Headline Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box2_headline_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box2-headline-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 2 Text Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box2_text_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box2-text-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 2 URL Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box2_url_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box2-url-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('BOX 2 Link Color')?>:</th>

                    <td><input type="text" class="colorfield" name="box2_url_border_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-box2-url-border-color' ); ?>"></td>
                </tr>

         <tr>
                    <th scope="row">
                        <h2>Footer Section</h2>
                    </th>

                    <td height="40"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Footer Background Color')?>:</th>

                    <td><input type="text" class="colorfield" name="footer_background_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-footer-background-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Footer Url Color')?>:</th>

                    <td><input type="text" class="colorfield" name="footer_url_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-footer-url-color' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Footer Text')?>:</th>

                    <td><input type="text" class="colorfield" name="footer_text_color" value="<?php echo get_option( DATABASE_OPTION_NAME.'-footer-text-color' ); ?>"></td>
                </tr>

                <tr>
                    <th scope="row">
                        <h2>Settings</h2>
                    </th>

                    <td height="40"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Image Sizes')?>:</th>

                    <td><?php $image_sizes = get_intermediate_image_sizes();  ?><select name="image_size">
                        <?php foreach ($image_sizes as $size_name => $size_attrs): ?>

                        <option value="<?php echo $size_attrs ?>" <?php if(get_option( DATABASE_OPTION_NAME.'-image-size' ) == $size_attrs){?> selected="selected" <?php } ?>>
                            <?php echo $size_attrs ?>
                        </option><?php endforeach; ?>
                    </select></td>
             </tr>

      <tr valign="top">
         <th scope="row"><?php _e('Excerpt')?>:</th>

                    <td><select name="excerpt">
                        <option value="yes" <?php if(get_option( DATABASE_OPTION_NAME.'-excerpt' ) == "yes"){?> selected="selected" <?php } ?>>
                            Yes
                        </option>

                        <option value="no" <?php if(get_option( DATABASE_OPTION_NAME.'-excerpt' ) == "no"){?> selected="selected" <?php } ?>>
                            no
                        </option>
                    </select></td>
                </tr>

                <tr>
                    <th scope="row"><?php _e('Excerpt Length Small Boxes')?>:</th>

                    <td><input type="text" class="" name="excerpt_length" value="<?php echo get_option( DATABASE_OPTION_NAME.'-excerpt-length' ); ?>"> (in words)</td>
                </tr>

                <tr>
                    <th scope="row"><?php _e('Excerpt Length First Box')?>:</th>

                    <td><input type="text" class="" name="excerpt_length_long" value="<?php echo get_option( DATABASE_OPTION_NAME.'-excerpt-length-long' ); ?>"> (in words)</td>
                </tr>

                <tr>
                    <th scope="row"><?php _e('Blogname')?>:</th>

                    <td><select name="blogname">
                        <option value="yes" <?php if(get_option( DATABASE_OPTION_NAME.'-blogname' ) == "yes"){?> selected="selected" <?php } ?>>
                            <?php _e('Yes')?>
                        </option>

                        <option value="no" <?php if(get_option( DATABASE_OPTION_NAME.'-blogname' ) == "no"){?> selected="selected" <?php } ?>>
                            <?php _e('No')?>
                        </option>
                    </select></td>
                </tr>

                <tr>
                    <th scope="row"><?php _e('Blogdescription')?>:</th>

                    <td><select name="blogdescription">
                        <option value="yes" <?php if(get_option( DATABASE_OPTION_NAME.'-blogdescription' ) == "yes"){?> selected="selected" <?php } ?>>
                            <?php _e('Yes')?>
                        </option>

                        <option value="no" <?php if(get_option( DATABASE_OPTION_NAME.'-blogdescription' ) == "no"){?> selected="selected" <?php } ?>>
                            <?php _e('No')?>
                        </option>
                    </select></td>
                </tr>
            </table>
            <table class="form-table" <?php if($current =="translations"){}else{?> style="display:none;" <?php }?>>
                <tr>
                    <td></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('read more')?>:</th>

                    <td><input type="text" class="" name="read_more" value="<?php echo get_option( DATABASE_OPTION_NAME.'-read-more-text' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('buy now')?>:</th>

                    <td><input type="text" class="" name="woo_read_more" value="<?php echo get_option( DATABASE_OPTION_NAME.'-woo-read-more-text' ); ?>"></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Product Headline')?>:</th>

                    <td><input type="text" class="" name="woo_headline_1" value="<?php echo get_option( DATABASE_OPTION_NAME.'-woo-headline-1' ); ?>"></td>
                </tr>
            </table><?php
            if ($newsletter->sys_woocommerce){      ?>

            <table class="form-table" <?php if($current =="woo"){}else{?> style="display:none;" <?php }?>>
                <tr>
                    <td></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Image Sizes')?>:</th>

                    <td><?php $woo_image_sizes = get_intermediate_image_sizes();  ?><select name="woo_image_size">
                        <?php foreach ($woo_image_sizes as $size_name => $size_attrs): ?>

                        <option value="<?php echo $size_attrs ?>" <?php if(get_option( DATABASE_OPTION_NAME.'-woo-image-size' ) == $size_attrs){?> selected="selected" <?php } ?>>
                            <?php echo $size_attrs ?>
                        </option><?php endforeach; ?>
                    </select></td>
                </tr>

                <tr valign="top">
                    <th scope="row"><?php _e('Excerpt')?>:</th>

                    <td><select name="woo_excerpt">
                        <option value="yes" <?php if(get_option( DATABASE_OPTION_NAME.'-woo-excerpt' ) == "yes"){?> selected="selected" <?php } ?>>
                            Yes
                        </option>

                        <option value="no" <?php if(get_option( DATABASE_OPTION_NAME.'-woo-excerpt' ) == "no"){?> selected="selected" <?php } ?>>
                            no
                        </option>
                    </select></td>
                </tr>

                <tr>
                    <th scope="row"><?php _e('Excerpt Length')?>:</th>

                    <td><input type="text" class="" name="woo_excerpt_length" value="<?php echo get_option( DATABASE_OPTION_NAME.'-woo-excerpt-length' ); ?>"> (in words)</td>
                </tr>
            </table><?php 
                    
                    }else{
                    ?>
            <hr>

            <div>
                <?php _e('WooCommerce is not installed or not activated. To use this feature please install or activate WooCommerce.')?>
            </div><?php
                    
                    }
                    
                    ?><input type="hidden" name="save" value="1"> <?php submit_button(); ?>
        </form>
    </div>

