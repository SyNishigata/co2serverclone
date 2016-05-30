<?php 
	global $post;
	global $current_user;
	get_currentuserinfo();

	if ( is_user_logged_in() && $post->post_author == $current_user->ID ):

		add_filter( 'wp_title', $post->post_title);
		get_header();?>

		<div class="content">
			<?php get_plugin_template('forms/tree-form'); ?>
		</div>

		<style>
			.post-pagination-wrap { display: none;}
		</style>
		<?php get_footer();

	elseif ( is_user_logged_in() ):
		wp_redirect( get_site_url().'/my-trees' );
		exit;
	else:
		wp_redirect( get_site_url() );
		exit;
	endif;