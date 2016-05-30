<?php 


	if ( is_user_logged_in() ):
		add_filter( 'wp_title', function ($title){ return "Plant A Tree"; });

		get_header();?>

		<div class="content">
			<?php get_plugin_template('forms/tree-form'); ?>
		</div>

		<style>
			.post-pagination-wrap, #mk-page-introduce { display: none;}
		</style>
		<?php get_footer();
	else:
		wp_redirect( get_home_url() );
		exit;
	endif;