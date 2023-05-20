<?php
/*
Template Name: Register Page
*/
get_header();
?>
<?php
if (isset($_POST['submit'])) : ?>
  <?php
  // sanitize user inputs
  $fullname = $_POST['fullname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // validate user inputs
  $errors = array();
  if (empty($fullname)) {
    $errors['fullname'] = 'Please enter your full name';
  }

  if (empty($phone)) {
    $errors['phone'] = 'Please enter a phone number';
  } elseif (!filter_var($phone)) {
    $errors['phone'] = 'Please enter a valid phone number';
  }

  if (empty($email)) {
    $errors['email'] = 'Please enter an email address';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address';
  }

  if (empty($password)) {
    $errors['password'] = 'Please enter a password';
  }

  // create new user if there are no errors
  if (empty($errors)) {
    $user_id = wp_create_user($fullname, $password, $email);
    if (is_wp_error($user_id)) {
      var_dump($user_id);
      echo '<p class="register-error">An error occurred while creating your account. Please try again later.</p>';
    } else {
      wp_update_user(array('ID' => $user_id, 'role' => 'subscriber'));
      // echo '<p class="register-success">Your account has been created successfully. Please login using your credentials.</p>';
      echo ("<script>location.href = 'http://localhost/plana-event-management';</script>");
      // exit(wp_redirect("Location: /plana-event-management/login"));
    }
  } else {
    // display errors
    foreach ($errors as $error) {
      echo '<p class="register-error">' . $error . '</p>';
    }
  }
  ?>
<?php endif ?>

<div class="form-container">
    <div class="regcover"> 
        <div class="event">
            <h1>Plana</h1>
            <P>Plan, organize, and elevate your events with ease using our comprehensive event management system.</P>
        </div>
        <form action="">
            <div class="form">
                <h2>Register</h2>
                <div class="input1">
                    <label for="fullname">Full Name</label>
                    <div class="icons1">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" placeholder="Enter full name" name="fullname" id="fullname">
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
                        <input type="text" placeholder="Enter email address" name="email">
                    </div>
                </div>
                <div class="input1">
                    <label for="password">Password</label>
                    <div class="icons1">
                        <ion-icon name="lock-open-outline"></ion-icon>
                        <input type="password" placeholder="Enter password" name="password">
                    </div>
                </div>
                <button class="btnreg" name="submit">Register</button>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>