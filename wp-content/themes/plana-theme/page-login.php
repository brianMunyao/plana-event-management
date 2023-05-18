<?php
/*
Template Name: Login Page
*/
get_header();
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