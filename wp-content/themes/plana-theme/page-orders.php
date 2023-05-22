<?php if (!is_user_logged_in()) wp_redirect(site_url('/login')); ?>

<?php

/**
 * 
 * Template Name: Ticket Orders Page
 */
get_header();

global $wpdb;
$users_table = $wpdb->prefix . "users";
$events_table = $wpdb->prefix . "events";
$tickets_table = $wpdb->prefix . "tickets";

$curr_user_id = get_current_user_id();

$my_tickets = $wpdb->get_results("SELECT * FROM $tickets_table JOIN $events_table ON t_event_id=e_id WHERE t_attendee_id=$curr_user_id ORDER BY t_date_bought DESC");
?>
<div class="orders-con">
    <div class="attendees-top">
        <a href="<?php echo home_url(); ?>"><span><ion-icon name="arrow-back"></ion-icon>Back To Home</span></a>

        <b>
            <p class="event-name">My Ticket History</p>
        </b>
    </div>

    <table>
        <tr>
            <th style="width:100px;">No.</th>
            <th>Event</th>
            <th style="width:150px;">
                <p class="table-overflow">Tickets Bought</p>
            </th>
            <th style="width:120px;">Price</th>
            <th style="width:200px;">
                <p class="table-overflow">Bought on</p>
            </th>
        </tr>

        <?php
        if (count($my_tickets) > 0) {
            $i = 0;
            foreach ($my_tickets as $ticket) {
        ?>
                <tr>
                    <td><?php echo ++$i; ?></td>
                    <td>
                        <p class="table-overflow"><?php echo $ticket->e_name; ?></p>
                    </td>
                    <td><?php echo $ticket->t_quantity; ?></td>
                    <td><?php echo add_commas($ticket->t_cost); ?></td>
                    <td>
                        <p class="table-overflow"><?php echo style_date($ticket->t_date_bought) . ", " . style_time($ticket->t_date_bought); ?></p>
                    </td>
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