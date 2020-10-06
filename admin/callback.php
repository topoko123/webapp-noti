<?php
    session_start();
    include_once('server.php');

    // if(!isset($_SESSION['my_service_state_key']) || $_GET['state'] !== $_SESSION['my_service_state_key']){
    //     if(isset($_SESSION['my_service_state_key'])){
    //         unset($_SESSION['my_service_state_key']);   
    //     }
    //     print_r($_SESSION['my_service_state_key']) ;
    //     echo 'State Validation fail <br>';
    //     echo '<a href="authorize.php"></a>';
    //     exit;
    // }

    echo "<pre>";
    print_r($_GET);

    if(!isset($_GET['error']) && isset($_GET['code']) && $_GET['code'] != ""){
        $code = $_GET['code'];
        $tokenURL = "https://notify-bot.line.me/oauth/token";

        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        $data = array(
            'grant_type' => 'authorization_code', // ไม่แก้ไขส่วนนี้
            'code' => (string)$code,
            'redirect_uri' => 'https://fee7e9d7b780.ngrok.io/pro-notify/admin/callback.php',
            'client_id' => 'Bls7f9yTn7I7CA9jAue1lK',
            'client_secret' => 'iDjHuOHjH81dnPlzXMggmW9K4CMAoapdZcd3rRhrMtC'                 
        );

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $tokenURL);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch,CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close($ch);

        $result = json_decode($result,TRUE);
         // ตรวจสอบข้อมูล ใช้เป็นเงื่อนไขในการทำงาน
    if(!is_null($result) && array_key_exists('status',$result)){
        if($result['status']==200){
            echo "Access token is: ".$result['access_token'];
            $memId = $_SESSION['memId'];
            $access_token = $result['access_token'];
            $sql = "UPDATE `member` SET `access_token` = '$access_token' WHERE `memId`='$memId'";
            $re = mysqli_query($conn,$sql);
            header("location: index.php");
        }
    }
    }else{ // กรณีเกิด error หรืออื่นๆ 
        if(isset($_SESSION['my_service_state_key'])){
            unset($_SESSION['my_service_state_key']);   
        }
        echo 'Authorization fail <br>';
        echo '<a href="authorize.php"></a>';
        exit;       
    }
?>