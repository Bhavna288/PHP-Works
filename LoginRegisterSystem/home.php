<?php

$conn = mysqli_connect('localhost', 'root', '', 'phpmysql');
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

session_start();

if(!isset($_SESSION['username'])){
    header("Location: index.php");
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaresWorth - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="main.js"></script>
</head>
<body>
    <div class="contain">
    </div>
    <div class="home">
    <div class="caresworth">CaresWorth</div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#about">About Us</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#contact">Contact</a>
            </li>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Account</a>
            <div class="dropdown-menu">
                <p class="dropP"><?php echo $_SESSION['username']; ?></p>
                <a class="dropdown-item" data-toggle="tab" href="#profile">View profile</a>
                <form action="home.php" method="POST"><input class="dropdown-item" type="submit" name="logout" value="Logout"></form></div>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="about" role="tabpanel" aria-labelledby="about-tab">
                <p>
                    A shocking 17.7 million children in India are out of school. Working in hazardous conditions, living on the street, braving hunger, poverty and violence, childhood for them has become an endless struggle to survive.
                </p>
                <p>
                    But despite their circumstances, they have not stopped dreaming. Their dreams are as colourful as any other child’s and they have just as much potential to fulfil them. What they lack is a fair chance – an opportunity to go school, to hone their talents, to even have a happy and carefree childhood that every child deserves.
                </p>
                <p>
                    Strongly aligned with the ‘Right to Education Act’ or the ‘Samagra Siksha’, CaresWorth is committed to the Government’s vision to improve access to primary education for children, especially young girls.
                </p>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                Email us<p>caresworth@gmail.com</p>
                Call us<p>123-456-789-0</p>
                Follow us on<p>Facebook | Instagram | Twitter</p>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table table-dark">
                        <tr>
                            <td>Username</td>
                            <td> <?php echo $_SESSION['username']; ?></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td> <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> <?php echo $_SESSION['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone number</td>
                            <td> <?php echo $_SESSION['phone']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</body>
</html>