<?php 

//** Template for comments and pingbacks
/*
function custom_tweed_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s says:', 'custom-tweed' ), sprintf( '%s', get_comment_author_link() ) ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php _e( 'Your comment is awaiting moderation.', 'custom-tweed' ); ?>
			<br>
		<?php endif; ?>

		<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				// translators: 1: date, 2: time
				printf( __( '%1$s at %2$s', 'custom-tweed' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'custom-tweed' ), ' ' );
			?>

		<div class="commentContent"><?php comment_text(); ?></div>

			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<article <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<p><?php _e( 'Pingback:', 'custom-tweed' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'custom-tweed'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;
*/

//**Closes comments and pingbacks with </article> instead of </li>
/*
function starkers_comment_close() {
	echo '</article>';
}
*/

//** Adjusts the comment_form() input types for HTML5.
function starkers_fields($fields) {
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$fields =  array(
	'author' => '<p><label for="author">' . __( 'Name' ) . '</label> ' . ( $req ? '' : '' ) .
	'<input id="author" name="author" type="text" placeholder="Your Name" size="30"' . $aria_req . ' /></p>',
	'email'  => '<p><label for="email">' . __( 'Email' ) . '</label> ' . ( $req ? '' : '' ) .
	'<input id="email" name="email" type="email" placeholder="Your Email" size="30"' . $aria_req . ' /></p>',
	'url'    => '<p><label for="url">' . __( 'Website' ) . '</label>' .
	'<input id="url" name="url" type="url" placeholder="Fav Website (or yours)" size="30"' . $aria_req . ' /></p>',
);
return $fields;
}
add_filter('comment_form_default_fields','starkers_fields');

/** Pass in a path and get back the page ID
 * e.g. get_page_id_from_path('about/terms-and-conditions');
*/
function get_page_id_from_path( $path ) {
	$page = get_page_by_path( $path );
	if( $page ) {
		return $page->ID;
	} else {
		return null;
	};
}

//** Append page slugs to the body class
function add_slug_to_body_class( $classes ) {
	global $post;
   
	if( is_home() ) {			
		$key = array_search( 'blog', $classes );
		if($key > -1) {
			unset( $classes[$key] );
		};
	} elseif( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif(is_singular()) {
		$classes[] = sanitize_html_class( $post->post_name );
	};

	return $classes;
}

add_filter( 'body_class', 'add_slug_to_body_class' );

//** Get the category id from a category name
function get_category_id( $cat_name ){
	$term = get_term_by( 'name', $cat_name, 'category' );
	return $term->term_id;
}

//** Add PDF Support to Media Filter
function modify_post_mime_types( $post_mime_types ) {

	// select the mime type, here: 'application/pdf'
	// then we define an array with the label values

	$post_mime_types['application/pdf'] = array( __( 'PDFs' ), __( 'Manage PDFs' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>' ) );

	// then we return the $post_mime_types variable
	return $post_mime_types;

}

add_filter( 'post_mime_types', 'modify_post_mime_types' );

//** Modify the length of the_excerpt
function the_excerpt_dynamic($length) { // Outputs an excerpt of variable length (in characters)
	global $post;
	$text = $post->post_exerpt;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace(']]>', ']]>', $text);
	}
		$text = strip_shortcodes( $text ); // optional, recommended
		$text = strip_tags($text); // use ' $text = strip_tags($text,'<p><a>'); ' to keep some formats; optional

		$output = strlen($text);
		if($output <= $length ) {
			$text = substr($text,0,$length).'';
		}else {
			$text = substr($text,0,$length).'...';
		}

	echo apply_filters('the_excerpt',$text);
}
 
//** ADD PHP FUNCTIONALITY TO TEXT WIDGET
add_filter('widget_text', 'php_text', 99);

function php_text($text) {
 if (strpos($text, '<' . '?') !== false) {
 ob_start();
 eval('?' . '>' . $text);
 $text = ob_get_contents();
 ob_end_clean();
 }
 return $text;
}