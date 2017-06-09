<?php

/**
 *
 * Plugin Name:       Classic Text Widget
 * Description:       Adds the pre 4.8 Classic WordPress text widget just like the good old days.
 * Version:           1.0.0
 * Author:            Victor Font Consulting Group, LLC based on initial code from Christina Arasmo Beymer
 * Author URI:        https://victorfont.com/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       classic-text-widget
 * Domain Path:       /languages
 *
 */

/*
Classic Text Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Classic Text Widget is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Classic Text Widget. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
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
