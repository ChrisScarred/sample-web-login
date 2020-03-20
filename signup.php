<?php
require "functions/user-auth.php";
 
if(isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){
    header("location: welcome.php");
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

<?php require("includes/forms/signup.php");?>

<?php require("includes/footer.php");?> 
</body>
</html>