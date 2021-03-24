<?php

session_start();
if(isset($_SESSION['userid'])){
    require_once ('php/CreateDb.php');
    require_once ('./php/component.php');
    require_once ('DbInit.php');

    // create instance of Createdb class
    $db = new DbInit();
    $con = $db->getConnection();
    $database = new CreateDb($con,"my_courses");  
}

?>

<!doctype html>
<html lang="en">
<head>
    
    <title>Shopping Cart</title>

</head>
<body>
<hr>
<?php require_once ("navb.php"); ?>
<hr>
<div class="container">
        <div class="row text-center py-5">
            <?php
                if(isset($_SESSION['userid'])){
                    $result = $database->getMycourse();
                    if(isset($result)){
                        while ($row = mysqli_fetch_assoc($result)){
                        $res = mysqli_fetch_assoc($database->getCourseData($row['product_id']));
                        courses($res['product_name'], $res['product_image'], $res['id'], $res['product_description']);
                        }    
                    }else{
            ?>
            <h2>No course available, you need to buy the course from catalog.</h2>
            <?php
                    }                    
                }
                else{
            ?>
            <h2>No course available, please Log in.</h2>
            <?php
                }
            ?>
        </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
