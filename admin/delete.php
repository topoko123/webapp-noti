<?php 
include_once('server.php');
       
        if(isset($_GET['id'])){
            $roomid = $_GET['id'];
            $sql = "DELETE FROM `room` WHERE roomId=$roomid";
            $result = mysqli_query($conn, $sql);

            if($result){
                echo "<script>alert('ทำการลบสำเร็จ');</script>";
                header("location: chanel.php");
            }else{
                echo "<script>alert('ไม่สามารถลบได้');</script>";
                header("location: chanel.php");

            }
            
        }
?>