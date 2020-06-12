<?php

$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($conn, 'phpmysql');

if (!$db_selected) {
  $sql = 'CREATE DATABASE phpmysql';
  if (mysqli_query($conn, $sql)) {
    $conn = mysqli_connect('localhost', 'root', '', 'phpmysql');
      //echo "Database phpmysql created successfully\n";
      $sql = "CREATE TABLE register (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            phone BIGINT,
            username VARCHAR(20),
            password VARCHAR(16),
            reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            
            if ($conn->query($sql) === TRUE) {
                //echo "Table register created successfully";
            } else {
                //echo "Error creating table: " . $conn->error;
            }
        
  } else {
      echo 'Error creating database: ' . mysql_error() . "\n";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaresWorth</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="contain">

    </div>
    <div class="content">
        Welcome To<br>
        CaresWorth
        <p>We care</p>
        <p><button onclick="window.location.href='signup.php'">Sign Up</button>
        <button onclick="window.location.href='login.php'">Login</button></p>
    </div>
</body>
</html>