<?php
session_start();
if(isset($_POST['verify'])){ 	
	if ($_POST['code']==$_SESSION['code']) {
		header("Location: http://localhost:8080/project/change_pass.php");
	} else{
		echo "<script>alert(\"Wrong code entered\");window.location = 'check_code.php'</script>";    
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot password</title>   
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
				<h3>Enter the code sent on mail.</h3>				
			</div>
			<div class="card-body">
				<form action="check_code.php" method="POST">

					<div class="input-group form-group">						
						<input type="number" class="form-control" placeholder="Enter code" min="100000" max="999999" name="code" required>
					</div>
					<div class="form-group" id="sub_but">
						<input type="submit" value="Verify" class="btn login_btn" name="verify">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>