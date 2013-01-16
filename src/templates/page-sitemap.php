<?php
/**
 * Template Name: Sitemap
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>

<div class="single-page sitemap">
		<header>
			<h1><?php _e('Sitemap', 'bolt'); ?></h1>
		</header>
		
		<!-- Spit out all pages of site as a Sitemap  -->
		
		<?php
			// Exlude Pages Here
			wp_list_pages('exclude=&title_li='); 
		?>
		
		<?php
			foreach( get_post_types( array('public' => true) ) as $post_type ) {
			  if ( in_array( $post_type, array('post','page','attachment') ) )
			    continue;
			
			  $pt = get_post_type_object( $post_type );
			
			  echo '<h2>'.$pt->labels->name.'</h2>';
			  echo '<ul>';
			
			  query_posts('post_type='.$post_type.'&posts_per_page=-1');
			  while( have_posts() ) {
			    the_post();
			    echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			  }
			
			  echo '</ul>';
			}
		?>
	
		<?php
			// Add categories you'd like to exclude in the exclude here
			$cats = get_categories('exclude=');
			foreach ($cats as $cat) {
			  echo "<h2>".$cat->cat_name."</h2>";
			  echo "<ul>";
			  query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
			  while(have_posts()) {
			    the_post();
			    $category = get_the_category();
			    // Only display a post link once, even if it's in multiple categories
			    if ($category[0]->cat_ID == $cat->cat_ID) {
			      echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
			    }
			  }
			  echo "</ul>";
			}
		?>
</div>
<!-- page: sitemap -->

<?php get_template_part('templates/footer'); ?>