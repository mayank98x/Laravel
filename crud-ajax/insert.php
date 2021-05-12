<?php
    include('connection.php');
    $id = 0;
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $name = $mydata['name'];
    $email = $mydata['email'];
    $phone = $mydata['phone'];
    $location = $mydata['location'];
    $err="Please enter valid";
    $flag= true;

    $regex_name= '/[A-Za-z]+/';
    if(!preg_match($regex_name, $name)){
        $err=$err."Name";
        $flag= false;
    }
    $regex_phone = '/^[6-9][0-9]{9}/';
    if(!preg_match($regex_phone, $phone)){
        $err=$err.", Phone";
        $flag= false;
    }
    $regex_location = '/^[a-zA-Z]/';
    if(!preg_match($regex_location, $location)){
        $err=$err.", Location";
        $flag= false;
    }
    $regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if(!preg_match($regex_email, $email)){
        $err=$err.", Email";
        $flag= false;
    }

if($flag){



    if(count($mydata)>4){
        $id = $mydata['id'];
    }
    if($id == 0){
        if(!empty($name) && !empty($email) && !empty($phone) && !empty($location)){
                $response;
                $sql = "INSERT INTO people(name,email,location,phone) VALUES('$name','$email','$location','$phone')";
                if($conn->query($sql)== TRUE){
                    echo "DATA HAS BEEN INSERTED";
                }
                else{
                    echo "UNABLE TO SAVE DATA";
                }
            }else{
            echo "FIll All fields";
        }
    }
    else{
        if(!empty($name) && !empty($email) && !empty($phone) && !empty($location)){
            $response;
            $sql = "UPDATE people SET name='$name', location='$location' , email='$email' , phone='$phone' WHERE id={$id}";
            if($conn->query($sql)== TRUE){
                echo "DATA HAS BEEN Updated";
            }
            else{
                echo "UNABLE TO SAVE DATA";
            }
        }else{
            echo "FIll All fields";
        }
    }
}
else{
    echo "Enter valid".$err ; 
}
    if(isset($_POST['email'])){     //Validation For email using ajax.
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