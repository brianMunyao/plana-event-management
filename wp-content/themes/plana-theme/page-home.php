<?php

/**
 * 
 *  Template Name: Home Template
 */

get_header();
?>

<?php
global $wpdb;

$events_table = $wpdb->prefix . 'events';
$events = $wpdb->get_results("SELECT * FROM $events_table");
?>

<div class="home-container">
    <form action="<?php echo site_url('/search') ?>" method="get">
        <div class="search-section">
            <div class="search-section-inner">
                <h2>Discover Events Near You</h2>

                <div class="search-con">
                    <ion-icon name="search-outline"></ion-icon>
                    <input type="search" name="q" id="search" placeholder="Search by location or event name">
                    <button class="custom-btn" type="submit">SEARCH</button>
                </div>
            </div>
        </div>
    </form>

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
                                <span class="event-date"><ion-icon name="calendar-outline"></ion-icon><?php echo style_date($event->e_date) . " at " . style_time($event->e_time); ?></span>
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
</div>


<?php get_footer(); ?>