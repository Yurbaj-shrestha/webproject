<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $profile = $_POST["profile"];

    // Validate the data (you can add more validation as needed)
    if (empty($name) || empty($phone) || empty($email) || empty($profile)) {
        // Handle validation errors, e.g., redirect to the login page with an error message
        header("Location: login.php?error=Please fill in all fields");
        exit();
    }

    // Here, you can implement authentication logic, like checking the database or other methods.
    // For the sake of this example, we'll just redirect based on the profile type.

    if ($profile === "user") {
        // Redirect to the user's dashboard or a user-specific page
        header("Location: user_dashboard.php");
    } elseif ($profile === "owner") {
        // Redirect to the owner's dashboard or an owner-specific page
        header("Location: owner_dashboard.php");
    } else {
        // Handle unknown profile types
        header("Location: login.php?error=Invalid profile type");
    }
} else {
    // Redirect to the login page if the form wasn't submitted via POST
    header("Location: login.php");
}
?>
