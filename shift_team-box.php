<div class="col-md-12 team-member">
	<div class="row">
		<div class="col-md-4 col-sm-6 team-image">
			<?php the_post_thumbnail( 'shift_team_thumb' ); ?>
		</div>
		<div class="col-md-8 col-sm-6">
			<h4><?php the_title(); ?></h4>
			<h5><?php the_field( 'role_title' ); ?></h5>

			<?php the_content(); ?>
		</div>
	</div>
</div>