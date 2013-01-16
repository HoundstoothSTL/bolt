<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav class="split">
		<span class="pull-left"><?php previous_post_link( '%link', '' . _x( '', 'Previous post link', 'bolt' ) . '&larr; Previous Post' ); ?></span>
		<span class="pull-right"><?php next_post_link( '%link', 'Next Post &rarr;' . _x( '', 'Next post link', 'bolt' ) . '' ); ?></span>
	</nav>
<?php endif; ?>

 
<?php // If there are no posts to display, such as an empty archive page ?>

<?php if ( ! have_posts() ) : ?>
	<h1><?php _e( 'Hmmm, there is nothing in here.', 'bolt' ); ?></h1>
	<p>That's odd, there is nothing to display on this page, try doing a search below for whatever it was you were looking for or you can use the navigation above.  Either way, have a nice day!</p>
	<?php get_search_form(); ?>

	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>
<?php endif; ?>
 
<?php while ( have_posts() ) : the_post(); ?>
 
<?php /* How to display posts of the Gallery format. The gallery category is the old way. */ ?>
 
<?php if ( ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) || in_category( _x( 'gallery', 'gallery category slug', 'bolt' ) ) ) : ?>
 
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header>
            <h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'bolt' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

            <?php custom_tweed_posted_on(); ?>
        </header>

	<?php if ( post_password_required() ) : ?>
	
		<?php the_content(); ?>
		
	<?php else : ?>

		<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		    if ( $images ) :
		        $total_images = count( $images );
		        $image = array_shift( $images );
		        $image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' ); ?>
		        
		        <a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
		         
		        <p><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'bolt' ), 'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'bolt' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"', number_format_i18n( $total_images )); ?></p>

    <?php endif; ?>
     
    	<?php the_excerpt(); ?>
 
<?php endif; ?>
 
            <footer>
	            <?php if ( function_exists( 'get_post_format' ) && 'gallery' == get_post_format( $post->ID ) ) : ?>
	            <a href="<?php echo get_post_format_link( 'gallery' ); ?>" title="<?php esc_attr_e( 'View Galleries', 'bolt' ); ?>"><?php _e( 'More Galleries', 'bolt' ); ?></a> | 
	            
	            <?php elseif ( in_category( _x( 'gallery', 'gallery category slug', 'bolt' ) ) ) : ?>
	            <a href="<?php echo get_term_link( _x( 'gallery', 'gallery category slug', 'bolt' ), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'bolt' ); ?>"><?php _e( 'More Galleries', 'twentyten' ); ?></a> | 
	            
	            <?php endif; ?>
	            
	            <?php comments_popup_link( __( 'Leave a comment', 'bolt' ), __( '1 Comment', 'bolt' ), __( '% Comments', 'bolt' ) ); ?>
            </footer>
        </article>
 
<?php /* How to display posts of the Aside format. The asides category is the old way. */ ?>
    
    <?php elseif ( ( function_exists( 'get_post_format' ) && 'aside' == get_post_format( $post->ID ) ) || in_category( _x( 'asides', 'asides category slug', 'bolt' ) )  ) : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
 
        <?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
                <?php the_excerpt(); ?>
        <?php else : ?>
                <?php the_content( __( 'Continue reading &rarr;', 'bolt' ) ); ?>
        <?php endif; ?>
         
            <footer>
                <?php custom_tweed_posted_on(); ?> | <?php comments_popup_link( __( 'Leave a comment', 'bolt' ), __( '1 Comment', 'bolt' ), __( '% Comments', 'bolt' ) ); ?> 
            </footer>
        </article>
 
<?php /* How to display all other posts. */ ?>
 
    <?php else : ?>
     
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         
			<header>
				<h1><?php the_title(); ?></h1>
				<time datetime="<?php the_time( 'm-d-Y' ); ?>" pubdate><?php the_date(); ?></time>
				<cite>By <?php the_author(); ?></cite>
				<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
			</header>
 
		    <?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
		    
		    	<p><?php the_excerpt_dynamic(500); ?></p>
		                
		    <?php else : ?>
		    
		    	<?php the_content( __( 'Continue reading &raquo;', 'bolt' ) ); ?>
		                 
		    	<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'bolt' ), 'after' => '</nav>' ) ); ?>
		                
		    <?php endif; ?>
     
            <footer>
				<section class="post-tags">
					<?php 
						$posttags = get_the_tags();
						if ($posttags) : ?>
						<i class="icon-tags"></i> Tags:	
					<?php foreach ($posttags as $tag) : ?>
					<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
					<?php endforeach; endif; ?>
				</section>
			</footer>
			
		</article>
 
            <?php comments_template( '', true ); ?>
 
    <?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
 
<?php endwhile; // End the loop. Whew. ?>
 
<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
    <nav class="split">
		<span class="pull-left"><?php previous_post_link( '%link', '' . _x( '', 'Previous post link', 'bolt' ) . '&larr; Previous Post' ); ?></span>
		<span class="pull-right"><?php next_post_link( '%link', 'Next Post &rarr;' . _x( '', 'Next post link', 'bolt' ) . '' ); ?></span>
	</nav>
<?php endif; ?>
