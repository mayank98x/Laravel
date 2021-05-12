<?php
    include('connection.php');
    $data = stripslashes(file_get_contents("php://input"));
    $mydata = json_decode($data,true);
    $id = $mydata['sid'];

    if(!empty($id)){
        $sql = "DELETE FROM people Where id ={$id}";
        if($conn->query($sql)== TRUE){
            echo "Record has been deleted Successfully";
        }else{
            echo "Unable to Delete Record";
        }
    }


?>    