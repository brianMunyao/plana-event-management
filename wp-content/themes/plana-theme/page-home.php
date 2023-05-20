<?php

/**
 * 
 *  Template Name: Home Template
 */

get_header();
?>

<?php
global $wpdb;
global $success_msg;
global $error_msg;


echo $success_msg;
echo $error_msg;

$events_table = $wpdb->prefix . 'events';
$events = $wpdb->get_results("SELECT * FROM $events_table");
?>

<div class="home-container">
    <div class="search-section">
        <div class="search-section-inner">
            <h2>Discover Events Near You</h2>

            <div class="search-con">
                <ion-icon name="search-outline"></ion-icon>
                <input type="search" name="search" id="search" placeholder="Search by location or event name">
                <button class="custom-btn">SEARCH</button>
            </div>
        </div>
    </div>

    <div class="events-list-con">
        <h2>Upcoming Events</h2>

        <div class="events-list">
            <?php
            foreach ($events as $event) {
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
                                <span class="event-price"><?php echo add_commas($event->e_price); ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
    </div>
</div>


<?php get_footer(); ?>