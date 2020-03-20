<?php
require "functions/user-auth.php";
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php require("includes/head-tag-contents.php");?>
</head>
<body>
<?php require("includes/design-top.php");?>

<?php require("includes/navigation.php");?>

    <div>
        <h1>Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
    </div>
    <p>
        <a href="change-password.php">Change password</a>
        <a href="functions/logout.php">Logout</a>
    </p>
    <?php if (!$_SESSION['verified']): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Verify your email address via <strong><?php echo $_SESSION['email']; ?></strong>
            <input type="submit" value="Resend verification email" name="verification-email-resend-btn">            
          </div>
        <?php else: ?>
          <p>Your email address is verified</p>
    <?php endif;?>
<?php require("includes/footer.php");?> 
</body>
</html>