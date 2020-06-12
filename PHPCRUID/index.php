<?php

$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

$db_selected = mysqli_select_db($conn, 'webevent');

if (!$db_selected) {

  $sql = 'CREATE DATABASE webevent';
  if (mysqli_query($conn, $sql)) {
    $conn = mysqli_connect('localhost', 'root', '', 'webevent');
      //echo "Database workshop created successfully\n";
      $sql = "CREATE TABLE register (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            stname VARCHAR(30) NOT NULL,
            stid VARCHAR(10) NOT NULL,
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
    <title>CRUID</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">

    <script>

      $('document').ready(function(){
        $('.heading').fadeIn(500);
        $('.contain').fadeIn(500);
      });

      function edit(i){
        var h = "#data" + (i);
        $(h).hide();
        var s = "#update" + (i) ;
        $(s).show();
      }
    </script>

</head>
<body>
    <div class="heading">
        <img src="cspit.jpg"><br>
        Web Designing
        <p>CSPIT, CHARUSAT, Changa</p>
    </div>
    <div class="contain">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#new">NEW</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#list">REGISTERED</a>
            </li>
          </ul>
        
          <!-- Tab panes -->
          <div class="tab-content">
            <div id="new" class="container tab-pane active"><br>
            <h3>Enter Details</h3>
              <form id="myform" action="register.php" method="POST">
                  <span><input type="text" name="stname" id="stname" placeholder="Student Name"></span>
                  <span><input type="text" name="stid" id="stid" placeholder="Student ID"></span>
                  <span><input type="submit" value="Register" name="register" id="register"></span>
              </form>
            </div>
            <div id="list" class="container tab-pane fade"><br>
              <h3>Registrations</h3>
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="thead-dark">
                  <tr>
                    <th>Entry No. </th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Registration Time</th>
                    <th>Update</th>
                    <th>Delete</th>
                  </tr>
                  </thead>

                  <?php

                  $SELECT = "SELECT `id`, `stname`, `stid`, `reg_date` FROM `register` ORDER BY id ASC";
                  $result = mysqli_query($conn, $SELECT);

                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){        
                  ?>
                    <tr id="data<?php echo $row['id']; ?>">
                      <td><?php echo $row['id']; ?></td>
                      <td class="sti"><?php echo $row['stid']; ?></td>
                      <td class="stn"><?php echo $row['stname']; ?></td>                      
                      <td><?php echo $row['reg_date']; ?></td>
                      <td><button onclick="edit(<?php echo $row['id']; ?>)" class="btn btn-primary">Edit</button></td>
                      <td><a href="transfer.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <form action="transfer.php?action=update&id=<?php echo $row['id']; ?>" method="POST">
                    <tr id="update<?php echo $row['id']; ?>" style="display: none">
                    <td><?php echo $row['id']; ?></td>
                      <td><input type="text" name="updatedId" value="<?php echo $row['stid']; ?>"></td>
                      <td><input type="text" name="updatedName" value="<?php echo $row['stname']; ?>"></td>
                      <td><?php echo $row['reg_date']; ?></td>
                      <td><button type="submit" class="btn btn-primary">Update</button></td>
                      <td><a href="transfer.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                      </tr>
                      </form>
                  <?php
                    }
                  }
                  ?>
                </table>
              </div>
            </div>
          </div>
    </div>
    
</body>
</html>