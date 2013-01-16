<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	
	<!-- DNS Prefetching -->
	<link rel="dns-prefetch" href="http://ajax.googleapis.com">
	
	<!-- View -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
	
	<title><?php wp_title(''); ?></title>

    <!-- Styles : Versioned for Caching -->
    <link href="<?php echo get_template_directory_uri(); ?>/assets/styles/main.css<?php echo '?v=' . filemtime( get_stylesheet_directory() . '/assets/styles/main.css'); ?>" rel="stylesheet">
	
	 <!-- Favicon & Touch Icons : Versioned for Caching -->
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/ico/favicon.ico<?php echo '?v=' . filemtime( get_stylesheet_directory() . '/ico/favicon.ico'); ?>">
	
    <!-- Layout Scripts (Modernizr, HTML5 Shim) -->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/scripts/vendor/modernizr.js<?php echo '?v=' . filemtime( get_stylesheet_directory() . '/assets/scripts/vendor/modernizr.custom.2.6.2.min.js'); ?>"></script>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<?php
    /* JavaScript to support sites with threaded comments (when in use). */
	    if ( is_singular() && get_option( 'thread_comments' ) )
	        wp_enqueue_script( 'comment-reply' );
	
		/* Don't forget wp_head or everything goes crazy! */
	    wp_head(); 
	?>	
</head>