<?php

$conn = mysqli_connect("localhost", "root", "", "phpmysql");

    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaresWorth - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="contain">
    </div>
    <div class="signup">
    <div class="caresworth">CaresWorth</div>

        <p>Sign Up</p>
        <form action="register.php" method="POST">
            <input type="text" name="firstname" id="firstname" placeholder="FIRSTNAME">
            <input type="text" name="lastname" id="lastname" placeholder="LASTNAME">
            <input type="email" name="email" id="email" placeholder="EMAIL">
            <input type="tel" name="phone" id="phone" placeholder="PHONE NUMBER">
            <input type="text" name="username" id="username" placeholder="CREATE USERNAME">
            <input type="password" name="password" id="password" placeholder="CREATE PASSWORD">
            <p id="already">Already a user? <a href="login.php">Login here</a></p>
            <input type="submit" name="submit" value="SIGN UP"></p>
    </div>
</body>
</html>