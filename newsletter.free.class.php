<?php defined( 'ABSPATH' ) or die( 'No direct access!' );


if(!class_exists('myNewsletter_free')){
	
	
class myNewsletter_free{



	public function __construct($user = NULL){


		$this->user = $user;

		$this->folder = FOLDER;
		
		if(empty($_SESSION['search_posttypes'])){
			$_SESSION['posttypes']['post'] ='post';
			$_SESSION['search_posttypes'] ='post';
		}



		if(empty($_SESSION['active_layout'])){

			
			$read = simplexml_load_file( plugin_dir_path( __FILE__ ).'themes/default/config.xml');
			$this->default_template = 'default/'.$read->file;
			$this->template_positions = $read->positions;
			$this->woocommerce_positions = $read->woocommerce_positions;
		}
		else{
			$this->default_template = $this->check_active_layout();
		}





		//CHECK IF WOOCOMMERCE IS INSTALLED AND ACTIVATED
		if ( class_exists( 'WooCommerce' ) ) {
		$this->sys_woocommerce = true;
		}else{
		$this->sys_woocommerce = false;
		}


		$dir =   plugin_dir_path( __FILE__ ).'themes/';

		$templates = scandir($dir, 1);

		$this->tpls = array();
		
								foreach($templates as $tpl){
															if($tpl !='.' and $tpl !='..'){
																
																
																
																										if(file_exists( plugin_dir_path( __FILE__ ).'themes/'.$tpl.'/config.xml')) 
																										{ 
																											
																																																	
																											$read = simplexml_load_file( plugin_dir_path( __FILE__ ).'/themes/'.$tpl.'/config.xml');
																						
																																if(!empty($read)){
																											
																											
																																	$this->tpls[]  = array(
																																		'name' => $read->name,
																																		'screenshot' => $read->screenshot,
																																		'responsive' =>$read->responsive,
																																		'positions' => $read->positions,
																																		'date' => $read->date,
																																		'file' => $read->file,
																																		'author' => $read->author,
																																		'folder' => $tpl ,
																																		'woocommerce' => $read->woocommerce,
																																		'woocommerce_positions' => $read->woocommerce_positions,
																																		'xml' => $read);
																											
																																}else{
																																}
																										}
																	
															}
						
								}




	}



	//CHECK LICENSE
	public function check_licence(){
		$license  = get_option( DATABASE_OPTION_NAME.'-license');
		if($license == md5('wpnewslettergenerator')){
			return true;
		}else{
			return false;
		}
	}







	//SAVE LICENCE
	public function saveLicense($license){
		update_option(DATABASE_OPTION_NAME.'-license', $license);
	}







	//SAVE OPTIONS
	public function save_options(){



		if(empty($_POST)){

			return false;

		}else{

			foreach($_POST as $post => $key){
				$$post = $key;
			}



			// UPDATE OPTIONS
			update_option(DATABASE_OPTION_NAME.'-background-color', $background_color);
			update_option(DATABASE_OPTION_NAME.'-url-color', $url_color);
			update_option(DATABASE_OPTION_NAME.'-image-size', $image_size);
			update_option(DATABASE_OPTION_NAME.'-text-color', $text_color);
			update_option(DATABASE_OPTION_NAME.'-url-color-2', $url_color_secondary);
			update_option(DATABASE_OPTION_NAME.'-excerpt', $excerpt);
			update_option(DATABASE_OPTION_NAME.'-excerpt-length', $excerpt_length);
			update_option(DATABASE_OPTION_NAME.'-excerpt-length-long', $excerpt_length_long);
			update_option(DATABASE_OPTION_NAME.'-blogname', $blogname);
			update_option(DATABASE_OPTION_NAME.'-blogdescription', $blogdescription);
			//DYNAMIC CSS
			update_option(DATABASE_OPTION_NAME.'-first-background-color', $first_background_color);
			update_option(DATABASE_OPTION_NAME.'-first-headline-color', $first_headline_color);
			update_option(DATABASE_OPTION_NAME.'-first-text-color', $first_text_color);
			update_option(DATABASE_OPTION_NAME.'-first-url-color', $first_url_color);
			update_option(DATABASE_OPTION_NAME.'-first-url-border-color', $first_url_border_color);
			update_option(DATABASE_OPTION_NAME.'-box1-background-color', $box1_background_color);
			update_option(DATABASE_OPTION_NAME.'-box1-headline-color', $box1_headline_color);
			update_option(DATABASE_OPTION_NAME.'-box1-url-color', $box1_url_color);
			update_option(DATABASE_OPTION_NAME.'-box1-url-border-color', $box1_url_border_color);
			update_option(DATABASE_OPTION_NAME.'-box1-text-color', $box1_text_color);
			update_option(DATABASE_OPTION_NAME.'-box2-background-color', $box2_background_color);
			update_option(DATABASE_OPTION_NAME.'-box2-headline-color', $box2_headline_color);
			update_option(DATABASE_OPTION_NAME.'-box2-text-color', $box2_headline_color);
			update_option(DATABASE_OPTION_NAME.'-box2-url-color', $box2_url_color);
			update_option(DATABASE_OPTION_NAME.'-box2-url-border-color', $box2_url_border_color);
			update_option(DATABASE_OPTION_NAME.'-footer-background-color', $footer_background_color);
			update_option(DATABASE_OPTION_NAME.'-footer-url-color', $footer_url_color);
			update_option(DATABASE_OPTION_NAME.'-footer-text-color', $footer_text_color);
			//WOO SAVE
			update_option(DATABASE_OPTION_NAME.'-woo-excerpt', $woo_excerpt);
			update_option(DATABASE_OPTION_NAME.'-woo-excerpt-length', $woo_excerpt_length);
			update_option(DATABASE_OPTION_NAME.'-woo-image-size', $woo_image_size);
			//TRANSLATIONS
			update_option(DATABASE_OPTION_NAME.'-read-more-text', $read_more);
			update_option(DATABASE_OPTION_NAME.'-woo-headline-1', $woo_headline_1);
			update_option(DATABASE_OPTION_NAME.'-woo-read-more-text', $woo_read_more);

			return true;


		}

	}







	public function get_tpl(){
		return $this->default_template;
	}







	public function saveTemplate(){

		$upload = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/wp-newsletter-creator';

		if (! is_dir($upload_dir)) {
			mkdir( $upload_dir, 0700 );
		}


		$date = new DateTime('Europe/Berlin');
		$date = $date->format('d_m_Y_#H_i_s');


		$file = $upload_dir . "/newsletter-".$date.".html";
		$myString = $this->render($this->get_tpl());
		file_put_contents($file, $myString);


		if(file_exists('../wp-content/uploads/wp-newsletter-creator/newsletter-'.$date.'.html')){



			$_SESSION['last_file'] = 'newsletter-'.$date.'.html';


		}



	}


	public function preview($file){

		$upload = wp_upload_dir();



		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/wp-newsletter-creator';


		$dir =  $upload_dir . '/' .$file;
		if(file_exists($dir)){

			$the_template = file_get_contents($dir);
			return $the_template;

		}


	}

	public function history_files(){



		$upload = wp_upload_dir();
		$upload_dir = $upload['basedir'];
		$upload_dir = $upload_dir . '/wp-newsletter-creator';


		$history = scandir($upload_dir);



		$this->history = array();


		foreach($history as $row){


			if($row !='.' and $row !='..' and $row !='.DS_Store'){


				$time = explode('-', $row);
				$date = explode('#', $time[1]);
				$time = explode('.',$date[1]);
				
				
				
				if(isset($time[0])){
					
				$time = str_replace('_',':',$time[0]);

				}
				$date = str_replace('_','/',$date[0]);

				$this->history[] = array('id'=> $date.'-'.$time, 'name' => $row, 'date' => $date, 'time' => $time);




			}


		}




		array_multisort($this->history,SORT_ASC, SORT_STRING);

		return $this->history;


	}


	public function createPreview(){







		if(empty($_SESSION['blog_pos_1'])){


			$size = get_option( DATABASE_OPTION_NAME.'-image-size' );

			if(empty($size)){

				$size = 'large';

			}



			$args = array('post_type' => $_SESSION['posttypes'],  'posts_per_page' => 40, 'order' => 'DESC', 'orderby' => 'post_date' );
			$loop = new WP_Query( $args );
			$i = 1;
			$s = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();

			$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size );

			if(!empty($featuredImage[0]) and $s<=$this->template_positions){


				$_SESSION[$s] =  $id;
				$_SESSION['blog_object_'.$id] = $s;
				$_SESSION['blog_pos_'.$s] = $s;





				$_SESSION[$s] =  $id;
				$_SESSION['blog_object_'.$id] = $s;
				$_SESSION['blog_pos_'.$s] = $id;



				$s++;
			}





			endwhile;

		}




		if($this->sys_woocommerce){



			if(empty($_SESSION['woo_pos_1'])){





				$args = array('post_type' => 'product',  'posts_per_page' => 40, 'order' => 'DESC', 'orderby' => 'post_date' );
				$loop = new WP_Query( $args );
				$i = 1;
				$s = 1;


				$size = get_option( DATABASE_OPTION_NAME.'-woo-image-size' );
				if(empty($size)){

					$size = 'shop_thumbnail';

				}



				while ( $loop->have_posts() ) : $loop->the_post();
				$id = get_the_ID();

				$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size );

				if(!empty($featuredImage[0]) and $s<=$this->template_positions){


					$_SESSION['woo_'.$s] =  $id;
					$_SESSION['woo_object_'.$id] = $s;
					$_SESSION['woo_pos_'.$s] = $s;




					$_SESSION['woo_'.$s] =  $id;
					$_SESSION['woo_object_'.$id] = $s;
					$_SESSION['woo_pos_'.$s] = $id;



					$s++;
				}





				endwhile;

			}





		}
		else{



								
								
								//CHECK FOR WOOCOMMERCE POSITIONS

								if($this->woocommerce_positions){
									foreach($_SESSION as $session => $row){
										if (preg_match("/woo_object/i", $session)) {
											unset($_SESSION[$session]);
										}
										if (preg_match("/woo_pos/i", $session)) {
											unset($_SESSION[$session]);
										}
									}
								}


		}









	}

	public function render($template){
		
		


		$newsletter = file_get_contents( plugin_dir_path( __FILE__ ).'themes/'.$template);


		if(get_option( DATABASE_OPTION_NAME.'-blogname' ) =="yes"){
			$newsletter =  str_replace('{BLOGNAME}', get_bloginfo('name') ,$newsletter);
		}else{
			$newsletter =  str_replace('{BLOGNAME}','' ,$newsletter);
		}



		if(get_option( DATABASE_OPTION_NAME.'-blogdescription' ) =="yes"){
			$newsletter =  str_replace('{BLOGDESCRIPTION}', get_bloginfo('description') ,$newsletter);
		}else{
			$newsletter =  str_replace('{BLOGDESCRIPTION}', '' ,$newsletter);
		}


		$s = 1;



		for($i = 0; $i < $this->template_positions+1; ++$i) {


if(!empty($_SESSION['blog_pos_'.$s])){
			$post = get_post($_SESSION['blog_pos_'.$s]);
			
			
			
			if(!empty($post)){
					$id = $post->ID;
		
				setup_postdata($post);


			$permalink = get_the_permalink($post->ID);
			$title = get_the_title();

			$content = get_the_content();

			$long_excerpt = strip_tags($content);
			$long_excerpt =  string_limit_words_free($long_excerpt, get_option( DATABASE_OPTION_NAME.'-excerpt-length-long' ));


			$content = strip_tags($content);

			$content = string_limit_words_free($content, get_option( DATABASE_OPTION_NAME.'-excerpt-length' ));



			$size = get_option( DATABASE_OPTION_NAME.'-image-size' );

			if(empty($size)){

				$size = 'large';

			}

			$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size);



			$newsletter = str_replace('{readmore}', get_option( DATABASE_OPTION_NAME.'-read-more-text' ), $newsletter);




			$theexcerpt = get_option(DATABASE_OPTION_NAME.'-excerpt');

			if($theexcerpt == "yes"){

				$newsletter = str_replace('{'.$s.'-EXCERPT}', $content  .'...' ,$newsletter);

			}else{

				$newsletter = str_replace('{'.$s.'-EXCERPT}', '' ,$newsletter);

			}




			$homeurl = get_home_url();
			$newsletter = str_replace('{HOMEURL}', $homeurl , $newsletter);

			$newsletter = str_replace('{'.$s.'-PERMALINK}', $permalink ,$newsletter);
			$newsletter = str_replace('{'.$s.'-TITLE}', $post->post_title ,$newsletter);
			$newsletter = str_replace('{'.$s.'-CONTENT}', $long_excerpt ,$newsletter);
			$newsletter = str_replace('{'.$s.'-IMAGE}', $featuredImage[0] ,$newsletter);






}

			wp_reset_postdata();

			$s++;

}
		}


		if(!empty($this->woocommerce_positions)){
			global $post, $woocommerce, $product;

			// WOOCOMMERCE PLACHOLDERS

			$s = 1;
			for($i = 0; $i < $this->woocommerce_positions+1; ++$i) {


				$post = get_post($_SESSION['woo_pos_'.$s]);


				if(isset($post)){

					$id = $post->ID;
					setup_postdata($post);


					$permalink = get_the_permalink($post->ID);
					$title = get_the_title($post->ID);

					$content = get_the_content($post->ID);

					$long_excerpt = strip_tags($content);
					$long_excerpt =  string_limit_words_free($long_excerpt, get_option( DATABASE_OPTION_NAME.'-excerpt-length-long' ));


					$content = strip_tags($content);

					$content = string_limit_words_free($content, get_option( DATABASE_OPTION_NAME.'-woo-excerpt-length' ));



					$newsletter = str_replace('<checkWooCommerceItems-'.$s.'>', '',$newsletter);
					$newsletter = str_replace('</checkWooCommerceItems-'.$s.'>', '',$newsletter);


					$size = get_option( DATABASE_OPTION_NAME.'-woo-image-size' );
					if(empty($size)){

						$size = 'shop_thumbnail';

					}
					$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $size);



					$newsletter = str_replace('{wooreadmore}', get_option( DATABASE_OPTION_NAME.'-woo-read-more-text' ), $newsletter);




					$theexcerpt = get_option(DATABASE_OPTION_NAME.'-woo-excerpt');

					if($theexcerpt == "yes"){

						$newsletter = str_replace('{'.$s.'-WOO-EXCERPT}', $content  .'...' ,$newsletter);

					}else{

						$newsletter = str_replace('{'.$s.'-WOO-EXCERPT}', '' ,$newsletter);

					}



					$newsletter = str_replace('{WOO-HEADLINE-1}', get_option( DATABASE_OPTION_NAME.'-woo-headline-1' ) ,$newsletter);


					$newsletter = str_replace('{'.$s.'-WOO-PERMALINK}', $permalink ,$newsletter);
					$newsletter = str_replace('{'.$s.'-WOO-TITLE}', $post->post_title ,$newsletter);
					$newsletter = str_replace('{'.$s.'-WOO-CONTENT}', $long_excerpt ,$newsletter);
					$newsletter = str_replace('{'.$s.'-WOO-IMAGE}', $featuredImage[0] ,$newsletter);



					wp_reset_postdata();

				}

				else{

					$startPoint = '<checkWooCommerceItems-'.$s.'>';
					$endPoint = '</checkWooCommerceItems-'.$s.'>';

					$newsletter = preg_replace('#('.preg_quote($startPoint).')(.*)('.preg_quote($endPoint).')#si', '', $newsletter);




				}

				$post ='';

				$s++;
			}




		}








