<?php
/*
Plugin Name: MoraLabs CO2
Description: A custom plugin for the Carbon Neutral Challenge.
Text Domain: moralabs-plugins 
Version: 1.0.0
Author: Donjay Barit
Author URI: http://www.twelvefusion.com
*/

if (!defined('ML_PLUGIN_THEME_DIR'))
    define('ML_PLUGIN_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());
if (!defined('ML_PLUGIN_NAME'))
    define('ML_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
if (!defined('ML_PLUGIN_DIR'))
    define('ML_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . ML_PLUGIN_NAME);
if (!defined('ML_PLUGIN_URL'))
    define('ML_PLUGIN_URL', WP_PLUGIN_URL . '/' . ML_PLUGIN_NAME);
if (!defined('INCLUDES_PATH'))
	define ( "INCLUDES_PATH", ML_PLUGIN_DIR.'/includes');
if (!defined('TEMPL_PATH'))
	define ('TEMPL_PATH', ML_PLUGIN_DIR.'/templates');
if (!defined('WIDGETS_PATH'))
	define ('WIDGETS_PATH', ML_PLUGIN_DIR.'/widgets');

require_once( INCLUDES_PATH. '/functions.php' ); // main functions
require_once( INCLUDES_PATH. '/ajax-process.php' ); // ajax
require_once( INCLUDES_PATH. '/rewrite.php' ); // rewrite rule
require_once( WIDGETS_PATH. '/widgets.php' ); // widget functions
require_once( INCLUDES_PATH.'/shortcodes.php'); 


// Add Styles and Scripts
add_action('wp_enqueue_scripts', 'add_header_scripts');
add_action('wp_footer', 'add_footer_scripts');