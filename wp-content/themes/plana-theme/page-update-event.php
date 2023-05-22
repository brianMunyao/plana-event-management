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


$event = $wpdb->get_row("SELECT * FROM $events_table WHERE e_id={$_GET['id']}");
?>

<form action="" method="post">
    <div class="create-event-form">
        <h1>Update Event</h1>

        <p class="error"><?php echo $error_msg ?></p>
        <p class="success"><?php echo $success_msg ?></p>

        <input type="hidden" name="e_id" value="<?php echo $event->e_id; ?>">
        <div class="inner-form">
            <div class="input-con">
                <label for="e_name">Event Name</label>
                <input type="text" name="e_name" id="e_name" placeholder="Enter the event name" value="<?php echo $event->e_name; ?>" required>
            </div>

            <div class="double-input">
                <div class="input-con">
                    <label for="e_date">Event Date</label>
                    <input type="date" name="e_date" id="e_date" value="<?php echo $event->e_date; ?>" required>
                </div>
                <div class="input-con">
                    <label for="e_time">Event Time</label>
                    <input type="time" name="e_time" id="e_time" value="<?php echo $event->e_time; ?>" required>
                </div>
            </div>

            <div class="input-con">
                <label for="e_location">Event Location</label>
                <input type="text" name="e_location" id="e_location" placeholder="Enter the event location" value="<?php echo $event->e_location; ?>" required>
            </div>
            <div class="input-con">
                <label for="e_desc">Event Description</label>
                <textarea name="e_desc" id="e_desc" cols="30" rows="5" placeholder="Give a brief explanation about your event">
                <?php echo $event->e_desc; ?>
                </textarea>
            </div>
            <div class="double-input">
                <div class="input-con">
                    <label for="e_capacity">Event Capacity</label>
                    <input type="number" min='1' name="e_capacity" id="e_capacity" placeholder="Max capacity" value="<?php echo $event->e_capacity; ?>" required>
                </div>
                <div class="input-con">
                    <label for="e_price">Event Price</label>
                    <input type="number" min="0" name="e_price" id="e_price" placeholder="How much" value="<?php echo $event->e_price; ?>" required>
                </div>
            </div>
            <div class="input-con">
                <label for="e_image_url">Event Image URL </label>
                <input type="url" name="e_image_url" id="e_image_url" placeholder="Link to your image" value="<?php echo $event->e_image_url; ?>" required>
            </div>
        </div>

        <button type="submit" name='update_event' class="custom-btn">UPDATE</button>
    </div>
</form>


<?php get_footer(); ?>