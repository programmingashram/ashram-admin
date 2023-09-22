<?php
// delete_user.php - Admin deletes a specific user

session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.html");
    exit;
}

include("db.php");

if (isset($_GET["id"])) {
    $user_id = $_GET["id"];

    // Delete the specific user and related data from the database
    $sql = "DELETE FROM users WHERE id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        // You can also delete related data from other tables here
        header("location: admin.php");
        exit; // Exit to prevent further execution
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
