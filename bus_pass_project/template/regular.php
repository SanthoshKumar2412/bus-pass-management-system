<?php
session_start();
include("../plugins/database.php");
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}

// Check if the user is logged in
$loggedIn = isset($_SESSION['email']);


if (!$loggedIn) {
    header("Location: user_login.php");
    exit();
 }

if($_SERVER["REQUEST_METHOD"]=="POST"){

$uname=$_SESSION['uname'];
$fname=$_SESSION['fname'];
$dob=$_SESSION['dob'];
$gender=$_SESSION['gender'];
$age=$_SESSION['age'];
$aadhar=$_SESSION['aadhar'];
$mobno=$_SESSION['mobno'];
$area=$_SESSION['area'];
$mail=$_SESSION['mail'];
$pcode=$_SESSION['pcode'];
$ptype=$_SESSION['ptype'];
$insname=$_POST['insname'];
$insplace=$_POST['insplace'];
$fromplace=$_POST['fromplace'];
$toplace=$_POST['toplace'];
$pcat=$_POST['pcat'];
$currentDate = new DateTime(); // Get the current date

switch ($pcat) {
    case "monthly":
        $currentDate->add(new DateInterval('P1M')); // Add 1 month
        break;
    case "quarterly":
        $currentDate->add(new DateInterval('P3M')); // Add 3 months
        break;
    case "halfyearly":
        $currentDate->add(new DateInterval('P6M')); // Add 6 months
        break;
    case "yearly":
        $currentDate->add(new DateInterval('P1Y')); // Add 1 year
        break;
    default:
        echo "Invalid payment frequency selected.";
        exit;
}
//customer id generate
$prefix = "CP";

// Generate a timestamp (e.g., current timestamp)
$timestamp = time();

// Generate a random component (e.g., a random number or alphanumeric string)
$random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);

// Combine the components to create a unique pass ID
$CusID = $prefix . $timestamp . $random;

// Format and display the calculated expiration date
$formattedExpirationDate = $currentDate->format('Y-m-d');


if(isset($_POST["submit"])){
    if(getimagesize($_FILES['aaphoto']['tmp_name'])==false
        && getimagesize($_FILES['aphoto']['tmp_name'])==false){
        echo "please select image";
    }
    else{
        $aphoto=$_FILES['aphoto']['tmp_name'];
        $aname=$_FILES['aphoto']['name'];
        $aphoto=file_get_contents($aphoto);
        $aphoto=base64_encode($aphoto);

        $aaphoto=$_FILES['aaphoto']['tmp_name'];
        $aaname=$_FILES['aaphoto']['name'];
        $aaphoto=file_get_contents($aaphoto);
        $aaphoto=base64_encode($aaphoto);

      

        $sql="INSERT INTO `application`(`uname`, `fathername`, `dob`, `age`, `mobno`, `gender`, `aadharnno`, `email`, `uaddress`, `pincode`, `category`, `insname`, `insplace`, `fromplace`, `toplace`, `passtype`, `aname`, `appphoto`, `aaname`, `aadhar`, `idname`, `idproof`, `validdate`,`cusId`)
        VALUES('".$uname."','".$fname."','".$dob."','".$gender."','".$age."','".$aadhar."','".$mobno."','".$area."','".$mail."','".$pcode."','".$ptype."','".$insname."','".$insplace."','".$fromplace."','".$toplace."','".$pcat."','".$aname."','".$aphoto."','".$aaname."','".$aaphoto."','".$idname."','".$idcard."','" .$formattedExpirationDate."','$CusID')";
        if($con->query($sql))
        {
            $_SESSION['cusId']=$CusID ;
            header("location:payment.php");
                    die;
        }
        else{
            echo "err";
        }

    }
}   

