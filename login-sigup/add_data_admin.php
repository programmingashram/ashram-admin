<?php
// add_data_admin.php - Admin adds data to a user's dashboard

session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.html");
    exit;
}

include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user_id"]) && isset($_POST["data_text"])) {
        $user_id = $_POST["user_id"];
        $data_text = $_POST["data_text"];

        // Insert the data into the user's dashboard
        $sql = "INSERT INTO user_data (user_id, data_text) VALUES ('$user_id', '
        ')";

        if ($conn->query($sql) === TRUE) {
            header("location: admin.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<h2>Add Information to User Dashboard</h2>
<form action="add_information_admin.php" method="POST">
    <label for="user_id">Select User:</label>
    <select name="user_id" required>
        <!-- Populate the dropdown with user options from your database -->
        <option value="user_id_1">User 1</option>
        <option value="user_id_2">User 2</option>
        <option value="user_id_3">User 2</option>
        <!-- Add more user options dynamically from the database -->
    </select><br>

    <label for="result">Result:</label>
    <input type="text" name="result" required><br>

    <label for="basic_details">Basic Details:</label>
    <input type="text" name="basic_details" required><br>

    <input type="submit" value="Add Information">
</form>