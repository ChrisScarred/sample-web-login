<?php
require "functions/config.php";

session_start();
 
$username = $password = "";

// SIGNUP
if(isset($_POST['signup-btn'])){
    $confirm_password = $email = $confirm_email = "";
    $username_err = $password_err = $confirm_password_err = "";
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username";

    } else{

        $sql = "SELECT id FROM users WHERE username = ?";

        if($prep = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($prep, "s", $param_username);
            $param_username = trim($_POST["username"]);
            
            if(mysqli_stmt_execute($prep)){
                mysqli_stmt_store_result($prep);
                
                if(mysqli_stmt_num_rows($prep) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }

            } else{
                echo "Something went wrong.";
            }

        }
        mysqli_stmt_close($prep);
    }
    

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter password";     

    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters";

    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password";     

    } else{
        $confirm_password = trim($_POST["confirm_password"]);

        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Passwords are different";
        }
    }
    
        
    if (empty($_POST['email'])) {
        $email_err = 'Please enter email';
    } else {
        $sql = "SELECT * FROM users WHERE email=?";
        
        if($prep = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($prep, "s", $param_email);
            $param_email = trim($_POST['email']);

            if(mysqli_stmt_execute($prep)){
                mysqli_stmt_store_result($prep);
                
                if(mysqli_stmt_num_rows($prep) == 1){
                    $email_err = "This email is taken";

                } elseif(filter_var($param_email, FILTER_VALIDATE_EMAIL) === false) {
                    $email_err = "Enter valid email address";

                } else {
                    $email = trim($_POST["email"]);
                }

            } else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($prep);
    }

    if(empty(trim($_POST["confirm_email"]))){
        $confirm_email_err = "Please confirm email";  

    } else{
        $confirm_email = trim($_POST["confirm_email"]);

        if(empty($email_err) && ($email != $confirm_email)){
            $confirm_email_err = "Emails are different";
        }
    }


    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($confirm_email_err)&& empty($email_err)){
        
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
         
        if($prep = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($prep, "sss", $param_username, $param_password, $param_email);
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            
            if(mysqli_stmt_execute($prep)){
                header("location: login.php");

            } else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($prep);
    }
    mysqli_close($link);
}


if(isset($_POST['login-btn'])){
    $username_err = $password_err = "";

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username";
    } else{
        $username = trim($_POST["username"]);
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter password";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($prep = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($prep, "s", $param_username);
            $param_username = $username;
            
            if(mysqli_stmt_execute($prep)){                
                mysqli_stmt_store_result($prep);
                
                if(mysqli_stmt_num_rows($prep) == 1){         

                    mysqli_stmt_bind_result($prep, $id, $username, $hashed_password);

                    if(mysqli_stmt_fetch($prep)){
                        if(password_verify($password, $hashed_password)){

                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;         
                            header("location: welcome.php");

                        } else{
                            $password_err = "Password incorrect";
                        }
                    }
                } else{
                    $username_err = "User does not exist";
                }
            } else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($prep);
    }
    mysqli_close($link);
}


if(isset($_POST['pass-change-btn'])){
    $new_password = $confirm_password = "";
    $old_password_err = $new_password_err = $confirm_password_err = "";

    if(empty(trim($_POST["old_password"]))){
        $old_password_err = "Please enter password";     
    } elseif(trim($_POST["old_password"]) != $password){
        $old_password_err = "Wrong password";
    } 

    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter new password";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must be at least 6 chatacters long";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password do not match";
        }
    }
        
    if(empty($new_password_err) && empty($confirm_password_err)){
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($prep = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($prep, "si", $param_password, $param_id);
            
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($prep)){
                session_destroy();
                header("location: login.php");
                exit();

            } else{
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($prep);
    }
    mysqli_close($link);
}

?>