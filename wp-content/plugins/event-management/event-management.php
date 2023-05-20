<?php

/**
 * @package EventManagement
 */


/**
 * Plugin Name: Plana Event Management
 * Plugin URI:  https://example.com
 * Description: Plana Plugin is the best goto tool for event management functionality
 * Version:     1.0
 * Author:      Brian, Nicholas
 * Author URI:  https://example.com
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */


//security
defined('ABSPATH') or die("Blocked");

use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Init;


if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once(dirname(__FILE__) . '/vendor/autoload.php');
}

function activate_event_plugin()
{
    Activate::activate();
}
register_activation_hook(__FILE__, 'activate_event_plugin');

function deactivate_event_plugin()
{
    Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_event_plugin');

if (class_exists('Inc\\Init')) {
    Init::register_services();
}
