<?php
// admin_login.php - Admin login authentication

session_start();

// Check if the admin is already logged in
if (isset($_SESSION["admin"])) {
    header("location: admin.php"); // Redirect to the admin panel if already logged in
    exit;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get admin username and password from the form
    $admin_username = $_POST["admin_username"];
    $admin_password = $_POST["admin_password"];

    // Replace with actual admin credentials from your database
    $stored_admin_username = "admin"; // Replace with your admin username
    $stored_admin_password_hash = password_hash("123", PASSWORD_DEFAULT); // Replace with your admin password hash

    // Verify admin credentials
    if ($admin_username === "$stored_admin_username" && password_verify($admin_password, $stored_admin_password_hash)) {
        // Admin authentication successful, set a session variable
        $_SESSION["admin"] = $admin_username;
        header("location: admin.php"); // Redirect to the admin panel
        exit;
    } else {
        // Invalid admin credentials, display an error message
        echo "Invalid admin credentials. Please try again.";
    }
}
?>
