<?php get_header(); ?>

<div class="container">

	<div class="row">

		<div class="col-md-12">

			<h2>Meet the Team</h2>

			<h3>Executive Leadership</h3>

		</div>

	</div>

	<div class="row">
		<?php $posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'shift_team',
			'meta_key' => 'member_type',
			'meta_value' => 'Executive',
			'orderby' => 'date',
			'order' => 'ASC'
		));
		
		if ( $posts ) :
			foreach ( $posts as $post ): setup_postdata( $post );
				get_template_part( 'shift_team', 'box' );
			endforeach;
		endif; ?>
	</div>

	<div class="row">

		<div class="col-md-12">

			<h2 class="advisors">Advisory Board</h2>

		</div>

	</div>

	<div class="row">
		<?php $posts = get_posts(array(
			'numberposts' => -1,
			'post_type' => 'shift_team',
			'meta_key' => 'member_type',
			'meta_value' => 'Advisor',
			'orderby' => 'date',
			'order' => 'ASC'
		));
		
		if ( $posts ) :
			foreach ( $posts as $post ): setup_postdata( $post );
				get_template_part( 'shift_team', 'box' );
			endforeach;
		endif; ?>
	</div>

</div>

<?php get_footer(); ?>