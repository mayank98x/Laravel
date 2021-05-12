// ajax request FOr Insert Data
$(document).ready(function(){
    showdata();    
    function showdata(){
        output="";
        $.ajax({
            url:'retrive.php',
            method:"GET",
            dataType: "json",
            success:function(data){
                // console.log(data);
                if(data){
                    x=data;
                }
                else{
                    x="";
                }
                for(i=0; i< x.length; i++){
                    // console.log(x[i]);
                    output+= "<tr><td>"+x[i].name+ "</td><td>"+x[i].email + "</td><td>"+x[i].phone + "</td><td>"+x[i].location + "</td><td><button id='edit' class='btn btn-warning btn-sm btn-edit' data-sid="+ x[i].id+ ">Edit</button> <button  id='del' class='btn btn-danger btn-sm btn-edit' data-sid="+ x[i].id+ ">Delete</button></tr>"
                }
                $("#tbody").html(output); }
        })
    }
    $('#email_id').keyup(function(){
        $('#validate_msg').show();
        var email= $('#email_id').val().trim();
        if(email!= ''){
            $.ajax({
                url: 'validate.php',
                type: 'POST',
                data:{email: email},
                success: function(response){
                    console.log(response)
                    if(response){
                        $('#validate_msg').html("<span style='color: green;'> Available.</span>");
                        $('#save').prop('disabled',false);
                    }
                    else{
                        $('#validate_msg').html("<span style='color: red;'>Not Available.</span>");
                        $('#save').prop('disabled',true);
                    }
                            
                }
            });
        }
    });

    $('#save').click(function(e){
        console.log("inside the SAVE button");
        showdata();
        e.preventDefault();
        $('#msg').show();
        $('#validate_msg').css("display","none");
        let name= $("#name_id").val();
        let email= $("#email_id").val();
        let location= $("#location_id").val();
        let phone= $("#phone_id").val();
        mydata = {'name' : name , 'email' : email , 'location' : location , 'phone' : phone};
            $.ajax({
                url : 'insert.php',
                method : 'POST',
                data : JSON.stringify(mydata),
                success: function(data){
                    console.log(data);
                    msg="<div class='alert alert-success mt-3'>"+data+"</div>";
                    $('#msg').html(msg);
                    $('#msg').delay(2000).fadeOut();
                    // console.log('$#msg');
                    $('#myform')[0].reset();
                    // window.location.href='table.php'; 
                },
                error: function(xhr, status, error){
                    console.error(xhr);}
            });
            showdata();    
    });


    $('#tbody').on('click','#del',function(){
        console.log("delete button clicked");
        let id= $(this).attr('data-sid');
        // console.log(this);
        // console.log(id);
        mydata = {sid:id};
        mythis = this;
        $.ajax({
            url: 'delete.php',
            method: "POST",
            data: JSON.stringify(mydata),
            success: function(data){
                console.log(data);
                // showdata(); 
                $(mythis).closest("tr").fadeOut(400);
            }
        });
    });
    $('#tbody').on('click','#edit',function(){
        console.log("Edit button clicked");
        let id= $(this).attr('data-sid');
        window.location.href='edit.php?data='+id;
    });
    $('#update').click(function(e){
        console.log("inside the update button");
        let id= $(this).attr('data-sid');
        console.log(id);
        e.preventDefault();
        $('#msg').show();
        $('#validate_msg').css("display","none");
        let name= $("#name_id").val();
        let email= $("#email_id").val();
        let location= $("#location_id").val();
        let phone= $("#phone_id").val();
        mydata = {'name' : name , 'email' : email , 'location' : location , 'phone' : phone , 'id' : id };
            $.ajax({
                url : 'insert.php',
                method : 'POST',
                data : JSON.stringify(mydata),
                success: function(data){
                    console.log(data);
                    msg="<div class='alert alert-success mt-3'>"+data+"</div>";
                    $('#msg').html(msg);
                    $('#msg').delay(2000).fadeOut();
                    // console.log('$#msg');
                    $('#myform')[0].reset();
                    window.location.href='table.php';

                    
                },
                error: function(xhr, status, error){
                    console.error(xhr);}
            });
            showdata();    
    });
});