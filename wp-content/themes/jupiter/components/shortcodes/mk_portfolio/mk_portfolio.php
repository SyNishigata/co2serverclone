<?php
$path = pathinfo(__FILE__) ['dirname'];


include ($path . '/config.php');


global $mk_options, $wp_query;

require_once (THEME_FUNCTIONS . "/bfi_cropping.php");

$item_id = (!empty($item_id)) ? $item_id : 1409305847;

$id = Mk_Static_Files::shortcode_id();

$cat = isset($_REQUEST['term']) ? $_REQUEST['term'] : $categories;

$query_options = array(
            'post_type' => 'portfolio',
            'count' => $count,
            'offset' => $offset,
            'categories' => $cat,
            'author' => $author,
            'posts' => $posts,
            'orderby' => $orderby,
            'order' => $order,
        );

$query = mk_wp_query($query_options);

$r = $query['wp_query'];



if (is_singular()) {
     global $post;
     $layout = get_post_meta($post->ID, '_layout', true);
} if (is_archive()) {
     $layout = $mk_options['archive_portfolio_layout'];
}



$atts = array(
    'shortcode_name' => 'mk_portfolio',
    'style' => $style,
     'column' => $column,
     'ajax' => $ajax,
     'layout' => $layout,
     'height' => $height,
     'pagination' => $pagination,
     'target' => $target,
     'meta_type' => $meta_type,
     'permalink_icon' => $permalink_icon,
     'zoom_icon' => $zoom_icon,
     'grid_spacing' => $grid_spacing,
     'hover_scenarios' => $hover_scenarios,
     'image_quality' => $image_quality,
     'image_size' => $image_size,
     'excerpt_length' => $excerpt_length,
     'r' => 0
);

$ajax_state_class = '';
if (($style == 'grid' || $style == 'masonry') && $ajax == 'true') {
     $ajax_state_class = 'portfolio-ajax-enabled';
}

?>

<div class="portfolio-grid <?php echo $ajax_state_class; ?>">
<?php 




/* Portfolio Sortable */
if ($sortable == 'true' && !is_archive()) {

    $sortable_atts = array(
        'post_type' => 'portfolio',
        'style' => $sortable_style,
        'align' => $sortable_align,
        'categories' => $categories,
        'uniqid' => $id,
        'custom_class' => false,
        'container' => '#loop-'.$id,
        'item' => '> .mk-portfolio-item'
    );

    echo mk_get_view('global', 'loop-sortable', true, $sortable_atts);
}
/* ****** */


$container_class[] = 'mk-portfolio-container';
$container_class[] = 'js-loop js-el';
$container_class[] = 'mk-portfolio-'.$style;
$container_class[] = ($grid_spacing > 0) ? 'grid-spacing-true' : '';
$container_class[] = $el_class;


if ($style == 'grid' || $style == 'masonry' && $ajax == 'true') { ?>
     <div class="ajax-container page-bg-color <?php echo ($layout == 'full') ? 'mk-grid' : ''; ?>">
     <div class="ajax-controls">
          <a href="#" class="close-ajax"><i class="mk-moon-close-2"></i></a>
          <a href="#" class="next-ajax"><i class="mk-jupiter-icon-arrow-right"></i></a>
          <a href="#" class="prev-ajax"><i class="mk-jupiter-icon-arrow-left"></i></a>
     </div></div>
<?php } ?>


<?php 

$data_config[] = 'data-query="'.base64_encode(json_encode($query_options)).'"';
$data_config[] = 'data-loop-atts="'.base64_encode(json_encode($atts)).'"';
$data_config[] = 'data-pagination-style="'.$pagination_style.'"';
$data_config[] = 'data-max-pages="'.$r->max_num_pages.'"';
$data_config[] = 'data-loop-iterator="'.$r->query['posts_per_page'].'"';
$data_config[] = 'data-loop-categories="'.$categories.'"';
$data_config[] = 'data-loop-author="'.$author.'"';
$data_config[] = 'data-loop-posts="'.$posts.'"';

if($style == 'masonry') {
    $data_config[] = 'data-mk-component="Masonry"';
    $data_config[] = 'data-masonry-config=\'{"container":"#loop-'.$id.'", "item":"> .mk-portfolio-item"}\'';
}

if($style == 'classic') { 
    $data_config[] = 'data-mk-component="Grid"';
    $data_config[] = 'data-grid-config=\'{"container":"#loop-'.$id.'", "item":".mk-portfolio-item"}\'';
}

?>
<?php if($style == 'grid' || $style == 'masonry'): ?>
    <div id="loop-main-wrapper-<?php echo $id;?>">
<?php endif;?>
    <section id="loop-<?php echo $id; ?>" <?php echo implode(' ', $data_config); ?> class="<?php echo implode(' ', $container_class); ?> clear">
    <div class="portfolio-loader"><div><div class="mk-preloader"></div></div></div>
    <?php 
    $atts['i'] = 0;
    if (is_archive()):
        $r = $wp_query;
        if (have_posts()):
            while (have_posts()):
                the_post();
                $atts['i']++;
                echo mk_get_shortcode_view('mk_portfolio', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    else:
        if ($r->have_posts()):
            while ($r->have_posts()):
                $r->the_post();
                $atts['i']++;
                echo mk_get_shortcode_view('mk_portfolio', 'loop-styles/' . $style, true, $atts);
            endwhile;
        endif;
    endif;
    ?>

    </section>
  
     <?php if( $pagination === 'true' ) {
             echo mk_get_view('global', 'loop-pagination', true, ['pagination_style' => $pagination_style, 'r' => $r]); 
         } ?>
<?php if($style == 'grid' || $style == 'masonry'): ?>
    </div>
<?php endif;?>
</div>

<?php
if($style == 'grid') {
    Mk_Static_Files::addCSS('
        #loop-'.$id.'.grid-spacing-true {
            box-sizing: border-box;
            padding-left:'.($grid_spacing/2).'px;
            padding-right:'.($grid_spacing/2).'px;
        }
        #loop-'.$id.'.grid-spacing-true .mk-portfolio-grid-item .item-holder {
            margin-left:'.($grid_spacing/2).'px;
            margin-right:'.($grid_spacing/2).'px;
            margin-bottom:'.$grid_spacing.'px;
        }
    ', $id);
}if($style == 'masonry') {
    Mk_Static_Files::addCSS('
        #loop-main-wrapper-'.$id.' {
            box-sizing: border-box;
            padding-left:'.($grid_spacing/2).'px;
            padding-right:'.($grid_spacing/2).'px;
        }
    ', $id);
} 

Mk_Static_Files::addCSS('
    .sortable-id-'.$id.'.sortable-outline-style {
         background-color:'.$sortable_bg_color.';
         margin:'.$grid_spacing.'px;
         padding-left:'.$grid_spacing.'px !important;
         padding-right:'.$grid_spacing.'px !important;
    }

    .sortable-id-'.$id.'.sortable-outline-style a {
         color:'.$sortable_txt_color.';
    }

    .sortable-id-'.$id.'.sortable-outline-style a.current {
         border-color:'.$sortable_txt_color.' !important;
    }
', $id);

wp_reset_postdata();
