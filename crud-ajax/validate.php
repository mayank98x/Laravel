<?php
    include('connection.php');
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $flag=true;
        $query = "select count(*) as cntUser from people where email='".$email."'";
        $result = mysqli_query($conn, $query);
        $response = true;
        if(mysqli_num_rows($result)){
            $row = mysqli_fetch_array($result);
            $count = $row['cntUser'];
            if($count > 0){
                $response = false;
            }
         }
         echo $response;
         die;
      }
      ?>