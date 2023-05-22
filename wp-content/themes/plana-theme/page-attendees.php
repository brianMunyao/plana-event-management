<?php

/**
 * 
 * Template Name: Event Attendees Page
 */
get_header();

function aggregateQuantityByEmail($array)
{
    $result = [];

    foreach ($array as $item) {
        $user_email = $item->user_email;
        $t_quantity = $item->t_quantity;

        if (isset($result[$user_email])) {
            $result[$user_email] += $t_quantity;
        } else {
            $result[$user_email] = $t_quantity;
        }
    }

    return $result;
}



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
            <th style="width:100px;">No.</th>
            <th>Attendee Email</th>
            <th style="width:150px;">Tickets Bought</th>
        </tr>

        <?php
        if (count($attendees) > 0) {
            $i = 0;
            foreach (aggregateQuantityByEmail($attendees) as $user_email => $t_quantity) {
        ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td><?php echo $user_email; ?></td>
                    <td><?php echo $t_quantity; ?></td>
                </tr>
            <?php
            }
        } else {
            ?>
            <tr>
                <td colspan="5" class="empty-row">No ticket purchases made</td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

<?php get_footer() ?>