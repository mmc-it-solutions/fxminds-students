<?php
/**
 * Plugin Name: FX Minds Students
 * Plugin URI: https://github.com/mmc-it-solutions/fxminds-students
 * Description: A custom plugin to be more productive with their students.
 * Version: 0.2.1
 * Author: MMC IT Solutions
 * Author URI: https://mmc-itsolutions.nl/
 */

if( ! defined('ABSPATH')){
	die();
}

if(file_exists(dirname(__FILE__). '/vendor/autoload.php')){
	require_once dirname(__FILE__). '/vendor/autoload.php';
}

define ('PLUGIN_PATH', plugin_dir_path(__FILE__));
define ('PLUGIN_URL', plugin_dir_url(__FILE__));
define ('PLUGIN_NAME', plugin_basename(__FILE__));

use Includes\Base\Activate;
use Includes\Base\Deactivate;

function activate_fxminds(){
	Activate::activate();
}

function deactivate_fxminds(){
	Deactivate::deactivate();
}

register_activation_hook(__FILE__, 'activate_fxminds');
register_deactivation_hook(__FILE__, 'deactivate_fxminds');

if( class_exists('Includes\\Init')){
	Includes\Init::register_services();
}

