<?php
/*
Template Name: Login Page
*/
get_header();
?>

<?php
// Check if user is already logged in
if (is_user_logged_in()) {
    wp_redirect('/plana-event-management/home'); // Redirect to dashboard if already logged in
    exit;
}

// Check if form was submitted
if (isset($_POST['submit'])) {
    // Verify user credentials
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $creds = array(
        'user_login' => $user_email,
        'user_password' => $user_password,
        'remember' => true
    );
    $user = wp_signon($creds, false);

    
    if (!is_wp_error($user)) {
        // Display error message if authentication failed
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        do_action('wp_login', $user->user_login, $user);

        wp_redirect('/plana-event-management/home');
        exit;
      }
      echo "server error";
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