<?php
/**
 * The loop for displaying archives : base loop.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         
	<header>
		<h1><?php the_title(); ?></h1>
		<time datetime="<?php the_time( 'm-d-Y' ); ?>" pubdate><?php the_date(); ?></time>
		<cite>By <?php the_author(); ?></cite>
		<?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
	</header>
	
        <p><?php the_excerpt_dynamic(500); ?></p>
         
    <section class="post-tags">
		<?php 
			$posttags = get_the_tags();
			if ($posttags) : ?>
			<i class="icon-tags"></i> Tags:	
		<?php foreach ($posttags as $tag) : ?>
		<a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name; ?></a>
		<?php endforeach; endif; ?>
	</section>
    
</article>

    <?php comments_template( '', true ); ?>
    
<?php endwhile; // end of the loop. ?>