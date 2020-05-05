<?php

/** 
 * 
 * @package FXMindsStudents
 */

namespace Includes\Pages;

 class Admin{

    public function register(){
	  add_action('init', array($this, 'create_cpt'));
	  add_action( 'admin_menu', array($this, 'admin_menu') );
	  add_action( 'wp_ajax_elementor_pro_forms_send_form', [ $this, 'ajax_send_form' ] );
	  add_action( 'wp_ajax_nopriv_elementor_pro_forms_send_form', [ $this, 'ajax_send_form' ] );
    }

   function admin_menu() {
		add_menu_page( 'FXMINDS STUDENTS', 'FXMinds students', 'manage_options', 'fxminds_admin_index', array($this, 'fxminds_admin_index'), 'dashicons-tickets', 1  );
		add_submenu_page('fxminds_admin_index', 'Verdieping', 'Verdiepingen', 'manage_options', 'fxminds_verdieping', array($this,'fxminds_admin_lesson_questions'));
		add_submenu_page('fxminds_admin_index', 'Q&A', 'Q&A Vragen', 'manage_options', 'fxminds_qa', array($this, 'fxminds_admin_questions_asked'));
   }

   
   function ajax_send_form() {  
   // form processing code here
   $fields = $_POST['form_fields'];
   if($fields['name'] && $fields['qa_ask']){
	$postArray = array(
		'post_title' => $fields['name'],
		'post_content' => $fields['message'],
		 'post_type' => 'fxminds_further_qa',
		 'post_status' => 'publish'
	);
		$newPost = wp_insert_post($postArray);
		add_metadata('post', $newPost, 'lesson_id', $fields['lesson_id']);
		add_metadata('post', $newPost, 'lesson_name', $fields['lesson_name']);
		add_metadata('post', $newPost, 'course_id', $fields['course_id']);
		add_metadata('post', $newPost, 'student', $fields['student']);
		add_metadata('post', $newPost, 'student_id', $fields['student_id']);
		add_metadata('post', $newPost, 'is_done', 'false');
	}
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

	function create_cpt(){
        register_post_type('fxminds_further_qa',
        array(
            'labels'      => array(
                'name'          => __('Verdiepingen', 'textdomain'),
                'singular_name' => __('Verdieping', 'textdomain'),
            ),
                'public'      => false,
                'has_archive' => true,
        )
    );
     }
   
}