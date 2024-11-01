<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?> 
<?php
//GET THE LOOPED POSTS 
$id = get_the_ID();
$featuredImage2 = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'medium' );
if(empty($featuredImage2[0])){
	 $featuredImage2[0] = $noImage;

}

?>	
		
<tr>	
	<td style="position:relative">
									
												
												
												

<?php if($_SESSION['search_posttypes'] =="product"){?>
			<?php if(!empty($_SESSION['woo_object_'.$id])){?> 
			<a href="media-upload.php?post_id=<?php echo $id?>type=&image&TB_iframe=1" onclick="javascript: jQuery('#inforeload').show();" target="_blank" id="set-post-thumbnail" class="thickbox" style="opacity:0.6"><img src="<?php echo $featuredImage2[0]?>" style="width:100px;"></a>
			<?php }else{ ?>
			<a href="media-upload.php?post_id=<?php echo $id?>type=&image&TB_iframe=1" onclick="javascript: jQuery('#inforeload').show();" target="_blank" id="set-post-thumbnail" class="thickbox"><img src="<?php echo $featuredImage2[0]?>" style="width:100px;"></a>
			<?php }?>
<?php }else{
	
	if(!empty($_SESSION['blog_object_'.$id])){?>
				<a href="media-upload.php?post_id=<?php echo $id?>type=&image&TB_iframe=1" onclick="javascript: jQuery('#inforeload').show();" target="_blank" id="set-post-thumbnail" class="thickbox" style="opacity:0.6"><img src="<?php echo $featuredImage2[0]?>" style="width:100px;"></a>
									
			<?php }else{ ?>
				
				<a href="media-upload.php?post_id=<?php echo $id?>type=&image&TB_iframe=1" onclick="javascript: jQuery('#inforeload').show();" target="_blank" id="set-post-thumbnail" class="thickbox"><img src="<?php echo $featuredImage2[0]?>" style="width:100px;"></a>
		<?php }
	
 }?>		
		
		
		</td>
			<td>
				<form method="post" action="admin.php?page=<?php echo FOLDER?>/index.php&setBlog=1" enctype="application/x-www-form-urlencoded">	
						<select name="pos" class="form-control" style="max-width:50px; float:left;">
							<option value="">-</option>
							<?php if($_SESSION['search_posttypes'] =="product"){?>
										<?php for($i = 1; $i < WOOCOMMERCE_POSITIONS + 1; ++$i) {?>	
										<option value="<?php echo $i?>" <?php if(isset($_SESSION['woo_object_'.$id]) and $_SESSION['woo_object_'.$id] == $i){?> selected="selected" <?php }?>><?php echo $i?></option>			
										<?php }?>
							<?php }else{?>
										<?php for($i = 1; $i < DEFAULT_TPL_POSITIONS + 1; ++$i) {?>	
										<option value="<?php echo $i?>" <?php if(isset($_SESSION['blog_object_'.$id]) and $_SESSION['blog_object_'.$id] == $i){?> selected="selected" <?php }?>><?php echo $i?></option>			
										<?php }?>
							<?php }?>
						</select>
						<?php if($_SESSION['search_posttypes'] =="product"){?><input type="hidden" name="product" value="<?php the_id();?>"><?php }?>
							<input type="hidden" name="post_id" value="<?php the_id();?>">
						<button type="submit" class="button-primary" style=" margin-left:10px; float:left;"><?php _e('Add')?></button>
					</form>
					
			</td>
			<td>	<?php if($_SESSION['search_posttypes'] =="product"){
				
					  if(isset($_SESSION['woo_object_'.$id])){?><b><?php echo string_limit_words_free(get_the_title(),8)?></b><?php }else{?><?php echo string_limit_words_free(get_the_title(),8)?> <?php }?> </td>
				
					<?php }else{?>
							
							<?php  if(isset($_SESSION['blog_object_'.$id])){?><b><?php echo string_limit_words_free(get_the_title(),8)?></b><?php }else{?><?php echo string_limit_words_free(get_the_title(),8)?> <?php }?> </td>
					<?php }?>
			<td>   <a href="#" title="Upgrade to Pro Version">Edit Post</a>
</td>       
			


</tr>