<?php
/** 
 * @package FXMindsStudents
 */

namespace Includes\Base;

 class Shortcode{

    public function register(){
        add_shortcode( 'add_cpt', array($this, 'add_cpt') );
    }
    protected function add_cpt(){
        var_dump($_POST);
        echo 'Hello World';
    }
 }