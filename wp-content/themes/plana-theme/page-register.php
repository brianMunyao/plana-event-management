<?php
/*
Template Name: Register Page
*/
get_header();

if (isset($_POST['submit'])) {
    require_once('wp-load.php');

    // Create a new user
    $user_data = array(
        'user_login'  => $_POST['fullname'],
        'user_password' => $_POST['password'],
        'user_email'  => $_POST['email'],
    );

    $user_id = wp_insert_user($user_data);

    if (!is_wp_error($user_id)) {
        echo "User created successfully. User ID: " . $user_id;
    } else {
        echo "Error creating user: " . $user_id->get_error_message();
    }
}
?>

<div class="form-container">
    <div class="regcover">
        <div class="event">
            <h1>Plana</h1>
            <p>Plan, organize, and elevate your events with ease using our comprehensive event management system.</p>
        </div>
        <form method="POST" action="">
            <div class="form">
                <h2>Register</h2>

                <div class="mychoice">
                    <div>
                        <label>
                            <input type="radio" name="role" value="organizer">
                            <span>organizer</span>
                        </label>
                        <label>
                            <input type="radio" name="role" value= "attendee" checked="">
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
                        <input type="text" placeholder="Enter phone number" name="phone">
                    </div>
                </div>
                <div class="input1">
                    <label for="email">Email Address</label>
                    <div class="icons1">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="text" placeholder="Enter email address" name="email" required>
                    </div>
                </div>
                <div class="input1">
                    <label for="password">Password</label>
                    <div class="icons1">
                        <ion-icon name="lock-open-outline"></ion-icon>
                        <input type="password" placeholder="Enter password" name="password" required>
                    </div>
                </div>
                <button class="btnreg" type="submit" name="submit">Register</button>
            </div>
        </form>
    </div>
</div>

<?php
get_footer();
?>