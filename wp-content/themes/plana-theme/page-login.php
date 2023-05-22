<?php
if (is_user_logged_in()) wp_redirect(home_url());
/*

Template Name: Login Page
*/


if (isset($_POST['login-submit'])) {

    // Sanitize and validate user input
    $email = sanitize_text_field($_POST['email']);
    $password = sanitize_text_field($_POST['password']);

    $user_verify = wp_signon([
        'user_login' => $email,
        'user_password' => $password,
        'remember' => true,
    ]);

    if (is_wp_error($user_verify)) {
        $error_msg = $user_verify->get_error_message();
    }
}
?>

<?php get_header(); ?>

<div class="form-container">
    <div class="regcover">
        <div class="event">
            <h1>Plana</h1>
            <P>Welcome back to Plana. Your number one event management system.</P>
        </div>
        <form action="" method="POST">
            <div class="form">
                <h2>Login</h2>

                <p class="error"><?php echo $error_msg ?></p>

                <div class="input1">
                    <label for="">Email Address</label>
                    <div class="icons1">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" placeholder="Enter email address" name="email" required>
                    </div>
                </div>
                <div class="input1">
                    <label for="">Password</label>
                    <div class="icons1">
                        <ion-icon name="lock-open-outline"></ion-icon>
                        <input type="password" placeholder="Enter password" name="password" required>
                    </div>
                </div>
                <button type="submit" class="btnreg" name="login-submit">Login</button>

                <p class="form-alt">
                    Don't have an account? <a href="<?php echo site_url('/register') ?>">Register</a>
                </p>
            </div>

        </form>
    </div>
</div>
<?php
get_footer();
?>