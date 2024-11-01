<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?> 
<div class="wrap">
	<div class="container-fluid">
			<div class="row">
						<div class="col-md-12"><h2><?php _e('Your History')?></h2></div>
			</div>
		<hr>
	<table class="widefat">
	<thead>
	    <tr>
	        <th><?php _e('Options')?></th>
	        <th><?php _e('Created')?></th>       
	        <th><?php _e('Template Name')?></th>
	        <th></th>

	    </tr>
	</thead>
	<tfoot>
	    <tr>
	    <th><?php _e('Options')?></th>
	    <th><?php _e('Created')?></th>
	    <th><?php _e('Template Name')?></th>
	    <th></th>

	    </tr>
	</tfoot>
	<tbody>
	<?php  
	$tmp = 0;
	foreach($newsletter->history_files() as $history){   ?>
			<tr>
			
				<td>
					
					
					<div class="col-md-6"><form method="post" action="admin.php?page=<?php echo FOLDER;?>/index.php&options=preview"> 
						<input type="hidden" name="file" value="<?php echo $history['name'];?>">
						 <input type="submit" class="button-primary" value="<?php _e("Preview"); ?>" id="submitbutton">
					 </form>
					 
					</div>
					
					
					
					<div class="col-md-6">		                   
               
                    	<form method="post" action="admin.php?page=<?php echo FOLDER;?>/index.php&options=download"> 
						<input type="hidden" name="file" value="<?php echo $history['name'];?>">
						 <input type="submit" class="button-primary" value="<?php _e("Download .html"); ?>" id="submitbutton">
					 </form>
					</div>
			
			
				 </td>
				<td><?php echo $history['date']?> <?php echo $history['time']?> h</td>
				<td><?php echo $history['name']?></td>

				<td><form method="post" enctype="application/x-www-form-urlencoded" action="admin.php?page=<?php echo FOLDER?>/index.php/history"> <input name="delete" value="<?php echo $history['name']?>" type="hidden"><input type="submit" value="Delete"></form></td>

			</tr>
	<?php $tmp++;}?>
	</tbody>
	</table>		
	<?php if(empty($tmp)){?><div class="col-md-12"><?php _e('First your need to generate and save your first newsletter, all future exports will be listed here.')?></div><?php }?>
	</div>
</div>
