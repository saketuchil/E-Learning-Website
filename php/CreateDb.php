<?php

class CreateDb
{ 
    public $tablename;
    public $con;

    // class constructor
    public function __construct($con,$tablename = "catalog")
    {
      $this->con = $con;
      $this->tablename = $tablename;
    }

    // get product from the database
    public function getData(){
        $sql = "SELECT * FROM $this->tablename";
    
        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }

    public function getMycourse(){
        $sql = "SELECT * FROM $this->tablename WHERE user_id=".$_SESSION['userid'];        
        $result = mysqli_query($this->con, $sql);
        if($result == false){
            return null;
        } else{
            if(mysqli_num_rows($result) > 0){
                return $result;
            }
        }        
    }

    public function getCourseData($course_id){
        $sql = "SELECT * FROM `catalog` WHERE id=".$course_id;
    
        $result = mysqli_query($this->con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }

    public function search($data){
        $sql="SELECT * FROM `catalog` WHERE `product_name` LIKE '%".$data."%' ORDER BY `product_name` ASC";        
        $result = mysqli_query($this->con,$sql);
        return $result;
    }
}






