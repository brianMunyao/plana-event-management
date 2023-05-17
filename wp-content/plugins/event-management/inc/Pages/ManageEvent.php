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
        $this->create_event();
        $this->update_event();
        $this->delete_event();
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

    private function create_event()
    {
        global $success_msg;
        global $error_msg;

        global $wpdb;
        $table = $wpdb->prefix . 'events';

        if (isset($_POST['create_event'])) {
            $data = [
                'e_name' => $_POST['e_name'],
                'e_date' => $_POST['e_date'],
                'e_time' => $_POST['e_time'],
                'e_location' => $_POST['e_location'],
                'e_price' => $_POST['e_price'],
                'e_desc' => $_POST['e_desc'],
                'e_capacity' => $_POST['e_capacity'],
                'e_tickets_remaining' => $_POST['e_tickets_remaining'],
                'e_organizer_id' => $_POST['e_organizer_id'],
            ];

            $results = $wpdb->insert($table, $data);


            if ($results) {
                $success_msg = "Event added";
            } else {
                $error_msg = "Error adding event";
            }
        }
    }

    private function update_event()
    {
        global $success_msg;
        global $error_msg;

        global $wpdb;
        $table = $wpdb->prefix . 'events';

        if (isset($_POST['update_event'])) {
            $data = [
                'e_name' => $_POST['e_name'],
                'e_date' => $_POST['e_date'],
                'e_time' => $_POST['e_time'],
                'e_location' => $_POST['e_location'],
                'e_price' => $_POST['e_price'],
                'e_desc' => $_POST['e_desc'],
                'e_capacity' => $_POST['e_capacity'],
                // 'e_tickets_remaining' => $_POST['e_tickets_remaining'],
            ];

            $where = ['e_id' => $_POST['e_id']];

            $results = $wpdb->update($table, $data, $where);


            if ($results) {
                $success_msg = "Event updated";
            } else {
                $error_msg = "Error updating event";
            }
        }
    }

    function delete_event()
    {
        if (isset($_POST['delete_event'])) {
            $where = ['e_id' => $_POST['e_id']];

            global $wpdb;
            global $success_msg;
            global $error_msg;

            $table = $wpdb->prefix . 'events';
            $results = $wpdb->delete($table, $where);

            if ($results) {
                $success_msg = "Event deleted";
            } else {
                $error_msg = "Error deleting event";
            }
        }
    }
}
