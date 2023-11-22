<?php
$con=new mysqli("localhost","root","","buspass");
if($con->connect_error){
  echo $con->connect_error;
  die("sorry database connection failed");
}
// {
//     echo "Database connected";
// }
?>