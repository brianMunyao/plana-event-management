<?php

/**
 * @package EventManagement
 */

namespace Inc\Pages;

class ManageTicket
{
    public function register()
    {
        $this->create_ticket_db();
        $this->buy_ticket();
    }

    private function create_ticket_db()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'tickets';

        $wpdb->query("CREATE TABLE IF NOT EXISTS $table(
            t_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            t_event_id INT NOT NULL,
            t_attendee_id INT NOT NULL,
            t_quantity INT NOT NULL DEFAULT 1
        );");
    }

    private function buy_ticket()
    {
        if (isset($_POST['buy_ticket'])) {
            global $success_msg;
            global $error_msg;

            global $wpdb;
            $events_table = $wpdb->prefix . 'events';
            $tickets_table = $wpdb->prefix . 'tickets';

            $available_tickets = $wpdb->get_var("SELECT e_tickets_remaining FROM $events_table WHERE e_id={$_POST['e_id']}");

            if ($available_tickets > 0) {
                // to reduce the number of available tickets
                $results = $wpdb->update(
                    $events_table,
                    ['e_tickets_remaining' => $available_tickets - 1],
                    ['e_id' => $_POST['e_id']]
                );

                if ($results) {
                    //TODO: add support to buy more than one ticket
                    // add ticket
                    $is_inserted = $wpdb->insert($tickets_table, [
                        't_event_id' => $_POST['e_id'],
                        't_attendee_id' => $_POST['attendee_id'],
                        't_quantity' => $_POST['t_quantity'] ?? 1
                    ]);

                    if ($is_inserted) {
                        $success_msg = "Ticket bought";
                    } else {
                        $error_msg = "Error buying ticket";
                    }
                }
            } else {
                $error_msg = "No more available tickets";
            }
        }
    }

    // private function create_ticket()
    // {
    //     global $success_msg;
    //     global $error_msg;

    //     global $wpdb;
    //     $table = $wpdb->prefix . 'tickets';

    //     if (isset($_POST['create_ticket'])) {
    //         $data = [
    //             'e_name' => $_POST['e_name'],
    //             'e_date' => $_POST['e_date'],
    //             'e_time' => $_POST['e_time'],
    //             'e_location' => $_POST['e_location'],
    //             'e_desc' => $_POST['e_desc'],
    //             'e_capacity' => $_POST['e_capacity'],
    //             'e_tickets_remaining' => $_POST['e_tickets_remaining'],
    //             'e_organizer_id' => $_POST['e_organizer_id'],
    //         ];

    //         $results = $wpdb->insert($table, $data);


    //         if ($results) {
    //             $success_msg = "ticket added";
    //         } else {
    //             $error_msg = "Error adding ticket";
    //         }
    //     }
    // }

    // private function update_ticket()
    // {
    //     global $success_msg;
    //     global $error_msg;

    //     global $wpdb;
    //     $table = $wpdb->prefix . 'tickets';

    //     if (isset($_POST['update_ticket'])) {
    //         $data = [
    //             'e_name' => $_POST['e_name'],
    //             'e_date' => $_POST['e_date'],
    //             'e_time' => $_POST['e_time'],
    //             'e_location' => $_POST['e_location'],
    //             'e_desc' => $_POST['e_desc'],
    //             'e_capacity' => $_POST['e_capacity'],
    //             // 'e_tickets_remaining' => $_POST['e_tickets_remaining'],
    //         ];

    //         $where = ['e_id' => $_POST['e_id']];

    //         $results = $wpdb->update($table, $data, $where);


    //         if ($results) {
    //             $success_msg = "ticket updated";
    //         } else {
    //             $error_msg = "Error updating ticket";
    //         }
    //     }
    // }

    // function delete_ticket()
    // {
    //     if (isset($_POST['delete_ticket'])) {
    //         $where = ['e_id' => $_POST['e_id']];

    //         global $wpdb;
    //         global $success_msg;
    //         global $error_msg;

    //         $table = $wpdb->prefix . 'tickets';
    //         $results = $wpdb->delete($table, $where);

    //         if ($results) {
    //             $success_msg = "ticket deleted";
    //         } else {
    //             $error_msg = "Error deleting ticket";
    //         }
    //     }
    // }
}
