<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <?php
            require('nav.php');
            require('process.php');
            $db_con = new MySqlDrive();
            $query = "SELECT * FROM emp";
            $result = $db_con->read($query);
            $result = mysqli_query($db_con->db_connect(), $query);
            // var_dump($result);
        ?>
        <?php if(isset($_SESSION["message"]))
                {
					echo '<div id="msg1" class="alert alert-success" role="alert">'.$_SESSION["message"].'</div>'; 
   					 echo "
                        <script>
                        $('document').ready(function(){ 
                         $('#msg1').delay(1000).fadeOut(300);
                            
                        });  </script>"; 
  						
                } 
				?> 
        <div class="contianer">
             <div class="row">
                <div class="col-10 mx-auto">
            <table class="table table-secondary table-striped table-hover table-bordered thead-light">
                <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Address</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-active table-striped ">
                    <?php while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td><img style="width: 100px; height:100px; " src="images/<?php echo $row['photo'];?>" alt=""></td>
                        <td ><?php echo $row['name']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        
                        <td>
                            <a href="add.php?edit=<?php echo $row['id']?>">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div></div></div>
        <br>
    </body>
</html>