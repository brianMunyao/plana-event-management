<?php get_header(); ?>

<?php
// global $wpdb;
global $success_msg;
global $error_msg;


echo $success_msg;
echo $error_msg;
?>


<h1>Index</h1>

<a href="<?php echo site_url('/update-event?id=1') ?>">test update event</a>

<form action="" method="post">
    Test Delete Event
    <input type="number" name="e_id">
    <button type="submit" name="delete_event">Test Delete Event</button>
</form>

<?php get_footer(); ?>