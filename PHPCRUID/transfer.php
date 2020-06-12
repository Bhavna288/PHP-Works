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

if (isset($_GET["action"])){
    if ($_GET["action"] == "delete"){
        $id = $_GET['id'];
        $delete = "DELETE FROM `register` WHERE `register`.`id` = '".$id."'";
            if(mysqli_query($conn, $delete)){
                echo '<script>alert("Registration canceled!")</script>';
            }
            echo '<script>window.location="index.php"</script>';
    }

    if ($_GET["action"] == "update"){
        $id = $_GET['id'];
        $uname = $_POST['updatedName'];
        $uid = $_POST['updatedId'];

        $update = "UPDATE `register` SET `register`.`stname`='".$uname."', `register`.`stid`='".$uid."' WHERE `register`.`id` = '".$id."'";
        if(mysqli_query($conn, $update)){
            echo '<script>alert("Updated Successfully!")</script>';
        }
        echo '<script>window.location="index.php"</script>';
    }
}

?>