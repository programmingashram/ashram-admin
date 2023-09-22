<?php
// admin.php - Admin panel code

session_start();

if (!isset($_SESSION["admin"])) {
    header("location: login.html");
    exit;
}

// Fetch and display user details for admin
include("db.php");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<h1>Admin Panel</h1>";

// Display a table of users and their details
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["id"] . "</td>";
    echo "<td>" . $row["username"] . "</td>";
    echo "<td>" . $row["email"] . "</td>";
    echo "<td><a href='delete_user.php?id=" . $row["id"] . "'>Delete User</a> | <a href='add_data_admin.php?id=" . $row["id"] . "'>Add Data</a></td>";
    echo "</tr>";
}
echo "</table>";

$conn->close();
?>



