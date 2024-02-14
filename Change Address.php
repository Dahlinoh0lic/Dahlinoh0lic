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
$addressQuery = "SELECT address FROM userdatabase WHERE UID = $UID";
$result = $conn->query($addressQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $address = $row['address']; // Corrected to lowercase 'address' as per database schema
}
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Address</title>
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
        <h1>Change Address</h1>
        <p>Address: <?php echo $address; ?></p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="new_address">New Address:</label>
            <input type="text" id="new_address" name="new_address" required>
            <br>
            <input type="submit" value="Change Address">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_address = $_POST["new_address"];

            // Update the address in the database
            $sql = "UPDATE userdatabase SET address=? WHERE UID=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $new_address, $UID);
            if ($stmt->execute()) {
                echo "<p class='success'>Address updated successfully</p>";
            } else {
                echo "<p class='error'>Error updating address: " . $stmt->error . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>

