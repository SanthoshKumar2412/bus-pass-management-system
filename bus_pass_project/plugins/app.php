<?php
 include("../plugins/database.php");
 if($_SERVER['REQUEST_METHOD']=="POST"){
    $uname=$_POST['uname'];
    $fname=$_POST['fname'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $age=$_POST['age'];
    $aadhar=$_POST['aadhar'];
    $mobno=$_POST['mobno'];
    $address=$_POST['address'];
    $mail=$_POST['mail'];
    $pcode=$_POST['pcode'];
    $ptype=$_POST['ptype'];
    if(!empty($uname)&&!empty($fname) &&!empty($dob) &&!empty($gender)&&!empty($age) &&!empty($aadhar) &&!empty($mobno) &&!empty(address) &&!empty(mail) &&!empty(pcode) &&!empty(ptype))
{
    $query="insert into passdetails(fromplace,toplace,passcat,passtype,rate) values('$fplace','$tplace','$passcategory','$ptype','$rate')";
    mysqli_query($con,$query);
    echo "<Script type='text/javascript'>alert('successfully Register')</script>";
}
else{
    echo "<Script type='text/javascript'>alert('enter all the details')</script>";
}
 }
 if($_SERVER['REQUEST_METHOD']=="POST"){
    
 }
 ?>