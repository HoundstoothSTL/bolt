<?php 

//*** Remove WLW Manifest Link, it's unneeded
remove_action( 'wp_head', 'wlwmanifest_link');

//*** KiLL WP_Generator
function kill_generators() {
	return '';
}

add_filter('the_generator','kill_generators');