<?php

/**
 * Template Name: Create Ticket Page
 */

get_header();
?>

<?php
global $success_msg;
global $error_msg;

echo $success_msg;
echo $error_msg;


$curr_user_id = get_current_user_id();

?>




<h1>New Event</h1>

<form action="" method="post">
    <div class="create-event-form">
        <input type="hidden" name="e_organizer_id" value="<?php echo $curr_user_id; ?>">
        <div class="input-con">
            <label for="e_name">Event Name</label>
            <input type="text" name="e_name" id="e_name">
        </div>
        <div class="input-con">
            <label for="e_date">Event Date</label>
            <input type="date" name="e_date" id="e_date">
        </div>
        <div class="input-con">
            <label for="e_time">Event Time</label>
            <input type="time" name="e_time" id="e_time">
        </div>
        <div class="input-con">
            <label for="e_location">Event Location</label>
            <input type="text" name="e_location" id="e_location">
        </div>
        <div class="input-con">
            <label for="e_desc">Event Desc</label>
            <textarea name="e_desc" id="e_desc" cols="30" rows="10"></textarea>
        </div>
        <div class="input-con">
            <label for="e_capacity">Event Capacity</label>
            <input type="number" min='0' name="e_capacity" id="e_capacity">
        </div>
        <div class="input-con">
            <label for="e_price">Event Price</label>
            <input type="number" min="0" name="e_price" id="e_price">
        </div>

        <button type="submit" name='create_event'>CREATE</button>
    </div>
</form>

<?php get_footer() ?>