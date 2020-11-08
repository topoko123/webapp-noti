<?php
    session_start();
    include_once('server.php');
    
    if (isset($_POST['send'])){
        
           
            $choose =  $_POST['choose'];      
            $sql = "SELECT subId,s.memId,s.roomId,m.memId,m.access_token,r.roomId,r.room_name FROM subscribe s INNER JOIN member m ON s.memId = m.memId INNER JOIN room r ON s.roomId = r.roomId WHERE s.memId = m.memId AND s.roomId = '$choose'";
            $re = mysqli_query($conn, $sql);
            // $sq = "SELECT * FROM `room`";
            // $ress = mysqli_query($conn, $sq);
            // $rowss = mysqli_fetch_assoc($re);   
            while($row = mysqli_fetch_assoc($re)){
            
            if (mysqli_num_rows($re) > 0){
                
                $ttken = $row['access_token'];
                $accToken = "$ttken";
                $notifyURL = "https://notify-api.line.me/api/notify";
                            $headers = array(
                                'Content-Type: application/x-www-form-urlencoded',
                                'Authorization: Bearer '.$accToken
                            );
                            $servicename = $row['room_name'];
                            $topic = $_POST['topic'];
                            $textarea = $_POST['content'];
                            
                        $message = $servicename .
                        "\n". "หัวข้อ: " . $topic .
                        "\n". "เนื้อหา: " . $textarea ;
                        
                        $data = array(
                            'message' => $message                  
                        );
                        $ch = curl_init();
                        curl_setopt( $ch, CURLOPT_URL, $notifyURL);
                        curl_setopt( $ch, CURLOPT_POST, 1);
                        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
                        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
                        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
                        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
                        $result = curl_exec( $ch );
                        
                        curl_close( $ch );
                        
                        var_dump($result);
                        
                        $result = json_decode($result, TRUE);
                        if(!is_null($result) && array_key_exists('status',$result)){
                            if($result['status']==200){
                                $qq = "INSERT INTO `msghis` (`msgId`, `msgSv`, `msgTopic`, `msgTxt`, `msgTime`) VALUES ('', '$servicename', '$topic', '$textarea', CURRENT_TIMESTAMP)";
                                $qs = mysqli_query($conn, $qq);
                                $_SESSION['complete'] = 'ส่งข้อความสำเร็จ';
                                header("location: notify_service.php");
                            
                            }
                        }
                        
                    }
                   
            }
                        if (mysqli_num_rows($re) <= 0){
                            $_SESSION['nothing'] = 'ห้องนี้ยังไม่มีผู้ติดตาม';
                             header("location: notify_service.php");
                        }

    }
    
    
        
    
?>