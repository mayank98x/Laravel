<?php

require ('MySqlDrive.php');

$db_con = new MySqlDrive();
session_start();
$name =$name_err= "";
$phone = $phone_err ="";
$location =$location_err= "";
$id = "";
$email=$email_err="";
$folder = $tempname = $filename= "";
$wrong = FALSE;
$update = FALSE;
// var_dump($GLOBALS);


// echo $_GET["delete"];

if(isset($_POST['save'])){

    $filename=$_FILES["image"]["name"]; 
    echo $filename;
    $tempname = $_FILES["image"]["tmp_name"];
    echo $tempname;
    // echo $tempname;
    $folder = "images/";

    move_uploaded_file($tempname, $folder.$filename);
    echo $folder.$filename;

    $name = trim($_POST['name']);
    $regex_name= '/[A-Za-z]+/';
    if(!preg_match($regex_name, $name)){
        $name_err="Name";
        $wrong = TRUE;
    }
   
    $phone = trim($_POST['phone']);
    $regex_phone = '/^[6-9][0-9]{9}/';
    if(!preg_match($regex_phone, $phone)){
        $phone_err=", Phone Number";
        $wrong = TRUE;
    }
    
    $location= trim($_POST['location']);
    $regex_location = '/^[a-zA-Z]/';
    if(!preg_match($regex_location, $location)){
        $location_err=", Location";
        $wrong = TRUE;
    }

    $email =trim($_POST['email']);
    $regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
    if(!preg_match($regex_email, $email)){
        $email_err=", Email";
        $wrong = TRUE;
    }
    // echo $_POST['name'];
    if(!$wrong){
        // echo $filename;
    $query = "INSERT INTO emp (name, phone, location , email , photo) VALUES ('$name', '$phone', '$location' , '$email' , '$filename')";

    $db_con = new MySqlDrive();
    $db_con->insert($query);
    $_SESSION['message']="Record has been inserted";
    // echo $filename;
    header("location: index_new.php");
    }
    else{
        $_SESSION['error']="Please Enter valid $name_err $phone_err $location_err $email_err.";
        header("location: add.php");
    }
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $query = "DELETE FROM emp WHERE id=$id";
    $db_con->excute_query($query);
    echo "delete";
    $_SESSION['message']="Record has been Deleted";
    header("location: index_new.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $query = "SELECT * FROM emp WHERE id=$id";
    $result = mysqli_query($db_con->db_connect(), $query);
    if(mysqli_num_rows($result) == 1){
        $row = $result->fetch_array();
        $name = $row['name'];
        $phone = $row['phone'];
        $location = $row['location'];
        $email = $row['email'];
        $id = $row['id'];
        $filename = $row['photo'];
        $update = TRUE;
    }
}


if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    // $filename=$_FILES["image"]["name"]; 
    echo $filename;
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $query = "UPDATE emp SET name='$name', location='$location' , email='$email' , phone='$phone' , photo='$filename' WHERE id=$id";
    echo $query;
    // $query = "UPDATE emp SET name='$name' WHERE id=$id";
    $result = mysqli_query($db_con->db_connect(), $query) or die("Error: " . $mysqli->error);
    $_SESSION['message']="Record has been Edited";
    // header('location:index_new.php');
}
?>