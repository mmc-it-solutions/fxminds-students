<?php
/** 
 * 
 * @package FXMindsStudents
 */

namespace Includes\Base;

 class SettingsLinks{
    public function register(){
        add_filter('plugin_action_links_'. PLUGIN_NAME, array($this, 'settings_link'));
    }

    public function settings_link($links){
        $settings_link = '<a href="admin.php?page=fxminds_admin_index">Bekijk de statistieken</a>';
        array_push($links, $settings_link);
        return $links;
    }
 }