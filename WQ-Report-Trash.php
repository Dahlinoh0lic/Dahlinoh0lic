<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        .box {
            display: flex;
            flex-wrap: wrap;
            margin-top: 50px;
        }

        .box .img-container {
            flex: 1;
        }

        .box .img-container img {
            width: 100%;
            height: auto;
        }

        .box .form-container {
            flex: 1;
            padding: 30px;
            background-color: #f9f9f9;
        }

        .box .form-container h2 {
            margin-top: 0;
        }

        .box .form-container .item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .box .form-container .item img {
            width: 30px;
            height: auto;
            margin-right: 10px;
        }

        .box .form-container input {
            width: 100%;
            padding: 8px;
        }

        .box .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        body {
            background-image: url(pictures/green-background.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }

        .container {
            flex: 1;
        }

        .custom-navbar {
            background-color: #062e06;
            color: #ffffff;
        }

        .custom-navbar .navbar-brand {
            color: #ffffff;
        }

        .custom-navbar .navbar-text {
            color: #ffffff;
        }

        .custom-navbar .nav-link {
            color: #ffffff;
        }

        .custom-navbar .nav-link:hover {
            color: #cccccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            background-color: #f9f9f9;
        }

        th {
            background-color: #f2f2f2;
        }

        .fixed-bottom-footer {
            width: 100%;
            background-color: #45526e;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light custom-navbar">
        <a class="navbar-brand" href="Home.php">
            <img src="pictures/Logo.png" alt="Logo" width="30">
        </a>
        <span style="color: #ffffff">𝒞𝑜𝓂𝓂𝓊𝓃𝒾𝓉𝓎 𝒞𝓁𝑒𝒶𝓃𝓊𝓅 𝒫𝒶𝓇𝓉𝓎</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="color: #ffffff;">Menu</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="Home.php">Home</a>
                        <a class="dropdown-item" href="Contribute.php">Contribute</a>
                        <a class="dropdown-item" href="Rewards.php">Rewards</a>
                        <a class="dropdown-item" href="JobsAvailable.php">Jobs Available</a>
                        <a class="dropdown-item" href="Reporting.php">Report</a>
                        <a class="dropdown-item" href="Login.php">Logout</a>
                    </div>
                </li>
            </ul>
            <a class="navbar-brand" href="Profile.php">
                <img src="admin.png" alt="Profile" width="30" height="30">
            </a>
        </div>
    </nav>
<h1>User sent Report Details</h1>
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ccp";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Approve'])) {
        $jobID = $_POST['jobID'];
        // Update status to approved
        $stmt = $conn->prepare("UPDATE jobs SET Status = 1 WHERE JobID = ?");
        $stmt->bind_param("i", $jobID);
        if ($stmt->execute()) {
            echo "Report approved.";
        } else {
            echo "Error approving report: " . $stmt->error;
        }
        $stmt->close();
    }

    if (isset($_POST['Reject'])) {
        $jobID = $_POST['jobID'];
        // Delete report
        $stmt = $conn->prepare("DELETE FROM jobs WHERE JobID = ?");
        $stmt->bind_param("i", $jobID);
        if ($stmt->execute()) {
            echo "Report rejected and deleted.";
        } else {
            echo "Error rejecting report: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Query and display report details
$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

echo "<table border='1'>
        <tr>
            <th>Job ID</th>
            <th>Location</th>
            <th>Description</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["JobID"] . "</td>";
        echo "<td>" . $row["JobLocation"] . "</td>";
        echo "<td>" . $row["JobDescription"] . "</td>";
        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['JobPhoto']) . "' width='100' /></td>";
        echo "<td>
                <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>
                    <input type='hidden' name='jobID' value='" . $row["JobID"] . "'>
                    <button type='submit' name='Approve'>Approve</button>
                    <button type='submit' name='Reject'>Reject</button>
                </form>
            </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No reports found</td></tr>";
}
echo "</table>";

$conn->close();
?>
</div>
    <div class="fixed-bottom-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Community Cleanup Party</h6>
                    <p>Welcome to CCP, where we are on a mission to create cleaner, greener, and more vibrant
                        communities. Our passion for environmental stewardship drives us to make a positive impact on
                        the world, one clean street at a time.</p>
                </div>
                <div class="col-md-3 ml-auto">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact Us</h6>
                    <p><i class="fas fa-home mr-3"></i>Imaginary Street, Imagi Nation</p>
                    <p><i class="fas fa-envelope mr-3"></i> ccp@gmail.com</p>
                    <p><i class="fas fa-phone mr-3"></i> + 60 12 345 67890</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
