<?php
session_start();
require_once("LineNotifyLib.php");
 
define('LINE_NOTIFY_CLIENT_ID','Bls7f9yTn7I7CA9jAue1lK');
define('LINE_NOTIFY_CLIENT_SECRET','iDjHuOHjH81dnPlzXMggmW9K4CMAoapdZcd3rRhrMtC');
define('LINE_NOTIFY_CALLBACK_URL','https://6307b36bfc1a.ngrok.io/pro-notify/admin/callback.php');
 
$LineNotify = new LineNotifyLib(
    LINE_NOTIFY_CLIENT_ID, LINE_NOTIFY_CLIENT_SECRET, LINE_NOTIFY_CALLBACK_URL);
     
if(!isset($_SESSION['ses_accToken_val'])){  
    $LineNotify->authorizeLineNotify();  
    exit;
}
 
$accToken = $_SESSION['ses_accToken_val'];
// Status Token Check
if($LineNotify->statusToken($accToken)){
    echo "Token Status OK <br>";  
}
 
echo "<pre>";
// Status Token Check with Result 
$statusToken = $LineNotify->statusToken($accToken, true);
print_r($statusToken);
 
//////////////////////////
echo "<hr>";
// Send Notification
/*$data = array(
    "message" => "ส่งข้อความผ่าน class library"
);
 
if($LineNotify->sendLineNotify($accToken, $data)){
    echo "Send notification Pass <br>";
}*/
 
//////////////////////////
// Send Notification with Result
/*$data = array(
    "message" => "ส่งข้อความผ่าน class library"
);
 
$statusNotifySend = $LineNotify->sendLineNotify($accToken, $data, true);
print_r($statusNotifySend);*/
 
echo "<hr>";
// Revoke Token
/*if($LineNotify->revokeToken($accToken)){
    echo "Disconnected Line Notify";    
}*/
 
// Revoke Token with Result
/*$statusRevoke = $LineNotify->revokeToken($accToken, true);
print_r($statusRevoke);*/
?>
<?php
if($LineNotify->statusToken($accToken)){
?>
<form method="post">
<button type="submit" name="revoke">Disconnect Web Service Notification</button>
</form>
<?php }else{ ?>
<form method="post">
<button type="submit" name="connect">Connect Web Service Notification</button>
</form>   
<?php } ?>
<?php
if(isset($_POST['connect'])){
    $LineNotify->authorizeLineNotify();  
    exit;   
}
if(isset($_POST['revoke'])){
    echo "<hr>";
    if($LineNotify->revokeToken($accToken)){
        echo "Disconnected Line Notify<br>";  
    }
    echo '
    <form method="post">
    <button type="submit" name="connect">Connect Web Service Notification Again</button>
    </form>   
    ';
}
?>