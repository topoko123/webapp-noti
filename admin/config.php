<?php

    require_once('vendor/autoload.php');
    define('gClientID', "752846571001-b3es2ohl10jjgasnmomp9esdon720qlt.apps.googleusercontent.com");
    define('gSecret', "K1jVWQi6cmoz9AFffQuvtZP4");
    define('gRedirect', "https://9ee31116b5fc.ngrok.io/pro-notify/admin/login_db.php");
    $google_client = new Google_Client();
    $google_client->setApplicationName("LoginWebsite");
    $google_client->setClientId("752846571001-b3es2ohl10jjgasnmomp9esdon720qlt.apps.googleusercontent.com");
    $google_client->setClientSecret("K1jVWQi6cmoz9AFffQuvtZP4");
    $google_client->setRedirectUri(gRedirect);
    $google_client->setDeveloperKey("AIzaSyBQhV-OBzk55vizKvIqfUx_Vt6vJ65aBV8");
    $google_client->addScope("https://www.googleapis.com/auth/userinfo.profile");
    $google_client->addScope("https://www.googleapis.com/auth/userinfo.email");
    //$google_client->addScope("https://www.googleapis.com/auth/userinfo.email");
    
    
    
?>