<?php 
        session_start();
        include_once('server.php');   
        
?>
<?php 
       if (isset($_GET['chanel'])){
        $roomId = $_GET['chanel'];
        $memId = $_SESSION['memId'];
        $sql = "DELETE FROM `subscribe` WHERE `roomId` = '$roomId'";
        $result = mysqli_query($conn, $sql);
        header("location: chanel.php");
       }
?>