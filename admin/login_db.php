<?php
   
   session_start();
    include_once('server.php');

    $errors = array();

    if (isset($_POST['submit'])) {
        $rusmail = mysqli_real_escape_string($conn, $_POST['rusmail']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
       // $password = $conn->real_escape_string($_POST['password']);
       // echo $rusmail;
        //echo $password;
    
        // if (empty($rusmail)) {
        //     array_push($errors, "Username is required");
        // }

        // if (empty($password)) {
        //     array_push($errors, "Password is required");
        // }

        if (count($errors) == 0) {
          //  $password = md5($password);
           $sql = "SELECT * FROM `member` WHERE `rusmail` = '".$rusmail."' AND `password` = '".$password."'";
          //  $sql = "SELECT * FROM `member` WHERE rusmail = '".$rusmail."' AND password = '".$password."' ";
            //$result = mysqli_query($conn, $sql);  
            $result = $conn->query($sql);
            echo print_r($result);         
            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_array($result);
                $_SESSION['memId'] = $row["memId"];
                $_SESSION['rusmail'] = $row["rusmail"];
                $_SESSION['status'] = $row["status"];
                $_SESSION['success'] = "Your are now logged in";
                if($_SESSION['status']=="1"){
                    header("location: index.php");
                }else {
                    header("location: index2.php");
                }
            } else {
                array_push($errors, "Wrong Username or Password");
                $_SESSION['error'] = "Wrong Username or Password!";
                header("location: login.php");
            }
        } else {
            array_push($errors, "rusmail & Password is required");
            $_SESSION['error'] = "rusmail & Password is required";
            header("location: login.php");
        }
    }

?>