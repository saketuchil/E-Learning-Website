<?php

function component($productname, $productprice, $productimg, $productid, $productdesc){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-3\" id=\"cat_comp\">
                <form action=\"catalog.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            
                            <p class=\"card-text\">
                                $productdesc
                            </p>
                            <h5>                                
                                <span class=\"price\"><i class=\"fa fa-rupee\"></i>$productprice</span>
                            </h5>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid ,$productdesc){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\" id=\"cart_comp\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>

                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">$productdesc</small>
                                <h5 class=\"pt-2\"><i class=\"fa fa-rupee\"></i>$productprice</h5>
                                <hr>
                                <button type=\"submit\" class=\"btn btn-danger pt-2\" name=\"remove\">Remove</button>
                            </div>                          
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

function courses($productname, $productimg, $productid, $productdesc){
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-3\" id=\"cou_comp\">
                <form action=\"c/c.html\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <img src=\"$productimg\" alt=\"Image1\" class=\"img-fluid card-img-top\">
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            
                            <p class=\"card-text\">
                                $productdesc
                            </p>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Go to course</button>
                             <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
       img.img-fluid {
            max-width: 100%;
            height: 180px;
        }
        div.card-body{
            height: 270px;
        }
    </style>
</head>
<body>

</body>
</html>
















