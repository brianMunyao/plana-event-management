<?php

/**
 * @package EventManagement
 */

namespace Inc;

use Inc\Pages\ManageEvent;
use Inc\Pages\UserRoles;

class Init
{
    public static function get_services()
    {
        return [
            ManageEvent::class,
            UserRoles::class
        ];
    }

    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    private static function instantiate($class)
    {
        $service = new $class;
        return $service;
    }
}
