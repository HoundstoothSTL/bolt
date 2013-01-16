<?php 
/**
 * Template Name: Debug
 *
 * @package WordPress
 * @subpackage Bolt
 * @since Bolt 0.1.0
 *
 * Use this template to test out different queries and stuff from the codex
 * and see how the built in wordpress functions work like get_stylesheet_directory_uri()
*/
?>

<?php get_template_part('templates/head'); ?>
<?php get_template_part('templates/header'); ?>

<div class="container">
	<div class="hero-unit">
		<header>
			<hgroup>
				<h1>Debugger Template</h1>
				<h2>Output the Constants <small>for example</small></h2>
			</hgroup>
			<p><strong>Scripts Directory= </strong><?php echo SCRIPTS_DIR; ?></p>
			<p><strong>Styles Directory= </strong><?php echo STYLESHEET_DIR; ?></p>
		</header>
	</div>
</div>


<?php get_template_part('templates/footer'); ?>