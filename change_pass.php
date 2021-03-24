<?php
require_once("DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['passupd'])){ 
session_start();
$pass=$_POST["passw"];
$hash = md5($pass);
$sql="UPDATE `register` SET `password`='".$hash."' WHERE `id`=".$_SESSION['reg_id'];
$result = mysqli_query($conn,$sql);
$sql="UPDATE `login` SET `password`='".$hash."' WHERE `id`=".$_SESSION['log_id'];
if ($conn->query($sql) === TRUE) {
	session_destroy();
	echo "<script>window.location = 'login.php'</script>";    
} else{
	echo "<script>alert(\"Error while updating password\");window.location = 'change_pass.php'</script>";    
}
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Password</title>   
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">

	<!--Bootstrap CDN-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		.card{
			height:300px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header" align="center">
				<h3>Change password</h3>				
			</div>
			<div class="card-body">
				<form action="change_pass.php" method="POST">

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-lock" style="font-size:24px"></i></span>
						</div>
						<input type="password" class="form-control" name="passw" placeholder="New Password" required>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-check" style="font-size:24px"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Confirm Password" required>
					</div>
					<div class="form-group" id="sub_but">
						<input type="submit" value="Update" class="btn login_btn" name="passupd">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>