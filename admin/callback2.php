<?php
session_start();
include('server.php');
require_once("LineNotifyLib.php");
$memId = $_SESSION['memId'];
define('LINE_NOTIFY_CLIENT_ID','Bls7f9yTn7I7CA9jAue1lK');
define('LINE_NOTIFY_CLIENT_SECRET','iDjHuOHjH81dnPlzXMggmW9K4CMAoapdZcd3rRhrMtC');
define('LINE_NOTIFY_CALLBACK_URL','https://localhost/pro-notify/admin/callback.php');
 
$LineNotify = new LineNotifyLib(
    LINE_NOTIFY_CLIENT_ID, LINE_NOTIFY_CLIENT_SECRET, LINE_NOTIFY_CALLBACK_URL);
     
    $state = $_GET['state'];
    $code = $_GET['code'];
$accToken = $LineNotify->requestAccessToken($_GET);
if(isset($accToken) && is_string($accToken)){

    $_SESSION['ses_accToken_val'] = $accToken;
    //$sql = "SELECT * FROM `member` ORDER BY `memId` asc" or die("Error" . mysqli_error());
    $sql = "UPDATE `member` SET `access_token` = '$accToken' WHERE `memId`='$memId'";
    $result = mysqli_query($conn,$sql);
    //$row = mysqli_fetch_array($result);
  
}
if (isset($result)){
    unset($_SESSION['ses_accToken_val']);
}
header("Location:login.php");
?>