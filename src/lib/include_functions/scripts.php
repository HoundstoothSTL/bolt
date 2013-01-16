<?php 

$rev = filemtime( get_stylesheet_directory() . '/assets/css/main.min.css');

//*** Enqueue Site Javascripts

function footer_load_javascript_files() {

  wp_enqueue_style('bolt_css', get_template_directory_uri() . '/assets/css/main.min.css', false, 'a8aa0944811ab44fbd2d166a16e78864');

	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery, we'll load this one in the header
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js', false, '1.8.2');
		wp_enqueue_script('jquery');
	}

  wp_register_script( 'jquery.flexslider', SCRIPTS_DIR . '/vendor/jquery.flexslider-min.js', array('jquery'), '1.7', true );
  
  //*** Load Bootstrap Scripts
  //wp_register_script( 'bootstrap.SCRIPTNAME', SCRIPTS_DIR . '/vendor/bootstrap/bootstrap-collapse.js', array('jquery'), '2.1.0', true );
  
  
  wp_enqueue_script('jquery.flexslider');
  //wp_enqueue_script('bootstrap.SCRIPTNAME');
  
  //*** Load App javascript last
  wp_register_script('bolt_scripts', get_template_directory_uri() . '/assets/scripts/scripts.min.js', false, 'bab60351f64ff1ea2ba1429e95cfd2fd', true);
  wp_enqueue_script( 'bolt_scripts' );
}

add_action( 'wp_enqueue_scripts', 'footer_load_javascript_files' );

//*** End JavaScripts