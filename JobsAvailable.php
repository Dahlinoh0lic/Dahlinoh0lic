<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Available</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-image: url(pictures/green-background.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
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
            position: static;
            bottom: 0;
        }
    </style>
</head>

<body>
    <?php session_start(); // Start the session                 ?>
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
                <img src="pictures/user.png" alt="Profile" width="30" height="30">
            </a>
        </div>
    </nav>
    <h1>Jobs Available</h1>

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

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        $jobId = $_POST["jobId"];

        // Check if a photo is selected
        if ($_FILES["submittedPhoto"]["error"] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["submittedPhoto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow certain file formats
            $allowedFormats = ["jpg", "jpeg", "png", "gif"];
            if (!in_array($imageFileType, $allowedFormats)) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["submittedPhoto"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Upload file
            if ($uploadOk == 1) {
                if (move_uploaded_file($_FILES["submittedPhoto"]["tmp_name"], $target_file)) {
                    // Read the uploaded image as binary data
                    $imageData = file_get_contents($target_file);

                    // Check if user is logged in and UID is set in the session
                    if (isset($_SESSION['UID'])) {
                        $userUID = $_SESSION['UID'];

                        // Update job status and submitted photo in the database
                        $sql = "UPDATE jobs SET SubmittedPhoto=?, Status=2, UID=? WHERE JobID=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("sii", $imageData, $userUID, $jobId);

                        if ($stmt->execute()) {
                            // Check if the query executed successfully
                            if ($stmt->affected_rows > 0) {
                                echo "Photo submitted successfully!";
                            } else {
                                echo "Failed to submit photo. Please try again.";
                            }
                        } else {
                            echo "Error executing query: " . $stmt->error;
                        }

                        $stmt->close();
                    } else {
                        // Redirect or handle the case where the user is not logged in
                        echo "User not logged in";
                    }

                    // Remove the uploaded file after processing
                    unlink($target_file);
                } else {
                    echo "Sorry, there was an error uploading your file. Error Code: " . $_FILES["submittedPhoto"]["error"];
                }
            }
        } else {
            echo "Please select a photo.";
        }
    }

    // Query database for available jobs where status is '1' (available)
    $sql = "SELECT JobID, JobPhoto, JobLocation, JobDescription, JobName, Points, Status FROM jobs WHERE Status = '1'";
    $result = $conn->query($sql);

    // Display jobs in table format
    echo "<table border='1'>
<tr>
    <th>JobID</th>
    <th>JobPhoto</th>
    <th>JobLocation</th>
    <th>JobDescription</th>
    <th>JobName</th>
    <th>Points</th>
    <th>Submit Photo</th>
</tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Add a unique identifier for each form
            $formId = 'form_' . $row["JobID"];

            echo "<tr>";
            // Display JobID
            echo "<td>" . $row["JobID"] . "</td>";

            // Check if JobPhoto contains binary data
            if (!empty($row['JobPhoto'])) {
                $imageData = $row['JobPhoto'];

                // Display the image if it's binary data
                echo "<td><img src='data:image/jpeg;base64," . base64_encode($imageData) . "' alt='Job Photo' width='100'></td>";
            } else {
                // If JobPhoto is empty
                echo "<td>No Photo</td>";
            }

            // Display other columns...
            echo "<td>" . $row["JobLocation"] . "</td>";
            echo "<td>" . $row["JobDescription"] . "</td>";
            echo "<td>" . $row["JobName"] . "</td>";
            echo "<td>" . $row["Points"] . "</td>";

            // Display the file input for submitting a photo within its own form
            echo "<td>";
            echo "<form method='post' enctype='multipart/form-data' id='$formId'>";
            echo "<input type='file' name='submittedPhoto'>";
            echo "<input type='hidden' name='jobId' value='" . $row["JobID"] . "'>";
            echo "<input type='submit' name='submit' value='Submit'>";
            echo "</form>";
            echo "</td>";

            echo "</tr>";
        }
    }

    echo "</table>";

    // Close the database connection
    $conn->close();
    ?>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
