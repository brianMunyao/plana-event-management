<?php

if (isset($_POST['logout'])) {
    wp_logout();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo bloginfo('name'); ?></title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <?php wp_head(); ?>
</head>



<body>
    <div class="app-body">
        <pre>
   <?php
    // echo is_user_in_role(wp_get_current_user(), 'organizer') ? "Organizer" : 'Not Organizer';
    ?>
   </pre>
        <nav>
            <?php
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } ?>

            <div class="nav-links">
                <?php
                if (is_user_in_role(wp_get_current_user(), 'organizer')) {
                ?>
                    <!-- <a href="<?php // echo site_url('/manage-events'); 
                                    ?>">Manage Events</a>
                    <a href="<?php // echo site_url('/create-event'); 
                                ?>">Create An Event</a> -->
                <?php
                } else {
                ?>
                    <!-- <a href="<?php // echo site_url('/orders'); 
                                    ?>">Ticket Orders</a> -->
                <?php
                }
                ?>

                <a href="<?php echo site_url('/manage-events'); ?>">Manage Events</a>
                <a href="<?php echo site_url('/create-event'); ?>">Create Event</a>
                <a href="<?php echo site_url('/orders'); ?>">Ticket Orders</a>
            </div>

            <?php if (is_user_logged_in()) { ?>
                <form action="" method="post">
                    <button class="custom-btn" name="logout" type="submit">Logout</button>
                </form>
            <?php } else { ?>
                <button class="custom-btn">Login</button>
            <?php } ?>
        </nav>

        <div class="inner-body">