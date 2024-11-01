<?php defined( 'ABSPATH' ) or die( 'No direct access!' );
/*
Plugin Name: WP Newsletter Creator FREE
Description: Generate with existing Wordpress Content your  HTML Newsletter Code for every Newsletter Hoster like Mailchimp, AWeber, CleverReach & Co.
Version: 1.0
Author: INMEDIA Design
Author URI: http://www.wp-newsletter-creator.com
Text Domain: wp-newsletter-creator-free
*/


if(isset($_GET['options']) and $_GET['options'] =="download"){
	
	if(!empty($_POST['file'])){
		
		
		include('download.php');
	}
	
	
}



		add_action('init', 'newsletter_StartSession_free', 1);
		add_action('wp_logout', 'newsletter_EndSession_free');
		add_action('wp_login', 'newsletter_EndSession_free');
		
		function newsletter_StartSession_free() {
			if(!session_id()) {
				session_start();
			}
		}
		
		function newsletter_EndSession_free() {
			session_destroy();
		}





session_start();
global $wp,$wpdb;

define('FOLDER', basename( dirname( __FILE__ ) ));


if(is_admin()){
   	include("newsletter.free.class.php");

}

	
	if(class_exists('myNewsletter_free')){
	
		$newsletter = new myNewsletter_free();

$newsletter->folder = FOLDER;

define('DEFAULT_TPL', $newsletter->default_template);
define('SEARCH_TITLE','Quick Search');
define('DATABASE_OPTION_NAME' , 'wp-newsletter-generator');
define('MY_NAME_FREE', 'WPNC Free');


if(isset($newsletter->template_positions)){
	define('DEFAULT_TPL_POSITIONS', $newsletter->template_positions);
}
else{
	define('DEFAULT_TPL_POSITIONS', '');
}


if(isset($newsletter->woocommerce_positions)){
	define('WOOCOMMERCE_POSITIONS' , $newsletter->woocommerce_positions);
}else{
	define('WOOCOMMERCE_POSITIONS' ,'');
}





//SETTINGS

if( !function_exists("install_wpnewsletter_settings_free") ) {


	function install_wpnewsletter_settings_free() {
	global  $newsletter;





		$data = get_option(DATABASE_OPTION_NAME.'-background-color');


		if (empty($data)) {

			//DEFAULT SETTINGS
			$data = array(


				'background-color' => '#000',
				'text-color' =>'#000',
				'url-color' => 'red',
				'image-size' => 'large',
				'url-color-2' => 'red',
				'read-more-text' => 'read more',
				'excerpt' => 'yes',
				'excerpt-length' => '30',
				'excerpt-length-long' => '100',

				'blogname'  => 'yes',
				'blogdescription' => 'yes',



				//DYNAMIC CSS

				'first-background-color' => '#FFF',
				'first-headline-color' => '#000',
				'first-text-color' => '#000',
				'first-url-color' => '#000',
				'first-url-border-color' => '#000',

				'box1-headline-color' => '#000',
				'box1-background-color' => '#FFF',
				'box1-url-color' => '#000',
				'box1-url-border-color' => '#000',
				'box1-text-color' => '#000',

				'box2-headline-color' => '#FFF',
				'box2-background-color' => '#000',
				'box2-url-color' => '#FFF',
				'box2-url-border-color' => '#FFF',
				'box2-text-color' => '#FFF',


				'footer-background-color' => '#FFF',
				'footer-url-color' => '#000',
				'footer-text-color' => '#000',





			);

			foreach($data as $settings => $key){



				update_option(DATABASE_OPTION_NAME.'-'.$settings, $key);

			}




		}else{


		}


		





		$data_check_woo = get_option(DATABASE_OPTION_NAME.'-woo-image-size');



		if (empty($data_check_woo)) {

			//DEFAULT SETTINGS
			$data_woo = array(



				'woo-excerpt' => 'yes',
				'woo-excerpt-length' => '20',
				'woo-image-size' => 'shop_catalog',
				'woo-headline-1' => 'Latest Products',
				'woo-read-more-text' => 'buy now'




			);

			foreach($data_woo as $settings => $key){



				update_option(DATABASE_OPTION_NAME.'-'.$settings, $key);

			}


		}





	}

	//ADD SETTINGS
	add_action( 'admin_init', 'install_wpnewsletter_settings_free' );

}


  if (!function_exists('string_limit_words_free')) {

		
		// RESIZE STRINGS
		function string_limit_words_free($string, $word_limit)
		{
		
			$words = explode(' ', $string, ($word_limit + 1));
			if(count($words) > $word_limit)
				array_pop($words);
			return implode(' ', $words);
		
		}
		

}

if (!function_exists('theme_name_scripts_free')) {

		//ADD JAVASCRIPT
		function theme_name_scripts_free() {
			wp_enqueue_script( MY_NAME_FREE, plugins_url( '/assets/js/bootstrap.min.js', __FILE__ ));
		
		}
		add_action( 'admin_init', 'theme_name_scripts_free' );
		

}



if (!function_exists('admin_register_head_free')) {

		
		function admin_register_head_free() {
			$siteurl = get_option('siteurl');
			$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/assets/css/bootstrap.min.css';
			echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
		
			$url = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/assets/css/default.css';
			echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
		
		}
		add_action('admin_head', 'admin_register_head_free');


}




if (!function_exists('wpnewsletter_enqueue_color_picker_free')) {

			
			add_action( 'admin_enqueue_scripts', 'wpnewsletter_enqueue_color_picker_free' );
			function wpnewsletter_enqueue_color_picker_free( $hook_suffix ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wpnewsletter-script', plugins_url('assets/js/wpnewsletter.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
			}
				

}


register_activation_hook(__FILE__, 'install_wpnewsletter_settings_free');



if (!function_exists('newsletter_plugin_top_menu_free')) {
		
		function newsletter_plugin_top_menu_free(){
		
			add_menu_page(MY_NAME_FREE, MY_NAME_FREE, 'read', __FILE__, 'newsletter_index_free',   plugin_dir_url( __FILE__ ). 'images/icon.png' );
//			add_submenu_page(__FILE__, 'History', 'History', 'read', __FILE__.'/history', 'newsletter_history_free');
			add_submenu_page(__FILE__, 'Settings', 'Settings', 'read', __FILE__.'/options', 'newsletter_options_free');
			add_submenu_page(__FILE__, 'Themes', 'Themes', 'read', __FILE__.'/templates', 'newsletter_themes_free');
			add_submenu_page( __FILE__, '*PRO Version*', '*PRO VERSION*' , 'read', __FILE__.'/go-pro-version' , 'proversionwpnc' );
		
		
		
		}

}

	$license_ProVersion  = get_option( 'wp-newsletter-creator-license' );

if(empty($license_ProVersion)){
	
	
	function my_admin_error_notice_upgrade_pro_version() {
		$class = "warning";
		$message = "Upgrade to WPNC Pro Version <a href=\"http://codecanyon.net/item/wp-newsletter-creator/12968685?ref=INMEDIA-DESIGN\" target=\"_blank\" style=\"font-size:22px; font-weight:bold;\">Buy Pro Version now</a>
				";
		echo"<div class=\"updated $class\"> <p>$message</p></div>";
	}
	add_action( 'admin_notices', 'my_admin_error_notice_upgrade_pro_version' );



}



if (!function_exists('proversionwpnc')) {



		
		//OPTIONS PAGE
		function proversionwpnc(){
			global $newsletter;
			
			
			
						
			include("upgradewpnc.php");
		
		}



}



if (!function_exists('newsletter_history_free')) {


		
		//OPTIONS PAGE
		function newsletter_history_free(){
			global $newsletter;
			
			
			
			
			if(isset($_POST) and isset($_POST['delete']) and !empty($_POST['delete'])){
				
				
				//DELETE HISTORY FILE
				
				$file = sanitize_text_field($_POST['delete']);
				
				
				$upload_dir = wp_upload_dir(); 
					$upload_dir = $upload_dir['basedir'];
				$upload_dir = $upload_dir . '/wp-newsletter-creator';
				
				
				if(file_exists($upload_dir . '/'.$file)){
					unlink($upload_dir . '/'.$file);			
		
					
				}
				
				
			}
			
			include("history.php");
		
		}


}



if (!function_exists('newsletter_options_free')) {
		
		//OPTIONS PAGE
		function newsletter_options_free(){
			global $newsletter;
		
		
			if(isset($_POST) and isset($_POST['save']) and $_POST['save'] =="1"){
		
		
				if($newsletter->save_options()){
		
		
					echo'
		<div id="message" class="updated fade"><p><strong>Settings updated.</strong></p></div>
		
		  <hr>';
		
				}
			}
		
		
			include("settings.php");
		
		
		
		
		
		}


}



if (!function_exists('newsletter_themes_free')) {

			
			//THEMES PAGE
			function newsletter_themes_free(){
				global $newsletter;
			
			
				if(isset($_GET['switchTheme']) and isset($_GET['switchTheme'])){
					$switched = true;
			
			
					$newsletter->switchtheme($_GET['switchTheme']);
			
			
			
				}
			
			
				include("templates.php");
			
			}

}




add_action('admin_menu','newsletter_plugin_top_menu_free');


// QUICKSEARCH BY title
add_action( 'wp_ajax_quicksearch', 'quicksearch_free');


if (!function_exists('quicksearch_free')) {

				function quicksearch_free() {
					global $wpdb,$query;
					
					
					include('../wp-load.php');
				
					$str = sanitize_text_field($_POST['query']);
				
				
					if(!empty($str)){
				
				
				
						echo'<hr><b>Search => </b>'.$str.' <hr>';
				
				
						function title_filter( $where = NULL, &$wp_query )
						{
							global $wpdb;
							if ( $search_term = $wp_query->get( 'search_prod_title' ) ) {
								$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $search_term ) ) . '%\'';
							}
							return $where;
						}
				
				
							
							if(!empty($_SESSION['search_posttypes'])){
				
									$typ = $_SESSION['search_posttypes'];
							
							}else{
								
									$typ ='posts';
									
							}
					
						$args = array(
							'post_type' => esc_sql($typ),
							'posts_per_page' => 80,
							'search_prod_title' => $str,
							'post_status' => 'publish',
							'orderby'     => 'title',
							'order'       => 'ASC'
						);
				
						add_filter( 'posts_where', 'title_filter', 10, 2 );
						
						$res = new WP_Query($args);
						
						remove_filter( 'posts_where', 'title_filter', 10, 2 );
				
				
				
				
						echo'							<div style="height:15px;">&nbsp;</div>
				<table class="widefat">
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
				
								';
				
				
						while( $res->have_posts() ) : $res->the_post();
				
						global $post;
				
				
						include("inc/post.loop.php");
				
						endwhile;
				
				
					}
					echo'			</tbody>
								     </table>';
				
				}

}

