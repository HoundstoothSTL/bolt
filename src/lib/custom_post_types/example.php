<?php
/*
	Placeholder "Events" Custom Post Type
*/


add_action( 'init', 'rwb_events_init' );
function rwb_events_init() {
  $labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'Event'),
    'add_new_item' => __('Add New Event'),
    'edit_item' => __('Edit Event'),
    'new_item' => __('New Event'),
    'all_items' => __('All Events'),
    'view_item' => __('View Event'),
    'search_items' => __('Search Events'),
    'not_found' =>  __('No Events found'),
    'not_found_in_trash' => __('No Events found in Trash'), 
    'parent_item_colon' => '',
    'menu_name' => 'Events'

  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    '_builtin' => false,
	'_edit_link' => 'post.php?post=%d',
    'rewrite' => array('slug' => 'about/press-room/events','with_front' => false),
	'menu_icon' => get_bloginfo('stylesheet_directory') . '/ico/events.png',
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => true,
    'menu_position' => 5,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' )
  ); 
  register_post_type('event',$args);
  
}

//add filter to ensure the text Event, or Event, is displayed when user updates a Event 
add_filter( 'post_updated_messages', 'rwb_event_updated_messages' );
function rwb_event_updated_messages( $messages ) {
  global $post, $post_ID;

  $messages['events'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View Event</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View Event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );

  return $messages;
}

//display contextual help for Events
add_action( 'contextual_help', 'rwb_add_event_help', 10, 3 );

function rwb_add_event_help( $contextual_help, $screen_id, $screen ) { 
  //$contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'event' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing an Event:') . '</p>' .
      '<ul>' .
      '<li>' . __('Always use fully qualified URLs in any "URL" box (ex: http://www.example.com)') . '</li>' .
      '<li>' . __('MAKE SURE to add the Google Analytics Key.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For the Special Tracking Script, DO NOT include the opening and closing script tags') . '</strong></p>' .
      '<ul>' .
      '<li>' . __('The "media" editor on some sections (like Column Copy) may not always mirror exactly what it will look like on the actual Event, be sure to preview before publishing.') . '</li>' .
      '<li>' . __('There is no need to use the "Featured Image" box, it is there in case you would like to dynamically display a link to the Event somewhere else on the site, this way you can call an image that is associated with the Event.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' .
      '<p>' . __('Feel free to <a href="mailto:rob@madebyhoundstooth.com">contact the developer</a> for issues.') . '</p>';
  } elseif ( 'edit-event' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table list of Events, probably doesn\'t need much explanation!') . '</p>' ;
  }
  return $contextual_help;
}

/* -- END Events --*/