<?php
/**
 * Plugin Name: Very First Plugin
 * Plugin URI: http://henrilindert.ikt.khk.ee
 * Description: This is the very first plugin i ever created.
 * Version: 1.0
 * Author: Henri Lindret
 * Author URI: http://henrilindert.ikt.khk.ee
**/

add_action( 'the_content', 'my_thank_you_text' );

function my_thank_you_text ( $content ) {
    return $content .= '<p>Aitäh vaatamast!</p>';
}









?>