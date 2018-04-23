<?php
/*
Plugin Name: Hello World
Plugin URI:
Description: Простой плагин, который будет выводить "Hello World!" на главной странице и в зависимости от времени суток принимать разные цвета
Author:
Version: 1.0
Author URI:
*/



function helloworld_register_stylesheet(){
    wp_register_style( 'helloworld_stylesheet', plugins_url( '/styles/style.css', __FILE__ ) );
    wp_enqueue_style( 'helloworld_stylesheet' );

    wp_register_script('helloworld_script', plugins_url('/scripts/hw-script.js', __FILE__), array('jquery') );
    wp_enqueue_script('helloworld_script');
}
add_action( 'wp_enqueue_scripts', 'helloworld_register_stylesheet' );
function shortcode_HelloWorld() {
    return '<div class="test-shortcode">Hello Wordl!</div>';
}
add_shortcode('helloworld', 'shortcode_HelloWorld');