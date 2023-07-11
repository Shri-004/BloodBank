<!DOCTYPE html>
<html>
    <head>
        <title>Blood Banks</title>
        <meta charset="UTF-8">
        <meta name="description" content="This is a blood dontation Website">
        <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
        <meta name="view-port" content="width=device-width initial-height=1.0">
        <meta http-equiv="refresh" content="1900">
        <link rel="stylesheet" type="text/css" href="donor_home.css">
        <script>
            function view()
            {
                const successCallback = (position) => {
                                console.log(position);
                                };
                const errorCallback = (error) => {
                                console.log(error);
                                };
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                window.location.href="https://www.google.com/maps/search/blood+bank/@postion.coords.latitude,position.coords.logitude,10z/data=!3m1!4b1";   
            }
        </script>
    </head>
    <body>
        <nav>
            <img src="homepagelogo.png" height="70px">
            <label><b>Life Blood Bank Management System</b></label>
            <ul>
            <li><a href="donor_history.php">View History</a></li>
            <li><a href="viewreq.php">View Requests</a></li>
            <li><a href="bookapmt.php">Book Appoinments</a></li>
            <li><a href="viewbank.php">View Blood Banks</a></li>
            </ul>
        </nav>
        <button onclick="view()" id="view">View All Blood Banks in Map</button><br>
        <center>
        <?php session_start(); ?>
        <?php 
        $mysql_hostname = "localhost";
        $mysql_password = "";
        $mysql_user = "root";
        $mysql_database = "bbms";
        $bd = mysqli_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Could not connect database");
        mysqli_select_db($bd,$mysql_database) or die("Cannot select database");
        $d_name=$_SESSION["username"];
        $sql =  "SELECT * FROM bloodbank";
        $query = mysqli_query($bd,$sql);
        if(mysqli_num_rows($query)!=0)
        {
            $tab = "<table style='margin-left:200px;border: 1px solid rgb(87, 6, 6);border-collapse:collapse;'>
            <caption style='color:rgb(188, 14, 14);font-size:30px'>Blood Banks</caption>
            <tr>
                <th>Blood bank Name</th>
                <th>A+</th>
                <th>A-</th>
                <th>B+</th>
                <th>B-</th>
                <th>O+</th>
                <th>O-</th>
                <th>AB+</th>
                <th>AB-</th>
            </tr>
            ";
            $i = 1;
            while($row = mysqli_fetch_row($query))
            {
                 //creating an html table
                $tab = $tab."<tr><td>".$row[1]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$row[10]."</td>";
                $i++;
            }
            $tab = $tab."</table>";
            echo $tab;
        
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
    header("location:donorlogin.php");
    // //Start another new session
    //session_start();
    
    //echo "New session is created.<br/>";
}
else
    //echo "Current session exists.<br/>";  
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
?>
        </center>
        <div class="footer" style="height:40px; background-color:rgba(0, 0, 0, 0.404);text-align:center;font-size:20px;">
            <p>&#169; Designed and Developed by Students of SCOPE</p>
        </div>
    </body>
</html>