    <div>
        <h2>Change password</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Old password</label>
                <input type="password" name="old_password" value="<?php echo $old_password; ?>">
                <span><?php echo $old_password_err; ?></span>
            </div> 
            <div>
                <label>New password</label>
                <input type="password" name="new_password" value="<?php echo $new_password; ?>">
                <span><?php echo $new_password_err; ?></span>
            </div>
            <div>
                <label>Confirm new password</label>
                <input type="password" name="confirm_password">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Change password" name="pass-change-btn">
                <a href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>