<?php
	session_start();
  	include("verify.php");
  	if(!isset($_SESSION['userid'])){
  		echo "<script>alert('In order to purchase the course, please Log in.');window.location = 'login.php'</script>";  		
  	}
if($h==1)
{
    require_once("DbInit.php");
	$dbins = new DbInit();

	$conn = $dbins->getConnection();
    if(! $conn)
    {
        die('Connection Failed'.mysql_error());
    }
	$product_id = array_column($_SESSION['cart'], 'product_id');
	$userid=$_SESSION['userid'];
	foreach ($product_id as $id){
		$sql = "INSERT INTO `my_courses`(`product_id`,`user_id`) VALUES (".$id.",".$userid.");";
		mysqli_query($conn,$sql);		
	}
	$conn->close();
	unset($_SESSION['cart']);
	header("Location: http://localhost:8080/project/mycourses.php");
}
else 
{			
	$conn->close();
	$h="<h1>There was an issue processing your order.</h1>";
}
?>