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

// Fetch the email from the database based on the UID
$emailQuery = "SELECT email FROM userdatabase WHERE UID = $UID";
$result = $conn->query($emailQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email']; // Corrected to lowercase 'email' as per database schema
}
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Email</title>
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
            text-align: center; /* Center align content */
        }
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
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
            margin: 0 auto; /* Center align button */
            display: block; /* Make the button a block element */
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        p.success {
            color: green;
            font-weight: bold;
        }
        p.error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Change Email</h1>
        <p>Email: <?php echo $email; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="new_email">New Email:</label>
            <input type="text" id="new_email" name="new_email" required>
            <input type="submit" value="Change Email" style="margin: 0 auto; display: block;">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_email = $_POST["new_email"];

            // Update the email in the database
            $sql = "UPDATE userdatabase SET email=? WHERE UID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_email, $UID);
            if ($stmt->execute()) {
                echo "<p class='success'>Email updated successfully</p>";
            } else {
                echo "<p class='error'>Error updating email: " . $stmt->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>

