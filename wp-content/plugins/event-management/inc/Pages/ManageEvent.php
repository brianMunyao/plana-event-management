<?php

/**
 * @package EventManagement
 */

namespace Inc\Pages;

class ManageEvent
{
    public function register()
    {
        $this->create_event_db();
    }

    private function create_event_db()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'events';

        $wpdb->query("CREATE TABLE IF NOT EXISTS $table(
            e_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            e_name VARCHAR(255) NOT NULL,
            e_date DATE NOT NULL DEFAULT CURRENT_DATE,
            e_time TIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            e_location VARCHAR(255) NOT NULL,
            e_desc TEXT NOT NULL,
            e_capacity INT NOT NULL,
            e_tickets_remaining INT NOT NULL,
            e_organizer_id INT NOT NULL
        );");
    }
}
