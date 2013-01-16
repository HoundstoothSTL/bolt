<?php
/**
 * The search page template.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>

<div class="topic-list">
	<?php if ( have_posts() ): ?>

		<header>
			<hgroup>
				<h1><?php _e('You searched for: ', 'bolt'); ?><em><?php _e( get_search_query() ); ?></em></h1>
			</hgroup>
		</header>
		
		<?php while ( have_posts() ) : the_post(); ?>
		
		<article class="<?php post_class(); ?>">
			<h2><?php the_title(); ?></h2>
			<p><?php the_excerpt_dynamic(500); ?></p>
			<a href="<?php the_permalink(); ?>">Learn More &raquo;</a>
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
		</article>
		
		<?php endwhile; ?>
		
		<?php else: ?>
		
		<h2><?php _e( 'No results found for', 'bolt' ); ?><?php _e( get_search_query(), 'bolt' ); ?></h2>
		
		<?php endif; ?>
					

</div>
<!-- topic list -->

<?php get_template_part('templates/footer'); ?>