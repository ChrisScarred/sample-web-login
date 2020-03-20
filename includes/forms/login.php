<!DOCTYPE html>
<html lang="sk">
<head>
    <?php require("includes/head-tag-contents.php");?>
</head>
<body>
    <div>
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div>
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
            </div>    
            <div>
                <label>Password</label>
                <input type="password" name="password">
                <span><?php echo $password_err; ?></span>
            </div>
            <div>
                <input type="submit" value="Login" name="login-btn">
            </div>
            <p>No account? <a href="register.php">Sign up!</a></p>
        </form>
    </div>
</body>
</html>