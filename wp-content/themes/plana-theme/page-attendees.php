<?php

/**
 * 
 * Template Name: Event Attendees Page
 */
get_header();


$event_id = $_GET['id'];

global $wpdb;
$users_table = $wpdb->prefix . "users";
$events_table = $wpdb->prefix . "events";
$tickets_table = $wpdb->prefix . "tickets";

$event_name = $wpdb->get_var("SELECT e_name FROM $events_table WHERE e_id=$event_id");


$attendees = $wpdb->get_results("SELECT * FROM $tickets_table JOIN $users_table ON ID=t_attendee_id WHERE t_event_id=$event_id");
?>

<div class="attendees-con">

    <div class="attendees-top">
        <a href="<?php echo site_url('/manage-events?id=') . $event_id ?>"><span><ion-icon name="arrow-back"></ion-icon>Back</span></a>

        <p class="event-name">Attendees for <b><?php echo shorten_string($event_name, 20); ?></b></p>
    </div>

    <table>
        <tr>
            <th>No.</th>
            <th>Attendee Email</th>
            <th>Tickets Bought</th>
        </tr>

        <?php
        $i = 0;
        foreach ($attendees as $attendee) {
        ?>
            <tr>
                <td><?php echo ++$i; ?></td>
                <td><?php echo $attendee->user_email; ?></td>
                <td><?php echo $attendee->t_quantity; ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php get_footer() ?>