<?php
session_start();
if(isset($_SESSION["user"]))
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System Login</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="login_page.css">
</head>

<body>
<div class="wrapper">

    <?php
    if (isset($_POST["login"]))
    {
         $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "database/dbconnect.php";
        $sql= "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
$user= mysqli_fetch_array ($result, MYSQLI_ASSOC);
        if($user)
        {
            if ($password === $user["password"])
            {
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: index.php");
                die();
            }
            else
            {
             echo "<div class = 'alert alert-danger'> password doesn't match</div> ";               
            }
        }
        else
        {
            echo "<div class = 'alert alert-danger'> Email doesn't match</div> ";

        }

    }
  ?>
<form action="login.php" method="post">
    <h2>
                   
     <a href="index.html">
        <i class='bx bx-left-arrow-alt'></i>
    </a>
    </h2>
    <h1>

   Login
    </h1>
    <div class="input-box">
       <input type="email" placeholder="Enter Email:" name="email">
    <i class='bx bxs-user'></i>
    </div>
    <div class="input-box">
        <input type="password" placeholder="Enter your password" name="password">
        <i class='bx bx-lock'></i>
    </div>
    <div class="remember-forgot" >
        <label>
        <input type="checkbox">
        Remember Me
    </label>
    </div>
    <button type="submit" class="btn" value="login" name="login"> 
        Login
    </button>
    <div class="register-link">
<p>
    Don't have account?
    <a href="Register.php">Register</a>
</p>
    </div>
    </form>
</body>

</html>