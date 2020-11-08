
<?php
   
    session_start();
    include_once('server.php');
    $input = file_get_contents('php://input');
    $obj = json_decode($input);
    
    
    if (isset($_POST['submit'])) {
        $rusmail = mysqli_real_escape_string($conn, $_POST['rusmail']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
       $password = $conn->real_escape_string($_POST['password']);
       echo $rusmail;
        echo $password;
    
        if (count($errors) == 0) {
          //  $password = md5($password);
           $sql = "SELECT * FROM `member` WHERE `rusmail` = '".$rusmail."' AND `password` = '".$password."'";
        //    $sql = "SELECT * FROM `member` WHERE rusmail = '".$rusmail."' AND password = '".$password."' ";
        //     $result = mysqli_query($conn, $sql);  
            $result = $conn->query($sql);
            echo print_r($result);         
            if (mysqli_num_rows($result) > 0) {
                
                $row = mysqli_fetch_array($result);
                $_SESSION['memId'] = $row['memId'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['rusmail'] = $row['rusmail'];
                $_SESSION['status'] = $row['status'];
                $_SESSION['success'] = "Your are now logged in";
                if($_SESSION['status']=="1"){
                    header("location: index.php");
                }else {
                    header("location: index.php");
                }
            } else {
                
                echo "<script>alert('ไม่พบผู้ใช้ กรุณาลองใหม่');</script>" ;
                header("location: login.php");
            }
        } else {
            echo "<script>alert('ไม่พบผู้ใช้ กรุณาลองใหม่');</script>" ;
            header("location: login.php");
        }
    }

?>