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
<div>
	<h2>This is a sample website with a login/register function</h2>
	<p>the website references email verification but it was not implemented</p>
	<p>warning: this code was not tested</p>
</div>

<?php require("includes/forms/login.php");?>

<?php require("includes/footer.php");?>
</body>
</html>