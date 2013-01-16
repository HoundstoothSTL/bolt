<?php
//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'rwb_create_custom_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function rwb_create_custom_taxonomies() 
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Event Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Event Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Event Types' ),
    'all_items' => __( 'All Event Types' ),
    'parent_item' => __( 'Parent Event Type' ),
    'parent_item_colon' => __( 'Parent Event Type:' ),
    'edit_item' => __( 'Edit Event Type' ), 
    'update_item' => __( 'Update Event Type' ),
    'add_new_item' => __( 'Add New Event Type' ),
    'new_item_name' => __( 'New Event Type Name' ),
    'menu_name' => __( 'Event Types' ),
  ); 	

  register_taxonomy('event_types',array('events'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'event-type','with_front' => false),
  ));
  
  // Add another below this comment if you like
  
}