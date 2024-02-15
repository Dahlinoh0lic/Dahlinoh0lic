<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        }
    </style>

</head>

<body>
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="logo-container text-center">
                    <img src="pictures/Logo.png" alt="Logo" width="200px" height="auto">
                </div>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="Username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Password"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="link">No Account? Click <a href="Register.php">Here</a> to register.</div>
                </form>
                <?php
                session_start(); // Start the session
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ccp";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    $stmt = $conn->prepare("SELECT * FROM userdatabase WHERE username=? AND password=?");
                    $stmt->bind_param("ss", $username, $password);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION["UID"] = $row["UID"];

                        // Check if the user is an admin (assuming UID 1 corresponds to the admin)
                        if ($_SESSION["UID"] == 1) {
                            header("Location: AdminHome.php?UID=" . $_SESSION["UID"]);
                        } else {
                            header("Location: Home.php?UID=" . $_SESSION["UID"]);
                        }
                    } else {
                        echo "Username or password do not match.";
                    }

                    $stmt->close();
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>
