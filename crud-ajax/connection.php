<?php

    $db_host="localhost";
    $db_user = "tyler";
    $db_password = "root";
    $db_name= "crud";
    $conn = new mysqli($db_host , $db_user , $db_password , $db_name);
    if($conn-> connect_error){
        die("Connection Failed");
    }
?>