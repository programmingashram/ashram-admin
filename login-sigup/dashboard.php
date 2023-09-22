<?php
// dashboard.php - User dashboard

session_start();

if (!isset($_SESSION["username"])) {
    header("location: login.html");
    exit;
}

include("db.php");

$username = $_SESSION["username"];
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $userFullName = $row["username"];
    $userEmail = $row["email"];
} else {
    $userFullName = "User Not Found";
    $userEmail = "N/A";
}

// Fetch user-specific information from the user_dashboard table
$user_id = $row["id"]; // Assuming 'id' is the user's ID from the users table

$sql = "SELECT * FROM user_dashboard WHERE user_id='$user_id'";
$result = $conn->query($sql);

$additionalData = array();
if ($result->num_rows > 0) {
    while ($additionalRow = $result->fetch_assoc()) {
        $additionalData[] = array(
            "result" => $additionalRow["result"],
            "basic_details" => $additionalRow["basic_details"]
            // Add more fields as needed
        );
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Add your custom CSS for styling here (if needed) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container justify-content-bteween">
    <a class="navbar-brand" href="#">
      <img src="./images/www.programmingashram.in-removebg-preview.png" alt="" width="40" height="40" class="object-fit-cover d-inline-block ">
      PA - Management 
    </a>
    <a href="login.html" class="btn btn-outline-success">Logout</a>
  </div>
</nav>
<div class="container mt-4">
    <div class="row align-items-center">
        <div class="col-md-4">
           <div class="card shadow-sm  mb-2 me-2 border border-success">
            <div class="card-body">
                <div class="user-img">
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="./images/72-729716_user-avatar-png-graphic-free-download-icon-removebg-preview.png" alt="" class="w-25 outline ">
                        <span class="badge bg-success">New Student</span>
                    </div>
                </div>
                    <br>
                    <h4 class="">Welcome, <?php echo $userFullName; ?>! 😎</h4>
                    <p><i class="fa-solid fa-envelope"></i> <?php echo $userEmail; ?></p>
                    <p><i class="fa-solid fa-phone"></i> (+91)-8224973413</p>
                </div>
                </div>
            </div>
        <div class="col-md-8">
            <div class="user_data">
                <?php if (!empty($additionalData)) { ?>
                <h4>Your Additional Data:</h4>
                <div class="mt-3">
                    <div class="d-flex flex-wrap align-items-center">
                    <?php foreach ($additionalData as $data) { ?>
                        <div class="card shadow-sm border-0 mb-2 me-2 bg-success-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">Course Name</h5>
                                <p class="card-text"><?php echo $data["result"]; ?></p>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2  bg-primary-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">Course Duration</h5>
                                <p class="card-text"><?php echo $data["basic_details"]; ?></p>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2  bg-warning-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">IT Experience</h5>
                                <p class="card-text"><?php echo $data["basic_details"]; ?></p>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2  bg-danger-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">IT Experience</h5>
                                <p class="card-text"><?php echo $data["basic_details"]; ?></p>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2 bg-info-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">IT Experience</h5>
                                <p class="card-text"><?php echo $data["basic_details"]; ?></p>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2 bg-primary-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">Apply For a Reliving</h5>
                                <p class="card-text">Apply when you are in <br> interview phase.</p>
                                <a href="#" class="nav-link ps-0 text-primary" download>Apply Now</a>
                            </div>
                        </div>
                        <div class="card shadow-sm border-0 shadow mb-2 me-2 bg-secondary-subtle">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2 text-secondary h6">Download certificate</h5>
                                <p class="card-text">Certificate will be add when your <br> course duration is ended.</p>
                                <a href="#" class="nav-link ps-0 text-primary" download>Download Now</a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            <?php } else { ?>
                <p>No additional data found.</p>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
