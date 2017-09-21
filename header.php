<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div class="container-fluid">
			<header class="row header">
				<div class="container">
					<div class="col-md-12">
						<nav class="navbar">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<?php if ( get_theme_mod( 'shift_logo' ) ): ?>
									<a class="navbar-brand" href="<?php echo get_home_url(); ?>"><img src='<?php echo esc_url( get_theme_mod( 'shift_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
								<?php else: ?>
									<a class="navbar-brand" href="<?php echo get_home_url(); ?>">Shift</a>
								<?php endif; ?>
							</div>
							<div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
								<?php wp_nav_menu( array( 'menu' => 'shift_header_menu', 'menu_class' => 'nav navbar-nav', 'container' => 'ul' ) ); ?>
							</div>
						</nav>
					</div>
				</div>
			</header>
		</div>