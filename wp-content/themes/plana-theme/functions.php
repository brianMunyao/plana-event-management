<?php

function enqueue_scripts()
{
    wp_enqueue_style("mainstyle", get_template_directory_uri() . '/style.css', [], "1.0", 'all');
    wp_enqueue_style("create_event_style", get_template_directory_uri() . '/styles/main-app.css', [], "1.0", 'all');
}

add_action('wp_enqueue_scripts', "enqueue_scripts");


function redirect_on_login()
{
    wp_redirect(home_url());
    exit();
}
add_action('wp_login', 'redirect_on_login');

function redirect_on_logout()
{
    wp_redirect(site_url('/login'));
    exit();
}
add_action('wp_logout', 'redirect_on_logout');

function add_commas($val)
{
    return 'Ksh ' . number_format($val, 0, '.', ',');
}

function is_user_in_role($user, $role)
{
    // pass the role you want to check and user object from wp_get_current_user()
    return in_array($role, $user->roles);
}

function shorten_string($string, $max_length)
{
    $short_string = substr($string, 0, $max_length);

    if (strlen($string) > strlen($short_string)) {
        $short_string .= '...';
    }

    return $short_string;
}

function style_date($raw_date)
{
    return date('M j Y', strtotime($raw_date));
}

function style_time($raw_time)
{
    return date('g:i', strtotime($raw_time));
}

function get_fullname_meta($user_id)
{
    return get_user_meta($user_id, 'fullname', true);
}
