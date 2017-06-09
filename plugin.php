<?php

/**
 *
 * Plugin Name:       Classic Text Widget
 * Description:       Adds the pre 4.8 Classic WordPress text widget just like the good old days.
 * Version:           1.0.0
 * License:           GPLv3
 *
 * Text Domain:       classic-text-widget
 * Domain Path:       /languages
 *
 */

namespace VictorFontCG;

if( ! defined( 'ABSPATH' ) ) exit;

/**
 *
 * Load Text Domain
 * @since  1.0.0
 *
 */
load_plugin_textdomain( 'classic-text-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );

//* get the class
require_once( plugin_dir_path( __FILE__ )  . 'lib/class-classic-wp-widget-text.php' );

//* run the new filter to allow shortcodes
add_filter( 'classic_widget_text', 'do_shortcode' );
