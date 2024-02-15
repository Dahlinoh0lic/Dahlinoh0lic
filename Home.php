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
      background-color: #fff;
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
      color: white;
      font-size: 1.2em;
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
    .bare {
      width: 150px;
      height: 40px;
      background-color: #001aff;
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
  <title>Home</title>
</head>

<body>
  <div class="container">
    <a href='Profile.php'><img class="pfp" src="pictures/user.png" alt="PFP HERE"></a>
    <div class="bare" id="bar1">STATUS HERE</div>
    <div class="bare" id="bar2">Current Points</div>
    <div class="Pbar">
      <div class="Ptext">Ongoing Jobs: None</div>
    </div>
    <div class="bar" id="bar3"><a href='Contribute.php'>Contribute</a></div>
    <div class="bar" id="bar4"> <a href='JobsAvailable.php'>Jobs Available</a> </div>
    <div class="bar" id="bar5"> <a href='Reporting.php'>Reporting</a> </div>
    <div class="bar" id="bar6">Rewards</div>
    <div class="bar" id="bar7">About Us</div>
  </div>
</body>

</html>
