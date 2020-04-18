<?php

/** 
 * 
 * @package FXMindsStudents
 */

namespace Includes\Base;

 class Enqueue{

    public function register(){
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }


    function enqueue(){
		wp_enqueue_style( 'fxminds-main', PLUGIN_URL . 'assets/css/fxminds.css' );
		wp_enqueue_style( 'fxminds-admin', PLUGIN_URL . 'assets/css/fxminds-admin.css' );
	}
 }