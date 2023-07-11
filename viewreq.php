<!DOCTYPE html>
<html>
    <head>
        <title>View Requests</title>
        <meta charset="UTF-8">
        <meta name="description" content="This is a blood dontation Website">
        <meta name="author" content="ShriKumaran,Anu Cyril Saju,Swati Anandan">
        <meta name="view-port" content="width=device-width initial-height=1.0">
        <link rel="stylesheet" type="text/css" href="donor_history.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
        $sql = "SELECT bb_name FROM donor_req d,bloodbank b WHERE d_username='$d_name' AND d.bb_username=b.bb_username";
        $query = mysqli_query($bd,$sql);
        if(mysqli_num_rows($query)!=0)
        {
            $tab = "<table style='margin-left:200px;border: 1px solid rgb(87, 6, 6);border-collapse:collapse;'>
            <tr>
                <th colspan='3' style='color:rgb(188, 14, 14);font-size:30px'>Requests Recieved</th>
            </tr>";
            $i = 1;
            while($row = mysqli_fetch_row($query))
            {
                 //creating an html table
                $tab = $tab."<tr><td>".$row[0]."</td>";
                $tab = $tab."<td><button id='btn1' onclick='requested(id)'>Accept</button></td>";
                $tab = $tab."<td><button id='btn2' onclick='declined(id)'>Decline</button></td></tr>";
                $i++;
            }
            $tab = $tab."</table>";
            echo $tab;
        
        }
        else
        {
            echo "Nos requests recieved!";
        }
        ?>
        </center>
        <div class="footer" style="height:40px; background-color:rgba(0, 0, 0, 0.404);text-align:center;font-size:20px;">
            <p>&#169; Designed and Developed by Students of SCOPE</p>
        </div>
        <script>
            var flag=1;
            function requested(c)
            {
                if(flag==1)
                {
                    var btn=document.getElementById(c);
                    btn.innerText="Accepted";
                    btn.style.background="green";
                    flag=0;
                }
            }
            function declined(c)
            {
                if(flag==1)
                {
                    var btn1=document.getElementById(c);
                    btn1.innerText="Declined";
                    btn1.style.background="red";
                    btn1.style.color="white";
                    flag=0;
                }
            }
        </script>
    </body>
</html>