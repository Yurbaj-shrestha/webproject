<?php

session_start();
if(!isset($_SESSION["user"]))
{
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>User dashboard</title>
</head>
<body>
    <div class="container">
        <h1>
             welcome to dashboard
        </h1>
        <a href="logout.php" class='btn btn-warning'>logout</a>

    </div>
   
</body>
</html>