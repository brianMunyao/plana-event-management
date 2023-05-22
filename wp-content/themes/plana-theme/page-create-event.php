<?php
if (!is_user_logged_in()) wp_redirect(site_url('/login'));
// is_user_in_role(wp_get_current_user(), 'organizer')
?>



<?php

/**
 * Template Name: Create Ticket Page
 */

get_header();
?>

<?php
global $success_msg;
global $error_msg;

$curr_user_id = get_current_user_id();
?>


<form action="" method="post">
    <input type="hidden" name="e_organizer_id" value="<?php echo $curr_user_id; ?>">

    <div class="create-event-form">
        <h1>New Event</h1>

        <p class="error"><?php echo $error_msg ?></p>
        <p class="success"><?php echo $success_msg ?></p>

        <div class="inner-form">
            <div class="input-con">
                <label for="e_name">Event Name</label>
                <input type="text" name="e_name" id="e_name" placeholder="Enter the event name" required>
            </div>

            <div class="double-input">
                <div class="input-con">
                    <label for="e_date">Event Date</label>
                    <input type="date" name="e_date" id="e_date" required>
                </div>
                <div class="input-con">
                    <label for="e_time">Event Time</label>
                    <input type="time" name="e_time" id="e_time" required>
                </div>
            </div>

            <div class="input-con">
                <label for="e_location">Event Location</label>
                <input type="text" name="e_location" id="e_location" placeholder="Enter the event location" required>
            </div>
            <div class="input-con">
                <label for="e_desc">Event Description</label>
                <textarea name="e_desc" id="e_desc" cols="30" rows="5" placeholder="Give a brief explanation about your event"></textarea>
            </div>
            <div class="double-input">
                <div class="input-con">
                    <label for="e_capacity">Event Capacity</label>
                    <input type="number" min='1' name="e_capacity" id="e_capacity" placeholder="Max capacity" required>
                </div>
                <div class="input-con">
                    <label for="e_price">Event Price</label>
                    <input type="number" min="0" name="e_price" id="e_price" placeholder="How much" required>
                </div>
            </div>
            <div class="input-con">
                <label for="e_image_url">Event Image URL </label>
                <input type="url" name="e_image_url" id="e_image_url" placeholder="Link to your image" required>
            </div>
        </div>

        <button type="submit" name='create_event' class="custom-btn">CREATE</button>

    </div>
</form>

<?php get_footer() ?>