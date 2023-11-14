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
    <link rel="stylesheet" href='signuppage.css'>

</head>

<body>
    <div class="wrapper">
        <?php
        if (isset($_POST["submit"]))
        {
            $username= $_POST["username"];
            $email=$_POST["email"];
            $phone_number= $_POST["phonenumber"];
            $password= $_POST["password"];
            $confirmpassword= $_POST["cpassword"];
            $profile_type= $_POST["profileType"];
            $errors=array();
            if ((empty($username)or empty($phone_number)or empty($password) or empty($confirmpassword)or empty($profile_type)))
            {
                array_push($errors,"All fields are required");
            }
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            {
                array_push($errors,"Email is not valid");
            }
            if(strlen($password)<8)
            {
                array_push($errors,"password must be at least 8 charates long");
            }
            if($password!==$confirmpassword)
            {
                array_push($errors,"password doesn't match");
            }
            require_once "database/dbconnect.php";
            $sql="SELECT *FROM users WHERE email ='$email'";
            $result= mysqli_query($conn,$sql);
            $rowcount = mysqli_num_rows($result);
            if($rowcount>0)
            {
                array_push($errors,"Email already exits!");

            }

            if(count($errors)>0)
            {
                foreach($errors as $error)
                {
                    echo"<div class='alert alert-danger'>$error</div>";
                }
            }
            else
            {
                
                $sql="INSERT INTO users (`username`, `email`, `phone_number`, `password`, `profile_type`) VALUES ( ?, ?, ?, ?, ?)";
                $stmt=mysqli_stmt_init($conn);
                 $prepare=mysqli_stmt_prepare($stmt,$sql);
                 if($prepare)
                 {
                     mysqli_stmt_bind_param($stmt,"ssdss",$username,$email,$phone_number,$password,$profile_type);
                     mysqli_stmt_execute($stmt);
                     echo "<div class='alert alert-success'>You are registerd successfully.</div>";
                 }
                 else
            {
                die("something went wrong");

            }
            }
            
        }
        ?>
        <form action="Register.php" method="post">
            <h1>SignUp</h1>
                   <div class="back">
     <a href="login.php">
        <i class='bx bx-left-arrow-alt'></i>
    </a>
   </div>
            <div class="input-box">
                <input type="text" placeholder="Username" name="username" >
                <i class='bx bxs-user'></i>
            </div>
                        <div class="input-box">
                <input type="email" placeholder="Email" name="email" >
                <i class='bx bxs-envelope'></i>
            </div>
            <div class="input-box">
                <input type="integer" placeholder="contact number" name="phonenumber" >
                <i class='bx bxs-contact' ></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="password" id="password" name="password" >
                <i class='bx bx-lock'></i>
            </div>
            <div class="input-box">
                <input type="password" placeholder="confirm password"  id="password" name="cpassword" >
                <div class="profile">
                    <label for="profileType">Select Profile Type:</label>
                    <select id="profileType" name="profileType" required>
                        <option value="user">User</option>
                        <option value="business">Business</option>
                    </select>
                </div>
            <button type="submit" class="btn_signup" name ="submit" value="submit">
                Signup
            </button>
        </form>
</body>

</html>