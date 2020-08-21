<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "web_noti";

    //สร้างการเชื่อมต่อ Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //Check Connection
    if (!$conn) {
        die("connection failed" . mysqli_connect_error());
    }
    