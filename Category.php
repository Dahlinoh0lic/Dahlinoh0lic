<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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

        h1 {
            margin: -10% auto 0;
            padding-bottom: 20px;
            text-align: center;
        }
        .pfp {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            display: block;
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
            width: 100%;
            height: 50px;
            background-color: #3498db;
            margin: 10px 0;
            transition: background-color 0.3s ease;
            border-radius: 35px;
            line-height: 50px;
            font-size: 1.2em;
            text-align: center;
            color: #fff;
            cursor: pointer;
            position: relative;
        }

        .bar:hover {
            background-color: #2980b9;
        }

        .bar:active {
            background-color: #1f618d;
        }

        .bar img {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            display: block;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 10px;
        }
        .bar {
            background-color: #f1f1f1;
            padding: 10px;
            text-align: center;
            font-size: 20px;
            color: black;
        }
        .pfp {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-top: 10px;

        }
        .box {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 5px;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="button">
            <a href="BL - Home.html">
                <img src="back button 3.png" alt="Back" width="30">
            </a>
            <a href="BL - Home.html">
                <img src="home button 3.png" alt="Home" width="30">
            </a>
        </div>
        <img class="pfp" src="ZIMGPFPPH.jpg" alt="PFP HERE"><br>
        <h1>Rewards</h1>

        
        <a href="Display Reward.php">
            <div class="box">
                <div class="bar">Voucher</div>
                <img src="ZIMGV.png" alt="Voucher" width="100">
            </div>
        </a>
        <a href="PHDisplayReward2.php">
            <div class="box">
                <div class="bar">Clothing</div>
                <img src="ZIMGSHIRT.png" alt="Clothing" width="100">
            </div>
        </a>
        <a href="PHDisplayReward3.php">
            <div class="box">
                <div class="bar">Food</div>
                <img src="ZIMGLays.png" alt="Food" width="100">
            </div>
        </a>
        <a href="PHDisplayReward4.php">
            <div class="box">
                <div class="bar">Other</div>
                <img src="ZIMGKeychain.png" alt="Other" width="100">
            </div>
        </a>
    </div>
</body>
</html>
