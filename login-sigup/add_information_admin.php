<?php
// add_information_admin.php - Admin adds information to a user's dashboard

session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.html");
    exit;
}

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST["user_id"];
    $result = $_POST["result"];
    $basic_details = $_POST["basic_details"];

    // Insert the information into the user's dashboard (assuming a table named user_dashboard)
    $sql = "INSERT INTO user_dashboard (user_id, result, basic_details) VALUES ('$user_id', '$result', '$basic_details')";

    if ($conn->query($sql) === TRUE) {
        header("location: admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
