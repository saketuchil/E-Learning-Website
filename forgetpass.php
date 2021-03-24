<?php

require_once("DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['mailme'])){ 
$mail_id=$_POST["email"];
$sql="SELECT * FROM `register` WHERE email='".$mail_id."';";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){      
	echo "<script>alert('No such email found!!');window.location = 'forgetpass.php'</script>";    
}
else{
	session_start();
	$row=mysqli_fetch_assoc($result);
	$_SESSION['reg_id']=$row['id'];
	$sql="SELECT * FROM `login` WHERE `username`='".$row['name']."'";
	$result = mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($result);
	$_SESSION['log_id']=$row['id'];	
	$mailer = "Location: http://localhost:8080/project/mail.php?id=".$mail_id;
	header($mailer);	
}
}
mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>   
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">

	<!--Bootstrap CDN-->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		.card{
			height:250px;
		}
	</style>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header" align="center">
				<h3>Forgot password</h3>				
			</div>
			<div class="card-body">
				<form action="forgetpass.php" method="POST">

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-at"></i></span>
						</div>
						<input type="email" class="form-control" name="email" placeholder="Email ID" required>
					</div>
					<div class="form-group" id="sub_but">
						<input type="submit" value="Send mail" class="btn login_btn" name="mailme">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>