<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
<?php
        require('nav.php'); 
        require('process.php');?>
                <?php if(isset($_SESSION["error"]))
                {
					echo '<div id="msg" class="alert alert-danger" role="alert">'.$_SESSION["error"].'</div>'; 
   					 echo "<script>
   							 $('#msg').delay(2000).fadeOut(2000);  </script>"; 
  						  $_SESSION['error']='';
                } 
				?> 
             
		<div class="container ">
        <div class="mt-5" >
        <form method="post" action="process.php" enctype="multipart/form-data" >
		<div  class="mb-3">
			<label>Full Name</label>
			<input type="text" class="form-control " name="name" value="<?php echo $name;?>" required>
		</div>
        <div class="mb-3">
		<label class="form-label">ID</label>
			<input type="number"  class="form-control" name="id" value="<?php echo $id;?>" required>
		</div>
		<div class="mb-3">
			<label class="form-label">Address</label>
			<input type="text" class="form-control" name="location" value="<?php echo $location;?>" required>
		</div>
        <div class="mb-3">
			<label class="form-label">Email</label>
			<input type="email"  class="form-control" name="email" value="<?php echo $email;?>" required>
		</div>
        <div class="mb-3">
			<label class="form-label">Mobile Number</label>
			<input type="number"  class="form-control" name="phone" value="<?php echo $phone;?>" required>
		</div>
		<div class="mb-3">
			<div class="row">
				<div class="col-sm"><label class="form-label" style="display: block;">Upload Your Profile Picture</label> </div>
				<div class="col"> <img src="images/<?php echo $filename;?>" alt=""> </div>
				<div class="w-100">    </div>
				<?php if($update == true): ; ?>
			    <div class="col"> <input type="file"  name="image" ></div>
				<?php else: ?>  
				<div class="col"> <input type="file"  name="image"  required></div>
				<?php endif ;?> 
			<div class="col" > </div>
		</div>
		<div  class="d-grid gap-2">
            <?php if($update == true): ; ?>
            <button class=" btn  btn-outline-info" class="form-control" type="submit" name="update">Update</button>
        <?php else: ?>    
			<button class=" btn  btn-outline-info"  class="form-control" type="submit" name="save" >Submit</button>
         <?php endif ;?>    
		</div></div></div>
	</form>
</body>
</html>