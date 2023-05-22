<?php

/**
 * 
 * Template Name: Search Page
 */
?>

<?php get_header() ?>

<?php
$query = $_GET['q'] ?? '';

global $wpdb;

$events_table = $wpdb->prefix . 'events';
$events = $wpdb->get_results("SELECT * FROM $events_table WHERE e_name LIKE '%$query%' OR e_location LIKE '%$query%'");


?>

<div class="search-page-con">
    <form action="" method="get">

        <div class="search-con">
            <ion-icon name="search-outline"></ion-icon>
            <input type="search" name="q" id="search" value="<?php echo $_GET['q'] ?>" placeholder="Search by location or event name">
            <button class="custom-btn" type="submit">SEARCH</button>
        </div>
    </form>

    <p class="search-results">
        <?php echo count($events) . " result(s) found"; ?>
    </p>

    <div class="events-list">
        <?php
        if (count($events) > 0) {

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
        } else {
            ?>
            <p class="no-results">
                No results matching that query
            </p>
        <?php
        }
        ?>
    </div>
</div>

<?php get_footer() ?>