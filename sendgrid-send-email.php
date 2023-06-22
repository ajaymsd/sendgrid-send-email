<?php 
/**
 * @package Automatic_Delete_Drafts
 * @version 1.7.2
 */
/*
Plugin Name: Sendgrid-send-mail
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Plugin to Send Mail Using Sendgrid
Author: Ajay Mathesh
Version: 1.0.0
Author URI: http://ma.tt/
*/

defined('ABSPATH') or exit;


defined('SGE_PLUGIN_FILE') or define('SGE_PLUGIN_FILE',__FILE__);
// die(print_r(AUDD_PLUGIN_FILE));
defined('SGE_PLUGIN_PATH') or define('SGE_PLUGIN_PATH',plugin_dir_path(__FILE__));

//autoload files
if(file_exists(SGE_PLUGIN_PATH .'/vendor/autoload.php')){
    // die("autoload");
   require SGE_PLUGIN_PATH . '/vendor/autoload.php';
}else{
    wp_die('Error During Autoload');
}

if(class_exists('SGE\app\Route')){
    $route=new SGE\app\Route();
    $route->hook();
}else{
    die('Route Not Loaded');
}

