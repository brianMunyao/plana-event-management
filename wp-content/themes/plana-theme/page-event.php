<?php
if (!isset($_GET['id']) || empty($_GET['id'])) wp_redirect(home_url());
?>
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

echo $success_msg;
echo $error_msg;

$event = $wpdb->get_row("SELECT * FROM $events_table WHERE e_id={$_GET['id']}");

$user_id = get_current_user_id();
?>

<h1>One Event</h1>

<pre>
<?php var_dump($event) ?>
</pre>

<?php
if (is_user_logged_in()) {
?>
    <form action="" method="POST">
        <input type="hidden" name="e_id" value="<?php echo $event->e_id; ?>">
        <input type="hidden" name="attendee_id" value="<?php echo $user_id; ?>">
        <input type="number" min='1' name="t_quantity" value="<?php echo 1; ?>">
        <button type="submit" name="buy_ticket">
            BUY TICKET
        </button>
    </form>
<?php
} else {
?>
    <a href="<?php echo site_url('/login') ?>"><button type="button">BUY TICKET</button></a>
<?php
}
?>



<?php get_footer(); ?>