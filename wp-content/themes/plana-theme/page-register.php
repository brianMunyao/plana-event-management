<?php
/*

Template Name: Register Page
*/


if (is_user_logged_in()) wp_redirect(home_url());

if (isset($_POST['register-submit'])) {
    $user_id = wp_insert_user([
        'user_login' => $_POST['email'],
        'user_pass' => $_POST['password'],
        'user_email' => $_POST['email'],
        'role' => $_POST['role']
    ]);

    if (!is_wp_error($user_id)) {
        update_user_meta($user_id, 'fullname', $_POST['fullname']);
        update_user_meta($user_id, 'phone', $_POST['phone']);

        $user = wp_signon([
            'user_login' => $_POST['email'],
            'user_password' => $_POST['password']
        ]);

        if (!is_wp_error($user)) {
            $error_msg = 'Register failed: ' . $user->get_error_message();
        }
    } else {
        $error_msg = $user_id->get_error_message();
    }
}
?>


<?php get_header(); ?>

<div class="form-container">
    <div class="regcover">
        <div class="event">
            <h1>Plana</h1>
            <p>Plan, organize, and elevate your events with ease using our comprehensive event management system.</p>
        </div>
        <form method="POST" action="">
            <div class="form">
                <h2>Register</h2>

                <p class="error"><?php echo $error_msg ?></p>

                <div class="mychoice">
                    <div>
                        <label for="organizer-radio">
                            <input id="organizer-radio" type="radio" name="role" value="organizer" required>
                            <span>organizer</span>
                        </label>
                        <label for="attendee-radio">
                            <input id="attendee-radio" type="radio" name="role" value="attendee" checked required>
                            <span>Attendee</span>
                        </label>

                    </div>
                </div>

                <div class="input1">
                    <label for="fullname">Full Name</label>
                    <div class="icons1">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" placeholder="Enter full name" name="fullname" id="fullname" required>
                    </div>
                </div>
                <div class="input1">
                    <label for="phone">Phone Number</label>
                    <div class="icons1">
                        <ion-icon name="call-outline"></ion-icon>
                        <input type="tel" placeholder="Enter phone number" name="phone" required>
                    </div>
                </div>
                <div class="input1">
                    <label for="email">Email Address</label>
                    <div class="icons1">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" placeholder="Enter email address" name="email" required>
                    </div>
                </div>
                <div class="input1">
                    <label for="password">Password</label>
                    <div class="icons1">
                        <ion-icon name="lock-open-outline"></ion-icon>
                        <input type="password" placeholder="Enter password" name="password" required>
                    </div>
                </div>
                <button class="btnreg" type="submit" name="register-submit">Register</button>

                <p class="form-alt">
                    Already have an account? <a href="<?php echo site_url('/login') ?>">Login</a>
                </p>
            </div>
        </form>
    </div>
</div>

<?php get_footer(); ?>