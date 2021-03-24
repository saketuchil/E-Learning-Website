<?php 
 
class DbInit
{
	public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

	public function __construct(
        $dbname = "zeal",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
      $this->dbname = $dbname;
      $this->servername = $servername;
      $this->username = $username;
      $this->password = $password;

      // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con){
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if(mysqli_query($this->con, $sql)){

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // sql to create new table
            $sql = "CREATE TABLE IF NOT EXISTS `catalog` (
					  `id` bigint(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					  `product_name` text NOT NULL,
					  `product_price` text NOT NULL,
					  `product_image` text NOT NULL,
					  `product_description` text NOT NULL
					);";
			$res = mysqli_query($this->con, $sql);

			$sql = "CREATE TABLE IF NOT EXISTS `login` (
					  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					  `username` text NOT NULL,
					  `password` text NOT NULL
					);";
			$res = mysqli_query($this->con, $sql);

			$sql = "CREATE TABLE IF NOT EXISTS `my_courses` (
					  `id` bigint(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					  `product_id` bigint(11) NOT NULL,
					  `user_id` bigint(11) NOT NULL
					);";
			$res = mysqli_query($this->con, $sql);

			$sql = "CREATE TABLE IF NOT EXISTS `orders` (
					  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
					  `user_id` bigint(20) NOT NULL,
					  `raz_id` text NOT NULL
					);";
			$res = mysqli_query($this->con, $sql);

			$sql = "CREATE TABLE IF NOT EXISTS `register` (
					  `name` text NOT NULL,
					  `email` text NOT NULL,
					  `contact` text NOT NULL,
					  `password` text NOT NULL,
					  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT
					);";
			$res = mysqli_query($this->con, $sql);		

            if (!$res){
                echo "Error creating table : " . mysqli_error($this->con);
            }

        }else{
            return false;
        }
    }

    public function getConnection(){
    	return $this->con;
    }
}

?>