<?php

/**
 * @package EventManagement
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        // echo "Test activation";
        flush_rewrite_rules();
    }
}
