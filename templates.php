<?php defined( 'ABSPATH' ) or die( 'No direct access!' ); ?>


<div class="wrap">
	
		<div class="container-fluid">
			<div class="row">
					<div class="col-md-12"><h2><?php _e('Installed Themes')?></h2></div>
			</div>
			
			<hr>
			
			<?php if(isset($switched)){?>

			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success"><b><?php _e('Theme switched successfully!')?></b></div>
				</div>
			</div>
			<hr>
			
			
			<?php }?>
			
					<table class="widefat">
					<thead>
					<tr>
					<th>Screenshot</th>
					<th>Name</th>       
					<th>Author</th>
					<th>Positions in theme</th>
					<th>Responsive</th>
					<th>Optimized for WooCommerce</th>

					</tr>
					</thead>
					<tfoot>
					<tr>
					<th>Screenshot</th>
					<th>Name</th>       
					<th>Author</th>
					<th>Positions in theme</th>
					<th>Responsive</th>
					<th>Optimized for WooCommerce</th>

					</tr>
					</tfoot>
					<tbody>
	
				<?php  
					
				
					foreach($newsletter->tpls as $templates){  ?>
				<tr <?php if($_GET['switchTheme'] ==$templates['folder']){?> bgcolor="#d7fcab"<?php }?>>					 
						 <td><a href="admin.php?page=<?php echo $_GET['page']?>&switchTheme=<?php echo $templates['folder']?>">  <?php if(file_exists(plugin_dir_path( __FILE__ ) .  'themes/'.$templates['folder'].'/'.$templates['screenshot'][0])){?>
						<img src="<?php echo   plugins_url( 'themes/'.$templates['folder'].'/'.$templates['screenshot'][0], __FILE__ );?>" class="img-responsive" style="max-width:100px">	
						<?php
						}else{?>
						<img src="https://placeholdit.imgix.net/~text?txtsize=40&txt=?&w=100&h=100" class="img-responsive">
						<?php }?></a></td>
								<td><?php echo $templates['name'][0]?></td>       
								<td><?php echo $templates['author'][0]?></td>
								<td><?php echo $templates['positions'][0]?></td>
								<td><?php echo $templates['responsive'][0]?></td>	
								<td><?php echo $templates['woocommerce'][0]?> <?php if(!empty($templates['woocommerce_positions'][0])){?><img src="<?php echo plugins_url(  ) . '/'.FOLDER ?>/images/woocommerce_logo.png" width="60"> <?php echo $templates['woocommerce_positions'][0]?> Product Positions <?php }?> </td>	
								
				</tr>
				 <?php  } ?>
			</div>
		</div>


</div>