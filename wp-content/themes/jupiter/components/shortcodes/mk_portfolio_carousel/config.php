<?php

extract( shortcode_atts( array(
    'title'              => '',
    'style'              => 'classic',
    'hover_scenarios'    => 'fadebox',
    'view_all'           => '',
    'count'              => 10,
    'author'             => '',
    'posts'              => '',
    'offset'             => 0,
    'cat'                => '',
    'categories'         => '',
    'order'              => 'DESC',
    'orderby'            => 'date',
    'show_items'         => 4,
    'image_quality'      => 1,
    'direction_vav'      => 'false',
    'el_class'           => '',
    'meta_type'          => 'category',
), $atts ) );

$direction_vav = ($style == 'modern') ? 'true' : $direction_vav;
Mk_Static_Files::addAssets('mk_portfolio_carousel');