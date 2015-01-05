<?php
/*
Plugin Name: Sweet Guess Plugin
Plugin URI: http://www.beroza.blogspot.com
Description: This plugin allows users to do sweet random guess
Version: 1.0
Author: Beroza Paul
Author URI: http://beroza.blogspot.com
*/

$corePlugin = plugin_dir_path(__FILE__) . '/CorePlugin.php';

if (!class_exists('CorePlugin') && file_exists($corePlugin)) {
   require_once($corePlugin);
}

require_once( plugin_dir_path( __FILE__ ) . 'config.php');
require_once( plugin_dir_path( __FILE__ ) . $pluginClass . '.php');
require_once(ABSPATH . 'wp-admin/includes/admin.php');

$obj  = new SweetGuess();

// Do necessary tasks as soon as plugin is activated
register_activation_hook( __FILE__, array($obj, 'activate'));

// Do necessary tasks as soon as plugin is deactivated
register_deactivation_hook(__FILE__, array($obj, 'deactivate'));
   
// Don't add menu item if user is not admin
add_action('admin_menu', array($obj, 'setupAdminMenu'));
   
add_shortcode('form', array($obj, 'showForm'));

add_action('wp_ajax_save', array($obj, 'save'));
