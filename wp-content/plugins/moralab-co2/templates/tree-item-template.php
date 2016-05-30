<?php 
	global $post; ?>

	<article>
	<div class="tree-item">
		<div class="row">
			<div class="large-6 columns">
				<p><img src="<?php echo !empty($post)? get_post_meta($post->ID, 'img_url', true):INCLUDES_URL.'/img/tree-long.png'; ?>" width="600" height="370" alt="image for article"></p>
			</div>
			<div class="large-6 columns">
			<h3><?php echo !empty($post)? $post->post_title:'';?></h3>
			<p><strong>Tree Diameter: </strong><?php echo !empty($post)? get_post_meta($post->ID, 'treeDiameter', true):'';?> <?php echo get_post_meta($post->ID, 'treeUnit', true)==1? 'in':'cm';?>
			</p>
			<p><strong>Total Sequestered: </strong><?php echo !empty($post)? get_post_meta($post->ID, 'sequestered', true):'';?></p>
			
			<p><span><a href="<?php echo get_permalink($post->ID);?>">Edit</a></span></p>
			</div>


		</div>
	</div>
</article>
