<?php get_header(); ?>

<div class="container-fluid intro">

	<div class="container">

		<? // intro section ?>
		<section class="row">

			<div class="col-md-12">
				
				<h2><?php the_field('headline'); ?></h2>

				<div class="row subtext">
					<div class="col-md-2"></div>
					<div class="col-md-8 col-sm-12">
						<?php the_field('subtext'); ?>
					</div>
				</div>

				<div class="buttons">
					<a href="#why-shift" class="btn btn-lg btn-yellow"><?php the_field('yellow_button_text'); ?></a>
					<a href="#how" class="btn btn-lg btn-hollow"><?php the_field('white_button_text'); ?></a>
				</div>

			</div>

		</section>

	</div>

</div>

<div class="container" id="why-shift">

	<?php // why section ?>
	<section class="row why">

		<div class="col-md-1"></div>
		<div class="col-md-10">

			<h2><?php the_field('why_title'); ?></h2>

			<div class="row subtext">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-8 col-sm-12">
							<?php the_field('why_subtext'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="row icons">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="row">
						<div class="col-sm-6">
							<?php $first_icon = get_field('first_icon'); ?>
							<img src="<?php echo $first_icon['url']; ?>" class="img-responsive first" width="149">
							<p><?php the_field('first_blurb'); ?></p>
						</div>
						<div class="col-sm-6">
							<?php $second_icon = get_field('second_icon'); ?>
							<img src="<?php echo $second_icon['url']; ?>" class="img-responsive second" width="154">
							<p><?php the_field('second_blurb'); ?></p>
						</div>
					</div>
				</div>
			</div>

		</div>

	</section>

</div>

<div class="how-banner" id="how"></div>

<div class="container-fluid how">

	<div class="banner-container">
		<img src="/wp-content/uploads/2017/06/biogas-gif_1920na456.gif" class="banner">
		<div class="spacer"></div>
	</div>

	<div class="container">

		<section class="row">

			<div class="col-md-12">

				<h2><?php the_field( 'how_headline' ); ?></h2>

			</div>

			<div class="col-sm-3 step">

				<h3>1</h3>

				<p><?php the_field( 'first_step' ); ?></p>

			</div>

			<div class="col-sm-3 step">

				<h3>2</h3>

				<p><?php the_field( 'second_step' ); ?></p>

			</div>

			<div class="col-sm-3 step">

				<h3>3</h3>

				<p><?php the_field( 'third_step' ); ?></p>

			</div>

			<div class="col-sm-3 step">

				<h3>4</h3>

				<p><?php the_field( 'fourth_step' ); ?></p>

			</div>

		</section>

	</div>

</div>

<div class="container">

	<section class="row map">

		<div class="col-md-12">

			<h2><?php the_field( 'map_headline' ); ?></h2>

			<?php $map = get_field('map_image'); ?>
			<img src="<?php echo $map['url']; ?>" class="img-responsive">

		</div>

	</section>

</div>

<div class="container-fluid progression">

	<section class="row">

		<div class="col-md-12">

			<h2><?php the_field( 'progress_headline' ); ?></h2>

			<div class="progress-carousel">
				<?php $posts = get_posts(array(
					'numberposts' => -1,
					'post_type' => 'shift_progress',
					'orderby' => 'menu_order'
				));
				
				if ( $posts ) :
					foreach ( $posts as $post ): setup_postdata( $post ); ?>
						<div class="carousel-item">
							<div>
								<?php the_post_thumbnail( 'shift_team_thumb' ); ?>
								<div class="caption">
									<?php the_content(); ?>
								</div>
							</div>
						</div>
					<?php endforeach;
				endif; 
				wp_reset_postdata(); ?>
			</div>

		</div>

	</section>

</div>

<div class="container-fluid donate" id="donate">

	<div class="container">

		<section class="row">

			<div class="col-md-4">

				<h2><?php the_field( 'donate_title' ); ?></h2>

				<div class="donate-text">
					<?php the_field( 'donate_text' ); ?>
				</div>

				<form class="form form-inline" id="donate-form">
					<div class="form-group">
						<label class="sr-only" for="donate-amount">Donation Amount</label>
						<input type="number" placeholder="$100" class="form-control" name="donate-amount" id="donate-amount">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-lg btn-black donate-trigger"><?php the_field( 'donate_button_text' ); ?></button>
					</div>
				</form>

			</div>

			<div class="col-md-12 footer">

				<p><?php the_field( 'footer_text' ); ?></p>

			</div>

		</section>

	</div>

</div>

<?php get_footer(); ?>