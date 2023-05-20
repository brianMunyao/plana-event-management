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
        <nav>
            <?php
            if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } ?>

            <?php

            if (is_user_logged_in()) {
            ?>
                <form action="" method="post">
                    <button class="custom-btn" name="logout" type="submit">Logout</button>
                </form>
            <?php
            } else {
            ?>
                <button class="custom-btn">Login</button>
            <?php
            }

            ?>
        </nav>

        <div class="inner-body">