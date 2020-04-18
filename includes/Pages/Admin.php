<?php

/** 
 * 
 * @package FXMindsStudents
 */

namespace Includes\Pages;

 class Admin{

    public function register(){
      add_action( 'admin_menu', array($this, 'admin_menu') );
    }

   function admin_menu() {
		add_menu_page( 'FXMINDS STUDENTS', 'FXMinds students', 'manage_options', 'fxminds_admin_index', array($this, 'fxminds_admin_index'), 'dashicons-tickets', 1  );
		add_submenu_page('fxminds_admin_index', 'Verdieping', 'Verdiepingen', 'manage_options', 'fxminds_verdieping', array($this,'fxminds_admin_lesson_questions'));
		add_submenu_page('fxminds_admin_index', 'Q&A', 'Q&A Vragen', 'manage_options', 'fxminds_qa', array($this, 'fxminds_admin_questions_asked'));
   }

   function fxminds_admin_index(){	
		require_once PLUGIN_PATH .'admin/fxminds-admin.php';	
	}
	
	function fxminds_admin_lesson_questions(){
		require_once PLUGIN_PATH .'admin/fxminds-admin-lesson-questions.php';
	}
	
	function fxminds_admin_questions_asked(){
		require_once PLUGIN_PATH .'admin/fxminds-admin-qa.php';
	}
   
}