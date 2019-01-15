<?php
/**
 * Plugin Name: langevad s端damed
 * Plugin URI: http://henrilindert.ikt.khk.ee
 * Description: This is the very first plugin i ever created.
 * Version: 1.0
 * Author: Henri Lindret
 * Author URI: http://henrilindert.ikt.khk.ee
**/

define( 'DC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

//functions for plugin administration
include( 'includes/developer.php' );

//create & manage plugin settings
include( 'includes/settings.php' );

//holds the "heart" of the plugin (sorry!)
include( 'includes/valentines-hearts.php' );
