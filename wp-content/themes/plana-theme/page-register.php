<?php
/*
Template Name: Register Page
*/
get_header();
?>
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
                        <label for="">Phone Number</label>
                        <div class="icons1">
                            <ion-icon name="call-outline"></ion-icon>
                            <input type="text" placeholder="Enter phone number" name="phone">
                        </div>
                    </div>
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
                    <button class="btnreg" name="submit">Register</button>
            </div>
        </form>
    </div>
</div>
<?php
get_footer();
?>