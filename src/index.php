<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 */
?>

<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>	
    
    <?php get_template_part( 'templates/loop', 'index' ); ?>
    		
<?php get_template_part('templates/footer'); ?>
