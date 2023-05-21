<?php

/**
 * Template Name: Manage Events Page
 */

get_header();;

global $wpdb;
$events_table = $wpdb->prefix . "events";
$my_events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_organizer_id=" . get_current_user_id());
?>

<div class="events-list-con">
    <h2>My Events</h2>

    <div class="events-list">
        <?php
        foreach ($my_events as $event) {
        ?>
            <a href='<?php echo site_url("/event?id={$event->e_id}"); ?>'>
                <div class="event-card">
                    <div class="event-top" style="background: url('<?php echo $event->e_image_url; ?>');background-size: cover;background-position: center;">

                        <?php
                        echo $event->e_tickets_remaining > 0 ?
                            "<span class='event-remaining'>Tickets: $event->e_tickets_remaining</span>" :
                            "<span class='event-remaining sold-out'>Sold Out</span>";
                        ?>

                    </div>

                    <div class="event-bottom">
                        <p class="event-loc"><ion-icon name="location-outline"></ion-icon><?php echo $event->e_location; ?></p>
                        <p class="event-name"><?php echo $event->e_name; ?></p>


                        <div class="bottom-inner">
                            <span class="event-date"><ion-icon name="calendar-outline"></ion-icon><?php echo $event->e_date; ?></span>
                            <span class="event-price"><?php echo (int)$event->e_price > 0 ? add_commas($event->e_price) : "FREE"; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        <?php
        }
        ?>
    </div>
</div>

<?php get_footer(); ?>