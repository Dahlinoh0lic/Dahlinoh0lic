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
      padding: 50px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .pfp {
        width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 50px;
            margin: 20%;
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
      color: white;
      font-size: 1.2em;
    }

    .bar {
      width: 350px;
      height: 50px;
      background-color: #3498db;
      margin: 10px 0;
      transition: background-color 0.3s ease;
      border-radius: 35px;
      line-height: 40px;
      font-size: 1.2em;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      cursor: pointer;
      background-color: black;
      text-decoration: none;
    }

    .bar:hover {
      background-color: black;
    }

    .bar:active {
      background-color: black;
    }
    .button img {
            border-radius: 50%;
            cursor: pointer;
            display: inline-block;
            text-align: left;
        }

        .button {
            margin-right: auto;
            display: inline-block;
        }
        h1{
            margin: -10%;
        }
  </style>
  <title>Home</title>
</head>

<body>
  <div class="container">
    <div class="button">
        <img src="back button 3.png" alt="Back" width="30" onclick="history.back()">
        <img src="home button 3.png" alt="Home" width="30" onclick="history.back()">
    </div>
    <h1>User Profile</h1>
    <img class="pfp" src="PFPPH.jpg" alt="PFP HERE">

    <a href="Change Username.php" class="bar" id="bar1">Change Username</a>
    <a href="Change Email.php" class="bar" id="bar2">Change Email</a>
    <a href="Change Phone Number.php" class="bar" id="bar3">Change Phone Number</a>
    <a href="Change Address.php" class="bar" id="bar4">Change Address</a>
    <a href="Change Password.php" class="bar" id="bar5">Change Password</a>
  </div>
</body>

</html>
