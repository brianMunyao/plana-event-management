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
add_action('wp_login', 'redirect_on_logout');
