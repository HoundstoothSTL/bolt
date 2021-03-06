<?php
/**
 * The template for displaying the category feed.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>

<div class="blog archives category-archives">
				
	<?php if ( have_posts() ): ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<article></article>
		
		<?php endwhile; ?>
		
	<?php else: ?>
		
		<header>
			<h1>No posts to display in <?php echo single_cat_title( '', false ); ?></h1>
		</header>	
		
	<?php endif; ?>
	
	<?php if(function_exists('wp_paginate')) { wp_paginate(); } //WP Paginate is pre-bundled ?>
				
</div>
<!-- blog: category-archives -->

<?php get_template_part('templates/footer'); ?>
