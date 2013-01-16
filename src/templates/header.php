
<body <?php body_class(); ?>>
<nav class="navbar-fixed-top">
	<div class="branding">
		<div class="container">
			<a class="brand" href="<?php echo bloginfo('url'); ?>"><?php echo bloginfo('sitename'); ?></a>
		</div>
	</div>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<div class="nav-collapse collapse">
					<?php wp_nav_menu( array('menu' => 'Primary Navigation', 'container' => false, 'menu_class' => 'nav', 'menu_id' => false, 'container' => false )); ?>
				</div>
				<!--/.nav-collapse -->
			</div>
		</div>
	</div>
</nav>