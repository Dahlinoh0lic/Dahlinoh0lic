<?php
    session_start(); // Start session

    // Check if UID is set in the session (retrieved from login.php)
    if (isset($_SESSION['UID'])) {
        $UID = $_SESSION['UID']; // Retrieve UID
    } else {
        echo "User UID not set in session."; // Echo this if UID is not set
    }

    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ccp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Fetch the username from the database based on the UID
    $usernameQuery = "SELECT username FROM userdatabase WHERE UID = '$UID'";
    $result = $conn->query($usernameQuery);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username']; // Corrected to lowercase 'username' as per database schema

    // Fetch additional user information
    $userInfoQuery = "SELECT email, PhoneNumber, address, points FROM userdatabase WHERE UID = '$UID'";
    $userInfoResult = $conn->query($userInfoQuery);
    if ($userInfoResult->num_rows > 0) {
        $userInfoRow = $userInfoResult->fetch_assoc();
        $email = $userInfoRow['email'];
        $phone_number = $userInfoRow['PhoneNumber'];
        $address = $userInfoRow['address'];
        $points = $userInfoRow['points'];
    } else {
        // Handle if user information is not found
        echo "User information not found";
    }
} else {
    // Handle if username is not found
    echo "Username not found";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
    }

    .container {
      max-width: 400px;
      margin: 20px auto;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-evenly;
      padding: 20px;
      background-color: #aaaaaa;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .pfp {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 20px;
    }

    .Pbar {
      width: 100%;
      height: 40px;
      background-color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 5px;
      margin-bottom: 20px;
    }

    .Ptext {
      color: rgb(255, 255, 255);
      font-size: 1.2em;
    }

    .buttone{
            margin-right: auto;
            display: inline-block;
        }

    .bar {
      width: 300px;
      height: 40px;
      background-color: #3498db;
      margin: 10px 0;
      transition: background-color 0.3s ease;
      border-radius: 15px;
      line-height: 40px;
      font-size: 1.2em;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      cursor: pointer;
    }

    .bar:hover {
      background-color: #2980b9;
    }

    .bar:active {
      background-color: #1f618d;
    }
  </style>
  <title>Profile</title>
</head>

<body>
  <div class="container">
    <div class="buttone">
      <a href="BL - Home..html" onclick="history.back()"><img src="back button 3.png" alt="Back" width="30"></a>
      <a href="BL - Home..html" onclick="history.back()"><img src="home button 3.png" alt="Home" width="30"></a>
    </div>
    <img class="pfp" src="PFPPH.jpg" alt="PFP HERE">
    <div class="Pbar">
      <div class="Ptext">User Profile</div>
    </div>
    <p>Username: <?php echo $username; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Phone Number: <?php echo $phone_number; ?></p>
    <p>Address: <?php echo $address; ?></p>
    <p>Points: <?php echo $points; ?></p>
    <a href="assignment settings.php" class="bar" id="bar5">Settings</a>
    <a href="assignment login.php" class="bar" id="bar6">Logout</a>

    
   
  </div>
</body>

</html>

