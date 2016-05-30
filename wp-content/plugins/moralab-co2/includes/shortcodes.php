<?php 

class carbon_shortcodes {

	public function __construct(){
		// Register shortcodes
		add_shortcode( 'co2_chart', Array( __CLASS__ , 'chart_graph'));			// [co2_chart]
		add_shortcode( 'co2_summary', Array( __CLASS__ , 'display_summary'));		// [co2_summary]	
		add_shortcode( 'co2_trees_display', Array( __CLASS__ , 'display_trees'));	// [co2_trees_display]
	}

	public function chart_graph( $atts ) {
		global $current_user;
      	get_currentuserinfo();
		
		if ( is_user_logged_in() ):

			add_action('wp_footer', 'graph_script');
		?>
			<div class="section group">
				<div class="section-title">
					<h2><?php _e('My Carbon Emission', 'moralabs-plugins');?></h2>
				</div>
				<div class="row" style="margin-top:15px; left:-20px;">
					<div class="small-12 column">
						<div id="data-bar-graph" style="width:100%x; height:350px; margin: 0 auto; margin-left:-15px;"></div>
					</div>
				</div>
			</div><?php
		else : ?>
			<a href="<?php get_home_url().'/login';?>">Login or Create an account</a> to begin sequestering your carbon emission.<?php
		endif;

	}

	public function display_summary($atts) {
		global $current_user;
      	get_currentuserinfo();		
		if ( is_user_logged_in() ): 
			$congrats = (get_total_sequestered() > get_total_carbon_emitted())? 'Congratulations You Are Carbon Neutral!': 'Plant More Trees To Become Carbon Netural!';
			
			$trees = get_total_sequestered();

			$rankings = carbon_ranking();
						$rank = array_search($current_user->ID, array_column($rankings, 'user_id')) + 1;
						$ends = array('th','st','nd','rd','th','th','th','th','th','th');
			if (($rank %100) >= 11 && ($rank%100) <= 13)
			   $ordinal_rank = $rank. 'th';
			else
			   $ordinal_rank = $rank. $ends[$rank % 10];

			?>


			<div class="section group">
				<div class="section-title">
					<h2><?php _e('Where Do I Rank?', 'moralabs-plugins');?></h2>
				</div>
				<div class="summary">
					<h3><center><?php if ($trees['total_sequestered'] > get_total_carbon_emitted()) echo $congrats; ?></center></h3>
					<div><strong>You are the <?php echo $ordinal_rank; ?> most carbon neutral person.</strong></div>
					<?php if ($trees['total_sequestered'] < get_total_carbon_emitted()): ?>
						<span>You still have <?php echo get_total_carbon_emitted() - $trees['total_sequestered'];?> co2 tonnes still to sequester.</span>
					<?php endif; ?>
					<div><span><strong>Total Carbon Emitted:</strong> <?php echo get_total_carbon_emitted(); ?> tonnes of co2.</span></div>
					<div><span><strong>Total Cabron Sequestered by Trees:</strong> <?php echo $trees['total_sequestered']; ?> tonnes of co2.</span></div>
				</div>
				
			</div><?php 
		else: ?>
			<p><a href="<?php echo get_home_url();?>/login">Login or Create an Account</a> to find out where you rank.</p><?php 
		endif;
	}

	public function display_trees($atts) {
		
		if ( is_user_logged_in() ): ?>
		
			<div class="section group">
				<div class="section-title">
					<h2><?php _e('My Trees', 'moralabs-plugins');?></h2>
				</div>
				<div class="the-trees">
					<ul class="small-block-grid-2 medium-block-grid-3 large-block-grid-4" style="margin-left:0;">
					  <!-- <li class="grid-th"><img class="th" src="http://www.trees4life.ca/wp-content/uploads/2012/07/Tree-icon.png"></li> -->
					  <?php get_users_trees_short(); ?>
					</ul>
				</div>
			<div><?php 
		else : ?>
			<p><a href="<?php echo get_home_url();?>/login">Login or Create an Account</a> to View Your Trees</p><?php
		endif;
	}
}

new carbon_shortcodes;