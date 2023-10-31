<?php
/*
 * Plugin Name:       Fuel Price
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Get Fuel Prices of over all USA States and its Cities shortcode "[fuel_price]"
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mr Haroon
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mhfp
 */

if (!defined('WPINC')) {
    die;
}

//define the assests directory path

if (!defined('MH_PLUGIN_DIR')) {
    define('MH_PLUGIN_DIR', plugin_dir_url(__FILE__));
}

// add links file here
require plugin_dir_path(__FILE__). 'inc/links.php';

// database table file
require plugin_dir_path(__FILE__). 'inc/table.php';

//register top menu in dashboard file here
require plugin_dir_path(__FILE__). 'inc/menu.php';

// plugin main page that show on website using the shortcode
require plugin_dir_path(__FILE__). 'inc/page.php';
?>