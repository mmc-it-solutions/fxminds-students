<?php
/**
 * Plugin Name: FX Minds Students
 * Plugin URI: https://mmc-itsolutions.nl/
 * Description: A custom plugin to be more productive with their students.
 * Version: 0.2
 * Author: MMC IT Solutions
 * Author URI: https://mmc-itsolutions.nl/
 */

if( ! defined('ABSPATH')){
	die();
}

add_action( 'admin_menu', 'my_admin_menu' );

wp_enqueue_style( 'fxminds-main', plugin_dir_url( __FILE__ ) . 'assets/css/fxminds.css' );

function fxminds_admin_index(){
	wp_enqueue_style( 'fxminds-admin', plugin_dir_url( __FILE__ ) . 'assets/css/fxminds-admin.css' );
	require_once plugin_dir_path(__FILE__).'admin/fxminds-admin.php';	
}

function fxminds_admin_lesson_questions(){
	require_once plugin_dir_path(__FILE__).'admin/fxminds-admin-lesson-questions.php';
	//wp_enqueue_style( 'fxminds-admin', plugin_dir_url( __FILE__ ) . 'assets/css/fxminds-admin-lesson.css' );
}

function fxminds_admin_questions_asked(){
	require_once plugin_dir_path(__FILE__).'admin/fxminds-admin-qa.php';
	//wp_enqueue_style( 'fxminds-admin', plugin_dir_url( __FILE__ ) . 'assets/css/fxminds-admin-lesson.css' );
}


function my_admin_menu() {
	add_menu_page( 'FXMINDS STUDENTS', 'FXMinds students', 'manage_options', 'fxminds_admin_index', 'fxminds_admin_index', 'dashicons-tickets', 1  );
	add_submenu_page('fxminds_admin_index', 'Verdieping', 'Verdiepingen', 'manage_options', 'fxminds_verdieping', 'fxminds_admin_lesson_questions');
	add_submenu_page('fxminds_admin_index', 'Q&A', 'Q&A Vragen', 'manage_options', 'fxminds_qa', 'fxminds_admin_questions_asked');
}

