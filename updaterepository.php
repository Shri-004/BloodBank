<!DOCTYPE html>
<html>
<head>
    <title>Update repository</title>
    <meta charset="UTF-8">
    <meta name="description" content="This is a blood dontation Website">
    <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
    <meta name="view-port" content="width=device-width initial-height=1.0">
    <meta http-equiv="refresh" content="1900">
    <link rel="stylesheet" type="text/css" href="recipienthome.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        form{
            font-size:20px;
            transform:translateY(100px);
        }
        input[type="submit"]
        {
            font-size:20px;
            border-radius:10px;
            padding:10px 20px;
            background-color:lightgreen;
        }
    </style>

</head>
<body>
<nav>
    <img src="homepagelogo.png" height="70px">
    <label><b>Life Blood Bank Management System</b></label>
    <ul>
    <li><a href="bloodbank.php">Go Back</a></li>
    </ul>
</nav>
<center>
<div class="container" style="height:520px">
<form action="<?php $_php_self ?>" method="post" style="width:500px;height:250px;background-color:white;">
    <h1>Enter the Details</h1><br>
    <label>Donor Name</label>
    <input type="text" name="dname"><br><br>
    <label>Amount of Blood Donated</label>
    <input type="text" name="amount" id="amount"><br><br>
    <input type="submit" name="btn"value="submit">
</form>
</div>
</center>
<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    USE PHPmAILER\PHPMailer\Exception;
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';
    session_start();
?>
<!-- establishing the php connection -->
<?php 
   if(isset($_POST['btn']))
   {
    $mysql_hostname = "localhost";
    $mysql_password = "";
    $mysql_user = "root";
    $mysql_database = "bbms";
    $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
    mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
    //echo"database connection success";
    $name = $_SESSION["name"];
    $dname = $_POST["dname"];
    $amt = $_POST["amount"];
    //echo $name.$dname.$amt;
    //echo "The name of the blood bank is $name";
    $sql = "SELECT bgrp,email FROM donor WHERE d_username = '$dname'";
   // echo "The name type is $dname";

   // $sql = "UPDATE bloodbank SET where bb_username = $name";
    $query = mysqli_query($bd,$sql);
    $result = mysqli_num_rows($query);
    if($result>0)
    {
        $row = mysqli_fetch_row($query);
        $bloodgroup = $row[0];
        $email = $row[1];
        $_SESSION["donoremail"] = $email;
        //echo"email is $email";
        $bloodgroup = str_replace("-","2",$bloodgroup);
        $bloodgroup = str_replace("+","1","$bloodgroup");
        
       // echo"the bloodgroup is $bloodgroup";
        $bloodgiven = $_POST["amount"];
        //getting the amoun to blood current in repository
        $sql1 = "SELECT $bloodgroup FROM bloodbank WHERE bb_name='$name'";
        $query1 = mysqli_query($bd,$sql1);
        $row1 = mysqli_fetch_row($query1);
        $currentblood = $row1[0];
      //  echo "The current repository is ".$currentblood;
        $new = $currentblood + (int)$bloodgiven;
      //  echo"The new blood is $new";
        $sql1 = "UPDATE bloodbank SET $bloodgroup=$new WHERE bb_name='$name'";
        $query1 = mysqli_query($bd,$sql1);
        $sql2 = "INSERT INTO donor_history VALUES('".$dname."','".$name."','".$bloodgiven."',CAST(curdate() AS Date))";
         $query2 = mysqli_query($bd,$sql2);
        if($query1)
        {

            
                $mail = new PHPMailer(true);
                $mail->Host = 'smtp.gmail.com';
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->Username = 'shrikumaran.pa2020@vitstudent.ac.in';
                $mail->Password = 'fiikcvoivnqgaccv ';
                $mail->setFrom('shrikumaran.pa2020@vitstudent.ac.in');
                $mail->addAddress($_SESSION["donoremail"]);
                $mail->addAddress($_SESSION['donoremail']);
                $mail->addAttachment("blooddrop.jpg");
                $mail->isHTML(true);
                $mail->Subject = "Thank You for Donating Blood";
                $mail->Body = "This message is from ".$_SESSION["name"]."<br>
                We appreciate your donation!. Your contribution will help us change lives - litrally!
                Someones's quality of live was improved because you gave us you blood. That's pretty 
                remarkable, and so are you. Thank you!";
                $mail->send();
                echo "<script>
                      swal('Success','mail sent successfully','success');
                      //document.location.href='updaterepository.php';
                      </script>";
        //echo"<script>swal('Success','Repository Updated Successfully','success')</script>";
       // header("location:send.php");

        }
        else
        echo"Error";


    }
    else{
        echo"<script>swal('Error','Enter a valid username','error')</script>";
    }
    // echo"The number of rows is ".$result;
    //print_r($query);
    //echo "fetch filed".mysqli_fetch_field($query);
    //echo "Row of 0 is ".$row[0];
    // if(mysqli_num_rows($query)==0)
    // {
    //     echo "<script>swal('Enter a valid username','Select a Blood Type','error')</script>";
    // }
    // else{
    //     echo "The blood group is $query";
    // }
}
?>
<?php
//Start a new session
//session_start();
//Set the session duration for 5 seconds
$duration = 1800;
//Read the request time of the user
$time = $_SERVER['REQUEST_TIME'];
//Check the user's session exist or not
if (isset($_SESSION['LAST_ACTIVITY']) &&
   ($time - $_SESSION['LAST_ACTIVITY']) > $duration) {
    //Unset the session variables
    session_unset();
    //Destroy the session
    session_destroy();
    header("location:bloodbanklogin.php");
    // //Start another new session
    //session_start();
    
    //echo "New session is created.<br/>";
}
else
   // echo "Current session exists.<br/>";  
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
?>
<div class="footer" style="height:40px">
    <p>&#169; Designed and Developed by Students of SCOPE</p>
</div>
<script>
    function request(id)
    {
        var btn = document.getElementById(id);
        console.log(btn);
        console.log("requested");
        btn.innerText="Requested";
        btn.style.background = "green";
    }
</script>
</body>
</html>


