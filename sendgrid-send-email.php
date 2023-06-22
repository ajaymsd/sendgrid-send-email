<?php
/*
 * Plugin Name:       Send Sendgrid Email
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ajay Mathesh
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       send-sendgrid-email
 * Domain Path:       /languages
 */

defined('ABSPATH') || exit;


defined('SGE_PLUGIN_FILE') or define('SGE_PLUGIN_FILE',__FILE__);
// die(print_r(AUDD_PLUGIN_FILE));
defined('SGE_PLUGIN_PATH') or define('SGE_PLUGIN_PATH',plugin_dir_path(__FILE__));

//autoload files
if(file_exists(SGE_PLUGIN_PATH .'/vendor/autoload.php')){
   require SGE_PLUGIN_PATH . '/vendor/autoload.php';
}else{
    wp_die('Error in Autoloading Files');
}

if(class_exists('SGE\App\Route')){
    $route=new SGE\App\Route();
    $route->hook();
}else{
    wp_die('Route Not Loaded');
}

