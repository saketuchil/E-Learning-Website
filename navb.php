<html>
<head>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen"> 
	<link rel="stylesheet" href="assets/css/style.css">
	<script type="text/javascript">
		$(document).ready(function(){
			alert("Hey");
			$("#navb").hide();	
		}
	</script>
	<style type="text/css">
		li{
			margin-left: 7px;
		}
		#nav_bar{
			height: 10px;
			margin-left: 7px;
			margin-top: -10px;
		}
		#but_login{
			width: 1%;
		}
		.glyphicon-log-in{
			position: relative;
			right:40px;
		}
		#login_font{
			position: relative;
			right: 30px;
		}
	</style>

</head>
<body>
	<div class="navbar navbar-inverse">
		<div class="container">			
			<div class="navbar-header"> 					        	 	
				<ul class="nav navbar-nav pull-right mainNav" id="navb">
				<li>		 		        
			        <a href="logout.php" class="btn btn-info btn-lg">
			          <span class="glyphicon glyphicon-log-out" id="logout"> Logout</span> 
			        </a> 
				</li>
		        <li class="header--nav__item header--profile__dropdown" id="nav_bar">
	                <a class="header--nav__link">
	                    <font size="5">
		                    <img class="header--user__avatar" src="avatar.png" height="50">
		                    <?php		                    
			                    if (isset($_SESSION['user']['name'])) {
			                    	echo $_SESSION['user']['name'];
			            		}
		                    ?>                   
		                    <i class="header--icon__caret"></i>
	                	</font>
	                </a>
		        </li>    		        
		    	</ul>    
		    	<ul id="nav_head">
		    	<li>		    		
		       	    <a href="login.php" class="btn btn-info btn-lg" id="but_login">
          				<span class="glyphicon glyphicon-log-in"></span><font size="4" id="login_font">Log in </font>
        			</a>
		        </li>
		        </ul>        	
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li><a href="index.php">Home</a></li>
					<li><a href="about.php">About</a></li>					
					<li><a href="catalog.php">Catalog</a></li>
					<li><a href="mycourses.php">My Courses</a></li>
					
					<li><a href="free_courses.php">Free Courses</a></li>
				</ul>				     
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>	
</body>
</html>

<?php		
		if(isset($_SESSION['userid'])){
			$show=true;
			echo "<script>$(\"#navb\").show();$(\"#nav_head\").hide();</script>";	
		}else{	
			$show=false;
			echo "<script>document.getElementById(\"navb\").style.display=\"none\";$(\"#nav_head\").show();</script>";
		}
?>	