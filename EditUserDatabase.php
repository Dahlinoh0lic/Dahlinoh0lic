<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page for Admin Users ONLY</title>
</head>
<body>
    <h1>Edit Page for Admin Users ONLY</h1>

    <?php
        include 'dbConn2.php';
        $UID = $_GET['userid'];

        $query = "SELECT * FROM userdatabase WHERE UID = $UID";

        $results = mysqli_query($connection, $query);

        // Check if record exists
        if(mysqli_num_rows($results) == 1){
            $row = mysqli_fetch_assoc($results);
    ?>
            <form action="" method="post">
                UID: <?php echo $UID; ?> <br>
                Username: <input type="text" name="txtUsername" value="<?php echo $row['Username']; ?>"> <br>
                Email: <input type="text" name="txtEmail" value="<?php echo $row['Email']; ?>"> <br>
                Password: <input type="text" name="txtPassword" value="<?php echo $row['Password']; ?>"> <br>
                Phone Number: <input type="text" name="txtPhoneNumber" value="<?php echo $row['PhoneNumber']; ?>"> <br>
                Address: <input type="text" name="txtAddress" value="<?php echo $row['Address']; ?>"> <br>
                Points: <input type="text" name="txtPoints" value="<?php echo $row['Points']; ?>"> <br>
                <input type="submit" value="Update" name="btnUpdate">
            </form>

    
    
    
    
    
    <?php
        }

        // Check if the user clicked the update button
        if(isset($_POST['btnUpdate'])){
            $Username = $_POST['txtUsername'];
            $Email = $_POST['txtEmail'];
            $Password = $_POST['txtPassword'];
            $PhoneNumber = $_POST['txtPhoneNumber'];
            $Address = $_POST['txtAddress'];
            $Points = $_POST['txtPoints'];

            $updateQuery = "UPDATE userdatabase SET Username = '$Username', Email = '$Email',
                            Password = '$Password', PhoneNumber = '$PhoneNumber', Address = '$Address', Points = '$Points' WHERE UID='$UID'"; 
            if (mysqli_query($connection, $updateQuery)){
                echo "Record updated successfully!";
            }else{
                echo "Error: ". mysqli_error($connection);
            }
        }

        mysqli_close($connection);
    ?>
    
    <br><br><a href="testinguserDatabase.php">HOME</a>
</body>
</html>
