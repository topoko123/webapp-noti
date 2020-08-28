<?php 


    $header = "Testing Line Notify";
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    $message = $haeder.
                "\n". "ชื่อจริง: " . $firstname .
                "\n". "นามสกุล: " . $lastname .
                "\n". "เบอร์โทรศัพท์: " . $phone .
                "\n". "อีเมล์: " . $email;

    if (isset($_POST["submit"])) {
        if ( $firstname <> "" ||  $lastname <> "" ||  $phone <> "" ||  $email <> "" ) {
            sendlinemesg();
            header('Content-Type: text/html; charset=utf8');
            $res = notify_message($message);
            echo "<script>alert('สมัครสมาชิกเรียบร้อย');</script>";
            header("location: linenotipage.php");
        } else {
            echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');</script>";
            header("location: linenotipage.php");
        }
    }

    function sendlinemesg() {
        
		// LINE LINE_API https://notify-api.line.me/api/notify //นี่คือ ลิงก์เชื่อมต่อกับ linenotify
        // LINE TOKEN tJX3sfW98K2EeVtKKBjFihj6cYmPpPTo2hiRjgzjxa4 
        //bofTwv1Y7oU3bOdXKK6v5VgOlTAZ1ZIerR1VtQhsqwC key Aun
        //jQIRr6rrL5RMJaSx1hnSKyBuX0lHUEK70cr5Scngsuo
        //define เป็นการเก็บค่างคงที่แบบ run-time
        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',"tJX3sfW98K2EeVtKKBjFihj6cYmPpPTo2hiRjgzjxa4");

        function notify_message($message) {
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                ."Content-Length: ".strlen($queryData)."\r\n",
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API, FALSE, $context);
            $res = json_decode($result);
            return $res;
        }
    }


?>