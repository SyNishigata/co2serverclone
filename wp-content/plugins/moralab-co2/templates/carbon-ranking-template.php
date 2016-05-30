<?php 

	if ( is_user_logged_in() ):
		global $wp_post_types;
		global $current_user;
		get_currentuserinfo();
		$carbon_total = get_total_carbon_emitted();
		$rankings = carbon_ranking();
		$myrank = array_search($current_user->ID, array_column($rankings, 'user_id')) + 1;


		$prev = 0;
		$next = 0;
		$last = count($rankings);
		switch($myrank){
			case 1:
			case 2:
				$prev = 0;
				$next = 5;
				break;
			case ($last-1):
			case $last:
				$prev = $last-5;
				$next = $last;
				break;
			default:
				$prev = $myrank - 3;
				$next = $myrank + 2;
				break;
		}

		get_header(); 

?>

	<div class="row carbon-summary">

        		<!-- Ranking -->
        		<div class="section group">
        			<div class="section-title">
						<h2><center><?php _e('Where Do I Rank?', 'moralabs-plugins');?></center></h2>
					</div>

	        		<div class="ranking">
	        		<?php if (floatval($carbon_total) <= 0 || $carbon_total == '') : ?>
						<h3 style="margin:0 0 20px"><center>Start entering your carbon data and plant trees to find your ranking.</center></h3>
						<?php else:
							$ends = array('th','st','nd','rd','th','th','th','th','th','th');
							if (($myrank %100) >= 11 && ($rank%100) <= 13)
							   $ordinal_rank = $myrank. 'th';
							else
							   $ordinal_rank = $myrank. $ends[$myrank % 10];
						?>
						<div class="rank-badge" style="background-image:url('<?php echo INCLUDES_URL.'/img/badge-blue.png';?>')">
							<span><?php _e($myrank); ?></span>
						</div>
						<p><center><strong>You are the top <?php echo $ordinal_rank; ?> most carbon neutral person among all users.</strong></center></p>
						<div class="avatars">
							<div class="row">
								<div class="small-1 columns nav" id="prev" data-prev="<?php echo $prev; ?>"><img src="<?php echo INCLUDES_URL.'/img/prev.png';?>" style="margin:100% auto"></div>
								<div class="small-10 columns" id="members">
								
									<?php if (sizeof($rankings) == 0):
										echo '<p><center>Enter your carbon data and start planting trees to get a ranking</center></p>';
									elseif (sizeof($rankings) <= 5): 
									
									for ($i = 0; $i < sizeof($rankings); $i++){
									?> 
									<div class="avatar-list">
										<div class="avatar"><?php echo $rankings[$i]['rank'].$rankings[$i]['avatar']; ?></div>
										<div class="name"><center><?php echo $rankings[$i]['user_login']; ?></center></div>
										<div class="sequestered"><center><?php echo floatval($rankings[$i]['meta_value']) * -1; ?> <br/>ton deficit</center></div>
									</div>
									
									
									<?php } else:
									for($i = $prev; $i < $next; $i ++ ) { ?>
									<div class="avatar-list">
										<div class="avatar"><?php echo $rankings[$i]['rank'] . $rankings[$i]['avatar']; ?></div>
										<div class="name"><center><?php echo $rankings[$i]['user_login']; ?></center></div>
										<div class="sequestered"><center><?php echo floatval($rankings[$i]['meta_value']) * -1; ?> <br/>ton deficit</center></div>
									</div>
									<?php } 
									endif;?>
								</div>
								<div class="small-1 columns nav" id="next" data-next="<?php echo $next; ?>"><img src="<?php echo INCLUDES_URL.'/img/next.png';?>" style="margin:100% auto"></div>
							</div>
						</div>
						<?php endif; ?>
					</div>
					
				</div><!-- .Ranking -->

    		</div>

<script>
jQuery(function ($) {
    $('#mk-page-introduce').hide();

    $(".mycarbon").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-carbon/'.$current_user->user_login.'/'.date('Y')?>";
    });

    $(".planttree").on("click", function(){
     	window.location = "<?php echo get_home_url().'/my-trees/plant-a-tree'?>";
    });


    $('#prev').click(function(){
			var max = 5;
			var last_index = parseInt($(this).attr("data-prev"));
			var first_index = last_index - max + 1;

			var update_list = '';
			var members = <?php echo json_encode($rankings); ?>;

			if (last_index >= 0){
				if (first_index < 0 ){
					first_index = 0;
					last_index = max;
				}

				$('div#next').attr("data-next", last_index + 1);
				$('div#prev').attr("data-prev", first_index );
				
				for (i = 0; i < max; i++) { 
				    //update_list = update_list + '<div class="members-profile">' + member[first_index]['Name'] + '</div>'; 
				    // update_list = '<div class="small-2 columns"><div class="avatar"><img src="'+ 
				    // 	members[first_index]["avatar"] + '" width="100" height="100"></div><div class="name"><center>' + 
				    // 	members[first_index]["user_login"] + '</center></div><div class="sequestered"><center>' + 
				    // 	members[first_index]["meta_value"] + '</center></div></div>'
				    var rank = members[first_index]["rank"];
				    var avatar = members[first_index]["avatar"];
				    var name = members[first_index]["user_login"];
				    var deficit = members[first_index]["meta_value"];
				    update_list = update_list + '<div class="avatar-list"><div class="avatar">' + rank + 
				    	avatar + '</div><div class="name"><center>' + 
				    	name + '</center></div><div class="sequestered"><center>' + 
				    	deficit * (-1) + '<br/>ton deficit</center></div></div>';
				    first_index++;
				}

				

				$('div#members').html(update_list);
			}

		});

		$('#next').click(function(){
			var max = 5;
			var first_index = parseInt($(this).attr("data-next"));
			
			var members = <?php echo json_encode($rankings); ?>;
			var update_list = '';

			if (first_index <= members.length){
				if ((first_index + max) > members.length){
					first_index = members.length - max ;
				}

				$('#prev').attr("data-prev", first_index-1);
				$(this).attr("data-next", first_index + max);


				for (i = 0; i < max; i++) { 
				    //update_list = update_list + '<div class="members-profile">' + member[first_index]['Name'] + '</div>';
				    var rank = members[first_index]["rank"];
				    var avatar = members[first_index]["avatar"];
				    var name = members[first_index]["user_login"];
				    var deficit = members[first_index]["meta_value"];
				    update_list = update_list + '<div class="avatar-list"><div class="avatar">' + rank +
				    	avatar + '</div><div class="name"><center>' + 
				    	name + '</center></div><div class="sequestered"><center>' + 
				    	deficit * (-1) + '<br/>ton deficit</center></div></div>';
				    first_index++;
				}



				$('div#members').html(update_list);
			}
		});
});
</script>
    <?php endif;
    	get_footer();
    ?>