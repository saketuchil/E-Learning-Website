<?php
require_once("DbInit.php");
$dbins = new DbInit();

$conn = $dbins->getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST["sub_ins"])){
    $img=$_POST["img"];
    $pname=$_POST["pname"];
    $price=$_POST["price"];
    $desc=$_POST["desc"];

    $sql="INSERT INTO `catalog`(`product_image`, `product_name`, `product_price`, `product_description`) VALUES ('".$img."','".$pname."','".$price."','".$desc."')";
    $result = $conn->query($sql);
    if ($result==true) {
        header("Location: http://localhost:8080/project/catalog.php");
    }    
}
mysqli_close($conn);

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            #container{
                margin-top:180px;
            }
            #title{
                position: relative;
                top:100px;
            }
        </style>
    </head>
    <body>
        <h1 align="center" id="title"><i><u>Insert product to catalog</u></i></h1>
        <div id="container">
        
        <form class="form-horizontal" action="insert_product.php" method="POST">

            <div class="form-group">
            <label class="control-label col-sm-2">Product name:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="pname" required="true">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2">Description:</label>
            <div class="col-sm-8">          
                <input type="textarea" class="form-control" id="desc" placeholder="Enter description about your product" name="desc" required="true">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2">Price:</label>
            <div class="col-sm-8">          
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required="true">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2">Image:</label>
            <div class="col-sm-8">          
                <input type="file" class="form-control" id="img" placeholder="Choose image" name="img" required="true">
            </div>
            </div>

            <div class="form-group">        
            <div class="col-sm-offset-5 col-sm-8">
                <button type="submit" name="sub_ins" class="btn btn-default">Submit</button>
            </div>
            </div>
        </form>
        </div>
    </body>
</html>