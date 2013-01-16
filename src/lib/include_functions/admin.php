<?php 

// ADMIN SETTINGS

//----------------------ADD SOCIAL LINKS TO PROFILE
function houndstooth_contactmethods( $contactmethods ) {
    // Add Twitter
    $contactmethods['twitter'] = 'Twitter';
    //add Facebook
    $contactmethods['facebook'] = 'Facebook';
    //add Google+
    $contactmethods['google'] = 'Google+';
    //add LinkedIn
    $contactmethods['linkedin'] = 'LinkedIn';
 
    return $contactmethods;
}
add_filter('user_contactmethods','houndstooth_contactmethods',10,1);

//------------------------Custom Admin Footer
function remove_footer_admin () {
echo 'Made by <a href="http://www.madebyhoundstooth.com" target="_blank">Houndstooth</a></p>';
}

add_filter('admin_footer_text', 'remove_footer_admin');


//------------------------Remove Profile Options
function hide_profile_fields( $contactmethods ) {
  unset($contactmethods['aim']);
  unset($contactmethods['jabber']);
  unset($contactmethods['yim']);
  return $contactmethods;
}

add_filter('user_contactmethods','hide_profile_fields',10,1);

//------------------------Remove Dashboard Widgets
function remove_dashboard_widgets() {

//------------------------Globalize the metaboxes array, this holds all the widgets for wp-admin
global $wp_meta_boxes;
	
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);// Remove the incoming links widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);// Remove Right Now
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);//Remove Recent Comments
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);//Remove Dashboard Plugins
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);//Remove Quickpress
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);//Remove Recent Drafts
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);//Remove Primary
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);//Remove Secondary
} 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );