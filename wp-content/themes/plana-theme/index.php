<?php get_header(); ?>

<?php
global $wpdb;
global $success_msg;
global $error_msg;


echo $success_msg;
echo $error_msg;

$events_table = $wpdb->prefix . 'events';
$events = $wpdb->get_results("SELECT * FROM $events_table");
?>


<h1>Index</h1>

<p>
    <a href="<?php echo site_url('/create-event') ?>">test create event</a>
</p>
<p>
    <a href="<?php echo site_url('/update-event?id=2') ?>">test update event</a>
</p>

<form action="" method="post">
    Test Delete Event
    <input type="number" name="e_id">
    <button type="submit" name="delete_event">Test Delete Event</button>
</form>


<div class="events">
    <br>
    <p>Available Events</p>
    <hr>
    <?php
    foreach ($events as $event) {
    ?>
        <a href='<?php echo site_url("/event?id={$event->e_id}"); ?>'>
            <?php echo $event->e_name; ?>
            (<?php echo $event->e_tickets_remaining; ?>)
        </a>
    <?php
    }
    ?>
    <hr>
</div>


<?php get_footer(); ?>