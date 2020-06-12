<?php

$conn = mysqli_connect("localhost", "root", "", "phpmysql");

    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }

    session_start();
    
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if(!empty($username) || !empty($password)){

            $sql = "SELECT * From register where username='".$username."' AND password='".$password."' limit 1";
        
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        
            if(mysqli_num_rows($result)==1){
                //Login the user
                
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['reg_date'] = $row['reg_date'];
                
                header("Location: home.php");
                exit();

            } else {
                echo "<script>alert('You have entered incorrect data')</script>";
                header("Location: login.php");
                exit();
            }
        } else {
            $message = "Please fill out all the details!";
            
            echo "<script type='text/javascript'>window.alert('$message');</script>";
            echo "<script type='text/javascript'>window.location.href='login.php';</script>";
            exit();
        }
    
    
    }
    
    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaresWorth - Login</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
    <div class="contain">
    </div>
    <div class="login">
    <div class="caresworth">CaresWorth</div>
        <p>Welcome Back</p>
        <form action="login.php" method="POST">
            <input type="text" name="username" id="username" placeholder="USERNAME">
            <input type="password" name="password" id="password" placeholder="PASSWORD">
            <p id="noaccount">New to CaresWorth? <a href="signup.php">Sign Up here</a></p>
            <input type="submit" name="submit" value="LOGIN">
    </div>
</body>
</html>