/**
	
					.first-headline-color:hover{color:'.get_option( DATABASE_OPTION_NAME.'-first-headline-color' ).';}

				.first-url-color:hover{color:'.get_option( DATABASE_OPTION_NAME.'-first-background-color' ).'; background-color:'.get_option( DATABASE_OPTION_NAME.'-first-headline-color' ).'; }

				.box1-url-color:hover{color:'.get_option( DATABASE_OPTION_NAME.'-box1-url-color' ).'; text-decoration:none;}
				.footer-url-color:hover{color:'.get_option( DATABASE_OPTION_NAME.'-footer-url-color' ).' ; text-decoration:none;}
				.box2-url-color:hover{color:'.get_option( DATABASE_OPTION_NAME.'-box2-url-color' ).'; text-decoration:none;}

**/

		//ADD CSS
		$newsletter = str_replace('</style>', '

				
				
				/**DYNAMIC CSS**/
				
				
				.wrapper{background-color:'.get_option( DATABASE_OPTION_NAME.'-background-color' ).'; color: '.get_option( DATABASE_OPTION_NAME.'-text-color' ).' ; }
				
				
				.firstbackgroundcolor{background-color:'.get_option( DATABASE_OPTION_NAME.'-first-background-color' ).';}
				.first-headline-color{color:'.get_option( DATABASE_OPTION_NAME.'-first-headline-color' ).';}
				
				.first-text-color{color:'.get_option( DATABASE_OPTION_NAME.'-first-text-color' ).';}
				.first-url-color{color:'.get_option( DATABASE_OPTION_NAME.'-first-url-color' ).'; display:block;}
				
				.first-url-border-color{border:1px solid '.get_option( DATABASE_OPTION_NAME.'-first-url-border-color' ).';}
				
				.box1-headline-color{color:'.get_option( DATABASE_OPTION_NAME.'-box1-headline-color' ).';}
				.box1-text-color{color:'.get_option( DATABASE_OPTION_NAME.'-box1-text-color' ).';}
				
				.box1-background-color{background-color:'.get_option( DATABASE_OPTION_NAME.'-box1-background-color' ).';}
				.box1-url-color{color:'.get_option( DATABASE_OPTION_NAME.'-box1-url-color' ).';display:block;}
				.box1-url-border-color{border:1px solid '.get_option( DATABASE_OPTION_NAME.'-box1-url-border-color' ).';}
				
				
				
				.box2-text-color{color:'.get_option( DATABASE_OPTION_NAME.'-box2-text-color' ).';}
				
				.box2-headline-color{color:'.get_option( DATABASE_OPTION_NAME.'-box2-headline-color' ).';}
				.box2-background-color{background-color:'.get_option( DATABASE_OPTION_NAME.'-box2-background-color' ).';}
				.box2-url-color{color:'.get_option( DATABASE_OPTION_NAME.'-box2-url-color' ).';display:block;}
				
				.box2-url-border-color{border:1px solid '.get_option( DATABASE_OPTION_NAME.'-box2-url-border-color' ).';}
				
				
				
				.footer-background-color{background-color:'.get_option( DATABASE_OPTION_NAME.'-footer-background-color' ).';}
				.footer-url-color{color:'.get_option( DATABASE_OPTION_NAME.'-footer-url-color' ).';}
				
				.footer-text-color{color:'.get_option( DATABASE_OPTION_NAME.'-footer-text-color' ).'; }
				





</style>',$newsletter);






		return  $newsletter;



	}


	public function check_active_layout(){





		if(!empty($_SESSION['active_layout_woo']) and $_SESSION['active_layout_woo'] =="1" and isset($this->sys_woocommerce) and $this->sys_woocommerce ===  false){



			if(file_exists( plugin_dir_path( __FILE__ ).'themes/default/config.xml'))
			{

				$read = simplexml_load_file( plugin_dir_path( __FILE__ ).'themes/default/config.xml');

				$this->default_template = 'default/'.$read->file;

				$this->template_positions = $read->positions;
				$this->woocommerce = $read->woocommerce;
				$this->woocommerce_positions = $read->woocommerce_positions;
				$_SESSION['active_layout'] ='default';


				$_SESSION['error_woocommerceTemplate'] = '1';
				return 'default/'.$read->file;





			}

		} else{


if(empty($_SESSION['active_layout'])){ 
	
	$_SESSION['active_layout'] = 'default';
	 
}
		if(file_exists( plugin_dir_path( __FILE__ ).'themes/'.$_SESSION['active_layout'].'/config.xml'))
			{

				$read = simplexml_load_file( plugin_dir_path( __FILE__ ).'themes/'.$_SESSION['active_layout'].'/config.xml');

				$this->default_template = $_SESSION['active_layout'].'/'.$read->file;

				$this->template_positions = $read->positions;
				$this->woocommerce = $read->woocommerce;
				$this->woocommerce_positions = $read->woocommerce_positions;

				return $_SESSION['active_layout'].'/'.$read->file;

			}


		}





	}


	public function switchtheme($theme){



		if(file_exists( plugin_dir_path( __FILE__ ).'themes/'.$theme.'/config.xml'))
		{

			$read = simplexml_load_file( plugin_dir_path( __FILE__ ).'themes/'.$theme.'/config.xml');





			$_SESSION['active_layout'] = $theme;

			$this->default_template =  $_SESSION['active_layout'].'/'.$read->file;
			$this->template_positions = $read->positions;
			$this->woocommerce = $read->woocommerce;
			$this->woocommerce_positions = $read->woocommerce_positions;


			if($this->woocommerce =="yes"){


				$_SESSION['active_layout_woo'] ='1';
			}else{

				$_SESSION['active_layout_woo'] ='0';
			}


		}else{



		}



	}


	//CHANGEN POSITIONS
	public function change_position($position = NULL, $postID = NULL){

		if(isset($_POST['product'])){
							if(isset($position)){
								$get_the_post_id = $_SESSION['woo_pos_'.$position];
								if(!empty($get_the_post_id)){
									if(isset($_SESSION['woo_object_'.$get_the_post_id])){
				
										unset($_SESSION['woo_object_'.$get_the_post_id]);
									}
								}
								$_SESSION['woo_'.$_POST['pos']] =  $postID;
								$_SESSION['woo_object_'.$_POST['post_id']] = $position;
								$_SESSION['woo_pos_'.$_POST['pos']] = $postID;
							}
		}else{
			if(isset($position)){
							$get_the_post_id = $_SESSION['blog_pos_'.$position];
							if(!empty($get_the_post_id)){
								if(isset($_SESSION['blog_object_'.$get_the_post_id])){
			
									unset($_SESSION['blog_object_'.$get_the_post_id]);
								}
							}
							$_SESSION[$_POST['pos']] =  $postID;
							$_SESSION['blog_object_'.$_POST['post_id']] = $position;
							$_SESSION['blog_pos_'.$_POST['pos']] = $postID;
			}
		}


	}


	public function set_post_type($data){
		if(!empty($data)){
			unset($_SESSION['posttypes']);
			$_SESSION['posttypes'][$data] = $data;
			$_SESSION['search_posttypes'] = $data;
		}
	}


	public function delete_post_type(){
		unset($_SESSION['posttypes'][$_GET['delPostType']]);
	}



}


}
