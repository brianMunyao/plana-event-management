<?php
if (!isset($_GET['id']) || empty($_GET['id'])) wp_redirect(home_url());
?>

<?php

/**
 * Template Name: Create Ticket Page
 */
get_header(); ?>


<?php
global $wpdb;
global $success_msg;
global $error_msg;

$events_table = $wpdb->prefix . 'events';

echo $success_msg;
echo $error_msg;


$event = $wpdb->get_row("SELECT * FROM $events_table WHERE e_id={$_GET['id']}");


?>

<h1>Update Event</h1>

<form action="" method="post">
    <div class="create-event-form">
        <input type="hidden" name="e_id" value="<?php echo $event->e_id; ?>">
        <div class="input-con">
            <label for="e_name">Event Name</label>
            <input type="text" name="e_name" id="e_name" value="<?php echo $event->e_name; ?>">
        </div>
        <div class="input-con">
            <label for="e_date">Event Date</label>
            <input type="date" name="e_date" id="e_date" value="<?php echo $event->e_date; ?>">
        </div>
        <div class="input-con">
            <label for="e_time">Event Time</label>
            <input type="time" name="e_time" id="e_time" value="<?php echo $event->e_time; ?>">
        </div>
        <div class="input-con">
            <label for="e_location">Event Location</label>
            <input type="text" name="e_location" id="e_location" value="<?php echo $event->e_location; ?>">
        </div>
        <div class="input-con">
            <label for="e_desc">Event Desc</label>
            <textarea name="e_desc" id="e_desc" cols="30" rows="10">
            <?php echo $event->e_desc; ?>
            </textarea>
        </div>
        <div class="input-con">
            <label for="e_capacity">Event Capacity</label>
            <input type="number" min='0' name="e_capacity" id="e_capacity" value="<?php echo $event->e_capacity; ?>">
        </div>
        <div class="input-con">
            <label for="e_price">Event Price</label>
            <input type="number" min="0" name="e_price" id="e_price" value="<?php echo $event->e_price; ?>">
        </div>
        <div class="input-con">
            <label for="e_image_url">Event Image URL</label>
            <input type="url" name="e_image_url" id="e_image_url">
        </div>

        <button type="submit" name='update_event'>UPDATE</button>
    </div>
</form>


<?php get_footer(); ?>