<?php

$hostname = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "webevent";

$conn = mysqli_connect("localhost", "root", "", "webevent");

    if (!$conn) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit();
    }

session_start();

if(isset($_POST['stname'])){
    $stname = mysqli_real_escape_string($conn, $_POST['stname']);
}
if(isset($_POST['stid'])){
    $stid = mysqli_real_escape_string($conn, $_POST['stid']);
}

//Error Handlers

if(!empty($stname) || !empty($stid)){
            $SELECT = "SELECT stname From register Where stname = ? Limit 1";
            $INSERT = "INSERT Into register (stname, stid) VALUES(?, ?)";
            $stmt = $conn->prepare($SELECT);
            $stmt->bind_param("s",$stname);
            $stmt->execute();
            $stmt->bind_result($stname);
            $stmt->store_result();
            $rnum = $stmt->num_rows;

            if($rnum==0){
                $stmt->close();
                $SELECT1 = "SELECT stid From register Where stid = ? Limit 1";
                $INSERT = "INSERT Into register (stname, stid) VALUES(?, ?)";
                $stmt = $conn->prepare($SELECT1);
                $stmt->bind_param("s",$stid);
                $stmt->execute();
                $stmt->bind_result($stid);
                $stmt->store_result();
                $rnum2 = $stmt->num_rows;

                if($rnum2==0){
                    $stmt->close();
                
                $stmt = $conn->prepare($INSERT);
                $stmt->bind_param("ss", $stname, $stid);
                $stmt->execute();
                $stmt->close();
                $sql = "SELECT * From register where stname='".$stname."' AND stid='".$stid."' limit 1";

                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);

                $_SESSION['stname'] = $row['stname'];
                $_SESSION['stid'] = $row['stid'];
                $message = "Registration Successful!";

                    echo "<script type='text/javascript'>window.alert('$message');</script>";
                    echo "<script type='text/javascript'>window.location.href='index.php';</script>";
                    exit();
                } else {
                    $message = "Student ID already registered!";

                    echo "<script type='text/javascript'>window.alert('$message');</script>";
                    echo "<script type='text/javascript'>window.location.href='index.php';</script>";
                }
    } else{
        $message = "Student Name already registered!";

                    echo "<script type='text/javascript'>window.alert('$message');</script>";
                    echo "<script type='text/javascript'>window.location.href='index.php';</script>";
    }
} else {
$message = "Please fill out all the details!";

echo "<script type='text/javascript'>window.alert('$message');</script>";
echo "<script type='text/javascript'>window.location.href='index.php';</script>";
exit();
}
?>