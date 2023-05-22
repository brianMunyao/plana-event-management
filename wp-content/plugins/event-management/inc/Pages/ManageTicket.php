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
            t_quantity INT NOT NULL DEFAULT 1,
            t_cost INT NOT NULL,
            t_date_bought TIMESTAMP DEFAULT CURRENT_TIMESTAMP
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

            $event_info = $wpdb->get_row("SELECT e_tickets_remaining, e_price FROM $events_table WHERE e_id={$_POST['e_id']}");


            if ($event_info->e_tickets_remaining > 0) {
                /**
                 * Check if the user ordered more tickets than are available
                 */

                if ($_POST['t_quantity'] >  $event_info->e_tickets_remaining) {
                    $error_msg = "Only $event_info->e_tickets_remaining tickets are available";
                } else {
                    // to reduce the number of available tickets

                    $results = $wpdb->update(
                        $events_table,
                        ['e_tickets_remaining' => $event_info->e_tickets_remaining - $_POST['t_quantity']],
                        ['e_id' => $_POST['e_id']]
                    );

                    if ($results) {
                        // add ticket
                        $is_inserted = $wpdb->insert($tickets_table, [
                            't_event_id' => $_POST['e_id'],
                            't_attendee_id' => $_POST['attendee_id'],
                            't_quantity' => $_POST['t_quantity'],
                            't_cost' => ((int)$_POST['t_quantity'] *  (int)$event_info->e_price)
                        ]);

                        if ($is_inserted) {
                            $success_msg = "Ticket bought";
                        } else {
                            $error_msg = "Error buying ticket";
                        }
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
