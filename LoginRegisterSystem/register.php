<?php

$hostname = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "phpmysql";

$conn = mysqli_connect("localhost", "root", "", "phpmysql");

    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }

session_start();

if(isset($_POST['firstname'])){
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
}
if(isset($_POST['lastname'])){
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
}
if(isset($_POST['email'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
}
if(isset($_POST['phone'])){
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
}
if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
}
if(isset($_POST['password'])){
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}

//Error Handlers

if(!empty($firstname) || !empty($email) || !empty($phone) || !empty($lastname) || !empty($username) || !empty($password)){
                $SELECT = "SELECT email From register Where email = ? Limit 1";
                $INSERT = "INSERT Into register (firstname, lastname, email, phone, username, password) VALUES(?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($SELECT);
                $stmt->bind_param("s",$email);
                $stmt->execute();
                $stmt->bind_result($email);
                $stmt->store_result();
                $rnum = $stmt->num_rows;

                if($rnum==0){
                    $stmt->close();
                    $SELECT1 = "SELECT username From register Where username = ? Limit 1";
                    $INSERT = "INSERT Into register (firstname, lastname, email, phone, username, password) VALUES(?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($SELECT1);
                    $stmt->bind_param("s",$username);
                    $stmt->execute();
                    $stmt->bind_result($phone);
                    $stmt->store_result();
                    $rnum2 = $stmt->num_rows;

                    if($rnum2==0){
                        $stmt->close();
                    
                    $stmt = $conn->prepare($INSERT);
                    $stmt->bind_param("sssiss", $firstname, $lastname, $email, $phone, $username, $password);
                    $stmt->execute();
                    $stmt->close();
                    $sql = "SELECT * From register where email='".$email."' AND phone='".$phone."' limit 1";

                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['reg_date'] = $row['reg_date'];
                    $message = "Account created successfully!";
    
                        echo "<script type='text/javascript'>window.alert('$message');</script>";
                        echo "<script type='text/javascript'>window.location.href='home.php';</script>";
                        exit();
                    } else {
                        $message = "Username exists!";
    
                        echo "<script type='text/javascript'>window.alert('$message');</script>";
                        echo "<script type='text/javascript'>window.location.href='signup.php';</script>";
                    }
        } else{
            $message = "Email already exists!";
    
                        echo "<script type='text/javascript'>window.alert('$message');</script>";
                        echo "<script type='text/javascript'>window.location.href='signup.php';</script>";
        }
} else {
    $message = "Please fill out all the details!";
    
    echo "<script type='text/javascript'>window.alert('$message');</script>";
    echo "<script type='text/javascript'>window.location.href='signup.php';</script>";
    exit();
}
?>