<?php
    include ('server.php');
?>
<?php
    if(isset($_POST['import']))
    {
        echo $file = $_FILES['file']['tmp_name'];
        if($_FILES["file"]["size"]>0)
        {
            $file = fopen($filename,"r");
            while (($empData = fgetcsv($file, 10000, ",")) !==  FALSE)
            {
                $sql = "INSERT INTO `member` (`firstname`, `lastname`, `rusmail`) VALUES (
                    '$firstname','$lastname','$rusmail')";
            }
        }
        
    }
?>