    <div>
        <h2>Sign Up</h2>
        <p>Please fill in this form to register</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Confirm password</label>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <label>Email</label>
                <input type="text" name="email" class="form-control form-control-lg" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>
            <div>
                <label>Confirm email</label>
                <input type="text" name="confirm_email" class="form-control form-control-lg" value="<?php echo $confirm_email; ?>">
                <span><?php echo $confirm_email_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Register" name="signup-btn">
                <input type="reset" value="Cancel">
            </div>
            <p>Already have an account? <a href="prihlasit.php">Login!</a></p>
        </form>
    </div>