<?php
/** 
 * @package FXMindsStudents
 */

namespace Includes;

 final class Init{

    public static function get_services(){
        return [
            Base\SettingsLinks::class,
            Base\Enqueue::class,
            Pages\Admin::class
        ];
    }

    public static function register_services(){
        foreach(self::get_services() as $class){
            $service = self::instantiate($class);
            if(method_exists($service, 'register')){
                $service->register();
            }
        }
    }

    private static function instantiate($class){
        return new $class();
    }

 }