<?php if (!isset($_GET['id']) || empty($_GET['id'])) wp_redirect(home_url()); ?>

<?php

/**
 * Template Name: Single Event Page
 */
get_header(); ?>

<?php
global $wpdb;
global $success_msg;
global $error_msg;

$events_table = $wpdb->prefix . 'events';
$users_table = $wpdb->prefix . 'users';

$event = $wpdb->get_row("SELECT * FROM $events_table JOIN $users_table ON e_organizer_id=ID  WHERE e_id={$_GET['id']}");

$user_id = get_current_user_id();

$event_name_arr = explode(" ", str_replace(',', '', $event->e_location), 4);

$related = [];

foreach ($event_name_arr as $q) {
    $res = $wpdb->get_results("SELECT * FROM $events_table WHERE e_location LIKE '%$q%'");

    foreach ($res as $r) {
        if (!in_array($r, $related) && $r->e_id != $event->e_id) {
            array_push($related, $r);
        }
    }
}
?>


<div class="single-event-con">
    <div class="title-con">
        <h1><?php echo $event->e_name ?></h1>
        <div class="host-con">
            <ion-icon name="person-circle"></ion-icon>
            <?php
            $fullname = get_fullname_meta($event->e_organizer_id)
            ?>
            <div>
                <p class="host-by">Hosted By</p>
                <p class="host-name"><?php echo $fullname != '' ? $fullname : $event->user_email ?></p>
            </div>
        </div>
    </div>



    <div class="event-con">
        <div class="event-left">
            <img src="<?php echo $event->e_image_url; ?>" alt="image">

            <div class="event-desc">
                <p class="event-desc-h">Event Details</p>
                <p class="event-desc-s">
                    <?php echo $event->e_desc; ?>
                </p>
            </div>
        </div>

        <div class="event-right">
            <p class="error"><?php echo $error_msg; ?></p>
            <p class="success"><?php echo $success_msg; ?></p>
            <?php
            if (is_user_logged_in()) {
                if (is_user_in_role(wp_get_current_user(), 'organizer') && $event->e_organizer_id == get_current_user_id()) {
            ?>
                    <div class="event-book-edit">
                        <a href="<?php echo site_url("/update-event?id={$_GET['id']}") ?>"><button type="button" class="custom-btn"><ion-icon name="create"></ion-icon><span>EDIT EVENT</span></button></a>
                    </div>
                    <?php
                } else {
                    if ($event->e_tickets_remaining > 0) {
                    ?>
                        <form action="" method="POST">
                            <input type="hidden" name="e_id" value="<?php echo $event->e_id; ?>">
                            <input type="hidden" name="attendee_id" value="<?php echo $user_id; ?>">
                            <div class="event-book-loggedin">
                                <input type="number" min='1' name="t_quantity" value="<?php echo 1; ?>">
                                <button class="custom-btn" type="submit" name="buy_ticket">BOOK A TICKET</button>
                            </div>
                        </form>
                    <?php
                    } else {
                    ?>
                        <button class="custom-btn" type="button" disabled>SOLD OUT</button>
                    <?php
                    }
                    ?>

                <?php
                }
            } else {
                ?>
                <div class="event-book-loggedout">
                    <a href="<?php echo site_url('/login') ?>"><button type="button" class="custom-btn">BOOK A TICKET</button></a>
                </div>
            <?php
            }
            ?>

            <div class="event-loc-time">
                <div class="event-lt">
                    <ion-icon name="ticket-outline"></ion-icon>
                    <div>
                        <p class="lt-h">Tickets remaining (Total)</p>
                        <p class="lt-s"><?php echo "$event->e_tickets_remaining ($event->e_capacity)" ?></p>
                    </div>
                </div>
                <hr>
                <div class="event-lt">
                    <ion-icon name="card-outline"></ion-icon>
                    <div>
                        <p class="lt-h">Price</p>
                        <p class="lt-s"><?php echo $event->e_price > 0 ? add_commas($event->e_price) : "<i>FREE</i>" ?></p>
                    </div>
                </div>
                <hr>
                <div class="event-lt">
                    <ion-icon name="time-outline"></ion-icon>
                    <div>
                        <p class="lt-h">Date and Time</p>
                        <p class="lt-s"><?php echo style_date($event->e_date) ?>, <?php echo style_time($event->e_time) ?></p>
                    </div>
                </div>
                <hr>
                <div class="event-lt">
                    <ion-icon name="location-outline"></ion-icon>
                    <div>
                        <p class="lt-h">Location</p>
                        <p class="lt-s"> <?php echo $event->e_location ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (count($related) > 0) {

    ?>
        <div class="events-list-con">
            <h2>You may also like</h2>

            <div class="events-list">
                <?php
                foreach (array_slice($related, 0, 6) as $event) {
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
</div>

<?php get_footer(); ?>