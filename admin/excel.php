<?php
    include('server.php');
    session_start();
    if(isset($_POST['submit']))
    {
         $fname = $_FILES['sel_file']['name'];
         echo 'Archivo Cargado: '.$fname.' ';
         $chk_ext = explode(".",$fname);
        
         if(strtolower(end($chk_ext)) == "csv")
        {
        
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
       
	   		set_time_limit(0);	
			 
             while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
            {
                if($data){
                     $data1 = $data[0];
                     $data2 = $data[1];
                     $data3 = $data[2];
                     $data4 = $data[3];
                     $sq = "SELECT * FROM `member` WHERE `rusmail` = '$data3' ORDER BY 'memId'";
                     $res = mysqli_query($conn, $sq);
                    if(mysqli_num_rows($res) > 0){
                        
                        
                        $sql = "UPDATE `member` SET `firstname` = '$data1', `lastname` = '$data2', `rusmail` = '$data3', `password` = '$data4', `status` = '2'";
                        $que = mysqli_query($conn, $sql);
                        
                        
                    }else{
                       
                        
                        $sql = "INSERT INTO `member`(`memId`,`firstname`, `lastname`, `rusmail`, `password`, `status`, `access_token`) values(NULL, '$data1','$data2', '$data3', '$data4', '2', NULL)";
                        $result = mysqli_query($conn, $sql);
                        
                    }                         
                    
                }
            }
          
       
                fclose($handle);
                echo "Importación exitosa!";
                header("location: import.php");
        } 
        
         else
        {
            $_SESSION['mes'] = "ไม่มีไฟล์ข้อมูล";
            header('location: import.php');
        }   
    }
?>