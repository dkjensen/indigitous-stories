<?php
/**
 * Plugin Name: Indigitous Stories
 * Description: 
 * Version: 1.0.3
 * Author: David Jensen
 * Author URI: https://dkjensen.com
 * Text Domain: indigitous-stories
 *
 * @package Indigitous Stories
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'INDIGITOUS_STORIES_VER', '1.0.3' );
define( 'INDIGITOUS_STORIES_PLUGIN_NAME', 'Indigitous Stories' );
define( 'INDIGITOUS_STORIES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'INDIGITOUS_STORIES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


// Load Composer
require INDIGITOUS_STORIES_PLUGIN_DIR . 'vendor/autoload.php';
require INDIGITOUS_STORIES_PLUGIN_DIR . 'includes/class-indigitous-stories.php';


function Indigitous_Stories() {
    return Indigitous_Stories::instance();
}
Indigitous_Stories();