else{
    echo "please select";
}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Pass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../css/application.css">
</head>
<body>
    <section id="header2" class="header">
    <nav>
                <div class="logo">
                    <div class="icon">
                    <i class="fa fa-bus" aria-hidden="true" id="icon"></i>
                    </div>
                    <div class="heading">
                  <h1>city<span>pass</span></h1>
                   </div>
                </div>
                <div class="nav-app">
                    <ul>
                     <li><a href="../index.php">home</a></li>
                     <li><a href="user_view.php">view pass</a></li>
                     <li><a href="renew.php">renew pass</a></li>
                     <li><a href="../index.php">status</a></li>
                     <li><a href="../index.php">about</a></li>
                     
                    </ul>
                </div>
                <div class="logins">
        <?php if ($loggedIn) { ?>
            <!-- If logged in, display logout button -->
            <form action="" method="post">
                <input type="submit" name="logout" value="Logout">
            </form>
        <?php } else { ?>
            <!-- If not logged in, display login button -->
            <button onclick="navigateToLoginPage()">Login</button>
            <script>
                function navigateToLoginPage() {
                    window.location.href = "template/user_login.php";
                }
            </script>
        <?php } ?>
    </div>
            </nav>
        </div>
        <div class="container" id="conn">
             <div class="app" >
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                    <h3>working details</h3>
                    <div class="app-det">
                        <div class="input-box">
                            <label for="iname" >institue name</label>
                            <input type="text" placeholder="abc college" name="insname" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="iplace">place</label>
                            <input type="text" placeholder="hosur" name="insplace" autocomplete="off" required>
                        </div>
                        </div>
                        <div class="title">
                        <h3>travel route details</h3>
                        </div>
                        <div class="tra-det">
                        <div class="input-box"><!--fromplace--->
                            <label for="fplace">from</label>
                            <select name="fromplace" autocomplete="off" required>
                            <option value="none" selected disabled hidden>--Select--</option> 
                            <option value="Kanakapura">Kanakapura</option>
                            <option value="Harohalli">Harohalli</option>
                            <option value="Channapatna">Channapatna</option>
                            <option value="Ramangara">Ramangara</option>
                            <option value="Magadi">Magadi</option>
                            <option value="Chikkaballapura">Chikkaballapura</option>
                            <option value="Bengaluru">Bengaluru</option>
                        </select>
                        </div>
                        <div class="input-box"><!--toplace--->
                            <label for="tplace">to</label>
                            <select name="toplace" autocomplete="off" required>
                            <option value="none" selected disabled hidden>--Select--</option> 
                            <option value="Kanakapura">Kanakapura</option>
                            <option value="Harohalli">Harohalli</option>
                            <option value="Channapatna">Channapatna</option>
                            <option value="Ramangara">Ramangara</option>
                            <option value="Magadi">Magadi</option>
                            <option value="Chikkaballapura">Chikkaballapura</option>
                            <option value="Bengaluru">Bengaluru</option>
                        </select>
                        </div>
                        <div class="input-box">
                            <label for="ptype">pass type</label>
                            <select name="pcat" id="ptype" autocomplete="off" required>
                            <option value="none" selected disabled hidden>--Select--</option> 
                                <option value="monthly">Monthly</option>
                                    <option value="quarterly">Quarterly</option>
                                    <option value="halfyearly">Half Yearly</option>
                                     <option value="yearly">Yearly</option>
                                     </select>
    
                        </div>
                 
                        </div>
                        <div class="title">
                            <h3>document details</h3>
                        </div>
                    <div class="doc-det">
                        <div class="input-box">
                            <label for="aphoto">applicant photo</label>
                            <input type="file" name="aphoto" autocomplete="off" required>
                        </div>
                        <div class="input-box">
                            <label for="aaphoto">aadhar upload</label>
                            <input type="file" name="aaphoto" autocomplete="off" required>
                            </div>
                        

                    </div>
                   
           
                    <div class="sbtn">
                        <button type="submit" name="submit">submit</button>
                        </div>
                </form>
             </div>
             </div>
        </div>
    </section>
</body>
</html>