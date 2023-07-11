<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <meta charset="UTF-8">
    <meta name="description" content="This is a blood dontation Website">
    <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
    <meta name="view-port" content="width=device-width initial-height=1.0">
    <link rel="stylesheet" type="text/css" href="recipienthome.css">
    <meta http-equiv="refresh" content="1900">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<nav>
    <img src="homepagelogo.png" height="70px">
    <label><b>Life Blood Bank Management System</b></label>
    <ul>
    <li><a href="bloodbank.php">Go Back</a></li>
    </ul>
</nav>
<!-- establishing the php connection -->
<?php session_start()?>
<?php 
    $bname = $_SESSION["name"];
    $mysql_hostname = "localhost";
    $mysql_password = "";
    $mysql_user = "root";
    $mysql_database = "bbms";
    $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
    mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
    //echo"database connection success";
    $sql = "SELECT * FROM donor";
    $query = mysqli_query($bd,$sql);
    $i = 1;
    if(mysqli_num_rows($query)!=0)
    {
        $tab = "<form method='post'<div class='container'>
        <table border='1' style='margin-left:150px;'>
            <tr>
                <th colspan='6' style='color:red;font-size:40px'>Donors</th>
            </tr>
            <tr>
                <th>Donor Name</th>
                <th>Email-id</th>
                <th>Age</th>
                <th>Blood Group</th>
                <th>Phone Number</th>
                <th>Action</th>
            </tr>
            ";
        $dnames = array();
        while($row = mysqli_fetch_row($query))
        {
            //creating an html table
            $tab = $tab."<tr><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td>";
            $tab = $tab."<td><button name='btn-$i' id='btn-$i'>Request Blood</button></td></tr>";
            array_push($dnames,$row[1]);
            $i++;
        }
        $tab = $tab."</table></div></form>";
        echo $tab;
    }
    
    for($j=0;$j<$i-1;$j++)
    {
        // echo "The donor names is ". $dnames[$j];
    if(isset($_POST['btn-'.$j]))
    {

        $query="INSERT INTO donor_req VALUES('".$bname."','".$dnames[$j-1]."')";
        $result = mysqli_query($bd,$query);
        if($result)
        {
            echo"<script>swal('success','Request Sent Successfully','success');
            var btn = document.getElementById('btn-$j');
            btn.innerText = 'Requested';
            btn.style.background = 'lightgreen';
            btn.disabled = true;
            </script>";
        }
    }
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
    
   // echo "New session is created.<br/>";
}
else
    //echo "Current session exists.<br/>";  
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
?>
<div class="footer" style="height:40px">
    <p>&#169; Designed and Developed by Students of SCOPE</p>
</div>
</body>
</html>