if (!function_exists('somebit_init_free')) {

function somebit_init_free() {
	global $newsletter;
	if(isset($_GET['switchTheme']) and isset($_POST['theme'])){
		$switched = true;

		$newsletter->check_active_layout();

		if($_GET['switchTheme'] =="post" and !empty($_POST['theme'])){
			$newsletter->switchtheme(sanitize_text_field($_POST['theme']));
		}else{
			$newsletter->switchtheme($_GET['switchTheme']);
		}


		header('LOCATION: admin.php?page='.FOLDER.'/index.php');
	}


}

add_action('init', 'somebit_init_free');

}




if (!function_exists('newsletter_index_free')) {



function newsletter_index_free(){
	global $newsletter;

	$newsletter->check_active_layout();

$noImage =  plugins_url( 'images/missing.png', __FILE__ );



	if(isset($_GET['setBlog'])){



		$newsletter->change_position($_POST['pos'],$_POST['post_id']);


	}
	if(isset($_GET['setPostType']) ){
		$newsletter->set_post_type($_POST['action']);
	}
	if(isset($_GET['delPostType'])){
		$newsletter->delete_post_type($_GET['delPostType']);
	}
	if(isset($_GET['reset'])){
		session_unset();
	}


	$newsletter->createPreview();


	$post_types = get_post_types( '', 'names' );



	if(isset($_GET['export'])){

		$xport = true;
		$newsletter->saveTemplate();





		include('inc/export.info.php');
		echo'<textarea id="editor"  class="textareaPreview" style="width:99%; height:50vh;>';

			echo $newsletter->render($newsletter->get_tpl());

		echo'</textarea> <div id="result"></div>
		
		
	
		
		';

                  
            if(isset($_SESSION['last_file'])){
               
               
               echo'     	<hr>
               
               
               <h2>or download the file as .html to import in your choosen E-Mail Provider</h2>
           
					<label>(This function is only available in Pro Version)	 <input type="submit" class="button-primary" value="'.__("Download .html File").'" id="submitbutton" > </label>
					
		';


		}


	}else{

		echo '<hr>';

		if(isset($_GET['options']) and $_GET['options'] =="fullscreen"){
		
		
			include("fullscreen.preview.php");

		
		
		}else if(isset($_GET['options']) and $_GET['options'] =="preview"){

			include("editor.preview.php");


		
		}else{


			include("editor.php");


		}



	}






}


}




}




?>