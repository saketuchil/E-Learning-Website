<?php
 
require_once("DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['login'])){
$user_name=$_POST["uname"];
$pass=$_POST["pass"];
$hash = md5($pass);

$stmt = $conn->prepare('SELECT * FROM `login` WHERE username = ? AND password = ?');
$stmt->bind_param('ss', $user_name, $hash);
$stmt->execute();
$result = $stmt->get_result();

// $sql="SELECT * FROM `login` WHERE username='".$user_name."' AND password='".$pass."';";
// $result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result)==0){      
	echo "<script>alert('Either username or password is incorrect');window.location = 'login.php'</script>";    
	//header("Location: http://localhost:8080/project/login.php");
}
else{	
	$row=$result->fetch_assoc();
	session_start();
	session_unset();
	$_SESSION['userid']=$row['id'];	
	$sql="SELECT * FROM `register` WHERE `name`='".$row['username']."' AND `password`='".$row['password']."';";
	$result = mysqli_query($conn,$sql);
	$row=$result->fetch_assoc();	
	$_SESSION['user']['email']=$row['email'];
	$_SESSION['user']['contact']=$row['contact'];
	$_SESSION['user']['name']=$row['name'];
	header("Location: http://localhost:8080/project/index.php");	
}
mysqli_close($conn);	
}

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
		#signup{
			margin-top:20px;
			float:right;
			position:relative;
			left:5%;
		}
		#skip{
			margin-top:20px;
			float:left;
			position:relative;
			right:5%;
		}

	</style>
</head>
<body>
<div class="container">
	<div>
		<a href="index.php"><button type="button" class="btn btn-success" id="skip">Skip Login</button></a>
	</div>
	<div>
		<a href="signup/signup.php"><button type="button" class="btn btn-success" id="signup">Sign Up</button></a>
	</div>
	<div class="d-flex justify-content-center h-100">

		<div class="card">
			<div class="card-header" align="center">
				<h3>Sign In</h3>				
			</div>
			<div class="card-body">
				<form action="login.php" method="post">
					<div class="input-group form-group" id="uname">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" name="uname" placeholder="Username" required>
						
					</div>
					<div class="input-group form-group" id="pass">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" name="pass" placeholder="Password" required>
					</div>					
					<div class="form-group" id="sub_but">
						<input type="submit" value="Login" class="btn login_btn" name="login">
					</div>
				</form>
			</div>
			<div class="card-footer">				
				<div class="d-flex justify-content-center">
					<a href="forgetpass.php">Forgot your password?</a>

				</div>

			</div>
		</div>
	</div>
</div>
</body>
</html>


 