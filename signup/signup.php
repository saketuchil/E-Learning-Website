<?php

require_once("../DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['reg'])){
$user_name=$_POST["name"];
$email=$_POST["email"];
$contact=$_POST["contact"];
$password=$_POST["password"];
$hash = md5($password);

$stmt = $conn->prepare('INSERT INTO `register`(`name`, `email`, `contact`, `password`) VALUES (?,?,?,? )');
$stmt->bind_param('ssss', $user_name, $email, $contact, $hash);
$stmt->execute();
$res1 = $stmt->get_result();

$stmt = $conn->prepare('INSERT INTO `login`(`username`, `password`) VALUES (?,?)');
$stmt->bind_param('ss', $user_name, $hash);
$stmt->execute();
$res2 = $stmt->get_result();


// $sql="INSERT INTO `register`(`name`, `email`, `contact`, `password`) VALUES ('".$user_name."','".$email."','".$contact."','".$password."')";
// $s="INSERT INTO `login`(`username`, `password`) VALUES ('".$user_name."','".$password."')";

// if($conn->query($sql) === TRUE AND $conn->query($s) === TRUE) {
//     header("Location: http://localhost:8080/project/login.php"); 
// }

header("Location: http://localhost:8080/project/login.php"); 
mysqli_close($conn);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>ZEAL: E-Learning</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>  
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <center>
                    <h2 class="title">Registration</h2>
                   </center>
                    <form method="POST" action="signup.php">
                        <div class="input-group">
                            <input class="input--style-2" type="text" placeholder="Name" name="name" required>
                        </div>

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="email" placeholder="Email" name="email" required> 
                                </div>
                        </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="text" placeholder="Contact Number" name="contact" required>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                        <div class="input-group">
                            <input class="input--style-2" type="password" placeholder="Password" id="password" name="password" required>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-2" type="password" placeholder="Confirm Password" id="confirm_password" required>
                                </div>
                            </div>
                        </div>
                        </fieldset>
                        <div class="p-t-30">
                            <button name="reg" class="btn btn--radius btn--green" type="submit">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script type="text/javascript">
        var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->