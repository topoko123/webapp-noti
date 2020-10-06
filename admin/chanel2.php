<?php 
        session_start();
        include_once('server.php');   
        
?>
<?php 
       if (isset($_GET['chanel'])){
        $roomId = $_GET['chanel'];
        echo $roomId;
        $memId = $_SESSION['memId'];
        $sql = "INSERT INTO `subscribe`(`subId`, `memId`, `roomId`) VALUES ('', '$memId' , '$roomId')";
        $result = mysqli_query($conn, $sql);
        header("location: chanel.php");
       }
?>