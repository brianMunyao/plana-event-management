<?php
if (isset($_POST['logout'])) wp_logout();
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

        <?php
        $slug = basename(get_permalink());
        if ($slug == 'register' || $slug == 'login') {
        ?>
            <nav class="form-nav">
                <?php
                if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>
            </nav>
        <?php
        } else {
        ?>

            <nav>
                <?php
                if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } ?>

                <div class="nav-links">
                    <?php
                    if (is_user_logged_in()) {
                    ?>
                        <a href="<?php echo site_url('/orders'); ?>">Ticket Orders</a>

                        <?php
                        if (!is_user_in_role(wp_get_current_user(), 'attendee')) {
                        ?>

                            <a href="<?php echo site_url('/manage-events') ?>">Manage Events</a>
                            <a href="<?php echo site_url('/create-event'); ?>"><ion-icon name="add"></ion-icon> Create Event</a>
                        <?php
                        }
                        ?>


                        <div class="separator"></div>

                        <form action="" method="post">
                            <span class="logged-user">
                                <ion-icon name='person-outline'></ion-icon>
                                <?php

                                $name = get_fullname_meta(get_current_user_id());
                                echo $name != '' ? $name : get_userdata(get_current_user_id())->user_login;
                                ?>

                                <div>
                                    <button class="custom-btn" name="logout" type="submit">Logout</button>
                                </div>
                            </span>
                        </form>
                    <?php
                    } else {
                    ?>
                        <a href="<?php echo site_url('/register') ?>"><button class="custom-btn">Register</button></a>
                    <?php
                    }
                    ?>
                </div>
                <span class="burger"><ion-icon name="menu"></ion-icon>
                    <div class="mob-nav-link">
                        <?php
                        if (is_user_logged_in()) {
                        ?>
                            <a href="<?php echo site_url('/orders'); ?>">Ticket Orders</a>

                            <?php
                            if (!is_user_in_role(wp_get_current_user(), 'attendee')) {
                            ?>

                                <a href="<?php echo site_url('/manage-events') ?>">Manage Events</a>
                                <a href="<?php echo site_url('/create-event'); ?>">Create Event</a>
                            <?php
                            }
                            ?>

                            <span class="logged-user">
                                <ion-icon name='person-outline'></ion-icon>
                                <a href="">
                                    <?php

                                    $name = get_fullname_meta(get_current_user_id());
                                    echo $name != '' ? $name : get_userdata(get_current_user_id())->user_login;
                                    ?>
                                </a>
                            </span>

                            <form action="" method="post">
                                <button class="custom-btn" name="logout" type="submit">Logout</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <a href="<?php echo site_url('/register') ?>"><button class="custom-btn">Register</button></a>
                        <?php
                        }
                        ?>
                    </div>
                </span>


            </nav>

        <?php } ?>

        <div class="inner-body">