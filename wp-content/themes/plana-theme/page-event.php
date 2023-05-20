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
?>

<div class="single-event-con">
    <div class="title-con">
        <h1><?php echo $event->e_name ?></h1>
        <div class="host-con">
            <ion-icon name="person-circle"></ion-icon>
            <div>
                <p class="host-by">Hosted By</p>
                <p class="host-name"><?php echo $event->user_email ?></p>
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
                    <ion-icon name="time-outline"></ion-icon>
                    <div>
                        <p class="lt-h">Date and Time</p>
                        <p class="lt-s"><?php echo $event->e_date ?>, <?php echo $event->e_time ?></p>
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
</div>

<?php get_footer(); ?>