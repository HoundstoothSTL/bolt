<?php
/**
 * The loop for displaying a single post.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article>
			
		<header>
			<h1><?php the_title(); ?></h1>
			<time datetime="<?php the_time( 'm-d-Y' ); ?>" pubdate><?php the_date(); ?></time>
			<cite>By <?php the_author(); ?></cite>
			<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
		</header>
		
		<?php the_content(); ?>

	
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
			<nav class="split">
				<span class="pull-left"><?php previous_post_link( '%link', '' . _x( '', 'Previous post link', 'bolt' ) . '&larr; Previous Post' ); ?></span>
				<span class="pull-right"><?php next_post_link( '%link', 'Next Post &rarr;' . _x( '', 'Next post link', 'bolt' ) . '' ); ?></span>
			</nav>
		</footer>
	</article>
	
	<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>