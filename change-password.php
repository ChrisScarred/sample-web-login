<?php
require "functions/user-auth.php";
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="sk">
<head>
    <?php require("includes/head-tag-contents.php");?>
</head>
<body>
<?php require("includes/design-top.php");?>

<?php require("includes/navigation.php");?>

<?php require("includes/forms/change-password.php");?>

<?php require("includes/footer.php");?> 
</body>
</html>