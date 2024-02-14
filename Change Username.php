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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the username from the database based on the UID
$usernameQuery = "SELECT username FROM userdatabase WHERE UID = $UID";
$result = $conn->query($usernameQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username']; // Corrected to lowercase 'username' as per database schema
}
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Username</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        form {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p.success {
            color: green;
            font-weight: bold;
            text-align: center;
        }
        p.error {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Change Username</h1>
        <p>Username: <?php echo $username; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" required>
            <br>
            <input type="submit" value="Change Username">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_username = $_POST["new_username"];

            // Update the username in the database
            $sql = "UPDATE userdatabase SET username=? WHERE UID=$UID";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $new_username);
            if ($stmt->execute()) {
                echo "<p class='success'>Username updated successfully</p>";
            } else {
                echo "<p class='error'>Error updating username: " . $stmt->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>



