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
        <p class="section-subtext">Don't miss out on the hottest upcoming events!</p>
        <div class="events-list">
            <?php
            $upcoming_events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_date >= CURDATE()  ORDER BY e_date ASC");
            foreach (array_slice($upcoming_events, 0, 6) as $event) {
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

    <!-- Limited Tickets -->
    <?php
    $limited_events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_tickets_remaining <= 10");

    if (count($limited_events) > 0) {
    ?>
        <div class="events-list-con">
            <h2>Hurry, Limited Tickets</h2>
            <p class="section-subtext">Act fast to secure your tickets before they run out!</p>
            <div class="events-list">
                <?php
                foreach (array_slice($limited_events, 0, 3) as $event) {
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
    <?php
    }

    ?>


    <!-- Cheap Events -->
    <div class="events-list-con">
        <h2>Budget-Friendly Events</h2>
        <p class="section-subtext">Enjoy amazing experiences without breaking the bank!</p>

        <div class="events-list">
            <?php
            $cheap_events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_price < 200");

            foreach (array_slice($cheap_events, 0, 6)  as $event) {
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