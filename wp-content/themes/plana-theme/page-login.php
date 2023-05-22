<?php
/*
Template Name: Login Page
*/
get_header();
?>

<?php
if (isset($_POST['submit'])) {
    require_once('wp-load.php');

    // Sanitize and validate user input
    $username = sanitize_text_field($_POST['username']);
    $password = sanitize_text_field($_POST['password']);

    // Perform login
    $login_data = array(
        'user_login' => $username,
        'user_password' => $password,
        'remember' => true,
    );

    $user_verify = wp_signon($login_data, false);

    if (!is_wp_error($user_verify)) {
        // Redirect to the home page or any desired page after successful login
        wp_redirect(home_url());
        exit;
    } else {
        $error_message = $user_verify->get_error_message();
        echo "Login failed: " . $error_message;
    }
}
?>

<div class="form-container">
    <div class="regcover">
        <div class="event">
            <h1>Plana</h1>
            <P>Welcome back to Plana. Your number one event management system.</P>
        </div>
        <form action="">
            <div class="form">
                    <h2>Login</h2>
                    <div class="input1">
                        <label for="">Email Address</label>
                        <div class="icons1">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="text" placeholder="Enter email address" name="email">
                        </div>
                    </div>
                    <div class="input1">
                        <label for="">Password</label>
                        <div class="icons1">
                            <ion-icon name="lock-open-outline"></ion-icon>
                            <input type="password" placeholder="Enter password" name="password">
                        </div>
                    </div>
                    <button class="btnreg" name="submit">Login</button>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>