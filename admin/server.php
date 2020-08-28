<?php

    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "web_noti";
   $conn = new mysqli('localhost', 'root', '' , 'web_noti');
    
 
    //สร้างการเชื่อมต่อ Create Connection
  //  $conn = mysqli_connect($servername, $username, $password, $dbname);
    //mysqli_query($conn, "SET NAMES 'utf8' ");

    //Check Connection
    if (!$conn) {
        die("connection failed" . mysqli_connect_error());
    }
    
    