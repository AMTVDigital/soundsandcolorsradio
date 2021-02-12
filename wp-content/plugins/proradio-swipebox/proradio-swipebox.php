<?php
/*
Plugin Name: ProRadio Swipebox Photo And Video
Plugin URI: http://pro.radio/
Description: Enable the swipebox for the galleries
Author: QantumThemes
Version: PR.5.8
*/

function proradio_swipebox_loader(){
	wp_enqueue_script( 'swipebox',plugins_url( '/min/qt-swipebox-min.js' , __FILE__ ), $deps = array("jquery"), $ver = false, $in_footer = true );
	wp_enqueue_style( 'QtswipeStyle',plugins_url( '/swipebox/css/swipebox.min.css' , __FILE__ ),false);
}
add_action("wp_enqueue_scripts",'proradio_swipebox_loader');

