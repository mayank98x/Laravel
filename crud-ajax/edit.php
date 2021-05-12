<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>AJAX</title>
</head>
<body>
<?php require('nav.php'); 
require('connection.php');
$name ="";
$phone  ="";
$location="";
$email="";
if(isset($_GET['data'])){
	$id = $_GET['data'];
    $query = "SELECT * FROM people WHERE id={$id}";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
        $name = $row['name'];
        $phone = $row['phone'];
        $location = $row['location'];
        $email = $row['email'];
}
?>

     <div class="container mt-5">
        <div class="row mt-5" >
        <form method="post"  id="myform" >
		<div class="row "><h1>Edit Details</h1></div>
		<div  class="col mb-3">
			<label>Full Name</label>
			<input type="text" class="form-control " name="name" id="name_id" placeholder="Enter Your Full Name Here" value="<?php echo $name;?>" required>
		</div>
		<div class="col mb-3">
			<label class="form-label">Address</label>
			<input type="text" class="form-control" name="location"  id="location_id" placeholder="Enter Your Valid Address" value="<?php echo $location;?>" required>
		</div>
        <div class="col mb-3">
			<label class="form-label">Email</label>
			<input type="email"  class="form-control" name="email" id="email_id" placeholder="Enter Your Valid Email" value="<?php echo $email;?>" required>
			<p id="validate_msg"></p>
		</div>
        <div class="col mb-3">
			<label class="form-label">Mobile Number</label>
			<input type="number"  class="form-control" name="phone" id="phone_id" placeholder="Enter Your Mobile Number" value="<?php echo $phone;?>" required>
		</div>
		<div class="col mb-3">
        <button class=" btn  btn-outline-info"  class="form-control" type="submit" name="update" id="update" data-sid="<?php echo $id; ?>">Update</button>
		</div>
		<div class="col mb-3" id="msg">
		</div>
		</div></div>
	</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="js/jqajax.js"> </script>
</body>
</html>